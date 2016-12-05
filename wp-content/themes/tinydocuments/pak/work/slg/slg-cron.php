<?php
/**
 * kuniga.maeno slg cron
 *
 * @package sparkling add
 */

 // メール送信処理
 function cron_haaku_autopost_url() {
  //wp_mail( ’xxx@xxx.jp’, 'テストタイトル', 'テストメッセージ' );
  haaku_autopost_url(); // slg-catchdata.php
 }

 function slg_cron_adds()
 {
    add_action ( 'haaku_add_cron', 'cron_haaku_autopost_url' );
    // cron登録処理
   if ( !wp_next_scheduled( 'haaku_add_cron' ) ) {
   wp_schedule_event( time(), 'hourly', 'haaku_add_cron' );
  //hourly,twicedaily,daily
   }
  
 }
