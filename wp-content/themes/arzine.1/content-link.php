    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header><?php _e( 'Link', 'arzine' ); ?></header>
        <div class="entry-content">
            <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'arzine' ) ); ?>
        </div>
        <footer class="entry-meta">
            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'arzine' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php echo get_the_date(); ?></a>
            <?php edit_post_link( __( 'Edit', 'arzine' ), '<span class="edit-link">', '</span>' ); ?>
        </footer>
    </article>