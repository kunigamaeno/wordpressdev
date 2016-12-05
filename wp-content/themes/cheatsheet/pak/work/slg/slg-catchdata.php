<?php
/**
 * kuniga.maeno slg catchdata
 *
 * @package sparkling add
 */
 
 function main_slg_catchdata()
 {
  
   logcr("main_slg_catchdata");

   //historydata
   if( isset($_POST['historydata']) )
   {//file write
     catchdatawrite($_POST['historydata']);
     //update file
     $newdata = array();
     $newtimes = array();
     {
       $slicedata = explode(PHP_EOL,$_POST['historydata']);
       $oldtime = getoldtime();
       foreach ($slicedata as $val) {
        $w = explode(",",$val);
        if( floatval($w[1]) > floatval($oldtime) ) { 
         array_push($newdata,$w[2]); 
         array_push($newtimes,$w[1]);
        }
       }
     }
      $newdata= array_unique($newdata);
      rsort($newtimes);
      //新しいデータがない場合の対応
      if( isset($newtimes[0]) ) {  // is 
         $newt = $newtimes[0];
         latesttimewrite($newt);
         urllistwrite($newt,implode(PHP_EOL,$newdata));
      }else { // not
         latesttimewrite($oldtime);
      }
     
     //echo count($_POST['historydata']);
   }
   else
   {//file read
     test_slg_catchdata();
   }
     echo disp_textarea($GLOBALS['LOGBR']);
 }
 
 function test_slg_catchdata()
 {
     logcr("data be");
     $d =catchdataread();
     logcr("orgcount=".count($d));
     $newd =array();
     $tstamp =array();
     foreach($d as $l)
     {
      array_push($newd,$l[2]);
      array_push($tstamp,intval($l[1]));
     }
      $newd= array_unique($newd);
      rsort($tstamp);
      //var_dump($tstamp);
      logcr("mosttimestamp=".$tstamp[0]);
      latesttimewrite($tstamp[0]);
      //null slice
      if( $newd[ count($newd)-1 ] == NULL)
      {   array_pop($newd);}
      
      //logcr(implodeA($newd));
      //logcr(implodeA($tstamp));
      
     logcr("uniquecount=".count($newd));
     //var_dump($newd);
     //var_dump($newd[ count($newd)-1 ]);
     logcr($newd[ count($newd)-1 ]);
     //var_dump($d[count($d)-1]);
     
     $la=array();
     $sla=$newd[count($newd)-1];
     $co=0;
     foreach($d as $l)
     {
       if($l[2] ==$sla){ 
        $la = $l;      
        logcr("co=".$co);
       }
       $co++;
     }
     //var_dump($la);
     //loggg(ldap2unixtime($la[1]));
     $ltt = latesttimeread();
     logcr(implodeAA($ltt));
     
     //logcr("oldtime=".getoldtime());
 }
 
 function ldap2unixtime($wintime)
 {
   return date(DATE_ATOM,($wintime / 1000000) - 11644473600);
   // 131229888430000000
   // 13119366824764444
 }
 function catchdataread()
 {
  //$d =file_get_contents($GLOBALS['historydatafile']);
  //return $d;//urldecode($d);
 $file = new SplFileObject($GLOBALS['historydatafile']); 
 $file->setFlags(SplFileObject::READ_CSV); 
 foreach ($file as $line) {
   if(!is_null($line[0])){
     $records[] = $line;
   }
 } 

  return $records;
 }

 function getoldtime()
 {
   $r = latesttimeread();
   if( $r[ count($r)-1 ] == NULL)
   {   array_pop($r);}
   return $r[count($r)-1][1];
 }

 function latesttimeread()
 {
  //$d =file_get_contents($GLOBALS['historydatafile']);
  //return $d;//urldecode($d);
 $file = new SplFileObject($GLOBALS['historylatestfile']); 
 $file->setFlags(SplFileObject::READ_CSV); 
 foreach ($file as $line) {
   if(!is_null($line[0])){
     $records[] = $line;
   }
 } 

  return $records;
 }
 
 function urllistwrite($fname,$d)
{
  file_put_contents($GLOBALS['historyworkdir'].$fname, $d);
}
 
 function latesttimewrite($d)
 {
  //FILE_APPEND is add write
  // logdate,chromelatestdate,0
  // 0 is flg
  $t=date("Y-m-d H:i:s");
  $wd ="[".$t."]".",".$d.",0".PHP_EOL;
  file_put_contents($GLOBALS['historylatestfile'], $wd,FILE_APPEND);
 }
 
 function catchdatawrite($d)
 {
  file_put_contents($GLOBALS['historydatafile'], $d);
 }


 //first call cron 
 function haaku_autopost_url()
 {
    $m ='kuniga.maeno@gmail.com';
    $t = date("Y-m-d H:i:s").':cron do';
    $b = ' haaku_autopost_url()';
    wp_mail($m,$t,$b);//
    
    $ddstr ="";
    $dd = latesttimeread();
    $ddstr = implodeAA($dd);
    
 $my_post = array(
  'post_title'    => $t,
  'post_content'  => $m.$b.$ddstr, //'This is my post.',
  //'post_status'   => 'publish',
  'post_author'   => 1,
  //'post_category' => array(8,39)
);

// 投稿をデータベースへ追加
   wp_insert_post( $my_post );
 }
