<?php
/**
 * Admin panel custom theme settings.
 *
 * @package WordPress
 * @subpackage jHuy
 * @since 1.0
 */

/**
 * Create custom theme settings
 *
 * @return void
 */
function jhuy_settings() {
	// Start JS WordPress API.
	if ( function_exists( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
	} else {
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_script( 'thickbox' );
	}

	// Add theme capability to admin.
	$admin = get_role( 'administrator' );
	if ( ! $admin->has_cap( 'manage_theme_options' ) ) {
		$admin->add_cap( 'manage_theme_options' );
	}

	// Add options here.
	add_option( 'jhuy_quote', 'This is an example quote.' );
	add_option( 'jhuy_quote_image', get_template_directory_uri() . '/assets/images/svg/johnnyhuy/logo_emblem_primary_2.svg' );

	// Add sections here.
	add_settings_section(
		'jhuy_section',
		'',
		'',
		'jhuy-theme-options'
	);

	// Add fields here.
	add_settings_field(
		'jhuy_quote',
		__( 'Front Page Quote', 'jhuy' ),
		'jhuy_text_callback',
		'jhuy-theme-options',
		'jhuy_section',
		array(
			'label_for' => 'jhuy_quote',
			'input_id'  => 'quote',
		)
	);
	add_settings_field(
		'jhuy_quote_image',
		__( 'Front Page Quote Image', 'jhuy' ),
		'jhuy_file_callback',
		'jhuy-theme-options',
		'jhuy_section',
		array(
			'label_for' => 'jhuy_quote_image',
			'input_id'  => 'quoteImage',
			'type'      => 'image',
		)
	);

	// Register settings here.
	register_setting( 'jhuy-theme-options-fields', 'jhuy_quote' );
	register_setting( 'jhuy-theme-options-fields', 'jhuy_quote_image' );

	// Add scripts and styling.
	wp_enqueue_script( 'jhuy-head', get_theme_file_uri( '/assets/js/head.js' ), array(), null, true );
	wp_enqueue_script( 'jhuy-admin', get_theme_file_uri( '/assets/js/admin.js' ), array(), null, true );
	wp_enqueue_style( 'jhuy-admin', get_theme_file_uri( '/assets/css/admin.css' ), array(), null );
}
add_action( 'admin_init', 'jhuy_settings' );

/**
 * Add jHuy theme page settings
 *   under the Appearance section.
 *
 * @return void
 */
function jhuy_add_theme_page() {
	add_theme_page(
		'jHuy Theme Settings',
		'jHuy Theme Settings',
		'manage_theme_options',
		'jhuy-theme-options',
		'jhuy_options_page'
	);
}
add_action( 'admin_menu', 'jhuy_add_theme_page' );

/**
 * Require the HTML structure of the
 *   theme settings page.
 *
 * @return void
 */
function jhuy_options_page() {
	get_template_part( 'template-parts/settings/settings', 'theme' );
}

/**
 * Output checkbox type input
 *
 * @param array $args arguments passed from settings field.
 * @return void
 */
function jhuy_checkbox_callback( $args ) {
	$options = get_option( $args['label_for'] );
	echo '<input name="' . esc_html( $args['label_for'] ) . '" id="' . esc_html( $args['input_id'] ) . '" type="checkbox" value="1" class="code" ' . checked( 1, $options, false ) . ' /> Check for enabling custom help text.';
}

/**
 * Output text type input
 *
 * @param array $args arguments passed from settings field.
 * @return void
 */
function jhuy_text_callback( $args ) {
	$options = get_option( esc_html( $args['label_for'] ) );
	echo '<input name="' . esc_html( $args['label_for'] ) . '" id="' . esc_html( $args['input_id'] ) . '" type="text" value="' . esc_html( $options ) . '" />';
}

/**
 * Output file upload input.
 *
 * @param array $args an array of arguments.
 * @return void
 */
function jhuy_file_callback( $args ) {
	$label_for = isset( $args['label_for'] ) ? $args['label_for'] : 'label';
	$input_id  = isset( $args['input_id'] ) ? $args['input_id'] : 'inputId';
	$type      = isset( $args['type'] ) ? $args['type'] : 'file';
	$options   = get_option( $args['label_for'] );

	echo '<input id="' . esc_html( $input_id ) . '" 
	class="upload-file-url" 
	name="' . esc_html( $label_for ) . '" 
	id="' . esc_html( $label_for ) . '" 
	type="text" value="' . esc_html( $options ) . '" />';
	echo '<p class="submit">';
	echo '<a href="#" class="button button-primary upload-file">Upload Media</a>';
	echo '</p>';

	if ( 'image' === $type ) {
		echo '<section class="upload-image-container">';
		echo '<img class="upload-image upload-image-lrg" alt="' . esc_html( $label_for ) . '" src="' . esc_html( $options ) . '">';
		echo '<img class="upload-image upload-image-mid" alt="' . esc_html( $label_for ) . '" src="' . esc_html( $options ) . '">';
		echo '<img class="upload-image upload-image-sml" alt="' . esc_html( $label_for ) . '" src="' . esc_html( $options ) . '">';
		echo '</section>';
	}
}
