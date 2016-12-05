<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

<?php
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function theme_slug_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'theme_slug_render_title' );
}
?>


	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>

<?php 
	$disableResponsive = esc_attr(klasik_get_option( 'klasik_disable_responsive' ,''));
	if($disableResponsive!='1'){
?>
<!-- Mobile Specific Metas
  ================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<?php
	}
?>


<?php wp_head(); ?>
</head>


<body <?php body_class('klasikt'); ?>>

