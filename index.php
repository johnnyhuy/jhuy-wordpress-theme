<?php
/**
 * Theme front page.
 *
 * @package WordPress
 * @subpackage jHuy
 * @since 1.0
 */

?>
<?php get_header(); ?>

	<main id="main" class="container container-sidebar site-main" role="main">

		<?php
		if ( is_front_page() || is_home() ) {
			$blog_class = 'site-blog site-blog-bar';
		} else {
			$blog_class = 'site-blog';
		}
		?>

		<div class="<?php echo $blog_class; ?>">

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
	</main><!-- #main -->
</div><!-- .site-content -->

<?php get_footer(); ?>
