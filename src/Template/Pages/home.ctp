<div class="">
    <section class="content-header"></section>
    <section class="content">
		<div id="about">
			<div class="">
				<h1>Featured<br><em>Places</em></h1>
				<p>Praesent pellentesque efficitur magna, 
				<br>sed pellentesque neque malesuada vitae.</p>
			</div>
		</div>
		<div id="microdata">
			<div class="">
				<h1>Recent<br><em>Projects</em></h1>
				<p>Praesent pellentesque efficitur magna, 
				<br>sed pellentesque neque malesuada vitae.</p>
			</div>
		</div>
		<div id="indicators">
			<div class="">
				<h1>This is a <em>company</em> presentation.</h1>
				<p>Praesent pellentesque efficitur magna, sed pellentesque neque malesuada vitae.</p>
			</div>
		</div>
		<div id="cartotheque">
			<div class="">
				<h1>Blog<br><em>Entries</em></h1>
				<p>Curabitur hendrerit mauris mollis ipsum vulputate rutrum. 
				<br>Phasellus luctus odio eget dui imperdiet.</p>
			</div>
		</div>
	</section>
</div>
<?php echo $this->Html->script('custom/jquery-2.1.4.min'); ?>
<?php echo $this->Html->script('custom/jquery.gritter.min'); ?>
<?php echo $this->Html->script('custom/jquery-ui.min'); ?>	
<script type="text/javascript">
	jQuery(function($) {
		$("#flash_render_info").show(function() {
			$.gritter.add({
				text: $(this).attr("name"),
				sticky: false,
				time: '8000',
				position: 'top-right',
				class_name: 'alert alert-info'
			});
			return false;
		});
	});
</script>
