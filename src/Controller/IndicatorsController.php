<?php
namespace App\Controller;

use App\Controller\AppController;

class IndicatorsController extends AppController
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
		$this->loadModel('Versions');
	}
	//FONCTION INDEX
    public function index()
    {
        //if($this->request->session()->read('Auth.User.id') == null) $this->viewBuilder()->layout('default_home');
		$this->paginate = [
            'contain' => ['Domains', 'Themes'],
			'limit' => 10,
        ];
		$indicators = $this->Indicators->find('all');
		if($this->request->session()->read('Auth.User.id') == null || $this->__getUserInfos($this->request->session()->read('Auth.User.id'))->group->group_abrev != 'MA') $indicators = $indicators->where(['Indicators.id IN' => $this->__getAllIndicatorsWithValue($this->__getActiveVersion())]);
		$idTheme = $idDomain = null;
		$themes = $this->Indicators->Themes->find('list');
        $domains = null;
		$indicator = $this->Indicators->newEntity();
        if ($this->request->is('post')) {
            $indicator = $this->Indicators->patchEntity($indicator, $this->request->getData());
			if(isset($this->request->data['theme_id'])){
				$idTheme = $this->request->data['theme_id'];
				$domains = $this->Indicators->Domains->find('list', ['conditions' => ['AND' => ['Domains.theme_id' => $idTheme]]]);
				$indicators = $indicators->where(['Indicators.theme_id' => $idTheme]);
			}
			if($this->request->data['domain_id'] != null){
				$idDomain = $this->request->data['domain_id'];
				$indicators = $indicators->where(['Indicators.domain_id' => $idDomain]);
			}
		}
        $indicators = $this->paginate($indicators);
		$regionsList = $this->Regions->find('list');
        $departmentsList = null;
        $townsList = null;
		$default = [$idTheme, $idDomain];
        $this->set(compact('indicators', 'regionsList', 'departmentsList', 'townsList', 'themes', 'domains', 'default'));
    }
    // FONCTION DE VERIFICATION DE LA SAISIE D'UNE MICRODONNES DANS UNE LOCALITE
    public function __checkDataForMdInTown($data, $region, $department, $town, $version)
    {
		return $this->Mdvs->find('all', ['conditions' => ['AND' => ['version_id' => $version, 'mdvs_state' => 2, 'mdc_id' => $data, 'region_id' => $region, 'department_id' => $department, 'town_id' => $town]]])->first();
	}
	// FONCTION DE REALISATION DE L'OPERATION
    public function __makeOperation($donnee, $operand, $formule)
    {
		if($formule == 0) return $donnee;
		if($operand == '/' && $donnee != 0) return $formule/$donnee;
		if($operand == '*' && $donnee != 0) return $formule*$donnee;
		if($operand == '-' && $donnee != 0) return $formule-$donnee;
		if($operand == '+' && $donnee != 0) return $formule+$donnee;
		if($donnee == 0) return $formule;
	}
    // FONCTION DE CALCUL DE LA FORMULE D'UN INDICATEURS
    public function __computeIndicator($indicator, $version, $region, $department, $town)
    {
		$operand = null;
		$value = $formule = 0;
		$formuleCheck = 1;
		$tabElts = explode(":", $indicator->indicator_calcul);
		for($i=0;$i<=(sizeof($tabElts)-1);$i++){
			if(explode("|", $tabElts[$i])[0] == 'O') $operand = $this->Operands->find('all', ['conditions' => ['AND' => ['id' => explode("|", $tabElts[$i])[1]]]])->first()->operand_symbol;
			if(explode("|", $tabElts[$i])[0] == 'M'){
				$check = $this->__checkDataForMdInTown(explode("|", $tabElts[$i])[1], $region, $department, $town, $version);
				if($check == null) $formuleCheck = 0;
				else $value = $check->mdvs_value;
			}
			if(explode("|", $tabElts[$i])[0] == 'V'){
				$value = explode("|", $tabElts[$i])[1];
			}
			if($formuleCheck == 1){//echo $value.'<br>';
				$formule = $this->__makeOperation($value, $operand, $formule);
				$value = 0;
			}
			else $formule = "-";
		}
		//return round($formule);
		return $formule;
	}
	// FONCTION DE VISUALISATION D'UN INDICATEUR
    public function view($id = null, $regionId = null, $deptId = null, $townId = null/*, $themeId = null, $domainId = null*/)
    {//$p1=10824;$p2=225;echo $p1/$p2;
        if($this->request->session()->read('Auth.User.id') == null) $this->viewBuilder()->layout('default_sig');		
		$indicator = $this->Indicators->get($id, ['contain' => ['Themes', 'Domains']]);
		$version = 	$this->__getActiveVersion();
		($regionId == null) ? $regions = $this->Regions->find('all') : $regions = $this->Regions->find('all', ['conditions' => ['AND' => ['Regions.id' => $regionId]]]);		
		$i =  0;
		foreach ($regions as $region):
			$indicateur[$i][0][0]['Region'] = $region->region_name_fr;
			$departments = $this->Departments->find('all', ['conditions' => ['AND' => ['Departments.region_id' => $region->id]]]);
			if($deptId != null) $departments = $departments->where(['id' => $deptId]);
			$j = 0;
			foreach ($departments as $department):
				$indicateur[$i][$j][0]['Department'] = $department->department_name_fr;
				$towns = $this->Towns->find('all', ['conditions' => ['AND' => ['Towns.department_id' => $department->id]]]);
				if($townId != null) $towns = $Towns->where(['id' => $townId]);
				$k = 0;
				foreach ($towns as $town):					
					$indicateur[$i][$j][$k]['Town'] = $town->town_name_fr;
					$indicateur[$i][$j][$k]['value'] = $this->__computeIndicator($indicator, $version->id, $region->id, $department->id, $town->id);
					$k++;
				endforeach;
				$j++;
			endforeach;
			$i++;
		endforeach;		
        $indicators = $this->Indicators->find('all');
		$regionsList = $this->Regions->find('list');
        $departmentsList = null;
        $townsList = null;
        $themes = $this->Indicators->Themes->find('list');
        $domains = null;
        $this->set(compact('indicateur', 'indicators', 'regionsList', 'departmentsList', 'townsList', 'domains', 'themes'));
    }
	// FONCTION DE VERIFICATION DE LA SAISIE D'UNE MICRODONNES DANS UNE REGION
    public function checkDataForMd2($md, $town, $version)
    {
		return $this->Mdvs->find('all', ['conditions' => ['AND' => ['version_id' => $version, 'mdvs_state' => 2, 'mdc_id' => $md, 'town_id' => $town]]])->first();
	}
	// FONCTION DE VISUALISATION DES INDIVATEURS URBAINS
    public function visualisation($id = null/*, $regionId = null, $deptId = null, $townId = null, $themeId = null, $domainId = null*/)
    {
        if($this->request->session()->read('Auth.User.id') == null) $this->viewBuilder()->layout('default_home');
		
		$indicator = $this->Indicators->get($id, ['contain' => ['Themes', 'Domains']]);
		/*
		$operand = $data = '';
		$coeficient = $formule = 0;
		$formuleCheck = 1;
		$tabElts = explode(":", $indicator->indicator_calcul);
		for($i=0;$i<=(sizeof($tabElts)-1);$i++){
			if(explode("|", $tabElts[$i])[0] == 'O') $operand = $this->Operands->find('all', ['conditions' => ['AND' => ['id' => explode("|", $tabElts[$i])[1]]]])->first()->operand_symbol;
			if(explode("|", $tabElts[$i])[0] == 'M'){
				$data = explode("|", $tabElts[$i])[1];
				$saisie = $this->checkDataForMd($data, $idTown->id, $this->__getActiveVersion()->id);
				if($saisie != null) $formule = $this->makeOperation($saisie->mdvs_value, $operand, $formule);
				else{
					$formuleCheck = 0;
					$i = sizeof($tabElts);
				}
			}
			if(explode("|", $tabElts[$i])[0] == 'V'){
				$data = explode("|", $tabElts[$i])[1];
				$formule = $this->makeOperation($saisie->mdvs_value, $operand, $formule);
			}
		}
			if($formuleCheck == 1){
				$indicateur[0][0][0]['region'] = __('Région : ').$region->region_name_fr;
				$indicateur[][][]['dept'] = __('Département : ').$department->department_name_fr;
				$indicateur[][][]['town'] = __('Commune : ').$town->town_name_fr;
			}
		*/
		$indicators = $this->Indicators->find('all');
		$regionsList = $this->Regions->find('list');
        $departmentsList = null;
        $townsList = null;
        $themes = $this->Indicators->Themes->find('list');
        $domains = null;
        $this->set(compact('indicators', 'regionsList', 'departmentsList', 'townsList', 'domains', 'themes'));
    }
    public function add()
    {
        $this->paginate = [
            'limit' => 10,
        ];
		$indicator = $this->Indicators->newEntity();
        if ($this->request->is('post')) {
            $indicator = $this->Indicators->patchEntity($indicator, $this->request->getData());
			$indicator->created_by = $this->request->session()->read('Auth.User.id');
			/*echo $indicator;*/
            if ($this->Indicators->save($indicator)) {
                $this->__setInspectors('Indicators', 'add', $indicator->id);
				$this->Flash->success(__('Enregistrement effectué avec succès.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->erreur(__('Impossible d\'effectuer l\'enregistrement. Veuillez recommencer svp.'));
        }
		$operandss = $this->Operands->find('all');
		foreach ($operandss as $operand):
			$elts[0][$operand->id] = $operand->operand_symbol;
			$operands[$operand->id.'||'.$operand->operand_symbol] = $operand->operand_symbol;
		endforeach;/**/
		$mdcss = $this->Mdcs->find('all');
		foreach ($mdcss as $mdc):
			$elts[1][$mdc->id] = $mdc->mdcs_name_fr;
			$mdcs[$mdc->id.'||'.$mdc->mdcs_name_fr] = $mdc->mdcs_name_fr;
		endforeach;
        $domains = $this->Indicators->Domains->find('list');
        $themes = $this->Indicators->Themes->find('list');
        //$mdcs = $this->Mdcs->find('list');
		//$operands = $this->Operands->find('list');
        $this->set(compact('indicator', 'domains', 'themes', 'mdcs', 'operands', 'elts'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Indicator id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $indicator = $this->Indicators->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $indicator = $this->Indicators->patchEntity($indicator, $this->request->getData());
            if ($this->Indicators->save($indicator)) {
                $this->Flash->success(__('The indicator has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The indicator could not be saved. Please, try again.'));
        }
        $domains = $this->Indicators->Domains->find('list', ['limit' => 200]);
        $themes = $this->Indicators->Themes->find('list', ['limit' => 200]);
        $mdcs = $this->Indicators->Mdcs->find('list', ['limit' => 200]);
        $this->set(compact('indicator', 'domains', 'themes', 'mdcs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Indicator id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $indicator = $this->Indicators->get($id);
        if ($this->Indicators->delete($indicator)) {
            $this->Flash->success(__('The indicator has been deleted.'));
        } else {
            $this->Flash->error(__('The indicator could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	/****** FONCTION DE SELECTION DES MICRODONNEES D'UN DOMAINE ******/
	public function listesliees1(){
		if ($this->request->is('ajax')) {
            $this->autoRender = false;
			if(isset($_GET['theme']))
			{
				if($_GET['domain'] == 0) $mdc = null;
				else $mdcss = $this->Mdcs->find('all', ['conditions' => ['AND' => ['domain_id' => $_GET['domain']]]]);
				echo '<option value=""> -- Sélectionner la microdonnée -- </option>';
				foreach ($mdcss as $mdc):
					$mdcs[$mdc->id.'||'.$mdc->mdcs_name_fr] = $mdc->mdcs_name_fr;
				endforeach;
			}
        }
    }
	////////////////////////////
	////////////////////////////
	public function getIndicatorForMap(){
		if ($this->request->is('ajax')) {
            $this->autoRender = false;
			$indicateur = null;
			if(isset($_GET['indicator']) && $_GET['indicator'] != '') $indicator = $this->Indicators->get($_GET['indicator'], ['contain' => ['Themes', 'Domains']]);
			$regions = $this->Regions->find('all');
			if(isset($_GET['region']) && $_GET['region'] != '') $regions = $regions->where(['Regions.id' => $_GET['region']]);	
			$i =  0;
			foreach ($regions as $region):
				//$indicateur[$i][0][0]['Region'] = $region->region_name_fr;
				$departments = $this->Departments->find('all', ['conditions' => ['AND' => ['Departments.region_id' => $region->id]]]);
				if(isset($_GET['department']) && $_GET['department'] != '') $departments = $departments->where(['Departments.id' => $_GET['department']]);
				$j = 0;
				foreach ($departments as $department):
					//$indicateur[$i][$j][0]['Department'] = $department->department_name_fr;
					$towns = $this->Towns->find('all', ['conditions' => ['AND' => ['Towns.department_id' => $department->id]]]);
					if(isset($_GET['town']) && $_GET['town'] != '') $towns = $towns->where(['Towns.id' => $_GET['town']]);
					$k = 0;
					foreach ($towns as $town):	
						$indicateur[$i][$j][$k]['Region'] = $region->region_name_fr;
						$indicateur[$i][$j][$k]['Department'] = $department->department_name_fr;				
						$indicateur[$i][$j][$k]['Town'] = $town->town_name_fr;
						$indicateur[$i][$j][$k]['townId'] = $town->id;
						$indicateur[$i][$j][$k]['geom'] = $town->geom;
						$formule = $this->__computeIndicator($indicator, $_GET['version'], $region->id, $department->id, $town->id);
						$indicateur[$i][$j][$k]['Value'] = ($formule == "-") ? $formule : round($formule);
						$k++;
					endforeach;
					$j++;
				endforeach;
				$i++;
			endforeach;
			echo json_encode($indicateur);
		}
	}
	/****** FONCTION AJAX ******/
	public function listesliees(){
		if ($this->request->is('ajax')) {
            $this->autoRender = false;
			$indicators = $this->Indicators->find('all');
			
			if(isset($_GET['theme']))
			{
				$indicators = $indicators->where(['theme_id' => $_GET['theme']]);				
			}
			if(isset($_GET['domain']))
			{
				$indicators = $indicators->where(['domain_id' => $_GET['domain']]);	
			}/*
			if(isset($_GET['version']))
			{
				$indicators = $indicators->where(['Indicators.id IN' => $this->__getAllIndicatorsWithValue($_GET['version'])]);
			}
			else {
				if($this->__checkIfDataPublishedForVersion($this->__getActiveVersion()) == null) $indicators = null;
				else $indicators = $indicators->where(['Indicators.id IN' => $this->__getAllIndicatorsWithValue($this->__getActiveVersion())]);
			}
			*/
			foreach ($indicators as $indicator):
				echo '<tbody>';
					echo '<tr>';
						echo '<td style="width=2%"><input type="checkbox"></td>';
						echo '<td>';
							echo '<ul class="control-sidebar-menu">';
								echo '<li>';
									echo '<a href="#">';
										echo '<div class="menu-info">';
											echo '<h6 class="control-sidebar-subheading">'.$indicator->indicator_name_fr.'</h6>';
										echo '</div>';
									echo '</a>';
								echo '</li>';
							echo '</ul>';
						echo '</td>';
					echo '</tr>';
				echo '</tbody>';
			endforeach;
			if($indicators == null) echo '<tbody><tr><td>';echo __('<center style="font-size:10px;color:red"><i>Données non encore traitées</i></center>');echo '</td></tr></tbody>';
			
        }
    }
	/*$operand = $data = '';
		$coeficient = $formule = 0;
		$formuleCheck = 1;
		foreach ($indicators as $indicator):
			$tabElts = explode(":", $indicator->indicator_calcul);
			for($i=0;$i<=(sizeof($tabElts)-1);$i++){
				if(explode("|", $tabElts[$i])[0] == 'O') $operand = $this->Operands->find('all', ['conditions' => ['AND' => ['id' => explode("|", $tabElts[$i])[1]]]])->first()->operand_symbol;
				if(explode("|", $tabElts[$i])[0] == 'M'){
					$data = explode("|", $tabElts[$i])[1];
					$saisie = $this->checkDataForMd($data, $idTown->id, $version->id);
					if($saisie != null) $formule = $this->makeOperation($saisie->mdvs_value, $operand, $formule);
					else{
						$formuleCheck = 0;
						$i = sizeof($tabElts);
					}
				}
				if(explode("|", $tabElts[$i])[0] == 'V'){
					$data = explode("|", $tabElts[$i])[1];
					$formule = $this->makeOperation($saisie->mdvs_value, $operand, $formule);
				}
			}
			if($formuleCheck == 1){
				$indicateur[0][0][0]['region'] = __('Région : ').$region->region_name_fr;
				$indicateur[][][]['dept'] = __('Département : ').$department->department_name_fr;
				$indicateur[][][]['town'] = __('Commune : ').$town->town_name_fr;
			}
		endforeach;*/
}
