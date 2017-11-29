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
			/**
			 * Do not show dot next to title if sticky,
			 * since sticky posts look different
			 * compared to normal posts.
			 */
			$dot = is_sticky() ? '' : 'site-blog-dot';

			/**
			 * Singular post titles look different to
			 * blog content.
			 */
			if ( is_single() ) {
				$title_start = '<h1 class="entry-title">';
				$title_end   = '</h1>';
			} elseif ( is_front_page() || is_home() ) {
				$title_start = '<h3 class="entry-title ' . $dot . '"><a class="entry-title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
				$title_end   = '</a></h3>';
			} else {
				$title_start = '<h3 class="entry-title"><a class="entry-title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
				$title_end   = '</a></h3>';
			}

			the_title( $title_start, $title_end );
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
		/**
		 * Check if post is a post
		 * and display post meta.
		 */
		if ( 'post' === get_post_type() ) {
			echo '<div class="entry-meta">';

			// Display avatar.
			echo '<img class="entry-author-avatar" src="' . esc_url( get_avatar_url( get_the_author_meta( 'email' ) ) ) . '" alt="profile_pic">';

			// Display nice name.
			echo esc_html( get_the_author_meta( 'user_nicename' ) ) . ' ';

			// Only show edit button when post is visited.
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
