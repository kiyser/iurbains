<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Towns Controller
 *
 * @property \App\Model\Table\TownsTable $Towns
 *
 * @method \App\Model\Entity\Town[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TownsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Departments'],
			'limit' => 10,
			'groupby' => ['department_id'],
        ];
		$towns = $this->Towns->find();
		if ($this->request->is(['patch', 'post', 'put'])) {
			if(!empty($this->request->data['department_id'])) $towns->where(['Towns.department_id' => $this->request->data['department_id']]);
		}
		$departments = $this->Towns->Departments->find('list');
		$towns = $this->paginate($towns);

        $this->set(compact('towns', 'departments'));
    }

    /**
     * View method
     *
     * @param string|null $id Town id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $town = $this->Towns->get($id, [
            'contain' => ['Departments', 'Indicators', 'Mdvs', 'Structures']
        ]);

        $this->set('town', $town);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $town = $this->Towns->newEntity();
        if ($this->request->is('post')) {
            $town = $this->Towns->patchEntity($town, $this->request->getData());
			$town->created_by = $this->request->session()->read('Auth.User.id');
            if ($this->Towns->save($town)) {
				$this->__setInspectors('Towns', 'add', $town->id);
                $this->Flash->success(__('Enregistrement effectué avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->erreur(__('Impossible d\'effectuer l\'enregistrement. Veuillez recommencer svp.'));
        }
		 $departments = $this->Towns->Departments->find('list', ['limit' => 200]);
        $this->set(compact('town', 'departments'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Town id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $town = $this->Towns->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $town = $this->Towns->patchEntity($town, $this->request->getData());
			$town->modified_by = $this->request->session()->read('Auth.User.id');
            if ($this->Towns->save($town)) {
				$this->__setInspectors('Towns', 'edit', $town->id);
                $this->Flash->success(__('Mise à jour effectuée avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->erreur(__('Impossible d\'effectuer la mise à jour. Veuillez recommencer svp.'));
        }
        $departments = $this->Towns->Departments->find('list', ['limit' => 200]);
        $this->set(compact('town', 'departments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Town id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $town = $this->Towns->get($id);
		$this->__setInspectors('Towns', 'delete', $town->id);
        if ($this->Towns->delete($town)) {
            $this->Flash->success(__('L\élément a été supprimé avec succès.'));
        } else {
            $this->Flash->erreur(__('Impossible de supprimer l\élément. Veuillez recommencer svp.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
