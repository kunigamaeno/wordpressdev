<?php
/**
 * synapse functions and definitions
 *
 * @package synapse
 */



if ( ! function_exists( 'synapse_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function synapse_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on synapse, use a find and replace
	 * to change 'synapse' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'synapse', get_template_directory() . '/languages' );

	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	 global $content_width;
	 if ( ! isset( $content_width ) ) {
		$content_width = 640; /* pixels */
	 }
	 
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 *
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'synapse' ),
		'top' => __( 'Top Menu', 'synapse' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'synapse_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	add_image_size('synapse-sq-thumb', 600,600, true );
	add_image_size('synapse-overlap-thumb', 670,400, true );
	add_image_size('synapse-thumb', 540,450, true );
	add_image_size('synapse-pop-thumb',542, 340, true );
	
	//Declare woocommerce support
	add_theme_support('woocommerce');
	
	//Slider Support
	add_theme_support('rt-slider');
	
	//Custom Logo
	add_theme_support('custom-logo');
	
}
endif; // synapse_setup
add_action( 'after_setup_theme', 'synapse_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function synapse_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'synapse' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'synapse' ), 
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'synapse' ), 
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'synapse' ), 
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 4', 'synapse' ), 
		'id'            => 'footer-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'synapse_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function synapse_scripts() {
	wp_enqueue_style( 'synapse-style', get_stylesheet_uri() );
	
	wp_enqueue_style('synapse-title-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", esc_html(get_theme_mod('synapse_title_font', 'Play') ) ).':100,300,400,700' );
	
	wp_enqueue_style('synapse-body-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", esc_html( get_theme_mod('synapse_body_font', 'Lato') ) ).':100,300,400,700' );
	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css' );
	
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css' );
	
	wp_enqueue_style( 'hover-css', get_template_directory_uri() . '/assets/css/hover.min.css' );
	
	wp_enqueue_style( 'flex-images', get_template_directory_uri() . '/assets/css/jquery.flex-images.css' );

	wp_enqueue_style( 'slicknav', get_template_directory_uri() . '/assets/css/slicknav.css' );
	
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper.min.css' );
	
	wp_enqueue_style( 'synapse-main-theme-style', get_template_directory_uri() . '/assets/css/'.get_theme_mod('synapse_skin', 'default').'.css' );

	wp_enqueue_script( 'synapse-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	
	wp_enqueue_script( 'synapse-externaljs', get_template_directory_uri() . '/js/external.js', array('jquery'), '20120206', true );

	wp_enqueue_script( 'synapse-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	wp_enqueue_script( 'synapse-custom-js', get_template_directory_uri() . '/js/custom.js', array('synapse-externaljs') );
}
add_action( 'wp_enqueue_scripts', 'synapse_scripts' );

/**
 * Enqueue Scripts for Admin
 */
function synapse_custom_wp_admin_style() {
        wp_enqueue_style( 'synapse-admin_css', get_template_directory_uri() . '/assets/css/admin.css' );
        wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css' );
}
add_action( 'customize_controls_print_styles', 'synapse_custom_wp_admin_style' );



//Function to Trim Excerpt Length & more..
function synapse_excerpt_length( $length ) {
	return 23;
}
add_filter( 'excerpt_length', 'synapse_excerpt_length', 999 );

function synapse_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'synapse_excerpt_more' );

//Backwards Compatibility FUnction
function synapse_logo() {	
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
function synapse_has_logo() {
	if (function_exists( 'has_custom_logo')) {
		if ( has_custom_logo() ) {
			return true;
		}
	} else {
		return false;
	}
}

/**
 * Include the Custom Functions of the Theme.
 */
require get_template_directory() . '/framework/theme-functions.php';

/**
 * Implement the Custom CSS Mods.
 */
require get_template_directory() . '/inc/css-mods.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load TGM.
 */
require get_template_directory() . '/framework/tgmpa.php';

