<?php
/**
 * Single Announce view.
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\view\Single
 * @since     2.0.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit; ?>

<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			/** Main content */
			the_content();

			$test = get_field( 'adress' );
			// echo '<pre>'; print_r($test); echo '</pre>';

			/** Comments */
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			/** Navigation */
			the_post_navigation();

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar( 'blog' );
get_footer();
