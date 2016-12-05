<?php
/**
 * synapse Theme Customizer
 *
 * @package synapse
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function synapse_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	//Logo Settings
	$wp_customize->add_section( 'title_tagline' , array(
	    'title'      => __( 'Title, Tagline & Logo', 'synapse' ),
	    'priority'   => 30,
	) );
	
	$wp_customize->add_setting( 'synapse_logo_resize' , array(
	    'default'     => 100,
	    'sanitize_callback' => 'synapse_sanitize_positive_number',
	) );
	
	$wp_customize->add_control(
	        'synapse_logo_resize',
	        array(
	            'label' => __('Resize & Adjust Logo','synapse'),
	            'section' => 'title_tagline',
	            'settings' => 'synapse_logo_resize',
	            'priority' => 6,
	            'type' => 'range',
	            'active_callback' => 'synapse_logo_enabled',
	            'input_attrs' => array(
			        'min'   => 30,
			        'max'   => 200,
			        'step'  => 5,
			    ),
	        )
	);
	
	function synapse_logo_enabled($control) {
		$option = $control->manager->get_setting('custom_logo');
		return $option->value() == true;
	}
	
	
	
	//Replace Header Text Color with, separate colors for Title and Description
	//Override synapse_site_titlecolor
	$wp_customize->remove_control('display_header_text');
	$wp_customize->remove_setting('header_textcolor');
	$wp_customize->add_setting('synapse_site_titlecolor', array(
	    'default'     => '#FFFFFF',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'synapse_site_titlecolor', array(
			'label' => __('Site Title Color','synapse'),
			'section' => 'colors',
			'settings' => 'synapse_site_titlecolor',
			'type' => 'color'
		) ) 
	);
	
	$wp_customize->add_setting('synapse_header_desccolor', array(
	    'default'     => '#AAAAAA',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'synapse_header_desccolor', array(
			'label' => __('Site Tagline Color','synapse'),
			'section' => 'colors',
			'settings' => 'synapse_header_desccolor',
			'type' => 'color'
		) ) 
	);
	
	//Settings For Logo Area
	
	$wp_customize->add_setting(
		'synapse_hide_title_tagline',
		array( 'sanitize_callback' => 'synapse_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'synapse_hide_title_tagline', array(
		    'settings' => 'synapse_hide_title_tagline',
		    'label'    => __( 'Hide Title and Tagline.', 'synapse' ),
		    'section'  => 'title_tagline',
		    'type'     => 'checkbox',
		)
	);
		
	function synapse_title_visible( $control ) {
		$option = $control->manager->get_setting('synapse_hide_title_tagline');
	    return $option->value() == false ;
	}
	
	
	//FEATURED POSTS SLIDER
	$wp_customize->add_section(
	    'synapse_feat_post_slider_section',
	    array(
	        'title'     => __('Featured Posts Slider','synapse'),
	        'priority'  => 35,
	    )
	);
	
	
	$wp_customize->add_setting(
		'synapse_feat_post_slider_enable',
		array( 'sanitize_callback' => 'synapse_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'synapse_feat_post_slider_enable', array(
		    'settings' => 'synapse_feat_post_slider_enable',
		    'label'    => __( 'Enable', 'synapse' ),
		    'section'  => 'synapse_feat_post_slider_section',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		    'synapse_feat_post_slider_cat',
		    array( 'sanitize_callback' => 'synapse_sanitize_category' )
		);
	
		
	$wp_customize->add_control(
	    new Synapse_WP_Customize_Category_Control(
	        $wp_customize,
	        'synapse_feat_post_slider_cat',
	        array(
	            'label'    => __('Category For Image Grid','synapse'),
	            'settings' => 'synapse_feat_post_slider_cat',
	            'section'  => 'synapse_feat_post_slider_section'
	        )
	    )
	);
	
	$wp_customize->add_setting(
		'synapse_feat_post_slider_pc',
		array( 'sanitize_callback' => 'synapse_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'synapse_feat_post_slider_pc', array(
		    'settings' => 'synapse_feat_post_slider_pc',
		    'label'    => __( 'Max No. of Posts. Min: 4.', 'synapse' ),
		    'section'  => 'synapse_feat_post_slider_section',
		    'type'     => 'number',
		    'default'  => '0'
		)
	);
	
	
	// Layout and Design
	$wp_customize->add_panel( 'synapse_design_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Design & Layout','synapse'),
	) );
	
	$wp_customize->add_section(
	    'synapse_design_options',
	    array(
	        'title'     => __('Blog Layout','synapse'),
	        'priority'  => 0,
	        'panel'     => 'synapse_design_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'synapse_blog_layout',
		array( 'sanitize_callback' => 'synapse_sanitize_blog_layout','default'=>'synapse' )
	);
	
	function synapse_sanitize_blog_layout( $input ) {
		if ( in_array($input, array('grid','grid_2_column','synapse') ) )
			return $input;
		else 
			return '';	
	}
	
	$wp_customize->add_control(
		'synapse_blog_layout',array(
				'label' => __('Select Layout','synapse'),
				'settings' => 'synapse_blog_layout',
				'section'  => 'synapse_design_options',
				'type' => 'select',
				'choices' => array(
						'grid' => __('Standard Blog Layout','synapse'),
						'synapse' => __('Synapse Theme Layout','synapse'),
						'grid_2_column' => __('Grid - 2 Column','synapse'),
					)
			)
	);
	
	$wp_customize->add_section(
	    'synapse_sidebar_options',
	    array(
	        'title'     => __('Sidebar Layout','synapse'),
	        'priority'  => 0,
	        'panel'     => 'synapse_design_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'synapse_disable_sidebar',
		array( 'sanitize_callback' => 'synapse_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'synapse_disable_sidebar', array(
		    'settings' => 'synapse_disable_sidebar',
		    'label'    => __( 'Disable Sidebar Everywhere.','synapse' ),
		    'section'  => 'synapse_sidebar_options',
		    'type'     => 'checkbox',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'synapse_disable_sidebar_home',
		array( 'sanitize_callback' => 'synapse_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'synapse_disable_sidebar_home', array(
		    'settings' => 'synapse_disable_sidebar_home',
		    'label'    => __( 'Disable Sidebar on Home/Blog.','synapse' ),
		    'section'  => 'synapse_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'synapse_show_sidebar_options',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'synapse_disable_sidebar_front',
		array( 'sanitize_callback' => 'synapse_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'synapse_disable_sidebar_front', array(
		    'settings' => 'synapse_disable_sidebar_front',
		    'label'    => __( 'Disable Sidebar on Front Page.','synapse' ),
		    'section'  => 'synapse_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'synapse_show_sidebar_options',
		    'default'  => false
		)
	);
	
	
	$wp_customize->add_setting(
		'synapse_sidebar_width',
		array(
			'default' => 4,
		    'sanitize_callback' => 'synapse_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'synapse_sidebar_width', array(
		    'settings' => 'synapse_sidebar_width',
		    'label'    => __( 'Sidebar Width','synapse' ),
		    'description' => __('Min: 25%, Default: 33%, Max: 40%','synapse'),
		    'section'  => 'synapse_sidebar_options',
		    'type'     => 'range',
		    'active_callback' => 'synapse_show_sidebar_options',
		    'input_attrs' => array(
		        'min'   => 3,
		        'max'   => 5,
		        'step'  => 1,
		        'class' => 'sidebar-width-range',
		        'style' => 'color: #0a0',
		    ),
		)
	);
	
	/* Active Callback Function */
	function synapse_show_sidebar_options($control) {
	   
	    $option = $control->manager->get_setting('synapse_disable_sidebar');
	    return $option->value() == false ;
	    
	}
	
	$wp_customize-> add_section(
    'synapse_custom_codes',
    array(
    	'title'			=> __('Custom CSS','synapse'),
    	'description'	=> __('Enter your Custom CSS to Modify design.','synapse'),
    	'priority'		=> 11,
    	'panel'			=> 'synapse_design_panel'
    	)
    );
    
	$wp_customize->add_setting(
	'synapse_custom_css',
	array(
		'default'		=> '',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'wp_filter_nohtml_kses',
		'sanitize_js_callback' => 'wp_filter_nohtml_kses'
		)
	);
	
	$wp_customize->add_control(
        'synapse_custom_css',
        array(
            'section' => 'synapse_custom_codes',
            'settings' => 'synapse_custom_css',
            'type' => 'textarea'
        )
    );
	
	function synapse_sanitize_text( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}
	
	$wp_customize-> add_section(
    'synapse_custom_footer',
    array(
    	'title'			=> __('Custom Footer Text','synapse'),
    	'description'	=> __('Enter your Own Copyright Text.','synapse'),
    	'priority'		=> 11,
    	'panel'			=> 'synapse_design_panel'
    	)
    );
    
	$wp_customize->add_setting(
	'synapse_footer_text',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(	 
	       'synapse_footer_text',
	        array(
	            'section' => 'synapse_custom_footer',
	            'settings' => 'synapse_footer_text',
	            'type' => 'text'
	        )
	);	
	
	
	//Select the Default Theme Skin
	$wp_customize->add_section(
	    'synapse_skin_options',
	    array(
	        'title'     => __('Choose Skin','synapse'),
	        'priority'  => 39,
	    )
	);
	
	$wp_customize->add_setting(
		'synapse_skin',
		array(
			'default'=> 'default',
			'sanitize_callback' => 'synapse_sanitize_skin' 
			)
	);
	
	$skins = array( 'default' => __('Default (Red/Yellow/Blue)','synapse'),
					'brown' =>  __('Dark Red/Dark Green/Brown','synapse'),
					'green' => __('Green/Yellow/Orange','synapse') );
	
	$wp_customize->add_control(
		'synapse_skin',array(
				'settings' => 'synapse_skin',
				'section'  => 'synapse_skin_options',
				'type' => 'select',
				'choices' => $skins,
			)
	);
	
	function synapse_sanitize_skin( $input ) {
		if ( in_array($input, array('default','orange','brown','green','grayscale') ) )
			return $input;
		else
			return '';
	}
	
	
	//Fonts
	$wp_customize->add_section(
	    'synapse_typo_options',
	    array(
	        'title'     => __('Google Web Fonts','synapse'),
	        'priority'  => 41,
	        'description' => __('Defaults: Play, Lap.','synapse')
	    )
	);
	
	$font_array = array('Play','Open Sans','Droid Sans','Lato','Droid Serif','Roboto');
	$fonts = array_combine($font_array, $font_array);
	
	$wp_customize->add_setting(
		'synapse_title_font',
		array(
			'default'=> 'Play',
			'sanitize_callback' => 'synapse_sanitize_gfont' 
			)
	);
	
	function synapse_sanitize_gfont( $input ) {
		if ( in_array($input, array('Play','Open Sans','Droid Sans','Lato','Droid Serif','Roboto') ) )
			return $input;
		else
			return '';	
	}
	
	$wp_customize->add_control(
		'synapse_title_font',array(
				'label' => __('Title','synapse'),
				'settings' => 'synapse_title_font',
				'section'  => 'synapse_typo_options',
				'type' => 'select',
				'choices' => $fonts,
			)
	);
	
	$wp_customize->add_setting(
		'synapse_body_font',
			array(	'default'=> 'Lato',
					'sanitize_callback' => 'synapse_sanitize_gfont' )
	);
	
	$wp_customize->add_control(
		'synapse_body_font',array(
				'label' => __('Body','synapse'),
				'settings' => 'synapse_body_font',
				'section'  => 'synapse_typo_options',
				'type' => 'select',
				'choices' => $fonts
			)
	);
	
	// Social Icons
	$wp_customize->add_section('synapse_social_section', array(
			'title' => __('Social Icons','synapse'),
			'priority' => 44 ,
	));
	
	$social_networks = array( //Redefinied in Sanitization Function.
					'none' => __('-','synapse'),
					'facebook' => __('Facebook','synapse'),
					'twitter' => __('Twitter','synapse'),
					'google-plus' => __('Google Plus','synapse'),
					'instagram' => __('Instagram','synapse'),
					'rss' => __('RSS Feeds','synapse'),
					'vine' => __('Vine','synapse'),
					'vimeo-square' => __('Vimeo','synapse'),
					'youtube' => __('Youtube','synapse'),
					'flickr' => __('Flickr','synapse'),
				);
				
	$social_count = count($social_networks);
				
	for ($x = 1 ; $x <= ($social_count - 3) ; $x++) :
			
		$wp_customize->add_setting(
			'synapse_social_'.$x, array(
				'sanitize_callback' => 'synapse_sanitize_social',
				'default' => 'none'
			));

		$wp_customize->add_control( 'synapse_social_'.$x, array(
					'settings' => 'synapse_social_'.$x,
					'label' => __('Icon ','synapse').$x,
					'section' => 'synapse_social_section',
					'type' => 'select',
					'choices' => $social_networks,			
		));
		
		$wp_customize->add_setting(
			'synapse_social_url'.$x, array(
				'sanitize_callback' => 'esc_url_raw'
			));

		$wp_customize->add_control( 'synapse_social_url'.$x, array(
					'settings' => 'synapse_social_url'.$x,
					'description' => __('Icon ','synapse').$x.__(' Url','synapse'),
					'section' => 'synapse_social_section',
					'type' => 'url',
					'choices' => $social_networks,			
		));
		
	endfor;
	
	function synapse_sanitize_social( $input ) {
		$social_networks = array(
					'none' ,
					'facebook',
					'twitter',
					'google-plus',
					'instagram',
					'rss',
					'vine',
					'vimeo-square',
					'youtube',
					'flickr'
				);
		if ( in_array($input, $social_networks) )
			return $input;
		else
			return '';	
	}
	
	$wp_customize->add_section(
	    'synapse_sec_upgrade',
	    array(
	        'title'     => __('Synapse Theme - Help & Support','synapse'),
	        'priority'  => 45,
	    )
	);
	
	$wp_customize->add_setting(
			'synapse_upgrade',
			array( 'sanitize_callback' => 'esc_textarea' )
		);
			
	$wp_customize->add_control(
	    new Synapse_WP_Customize_Upgrade_Control(
	        $wp_customize,
	        'synapse_upgrade',
	        array(
	            'label' => __('Thank You','synapse'),
	            'description' => __('Thank You for Choosing Synapse Theme by Rohitink.com. Synapse is a Powerful Wordpress theme which also supports WooCommerce in the best possible way. It is "as we say" the last theme you would ever need. It has all the basic and advanced features needed to run a gorgeous looking site. For any Help related to this theme, please visit  <a href="https://rohitink.com/2016/02/01/synapse-news-magazine-theme/">Synapse Help & Support</a>.','synapse'),
	            'section' => 'synapse_sec_upgrade',
	            'settings' => 'synapse_upgrade',			       
	        )
		)
	);
	
	
	/* Sanitization Functions Common to Multiple Settings go Here, Specific Sanitization Functions are defined along with add_setting() */
	function synapse_sanitize_checkbox( $input ) {
	    if ( $input == 1 ) {
	        return 1;
	    } else {
	        return '';
	    }
	}
	
	function synapse_sanitize_positive_number( $input ) {
		if ( ($input >= 0) && is_numeric($input) )
			return $input;
		else
			return '';	
	}
	
	function synapse_sanitize_category( $input ) {
		if ( term_exists(get_cat_name( $input ), 'category') )
			return $input;
		else 
			return '';	
	}
	
	function synapse_sanitize_product_category( $input ) {
		if ( get_term( $input, 'product_cat' ) )
			return $input;
		else 
			return '';	
	}
	
	
}
add_action( 'customize_register', 'synapse_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function synapse_customize_preview_js() {
	wp_enqueue_script( 'synapse_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'synapse_customize_preview_js' );
