<?php
/**
 * @package synapse
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="entry-header single-entry-header col-md-12">
			<?php the_title( '<h1 class="entry-title title-font">', '</h1>' ); ?>
			
			
			<div class="entry-meta">
				<?php wp_reset_postdata();
					synapse_posted_on_icon('both'); ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

	<div id="featured-image">
			<?php the_post_thumbnail('full'); ?>
		</div>
			
			
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'synapse' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php synapse_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
