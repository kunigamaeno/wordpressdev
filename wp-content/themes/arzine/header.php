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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" type="text/css" media="all">
<link rel="stylesheet" href="https://slg-kunigamaeno.c9users.io/wp-content/themes/arzine/mycss.min.css" type="text/css" media="all">

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
    <header id="header" class="site-header" role="banner">
        <h1 class="blog-title"><a href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' )); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
        <?php insertheader(); ?>
        <?php $header_image = get_header_image();
        if ( ! empty( $header_image ) ) : ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt=""></a>
        <?php endif; ?>
    </header>
    <div id="container" class="wrapper">
        <aside class="author-bio">
            <?php insertheader2(); ?>
        </aside>