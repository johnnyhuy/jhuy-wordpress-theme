<?php
/**
 * Theme functions and definitions.
 */

/**
 * Setup initial WordPress features.
 *
 * @return void
 */
function jhuy_init() {
    // Load translation domain
    load_theme_textdomain( 'jhuy' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Enable HTML5
    add_theme_support( 'html5', array( 
        'comment-list',
        'comment-form',
        'search-form',
        'gallery',
        'caption'
    ) );

    // Enable thumbnail support
    add_theme_support( 'post-thumbnails' );

    // Enable post formats
    add_theme_support( 'post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
        'gallery',
        'audio',
    ) );

    // Add theme support for Custom Logo.
    add_theme_support( 'custom-logo', array(
        'width'       => 250,
        'height'      => 250,
        'flex-width'  => true,
        'flex-height' => true
    ) );

    // Register navigation menus
    register_nav_menus( array(
        'top'    => __( 'Top Menu', 'jhuy' )
    ) );

    // Define and register starter content to showcase the theme on new sites.
    $starter_content = array(
        'nav_menus' => array(
            'top' => array(
                'name' => __( 'Top Menu', 'jhuy' ),
                'items' => array(
                    'link_home',
                    'page_about',
                    'page_blog',
                    'page_contact',
                    'page_test' => array(
                        'type' => 'post_type',
                        'object' => 'page',
                        'object_id' => '{{test}}'
                    )
                )
            )
        ),

        // Default posts (pages)
        'posts' => array(
            'home',
            'about',
            'contact',
            'blog',
            'homepage-section',
            'test' => array(
                'post_type' => 'page',
                'post_title' => _x( 'Test', 'jhuy' ),
                'post_content' => _x( 'Test page', 'jhuy' ),
            )
        ),

        // Default options
        'options' => array(
            'show_on_front' => 'page',
            'page_on_front' => '{{home}}',
            'page_for_posts' => '{{blog}}',
        ),
    );

    $starter_content = apply_filters( 'jhuy_starter_content', $starter_content );
    add_theme_support( 'starter-content', $starter_content );    
}
add_action( 'after_setup_theme', 'jhuy_init' );
 
/**
 * Enqueue scripts and styles.
 *
 * @return void
 */
function jhuy_scripts() {
    // Custom fonts
    // wp_enqueue_style( 'jhuy-fonts', jhuy_fonts_url(), array(), null );

    $parent_style = 'jhuy-style';

    // Get theme version
    $theme_version = wp_get_theme()->get('Version');

    /**
     * Developer use only
     * Force WordPress to load stylesheet
     * 
     * DISABLE IF IN PRODUCTION
     */
    $theme_version = time();

    // Theme stylesheet.
    wp_enqueue_style( $parent_style, get_stylesheet_uri(),
        array(),
        $theme_version
    );

    // Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'jhuy-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'jhuy-style' ), null );
		wp_style_add_data( 'jhuy-ie9', 'conditional', 'IE 9' );
	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'jhuy-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'jhuy-style' ), '1.0' );
	wp_style_add_data( 'jhuy-ie8', 'conditional', 'lt IE 9' );    

    // Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

    // Load WebPack JS bundle file (includes jQuery and other NPM deps.)
    wp_enqueue_script( 'jhuy-bundle', get_theme_file_uri( '/assets/js/bundle.js' ), array(), null );
}
add_action( 'wp_enqueue_scripts', 'jhuy_scripts' );

/**
 * Return fonts URL.
 *
 * @return void
 */
function jhuy_fonts_url() {
    // TODO
}

/**
 * Filter to add a class to the menu
 *  anchor.
 *
 * @param array $atts
 * @return void
 */
function add_class_to_menu_anchor( $atts ) {
    $atts['class'] = 'menu-item-link';

    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_class_to_menu_anchor', 10 );