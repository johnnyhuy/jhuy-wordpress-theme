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
	$icon_file = get_template_directory_uri() . '/assets/images/svg/open-iconic/open-iconic.svg';

	// Init empty strings.
	$width  = '';
	$height = '';
	$class  = '';
	$fill   = '';

	// When name is empty, error.
	if ( empty( $options['name'] ) ) {
		return __( 'Error has occured, please enter an icon name in the first parameter.', 'jhuy' );
	}

	// Set dimensions.
	if ( ! empty( $options['width'] ) ) {
		$width = ' width="' . $options['width'] . '"';
	}
	if ( ! empty( $options['height'] ) ) {
		$height = ' height="' . $options['height'] . '"';
	}

	// Set fallback color fill to black.
	if ( ! empty( $options['fill'] ) ) {
		$fill = ' style="fill: ' . $options['fill'] . '"';
	}

	// Check if class exists.
	if ( ! empty( $options['class'] ) ) {
		$class = ' class="' . $options['class'] . '"';
	}

	// Construct SVG.
	$svg  = '<svg' . $class . $width . $height . $fill . ' viewBox="0 0 8 8" role="img">';
	$svg .= '<use href="' . $icon_file . '#' . $options['name'] . '"></use>';
	$svg .= '</svg>';

	return $svg;
}
