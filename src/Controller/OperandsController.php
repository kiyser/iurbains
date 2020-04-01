<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Operands Controller
 *
 * @property \App\Model\Table\OperandsTable $Operands
 *
 * @method \App\Model\Entity\Operand[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OperandsController extends AppController
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
		$operands = $this->paginate($this->Operands);

        $this->set(compact('operands'));
    }

    /**
     * View method
     *
     * @param string|null $id Operand id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $operand = $this->Operands->get($id, [
            'contain' => []
        ]);

        $this->set('operand', $operand);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $operand = $this->Operands->newEntity();
        if ($this->request->is('post')) {
            $operand = $this->Operands->patchEntity($operand, $this->request->getData());
			$operand->created_by = $this->request->session()->read('Auth.User.id');
            if ($this->Operands->save($operand)) {
                $this->__setInspectors('Operands', 'add', $operand->id);
				$this->Flash->success(__('Enregistrement effectué avec succès.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->erreur(__('Impossible d\'effectuer l\'enregistrement. Veuillez recommencer svp.'));
        }
        $this->set(compact('operand'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Operand id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $operand = $this->Operands->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $operand = $this->Operands->patchEntity($operand, $this->request->getData());
			$operand->modified_by = $this->request->session()->read('Auth.User.id');
            if ($this->Operands->save($operand)) {
                //Sauvegarde de l'action
				$this->__setInspectors('Operands', 'edit', $operand->id);
                $this->Flash->success(__('Mise à jour effectuée avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->erreur(__('Impossible d\'effectuer la mise à jour. Veuillez recommencer svp.'));
        }
        $this->set(compact('operand'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Operand id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $operand = $this->Operands->get($id);
        if ($this->Operands->delete($operand)) {
             $this->Flash->success(__('L\élément a été supprimé avec succès.'));
        } else {
            $this->Flash->erreur(__('Impossible de supprimer l\élément. Veuillez recommencer svp.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
