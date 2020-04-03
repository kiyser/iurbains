/******************************************************** GESTION DES MICRODONNES ********************************************************/
function editMd(num) {
	$("#colVal"+num).removeClass('hide');
	$("#colSrc"+num).removeClass('hide');
	$("#colUni"+num).removeClass('hide');	
	$("#btnSave"+num).removeClass('hide');
	$("#btnCancel"+num).removeClass('hide');
	$("#btnEditMd"+num).addClass('hide');
}
function cancelMd(num) {
	$("#colVal"+num).addClass('hide');
	$("#colSrc"+num).addClass('hide');
	$("#colUni"+num).addClass('hide');	
	$("#btnSave"+num).addClass('hide');
	$("#btnCancel"+num).addClass('hide');
	$("#btnEditMd"+num).removeClass('hide');
}

function saveMd_Next(no,urlAction) {
	$('#btnSave'+no).on('click', function() {			
		$("#btnEditMd"+no).attr('disabled', true);
		//e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire	 
		if($('#valMd'+no).val() == "" || $('#srcMd'+no).val() == "" || $('#uniMd'+no).val() == ""){				
			$.gritter.add({
				title: '<i class="ace-icon fa fa-times bigger-110"></i> Formulaire incomplet</i>',
				text: 'Renseigner les champs obligatoires.',
				sticky: false,
				time: '8000',
				position: 'top-left',
				class_name: 'gritter-error'
			});
		}
		else{//alert($('#idMd'+no).val());
			$.ajax({// Envoi de la requête HTTP en mode asynchrone
				url: urlAction, // Le nom du fichier indiqué dans le formulaire
				type: "GET",//$('#formEditMd'+no).attr('method'), // La méthode indiquée dans le formulaire (get ou post)
				data: 'valMd=' + $('#valMd'+no).val() + '&srcMd=' + $('#srcMd'+no).val() + '&uniMd=' + $('#uniMd'+no).val() + '&idMd=' + $('#idMd'+no).val(), //$('#formEditMd'+no).serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
				success: function(data) { // Je récupère la réponse du fichier PHP
					//alert(data); // J'affiche cette réponse
					
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
						class_name: 'gritter-success'
					});	
				}
			});	
		}			
	});
}



