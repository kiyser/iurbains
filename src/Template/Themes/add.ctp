<section class="content-header">
	<h1><?= __('CONFIGURATION') ?><small><?= __('Ajouter un thème') ?></small></h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"></h3><i style="color:red;float:right">(*) Champs obligatoires</i>
				</div>
				<?= $this->Form->create($theme) ?>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-2"></div>
							<div class="col-xs-6">
								<div class="form-group">
									<label><?= __('Nom du thème') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('theme_name_fr', ['label' => false, 'required' => true, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Nom du thème']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Code du thème') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('theme_abrev', ['label' => false, 'required' => true, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Code du thème']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Description') ?></label>
									<?= $this->Form->control('theme_desc_fr', ['label' => false, 'class' => 'form-control', 'type' => 'textarea']) ?>
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
