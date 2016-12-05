    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="entry-header">
            <header>
                <h1><?php the_author(); ?></h1>
                <h2><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'arzine' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php echo get_the_date(); ?></a></h2>
            </header>
            <?php echo get_avatar( get_the_author_meta( 'ID' ), apply_filters( 'arzine_status_avatar', '48' ) ); ?>
        </div>

        <div class="entry-content">
            <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'arzine' ) ); ?>
        </div>

        <footer class="entry-meta">
            <?php edit_post_link( __( 'Edit', 'arzine' ), '<span class="edit-link">', '</span>' ); ?>
        </footer>
    </article>
