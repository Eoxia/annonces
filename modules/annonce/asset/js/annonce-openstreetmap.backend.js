/**
 * Module Annonce Open Street Map
 * @since 2.4.0
 */

/**
 * La méthode "init" est appelé automatiquement par la lib JS de Eo-Framework
 *
 * @since 2.0.0
 * @return {void}
 */
function annonceOSMapInit() {
	annonceInitOpenStreetMap();
}

/**
 * Init Google Map
 *
 * @since 2.0.0
 * @return {void}
 */
function annonceInitOpenStreetMap() {
	var $map = jQuery( '#annonces-map-wrapper' );

	jQuery( $map ).each(function() {
		annonceCreateOSMap( jQuery( this ) );
	});
}

/**
 * Create map and markers
 *
 * @since  2.0.0
 * @param  {Array} map Map wrapper
 * @return {void}
 */
function annonceCreateOSMap( map ) {
	if ( map == undefined || map.length == 0 ) return;

	// Création de la carte, centrée sur Paris.
	var lat = 48.852969;
	var lng = 2.349903;
	var $currentMap = L.map('annonces-google-map').setView([lat, lng], 5);
	var $listMarkers = [];
	var $htmlMarker = [];


	L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
		// Il est toujours bien de laisser le lien vers la source des données
		attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
		minZoom: 1,
		maxZoom: 20
	}).addTo($currentMap);

	// Ajout des markers.
	var $markers = jQuery( map ).find( 'marker' );

	jQuery( $markers ).each(function() {
		// var marker = annonceCreateOSMarker($currentMap, jQuery(this));
		annonceGetAddressAttr( jQuery(this).attr('address') ).then( (data) => {
			$marker = jQuery(this);
			if ( data.length > 0 ) {
				lat = data[0]['lat'];
				lng = data[0]['lon'];
			} else {
				lat = Number( jQuery(this).attr('lat') );
				lng = Number( jQuery(this).attr('lng') );
			}
			// Create marker with datas
			annonceCreateOSMarker($currentMap, $marker, lat, lng);
			// Craete popup
			annonceBindPopupOSMarker($currentMap, $marker, finalMarker);
			// Push the variable with all markers
			$listMarkers.push(finalMarker);
			$htmlMarker.push(jQuery(this));

			var group = new L.featureGroup($listMarkers);
			$currentMap.fitBounds(group.getBounds().pad(0.5), { duration: 0.5 });
		});
	});

	jQuery( '.annonces-taxonomies .taxonomy-label' ).on( 'click', function() {
		if ( jQuery( this ).hasClass( 'active' ) ) {
			annonceDisplayOSMapMarkers( $htmlMarker, $listMarkers, $currentMap, jQuery( this ).attr( 'data-id' ).split( ',' ) );
			jQuery( this ).removeClass( 'active' );
			jQuery( this ).next('.taxonomies-child').find( '.taxonomy-label' ).removeClass( 'active' );
		} else {
			annonceDisplayOSMapMarkers( $htmlMarker, $listMarkers, $currentMap, jQuery( this ).attr( 'data-id' ).split( ',' ) );
			jQuery( this ).addClass( 'active' );
			jQuery( this ).next('.taxonomies-child').find( '.taxonomy-label' ).addClass( 'active' );
		}
	});
};

/**
 * Get Adress Lat & Lng
 *
 * @param address
 * @returns {Promise<*>}
 */
async function annonceGetAddressAttr(address) {
	var address
	let result;
	try {
		result = await jQuery.getJSON('https://nominatim.openstreetmap.org/search?q=' + address + '&format=json&polygon=1&addressdetails=1');
		return result;
	} catch (error) {
		console.log(error); 
	}
}

/**
 * Create marker
 *
 * @since  2.0.0
 * @param  {Array} map Map
 * @param  {Array} marker Map marker
 * @return {void}
 */
async function annonceCreateOSMarker( map, marker, lat, lng) {
	var $map = map;
	var $marker = marker;

	if ( $marker.attr('pin') != undefined ) {
		var iconUrl = annonces_data.url + '/modules/annonce/asset/img/pin-' + $marker.attr('pin') + '.png'; /** annonces_data is obtained with php enqueue */
	} else {
		var iconUrl = annonces_data.url + '/modules/annonce/asset/img/pin-red.png';
	}
	var myIcon = L.icon({
		iconUrl: iconUrl,
		iconSize: [40, 40],
		iconAnchor: [20, 40],
		popupAnchor: [0, -40],
	});

	finalMarker = L.marker([lat, lng], {icon: myIcon}).addTo($map);
};

function annonceBindPopupOSMarker( map, marker, finalMarker ) {
	var $map = map;
	var $marker = marker;
	var $finalMarker = finalMarker;

	finalMarker.bindPopup($marker.html());
}

/**
 * Display or Hide markers
 *
 * @since  2.0.0
 * @param  {Array} htmlMarker Array with the marker html
 * @param  {Array} listMarkers Array with the google marker
 * @param  {Array} map Map
 * @return {void}
 */
function annonceDisplayOSMapMarkers( htmlMarker, listMarkers, map, listTaxId ) {
	if ( listMarkers.length == 0 ) return;
	for (var i = 0; i < listMarkers.length; i++) {
		var taxonomies = htmlMarker[i].attr( 'taxonomy' ).split( ',' );
		/** Loop over all markers */
		taxonomies.forEach(function(tax) {
			/** Loop over all chosen taxonomies */
			listTaxId.forEach(function(id) {
				if ( tax == id ) {
					if(map.hasLayer(listMarkers[i])) {
						map.removeLayer(listMarkers[i]);
					} else {
						map.addLayer(listMarkers[i]);
					}
				}
			});
		});
	}
}
