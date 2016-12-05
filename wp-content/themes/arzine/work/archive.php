<?php get_header(); ?>
    <section id="container" class="blog-content">
        <div id="content">
        <?php if ( have_posts() ) : ?>
            <header class="archive-header">
                <h1 class="archive-title"><?php
                    if ( is_day() ) :
                        printf( __( 'Daily Archives: %s', 'arzine' ), '<span>' . get_the_date() . '</span>' );
                    elseif ( is_month() ) :
                        printf( __( 'Monthly Archives: %s', 'arzine' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'arzine' ) ) . '</span>' );
                    elseif ( is_year() ) :
                        printf( __( 'Yearly Archives: %s', 'arzine' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'arzine' ) ) . '</span>' );
                    else :
                        _e( 'Archives', 'arzine' );
                    endif;
                ?></h1>
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