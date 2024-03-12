<?php
/**
 * Plugin Name: Annonces
 * Plugin URI:
 * Description: Add all type of announces you need to display in a large map.
 * Version: 2.4.0
 * Author: Eoxia <dev@eoxia.com>
 * Author URI: http://www.eoxia.com/
 * License: AGPLv3
 * License URI: https://spdx.org/licenses/AGPL-3.0-or-later.html
 * Text Domain: annonces
 * Domain Path: /language
 *
 * @package Annonces
 */

namespace annonces;

defined( 'ABSPATH' ) || exit;

DEFINE( 'ANNONCES_PATH', realpath( plugin_dir_path( __FILE__ ) ) . '/' );
DEFINE( 'ANNONCES_URL', plugins_url( basename( __DIR__ ) ) . '/' );
DEFINE( 'ANNONCES_DIR', basename( __DIR__ ) );

/**
 * Regenerate permalinks
 *
 * @since 2.1.0
 * @return void
 */
function my_rewrite_flush() {
	Annonce_Action::get_instance()->annonces_generate_post_type();
	Label_Action::get_instance()->label_generate_post_type();

	flush_rewrite_rules();
}
//register_activation_hook( __FILE__, '\annonces\my_rewrite_flush' );

require_once ANNONCES_PATH . 'annonces-init.php';
