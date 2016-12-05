<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function klasik_optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);

	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {
	
	$shortname = 'klasik';
	
	$optLogotype 	= array(
		'imagelogo' 	=> __('Image logo','klasik'),
		'textlogo' 		=> __('Text-based logo','klasik')
		 );
		 

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array( 'name' => __('General', 'klasik'),
		'type' => 'heading');
	
	$options[] = array( 'name' => __('Disable Responsive', 'klasik'),
		'desc' => __('Select this checkbox to disable responsive feature.', 'klasik'),
		'id' => $shortname."_disable_responsive",
		'std' => '0',
		'type' => 'checkbox');
	
	if(file_exists( get_stylesheet_directory() . '/fixedmenu.css')){
	$options[] = array( 'name' => __('Enable Fixed Menu', 'klasik'),
		'desc' => __('Select this checkbox to enable fixed menu.', 'klasik'),
		'id' => $shortname."_enable_fixed_menu",
		'std' => '0',
		'type' => 'checkbox');
	}
	
	$options[] = array( 'name' => __('Default Layout', 'klasik'),
		'desc' => __('Select the default layout for your theme.', 'klasik'),
		'id' => $shortname."_sidebar_position",
		'std' => 'two-col-left',
		'type' => 'images',
		'options' => array(
			'one-col' =>  $imagepath . '1col.png',
			'two-col-left' => $imagepath . '2cl.png',
			'two-col-right' => $imagepath . '2cr.png')
	);
	
	
	$options[] = array( 'name' => __('Header', 'klasik'),
		'type' => 'heading');
	
	$options[] = array( 'name' => __('Logo Type', 'klasik'),
		'desc' => __('If text-based logo is activated, enter the sitename and tagline in the fields below.', 'klasik'),
		'id' => $shortname."_logo_type",
		'std' => 'imagelogo',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $optLogotype);
	
	$options[] = array( 'name' => __('Site name', 'klasik'),
		'desc' => __('Put your sitename in here.', 'klasik'),
		'id' => $shortname."_site_name",
		'std' => '',
		'type' => 'text');
	
	$options[] = array( 'name' => __('Tagline', 'klasik'),
		'desc' => __('Put your tagline in here.', 'klasik'),
		'id' => $shortname."_tagline",
		'std' => '',
		'type' => 'text');
	
	$options[] = array( 'name' => __('Logo Image', 'klasik'),
		'desc' => __('If image logo is activated, upload the logo image.', 'klasik'),
		'id' => $shortname."_logo_image",
		'type' => 'upload');
		
	$options[] = array( 'name' => __('Footer', 'klasik'),
		'type' => 'heading');

	
	$options[] = array( 'name' => __('Footer Text', 'klasik'),
		'desc' => __('You can use html tag in here.', 'klasik'),
		'id' => $shortname."_footer",
		'std' => '',
		'type' => 'textarea');
	
	$options[] = array( 'name' => __('Footer Script', 'klasik'),
		'desc' => __('Enter your footer script here.', 'klasik'),
		'id' => $shortname."_footerscript",
		'std' => '',
		'type' => 'textarea');
	
	$options[] = array( 'name' => __('Custom Styling', 'klasik'),
		'type' => 'heading');
		
	add_thickbox();
	if(file_exists( get_stylesheet_directory() . '/color.css')){
		$thecolorfile =  get_stylesheet_directory_uri().'/color.css';
	}else{
		$thecolorfile =  get_stylesheet_directory_uri().'/css/color.css';
	}
	$options[] = array( 'name' => __('Custom CSS', 'klasik'),
		'desc' => __('Enter your custom css here. <br/> <strong>You can see the original styles to override it :</strong>', 'klasik').' <a href="'.$thecolorfile.'?iframe=true&width=950&height=600" class="useprettyphoto">color.css</a>',
		'id' => $shortname."_customcss",
		'std' => '',
		'type' => 'textarea');
	
	$options = apply_filters('klasik_optionsframework_options', $options);
	
	return $options;
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'klasik_optionsframework_custom_scripts');

function klasik_optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});

	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}

});
</script>

<?php
}