<?php echo $this->Form->create(null, array('method'=>'post', 'role'=>'form', 'id'=>'formSearch', 'class'=>'', 'url'=>['controller' => 'Mdvs', 'action' => 'index'])); ?>
<?php echo $this->Form->hidden('url', ['label' => false,'id'=>'url', 'value'=>$this->Url->build(['controller' => 'Departments', 'action' => 'listesliees']), 'hidden' => true]); ?>
<?php echo $this->Form->hidden('url2', ['label' => false,'id'=>'url2', 'value'=>$this->Url->build(['controller' => 'Domains', 'action' => 'listesliees']), 'hidden' => true]); ?>
<?php echo $this->Form->hidden('urlIu', ['label' => false,'id'=>'urlIu', 'value'=>$this->Url->build(['controller' => 'Indicators', 'action' => 'listesliees']), 'hidden' => true]); ?>
<?php echo $this->Form->hidden('urlMd', ['label' => false,'id'=>'urlMd', 'value'=>$this->Url->build(['controller' => 'Mdvs', 'action' => 'listesliees']), 'hidden' => true]); ?>
<?php echo $this->Form->hidden('urlValMd', ['label' => false,'id'=>'urlValMd', 'value'=>$this->Url->build(['controller' => 'Mdvs', 'action' => 'getDataForMap']), 'hidden' => true]); ?>
<?php echo $this->Form->hidden('urlValInd', ['label' => false,'id'=>'urlValInd', 'value'=>$this->Url->build(['controller' => 'Indicators', 'action' => 'getIndicatorForMap']), 'hidden' => true]); ?>

		<ul class="sidebar-menu tree" data-widget="tree">
			<li class="header"><i class="fa fa-search"></i><?= __(' FILTREZ LES DONNEES') ?></li>
			<li class="treeview active menu-open">
				<a href="#">
					<i class="fa fa-map"></i>
					<span style="font-size:10px;font-weight:600"><?= __('COUCHES ADMINISTRATIVES') ?></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
				</a>
				<ul class="treeview-menu">
					<div class="box-body">
						<div class="form-group" style="font-size:13px">
							<i><?= $this->Form->input('allRegion',['type'=>'checkbox', 'onclick'=>'selectAllRegion()', 'id'=>'allRegion', 'options'=>[['value'=>'1']], 'label'=>__(' Afficher toutes les régions ')])	?></i>
							<i><?= $this->Form->input('allDepartment',['type'=>'checkbox', 'onclick'=>'selectAllDepartment()', 'id'=>'allDepartment', 'options'=>[['value'=>'1']], 'label'=>__(' Afficher tous les départements ')])	?></i>
							<i><?= $this->Form->input('allTown',['type'=>'checkbox', 'onclick'=>'selectAllTown()', 'id'=>'allTown', 'options'=>[['value'=>'1']], 'label'=>__(' Afficher toutes les communes ')])	?></i>
						</div>
						<div class="form-group">
							<div class="col-xs-4" style="padding:1px">
								<i><?= $this->Form->control('region_id', ['label' => false, 'id'=>'region', 'onchange'=>'selectDepartment();selectMicrodata();selectRegionLayer();', 'style'=>'width: 100%;', 'class' => 'form-control input-sm', 'options' => $regionsList, 'empty' => '--Région--']) ?></i>
							</div>
							<div class="col-xs-4" style="padding:1px">
								<i><?= $this->Form->control('department_id', ['label' => false, 'id'=>'department', 'onchange'=>'selectTown();selectMicrodata();selectDepartmentLayer();', 'style'=>'width: 100%;', 'class' => 'form-control input-sm', 'options' => $departmentsList, 'empty' => '--Département--']) ?></i>
							</div>
							<div class="col-xs-4" style="padding:1px">
								<i><?= $this->Form->control('town_id', ['label' => false, 'id'=>'town', 'onchange'=>'selectMicrodata();selectTownLayer();', 'style'=>'width: 100%;', 'class' => 'form-control input-sm', 'options' => $townsList, 'empty' => '--Commune--']) ?></i>
							</div>
						</div>
					</div>
				</ul>
			</li>
			<li class="treeview active menu-open">
				<a href="#">
					<i class="fa fa-object-group"></i>
					<span style="font-size:10px;font-weight:600"><?= __('DOMAINES, THEMES ET VERSIONS') ?></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
				</a>
				<ul class="treeview-menu">
					<div class="box-body">
						<div class="col-xs-4" style="padding:1px">
							<i><?= $this->Form->control('theme_id', ['label' => false, 'id'=>'theme', 'onchange'=>'selectDomain2();selectIuTheme();selectMicrodata();', 'style'=>'width: 100%;', 'class' => 'form-control input-sm', 'options' => $themes, 'empty' => '--Thème--']) ?></i>
						</div>
						<div class="col-xs-4" style="padding:1px">
							<i><?= $this->Form->control('domain_id', ['label' => false, 'id'=>'domain', 'onchange'=>'selectIuDomain();selectMicrodata();', 'style'=>'width: 100%;', 'class' => 'form-control input-sm', 'options' => $domains, 'empty' => '--Domaine--']) ?></i>
						</div>
						<div class="col-xs-4" style="padding:1px">
							<i><?= $this->Form->control('version_id', ['label' => false, 'id'=>'version', 'onchange'=>'selectMicrodata();', 'style'=>'width: 100%;', 'class' => 'form-control input-sm', 'options' => $versionList, 'default' => '1']) ?></i>
						</div>
					</div>
				</ul>
			</li>
			<li class="treeview active menu-open">
				<a href="#">
					<i class="fa fa-line-chart"></i>
					<span style="font-size:10px;font-weight:600"><?= __('INDICATEURS URBAINS') ?></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
				</a>
				<ul class="treeview-menu">
					<div class="box-body">
						<div class="scroller">
							<table id="indicateurs" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
								<tbody>
									<?php foreach ($indicators as $indicator): ?>
									<tr>
										<td>
											<ul class="control-sidebar-menu">
												<li>
													<a href="#" onclick="checkRadio(<?php echo $indicator->id; ?>, 1);setMarkerForIndicator(<?php echo $indicator->id; ?>)">
														<div class="" style="float:left;width:5%;"><input name="radioIndicator" type="radio" value="<?php echo $indicator->id; ?>" id="<?php echo 'radioIndicator'.$indicator->id; ?>"></div>
														<div class="" style="float:left;width:95%;padding-left:5px;padding-top:3px">
															<div class="menu-info">
																<input class="hide" type="text" value="<?php echo $indicator->indicator_name_fr; ?>" id="<?php echo 'iuName'.$indicator->id; ?>">
																<h6 class="control-sidebar-subheading"><?= h($indicator->indicator_name_fr) ?></h6>
															</div>
														</div>
													</a>													
												</li>
											</ul>
										</td>
									</tr>
									<?php endforeach; ?>	
								</tbody>
							</table>
						</div>
					</div>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-list"></i>
					<span style="font-size:10px;font-weight:600"><?= __('MICRODONNEES') ?></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
				</a>
				<ul class="treeview-menu">
					<div class="box-body">
						<div class="scroller">
							<table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
								<tbody id="microdonnees">
									<?php foreach ($microdata as $data): ?>
									<tr>
										<td>
											<ul class="control-sidebar-menu">
												<li>
													<a href="#" onclick="checkRadio(<?php echo $data->id; ?>, 1);setMarkerForMicrodata()">
														<div class="" style="float:left;width:5%;"><input name="radioData" type="radio" value="<?php echo $data->id; ?>" id="<?php echo 'radioData'.$data->id; ?>"></div>
														<div class="" style="float:left;width:95%;padding-left:5px;padding-top:3px">
															<div class="menu-info">
																<input class="hide" type="text" value="<?php echo $data->mdc->mdcs_name_fr; ?>" id="<?php echo 'mdName'.$data->id; ?>">
																<h6 class="control-sidebar-subheading"><?= $data->mdcs_name_fr ?></h6>
															</div>
														</div>
													</a>													
												</li>
											</ul>
										</td>
									</tr>
									<?php endforeach; ?>	
								</tbody>
							</table>
						</div>
					</div>
				</ul>
			</li>
		</ul>
