/*********************************************** LISTES LIEES(THEME, DOMAINS, REGION, DEPARTEMENT, COMMUNE) ****************************************/
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
function onChangeCountry() {
	if($('#country').val() !=37){
		$("#region, #departement, #arrondissement").empty();
		$("#region, #departement, #arrondissement").append('<option value="0">-- Aucune donnée --</option>');
		$("#region, #departement, #arrondissement, #quater, #quartier").attr('disabled', true);
	}
	else{
		$("#region, #departement, #arrondissement, #quater, #quartier").removeAttr('disabled');
		$("#region").attr('required', true);
		$("#departement").empty();
		$("#arrondissement").empty();
		$("#departement").append('<option value="">-- Aucune donnée --</option>');
		$("#arrondissement").append('<option value="">-- Aucune donnée --</option>');
		if($('#quater').val() != "") $("#quartier").attr('disabled', true);
		$.ajax({
			url: $('#url').val(),
			type: "GET",
			data: "pays="+ $('#country').val(),
			success: function(data) { 
				$("#region").empty().hide();
				$("#region").append(data);
				$('#region').fadeIn(1000);
			}
		});
	}
}
/***** FONCTION DECLENCHEE 	APRES LE CHOIX DE LA REGION *****/
function selectRegion() {	
	$.ajax({
		url: $('#url').val(),
		type: "GET",
		data: "region="+ $('#region').val(),
		success: function(data) {
			///alert(data);
			$("#department").attr('disabled', false);
			$("#department").empty().hide();
			$("#department").append(data);
			$('#department').fadeIn(1000);
		}
	});
}
/***** FONCTION DECLENCHEE 	APRES LE CHOIX DU DEPARTEMENT *****/
function onSelectDepartement() {//alert($('#departement').val());
	$.ajax({
		url: $('#url').val(),
		type: "GET",
		data: "departement="+ $('#departement').val(),
		success: function(data) {
			$("#arrondissement").attr('required', true);
			$("#arrondissement").empty().hide();
			$("#arrondissement").append(data);
			$('#arrondissement').fadeIn(1000);
		}
	});
}
function setQuaters() {
	if($('#region').val() == 12){
		$("#quater").empty();
		$("#quater").append('<option value="">-- Aucun quartier pour la région --</option>');
		$("#quater").attr('disabled', true);
	}
	else{
		$.ajax({
			url: $('#url').val(),
			type: "GET",
			data: "region2="+ $('#region').val(),
			success: function(data) {
				$("#quater").attr('disabled', false);
				$("#quartier").attr('disabled', false);
				$("#quater").empty().hide();
				$("#quater").append(data);
				$('#quater').fadeIn(1000);
			}
		});
	}	
}
function setQuatersE() {// Pour le formulaire recherche entreprise en page d'accueil
	if($('#region2').val() == 12){
		$("#quater2").empty();
		$("#quater2").append('<option value="">-- Aucun quartier pour la région --</option>');
		$("#quater2").attr('disabled', true);
	}
	else{
		$.ajax({
			url: $('#url').val(),
			type: "GET",
			data: "region2="+ $('#region2').val(),
			success: function(data) {
				$("#quater2").attr('disabled', false);
				$("#quartier").attr('disabled', false);
				$("#quater2").empty().hide();
				$("#quater2").append(data);
				$('#quater2').fadeIn(1000);
			}
		});
	}	
}
/***** FONCTION DECLENCHEE 	APRES LE CHOIX D'UN DOMAINE *****/
function onSelectSkill() {	
	//alert($('#url2').val());
	$.ajax({
		url: $('#url2').val(), 
		type: "GET",
		data: "skills="+ $('#skills').val(), 
		success: function(data) { 
			$("#sectors").empty().hide();
			$("#sectors").append(data);
			$('#sectors').fadeIn(1000);
		}
	});
}
/***** FONCTION DECLENCHEE 	APRES SELECTION DU GROUPE UTILISATEUR *****/
function onSelectGroup() {	
	//alert($('#url').val());
	$.ajax({
		url: $('#url').val(), 
		type: "GET",
		data: "group="+ $('#group').val(), 
		success: function(data) { 
			$("#user").empty().hide();
			$("#user").append(data);
			$('#user').fadeIn(1000);
		}
	});
}
/***** FONCTION DECLENCHEE 	APRES SELECTION DU STATUT UTILISATEUR *****/
function onSelectStatut() {	
	//alert($('#url').val());
	$.ajax({
		url: $('#url').val(), 
		type: "GET",
		data: "statut="+ $('#statut').val(), 
		success: function(data) { 
			$("#user").empty().hide();
			$("#user").append(data);
			$('#user').fadeIn(1000);
		}
	});
}