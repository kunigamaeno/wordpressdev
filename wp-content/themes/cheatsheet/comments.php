<?php 
if ( post_password_required() )
    return; ?>
<div id="comments" class="comments-area">
    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title"><?php printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'arzine' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?></h2>
        <ol class="commentlist">
            <?php wp_list_comments( array( 'callback' => 'arzine_comment', 'style' => 'ol' ) ); ?>
        </ol>
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <nav id="comment-nav-below" class="navigation" role="navigation">
            <h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'arzine' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'arzine' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'arzine' ) ); ?></div>
        </nav>
        <?php endif;
        elseif ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
        <p class="nocomments"><?php _e( 'Comments are closed.', 'arzine' ); ?></p>
    <?php endif;
    comment_form(); ?>
</div>