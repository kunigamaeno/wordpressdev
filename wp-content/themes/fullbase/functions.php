<?php
/**
 * Theme: Fullbase
 *
 * Theme Functions, includes, etc.
 *
 * @package fullbase
 */


/* ------------------------------------------------------------------------- *
 *  Include Functional File
/* ------------------------------------------------------------------------- */


	require_once('functions/fullbase_bootstrap_navwalker.php');   	// script for bootstrap menu


/* ------------------------------------------------------------------------- *
 *  Base functionality
/* ------------------------------------------------------------------------- */


	// Content width
	if ( !isset( $content_width ) ) { $content_width = 720; }


/*  Theme setup
/* ------------------------------------ */
if ( ! function_exists( 'fullbase_setup' ) ) {

	function fullbase_setup() {

		add_theme_support( "title-tag" );

		// Enable automatic feed links
		add_theme_support( 'automatic-feed-links' );

		// Enable featured image
		add_theme_support( 'post-thumbnails' );

		// Thumbnail sizes
		add_image_size( 'fullbase_single', 800, 493, true ); //(cropped)
		add_image_size( 'fullbase_big', 1400, 928, true ); 	//(cropped)

		// Custom menu areas
		register_nav_menus( array(
			'header' => esc_html__( 'Header', 'fullbase' )
		) );
		
		// Load theme languages
		load_theme_textdomain( 'fullbase', get_template_directory().'/languages' );
		
	}

}
add_action( 'after_setup_theme', 'fullbase_setup' );



/*  Register sidebars
/* ------------------------------------ */
if ( ! function_exists( 'fullbase_sidebars' ) ) {


	function fullbase_sidebars()	{
		register_sidebar(array( 'name' => esc_html__( 'Primary', 'fullbase' ),'id' => 'primary','description' => esc_html__( 'Normal full width sidebar.', 'fullbase' ), 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	}

}
add_action( 'widgets_init', 'fullbase_sidebars' );


/*  Enqueue javascript
/* ------------------------------------ */
if ( ! function_exists( 'fullbase_scripts' ) ) {

	function fullbase_scripts() {

		// all script
		wp_enqueue_script( 'fullbase-core', get_template_directory_uri() . '/js/core.min.js', array( 'jquery' ),null,true );
		wp_enqueue_script( 'fullbase-script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ),'', true );
		
		
		// HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries
		wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/html5/html5shiv.js' );
		wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
		
		wp_enqueue_script( 'respond', get_template_directory_uri() . '/html5/respond.min.js' );
		wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
		
		if ( is_singular() && get_option( 'thread_comments' ) )	{ wp_enqueue_script( 'comment-reply' ); }
	}

}
add_action( 'wp_enqueue_scripts', 'fullbase_scripts' );


/*  Enqueue css
/* ------------------------------------ */
if ( ! function_exists( 'fullbase_styles' ) ) {

	function fullbase_styles() {
		wp_enqueue_style( 'fullbase-core', get_template_directory_uri().'/css/core.min.css');
		wp_enqueue_style( 'fullbase-sourcesanspro','//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700');
		wp_enqueue_style( 'fullbase', get_template_directory_uri().'/style.css');

	}

}
add_action( 'wp_enqueue_scripts', 'fullbase_styles' );

/* ------------------------------------------------------------------------- *
 *  General
/* ------------------------------------------------------------------------- */

	/*  Disable Gallery Inline Style
	/* ------------------------------------ */
	add_filter( 'use_default_gallery_style', '__return_false' );

	/*  Oembed Responsive
	/* ------------------------------------ */
	add_filter( 'embed_oembed_html', 'fullbase_oembed_filter', 10, 4 ) ;

	function fullbase_oembed_filter($html, $url, $attr, $post_ID) {
		$return = '<figure class="video-container">'.$html.'</figure>';
		return $return;
	}

	/*  Enable hr button tiny MCE
	/* ------------------------------------ */
	function fullbase_enable_more_buttons($buttons) {
	  $buttons[] = 'hr';
	  return $buttons;
	}
	add_filter("mce_buttons", "fullbase_enable_more_buttons");


	/*  Remove P in description output
	/* ------------------------------------ */
	remove_filter('term_description','wpautop');


	/*  Add Excerpt on Pages for Seo description
	/* ------------------------------------ */
	add_action( 'init', 'fullbase_add_excerpts_to_pages' );
	function fullbase_add_excerpts_to_pages() {
	     add_post_type_support( 'page', 'excerpt' );
	}

	/* Add images to RSS Feed
	/* ------------------------------------ */
	function fullbase_rss_post_thumbnail($content) {

		global $post;

		if(has_post_thumbnail($post->ID)) {

			$content = '<p>' . get_the_post_thumbnail($post->ID, 'single') . '</p>' . get_the_content();
			$content = preg_replace("/\[caption.*\[\/caption\]/", '',$content);

		}

		return $content;
	}
	add_filter('the_excerpt_rss', 'fullbase_rss_post_thumbnail');
	add_filter('the_content_feed', 'fullbase_rss_post_thumbnail');

?>
