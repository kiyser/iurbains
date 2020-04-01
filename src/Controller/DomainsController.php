<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Domains Controller
 *
 * @property \App\Model\Table\DomainsTable $Domains
 *
 * @method \App\Model\Entity\Domain[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DomainsController extends AppController
{
    public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['listesliees']);
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
            'contain' => ['Themes'],
			'limit' => 10,
			'groupby' => ['theme_id'],
        ];
        $domains = $this->Domains->find();
		if ($this->request->is(['patch', 'post', 'put'])) {
			if(!empty($this->request->data['theme_id'])) $domains->where(['Domains.theme_id' => $this->request->data['theme_id']]);
		}
		$themes = $this->Domains->Themes->find('list');
		$domains = $this->paginate($domains);

        $this->set(compact('domains', 'themes'));
    }

    /**
     * View method
     *
     * @param string|null $id Domain id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $domain = $this->Domains->get($id, [
            'contain' => ['Themes', 'Indicators', 'Mdvs']
        ]);

        $this->set('domain', $domain);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $domain = $this->Domains->newEntity();
        if ($this->request->is('post')) {
            $domain = $this->Domains->patchEntity($domain, $this->request->getData());
			$domain->created_by = $this->request->session()->read('Auth.User.id');
            if ($this->Domains->save($domain)) {
                //Sauvegarde de l'action
				$this->__setInspectors('Domains', 'edit', $domain->id);
                $this->Flash->success(__('Enregistrement effectué avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->erreur(__('Impossible d\'effectuer l\'enregistrement. Veuillez recommencer svp.'));
        }
        $themes = $this->Domains->Themes->find('list', ['limit' => 200]);
        $this->set(compact('domain', 'themes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Domain id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $domain = $this->Domains->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $domain = $this->Domains->patchEntity($domain, $this->request->getData());
			$domain->modified_by = $this->request->session()->read('Auth.User.id');
            if ($this->Domains->save($domain)) {
                //Sauvegarde de l'action
				$this->__setInspectors('Domains', 'edit', $domain->id);
                $this->Flash->success(__('Mise à jour effectuée avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->erreur(__('Impossible d\'effectuer la mise à jour. Veuillez recommencer svp.'));
        }
        $themes = $this->Domains->Themes->find('list', ['limit' => 200]);
        $this->set(compact('domain', 'themes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Domain id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $domain = $this->Domains->get($id);
        if ($this->Domains->delete($domain)) {
            $this->Flash->success(__('L\élément a été supprimé avec succès.'));
        } else {
            $this->Flash->erreur(__('Impossible de supprimer l\élément. Veuillez recommencer svp.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	/****** FONCTION DE SELECTION DES DOMAINES D'UN THEME ******/
	public function listesliees(){
		$domains = $this->Domains->newEntity();
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
			if(isset($_GET['theme']))
			{
				if($_GET['theme'] == 0) $domains = null;
				else $domains = $this->Domains->find('all', ['conditions' => ['AND' => ['theme_id' => $_GET['theme']]]]);
				echo '<option value=""> -- Sélectionner le domaine -- </option>';
				foreach ($domains as $domain):
					echo '<option value="'.$domain->id.'">'.$domain->domain_name_fr.'</option>';
				endforeach;
			}
        }
    }
}
