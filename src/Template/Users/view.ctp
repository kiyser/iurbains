<section class="content-header">
	<h1><?= __('GESTION DES UTILISATEURS') ?><small><?= __('Profil') ?></small></h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-3">
			<div class="box box-primary">
				<div class="box-body box-profile">
					<?= $this->Html->image($ui->profil,['class'=>'profile-user-img img-responsive img-circle'])	?>
					<h3 class="profile-username text-center"><?= h($user->lastname).' '.h($user->firstname) ?></h3>
					<p class="text-muted text-center"><?= $user->group->group_name_fr ?></p>
					<a href="<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'edit', $user->id]); ?>" class="btn btn-primary btn-block"><b><?= __('Mise à jour') ?></b></a>
				</div>
			</div>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><?= __('A propos de moi') ?></h3>
				</div>
				<div class="box-body">
					<strong><i class="fa fa-map-marker margin-r-5"></i><?= __('Adresse') ?></strong>
					<p class="text-muted"><?= $user->adresse ?></p>
					<hr>
					<strong><i class="fa fa-envelope margin-r-5"></i> <?= __('E-mail') ?></strong>
					<p class="text-muted"><?= $user->email ?></p>
					<hr>
					<strong><i class="fa fa-phone margin-r-5"></i> <?= __('Téléphone') ?></strong>
					<p class="text-muted"><?= $user->portable ?></p>
				</div>
          </div>
        </div>
		<div class="col-md-9">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#activity" data-toggle="tab" aria-expanded="false"><?= __('Activités') ?></a></li>
					<li class=""><a href="#compte" data-toggle="tab" aria-expanded="false"><?= __('Compte utilisateur') ?></a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="activity">
						
					</div>
					<div class="tab-pane" id="compte">
						
					</div>
				</div>
          </div>
        </div>
	</div>
</section><?php echo $this->Html->script('custom/jquery-2.1.4.min'); ?>
<?php echo $this->Html->script('custom/jquery.gritter.min'); ?>
<?php echo $this->Html->script('custom/jquery-ui.min'); ?>
<script language="javascript">	
	jQuery(function($) {
		$("#flash_render_info").show(function() {
			$.gritter.add({
				text: $(this).attr("name"),
				sticky: false,
				time: '8000',
				position: 'top-left',
				class_name: 'alert alert-info'
			});
			return false;
		});
		$("#flash_render_success").show(function() {
			$.gritter.add({
				text: $(this).attr("name"),
				sticky: false,
				time: '8000',
				position: 'top-right',
				class_name: 'alert alert-success'
			});
			return false;
		});
	});
</script>