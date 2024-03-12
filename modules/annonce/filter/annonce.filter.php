<?php
/**
 * Action of Annonce module.
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\annonce\Filters
 * @since     2.0.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit;

/**
 * Action of "Hello_World" module.
 */
class Annonce_Filters {

	/**
	 * Constructor
	 *
	 * @since 2.0.0
	 * @version 2.0.0
	 */
	public function __construct() {
		add_filter( 'acf/settings/load_json', array( $this, 'annonces_annonce_json_load' ) );
		add_filter( 'single_template', array( $this, 'get_custom_post_type_template' ), 11 );
		add_filter( 'acf/load_field', array( $this, 'display_hide_fields' ) );
	}

	/**
	 * Add a json acf directory
	 *
	 * @since  2.0.0
	 * @param  Array $paths Acf folders.
	 * @return Array $paths Acf folders
	 */
	public function annonces_annonce_json_load( $paths ) {
		$paths[] = ANNONCES_PATH . 'modules/annonce/asset/json';
		return $paths;
	}

	/**
	 * Get template for single post type
	 *
	 * @since  2.0.0
	 * @param  string $single_template Template path.
	 * @return string $single_template Template path.
	 */
	public function get_custom_post_type_template( $single_template ) {
		global $post;

		if ( is_singular( 'announce' ) ) {
			$single_template = \annonces\Annonces_Util::get_instance()->get_module_view_path( 'annonce', 'single-announce' );
		}

		return $single_template;
	}

	public function display_hide_fields( $field ) {
		// Masquer les chams Open Street Map.
		if ( 'gmap' == get_option( 'annonces_library' ) ) {
			if ( $field['name'] == 'adresse_complete' || $field['name'] == 'lat' || $field['name'] == 'lng' ) {
				return;
			}
		}
		// Masquer les chams Google.
		if ( 'openstreetmap' == get_option( 'annonces_library' ) ) {
			if ( $field['name'] == 'address' ) {
				return;
			}
		}

		return $field;
	}
}

new Annonce_Filters();
