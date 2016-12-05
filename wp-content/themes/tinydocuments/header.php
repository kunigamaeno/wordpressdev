<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
	<meta name="viewport" content="width=device-width" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_get_archives('type=monthly&format=link'); ?>
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- ## -->
<div class="pretty-split-pane-frame">
<div class="split-pane fixed-top">
<!-- # -->
		<div class="split-pane-component" id="top-component">
			<div class="pretty-split-pane-component-inner">
				
				
				
<!-- ### -->
<section class="saftysection">
<div id="t1" class="container-fluid">
  	<div class="row">
		<div class="main">
			<div class="hdr1">

			<div class="head">
				<?php if ( function_exists( 'jetpack_the_site_logo' ) ) jetpack_the_site_logo(); ?>
				<h5 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h5>
				<h6 class="site-description"><?php bloginfo( 'description' ); ?></h6>
			</div>
			<div class="sidebar-head3 span2">
				<!-- -->
				<?php dynamic_sidebar( 'sidebar-head' ); ?>
				
			</div>
			<div class="sidebar-head4 span2">
				<!-- -->
			</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="main3">
		</div>
		<div class="main4">
				<?php dynamic_sidebar( 'sidebar-head2' ); ?>
			<!--	<ul><li><?php /* wp_nav_menu( array( 'theme_location' => 'header-menu' ) );*/ ?> </li></ul>
				<a id="live-menu" class="responsive-menu" href="#">Menu</a> -->
		</div>
	</div>
	</div>
</div>
</section>
<!-- ### -->



			</div>
		<!-- </div>-->
		<!---->
		<div class="split-pane-divider" id="my-divider"></div>
		<!---->
		<div class="split-pane-component" id="bottom-component">
			<div class="pretty-split-pane-component-inner">
