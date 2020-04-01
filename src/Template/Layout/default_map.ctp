<?php $cakeDescription = 'CakePHP: the rapid development php framework'; ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?= $this->Html->charset() ?>
	<?php header('Access-Control-Allow-Origin: http://localhost:8080'); ?>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('others/bootstrap.min.css') ?>
    <?= $this->Html->css('font-awesome/css/font-awesome.min.css') ?>
    <?= $this->Html->css('others/ionicons.min.css') ?>
    <?= $this->Html->css('AdminLTE.min.css') ?>
	<?= $this->Html->css('skins/_all-skins.min.css') ?>
	<?= $this->Html->css('custom/fonts.googleapis.com.css') ?>
	<?= $this->Html->css('custom/jquery.gritter.css') ?>
	<?= $this->Html->script('custom/jquery') ?>	

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="skin-blue-light sidebar-mini" onload="">
	<div class="wrapper">
		<header class="main-header">
			<?= $this->element('Menus/_top_menu_map') ?>
		</header>
		<aside class="main-sidebar">
			<section class="sidebar">
				<?= $this->element('Menus/_slide_menu_map') ?>
			</section>
		</aside>
		<div class="content-wrapper" style="">
			<div class="hide"><?php echo $this->Flash->render(); ?></div>
			<?= $this->fetch('content') ?>
		</div>
		<footer class="main-footer">
			<div class="pull-right hidden-xs"><b>Version</b> 1.0</div>
			<strong>Copyright &copy; 2019 <a href="#">MINHDU</a>.</strong> All rights reserved.
		</footer>	
		<?= $this->Html->script('others/jquery.min') ?>
		<?= $this->Html->script('others/bootstrap.min') ?>
		<?= $this->Html->script('others/jquery.slimscroll.min') ?>
		<?= $this->Html->script('others/fastclick') ?>
		<?php echo $this->Html->script('adminlte'); ?>
		<?= $this->Html->script('others/icheck.min') ?>		
		
		
		<?= $this->Html->script('others/jquery.sparkline.min') ?>
	</div>
</body>
</html>