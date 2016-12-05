<?php
function klasik_styles() {
	
	if(is_admin()){
		if(function_exists( 'optionsframework_init' ) || function_exists( 'rwmb_meta' )){
			wp_enqueue_style('klasik-admin', get_template_directory_uri().'/css/admin.css', '', '', 'screen, all');
		}
	}
	
	if (!is_admin() || function_exists( 'optionsframework_init' )) {
		wp_enqueue_style('prettyphoto', get_template_directory_uri().'/css/prettyPhoto.css', '', '', 'screen, all');
	}

	if (!is_admin()) {
		wp_enqueue_style('googleFonts', ( is_ssl() ? 'https' : 'http' ) . '://fonts.googleapis.com/css?family=Open+Sans:400,600,300,700,600italic,400italic,300italic,700italic');
		wp_enqueue_style('klasik-skeleton', get_template_directory_uri().'/css/skeleton.css', '', '', 'screen, all');	
		wp_enqueue_style('klasik-general', get_template_directory_uri().'/css/general.css', '', '', 'screen, all');
		wp_enqueue_style('flexslider', get_template_directory_uri().'/css/flexslider.css', '', '', 'screen, all');	
		wp_enqueue_style('fontawesome', get_template_directory_uri() . '/css/font-awesome.css' , array(), '4.4.0', 'all' );
		
		if(file_exists( get_stylesheet_directory() . '/fixedmenu.css')){
			$enable_fixedmenu = esc_attr(klasik_get_option( 'klasik_enable_fixed_menu',''));
			if($enable_fixedmenu=='1'){
				wp_enqueue_style('klasik-fixedmenu', get_template_directory_uri().'/fixedmenu.css', '', '', 'screen, all');
			}
		}
		
		// Load our main stylesheet.
		wp_enqueue_style( 'klasik-style', get_stylesheet_uri() );
		
		if(file_exists( get_stylesheet_directory() . '/color.css')){
			wp_enqueue_style('klasik-color', get_template_directory_uri().'/color.css', '', '', 'screen, all');
		}else{
			wp_enqueue_style('klasik-color', get_template_directory_uri().'/css/color.css', '', '', 'screen, all');
		}	
		


		wp_enqueue_style('klasik-layout', get_template_directory_uri().'/css/layout.css', '', '', 'all');
	
	}
}
add_action('init', 'klasik_styles');