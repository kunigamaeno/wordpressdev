<?php
function klasik_script() {
		
	if (!is_admin() || function_exists( 'optionsframework_init' )) {
		wp_enqueue_script('prettyphoto', get_template_directory_uri().'/js/jquery.prettyPhoto.js', array('jquery'), '3.1.6', true);
	}
	if(is_admin()){
		if( function_exists( 'optionsframework_init' )){
			wp_enqueue_script('klasik-options-custom', get_template_directory_uri().'/js/options-custom.js', array('jquery'), '1.0', true);
		}
	}
	if (!is_admin()) {
		wp_enqueue_script('flexslider', get_template_directory_uri().'/js/jquery.flexslider.js', array('jquery'), '2.6.0', true);
		wp_enqueue_script('modernizr', get_template_directory_uri().'/js/modernizr.js', array('jquery'), '2.8.3', true);
		wp_enqueue_script('superfish', get_template_directory_uri().'/js/superfish.js', array('jquery'), '1.4.8', true);
		wp_enqueue_script('supersubs', get_template_directory_uri().'/js/supersubs.js', array('jquery'), '0.2', true);
		wp_enqueue_script('tinynav', get_template_directory_uri().'/js/tinynav.js', array('jquery'), '1.2', true);
		wp_enqueue_script('retina', get_template_directory_uri().'/js/retina-1.3.js', array('jquery'), '1.3.0', true);
		wp_enqueue_script('klasik-custom', get_stylesheet_directory_uri().'/js/custom.js', array('jquery'), '1.0', true);

		if(file_exists( get_stylesheet_directory() . '/fixedmenu.css')){
			$enable_fixedmenu = esc_attr(klasik_get_option( 'klasik_enable_fixed_menu',''));
			if($enable_fixedmenu=='1'){
				wp_enqueue_script('klasik-fixedmenu', get_stylesheet_directory_uri().'/js/fixedmenu.js', array('jquery'), '1.0', true);
			}
		}

	}
	
	// Load the html5 shiv.
	wp_enqueue_script( 'klasik-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'klasik-html5', 'conditional', 'lt IE 9' );
	
	
}
add_action('init', 'klasik_script');