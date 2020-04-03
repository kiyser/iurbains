<!-- GESTION DES UTILISATEURS -->
<div class="modal fade" id="popActivate">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?= __('CONFIRMER VOTRE ACTION') ?></h4>
			</div>
			<div class="modal-body">
				<p><?= __('Cet utilisateur est actuellement désactivé sur la plate-forme. Voulez-vous l\'activer ?') ?></p>
				<p><?php echo __('Cliquer sur '); ?><b><?php echo __('Confirmer '); ?></b><?php echo __('pour activer'); ?>.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?= __('Fermer') ?></button>
				<button type="button" class="btn btn-primary" onclick="actionActOrDesact()" data-dismiss="modal"><?= __('Confirmer') ?></button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="popDesactivate">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?= __('CONFIRMER VOTRE ACTION') ?></h4>
			</div>
			<div class="modal-body">
				<p><?= __('Cet utilisateur est actuellement activé sur la plate-forme. Voulez-vous le désactiver ?') ?></p>
				<p><?php echo __('Cliquer sur '); ?><b><?php echo __('Confirmer '); ?></b><?php echo __('pour désactiver'); ?>.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?= __('Fermer') ?></button>
				<button type="button" class="btn btn-primary" onclick="actionActOrDesact()" data-dismiss="modal"><?= __('Confirmer') ?></button>
			</div>
		</div>
	</div>
</div>
<!-- GESTION DES MICRO DONNEES -->
<div class="modal fade" id="popValidate">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?= __('CONFIRMER VOTRE ACTION') ?></h4>
			</div>
			<div class="modal-body">
				<p><?= __('La microdonnée que vous avez sélectionné va être validée.') ?></p>
				<p><?php echo __('Cliquer sur '); ?><b><?php echo __('Confirmer '); ?></b><?php echo __('pour valider'); ?>.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?= __('Fermer') ?></button>
				<button type="button" class="btn btn-primary" onclick="actionValOrNot()" data-dismiss="modal"><?= __('Confirmer') ?></button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="popInvalidate">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?= __('CONFIRMER VOTRE ACTION') ?></h4>
			</div>
			<div class="modal-body">
				<p><?= __('La microdonnée que vous avez sélectionné est actuellement validée. Voulez-vous annuler la validation?') ?></p>
				<p><?php echo __('Cliquer sur '); ?><b><?php echo __('Confirmer '); ?></b><?php echo __('pour annuler'); ?>.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?= __('Fermer') ?></button>
				<button type="button" class="btn btn-primary" onclick="actionValOrNot()" data-dismiss="modal"><?= __('Confirmer') ?></button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="popEditPub">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?= __('CONFIRMER VOTRE ACTION') ?></h4>
			</div>
			<div class="modal-body">
				<p><?= __('La microdonnée que vous avez sélectionné est actuellement publiée. Voulez-vous tout de même la modifier ?') ?></p>
				<p><?php echo __('Cliquer sur '); ?><b><?php echo __('Confirmer '); ?></b><?php echo __('pour annuler'); ?>.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?= __('Fermer') ?></button>
				<button type="button" class="btn btn-primary" onclick="actionEditPub()" data-dismiss="modal"><?= __('Confirmer') ?></button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="popPub">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?= __('CONFIRMER VOTRE ACTION') ?></h4>
			</div>
			<div class="modal-body">
				<p><?= __('La microdonnée que vous avez sélectionné va être publiée.') ?></p>
				<p><?php echo __('Cliquer sur '); ?><b><?php echo __('Confirmer '); ?></b><?php echo __('pour publier'); ?>.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?= __('Fermer') ?></button>
				<button type="button" class="btn btn-primary" onclick="actionPubOrNot()" data-dismiss="modal"><?= __('Confirmer') ?></button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="popDepub">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?= __('CONFIRMER VOTRE ACTION') ?></h4>
			</div>
			<div class="modal-body">
				<p><?= __('La microdonnée que vous avez sélectionné est actuellement validée. Voulez-vous annuler la validation?') ?></p>
				<p><?php echo __('Cliquer sur '); ?><b><?php echo __('Confirmer '); ?></b><?php echo __('pour annuler'); ?>.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?= __('Fermer') ?></button>
				<button type="button" class="btn btn-primary" onclick="actionPubOrNot()" data-dismiss="modal"><?= __('Confirmer') ?></button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="popMap1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?= __('INFORMATION') ?></h4>
			</div>
			<div class="modal-body">
				<p><?= __('Pour visualiser les microdonnées sur la carte, vous devez sélectionner un département ou une région') ?></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?= __('Fermer') ?></button>
			</div>
		</div>
	</div>
</div>