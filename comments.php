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

<?php if ( have_comments() ) : ?>

	<article id="comments" class="post-container comments-area">

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
				'prev_text' => jhuy_get_oi_svg( array(
					'name'  => 'arrow-left',
					'class' => 'comments-pagination-arrow',
				) ),
				'next_text' => jhuy_get_oi_svg( array(
					'name'  => 'arrow-right',
					'class' => 'comments-pagination-arrow',
				) ),
			) );
			?>

	</article><!-- #comments -->

<?php endif; ?>

<article class="post-container comment-reply">
	<?php
	comment_form( array(
		'class_submit' => 'comment-submit',
		'comment_field' => '<textarea id="comment" class="comment-textarea" name="comment" aria-required="true"></textarea>',
		'submit_field' => '%1$s %2$s',
	) );
	?>
	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="comments-closed"><?php esc_html_e( 'Comments are closed.', 'jhuy' ); ?></p>
	<?php endif; ?>
</article>
