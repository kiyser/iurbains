<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Departments Controller
 *
 * @property \App\Model\Table\DepartmentsTable $Departments
 *
 * @method \App\Model\Entity\Department[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DepartmentsController extends AppController
{
    public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['listesliees']);
		$this->loadComponent('Flash');
		$this->loadComponent('RequestHandler');
	}
	/**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Regions'],
			'limit' => 10,
			//'order' => ['id' => 'desc'],
			'groupby' => ['region_id'],
        ];
		//$this->__setInspectors('Departments', 'index', 1);
        $departments = $this->Departments->find();
		if ($this->request->is(['patch', 'post', 'put'])) {
			if(!empty($this->request->data['region_id'])) $departments->where(['Departments.region_id' => $this->request->data['region_id']]);
		}
		$regions = $this->Departments->Regions->find('list');
		$departments = $this->paginate($departments);
        $this->set(compact('departments', 'regions'));
    }

    /**
     * View method
     *
     * @param string|null $id Department id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $department = $this->Departments->get($id, [
            'contain' => ['Regions', 'Indicators', 'Mdvs', 'Structures', 'Towns']
        ]);

        $this->set('department', $department);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $department = $this->Departments->newEntity();
        if ($this->request->is('post')) {
            $department = $this->Departments->patchEntity($department, $this->request->getData());
			$department->created_by = $this->request->session()->read('Auth.User.id');
			
            if ($this->Departments->save($department)) {
                //Sauvegarde de l'action
				$this->__setInspectors('Departments', 'add', $department->id);
				$this->Flash->success(__('Enregistrement effectué avec succès.'));
                return $this->redirect(['action' => 'index']);
            }/**/
            $this->Flash->erreur(__('Impossible d\'effectuer l\'enregistrement. Veuillez recommencer svp.'));
        }
        $regions = $this->Departments->Regions->find('list', ['limit' => 200]);
        $this->set(compact('department', 'regions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Department id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $department = $this->Departments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $department = $this->Departments->patchEntity($department, $this->request->getData());
			$department->modified_by = $this->request->session()->read('Auth.User.id');
            if ($this->Departments->save($department)) {
                //Sauvegarde de l'action
				$this->__setInspectors('Departments', 'edit', $department->id);
                $this->Flash->success(__('Mise à jour effectuée avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->erreur(__('Impossible d\'effectuer la mise à jour. Veuillez recommencer svp.'));
        }
        $regions = $this->Departments->Regions->find('list', ['limit' => 200]);
        $this->set(compact('department', 'regions'));
    }
	/*
	//////////////////////////// FONCTION DE MISE A JOUR D'UN DEPARTEMENT
	public function edit(){
		if ($this->request->is('ajax')) {		
			$department = $this->Departments->get($_GET['idDept']);
        	$this->autoRender = false;
			$department->department_name_fr = $_GET['deptName'];
			$department->department_city = $_GET['deptCity'];
			$department->region_id = $_GET['regionId'];
			$department->modified_by = $this->request->session()->read('Auth.User.id');
			$reponse = 0;
			if ($this->Departments->save($department)) {
				$this->__setInspectors('Departments', 'Modification', $department->id);
				$reponse = 1;
            }
			echo $reponse;
        }
	}
	*/
    /**
     * Delete method
     *
     * @param string|null $id Department id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $department = $this->Departments->get($id);
        if ($this->Departments->delete($department)) {
            $this->Flash->success(__('L\élément a été supprimé avec succès.'));
        } else {
            $this->Flash->erreur(__('Impossible de supprimer l\élément. Veuillez recommencer svp.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	/****** FONCTION DE SELECTION DES DEPARTEMENTS ET COMMUNES ******/
	public function listesliees(){
		//$domains = $this->Domains->newEntity();
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
			if(isset($_GET['region']))
			{
				if($_GET['region'] == 0) $departments = null;
				else $departments = $this->Departments->find('all', ['conditions' => ['AND' => ['region_id' => $_GET['region']]]]);
				echo '<option value=""> -- Sélectionner le département -- </option>';
				foreach ($departments as $department):
					echo '<option value="'.$department->id.'">'.$department->department_name_fr.'</option>';
				endforeach;
			}
			if(isset($_GET['department']))
			{
				if($_GET['department'] == 0) $towns = null;
				else $towns = $this->Departments->Towns->find('all', ['conditions' => ['AND' => ['department_id' => $_GET['department']]]]);
				echo '<option value=""> -- Sélectionner la commune -- </option>';
				foreach ($towns as $town):
					echo '<option value="'.$town->id.'">'.$town->town_name_fr.'</option>';
				endforeach;
			}
        }
    }
}
