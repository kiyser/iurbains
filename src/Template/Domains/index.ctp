<!-- Content Header (Page header) -->
<section class="content-header">
	<h1><?= __('CONFIGURATION') ?><small><?= __('Liste des domaines') ?></small></h1>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<div class="row">
						<div class="col-sm-5">
							<?= $this->Form->create(null, ['id' => 'formSearch']) ?>
							<?= $this->Form->control('theme_id', ['label' => false, 'required' => true, 'onChange'=>'startSearch()', 'class' => 'form-control input-sm select2', 'options' => $themes, 'empty' => '-- Sélectionner le thème --']) ?>
						</div>
						<?= $this->Form->end() ?>
						<div class="col-sm-3 pull-right" style="text-align:right">
							<a class="btn btn-primary btn-sm" href="<?= $this->Url->build(['controller' => 'Domains', 'action' => 'add']) ?>"><i class="fa fa-plus"></i><?= __(' Ajouter un domaines') ?></a>
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
											<th scope="col"><?= __('Nom du thème') ?></th>
											<th scope="col"><?= __('Nom du domaine') ?></th>
											<th scope="col" style="width:10%;text-align:center"><?= __('Abréviation') ?></th>
											<th scope="col" class="actions" style="width:28%;text-align:center"><?= __('Actions') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($domains as $domain): ?>
										<tr>
											<td><?= $this->Number->format($domain->id) ?></td>
											<td><?= $domain->has('theme') ? $domain->theme->theme_name_fr : '' ?></td>
											<td><?= h($domain->domain_name_fr) ?></td>
											<td style="text-align:center"><?= h($domain->domain_abrev) ?></td>
											<td class="actions" style="text-align:center">
												<div class="btn-group">
													<a class="btn btn-primary btn-element btn-sm" href="<?= $this->Url->build(['controller' => 'Domains', 'action' => 'edit', $domain->id]) ?>"><i class="fa fa-pencil"></i><?= __(' Modifier') ?></a>
													<a class="btn btn-default btn-sm disabled" href="<?= $this->Url->build(['controller' => 'Domains', 'action' => 'view', $domain->id]) ?>"><i class="fa fa-list"></i><?= __(' Détails') ?></a>
												<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $domain->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cet enregistrement # {0}?', $domain->id)]) ?>
												</div>
											</td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<?php if($domains == null) echo '<div class= "center">'.__('Aucune donnée trouvée').'</div>'; else {?>
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
<!-- /.content -->

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