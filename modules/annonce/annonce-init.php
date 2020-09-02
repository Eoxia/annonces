<?php
/**
 * Init of Directory module
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2020 Eoxia <dev@eoxia.com>
 * @License   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\
 * @since     2.2.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit;

class Annonce_Init {
	public function __construct() {
		require_once ANNONCES_PATH . 'modules/annonce/action/annonce.action.php';
		require_once ANNONCES_PATH . 'modules/annonce/filter/annonce.filter.php';
		require_once ANNONCES_PATH . 'modules/annonce/shortcode/annonce.shortcode.php';
	}
}
new Annonce_Init();
