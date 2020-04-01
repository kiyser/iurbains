<section class="content-header">
	<h1><?= __('GESTION DES VERSIONS') ?><small><?= __('Modifier une version') ?></small></h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"></h3><i style="color:red;float:right">(*) Champs obligatoires</i>
				</div>
				<?= $this->Form->create($version) ?>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-2"></div>
							<div class="col-xs-6">
								<div class="form-group">
									<label><?= __('Intitulé') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('version_name_fr', ['label' => false, 'required' => true, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Intitulé de la version']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Statut de la version') ?></label><i style="color:red;">*</i>
									<?= $this->Form->input('version_state', array('label' => false, 'class' => 'form-control', 'type'=>'select', 'options' => array('0' => '  Non actif ', '1' => 'Actif '))) ?>
								</div>
								<div class="form-group">
									<label><?= __('Année') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('version_year', ['label' => false, 'required' => true, 'class' => 'form-control', 'data-inputmask' => "'mask': ['9999']", 'data-mask' => '', 'type' => 'text', 'placeholder' => 'Année. Ex: 2020']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Date de début') ?></label>
									<?= $this->Form->control('version_dd', ['label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Année. Ex: 01/01/2020']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Date de fin') ?></label>
									<?= $this->Form->control('version_df', ['label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Année. Ex: 31/12/2020']) ?>
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
<script language="javascript">
	$(document).ready(function() {
		$('[data-mask]').inputmask()
	});	
</script>
