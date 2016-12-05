<?php 
if ( ! isset( $content_width ) )
    $content_width = 550;

function arzine_setup() {
    load_theme_textdomain( 'arzine', get_template_directory() . '/langs' );
    add_editor_style();
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );
    register_nav_menu( 'container', __( 'container Menu', 'arzine' ) );
    add_theme_support( 'custom-background', array(
        'default-color' => '040606',
    ) );
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 550, 9999 );
}
add_action( 'after_setup_theme', 'arzine_setup' );
require( get_template_directory() . '/inc/custom-header.php' );

function arzine_scripts_styles() {
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );
    wp_enqueue_script( 'arzine-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );
    if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'arzine' ) ) {
        $subsets = 'latin,latin-ext';
        $subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'arzine' );
        if ( 'cyrillic' == $subset )
            $subsets .= ',cyrillic,cyrillic-ext';
        elseif ( 'greek' == $subset )
            $subsets .= ',greek,greek-ext';
        elseif ( 'vietnamese' == $subset )
            $subsets .= ',vietnamese';
        $protocol = is_ssl() ? 'https' : 'http';
        $query_args = array(
            'family' => 'Open+Sans:400italic,700italic,400,700',
            'subset' => $subsets,
        );
        wp_enqueue_style( 'arzine-fonts', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );
    }
    wp_enqueue_style( 'arzine-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'arzine_scripts_styles' );

function arzine_wp_title( $title, $sep ) {
    global $paged, $page;
    if ( is_feed() )
        return $title;
    $title .= get_bloginfo( 'name' );
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title = "$title $sep $site_description";
    if ( $paged >= 2 || $page >= 2 )
        $title = "$title $sep " . sprintf( __( 'Page %s', 'arzine' ), max( $paged, $page ) );
    return $title;
}
add_filter( 'wp_title', 'arzine_wp_title', 10, 2 );

function arzine_page_menu_args( $args ) {
    $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'arzine_page_menu_args' );

function arzine_widgets_init() {
    register_sidebar(
        array(
            'name' => __( 'container Sidebar', 'arzine' ),
            'id' => 'sidebar-1',
            'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'arzine' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
    register_sidebar(
        array(
            'name' => __( 'First Front Page Widget Area', 'arzine' ),
            'id' => 'sidebar-2',
            'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'arzine' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
    register_sidebar(
        array(
            'name' => __( 'Second Front Page Widget Area', 'arzine' ),
            'id' => 'sidebar-3',
            'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'arzine' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'arzine_widgets_init' );

if ( ! function_exists( 'arzine_content_nav' ) ) :
function arzine_content_nav( $nav_id ) {
    global $wp_query;
    if ( $wp_query->max_num_pages > 1 ) : ?>
        <nav id="<?php echo $nav_id; ?>" class="navigation" role="navigation">
            <h3 class="assistive-text"><?php _e( 'Post navigation', 'arzine' ); ?></h3>
            <ul>
                <li class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'arzine' ) ); ?></li>
                <li class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'arzine' ) ); ?></li>
            </ul>
        </nav>
    <?php endif;
}
endif;

if ( ! function_exists( 'arzine_comment' ) ) : 
function arzine_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) : 
        case 'pingback' : 
        case 'trackback' : ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <p><?php _e( 'Pingback:', 'arzine' ); comment_author_link(); edit_comment_link( __( '(Edit)', 'arzine' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php break;
        default :
            global $post; ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
            <header class="comment-meta comment-author vcard">
                <?php echo get_avatar( $comment, 44 );
                    printf( '<cite class="fn">%1$s %2$s</cite>',
                        get_comment_author_link(),
                        ( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'arzine' ) . '</span>' : ''
                    );
                    printf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
                        esc_url( get_comment_link( $comment->comment_ID ) ),
                        get_comment_time( 'c' ),
                        sprintf( __( '%1$s at %2$s', 'arzine' ), get_comment_date(), get_comment_time() )
                    ); ?>
            </header>
            <?php if ( '0' == $comment->comment_approved ) : ?>
                <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'arzine' ); ?></p>
            <?php endif; ?>
            <section class="comment-content comment">
                <?php comment_text();
                edit_comment_link( __( 'Edit', 'arzine' ), '<p class="edit-link">', '</p>' ); ?>
            </section>
            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'arzine' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div>
        </article>
    <?php break;
    endswitch;
}
endif;

if ( ! function_exists( 'arzine_entry_meta' ) ) : 
function arzine_entry_meta() {
    $categories_list = get_the_category_list( __( ', ', 'arzine' ) );
    $tag_list = get_the_tag_list( '', __( ', ', 'arzine' ) );
    $date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>',
        esc_url( get_permalink() ),
        esc_attr( get_the_time() ),
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() )
    );
    $author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        esc_attr( sprintf( __( 'View all posts by %s', 'arzine' ), get_the_author() ) ),
        get_the_author()
    );
    if ( $tag_list ) {
        $utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'arzine' );
    } elseif ( $categories_list ) {
        $utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'arzine' );
    } else {
        $utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'arzine' );
    }
    printf(
        $utility_text,
        $categories_list,
        $tag_list,
        $date,
        $author
    );
}
endif;

function arzine_body_class( $classes ) {
    $background_color = get_background_color();
    if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
        $classes[] = 'full-width';
    if ( is_page_template( 'page-templates/front-page.php' ) ) {
        $classes[] = 'template-front-page';
        if ( has_post_thumbnail() )
            $classes[] = 'has-post-thumbnail';
        if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
            $classes[] = 'two-sidebars';
    }
    if ( empty( $background_color ) )
        $classes[] = 'custom-background-empty';
    elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
        $classes[] = 'custom-background-white';
    if ( wp_style_is( 'arzine-fonts', 'queue' ) )
        $classes[] = 'custom-font-enabled';
    if ( ! is_multi_author() )
        $classes[] = 'single-author';
    return $classes;
}
add_filter( 'body_class', 'arzine_body_class' );

function arzine_content_width() {
    if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
        global $content_width;
        $content_width = 960;
    }
}
add_action( 'template_redirect', 'arzine_content_width' );

function arzine_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'arzine_customize_register' );

function arzine_customize_preview_js() {
    wp_enqueue_script( 'arzine-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20120827', true );
}
add_action( 'customize_preview_init', 'arzine_customize_preview_js' );


function insertheader2()
{
    
}

function insertheader2_org()
{
?>
<?php $username = get_userdata( $post->post_author ); ?>
            <h3><?php echo $username->user_nicename; ?></h3>
            <p><?php echo $username->user_description; ?></p>
            <p class="author-name"><a href="<?php echo get_author_posts_url( $post->post_author ); ?>"><?php echo $username->user_nicename; ?></a></p>
        
<?php
}

function insertheader()
{
    
}

function insertheader_org()
{
?>        
    <nav id="site-navigation" class="container-navigation" role="navigation">
            <h3 class="menu-toggle"><?php _e( 'Menu', 'arzine' ); ?></h3>
            <p class="skip-link assistive-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'arzine' ); ?>"><?php _e( 'Skip to content', 'arzine' ); ?></a></p>
            <?php wp_nav_menu( 
                array( 
                    'theme_location' => 'container', 
                    'menu_class' => 'nav-menu'
                )
            ); ?>
        </nav>
<?php    
}