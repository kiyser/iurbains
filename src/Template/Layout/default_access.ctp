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

$cakeDescription = 'Plateforme de gestion des indicateurs urbains';
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
    <?= $this->Html->css('others/blue.css') ?>
    <?= $this->Html->css('AdminLTE.min.css') ?>
	<?= $this->Html->css('custom/fonts.googleapis.com.css') ?>
	<?= $this->Html->css('custom/jquery.gritter.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="hold-transition login-page">
	<?= $this->fetch('content') ?>
	
	<?= $this->Html->script('others/jquery.min') ?>
		<?= $this->Html->script('others/select2.full.min') ?>
	<?= $this->Html->script('others/bootstrap.min') ?>
	<?= $this->Html->script('others/icheck.min') ?>
	<script>
	  $(function () {
		$('input').iCheck({
		  checkboxClass: 'icheckbox_square-blue',
		  radioClass: 'iradio_square-blue',
		  increaseArea: '20%' /* optional */
		});
	  });
	</script>
</body>
</html>
