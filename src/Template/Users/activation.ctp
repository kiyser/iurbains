<div class="login-box" style="width:500px;">
	<div class="login-logo">
		<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display']) ?>" style="font-size:18px;"><b><?= __('GESTION DES ') ?><?= __('INDICATEURS URBAINS') ?></b></a>
	</div>
	<div class="login-box-body">
		<?php if($param == 0) { ?>
		<p class="login-box-msg" style="color:red;"><i class="fa fa-times"></i><br><?= __('ERREUR D\'ACTIVATION') ?><br><br>
		<p style="color:#777777;font-size:15px; text-align:justify;"><b><?php echo __('Les paramètres contenus dans le lien d\'activation que vous avez fournie sont inconnus.'); ?></b></p>
		<p style="color:#777777;font-size:15px;margin-top:5%"><?php echo __('Veuillez cliquer sur ce lien que vous avez reçu dans votre boîte mail pour activer votre compte.'); ?></p><br>
		<?php } else { ?>		
		<p class="login-box-msg" style="color:green;"><i class="fa fa-check"></i><br><?= __('COMPTE ACTIVE AVEC SUCCES') ?><br><br>
		<p style="color:#777777;font-size:15px"><b><?php echo __('Votre compte a été activé avec succès!'); ?></b></p><br>
		<?php } ?>		
		<a class="btn btn-primary" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>"><?= __('Se connecter') ?></a></p>
		<a class="btn btn-primary" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display']) ?>"><?= __('Retour à la page d\'accueil') ?></a></p>
	</div>
</div>