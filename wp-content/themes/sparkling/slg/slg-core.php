<?php
/**
 * kuniga.maeno slg core 
 *
 * @package sparkling add
 */

 function main_slg_core()
 {
  echo timecolor();
  echo disp_date();
  //echo highlight_js();
  add_shortcode('main_slg_sandbox', 'main_slg_sandbox');
  add_shortcode('main_slg_catchdata', 'main_slg_catchdata');
  add_shortcode('main_slg_sandbox2', 'main_slg_sandbox2');
  //haaku_autopost_url();
  add_shortcode('test_messa_init','test_messa_init');

 }

 function highlight_js()
 {
  // https://highlightjs.org/download/
    $js = <<< EOF
 <link rel="stylesheet" href="https://slg-kunigamaeno.c9users.io/wp-content/themes/sparkling/slg/tomorrow-night-eighties.css">
 <script src="https://slg-kunigamaeno.c9users.io/wp-content/themes/sparkling/slg/highlight.pack.js"></script>
 <script type="text/javascript">
//<![CDATA[
(function($){

  hljs.initHighlightingOnLoad();

   var htag ='.entry-content pre';
$(document).ready(function() {
  $(htag).each(function(i, block) {
    hljs.highlightBlock(block);
  });
});

})(jQuery);
//]]>
</script>
EOF;

  //return $js;
  echo $js; //add_action("wp_head","highlight_js");
 }

 //use <?php echo timecolor() ..
 function timecolor()
 {
     $m = hexdec("ffffff");//16->10
     $rm = mt_rand ( 0, $m );//rgb #aabbcc
     $co = sprintf("%'.06x",$rm);// zero paint
     return "<style scoped> span.timecolor {background-color: "."#".$co."; }</style>";
 }
 
 function disp_date()
 {
    $t=date("Y-m-d H:i:s");
    return "<span class='timecolor'>[".$t."]:template is page-slg.php</span>";
 }
 
 function disp_textarea($text,$rows=10)
 {
  return sprintf('<div class="form-group"><textarea class="form-control" rows="%d" >%s</textarea></div>',$rows,$text);
 }
 
 function disp_preamp($text)
 {
  return '<pre>'.htmlspecialchars($text).'</pre>';
 }
 
 function implodeA($ary)
 {
   return implode(",",$ary);
 }
 function implodeAA($aryary)
 {
   $buf="";
   foreach($aryary as $l)
   {
     $buf.=implode(",",$l).PHP_EOL;
   }
   return $buf;
  
 }
 function logcr($s)
 {
  $GLOBALS['LOGBR'].= $s.PHP_EOL;
 }
 function loggg($s)
 {
  $GLOBALS['LOGBR'].= $s;
 }
 function logbr($s)
 {
  $GLOBALS['LOGBR'].= $s.'<br>';
 }

 function strlen_rsort($ary)
 {  $a = $ary;
    usort($a, create_function('$b,$a', 'return mb_strlen($a, "UTF-8") - mb_strlen($b, "UTF-8");'));
    return $a;
 }
 
 function strlen_usort($ary)
 {  $a = $ary;
    usort($a, create_function('$a,$b', 'return mb_strlen($a, "UTF-8") - mb_strlen($b, "UTF-8");'));
    return $a;
 }


function in_array_recursive ($val, $a = array()) {
    $r = function ($v,$a) use (&$r) {
        static $bool = false;
        if ($bool === true) return true;        
        foreach ($a as $ary) {
            is_array($ary) && $r($v, $ary);
            if ($v == $ary) {
                $bool = true;
            }
        }
        return $bool;
    };
    return $r($val, $a);
}

function raw_json_encode($input) {
    
    return preg_replace_callback(
        '/\\\\u([0-9a-zA-Z]{4})/',
        function ($matches) {
            return mb_convert_encoding(pack('H*',$matches[1]),'UTF-8','UTF-16');
        },
        json_encode($input)
    );
    
}

 function is_innerurl($baseurl,$chkurl)
 {
  //if relation check
   $rec = createUri($baseurl,$chkurl);
   
   //$parse["host"]
   $b = parse_url($baseurl);
   $c = parse_url($rec);
   
   if( $b["host"] === $c["host"]){ return true;}
   else                          { return false;}
 }

