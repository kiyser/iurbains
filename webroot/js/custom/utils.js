/********************************* GESTION DES MICRODONNES *********************************/
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

function setPermission_Next(controller, action, acl, url) {
	//alert(url);
	$.ajax({
		url: url,
		type: "GET",
		data: 'aro=' + $('#aro').val() + '&controller=' + controller + '&action=' + action + '&acl=' + acl, 
		success: function(data) { // Je récupère la réponse du fichier PHP
			alert(data); // J'affiche cette réponse
			if(data == 1){
				$("#btnDeny"+controller+action).removeClass('btn-danger');
				$("#faDeny"+controller+action).removeClass('fa-times');
				$("#faDeny"+controller+action).addClass('fa-check');
				$("#btnDeny"+controller+action).addClass('btn-success');
			}else{
				$("#btnAllow"+controller+action).removeClass('btn-success');
				$("#faAllow"+controller+action).removeClass('fa-check');
				$("#faAllow"+controller+action).addClass('fa-times');
				$("#btnAllow"+controller+action).addClass('btn-danger');
			}
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
function saveMd_Next(no,urlAction) {
	//alert(no);alert($('#idMdv'+no).val());
	$("#btnEditMd"+no).attr('disabled', true);
	$.ajax({
		url: urlAction,
		type: "GET",
		data: 'valMd=' + $('#valMd'+no).val() + '&srcMd=' + $('#srcMd'+no).val() + '&uniMd=' + $('#uniMd'+no).val() + '&year=' + $('#year').val() + '&idMd=' + $('#idMd'+no).val() + '&idMdv=' + $('#idMdv'+no).val() + '&region=' + $('#region').val() + '&department=' + $('#department').val() + '&town=' + $('#town').val(), //$('#formEditMd'+no).serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
		success: function(data) {
			$('#idMdv'+no).val(data);
			alert("Micro donnée éditée avec succès");
			$("#btnCancel"+no).addClass('hide');
			$("#btnSave"+no).addClass('hide');
			$("#btnMod"+no).removeClass('hide');
		}
	});
}	
function modMd_Next(no,urlAction) {
	//alert(no);alert($('#idMdv'+no).val());
	$.ajax({
		url: urlAction,
		type: "GET",
		data: 'valMd=' + $('#valMd'+no).val() + '&srcMd=' + $('#srcMd'+no).val() + '&uniMd=' + $('#uniMd'+no).val() + '&year=' + $('#year').val() + '&idMd=' + $('#idMd'+no).val() + '&idMdv=' + $('#idMdv'+no).val() + '&region=' + $('#region').val() + '&department=' + $('#department').val() + '&town=' + $('#town').val(), //$('#formEditMd'+no).serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
		success: function(data) {
			alert(data);
		}
	});
}

/********************************* GESTION DES THEMES ET DOMAINES *********************************/
/***** FONCTION DECLENCHEE 	APRES LE CHOIX DU THEME *****/
function selectDomain() {	
	$.ajax({
		url: $('#url').val(),
		type: "GET",
		data: "theme="+ $('#theme').val(),
		success: function(data) {
			//alert(data);
			$("#domain").attr('disabled', false);
			$("#domain").empty().hide();
			$("#domain").append(data);
			$('#domain').fadeIn(1000);
		}
	});
}
function selectDomain2() {	
	$.ajax({
		url: $('#url2').val(),
		type: "GET",
		data: "theme="+ $('#theme').val(),
		success: function(data) {
			//alert(data);
			$("#domain").attr('disabled', false);
			$("#domain").empty().hide();
			$("#domain").append(data);
			$('#domain').fadeIn(1000);
		}
	});
}
/********************************* GESTION DES REGIONS, DEPARTEMENTS ET COMMUNES *********************************/
/***** FONCTION DECLENCHEE 	APRES LE CHOIX D'UNE REGION *****/
function selectDepartment() {	
	$.ajax({
		url: $('#url').val(),
		type: "GET",
		data: "region="+ $('#region').val(),
		success: function(data) {
			//alert(data);
			$("#town").empty();
			$("#town").append('<option value="">-- Sélectionner une commune --</option>');
			
			$("#department").attr('disabled', false);
			$("#department").empty().hide();
			$("#department").append(data);
			$('#department').fadeIn(1000);
		}
	});
}
/***** FONCTION DECLENCHEE 	APRES LE CHOIX D'UN DEPARTEMENT *****/
function selectTown() {	
	$.ajax({
		url: $('#url').val(),
		type: "GET",
		data: "department="+ $('#department').val(),
		success: function(data) {
			//alert(data);
			$("#town").attr('disabled', false);
			$("#town").empty().hide();
			$("#town").append(data);
			$('#town').fadeIn(1000);
		}
	});
}
/***** FONCTION QUI DECLENCHE LA RECHERCHE APRES LE CHOIX D'UNE REGION OU D'UN DEPARTEMENT OU D'UNE COMMUNE *****/
function startGettingMdvs(){
		$.ajax({
			url: $('#url3').val(),
			type: "GET",
			data: 'region=' + $('#region').val() + '&department=' + $('#department').val() + '&town=' + $('#town').val() + '&theme=' + $('#theme').val() + '&domain=' + $('#domain').val() + '&version=' + $('#year').val(),
			success: function(data) {
				data = JSON.parse(data);
				console.log(data);
			}
		});
	}
/***** FONCTION QUI DECLENCHE LA RECHERCHE APRES LE CHOIX D'UNE REGION OU D'UN DEPARTEMENT OU D'UNE COMMUNE *****/
function searchMd() {
	document.getElementById("formSearch").submit(); 
}
/********************************* GESTION DES INDICATEURS *********************************/
/***** FONCTION DECLENCHEE 	APRES LE CHOIX DU THEME *****/
function selectIuTheme() {	
	$.ajax({
		url: $('#urlIu').val(),
		type: "GET",
		data: "theme="+ $('#theme').val(),
		success: function(data) {
			//alert(data);
			//$("#indicateurs").attr('disabled', false);
			$("#indicateurs").empty().hide();
			$("#indicateurs").append(data);
			$('#indicateurs').fadeIn(10);
		}
	});
}
function selectIuDomain() {	
	$.ajax({
		url: $('#urlIu').val(),
		type: "GET",
		data: "domain="+ $('#domain').val(),
		success: function(data) {
			//alert(data);
			//$("#indicateurs").attr('disabled', false);
			$("#indicateurs").empty().hide();
			$("#indicateurs").append(data);
			$('#indicateurs').fadeIn(10);
		}
	});
}
function selectIuVersion() {	
	$.ajax({
		url: $('#urlIu').val(),
		type: "GET",
		data: "version="+ $('#version').val(),
		success: function(data) {
			//alert(data);
			//$("#indicateurs").attr('disabled', false);
			$("#indicateurs").empty().hide();
			$("#indicateurs").append(data);
			$('#indicateurs').fadeIn(10);
		}
	});
}
function selectMicrodata() {	//alert($('#region').val());
	$.ajax({
		url: $('#urlMd').val(),
		type: "GET",
		data: 'theme=' + $('#theme').val() + '&domain=' + $('#domain').val() + '&region=' + $('#region').val() + '&department=' + $('#department').val() + '&town=' + $('#town').val() + '&version=' + $('#version').val(),
		success: function(data) {
			//alert(data);
			//$("#indicateurs").attr('disabled', false);
			$("#microdonnees").empty().hide();
			$("#microdonnees").append(data);
			$('#microdonnees').fadeIn(10);
		}
	});
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
////// FONCTION DE MISE A JOUR D'UNE REGION
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function editRegion(id) {
	jQuery.noConflict();	
	if($('#regionName'+id).val() == "" || $('#regionCity'+id).val() == "" || $('#regionAbrev'+id).val() == ""){
		$(document).ready(function() {
			$.gritter.add({
				text: 'Formulaire incomplet.',
				sticky: false,
				time: '8000',
				position: 'top-right',
				class_name: 'alert alert-danger'
			});
		});
	}else{
		$.ajax({
			url: $('#urlRegion').val(),
			type: "GET",
			data: 'regionName=' + $('#regionName'+id).val() + '&regionCity=' + $('#regionCity'+id).val() + '&regionAbrev=' + $('#regionAbrev'+id).val() + '&idRegion=' + $('#idRegion'+id).val(),
			success: function(data) {
				msg = 'Mise à jour effectuée avec succès.';
				classe = 'alert alert-success';
				if(data == 0){
					msg = 'Echec de mise à jour de la région. Veuillez recommencer plutard';
					classe = 'alert alert-danger';
				}
				$(document).ready(function() {
					$.gritter.add({
						text: msg,
						sticky: false,
						time: '8000',
						position: 'top-right',
						class_name: classe
					});
				});
			}
		});
	}
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
////// FONCTION DE MISE A JOUR D'UN DEPARTEMENT
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function editDepartment(id) {
	jQuery.noConflict();	
	if($('#deptName'+id).val() == ""){
		$(document).ready(function() {
			$.gritter.add({
				text: 'Formulaire incomplet.',
				sticky: false,
				time: '8000',
				position: 'top-right',
				class_name: 'alert alert-danger'
			});
		});
	}else{
		$.ajax({
			url: $('#urlDepartment').val(),
			type: "GET",
			data: 'deptName=' + $('#deptName'+id).val() + '&deptCity=' + $('#deptCity'+id).val() + '&regionId=' + $('#regionId'+id).val() + '&idDept=' + $('#idDept'+id).val(),
			success: function(data) {
				msg = 'Mise à jour effectuée avec succès.';
				classe = 'alert alert-success';
				if(data == 0){
					msg = 'Echec de mise à jour du département. Veuillez recommencer plutard';
					classe = 'alert alert-danger';
				}
				$(document).ready(function() {
					$.gritter.add({
						text: msg,
						sticky: false,
						time: '8000',
						position: 'top-right',
						class_name: classe
					});
				});
			}
		});
	}
}
/***** FONCTION  *****/
function initNo() {
	if($('#valMd1').val() != '') return 1;	if($('#valMd2').val() != '') return 2;	if($('#valMd3').val() != '') return 3;	if($('#valMd4').val() != '') return 4;
	if($('#valMd5').val() != '') return 5;	if($('#valMd6').val() != '') return 6;	if($('#valMd7').val() != '') return 7;	if($('#valMd8').val() != '') return 8;
	if($('#valMd9').val() != '') return 9;	if($('#valMd10').val() != '') return 10;	if($('#valMd11').val() != '') return 11;	if($('#valMd12').val() != '') return 12;
	if($('#valMd13').val() != '') return 13;	if($('#valMd14').val() != '') return 14;	if($('#valMd15').val() != '') return 15;	if($('#valMd16').val() != '') return 16;
	if($('#valMd17').val() != '') return 17;	if($('#valMd18').val() != '') return 18;	if($('#valMd19').val() != '') return 19;	if($('#valMd20').val() != '') return 20;
}