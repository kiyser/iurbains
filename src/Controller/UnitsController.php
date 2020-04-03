<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Units Controller
 *
 * @property \App\Model\Table\UnitsTable $Units
 *
 * @method \App\Model\Entity\Unit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UnitsController extends AppController
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
        ];
		$units = $this->paginate($this->Units);

        $this->set(compact('units'));
    }

    /**
     * View method
     *
     * @param string|null $id Unit id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $unit = $this->Units->get($id, [
            'contain' => []
        ]);

        $this->set('unit', $unit);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $unit = $this->Units->newEntity();
        if ($this->request->is('post')) {
            $unit = $this->Units->patchEntity($unit, $this->request->getData());
            if ($this->Units->save($unit)) {
				$this->__setInspectors('Units', 'add', $unit->id);
				$this->Flash->success(__('Enregistrement effectué avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->erreur(__('Impossible d\'effectuer l\'enregistrement. Veuillez recommencer svp.'));
        }
        $this->set(compact('unit'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Unit id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $unit = $this->Units->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $unit = $this->Units->patchEntity($unit, $this->request->getData());
            if ($this->Units->save($unit)) {
				$this->__setInspectors('Units', 'edit', $unit->id);
                $this->Flash->success(__('Mise à jour effectuée avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->erreur(__('Impossible d\'effectuer la mise à jour. Veuillez recommencer svp.'));
        }
        $this->set(compact('unit'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Unit id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $unit = $this->Units->get($id);
        if ($this->Units->delete($unit)) {
             $this->Flash->success(__('L\élément a été supprimé avec succès.'));
        } else {
            $this->Flash->erreur(__('Impossible de supprimer l\élément. Veuillez recommencer svp.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
