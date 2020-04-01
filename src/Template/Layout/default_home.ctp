<?php	$description = 'Plate-forme webmapping pour la gestion des indicateurs urbains au Cameroun';	?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
    <?= $this->Html->charset() ?>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>
        <?= $description ?>:
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
	
	<?= $this->Html->css('sentra/bootstrap-theme.min.css') ?>
	<?= $this->Html->css('sentra/light-box.css') ?>
	<?= $this->Html->css('sentra/owl-carousel.css') ?>
	<?= $this->Html->css('sentra/templatemo-style.css') ?>
	

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
	<?= $this->Html->script('custom/jquery') ?>
	
</head>
<body class="fixed hold-transition skin-blue sidebar-collapse">
	<div class="wrapper">
		<header class="main-header">
			<?= $this->element('Menus/_top_menu_home') ?>
		</header>
        <div class="slider">
			<div class="" id="menu">
				<div class="geoname">
					<h2 style="color:#3C8DBC;font-size: 60px;">
					Géo<span style="font-weight: normal;color: #fff"><?= __('Portail') ?></span>
					</h2>
					<p style="font-size:40px;font-weight: 300;"><?= __('Plate-forme de gestion des indicateurs urbains au Cameroun') ?></p>
				</div>
				<div class="Modern-Slider content-section" id="top">
					<div class="item item-1">
						<div class="img-fill">
						<div class="image"></div>
						<div class="info">
							<div>
							  <h1>Beautiful Template Sentra</h1>
							</div>
							</div>
						</div>
					</div>
					<div class="item item-2">
						<div class="img-fill">
							<div class="image"></div>
							<div class="info">
							<div>
							  <h1>Please tell your friends</h1>
							</div>
							</div>
						</div>
					</div>
					<div class="item item-3">
						<div class="img-fill">
							<div class="image"></div>
							<div class="info">
							<div>
							  <h1>Suspendisse suscipit nulla sed</h1>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>

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
		<?= $this->Html->script('adminlte.min') ?>
		<?= $this->Html->script('demo') ?>
		
		<?= $this->Html->script('others/jquery.sparkline.min') ?>
		<?= $this->Html->script('sentra/modernizr-2.8.3-respond-1.4.2.min') ?>
		<?= $this->Html->script('sentra/plugins') ?>
		<?= $this->Html->script('sentra/main') ?>
	</div>
	<style>
		.navbar-nav > li > a{
			padding-bottom:14px;
		}
		.geoname{
			outline: none;
			position: absolute;
			width: 100%;
			top: 270px;
			font-weight: normal;
			text-shadow: 0 2px 24px #404040eb;
			font-family: 'Open Sans', sans-serif;
			/*
			height: 50px;
			background: rgba(0,0,0,.50);
			margin-top: -22.5px;
			right: 120px;
			*/
			border: 0 none;
			text-align: center;
			font-size: 60px;
			z-index: 5;
			color:#FFF;
		}
	</style>
	<script>
        // Hide Header on on scroll down
        var didScroll;
        var lastScrollTop = 0;
        var delta = 5;
        var navbarHeight = $('header').outerHeight();

        $(window).scroll(function(event){
            didScroll = true;
        });

        setInterval(function() {
            if (didScroll) {
                hasScrolled();
                didScroll = false;
            }
        }, 250);

        function hasScrolled() {
            var st = $(this).scrollTop();
            
            // Make sure they scroll more than delta
            if(Math.abs(lastScrollTop - st) <= delta)
                return;
            
            // If they scrolled down and are past the navbar, add class .nav-up.
            // This is necessary so you never see what is "behind" the navbar.
            if (st > lastScrollTop && st > navbarHeight){
                // Scroll Down
                $('header').removeClass('nav-down').addClass('nav-up');
            } else {
                // Scroll Up
                if(st + $(window).height() < $(document).height()) {
                    $('header').removeClass('nav-up').addClass('nav-down');
                }
            }
            
            lastScrollTop = st;
        }
    </script>
</body>
</html>