<?php
/**
 * Mains actions of module
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @License   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\Actions
 * @since     2.2.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit;

/**
 * Main actions of annonces
 */
class Core_Action {

	/**
	 * Constructor
	 *
	 * @since 2.0.0
	 * @version 2.0.0
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'callback_front_enqueue_scripts' ), 11 );
		add_action( 'tgmpa_register', array( \annonces\Annonces_Util::get_instance(), 'annonces_register_required_plugins' ), 11 );

		add_action( 'init', array( $this, 'load_languages' ) );
	}

	/**
	 * Init style and script
	 *
	 * @since 2.0.0
	 * @version 2.0.0
	 *
	 * @return void nothing
	 */
	public function callback_admin_enqueue_scripts() {
	}

	/**
	 * Init style and script in frontend
	 *
	 * @since 2.0.0
	 * @version 2.0.0
	 *
	 * @return void nothing
	 */
	public function callback_front_enqueue_scripts() {
		wp_enqueue_style( 'annonces-frontend-style', ANNONCES_URL . 'core/asset/css/style.css' );

		/** URl of module in javascipt */
		wp_register_script( 'annonces-frontend-script', ANNONCES_URL . 'core/asset/js/backend.min.js', 'jquery' );
		wp_localize_script( 'annonces-frontend-script', 'annonces_data', array( 'url' => ANNONCES_URL ) );
		wp_enqueue_script( 'annonces-frontend-script' );

		/** Aller chercher la clé entrée dans les options de configuration */
		$api_key = get_option( 'annonces_google_key' );
		wp_enqueue_script( 'annonces-google-map-api', 'https://maps.googleapis.com/maps/api/js?key=' . $api_key, array(), '', true );
	}

	/**
	 * Initialise le fichier MO
	 *
	 * @since 0.1.0
	 * @version 0.1.0
	 */
	public function load_languages() {
		load_plugin_textdomain( 'annonces', false, ANNONCES_DIR . '/core/asset/languages/' );
	}
}
new Core_Action();
