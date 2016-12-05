<?php
/**
 * kuniga.maeno slg sandbox
 * this file include relations write only.
 * @package sparkling add
 */

 function main_slg_sandbox()
 {
     //echo "sandboxgggggggggggggggggggg";
     
     main_slg_data();
     test_AbilityUp();
     
     echo disp_textarea($GLOBALS['LOGBR']);
     //echo $GLOBALS['LOGBR'];
 }

 function test_AbilityUp()
 {
     //var_export($GLOBALS['GAME']);
     for($j=0;$j<20;$j++){
      loggg($GLOBALS['GAME']['CHDATA'][0]['chnumability']['fp']."%");
      for($i=0;$i<100;$i++){
      AbilityUp('fp',0,0);
      }
      loggg($GLOBALS['GAME']['CHDATA'][0]['nowability']['fp']);
      loggg("\n");
      //reset status
      $GLOBALS['GAME']['CHDATA'][0]['nowability']['fp']=0;
      $GLOBALS['GAME']['CHDATA'][0]['chnumability']['fp']+=5;
     }
  
  
 }
 

 function Dice($maxvalue)
 {
    return mt_rand ( 0, $maxvalue );
 }
 
 function IsDice($percent)
 {
 //$GLOBALS['GAME'].OK or $GLOBALS['GAME'].NG
  if($percent >= $GLOBALS['GAME']['lalimit']){ return $GLOBALS['GAME']['OK'];}
 
 //throw dice 0-$GLOBALS['GAME'].lalimit
  if($percent >= Dice($GLOBALS['GAME']['lalimit'])){ return $GLOBALS['GAME']['OK'];}

    return $GLOBALS['GAME']['NG'];
 }

//$outkind is 'fp','mp','sk','lu','fd','md'
function AbilityUp($outkind,$chnum,$jobnum)
{
 //ablility max check 
 //logbr($GLOBALS['GAME']['CHDATA'][$chnum]['nowability'][$outkind]);
 //logbr($GLOBALS['GAME']['maxability'][$outkind]);

 if($GLOBALS['GAME']['CHDATA'][$chnum]['nowability'][$outkind] >=$GLOBALS['GAME']['maxability'][$outkind]){ return;}

  $per;
  {
   //最終能力値上昇率＝キャラ個別＋ジョブ個別
   //ＬＡ＝（ＣＡ＋ＪＡ）
   $la = $GLOBALS['GAME']['CHDATA'][$chnum]['chnumability'][$outkind] + $GLOBALS['GAME']['JOBDATA'][$jobnum]['jobnumability'][$outkind];
   //；欠点としてＬＡが５％と低確率の場合、確率が上昇しづらい。；解決策。二乗上昇の場合。
   //ｂＬＡ＝ＬＡ＾（１＋Ｏｎ＊ｂＧＡＩＮ）　ｂＧＡＩＮ＝０．３
   //logbr("bgain=".$GLOBALS['GAME']['CHDATA'][$chnum]['outcount'][$outkind]*$GLOBALS['GAME']['bgain']);
   $g=1.0+($GLOBALS['GAME']['CHDATA'][$chnum]['outcount'][$outkind]*$GLOBALS['GAME']['bgain']);
   //logbr("g=".$g);
   $bla =pow($la,$g);
   //logbr("bla=".$bla);
   //；現在能力値が低いと上がりやすく,能力値上限になればなるほど上がりにくい。
   //CapA=(1-nA/MA)*gain　ｃＧＡＩＮ＝１．３
   //ｎＡ：現在の能力値 ＭＡ：能力値上限。
   $nma =$GLOBALS['GAME']['CHDATA'][$chnum]['nowability'][$outkind]/$GLOBALS['GAME']['maxability'][$outkind];
   //logbr("nma=".$nma);
   $capa=(1.0-$nma)*$GLOBALS['GAME']['cgain'];
   //logbr("capa=".$capa);
   //欠点を補正した最終的な能力値上昇率。
   //ｃＬＡ＝ｂＬＡ＊ＣａｐＡ
   $cla =$bla*$capa;
   $per=$cla;
  }

 //logbr("per=".$per);
 $ans = IsDice($per);

  if($ans == $GLOBALS['GAME']['OK'])
  {
   //up ablitiy
   $GLOBALS['GAME']['CHDATA'][$chnum]['nowability'][$outkind]++;
   $GLOBALS['GAME']['CHDATA'][$chnum]['outcount'][$outkind]=0;
   loggg("+");

  }
  else
  { 
   //sorry no ability up, next goodluck.
   $GLOBALS['GAME']['CHDATA'][$chnum]['outcount'][$outkind]++;
   loggg(".");
  }
 //logbr($GLOBALS['GAME']['CHDATA'][$chnum]['nowability'][$outkind]);
 
} 
  //end ability
