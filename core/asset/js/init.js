/**
 * Fichier init javascript
 * @since 2.0.0
 */
jQuery( document ).ready(function() {
	/** Lancer les fonctions init */
	if ( annonces_data.library == 'gmap' ) {
		annonceInit();
	}
	if ( annonces_data.library == 'openstreetmap' ) {
		annonceOSMapInit();
	}

})
