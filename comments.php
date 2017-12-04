<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage jhuy
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="post-container comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			// Get count of comments for this post.
			$comments_number = get_comments_number();

			// Print comment section title.
			printf(
				_nx(
					'%1$s Comment',
					'%1$s Comments',
					$comments_number,
					'comments title',
					'jhuy'
				),
				esc_html( number_format_i18n( $comments_number ) )
			);
			?>
		</h2>

		<ol class="comments-list">
			<?php
			wp_list_comments( array(
				'avatar_size' => 50,
				'callback'    => 'jhuy_list_comments_callback',
				'style'       => 'ol',
				'short_ping'  => true,
				'reply_text'  => 'Reply',
			) );
			?>
		</ol>

		<?php
		the_comments_pagination( array(
			'prev_text' => jhuy_get_oi_svg( array( 'name' => 'arrow-left' ) ),
			'next_text' => jhuy_get_oi_svg( array( 'name' => 'arrow-right' ) ),
		) );
		?>

	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'jhuy' ); ?></p>
	<?php endif; ?>

</div><!-- #comments -->

<div class="post-container comment-form">
	<?php
	comment_form();
	?>
</div>
