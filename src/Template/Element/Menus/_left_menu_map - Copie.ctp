<?php if($ui != null) { ?>
<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
		<ul data-widget="tree" class="sidebar-menu">
			<li class="header"><?= __('MENU PERSONNEL') ?></li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-dashboard"></i><span><?= __('Tableau de bord') ?></span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?= $this->Url->build(['controller' => 'Maps', 'action' => 'index']) ?>"><i class="fa fa-circle-o"></i><?= __(' Visualiser sur la carte') ?></a></li>
					<li><a href="<?= $this->Url->build(['controller' => 'Maps', 'action' => 'index']) ?>"><i class="fa fa-circle-o"></i><?= __(' Tableaux statistiques') ?></a></li>
				</ul>
			</li>			
			
			<?php if($ui->group->group_abrev == 'MA') { ?>
			<li class="header"><i class="fa fa-cogs"></i><span><?= __(' PARAMÉTRAGE') ?></span></li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-map"></i><span><?= __(' Gestion des localités') ?></span>
					<span class="pull-right-container"><span class="fa fa-angle-left pull-right"></span></span>
				</a>
				<ul class="treeview-menu">
					<li class="treeview">
						<a href="#"><i class="fa fa-circle-o"></i><?= __(' Régions') ?><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
						<ul class="treeview-menu">
							<li><a href="<?= $this->Url->build(['controller' => 'Regions', 'action' => 'index']) ?>"><i class="fa fa-circle-o"></i><?= __(' Afficher les régions') ?></a></li>
							<li><a href="<?= $this->Url->build(['controller' => 'Regions', 'action' => 'add']) ?>"><i class="fa fa-circle-o"></i><?= __(' Ajouter une région') ?></a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#"><i class="fa fa-circle-o"></i><?= __(' Département') ?><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
						<ul class="treeview-menu">
							<li><a href="<?= $this->Url->build(['controller' => 'Departments', 'action' => 'index']) ?>"><i class="fa fa-circle-o"></i><?= __(' Afficher les départements') ?></a></li>
							<li><a href="<?= $this->Url->build(['controller' => 'Departments', 'action' => 'add']) ?>"><i class="fa fa-circle-o"></i><?= __(' Ajouter un département') ?></a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#"><i class="fa fa-circle-o"></i><?= __(' Communes') ?><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
						<ul class="treeview-menu">
							<li><a href="<?= $this->Url->build(['controller' => 'Towns', 'action' => 'index']) ?>"><i class="fa fa-circle-o"></i><?= __(' Afficher les communes') ?></a></li>
							<li><a href="<?= $this->Url->build(['controller' => 'Towns', 'action' => 'add']) ?>"><i class="fa fa-circle-o"></i><?= __(' Ajouter une commune') ?></a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-briefcase"></i><span><?= __(' Gestion des structures') ?></span>
					<span class="pull-right-container">
						<span class="fa fa-angle-left pull-right"></span>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="treeview">
						<a href="#"><i class="fa fa-circle-o"></i><?= __(' Types de structures') ?><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
						<ul class="treeview-menu">
							<li><a href="<?= $this->Url->build(['controller' => 'Sts', 'action' => 'index']) ?>"><i class="fa fa-circle-o"></i><?= __(' Afficher les types de structure') ?></a></li>
							<li><a href="<?= $this->Url->build(['controller' => 'Sts', 'action' => 'add']) ?>"><i class="fa fa-circle-o"></i><?= __(' Ajouter un type de structure') ?></a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#"><i class="fa fa-circle-o"></i><?= __(' Structures') ?><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
						<ul class="treeview-menu">
							<li><a href="<?= $this->Url->build(['controller' => 'Structures', 'action' => 'index']) ?>"><i class="fa fa-circle-o"></i><?= __(' Afficher les structures') ?></a></li>
							<li><a href="<?= $this->Url->build(['controller' => 'Structures', 'action' => 'add']) ?>"><i class="fa fa-circle-o"></i><?= __(' Ajouter une structure') ?></a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-briefcase"></i><span><?= __(' Gestion des thèmes') ?></span>
					<span class="pull-right-container">
						<span class="fa fa-angle-left pull-right"></span>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="treeview">
						<a href="#"><i class="fa fa-circle-o"></i><?= __(' Domaines') ?><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
						<ul class="treeview-menu">
							<li><a href="<?= $this->Url->build(['controller' => 'Domains', 'action' => 'index']) ?>"><i class="fa fa-circle-o"></i><?= __(' Afficher les domaines') ?></a></li>
							<li><a href="<?= $this->Url->build(['controller' => 'Domains', 'action' => 'add']) ?>"><i class="fa fa-circle-o"></i><?= __(' Ajouter un domaine') ?></a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#"><i class="fa fa-circle-o"></i><?= __(' Thèmes') ?><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
						<ul class="treeview-menu">
							<li><a href="<?= $this->Url->build(['controller' => 'Themes', 'action' => 'index']) ?>"><i class="fa fa-circle-o"></i><?= __(' Afficher les thèmes') ?></a></li>
							<li><a href="<?= $this->Url->build(['controller' => 'Themes', 'action' => 'add']) ?>"><i class="fa fa-circle-o"></i><?= __(' Ajouter un thème') ?></a></li>
						</ul>
					</li>
				</ul>
			</li>
			<?php } ?>
			<?php if($ui->group->group_abrev == 'AD') { ?>
			<li class="header"><i class="fa fa-wrench"></i><span><?= __(' ADMINISTRATION') ?></span></li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-users"></i><span><?= __(' Groupes utilisateurs') ?></span>
					<span class="pull-right-container">
						<span class="fa fa-angle-left pull-right"></span>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?= $this->Url->build(['controller' => 'Groups', 'action' => 'index']) ?>"><i class="fa fa-circle-o"></i><?= __(' Afficher les groupes') ?></a></li>
					<li><a href="<?= $this->Url->build(['controller' => 'Groups', 'action' => 'add']) ?>"><i class="fa fa-circle-o"></i><?= __(' Ajouter un groupe') ?></a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-user"></i><span><?= __(' Utilisateurs') ?></span>
					<span class="pull-right-container">
						<span class="fa fa-angle-left pull-right"></span>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>"><i class="fa fa-circle-o"></i><?= __(' Afficher les utilisateurs') ?></a></li>
					<li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'add']) ?>"><i class="fa fa-circle-o"></i><?= __(' Ajouter un utilisateur') ?></a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-tasks"></i><span><?= __(' Permissions et rôles') ?></span>
					<span class="pull-right-container">
						<span class="fa fa-angle-left pull-right"></span>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?= $this->Url->build(['controller' => 'Acos', 'action' => 'index']) ?>"><i class="fa fa-circle-o"></i><?= __(' Afficher les rôles') ?></a></li>
					<li><a href="<?= $this->Url->build(['controller' => 'Acos', 'action' => 'edit']) ?>"><i class="fa fa-circle-o"></i><?= __(' Modifier les permissions') ?></a></li>
				</ul>
			</li>
			<li><a href="<?= $this->Url->build(['controller' => 'Inspectors', 'action' => 'index']) ?>"><i class="fa fa-tv"></i><span><?= __(' Gestion des logs') ?></span></a></li>
			<?php } ?>
			<?php if($ui->group->group_abrev == 'MA' || $ui->group->group_abrev == 'AS' || $ui->group->group_abrev == 'AV' || $ui->group->group_abrev == 'AP') { ?>
			<li class="header"><i class="fa fa-object-ungroup"></i><span><?= __(' MICROS DONNÉES') ?></span></li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-object-ungroup"></i><span><?= __(' Gestion des microdonnées') ?></span>
					<span class="pull-right-container">
						<span class="fa fa-angle-left pull-right"></span>
					</span>
				</a>
				<ul class="treeview-menu">
					<?php if($ui->group->group_abrev == 'MA') { ?><li><a href="<?= $this->Url->build(['controller' => 'Mdcs', 'action' => 'index']) ?>"><i class="fa fa-circle-o"></i><?= __(' Afficher les microdonnées') ?></a></li><?php } ?>
					<?php if($ui->group->group_abrev == 'MA') { ?><li><a href="<?= $this->Url->build(['controller' => 'Mdcs', 'action' => 'add']) ?>"><i class="fa fa-circle-o"></i><?= __(' Création des microdonnées') ?></a></li><?php } ?>
					<?php if($ui->group->group_abrev == 'MA') { ?><li><a href="<?= $this->Url->build(['controller' => 'Mdvs', 'action' => 'index']) ?>"><i class="fa fa-circle-o"></i><?= __(' Validation des données') ?></a></li><?php } ?>
					<?php if($ui->group->group_abrev == 'AS') { ?><li><a href="<?= $this->Url->build(['controller' => 'Mdvs', 'action' => 'index']) ?>"><i class="fa fa-circle-o"></i><?= __(' Édition des microdonnées') ?></a></li><?php } ?>
					<?php if($ui->group->group_abrev == 'AV') { ?><li><a href="<?= $this->Url->build(['controller' => 'Mdvs', 'action' => 'index']) ?>"><i class="fa fa-circle-o"></i><?= __(' Validation des microdonnées') ?></a></li><?php } ?>
					<?php if($ui->group->group_abrev == 'AP') { ?><li><a href="<?= $this->Url->build(['controller' => 'Mdvs', 'action' => 'index']) ?>"><i class="fa fa-circle-o"></i><?= __(' Publication des microdonnées') ?></a></li><?php } ?>
				</ul>
			</li>
			<?php if($ui->group->group_abrev == 'MA') { ?>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-archive"></i><span><?= __(' Gestion des versions') ?></span>
					<span class="pull-right-container">
						<span class="fa fa-angle-left pull-right"></span>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?= $this->Url->build(['controller' => 'Versions', 'action' => 'index']) ?>"><i class="fa fa-circle-o"></i><?= __(' Afficher les versions') ?></a></li>
					<li><a href="<?= $this->Url->build(['controller' => 'Versions', 'action' => 'add']) ?>"><i class="fa fa-circle-o"></i><?= __(' Ajouter une version') ?></a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-archive"></i><span><?= __(' Gestion des unités') ?></span>
					<span class="pull-right-container">
						<span class="fa fa-angle-left pull-right"></span>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?= $this->Url->build(['controller' => 'Units', 'action' => 'index']) ?>"><i class="fa fa-circle-o"></i><?= __(' Afficher les unités') ?></a></li>
					<li><a href="<?= $this->Url->build(['controller' => 'Units', 'action' => 'add']) ?>"><i class="fa fa-circle-o"></i><?= __(' Ajouter une unité') ?></a></li>
				</ul>
			</li>	
			<li class="header"><i class="fa fa-object-industry"></i><span><?= __(' INDICATEURS URBAINS') ?></span></li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-industry"></i><span><?= __(' Gestion des indicateurs') ?></span>
					<span class="pull-right-container">
						<span class="fa fa-angle-left pull-right"></span>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?= $this->Url->build(['controller' => 'Indicators', 'action' => 'index']) ?>"><i class="fa fa-circle-o"></i><?= __(' Afficher les indicateurs') ?></a></li>
					<li><a href="<?= $this->Url->build(['controller' => 'Indicators', 'action' => 'add']) ?>"><i class="fa fa-circle-o"></i><?= __(' Ajouter un indicateur') ?></a></li>
					<li><a href="<?= $this->Url->build(['controller' => 'Indicators', 'action' => 'visualisation']) ?>"><i class="fa fa-circle-o"></i><?= __(' Visualiser les indicateurs') ?></a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-industry"></i><span><?= __(' Gestion des opérandes') ?></span>
					<span class="pull-right-container">
						<span class="fa fa-angle-left pull-right"></span>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?= $this->Url->build(['controller' => 'Operands', 'action' => 'index']) ?>"><i class="fa fa-circle-o"></i><?= __(' Afficher les opérandes') ?></a></li>
					<li><a href="<?= $this->Url->build(['controller' => 'Operands', 'action' => 'add']) ?>"><i class="fa fa-circle-o"></i><?= __(' Ajouter une opérande') ?></a></li>
				</ul>
			</li>	
			<?php } ?>
			<?php } ?>
		</ul>
    </section>
</aside>
<?php } ?>