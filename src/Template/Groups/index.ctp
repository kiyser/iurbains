<section class="content-header">
	<h1><?= __('GROUPES UTILISATEURS') ?><small><?= __('Liste des groupes') ?></small></h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<a class="btn btn-primary btn-element btn-sm pull-right" href="<?= $this->Url->build(['controller' => 'Groups', 'action' => 'add']) ?>"><i class="fa fa-plus"></i><?= __(' Ajouter un groupe') ?></a>
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
											<th scope="col" style="width:20%;"><?= __('Nom du groupe') ?></th>
											<th scope="col" style="width:5%"><?= __('Code') ?></th>
											<th scope="col" style="text-align:center"><?= __('Rôles du groupe') ?></th>
											<th scope="col" style="width:15%;text-align:center"><?= __('Date de création') ?></th>
											<th scope="col" class="actions" style="width:18%;text-align:center"><?= __('Actions') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php  foreach ($groups as $group): ?>
										<tr>
											<td><?= $this->Number->format($group->id) ?></td>
											<td><?= h($group->group_name_fr) ?></td>
											<td style="text-align:center"><?= h($group->group_abrev) ?></td>
											<td></td>
											<td style="text-align:center"><?= h($group->created) ?></td>
											<td class="actions" style="text-align:center">
												<div class="btn-group">
													<a class="btn btn-primary btn-element btn-sm" href="<?= $this->Url->build(['controller' => 'Groups', 'action' => 'edit', $group->id]) ?>"><i class="fa fa-pencil"></i><?= __(' Modifier') ?></a>
													<a class="btn btn-default btn-sm" href="<?= $this->Url->build(['controller' => 'Groups', 'action' => 'view', $group->id]) ?>"><i class="fa fa-list"></i><?= __(' Détails') ?></a>
												</div>
											</td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<?php if($groups == null) echo '<div class= "center">'.__('Aucune donnée trouvée').'</div>'; else {?>
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
<?php echo $this->Html->script('custom/jquery-2.1.4.min'); ?>
<?php echo $this->Html->script('custom/jquery.gritter.min'); ?>
<?php echo $this->Html->script('custom/jquery-ui.min'); ?>
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