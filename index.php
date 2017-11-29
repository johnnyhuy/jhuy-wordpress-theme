<?php
/**
 * Theme front page.
 *
 * @package WordPress
 * @subpackage jHuy
 * @since 1.0
 */

// Only show pagination when page number is not 1.
$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

// Setup custom query to ignore sticky posts.
$the_query = new WP_Query( array(
	'post__not_in'   => get_option( 'sticky_posts' ),
	'posts_per_page' => 5,
	'paged'          => $paged,
) );

// Overwrite wp_query global with custom query.
$wp_query = $the_query;


?>
<?php get_header(); ?>

	<di id="main" class="container container-sidebar site-main" role="main">

		<?php
		/**
		 * Only show top pagination
		 * if page number is not 1 (front page).
		 */
		if ( 1 !== $paged ) {
			jhuy_get_pagination();
		}
		?>

		<div class="site-blog site-blog-sticky">

		<?php

		/**
		 * Show only sticky posts
		 * as this will display on all pages.
		 */
		$sticky_query = new WP_Query( array( 'post__in' => get_option( 'sticky_posts' ) ) );

		if ( $sticky_query->have_posts() ) {

			/* Start the loop */
			while ( $sticky_query->have_posts() ) {

				$sticky_query->the_post();
				get_template_part( 'template-parts/post/content', get_post_format() );

			}
		}
		?>

		</div>

		<div class="site-blog site-blog-bar">

		<?php
		if ( $the_query->have_posts() ) {


			/* Start the loop */
			while ( $the_query->have_posts() ) {

				$the_query->the_post();

				/**
				 * Use the Post-Formats support module to
				 *  allow custom formatting on posts.
				 * Example: using the aside format on a post will load
				 *  template-parts/post/content-aside.php (note the added text to slug)
				 */
				get_template_part( 'template-parts/post/content', get_post_format() );

			}
		} else {

			/**
			 * When there is no posts available
			 *  load no content post format
			 */
			get_template_part( 'template-parts/post/content', 'none' );

		}
		?>

		</div>

		<?php
		/**
		 * Setup pagination under blog container.
		 */
		jhuy_get_pagination();
		?>
	</main><!-- #main -->
</div><!-- .site-content -->

<?php get_footer(); ?>
