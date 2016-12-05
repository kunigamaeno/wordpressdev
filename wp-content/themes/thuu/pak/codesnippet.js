/*
 codesnippet boot javascript
*/

var nanobar;

/*<script>*/
(function(){
/**/
 'use strict';
document.addEventListener('DOMContentLoaded', function() {
  //console.log('ready 0 document.addEventListener("DOMContentLoaded", function() {...');
  // = ready
    //nanobar.go(100);
   //document.body.style.visibility='hidden';
    
    var sp= Split(['#eight', '#nine'], {
        direction: 'vertical',
    sizes: [25, 75],
    minSize: 200        
    });
    nanobar = new Nanobar({ target: document.querySelector('.gutter.gutter-vertical') });
   // sp.setSizes([70, 30]);//percetnt
    //minSize: 200
});

/**/
})(); 
/*</script>*/

/*<script>*/
(function(){
/**/
 'use strict';

function addEvent(e, evnt, funct){
  
    if (e.attachEvent)
        return e.attachEvent('on'+evnt, funct);
    else
        return e.addEventListener(evnt, funct, false);
}

//signature
addEvent(
    document.getElementById('sigspan'),
    'click',
    function () { nanobar.go(100); }
);
//all a
Array.prototype.forEach.call(document.querySelectorAll('a'), function(e) {
addEvent(
    e,
    'click',
    function () { nanobar.go(100); }
);
});


/**/
})(nanobar);
/* </script> */

/* <script> */
(function(){ 
/**/
/*  hljs.initHighlightingOnLoad(); */
/**/  
})();
/* </script>*/


(function(){
 'use strict';
 
    window.addEventListener('load', function() {
    /*setTimeout(function(){
     document.body.style.visibility='visible';
    },200)
    */
      //clipboardcopy
      var inH= '<span class="btn btn-fit-r copied" data-clipboard-target>c</span>';
      var snippets=document.querySelectorAll('pre');[].forEach.call(snippets,function(snippet){
          if( snippet.firstChild.childNodes.length !=0){
          snippet.firstChild.insertAdjacentHTML('beforebegin',inH);
          }
      });
      var clipboardSnippets=new Clipboard('[data-clipboard-target]',{target:function(trigger){return trigger.nextElementSibling;}});
      clipboardSnippets.on('success',function(e){
          e.clearSelection();
          nanobar.go(100);
          //console.log("in");
      });

});/* pure js*/

})(nanobar);
