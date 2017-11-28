<?php
/**
 * Show site header.
 *
 * @package WordPress
 * @subpackage jHuy
 * @since 1.0
 */

?>
<header id="header" class="site-header" role="banner">
	<div class="container container-header container-sidebar">

		<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

		<button class="hamburger hamburger--spring header-hamburger is-active" type="button">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
		</button>

	</div><!-- .custom-header -->
</header><!-- .site-header -->
