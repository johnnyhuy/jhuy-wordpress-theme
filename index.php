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
<div class="intro">
	<section class="container intro-container">
		<p class="intro-quote"><?php echo esc_html( get_option( 'jhuy_quote' ) ); ?></p>
		<img class="intro-image" src="<?php echo esc_url( get_option( 'jhuy_quote_image' ) ); ?>" alt="jhuy_quote_image">
	</section>
</div>
<main id="main" class="container site-main" role="main">
	<?php if ( is_single() ) : ?>
		<div class="site-blog">
	<?php elseif ( is_front_page() || is_home() ) : ?>
		<div class="site-blog site-blog-bar">
	<?php else : ?>
		<div class="site-blog">
	<?php endif; ?>
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

<?php get_footer(); ?>