function base64imgsrcdata($imgurl,$re_w=-1,$re_h=-1)
{
 //https://www.softel.co.jp/blogs/tech/archives/2117
 //<img src="data:image/png;base64,[DATA]" />
 //$imgurl = 'https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_150x54dp.png';
 //$imgurl = 'https://facebookbrand.com/wp-content/themes/fb-branding/prj-fb-branding/assets/images/fb-art.png';
 
 $falsesrc ='';
 if(!@get_headers($imgurl)){ return $falsesrc;}

 $c = file_get_contents($imgurl);

 //gd専用の方がいい
 
 //var_dump(strlen($c));
 $ret = getimagesizefromstring($c);
 if($ret == FALSE){ return $falsesrc; }
 
 list($w, $h, $type, $attr) = $ret;
 
 //$cgd ; //$cgd is gd object
 //resize non
 if($re_w == -1 && $re_h == -1)
 {
  $cimg = imagecreatefromstring($c);
  $cgd = $cimg;
  //var_dump($cimg);
  //imagepng($cgd);
  imagedestroy($cimg);
 }else{  //resize go
   $n_w =$re_w;
   $n_h =$re_h;
   if($re_w ==-1){ $n_w= abs($n_h * $w /$h);}
   elseif($re_h==-1){ $n_h= abs($n_w * $h / $w);}
   $newimg = imagecreatetruecolor($n_w, $n_h);
   $cimg = imagecreatefromstring($c);
   imagecopyresampled($newimg, $cimg, 0, 0, 0, 0,
                        $n_w, $n_h, $w, $h);
   $cgd = $newimg;
   imagedestroy($cimg);
   imagedestroy($newimg);
 }
    //change stream
     //https://icondecotter.jp/blog/2013/01/23/php%E3%81%AEgd%E3%82%A4%E3%83%A1%E3%83%BC%E3%82%B8%E3%82%B9%E3%83%88%E3%83%AA%E3%83%BC%E3%83%A0%E3%82%92%E6%96%87%E5%AD%97%E5%88%97%E3%81%AB%E5%A4%89%E6%8F%9B%E3%81%99%E3%82%8B/
     ob_start();
     switch ( $ret['mime'] ) {
    			case 'image/jpeg':
                     header('Content-Type: '.$ret['mime']);
    				 imagejpeg( $cgd );break;
    			case 'image/png':
                     header('Content-Type: '.$ret['mime']);
    				 imagepng( $cgd );break;
    			case 'image/gif':
                     header('Content-Type: '.$ret['mime']);
    				 imagegif( $cgd );break;
    			default:
                     header('Content-Type: '.'image/jpeg');
    				 imagejpeg();
    		}
     $c = ob_get_contents();
     ob_end_clean(); 
     //imagedestroy($cgd);
 //}
 
 $c64 = base64_encode($c);
 //var_dump($ret['mime']);
 $src ='data:'.$ret['mime'].';base64,'.$c64;

 return $src; 
}


 function is_adsize($w,$h)
 {
     //https://support.google.com/adsense/answer/6002621?hl=ja
     $ad =[
         '300,250','336,280','728,90','300,600','320,100',
         '320,50','468,60','234,60','120,600','120,240',
         '160,600','300,1050','970,90','970,250','250,250',
         '200,200','180,150','125,125',
         //local ad size
         '240,400','980,120','250,360','930,180','580,400',
         '750,300','750,200','750,100',
         ];
     $n =intval($w).','.intval($h);
     return in_array($n,$ad);
 }

 function is_imagesize_less($max_w,$max_h,$tgtfile,$stream='')
 {
     $ret= FALSE;
     //stream 対応 画像stringからチェック可能
     if($stream !='') { $ret =getimagesizefromstring($stream); }
     else{ $ret = getimagesize($tgtfile); }
     
     //$ret = getimagesize($tgtfile);
     if($ret == FALSE){ return FALSE; }
     list($w, $h, $type, $attr) = $ret;
     //var_dump($ret);
     //var_dump($type);
     if( (intval($w) <= intval($max_w)) && 
            (intval($h) <= intval($max_h)) 
      ){ return TRUE; }
     
     return FALSE;
 }

 function is_imagesize_more($min_w,$min_h,$tgtfile,$stream='')
 {
     //stream 対応 画像stringからチェック可能
     //http://php.net/manual/ja/function.getimagesizefromstring.php
     //usage 
     //  $c = file_get_contents($iu);      //get tgtcontents
     //  $sizeok = is_imagesize_more(100,-9999,'',$c); 
     if($stream !='') { $ret =getimagesizefromstring($stream); }
     else{ $ret = getimagesize($tgtfile); }
     
     //$ret = getimagesize($tgtfile);
     if($ret == FALSE){ return FALSE; }
     list($w, $h, $type, $attr) = $ret;
     //var_dump($ret);
     //var_dump($type);
     if( (intval($w) >= intval($min_w)) && 
            (intval($h) >= intval($min_h)) 
      ){ return TRUE; }
     
     return FALSE;
 }

/**
 * createUri
 * 相対パスから絶対URLを返します
 *
 * @param string $base ベースURL（絶対URL）
 * @param string $relational_path 相対パス
 * @return string 相対パスの絶対URL
 * @link http://blog.anoncom.net/2010/01/08/295.html/comment-page-1
 */
function createUri( $base, $relationalPath )
{
     $parse = array(
          "scheme" => null,
          "user" => null,
          "pass" => null,
          "host" => null,
          "port" => null,
          "query" => null,
          "fragment" => null
     );
     $parse = parse_url( $base );

     //attention! binary data is no recover. binary not be url!
     //ex)img class="smart" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
     // src=".." is binary
     //bug xx
     if( substr($relationalPath,0,strlen('data:')) == 'data:'){ return $relationalPath; }
          
     //bug1 # recover <a href='#hogehoge'..>  $base='#hogehoge'
     if( substr($relationalPath,0,1) == "#"){ return $base .$relationalPath; }//end bug1
     
     //bug2 // is https:// or http:// 
     if( substr($relationalPath,0,strlen('//')) == '//'){ return $relationalPath; }//end bug2
     
     if( strpos($parse["path"], "/", (strlen($parse["path"])-1)) !== false ){
          $parse["path"] .= ".";
     }

     if( preg_match("#^https?://#", $relationalPath) ){
          return $relationalPath;
     }else if( preg_match("#^/.*$#", $relationalPath) ){
          return $parse["scheme"] . "://" . $parse["host"] . $relationalPath;
     }else{
          $basePath = explode("/", dirname($parse["path"]));
          $relPath = explode("/", $relationalPath);
          foreach( $relPath as $relDirName ){
               if( $relDirName == "." ){
                    array_shift( $basePath );
                    array_unshift( $basePath, "" );
               }else if( $relDirName == ".." ){
                    array_pop( $basePath );
                    if( count($basePath) == 0 ){
                         $basePath = array("");
                    }
               }else{
                    array_push($basePath, $relDirName);
               }
          }
          $path = implode("/", $basePath);
          return $parse["scheme"] . "://" . $parse["host"] . $path;
     }

}