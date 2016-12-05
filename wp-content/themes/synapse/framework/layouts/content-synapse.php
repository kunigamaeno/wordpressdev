<?php
/**
 * @package Synapse
 */
 //Load Default Image sizes
 			if ( has_post_thumbnail() ): 
						  $image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "large" ); ?>
					<?php $image_width = $image_data[1]; ?>
					<?php $image_height = $image_data[2]; ?>
				<?php else :
						  $image_height	= 170;
						  $image_width = 270;
				endif; ?>


<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-4 col-sm-6 grid synapse item'); ?> data-w="<?php echo $image_width ?>" data-h="<?php echo $image_height; ?>">

		<div class="featured-thumb col-md-12">
			<?php if (has_post_thumbnail()) : ?>	
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><?php the_post_thumbnail('large'); ?></a>
			<?php else: ?>
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><img src="<?php echo get_template_directory_uri()."/assets/images/placeholder2.jpg"; ?>"></a>
			<?php endif; ?>
			
			<div class="postedon"><?php synapse_posted_on_small('date'); ?></div>
			
			<div class="out-thumb">
				<h1 class="entry-title title-font"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			</div>
		</div><!--.featured-thumb-->
			
					
</article><!-- #post-## -->