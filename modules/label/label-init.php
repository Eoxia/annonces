<?php
/**
 * Init of Label module
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2020 Eoxia <dev@eoxia.com>
 * @License   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\Label
 * @since     2.2.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit;

class Label_Init {
	public function __construct() {
		require_once ANNONCES_PATH . 'modules/label/action/label.action.php';
		require_once ANNONCES_PATH . 'modules/label/filter/label.filter.php';
	}
}
new Label_Init();
