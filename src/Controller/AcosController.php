<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM;
use Acl\AclExtras;

/**
 * Acos Controller
 *
 * @property \App\Model\Table\AcosTable $Acos
 *
 * @method \App\Model\Entity\Aco[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AcosController extends AppController
{
    public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['buildAcl']);
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
            'limit' => 10,
            'contain' => ['ArosAcos'],
        ];
		//$acos = $this->Acos->find('all');
		$controllers = $this->Acos->find('all', ['conditions' => ['AND' => ['parent_id' => 2]]]);
		$actions = $this->Acos->find('all', ['conditions' => ['AND' => ['parent_id > 2']]]);
		$i = 0;
		foreach ($controllers as $controller):
			$j = 0;
			foreach ($actions as $action):
				if($action->parent_id == $controller->id){
					$acos[$i][$j]['controller'] = $controller->alias;
					$acos[$i][$j]['action'] = $action->alias;
					$j++;
				}
			endforeach;
			$i++;
		endforeach;
		$controllers = $this->Acos->find('list', ['conditions' => ['AND' => ['parent_id' => 1]]]);
        //$acos = $this->paginate($acos);
        $this->set(compact('acos', 'controllers'));
    }

    /**
     * View method
     *
     * @param string|null $id Aco id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $aco = $this->Acos->get($id, [
            'contain' => ['ParentAcos', 'Aros', 'ChildAcos']
        ]);

        $this->set('aco', $aco);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $aco = $this->Acos->newEntity();
        if ($this->request->is('post')) {
            $aco = $this->Acos->patchEntity($aco, $this->request->getData());
            if ($this->Acos->save($aco)) {
                $this->Flash->success(__('The aco has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The aco could not be saved. Please, try again.'));
        }
        $parentAcos = $this->Acos->ParentAcos->find('list', ['limit' => 200]);
        $aros = $this->Acos->Aros->find('list', ['limit' => 200]);
        $this->set(compact('aco', 'parentAcos', 'aros'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Aco id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function permission()
    {
		if ($this->request->is('ajax')) {
            $this->autoRender = false;
			if(isset($_GET['aro']) && isset($_GET['controller']) && isset($_GET['action']) && isset($_GET['acl']))
			{
			if($_GET['acl'] == 'allow') {	$this->Acl->allow($_GET['aro'], 'controllers/'.$_GET['controller']); echo 1;	}
				else{	 $this->Acl->deny($_GET['aro'], $_GET['controller'], '_read'); echo 0;	}
			}
        }
	}
	public function edit()
    {        
		$this->loadModel('Groups');
        $aco = $this->Groups->find('all', ['order' => ['group_abrev' =>'ASC']])->first()->id;
		//$this->Acl->deny(3, 'Acos');
		//$this->Acl->allow(3, 'Acos','_read');
		if ($this->request->is(['patch', 'post', 'put'])) {
			if(!empty($this->request->data['group_id'])) $aco = $this->Groups->find('all', ['conditions' => ['id' => $this->request->data['group_id']]])->first()->id;
		}
		//$firstAcos = $this->Acos->find('all', ['order' => ['id' =>'desc']])->first();
		$groups = $this->Groups->find('list', ['order' => ['group_abrev' =>'ASC']]);
		$this->loadModel('Aros');
        $aros = $this->Aros->find('all', ['conditions' => ['AND' => ['model' => 'Groups']]]);
		$controllers = $this->Acos->find('all', ['conditions' => ['AND' => ['parent_id' => 2]]]);
		$actions = $this->Acos->find('all', ['conditions' => ['AND' => ['parent_id > 2']]]);
		
		$i = 0;
		foreach ($controllers as $controller):
			$j = 0;
			foreach ($actions as $action):
				if($action->parent_id == $controller->id){
					$tables[$i][$j]['controller'] = $controller->alias;
					$tables[$i][$j]['action'] = $action->alias;
					$tables[$i][$j]['permission'] = $this->Acl->check($aco, $controller->alias, "*");
					$j++;
				}
			endforeach;
			$i++;
		endforeach;
		
		
		$models = $this->Acos->find('list', ['conditions' => ['AND' => ['parent_id' => 1]]]);
        $this->set(compact('groups', 'tables', 'models', 'aros'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Aco id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $aco = $this->Acos->get($id);
        if ($this->Acos->delete($aco)) {
            $this->Flash->success(__('The aco has been deleted.'));
        } else {
            $this->Flash->error(__('The aco could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	function buildAcl() {
        $log = array();
 
        $aco =& $this->Acl->Aco;
        $root = $aco->node('controllers');
        if (!$root) {
            $aco->create(array('parent_id' => null, 'model' => null, 'alias' => 'controllers'));
            $root = $aco->save();
            $root['Aco']['id'] = $aco->id; 
            $log[] = 'Created Aco node for controllers';
        } else {
            $root = $root[0];
        }   
 
        App::import('Core', 'File');
        $Controllers = Configure::listObjects('controller');
        $appIndex = array_search('App', $Controllers);
        if ($appIndex !== false ) {
            unset($Controllers[$appIndex]);
        }
        $baseMethods = get_class_methods('Controller');
        $baseMethods[] = 'buildAcl';
 
        // look at each controller in app/controllers
        foreach ($Controllers as $ctrlName) {
            App::import('Controller', $ctrlName);
            $ctrlclass = $ctrlName . 'Controller';
            $methods = get_class_methods($ctrlclass);
 
            // find / make controller node
            $controllerNode = $aco->node('controllers/'.$ctrlName);
            if (!$controllerNode) {
                $aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $ctrlName));
                $controllerNode = $aco->save();
                $controllerNode['Aco']['id'] = $aco->id;
                $log[] = 'Created Aco node for '.$ctrlName;
            } else {
                $controllerNode = $controllerNode[0];
            }
 
            //clean the methods. to remove those in Controller and private actions.
            foreach ($methods as $k => $method) {
                if (strpos($method, '_', 0) === 0) {
                    unset($methods[$k]);
                    continue;
                }
                if (in_array($method, $baseMethods)) {
                    unset($methods[$k]);
                    continue;
                }
                $methodNode = $aco->node('controllers/'.$ctrlName.'/'.$method);
                if (!$methodNode) {
                    $aco->create(array('parent_id' => $controllerNode['Aco']['id'], 'model' => null, 'alias' => $method));
                    $methodNode = $aco->save();
                    $log[] = 'Created Aco node for '. $method;
                }
            }
        }
        debug($log);
    }
}
