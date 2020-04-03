<!-- Content Header (Page header) -->
<section class="content-header">
	<h1><?= __('ADMINISTRATION') ?><small><?= __('Le mouchard') ?></small></h1>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<div class="row">
						<?= $this->Form->create(null) ?>
						<?= $this->Form->hidden('url', ['label' => false,'id'=>'url', 'value'=>$this->Url->build(['controller' => 'Domains', 'action' => 'listesliees']), 'hidden' => true]) ?>
						<div class="col-sm-3">
							<?= $this->Form->control('user_id', ['label' => false, 'required' => true, 'id'=>'user', 'class' => 'form-control input-sm selsect2', 'options' => '', 'empty' => '-- Sélectionner un utilisateur --']) ?>
						</div>
						<div class="col-sm-3">
							<?= $this->Form->control('domain_id', ['label' => false, 'id'=>'domain', 'class' => 'form-control input-sm', 'options' => '', 'empty' => '-- Sélectionner le domaine --']) ?>
						</div>
						<div class="col-sm-3"><button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i><?= __(' Rechercher') ?></button></div>
						<?= $this->Form->end() ?>
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
											<th scope="col"><?= __('Utilisateur') ?></th>
											<th scope="col" style="width:15%;"><?= __('Action') ?></th>
											<th scope="col" style="width:25%;"><?= __('Donnée traitée') ?></th>
											<th scope="col" style="width:15%;text-align:center"><?= __('Date de l\'action') ?></th>
											<th scope="col" class="actions" style="width:10%;text-align:center"><?= __('Actions') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 0; foreach ($inspectors as $inspector): ?>
										<tr>
											<td><?= $this->Number->format($inspector->id) ?></td>
											<td><?= $user[$inspector->created_by] ?></td>
											<td><?= h($inspector->model_name).'/'.h($inspector->controller_action) ?></td>
											<td><?= $this->Number->format($inspector->id_data) ?></td>
											<td style="text-align:center"><?= h($inspector->created) ?></td>
											<td class="actions" style="text-align:center">
												<div class="btn-group">
													<a class="btn btn-default btn-sm disabled" href="<?= $this->Url->build(['controller' => 'Inspectors', 'action' => 'view']) ?>"><i class="fa fa-list"></i><?= __(' Détails') ?></a>
												</div>
											</td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<?php if($inspectors == null) echo '<div class= "center">'.__('Aucune donnée trouvée').'</div>'; else {?>
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

<?= $this->Html->script('custom/jquery-2.1.4.min') ?>
<?= $this->Html->script('custom/jquery.gritter.min') ?>
<?= $this->Html->script('custom/utils') ?>
<script language="javascript">
	$(document).ready(function() {
		$('.select2').select2();
	});
</script>