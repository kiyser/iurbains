 <aside class="control-sidebar control-sidebar-dark" style="display: none;">
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
		<li class=""><a href="#" data-toggle="tab" style="float:left;width:605px;"><i class="fa fa-bars"></i><?= __(' Définissez vos critères de recherche') ?></a></li>
		<li class="active"><a href="#" data-toggle="control-sidebar" style="float:right;width:95px;"><i class="fa fa-times"></i><?= __(' Fermer') ?></a></li>
    </ul>
    <div class="tab-content">
		<div class="box">
			<?php echo $this->Form->create(null, array('method'=>'post', 'role'=>'form', 'id'=>'formSearch', 'class'=>'', 'url'=>['controller' => 'Mdvs', 'action' => 'index'])); ?>
			<?php echo $this->Form->hidden('url', ['label' => false,'id'=>'url', 'value'=>$this->Url->build(['controller' => 'Departments', 'action' => 'listesliees']), 'hidden' => true]); ?>
			<?php echo $this->Form->hidden('url2', ['label' => false,'id'=>'url2', 'value'=>$this->Url->build(['controller' => 'Domains', 'action' => 'listesliees']), 'hidden' => true]); ?>
			<?php echo $this->Form->hidden('urlIu', ['label' => false,'id'=>'urlIu', 'value'=>$this->Url->build(['controller' => 'Indicators', 'action' => 'listesliees']), 'hidden' => true]); ?>
			<div class="box-header with-border">
				<h3 class="box-title"><?= __('CRITERES DE RECHERCHE') ?></h3>
				<div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div>
			</div>
			<div class="box-body">
				<div class="form-group col-xs-4">
					<label><?= __('Région') ?></label>
					<?= $this->Form->control('region_id', ['label' => false, 'id'=>'region', 'onchange'=>'selectDepartment();', 'style'=>'width: 100%;', 'class' => 'form-control input-sm', 'options' => $regionsList, 'empty' => '-- Sélectionner une région --']) ?>
				</div>								
				<div class="form-group col-xs-4">
					<label><?= __('Département') ?></label>
					<?= $this->Form->control('department_id', ['label' => false, 'id'=>'department', 'onchange'=>'selectTown();', 'style'=>'width: 100%;', 'class' => 'form-control input-sm', 'options' => $departmentsList, 'empty' => '-- Sélectionner un département --']) ?>
				</div>								
				<div class="form-group col-xs-4">
					<label><?= __('Commune') ?></label>
					<?= $this->Form->control('town_id', ['label' => false, 'id'=>'town', 'style'=>'width: 100%;', 'class' => 'form-control input-sm', 'options' => $townsList, 'empty' => '-- Sélectionner une commune --']) ?>
				</div>
				<div class="form-group col-xs-4">
					<label><?= __('Thème') ?></label>
					<?= $this->Form->control('theme_id', ['label' => false, 'id'=>'theme', 'onchange'=>'selectDomain2();selectIuTheme();', 'style'=>'width: 100%;', 'class' => 'form-control input-sm', 'options' => $themes, 'empty' => '-- Sélectionner un thème --']) ?>
				</div>
				<div class="form-group col-xs-4">
					<label><?= __('Domaine') ?></label>
					<?= $this->Form->control('domain_id', ['label' => false, 'id'=>'domain', 'onchange'=>'selectIuDomain();', 'style'=>'width: 100%;', 'class' => 'form-control input-sm', 'options' => $domains, 'empty' => '-- Sélectionner un domaine --']) ?>
				</div>
			</div>
			<?= $this->Form->end() ?>
		</div>
		<div class="tab-pane active" id="control-sidebar-home-tab">
			<h3 class="control-sidebar-heading"><?= __(' INDICATEURS URBAINS') ?></h3>			
			<ul class="control-sidebar-menu" id="indicateurs">
				<?php foreach ($indicators as $indicator): ?>
				<li>
					<a href="<?php echo $this->Url->build(['controller' => 'Indicators', 'action' => 'view', $indicator->id]); ?>">
						<i class="menu-icon fa fa-bars bg-warning"></i>
						<div class="menu-info">
							<h4 class="control-sidebar-subheading"><?= h($indicator->indicator_name_fr) ?></h4>
							<p><i><?= h($indicator->indicator_desc_fr) ?></i></p>
						</div>
					</a>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
    </div>
</aside>
<style>
	.box{
		margin-bottom:2px;
	}
	.form-group{
		font-size:12px;
		margin-bottom:0px;
	}
	.box-header > .fa, .box-header > .glyphicon, .box-header > .ion, .box-header .box-title{
		font-size:15px;
	}
	.control-sidebar-bg, .control-sidebar{
		width:700px;
	}
	.nav-tabs.nav-justified > li > a{
		text-align:left;
	}
	.control-sidebar-dark, .control-sidebar-dark + .control-sidebar-bg {
		background: #3C8DBC;
	}
	.control-sidebar-menu > li > a {
		padding: 1px 15px;
	}
	.control-sidebar-menu .menu-icon {
		width: 30px;
		height: 30px;
		line-height: 30px;
	}
	.control-sidebar-heading {
		padding: 0px;
	}
</style>