    </div>
    <footer id="footer">
        <p><?php do_action( 'arzine_credits' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> <?php printf( __( 'is proudly powered by ', 'arzine' ) ); ?> <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'arzine' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'arzine' ); ?>" rel="generator"><?php printf( __( '%s', 'arzine' ), 'WordPress' ); ?></a>.</p>
    </footer>
</div>
<?php wp_footer(); ?>
<script type='text/javascript' src='https://slg-kunigamaeno.c9users.io/wp-includes/js/jquery/jquery.js?ver=1.12.4'></script>
<script src="https://slg-kunigamaeno.c9users.io/wp-content/themes/sparkling/slg/bootstrap.min.js" type=" text/javascript"></script>
<!-- <link href="https://slg-kunigamaeno.c9users.io/wp-content/themes/sparkling/slg/bootstrap-github.min.css" rel="stylesheet"> -->
<script src="https://slg-kunigamaeno.c9users.io/wp-content/themes/sparkling/slg/jquery.pjax.js" type="text/javascript"></script>
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" rel="stylesheet"> -->
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js
'></script>
<script src="https://cdn.jsdelivr.net/clipboard.js/1.5.13/clipboard.min.js"></script>

<script>
//<![CDATA[
//nprogress use
//https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css
//https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js
//#nprogress .bar{background-color: #040606; }
//#nprogress .peg{background-color: #040606; }
//

NProgress.configure({ parent: '#container' }); //default body
NProgress.configure({ showSpinner: false,minimum: 0.01,});  

    // Show the progress bar 
    NProgress.start();NProgress.set(0.3);

    // Increase randomly
    //var interval = setInterval( function(){ NProgress.inc();} , 300);

    // Trigger finish when page fully loaded
    jQuery(window).load(function () {
    //    clearInterval(interval);
        NProgress.done();
    });

    // Trigger bar when exiting the page
    jQuery(window).unload(function () {
    NProgress.start();NProgress.set(0.3);
    });
    
    
    
    
//]]>
</script>
<script>
(function($){
       var ai ='.blog-content';
$(document).on('click', "a:not([target])", function(e) {
    //nprogress
    NProgress.start();NProgress.set(0.3);
    e.preventDefault();
        //console.log($(ai).length);
    var nextUrl = $(this).attr('href');
    //まずは切り替える部分を透明に
    //$(ai).animate({opacity:0}, "normal", function(){
        $.pjax({//エフェクトが終わったらPjaxイベント
            url: nextUrl,
            container: ai,
            fragment: ai,
            timeout: 2000
        });
    //});
});
 
//Pjaxイベントが終わったときの動作
$(document).on('pjax:end', function() {
    //$(ai).animate({opacity:1}, "normal");
    NProgress.inc();
    NProgress.done();
});	

$(document).on('pjax:end', function() {
   // gapi.plusone.go(); //Google+1ボタンの読み込み
  //twttr.widgets.load(); //Twitterボタンの読み込み
  //  FB.XFBML.parse(); //Facebookのいいねボタン読み込み
  //  Hatena.Bookmark.BookmarkButton.setup(); //はてなブックマークボタン読み込み
});

var tri="span.copied"; //needed class copied. data-clipboard-target.
$(tri).tooltip({
  trigger: 'click',
  placement: 'bottom'
});

$(document).on('pjax:end', function() {
  $(tri).tooltip({
  trigger: 'click',
  placement: 'bottom'
});
  
});

//use bootstrap tooltip. attr in data-original-title. set and remove. 
function setTooltip(btn, message) {
  $(btn).tooltip('hide')
    .attr('data-original-title', message)
    .tooltip('show');
}

function hideTooltip(btn) {
  setTimeout(function() {
    $(btn).tooltip('hide').removeAttr('data-original-title');
  }, 1000);
}

var clipboard = new Clipboard(tri);

var n=0;
clipboard.on('success', function(e) {
  e.clearSelection();//copy str no-hi-light
  setTooltip(e.trigger, 'Copied!');
  hideTooltip(e.trigger);
  //console.log(n++);
});

clipboard.on('error', function(e) {
  setTooltip(e.trigger, 'Failed!');
  hideTooltip(e.trigger);
});

 $(tri).click(function(){ console.log($(this).prev().html());});


var snippets=document.querySelectorAll('pre');[].forEach.call(snippets,function(snippet){snippet.firstChild.insertAdjacentHTML('beforebegin',('<button class="btn" data-clipboard-snippet><img class="clippy" width="13" src="assets/images/clippy.svg" alt="Copy to clipboard"></button>').outerHTML);});var clipboardSnippets=new Clipboard('[data-clipboard-snippet]',{target:function(trigger){return trigger.nextElementSibling;}});clipboardSnippets.on('success',function(e){e.clearSelection();showTooltip(e.trigger,'Copied!');});clipboardSnippets.on('error',function(e){showTooltip(e.trigger,fallbackMessage(e.action));});

})(jQuery);
</script>

</body>
</html>