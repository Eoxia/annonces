<?php
/**
 * Main view of Option Module.
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\option\View
 * @since     2.0.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit; ?>

<div class="wrap">
	<h1><?php esc_html_e( 'Announces options', 'annonces' ); ?></h1>

	<form class="form" method="POST" action="">
		<input type="hidden" name="action" value="save_annonces_options" />
		<?php wp_nonce_field( 'save_annonces_options' ); ?>

		<label><?php esc_html_e( 'Google api key', 'annonces' ); ?></label><br>
		<input type="text" name="annonces_google_key" class="form-field" value="<?php echo esc_attr( get_option( 'annonces_google_key', '' ) ); ?>" />
		<p><a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank"><?php esc_html_e( 'Obtain a google map api key', 'annonces' ); ?></a></p>

		<input type="submit" class="button" value="<?php esc_html_e( 'Update', 'annonces' ); ?>" />
	</form>
</div>
