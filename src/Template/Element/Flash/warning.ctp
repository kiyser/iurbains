<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="flash-message-warning" onclick="this.classList.add('hidden')" name="<?= $message ?>" id="flash_render_warning">
	<div class="pull-left alert alert-warning no-margin alert-dismissable">
		<button type="button" class="close" data-dismiss="alert">
			<i class="ace-icon fa fa-times"></i>
		</button>
		<i class="ace-icon fa fa-check bigger-120 yellow"></i>
		<?= $message ?>
	</div>
</div>