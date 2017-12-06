<?php
/**
 * Post header.
 *
 * @package WordPress
 * @subpackage jHuy
 * @since 1.0
 */

?>
<header class="entry-header">

	<?php
	if ( is_sticky() ) {
		echo jhuy_get_oi_svg( array(
			'name'  => 'pin',
			'class' => 'entry-sticky',
		) );
	}

	if ( get_post_field( 'post_password' ) ) {
		echo jhuy_get_oi_svg( array(
			'name'  => 'lock-locked',
			'class' => 'entry-lock',
		) );
	}

	jhuy_the_title();
	?>

</header>
