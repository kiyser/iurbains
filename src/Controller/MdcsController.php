<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Mdcs Controller
 *
 * @property \App\Model\Table\MdcsTable $Mdcs
 *
 * @method \App\Model\Entity\Mdc[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MdcsController extends AppController
{
    public function initialize()
	{
		parent::initialize();
		$this->Auth->allow();
		//$this->loadComponent('Flash');
		//$this->loadComponent('RequestHandler');
		$this->loadModel('Mdvs');
	}
	/**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'limit' => 10,
			'groupby' => ['theme_id'],
			'contain' => ['Themes', 'Domains', 'Units'],
        ];
		$themes = $this->Mdcs->Themes->find('list');
		$domains = null;//$this->Mdcs->Domains->find('list');
		$mdcs = $this->Mdcs->find('all');
		$default['theme'] = $default['domain'] = 0;
		if ($this->request->is(['patch', 'post', 'put'])) {
			if(!empty($this->request->data['theme_id'])){
				$mdcs->where(['Mdcs.theme_id' => $this->request->data['theme_id']]);
				$domains = $this->Mdcs->Domains->find('list', ['conditions' => ['theme_id' => $this->request->data['theme_id']]]);
			}
			if(!empty($this->request->data['domain_id'])) $mdcs->where(['Mdcs.domain_id' => $this->request->data['domain_id']]);
			$default['theme'] = $this->request->data['theme_id'];
			$default['domain'] = $this->request->data['domain_id'];
		}
		$mdcs = $this->paginate($mdcs);

        $this->set(compact('mdcs', 'themes', 'domains', 'default'));
    }

    /**
     * View method
     *
     * @param string|null $id Mdc id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mdc = $this->Mdcs->get($id, [
            'contain' => ['Mdvs']
        ]);

        $this->set('mdc', $mdc);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mdc = $this->Mdcs->newEntity();
        if ($this->request->is('post')) {
            $mdc = $this->Mdcs->patchEntity($mdc, $this->request->getData());
			$mdc->created_by = $this->request->session()->read('Auth.User.id');
			echo $mdc;
            if ($this->Mdcs->save($mdc)) {
				$this->__setInspectors('Mdcs', 'add', $mdc->id);
                $this->Flash->success(__('Enregistrement effectué avec succès.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->erreur(__('Impossible d\'effectuer l\'enregistrement. Veuillez recommencer svp.'));
        }
		$units = $this->Mdcs->Units->find('list');
		$themes = $this->Mdcs->Themes->find('list');
		$domains = null;//$this->Mdcs->Domains->find('list');
        $this->set(compact('mdc', 'themes', 'domains', 'units'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Mdc id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mdc = $this->Mdcs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mdc = $this->Mdcs->patchEntity($mdc, $this->request->getData());
			$mdc->modified_by = $this->request->session()->read('Auth.User.id');
            if ($this->Mdcs->save($mdc)) {
				$this->__setInspectors('Mdcs', 'edit', $mdc->id);
                $this->Flash->success(__('Mise à jour effectuée avec succès.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->erreur(__('Impossible d\'effectuer la mise à jour. Veuillez recommencer svp.'));
        }
		$units = $this->Mdcs->Units->find('list');
		$themes = $this->Mdcs->Themes->find('list');
		$domains = $this->Mdcs->Domains->find('list');
        $this->set(compact('mdc', 'themes', 'domains', 'units'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Mdc id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mdc = $this->Mdcs->get($id);
		$this->__setInspectors('Mdcs', 'delete', $mdc->id);
        if ($this->Mdcs->delete($mdc)) {
            $this->Flash->success(__('L\élément a été supprimé avec succès.'));
        } else {
            $this->Flash->erreur(__('Impossible de supprimer l\élément. Veuillez recommencer svp.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
