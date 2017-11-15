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
	add_option( 'jhuy_quote', 'Be Cool.' );

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
		array( 'label_for' => 'jhuy_quote' )
	);

	// Register settings here.
	register_setting( 'jhuy-theme-options-fields', 'jhuy_quote' );
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
	echo '<input name="' . $args['label_for'] . '" id="' . $args['label_for'] . '" type="checkbox" value="1" class="code" ' . checked( 1, $options, false ) . ' /> Check for enabling custom help text.';
}

/**
 * Output text type input
 *
 * @param array $args arguments passed from settings field.
 * @return void
 */
function jhuy_text_callback( $args ) {
	$options = get_option( $args['label_for'] );
	echo '<input name="' . $args['label_for'] . '" id="' . $args['label_for'] . '" type="text" value="' . $options . '" />';
}
