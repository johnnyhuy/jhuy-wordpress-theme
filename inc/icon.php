<?php
/**
 * Admin panel custom theme settings.
 *
 * @package WordPress
 * @subpackage jHuy
 * @since 1.0
 */

/**
 * Return an svg element of an icon from Open Iconic.
 *
 * @param array $options options to conigure Open Iconic image.
 * @return string
 */
function jhuy_get_oi_svg( $options ) {
	$icon_file = get_theme_file_uri( '/assets/images/svg/open-iconic/open-iconic.svg' );

	// When name is empty, error.
	if ( empty( $options['name'] ) ) {
		return __( 'Error has occured, please enter an icon name in the first parameter.', 'jhuy' );
	}

	// Default dimensions is 100 x 100.
	if ( empty( $options['width'] ) || empty( $options['height'] ) ) {
		$options['width']  = 100;
		$options['height'] = 100;
	}

	// Set fallback color fill to black.
	if ( empty( $options['fill'] ) ) {
		$options['fill'] = 'black';
	}

	// Construct SVG.
	$svg  = '<svg width="' . $options['width'] . '" height="' . $options['height'] . '" viewBox="0 0 8 8" role="img">';
	$svg .= '<use style="fill: ' . $options['fill'] . '" href="' . $icon_file . '#' . $options['name'] . '"></use>';
	$svg .= '</svg>';

	return $svg;
}
