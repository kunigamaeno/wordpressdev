<?php
/*
Plugin Name: Automatic Page Load Progress Bar by PACE - Make Your Site Feel Faster
Description: Automatically show a customizable progress bar while your site is loading. This is the official plugin, created by the PACE maintainers.
Version: 1.0.0.0
Author: EagerApps
Author URI: https://eager.io/app/pace
Plugin URI: https://eager.io/app/pace
*/

define('EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_VERSION', '2.1');
define('EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_VERSION_STRING', 'v2-1');
define('EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_PRIORITY', EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_VERSION * 10);
define('EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_DIR', plugin_dir_path(__FILE__));
define('EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_URL', plugin_dir_url(__FILE__));
define('EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_ID', 'kYKTiQjoVjQk');

if (!class_exists('Bugsnag_Client')) {
  require_once(EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_DIR . 'includes/Bugsnag/Autoload.php');
}

require_once(EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_DIR . 'includes/core.php');
require_once(EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_DIR . 'includes/actions.php');
require_once(EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_DIR . 'includes/pages.php');
require_once(EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_DIR . 'includes/menus.php');

register_deactivation_hook(__FILE__, 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_deactivation');
