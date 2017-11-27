<?php
/**
 * Show header image
 *
 * Custom header markup is used for the customizer
 *
 * @package WordPress
 * @subpackage jHuy
 * @since 1.0
 */

?>
<div class="container custom-header container-sidebar">

	<div class="custom-header-media">
		<?php the_custom_header_markup(); ?>
	</div>

	<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

	<button class="hamburger hamburger--spring header-hamburger is-active" type="button">
		<span class="hamburger-box">
			<span class="hamburger-inner"></span>
		</span>
	</button>

</div><!-- .custom-header -->
