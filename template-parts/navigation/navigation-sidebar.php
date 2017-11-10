<?php
/**
 * Template part that display the top navigation bar
 */

?>
<nav id="site-navigation" class="site-navigation sidebar" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'twentyseventeen' ); ?>">
	<?php
		wp_nav_menu( array(
			'theme_location' => 'right-sidebar',
			'menu_id'        => 'sidebar',
			'container'      => false,
		) );
	?>
</nav><!-- .site-navigation -->
