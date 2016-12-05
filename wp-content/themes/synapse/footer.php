<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package synapse
 */
?>

	</div><!-- #content -->

	<?php get_sidebar('footer'); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info container">
			<?php printf( __( 'Powered by %1$s.', 'synapse' ), '<a href="'.esc_url("https://rohitink.com/2015/05/21/synapse-woocommerce-theme/").'" rel="nofollow">Synapse Theme</a>' ); ?>
			<span class="sep"></span>
			<?php echo ( get_theme_mod('synapse_footer_text') == '' ) ? ('&copy; '.date('Y').' '.get_bloginfo('name').__('. All Rights Reserved. ','synapse')) : esc_html( get_theme_mod('synapse_footer_text') ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	
</div><!-- #page -->


<?php wp_footer(); ?>

</body>
</html>
