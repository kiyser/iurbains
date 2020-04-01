<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="flash-message-success" onclick="this.classList.add('hidden')" name="<?= $message ?>" id="flash_render_success">
	<div class="pull-right alert alert-success no-margin alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-label="close">
			<i class="fa fa-times"></i><span aria-hidden="true">&times;</span>
		</button>
		<i class="fa fa-check yellow"></i>
		<?= $message ?>
	</div>
</div>