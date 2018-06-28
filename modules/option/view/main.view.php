<?php
/**
 * Main view of Option module.
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\option\View
 * @since     2.0.0
 */

namespace annonces;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="wrap wpeo-wrap">
	<h1><?php esc_html_e( 'Announces options', 'annonces' ); ?></h1>

	<div class="wpeo-form">
	<input type="hidden" name="action" value="save_annonces_google_key" />
	<?php wp_nonce_field( 'save_annonces_google_key' ); ?>

	<div class="form-element">
		<span class="form-label"><?php esc_html_e( 'Domaine de l\'email', 'digirisk' ); ?></span>

		<label class="form-field-container">
			<input type="text" name="annonces_google_key" class="form-field" value="<?php echo esc_attr( get_option( 'annonces_google_key', '' ) ); ?>" />
		</label>
	</div>

	<div class="form-element">
		<span class="form-label"><?php esc_html_e( 'Domaine de l\'email', 'digirisk' ); ?></span>
		<p>http://127.0.0.1/eoxia-module/wp-admin/options-permalink.php</p>

		<label class="form-field-container">
			<input type="text" name="mon_option" class="form-field" value="<?php echo esc_attr( get_option( 'mon_option', 'announce' ) ); ?>" />
		</label>
	</div>

	<div class="wpeo-button button-main action-input button-progress" data-parent="wpeo-form">
		<span><?php esc_html_e( 'Enregistrer les modifications', 'digirisk' ); ?></span>
	</div>
</div>
</div>
