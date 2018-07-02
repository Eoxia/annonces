<?php
/**
 * Action of Option Module.
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\option\Actions
 * @since     2.0.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit;

/**
 * Action of "Hello_World" module.
 */
class Option_Action {

	/**
	 * Constructor
	 *
	 * @since 2.0.0
	 * @version 2.0.0
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'callback_admin_menu' ) );
		add_action( 'wp_ajax_save_annonces_google_key', array( $this, 'callback_save_annonces_google_key' ) );
	}


	/**
	 * Add submenu "Annonces" in WP Options.
	 *
	 * @since 2.0.0
	 * @version 2.0.0
	 */
	public function callback_admin_menu() {
		add_submenu_page( 'options-general.php', __( 'Announces', 'annonces' ), __( 'Announces', 'annonces' ), 'manage_options', 'announces-options', array( $this, 'callback_add_menu_page' ) );
	}

	/**
	 * Display view of the submenu "Announces Options".
	 *
	 * @since 2.0.0
	 * @version 2.0.0
	 */
	public function callback_add_menu_page() {
		\eoxia\View_Util::exec( 'annonces', 'option', 'main' );
	}

	/**
	 * Sauvegardes le domaine de l'email dans la page "Digirisk" dans le menu "Utilisateurs" de WordPress.
	 *
	 * @return void
	 *
	 * @since 6.0.0
	 * @version 6.6.0
	 */
	public function callback_save_annonces_google_key() {
		check_ajax_referer( 'save_annonces_google_key' );
		$google_key        = ! empty( $_POST['annonces_google_key'] ) ? sanitize_text_field( $_POST['annonces_google_key'] ) : '';
		$permalink_annonce = ! empty( $_POST['permalink_annonce'] ) ? sanitize_title( $_POST['permalink_annonce'] ) : '';

		update_option( 'annonces_google_key', $google_key );
		update_option( 'permalink_annonce', $permalink_annonce );
		wp_send_json_success();
	}
}

new Option_Action();
