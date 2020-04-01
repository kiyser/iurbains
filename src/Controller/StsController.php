<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Sts Controller
 *
 * @property \App\Model\Table\StsTable $Sts
 *
 * @method \App\Model\Entity\St[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StsController extends AppController
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
			'order' => ['id' => 'desc'],
        ];
		$sts = $this->paginate($this->Sts);

        $this->set(compact('sts'));
    }

    /**
     * View method
     *
     * @param string|null $id St id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $st = $this->Sts->get($id, [
            'contain' => ['Structures']
        ]);

        $this->set('st', $st);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $st = $this->Sts->newEntity();
        if ($this->request->is('post')) {
            $st = $this->Sts->patchEntity($st, $this->request->getData());
			$st->created_by = $this->request->session()->read('Auth.User.id');
            if ($this->Sts->save($st)) {
				$this->__setInspectors('Sts', 'add', $st->id);
                $this->Flash->success(__('Enregistrement effectué avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->erreur(__('Impossible d\'effectuer l\'enregistrement. Veuillez recommencer svp.'));
        }
        $this->set(compact('st'));
    }

    /**
     * Edit method
     *
     * @param string|null $id St id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $st = $this->Sts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $st = $this->Sts->patchEntity($st, $this->request->getData());
			$st->modified_by = $this->request->session()->read('Auth.User.id');
            if ($this->Sts->save($st)) {
				$this->__setInspectors('Sts', 'edit', $st->id);
                $this->Flash->success(__('Mise à jour effectuée avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->erreur(__('Impossible d\'effectuer la mise à jour. Veuillez recommencer svp.'));
        }
        $this->set(compact('st'));
    }

    /**
     * Delete method
     *
     * @param string|null $id St id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $st = $this->Sts->get($id);
		$this->__setInspectors('Sts', 'delete', $st->id);
        if ($this->Sts->delete($st)) {
            $this->Flash->success(__('L\élément a été supprimé avec succès.'));
        } else {
            $this->Flash->erreur(__('Impossible de supprimer l\élément. Veuillez recommencer svp.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
