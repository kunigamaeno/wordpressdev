/*<script>
//<![CDATA[
*/


document.addEventListener('DOMContentLoaded', function() {
  //console.log('ready 0 document.addEventListener("DOMContentLoaded", function() {...');
  // = ready


  var donepanel =(function(query){
    var $pane;
    if( query instanceof jQuery){
        $pane = query; //gule ok
         //console.log($pane instanceof jQuery);      
    }else{
        $pane = jQuery(document.querySelector(query));//$('div.split-pane');
    }
				$pane.splitPane();
        $pane.addClass('.horizontal-percent');
        var per =30;
        $pane.splitPane('firstComponentSize',parseInt( $pane.height()*100/per ));
  });
  var sel='div.split-pane';
  donepanel(sel); 



    /*nprogress は使い回すため start時はconfigureを呼ぶ*/
    NProgress.configure({ parent: '#my-divider' }); //
    NProgress.configure({ showSpinner: false,minimum: 0.01,});
});

window.addEventListener('load', function() {
  
    /* pure js*/
    NProgress.start();NProgress.set(0.1);

    var intspd =500;
    var interval = setInterval( function(){ NProgress.inc();} , intspd);
    
    clearInterval(interval);
    NProgress.done();
        
      //clipboardcopy
      var inH= '<span class="btn btn-fit-r copied" data-clipboard-target>c</span>';
      var snippets=document.querySelectorAll('pre[data-clipboard-copied]');[].forEach.call(snippets,function(snippet){snippet.firstChild.insertAdjacentHTML('beforebegin',inH);});
      var clipboardSnippets=new Clipboard('[data-clipboard-target]',{target:function(trigger){return trigger.nextElementSibling;}});
      clipboardSnippets.on('success',function(e){
          e.clearSelection();     
        //console.log(e);
          var p=e.trigger; //jQuery(this);//e;//$(this);
          var se = 'oncedummynprogressclass';
          p.classList.add(se)
          //p.addClass(se);
          NProgress.configure({parent:"." + se});
          NProgress.start();NProgress.done();
          window.setTimeout(function(){
             //p.removeClass(se);
             p.classList.remove(se);
           },500);
      });
        
});/* pure js*/

    // Trigger bar when exiting the page
window.addEventListener("unload", function () {
        NProgress.configure({ parent: '#my-divider' }); //
        NProgress.start();NProgress.set(0.1);
        interval = setInterval( function(){ NProgress.inc();} , intspd);    
});
    

/*    
//]]>
</script>
<script>
*/

/*
(function($){
       var ai ='.blog-content';
    //$(document).on('click', "a:not([href^=#])", function(e) {
    //link _blank $('a:not([href^="#"])[target]');
    //link 'a:not([href^="#"])a:not([target])'
    
    
    $(document).on('click', 'a:not([href^="#"])', function(e) {
        if( !$(this).attr('target')) //many case _blank
        {    e.preventDefault();
            NProgress.configure({ parent: '#container' }); 
            NProgress.start(); NProgress.set(0.1);
            interval = setInterval( function(){ NProgress.inc();} , intspd);   

          　//console.log("in");
            var nextUrl = $(this).attr('href');
                $.pjax({//エフェクトが終わったらPjaxイベント
                    url: nextUrl,
                    container: ai,
                    fragment: ai,
                    timeout: 2000
                });
        }
  });
*/
 
 /*
//Pjaxイベントが終わったときの動作
$(document).on('pjax:end', function() {
    //$(ai).animate({opacity:1}, "normal");
    NProgress.inc();
    clearInterval(interval);
    NProgress.done();

      //clipboardcopy
      var inH= '<span class="btn btn-fit-r copied" data-clipboard-target>c</span>';
      var snippets=document.querySelectorAll('pre[data-clipboard-copied]');[].forEach.call(snippets,function(snippet){snippet.firstChild.insertAdjacentHTML('beforebegin',inH);});
      var clipboardSnippets=new Clipboard('[data-clipboard-target]',{target:function(trigger){return trigger.nextElementSibling;}});
      clipboardSnippets.on('success',function(e){e.clearSelection();     
        //console.log(e);
      var p=e.trigger; //jQuery(this);//e;//$(this);
      var se = 'oncedummynprogressclass';
      p.classList.add(se)
      //p.addClass(se);
      NProgress.configure({parent:"." + se});
      NProgress.start();NProgress.done();
       window.setTimeout(function(){
         //p.removeClass(se);
         p.classList.remove(se);
       },500);
      });
});	

*/

/*
$(document).on('pjax:end', function() {
  // gapi.plusone.go(); //Google+1ボタンの読み込み
  //twttr.widgets.load(); //Twitterボタンの読み込み
  //  FB.XFBML.parse(); //Facebookのいいねボタン読み込み
  //  Hatena.Bookmark.BookmarkButton.setup(); //はてなブックマークボタン読み込み
});
*/

/*
$(document).on('pjax:end', function() {
  // gapi.plusone.go(); //Google+1ボタンの読み込み
  //twttr.widgets.load(); //Twitterボタンの読み込み
  //  FB.XFBML.parse(); //Facebookのいいねボタン読み込み
  //  Hatena.Bookmark.BookmarkButton.setup(); //はてなブックマークボタン読み込み
});
*/

/*
$(document).on('pjax:end', function() {
  
});
*/

/*
jQuery(jQuery('a[href^="#"]').attr("href"))
jQuery( jQuery('a[href^="#"]').attr("href") ).selector
$('a[href^="#"]')
*/

/* })(jQuery); */
/*</script>*/
