<?php
/**
 * Mains actions of module
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\Actions
 * @since     2.0.0
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
		add_action( 'admin_enqueue_scripts', array( $this, 'callback_admin_enqueue_scripts' ), 11 );
		add_action( 'wp_enqueue_scripts', array( $this, 'callback_front_enqueue_scripts' ), 11 );
		add_action( 'tgmpa_register', array( Annonces_Util::g(), 'annonces_register_required_plugins' ), 11 );
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
		// wp_enqueue_style( 'annonces-backend-style', PLUGIN_ANNONCES_URL . 'core/asset/css/style.css', array(), \eoxia\Config_Util::$init['annonces']->version );
		// wp_enqueue_script( 'annonces-backend-script', PLUGIN_ANNONCES_URL . 'core/asset/js/backend.min.js', array(), \eoxia\Config_Util::$init['annonces']->version );
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
		wp_enqueue_style( 'annonces-frontend-style', PLUGIN_ANNONCES_URL . 'core/asset/css/style.css', array(), \eoxia\Config_Util::$init['annonces']->version );

		/** URl of module in javascipt */
		wp_register_script( 'annonces-frontend-script', PLUGIN_ANNONCES_URL . 'core/asset/js/backend.min.js', array(), \eoxia\Config_Util::$init['annonces']->version );
		wp_localize_script( 'annonces-frontend-script', 'annonces_data', array( 'url' => PLUGIN_ANNONCES_URL ) );
		wp_enqueue_script( 'annonces-frontend-script' );

		/** Aller chercher la clé entrée dans les options de configuration */
		// $api_key = 'AIzaSyAjNX-2ycIAskm4GmdWpmYhSG0XCHB2KgY';
		$api_key = get_option( 'annonces_google_key' );
		wp_enqueue_script( 'annonces-google-map-api', 'https://maps.googleapis.com/maps/api/js?key=' . $api_key, array(), '', true );
	}
}

new Core_Action();
