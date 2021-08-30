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
		add_action('admin_menu', array($this, 'callback_admin_menu'));
//		add_action('wp_ajax_save_annonces_options', array($this, 'callback_save_annonces_options'));
		add_action('admin_init', array($this, 'add_permalink_setting'));
		add_action('load-options-permalink.php', array($this, 'update_permalink_setting_value'));
	}


	/**
	 * Add submenu "Annonces" in WP Options.
	 *
	 * @since 2.0.0
	 */
	public function callback_admin_menu() {
		add_submenu_page('options-general.php', __('Announces', 'annonces'), __('Announces', 'annonces'), 'manage_options', 'announces-options', array($this, 'callback_add_menu_page'));
	}

	/**
	 * Display view of the submenu "Announces Options".
	 *
	 * @since 2.0.0
	 * @version 2.0.0
	 */
	public function callback_add_menu_page() {
		if ( isset( $_POST['annonces_google_key'] ) ) {
			$google_key = !empty($_POST['annonces_google_key']) ? sanitize_text_field($_POST['annonces_google_key']) : '';
			update_option('annonces_google_key', $google_key);
		}

		$view_path = \annonces\Annonces_Util::get_instance()->get_module_view_path('option', 'main.view');
		include $view_path;
	}

	/**
	 * Save permalink option
	 *
	 * @return void
	 * @since 2.0.0
	 */
	public function add_permalink_setting() {
		add_settings_section(
			'permalink_session_annonce',
			__('Announces', 'annonces'),
			null,
			'permalink'
		);

		add_settings_field(
			'permalink_annonce',
			__('Permalink Announce', 'annonces'),
			array($this, 'eg_setting_callback_function'),
			'permalink',
			'permalink_session_annonce'
		);
		add_settings_field(
			'permalink_annonce_tax',
			__('Permalink Announce taxonomy', 'annonces'),
			array($this, 'eg_setting_tax_callback_function'),
			'permalink',
			'permalink_session_annonce'
		);

		register_setting('permalink', 'permalink_annonce');
		register_setting('permalink', 'permalink_annonce_tax');
	}

	/**
	 * Display permalink field view
	 *
	 * @return void
	 * @since 2.0.0
	 */
	public function eg_setting_callback_function() {
		$main_view = \annonces\Annonces_Util::get_instance()->get_module_view_path('option', 'permalink-field.view');
		include $main_view;
	}

	/**
	 * Display permalink field view
	 *
	 * @return void
	 * @since 2.0.0
	 */
	public function eg_setting_tax_callback_function() {
		$main_view = \annonces\Annonces_Util::get_instance()->get_module_view_path('option', 'permalink-field-tax.view');
		include $main_view;
	}

	/**
	 * Update manually permalink data
	 *
	 * @return void
	 * @since 2.0.0
	 */
	public function update_permalink_setting_value() {
		if (isset($_POST['permalink_annonce'])) {
			$permalink_annonce = !empty($_POST['permalink_annonce']) ? sanitize_title($_POST['permalink_annonce']) : '';
			update_option('permalink_annonce', $permalink_annonce);
		}

		if (isset($_POST['permalink_annonce'])) {
			$permalink_annonce_tax = !empty($_POST['permalink_annonce_tax']) ? sanitize_title($_POST['permalink_annonce_tax']) : '';
			update_option('permalink_annonce_tax', $permalink_annonce_tax);
		}
	}

}
new Option_Action();
