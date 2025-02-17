<?php
/**
 * PPx Starter Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package PPx_Starter_Theme
 */

if ( ! function_exists( 'ppx_starter_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ppx_starter_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on PPx Starter Theme, use a find and replace
		 * to change 'ppx-starter' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ppx-starter', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		
		register_nav_menus( array(
			'menu-primary-satcom-desktop' => esc_html__( 'Primary SATCOM Desktop', 'ppx-starter' ),
			'menu-primary-apps-desktop' => esc_html__( 'Primary Apps Desktop', 'ppx-starter' ),
			'menu-primary-services-desktop' => esc_html__( 'Primary Services Desktop', 'ppx-starter' ),
			'menu-primary-company-desktop' => esc_html__( 'Primary Company Desktop', 'ppx-starter' ),
            
            'menu-primary-satcom-mobile' => esc_html__( 'Primary SATCOM Mobile', 'ppx-starter' ),
			'menu-primary-apps-mobile' => esc_html__( 'Primary Apps Mobile', 'ppx-starter' ),
			'menu-primary-services-mobile' => esc_html__( 'Primary Services Mobile', 'ppx-starter' ),
			'menu-primary-company-mobile' => esc_html__( 'Primary Company Mobile', 'ppx-starter' ),
            
            'menu-primary-desktop' => esc_html__( 'Primary Desktop', 'ppx-starter' ), // Register Mobile Nav Menu
            
            'menu-primary-mobile' => esc_html__( 'Primary Mobile', 'ppx-starter' ), // Register Mobile Nav Menu
            
            'menu-footer-desktop' => esc_html__( 'Footer Desktop', 'ppx-starter' ), // Register Desktop Footer Menu
            'menu-footer-mobile' => esc_html__( 'Footer Mobile', 'ppx-starter' ), // Register Mobile Footer Menu
            
            'menu-subpage-company' => esc_html__( 'Subpage Company Nav', 'ppx-starter' ), // Register Subpage Company Nav Menu
            'menu-subpage-industries' => esc_html__( 'Subpage Industries Nav', 'ppx-starter' ), // Register Subpage Industries Nav Menu
            'menu-subpage-services' => esc_html__( 'Subpage Services Nav', 'ppx-starter' ), // Register Subpage Services Nav
		) );
       

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ppx_starter_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 75,
			'width'       => 75,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'ppx_starter_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ppx_starter_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'ppx_starter_content_width', 640 );
}
add_action( 'after_setup_theme', 'ppx_starter_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ppx_starter_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ppx-starter' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ppx-starter' ),
		'before_widget' => '<section id="%1$s" class="uk-card uk-card-body uk-card-default widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title uk-card-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Page Bottom 1', 'ppx-starter' ),
		'id'            => 'page-bottom-1',
		'description'   => esc_html__( 'Add widgets here for Page Bottom Area 1', 'ppx-starter' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title uk-h1">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ppx_starter_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ppx_starter_scripts() {
	wp_enqueue_style( 'ppx-starter-style', get_stylesheet_uri(), array(), '1.0' );

	wp_enqueue_script( 'ppx-starter-uikit', get_template_directory_uri() . '/js/uikit.min.js', array(), '3.7.0', false );

	wp_enqueue_script( 'ppx-starter-uikit-icons', get_template_directory_uri() . '/js/uikit-icons.min.js', array(), '3.7.0', true );
    
    wp_enqueue_script('jquery');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ppx_starter_scripts' );

/**
 * Custom Image Sizes
 */
add_image_size( 'small', 9999, 300 ); // 300px height unlimited width
add_image_size( 'medium-small', 450, 9999 ); // 300px wide unlimited height
add_image_size( 'xl', 1200, 9999 ); // 1200px wide unlimited height
add_image_size( 'xxl', 2000, 9999 ); // 2000px wide unlimited height
add_image_size( 'xxxl', 3000, 9999 ); // 3000px wide unlimited height


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom block registration. ---------------
 */
require get_template_directory() . '/template-parts/views/_view-base.php';
require get_template_directory() . '/template-parts/views/code.php';
require get_template_directory() . '/template-parts/views/card.php';
require get_template_directory() . '/template-parts/views/filter.php';
require get_template_directory() . '/template-parts/views/thumbnail-grid.php';
require get_template_directory() . '/template-parts/views/card-archive.php';
require get_template_directory() . '/template-parts/views/slider.php';
require get_template_directory() . '/template-parts/views/tile.php';



/**
 * Enable block template creation
 */
add_theme_support( 'block-templates' );

/**
 * Custom block registration.
 */
require get_template_directory() . '/inc/register-blocks.php';

/**
 * ACF Dynamic field population
 */
require get_template_directory() . '/inc/dynamic-fields.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/template-widgets.php';

/**
 * Enable Yoast Breadcrumbs
 */
add_theme_support( 'yoast-seo-breadcrumbs' );;

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
