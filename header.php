<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<header id="header" class="site-header" role="banner">

		<?php get_template_part( 'template-parts/header/header', 'image' ); ?>

	</header><!-- .site-header -->

	<?php if ( has_nav_menu( 'top' ) ) : ?>

			<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>

	<?php endif; ?>

	<div id="content" class="site-content">
