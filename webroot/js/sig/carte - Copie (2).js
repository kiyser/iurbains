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
var latTown;
var lngTown;
var classColors = ['#e3f704', '#02f912', '#f40404', '#0404f7'];
var townMarker = new Array();
var layerColors = new Array();
var markerTable = new Array();
function initialize() {
	mapboxgl.accessToken = 'pk.eyJ1Ijoia2l5c2VyIiwiYSI6ImNrMjR5bGR2cDA2ZGwzYmt4aGs1enRjeXoifQ.5xrRklqYoUdarsCksuav2w';
	map = new mapboxgl.Map({
		container: 'map',
		zoom: 5.2,
		maxZoom: 8,
		center: [13, 7.5],
		//pitch: 40,
		attributionControl: false,
		style: 'mapbox://styles/mapbox/streets-v11'
	});
	//map.legendControl.addLegend(document.getElementById('legend').innerHTML);
	map.addControl(new mapboxgl.AttributionControl({compact: true}));				  // Icone informations et liens mapbox + openstreetmap
	map.addControl(new mapboxgl.NavigationControl());								  // Boutons de navigation
	map.addControl(new mapboxgl.FullscreenControl());								  // Bouton pour le plein écran	
	map.addControl(scale = new mapboxgl.ScaleControl({ maxWidth: 80,unit: 'metric'}));// Echelle
	// Initialisation de la table des couleurs des couches
	InitLayerColors();
	// Exécutée au chargement de la page
	map.on('load', function() {
		addSources();// Ajout des sources
		/* Ajout de la couche des régions */
		addLayerOnMap(regionsGs, 'fill', regionsGs, ["<", "$id", 11], {visibility: "visible",}, {"fill-outline-color": "#f70429", "fill-color": "#008D4C","fill-opacity": 0.2});
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
		/* Enlever la couche des noms des villes de tous les pays */
		//map.removeLayer('settlement-label'); 
	});//map.setStyle('mapbox://styles/mapbox/light-v10');console.log(map.getStyle());
}
// FONCTION DE CHANGEMENT DU BASE LAYER
function chageBaseLayer(code){
	if(code == 1) map.setStyle('mapbox://styles/mapbox/satellite-v9');
	if(code == 2) map.setStyle('mapbox://styles/mapbox/light-v10');
}
// FONCTION D'AJOUT DES SOURCES TILES
function addSources(){
	map.addSource(regionsGs, {"type": "vector", "scheme":'tms', "tiles":[urlToGeoserverWorkspace+regionsGs+urlPBF]});
	map.addSource(departmentsGs, {"type": "vector", "scheme":'tms', "tiles":[urlToGeoserverWorkspace+departmentsGs+urlPBF]});
	map.addSource(townsGs, {"type": "vector", "scheme":'tms', "tiles":[urlToGeoserverWorkspace+townsGs+urlPBF]});
}
// FONCTION D'AJOUT D'UNE COUCHE
function addLayerOnMap(layerId, type, src, filter, layout, paint){
	map.addLayer({
		"id": layerId,
		"type": type,
		"source": src,
		"filter": filter,
		"source-layer": src,
		layout: layout,
		"paint": paint		
	});
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
// FONCTION D'AFFICHAGE D'UNE COUCHE REGION + ZOOM
function selectRegionLayer(){	
	if(map.getLayer('allRegions')) {	map.removeLayer('allRegions');	layerColors[4].layerState = 0;	$("#allRegion").prop('checked', false);	}
	if(map.getLayer('regionsId')) map.removeLayer('regionsId');
	if(map.getLayer('departmentsId')) map.removeLayer('departmentsId');
	if(map.getLayer('townsId')) map.removeLayer('townsId');
	url = 'http://localhost:8080/geoserver/wfs?service=WFS&version=1.1.0&request=GetFeature&outputFormat=application/json&srsName=EPSG:4326&typeName=iurbains:regions&featureId='+parseInt(getParameters()['oneRegion']);
	
	var ajax = $.ajax({
		jsonp:false,
		type:'GET',
		url:url,
		async:true,
		dataType: 'json',
		success: function(data) {
			// AJOUTER UNE COUCHE SUR LA CARTE
			addLayerOnMap('regionsId', 'fill', regionsGs, ["==", "$id", parseInt(getParameters()["oneRegion"])], {visibility: "visible",}, {"fill-outline-color": "#3887be","fill-color": "#008D4C","fill-opacity": 0.5});
			zoomToLayer(data);
			putLayerOnLegende(1,data.features[0].properties.region_name_fr);
			//map.setMaxZoom(8);
		}
	});
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
// FONCTION D'AFFICHAGE D'UNE COUCHE DEPARTEMENT + ZOOM
function selectDepartmentLayer(){	
	if(map.getLayer('allDepartments')) {	map.removeLayer('allDepartments');	layerColors[5].layerState = 0;	$("#allDepartment").prop('checked', false);	}
	if(map.getLayer('departmentsId')) map.removeLayer('departmentsId');
	if(map.getLayer('townsId')) map.removeLayer('townsId');
	url = 'http://localhost:8080/geoserver/wfs?service=WFS&version=1.1.0&request=GetFeature&outputFormat=application/json&srsName=EPSG:4326&typeName=iurbains:departments&featureId='+parseInt(getParameters()['oneDepartment']);
	var ajax = $.ajax({
		jsonp:false,
		type:'GET',
		url:url,
		async:true,
		dataType: 'json',
		success: function(data) {
			// AJOUTER UNE COUCHE SUR LA CARTE
			addLayerOnMap('departmentsId', 'fill', departmentsGs, ["==", "$id", parseInt(getParameters()["oneDepartment"])], {visibility: "visible",}, {"fill-outline-color": "#3887be","fill-color": "#008D4C","fill-opacity": 0.7});
			zoomToLayer(data);
			putLayerOnLegende(2,data.features[0].properties.department_name_fr);
		}
	});
	makeTableMarkers(0);
	removeMarker();
}
// FONCTION D'AFFICHAGE D'UNE COUCHE COMMUNE + ZOOM
function selectTownLayer(){
	if(map.getLayer('townsId')) map.removeLayer('townsId');
	url = 'http://localhost:8080/geoserver/wfs?service=WFS&version=1.1.0&request=GetFeature&outputFormat=application/json&srsName=EPSG:4326&typeName=iurbains:towns&featureId='+parseInt(getParameters()['oneTown']);
	var ajax = $.ajax({
		jsonp:false,
		type:'GET',
		url:url,
		async:true,
		dataType: 'json',
		success: function(data) {
			// AJOUTER UNE COUCHE SUR LA CARTE
			addLayerOnMap('townsId', 'fill', townsGs, ["==", "$id", parseInt(getParameters()["oneTown"])], {visibility: "visible",}, {"fill-outline-color": "#3887be","fill-color": "#DD4B39","fill-opacity": 0.4});
			zoomToLayer(data);
			putLayerOnLegende(3,data.features[0].properties.town_name_fr);
		}
	});
	makeTableMarkers(1);
	removeMarker();
}
// FONCTION D'AJOUT DE LA LEGENDE
function addLegende(code){
	if(code == 1) $("#legend").empty();
	var item = document.createElement('div');
	var value = document.createElement('span');
	value.innerHTML = '<b>Légende</b>';
	item.appendChild(value);
	legend.appendChild(item);
	for (i = 0; i < layerColors.length; i++) {
		if(layerColors[i].layerState == 1){
			var couche = layerColors[i].layerType + layerColors[i].layerLabel;
			var color = layerColors[i].layerColor;
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
	}
}
// FONCTION D'INITIALISATION DES COULEURS DES COUCHES
function InitLayerColors(){
	layerColors[0] = new Array();
	layerColors[0].layerId = "regions";
	layerColors[0].layerLabel = "Cameroun";
	layerColors[0].layerType = "";
	layerColors[0].layerState = 1;
	layerColors[0].layerColor = "#B9D8B2";
	
	layerColors[1] = new Array();
	layerColors[1].layerId = "regionsId";
	layerColors[1].layerLabel = "";
	layerColors[1].layerType = "Region - ";
	layerColors[1].layerState = 0;
	layerColors[1].layerColor = "#5EB283";
	
	layerColors[2] = new Array();
	layerColors[2].layerId = "departmentsId";
	layerColors[2].layerLabel = "";
	layerColors[2].layerType = "Departement - ";
	layerColors[2].layerState = 0;
	layerColors[2].layerColor = "#1C985E";
	
	layerColors[3] = new Array();
	layerColors[3].layerId = "townsId";
	layerColors[3].layerLabel = "";
	layerColors[3].layerType = "Commune - ";
	layerColors[3].layerState = 0;
	layerColors[3].layerColor = "#69794F";
	
	layerColors[4] = new Array();
	layerColors[4].layerId = "allRegions";
	layerColors[4].layerLabel = "";
	layerColors[4].layerType = "";
	layerColors[4].layerState = 0;
	layerColors[4].layerColor = "#5EB283";
	
	layerColors[5] = new Array();
	layerColors[5].layerId = "allDepartments";
	layerColors[5].layerLabel = "";
	layerColors[5].layerType = "";
	layerColors[5].layerState = 0;
	layerColors[5].layerColor = "#1C985E";	
	
	layerColors[6] = new Array();
	layerColors[6].layerId = "allTowns";
	layerColors[6].layerLabel = "";
	layerColors[6].layerType = "";
	layerColors[6].layerState = 0;
	layerColors[6].layerColor = "#69794F";	
}
// FONCTION D'ACTIVATION DE LA COUCHE DANS LA LEGENDE
function putLayerOnLegende(id, elts){
	layerColors[id].layerState = 1;
	layerColors[id].layerLabel = elts;
	for (i = id+1; i < layerColors.length; i++) {
		layerColors[i].layerState = 0;
	}
	addLegende(1);
}
// FONCTION DE DESACTIVATION DE LA COUCHE DE LA LEGENDE
function removeLayerOnLegende(id){
	layerColors[id].layerState = 0;
	addLegende(1);
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

function makeTableMarkers(code){//code=1 -->town,,,,,,,,,,,,,,,code=0-->department
	if(code == 1){
		url = 'http://localhost:8080/geoserver/wfs?service=WFS&version=1.1.0&request=GetFeature&outputFormat=application/json&srsName=EPSG:4326&typeName=iurbains:towns&featureId='+parseInt(getParameters()['oneTown']);
	}else{
		url = 'http://localhost:8080/geoserver/wfs?service=WFS&version=1.1.0&request=GetFeature&outputFormat=application/json&srsName=EPSG:4326&typeName=iurbains:towns&cql_filter=department_id='+parseInt($('#department').val());
	}
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
				markerTable[parseInt(e.id.split(".")[1])].marker ="";
				markerTable[parseInt(e.id.split(".")[1])].indicator = "";
				markerTable[parseInt(e.id.split(".")[1])].microdata = "";
				
				val = e.geometry.coordinates[0][0];
				markerTable[parseInt(e.id.split(".")[1])].bounds = val.reduce(function(bounds, coord) {	return bounds.extend(coord);	}, new mapboxgl.LngLatBounds(val[0], val[0]));
				i++;
			});
		}
	});
}
// FONCTION D'AFFICHAGE D'UNE MICRODONNEE
function setMarkerForMicrodata(mdId){//if(getParameters()["oneTown"] == "") alert(getParameters()["oneTown"]);
	$.ajax({
		url: $('#urlValMd').val(),
		type: "GET",
		data: 'region=' + $('#region').val() + '&department=' + $('#department').val() + '&town=' + $('#town').val() + '&version=' + $('#version').val() + '&microdata=' + mdId,
		success: function(data) {
			//removeMarker();
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
			for(i=0;i<townMarker.length;i++){
				var mdClass = getClassFromData(minMax, markerTable[townMarker[i]].microdata);
				// AJOUTER UNE COUCHE SUR LA CARTE
				if(!map.getLayer('townsId')) addLayerOnMap(markerTable[townMarker[i]].townName, 'fill', townsGs, ["==", "$id", parseInt(townMarker[i])], {visibility: "visible",}, {"fill-outline-color": "#3887be","fill-color": "#DD4B39","fill-opacity": 0.4});
				var elt = document.createElement('div');
				elt.className = 'fa fa-map-marker';
				elt.style = 'font-size:20px;color:'+classColors[mdClass];
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
			if(getParameters()["oneTown"] == "") putLayerOnLegende(6,"Communes sélectionnées");
		}
	});
}
// FONCTION DE SUPPRESSION DE TOUS LES MARKERS
function removeMarker() {
	for(i=0;i<townMarker.length;i++){
		if(markerTable[townMarker[i]].marker){
			markerTable[townMarker[i]].marker.remove();
			markerTable[townMarker[i]].marker = "";
		}
		if(map.getLayer(markerTable[townMarker[i]].townName)){
			map.removeLayer(markerTable[townMarker[i]].townName);
		}
	}/**/
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
/*
function loadWFS(layerName, epsg) {
	
	map = L.map('map').setView([7, 16], 6);
	var basemap = L.tileLayer('http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', { attribution: '&copy; <a href="http://www.osm.org">OpenStreetMap</a>' }).addTo(map);	
	//loadWFS("iurbains:regions", "EPSG:4326");
	
	var defaultParameters = {
		service: 'WFS',
		version: '1.1.0',
		request: 'GetFeature',
		typeName: layerName,
		maxFeatures:200,
		outputFormat: 'application/json',
		format_options: 'callback: getJson',
		featureId:2,
		srsName: epsg
	};
	var parameters = mapboxgl.Util.extend(defaultParameters);
	var url = urlToGeoserverWorkspace + mapboxgl.Util.getParamString(parameters);
	
	console.log(url);
	
	var ajax = $.ajax({
		jsonp:false,
		type:'GET',
		url:url,
		async:true,
		dataType: 'json',
		jsonpCallback: 'getJson',
		success: handleJson
	});
	console.log(ajax);
	 
	//var group = new L.featureGroup().addTo(map);
}*/