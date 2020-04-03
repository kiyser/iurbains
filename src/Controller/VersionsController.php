<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Versions Controller
 *
 * @property \App\Model\Table\VersionsTable $Versions
 *
 * @method \App\Model\Entity\Version[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VersionsController extends AppController
{
    public function initialize()
	{
		parent::initialize();
		$this->Auth->allow();
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
			'order' => ['id' => 'asc'],
        ];
		$versions = $this->paginate($this->Versions);

        $this->set(compact('versions'));
    }

    /**
     * View method
     *
     * @param string|null $id Version id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $version = $this->Versions->get($id, [
            'contain' => ['Mdvs']
        ]);

        $this->set('version', $version);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $version = $this->Versions->newEntity();
        if ($this->request->is('post')) {
            $version = $this->Versions->patchEntity($version, $this->request->getData());
			$version->created_by = $this->request->session()->read('Auth.User.id');
            if ($this->Versions->save($version)) {
                //Sauvegarde de l'action
				$this->__setInspectors('Versions', 'add', $version->id);
				$this->Flash->success(__('Enregistrement effectué avec succès.'));
                return $this->redirect(['action' => 'index']);
            }/**/
            $this->Flash->erreur(__('Impossible d\'effectuer l\'enregistrement. Veuillez recommencer svp.'));
        }
        $this->set(compact('version'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Version id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $version = $this->Versions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $version = $this->Versions->patchEntity($version, $this->request->getData());
			$version->modified_by = $this->request->session()->read('Auth.User.id');			
			
			$result = $this->Users->connection()->transactional(function() use ($version){							
				if ($this->Versions->save($version)) {
					if($version->version_state == 1){
						$active = $this->Versions->find('all', ['conditions' => ['AND' => ['version_state' => 1]]])->first();	
						if($active != null && $version->id != $active->id){
							$active->version_state = 0;
							if ($this->Versions->save($active)) {
								return true;
							}
							else return false;
						}
					}
					return true;
				}
				else return false;
			});
			if($result){
				$this->__setInspectors('Versions', 'edit', $version->id);
                $this->Flash->success(__('Mise à jour effectuée avec succès.'));
                return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->erreur(__('Impossible d\'effectuer la mise à jour. Veuillez recommencer svp.'));
			}
        }
        $this->set(compact('version'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Version id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $version = $this->Versions->get($id);
        if ($this->Versions->delete($version)) {
             $this->Flash->success(__('L\élément a été supprimé avec succès.'));
        } else {
            $this->Flash->erreur(__('Impossible de supprimer l\élément. Veuillez recommencer svp.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
