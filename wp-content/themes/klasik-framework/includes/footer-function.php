<?php
// get website title
if(!function_exists("klasik_footer_text")){
	function klasik_footer_text(){
	
		$foot= wp_kses_post(klasik_get_option( 'klasik_footer'));
		if($foot!=""){
        	echo $foot;
        }
		
	}// end klasik_footer_text()
}

// Copyright
if(!function_exists("klasik_copyright_text")){
	function klasik_copyright_text(){

			_e('Copyright', 'klasik'); echo ' &copy; ';
			
				echo date('Y') . ' <a href="'.esc_url( home_url( '/' ) ).'">'.get_bloginfo('name') .'</a>.';
			?>
			<?php _e(' Designed by', 'klasik'); ?>	<a href="<?php echo esc_url( __( 'http://www.klasikthemes.com', 'klasik' ) ); ?>" title=""><?php _e('Klasik Themes','klasik')?></a>.
            
        <?php 
		
	}// end klasik_copyright_text()
}

if(!function_exists("klasik_foot")){
	function klasik_foot(){
		do_action("klasik_foot");
	}
}
add_action("wp_footer","klasik_foot",20);

?>
