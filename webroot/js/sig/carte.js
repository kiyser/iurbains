//Mapbox key : pk.eyJ1Ijoia2l5c2VyIiwiYSI6ImNrMjR5bGR2cDA2ZGwzYmt4aGs1enRjeXoifQ.5xrRklqYoUdarsCksuav2w
// DECLARATION DES VARIABLES GLOBALES
var map;
var urlToGeoserverWorkspace = 'http://localhost:8080/geoserver/gwc/service/tms/1.0.0/iurbains:';
var urlPBF = '@EPSG:900913@pbf/{z}/{x}/{y}.pbf';
var lastRegion = ""; var lastDepartment = ""; var lastTown = "";

var markerColors = ['#e3f704', '#02f912', '#f40404', '#0404f7']; 											// Couleurs des marqueurs
var layersColors = ["#B9D8B2", "#5EB283", "#5EB283", "#1C985E", "#1C985E", "#69794F", "#69794F", "#69794F"]; 	// Couleurs des couches

var layerAddedToMap = new Array();
var townMarker = new Array();
var layerColors = new Array();
var markerTable = new Array();
var existEqualToSept = 0;
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
	map.addControl(scale = new mapboxgl.ScaleControl({ maxWidth: 80,unit: 'metric'}));	  // Echelle	
	
	map.on('load', function() {		// Exécutée au chargement de la page
		/* Ajout des sources */
		addSources();
		/* Ajout de la couche des régions */
		addLayerOnMap(0, 'cameroun', 'fill', "regions", ["<", "$id", 11], {visibility: "visible",}, {"fill-outline-color": "#f70429", "fill-color": "#0b3def","fill-opacity": 0.2});
		/* Ajout des noms des villes à couche des régions */
		addSymbolOnMap('region-name', 'symbol', "regions", {"text-field": "{region_name_fr}", "text-font": ["DIN Offc Pro Medium", "Arial Unicode MS Bold"], "text-size": 12});
		/* Redéfinir le format des noms des pays */
		map.setLayoutProperty('country-label', 'text-field', ['format',
			['get', 'name'], { 'font-scale': 1.2 },
			'\n', {},['get', 'name_en'], {'font-scale': 0.8,'text-font': ['literal', [ 'DIN Offc Pro Italic', 'Arial Unicode MS Regular' ]]	}
		]);
		makeTableMarkers(0);
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
// FONCTION D'AJOUT DES SOURCES DES TuILES
function addSources(){
	map.addSource("regions", {"type": "vector", "scheme":'tms', "tiles":[urlToGeoserverWorkspace+"regions"+urlPBF]});
	map.addSource("departments", {"type": "vector", "scheme":'tms', "tiles":[urlToGeoserverWorkspace+"departments"+urlPBF]});
	map.addSource("towns", {"type": "vector", "scheme":'tms', "tiles":[urlToGeoserverWorkspace+"towns"+urlPBF]});
}
// FONCTION D'AJOUT D'UNE COUCHE
function addLayerOnMap(code, layerId, type, src, filter, layout, paint){
	map.addLayer({ "id": layerId, "type": type, "source": src, "filter": filter, "source-layer": src, layout: layout,	"paint": paint });
	//addLayerSelectToTable(layerId, code);
	addNewLayerToTable(layerId, code);
}
// FONCTION D'AJOUT D'UN  SYMBOL
function addSymbolOnMap(regionName, type, src, layout){
	map.addLayer({ id: regionName,	type: type,	source: src, "source-layer": src, layout: layout });
}
// FONCTION DE MISE A JOUR DU TABLEAU DES COUCHES ACTIVES
function addNewLayerToTable(layerId, code){
	layerAddedToMap[layerId] = new Array();
	layerAddedToMap[layerId].layerId = layerId;	
	
	layerAddedToMap[layerId].layerCode = code;
	layerAddedToMap[layerId].layerColor = layersColors[code];
	
	if(code == 0){	layerAddedToMap[layerId].layerType = "";	layerAddedToMap[layerId].layerLabel = "Cameroun";	layerAddedToMap[layerId].layerState = 1;	}
	if(code == 1){	layerAddedToMap[layerId].layerType = "";					layerAddedToMap[layerId].layerLabel = "";	layerAddedToMap[layerId].layerState = 1;	}
	if(code == 2){	layerAddedToMap[layerId].layerType = "Région: ";			layerAddedToMap[layerId].layerLabel = layerId;	layerAddedToMap[layerId].layerState = 1;	}
	if(code == 3){	layerAddedToMap[layerId].layerType = "";					layerAddedToMap[layerId].layerLabel = "";	layerAddedToMap[layerId].layerState = 1;	}
	if(code == 4){	layerAddedToMap[layerId].layerType = "Département: ";	layerAddedToMap[layerId].layerLabel = layerId;	layerAddedToMap[layerId].layerState = 1;	}
	if(code == 5){	layerAddedToMap[layerId].layerType = "";					layerAddedToMap[layerId].layerLabel = "";	layerAddedToMap[layerId].layerState = 1;	}
	if(code == 6){	layerAddedToMap[layerId].layerType = "Commune: ";		layerAddedToMap[layerId].layerLabel = layerId;	layerAddedToMap[layerId].layerState = 1;	}
	if(code == 7 && existEqualToSept == 0){		layerAddedToMap[layerId].layerType = "Communes sélectionnées";	layerAddedToMap[layerId].layerLabel = "";	layerAddedToMap[layerId].layerState = 1;	existEqualToSept = 1;	}
}
// FONCTION POUR ZOOMER SUR LA COUCHE SELECTIONNEE
function zoomToLayer(data){
	coordinates = data.features[0].geometry.coordinates[0][0];
	var bounds = coordinates.reduce(function(bounds, coord) {	return bounds.extend(coord);	}, new mapboxgl.LngLatBounds(coordinates[0], coordinates[0]));
	map.fitBounds(bounds, {		padding: 20		});
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
			addLayerOnMap(2, data.features[0].properties.region_name_fr, 'fill', "regions", ["==", "$id", parseInt(getParameters()["oneRegion"])], {visibility: "visible",}, {"fill-outline-color": "#3887be","fill-color": "#008D4C","fill-opacity": 0.3});
			zoomToLayer(data);
			lastRegion = data.features[0].properties.region_name_fr;
			putLayerOnLegende(2,data.features[0].properties.region_name_fr);
			//map.setMaxZoom(8);
		}
	});
	makeTableMarkers(1);
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
			addLayerOnMap(4, data.features[0].properties.department_name_fr, 'fill', "departments", ["==", "$id", parseInt(getParameters()["oneDepartment"])], {visibility: "visible",}, {"fill-outline-color": "#3887be","fill-color": "#008D4C","fill-opacity": 0.5});
			lastDepartment = data.features[0].properties.department_name_fr;
			zoomToLayer(data);
			putLayerOnLegende(4,data.features[0].properties.department_name_fr);
		}
	});
	makeTableMarkers(2);
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
			addLayerOnMap(6, data.features[0].properties.town_name_fr, 'fill', "towns", ["==", "$id", parseInt(getParameters()["oneTown"])], {visibility: "visible",}, {"fill-outline-color": "#3887be","fill-color": "#0b3def","fill-opacity": 0.5});
			zoomToLayer(data);
			lastTown = data.features[0].properties.town_name_fr;
			putLayerOnLegende(6,data.features[0].properties.town_name_fr);
		}
	});
	makeTableMarkers(3);
	removeMarker();
}
// FONCTION DE CHECK ET DE SUPPRESSION DES COUCHES
function removeLayerIfExiste(code){
	Object.keys(layerAddedToMap).map(function(layerId) {
		if(layerAddedToMap[layerId].layerCode >= code){
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
	var codeSept = "N";
	Object.keys(layerAddedToMap).map(function(layerId) {
		if(layerAddedToMap[layerId].layerState == 1){
			var couche = layerAddedToMap[layerId].layerType + layerAddedToMap[layerId].layerLabel/*.toLowerCase()*/;
			var color = layerAddedToMap[layerId].layerColor;
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
			//donnee.style = 'font-size:18px;color:'+markerColors[markerTable[town].colorCode];
			donnee.style = 'font-size:18px;color:'+markerColors[markerTable[town].colorCode];

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
	layerAddedToMap[layerId].layerState = 0;
	layerAddedToMap[layerId].layerType = "";
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

function makeTableMarkers(code){//code=3 -->town,,,,,,,,code=2-->department,,,,,,,,code=1-->region,,,,,,,,code=0-->all towns
	if(code == 1) url = 'http://localhost:8080/geoserver/wfs?service=WFS&version=1.1.0&request=GetFeature&outputFormat=application/json&srsName=EPSG:4326&typeName=iurbains:towns&cql_filter=region_id='+parseInt($('#region').val());
	else if(code == 2) url = 'http://localhost:8080/geoserver/wfs?service=WFS&version=1.1.0&request=GetFeature&outputFormat=application/json&srsName=EPSG:4326&typeName=iurbains:towns&cql_filter=department_id='+parseInt($('#department').val());
	else if(code == 3) url = 'http://localhost:8080/geoserver/wfs?service=WFS&version=1.1.0&request=GetFeature&outputFormat=application/json&srsName=EPSG:4326&typeName=iurbains:towns&featureId='+parseInt($('#town').val());
	else url = 'http://localhost:8080/geoserver/wfs?service=WFS&version=1.1.0&request=GetFeature&outputFormat=application/json&srsName=EPSG:4326&typeName=iurbains:towns';
	
	var ajax = $.ajax({
		jsonp:false,
		type:'GET',
		url:url,
		async:true,
		dataType: 'json',
		success: function(data) {
			markerTable.length = 0;
			var i = 0;
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
						addLayerOnMap(6,markerTable[townMarker[i]].townName, 'fill', "towns", ["==", "$id", parseInt(townMarker[i])], {visibility: "visible",}, {"fill-outline-color": "#3887be","fill-color": "#DD4B39","fill-opacity": 0.4});
					var elt = document.createElement('div');
					elt.className = 'fa fa-map-marker';
					//elt.style = 'font-size:20px;color:'+markerColors[mdClass];
					elt.style = 'font-size:20px;color:'+markerColors[3];
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
			for(i=0;i<data.length;i++){
				for(j=0;j<data[i].length;j++){
					for(k=0;k<data[i][j].length;k++){
						if(data[i][j][k]['Value'] >= 0){
							markerTable[data[i][j][k]['townId']].regionName = data[i][j][k]['Region'];
							markerTable[data[i][j][k]['townId']].departmentName = data[i][j][k]['Department'];
							markerTable[data[i][j][k]['townId']].indicator = data[i][j][k]['Value'];
							minMax[index] = data[i][j][k]['Value'];
							index++;
					
							var mdClass = getClassFromData(minMax, markerTable[data[i][j][k]['townId']].indicator);
							markerTable[data[i][j][k]['townId']].colorCode = mdClass;
							// AJOUTER UNE COUCHE SUR LA CARTE
							if(!map.getLayer(markerTable[data[i][j][k]['townId']].townName))
								addLayerOnMap(7,data[i][j][k]['Town'], 'fill', "towns", ["==", "$id", parseInt(data[i][j][k]['townId'])], {visibility: "visible",}, {"fill-outline-color": "#3887be","fill-color": "#DD4B39","fill-opacity": 0.4});
							var elt = document.createElement('div');
							elt.className = 'fa fa-map-marker';
							elt.style = 'font-size:20px;color:'+markerColors[mdClass];
							content = '<p style="font-size:10px;margin:0 0 0px;text-align:left"><i>Région: ' + markerTable[data[i][j][k]['townId']].regionName + '</i></p>';
							content += '<p style="font-size:10px;margin:-8px 0 0;text-align:left"><i>Département: ' + markerTable[data[i][j][k]['townId']].departmentName + '</i></p>';
							content += '<p style="font-size:10px;margin:-8px 0 0;text-align:left"><i>Commune: ' + markerTable[data[i][j][k]['townId']].townName + '</i></p>';
							content += '<p style="font-size:10px;margin:0 0 0px;"><b>' + $('#iuName'+indId).val() + '</b></p>';
							content += '<p style="font-size:12px;margin:0 0 0px;"><b>' + markerTable[data[i][j][k]['townId']].indicator + '</b></p>';
							//elt.style = 'font-size:20px;color:'+markerColors[3];
							markerTable[data[i][j][k]['townId']].marker = new mapboxgl.Marker(elt)
														.setLngLat(markerTable[data[i][j][k]['townId']].bounds.getCenter())
														.setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
														.setHTML(content))
														.addTo(map);
						}
					}			
				}		
			}
				console.log(markerTable);	
			addLegende(1);
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