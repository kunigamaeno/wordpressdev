<footer class="entry-footer">
<?php if ( comments_open() ) { 
echo '<span class="meta-sep">|</span> <span class="comments-link"><a href="' . get_comments_link() . '">' . sprintf( __( 'Comments', 'generic' ) ) . '</a></span>';
} ?>
<?php if ( !is_search() ) get_template_part( 'entry', 'meta' ); ?>
</footer> 