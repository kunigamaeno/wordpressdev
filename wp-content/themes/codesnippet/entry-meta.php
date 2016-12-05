<div class="entry-meta">
<span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
<span class="meta-sep"> | </span>
<span class="cat-links"><?php /*_e( 'Categories: ', 'generic' );*/ ?><?php the_category( ', ' ); ?></span>
<span class="meta-sep"> | </span>
<span class="tag-links"><?php the_tags(); ?></span>
<span class="meta-sep"> | </span>
<span class="author vcard"><?php the_author_posts_link(); ?></span>
</div>