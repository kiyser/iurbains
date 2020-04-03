<!-- Content Header (Page header) -->
<section class="content-header">
	<h1><?= __('GESTION DES MICRODONNEES') ?><small><?= __('Liste des microdonnées') ?></small></h1>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<div class="row">
						<?= $this->Form->create(null, ['id' => 'formSearch']) ?>
						<?= $this->Form->hidden('url', ['label' => false,'id'=>'url', 'value'=>$this->Url->build(['controller' => 'Domains', 'action' => 'listesliees']), 'hidden' => true]) ?>
						<div class="col-sm-5">
							<?= $this->Form->control('theme_id', ['label' => false, 'required' => true, 'default'=>$default['theme'], 'id'=>'theme', 'onChange'=>'selectDomain();startSearch()', 'class' => 'form-control select2', 'options' => $themes, 'empty' => '-- Sélectionner le thème --']) ?>
						</div>
						<div class="col-sm-4">
							<?= $this->Form->control('domain_id', ['label' => false, 'default'=>$default['theme'], 'id'=>'domain', 'onChange'=>'startSearch()', 'class' => 'form-control select2', 'options' => $domains, 'empty' => '-- Sélectionner le domaine --']) ?>
						</div>
						<?= $this->Form->end() ?>
						<div class="col-sm-3 pull-right">
							<a class="btn btn-primary btn-sm pull-right" href="<?= $this->Url->build(['controller' => 'Mdcs', 'action' => 'add']) ?>"><i class="fa fa-plus"></i><?= __(' Créer une microdonnée') ?></a>
						</div>
					</div>
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
											<th scope="col" style="width:5%;">#</th>
											<th scope="col"><?= __('MICRODONNEES') ?></th>
											<th scope="col"><?= __('THEMES ET DOMAINES') ?></th>
											<th scope="col" class="actions" style="width:18%;text-align:center"><?= __('ACTIONS') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1; foreach ($mdcs as $mdc): ?>
										<tr>
											<td><span class="badge bg-blue"><?= $i ?></span></td>
											<td>
												<ul class="control-sidebar-menu">
													<li>
														<a href="#">
															<div class="menu-info">
																<h4 class="control-sidebar-subheading"><?= h($mdc->mdcs_name_fr) ?></h4>
																<p><i><?= __('Le : ').$mdc->modified.__(', par : ').$mdc->created_by ?></i></p>
															</div>
														</a>
													</li>
												</ul>
											</td>
											<td>
												<ul class="control-sidebar-menu">
													<li>
														<a href="#">
															<div class="menu-info">
																<h4 class="control-sidebar-subheading"><?= $mdc->has('theme') ? $mdc->theme->theme_name_fr : '' ?>/<?= $mdc->has('domain') ? $mdc->domain->domain_name_fr : '' ?></h4>
																<p><i><?= __('Type de données : ').$mdc->domain->mdcs_type.__('. Unité : ').$mdc->unit->unit_name_fr ?></i></p>
															</div>
														</a>
													</li>
												</ul>												
											</td>
											<td class="actions" style="text-align:center">
												<a class="btn btn-primary btn-element btn-sm" href="<?= $this->Url->build(['controller' => 'Mdcs', 'action' => 'edit', $mdc->id]) ?>"><i class="fa fa-pencil"></i><?= __(' Modifier') ?></a>
												<a class="btn btn-default btn-sm disabled" href="<?= $this->Url->build(['controller' => 'Mdcs', 'action' => 'view', $mdc->id]) ?>"><i class="fa fa-list"></i><?= __(' Détails') ?></a>
											</td>
										</tr>
										<?php $i++; endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<?php if($mdcs == null) echo '<div class= "center">'.__('Aucune donnée trouvée').'</div>'; else {?>
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
							<?php } ?>
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
		font-size: 14px;
	}
	
	.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
		padding: 3px;
		vertical-align: middle;
	}
	.control-sidebar-menu .menu-info {
		margin-left: 0px;
		margin-top: 3px;
	}
</style>
<?= $this->Html->script('custom/jquery-2.1.4.min') ?>
<?= $this->Html->script('custom/jquery.gritter.min') ?>
<?= $this->Html->script('custom/utils') ?>
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
				position: 'top-left',
				class_name: 'alert-error'
			});
			return false;
		});
	});
</script>