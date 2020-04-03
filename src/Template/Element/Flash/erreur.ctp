<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>

<div class="col-sm-10 floatright kl-icon.icon-klmid" style="color:red;padding:0px" onclick="this.classList.add('hidden');">
	<div class="ib2-style2 ib2-text-color-light-theme" style="background-color:#fff;">
		<div class="ib2-inner" style="padding:1%;margin-top:-0.3%;border-left:4px solid rgb(255, 0, 0);">
			<div class="ib2-content">
				<div class="message error" name="<?= $message ?>" style="min-height:45px;"><?= $message ?></div>
			</div>
		</div>
	</div>					
</div>