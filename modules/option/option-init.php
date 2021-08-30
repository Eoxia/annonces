<?php
/**
 * Init of Option module
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2020 Eoxia <dev@eoxia.com>
 * @License   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\Option
 * @since     2.2.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit;

class Option_Init {
	public function __construct() {
		require_once ANNONCES_PATH . 'modules/option/action/option.action.php';
	}
}
new Option_Init();
