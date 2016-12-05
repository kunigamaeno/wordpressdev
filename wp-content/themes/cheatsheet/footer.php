    </div>
    <footer id="footer">
        <p><?php do_action( 'arzine_credits' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> <?php printf( __( 'is proudly powered by ', 'arzine' ) ); ?> <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'arzine' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'arzine' ); ?>" rel="generator"><?php printf( __( '%s', 'arzine' ), 'WordPress' ); ?></a>.</p>
        <a href="#top">top</a>
    </footer>
</div>
<?php wp_footer(); ?>

</body>
</html>