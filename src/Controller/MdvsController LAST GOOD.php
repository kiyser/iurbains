<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Mdvs Controller
 *
 * @property \App\Model\Table\MdvsTable $Mdvs
 *
 * @method \App\Model\Entity\Mdv[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MdvsController extends AppController
{
    public function initialize()
	{
		parent::initialize();
		$this->Auth->allow();
		$this->loadComponent('Flash');
		$this->loadComponent('RequestHandler');
		//Je charge les modèles Regions, Departments, Towns, Themes, Domaines, Units
		$this->loadModel('Regions');
		$this->loadModel('Departments');
		$this->loadModel('Towns');
		$this->loadModel('Themes');
		$this->loadModel('Domains');
		$this->loadModel('Units');
		$this->loadModel('Mdcs');
	}
	
    /**
     * View method
     *
     * @param string|null $id Mdv id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mdv = $this->Mdvs->get($id, [
            'contain' => ['Regions', 'Departments', 'Towns', 'Mdcs', 'Mdvs']
        ]);

        $this->set('mdv', $mdv);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
	public function _checkDataPublished($mdvs)
	{	
		$publish = 0;
		foreach ($mdvs as $mdv):
			if($mdv->mdvs_state == 2){
				$publish = 1;
			}
		endforeach;
		return $publish;
		//return $mdvs->where(['Mdvs.mdvs_state' => 2])->count() == 0 ? false : true;
	}
	public function _checkDataValidate($mdvs)
	{	
		return $mdvs->where(['Mdvs.mdvs_state' => 1])->first() == null ? false : true;
	}
	public function _checkNewRecord($mdvs, $stTypeConnect)
	{	
		$newRecord = 1;
		$count = 0;
		foreach ($mdvs as $mdv):
			if($mdv->mdvs_state == 2){
				$newRecord = 0;
			}
			if($mdv->mdvs_state == 0 || $mdv->mdvs_state == 1){
				if($stTypeConnect == $this->__getStructureInfos($this->__getUserInfos($mdv->created_by)->structure->id)->st->sts_abrev){
					$newRecord = 0;
					$count--;
					if($count < 0) $count = 0;
				}
				else{
					$count++;
				}
			}
		endforeach;
		return ($newRecord > 0) ? $count : $newRecord;
	}
    public function _getMicroDada($region = null, $department = null, $town = null, $theme = null, $domaine = null, $stType = null, $version = null)
	{
		$this->paginate = [
            'limit' => 40,
			//'order' => ['id' => 'asc'],
        ];
		///// LOCALISATION DES MICRO DONNEES
		if($town != null)	$donnees[0][0]['struct'] = __('communales : (').$this->Towns->get($town)->town_name_fr.')';
		elseif($department != null)		$donnees[0][0]['struct'] = __('départementales : (').$this->Departments->get($department)->department_name_fr.')';
		elseif($region != null)		$donnees[0][0]['struct'] = __('régionales : (').$this->Regions->get($region)->region_name_fr.')';
		else	{	$donnees[0][0]['struct'] = __('nationales');}
		if($town == null)	$donnees[0][0]['btnSaisir'] = 0;	else	$donnees[0][0]['btnSaisir'] = 1;
		///// RECUPERATION DE TOUTES LES MICRO DONNEES CREES ET PUBLIEES PAR LE MANAGER
		$microdata = $this->Mdvs->Mdcs->find('all', ['conditions' => ['AND' => ['Mdcs.mdcs_state' => 1]]]);		
		///// FILTRAGE SUIVANT LE  ET LE DOMAINE, PUIS PAGINATION DES DONNEES
		$theme ? $microdata->where(['Mdcs.theme_id' => $theme]) : '';
		$domaine ? $microdata->where(['Mdcs.domain_id' => $domaine]) : '';
		$microdata = $this->paginate($microdata);
		
		if(!empty($this->request->session()->read('Auth.User.id')))	$userConnectedGroup = $this->__getUserInfos($this->request->session()->read('Auth.User.id'))->group->group_abrev;
		else $userConnectedGroup = null;
		$i = 1;
		foreach ($microdata as $data):
			$donnees[$i][0]['mdName'] = $data->mdcs_name_fr;
			$donnees[$i][0]['mdId'] = $data->id;
			$donnees[$i][0]['mdUnit'] = $data->unit_id;
			///// RECUPERATION DES VALEURS DE LA MICRO DONNEE COURANTE			
			$mdvs = $this->Mdvs->find('all', ['contain' => ['Regions', 'Departments', 'Towns'], 'conditions' => ['AND' => ['Mdvs.mdc_id' => $data->id]]]);
			///// FILTRAGE SUIVANT LA REGION, LE DEPARTEMENT, LA COMMUNE, LE STATUT
			$region ? $mdvs->where(['Mdvs.region_id' => $region]) : $mdvs->where(['Mdvs.region_id  IS NULL']);
			$department ? $mdvs->where(['Mdvs.department_id' => $department]) : $mdvs->where(['Mdvs.department_id  IS NULL']);
			$town ? $mdvs->where(['Mdvs.town_id' => $town]) : $mdvs->where(['Mdvs.town_id IS NULL']);
			$version ? $mdvs->where(['Mdvs.version_id' => $version]) : $mdvs->where(['Mdvs.version_id IS NULL']);
			
			//if($this->_checkDataValidate($mdvs)) $mdvs->where(['Mdvs.mdvs_state' => 1]);
			if($this->_checkDataPublished($mdvs) == 1 && $stType != 'CE') $mdvs->where(['Mdvs.mdvs_state' => 2]);
			
			$donnees[$i][0]['value'] = $donnees[$i][0]['source'] = $donnees[$i][0]['unite'] = $donnees[$i][0]['sourceName'] = $donnees[$i][0]['unitName'] = '';
			$donnees[$i][0]['state'] = 0;
			if($userConnectedGroup == 'AS' || $userConnectedGroup == 'AV' || $userConnectedGroup == 'AP' || $userConnectedGroup == 'MA')	$donnees[$i][0]['action'] = 'CREATE';
			else $donnees[$i][0]['action'] = 'VIEW';
			
			
			$donnees[$i][0]['newRecord'] = $this->_checkNewRecord($mdvs, $stType);
			$j = 0;
			foreach ($mdvs as $mdv):
				$stTypeSaisie = $this->__getStructureInfos($this->__getUserInfos($mdv->created_by)->structure->id)->st->sts_abrev;
				
				$take = false;
				if($stType == 'CO' && $stTypeSaisie == 'CO') $take = true;
				if($stType == 'DE' && ($stTypeSaisie == 'DE' || $stTypeSaisie == 'CO')) $take = true;
				if($stType == 'RE' && ($stTypeSaisie == 'RE' || $stTypeSaisie == 'DE' || $stTypeSaisie == 'CO')) $take = true;
				if($stType == 'CE' && ($stTypeSaisie == 'CE' || $stTypeSaisie == 'RE' || $stTypeSaisie == 'DE' || $stTypeSaisie == 'CO')) $take = true;
				
				if($mdv->mdvs_state == 2){
					$take = true;				
					if($stType == 'CE') $donnees[$i][$j]['action'] = 'EDIT';
					else	$donnees[$i][$j]['action'] = 'VIEW';				
				}
				
				if($take) $donnees[$i][$j]['idMdv'] = $mdv->id;
				if($take) $donnees[$i][$j]['value'] = $mdv->mdvs_value;
				if($take) $donnees[$i][$j]['source'] = $mdv->mdvs_source;
				if($take) $donnees[$i][$j]['sourceName'] = $this->__getStructureInfos($mdv->mdvs_source)->structure_name_fr;
				if($take) $donnees[$i][$j]['unite'] = $mdv->mdvs_unite;//$this->Units->get($mdv->mdvs_unite)->unit_abrev;
				if($take) $donnees[$i][$j]['unitName'] = $this->Units->get($mdv->mdvs_unite)->unit_abrev;
				if($take) $donnees[$i][$j]['state'] = $mdv->mdvs_state;
				if($take) $donnees[$i][$j]['stType'] = $stTypeSaisie; 
				if($take) $donnees[$i][$j]['group'] = $this->__getUserInfos($mdv->created_by)->group->group_abrev; 
				if($take) $donnees[$i][$j]['userPub'] = $mdv->publish_by; 
				
				if(($mdv->mdvs_state == 0 || $mdv->mdvs_state == 1) && $take){				
					if($userConnectedGroup == 'AS' || $userConnectedGroup == 'AV' || $userConnectedGroup == 'AP' || $userConnectedGroup == 'MA') $donnees[$i][$j]['action'] = 'EDIT';
					else	$donnees[$i][$j]['action'] = 'VIEW';				
				}
				if($take) $j++;
			endforeach;
			$i++;
		endforeach;
		return $donnees;
		//return $this->paginate($donnees);
	}
    
    public function index()
    {
        //if($this->request->session()->read('Auth.User.id') == null) $this->viewBuilder()->layout('default_public');
		$this->paginate = [
            'limit' => 10,
			//'order' => ['id' => 'asc'],
        ];
		////// INITIALISATION DES THEMES ET DOMAINES
		$idTheme = $idDomain = null;$mdState = 0;
		$themes = $this->Themes->find('list');
		$domains = $this->Domains->find('list');
		///// INITIALISATION DES VERSIONS REGIONS DEPARTEMENTS COMMUNES
		$idVersion = $this->Mdvs->Versions->find('all', ['conditions' => ['AND' => ['Versions.version_state' => 1]]])->first();
		if($idVersion == null) $idVersion = $this->Mdvs->Versions->find('all')->first()->id; else $idVersion = $idVersion->id;
		$idRegion = $idDepartment = $idTown = null;
		$regions = $departments = $towns = null;
		if($this->request->session()->read('Auth.User.structure_id') != null){
			$struct = $this->__getStructureInfos($this->request->session()->read('Auth.User.structure_id'));
			$stType = $struct->st->sts_abrev;
			if(isset($struct->region_id))	$idRegion = $struct->region_id;
			if(isset($struct->department_id))	$idDepartment = $struct->department_id;
			if(isset($struct->town_id))	$idTown = $struct->town_id;
		}else{
			$stType = null;		
		}
        if($stType == 'CE' || $stType == null){
			$regions = $this->Mdvs->Regions->find('list');
		}
        if($stType == 'RE'){
			$regions = $this->Mdvs->Regions->find('list', ['conditions' => ['AND' => ['Regions.id' => $idRegion]]]);
			$departments = $this->Mdvs->Departments->find('list', ['conditions' => ['AND' => ['Departments.region_id' => $idRegion]]]);
		}
        if($stType == 'DE'){
			$regions = $this->Mdvs->Regions->find('list', ['conditions' => ['AND' => ['Regions.id' => $idRegion]]]);
			$departments = $this->Mdvs->Departments->find('list', ['conditions' => ['AND' => ['Departments.id' => $idDepartment]]]);
			$towns = $this->Mdvs->Towns->find('list', ['conditions' => ['AND' => ['Towns.department_id' => $idDepartment]]]);
		}
        if($stType == 'CO'){
			$regions = $this->Mdvs->Regions->find('list', ['conditions' => ['AND' => ['Regions.id' => $idRegion]]]);
			$departments = $this->Mdvs->Departments->find('list', ['conditions' => ['AND' => ['Departments.id' => $idDepartment]]]);
			$towns = $this->Mdvs->Towns->find('list', ['conditions' => ['AND' => ['Towns.id' => $idTown]]]);
		}
		$mdv = $this->Mdvs->newEntity();
        if ($this->request->is('post')) {
            $mdv = $this->Mdvs->patchEntity($mdv, $this->request->getData());
			
			if(isset($this->request->data['region_id'])){
				$idRegion = $this->request->data['region_id'];
				$departments = $this->Mdvs->Departments->find('list', ['conditions' => ['AND' => ['Departments.region_id' => $idRegion]]]);
				$towns = null;
			}
			if(isset($this->request->data['department_id'])){
				$idDepartment = $this->request->data['department_id'];
				$towns = $this->Mdvs->Towns->find('list', ['conditions' => ['AND' => ['Towns.department_id' => $idDepartment]]]);
			}
			if(isset($this->request->data['town_id'])){
				$idTown = $this->request->data['town_id'];
			}
			if(isset($this->request->data['theme_id'])){
				$idTheme = $this->request->data['theme_id'];
				$domains = $domains->where(['Domains.theme_id' => $idTheme]);
			}
			if(isset($this->request->data['domain_id'])){
				$idDomain = $this->request->data['domain_id'];
			}
			if(isset($this->request->data['version_year'])){
				$idVersion = $this->request->data['version_year'];
			}			
        }
		$units = $this->Units->find('list');
		$default = [$idRegion, $idDepartment, $idTown, $idTheme, $idDomain, $idVersion];
		$microdata = $this->_getMicroDada($idRegion, $idDepartment, $idTown, $idTheme, $idDomain, $stType, $idVersion);
		$this->loadModel('Structures');
		$structures = $this->Structures->find('list', ['contain' => ['Sts']]);
        $mdcs = $this->Mdvs->Mdcs->find('list');
        $versions = $this->Mdvs->Versions->find('list');
        $this->set(compact('versions', 'structures', 'regions', 'departments', 'towns', 'themes', 'domains', 'units', 'mdcs', 'microdata', 'stType', 'default'));
    }
	/***** FUNCTION D'EDITION D'UNE MICRODONNEE *****/
	public function edition()
    {
        $mdv = $this->Mdvs->newEntity();
        if ($this->request->is('ajax')) {
			$this->autoRender = false;
			$mdv->created_by = $this->request->session()->read('Auth.User.id');
			$mdv->region_id = $_GET['region'] ? $_GET['region'] : null;
			$mdv->department_id = $_GET['department'] ? $_GET['department'] : null;
			$mdv->town_id = $_GET['town'] ? $_GET['town'] : null;
			$mdv->mdc_id = $_GET['idMd'];
			$mdv->version_id = $_GET['year'];
			$mdv->mdv_id = $_GET['idMdv'] ? $_GET['idMdv'] : null;
			$mdv->mdvs_value = $_GET['valMd'];
			$mdv->mdvs_source = $_GET['srcMd'];
			$mdv->mdvs_unite = $_GET['uniMd'];
			$userConnectedGroup = $this->__getUserInfos($this->request->session()->read('Auth.User.id'))->group->group_abrev;
			if($userConnectedGroup == 'AV' || $userConnectedGroup == 'MA'){
				$mdv->mdvs_state = 1;
				$mdv->validate_by = $this->request->session()->read('Auth.User.id');
				$mdv->validate_date = date("Y-m-d H:i:s");
				if($this->__getStructureInfos($this->__getUserInfos($this->request->session()->read('Auth.User.id'))->structure->id)->st->sts_abrev == 'CE'){
					$mdv->mdvs_state = 2;
					$mdv->publish_by = $this->request->session()->read('Auth.User.id');
					$mdv->publish_date = date("Y-m-d H:i:s");
				}
			}
			/*echo $mdv;*/
            if ($this->Mdvs->save($mdv)) {
				$this->__setInspectors('Mdvs', 'Edition', $mdv->id);
                echo $mdv->id;
				//echo __('Micro donnée éditée avec succès');
            }
        }
    }
	public function edit()
    {
        if ($this->request->is('ajax')) {		
			$mdv = $this->Mdvs->get($_GET['idMdv']);
        	$this->autoRender = false;
			$userConnectedGroup = $this->__getUserInfos($this->request->session()->read('Auth.User.id'))->group->group_abrev;
			$mdv->mdvs_value = $_GET['valMd'];
			$mdv->mdvs_source = $_GET['srcMd'];
			$mdv->mdvs_unite = $_GET['uniMd'];
			
			/*echo $mdv;*/
			if ($this->Mdvs->save($mdv)) {
				$this->__setInspectors('Mdvs', 'Modification', $mdv->id);
				//echo $mdv->id;
				echo __('Micro donnée Modifiée avec succès');
            }
        }
    }
	/***** FUNCTION DE VALIDATION D'UNE MICRODONNEE *****/
	public function validation($id = null)
    {
        $mdv = $this->Mdvs->get($id);
        if ($this->request->is('ajax')) {
			$this->autoRender = false;
            if($mdv->mdvs_state == 0) $mdv->mdvs_state = 1;
            else $mdv->mdvs_state = 0;
			$mdv->validate_by = $this->request->session()->read('Auth.User.id');
			$mdv->validate_date = date("Y-m-d H:i:s");
			/*echo $mdv->mdvs_state;*/
            if ($this->Mdvs->save($mdv)) {
				$this->__setInspectors('Mdvs', 'Validation', $mdv->id);
                echo $mdv->mdvs_state;
            }
        }
    }
	/***** FUNCTION DE PUBLICATION D'UNE MICRODONNEE *****/
	public function publication($id = null)
    {
        $mdv = $this->Mdvs->get($id);
        if ($this->request->is('ajax')) {
			$this->autoRender = false;
            if($mdv->mdvs_state == 1) $mdv->mdvs_state = 2;
            else $mdv->mdvs_state = 1;
			/*echo $mdv;*/
            if ($this->Mdvs->save($mdv)) {
                echo $mdv->id;
            }
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Mdv id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mdv = $this->Mdvs->get($id);
        if ($this->Mdvs->delete($mdv)) {
            $this->Flash->success(__('L\élément a été supprimé avec succès.'));
        } else {
            $this->Flash->erreur(__('Impossible de supprimer l\élément. Veuillez recommencer svp.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	////////////////////////////
	////////////////////////////
	public function getDataForMap(){
		if ($this->request->is('ajax')) {
            $this->autoRender = false;
			$data = $this->Mdvs->find('all', ['conditions' => ['AND' => ['mdvs_state' => 2]]]);
			
			if(isset($_GET['region']) && $_GET['region'] != '')	$data = $data->where(['region_id' => $_GET['region']]);
			if(isset($_GET['department']) && $_GET['department'] != '')	$data = $data->where(['department_id' => $_GET['department']]);
			if(isset($_GET['town']) && $_GET['town'] != '')	$data = $data->where(['town_id' => $_GET['town']]);
			if(isset($_GET['microdata']) && $_GET['microdata'] != '')	$data = $data->where(['mdc_id' => $_GET['microdata']]);
			if(isset($_GET['version']) && $_GET['version'] != '')	$data = $data->where(['version_id' => $_GET['version']]);
			$value = "";
			foreach ($data as $elt):
				$region = $this->Regions->get($elt->region_id)->region_name_fr;
				$department = $this->Departments->get($elt->department_id)->department_name_fr;
				$town = $this->Towns->get($elt->town_id)->town_name_fr;
				if($value != "") $value = $value."|";
				//$value = $value."R=".$elt->region->region_name_fr."D=".$elt->department->department_name_fr."T=".$elt->town->town_name_fr."V=".$elt->mdvs_value;
				$value = $value."R=".$region.";D=".$department.";T=".$elt->town_id.";V=".$elt->mdvs_value;
			endforeach;
			echo $value;
		}
	}
	// RECHERCHE DES DONNEES POUR UNE REGION UN DEPARTEMENT UNE COMMUNE
	public function getDataForLocalies($microdata, $mdcId){
		$value = "";
		foreach ($microdata as $data):
			if($data->mdc_id == $mdcId){
				if($value != null) $value = $value.$data->mdvs_value."_";
				$value = $value.$data->mdvs_value."_";
			}
		endforeach;
		return $value;
	}
	/****** FONCTION AJAX ******/
	public function listesliees(){
		if ($this->request->is('ajax')) {
            $this->autoRender = false;
			$microdata = $this->Mdvs->find('all', ['contain' => ['Mdcs']], ['conditions' => ['AND' => ['Mdvs.mdvs_state' => 2]]])->distinct('Mdvs.mdc_id');
			
			if(isset($_GET['version']) && $_GET['version'] != '') $microdata = $microdata->where(['Mdvs.version_id' => $_GET['version']]);
			
			if(isset($_GET['theme']) && $_GET['theme'] != '') $microdata = $microdata->where(['Mdcs.theme_id' => $_GET['theme']]);
			
			if(isset($_GET['domain']) && $_GET['domain'] != '') $microdata = $microdata->where(['Mdcs.domain_id' => $_GET['domain']]);
			
			if(isset($_GET['region']) && $_GET['region'] != ''){
				$microdata = $microdata->where(['Mdvs.region_id' => $_GET['region']]);
			}			
			if(isset($_GET['department']) && $_GET['department'] != ''){
				$microdata = $microdata->where(['Mdvs.department_id' => $_GET['department']]);
			}			
			if(isset($_GET['town']) && $_GET['town'] != ''){
				$microdata = $microdata->where(['Mdvs.town_id' => $_GET['town']]);
			}
			
			foreach ($microdata as $data):
				//$mdValue = $this->getDataForLocalies($microdata, $data->mdc_id);
				echo '<tr>';
					echo '<td>';
						echo '<ul class="control-sidebar-menu">';
							echo '<li>';
								echo '<a href="#" onclick="checkRadio('.$data->id.', 1);setMarkerForMicrodata('.$data->mdc_id.')">';
									echo '<div class="" style="float:left;width:5%;"><input name="radioData" type="radio" value="'.$data->id.'" id="radioData'.$data->id.'"></div>';
									echo '<div class="" style="float:left;width:95%;padding-left:5px;padding-top:3px">';
										echo '<div class="menu-info">';
											echo '<input class="hide" type="text" value="'.$data->mdc->mdcs_name_fr.'" id="mdName'.$data->mdc_id.'">';
											echo '<h6 class="control-sidebar-subheading">'.$data->mdc->mdcs_name_fr.'</h6>';
										echo '</div>';
									echo '</div>';
								echo '</a>';													
							echo '</li>';
						echo '</ul>';
					echo '</td>';
				echo '</tr>';		
			endforeach;
			if($microdata == null) echo '<tr><td>';echo __('<center style="font-size:10px;color:red"><i>Données non encore traitées</i></center>');echo '</td></tr>';
        }
    }
}
