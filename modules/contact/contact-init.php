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

class Contact_Init {
	public function __construct() {
		require_once ANNONCES_PATH . 'modules/contact/action/contact.action.php';
		require_once ANNONCES_PATH . 'modules/contact/filter/contact.filter.php';
	}
}
new Contact_Init();
