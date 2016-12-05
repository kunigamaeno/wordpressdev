<?php
// =============================== Klasik Magazine widget ======================================
class Klasik_MagazineWidget extends WP_Widget {
    /** constructor */

	function Klasik_MagazineWidget() {
		$widget_ops = array('classname' => 'widget_klasik_magazine', 'description' => __('Klasik Magazine Style','klasik') );
		parent::__construct('klasik-magazine-widget', __('Klasik Magazine Style','klasik'), $widget_ops);
	}


  /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title 			= apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);

		$category 		= apply_filters('widget_category', empty($instance['category']) ? '' : $instance['category']);
		$cols 			= apply_filters('widget_cols', empty($instance['cols']) ? '' : $instance['cols']);
		$showposts 		= apply_filters('widget_showpost', empty($instance['showpost']) ? '' : $instance['showpost']);
		$longdesc 		= apply_filters('widget_longdesc', empty($instance['longdesc']) ? '' : $instance['longdesc']);
		$customclass 	= apply_filters('widget_customclass', empty($instance['customclass']) ? '' : $instance['customclass']);
		
		$text 					= isset($instance['text']) ? $instance['text'] : false;
        $wpautop				= isset($instance['wpautop']) ? $instance['wpautop'] : false;
		
		$instance['category'] = esc_attr(isset($instance['category'])? $instance['category'] : "");
		global $wp_query;
		
		$longdesc = (!is_numeric($longdesc) || empty($longdesc))? 0 : $longdesc;
		$showposts = (!is_numeric($showposts))? get_option('posts_per_page') : $showposts;
		
		$cols = intval($cols);
		

		if(!is_numeric($cols) || $cols < 1 || $cols > 6){
			$cols = 4;
		}
		
        if ( $customclass ) {
            $before_widget = str_replace('class="', 'class="'. $customclass . ' ', $before_widget);
        }  
		
        			 echo $before_widget; 
	
					 echo '
					    <div class="all-widget-wrapper">
                		<div class="container">
                    	<div class="row">
                        <div class="twelve columns">
					 ';
					 
					 echo '<div class="klasik-magazinepost-widget-wrapper" >';
					 
					 
					$titleline='<span class="line-wrap-title"><span class="line-title"></span></span>';
					
					
					if ( $title!='' )
					echo $before_title . esc_html($title). $titleline . $after_title;

						
					$output = "";
					
					// Echo the text
					if($text){
						if($wpautop == "on") { $text = wpautop($text); }
						$output .='<div class="text-under-title magazine-text">'.$text.'</div>';
					}	
					
					
					
					if($cols==1){
						$colname = "one-col-style";
					}elseif($cols==2){
						$colname = "two-col-style";
					}elseif($cols==3){
						$colname = "headline-col-style";
					}else{
						$colname = "";
					}

					$output .='<div class="klasik-magazinepost-widget '.$colname.'">';
						$output .='<div class="row">';
							
							
							if($cols==1){
								$colclass = "twelve";
							}elseif($cols==2){
								$colclass = "one_half";
							}elseif($cols==3){
								$colclass = "twelve";
							}else{
								$colclass = "";
							}
							
							$temp = $wp_query;
							$wp_query= null;
							$wp_query = new WP_Query();
							$args = array(
								"post_type" => "post",
								"showposts" => $showposts
							);
							
							if( $category!="" ){
								$args['tax_query'] = array(
									array(
										'taxonomy' => 'category',
										'field' => 'id',
										'terms' => $category
									)
								);
							}
							
							$wp_query->query($args);
							global $post;
							
							
								$tpl ='<div id="magpost-%%ID%%" class="tpl1 %%CLASS%%">';
									$tpl .='<div class="recent-item">';
									$tpl .= '<div class="recent-thumb">%%THUMB%%</div>';
									
									$tpl .= '<h3 class="recent-title"><a href="%%LINK%%">%%TITLE%%</a></h3>';
									$tpl .= '<span class="smalldate">'.__('Posted on ', 'klasik').' %%DATE%%</span>';
	
									$tpl .='<div class="recent-text">%%TEXT%%</div>';
									$tpl .= '<div class="recent-link"><a href="%%LINK%%">'.__('Read More', 'klasik').'</a></div>';
									$tpl .='<div class="clear"></div>';
									
									$tpl .='</div>';
								$tpl .='</div>';
								$tpl = apply_filters( 'klasik_magazine_item_template1', $tpl );
								
								$tpl2 ='<div id="magpost-%%ID%%" class="tpl2 %%CLASS%%">';
									$tpl2 .='<div class="recent-item">';
									$tpl2 .= '<div class="recent-thumb">%%THUMB2%%</div>';
									
									$tpl2 .= '<h3 class="recent-title"><a href="%%LINK%%">%%TITLE%%</a></h3>';
									$tpl2 .= '<span class="smalldate">'.__('Posted on ', 'klasik').' %%DATE%%</span>';
									$tpl2 .='<div class="clear"></div>';
									
									$tpl2 .='</div>';
								$tpl2 .='</div>';
								$tpl2 = apply_filters( 'klasik_magazine_item_template2', $tpl2 );

							
							
							if ($wp_query->have_posts()) : 
								
						
								if($cols==1){
									$x = $y = 0;
								}elseif($cols==2){
									$x = $y = 1;
								}elseif($cols==3){
									$x = $y = 2;
								}else{
									$x = $y = 0;
								}
								
								while ($wp_query->have_posts()) : $wp_query->the_post(); 
								
								
									$x++;
									$y++;
									
									if($y<=$cols){
										$template = $tpl;
										$x = 0;
										$noclass = 'post'.$y;
									}else{
								
										$template = $tpl2;
										
										if($cols==2){$colclass = "one_half";}
										if($cols==3){$colclass = "one_half";}
										$noclass = 'post'.$x;
									}
									
									if($x%$cols==0 && $x!=0){
										$omega = "omega";
									}elseif($x%$cols==1 && $x!=0){
										$omega = "alpha";
									}else{
										$omega = "";
									}
								
									if(has_post_thumbnail($post->ID) ){
										$thumb = get_the_post_thumbnail($post->ID, 'klasik-widget-magazine', array('class' => 'magpostimg'));
										$thumb2 = get_the_post_thumbnail($post->ID, 'thumbnail', array('class' => 'magpostimg2'));
									}else{
										$thumb = $thumb2 = "";
									}
									
									if($thumb){
										$withimage = "imageon";
									}else{
										$withimage = "imageoff";
									}							
									
				
									//POSTID
									$template = str_replace( '%%ID%%', $post->ID, $template );
									
									//postformat
									$postformat = '';
									$postformat .= 'format-'.get_post_format($post->ID);
									$template = str_replace( '%%FORMAT%%', $postformat, $template );
									
									//POSTCLASS
									$postclass  = 'columns ';
									$postclass .= $colclass.' ';
									$postclass .= $noclass.' ';
									$postclass .= $omega.' ';
									$postclass .= $withimage;
									$template = str_replace( '%%CLASS%%', $postclass, $template );
									
									//POSTTITLE
									$posttitle  = '';
									$posttitle .= get_the_title();
									$template   = str_replace( '%%TITLE%%', $posttitle, $template );
									
									//TAGS
									$maintags = "";
									$posttags = get_the_tags();
									$count=0;
									if ($posttags) {
									  $maintags .= '<div class="tags">';
									  foreach($posttags as $tag) {
										$count++;
										if (1 == $count) {
										  $maintags .= $tag->name . ' ';
										}
									  }
									  $maintags .= '</div>' ; 
									}
									$template = str_replace( '%%TAG%%', $maintags, $template );
									
									//AllTAGS
									$alltags = '';
									$alltags = get_the_tag_list('<ul class="tags"><li>','</li><li>','</li></ul>');
									$template = str_replace( '%%ALLTAGS%%', $alltags, $template );
									
									//POSTDATE
									$postdate  = '';
									$postdate .= get_the_time( get_option('date_format') );
									$template   = str_replace( '%%DATE%%', $postdate, $template );
									
									//POST-DAY
									$postday  = '';
									$postday .= get_the_time( 'd' );
									$template   = str_replace( '%%DAY%%', $postday, $template );
									
									//POST-MONTH
									$postmonth  = '';
									$postmonth .= get_the_time('M');
									$template   = str_replace( '%%MONTH%', $postmonth, $template );
									
									//POST-YEAR
									$postyear  = '';
									$postyear .= get_the_time('Y');
									$template   = str_replace( '%%YEAR%', $postyear, $template );
									
									//POSTLINK
									$postlink = get_permalink();
									$template = str_replace( '%%LINK%%', $postlink, $template );
									
									//POSTCATEGORY
									$categories = get_the_category();
									$separator = apply_filters( 'klasik_magazine_cat_separator', ', ' );
									$atitle = apply_filters( 'klasik_magazine_cat_linktitle', __( "View all posts in %s", 'klasik' ) );
									$postcat = '';
									$i = 0;
									if($categories){
										foreach($categories as $category) {
											$i++;
											$postcat .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( $atitle, $category->name ) ) . '">'.$category->cat_name.'</a>';
											if($i != count($categories)){
												$postcat .= $separator;
											}
										}
									}
									$template = str_replace( '%%CATEGORY%%', $postcat, $template );
									
									//POSTAUTHOR
									$postauthor = get_the_author();
									$template = str_replace( '%%AUTHOR%%', $postauthor, $template );
									
									//POSTAUTHORLINK
									$postauthorlink = get_author_posts_url( get_the_author_meta( 'ID' ) );
									$template = str_replace( '%%AUTHORLINK%%', $postauthorlink, $template );
									
									//POSTTHUMB
									$postthumb = '';
									if($thumb){
									$postthumb .= '<div class="image">'.$thumb.'</div>';
									}
									$template = str_replace( '%%THUMB%%', $postthumb, $template );
									
									//POSTTHUMB2
									$postthumb2 = '';
									if($thumb2){
									$postthumb2 .= '<div class="image">'.$thumb2.'</div>';
									}
									$template = str_replace( '%%THUMB2%%', $postthumb2, $template );
									
									//POSTTEXT
									$posttext = '';
									if($longdesc>0){
										$excerpt = klasik_string_limit_char(get_the_excerpt(), $longdesc);
									}else{
										$excerpt = get_the_excerpt();
									}
									$posttext .= $excerpt;
									$template = str_replace( '%%TEXT%%', $posttext, $template );
									
									$output .= $template;
									
								endwhile;
						
							endif;
							$wp_query = null; $wp_query = $temp; wp_reset_query();
						$output .='</div>';
						$output.='<div class="clear"></div>';
					$output .='</div>';
						 
					echo $output;
					
					echo '<div class="clear"></div></div>';
				
					echo '                        
					</div>
					</div>
					</div>
					<div class="clear"></div></div>';
					
					
									
					echo $after_widget; 

    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {		
			
        $instance = $old_instance;
		
    	$instance['title'] 					= sanitize_text_field($new_instance['title']);

		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = wp_kses_post( stripslashes( $new_instance['text'] ) );
			
		$instance['wpautop'] 				= esc_attr($new_instance['wpautop']);

		$instance['category'] 				= esc_attr($new_instance['category']);
		$instance['cols'] 					= esc_attr($new_instance['cols']);
		$instance['showpost'] 				= esc_attr($new_instance['showpost']);
		$instance['longdesc'] 				= esc_attr($new_instance['longdesc']);
		$instance['customclass'] 			= esc_attr($new_instance['customclass']);
				
    	return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
		$instance['title'] 			= (isset($instance['title']))? $instance['title'] : "";

		$instance['category'] 		= (isset($instance['category']))? $instance['category'] : "";
		$instance['cols'] 			= (isset($instance['cols']))? $instance['cols'] : "";
		$instance['showpost'] 		= (isset($instance['showpost']))? $instance['showpost'] : "";
		$instance['longdesc'] 		= (isset($instance['longdesc']))? $instance['longdesc'] : "";
		$instance['customclass'] 	= (isset($instance['customclass']))? $instance['customclass'] : "";
		
			
		$text 			= isset($instance['text']) ? esc_textarea($instance['text']) : "";
		$wpautop 		= isset($instance['wpautop']) ? esc_attr($instance['wpautop']) : "";	
					
        $title 			= esc_attr($instance['title']);

		$category 		= esc_attr($instance['category']);
		$cols 			= esc_attr($instance['cols']);
		$longdesc 		= esc_attr($instance['longdesc']);
		$customclass 	= esc_attr($instance['customclass']);
		$showpost 		= esc_attr($instance['showpost']);
		

        ?>
        

            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'klasik'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:', 'klasik'); ?><textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" rows="3"><?php echo esc_attr($text ); ?></textarea>			</label></p>
            <p>
                <input id="<?php echo $this->get_field_id('wpautop'); ?>" name="<?php echo $this->get_field_name('wpautop'); ?>" type="checkbox"<?php if($wpautop == "on") echo " checked='checked'"; ?>>&nbsp;
                <label for="<?php echo $this->get_field_id('wpautop'); ?>"><?php _e('Automatically add paragraphs', 'klasik'); ?></label>
            </p>
            <p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category:', 'klasik'); ?><br />
			<?php 
			$args = array(
			'selected'         => $category,
			'echo'             => 1,
			'name'             =>$this->get_field_name('category')
			);
			wp_dropdown_categories( $args );
			?>
			</label></p>
            
            <p><label for="<?php echo $this->get_field_id('cols'); ?>"><?php _e('Columns:', 'klasik'); ?></label><br />
            <select id="<?php echo $this->get_field_id('cols'); ?>" name="<?php echo $this->get_field_name('cols'); ?>" class="widefat" style="width:50%;">
				<?php foreach($this->get_number_options() as $k => $v ) { ?>
                    <option <?php selected( $instance['cols'], $k); ?> value="<?php echo esc_attr($k); ?>"><?php echo esc_attr($v); ?></option>
                <?php } ?>      
            </select></p>
            
            <p><label for="<?php echo $this->get_field_id('showpost'); ?>"><?php _e('Number of Post:', 'klasik'); ?> <input class="widefat" id="<?php echo $this->get_field_id('showpost'); ?>" name="<?php echo $this->get_field_name('showpost'); ?>" type="text" value="<?php echo esc_attr($showpost); ?>" /></label></p>
            
            <p><label for="<?php echo $this->get_field_id('longdesc'); ?>"><?php _e('Length of Description Text:', 'klasik'); ?> <input class="widefat" id="<?php echo $this->get_field_id('longdesc'); ?>" name="<?php echo $this->get_field_name('longdesc'); ?>" type="text" value="<?php echo esc_attr($longdesc); ?>" /></label></p>
            
            <p><label for="<?php echo $this->get_field_id('customclass'); ?>"><?php _e('Custom Class:', 'klasik'); ?> 
            <input class="widefat" id="<?php echo $this->get_field_id('customclass'); ?>" name="<?php echo $this->get_field_name('customclass'); ?>" 
            type="text" value="<?php echo esc_attr($customclass); ?>" /></label></p>



        <?php
    }


	protected function get_number_options () {
	return array(
				'1' 			=> __( 'One Column', 'klasik' ),		
				'2' 			=> __( 'Two Column Headline Left', 'klasik' ),
				'3' 			=> __( 'Two Column Headline Top', 'klasik' ),
				);
	} // End get_number_options()


} // class  Widget