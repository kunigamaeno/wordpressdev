<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package synapse
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'synapse' ); ?></a>
	<div id="jumbosearch">
		<span class="fa fa-remove closeicon"></span>
		<div class="form">
			<?php get_search_form(); ?>
		</div>
	</div>	
	
	<div id="top-bar">
		<div class="container-fluid">
			
			<div id="top-menu">
				<?php $twalker = new Synapse_Menu_With_Hover; 
					if (has_nav_menu('top')) 
					 wp_nav_menu( array( 'theme_location' => 'top', 'walker' => $twalker ) ); ?>
			</div>
			
			<div id="woocommerce-zone">
			<?php if (class_exists('woocommerce')) : ?>
				<div id="top-cart">
					<div class="top-cart-icon">
	
		 
						<span class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'synapse'); ?>">
							<div class="count"><?php echo sprintf(_n('%d item', '%d items', WC()->cart->cart_contents_count, 'synapse'), WC()->cart->cart_contents_count);?></div>
							<div class="total"> <?php echo WC()->cart->get_cart_total(); ?> </div>
							
							<a class="links" href="<?php echo WC()->cart->get_cart_url(); ?>"><?php _e('Go to Cart','synapse'); ?></a>
							<a class="links" href="<?php echo WC()->cart->get_checkout_url(); ?>"><?php _e('Checkout','synapse'); ?></a>
						</span>
						
						
						
						<i class="fa fa-shopping-bag"></i>
						</div>
				</div>
				
				<div id="userlinks">
					<?php if ( is_user_logged_in() ) { ?>
					 	<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','synapse'); ?>"><?php _e('My Account','synapse'); ?></a>
					 <?php } 
					 else { ?>
					 	<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','synapse'); ?>"><?php _e('Login / Register','synapse'); ?></a>
					<?php } ?>
				</div>
					
			<?php endif; ?>
				

			</div>
			
		
		
			
			
		</div>	
			
	</div>
	
	<header id="masthead" class="site-header" role="banner">
		<div class="container masthead-container">
			<div class="site-branding">
				<?php if ( synapse_has_logo() ) : ?>					
					<div id="site-logo">
						<?php synapse_logo() ?>
					</div>
				<?php endif; ?>
				<div id="text-title-desc">
				<h1 class="site-title title-font"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</div>
			</div>	
			
		</div>	
		
		<div id="bar" class="container-fluid">
		
			<div id="slickmenu"></div>
			<nav id="site-navigation" class="main-navigation" role="navigation">
					<?php $walker = new Synapse_menu_with_Icon;
						if (!has_nav_menu('primary'))
							$walker = ''; 
					wp_nav_menu( array( 'theme_location' => 'primary', 'walker' => $walker ) ); ?>
			</nav><!-- #site-navigation -->
			
			<div id="searchicon">
				<i class="fa fa-search"></i>
			</div>
			
			<div class="social-icons">
				<?php get_template_part('social', 'fa'); ?>	 
			</div>
			
		</div><!--#bar-->	
		
	</header><!-- #masthead -->
	
	
	<div class="mega-container container-fluid">
	
	<?php get_template_part('slider', 'feat_posts'); ?>

	<?php if( class_exists('rt_slider') ) {
		 rt_slider::render('slider', 'swiper' ); 
	} ?>
	
		<div id="content" class="site-content">