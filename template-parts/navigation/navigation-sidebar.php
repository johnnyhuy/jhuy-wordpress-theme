<?php
/**
 * Template part that display the top navigation bar
 *
 * @package WordPress
 * @subpackage jHuy
 * @since 1.0
 */

?>
<nav id="site-navigation" class="site-navigation sidebar" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'twentyseventeen' ); ?>">
	<?php
	// TODO:
	// echo jhuy_get_oi_svg( array(
	// 	'name'  => 'menu',
	// 	'class' => 'sidebar-menu-button',
	// ) );
	wp_nav_menu( array(
		'theme_location' => 'right-sidebar',
		'menu_id'        => 'sidebar',
		'container'      => false,
	) );
	?>
</nav><!-- .site-navigation -->
