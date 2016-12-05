<?php
/**
 * kuniga.maeno slg sandbox
 * this file include relations write only.
 * @package sparkling add
 */

 function main_slg_sandbox2()
 {
     //echo "sandboxgggggggggggggggggggg";
     //test_wp_upload_dir();
     test_content_decode();
     echo disp_textarea($GLOBALS['LOGBR']);
     //echo $GLOBALS['LOGBR'];
 }
 
 function test_content_decode()
 {
   //$tgturl ="http://blog.katty.in/1400";
   //$tgturl ="http://qiita.com/kobake@github/items/3c5d09f9584a8786339d";
   //$tgturl ="https://www.webprofessional.jp/enabling-ajax-file-uploads-in-your-wordpress-plugin/";
   //$tgturl ="http://webdesign.practice.jp/ogp-facebook-twittercards";
   //$tgturl ="https://www.circl.jp/23312";
   //$tgturl ='http://thr3a.hatenablog.com/entry/20131027/1382848291';
   //$tgturl ='http://dev.adokikaku.com/cat-php/119/php%E3%81%A7%E5%A4%96%E9%83%A8%E3%81%AEhtml%E3%82%92%E5%8F%96%E5%BE%97%E3%81%97%E3%81%A6%E3%80%81%E8%89%B2%E3%80%85%E3%81%AA%E5%80%A4%E3%82%92%E5%8F%96%E5%BE%97%E3%81%99%E3%82%8B/';
   //$tgturl ='http://www3.nhk.or.jp/news/web_tokushu/2016_1109.html?utm_int=detail_contents_tokushu_002';
   //$tgturl ="http://webdesign.practice.jp/google-adsense-seo";
   //$tgturl='http://www.sankei.com/world/news/161109/wor1611090109-n1.html';
   //$tgturl='http://www.sankei.com/politics/news/161111/plt1611110004-n1.html';
   //$tgturl='http://homepage.it-manual.com/css-intro/break.html';
   //$tgturl='http://yossense.com/br-do-not-use/';
   //$tgturl ='http://wired.jp/2016/11/11/how-to-talk-alien/';
   //$tgturl='http://9-bb.com/bootstrap%E3%82%92%E4%BD%BF%E3%81%A3%E3%81%A6web%E3%82%B5%E3%82%A4%E3%83%88%E3%82%92%E4%BD%9C%E3%81%A3%E3%81%A6%E3%81%BF%E3%82%88%E3%81%86%E3%81%9C-%E7%AC%AC6%E5%9B%9E-%E3%80%8E%E3%83%98%E3%83%83/';
   //$tgturl='http://qiita.com/tadsan/items/2a4c3e6b0b74a408c038';
   //$tgturl='http://www.css-lecture.com/log/css3/css3-text-shadow-box-shadow.html';
   //$tgturl='http://wired.jp/2016/11/11/1_tokyo-metropolitan-festival/';
   //$tgturl ='http://www.bbc.com/japanese/37946531';
   //$tgturl='http://www.huffingtonpost.jp/2016/06/14/donald-trump-blacklists-the-washington-post_n_10470446.html';
   //$tgturl='http://photoshopvip.net/80725';
   //$tgturl='http://www.seojapan.com/blog/target%E2%80%9D_blank%E2%80%9D-%E3%81%AE%E6%AD%A3%E3%81%97%E3%81%84%E4%BD%BF%E3%81%84%E6%96%B9%E8%AC%9B%E5%BA%A7';
   //$tgturl='https://www.youtube.com/?gl=JP&hl=ja';
   //$tgturl='http://jp.techcrunch.com/2016/11/10/tc-tokyo-product-update/';
   //$tgturl='http://cp.glico.jp/pretz1111/';
   //$tgturl ='http://japan.cnet.com/news/service/35084667/';
   //$tgturl='https://ja.wikipedia.org/wiki/%E3%83%95%E3%82%A1%E3%82%A4%E3%82%A2%E3%83%BC%E3%82%A8%E3%83%A0%E3%83%96%E3%83%AC%E3%83%A0';
   //$tgturl='http://requlog.com/self-branding/wordpress/media-setting/';
   //$tgturl='https://yumeirodesign.jp/blog/201312/csstransforms_fixed.html';
   //$tgturl='https://support.google.com/adsense/answer/6002621?hl=ja';
   $tgturl ='http://designup.jp/bootstrap3-collapse-194/';
  if(!@get_headers($tgturl)) return false; //dead

  $c = file_get_contents($tgturl);      //get tgtcontents
  //var_dump(strlen($c));
   parse_imagelist($c,$tgturl);
  
 }
 
 
 function test_wp_upload_dir()
{
 
     logcr("wp_upload_dir()");
     logcr(implodeA(wp_upload_dir()));
     logcr(json_encode(wp_upload_dir()));
     var_dump(wp_upload_dir());
 //
 //array(6) { 
 // 'path' => string(49) "/home/ubuntu/workspace/wp-content/uploads/2016/11" 
 // 'url' => string(61) "https://slg-kunigamaeno.c9users.io/wp-content/uploads/2016/11" 
 // 'subdir' => string(8) "/2016/11" 
 // 'basedir' => string(41) "/home/ubuntu/workspace/wp-content/uploads" 
 // 'baseurl' => string(53) "https://slg-kunigamaeno.c9users.io/wp-content/uploads" 
 // 'error' => bool(false) 
 //}
 
}

 function sitespooler_image($tgturl)
{ //do jpg,png  //no gif,mpeg,mp4,mp3,flv,

  if(!@get_headers($tgturl)) return false; //dead

  $c = file_get_contents($tgturl);      //get tgtcontents
  $imageary = parse_imagelist($c,$tgturl);  //parse contents
  $uinfoary = array();
      foreach($imageary as $fff){
        if(  @get_headers($fff)){//alive
          $ufname = create_wp_imageurl($fff);
	  $idata = file_get_contents($fff);
	  file_put_contents($ufname,$idata);
          $aid = image_wp_relation($ufname); //wordpress relation
          array_push($uinfoary,['id'=>$aid,'imageurl'=>$ufname ]); //log or info
        }
      }
 //var_dump($uinfoary); //image info on wp. id,imageurl
 //wp_insert_post //dashboard

  return true;//complete
}

