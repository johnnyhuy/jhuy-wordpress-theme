<?php
/**
 * Template part used to display post content
 * This is the default content file
 *
 * @package WordPress
 * @subpackage jHuy
 * @since 1.0
 */

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
	$title_start = '<h3 class="entry-title">';
	$title_end   = '</h3>';
} elseif ( is_front_page() || is_home() ) {
	$title_start = '<h3 class="entry-title ' . $dot . '"><a class="entry-title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
	$title_end   = '</a></h3>';
} else {
	$title_start = '<h3 class="entry-title"><a class="entry-title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
	$title_end   = '</a></h3>';
}

/**
 * Only show entry-excerpt class
 * if excerpt exists with post.
 */
if ( ! has_excerpt() ) {
	$entry_class = 'entry-content';
} else {
	$entry_class = 'entry-content entry-excerpt';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-container">

		<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail(); ?>
				</a>
			</div><!-- .post-thumbnail -->
		<?php endif; ?>

		<header class="entry-header">

			<?php
			if ( is_sticky() ) {
				echo jhuy_get_oi_svg( array(
					'name'  => 'pin',
					'class' => 'entry-sticky',
				) );
			}

			if ( get_post_field( 'post_password' ) ) {
				echo jhuy_get_oi_svg( array(
					'name'  => 'lock-locked',
					'class' => 'entry-lock',
				) );
			}

			the_title( $title_start, $title_end );
			?>

		</header>

		<div class="<?php echo $entry_class; ?>">

			<?php
			if ( ! has_excerpt() ) {
				the_content();

				$left_arrow  = jhuy_get_oi_svg( array(
					'name'  => 'arrow-left',
					'class' => 'pagination-arrow pagination-arrow-left',
				) );
				$right_arrow = jhuy_get_oi_svg( array(
					'name'  => 'arrow-right',
					'class' => 'pagination-arrow pagination-arrow-right',
				) );

				wp_link_pages( array(
					'before' => '<nav class="navigation pagination" role="navigation">',
					'after' => '</nav>',
					'link_before' => '<span class="page-numbers">',
					'link_after' => '</span>',
					'next_or_number' => 'number',
					'separator' => '&nbsp',
				) );
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
				echo '<span class="screen-reader-text">posted </span>';
				echo jhuy_time_link();
				jhuy_edit_link();
			};

			echo '</div><!-- .entry-meta -->';
		};
		?>
	</div>
</article><!-- #post-## -->
