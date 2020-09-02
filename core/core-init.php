<?php
/**
 * Core Init.
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2020 Eoxia <dev@eoxia.com>
 * @License   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\Core
 * @since     2.2.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit;

/**
 * Init of the Core
 */
class Core_Init {
	/**
	 * Core_Init constructor.
	 */
	public function __construct() {
		require_once ANNONCES_PATH . 'core/class/class-tgm-plugin-activation.php';
		require_once ANNONCES_PATH . 'core/util/core.util.php';
		require_once ANNONCES_PATH . 'core/action/core.action.php';
		require_once ANNONCES_PATH . 'core/filter/core.filter.php';
		require_once ANNONCES_PATH . 'core/helper/core.helper.php';
	}
}
new Core_Init();