function parse_imagelist($contents,$tgturl)
{
  //echo $contents;
  //日本語文字化け対策
  //$cc = mb_convert_encoding($contents, 'HTML-ENTITIES', 'ASCII, JIS, UTF-8, EUC-JP, SJIS');
  //$cc = mb_convert_encoding($contents, 'HTML-ENTITIES', 'UTF-8');
  mb_detect_order("SJIS,SJIS-win,EUCJP-win,UTF-8,JIS,ASCII");
  $encode = mb_detect_encoding( strip_tags( $contents ) );
  //var_dump($encode);
  //$cc = mb_convert_encoding( $contents, $encode, mb_detect_order() );
  $cc = mb_convert_encoding( $contents,'HTML-ENTITIES', $encode);
  //echo $cc;
  //
  $dd = new DOMDocument();
  libxml_use_internal_errors( true );//warning stop
  $dd->loadHTML($cc);
  libxml_clear_errors(); //warning stop
  //var_dump($dd);
  //$x = @simplexml_load_string($dd->saveXML()); //saveXMLでhtmlの解析エラー多し
  $x = simplexml_import_dom($dd); //simplexml_loda_string(...)より融通が利く
  $xall =  simplexml_import_dom($dd);//全てはこれをxpath meta等
  
  //echo $dd->saveHTML();
  
  //id=primary がある場合
  $el =$xall->xpath('//*[@id="primary"]');
  if(count($el) != 0)  //be.  //not is array(0)
  {  
   //
  }else{  //無い場合 body
    $el = $xall->xpath('//body');
  }
  
  {
    $str ='';
    foreach($el as $a){ $str .=$a->asXML().PHP_EOL; }
    
    mb_detect_order("SJIS,SJIS-win,EUCJP-win,UTF-8,JIS,ASCII");
    $encode = mb_detect_encoding( strip_tags( $str ) );
    //var_dump($encode);
    $stren ='<meta charset="'.$encode.'">';
    //echo ($stren);
    logcr($stren);
    $strcc = $stren.mb_convert_encoding( $str, $encode, mb_detect_order() );
    //var_dump($strcc);
    $ndd = new DOMDocument();
    libxml_use_internal_errors( true );//warning stop
    $ndd->loadHTML($strcc);
    libxml_clear_errors(); //warning stop
    $x = simplexml_import_dom($ndd);
  }
  //$atag ="<h1><h2><h3><p><a><pre><code><mark><strong>";
  //$str =strip_tags( $str ,$atag);
  //echo $str;
  //echo disp_preamp($str);

  
  //get img
  $el =$x->xpath("//img[@src]");
  $iimg = array();
  foreach($el as $a) 
  { array_push($iimg,[ 'src'=>$a['src'],'alt'=>$a['alt'],'title'=>$a['title'] ]); }
  logcr('img='.count($iimg));
  //logcr(implodeAA($iimg));

  test_innerurl($iimg,$tgturl);

  //get a href
  $el =$x->xpath("//a[@href]");
  $ia = array();
  foreach($el as $a) 
  { array_push($ia,[ 'href'=>$a['href'],'alt'=>$a['alt'],'title'=>$a['title'],'string'=>trim( (string)$a )]); }
  logcr('a href='.count($ia));
  //logcr(implodeAA($ia));
  
  test_createurl($ia,$tgturl);

  //get h1
  $el =$x->xpath("//h1");
  $ih1 =array();
  foreach($el as $a) 
  {
    $wk =strip_tags($a->asXML());
   if(strlen((string)$wk) != 0){ array_push($ih1,trim( (string)$wk )); } 
   //if(strlen((string)$a) != 0){ array_push($ih1,trim((string)$a)); } 
  }
  //logcr('h1='.count($ih1));
  //logcr(implodeA($ih1));
  //get h2
  $el =$x->xpath("//h2");
  $ih2 =array();
  foreach($el as $a)
  { 
    $wk =strip_tags($a->asXML());
   if(strlen((string)$wk) != 0){ array_push($ih2,trim( (string)$wk )); } 
   //if(strlen((string)$a) != 0){ array_push($ih2,trim( (string)$a )); } 
  }
  //logcr('h2='.count($ih2));
  //logcr(implodeA($ih2));
  
  //get h3
  $el =$x->xpath("//h3");
  $ih3 =array();
  foreach($el as $a)
  { 
    $wk =strip_tags($a->asXML());
   if(strlen((string)$wk) != 0){ array_push($ih3,trim( (string)$wk )); }
   //if(strlen((string)$a) != 0){ array_push($ih3,trim( (string)$a )); } 
  }
  //logcr('h3='.count($ih3));
  //logcr(implodeA($ih3));
  
  //get p
  $el =$x->xpath("//p");
  $ipt=array();
  foreach($el as $a)
  { //pのなかの strong mark aが stringでなくなる
    //$str .=$a->asXML().PHP_EOL;
    //echo disp_preamp($a->asXML().PHP_EOL.(string)$a.PHP_EOL.strip_tags($a->asXML()));
    $wk =strip_tags($a->asXML());
   if(strlen((string)$wk) != 0){ array_push($ipt,trim( (string)$wk )); } 
  }
  //logcr('p='.count($ipt));
  //logcr(implodeA($ipt));
  
  
  //following-sibling::p[1]
  //get h1 > p
  $el =$x->xpath("//h2/following-sibling::p[1]");
  $h1p=array();
  foreach($el as $a)
  {
    $wk =strip_tags($a->asXML());
   if(strlen((string)$wk) != 0){ array_push($h1p,trim( (string)$wk )); } 
   //if(strlen((string)$a) != 0){ array_push($h1p,trim( (string)$a )); } 
  }
  //logcr('h1p='.count($h1p));
  //logcr(implodeA($h1p));

  //following-sibling::p[1]
  //get h1 > p
  $el =$x->xpath("//pre");
  $ipre=array();
  foreach($el as $a)
  {
    $wk =strip_tags($a->asXML());
   if(strlen((string)$wk) != 0){ array_push($ipre,trim( (string)$wk )); } 
   //if(strlen((string)$a) != 0){ array_push($ipre,trim( (string)$a )); } 
  }
  //logcr('ipre='.count($ipre));
  //logcr(implodeA($ipre));

  //bk_test();
  $el =$xall->xpath("//meta");  //$xall
  //$el =$el->xpath("*[@name]");
  $str ='';
  $imeta=array();
  foreach($el as $a)
  {
    array_push($imeta,[ 'name'=>$a['name'],'property'=>$a['property'],'content'=>$a['content'] ] );
    $str .=$a->asXML().PHP_EOL;
  }
  //head titleがあれば $imetaの中に入れておく
  $el =$xall->xpath("//head/title");
  foreach($el as $a)
  {
    array_push($imeta,[ 'name'=>'title','property'=>'title','content'=>(string)$a ] );
    $str .=$a->asXML().PHP_EOL;
  }
  //echo disp_preamp($str);
  logcr($str);
  //logcr(implodeAA($imeta));

  $el =$x->xpath("//p");
  $str ='';
  foreach($el as $a)
  {
    $str .=$a->asXML().PHP_EOL;
  }
  $atag ="<a><pre><code><mark><strong>";
  $str =strip_tags( $str ,$atag);
  //echo $str;
  //echo disp_preamp($str);
 
  $el =$x->xpath('//*[@id="primary"]');
  $str ='';
  foreach($el as $a)
  {
    $str .=$a->asXML().PHP_EOL;
  }
  //$atag ="<h1><h2><h3><p><a><pre><code><mark><strong>";
  //$str =strip_tags( $str ,$atag);
  //echo $str;
  //echo disp_preamp($str);
 
  //$el =$x->xpath('//*[@id="primary"]');
  //if(count($el) != 0)  //be.  //not is array(0)
  //  var_dump($el);
  
  //href='#hogehoge' cut
  //doublecount link cut
  //doublecount img cut
  //http://aoproj.web.fc2.com/xpath/XPath_cheatsheets_v2.pdf 
  //p 要素は文字数によって改行させる
  $xqa = [ 
   'img'=>'//img[@src]',
   'ahref'=>'//a[@href]',
   'h1'=>'//h1',
   'h2'=>'//h2',
   'h3'=>'//h3',
   'p'=>'//p',
   'pre'=>'//pre',
   'h1p'=>'//h1/following-sibling::p[1]',
   'h2p'=>'//h2/following-sibling::p[1]',
   'h3p'=>'//h3/following-sibling::p[1]',
   'htmltitle'=>'//html/head/title',
   'meta' =>'//meta',
   'link' =>'//link',
   'style' =>'//style',
   'script' =>'//script',
   ];

  print_r(meta_smart_disp($imeta,$tgturl));
  
  print_r(h_smart_disp($ih1,$ih2,$ih3,$tgturl));
  //print_r(p_smart_disp($ihm,400,$tgturl));
  print_r(p_smart_disp($ipt,400,$tgturl));
  
  print_r(a_smart_disp($ia,$tgturl));
  print_r(img_smart_disp($iimg,$tgturl));

  
  $n =check_score(intval( count($ia)),strlen(implodeA($ipt)));
  logcr('score='.$n);
  
  //test_img_get($iimg,$tgturl);
  test_imgsrcdata();

  return $ia;
}


