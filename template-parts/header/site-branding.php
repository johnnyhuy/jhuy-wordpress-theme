<?php
/**
 * Show site branding
 * Includes blog title and custom logo
 */

?>
<div class="site-branding">


	<?php if ( has_custom_logo() ) : ?>

		<?php the_custom_logo(); ?>

	<?php else : ?>

		<div class="site-branding-text">
			<h2 class="site-title">
				<a class="site-title-link"
					href="<?php echo esc_url( home_url( '/' ) ); ?>"
					rel="home"><?php bloginfo( 'name' ); ?></a>
			</h2><!-- .site-title -->
		</div><!-- .site-branding-text -->

	<?php endif; ?>

</div>
