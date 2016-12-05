<?php
/**
 * kuniga.maeno slg include
 * this file include relations write only.
 * 
 * need page-slg.php 
 * 
 * @package sparkling add
 */

require_once(get_template_directory() . '/slg/slg-data.php');
require_once(get_template_directory() . '/slg/slg-core.php');
require_once(get_template_directory() . '/slg/slg-sandbox.php');
require_once(get_template_directory() . '/slg/slg-catchdata.php');
require_once(get_template_directory() . '/slg/slg-cron.php');
require_once(get_template_directory() . '/slg/slg-sandbox2.php');

require_once(get_template_directory() . '/slg/messa-core.php');

$GLOBALS['historyworkdir'] =get_template_directory() . '/slg/work/';
$GLOBALS['historyngurl'] =get_template_directory() . '/slg/work/historyngurl.csv';
$GLOBALS['historydatafile'] =get_template_directory() . '/slg/work/historydatafile.csv';
$GLOBALS['historylatestfile'] =get_template_directory() . '/slg/work/historylatestfile.csv';

 slg_cron_adds();//wp-cron add
 add_action('wp_head','highlight_js'); //slg-core.php
 