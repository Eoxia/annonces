/**
 * Module Annonce Gmap
 * @since 2.0.0
 */

/**
 * La méthode "init" est appelé automatiquement par la lib JS de Eo-Framework
 *
 * @since 2.0.0
 * @return {void}
 */
function annonceInit() {
	annonceInitMap();
}

/**
 * Init Google Map
 *
 * @since 2.0.0
 * @return {void}
 */
function annonceInitMap() {
	var $map = jQuery( '#annonces-map-wrapper' );

	jQuery( $map ).each(function() {
		annonceCreateMap( jQuery( this ) );
	});
}

/**
 * Create map and markers
 *
 * @since  2.0.0
 * @param  {Array} map Map wrapper
 * @return {void}
 */
function annonceCreateMap( map ) {
	if ( map == undefined || map.length == 0 ) return;

	var $map = map;
	// var france = {lat: 48.856614, lng: 2.352222};
	var $markers = jQuery( $map ).find( 'marker' );
	var myLatlng = new google.maps.LatLng($markers.attr('lat'),$markers.attr('lng'));
	var $listMarker = [];
	var $htmlMarker = [];
	var args = {
		zoom: 8,
		center: myLatlng,
		fullscreenControl: false,
	};
	var $gMap = new google.maps.Map( jQuery( $map ).find( '#annonces-google-map' )[0], args );


	jQuery( $markers ).each(function() {
		var marker = annonceCreateMarker( $gMap, jQuery( this ) );
		var infoWindow = annonceCreateInfoWindow( jQuery( this ) );

		if ( jQuery( this ).html().length != 0 ) {
			marker.addListener('click', function() {
				infoWindow.open($map, marker);
			});
		}

		$listMarker.push( marker );
		$htmlMarker.push( jQuery( this ) );
	});

	jQuery( '.annonces-taxonomies .taxonomy-label' ).on( 'click', function() {
		if ( jQuery( this ).hasClass( 'active' ) ) {
			annonceDisplayMapMarkers( $htmlMarker, $listMarker, null, jQuery( this ).attr( 'data-id' ).split( ',' ) );
			jQuery( this ).removeClass( 'active' );
			jQuery( this ).next('.taxonomies-child').find( '.taxonomy-label' ).removeClass( 'active' );
		} else {
			annonceDisplayMapMarkers( $htmlMarker, $listMarker, $gMap, jQuery( this ).attr( 'data-id' ).split( ',' ) );
			jQuery( this ).addClass( 'active' );
			jQuery( this ).next('.taxonomies-child').find( '.taxonomy-label' ).addClass( 'active' );
		}

	});
};

/**
 * Create marker
 *
 * @since  2.0.0
 * @param  {Array} map Map
 * @param  {Array} marker Map marker
 * @return {void}
 */
function annonceCreateMarker( map, marker ) {
	var $map = map;
	var $marker = marker;
	var myLatLng = {lat: Number( $marker.attr('lat') ), lng: Number( $marker.attr('lng') )};
	if ( $marker.attr('pin') != undefined ) {
		var iconUrl = annonces_data.url + '/modules/annonce/asset/img/pin-' + $marker.attr('pin') + '.png'; /** annonces_data is obtained with php enqueue */
	} else {
		var iconUrl = annonces_data.url + '/modules/annonce/asset/img/pin-red.png';
	}

	return new google.maps.Marker({
		position: myLatLng,
		map: $map,
		animation: google.maps.Animation.DROP,
		icon: iconUrl,
	});
};

/**
 * Create infowindow
 *
 * @since  2.0.0
 * @param  {Array} marker Map marker
 * @return {void}
 */
function annonceCreateInfoWindow( marker ) {
	var $marker = marker;

	return new google.maps.InfoWindow({
		content: $marker.html()
	});
};

/**
 * Display or Hide markers
 *
 * @since  2.0.0
 * @param  {Array} htmlMarker Array with the marker html
 * @param  {Array} listMarkers Array with the google marker
 * @param  {Array} map Map
 * @return {void}
 */
function annonceDisplayMapMarkers( htmlMarker, listMarkers, map, listTaxId ) {
	for (var i = 0; i < listMarkers.length; i++) {
		var taxonomies = htmlMarker[i].attr( 'taxonomy' ).split( ',' );
		/** Loop over all markers */
		taxonomies.forEach(function(tax) {
			/** Loop over all chosen taxonomies */
			listTaxId.forEach(function(id) {
				if ( tax == id ) {
					listMarkers[i].setMap(map);
				}
			});
		});
	}
}
