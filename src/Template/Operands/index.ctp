<section class="content-header">
	<h1><?= __('CONFIGURATION') ?><small><?= __('Liste des opérandes') ?></small></h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<div class="row">
						<div class="col-sm-3 pull-right" style="text-align:right">
							<a class="btn btn-primary btn-sm" href="<?= $this->Url->build(['controller' => 'Operands', 'action' => 'add']) ?>"><i class="fa fa-plus"></i><?= __(' Ajouter une opérandes') ?></a>
						</div>
					</div>
				</div>
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
											<th scope="col"><?= __('Nom du l\'opérande') ?></th>
											<th scope="col"><?= __('Abréviation') ?></th>
											<th scope="col" style="width:10%;text-align:center"><?= __('Symbole') ?></th>
											<th scope="col" class="actions" style="width:20%;text-align:center"><?= __('Actions') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($operands as $operand): ?>
										<tr>
											<td><?= $this->Number->format($operand->id) ?></td>
											<td><?= h($operand->operand_name_fr) ?></td>
											<td><?= h($operand->operand_abrev) ?></td>
											<td><?= h($operand->operand_symbol) ?></td>
											<td class="actions" style="text-align:center">
												<a class="btn btn-primary btn-element btn-sm" href="<?= $this->Url->build(['controller' => 'Operands', 'action' => 'edit', $operand->id]) ?>"><i class="fa fa-pencil"></i><?= __(' Modifier') ?></a>
												<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $operand->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Voulez-vous supprimer cet enregistrement # {0}?', $operand->id)]) ?>
											</td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<?php if($operands == null) echo '<div class= "center">'.__('Aucune donnée trouvée').'</div>'; else {?>
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
			</div>
		</div>
	</div>
</section>
<?php echo $this->Html->script('custom/jquery-2.1.4.min'); ?>
<?php echo $this->Html->script('custom/jquery-ui.min'); ?>
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