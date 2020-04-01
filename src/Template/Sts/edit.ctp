<section class="content-header">
	<h1><?= __('CONFIGURATION') ?><small><?= __('Modifier un type de structure') ?></small></h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"></h3><i style="color:red;float:right">(*) Champs obligatoires</i>
				</div>
				<?= $this->Form->create($st) ?>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-2"></div>
							<div class="col-xs-6">
								<div class="form-group">
									<label><?= __('Intitulé') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('sts_name_fr', ['label' => false, 'required' => true, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Intitulé']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Abréviation') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('sts_abrev', ['label' => false, 'required' => true, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Abréviation']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Description') ?></label>
									<?= $this->Form->control('sts_desc_fr', ['label' => false, 'class' => 'form-control', 'type' => 'textarea', 'placeholder' => 'Description']) ?>
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