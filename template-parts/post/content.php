<?php
/**
 * Template part used to display post content
 * This is the default content file
 *
 * @package WordPress
 * @subpackage jHuy
 * @since 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-container">
		<header class="entry-header">

			<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} elseif ( is_front_page() || is_home() ) {
				the_title( '<h3 class="entry-title site-blog-dot"><a class="entry-title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			} else {
				the_title( '<h3 class="entry-title"><a class="entry-title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			}
			?>

		</header>
		<div class="entry-content">

			<?php
			if ( is_singular() ) {
				the_content();
			} else {
				the_excerpt();
			}
			?>

		</div>
		<?php
		if ( 'post' === get_post_type() ) {
			echo '<div class="entry-meta">';
			echo '<img class="entry-author-avatar" src="' . esc_url( get_avatar_url( get_the_author_meta( 'email' ) ) ) . '" alt="profile_pic">';
			if ( is_single() ) {
				jhuy_posted_on();
			} else {
				echo jhuy_time_link();
				jhuy_edit_link();
			};
			echo '</div><!-- .entry-meta -->';
		};
		?>
	</div>
</article><!-- #post-## -->
