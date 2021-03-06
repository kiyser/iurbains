<!-- Content Header (Page header) -->
<section class="content-header">
	<h1><?= __('CONFIGURATION') ?><small><?= __('Liste des régions') ?></small></h1>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<a class="btn btn-primary btn-element disabled btn-sm pull-right" href="<?= $this->Url->build(['controller' => 'Regions', 'action' => 'add']) ?>"><i class="fa fa-plus"></i><?= __(' Ajouter une région') ?></a>
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
											<th scope="col" style="width:3%;">#</th>
											<th scope="col"><?= __('NOM DE LA REGION') ?></th>
											<th scope="col"><?= __('CHEF LIEU DE REGION') ?></th>
											<th scope="col" style="width:5%"><?= __('CODE') ?></th>
											<th scope="col" class="actions" style="width:18%;text-align:center"><?= __('ACTIONS') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($regions as $region): ?>
										<tr>
											<td><span class="badge bg-blue"><?= $this->Number->format($region->id) ?></span></td>
											<td><?= h($region->region_name_fr) ?></td>
											<td><?= h($region->region_city) ?></td>
											<td style="text-align:center"><?= h($region->region_abrev) ?></td>
											<td class="actions" style="text-align:center">
												<a class="btn btn-primary btn-element btn-sm" href="<?= $this->Url->build(['controller' => 'Regions', 'action' => 'edit', $region->id]) ?>"><i class="fa fa-pencil"></i><?= __(' Modifier') ?></a>
												<a class="btn btn-default btn-sm disabled" href="<?= $this->Url->build(['controller' => 'Regions', 'action' => 'view', $region->id]) ?>"><i class="fa fa-list"></i><?= __(' Détails') ?></a>
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
</section>
<!-- /.content -->
<?php echo $this->Html->script('custom/jquery-2.1.4.min'); ?>
<?php echo $this->Html->script('custom/jquery-ui.min'); ?>
<?php echo $this->Html->script('custom/utils'); ?>
<?php echo $this->Html->script('custom/jquery.gritter.min'); ?>
<script language="javascript">
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