<?php
/**
 * Main view of Annonce module.
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\annonce\Actions
 * @since     2.0.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit; ?>

<div id="annonces-map-wrapper">
	<div id="annonces-google-map">
		<markers>
			<?php
			$marker_template = \annonces\Annonces_Util::get_instance()->get_module_view_path( 'annonce', 'main-markers.view' );
			include $marker_template;
			?>
		</markers>
	</div>
	<?php
	$map_template = \annonces\Annonces_Util::get_instance()->get_module_view_path( 'annonce', 'main-taxonomies.view' );
	include $map_template;
	?>
</div>
