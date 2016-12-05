<?php 
$GLOBALS['hwf'] = get_template_directory().'/slg/work/'; //history-work-folder
$GLOBALS['historydatafile'] = $GLOBALS['hwf'].'historydatafile.csv';
add_shortcode('main_catchdata', 'main_catchdata'); //wordpress only
 function main_catchdata()
 {
   // if..need pass check. $_POST['pass']
   if( isset($_POST['historydata']) ){//file write
     file_put_contents($GLOBALS['historydatafile'], $_POST['historydata']);
   }else{//file read viewmode
     $d =file_get_contents($GLOBALS['historydatafile']);
     //var_dump($d);
     echo "<span>[".date("Y-m-d H:i:s")."]:".count($d)."</span>";
   }
 }
