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

/**
 * Make short aliases.
 */
$author_id       = get_the_author_meta( 'ID' );
$author_email    = get_the_author_meta( 'user_nicename' );
$author_nicename = get_the_author_meta( 'user_nicename' );
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
					'before'         => '<nav class="navigation pagination" role="navigation">',
					'after'          => '</nav>',
					'link_before'    => '<span class="page-numbers">',
					'link_after'     => '</span>',
					'next_or_number' => 'number',
					'separator'      => '&nbsp',
				) );
			} else {
				the_excerpt();
			}
			?>

		</div>

	<?php if ( 'post' === get_post_type() && ! is_singular() ) : ?>

		<footer class="entry-meta entry-meta-small">
			<img class="entry-avatar entry-avatar-small" src="<?php echo esc_url( get_avatar_url( $author_email ) ); ?>" alt="profile_pic">
			<a class="entry-author entry-author-small" href="<?php echo get_author_posts_url( $author_id, $author_nicename ); ?>"><?php echo $author_nicename; ?></a>
			<span class="screen-reader-text"> posted </span>
			<?php echo jhuy_time_link(); ?>
		</footer><!-- .entry-meta-small -->

	<?php endif; ?>

	</div>
</article><!-- #post-## -->

<?php if ( is_singular() ) : ?>

	<footer class="post-container entry-meta entry-meta-large">
		<img class="entry-avatar entry-avatar-large" src="<?php echo esc_url( get_avatar_url( get_the_author_meta( 'email' ), 75 ) ); ?>" alt="profile_pic">
		<div class="entry-metadata">
			<a class="entry-author entry-author-large" href="<?php echo get_author_posts_url( $author_id, $author_nicename ); ?>">
				<?php echo $author_nicename; ?>
			</a>
			<p class="entry-time entry-time-created">Post created
				<time class="entry-date published updated" datetime="<?php echo get_the_time( 'c' ); ?>">
					<?php
						printf(
							'%1$s ago, %2$s',
							get_elapsed_time_string( get_the_time( 'U' ), 'U' ),
							get_the_time( 'F d Y' )
						)
						?>
				</time>
			</p>

			<?php if ( get_the_modified_time( 'U' ) !== get_the_time( 'U' ) ) : ?>

				<p class="entry-time entry-time-modified">Last modified
					<time class="entry-date published updated" datetime="<?php echo get_the_modified_time( 'c' ); ?>">
						<?php
						printf(
							'%1$s ago, %2$s',
							get_elapsed_time_string( get_the_modified_time( 'U' ), 'U' ),
							get_the_modified_time( 'F d Y' )
						)
						?>
					</time>
				</p>

			<?php endif; ?>

		</div>
	</footer>

<?php endif; ?>