function test_innerurl($ary,$tgturl)
{
  
   //$tgturl ="http://blog.katty.in/1400";
   //$tgturl ="http://qiita.com/kobake@github/items/3c5d09f9584a8786339d";
   //$tgturl ="https://www.webprofessional.jp/enabling-ajax-file-uploads-in-your-wordpress-plugin/";
   //$tgturl ="http://webdesign.practice.jp/ogp-facebook-twittercards";
   //$tgturl ="http://webdesign.practice.jp/google-adsense-seo";
   foreach($ary as $a)
   {
     $flg = is_innerurl($tgturl,$a['src']);
     $w = $flg.' '.$a['src'].' '.createUri($tgturl,$a['src']);
     logcr($w);
   }
}

function test_createurl($ary,$tgturl)
{
   //$tgturl ="http://blog.katty.in/1400";
   //$tgturl ="http://qiita.com/kobake@github/items/3c5d09f9584a8786339d";
   //$tgturl ="https://www.webprofessional.jp/enabling-ajax-file-uploads-in-your-wordpress-plugin/";
   //$tgturl ="http://webdesign.practice.jp/ogp-facebook-twittercards";
   //$tgturl ="http://webdesign.practice.jp/google-adsense-seo";
   foreach($ary as $a)
   {
     $flg = is_innerurl($tgturl,$a['href']);
     $w = $flg.' '.$a['href'].' '.createUri($tgturl,$a['href']);
     //logcr($w);
   }
}

