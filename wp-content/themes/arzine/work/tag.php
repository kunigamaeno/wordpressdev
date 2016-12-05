<?php get_header(); ?>
    <section id="container" class="blog-content">
        <div id="content">
        <?php if ( have_posts() ) : ?>
            <header class="archive-header">
                <h1 class="archive-title"><?php printf( __( 'Tag Archives: %s', 'arzine' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>
            <?php if ( tag_description() ) : ?>
                <div class="archive-meta"><?php echo tag_description(); ?></div>
            <?php endif; ?>
            </header>
            <?php while ( have_posts() ) : the_post();
                get_template_part( 'content', get_post_format() );
            endwhile;
            arzine_content_nav( 'nav-below' );
            else : 
                get_template_part( 'content', 'none' );
        endif; ?>
        </div>
    </section>
<?php get_sidebar();
get_footer(); ?>