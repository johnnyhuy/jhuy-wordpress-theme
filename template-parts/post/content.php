<?php
/**
 * Template part used to display post content
 * This is the default content file
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-container">
		<header class="entry-header">

			<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} elseif ( is_front_page() && is_home() ) {
				the_title( '<h2 class="entry-title"><a class="entry-title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				echo '<div class="site-blog__dot"></div>';
			} elseif ( is_home() ) {
				the_title( '<h3 class="entry-title"><a class="entry-title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
				echo '<div class="site-blog__dot"></div>';
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
			if ( is_single() ) {
				jhuy_posted_on();
			} else {
				echo esc_url( jhuy_time_link() );
				jhuy_edit_link();
			};
			echo '</div><!-- .entry-meta -->';
		};
		?>
	</div>
</article><!-- #post-## -->