function bk_test()
{
 $el =$x->xpath("//meta");
  //$imeta=array();
  //foreach($el as $a)
  //{ if(strlen((string)$a) != 0){ array_push($ipre,trim( (string)$a )); } }
  //logcr('ipre='.count($ipre));
  //logcr(implodeA($ipre));
  //echo $x->asXML();
  
  //xpath asXML
  //while(list( , $node) = each($el)) {
  //  logcr($node->asXML());
  //}
  $str ='';
  foreach($el as $a)
  {
    $str .=$a->asXML().PHP_EOL;
  }
  ///logcr("hoge");
  //logcr($str);
  echo ('<pre>'.htmlspecialchars($str).'</pre>');
  //var_dump((string)$el);
  //$nel = new SimpleXMLElement((string)$el);
  //logcr($nel->asXML());
  //href='#hogehoge' cut
  //doublecount link cut
  //doublecount img cut
  
 
}

function full_meta_create()
{
 // Open Graph protocol
 $t =""; //##t##
 $d =""; //##d##
 $i =""; //##i##
 $u =""; //##u##
 $n =""; //##n## site name
 $tc ="summary_large_image"; //##tc## twitter card
 $r =
  '<meta property="og:title" content="##t##" />'.PHP_EOL.
  '<meta property="og:image" content="##d##" />'.PHP_EOL.
  '<meta property="og:description" content="##i##" />'.PHP_EOL.
  '<meta property="og:url" content="##u##"/>'.PHP_EOL.
  '<meta property="og:site_name" content="##n##"/>'.PHP_EOL.
  '<meta name="twitter:card" content="##tc##"/>'.PHP_EOL.
  '<meta name="twitter:description" content="##d##"/>'.PHP_EOL.
  '<meta name="twitter:title" content="##t##"/>'.PHP_EOL.
  '<meta name="twitter:image" content="##i##"/>'.PHP_EOL.
  '';
 
}

