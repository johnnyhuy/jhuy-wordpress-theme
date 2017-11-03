<?php
/**
 * Show site branding
 * Includes blog title and custom logo
 */

?>
<div class="site-branding">

	<?php the_custom_logo(); ?>

	<?php if ( ! has_custom_logo() ) : ?>
		<div class="site-branding-text">
			<?php if ( is_front_page() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif; ?>
		</div><!-- .site-branding-text -->
	<?php endif; ?>

</div>
