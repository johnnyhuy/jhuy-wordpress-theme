<?php
/**
 * Footer of theme.
 *
 * @package WordPress
 * @subpackage jHuy
 * @since 1.0
 */

?>
	<footer class="site-footer" role="contentinfo">
		<div class="container container-sidebar">
			<section class="powered">
				<span class="powered-text">Powered by</span>
				<a href="https://wordpress.com/" target="_blank">
					<img class="powered-image"
						src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/svg/wordpress_white.svg"
						alt="">
				</a>
				<a href="https://www.docker.com/" target="_blank">
					<img class="powered-image"
						src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/svg/docker_white.svg"
						alt="">
				</a>
				<a href="https://aws.amazon.com/" target="_blank">
					<img class="powered-image" 
						src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/svg/aws_white.svg"
						alt="">
				</a>
				<a href="http://php.net/manual/en/intro-whatis.php" target="_blank">
					<img class="powered-image"
						src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/svg/php_white.svg"
						alt="">
				</a>
			</section>
			<?php get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>
		</div>
	</footer>

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
