<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message error" onclick="this.classList.add('hidden');" name="<?= $message ?>" id="flash_render_error">
	<i class="ace-icon fa fa-warning bigger-120 yellow"></i>
	<?= $message ?>
</div>
<!-- 	<div class="pull-left alert alert-danger no-margin alert-dismissable">
		<button type="button" class="close" data-dismiss="alert">
			<i class="ace-icon fa fa-times"></i>
		</button>
		<i class="ace-icon fa fa-times bigger-120 red"></i>
		
	</div> -->
