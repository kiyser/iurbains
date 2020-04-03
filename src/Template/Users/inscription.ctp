<style>
	.error-message{color:red;}
</style>
<div class="login-box" style="width:450px; margin-top:2%;">
	<div class="" style="text-align:center">
		<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display']) ?>" style="font-size:15px;text-align:center"><b><?= __('PLATE-FORME WEBMAPPING POUR LA GESTION DES INDICATEURS URBAINS AU CAMEROUN') ?></b></a>
		
	</div>
	<div class="login-box-body" style="box-shadow: 0 0 8px rgba(0,0,0,0.5);">
		<?php 	echo $this->Html->image('ins.png',['style'=>'width:30px;height:30px','class'=>'']);	?>
		<?php 	echo $this->Html->image('minhdu.png',['style'=>'width:40px;height:40px','class'=>'pull-right']);	?>
		<p class="login-box-msg"><?= __('INSCRIPTION A LA PLATEFORME') ?></p>
		<?= $this->Form->create($user, array('method'=>'post', 'role'=>'form', 'url' => ['controller' => 'Users', 'action' => 'inscription'])) ?>
			<div class="form-group has-feedback">
				<?= $this->Form->control('lastname', ['label' => false, 'required' => true, 'class' => 'form-control', 'text' => 'text', 'placeholder' => 'Votre nom']) ?>
				<span class="fa fa-user form-control-feedback"><i style="color:red;padding-left:5px;">*</i></span>
			</div>					
			<div class="form-group has-feedback">
				<?= $this->Form->input('firstname', ['label' => false, 'class' => 'form-control', 'text' => 'text', 'placeholder' => 'Votre prénom']) ?>
				<span class="fa fa-user form-control-feedback"><i style="color:red;padding-left:12px;"></i></span>
			</div>					
			<div class="form-group has-feedback">
				<?= $this->Form->input('email', ['label' => false, 'required' => true, 'class' => 'form-control', 'required' => true, 'placeholder' => 'Votre email', 'type' => 'email']) ?>
				<span class="fa fa-envelope form-control-feedback"><i style="color:red;padding-left:5px;">*</i></span>
			</div>
			<div class="form-group has-feedback">
				<?= $this->Form->input('portable', ['label' => false, 'required' => true, 'class' => 'form-control', 'required' => true, 'placeholder' => 'Votre numéro de téléphone', 'type' => 'text']) ?>
				<span class="fa fa-phone form-control-feedback"><i style="color:red;padding-left:5px;">*</i></span>
			</div>
			<div class="form-group has-feedback">
				<?= $this->Form->input('adresse', ['label' => false, 'required' => true, 'class' => 'form-control', 'required' => true, 'placeholder' => 'Votre adresse', 'type' => 'text']) ?>
				<span class="fa fa-map-marker form-control-feedback"><i style="color:red;padding-left:5px;">*</i></span>
			</div>
			<div class="form-group has-feedback">
				<?= $this->Form->input('username', ['label' => false, 'required' => true, 'class' => 'form-control', 'text' => 'text', 'placeholder' => 'Identifiant de connexion']) ?>
				<span class="fa fa-user form-control-feedback"><i style="color:red;padding-left:5px;">*</i></span>
			</div>
			<div class="form-group has-feedback">
				<?= $this->Form->input('password', ['label' => false, 'required' => true, 'class' => 'form-control', 'text' => 'password', 'placeholder' => 'Mot de passe']) ?>
				<span class="fa fa-key form-control-feedback"><i style="color:red;padding-left:5px;">*</i></span>
			</div>
			<div class="form-group has-feedback">
				<?= $this->Form->input('confirm_password', ['label' => false, 'class' => 'form-control', 'required' => true, 'minlength' => 6, 'placeholder' => 'Confirmer le mot de passe', 'type' => 'password']) ?>
				<span class="fa fa-key form-control-feedback"><i style="color:red;padding-left:5px;">*</i></span>
			</div>
			<div class="form-group has-feedback" style="">			
				<label for="terms"><?= __('En vous inscrivant, vous acceptez ') ?><a href="javascript:void(0);" class="" data-toggle="modal" data-target="#modal-info"><?= __('la charte d\'utilisation') ?></a><?= __(' de la plateforme') ?>.</label>			
			</div>
			<div class="form-group has-feedback" style="">			
				<button type="submit" class="btn btn-primary pull-right"><?= __(' S\'inscrire') ?></button>			
			</div>
			<!-- /.col -->
		<?= $this->Form->end() ?><br><br>
		<a class="pull-left" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>"><?= __(' Déjà inscrit?') ?></a>
		<a class="pull-right"  href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display']) ?>"><i class="fa fa-home"></i><?= __(' Page d\'accueil') ?></a><br>
	</div>
</div>
<div class="modal modal-info fade" id="modal-info">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title"><?= __(' CLAUSES D\'UTILISATION DE LA PLATEFORME') ?></h4>
	  </div>
	  <div class="modal-body">
		<p><?= __(' Contenu') ?>&hellip;</p>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><?= __(' Fermer ') ?></button>
	  </div>
	</div>
  </div>
</div>

<?= $this->Html->script('custom/jquery-2.1.4.min') ?>
<?php echo $this->Html->script('custom/jquery-ui.min'); ?>
<?php echo $this->Html->script('custom/utils'); ?>
<?php echo $this->Html->script('custom/jquery.gritter.min'); ?>
<script language="javascript">
	$(document).ready(function() {
		$('.select2').select2();
	});
</script>