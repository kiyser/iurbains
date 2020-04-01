<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout', 'inscription', 'confirmation', 'activate', 'activation']);
		$this->loadComponent('Flash');
		$this->loadComponent('RequestHandler');
	}
	/**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Groups', 'Structures'],
			'limit' => 10,
        ];
        $users = $this->paginate($this->Users);
		$this->__getUserInfos($this->request->session()->read('Auth.User.id'));
        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Groups', 'Structures']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
			$user->created_by = $this->request->session()->read('Auth.User.id');
			$hasher = new DefaultPasswordHasher;
			$user->password = $hasher->hash($user->password);
            if ($this->Users->save($user)) {
				$this->__setInspectors('Users', 'add', $user->id);
				//$this->send_mail_to_activate($user);
                $this->Flash->success(__('Enregistrement effectué avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->erreur(__('Impossible d\'effectuer l\'enregistrement. Veuillez recommencer svp.'));
        }
        $groups = $this->Users->Groups->find('list');
        $structures = $this->Users->Structures->find('list');
        $this->set(compact('user', 'groups', 'structures'));
    }
	/***** Fonction d'inscription à la plateforme *****/
	public function inscription() {
		$this->viewBuilder()->layout('default_access');
		$user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
			$user->group_id = $this->Users->Groups->find('all', ['conditions' => ['group_abrev' => 'UA']])->first()->id;
			$hasher = new DefaultPasswordHasher;
			$user->password = $hasher->hash($user->password);
			/*echo '<br><br><br>'.$user->password;*/
            if ($this->Users->save($user)) {
				$this->__setInspectors('Users', 'inscription', $user->id);
				//$this->send_mail_to_activate($user);
				return $this->redirect(['controller'=>'Users', 'action' => 'confirmation']);
            }
        }
        $groups = $this->Users->Groups->find('list');
        $structures = $this->Users->Structures->find('list');
        $this->set(compact('user', 'groups', 'structures'));
	}

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit__($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
			$user->modified_by = $this->request->session()->read('Auth.User.id');
            if ($this->Users->save($user)) {
                //Sauvegarde de l'action
				$this->__setInspectors('Users', 'edit', $user->id);
                $this->Flash->success(__('Mise à jour effectuée avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->erreur(__('Impossible d\'effectuer la mise à jour. Veuillez recommencer svp.'));
        }
        $groups = $this->Users->Groups->find('list');
        $structures = $this->Users->Structures->find('list');
        $this->set(compact('user', 'groups', 'structures'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
		$this->__setInspectors('Users', 'delete', $user->id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('L\élément a été supprimé avec succès.'));
        } else {
            $this->Flash->erreur(__('Impossible de supprimer l\élément. Veuillez recommencer svp.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	/***** Fonction de connexion à la plateforme *****/
	public function login() {
		$this->viewBuilder()->layout('default_access');
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user) {
				$data_user = $this->Users->findByUsername($user['username'])->first();
				if($data_user->statut == 10) $this->Flash->erreur(__(' Votre compte a été désactivé. Veuillez contacter l\'administrateur pour plus d\'informations.'));
				else if($data_user->statut == 0) $this->Flash->erreur(__(' Oups! Vous n\'avez pas encore accès à votre compte. Veuillez activer votre compte en cliquant sur le lien d\'activation envoyé dans votre boîte mail.'));
				else {
					$this->Flash->info(__('<b><i>Bienvenue '.$user['firstname'].' '.$user['lastname'].'</i></b><br>Vous êtes maintenant connecté à la plateforme. Profitez-en!'));
					$this->Auth->setUser($user);
					//Sauvegarde de l'action
					$this->__setInspectors('Users', 'login', $this->request->session()->read('Auth.User.id'));
					return $this->redirect(['action' => 'view', $this->request->session()->read('Auth.User.id')]);
					//return $this->redirect($this->Auth->redirectUrl());
				}
			}
			else $this->Flash->erreur(__('Votre identifiant ou mot de passe est incorrect.'));
		}
	}
	/***** Fonction de déconnexion de la plateforme *****/
	public function logout() {
		//$this->Flash->success(__('Good-Bye'));
		$this->redirect($this->Auth->logout());
		$this->Flash->info(__('Vous êtes maintenant déconnecté de la plateforme des indicateurs urbains.'));
	}
	/***** Fonction de confirmation de l'inscription à la plateforme *****/
	public function confirmation() {
		$this->viewBuilder()->layout('default_access');
	}
	/****** FONCTION D'ACTIVATION ET DE DESACTIVATION DES UTILISATEURS ******/
	public function edit($id = null){
		$user = $this->Users->get($id);
        $groups = $this->Users->Groups->find('list');
        $structures = $this->Users->Structures->find('list');
		
        if ($this->request->is(['ajax'])) {
			$this->autoRender = false;
			if($user->statut == 1){
				$user->statut = 10;
			}else{
				$user->statut = 1;
				$action = 'activation';
			}
			if ($this->Users->save($user)) {
				$this->__setInspectors('Users', $action, $user->id);
				echo $user->statut;
			}			
		}
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
			if($user->statut == 0 && $user->activate_by == null && $user->activate_date == null){
				//return $this->redirect(['controller'=>'Users', 'action' => 'activate', $user->password, $user->id, $user->group_id]);
				$this->activate($user->password, $user->id, $user->group_id);
			}else{
				$user->modified_by = $this->request->session()->read('Auth.User.id');
				if ($this->Users->save($user)) {
					$this->__setInspectors('Users', 'edit', $user->id);
					$this->Flash->success(__('Mise à jour effectuée avec succès.'));
					return $this->redirect(['action' => 'view', $user->id]);
				}
				$this->Flash->erreur(__('Impossible d\'effectuer la mise à jour. Veuillez recommencer svp.'));
			}
        }//echo '<br><br><br><br>'.$this->__getUserConnectedInfos($this->request->session()->read('Auth.User.id'))->id;
        $this->set(compact('user', 'groups', 'structures'));
    }
	/****** FONCTION D'ACTIVATION DES COMPTES UTILISATEURS ******/
	public function activate($key = null, $id = null, $gpe = null)
    {
        $user = $this->Users->get($id);
		$return = 0;
		if($user['password'] == $key && $user['statut'] == 0)
		{
			$user['statut'] = 1;
			$user['group_id'] = $gpe;
			$user['activate_date'] = date("Y-m-d H:i:s");
			$user['activate_by'] = $this->request->session()->read('Auth.User.id') ? $this->request->session()->read('Auth.User.id') : $user['id'];
			$user['profil'] = "IU/Profils/".$user['id']."/inconnu.png";
			if ($this->Users->save($user)) {				
				$return = $user['group_id'];
				$user_path = $user['id'];
				$default = new Folder(WWW_ROOT.'img/Default');				
				$complete_path = WWW_ROOT.'img/IU/Profils/'.$user_path;
				$folder_user = new Folder($complete_path, true, 0755);
				$default->copy($complete_path);
				$this->__setInspectors('Users', 'activate', $user->id);
				//if($user->email =! null) $this->send_mail_after_activation($user);
			}
		}
		if($this->request->session()->read('Auth.User.id')) {
			$this->Flash->success(__('Le compte utilisateur a été activé avec succès.'));
			return $this->redirect(['controller'=>'Users', 'action' => 'index']);
		}
		else return $this->redirect(['action' => 'activation', $return]);		
    }
	public function activation($param = null)
	{	
		$this->viewBuilder()->layout('default_access');
		$this->set(compact('param'));
	}
	/****** FONCTIONS D'ENVOIE DE MAIL APRES INSCRIPTION ******/
	private function send_mail_to_activate($user)
	{
	    //$user = $this->Users->get($id);
		$lien = 'iurbains/Users/activate/'.$user->password.'/'.$user->id.'/'.$user->group_id;		
		$message = '<html><body>';
		$message .= '<p style=""><b>Bonjour/Bonsoir '.$user->firstname.' '.$user->lastname.',</b></p><br>';
		$message .= '<p style="">Vous recevez ce courrier suite à votre inscription sur la plate-forme nationale de gestion des indicateurs urbains</a> en tant que UTILISATEUR AUTHENTIFIE.</p>';
		
		$message .= '<p style="">Si vous souhaitez poursuivre votre inscription et activer votre compte, vous devez cliquer sur le lien d\'activation ci-dessous: </p>';
		$message .='<p>'.$lien.'</p>';
		$message .= '<p style="">Si vous ne pouvez pas cliquer sur le lien, veuillez le copier et le coller dans la barre d\'adresse de votre navigateur.</p>';
		$message .= '<p>Cordialement</p><br><br>';
		$message .= '<p><b style="font-size:30px">IU</b></p>';
		$message .= '<p><i>Plate-forme de gestion des indicateurs urbains</i>';
		$message .= '<br>Yaoundé - Cameroun';
		$message .= '<br>E-mail: contact@minhdu.cm';
		$message .= '<br>Contacts: (+237) xxx xxx xxx <br>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;(+237) xxx xxx xxx</p><br>';
		$message .= '<p>IMPORTANT: Ceci est un message généré automatiquement. Merci de ne pas y répondre.</p>';
		$message .= "</body></html>";		
		$email = new Email('default'); 
		$email->setFrom(['mail@minhdu.cm' => 'INDICATEURS URBAINS']) 
			  ->setTo($user->email)
			  ->setEmailFormat('html') 
			  ->setSubject('Confirmer votre inscription') 
			  ->send($message);
	}
}
