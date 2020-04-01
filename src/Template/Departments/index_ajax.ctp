<!-- Content Header (Page header) -->
<section class="content-header">
	<h1><?= __('CONFIGURATION') ?><small><?= __('Liste des départements') ?></small></h1>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<div class="row">
						<div class="col-sm-3">
							<?= $this->Form->create(null, ['id' => 'formSearch']) ?>
							<?= $this->Form->control('region_id', ['label' => false, 'required' => true, 'class' => 'form-control input-sm select2', 'onChange'=>'startSearch()', 'options' => $regions, 'empty' => '-- Sélectionner la région --']) ?>
						</div>
						<?= $this->Form->end() ?>
						<div class="col-sm-3 pull-right" style="text-align:right">
							<a class="btn btn-primary btn-sm" href="<?= $this->Url->build(['controller' => 'Departments', 'action' => 'add']) ?>"><i class="fa fa-plus"></i><?= __(' Ajouter un département') ?></a>
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
											<th scope="col"><?= __('NOM DU DEPARTEMENT') ?></th>
											<th scope="col"><?= __('CHEF LIEU DE DEPARTEMENT') ?></th>
											<th scope="col" style="width:18%;text-align:center"><?= __('REGION') ?></th>
											<th scope="col" class="actions" style="width:28%;text-align:center"><?= __('ACTIONS') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php echo $this->Form->hidden('urlDepartment', ['label' => false,'id'=>'urlDepartment', 'value'=>$this->Url->build(['controller' => 'Departments', 'action' => 'edit']), 'hidden' => true]); ?>
										<?php $count = 1;  foreach ($departments as $department): ?>
										<?php echo $this->Form->create(null, array('method'=>'post', 'role'=>'form', 'id'=>'formDept'.$count)); echo $this->Form->hidden('idDept', ['label' => false, 'id'=>'idDept'.$count, 'value'=>$department->id, 'hidden' => true]); ?>
										<tr>
											<td><span class="badge bg-blue"><?= $count ?></span></td>
											<td><div id="<?php echo 'colNameD'.$count;  ?>"><?php echo $this->Form->control('department_name_fr',['label'=>false, 'required'=>true, 'type'=>'text', 'value'=>$department->department_name_fr, 'placeholder' => 'Nom du département', 'id'=>'deptName'.$count, 'class'=>'form-control input-sm']); ?></div></td>
											<td><div id="<?php echo 'colCityD'.$count;  ?>"><?php echo $this->Form->control('department_city',['label'=>false, 'required'=>true, 'type'=>'text', 'value'=>$department->department_city, 'placeholder' => 'Chef lieu du département', 'id'=>'deptCity'.$count, 'class'=>'form-control input-sm']); ?></div></td>
											<td><div id="<?php echo 'colCodeD'.$count;  ?>"><?= $this->Form->control('region_id', ['label' => false, 'required' => true, 'class' => 'form-control input-sm', 'options' => $regions, 'default' => $department->region->id, 'id'=>'regionId'.$count]) ?></div></td>
											<td class="actions" style="text-align:center">
												<button class="btn btn-primary btn-element btn-xs" type="button" onclick="editDepartment(<?php echo $count; ?>)" id="<?php echo 'btnEditDept'.$count; ?>"><i class="fa fa-pencil"></i><?php echo __(' Modifier'); ?></button>
											</td>
										</tr>
										<?php echo $this->Form->end(); ?>
										<?php $count++;   endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<?php if($departments == null) echo '<div class= "center">'.__('Aucune donnée trouvée').'</div>'; else {?>
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