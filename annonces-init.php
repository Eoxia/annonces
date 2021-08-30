<?php
/**
 * Init of core and modules
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2020 Eoxia <dev@eoxia.com>
 * @License   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\
 * @since     2.2.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit;

/**
 * Class WP_Directory_Init
 *
 * @package wp_directory
 */
class Annonces_Init {

	/**
	 * WP_Directory_Init constructor.
	 */
	public function __construct() {
		// Core include.
		require_once ANNONCES_PATH . 'core/core-init.php';

		// Modules include.
		if ( \annonces\Core_Helper::get_instance()->is_acf() ) {
			require_once ANNONCES_PATH . 'modules/annonce/annonce-init.php';
			require_once ANNONCES_PATH . 'modules/option/option-init.php';
			require_once ANNONCES_PATH . 'modules/contact/contact-init.php';
			require_once ANNONCES_PATH . 'modules/label/label-init.php';
		}
	}

}
new Annonces_Init();
