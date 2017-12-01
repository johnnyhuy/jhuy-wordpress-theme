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

// Only show blog bar if in blog page (not singular post).
if ( is_singular() ) {
	$blog_bar = 'site-blog';
} else {
	$blog_bar = 'site-blog site-blog-bar';
}

$stickies = get_option( 'sticky_posts' );

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

		<?php if ( ! is_singular() && is_home() && $stickies ) : ?>

			<div class="site-blog site-blog-sticky">

			<?php

			/**
			 * Show only sticky posts
			 * as this will display on all pages.
			 */
			$sticky_query = new WP_Query( array(
				'post_type'           => 'post',
				'post__in'            => get_option( 'sticky_posts' ),
				'ignore_sticky_posts' => 1,
			) );

			if ( $sticky_query->have_posts() ) {

				/* Start the loop */
				while ( $sticky_query->have_posts() ) {

					$sticky_query->the_post();
					get_template_part( 'template-parts/post/content', get_post_format() );

				}
			}
			?>

			</div>

		<?php endif; ?>

		<div class="<?php echo esc_html( $blog_bar ); ?>">

		<?php
		if ( have_posts() ) {

			/* Start the loop */
			while ( have_posts() ) {

				the_post();

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
