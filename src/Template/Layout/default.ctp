<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('others/bootstrap.min.css') ?>
    <?= $this->Html->css('font-awesome/css/font-awesome.min.css') ?>
    <?= $this->Html->css('others/ionicons.min.css') ?>
    <?= $this->Html->css('others/select2.min.css') ?>
    <?= $this->Html->css('AdminLTE.min.css') ?>
	<?= $this->Html->css('skins/_all-skins.min.css') ?>
	<?= $this->Html->css('custom/fonts.googleapis.com.css') ?>
	<?= $this->Html->css('custom/jquery.gritter.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
	<?= $this->Html->script('custom/jquery') ?>	
</head>
<?php if($ui != null){ ?>
	<body class="hold-transition skin-blue layout-boxed sidebar-mini">
<?php }else{ ?>
<body class="layout-top-nav skin-blue layout-boxed">
<?php } ?>
	<div class="wrapper">
		<header class="main-header">
			<?= $this->element('Menus/_top_menu') ?>
		</header>
		<?php if($ui != null){ ?>
		<aside class="main-sidebar">
			<section class="sidebar">
				<?= $this->element('Menus/_left_menu') ?>
			</section>
		</aside>
		<?php } ?>
		<div class="content-wrapper">
			<div class="hide"><?php echo $this->Flash->render(); ?></div>
			<?= $this->fetch('content') ?>
		</div>
		<footer class="main-footer">
			<div class="pull-right hidden-xs"><b>Version</b> 1.0</div>
			<strong>Copyright &copy; 2019 <a href="#">MINHDU</a>.</strong> All rights reserved.
		</footer>
		
		<div class="control-sidebar-bg11"></div>
		
		<?= $this->Html->script('others/jquery.min') ?>
		<?= $this->Html->script('others/select2.full.min') ?>
		<?= $this->Html->script('others/jquery.slimscroll.min') ?>
		<?= $this->Html->script('others/fastclick') ?>
		<?= $this->Html->script('others/bootstrap.min') ?>
		<?= $this->Html->script('adminlte.min') ?>
		<?= $this->Html->script('demo') ?>
		
		<?= $this->Html->script('custom/jquery.gritter.min') ?>
		<?= $this->Html->script('custom/jquery-2.1.4.min') ?>		
		<?= $this->Html->script('custom/jquery-ui.min') ?>
		
		<?= $this->Html->script('others/jquery.inputmask') ?>		
		<?= $this->Html->script('others/jquery.inputmask.extensions') ?>
		<?= $this->Html->script('others/icheck.min') ?>		
	</div>
	<!-- ./wrapper -->
</body>
</html>
