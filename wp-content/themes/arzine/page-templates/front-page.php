<?php 
/* 
    Template Name: Front Page Template 
*/
get_header(); ?>
    <div class="blog-content">
        <div id="content">
            <?php while ( have_posts() ) : the_post(); 
                if ( has_post_thumbnail() ) : ?>
                    <div class="entry-page-image"><?php the_post_thumbnail(); ?></div>
                <?php endif;
                get_template_part( 'content', 'page' );
            endwhile; ?>
        </div>
    </div>
<?php get_sidebar( 'front' );
get_footer(); ?>