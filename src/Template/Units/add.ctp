<section class="content-header">
	<h1><?= __('GESTION DES MICRODONNEES') ?><small><?= __('Ajouter une mésure') ?></small></h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"></h3><i style="color:red;float:right">(*) Champs obligatoires</i>
				</div>
				<?= $this->Form->create($unit) ?>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-2"></div>
							<div class="col-xs-6">
								<div class="form-group">
									<label><?= __('Intitulé de l\'unité') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('unit_name_fr', ['label' => false, 'required' => true, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Intitulé de l\'unité']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Abréviation') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('unit_abrev', ['label' => false, 'required' => true, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Nom court']) ?>
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