<?php
/**
 * Theme functions and definitions.
 *
 * @package WordPress
 * @subpackage jHuy
 * @since 1.0
 */

/**
 * Setup initial WordPress features.
 *
 * @return void
 */
function jhuy_after() {
	// Load translation domain.
	load_theme_textdomain( 'jhuy' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Enable HTML5.
	add_theme_support( 'html5', array(
		'comment-list',
		'comment-form',
		'search-form',
		'gallery',
		'caption',
	) );

	// Enable thumbnail support.
	add_theme_support( 'post-thumbnails' );

	// Enable post formats.
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
		'flex-height' => true,
	) );

	// Register navigation menus.
	register_nav_menus( array(
		'right-sidebar' => __( 'Right Sidebar', 'jhuy' ),
	) );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'nav_menus' => array(
			'right-sidebar' => array(
				'name'  => __( 'Right Sidebar', 'jhuy' ),
				'items' => array(
					'link_home',
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
		),

		// Widgets.
		'widgets' => array(
			'footer-left'   => array(
				'text_about',
			),
			'footer-middle' => array(
				'text_business_info',
			),
			'footer-right'  => array(
				'search',
			),
		),

		// Default posts (pages).
		'posts' => array(
			'home',
			'about',
			'contact',
			'blog',
			'homepage-section',
		),

		// Default options.
		'options' => array(
			'show_on_front'  => 'page',
			'page_on_front'  => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),
	);

	$starter_content = apply_filters( 'jhuy_starter_content', $starter_content );
	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'jhuy_after' );

/**
 * Initialize widget area
 *
 * @return void
 */
function jhuy_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer Left', 'jhuy' ),
		'id'            => 'footer-left',
		'description'   => __( 'Add widget content to the footer.', 'jhuy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Middle', 'jhuy' ),
		'id'            => 'footer-middle',
		'description'   => __( 'Add widget content to the footer.', 'jhuy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Right', 'jhuy' ),
		'id'            => 'footer-right',
		'description'   => __( 'Add widget content to the footer.', 'jhuy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'jhuy_widgets_init' );

/**
 * Enqueue scripts and styles.
 *
 * @return void
 */
function jhuy_scripts() {
	$parent_style = 'jhuy-style';

	// Get theme version.
	$theme_version = wp_get_theme()->get( 'Version' );

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

	// Load Webpack JS bundle file (includes jQuery and other NPM deps.).
	wp_enqueue_script( 'jhuy-head', get_theme_file_uri( '/assets/js/head.js' ), array(), null, true );
	wp_enqueue_script( 'jhuy-bundle', get_theme_file_uri( '/assets/js/bundle.js' ), array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'jhuy_scripts' );

/**
 * Filter to add a class to the menu
 *  anchor.
 *
 * @param array $atts attributes.
 * @return $atts
 */
function add_class_to_menu_anchor( $atts ) {
	$atts['class'] = 'menu-item-link';

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_class_to_menu_anchor', 10 );

/**
 * Custom search form
 *
 * @param string $form form to return.
 * @return $form
 */
function jhuy_search_form( $form ) {
	$form = '<form role="search" method="get" id="searchForm" class="search-form" action="' . home_url( '/' ) . '" >
		<input type="text" id="searchField" class="search-field" placeholder="Search …" value="' . get_search_query() . '" name="s" id="s" />
		<input type="submit" id="searchSubmit" class="search-submit" value="' . esc_attr__( 'Search' ) . '" />
		</div>
	</form>';

	return $form;
}
add_filter( 'get_search_form', 'jhuy_search_form' );

/**
 * Get pagination HTML by calling this function.
 *
 * @return void
 */
function jhuy_get_pagination() {
	if ( have_posts() ) {
		$left_arrow  = jhuy_get_oi_svg( array(
			'name'  => 'arrow-left',
			'class' => 'pagination-arrow pagination-arrow-left',
		) );
		$right_arrow = jhuy_get_oi_svg( array(
			'name'  => 'arrow-right',
			'class' => 'pagination-arrow pagination-arrow-right',
		) );

		the_posts_pagination( array(
			'prev_text' => $left_arrow . '<span class="screen-reader-text">' . __( 'Previous page', 'jhuy' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'jhuy' ) . '</span>' . $right_arrow,
		) );
	}
}

/**
 * Adjust main query before post.
 *
 * @param array $query query object.
 * @return void
 */
function jhuy_pre_get_posts( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$query->set( 'post__not_in', get_option( 'sticky_posts' ) );
	}
}
add_action( 'pre_get_posts', 'jhuy_pre_get_posts' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Admin panel custom theme settings.
 */
require get_parent_theme_file_path( '/inc/admin.php' );

/**
 * Icon functions.
 */
require get_parent_theme_file_path( '/inc/icon.php' );
