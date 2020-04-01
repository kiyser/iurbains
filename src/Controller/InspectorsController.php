<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Inspectors Controller
 *
 * @property \App\Model\Table\InspectorsTable $Inspectors
 *
 * @method \App\Model\Entity\Inspector[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InspectorsController extends AppController
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
            'limit' => 20,
        ];
		$inspectors = $this->Inspectors->find('all');
		$user = null;
		foreach ($inspectors as $inspector):			
			$user[$inspector->created_by] = $this->__getUserInfos($inspector->created_by)->lastname;
		endforeach;
        $inspectors = $this->paginate($inspectors);
        $this->set(compact('inspectors', 'user'));
    }

    /**
     * View method
     *
     * @param string|null $id Inspector id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $inspector = $this->Inspectors->get($id, [
            'contain' => ['Data']
        ]);

        $this->set('inspector', $inspector);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $inspector = $this->Inspectors->newEntity();
        if ($this->request->is('post')) {
            $inspector = $this->Inspectors->patchEntity($inspector, $this->request->getData());
            if ($this->Inspectors->save($inspector)) {
                $this->Flash->success(__('The inspector has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inspector could not be saved. Please, try again.'));
        }
        $this->set(compact('inspector'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Inspector id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $inspector = $this->Inspectors->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $inspector = $this->Inspectors->patchEntity($inspector, $this->request->getData());
            if ($this->Inspectors->save($inspector)) {
                $this->Flash->success(__('The inspector has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inspector could not be saved. Please, try again.'));
        }
        $data = $this->Inspectors->Data->find('list', ['limit' => 200]);
        $this->set(compact('inspector', 'data'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Inspector id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $inspector = $this->Inspectors->get($id);
        if ($this->Inspectors->delete($inspector)) {
            $this->Flash->success(__('The inspector has been deleted.'));
        } else {
            $this->Flash->error(__('The inspector could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
