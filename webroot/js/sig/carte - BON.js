//Mapbox key : pk.eyJ1Ijoia2l5c2VyIiwiYSI6ImNrMjR5bGR2cDA2ZGwzYmt4aGs1enRjeXoifQ.5xrRklqYoUdarsCksuav2w
// DECLARATION DES VARIABLES GLOBALES
//var urlToGeoserverWorkspace = 'http://localhost:8080/geoserver/wfs';http://localhost:8080/geoserver/wfs?service=WFS&version=1.1.0&request=GetFeature&typeName=iurbains%3Aregions&maxFeatures=200&outputFormat=application%2Fjson&format_options=callback%3A%20getJson&srsName=EPSG%3A4326
var urlToGeoserverWorkspace = 'http://localhost:8080/geoserver/gwc/service/tms/1.0.0/iurbains:';
var urlPBF = '@EPSG:900913@pbf/{z}/{x}/{y}.pbf';
var map;
var regionsGs = "regions";
var departmentsGs = "departments";
var townsGs = "towns";
var townsDeptGeoJs;
var markerMicrodata;
var markerIndicator;
var lastRegion = ""; var lastDepartment = ""; var lastTown = "";
var lngTown;
var classColors = ['#e3f704', '#02f912', '#f40404', '#0404f7'];
var layersColors = ["#B9D8B2", "#5EB283", "#1C985E", "#69794F"];
var townMarker = new Array();
var tableLayerAddedToMap = new Array();
var layerColors = new Array();
var markerTable = new Array();
function initialize() {
	mapboxgl.accessToken = 'pk.eyJ1Ijoia2l5c2VyIiwiYSI6ImNrMjR5bGR2cDA2ZGwzYmt4aGs1enRjeXoifQ.5xrRklqYoUdarsCksuav2w';
	map = new mapboxgl.Map({
		container: 'map',
		zoom: 5.2,
		maxZoom: 14,
		center: [13, 7.5],
		attributionControl: false,
		style: 'mapbox://styles/mapbox/streets-v11'
	});
	map.getCanvas().style.height = '100%';
	
	map.addControl(new mapboxgl.AttributionControl({compact: true}));				  // Icone informations et liens mapbox + openstreetmap
	map.addControl(new mapboxgl.NavigationControl());								  // Boutons de navigation
	map.addControl(new mapboxgl.FullscreenControl());								  // Bouton pour le plein écran	
	map.addControl(scale = new mapboxgl.ScaleControl({ maxWidth: 80,unit: 'metric'}));// Echelle	
	
	map.on('load', function() {		// Exécutée au chargement de la page
		/* Ajout des sources */
		addSources();
		/* Ajout de la couche des régions */
		addLayerOnMap(0, 'cameroun', 'fill', regionsGs, ["<", "$id", 11], {visibility: "visible",}, {"fill-outline-color": "#f70429", "fill-color": "#0b3def","fill-opacity": 0.2});
		/* Ajout des noms des villes à couche des régions */
		map.addLayer({
			id: 'region-name',
			type: 'symbol',
			source: regionsGs,
			"source-layer": regionsGs,
			layout: { "text-field": "{region_name_fr}", "text-font": ["DIN Offc Pro Medium", "Arial Unicode MS Bold"], "text-size": 12 }
		});
		/* Redéfinir le format des noms des pays */
		map.setLayoutProperty('country-label', 'text-field', ['format',
			['get', 'name'], { 'font-scale': 1.2 },
			'\n', {},['get', 'name_en'], {'font-scale': 0.8,'text-font': ['literal', [ 'DIN Offc Pro Italic', 'Arial Unicode MS Regular' ]]	}
		]);
		/* Ajout de la légende */
		addLegende(0);
	});
}
// FONCTION DE CHANGEMENT DU BASE LAYER
function chageBaseLayer2(code){
	//if(code == 1) map.setStyle('mapbox://styles/mapbox/satellite-v9');
	//if(code == 2) map.setStyle('mapbox://styles/mapbox/light-v10');
	//map.setLayoutProperty('cameroun', 'visibility', 'none');
}
// FONCTION D'AJOUT DES SOURCES TILES
function addSources(){
	map.addSource(regionsGs, {"type": "vector", "scheme":'tms', "tiles":[urlToGeoserverWorkspace+regionsGs+urlPBF]});
	map.addSource(departmentsGs, {"type": "vector", "scheme":'tms', "tiles":[urlToGeoserverWorkspace+departmentsGs+urlPBF]});
	map.addSource(townsGs, {"type": "vector", "scheme":'tms', "tiles":[urlToGeoserverWorkspace+townsGs+urlPBF]});
}
// FONCTION D'AJOUT D'UNE COUCHE
function addLayerOnMap(code, layerId, type, src, filter, layout, paint){
	map.addLayer({
		"id": layerId,
		"type": type,
		"source": src,
		"filter": filter,
		"source-layer": src,
		layout: layout,
		"paint": paint		
	});
	addLayerSelectToTable(layerId, code);
}
// FONCTION POUR AJOUTER LA COUCHE SELECTIONNEE DANS LE TABLEAU
function addLayerSelectToTable(layerId, code){
	tableLayerAddedToMap[layerId] = new Array();
	tableLayerAddedToMap[layerId].layerId = layerId;	
	tableLayerAddedToMap[layerId].layerState = 1;
	tableLayerAddedToMap[layerId].layerCode = code;
	
	if(code == 0){	tableLayerAddedToMap[layerId].layerType = "";	tableLayerAddedToMap[layerId].layerLabel = "Cameroun";	tableLayerAddedToMap[layerId].layerColor = layersColors[0];	}
	if(code == 1){	tableLayerAddedToMap[layerId].layerType = "";	tableLayerAddedToMap[layerId].layerLabel = "";	tableLayerAddedToMap[layerId].layerColor = layersColors[1];	}
	if(code == 2){	tableLayerAddedToMap[layerId].layerType = "Région: ";	tableLayerAddedToMap[layerId].layerLabel = layerId;	tableLayerAddedToMap[layerId].layerColor = layersColors[1];	}
	if(code == 3){	tableLayerAddedToMap[layerId].layerType = "";	tableLayerAddedToMap[layerId].layerLabel = "";	tableLayerAddedToMap[layerId].layerColor = layersColors[2];	}
	if(code == 4){	tableLayerAddedToMap[layerId].layerType = "Département: ";	tableLayerAddedToMap[layerId].layerLabel = layerId;	tableLayerAddedToMap[layerId].layerColor = layersColors[2];	}
	if(code == 5){	tableLayerAddedToMap[layerId].layerType = "";	tableLayerAddedToMap[layerId].layerLabel = "";	tableLayerAddedToMap[layerId].layerColor = layersColors[3];	}
	if(code == 6){	tableLayerAddedToMap[layerId].layerType = "Commune: ";	tableLayerAddedToMap[layerId].layerLabel = layerId;	tableLayerAddedToMap[layerId].layerColor = layersColors[3];	}
	if(code == 7){	tableLayerAddedToMap[layerId].layerType = "";	tableLayerAddedToMap[layerId].layerLabel = "";	tableLayerAddedToMap[layerId].layerColor = layersColors[3];	}
}
// FONCTION POUR ZOOMER SUR LA COUCHE SELECTIONNEE
function zoomToLayer(data){
	coordinates = data.features[0].geometry.coordinates[0][0];
	var bounds = coordinates.reduce(function(bounds, coord) {
		return bounds.extend(coord);
	}, new mapboxgl.LngLatBounds(coordinates[0], coordinates[0]));
	map.fitBounds(bounds, {
		padding: 20
	});
}
// FONCTION D'AFFICHAGE DE TOUTES LES REGION
function selectAllRegion(){
	if(map.getLayer('regionsId'))		{		map.removeLayer('regionsId');	layerColors[1].layerState = 0;		}
	if(map.getLayer('departmentsId'))	{		map.removeLayer('departmentsId');	layerColors[2].layerState = 0;	}
	if(map.getLayer('townsId'))			{		map.removeLayer('townsId');	layerColors[3].layerState = 0;			}	
	if(map.getLayer('allRegions'))		{		map.removeLayer('allRegions');	layerColors[4].layerState = 0;		}
	else{
		document.getElementById("region").value = "";
		url = 'http://localhost:8080/geoserver/wfs?service=WFS&version=1.1.0&request=GetFeature&outputFormat=application/json&srsName=EPSG:4326&typeName=iurbains:regions';
		var ajax = $.ajax({
			jsonp:false,
			type:'GET',
			url:url,
			async:true,
			dataType: 'json',
			success: function(data) {
				map.addLayer({
					"id": "allRegions",
					"type": "fill",
					"source": regionsGs,
					//"filter": ["==", "$id", parseInt(getParameters()['oneRegion'])],
					//"filter": ["==", "$region_id", parseInt(getParameters()['oneRegion'])],
					"source-layer": regionsGs,
					layout: {
						visibility: 'visible',				
					},
					"paint": {"fill-outline-color": "#3887be","fill-color": '#008D4C',"fill-opacity": 0.5}		
				});
				//zoomToLayer(data);
				putLayerOnLegende(4,"Toutes les régions");
				selectMicrodata();
				//map.setMaxZoom(5.2);
			}
		});
	}
	removeMarker();	
}
// FONCTION D'AFFICHAGE DE TOUTES LES REGION
function selectAllDepartment(){
	//if(map.getLayer('regionsId'))		{		map.removeLayer('regionsId');	layerColors[1].layerState = 0;		}
	if(map.getLayer('departmentsId'))	{		map.removeLayer('departmentsId');	layerColors[2].layerState = 0;	}
	if(map.getLayer('townsId'))			{		map.removeLayer('townsId');	layerColors[3].layerState = 0;			}	
	if(map.getLayer('allDepartments'))	{		map.removeLayer('allDepartments');	layerColors[5].layerState = 0;	}
	else{
		document.getElementById("department").value = "";
		map.addLayer({
			"id": "allDepartments",
			"type": "fill",
			"source": departmentsGs,
			"filter": ["==", "$departments.region_id", parseInt(getParameters()['oneRegion'])],
			"source-layer": departmentsGs,
			layout: {
				visibility: 'visible',				
			},
			"paint": {"fill-outline-color": "#3887be","fill-color": '#008D4C',"fill-opacity": 0.7}		
		});
		//zoomToLayer(data);
		putLayerOnLegende(5,"Tous les départements");
		selectMicrodata();
		//map.setMaxZoom(5.2);
	}
	removeMarker();
}
// FONCTION D'AFFICHAGE D'UNE REGION + ZOOM
function selectRegionLayer(){	
	removeLayerIfExiste(2);
	url = 'http://localhost:8080/geoserver/wfs?service=WFS&version=1.1.0&request=GetFeature&outputFormat=application/json&srsName=EPSG:4326&typeName=iurbains:regions&featureId='+parseInt(getParameters()['oneRegion']);
	var ajax = $.ajax({
		jsonp:false,
		type:'GET',
		url:url,
		async:true,
		dataType: 'json',
		success: function(data) {
			// AJOUTER UNE COUCHE SUR LA CARTE
			addLayerOnMap(2, data.features[0].properties.region_name_fr, 'fill', regionsGs, ["==", "$id", parseInt(getParameters()["oneRegion"])], {visibility: "visible",}, {"fill-outline-color": "#3887be","fill-color": "#008D4C","fill-opacity": 0.3});
			zoomToLayer(data);
			lastRegion = data.features[0].properties.region_name_fr;
			putLayerOnLegende(2,data.features[0].properties.region_name_fr);
			//map.setMaxZoom(8);
		}
	});
	//makeTableMarkers(0);
	removeMarker();
}
// FONCTION D'AFFICHAGE D'UN DEPARTEMENT + ZOOM
function selectDepartmentLayer(){	
	//if(map.getLayer('allDepartments')) {	map.removeLayer('allDepartments');	layerColors[5].layerState = 0;	$("#allDepartment").prop('checked', false);	}
	removeLayerIfExiste(4);
	url = 'http://localhost:8080/geoserver/wfs?service=WFS&version=1.1.0&request=GetFeature&outputFormat=application/json&srsName=EPSG:4326&typeName=iurbains:departments&featureId='+parseInt(getParameters()['oneDepartment']);
	var ajax = $.ajax({
		jsonp:false,
		type:'GET',
		url:url,
		async:true,
		dataType: 'json',
		success: function(data) {
			// AJOUTER UNE COUCHE SUR LA CARTE
			addLayerOnMap(4, data.features[0].properties.department_name_fr, 'fill', departmentsGs, ["==", "$id", parseInt(getParameters()["oneDepartment"])], {visibility: "visible",}, {"fill-outline-color": "#3887be","fill-color": "#008D4C","fill-opacity": 0.5});
			lastDepartment = data.features[0].properties.department_name_fr;
			zoomToLayer(data);
			putLayerOnLegende(4,data.features[0].properties.department_name_fr);
		}
	});
	makeTableMarkers(1);
	removeMarker();
}
// FONCTION D'AFFICHAGE D'UNE COMMUNE + ZOOM
function selectTownLayer(){
	removeLayerIfExiste(6);
	url = 'http://localhost:8080/geoserver/wfs?service=WFS&version=1.1.0&request=GetFeature&outputFormat=application/json&srsName=EPSG:4326&typeName=iurbains:towns&featureId='+parseInt(getParameters()['oneTown']);
	var ajax = $.ajax({
		jsonp:false,
		type:'GET',
		url:url,
		async:true,
		dataType: 'json',
		success: function(data) {
			// AJOUTER UNE COUCHE SUR LA CARTE
			addLayerOnMap(6, data.features[0].properties.town_name_fr, 'fill', townsGs, ["==", "$id", parseInt(getParameters()["oneTown"])], {visibility: "visible",}, {"fill-outline-color": "#3887be","fill-color": "#0b3def","fill-opacity": 0.5});
			zoomToLayer(data);
			lastTown = data.features[0].properties.town_name_fr;
			putLayerOnLegende(6,data.features[0].properties.town_name_fr);
		}
	});
	makeTableMarkers(2);
	removeMarker();
}
// FONCTION DE CHECK ET DE SUPPRESSION DES COUCHES
function removeLayerIfExiste(code){
	Object.keys(tableLayerAddedToMap).map(function(layerId) {
		if(tableLayerAddedToMap[layerId].layerCode >= code){
			if(map.getLayer(layerId)) map.removeLayer(layerId);
			removeLayerOnLegende(layerId);
		}
	});
}
// FONCTION D'AJOUT DE LA LEGENDE
function addLegende(code){
	if(code == 1) $("#legend").empty();
	var item = document.createElement('div');
	var value = document.createElement('span');
	value.innerHTML = '<h5><b>Légende</b></h5><b>Couches administratives</b>';
	item.appendChild(value);
	legend.appendChild(item);
	Object.keys(tableLayerAddedToMap).map(function(layerId) {
		if(tableLayerAddedToMap[layerId].layerState == 1){
			var couche = tableLayerAddedToMap[layerId].layerType + tableLayerAddedToMap[layerId].layerLabel.toLowerCase();
			var color = tableLayerAddedToMap[layerId].layerColor;
			var item = document.createElement('div');
			var key = document.createElement('span');
			key.className = 'legend-key';
			key.style.backgroundColor = color;

			var value = document.createElement('span');
			value.innerHTML = couche;
			item.appendChild(key);
			item.appendChild(value);
			legend.appendChild(item);
		}
	});
	/*
	var microdata = document.createElement('div');
	var valueMd = document.createElement('span');
	valueMd.innerHTML = '<hr><b>Marqueurs sur la carte</b>';
	microdata.appendChild(valueMd);
	legend.appendChild(microdata);
	Object.keys(markerTable).map(function(town) {
		console.log(markerTable[town].colorCode);
		if(markerTable[town].marker != ""){
			var microdata = document.createElement('div');
			var donnee = document.createElement('span');
			donnee.className = 'fa fa-map-marker';
			//donnee.style = 'font-size:18px;color:'+classColors[markerTable[town].colorCode];
			donnee.style = 'font-size:18px;color:'+classColors[markerTable[town].colorCode];

			var value = document.createElement('span');
			//value.innerHTML = " Signification de la couleur";
			value.innerHTML = colorSingnMarker(markerTable[town].colorCode);
			microdata.appendChild(donnee);
			microdata.appendChild(value);
			legend.appendChild(microdata);
		}		
	});
	*/
}
// FONCTION D'AJOUT DE LA LEGENDE
function addIndicatorInfos(){
	$("#indicator").empty();
	var item = document.createElement('div');
	var value = document.createElement('span');
	value.innerHTML = '<h6><b>Détails de l\'indicateur.</b></h6>';
	item.appendChild(value);
	indicator.appendChild(item);
}
// FONCTION D'INTERPRETATION DU CODE COULEUR DES MARKERS
function colorSingnMarker(id){
	var singnification = "";
	if(id == 0) singnification = " Pas acceptable";//jaune
	if(id == 1) singnification = " Acceptable";//vert
	if(id == 2) singnification = " Critique";//rouge
	if(id == 3) singnification = " Normale";//bleu
	return singnification;
}
// FONCTION D'ACTIVATION DE LA COUCHE DANS LA LEGENDE
function putLayerOnLegende(id, texte){
	addLegende(1);
}
// FONCTION DE DESACTIVATION DE LA COUCHE DE LA LEGENDE
function removeLayerOnLegende(layerId){
	tableLayerAddedToMap[layerId].layerState = 0;
	tableLayerAddedToMap[layerId].layerType = "";
}
// FONCTION POUR RECUPERER LES PARAMETRES DU FORMULAIRE
function getParameters(){
	var mapParams = new Object();
	mapParams['allRegion'] = $('#allRegion').val();
	mapParams['allDepartment'] = $('#allDepartment').val();
	mapParams['allTown'] = $('#allTown').val();
	mapParams['oneRegion'] = $('#region').val();
	mapParams['oneDepartment'] = $('#department').val();
	mapParams['oneTown'] = $('#town').val();
	mapParams['theme'] = $('#theme').val();
	mapParams['domain'] = $('#domain').val();
	mapParams['version'] = $('#version').val();
	mapParams['indicator'] = mapParams['microdata'] = null;
	radioInd = document.getElementsByName("radioIndicator");	for(i = 0; i < radioInd.length; i++) { if(radioInd[i].checked) mapParams['indicator'] = radioInd[i].value; }
	radioMic = document.getElementsByName("radioIndicator");	for(i = 0; i < radioMic.length; i++) { if(radioMic[i].checked) mapParams['microdata'] = radioMic[i].value; }
	return mapParams;
}

