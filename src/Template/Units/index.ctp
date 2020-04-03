<!-- Content Header (Page header) -->
<section class="content-header">
	<h1><?= __('GESTION DES MICRODONNEES') ?><small><?= __('Liste des unités') ?></small></h1>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<div class="row">
						<div class="col-sm-3 pull-right">
							<a class="btn btn-primary btn-sm pull-right" href="<?= $this->Url->build(['controller' => 'Units', 'action' => 'add']) ?>"><i class="fa fa-plus"></i><?= __(' Ajouter une unité') ?></a>
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
											<th scope="col"><?= __('Intitulé de l\'unité') ?></th>
											<th scope="col" style="width:10%;text-align:center"><?= __('Abréviation') ?></th>
											<th scope="col"><?= __('Date de création') ?></th>
											<th scope="col" class="actions" style="width:28%;text-align:center"><?= __('Actions') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($units as $unit): ?>
										<tr>
											<td><?= $this->Number->format($unit->id) ?></td>
											<td><?= h($unit->unit_name_fr) ?></td>
											<td style="text-align:center"><?= h($unit->unit_abrev) ?></td>
											<td><?= h($unit->created) ?></td>
											<td class="actions" style="text-align:center">												
												<a class="btn btn-primary btn-element btn-sm" href="<?= $this->Url->build(['controller' => 'Units', 'action' => 'edit', $unit->id]) ?>"><i class="fa fa-pencil"></i><?= __(' Modifier') ?></a>
												<a class="btn btn-default btn-sm disabled" href="<?= $this->Url->build(['controller' => 'Units', 'action' => 'view', $unit->id]) ?>"><i class="fa fa-list"></i><?= __(' Détails') ?></a>
												<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $unit->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cet enregistrement # {0}?', $unit->id)]) ?>
											</td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<?php if($units == null) echo '<div class= "center">'.__('Aucune donnée trouvée').'</div>'; else {?>
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

<?= $this->Html->script('custom/jquery-2.1.4.min') ?>
<?= $this->Html->script('custom/jquery.gritter.min') ?>
<?= $this->Html->script('custom/utils') ?>
<script language="javascript">
	jQuery(function($) {
		$("#flash_render_success").show(function() {
			$.gritter.add({
				text: $(this).attr("name"),
				sticky: false,
				time: '8000',
				position: 'top-right',
				class_name: 'alert-success'
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