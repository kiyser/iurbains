<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Regions Controller
 *
 * @property \App\Model\Table\RegionsTable $Regions
 *
 * @method \App\Model\Entity\Region[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'limit' => 10,
			'order' => ['region_name_fr' => 'asc'],
        ];
		$regions = $this->paginate($this->Regions);

        $this->set(compact('regions'));
    }

    /**
     * View method
     *
     * @param string|null $id Region id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $region = $this->Regions->get($id, [
            'contain' => ['Departments', 'Indicators', 'Mdvs', 'Structures']
        ]);

        $this->set('region', $region);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $region = $this->Regions->newEntity();
        if ($this->request->is('post')) {
            $region = $this->Regions->patchEntity($region, $this->request->getData());
			$region->created_by = $this->request->session()->read('Auth.User.id');
            if ($this->Regions->save($region)) {
				$this->__setInspectors('Regions', 'add', $region->id);
                $this->Flash->success(__('Enregistrement effectué avec succès.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->erreur(__('Impossible d\'effectuer l\'enregistrement. Veuillez recommencer svp.'));
        }
        $this->set(compact('region'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Region id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $region = $this->Regions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $region = $this->Regions->patchEntity($region, $this->request->getData());
			$region->modified_by = $this->request->session()->read('Auth.User.id');
            if ($this->Regions->save($region)) {
				$this->__setInspectors('Regions', 'edit', $region->id);
                $this->Flash->success(__('Mise à jour effectuée avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->erreur(__('Impossible d\'effectuer la mise à jour. Veuillez recommencer svp.'));
        }
        $this->set(compact('region'));
    }
	/*
	////////////////////////////
	////////////////////////////
	public function edit(){
		if ($this->request->is('ajax')) {		
			$region = $this->Regions->get($_GET['idRegion']);
        	$this->autoRender = false;
			$region->region_name_fr = $_GET['regionName'];
			$region->region_city = $_GET['regionCity'];
			$region->region_abrev = $_GET['regionAbrev'];
			$region->modified_by = $this->request->session()->read('Auth.User.id');
			$reponse = 0;
			if ($this->Regions->save($region)) {
				$this->__setInspectors('Regions', 'Modification', $region->id);
				$reponse = 1;
            }
			echo $reponse;
        }
	}
	*/
    /**
     * Delete method
     *
     * @param string|null $id Region id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $region = $this->Regions->get($id);
		$this->__setInspectors('Regions', 'delete', $region->id);
        if ($this->Regions->delete($region)) {
            $this->Flash->success(__('L\élément a été supprimé avec succès.'));
        } else {
            $this->Flash->erreur(__('Impossible de supprimer l\élément. Veuillez recommencer svp.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
