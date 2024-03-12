<?php
/**
 * Action of Annonce module.
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\annonce\Actions
 * @since     2.2.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit;

/**
 * Main class of the theme
 */
class Annonce_Shortcode {
	/**
	 * Constructor
	 */
	public function __construct() {
		add_shortcode( 'annonces', array( $this, 'annonces_display_shortcode' ) );
	}

	/**
	 * Création du shortcode annuaire
	 *
	 * @method annonces_display_shortcode
	 * @param  Array $atts id et template.
	 * @return content of diapo
	 */
	public function annonces_display_shortcode( $atts ) {
		$annonces_map_query = new \WP_Query( array(
			'post_type'      => 'announce',
			'posts_per_page' => -1,
		) );

		if ( ! empty( $annonces_map_query->posts ) ) {
			foreach ( $annonces_map_query->posts as &$annonce ) {
				/** Address field */
				if ( 'gmap' == get_option( 'annonces_library' ) ) {
					$annonce_gmap = get_field( 'address', $annonce->ID );
					if ( ! empty( $annonce_gmap ) ) {
						$annonce->address = $annonce_gmap['address'];
						$annonce->lat     = $annonce_gmap['lat'];
						$annonce->lng     = $annonce_gmap['lng'];
					}
				}
				if ( 'openstreetmap' == get_option( 'annonces_library' ) ) {
					$annonce->address = esc_html( get_field( 'adresse_complete', $annonce->ID ) );
					$annonce->lat     = esc_html( get_field( 'lat', $annonce->ID ) );
					$annonce->lng     = esc_html( get_field( 'lng', $annonce->ID ) );
				}

				/** Datas to display in infowindow */
				$microdata      = array(
					array(
						'icon'    => 'envelope',
						'title'   => __( 'Email', 'annonces' ),
						'content' => get_field( 'email', $annonce->ID ),
					),
					array(
						'icon'    => 'mobile-alt',
						'title'   => __( 'Phone number', 'annonces' ),
						'content' => get_field( 'telephone', $annonce->ID ),
					),
					array(
						'icon'    => 'map-marker-alt',
						'title'   => __( 'Address', 'annonces' ),
						'content' => $annonce->address,
					),
				);
				$annonce->datas = apply_filters( 'set_marker_data', $microdata, $annonce->ID );

				/** All taxonomies of the announce */
				$taxonomies   = wp_get_post_terms( $annonce->ID, 'announce_taxonomy', array() );
				$annonce->tax = '';
				if ( ! empty( $taxonomies ) ) :
					foreach ( $taxonomies as $element ) :
						$annonce->tax .= $element->term_id . ',';
					endforeach;
				endif;
				$annonce->tax = substr( $annonce->tax, 0, -1 );

				/** Pin color of the announce */
				if ( 0 === $taxonomies[0]->parent ) :
					$annonce->pin = get_field( 'icon', 'announce_taxonomy_' . $taxonomies[0]->term_id );
				else :
					$annonce->pin = get_field( 'icon', 'announce_taxonomy_' . $taxonomies[0]->parent );
				endif;
			}
		}

		/** List of all taxonomies */
		$taxonomies_datas                    = new \stdClass();
		$taxonomies_datas->taxonomies_parent = get_terms( array(
			'taxonomy'     => 'announce_taxonomy',
			'parent'       => 0,
			'hierarchical' => true,
			'hide_empty'   => false,
		) );
		/** Construct of the child tax array */
		foreach ( $taxonomies_datas->taxonomies_parent as $parent ) {
			$parent->taxonomies_child      = get_terms( array(
				'taxonomy'     => 'announce_taxonomy',
				'parent'       => $parent->term_id,
				'hierarchical' => true,
				'hide_empty'   => false,
			) );

			/** List of all tax ID */
			$parent->list_tax_id = $parent->term_id . ',';
			if ( ! empty( $parent->taxonomies_child ) ) {
				foreach ( $parent->taxonomies_child as $child ) {
					$parent->list_tax_id .= $child->term_id . ',';
				}
			}
			$parent->list_tax_id = substr( $parent->list_tax_id, 0, -1 );

			/** Pin color of the child */
			$parent_marker_data = get_field( 'icon', $parent );
			$parent_marker_data = ( ! empty( $parent_marker_data ) ) ? $parent_marker_data : 'red';
			$parent->marker     = ANNONCES_URL . 'modules/annonce/asset/img/pin-' . $parent_marker_data . '.png';
		}

		/** Title of filter bloc */
		$filter_title                       = __( 'Announces', 'annonces' );
		$taxonomies_datas->taxonomies_title = apply_filters( 'bloc_filter_title', $filter_title );

		$shortcode_atts = shortcode_atts( array(
			'mapargs' => '',
		), $atts, 'annonces' );

		if ( ! empty( $shortcode_atts['mapargs'] ) ) {
			$map_args      = array();
			$map_args_data = explode( ',', $shortcode_atts['mapargs'] );
			foreach ( $map_args_data as $map_arg ) {
				$arg        = explode( ':', $map_arg ); // Separe name and value
				$parenthese = preg_match( '#\(+(.*)\)+#', $arg[1], $value_type ); // Get value type in parenthesis
				$arg_value  = preg_replace( '#\(+(.*)\)+#', '', $arg[1]); // Delete value type
				if ( ! empty( $value_type ) ) {
					settype($arg_value, $value_type[1]); // Change type of value according to parenthesis
				}

				$map_args[$arg[0]] = $arg_value;
			}

			$shortcode_atts['mapargs'] = $map_args;
		}

		ob_start();
			$view_path = \annonces\Annonces_Util::get_instance()->get_module_view_path( 'annonce', 'main.view' );
			include $view_path;

		return ob_get_clean();
	}
}

new Annonce_Shortcode();
