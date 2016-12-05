<?php
/**
 * Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div class="container">.
 *
 * @since fullbase
 */
?><!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>" />

	<!-- Meta for IE support -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

	<?php wp_head(); ?>
<!---->

<script type="text/javascript" src="https://slg-kunigamaeno.c9users.io/wp-content/themes/twentyfifteen/pace.js"></script>	
<style>
/*--------------------------------------------------------------
18.0 Pace
--------------------------------------------------------------*/
.container{
	opacity: 0;
}
.pace-done .container{
	opacity: 1;
}
.pace-done .pace{
	display: none;
}

.pace{
    top: 1rem;/*5%;*/
    left: 1rem;/*5%;*/
    position:fixed;
}

.pace{width:140px;height:300px;z-index:2000;-webkit-transform:scale(0);-moz-transform:scale(0);-ms-transform:scale(0);-o-transform:scale(0);transform:scale(0);opacity:0;-webkit-transition:all 2s linear 0s;-moz-transition:all 2s linear 0s;transition:all 2s linear 0s}.pace.pace-active{-webkit-transform:scale(.25);-moz-transform:scale(.25);-ms-transform:scale(.25);-o-transform:scale(.25);transform:scale(.25);opacity:1}.pace .pace-activity{width:140px;height:140px;border-radius:70px;background:#d01c20;position:absolute;top:0;z-index:1911;-webkit-animation:pace-bounce 1s infinite;-moz-animation:pace-bounce 1s infinite;-o-animation:pace-bounce 1s infinite;-ms-animation:pace-bounce 1s infinite;animation:pace-bounce 1s infinite}.pace .pace-progress{position:absolute;display:block;left:50%;bottom:0;z-index:1910;margin-left:-30px;width:60px;height:75px;background:rgba(20,20,20,.1);box-shadow:0 0 20px 35px rgba(20,20,20,.1);border-radius:30px/40px;-webkit-transform:scaleY(.3)!important;-moz-transform:scaleY(.3)!important;-ms-transform:scaleY(.3)!important;-o-transform:scaleY(.3)!important;transform:scaleY(.3)!important;-webkit-animation:pace-compress .5s infinite alternate;-moz-animation:pace-compress .5s infinite alternate;-o-animation:pace-compress .5s infinite alternate;-ms-animation:pace-compress .5s infinite alternate;animation:pace-compress .5s infinite alternate}@-webkit-keyframes pace-bounce{0%,100%,95%{top:0;-webkit-animation-timing-function:ease-in}50%{top:140px;height:140px;-webkit-animation-timing-function:ease-out}55%{top:160px;height:120px;border-radius:70px/60px;-webkit-animation-timing-function:ease-in}65%{top:120px;height:140px;border-radius:70px;-webkit-animation-timing-function:ease-out}}@-moz-keyframes pace-bounce{0%,100%,95%{top:0;-moz-animation-timing-function:ease-in}50%{top:140px;height:140px;-moz-animation-timing-function:ease-out}55%{top:160px;height:120px;border-radius:70px/60px;-moz-animation-timing-function:ease-in}65%{top:120px;height:140px;border-radius:70px;-moz-animation-timing-function:ease-out}}@keyframes pace-bounce{0%,100%,95%{top:0;animation-timing-function:ease-in}50%{top:140px;height:140px;animation-timing-function:ease-out}55%{top:160px;height:120px;border-radius:70px/60px;animation-timing-function:ease-in}65%{top:120px;height:140px;border-radius:70px;animation-timing-function:ease-out}}@-webkit-keyframes pace-compress{0%{bottom:0;margin-left:-30px;width:60px;height:75px;background:rgba(20,20,20,.1);box-shadow:0 0 20px 35px rgba(20,20,20,.1);border-radius:30px/40px;-webkit-animation-timing-function:ease-in}100%{bottom:30px;margin-left:-10px;width:20px;height:5px;background:rgba(20,20,20,.3);box-shadow:0 0 20px 35px rgba(20,20,20,.3);border-radius:20px;-webkit-animation-timing-function:ease-out}}@-moz-keyframes pace-compress{0%{bottom:0;margin-left:-30px;width:60px;height:75px;background:rgba(20,20,20,.1);box-shadow:0 0 20px 35px rgba(20,20,20,.1);border-radius:30px/40px;-moz-animation-timing-function:ease-in}100%{bottom:30px;margin-left:-10px;width:20px;height:5px;background:rgba(20,20,20,.3);box-shadow:0 0 20px 35px rgba(20,20,20,.3);border-radius:20px;-moz-animation-timing-function:ease-out}}@keyframes pace-compress{0%{bottom:0;margin-left:-30px;width:60px;height:75px;background:rgba(20,20,20,.1);box-shadow:0 0 20px 35px rgba(20,20,20,.1);border-radius:30px/40px;animation-timing-function:ease-in}100%{bottom:30px;margin-left:-10px;width:20px;height:5px;background:rgba(20,20,20,.3);box-shadow:0 0 20px 35px rgba(20,20,20,.3);border-radius:20px;animation-timing-function:ease-out}
}</style>


<!---->
</head>
<body <?php body_class(); ?>>

    <header class="navbar navbar-fixed-top">
    	<div class="container">

  			<div class="navbar-header">
  				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainmenu" aria-expanded="false" aria-controls="navbar">
  					<span class="icon-bar"></span>
  					<span class="icon-bar"></span>
  					<span class="icon-bar"></span>
  				</button>
  				<a class="navbar-brand" href="<?php echo home_url(); ?>"><i class="fa fa-angle-double-right"></i> <?php bloginfo('title'); ?> </a>
  			</div>

  			<div id="mainmenu" class="collapse navbar-collapse">
  			 	<?php /* Main Navigation */
  					wp_nav_menu( array(
  					  'theme_location' => 'header',
  					  'depth' => 2,
  					  'container' => false,
  					  'menu_class' => 'nav navbar-nav navbar-right',
  					  'fallback_cb'       => 'fullbase_wp_bootstrap_navwalker::fallback',
  					  //Process nav menu using our custom nav walker
  					  'walker' => new fullbase_wp_bootstrap_navwalker())
  					);
  				?>
  			</div><!--/.nav-collapse -->

    	</div>
    </header>

    <?php if (is_page_template( 'page-templates/home-page.php' )) { ?>

  		<!-- seo title home -->
  		<h1 class="home-title"><?php bloginfo('name'); ?> -  <?php bloginfo('description'); ?></h1>

  		<?php if (is_home()){ ?> <div class="spacer"> </div> <?php } ?>

  	<?php } else { ?>

  	   <div class="spacer"> </div>

  	<?php } ?>

	<!-- Prompt IE 6 and 7 users to install Chrome Frame: chromium.org/developers/how-tos/chrome-frame-getting-started -->
	<!--[if lt IE 9]>
		<p style="margin:0px;padding: 8px 35px 8px 14px;color: #b94a61;background-color: #f2dede;border: 1px solid #eed3d7;">Your browser is <em>ancient!</em> <strong><a style="color: #b94a61;" href="http://browsehappy.com/" target="_blank">Upgrade to a different browser</a></strong> or <strong><a style="color: #b94a61;" href="http://www.google.com/chromeframe/?redirect=true" target="_blank">install Google Chrome Frame</a></strong> to experience this site.</p>
	<![endif]-->


	<?php if (!is_page_template( 'page-templates/home-page.php' )){ ?>

	<div class="container">

		<div class="row">

	<?php } ?>
