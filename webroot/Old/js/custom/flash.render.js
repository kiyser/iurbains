$(document).ready(function() {
	/* 
	$.extend($.gritter.options, {
		class_name: 'gritter-light', // for light notifications (can be added directly to $.gritter.add too)
		position: 'bottom-left', // possibilities: bottom-left, bottom-right, top-left, top-right
		fade_in_speed: 100, // how fast notifications fade in (string or int)
		fade_out_speed: 100, // how fast the notices fade out
		time: 3000 // hang on the screen for...
	});
	*/
	$("#flash_render_success").show(function() {
		$.gritter.add({
			title: '<i class="ace-icon fa fa-check bigger-110"></i> Opération effectuée</i>',
			text: $(this).attr("name"),
			sticky: false,
			time: '8000',
			position: 'bottom-left',
			class_name: 'gritter-success'
		});
		return false;
	});
	$("#flash_render_error").show(function() {
		$.gritter.add({
			title: '<i class="ace-icon fa fa-times bigger-110"></i> Echec d\'enregistrement</i>',
			text: $(this).attr("name"),
			sticky: false,
			time: '8000',
			position: 'top-left',
			class_name: 'gritter-error'
		});
		return false;
	});
	$("#flash_render_info").show(function() {
		$.gritter.add({
			title: '<i class="ace-icon fa fa-check bigger-120"></i> Connecté avec succès </i>',
			text: $(this).attr("name"),
			sticky: false,
			time: '8000',
			position: 'top-left',
			class_name: 'gritter-info'
		});
		return false;
	});
});