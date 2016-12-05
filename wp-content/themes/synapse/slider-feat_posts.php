<?php if (get_theme_mod('synapse_feat_post_slider_enable') && is_front_page() ) : ?>
<div id="slider-feat_posts" class="container-fluid">
	<div class="swiper-posts-slider">
	        <div class="swiper-wrapper">
	        	 <?php
			        $args = array( 
			        	'post_type' => 'post',
			        	'posts_per_page' => esc_html( get_theme_mod('synapse_feat_post_slider_pc',10) ), 
			        	'cat' => esc_html( get_theme_mod('synapse_feat_post_slider_cat',0) ),
					    
			        );
			       
			        $loop = new WP_Query( $args );
			        while ( $loop->have_posts() ) : 
			        
			        	$loop->the_post(); 
			        	global $product; 
			        	
			        	if ( has_post_thumbnail() ) :
			        		$image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID), 'synapse-thumb' ); 
							$image_url = $image_data[0]; 
							//DIsplay Only if the Post has a Featured Image
			        	
			        ?>
					
						<div class="swiper-slide">
							<a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">
							<?php the_post_thumbnail('synapse-thumb'); ?>
							<div class="product-details">
								<h3><?php the_title(); ?></h3>
							</div>
							</a>
						</div>
												
					 <?php endif;	
					endwhile; ?>
					<?php 
						wp_reset_postdata(); 
					?>	
	            
	        </div>
	        <!-- Add Pagination -->
	         <div class="swiper-pagination swiper-pagination-x swiper-pagination-white"></div>
 
			<div class="swiper-button-next nb swiper-button-white"></div>
			<div class="swiper-button-prev pb swiper-button-white"></div>
	        
	    </div>
</div>
<?php endif; ?>