function image_check()
{
 //外部イメージイメージは広告の場合が多いので内部の
 
}

function check_score($l,$m)
{
 //ユニークリンクに対する文字数//uniqueでないほうがいい。リンク連打とか
 //#はカウントなしにしたい
 //ulink,kijimoji
 //kijimoji/ulink
 $ul =$l+1;//0 is bad
 $mo =$m;
 
 logcr($str =$ul." ".$mo);

 $score = $mo/$ul;
 //ex
 $badscore = 400/10;//40
 $goodscore = 1000/5;//200
 $twitterscore = (140-20)/1;//120
 
 //2000文字を超えると重みがけ = 読みづらい
 $rz =2000;
 $rzg =0.5;
 //if($mo >$rz ){  $score = intval( $score/(($mo/$rz)*$rzg) );}

 return intval( $score); 
}

function meta_smart_disp($metaary,$url)
{
 /*
,,
,,IE=edge
,,requiresActiveX=true
viewport,,width=device-width,initial-scale=1
keywords,,韓国,NHK,ニュース,NHK NEWS WEB
description,,「ピソン（秘線）」。権力者が公式の参謀陣と協議して政策決定を進める「表のライン」とは別に、表舞台には姿を見せない人物たちが権力者にアドバイスをし、みずからも権力を振るう構図、「裏のライン」を意味する韓国語です。韓国の歴代の大統領にも、家族らがそうした「秘線」となり、政策面で貢献する一方、ときには腐敗の温床ともなりました。（ソウル支局 池畑修平支局長）
copyright,,NHK(Japan Broadcasting Corporation)
author,,日本放送協会
Targeted Geographic Area,,Japan
coverage,,Japan
rating,,general
content-language,,ja
robots,,index,follow
format-detection,,telephone=no
,og:site_name,NHK NEWS WEB
,og:title,「秘線」の衝撃 韓国パク大統領の失墜｜NHK NEWS WEB
,og:locale,ja_JP
,og:description,「ピソン（秘線）」。権力者が公式の参謀陣と協議して政策決定を進める「表のライン」とは別に、表舞台には姿を見せない人物たちが権力者にアドバイスをし、みずからも権力を振るう構図、「裏のライン」を意味する韓国語です。韓国の歴代の大統領にも、家族らがそうした「秘線」となり、政策面で貢献する一方、ときには腐敗の温床ともなりました。（ソウル支局 池畑修平支局長）
,og:url,http://www3.nhk.or.jp/news/web_tokushu/2016_1109.html
,og:image,http://www3.nhk.or.jp/news/web_tokushu/still/1109_eyecatch.jpg
,og:type,article
,fb:app_id,157582317936888
twitter:card,,summary_large_image
twitter:site,,@nhk_news
twitter:creator,,@nhk_news
theme-color,,#0087d2
msapplication-config,,http://www.nhk.or.jp/browserconfig.xml
msapplication-TileImage,,http://www.nhk.or.jp/apple-touch-icon-152x152-precomposed.png
msapplication-TileColor,,#044181
*/
 //'name','property','contents';
 //array_push($imeta,[ 'name'=>$a['name'],'property'=>$a['property'],'content'=>$a['content'] ] );

  $metas =[
   'viewport',
   'copyright',
   'author',
   'robots',
   'og:site_name',
   'og:title',
   'og:locale',
   'og:description',
   'og:url',
   'og:image',
   'og:type',
   'fb:app_id',
   'fb:pages',
   'article:publisher',
   'article:author',
   'twitter:card',
   'twitter:site',
   'twitter:creator',
   'twitter:domain',
   'keywords',
   'description',
   'title',
   ];

 $ti ='';
 $desc='';
 $img='';
 $key='';
 $ur ='';
 $sn ='';
 
   foreach($metaary as $sw)
   {
     if( in_array('title',$sw)) $ti= $sw['content'];
     if( in_array('og:title',$sw)) $ti= $sw['content'];
     if( in_array('description',$sw)) $desc= $sw['content'];
     if( in_array('og:description',$sw)) $desc= $sw['content'];
     if( in_array('og:image',$sw)) $img= $sw['content'];
     
     if( in_array('og:url',$sw)) $ur= $sw['content'];
     if( in_array('site_name',$sw)) $sn= $sw['content'];
     if( in_array('keywords',$sw)) $key= $sw['content'];
     
   }

 $style='<style scoped>
    .smart.jumbotron {
      background: url("##img##");
      background-position: center center;
      background-color: #000;
      background-size: cover;
      color: #f0f8ff;
      margin-bottom: 0;
      text-shadow: 3px 3px 3px #000;
    }</style>
 ';
 $rep ='<div class="smart jumbotron"><div class="container">
   <h1>##title##</h1>
   <p>##desc##</p>
 </div></div>';
//   <blockquote cite="##url##">##site_name## ##keyword##</blockquote>

   $reptag =['##img##','##title##','##desc##','##url##','##site_name##','##keyword##'];
   //
   //htmlspecialchars();タグ混入
   $ti =htmlspecialchars($ti);
   $desc =htmlspecialchars($desc);
   $sn =htmlspecialchars($key);
   $key =htmlspecialchars($key);

   //
   $s =[$img,$ti,$desc,$ur,$sn,$key];

   $ret =str_replace($reptag,$s,$style.$rep);
  return $ret;
}

