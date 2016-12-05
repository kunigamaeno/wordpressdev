<?php get_header(); ?>


    <div class="container">
      <section class="main">
          <div class="splitpanel">
            
            <div id="eight" class="split split-vertical">
                    <section id="cs1" class="clearsection">
                        <!---->
                      <div class="container">
                         <?php dynamic_sidebar( 'sidebar-body-t' ); ?>
                      </div>
                      <div class="container-fuluid">
                        <main id="content">
                        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'entry' ); ?>
                        <?php comments_template(); ?>
                        <?php endwhile; endif; ?>
                        <?php get_template_part( 'nav', 'below' ); ?>
                        </main>
                      </div>
                        <!---->    
                   </section>
            </div>
            
            <div id="nine" class="split split-vertical">
                  <section id="cs2" class="clearsection">
              <div class="container">
                 <?php dynamic_sidebar( 'sidebar-body-b' ); ?>
              </div>
              </section>
            </div>
            
            
          </div>
          <div class="mainbottom">
              <div class="container">
                 <?php dynamic_sidebar( 'sidebar-footer-t' ); ?>
              </div>
          </div>
     </section>
  </div>
  
  <section class="footer">
  <div id="bottomfix">
        <div class="container">
         <?php dynamic_sidebar( 'sidebar-footer-b' ); ?><span id="sigspan"></span>
        </div>
  </div>
  </section>


<?php get_footer(); ?>