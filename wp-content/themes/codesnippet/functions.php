<?php
add_action( 'after_setup_theme', 'generic_setup' );
function generic_setup()
{
load_theme_textdomain( 'generic', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array( 'search-form' ) );
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;
register_nav_menus(
array( 'main-menu' => __( 'Main Menu', 'generic' ) )
);
}
add_action( 'wp_enqueue_scripts', 'generic_load_scripts' );
function generic_load_scripts()
{
wp_enqueue_style( 'generic-style', get_stylesheet_uri() );
/*wp_enqueue_script( 'jquery' );
wp_register_script( 'generic-videos', get_template_directory_uri() . '/js/videos.js' );
wp_enqueue_script( 'generic-videos' );*/
}
/* add_action( 'wp_head', 'generic_print_custom_scripts', 99 ); */
function generic_print_custom_scripts()
{
if ( !is_admin() ) {
?>
<script type="text/javascript">
jQuery(document).ready(function($){
$("#wrapper").vids();
});
</script>
<?php
}
}


add_filter( 'document_title_separator', 'generic_document_title_separator' );
function generic_document_title_separator( $sep ) {
$sep = "|";
return $sep;
}
add_filter( 'the_title', 'generic_title' );
function generic_title( $title ) {
if ( $title == '' ) {
return '&rarr;';
} else {
return $title;
}
}
add_action( 'widgets_init', 'generic_widgets_init' );
function generic_widgets_init()
{
register_sidebar( array (
'name' => __( 'Sidebar Widget Area', 'generic' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
add_action( 'comment_form_before', 'generic_enqueue_comment_reply_script' );
function generic_enqueue_comment_reply_script()
{
if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
function generic_custom_pings( $comment )
{
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php 
}
add_filter( 'get_comments_number', 'generic_comment_count', 0 );
function generic_comment_count( $count ) {
if ( ! is_admin() ) {
global $id;
$get_comments = get_comments( 'status=approve&post_id=' . $id );
$comments_by_type = separate_comments( $get_comments );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}

add_action( 'widgets_init', 'codesnippets_widgets' );
function codesnippets_widgets() {
/* <?php dynamic_sidebar( 'sidebar-head-t' ); ?> */
register_sidebar( array(
	'id' => 'sidebar-head-t','name' => __( 'sidebar-head-t', 'generic' ),
	)   );
register_sidebar( array(
	'id' => 'sidebar-head-b', 'name' => __( 'sidebar-head-b', 'generic' ),
	)   );

register_sidebar( array(
	'id' => 'sidebar-body-t','name' => __( 'sidebar-body-t', 'generic' ),
	)		);
register_sidebar(		array(
	'id' => 'sidebar-body-b', 'name' => __( 'sidebar-body-b', 'generic' ),
	)		);

register_sidebar(		array(
	'id' => 'sidebar-footer-t',	'name' => __( 'sidebar-footer-t', 'generic' ),
	)		);
register_sidebar(		array(
	'id' => 'sidebar-footer-b',	'name' => __( 'sidebar-footer-b', 'generic' ),
	)		);
}


function wp_cs_fasthead()
{
$s = <<< EOF
<!-- s wp_cs_fasthead() -->
    <!--<link href="https://slg-kunigamaeno.c9users.io/wp-content/themes/codesnippet/pak/lib/normalize.min.css" rel="stylesheet">-->
    <link href="https://slg-kunigamaeno.c9users.io/wp-content/themes/codesnippet/pak/cht-scroll.css" rel="stylesheet">
    <link href="https://slg-kunigamaeno.c9users.io/wp-content/themes/codesnippet/pak/lib/bootstrap.min.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="https://slg-kunigamaeno.c9users.io/wp-content/themes/codesnippet/pak/lib/highlight.github.min.css">-->
<!-- e wp_cs_fasthead() -->
EOF;
return $s;

}

function wp_cs_latefooter()
{
$s =<<< EOF
<!-- s wp_cs_latefooter() -->

<script src="https://slg-kunigamaeno.c9users.io/wp-content/themes/codesnippet/pak/lib/split.min.js" type="text/javascript"></script>

<script src="https://slg-kunigamaeno.c9users.io/wp-content/themes/codesnippet/pak/lib/nanobar.min.js" type="text/javascript"></script>
<script src="https://slg-kunigamaeno.c9users.io/wp-content/themes/codesnippet/pak/lib/clipboard.min.js" type="text/javascript"></script>

<script src="https://slg-kunigamaeno.c9users.io/wp-content/themes/codesnippet/pak/codesnippet.js" type="text/javascript"></script>

<!-- <script src="https://slg-kunigamaeno.c9users.io/wp-content/themes/codesnippet/pak/lib/highlight.min.js"></script> -->

<!-- wp_cs_latefooter() -->
EOF;
return $s;

/*
*/

}

 //
 require_once( get_template_directory() . '/pak/cht-functions.php' );
 cht_init();
 //
