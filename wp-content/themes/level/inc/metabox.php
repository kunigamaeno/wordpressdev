<?php
/**
 * Add meta box
 *
 */
function levelsingle_add_meta_boxes( $post ){
	add_meta_box( 'food_meta_box', __( '<span class="dashicons dashicons-layout"></span> Post Layout Select [Pro Only]', 'level' ), 'levelsingle_build_meta_box', 'post', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'levelsingle_add_meta_boxes' );
/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function levelsingle_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'levelsinglemeta_meta_box_nonce' );
	// retrieve the _food_levelsinglemeta current value
	$current_levelsinglemeta = get_post_meta( $post->ID, '_food_levelsinglemeta', true );
	
	$upgradetopro = 'Layout Select for current post only - for website layout please choose from theme options <a href="' . esc_url('http://www.insertcart.com/product/level-wordpress-theme/','level') . '" target="_blank">' . esc_attr__( 'Get Level Pro', 'level' ) . '</a>';
	
	
	?>
	<div class='inside'>

		<h4><?php echo $upgradetopro; ?></h4>
		<p>
			<input type="radio" name="levelsinglemeta" value="rsd" <?php checked( $current_levelsinglemeta, 'rsd' ); ?> /> <?php _e('Right Sidebar - Default','level'); ?><br />
			<input type="radio" name="levelsinglemeta" value="ls" <?php checked( $current_levelsinglemeta, 'ls' ); ?> /> <?php _e('Left Sidebar','level'); ?><br/>
			<input type="radio" name="levelsinglemeta" value="lr" <?php checked( $current_levelsinglemeta, 'lr' ); ?> /> <?php _e('Left - Right Sidebars','level'); ?> <br/>
			<input type="radio" name="levelsinglemeta" value="fc" <?php checked( $current_levelsinglemeta, 'fc' ); ?> /> <?php _e('Full Content - No Sidebar','level'); ?>
		</p>

		

	</div>
	<?php
}
/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
 */
function food_save_meta_box_data( $post_id ){
	// verify meta box nonce
	if ( !isset( $_POST['levelsinglemeta_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['levelsinglemeta_meta_box_nonce'], basename( __FILE__ ) ) ){
		return;
	}
	// return if autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return;
	}
  // Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ){
		return;
	}
	// store custom fields values
	// levelsinglemeta string
	if ( isset( $_REQUEST['levelsinglemeta'] ) ) {
		update_post_meta( $post_id, '_food_levelsinglemeta', sanitize_text_field( $_POST['levelsinglemeta'] ) );
	}

}
add_action( 'save_post', 'food_save_meta_box_data' );