function h_smart_disp($h1ary,$h2ary,$h3ary,$url)
{//keyword
 ///$url same domain check spoil to adsense
 // $ihm =array_merge($h1ary,$h2ary,$h3ary);
 // $ihm= array_unique($ihm);
 
 //ng word PR,ＰＲ,[PR],
 
   $style ='<style scoped>h1.smart, h2.smart, h3.smart {
    display: inline;
    font-size: initial;
    padding: 4px;
    /* border: 1px solid rgba(247, 26, 26, 0.15); */
    /* border-radius: 4px; */
    color: inherit;
}</style>';
   $sep ='<span class="imgsepspan"></span>';
   $rep1 ='<h1 class="smart">##string##</h1>';
   $rep2 ='<h2 class="smart">##string##</h2>';
   $rep3 ='<h3 class="smart">##string##</h3>';
   
   $reptag ='##string##';
   $w ='';
   $repary =array();
   foreach($h1ary as $s)
   { 
     array_push($repary,str_replace($reptag,$s,$rep1).PHP_EOL);
   }
   foreach($h2ary as $s)
   { 
     array_push($repary,str_replace($reptag,$s,$rep2).PHP_EOL);
   }
   foreach($h3ary as $s)
   { 
     array_push($repary,str_replace($reptag,$s,$rep3).PHP_EOL);
   }
     
   $repary= array_unique($repary);
   //$repary= strlen_rsort($repary);
   $i =0;
   
   foreach($repary as $s){ 
    $w.=$s; 
    if($i ==10) break;
    $i++;
   }

   return '<div class="smart">'.$style.$w.'</div>';
   //return $style.$w;

}

function a_smart_disp($iaary,$url)
{
 //{ array_push($ia,[ 'href'=>$a['href'],'alt'=>$a['alt'],'title'=>$a['title'],'string'=>trim( (string)$a )]); }

 
 ///$url same domain check spoil to adsense
   $style ='<style scoped>a.smart {
    margin-left: 5em;
    display: flex;   
    /* min-height: 150px; */
   }</style>';
   // target=”_blank”
   //rel="nofollow" 
   $sep ='<span class="imgsepspan"></span>';
   $rep ='<a class="smart" href="##href##" alt="##alt##" title="##title##" rel="nofollow" target=”_blank”>##string##</a>';
   $reptag =['##href##','##alt##','##title##','##string##'];
   $w ='';
   $repary =array();
   foreach($iaary as $s)
   { 
     $t ='';
     if( strlen($s['alt']) > strlen($s['title'])){ $t = $s['alt']; }
     else{ $t = $s['title']; }

     if( strlen($s['string']) >strlen($t) ) { $t =$s['string']; }
     
    //$w.= str_replace($reptag,[$s['href'],$t,$t,$t],$rep).PHP_EOL;
     $nhref= createUri($url,$s['href']);
     array_push($repary,str_replace($reptag,[$nhref,$t,$t,$t],$rep).PHP_EOL);
   }
     
   $repary= array_unique($repary);
   $repary= strlen_rsort($repary);
   $i =0;
   foreach($repary as $s){ 
    $w.=$s; 
    if($i ==10) break;
    $i++;
   }

   return '<div class="smart">'.$style.$w.'</div>';
   //return $style.$w;
}

