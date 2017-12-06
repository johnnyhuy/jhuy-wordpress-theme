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

		<?php get_template_part( 'template-parts/post/post', 'header' ); ?>

		<div class="<?php echo $entry_class; ?>">

			<?php
			if ( ! has_excerpt() ) {
				the_content();
			} else {
				the_excerpt();
			}
			?>

		</div>

		<?php
		wp_link_pages( array(
			'before'         => '<nav class="navigation pagination entry-pagination" role="navigation">',
			'after'          => '</nav>',
			'link_before'    => '<span class="page-numbers">',
			'link_after'     => '</span>',
			'next_or_number' => 'number',
			'separator'      => '&nbsp',
		) );
		?>

	<?php
	if ( 'post' === get_post_type() && ! is_singular() ) {
		get_template_part( 'template-parts/post/metadata/content', 'small' );
	}
	?>

	</div>
</article><!-- #post-## -->

<?php
if ( is_singular() ) {
	get_template_part( 'template-parts/post/metadata/content', 'large' );
}
?>
