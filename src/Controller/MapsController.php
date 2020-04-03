<?php
namespace App\Controller;

use App\Controller\AppController;

class MapsController extends AppController
{
    public function initialize()
	{
		parent::initialize();
		$this->Auth->allow();
		$this->loadModel('Mdcs');
		$this->loadModel('Mdvs');
		$this->loadModel('Operands');
		$this->loadModel('Regions');
		$this->loadModel('Departments');
		$this->loadModel('Towns');
		$this->loadModel('Indicators');
		$this->loadModel('Versions');
	}
    public function index()
    {
        $this->viewBuilder()->layout('default_map');
		$this->paginate = ['limit' => 10];
		
		$version = $this->__getActiveVersion();
		
		$indicators = $this->Indicators->find('all');
		$microdata = $this->Mdcs->find('all', ['contain' => ['Mdvs']], ['conditions' => ['AND' => ['Mdvs.mdvs_state' => 2, 'Mdvs.version_id' => $version]]]);
		$indicators = $indicators->where(['Indicators.id IN' => $this->__getAllIndicatorsWithValue($version)]);
		
		$versionList = $this->Versions->find('list')->order(['Versions.version_state' => 'DESC']);
		$themes = $this->Indicators->Themes->find('list');
		$regionsList = $this->Regions->find('list')->order(['region_name_fr' => 'ASC']);
        $departmentsList = $townsList = $domains = null;
		
        $indicators = $this->paginate($indicators);
        $microdata = $this->paginate($microdata);
		
        $this->set(compact('indicators', 'microdata', 'regionsList', 'departmentsList', 'townsList', 'themes', 'domains', 'versionList'));
    }
}
