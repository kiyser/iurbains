<section class="content-header">
	<h1><?= __('GESTION DES UTILISATEURS') ?><small><?= __('Ajouter un utilisateur') ?></small></h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"></h3><i style="color:red;float:right">(*) Champs obligatoires</i>
				</div>
				<?= $this->Form->create($user) ?>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-2"></div>
							<div class="col-xs-6">
								<div class="form-group">
									<label><?= __('Civilité') ?></label><i style="color:red;">*</i>
									<?= $this->Form->input('civilite',[
															'type'=>'radio',
															'options'=>[
																['value'=>'1', 'text'=>__(' Monsieur ')],
																['value'=>'0', 'text'=>__(' Madame ')]
															],
															'required'=>true,
															'label'=>false
														  ])
														?>
								</div>
								<div class="form-group">
									<label><?= __('Nom') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('lastname', ['label' => false, 'required' => true, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Nom de l\'utilisateur']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Prénom') ?></label>
									<?= $this->Form->control('firstname', ['label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Prénom de l\'utilisateur']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Groupe utilisateur') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('group_id', ['label' => false, 'required' => true, 'class' => 'form-control select2', 'options' => $groups, 'empty' => true, 'empty' => 'Sélectionner le groupe']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Structure de l\'utilisateur') ?></label>
									<?= $this->Form->control('structure_id', ['label' => false, 'class' => 'form-control select2', 'options' => $structures, 'empty' => true, 'empty' => 'Sélectionner la structure']) ?>
								</div>				
								<div class="form-group">
									<label><?= __('Numéro de téléphone') ?></label>
									<?= $this->Form->control('portable', ['label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Numéro de téléphone']) ?>
								</div>				
								<div class="form-group">
									<label><?= __('Adresse') ?></label>
									<?= $this->Form->control('adresse', ['label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Adresse']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Email de l\'utilisateur') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('email', ['label' => false, 'required' => true, 'class' => 'form-control', 'type' => 'email', 'placeholder' => 'Email de l\'utilisateur']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Identifiant de connexion') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('username', ['label' => false, 'required' => true, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Identifiant de connexion']) ?>
								</div>
								<div class="form-group">
									<label><?= __('Mot de passe par défaut') ?></label><i style="color:red;">*</i>
									<?= $this->Form->control('password', ['label' => false, 'required' => true, 'class' => 'form-control', 'type' => 'password', 'placeholder' => 'Mot de passe par défaut']) ?>
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