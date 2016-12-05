<?php 
/* 
    Template Name: Full-width Page Template, No Sidebar 
*/
get_header(); ?>
    <div class="blog-content">
        <div id="content">
            <?php while ( have_posts() ) : the_post();
                get_template_part( 'content', 'page' );
                comments_template( '', true );
            endwhile; ?>
        </div>
    </div>
<?php get_footer(); ?>