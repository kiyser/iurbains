<section class="content-header">
	<h1><?= __('CONFIGURATION') ?><small><?= __('Ajouter une opérande') ?></small></h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"></h3><i style="color:red;float:right">(*) Champs obligatoires</i>
				</div>
				<?= $this->Form->create($operand) ?>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-3"></div>
							<div class="col-xs-6">
								<div class="form-group">
									<label><?= __('Nom de l\'opérande') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('operand_name_fr', ['label' => false, 'required' => true, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Nom de l\'opérande']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Abréviation') ?></label>
									<?= $this->Form->control('operand_abrev', ['label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Abréviation']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Symbole') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('operand_symbol', ['label' => false, 'required' => true, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Symbole']) ?>
								</div>
							</div>
							<div class="col-xs-3"></div>
						</div>
						
					</div>
					<div class="box-footer">
						<div class="col-xs-2 pull-right"><button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i><?= __(' Sauvegarder') ?></button></div>
					</div>
				<?= $this->Form->end() ?>
			</div>
		</div>
	</div>
</section>