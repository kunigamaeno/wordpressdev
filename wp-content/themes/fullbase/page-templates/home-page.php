<?php
/**
 * Template for displaying Slider with Post
 *
 * @package fullbase
 */
/*

Template Name: Home Page

*/
?>
<?php get_header(); ?>

	<!-- Carousel -->
	<section id="hero-slider" class="carousel slide" data-ride="carousel">

		<div class="carousel-inner">

			<?php

			$counter = 0;

			$specialPosts = new WP_Query(array(
		    	'post_type' => 'post',
		    	'posts_per_page' => 3,
		    	'orderby' => 'menu_order',
		    	'order' => 'ASC',
		    ));
			?>

			<?php if ($specialPosts->have_posts()) : while($specialPosts->have_posts()) : $specialPosts->the_post(); ?>

				<div class="item <?php $counter++; if ($counter == 1){ ?> active <?php } ?>">

					<?php

						/* Image */
						$image_url =  wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'fullbase_big' );

					?>
					<div class="bg-fill"></div>
					<div class="fill"  style="background: url(<?php echo  $image_url[0]; ?>) center center; -webkit-background-size: cover; -moz-background-size: cover; background-size: cover; -o-background-size: cover; "></div>


					<div class="container-caption">
						<div class="carousel-caption">
							<h2 class="huge"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<?php the_excerpt(); ?>
						</div>
					</div>

				</div>

			<?php endwhile;  else : ?>

				<p><?php esc_html_e('Sorry, no posts matched your criteria.', 'fullbase'); ?></p>

			<?php endif; ?>

		</div>

		<!-- Controls -->
		<a class="left carousel-control" href="#hero-slider" data-slide="prev">
			 <span class="glyphicon glyphicon-chevron-left"></span>
		</a>
		<a class="right carousel-control" href="#hero-slider" data-slide="next">
			 <span class="glyphicon glyphicon-chevron-right"></span>
		</a>

	</section><!-- /.carousel -->

<?php get_footer(); ?>
