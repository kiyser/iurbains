<section class="content-header">
	<h1><?= __('CONFIGURATION') ?><small><?= __('Modifier une structure') ?></small></h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"></h3><i style="color:red;float:right">(*) Champs obligatoires</i>
				</div>
				<?= $this->Form->create($structure) ?>
					<?= $this->Form->hidden('url', ['label' => false,'id'=>'url', 'value'=>$this->Url->build(['controller' => 'Departments', 'action' => 'listesliees']), 'hidden' => true]) ?>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-2"></div>
							<div class="col-xs-6">
								<div class="form-group">
									<label><?= __('Type de structure') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('st_id', ['label' => false, 'required' => true, 'class' => 'form-control select2', 'options' => $sts, 'empty' => '-- Sélectionner la structure --']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Nom de la structure') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('structure_name_fr', ['label' => false, 'required' => true, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Nom de la structure']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Région') ?></label>
									<?= $this->Form->control('region_id', ['label' => false, 'id'=>'region', 'onChange'=>'selectDepartment();', 'class' => 'form-control select2', 'options' => $regions, 'empty' => '-- Sélectionner la région --']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Département') ?></label>
									<?= $this->Form->control('department_id', ['label' => false, 'id'=>'department', 'onChange'=>'selectTown();', 'class' => 'form-control select2', 'options' => $departments, 'empty' => '-- Sélectionner le département --']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Commune') ?></label>
									<?= $this->Form->control('town_id', ['label' => false, 'id'=>'town', 'class' => 'form-control select2', 'options' => $towns, 'empty' => '-- Sélectionner la commune --']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Abréviation') ?></label>
									<?= $this->Form->control('structure_abrev', ['label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Abréviation']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Description') ?></label>
									<?= $this->Form->control('structure_desc_fr', ['label' => false, 'class' => 'form-control', 'type' => 'textarea']) ?>
								</div>
							</div>
							<div class="col-xs-4"></div>
						</div>
						
					</div>
					<div class="box-footer">
						<div class="col-xs-2"></div>
						<div class="col-xs-6 pull-right"><button type="submit" class="btn btn-primary"><i class="fa fa-save"></i><?= __(' Sauvegarder') ?></button></div>
						<div class="col-xs-2"></div>
					</div>
				<?= $this->Form->end() ?>
			</div>
		</div>
	</div>
</section>
<?= $this->Html->script('custom/jquery-2.1.4.min') ?>
<?= $this->Html->script('custom/jquery.gritter.min') ?>
<?= $this->Html->script('custom/utils') ?>
<script language="javascript">
	$(document).ready(function() {
		$('.select2').select2();
	});
</script>