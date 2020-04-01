<!-- Content Header (Page header) -->
<section class="content-header">
	<h1><?= __('GESTION DES INDICATEURS') ?><small><?= __('Liste des indicateurs urbains') ?></small></h1>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<?php echo $this->Form->create(null, array('method'=>'post', 'role'=>'form', 'id'=>'formSearch', 'class'=>'', 'url'=>['controller' => 'Indicators', 'action' => 'index'])); ?>
					<?php echo $this->Form->hidden('url2', ['label' => false,'id'=>'url2', 'value'=>$this->Url->build(['controller' => 'Domains', 'action' => 'listesliees']), 'hidden' => true]); ?>
					<div class="col-xs-4">						
						<?= $this->Form->control('theme_id', ['label'=>false, 'class'=>'form-control input-sm select2', 'id'=>'theme', 'onChange'=>'selectDomain2();startSearch()', 'options' => $themes, 'default' => $default[0], 'empty'=>' -- Sélectionner un thème -- ']); ?>
					</div>
					<div class="col-xs-4">						
						<?= $this->Form->control('domain_id', ['label'=>false, 'class'=>'form-control input-sm select2', 'id'=>'domain', 'onChange'=>'startSearch()', 'options' => $domains, 'default' => $default[1], 'empty'=>' -- Sélectionner un domaine -- ']); ?>
					</div>
					<?php if($ui != null && $ui->group->group_abrev == 'MA'){ ?>
					<a class="btn btn-primary btn-element btn-sm pull-right" href="<?= $this->Url->build(['controller' => 'Indicators', 'action' => 'add']) ?>"><i class="fa fa-plus"></i><?= __(' Ajouter un indicateur') ?></a>
					<?php } ?>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
						<div class="row">
							<div class="col-sm-6"></div>
							<div class="col-sm-6"></div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
									<thead>
										<tr role="row" style="background-color:#ECF0F5">
											<th scope="col" style=""><?= __('Intitulé de l\'indicateur') ?></th>
											<th scope="col" class="actions" style="width:auto;text-align:center"><?= __('Actions') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1; foreach ($indicators as $indicator): ?>
										<tr>
											<td>
												<ul class="control-sidebar-menu">
													<li>
														<a href="#">
															<i class="menu-icon bg-warning"><?= $i ?></i>
															<div class="menu-info">
																<h4 class="control-sidebar-subheading"><?= h($indicator->indicator_name_fr) ?></h4>
																<p><i><?= h($indicator->indicator_desc_fr) ?></i></p>
															</div>
														</a>
													</li>
												</ul>
											</td>
											<td style="text-align:center">
												<?php if($ui != null && $ui->group->group_abrev == 'MA'){ ?>
												<a class="btn btn-primary btn-element btn-sm" href="<?= $this->Url->build(['controller' => 'Regions', 'action' => 'edit', $indicator->id]) ?>"><i class="fa fa-pencil"></i><?= __(' Modifier') ?></a>
												<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $indicator->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cet enregistrement # {0}?', $indicator->id)]) ?>
												<?php } ?>
												<a class="btn btn-success btn-sm" href="<?= $this->Url->build(['controller' => 'Indicators', 'action' => 'visualisation', $indicator->id]) ?>"><i class="fa fa-globe"></i><?= __(' Afficher') ?></a>
											</td>
										</tr>
										<?php $i++;  endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-5">
								<div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
									<?= $this->Paginator->counter(['format' => __('Page {{page}}/{{pages}}, {{current}} enregistrement(s) sur {{count}} au total.')]) ?>
								</div>
							</div>
							<div class="col-sm-7">
								<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
									<ul class="pagination" style="margin:0px;float:right;">
										<?= $this->Paginator->first(__('Début')) ?>
										<?= $this->Paginator->prev(__('Préc.')) ?>
										<?= $this->Paginator->numbers() ?>
										<?= $this->Paginator->next(__('Suiv.')) ?>
										<?= $this->Paginator->last(__('Fin')) ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
		</div>
	</div>
</section>
<style>
	.box{
		margin-bottom:2px;
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
		padding: 5px 15px;
	}
	.control-sidebar-menu .menu-icon {
		width: 30px;
		height: 30px;
		line-height: 30px;
	}
	.control-sidebar-heading {
		padding: 0px;
	}
	a, a:hover, a:active, a:focus {
		color: #000;
	}
	.control-sidebar-subheading {
		font-size: 16px;
	}
	
	.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
		padding: 3px;
		vertical-align: middle;
	}
</style>
<?php echo $this->Html->script('custom/jquery-2.1.4.min'); ?>
<?php echo $this->Html->script('custom/jquery-ui.min'); ?>
<?php echo $this->Html->script('custom/utils'); ?>
<?php echo $this->Html->script('custom/jquery.gritter.min'); ?>
<script language="javascript">
	$(document).ready(function() {
		$('.select2').select2();
	});	
	jQuery(function($) {
		$("#flash_render_success").show(function() {
			$.gritter.add({
				text: $(this).attr("name"),
				sticky: false,
				time: '8000',
				position: 'top-right',
				class_name: 'alert alert-success'
			});
			return false;
		});
		$("#flash_render_error").show(function() {
			$.gritter.add({
				text: $(this).attr("name"),
				sticky: false,
				time: '8000',
				position: 'top-right',
				class_name: 'alert-error'
			});
			return false;
		});
	});
</script>