function img_smart_disp($imgary,$url)
{
 ///$url same domain check spoil to adsense

//参考
//http://requlog.com/self-branding/wordpress/media-setting/
/*
  <stule scoped>.styled_post_list1 .image img {
    width: 100px;
    height: 100px;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transition: all 0.35s ease-in-out;
    -moz-transition: all 0.35s ease-in-out;
    transition: all 0.35s ease-in-out;
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    -o-transform: scale(1);
    transform: scale(1);
}
.styled_post_list1 .image:hover img {
    -webkit-transform: scale(1.2);
    -moz-transform: scale(1.2);
    -ms-transform: scale(1.2);
    -o-transform: scale(1.2);
    transform: scale(1.2);
}
</style>
<img width="180" height="180" src="http://requlog.com/wp-content/uploads/todoist-advanced_ec-200x200.jpg" class="attachment-size1 size-size1 wp-post-image" alt="todoist-advanced_ec" srcset="http://requlog.com/wp-content/uploads/todoist-advanced_ec-200x200.jpg 200w, http://requlog.com/wp-content/uploads/todoist-advanced_ec-120x120.jpg 120w" sizes="(max-width: 180px) 100vw, 180px" style="display: inline;">
*/
   $style ='<style scoped>
   span.hideof{ /*hidden overflow */
    overflow: hidden;
    float: left; 
   }
   img.smart {
    width: 100px;
    height: 100px;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transition: all 0.35s ease-in-out;
    -moz-transition: all 0.35s ease-in-out;
    transition: all 0.35s ease-in-out;
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    -o-transform: scale(1);
    transform: scale(1);
   }
    img.smart:hover {
    -webkit-transform: scale(1.2);
    -moz-transform: scale(1.2);
    -ms-transform: scale(1.2);
    -o-transform: scale(1.2);
    transform: scale(1.2);
}   
   </style>';
   $sep ='<span class="imgsepspan"></span>';
   //$rep ='<img class="smart img-thumbnail img-responsive"" src="##src##" alt="##alt##" title="##title##" >';
   $addedrep =' width="180" height="180"  sizes="(max-width: 180px) 100vw, 180px" style="display: inline;"';
   // img-thumbnail img-responsive
   $rep ='<img class="smart" src="##src##" alt="##alt##" title="##title##" '.
    $addedrep.
   '>';
   $rep ='<span class="hideof">'.$rep.'</span>';
      
   $reptag =['##src##','##alt##','##title##'];
   $w ='';
   $repary =array();
   foreach($imgary as $s)
   { 
     $t ='';
     if( strlen($s['alt']) > strlen($s['title'])){ $t = $s['alt']; }
     else{ $t = $s['title']; }
     
     //if(is_innerurl($url,$s['src']))
     {  
      $nsrc= createUri($url,$s['src']);
      array_push($repary,str_replace($reptag,[$nsrc,$t,$t],$rep).PHP_EOL); 
     }
   }
      //var_dump(count($repary));
      $repary= array_unique($repary);
      //var_dump(count($repary));
   $i =0;
   foreach($repary as $s){ 
    $w.=$s; 
    if($i ==10) break;
    $i++;
   }
   //var_dump($repary);
   return '<div class="smart">'.$style.$w.'</div>';

   //return '<div class="smart">'.$style.$w.'</div>';
   //return $style.$w;
}

function p_smart_disp($pary,$mojisuu=400,$tgturl)
{
   $style ='<style scoped>
    p.smart {
    margin-left: 5em;
   }</style>';
   $sep ='<span class="sepspan"></span>';
   $rep ='<p class="smart">##p##</p>';
   $reptag ='##p##';
   $w ='';
   $repary =array();
   foreach($pary as $os)
   { 
    $s = htmlspecialchars($os);//文字のなかにタグ混入
    if(strlen($w) > $mojisuu){ array_push($repary,[$reptag,$w,$rep]); $w =$s;}
    else{ $w.=$s.$sep; }
   }
   
   if(strlen($w) !=0){ array_push($repary,[$reptag,$w,$rep]);   }
   
   $w ='';
   $wmore='';
   $wmorerep='<p class="smart btn btn-link" data-toggle="collapse" data-target="#demo">...READ MORE...</p>
<span id="demo" class="collapse">##more##</span>';

   $i=0;
   foreach($repary as $s)
   {
     if( $i >= 3 ){ $wmore.= str_replace($s[0],$s[1],$s[2]).PHP_EOL; }
     else {$w.= str_replace($s[0],$s[1],$s[2]).PHP_EOL; }
     $i++;
   }
   if(strlen($wmore) !=0)
   {  $w.= str_replace('##more##',$wmore,$wmorerep).PHP_EOL; }
   //var_dump($repary);
   //&amp;#13;はカット <> &lt; &gt;に戻す
   $w = str_replace(["&amp;#13;","&amp;lt;","&amp;gt;"],["","&lt;","&gt;"],$w);
   
   return '<div class="smart">'.$style.$w.'</div>';
   //return $w;
}


