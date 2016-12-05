<?php

function cht_init()
{
 //this function equal functions.php  
 //remove_filter('the_content', 'wpautop');
 //remove_filter('the_excerpt', 'wpautop');

 //widget on shortcode
 add_filter( 'widget_text', 'do_shortcode' );
 
 require_once( get_template_directory() . '/pak/where.php' );
 add_action('wp_head','cht_addhead');
 add_action('wp_footer','cht_addfooter');
 add_action( 'wp_enqueue_scripts', 'cht_addscripts' );
 
 //wp-embed.min.js remove
 add_action('init', 'disable_embeds_init', 9999);
 
 //disable emojis
 add_action( 'init', 'disable_wp_emojicons' );

//管理画面編集 
 if (is_admin()){ add_action('admin_menu', 'add_post_meta_box' ); }
 
 // header('Access-Control-Allow-Origin: *'); 
 qui();
   add_shortcode('list_cate','shortcode_list_cate');
}

function shortcode_list_cate($atts, $content = null)
{
    //[list_cate cate="wordpress" num="-1"]
    // {'cate' =>''}
    //$category = get_the_category(); 
    //echo $category[0]->cat_ID;
    //$v ="未分類";
    $a =array();
    $mya = shortcode_atts( array(
        'cate' => '未分類',
        'num' => -1,
    ), $atts );
    $catid=get_cat_ID($mya['cate']);
    if($cateid != 0)
    {
        $a = array(
                'cat'=> $catid,
                'orderby' => 'title',
                'posts_per_page' => $mya['num']
            );
    }else{
        $a = array(
                's' => $mya['cateid'],
                'orderby' => 'title',
                'posts_per_page' => $mya['num']
            );
      
    }
    $r = new WP_Query($a);
        $liclass = 'class="catelist col-md-4 col-sm-6 col-lg-3"';
        
		if ($r->have_posts()) :
		?>
		<?php if ( $title ) {
		} ?>
		<ul>
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<li <?php echo $liclass; ?> >
				<a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
			<?php if ( $show_date ) : ?>
				<span class="post-date"><?php echo get_the_date(); ?></span>
			<?php endif; ?>
			</li>
		<?php endwhile; ?>
		</ul>
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

}


function qui()
{
    //テキストがエディタにクイックタグボタン追加
//http://webtukuru.com/web/wordpress-quicktag/
//https://wpdocs.osdn.jp/%E3%82%AF%E3%82%A4%E3%83%83%E3%82%AF%E3%82%BF%E3%82%B0API
if ( !function_exists( 'add_quicktags_to_text_editor' ) ):
function add_quicktags_to_text_editor() {
  //スクリプトキューにquicktagsが保存されているかチェック
  if (wp_script_is('quicktags')){?>
    <script>
/*      QTags.addButton('qt-bold','太字','<span class="bold">','</span>');
      QTags.addButton('qt-red','赤字','<span class="red">','</span>');
      QTags.addButton('qt-red','赤字','testettt');
*/      
    </script>
  <?php
  }
}
endif;
add_action( 'admin_print_footer_scripts', 'add_quicktags_to_text_editor' );

}

function add_post_meta_box()
{
    /* usage add_meta_box, look wiki
     * http://wpdocs.osdn.jp > add_meta_box   
     * outpu menu slug ok. 
     * 'post','page','dashboard','link','attachment','custom_post_type','comment'
    */
    
    add_meta_box(
        'memo_meta_post_page', // equal <div id=[this]... 
        'koko wa memo', //title
        function(){
          /* meta filed plz html*/
          echo <<< EOF
<span id="absolute-clear-span">
<span><textarea id="mytextarea" style="position:relative;width:100%;">
yaaa.yooo 
</textarea>
</span>
</span>
EOF;
        }, 
        'post',  /* target output wpmenu */
        'side', 
        'high'   /* or 'core' or deault is 'low' */
        );
  
}

function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  //if use TinyMCE. filter to remove TinyMCE emojis
  //add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
  
  //svg no read
  add_filter( 'emoji_svg_url', '__return_false' );

}

