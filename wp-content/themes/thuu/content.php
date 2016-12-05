    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <?php the_post_thumbnail();
            if ( is_single() ) : ?>
                <h2 class="entry-title"><?php the_title(); ?></h2>
            <?php else : ?>
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'arzine' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
            <?php endif;
            if ( comments_open() ) : ?>
                <div class="comments-link">
                    <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'arzine' ) . '</span>', __( '1 Reply', 'arzine' ), __( '% Replies', 'arzine' ) ); ?>
                </div>
            <?php endif; ?>
        </header>
        <?php if ( is_search() ) : ?>
            <div class="entry-summary">
                <?php the_excerpt(); ?>
            </div>
        <?php else : ?>
            <div class="entry-content">
                <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'arzine' ) );
                wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'arzine' ), 'after' => '</div>' ) ); ?>
            </div>
        <?php endif; ?>
        <footer class="entry-meta">
            <?php /*arzine_entry_meta();*/
            edit_post_link( __( 'Edit', 'arzine' ), '<span class="edit-link">', '</span>' );
            if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
                <div class="author-info">
                    <div class="author-avatar">
                        <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'arzine_author_bio_avatar_size', 68 ) ); ?>
                    </div>
                    <div class="author-description">
                        <h3><?php printf( __( 'About %s', 'arzine' ), get_the_author() ); ?></h3>
                        <p><?php the_author_meta( 'description' ); ?></p>
                        <p class="author-link"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'arzine' ), get_the_author() ); ?></a></p>
                    </div>
                </div>
            <?php endif; ?>
        </footer>
    </article>