function old_parse_imagelist($contents,$tgturl)
{
  //日本語文字化け対策
  //$cc = mb_convert_encoding($contents, 'HTML-ENTITIES', 'ASCII, JIS, UTF-8, EUC-JP, SJIS');
  //$cc = mb_convert_encoding($contents, 'HTML-ENTITIES', 'UTF-8');
  mb_detect_order("SJIS,SJIS-win,EUCJP-win,UTF-8,JIS,ASCII");
  $encode = mb_detect_encoding( strip_tags( $contents ) );
  var_dump($encode);
  $cc = mb_convert_encoding( $contents, $encode, mb_detect_order() );
  //
  $dd = new DOMDocument();
  libxml_use_internal_errors( true );//warning stop
  $dd->loadHTML($cc);
  libxml_clear_errors(); //warning stop
  $xmlString = $dd->saveXML();
  //$ssss =@simplexml_load_string($xmlString);
  //var_dump($ssss);
  $jsa = raw_json_encode( @simplexml_load_string($xmlString));
  //$jsa = json_encode($xmlString);
  //var_dump($jsa);
  //logcr($jsa);
  $xmlarray = json_decode($jsa, true);
  //echo $xmlarray['head']['title'];
  var_dump($xmlarray['head']['meta']);
  //logcr( json_encode( $xmlarray['head']['title']) );
  logcr( raw_json_encode( $xmlarray['head']['meta']));
  //logcr( strip_tags($contents));
  //calc
  $ia = array();

  return $ia;
}


function test_imgsrcdata()
{
 $imgurl = 'https://facebookbrand.com/wp-content/themes/fb-branding/prj-fb-branding/assets/images/fb-art.png';

//resize w,h

 //$src = base64imgsrcdata($imgurl,-1,140);
 $src = base64imgsrcdata($imgurl);

 if($src ==''){ return; } //bad case 
 
 $n ='##src##';
 $rep ='<img src="##src##" />';
 $imgtag =str_replace($n,$src,$rep);
 echo $imgtag;
}


function test_img_get($imgary,$url)
{
   $w ='';
   $repary =array();
   foreach($imgary as $s)
   { 

     //if(is_innerurl($url,$s['src']))
     {  
      $nsrc= createUri($url,$s['src']);
      array_push($repary,$nsrc); 
     }
   }
      //var_dump(count($repary));
      $repary= array_unique($repary);
      //var_dump(count($repary));
      
   $i =0;$imax=999;
   foreach($repary as $s){
    if($i ==$imax) break;
    $i++;
    image_on_web($s);
   }
   
}

function image_on_web($imgurl)
{
  $iu = $imgurl; //$iu = 'http://*******/aaa.jpg';

  if(!@get_headers($iu)) 
  {
   logcr("site is dead=".$iu);
   return false; //dead
  }
  
  $c = file_get_contents($iu);      //get tgtcontents
  $sizeok = is_imagesize_more(300,150,'',$c);
  //一時的にテンポラリに書いてサイズチェック
  //var_dump($sizeok);
   
 if($sizeok == TRUE)
 {
  
  //$c = file_get_contents($iu);      //get tgtcontents
  $funiq =hash_file('md5', $iu).'__';  //file unique head name 
  $wpf = create_wp_imageurl($iu,$funiq);
  $wps = file_put_contents($wpf,$c); // ok is return filesize. ng is FALSE.
  
  //$r = is_imagesize_more(100,-999,$wpf);
  //logcr(" is_imagesize_more=". $r);
  
  // check this...
  logcr(" imgurl=".$iu);
  logcr(" size=".strlen($c));
  logcr(" wpf=".$wpf);
  logcr(" wpsize=".$wps);

  $r = image_wp_relation($wpf); //wpで設定したサイズ切り出しとdb登録
  logcr(" attach_id=".$r);
 }
 
}

function create_wp_imageurl($fff,$funiq='')
{
  $iu = $fff; //http://*******/aaa.jpg
  $putdir = wp_upload_dir();// wp upload dir
  $iu_p = parse_url($iu);
  //var_dump($iu_p);
  $iu_pp = pathinfo($iu_p['path']);
  //var_dump($iu_pp);
  //$ufname = $putdir['path']."/".$iu_pp['basename'];
  $ufname = $putdir['path']."/".$funiq.$iu_pp['basename']; //uniq head add
  //var_dump($putdir);
  return $ufname;
}

function image_wp_relation($upimageurl)
{
 // $filename はアップロード用ディレクトリにあるファイルのパス。
 $filename = $upimageurl;
 // この添付ファイルを紐付ける親投稿の ID。
 $parent_post_id = 0;// 0 is none
 // ファイルの種類をチェックする。これを 'post_mime_type' に使う。
 $filetype = wp_check_filetype( basename( $filename ), null );
 // アップロード用ディレクトリのパスを取得。
 $wp_upload_dir = wp_upload_dir();
 // 添付ファイル用の投稿データの配列を準備。
 $attachment = array(
	'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
	'post_mime_type' => $filetype['type'],
	'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
	'post_content'   => '',
	'post_status'    => 'inherit'
 );
 // 添付ファイルを追加。
 $attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );

 // wp_generate_attachment_metadata() の実行に必要なので下記ファイルを含める。
 require_once( ABSPATH . 'wp-admin/includes/image.php' );

 // 添付ファイルのメタデータを生成し、データベースを更新。
 $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
 wp_update_attachment_metadata( $attach_id, $attach_data );

 return $attach_id;
}

