<?php
/**
 * Template for displaying the footer
 *
 * Contains the closing of the class=container div and all content
 * after.
 *
 * @package fullbase
 */
?>


<?php if (!is_page_template( 'page-templates/home-page.php' )){ ?>

	</div><!-- /.row -->

</div><!-- /.container -->

<?php } ?>

<footer class="col-md-12 no-margin">

	<div class="footer">

		<div class="container">

			<div class="row">
				<div class="col-md-6">
					<p><?php esc_html_e('&copy; Copyright ', 'fullbase'); ?> <?php echo date("o");?>   <?php bloginfo('name'); ?>  </p>
				</div>
				<div class="col-md-6">
					<p class="alignright"> <a href="#top"><i class="fa fa-angle-double-up"></i> Top</a></p>
				</div>
			</div>

		</div>

	</div>

</footer>

<?php wp_footer();?>

</body>
</html>
