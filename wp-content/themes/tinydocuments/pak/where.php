<?php

/*
 where.org.php please duplicate and re-write > where.php
 
  get_where("filename"); //normal e.g) /pak/searchname
  get_where("filename",0); //dir only  e.g) /pak/
 
*/

 function get_wherelist()
 {
     //[dir,name]
     return [
["/pak/","where.org.php"],
["/pak/","where.php"],
["/pak/","where.org.php"],
["/pak/","cht-foot.js"],
["/pak/","page-slg.sparkling.php"],
["/pak/","cht-head.js"],
["/pak/","filelist.sh"],
["/pak/","cht.css"],
["/pak/","where.php"],
["/pak/","ideanote.txt"],
["/pak/lib/highlight/","tomorrow-night-eighties.css"],
["/pak/lib/highlight/","highlight.pack.js"],
["/pak/lib/pjax/","jquery.pjax.js"],
["/pak/lib/nprogress/","nprogress.min.js"],
["/pak/lib/nprogress/","nprogress.min.css"],
["/pak/lib/fontscss/","font-awesome.min.css"],
["/pak/lib/bootstrap/","bootstrap-github.min.css"],
["/pak/lib/bootstrap/","bootstrap.min.js"],
["/pak/lib/colorpicker/css/","bootstrap-colorpicker.min.css"],
["/pak/lib/colorpicker/js/","bootstrap-colorpicker.min.js"],
["/pak/lib/clipborad/","clipboard.min.js"],
//["/pak/lib/animatescroll/","animatescroll.min.js"],
//["/pak/lib/resize/","jquery.funcResizeBox.js"],
//["/pak/lib/jqueryui/","jquery.layout.min.js"],
//["/pak/lib/jqueryui/","jquery.ui.all.js"],
//["/pak/lib/jqueryui/","jquery.layout-default.css"],
["/pak/lib/jquery/","jquery.2.1.3.noconflict.min.js"],
//["/pak/lib/split-pane/","split-pane.css"],
["/pak/lib/split-pane/","split-pane.js"],
//["/pak/lib/split-pane/","pretty-split-pane.css"],
["/pak/lib/split-pane/","split-pane-migrade.css"],
["/pak/","cht-scroll.css"],
["/pak/lib/boostrap_gridonly/","bootstrap.min.css"],
["/pak/lib/normalize/","normalize.min.css"],
["/pak/lib/normalize/","skeleton.min.css"],
["/pak/lib/splitjs/","split.min.js"],


        /* 
         ["/cht/","where3.org.php"],
         ["/cht/","where4.org.php"],
         
         ["/lib/","where5.org.php"],
         ["/lib/","where6.org.php"],
         ["/lib/","where7.org.php"],
         */

         ];
 }

// test_where(); //test code
 function test_where(){
 	 $a= get_where("where.org.php");
     var_dump($a);
 	 $a= get_where("where.org.php",0);
     var_dump($a);
     
     $b =get_wherelist();
     var_dump($b);
 }

 function get_where($searchfilename,$opt =1) //1 is /dir/name, other is dir
 {
     $o=0; //return dir
     if($opt ==1) { $o=1;} //return dir and name
     
     $sl = get_wherelist();
     foreach ($sl as $v) {
        if($v[1] == $searchfilename){
           if($o==0){ return $v[0];}
           else{ return $v[0].$v[1];}
        }
     }
     //not search is "";
     return "";
 }

