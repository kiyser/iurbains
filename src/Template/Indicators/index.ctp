<?php
	if($ui != null && $ui->group->group_abrev == 'MA') echo $this->element('Indicators/connected');
	else echo $this->element('Indicators/guest');
?>
<style>
	.col-xs-12{
		padding-left:0px;
		padding-right:0px;
	}
	.box{
		margin-bottom:0px;
	}
	.box-header.with-border {
		border-bottom: 1px solid 
		#ccc;
	}
</style>
<?php echo $this->Html->script('custom/jquery-2.1.4.min'); ?>
<?php echo $this->Html->script('custom/jquery.gritter.min'); ?>
<?php echo $this->Html->script('custom/jquery-ui.min'); ?>
<?php echo $this->Html->script('custom/utils'); ?>
<script language="javascript">
	$(document).ready(function() {
		$('.select2').select2();
	});
</script>