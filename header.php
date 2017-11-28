<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
if ( has_nav_menu( 'right-sidebar' ) ) {
	$site_class = 'site site-sidebar';
} else {
	$site_class = 'site';
}
?>

<div id="page" class="<?php echo $site_class; ?>">

	<header id="header" class="site-header" role="banner">

		<?php get_template_part( 'template-parts/header/header', 'image' ); ?>

	</header><!-- .site-header -->

	<?php if ( has_nav_menu( 'right-sidebar' ) ) : ?>

		<?php get_template_part( 'template-parts/navigation/navigation', 'sidebar' ); ?>

	<?php endif; ?>

	<?php if ( is_front_page() || is_home() ) : ?>

		<div class="intro">
			<section class="container container-intro container-sidebar">
				<p class="intro-quote"><?php echo esc_html( get_option( 'jhuy_quote' ) ); ?></p>

					<?php
					$quote_image = get_option( 'jhuy_quote_image' );

					if ( empty( $quote_image ) ) {
						$quote_image = get_template_directory_uri() . '/assets/images/svg/no_image.svg';
					}
					?>

					<?php if ( get_option( 'jhuy_toggle_quote_image' ) ) : ?>

						<img class="intro-image" src="<?php echo esc_html( $quote_image ); ?>" alt="jhuy_quote_image">

					<?php endif; ?>

			</section>
		</div>

	<?php endif; ?>

	<div id="content" class="site-content">