<?= $this->Form->end() ?>
<script>
	function checkRadio(id, type){
		if(type == 0) $("#radioIndicator"+id).attr('checked', true);
		if(type == 1) $("#radioData"+id).attr('checked', true);
	}
</script>

<style>
	.main-header .logo{
		width:350px;
	}
	.main-sidebar{
		width:350px;
	}
	.main-header .logo{
		padding:0px;
	}
	.main-header .navbar{
		margin-left:350px;
	}
	.content-wrapper, .main-footer{
		margin-left:350px;
	}
	.control-sidebar-menu > li > a {
		display: block;
		padding: 2px 15px;
	}
	.sidebar-menu > li > a {
		padding: 8px 5px 8px 15px;
		display: block;
	}
	.skin-blue-light .sidebar-menu > li > .treeview-menu {
		background:white;
	}
	.navbar-nav > li > a {

		padding-top: 15px;
		padding-bottom: 13.5px;

	}
	.scroller {
		max-height: 250px;
		position: relative;
		overflow: auto;
		scrollbar-width: thin;
		scrollbar-color: #3C8DBC #ECF0F5;
	}
	::-webkit-scrollbar {
		width: 0.5em;
		height: 0.5em;
	}
	::-webkit-scrollbar-button {
		background: #ECF0F5
	}
	::-webkit-scrollbar-track-piece {
		background: #ECF0F5
	}
	::-webkit-scrollbar-thumb {
		background: #3C8DBC
	}
</style>