function disable_embeds_init() {

    // Remove the REST API endpoint.
    remove_action('rest_api_init', 'wp_oembed_register_route');

    // Turn off oEmbed auto discovery.
    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');
}

function cht_addhead()
{
    $te = get_template_directory_uri();
    $ret ="";
    //scroll bar 最も速く読む
    //wp_enqueue_style('cht-scrollfast', $te.get_where('cht-scroll.css'), array('style.css'), '1.0', 'all' );
    
    $ret .=cht_csswrap( $te.get_where('normalize.min.css'));
    $ret .=cht_csswrap( $te.get_where('cht-scroll.css') );
    //$ret .=cht_csswrap( $te.get_where('skeleton.min.css') );
    
    $ret .=cht_csswrap( $te.get_where('nprogress.min.css'));
    
    //$ret .=cht_csswrap( $te.get_where('jquery.layout-default.css'));
    $ret .=cht_csswrap( $te.get_where('bootstrap.min.css'));
    $ret .=cht_csswrap( $te.get_where('split-pane-migrade.css'));
    
    $ret .=cht_csswrap( $te.get_where('cht.css'));
    $ret .=cht_jswrap( $te.get_where('cht-head.js'));
    echo $ret;
}

function cht_addscripts()
{
    $te =get_template_directory_uri();
    $ret ="";
    
    //trueで/body前
    //jquery.js?ver=1.12.4
    $ver1 ="1.0"; //20161122
    $fastlib ='jquery';
    //$fastlib ='';
    
    wp_deregister_script('jquery'); //wordpress jQuery out
    $myjquery = $te.get_where('jquery.2.1.3.noconflict.min.js');
    wp_enqueue_script('jquery',$myjquery, array(), '2.1.3');
    //wp_enqueue_script( 'cht-js01', $te.get_where('split.min.js'),array( $fastlib ),$ver1,true);
    wp_enqueue_script( 'cht-js110', $te.get_where('split-pane.js'),array( $fastlib ),$ver1,true);
    //wp_enqueue_script( 'cht-js1', $te.get_where('jquery.pjax.js'),array('jquery'),$ver1,true);
    //wp_enqueue_script( 'cht-js2', $te.get_where('nprogress.min.js'),array( $fastlib ),$ver1,true);
    //wp_enqueue_script( 'cht-js21', $te.get_where('animatescroll.min.js'),array( 'jquery' ),$ver1,true);
    //wp_enqueue_script( 'cht-js3', $te.get_where('bootstrap.min.js'),array( 'jquery' ),$ver1,true);
    //wp_enqueue_script( 'cht-js4', $te.get_where('clipboard.min.js'),array( $fastlib ),$ver1,true);
    //wp_enqueue_script( 'cht-js100', $te.get_where('cht-foot.js'),array( $fastlib ),$ver1,true);
    //wp_enqueue_script( 'cht-js110', $te.get_where('jquery.funcResizeBox.js'),array( 'jquery' ),$ver1,true);
    //wp_enqueue_script( 'cht-js120', $te.get_where('jquery.ui.all.js'),array( 'jquery' ),$ver1,true);
    //wp_enqueue_script( 'cht-js130', $te.get_where('jquery.layout.min.js'),array( 'jquery' ),$ver1,true);

}

function cht_addfooter()
{
    $te =get_template_directory_uri();
    $ret ="";
    //$ret.=cht_jswrap( $te.get_where('split.min.js'));
    $ret.=cht_jswrap( $te.get_where('nprogress.min.js'));
    $ret.=cht_jswrap( $te.get_where('clipboard.min.js'));
    $ret.=cht_jswrap( $te.get_where('cht-foot.js'));
    
    echo $ret;
}


function cht_csswrap($url)
{             
    $rep = '<link href="##url##" rel="stylesheet">';
    return str_replace("##url##",$url,$rep);
}

function cht_jswrap($url)
{
    $rep = '<script src="##url##" type="text/javascript"></script>';
    return str_replace("##url##",$url,$rep);
}