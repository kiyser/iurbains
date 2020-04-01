<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MdcsIndicators Controller
 *
 * @property \App\Model\Table\MdcsIndicatorsTable $MdcsIndicators
 *
 * @method \App\Model\Entity\MdcsIndicator[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MdcsIndicatorsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Indicators', 'Mdcs']
        ];
        $mdcsIndicators = $this->paginate($this->MdcsIndicators);

        $this->set(compact('mdcsIndicators'));
    }

    /**
     * View method
     *
     * @param string|null $id Mdcs Indicator id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mdcsIndicator = $this->MdcsIndicators->get($id, [
            'contain' => ['Indicators', 'Mdcs']
        ]);

        $this->set('mdcsIndicator', $mdcsIndicator);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mdcsIndicator = $this->MdcsIndicators->newEntity();
        if ($this->request->is('post')) {
            $mdcsIndicator = $this->MdcsIndicators->patchEntity($mdcsIndicator, $this->request->getData());
            if ($this->MdcsIndicators->save($mdcsIndicator)) {
                $this->Flash->success(__('The mdcs indicator has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mdcs indicator could not be saved. Please, try again.'));
        }
        $indicators = $this->MdcsIndicators->Indicators->find('list', ['limit' => 200]);
        $mdcs = $this->MdcsIndicators->Mdcs->find('list', ['limit' => 200]);
        $this->set(compact('mdcsIndicator', 'indicators', 'mdcs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Mdcs Indicator id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mdcsIndicator = $this->MdcsIndicators->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mdcsIndicator = $this->MdcsIndicators->patchEntity($mdcsIndicator, $this->request->getData());
            if ($this->MdcsIndicators->save($mdcsIndicator)) {
                $this->Flash->success(__('The mdcs indicator has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mdcs indicator could not be saved. Please, try again.'));
        }
        $indicators = $this->MdcsIndicators->Indicators->find('list', ['limit' => 200]);
        $mdcs = $this->MdcsIndicators->Mdcs->find('list', ['limit' => 200]);
        $this->set(compact('mdcsIndicator', 'indicators', 'mdcs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Mdcs Indicator id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mdcsIndicator = $this->MdcsIndicators->get($id);
        if ($this->MdcsIndicators->delete($mdcsIndicator)) {
            $this->Flash->success(__('The mdcs indicator has been deleted.'));
        } else {
            $this->Flash->error(__('The mdcs indicator could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
