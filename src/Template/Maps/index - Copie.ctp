<?php //last: AIzaSyATUUEkfD1MGDZmC54EECKt7ub-rPPBXzU ?>
<?php //echo $this->Html->css('//unpkg.com/leaflet@1.3.1/dist/leaflet.css'); ?>
<?php //echo $this->Html->script('https://unpkg.com/leaflet@1.3.1/dist/leaflet.js') ?>
<?php echo $this->Html->css('https://api.mapbox.com/mapbox.js/v3.2.1/mapbox.css'); ?>
<?php //echo $this->Html->script('https://api.mapbox.com/mapbox.js/v3.2.1/mapbox.js'); ?>
<?php //echo $this->Html->css('https://api.tiles.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.css'); ?>
<?php //echo $this->Html->script('https://api.tiles.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.js'); ?>
<?= $this->Html->script('sig/carte') ?>
<?= $this->Html->script('sig/cameroun') ?>
<?= $this->Html->script('sig/regions') ?>
<?= $this->Html->script('sig/departments') ?>
<?= $this->Html->script('sig/towns') ?>
<?php //echo  $this->Html->css('sig/mapbox') ?>
<?php echo $this->Html->script('sig/mapbox.js') ?>
<?php //echo  $this->Html->css('sig/mapboxgl') ?>
<?php //echo $this->Html->script('sig/mapboxgl.js') ?>
<?php //echo  $this->Html->css('sig/leaflet') ?>
<?php //echo $this->Html->script('sig/leaflet.js') ?>
<?php echo $this->Form->create(null, array('method'=>'post', 'role'=>'form', 'id'=>'formSearch', 'class'=>'', 'url'=>['controller' => 'Mdvs', 'action' => 'index'])); ?>
<?php echo $this->Form->hidden('url', ['label' => false,'id'=>'url', 'value'=>$this->Url->build(['controller' => 'Departments', 'action' => 'listesliees']), 'hidden' => true]); ?>
<?php echo $this->Form->hidden('url2', ['label' => false,'id'=>'url2', 'value'=>$this->Url->build(['controller' => 'Domains', 'action' => 'listesliees']), 'hidden' => true]); ?>
<?php echo $this->Form->hidden('urlIu', ['label' => false,'id'=>'urlIu', 'value'=>$this->Url->build(['controller' => 'Indicators', 'action' => 'listesliees']), 'hidden' => true]); ?>
<?php echo $this->Form->hidden('urlMd', ['label' => false,'id'=>'urlMd', 'value'=>$this->Url->build(['controller' => 'Mdcs', 'action' => 'listesliees']), 'hidden' => true]); ?>
<section class="content-header" style="padding:1px 15px 0 15px">
	<div class="row">
        <div class="col-md-12">
			<h4 class="pull-left" style=""><?= __('CARTOTHEQUE') ?><small><?= __(' Visualisation des données') ?></small></h4>
			<div class="pull-right" style="padding-top:10px;padding-right:0px">
				<a href="#" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown"><i class="fa fa-th"></i><b><?= __(' Menu') ?></b></a>
				<ul class="dropdown-menu" role="menu" style="margin:-7px 12px 0;min-width:auto">
					<li><a href="#"><?= __('Carte') ?></a></li>
					<li><a href="#"><?= __('Tableaux') ?></a></li>
					<li><a href="#"><?= __('Graphiques') ?></a></li>
				</ul>
				<a class="btn btn-success btn-xs" href="#" data-toggle="control-sidebar"><i class="fa fa-search"></i><?= __(' Filtrer les données') ?></a>
			</div>
		</div>
	</div>
</section>
<section class="content" style="padding:1px 15px 0 15px;border-top: 1px solid #CCC;">
	<div class="row">		
		<div class="">
			<div id="map" style="">
				
			</div>
		</div>
	</div>
</section>
<div id='legend' style='display:none;'>
  <strong>Légende</strong>
  <nav class='legend clearfix'>
    <span style='background:#73B993;'></span>
    <span style='background:#2E9F68;'></span>
    <span style='background:#D33C44;'></span>
    <label>Région</label>
    <label>Département</label>
    <label>Commune</label>
  </nav><hr style="margin:5px;background-color:#777">
  <nav class='legend clearfix'>
    <span style='background:#73B001;'></span>
    <span style='background:#3C8DBC;'></span>
    <span style=''></span>
    <label>Micro-donnée</label>
    <label>Indicateur</label>
    <label></label>
    <small>Source: <a href="#link to source">Name of source</a></small>
  </nav>
</div>
<?= $this->Form->end() ?>
<style>
	#map{position:absolute; width:100%;height:100%;}
	a, a:hover, a:active, a:focus {
		color: #000;
	}
	#li-style {
		padding:4px;
	}
	.box-body {
		padding:5px;
	}
	.control-sidebar-menu .menu-info {
		margin-left:0px;
	}
	.control-sidebar-subheading, h6 {
		font-size:12px;
	}
	.navbar-brand {
		font-size:13px;
	}
	.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
		padding: 3px;
		vertical-align: middle;
	}
	.pagination-sm > li > a, .pagination-sm > li > span {
		padding: 2px 8px;;
	}
	
	.legend label,
	.legend span {
	  display:block;
	  float:left;
	  height:15px;
	  width:33%;
	  text-align:left;
	  font-size:9px;
	  color:#808080;
	}
</style>
<?= $this->element('Menus/_slide_menu') ?>
<?php echo $this->Html->script('custom/jquery-2.1.4.min'); ?>
<?php echo $this->Html->script('custom/jquery.gritter.min'); ?>
<?php echo $this->Html->script('custom/jquery-ui.min'); ?>
<?php echo $this->Html->script('custom/utils'); ?>
<script type="text/javascript">
	
</script>