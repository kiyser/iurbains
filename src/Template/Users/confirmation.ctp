<div class="login-box" style="width:500px;">
	<div class="login-logo">
		<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display']) ?>" style="font-size:18px;"><b><?= __('GESTION DES ') ?><?= __('INDICATEURS URBAINS') ?></b></a>
	</div>
	<div class="login-box-body">
		<p class="login-box-msg" style="color:green;"><i class="fa fa-check"></i><br><?= __('CONFIRMATION DE VOTRE INSCRIPTION') ?><br><br>
		<p style="color:#777777;font-size:15px; text-align:justify;"><b><?php echo __('Un lien d’activation sera envoyé à l’adresse mail que vous avez fournie. Veuillez cliquer sur ce lien pour activer le compte que vous venez de créer sur la plate-forme de gestion des indicateurs urbains.'); ?></b></p>
		<br>
		<a class="btn btn-primary pull-center" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display']) ?>"><?= __('Retour à la page d\'accueil') ?></a></p>
	</div>
</div>