<?php
/**
 * Post small metadata.
 *
 * @package WordPress
 * @subpackage jHuy
 * @since 1.0
 */

/**
 * Make short aliases.
 */
$author_id       = get_the_author_meta( 'ID' );
$author_email    = get_the_author_meta( 'user_nicename' );
$author_nicename = get_the_author_meta( 'user_nicename' );
?>
<footer class="entry-meta entry-meta-small">
	<img class="entry-avatar entry-avatar-small" src="<?php echo esc_url( get_avatar_url( $author_email ) ); ?>" alt="profile_pic">
	<a class="entry-author entry-author-small" href="<?php echo get_author_posts_url( $author_id, $author_nicename ); ?>"><?php echo $author_nicename; ?></a>
	<span class="screen-reader-text"> posted </span>
	<?php echo jhuy_time_link(); ?>
</footer><!-- .entry-meta-small -->
