
<?php

// project messa  
//file prefix     messa-
//function prefix messa_

function note()
{
    
    //stdin stderr stdout を jsonで返してサーバで処理
    // messa-viewer.php >> post(source) >>
    //  messa-httpwarp.php >>excute>> messa-core.php >>post(stdio) >>messa-viewer.php
    // 
    // execute.php  >> stdin,stderr,stdout  >> json >> web
    // 
    // proc で起動する
    // 
    // prompt.php gui
    // highlight.js (php parse, intellisense ) 
    
}

function test_messa_init()
{
    /*
function console_log()
{
    ob_start();
    call_user_func_array('var_dump', func_get_args());
    file_put_contents('php://stderr', ob_get_clean());
}    
    */
	// global prefix is $GLOBALS[ $pak['prefix']];
    //closure's like ... but use $GLOBALS.
    // $pak in array functions
    
    $pak =[
	    'prefix' =>'messa', 
	    
	    'dump' => function($a,$g='messa'){
	      $o = var_export($a,true);
	      $GLOBALS[$g]['var_dump'].=$o.PHP_EOL;
	    },
	      
	    'vdump' => function($a,$g='messa'){ var_dump($a); 
	    },
	    
	    'init' => function($g='messa'){
	    	$GLOBALS[$g]['var_dump'] = ''; 
	    },
	    
	    'get_stdio' => function($g='messa'){
	        return [
	            'var_dump' => $GLOBALS[$g]['var_dump'],
	            'stdin'    => STDIN,
	            'stdout'   => STDOUT,
	            'stderr'   => STDERR,
	        ]; 
	     },
	    
	    'get_var_dump' => function($g='messa') { return $GLOBALS[$g]['var_dump'];
	    },
	
	    'main' => function($d,$g='messa'){
	      $stderr = fopen('php://stderr', 'r');
	      $stdout = fopen('php://stdout', 'r');
	      $stdin = fopen('php://stdin', 'r');
	      
	      //$d is user custom var_dump
	      $d(['akey'=>0,'bkey'=>1]);
	      $d('hogehoge');
	      $d(stream_get_contents($stderr));
	      $d(stream_get_contents($stdout));
	      $d(stream_get_contents($stdin));

	    },
	    
    ];

    
    $pak['init']();
    $pak['main']( $pak['dump'] );
    //$pak['main']( $pak['vdump'] );
    $s = print_r( $pak['get_var_dump'](),true);
    //$s.= print_r( $pak['get_stdio'](),true);
    
    return $s;
}



//wordpress の記事からテキストボックス経由で実行できること。
//いちいち別の記事を作らないくてもよい。

function messa_v_js()
{//messa-viewer.js
    $tag =<<< EOF
  <div id="formbox">
<form action="http://kuwayoshi.com/wp-comments-post.php" method="post" id="commentform" class="comment-form">
<textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required"></textarea></p> 
<input id="author" name="author" type="text" value="" size="30" maxlength="245" aria-required="true" required="required"></p>
<p class="form-submit"><input name="submit" type="submit" id="submit" class="submit" value="コメントを送信"> 
</p><p style="display: none;"><input type="hidden" id="akismet_comment_nonce" name="akismet_comment_nonce" value="ee2b1577e2"></p>
<p style="display: none;"></p><input type="hidden" id="ak_js" name="ak_js" value="1479150824979">
</form>  
  </div>
  <div id="resbox"></div>
  <span class="res"><p>time</p>[res message]</span>
    
EOF;

    $js = <<< EOF
 <script type='text/javascript' src='http://.../jquery.min.js?ver=1.4.1'></script>
 <script>
 {
     var u='messa-core.php'; //messa core url
     $.(@resbox).()...
 }
 </script>
EOF;
 
   $css = <<< EOF
 <style scoped>
 @resbox{
     
 }
 .res{
     
 }
 </style>
EOF;

 //return $s;
}

//messa-viewer.css
//messa-viewer.php  ajax.js and jQuery tag add

//messa-core.php 

function messa_core()
{
    $pname = 'command'; //post name
    $def_c = 'messa_disp_help';
    $c = $def_c; //default call name;
    $a = array(); //args;
    if( is_null($_REQUEST[$pname]) ){   
        return messa_resformat( call_user_func($def_c,array()) );
    }
    //$_REQUEST['command']
    // command is  FUNC arg1 arg2 arg3
    $deli =' ';//space
    $a = explode($deli,$_REQUEST[$pname]);
    $c = array_shift($a);
    
    if( !function_exists($c)){
        return messa_resformat( call_user_func($def_c,array()) );
    }
    
    return messa_resformat( call_user_func($c,$a) );
}

function messa_resformat($v)
{
    echo json_encode($v);
    return;
}

function messa_disp_help()
{
    $arr = get_defined_functions();
    return $arr["user"];
}