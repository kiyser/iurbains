//Mapbox key : pk.eyJ1Ijoia2l5c2VyIiwiYSI6ImNrMjR5bGR2cDA2ZGwzYmt4aGs1enRjeXoifQ.5xrRklqYoUdarsCksuav2w
// DECLARATION DES VARIABLES GLOBALES
var map;
var regionsGeoJs;
var departmentsGeoJs;
var townsGeoJs;
var markerMicrodata;
var markerIndicator;
var latTown;
var lngTown;

function initialize() {
	L.mapbox.accessToken = 'pk.eyJ1Ijoia2l5c2VyIiwiYSI6ImNrMjR5bGR2cDA2ZGwzYmt4aGs1enRjeXoifQ.5xrRklqYoUdarsCksuav2w';
	map = L.mapbox.map('map', null, { zoomControl: true })
		.setView([7, 16], 6)
	;
	var layers = {
      MapboxStreets: L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'),
      MapboxLight: L.mapbox.styleLayer('mapbox://styles/mapbox/light-v10'),
      MapboxSatellite: L.mapbox.styleLayer('mapbox://styles/mapbox/satellite-v9'),
	  OpenStreetMap: L.tileLayer('http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', { attribution: '&copy; <a href="http://www.osm.org">OpenStreetMap</a>' })
	};
	layers.MapboxStreets.addTo(map);
	L.control.layers(layers).addTo(map).setPosition('topleft');
	
	//L.control.scale().addTo(map);
	//new L.Control.Zoom({ position: 'topleft' }).addTo(map);
	// COUCHE CAMEROUN
	var camerounGeoJs = L.geoJson(cameroun, {style :{ weight: 0, opacity: 1, color: '#3C8DBC', fillOpacity: 0.4} }).addTo(map);
	regionsGeoJs = L.geoJson(regions);
	departmentsGeoJs = L.geoJson(departments);
	townsGeoJs = L.geoJson(towns);
	map.legendControl.addLegend(document.getElementById('legend').innerHTML).setPosition('bottomleft');
	
}
/*********************************************************************/
/////////////////// GESTION DE LA COUCHE REGION ///////////////////////
/*********************************************************************/
// FONCTION DE RECHERCHE DE L'IDENTIFIANT OBJET D'UNE REGION
function regionIdObject(regionsObj){
	for(i=0;i<10;i++){
		if(regionsObj[i]['properties']['id'] == $('#region').val()) return i;
	}
}
// ACTION APRES CLICK SUR UNE REGION
function onRegionClick(e) {
	regionsGeoJs.bindPopup("<b>Région : "+regions['features'][regionIdObject(regions['features'])]['properties']['region_name_fr']+"</b>").openPopup();
}
// FONCTION D'AFFICHAGE D'UNE COUCHE REGION
function selectRegionLayer(){
	map.removeLayer(regionsGeoJs);
	map.removeLayer(departmentsGeoJs);
	map.removeLayer(townsGeoJs);
	regionsGeoJs = L.geoJson(regions['features'][regionIdObject(regions['features'])], {style :{ weight: 0, opacity: 1, color: '#008D4C', fillOpacity: 0.4} }).addTo(map);
	map.setView([regionsGeoJs.getBounds().getCenter()['lat'], regionsGeoJs.getBounds().getCenter()['lng']], 8);
	//map.fitBounds(regionsGeoJs.getBounds());
	//regionsGeoJs.on('click', onRegionClick);
	regionsGeoJs.bindPopup("<b>Région : "+regions['features'][regionIdObject(regions['features'])]['properties']['region_name_fr']+"</b>").openPopup();
}
/*********************************************************************/
/////////////////// GESTION DE LA COUCHE DEPARTMENT ///////////////////
/*********************************************************************/
// FONCTION DE RECHERCHE DE L'IDENTIFIANT OBJET D'UN DEPARTEMENT
function departmentIdObject(departmentsObj){
	for(i=0;i<58;i++){
		if(departmentsObj[i]['properties']['id'] == $('#department').val()) return i;
	}
}
// ACTION APRES CLICK SUR UN DEPARTEMENT
function onDepartmentClick(e) {
	departmentsGeoJs.bindPopup("<b>Département : "+departments['features'][departmentIdObject(departments['features'])]['properties']['department_name_fr']+"</b>").openPopup();
}
// FONCTION D'AFFICHAGE D'UNE COUCHE DEPARTEMENT
function selectDepartmentLayer(){
	map.removeLayer(departmentsGeoJs);
	map.removeLayer(townsGeoJs);
	departmentsGeoJs = L.geoJson(departments['features'][departmentIdObject(departments['features'])], {style :{ weight: 0, opacity: 1, color: '#008D4C', fillOpacity: 0.6} }).addTo(map);	
	map.fitBounds(departmentsGeoJs.getBounds());
	//departmentsGeoJs.on('click', onDepartmentClick);
	departmentsGeoJs.bindPopup("<b>Département : "+departments['features'][departmentIdObject(departments['features'])]['properties']['department_name_fr']+"</b>").openPopup();
}
/*********************************************************************/
///////////////////// GESTION DE LA COUCHE COMMUNE ////////////////////
/*********************************************************************/
// FONCTION DE RECHERCHE DE L'IDENTIFIANT OBJET D'UNE COMMUNE
function townIdObject(townsObj){
	for(i=0;i<360;i++){
		if(townsObj[i]['properties']['id'] == $('#town').val()) return i;
	}
}
// ACTION APRES CLICK SUR UNE COMMUNE
function onTownClick(e) {
	townsGeoJs.bindPopup("<b>Commune : "+towns['features'][townsObj(towns['features'])]['properties']['town_name_fr']+"</b>").openPopup();
}
// FONCTION D'AFFICHAGE D'UNE COUCHE COMMUNE
function selectTownLayer(){
	map.removeLayer(townsGeoJs);
	townsGeoJs = L.geoJson(towns['features'][townIdObject(towns['features'])], {style :{ weight: 0, opacity: 1, color: '#D33C44', fillOpacity: 0.5} }).addTo(map);	
	map.fitBounds(townsGeoJs.getBounds());
	//townsGeoJs.on('click', onTownClick);
	townsGeoJs.bindPopup("<b>Commune de "+towns['features'][townIdObject(towns['features'])]['properties']['town_name_fr']+"</b>").openPopup();
	latTown = townsGeoJs.getBounds().getCenter()['lat'];
	lngTown = townsGeoJs.getBounds().getCenter()['lng'];
}
// FONCTION D'AFFICHAGE D'UNE MICRODONNEE
function setMicrodata(id){	
	markerMicrodata = L.marker([latTown, lngTown]).addTo(map);
}