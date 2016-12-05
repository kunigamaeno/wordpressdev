<!DOCTYPE html>
<!--[if IE 7 | IE 8]>
<html class="ie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <!--[if lt IE 9]> <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script> <![endif]-->
    <!--[if lt IE 9]> <script src="<?php echo get_template_directory_uri(); ?>/js/css3-mediaqueries.js" type="text/javascript"></script> <![endif]-->
<?php wp_head(); ?>
<link href="https://slg-kunigamaeno.c9users.io/wp-content/themes/sparkling/slg/bootstrap-github.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" rel="stylesheet">
<style>
#nprogress .bar{background-color: #040606; }
#nprogress .peg{background-color: #040606; }
</style>
<style>
section.rel {
    position: relative;
}
span.btn-fit-r {
    position: absolute;
    top: 0;
    right: 0;
    z-index: 10;
    display: block;
    /*padding: 5px 8px;*/
    font-size: 12px;
    color: #767676;
    cursor: pointer;
    background-color: #fff;
    border: 1px solid #e1e1e8;
    border-radius: 0 4px 0 4px;
}    
</style>
<style>
a:hover {
    color: #c1443c;
}
a {
    color: #666666;
}
</style>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
    <header id="header" class="site-header" role="banner">
        <h1 class="blog-title"><a href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' )); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
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
        <?php $header_image = get_header_image();
        if ( ! empty( $header_image ) ) : ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt=""></a>
        <?php endif; ?>
    </header>
    <div id="container" class="wrapper">
        <aside class="author-bio"><?php $username = get_userdata( $post->post_author ); ?>
            <h3><?php echo $username->user_nicename; ?></h3>
            <p><?php echo $username->user_description; ?></p>
            <p class="author-name"><a href="<?php echo get_author_posts_url( $post->post_author ); ?>"><?php echo $username->user_nicename; ?></a></p>
        </aside>