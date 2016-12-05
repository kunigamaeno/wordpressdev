<?php get_header(); ?>
    <div class="blog-content">
        <div id="content">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'content', get_post_format() ); ?>
                <nav class="nav-single">
                    <h3 class="assistive-text"><?php _e( 'Post navigation', 'arzine' ); ?></h3>
                    <ul>
                        <li class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'arzine' ) . '</span> %title' ); ?></li>
                        <li class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'arzine' ) . '</span>' ); ?></li>
                    </ul>
                </nav>
                <?php if ( comments_open() || '0' != get_comments_number() )
                    comments_template( '', true );
                endwhile; ?>
        </div>
    </div>
<?php get_sidebar();
get_footer(); ?>