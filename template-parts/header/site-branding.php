<?php
/**
 * Show site branding
 * Includes blog title and custom logo
 */

?>
<div class="site-branding">

	<div class="custom-header-media">
		<?php the_custom_header_markup(); ?>
	</div>

	<?php if ( has_custom_logo() ) : ?>

		<?php the_custom_logo(); ?>

	<?php else : ?>

		<div class="site-title">
			<a class="site-title-link"
				href="<?php echo esc_url( home_url( '/' ) ); ?>"
				rel="home"><?php bloginfo( 'name' ); ?></a>
		</div><!-- .site-branding-text -->

	<?php endif; ?>

</div><!-- .site-branding -->