/******************************************************** COMPETENCE ********************************************************/
function addRowForNewCompetence() {
	num = 1;
	condition = 1;
	while(num<=10 && condition == 1){
		if($('#rowCompetence'+num).hasClass('hide')){
			//$("#newRowForCompetence").attr('disabled','disabled');
			$("#rowCompetence"+num).removeClass('hide');
			condition = 0;
		}
		num = num + 1;
	}
}
function searchSectors_Next(no,urlAction) {
	$('#new_skills'+no).on('change', function(e) {
		e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire	 
		var $this = $(this); // L'objet jQuery du formulaire
		// Je récupère les valeurs
		var skills = $('#new_skills'+no).val();				
		$.ajax({// Envoi de la requête HTTP en mode asynchrone
			url: urlAction, // Le nom du fichier indiqué dans le formulaire
			type: "GET", // La méthode indiquée dans le formulaire (get ou post)
			data: "skills="+ skills, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
			success: function(data) { // Je récupère la réponse du fichier PHP
				//alert(data);
				$("#id_skills"+no).val(skills);//alert($("#id_skills"+no).val());
				$("#new_sectors"+no).empty().hide();
				$("#new_sectors"+no).append(data);
				$('#new_sectors'+no).fadeIn(1000);
			}
		});
	});
}
function addCompetence_Next(no,urlAction) {
	$('#formCompetence'+no).on('submit', function(e) {
		e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire	 
		skill = $('#new_skills'+no).val();
		sector = $('#new_sectors'+no).val();
		if(sector == null || skill == null){				
			$.gritter.add({
				title: '<i class="fa fa-times bigger-110"></i> Formulaire incomplet</i>',
				text: 'Renseigner les champs obligatoires.',
				sticky: false,
				time: '8000',
				position: 'top-left',
				class_name: 'gritter-error'
			});
		}
		else{//alert(sector);
			$.ajax({// Envoi de la requête HTTP en mode asynchrone
				url: urlAction, // Le nom du fichier indiqué dans le formulaire
				type: "GET",//$('#formCompetence'+no).attr('method'), // La méthode indiquée dans le formulaire (get ou post)
				data: 'sector=' + sector + '&skill=' + skill, //$('#formCompetence'+no).serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
				success: function(data) { // Je récupère la réponse du fichier PHP
					//alert(data); // J'affiche cette réponse
					$("#col"+no).empty();
					$("#col"+no).append(data);
					$("#M"+no).removeClass('hide');
					$("#S"+no).removeClass('hide');
					$("#A"+no).addClass('hide');
					$.gritter.add({
						title: '<i class="fa fa-check bigger-110"></i> Opération effectuée</i>',
						text: 'Vos compétences ont été enregistrées et votre CV a été mis à jour.',
						sticky: false,
						time: '8000',
						position: 'top-left',
						class_name: 'gritter-success'
					});			
				}
			});	
		}					
	});
}
function editCompetence_Next(no,urlAction,user,skill) {
	$('#formCompetence'+no).on('submit', function(e) {
		e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire	 
		sector = $('#new_sectors'+no).val();
		if(sector == null){				
			$.gritter.add({
				title: '<i class="ace-icon fa fa-times bigger-110"></i> Formulaire incomplet</i>',
				text: 'Renseigner les champs obligatoires.',
				sticky: false,
				time: '8000',
				position: 'top-left',
				class_name: 'gritter-error'
			});
		}
		else{
			$.ajax({// Envoi de la requête HTTP en mode asynchrone
				url: urlAction, // Le nom du fichier indiqué dans le formulaire
				type: "GET", // La méthode indiquée dans le formulaire (get ou post)
				data : 'sector=' + sector + '&user=' + user + '&skill=' + skill, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
				success: function(data) { // Je récupère la réponse du fichier PHP
					//alert(data); // J'affiche cette réponse
					$.gritter.add({
						title: '<i class="ace-icon fa fa-check bigger-110"></i> Opération effectuée</i>',
						text: 'Vos informations ont été enregistrées et votre CV a été mis à jour.',
						sticky: false,
						time: '8000',
						position: 'top-left',
						class_name: 'gritter-success'
					});		
				}
			});	/**/
		}					
	});
}
function deleteCompetence_Next(no,sector,user,urlAction) {//alert(no);
	$.ajax({// Envoi de la requête HTTP en mode asynchrone
		url: urlAction,
		type: "GET", // La méthode indiquée dans le formulaire (get ou post)
		data : 'sector=' + sector + '&user=' + user, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
		success: function(data) { // Je récupère la réponse du fichier PHP
			//alert(data); // J'affiche cette réponse
			$("#rowCompetence"+no).empty().hide();
			$.gritter.add({
				title: '<i class="ace-icon fa fa-check bigger-110"></i> Opération effectuée</i>',
				text: 'L\'enregistrement a été supprimée et votre CV a été mis à jour.',
				sticky: false,
				time: '8000',
				position: 'top-left',
				class_name: 'gritter-success'
			});		
		}
	});	
	$( "#dialog_message_delete" ).dialog( "close" );/**/	
}
/******************************************************** EXPERIENCE PROFESSIONNELLE ********************************************************/
function addRowForNewExperience() {
	num = 1;
	condition = 1;
	while(num<=10 && condition == 1){
		if($('#rowExperience'+num).hasClass('hide')){
			//$("#newRowForCompetence").attr('disabled','disabled');
			$("#rowExperience"+num).removeClass('hide');
			condition = 0;
		}
		num = num + 1;
	}
}
function addExperience_Next(no,urlAction) {
	$('#formExperience'+no).on('submit', function(e) {
		$("#addBtnExperience"+no).attr('disabled', true);
		e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire	 
		var intitule = $('#intitule'+no).val();
		var dd = $('#date_debut'+no).val();
		var df = $('#date_fin'+no).val();
		var statut = $('#statut'+no).val();
		if(intitule == "" || dd == "" || df == ""){				
			$.gritter.add({
				title: '<i class="ace-icon fa fa-times bigger-110"></i> Formulaire incomplet</i>',
				text: 'Renseigner les champs obligatoires.',
				sticky: false,
				time: '8000',
				position: 'top-left',
				class_name: 'gritter-error'
			});
		}
		else{//alert(dd);
			$.ajax({// Envoi de la requête HTTP en mode asynchrone
				url: urlAction, // Le nom du fichier indiqué dans le formulaire
				type: "GET",//$('#formExperience'+no).attr('method'), // La méthode indiquée dans le formulaire (get ou post)
				data: 'intitule=' + intitule + '&dd=' + dd + '&df=' + df + '&statut=' + statut, //$('#formExperience'+no).serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
				success: function(data) { // Je récupère la réponse du fichier PHP
					//alert(data); // J'affiche cette réponse
					$('#expID'+no).val(data);
					$("#editBtnExperience"+no).removeClass('hide');
					$("#deleteBtnExperience"+no).removeClass('hide');
					$("#addBtnExperience"+no).addClass('hide');
					$.gritter.add({
						title: '<i class="ace-icon fa fa-check bigger-110"></i> Opération effectuée</i>',
						text: 'Les données ont été enregistrées et votre CV a été mis à jour.',
						sticky: false,
						time: '8000',
						position: 'top-left',
						class_name: 'gritter-success'
					});	/**/		
				}
			});	
		}					
	});
}
function editExperience_Next(no,urlAction) {
	var intitule = $('#intitule'+no).val();
	var dd = $('#date_debut'+no).val();
	var df = $('#date_fin'+no).val();
	var statut = $('#statut'+no).val();
	if(intitule == "" || dd == "" || df == ""){				
		$.gritter.add({
			title: '<i class="ace-icon fa fa-times bigger-110"></i> Formulaire incomplet</i>',
			text: 'Renseigner les champs obligatoires.',
			sticky: false,
			time: '8000',
			position: 'top-left',
			class_name: 'gritter-error'
		});
	}
	else{
		$.ajax({// Envoi de la requête HTTP en mode asynchrone
			url: urlAction,
			type: "GET", // La méthode indiquée dans le formulaire (get ou post)
			data: 'intitule=' + intitule + '&dd=' + dd + '&df=' + df + '&statut=' + statut, //$('#formExperience'+no).serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
			success: function(data) { // Je récupère la réponse du fichier PHP
				//alert(data); // J'affiche cette réponse
				$.gritter.add({
					title: '<i class="ace-icon fa fa-check bigger-110"></i> Opération effectuée</i>',
					text: 'Les données ont été modifiées et votre CV a été mis à jour.',
					sticky: false,
					time: '8000',
					position: 'top-left',
					class_name: 'gritter-success'
				});	/**/		
			}
		});	
	}	
}
function deleteExperience_Next(no,urlAction) {
	id = $('#expID'+no).val();
	$.ajax({// Envoi de la requête HTTP en mode asynchrone
		url: urlAction,
		type: "GET", // La méthode indiquée dans le formulaire (get ou post)
		data: 'id=' + id,//$('#formExperience'+no).serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
		success: function(data) { // Je récupère la réponse du fichier PHP
			//alert(data); // J'affiche cette réponse
			$("#rowExperience"+no).empty().hide();
			$.gritter.add({
				title: '<i class="ace-icon fa fa-check bigger-110"></i> Opération effectuée</i>',
				text: 'L\'enregistrement a été supprimée et votre CV a été mis à jour.',
				sticky: false,
				time: '8000',
				position: 'top-left',
				class_name: 'gritter-success'
			});	/**/		
		}
	});	
	$( "#dialog_message_delete" ).dialog( "close" );
}
/******************************************************** FORMATIONS ********************************************************/
function addRowForNewTraining() {
	num = 1;
	condition = 1;
	while(num<=10 && condition == 1){
		if($('#rowTraining'+num).hasClass('hide')){
			//$("#newRowForCompetence").attr('disabled','disabled');
			//$("#intituleTra"+num, "#etablissement"+num, "#type_for"+num, "#mention"+num, "#annee_ob"+num).empty();
			$("#rowTraining"+num).removeClass('hide');
			condition = 0;
		}
		num = num + 1;
	}
}
function editTraining_Next(no,urlAction) {//alert($('#annee'+no).val());
	if($('#intituleTra'+no).val() == "" || $('#etablissement'+no).val() == "" || $('#type_for'+no).val() == "" || $('#mention'+no).val() == ""){			
		$.gritter.add({
			title: '<i class="ace-icon fa fa-times bigger-110"></i> Formulaire incomplet</i>',
			text: 'Renseigner les champs obligatoires.',
			sticky: false,
			time: '8000',
			position: 'top-left',
			class_name: 'gritter-error'
		});
	}
	else{
		$.ajax({// Envoi de la requête HTTP en mode asynchrone
			url: urlAction,
			type: "GET", // La méthode indiquée dans le formulaire (get ou post)
			data: 'intitule=' + $('#intituleTra'+no).val() + '&ets=' + $('#etablissement'+no).val() + '&type=' + $('#type_for'+no).val() + '&mention=' + $('#mention'+no).val() + '&annee=' + $('#annee'+no).val(), //$('#formTraining'+no).serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
			success: function(data) { // Je récupère la réponse du fichier PHP
				alert(data); // J'affiche cette réponse
				$.gritter.add({
					title: '<i class="ace-icon fa fa-check bigger-110"></i> Opération effectuée</i>',
					text: 'Les données ont été modifiées et votre CV a été mis à jour.',
					sticky: false,
					time: '8000',
					position: 'top-left',
					class_name: 'gritter-success'
				});	/**/		
			}
		});	
	}	
}
function deleteTraining_Next(no,urlAction) {
	id = $('#traID'+no).val();
	$.ajax({// Envoi de la requête HTTP en mode asynchrone
		url: urlAction,
		type: "GET", // La méthode indiquée dans le formulaire (get ou post)
		data: 'id=' + id,//$('#formTraining'+no).serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
		success: function(data) { // Je récupère la réponse du fichier PHP
			//alert(data); // J'affiche cette réponse
			$("#rowTraining"+no).empty().hide();
			$.gritter.add({
				title: '<i class="ace-icon fa fa-check bigger-110"></i> Opération effectuée</i>',
				text: 'L\'enregistrement a été supprimée et votre CV a été mis à jour.',
				sticky: false,
				time: '8000',
				position: 'top-left',
				class_name: 'gritter-success'
			});	/**/		
		}
	});	
}
/******************************************************** AUTRES INFORMATIONS ********************************************************/
function addAutresInfos_Next(urlAction) {
	$('#formAutresInfos').on('submit', function(e) {
		e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire	 
		var invo_exp = $('#invo_exp').val();
		var langue = $('#langues').val();
		var caracteristic = $('#caracteristique').val();
		if(invo_exp == ""){				
			$.gritter.add({
				title: '<i class="ace-icon fa fa-times bigger-110"></i> Formulaire incomplet</i>',
				text: 'Renseigner les champs obligatoires.',
				sticky: false,
				time: '8000',
				position: 'top-left',
				class_name: 'gritter-error'
			});
		}
		else{
			$.ajax({// Envoi de la requête HTTP en mode asynchrone
				url: urlAction, // Le nom du fichier indiqué dans le formulaire
				type: $('#formAutresInfos').attr('method'), // La méthode indiquée dans le formulaire (get ou post)
				data: $('#formAutresInfos').serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
				success: function(data) { // Je récupère la réponse du fichier PHP
					//alert(data); // J'affiche cette réponse
					$.gritter.add({
						title: '<i class="ace-icon fa fa-check bigger-110"></i> Opération effectuée</i>',
						text: 'Vos informations ont été enregistrées et votre CV a été mis à jour.',
						sticky: false,
						time: '8000',
						position: 'top-left',
						class_name: 'gritter-success'
					});	/**/		
				}
			});	
		}					
	});
}
/******************************************************** DOSSIER ATTACHE ********************************************************/
function addDossier_Next(urlAction){
	$('#formDossier').on('submit', function(e) {
		e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire
		table = $('#id-input-file-2').val().split('\\');
		//alert(table[table.length - 1]);
		if($('#id-input-file-2').val() == ""){
			$.gritter.add({
				title: '<i class="ace-icon fa fa-times bigger-110"></i> Formulaire incomplet</i>',
				text: 'Aucun fichier ajouté. Cliquer sur parcourir pour envoyer votre dossier.',
				sticky: false,
				time: '8000',
				position: 'top-left',
				class_name: 'gritter-error'
			});
		}
		else{
			$.ajax({// Envoi de la requête HTTP en mode asynchrone
				url: urlAction,
				type: "POST", // La méthode indiquée dans le formulaire (get ou post)
				data: $('#formDossier').serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
				//data: "dossier="+table[table.length - 1], // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
				//data: "dossier="+$('#id-input-file-2').val(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
				success: function(data) { // Je récupère la réponse du fichier PHP
					//alert(data); // J'affiche cette réponse
					$("#downloadFolder").empty();
					$("#downloadFolder").append(data);
					$('#downloadFolder').fadeIn(2000);
					$.gritter.add({
						title: '<i class="ace-icon fa fa-check bigger-110"></i> Opération effectuée</i>',
						text: 'L\'enregistrement a été supprimée et votre CV a été mis à jour.',
						sticky: false,
						time: '8000',
						position: 'top-left',
						class_name: 'gritter-success'
					});	/**/		
				}
			});
		}
	});
}