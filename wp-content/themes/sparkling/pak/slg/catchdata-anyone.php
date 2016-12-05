<?php 
$GLOBALS['hwf'] = get_template_directory().'/slg/bom/'; //history-work-folder
$GLOBALS['bomdata'] = $GLOBALS['hwf'].date("YmdHis").'data.dat';
$GLOBALS['bomdatalog'] = $GLOBALS['hwf'].'log.csv';
add_shortcode('main_catchdata', 'main_catchdata'); //wordpress only
 function main_catchdata()
 {
   // if..need pass check. $_POST['pass']
   if( isset($_POST['historydata']) ){//file write
     file_put_contents($GLOBALS['bomdata'], $_POST['historydata']);
     {
        $t=date("Y-m-d H:i:s");
        $wd ="[".$t."]".",".$GLOBALS['bomdata'].",0".PHP_EOL;
        file_put_contents($GLOBALS['bomdatalog'], $wd,FILE_APPEND);
     }
      
   }else{//file read viewmode
     $d =file_get_contents($GLOBALS['bomdatalog']);
     //var_dump($d);
     //echo "<span>[".date("Y-m-d H:i:s")."]:".count($d)."</span>";
     echo $d;
   }
 }