function makeTableMarkers(code){//code=2 -->town,,,,,,,,,,,,,,,code=1-->department,,,,,,,,,,,,,,,code=0-->region
	url = "";
	if(code == 0){
		url = 'http://localhost:8080/geoserver/wfs?service=WFS&version=1.1.0&request=GetFeature&outputFormat=application/json&srsName=EPSG:4326&typeName=iurbains:towns&cql_filter=region_id='+parseInt(getParameters()['oneRegion']);
	}
	if(code == 1){
		url = 'http://localhost:8080/geoserver/wfs?service=WFS&version=1.1.0&request=GetFeature&outputFormat=application/json&srsName=EPSG:4326&typeName=iurbains:towns&cql_filter=department_id='+parseInt($('#department').val());
	}
	if(code == 2){
		url = 'http://localhost:8080/geoserver/wfs?service=WFS&version=1.1.0&request=GetFeature&outputFormat=application/json&srsName=EPSG:4326&typeName=iurbains:towns&featureId='+parseInt(getParameters()['oneTown']);
	}
	if(code == 1 || code == 2){		
		var ajax = $.ajax({
			jsonp:false,
			type:'GET',
			url:url,
			async:true,
			dataType: 'json',
			success: function(data) {
				var i = 0;
				markerTable.length = 0;
				data.features.forEach(function(e) {
					markerTable[parseInt(e.id.split(".")[1])] = new Array();
					markerTable[parseInt(e.id.split(".")[1])].regionName ="";
					markerTable[parseInt(e.id.split(".")[1])].departmentName ="";
					markerTable[parseInt(e.id.split(".")[1])].townName = e.properties['town_name_fr'];
					markerTable[parseInt(e.id.split(".")[1])].marker = "";
					markerTable[parseInt(e.id.split(".")[1])].indicator = "";
					markerTable[parseInt(e.id.split(".")[1])].microdata = "";
					
					val = e.geometry.coordinates[0][0];
					markerTable[parseInt(e.id.split(".")[1])].bounds = val.reduce(function(bounds, coord) {	return bounds.extend(coord);	}, new mapboxgl.LngLatBounds(val[0], val[0]));
					i++;
				});
			}
		});
	}
}
// FONCTION D'AFFICHAGE DES MARKERS D'UNE MICRODONNEE
function setMarkerForMicrodata(mdId){
	if($('#department').val() == ""){
		alert('Vous devez sélectionner un département ou une commune');
	}else{
		$.ajax({
			url: $('#urlValMd').val(),
			type: "GET",
			data: 'region=' + $('#region').val() + '&department=' + $('#department').val() + '&town=' + $('#town').val() + '&version=' + $('#version').val() + '&microdata=' + mdId,
			success: function(data) {
				var index = 0;
				var minMax = new Array();
				var tabValue = data.split("|");
				townMarker.length = 0;
				for(i=0;i<tabValue.length;i++){
					var elts = tabValue[i].split(";");
					markerTable[elts[2].split("=")[1]].regionName =elts[0].split("=")[1];
					markerTable[elts[2].split("=")[1]].departmentName =elts[1].split("=")[1];
					markerTable[elts[2].split("=")[1]].microdata = elts[3].split("=")[1];
					townMarker[index] = elts[2].split("=")[1];
					minMax[index] = elts[3].split("=")[1];
					index++;
				}
				removeMarker();
				for(i=0;i<townMarker.length;i++){//removeLayerIfExiste(6);
					var mdClass = getClassFromData(minMax, markerTable[townMarker[i]].microdata);
					markerTable[townMarker[i]].colorCode = mdClass;
					// AJOUTER UNE COUCHE SUR LA CARTE
					if(!map.getLayer(markerTable[townMarker[i]].townName))
						addLayerOnMap(6,markerTable[townMarker[i]].townName, 'fill', townsGs, ["==", "$id", parseInt(townMarker[i])], {visibility: "visible",}, {"fill-outline-color": "#3887be","fill-color": "#DD4B39","fill-opacity": 0.4});
					var elt = document.createElement('div');
					elt.className = 'fa fa-map-marker';
					//elt.style = 'font-size:20px;color:'+classColors[mdClass];
					elt.style = 'font-size:20px;color:'+classColors[3];
					content = '<p style="font-size:10px;margin:0 0 0px;text-align:left"><i>Région: ' + markerTable[townMarker[i]].regionName + '</i></p>';
					content += '<p style="font-size:10px;margin:-8px 0 0;text-align:left"><i>Département: ' + markerTable[townMarker[i]].departmentName + '</i></p>';
					content += '<p style="font-size:10px;margin:-8px 0 0;text-align:left"><i>Commune: ' + markerTable[townMarker[i]].townName + '</i></p>';
					content += '<p style="font-size:10px;margin:0 0 0px;"><b>' + $('#mdName'+mdId).val() + '</b></p>';
					content += '<p style="font-size:12px;margin:0 0 0px;"><b>' + markerTable[townMarker[i]].microdata + '</b></p>';
					markerTable[townMarker[i]].marker = new mapboxgl.Marker(elt)
														.setLngLat(markerTable[townMarker[i]].bounds.getCenter())
														.setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
														.setHTML(content))
														.addTo(map);/**/
				}
				//makeTableMarkers(1);
				addLegende(1);//if(getParameters()["oneTown"] == "") putLayerOnLegende(7,"Communes sélectionnées");
			}
		});
	}
}
// FONCTION D'AFFICHAGE DES MARKERS D'UN INDICATEUR
function setMarkerForIndicator(indId){
	$.ajax({
		url: $('#urlValInd').val(),
		type: "GET",
		data: 'region=' + $('#region').val() + '&department=' + $('#department').val() + '&town=' + $('#town').val() + '&version=' + $('#version').val() + '&indicator=' + indId,
		success: function(data) {
			data = JSON.parse(data);
			var index = 0;
			var minMax = new Array();
			townMarker.length = 0;
			for(i=0;i<data.length;i++){
				for(j=0;j<data[i].length;j++){
					for(k=0;k<data[i][j].length;k++){
						if(data[i][j][k]['Value'] >= 0){
							markerTable[data[i][j][k]['townId']].regionName = data[i][j][k]['Region'];
							markerTable[data[i][j][k]['townId']].departmentName = data[i][j][k]['Department'];
							markerTable[data[i][j][k]['townId']].indicator = data[i][j][k]['Value'];
							townMarker[index] = data[i][j][k]['townId'];
							minMax[index] = data[i][j][k]['Value'];
							index++;
					
							var mdClass = getClassFromData(minMax, markerTable[data[i][j][k]['townId']].indicator);
							markerTable[townMarker[i]].colorCode = mdClass;
							// AJOUTER UNE COUCHE SUR LA CARTE
							if(!map.getLayer(markerTable[data[i][j][k]['townId']].townName))
								addLayerOnMap(6,data[i][j][k]['Town'], 'fill', townsGs, ["==", "$id", parseInt(data[i][j][k]['townId'])], {visibility: "visible",}, {"fill-outline-color": "#3887be","fill-color": "#DD4B39","fill-opacity": 0.4});
							var elt = document.createElement('div');
							elt.className = 'fa fa-map-marker';
							elt.style = 'font-size:20px;color:'+classColors[mdClass];
							content = '<p style="font-size:10px;margin:0 0 0px;text-align:left"><i>Région: ' + markerTable[data[i][j][k]['townId']].regionName + '</i></p>';
							content += '<p style="font-size:10px;margin:-8px 0 0;text-align:left"><i>Département: ' + markerTable[data[i][j][k]['townId']].departmentName + '</i></p>';
							content += '<p style="font-size:10px;margin:-8px 0 0;text-align:left"><i>Commune: ' + markerTable[data[i][j][k]['townId']].townName + '</i></p>';
							//content += '<p style="font-size:10px;margin:0 0 0px;"><b>' + $('#mdName'+mdId).val() + '</b></p>';
							content += '<p style="font-size:12px;margin:0 0 0px;"><b>' + markerTable[data[i][j][k]['townId']].indicator + '</b></p>';
							//elt.style = 'font-size:20px;color:'+classColors[3];
							markerTable[data[i][j][k]['townId']].marker = new mapboxgl.Marker(elt)
														.setLngLat(markerTable[data[i][j][k]['townId']].bounds.getCenter())
														.setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
														.setHTML(content))
														.addTo(map);
						}
					}			
				}			
			}
			//addLegende(1);
		}
	});	
}
// FONCTION DE SUPPRESSION DE TOUS LES MARKERS
function removeMarker() {
	for(i=0;i<townMarker.length;i++){
		if(markerTable[townMarker[i]].marker != ""){
			markerTable[townMarker[i]].marker.remove();
			markerTable[townMarker[i]].marker = "";
		}
		if(map.getLayer(markerTable[townMarker[i]].townName)){
			map.removeLayer(markerTable[townMarker[i]].townName);
			removeLayerOnLegende(markerTable[townMarker[i]].townName)
		}
	}
}
// FONCTION DE DETERMINATION DES CLASSES A PARTIR DES VALEURS DES MICRODONNEES
function getClassFromData(table, md) {
	min = Math.min.apply(null, table);
	max = Math.max.apply(null, table);
	if(md>=min & md<(max/4)) return 0;//jaune
	if(md>=(max/4) & md<(max/2)) return 1;//vert
	if(md>=(max/2) & md<(max*3/4)) return 2;//rouge
	if(md>=(max*3/4) & md<=max) return 3;//bleu
	if(max==min) return 3;
}