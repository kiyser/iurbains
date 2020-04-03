<section class="content-header">
	<h1><?= __('CONFIGURATION') ?><small><?= __('Ajouter un département') ?></small></h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"></h3><i style="color:red;float:right">(*) Champs obligatoires</i>
				</div>
				<?= $this->Form->create($department) ?>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-2"></div>
							<div class="col-xs-6">
								<div class="form-group">
									<label><?= __('Région') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('region_id', ['label' => false, 'required' => true, 'class' => 'form-control select2', 'options' => $regions, 'empty' => '-- Sélectionner la région --']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Nom du département') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('department_name_fr', ['label' => false, 'required' => true, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Nom du département']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Chef lieu de département') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('department_city', ['label' => false, 'required' => true, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Chef lieu de département']) ?>
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

<?php echo $this->Html->script('custom/jquery-2.1.4.min'); ?>
<?php echo $this->Html->script('custom/jquery-ui.min'); ?>
<?php echo $this->Html->script('custom/utils'); ?>
<?php echo $this->Html->script('custom/jquery.gritter.min'); ?>
<script language="javascript">
	$(document).ready(function() {
		$('.select2').select2();
	});
</script>