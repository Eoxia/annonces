<?php
/**
 * Action of Annonce module.
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\annonce\Actions
 * @since     2.0.0
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
				$annonce->address = get_field( 'address', $annonce->ID );
				$microdata        = array(
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
						'content' => $annonce->address['address'],
					),
				);
				$annonce->datas   = apply_filters( 'set_marker_data', $microdata, $annonce->ID );
				$taxonomies       = wp_get_post_terms( $annonce->ID, 'announce_taxonomy', array() );

				$annonce->tax = '';
				if ( ! empty( $taxonomies ) ) :
					foreach ( $taxonomies as $element ) :
						$annonce->tax .= $element->term_id . ',';
					endforeach;
				endif;
				$annonce->tax = substr( $annonce->tax, 0, -1 );

				if ( 0 === $taxonomies[0]->parent ) :
					$annonce->pin = get_field( 'icon', 'announce_taxonomy_' . $taxonomies[0]->term_id );
				else :
					$annonce->pin = get_field( 'icon', 'announce_taxonomy_' . $taxonomies[0]->parent );
				endif;
			}
		}

		$taxonomies_datas                    = new \stdClass();
		$taxonomies_datas->taxonomies_parent = get_terms( array(
			'taxonomy'     => 'announce_taxonomy',
			'parent'       => 0,
			'hierarchical' => true,
			'hide_empty'   => false,
		) );
		foreach ( $taxonomies_datas->taxonomies_parent as $parent ) {
			$parent->taxonomies_child = get_terms( array(
				'taxonomy'     => 'announce_taxonomy',
				'parent'       => $parent->term_id,
				'hierarchical' => true,
				'hide_empty'   => false,
			) );
			$parent->marker           = PLUGIN_ANNONCES_URL . 'modules/annonce/asset/img/pin-' . get_field( 'icon', $parent ) . '.png';
		}

		$filter_title                       = __( 'Announces', 'annonces' );
		$taxonomies_datas->taxonomies_title = apply_filters( 'bloc_filter_title', $filter_title );

		ob_start();
			\eoxia\View_Util::exec( 'annonces', 'annonce', 'main', array(
				'annonces_map_query' => $annonces_map_query,
				'taxonomies_datas'   => $taxonomies_datas,
			) );

		return ob_get_clean();
	}
}

new Annonce_Shortcode();
