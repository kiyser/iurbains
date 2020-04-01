jQuery(function($) {
	////// ENREGISTREMENT D'UNE MICRODONNEE
	$('#btnSave1, #btnSave2, #btnSave3, #btnSave4, #btnSave5, #btnSave6, #btnSave7, #btnSave8, #btnSave9, #btnSave10, #btnSave11, #btnSave12, #btnSave13, #btnSave14, #btnSave15, #btnSave16, #btnSave17, #btnSave18, #btnSave19, #btnSave20').on('click', function(e){
		e.preventDefault();
		no = initNo();
		if($('#valMd'+no).val() == "" || $('#srcMd'+no).val() == "" || $('#uniMd'+no).val() == ""){		
			$.gritter.add({
				title: '<i class="ace-icon fa fa-times bigger-110"></i> Formulaire incomplet</i>',
				text: 'Renseigner les champs obligatoires.',
				sticky: false,
				time: '8000',
				position: 'top-left',
				class_name: 'alert gritter-error'
			});
		}
		else{
			$.ajax({// Envoi de la requête HTTP en mode asynchrone
				url: "<?php echo $this->Url->build(['controller' => 'Mdvs', 'action' => 'edition']); ?>", // Le nom du fichier indiqué dans le formulaire
				type: "GET",//$('#formEditMd'+no).attr('method'), // La méthode indiquée dans le formulaire (get ou post)
				data: 'valMd=' + $('#valMd'+no).val() + '&srcMd=' + $('#srcMd'+no).val() + '&uniMd=' + $('#uniMd'+no).val() + '&idMd=' + $('#idMd'+no).val() + '&region=' + $('#region').val() + '&department=' + $('#department').val() + '&town=' + $('#town').val(), //$('#formEditMd'+no).serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
				success: function(data) { // Je récupère la réponse du fichier PHP
					alert(data); // J'affiche cette réponse						
					$("#btnCancel"+no).addClass('hide');
					$("#btnSave"+no).addClass('hide');
					$("#btnMod"+no).removeClass('hide');
					$("#btnDel"+no).removeClass('hide');
					$.gritter.add({
						title: '<i class="ace-icon fa fa-check bigger-110"></i> Opération effectuée</i>',
						text: 'Les données ont été enregistrées et votre CV a été mis à jour.',
						sticky: false,
						time: '8000',
						position: 'top-left',
						class_name: 'alert gritter-success'
					});	
				}
			});
		}
	});
});
/***** FONCTION  *****/
function initNo() {
	if($('#valMd1').val() != '') return 1;	if($('#valMd2').val() != '') return 2;	if($('#valMd3').val() != '') return 3;	if($('#valMd4').val() != '') return 4;
	if($('#valMd5').val() != '') return 5;	if($('#valMd6').val() != '') return 6;	if($('#valMd7').val() != '') return 7;	if($('#valMd8').val() != '') return 8;
	if($('#valMd9').val() != '') return 9;	if($('#valMd10').val() != '') return 10;	if($('#valMd11').val() != '') return 11;	if($('#valMd12').val() != '') return 12;
	if($('#valMd13').val() != '') return 13;	if($('#valMd14').val() != '') return 14;	if($('#valMd15').val() != '') return 15;	if($('#valMd16').val() != '') return 16;
	if($('#valMd17').val() != '') return 17;	if($('#valMd18').val() != '') return 18;	if($('#valMd19').val() != '') return 19;	if($('#valMd20').val() != '') return 20;
}