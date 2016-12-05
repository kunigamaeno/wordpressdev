<?php get_header(); ?>

<div id="wrapper" class="hfeed">
<header id="header">
<div id="branding">
<div id="site-title"><?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '<h1>'; } ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a><?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '</h1>'; } ?></div>
<div id="site-description"><?php bloginfo( 'description' ); ?></div>
</div>
<nav id="menu">
<div id="search">
<?php get_search_form(); ?>
</div>
<label class="toggle" for="toggle">&#9776; Menu</label>
<input id="toggle" class="toggle" type="checkbox" />
<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
</nav>
</header>
<div id="container">

<main id="content">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<?php comments_template(); ?>
<?php endwhile; endif; ?>
<?php get_template_part( 'nav', 'below' ); ?>
</main>
<?php get_sidebar(); ?>
</div>
<footer id="footer">
<div id="copyright">
<?php echo sprintf( __( '%1$s %2$s %3$s', 'generic' ), '&copy;', date( 'Y' ), esc_html( get_bloginfo( 'name' ) ) ); ?>
</div>
</footer>
</div>
<?php get_footer(); ?>