/*
 
　能力値の蓄積ダイス。

　キャラクター毎に能力値上昇が％で決まっている。
　ジョブ毎に能力値上昇が％で決まっている。
　キャラ＋ジョブの合算で能力値上昇率が決まる。
　
　最終能力値上昇率＝キャラ個別＋ジョブ個別
　ＬＡ＝（ＣＡ＋ＪＡ）

　ファイヤーエムブレムの場合。
　物力、魔力、技巧、敏捷、幸運、物防、魔防
　ＦＰ、ＭＰ、ＳＫ、ＳＰ、ＬＵ、ＦＤ、ＭＤ

　レベルアップの能力値上昇のダイスは最終能力値上昇率だが、
　はずれた場合に外れ回数をカウントする。Ｏｎ

　前回能力未上昇時の補正能力上昇率　＝　最終能力値上昇率＊（１＋外れ回数）
　ｂＬＡ＝　ＬＡ＊（１＋Ｏｎ）
　ｂＬＡが１００％を超える場合、ダイスを振らずに能力値を上昇させる。

　能力値が上昇したら外れ回数を０に戻す。

　；欠点としてＬＡが５％と低確率の場合、確率が上昇しづらい。
　；解決策。二乗上昇の場合。
　ｂＬＡ＝ＬＡ＾（１＋Ｏｎ＊ｂＧＡＩＮ）　ｂＧＡＩＮ＝０．３

　；能力値が低いと上がりやすく、
　；能力値上限になればなるほど上がりにくい。
　CapA=(1-nA/MA)*gain　ｃＧＡＩＮ＝１．３
　ｎＡ：現在の能力値
　ＭＡ：能力値上限。
　
　欠点を補正した最終的な能力値上昇率。
　ｃＬＡ＝ｂＬＡ＊ＣａｐＡ

　//stat ability
  // var outkind=fp,mp,sk,sp,lu,fd,md;
  // var chnum,jobnum;
  // array outcount={ fp=0,mp=0,sk=0,lu=0,fd=0,md=0};
  // array chnumability={ fp=5,mp=5,sk=5,lu=10,fd=10,md=10};  //percent
  // array jobnumability={ fp=5,mp=5,sk=5,lu=10,fd=10,md=10};  //percent
  // array nowability ={fp=4,mp=25,sk=10,lu=2,fd=5,md=6};  //value maxMA
  // array CHDATA,JOBDATA,GAMEDEF;
 function InitDATA()
{
 GAMEDEF.lalimit=100;
 GAMEDEF.bgain =0.3;
 GAMEDEF.cgain =1.3;
 array GAMEDEF.maxability={fp=40,mp=40,sk=40,lu=40,fd=40,md=40};
 GAMEDEF.OK =1;
 GAMEDEF.NG =0;

}
function Dice(maxvalue)
{
 //random 0-maxvalue;
 return rand(0,maxvalue);
}

 function IsDice(percent)
{
 //GAMEDEF.OK or GAMEDEF.NG
  if(percent >= GAMEDEF.lalimit){ return GAMEDEF.OK;}
 
 //throw dice 0-GAMEDEF.lalimit
  if(percent <= Dice(GAMEDEF.lalimit){ return GAMEDEF.OK;};

 return GAMEDEF.NG;
}
  function AbilityUp(outkind,chnum,jobnum)
{
 //ablility max check 
 if(CHDATA[chnum].nowability[outkind] >=GAMEDEF.maxability[outkind]){ return;} 

 var per =function (outkind,chnum,jobnum)
{
 //最終能力値上昇率＝キャラ個別＋ジョブ個別
 //ＬＡ＝（ＣＡ＋ＪＡ）
 la = CHDATA[chnum].chnumability[outkind] + JOBDATA[jobnum].jobnumability[outkind];

 //；欠点としてＬＡが５％と低確率の場合、確率が上昇しづらい。；解決策。二乗上昇の場合。
 //ｂＬＡ＝ＬＡ＾（１＋Ｏｎ＊ｂＧＡＩＮ）　ｂＧＡＩＮ＝０．３
 bla =la^(1+(CHDATA[chnum].outcount[outkind]*GAMEDEF.bgain));

 //；現在能力値が低いと上がりやすく,能力値上限になればなるほど上がりにくい。
 //CapA=(1-nA/MA)*gain　ｃＧＡＩＮ＝１．３
 //ｎＡ：現在の能力値 ＭＡ：能力値上限。
 var nma =CHDATA[chnum].nowability[outkind]/GAMEDEF.maxability[outkind];
 capa=(1-nma)*GAMEDEF.cgain;

 //欠点を補正した最終的な能力値上昇率。
 //ｃＬＡ＝ｂＬＡ＊ＣａｐＡ
 cla =bla*capa;
};////

 var ans = IsDice(per); 

 if(ans == GAMEDEF.OK)
{
 //up ablitiy
 CHDATA[chnum].nowability[outkind]++;
 CHDATA[chnum].outcount[outkind]=0;
}
else
{ 
 //sorry no ability up, next goodluck.
 CHDATA[chnum].outcount[outkind]++;
}

} 
  //end ability
　
 */ 
