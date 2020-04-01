<?= $this->Html->css('//unpkg.com/leaflet@1.3.1/dist/leaflet.css') ?>
<?= $this->Html->script('https://unpkg.com/leaflet@1.3.1/dist/leaflet.js') ?>
<?= $this->Html->script('http://www.openlayers.org/api/OpenLayers.js') ?>
<?= $this->Html->script('sig/carte') ?>
<section class="content-header">
	<h1><?= __('INDICATEURS URBAINS') ?><small><?= __('Visualisation des données') ?></small></h1>
</section>
<section class="content">
	<div class="box box-primary">
		<div class="box-body">
			<a class="btn btn-app" href="#" data-toggle="control-sidebar">
				<span class="badge bg-green">300<?= __(' indicateurs urbains') ?></span>
				<i class="fa fa-search"></i><b><?= __(' MODIFIER LES CRITERES DE RECHERCHE') ?></b>
			</a>
			<div class="row">
				<div class="col-xs-12">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs pull-right">
							<li class=""><a href="#tab_1-1" data-toggle="tab" aria-expanded="false"><b><?= __(' Graphiques') ?></b></a></li>
							<li class=""><a href="#tab_2-2" data-toggle="tab" aria-expanded="false"><b><?= __(' Tableaux') ?></b></a></li>
							<li class="active"><a href="#tab_3-2" data-toggle="tab" aria-expanded="true"><b><?= __(' Carte') ?></b></a></li>
							<li class="pull-left header"><i class="fa fa-th"></i><?= __(' Visualisation des données') ?></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane" id="tab_1-1">
								<div class="row">
									<div class="col-md-9">
										<p class="text-center">
											<strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
										</p>
									  <div class="chart">
											<canvas id="salesChart" style="height: 300px; width: 816px;" height="225" width="1020"></canvas>
									  </div>
									</div>
									<div class="col-xs-3" style="margin-top:3%">
										<div class="row">
											<div class="chart-responsive">
												<canvas id="pieChart" height="200" style="width: 243px; height: 160px;" width="303"></canvas>
											</div>
											<div class="col-xs-6">
												<ul class="chart-legend clearfix">
													<li><i class="fa fa-circle-o text-red"></i> Chrome</li>
													<li><i class="fa fa-circle-o text-green"></i> IE</li>
													<li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
												</ul>
											</div>
											<div class="col-xs-6">
												<ul class="chart-legend clearfix">
													<li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
													<li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
													<li><i class="fa fa-circle-o text-gray"></i> Navigator</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="tab_2-2">
								<div class="box-group" id="accordion">
									<?php $indice = 0; for($i=0;$i<=(sizeof($indicateur)-1);$i++){$indice++; ?>
									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="<?php echo '#collapse'.$indice; ?>" aria-expanded="true">
												<?php echo $indicateur[$i][0][0]['Region']; ?>
											</a>
										</h4>
									</div>
									<div id="<?php echo 'collapse'.$indice; ?>" class="panel-collapse collapse" aria-expanded="true">
										<div class="box-body">
											<?php for($j=0;$j<=(sizeof($indicateur[$i])-1);$j++){$indice++; ?>
											<div class="box-group" id="accordion">
												<div class="box-header with-border">
													<h4 class="box-title">
														<a data-toggle="collapse" data-parent="#accordion" href="<?php echo '#collapse'.$indice; ?>" aria-expanded="true" class="">
															<?php echo $indicateur[$i][$j][0]['Department']; ?>
														</a>
													</h4>
												</div>
												<div id="<?php echo 'collapse'.$indice; ?>" class="panel-collapse collapse" aria-expanded="true" style="">
													<div class="box-body">
														<?php for($k=0;$k<=(sizeof($indicateur[$i][$j])-1);$k++){$indice++; ?>
														<div class="box-group" id="accordion">
															<div class="box-header with-border">
																<h4 class="box-title">
																	<a data-toggle="collapse" data-parent="#accordion" href="<?php echo '#collapse'.$indice; ?>" aria-expanded="true" class="">
																		<?php echo $indicateur[$i][$j][$k]['Town']; ?>
																	</a>
																</h4>
															</div>
															<div id="<?php echo 'collapse'.$indice; ?>" class="panel-collapse collapse" aria-expanded="true" style="">
																<div class="box-body">
																	<?php echo $indicateur[$i][$j][$k]['value']; ?>
																</div>
															</div>
														</div>
														<?php } ?>
													</div>
												</div>
											</div>
											<?php } ?>
										</div>
									</div>
									<?php } ?>
								</div>
							</div>
							<div class="tab-pane active" id="tab_3-2">
								<div class="row">
									<div class="box box-solid bg-light-blue-gradient">
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<style>
	#map{width:100%;height:600px;}
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
<?= $this->element('Menus/_slide_menu') ?>
<?php echo $this->Html->script('custom/jquery-2.1.4.min'); ?>
<?php echo $this->Html->script('custom/jquery.gritter.min'); ?>
<?php echo $this->Html->script('custom/jquery-ui.min'); ?>
<?php echo $this->Html->script('custom/utils'); ?>
<script type="text/javascript">
	
</script>