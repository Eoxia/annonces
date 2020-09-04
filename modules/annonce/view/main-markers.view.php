<?php
/**
 * Marker html of main view
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\annonce\Actions
 * @since     2.0.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit;

if ( ! empty( $annonces_map_query->posts ) ) :
	echo '<pre>';
	print_r($annonces_map_query->posts);
	echo '</pre>';
	foreach ( $annonces_map_query->posts as $marker_annonce ) : ?>
		<marker id="<?php echo esc_html( $marker_annonce->ID ); ?>"
		lat="<?php echo esc_html( $marker_annonce->address['lat'] ); ?>"
		lng="<?php echo esc_html( $marker_annonce->address['lng'] ); ?>"
		taxonomy="<?php echo esc_attr( $marker_annonce->tax ); ?>"
		pin="<?php echo ( ! empty( $marker_annonce->pin ) ) ? esc_html( $marker_annonce->pin ) : 'red'; ?>">
			<div class="marker-container wpeo-gridlayout grid-2">
				<figure class="thumbnail">
					<?php
					$thumb_id  = get_post_thumbnail_id( $marker_annonce->ID );
					$thumb_url = wp_get_attachment_image_url( $thumb_id, 'thumbnail' );
					?>
					<img src="<?php echo esc_url( $thumb_url ); ?>" />
				</figure>
				<div class="content">
					<p class="content-title"><?php echo esc_html( $marker_annonce->post_title ); ?></p>
					<p class="content-description"><?php echo wp_trim_words( $marker_annonce->post_content, 10, '...' ); // WPCS: XSS ok. ?></p>
					<ul class="content-datas">
						<?php foreach ( $marker_annonce->datas as $data ) : ?>
							<?php if ( ! empty( $data['content'] ) ) : ?>
								<li>
										<span class="data-icon"><i class="fas fa-<?php echo esc_html( $data['icon'] ); ?>"></i></span>
										<span class="data-title"><?php echo esc_html( $data['title'] ); ?></span>
										<span class="data-content"><?php echo esc_html( $data['content'] ); ?></span>
								</li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
					<a href="<?php echo esc_url( get_permalink( $marker_annonce->ID ) ); ?>" class="wpeo-button button-main button-size-small"><?php esc_html_e( 'See', 'annonces' ); ?></a>
				</div>
			</div>
		</marker> <?php
	endforeach;
endif;
