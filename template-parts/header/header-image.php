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
<div class="container custom-header">

	<div class="custom-header-media">
		<?php the_custom_header_markup(); ?>
	</div>

	<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

</div><!-- .custom-header -->
