<?php if($ui != null){ ?>
<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display']) ?>" class="logo" style="">
	<span class="logo-mini"><b>I</b>U</span>
	<span class="logo-lg" style="font-size:15px;"><b><?= __('INDICATEURS') ?></b><?= __('URBAINS') ?></span>
</a>
<?php } ?>
<nav class="navbar navbar-static-top">
	<?php if($ui != null){ ?>
	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
		<span class="sr-only">Toggle navigation</span>
	</a>
	<?php }else{ ?>
	<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display']) ?>" class="navbar-brand" style="background:rgba(0,0,0,0.1)"><b><?= __('INDICATEURS') ?></b><?= __('URBAINS') ?></a>
	<?php } ?>
	<div class="navbar-custom-menu pull-left" style="font-size:12px;">
		<ul class="nav navbar-nav">
			<li><a href="<?php echo $this->Url->build(['controller' => 'Mdvs', 'action' => 'index']); ?>"><?= __('MICRODONNEES') ?></a></li>
			<li><a href="<?php echo $this->Url->build(['controller' => 'Indicators', 'action' => 'index']); ?>"><?= __('INDICATEURS URBAINS') ?></a></li>
			<li><a href="<?php echo $this->Url->build(['controller' => 'Maps', 'action' => 'index']); ?>"><?= __('CARTOTHEQUE') ?></a></li>
		</ul>
	</div>
	
	<div class="navbar-custom-menu">
		<ul class="nav navbar-nav">
			<?php if($ui != null) { ?>
			<li class="dropdown user user-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<?= $this->Html->image($ui->profil,['class'=>'user-image'])	?>
					<span class="hidden-xs"><?= $ui->lastname ?></span>
				</a>
				<ul class="dropdown-menu">
					<li class="user-header" style="height:auto;">
						<p>
							<?= $ui->group->group_name_fr ?>
							<small><?php if($ui->structure_id != null) $ui->structure->structure_name_fr; ?></small>
						</p>
						<div class="pull-right"></div>
					</li>
					<li class="user-footer">
						<div class="pull-left">
							<a href="<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'view', $ui->id]); ?>" class="btn btn-default btn-flat"><?= __('Profil') ?></a>
						</div>
						<div class="pull-right">
							<a href="<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'logout']); ?>" class="btn btn-default btn-flat"><?= __('Déconnexion') ?></a>
						</div>
					</li>
				</ul>
			</li>
			<?php } else { ?>
			<li class="dropdown user user-menu">
				<a href="<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'inscription']); ?>" class="btn" style="font-size:13px;">
					<span class="hidden-xs"><?= __('Inscription') ?></span>
				</a>
			</li>
			<li class="dropdown user user-menu">
				<a href="<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'login']); ?>" class="btn" style="font-size:13px;">
					<span class="hidden-xs"><?= __('Connexion') ?></span>
				</a>
			</li>
			<?php } ?>
		</ul>
	</div>
</nav>