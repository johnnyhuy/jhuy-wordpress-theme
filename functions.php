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
			'blog',
			'news',
			'about',
			'contact',
		),

		// Default options.
		'options' => array(
			'show_on_front'  => 'page',
			'page_on_front'  => '',
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
 * Custom password form.
 *
 * @param string $post the post.
 * @return string
 */
function jhuy_password_form( $post ) {
	// Get post.
	$post = get_post( $post );

	// Set label.
	$label = 'pwbox-' . ( empty($post->ID) ? rand() : $post->ID );

	// Build output.
	$output  = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">';
	$output .= '<label for="' . $label . '">' . __( 'Password' ) . '</label>';
	$output .= ' <input class="post-password-field" name="post_password" id="' . $label . '" type="password" size="20" />';
	$output .= '<input class="post-password-submit" type="submit" name="Submit" value="' . esc_attr_x( 'Enter', 'post password form' ) . '" />';
	$output .= '</form>';

	return $output;
}
add_filter( 'the_password_form', 'jhuy_password_form' );

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
			'prev_text' => $left_arrow,
			'next_text' => $right_arrow,
		) );
	}
}

/**
 * Singular post titles look different to
 * blog content.
 *
 * @return void
 */
function jhuy_the_title() {
	/**
	 * Do not show dot next to title if sticky,
	 * since sticky posts look different
	 * compared to normal posts.
	 */
	$dot = is_sticky() ? '' : 'site-blog-dot';

	if ( is_single() ) {
		$title_start = '<h3 class="entry-title">';
		$title_end   = '</h3>';
	} elseif ( is_front_page() || is_home() ) {
		$title_start = '<h3 class="entry-title ' . $dot . '"><a class="entry-title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
		$title_end   = '</a></h3>';
	} else {
		$title_start = '<h3 class="entry-title"><a class="entry-title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
		$title_end   = '</a></h3>';
	}

	the_title( $title_start, $title_end );
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
 * Modify the more text in an excerpt.
 *
 * @param string $more excerpt string.
 * @return string
 */
function jhuy_excerpt_more( $more ) {
	return sprintf( '<a class="entry-excerpt-more" href="%1$s">%2$s</a>',
		get_permalink( get_the_ID() ),
		__( '... See More', 'jhuy' )
	);
}
add_filter( 'excerpt_more', 'jhuy_excerpt_more' );

/**
 * Custom callback for list comments in posts.
 *
 * @param object $comment comments object needed to display.
 * @param array  $args arguments.
 * @param string $depth depth of comments.
 * @return void
 */
function jhuy_list_comments_callback( $comment, $args, $depth ) {
	$avatar = get_avatar( $comment, $args['avatar_size'] );
	?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<article id="comment-article-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php echo $avatar; ?>
					<?php echo get_comment_author_link( $comment ); ?>
				</div><!-- .comment-author -->
				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
						<?php
						printf(
							'%1$s ago, %2$s',
							get_elapsed_time_string( get_comment_time( 'U' ), 'U' ),
							get_comment_date( 'F d Y', $comment )
						);
						?>
						</time>
					</a>
				</div><!-- .comment-metadata -->
			</footer>
			<div class="comment-content">
				<?php comment_text(); ?>
				<div class="comment-reply">
				</div><!-- .comment-reply -->
			</div><!-- .comment-content -->
			<div class="comment-controls">
				<?php edit_comment_link( __( 'Edit' ), '<span class="comment-edit">', '</span>' ); ?>
				<?php
				comment_reply_link( array_merge( $args, array(
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
				) ) );
				?>
			</div>
		</article>
	</li><!-- .comment -->
	<?php
}

/**
 * Remove screen reader text from navigation markup.
 *
 * @param string $content Raw HTML content.
 * @return string
 */
function remove_screen_reader_text( $content ) {
	$exp     = '$<h2 class="screen-reader-text">(.*?)<\/h2>$si';
	$content = preg_replace( $exp, '', $content );

	return $content;
}
add_action( 'navigation_markup_template', 'remove_screen_reader_text' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/time-string.php' );

/**
 * Admin panel custom theme settings.
 */
require get_parent_theme_file_path( '/inc/admin.php' );

/**
 * Icon functions.
 */
require get_parent_theme_file_path( '/inc/icon.php' );
