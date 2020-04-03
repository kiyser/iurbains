<section class="content-header">
	<h1><?= __('CONFIGURATION') ?><small><?= __('Modifier un domaine') ?></small></h1>
</section>
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"></h3><i style="color:red;float:right">(*) Champs obligatoires</i>
	</div>
	<?= $this->Form->create($domain) ?>
		<div class="box-body">
			<div class="row">
				<div class="col-xs-2"></div>
				<div class="col-xs-6">
					<div class="form-group">
						<label><?= __('Nom du thème') ?></label><i style="color:red;">*</i>
						<?= $this->Form->control('theme_id', ['label' => false, 'required' => true, 'class' => 'form-control', 'options' => $themes, 'empty' => '-- Sélectionner un thème --']) ?>
					</div>
					<div class="form-group">
						<label><?= __('Nom du domaines') ?></label><i style="color:red;">*</i>
						<?= $this->Form->control('domain_name_fr', ['label' => false, 'required' => true, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Nom du domaine']) ?>
					</div>
					<div class="form-group">
						<label><?= __('Abréviation') ?></label>
						<?= $this->Form->control('domain_abrev', ['label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Abréviation']) ?>
					</div>
					<div class="form-group">
						<label><?= __('Description') ?></label>
						<?= $this->Form->control('domain_desc_fr', ['label' => false, 'class' => 'form-control', 'type' => 'textarea']) ?>
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
