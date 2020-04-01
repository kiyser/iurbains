<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
	public $components = [
		'Acl' => [
			'className' => 'Acl.Acl'
		]
	];
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
		if(!empty($this->request->session()->read('Auth.User.id'))) $this->__getUserConnectedInfos($this->request->session()->read('Auth.User.id'));
		else $this->__getUserConnectedInfos(null);

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
		$this->loadComponent('Auth', [
			'authorize' => [
				'Acl.Actions' => ['actionPath' => 'controllers/']
			],
			'loginAction' => [
				'plugin' => false,
				'controller' => 'Users',
				'action' => 'login'
			],
			'loginRedirect' => [
				'plugin' => false,
				'controller' => 'Pages',
				'action' => 'display'
			],
			'logoutRedirect' => [
				'plugin' => false,
				'controller' => 'Pages',
				'action' => 'display'
			],
			'unauthorizedRedirect' => [
				'controller' => 'Users',
				'action' => 'login',
				'prefix' => false
			],
			'authError' => __('Vous ne disposez pas de droit d\'accès à cette page.'),
			'flash' => [
				'element' => 'error'
			]
		]);

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////// MES FONCTIONS ////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/* ENREGISTREMENT DANS INSPECTORS */
	public function __setInspectors($model, $action, $dataId) {		
		$this->loadModel('Inspectors');
		$inspector = $this->Inspectors->newEntity();
		$inspector->model_name = $model;
		$inspector->controller_action = $action;
		$inspector->id_data = $dataId;
		$inspector->created_by = ($this->request->session()->read('Auth.User.id')>0) ? $this->request->session()->read('Auth.User.id') : $dataId;
        if ($this->Inspectors->save($inspector)) return true;
		else return false;
	}
	/* RECHERCHE DES INFOS DE L'UTILISATEUR CONNECTE */
	public function __getUserConnectedInfos($id = null) {
		$this->loadModel('Users');
		$ui = null;
		if($id != null) $ui = $this->Users->get($id, ['contain' => ['Groups', 'Structures']]);
		$this->set(compact('ui'));
	}
	/* RECHERCHE DES INFOS D'UTILISATEUR QUELCONQUE */
	public function __getUserInfos($id = null) {
		$this->loadModel('Users');
		return $this->Users->get($id, ['contain' => ['Groups', 'Structures']]);
	}
	/* RECHERCHE DE LA STRUCTURE DE L'UTILISATEUR CONNECTE */
	public function __structUser() {
		$structureTable = TableRegistry::get('Structures');
		return $structureTable->get($this->request->session()->read('Auth.User.structure_id'), ['contain' => ['Regions', 'Departments', 'Towns']]);
	}
	/* RECHERCHE LES INFOS D'UNE STRUCTURE */
	public function __getStructureInfos($id) {
		$this->loadModel('Structures');
		return $this->Structures->get($id, ['contain' => ['Sts', 'Regions', 'Departments', 'Towns']]);
	}
	/* RECHERCHE DU TYPE DE STRUCTURE DE L'UTILISATEUR CONNECTE */
	public function __structType($structure) {
		$stsTable = TableRegistry::get('Sts');
		return $stsTable->get($structure->st_id);
	}
	/* RECHERCHE DE LA VERSION DE DONNEES ACTIVE */
	public function __getActiveVersion() {
		$this->loadModel('Versions');
		$version = $this->Versions->find('all', ['conditions' => ['AND' => ['version_state' => 1]]])->first();
		return ($version == null) ? $this->Versions->find('all')->first() : $version;
	}
	///////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////// GESTION DES INDICATEURS URBAINS /////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////
	// FONCTION DE VERIFICATION DES DONNEES PUBLIEES A UNE VERSION
    public function __checkIfDataPublishedForVersion($version)
    {
		$this->loadModel('Mdvs');
		$mdPublished = $this->Mdvs->find('all', ['conditions' => ['AND' => ['Mdvs.version_id' => $version, 'Mdvs.mdvs_state' => 2]]]);
		return $mdPublished;
	}
	// FONCTION DE RECUPERATION DE TOUTES LES DONNEES PUBLIEES A UNE VERSION
    public function __getAllDataPublishedForVersion($version)
    {
		$this->loadModel('Mdvs');
		$mdPublished = $this->Mdvs->find('all', ['conditions' => ['AND' => ['Mdvs.version_id' => $version, 'Mdvs.mdvs_state' => 2]]]);
		$tableMdPublished[] = null;
		$i = 0;
		foreach ($mdPublished as $published):
			$tableMdPublished[$i] = $published->mdc_id;
			$i++;
		endforeach;
		return $tableMdPublished;
	}
	// FONCTION DE RECUPERATION DE TOUS LES INDICATEURS AYANT DES DONNEES
    public function __getAllIndicatorsWithValue($version)
    {
		$this->loadModel('Indicators');
		$indicators = $this->Indicators->find('all');
		$tableMdPublished = $this->__getAllDataPublishedForVersion($version->id);
		$indicatorsWithValue[] = null;
		$j = 0;
		foreach ($indicators as $indicator):
			$status = 1;
			$tabElts = explode(":", $indicator->indicator_calcul);
			for($i=0;$i<=(sizeof($tabElts)-1);$i++){
				if(explode("|", $tabElts[$i])[0] == 'M'){
					if(!in_array(explode("|", $tabElts[$i])[1], $tableMdPublished)){
						$status = 0;
					}
				}
			}
			if($status == 1){
				$indicatorsWithValue[$j] = $indicator->id;
				$j++;
			}
			$i++;
		endforeach;
		return $indicatorsWithValue;
	}
}
