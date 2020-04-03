<section class="content-header">
	<h1><?= __('GESTION DES MICRODONNEES') ?><small><?= __('Modifier une microdonnées') ?></small></h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"></h3><i style="color:red;float:right">(*) Champs obligatoires</i>
				</div>
				<?= $this->Form->create($mdc) ?>
					<?= $this->Form->hidden('url', ['label' => false,'id'=>'url', 'value'=>$this->Url->build(['controller' => 'Domains', 'action' => 'listesliees']), 'hidden' => true]) ?>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-2"></div>
							<div class="col-xs-6">
								<div class="form-group">
									<label><?= __('Nom de la microdonnée') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('mdcs_name_fr', ['label' => false, 'required' => true, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Nom de la microdonnée']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Unité') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('unit_id', ['label' => false, 'required' => true, 'id'=>'theme', 'class' => 'form-control select2', 'options' => $units, 'empty' => '-- Sélectionner une unité --']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Thème') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('theme_id', ['label' => false, 'required' => true, 'id'=>'theme', 'onChange'=>'selectDomain();', 'class' => 'form-control select2', 'options' => $themes, 'empty' => '-- Sélectionner le thème --']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Domaine') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('domain_id', ['label' => false, 'required' => true, 'id'=>'domain', 'class' => 'form-control select2', 'options' => $domains, 'empty' => '-- Sélectionner le domaine --']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Type de microdonnée') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('mdcs_type', ['label' => false, 'class' => 'form-control', 'type'=>'select', 'options' => array('Numérique' => ' Numérique ')]) ?>
								</div>
								<div class="form-group">
									<label><?= __('Description') ?></label>
									<?= $this->Form->control('mdcs_desc_fr', ['label' => false, 'class' => 'form-control', 'type' => 'textarea']) ?>
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