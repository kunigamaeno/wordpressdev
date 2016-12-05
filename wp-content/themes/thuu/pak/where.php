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
["/pak/lib/","bootstrap.min.css"],
["/pak/lib/","split.min.js"],
["/pak/lib/","clipboard.min.js"],
["/pak/lib/","skeleton.min.css"],
["/pak/lib/","highlight.min.js"],
["/pak/lib/","highlight.github.min.css"],
["/pak/lib/","normalize.min.css"],
["/pak/lib/","nanobar.min.js"],
         
        /* 
         ["/pak/","ideanote.txt"],
         
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

