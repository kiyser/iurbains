<!-- Content Header (Page header) -->
<section class="content-header">
	<h1><?= __('CONFIGURATION') ?><small><?= __('Liste des structures') ?></small></h1>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<div class="row">
						<div class="col-sm-4">
							<?= $this->Form->create(null, ['id' => 'formSearch']) ?>
							<?= $this->Form->control('st_id', ['label' => false, 'required' => true, 'onChange'=>'startSearch()', 'class' => 'form-control input-sm select2', 'options' => $sts, 'empty' => '-- Sélectionner le type de structure --']) ?>
						</div>
						<?= $this->Form->end() ?>
						<div class="col-sm-3 pull-right" style="text-align:right">
							<a class="btn btn-primary btn-sm" href="<?= $this->Url->build(['controller' => 'Structures', 'action' => 'add']) ?>"><i class="fa fa-plus"></i><?= __(' Ajouter une structure') ?></a>
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
											<th scope="col">#</th>
											<th scope="col"><?= __('NOM DE LA STRUCTURE') ?></th>
											<th scope="col"><?= __('TYPE DE STRUCTURE') ?></th>
											<th scope="col" class="actions" style="width:28%;text-align:center"><?= __('ACTIONS') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($structures as $structure): ?>
										<tr>
											<td><span class="badge bg-blue"><?= $this->Number->format($structure->id) ?></td>
											<td>
												<ul class="control-sidebar-menu">
													<li>
														<a href="#">
															<div class="menu-info">
																<h4 class="control-sidebar-subheading"><?= h($structure->structure_name_fr) ?></h4>
																<p><i><?= '<i class="fa fa-calendar"></i> '.$structure->modified.', <i class="fa fa-user"></i> '.$structure->created_by ?></i></p>
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
																<h4 class="control-sidebar-subheading"><?= h($structure->st->sts_name_fr) ?></h4>
																<p><i><?= $structure->has('region') ? $structure->region->region_name_fr : '' ?><?= $structure->has('department') ? ' -- '.$structure->department->department_name_fr : '' ?><?= $structure->has('town') ? ' -- '.$structure->town->town_name_fr : '' ?></i></p>
															</div>
														</a>
													</li>
												</ul>
											</td>
											<td class="actions" style="text-align:center">
												<a class="btn btn-primary btn-element btn-sm" href="<?= $this->Url->build(['controller' => 'Structures', 'action' => 'edit', $structure->id]) ?>"><i class="fa fa-pencil"></i><?= __(' Modifier') ?></a>
												<a class="btn btn-default btn-sm disabled" href="<?= $this->Url->build(['controller' => 'Structures', 'action' => 'view', $structure->id]) ?>"><i class="fa fa-list"></i><?= __(' Détails') ?></a>
												<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $structure->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cet enregistrement # {0}?', $structure->id)]) ?>
											</td>
										</tr>
										<?php endforeach; ?>
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
</section><style>
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
<div class="modal fade" id="modal-default">
	 <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Default Modal</h4>
			</div>
			<div class="modal-body">
				<p>One fine body&hellip;</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?= __('Fermer') ?></button>
				<button type="button" class="btn btn-primary"><?= __('Activer') ?></button>
			</div>
		</div>
	  </div>
	</div>

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