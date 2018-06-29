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
 * Action of "Hello_World" module.
 */
class Annonce_Actions {

	/**
	 * Constructor
	 *
	 * @since 2.0.0
	 * @version 2.0.0
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'annonces_generate_post_type' ), 11 );
		add_action( 'init', array( $this, 'announce_taxonomy' ), 11 );
	}

	/**
	 * Register Announces post type
	 *
	 * @since 2.0.0
	 * @return void
	 */
	public function annonces_generate_post_type() {

		$labels = array(
			'name'          => _x( 'Announces', 'Post Type General Name', 'annonces' ),
			'singular_name' => _x( 'Announce', 'Post Type Singular Name', 'annonces' ),
			'menu_name'     => __( 'Announces', 'annonces' ),
		);
		$args   = array(
			'label'               => __( 'Announce', 'annonces' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions' ),
			'taxonomies'          => array( 'announce_taxonomy' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-location',
			'show_in_admin_bar'   => false,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'rewrite'             => array(
				'slug' => get_option( 'permalink_annonce', 'announce' ),
			),
		);
		register_post_type( 'announce', $args );

	}

	/**
	 * Register Announces taconomy
	 *
	 * @since 2.0.0
	 * @return void
	 */
	public function announce_taxonomy() {

		$labels = array(
			'name'          => _x( 'Announce taxonomies', 'Taxonomy General Name', 'annonces' ),
			'singular_name' => _x( 'Announce taxonomy', 'Taxonomy Singular Name', 'annonces' ),
			'menu_name'     => __( 'Announce taxonomy', 'annonces' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
		);
		register_taxonomy( 'announce_taxonomy', array( 'announce' ), $args );
	}
}

new Annonce_Actions();
