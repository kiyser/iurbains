<?php //last: AIzaSyATUUEkfD1MGDZmC54EECKt7ub-rPPBXzU ?>
<?php //echo $this->Html->css('//unpkg.com/leaflet@1.3.1/dist/leaflet.css'); ?>
<?php //echo $this->Html->script('https://unpkg.com/leaflet@1.3.1/dist/leaflet.js') ?>
<?php //echo $this->Html->css('https://api.mapbox.com/mapbox.js/v3.2.1/mapbox.css'); ?>
<?php echo $this->Html->script('https://api.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.js'); ?>
<?php echo $this->Html->css('https://api.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.css'); ?>
<?= $this->Html->script('sig/carte', ['crossorigin' => 'anonymous']) ?>
<?php echo  $this->Html->css('sig/map-style') ?>
<?php //echo  $this->Html->css('sig/mapbox') ?>
<?php //echo $this->Html->script('sig/mapbox.js') ?>
<?php //echo  $this->Html->css('sig/mapboxgl') ?>
<?php //echo $this->Html->script('sig/mapboxgl.js') ?>
<?php //echo  $this->Html->css('sig/leaflet') ?>
<?php //echo $this->Html->script('sig/leaflet.js') ?>
<?php //echo $this->Html->script('custom/jquery-2.1.4.min'); ?>
<?php //echo $this->Html->script('custom/jquery-ui.min'); ?>

<section class="content-header" style="padding:1px 15px 0 15px">
	<div class="row">
        <div class="col-md-12">
			<h4 class="pull-left" style=""><?= __('CARTOTHEQUE') ?><small><?= __(' Visualisation des données') ?></small></h4>
			<div class="pull-right" style="padding-top:10px;padding-right:0px">
				<a href="#" class="sidebar-toggle btn btn-success btn-xs" data-toggle="push-menu" role="button">
					<span class=""><i class="fa fa-search"></i><?= __(' Filtrer les données') ?></span>
				</a>
				<a href="#" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown"><i class="fa fa-th"></i><b><?= __(' Fonds de carte') ?></b></a>
				<ul class="dropdown-menu" role="menu" style="margin:-7px 12px 0;min-width:auto" id="baseLayer">
					<li><a href="#"><?= __('Mapbox satellite') ?></a></li>
					<li><a href="#"><?= __('Mapbox Light') ?></a></li>
				</ul>
			</div>
		</div>
	</div>
</section>
<section class="content" style="padding:1px 2px 0 2px;border-top: 1px solid #CCC;">
	<div class="col-xs-12" style="min-height:inherit;border-bottom: 1px solid #ccc;">	
		<div class="row" style="">
			<div class="" id="map">

			</div>
		</div>
	</div>
</section>

<div class="legende-position" id="legend"></div>
<div class="ind-infos-position" id="indicator"></div>

<div id='legend2' style='display:none;'>
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
<style>	
	a, a:hover, a:active, a:focus {
		color: #000;
	}
	#li-style {
		padding:4px;
	}
	.content {
		min-height: inherit;
	}
	.control-sidebar-subheading {
		font-size: 13px;
	}
	.control-sidebar-menu .menu-info {
		margin-left: 0px;
		margin-top: 0px;
	}
	.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
		padding: 3px;
		vertical-align: middle;
	}
</style>

<?php echo $this->Html->script('custom/jquery-2.1.4.min'); ?>
<?php echo $this->Html->script('custom/jquery.gritter.min'); ?>
<?php echo $this->Html->script('custom/jquery-ui.min'); ?>
<?php echo $this->Html->script('custom/utils'); ?>
<script type="text/javascript">
	initialize();
</script>