<?php
/**
 * Post large metadata.
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
