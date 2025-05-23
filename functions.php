<?php
/**
 * poonam_themes functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package poonam_themes
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function poonam_themes_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on poonam_themes, use a find and replace
		* to change 'poonam_themes' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'poonam_themes', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'poonam_themes' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'poonam_themes_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'poonam_themes_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function poonam_themes_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'poonam_themes_content_width', 640 );
}
add_action( 'after_setup_theme', 'poonam_themes_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function poonam_themes_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'poonam_themes' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'poonam_themes' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'poonam_themes_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function poonam_themes_scripts() {
	wp_enqueue_style( 'poonam_themes-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'poonam_themes-style', 'rtl', 'replace' );

	wp_enqueue_script( 'poonam_themes-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'poonam_themes_scripts' );

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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


//slider
function poonam_enqueue_styles_and_scripts() {
	
    // Always load the main style.css
    wp_enqueue_style( 'poonam-style', get_stylesheet_uri() );
 // Load slider JS only on front-page.php
        // wp_enqueue_script( 'slider', get_template_directory_uri() . '/assets/js/slider.js', array(), false, true );
		wp_enqueue_script(
			'menu-toggle', 
			get_template_directory_uri() . '/assets/js/custom-script.js', 
			false, // Version (set it to false or provide version number)
			true // Load in footer (true to load at the end of the page, recommended for performance)
		);
    // Load slider CSS only on front-page.php
    if ( is_front_page() ) {
		wp_enqueue_style( 'homepage-style', get_template_directory_uri() . '/assets/css/front-page.css' );

       
    }

}
add_action( 'wp_enqueue_scripts', 'poonam_enqueue_styles_and_scripts' );

function custom_enqueue_aboutus_styles() {
    if ( is_page( array( 78, 81,3, 84, 156) ) ) {
		wp_enqueue_style( 'aboutus-style', get_template_directory_uri() . '/assets/css/about-us.css' );
		wp_enqueue_style( 'homepage-style', get_template_directory_uri() . '/assets/css/front-page.css' );
		wp_enqueue_style( 'service-page-style', get_template_directory_uri() . '/assets/css/services.css' );
		wp_enqueue_style( 'contact-us-style', get_template_directory_uri() . '/assets/css/contact-us.css' );
		wp_enqueue_style( 'policies-faq', get_template_directory_uri() . '/assets/css/privacypolicy-faq.css' );
	}
}	

add_action( 'wp_enqueue_scripts', 'custom_enqueue_aboutus_styles' );

require get_template_directory() . '/inc/home-page-custom-meta-box.php';
require get_template_directory() . '/inc/aboutus-page-custom-meta-box.php';
require get_template_directory() . '/inc/faq_meta_box.php';
require get_template_directory() . '/inc/contacts.php';





function register_footer_menus() {
    register_nav_menus([
        'footer_quick_links' => 'Footer – Quick Links',
        'footer_services' => 'Footer – Services',
        'footer_contact' => 'Footer – Contact',
    ]);
}
add_action('after_setup_theme', 'register_footer_menus');



function krisli_register_cleaning_services_cpt() {
    $labels = array(
        'name' => 'Cleaning Services',
        'singular_name' => 'Cleaning Service',
        'add_new' => 'Add New Service',
        'add_new_item' => 'Add New Cleaning Service',
        'edit_item' => 'Edit Cleaning Service',
        'new_item' => 'New Cleaning Service',
        'view_item' => 'View Cleaning Service',
        'search_items' => 'Search Cleaning Services',
        'not_found' => 'No services found',
        'menu_name' => 'Cleaning Services'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
		'menu_icon' => 'dashicons-awards',
        'rewrite' => array('slug' => 'cleaning-services'),
        'supports' => array('title', 'editor', 'thumbnail'),
    );

    register_post_type('cleaning_service', $args);
}
add_action('init', 'krisli_register_cleaning_services_cpt');
