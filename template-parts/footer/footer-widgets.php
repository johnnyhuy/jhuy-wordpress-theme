<?php
/**
 * Footer widgets
 *
 * @package WordPress
 * @subpackage jHuy
 * @since 1.0
 */

?>
<?php
if ( is_active_sidebar( 'footer-left' ) ||
	is_active_sidebar( 'footer-middle' ) ||
	is_active_sidebar( 'footer-right' ) ) :
?>
	<aside class="widget-area footer-widget-area" role="complementary">
		<?php if ( is_active_sidebar( 'footer-left' ) ) : ?>
			<div class="widget-column footer-widget footer-widget-left">
				<?php dynamic_sidebar( 'footer-left' ); ?>
			</div>
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'footer-middle' ) ) : ?>
			<div class="widget-column footer-widget footer-widget-middle">
				<?php dynamic_sidebar( 'footer-middle' ); ?>
			</div>
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'footer-right' ) ) : ?>
			<div class="widget-column footer-widget footer-widget-right">
				<?php dynamic_sidebar( 'footer-right' ); ?>
			</div>
		<?php endif; ?>
	</aside><!-- .widget-area -->
<?php endif; ?>
