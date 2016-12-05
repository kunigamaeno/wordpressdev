<?php
/**
 * kuniga.maeno slg core 
 *
 * @package sparkling add
 */
 


 function main_slg_data()
 {
  
   $GLOBALS['GAME']=init_gamedata();
 }

 
 function init_gamedata()
 {
   $GAME=[ 
   'lalimit' =>100,
   'bgain' =>0.30,
   'cgain' =>1.30,
   'maxability' =>['fp'=>40,'mp'=>40,'sk'=>40,'lu'=>40,'fd'=>40,'md'=>40],
   'OK' =>1,
   'NG' =>0,
   'CHDATA' =>array(),
   'JOBDATA' =>array(),
  ];

 $cd =[ 0=>[ 'nowability' =>['fp'=>1,'mp'=>1,'sk'=>1,'lu'=>1,'fd'=>1,'md'=>1],
             'chnumability'=>['fp'=>1,'mp'=>5,'sk'=>5,'lu'=>5,'fd'=>5,'md'=>5],
             'outcount'=>['fp'=>0,'mp'=>0,'sk'=>0,'lu'=>0,'fd'=>0,'md'=>0],
           ],
 ];
 $GAME['CHDATA']=$cd;
 
 $jd =[ 0=>[ 'jobnumability' =>['fp'=>0,'mp'=>40,'sk'=>40,'lu'=>40,'fd'=>40,'md'=>40],
           ],
 ];
 $GAME['JOBDATA']=$jd;

 return $GAME;
 }
 
 