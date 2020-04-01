<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Structures Controller
 *
 * @property \App\Model\Table\StructuresTable $Structures
 *
 * @method \App\Model\Entity\Structure[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StructuresController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Sts', 'Regions', 'Departments', 'Towns'],
			'limit' => 10,
			'groupby' => ['st_id'],
        ];
		$structures = $this->Structures->find();
		if ($this->request->is(['patch', 'post', 'put'])) {
			if(!empty($this->request->data['st_id'])) $structures->where(['Structures.st_id' => $this->request->data['st_id']]);
		}
		$structures = $this->paginate($structures);
		$sts = $this->Structures->Sts->find('list');

        $this->set(compact('structures', 'sts'));
    }

    /**
     * View method
     *
     * @param string|null $id Structure id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $structure = $this->Structures->get($id, [
            'contain' => ['Sts', 'Regions', 'Departments', 'Towns', 'Users']
        ]);

        $this->set('structure', $structure);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $structure = $this->Structures->newEntity();
        if ($this->request->is('post')) {
            $structure = $this->Structures->patchEntity($structure, $this->request->getData());
			$structure->created_by = $this->request->session()->read('Auth.User.id');
            if ($this->Structures->save($structure)) {
				$this->__setInspectors('Structures', 'add', $structure->id);
                $this->Flash->success(__('Enregistrement effectué avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->erreur(__('Impossible d\'effectuer l\'enregistrement. Veuillez recommencer svp.'));
        }
        $sts = $this->Structures->Sts->find('list', ['limit' => 200]);
        $regions = $this->Structures->Regions->find('list', ['limit' => 200]);
        $departments = $this->Structures->Departments->find('list', ['limit' => 200]);
        $towns = $this->Structures->Towns->find('list', ['limit' => 200]);
        $this->set(compact('structure', 'sts', 'regions', 'departments', 'towns'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Structure id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $structure = $this->Structures->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $structure = $this->Structures->patchEntity($structure, $this->request->getData());
			$structure->modified_by = $this->request->session()->read('Auth.User.id');
            if ($this->Structures->save($structure)) {
				$this->__setInspectors('Structures', 'edit', $structure->id);
                $this->Flash->success(__('Mise à jour effectuée avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->erreur(__('Impossible d\'effectuer la mise à jour. Veuillez recommencer svp.'));
        }
        $sts = $this->Structures->Sts->find('list', ['limit' => 200]);
        $regions = $this->Structures->Regions->find('list', ['limit' => 200]);
        $departments = $this->Structures->Departments->find('list', ['limit' => 200]);
        $towns = $this->Structures->Towns->find('list', ['limit' => 200]);
        $this->set(compact('structure', 'sts', 'regions', 'departments', 'towns'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Structure id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $structure = $this->Structures->get($id);
		$this->__setInspectors('Structures', 'delete', $structure->id);
        if ($this->Structures->delete($structure)) {
            $this->Flash->success(__('L\élément a été supprimé avec succès.'));
        } else {
            $this->Flash->erreur(__('Impossible de supprimer l\élément. Veuillez recommencer svp.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
