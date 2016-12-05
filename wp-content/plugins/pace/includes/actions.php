<?php

/**
 * Actions registered in approximate loading order by WordPress (apparently this isn't always 100% exact)
 *
 * @see https://codex.wordpress.org/Plugin_API/Action_Reference
 */
add_action('plugins_loaded', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_hook', EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_PRIORITY);
add_action('init', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_resource_cleanup', EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_PRIORITY);
add_action('admin_enqueue_scripts', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_plugins_page', EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_PRIORITY);
add_action('activated_plugin', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_activated', EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_PRIORITY);
add_action('wp_ajax_eager_save_login', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_save_login_callback', EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_PRIORITY);

/**
 * Fire up the plugin
 * 
 * @since 2.0
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_hook() {
  if (eager_EagerWordpressBasePlugin_cms_v2_1_pace_load()) {
    eager_EagerWordpressBasePlugin_cms_v2_1_pace_init();
    add_action('admin_init', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_admin_init', EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_PRIORITY);
  }
}

/**
 * Remove resources added by outdated plugin(s)
 *
 * In order to prevent conflicts between old versions of the plugin (1.3.4.0 and below), we need to remove resources
 * created by those older versions (menu pages, css, js). The remove_menu_page function only removes the menu item but
 * doesn't actually remove the page itself, which causes conflicts (as one would expect). Therefore, we need to
 * remove all items with a priority of 10 that have 'eager' in the name. The priority of 10 is important -
 * that's the default we used when creating menu items in older versions of the plugin. All current and future
 * versions of the plugin have a priority equal to 10 * version (so 21 for version 2.1, etc). This ensures that going
 * forward we can target any resources directly based on version.
 * 
 * @since 2.0
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_resource_cleanup() {
  if (is_admin()) {
    global $wp_filter;

  /**
   *  Eager-Drift 1.2.0.0 and below add an activation menu that the user must opt-in to first, which then installs
   *  eager-base and enables the drift app. We need to make sure we don't remove those menu pages, so they're
   *  manually added to the $protected array
   */
    $protected = array(
      'eager_l1tqJOSJSjRIVtnl_menu',  // 1.0.0
      'eager_qh1p57tvykLvFoLN_menu',  // 1.1.1.0
      'eager_nJtaE7BB6176fAoS_menu',  // 1.1.2.0
      'eager_K8BLLjglmxKfYPot_menu',  // 1.1.4.0
      'eager_RZ66HWwDxPLs4Mx3_menu',  // 1.2.0.0
    );

    foreach ($wp_filter['admin_menu'][10] as $key => $menu) {
      if (strpos($key, 'eager') !== FALSE && !in_array($key, $protected)) {
        unset($wp_filter['admin_menu'][10][$key]);
      }
    }

    foreach ($wp_filter['admin_init'][10] as $key => $menu) {
      if (strpos($key, 'eager') !== FALSE) {
        unset($wp_filter['admin_init'][10][$key]);
      }
    }

  }
}

/**
 * Load the admin menu or embed script
 *
 * If on admin page, add the plugin to the global array of active plugins (for generating the menu items later). We
 * also need to do a little work to determine if the current plugin is the highest version so that we ensure the
 * highest version of the plugin loads its menu and resources.
 *
 * If not on an admin page, we load the embed script so that Eager can do it's magic.
 *
 * @since 2.0
 * @return boolean
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_load() {
  // if we're on an admin page
  if (is_admin()){
    global $eagerActivePlugins;
    global $eagerHighestVersion;

    $eagerActivePlugins[EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_ID] = array(
      'title' => "PACE",
      'pluginTitle' => "Automatic Page Load Progress Bar by PACE - Make Your Site Feel Faster"
    );

    // If this plugin version is lower than a previously loaded plugin, no need to continue
    if (isset($eagerHighestVersion) && $eagerHighestVersion > EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_VERSION) {
      return;
    }

    $eagerHighestVersion = EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_VERSION;

    $optin = get_option('eager_optin');
    $priority = EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_PRIORITY;

    // Show opt-in page/menu if user hasn't opted in to Eager yet
    if (!$optin) {
      add_action('admin_menu', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_activation_menu', $priority);
    } else {
      add_action('admin_menu', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_base_menu', $priority);
    }

    return true;

  } else {
    // non admin page - embed the eager code so apps display on site
    require_once(EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_DIR . 'includes/embed.php');
  }

}

/**
 * Triggered after plugin activation
 *
 * @since 2.0
 * @param string $plugin Filename of the plugin, including plugin folder
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_activated($plugin) {
  if (strpos($plugin, 'pace') === FALSE) {
    return;
  }

  $optin = get_option('eager_optin');
  $url = '';
  if (!$optin) {
    $url = "admin.php?page=eager_EagerWordpressBasePlugin_cms_v2_1_pace_optin_handle";
  } else {
    $url = "admin.php?page=eager_app_" . EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_ID . "_options";
  }
  exit(wp_redirect(admin_url($url)));
}


/**
 * Register css and js resources
 * 
 * Similar to how we handle creating the menu, we want to make sure only the latest version of the plugin loads it's 
 * resources, and that it only happens once.
 * 
 * @since 2.0
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_admin_init() {
  global $eagerAdminInit;
  global $eagerHighestVersion;

  // Don't add duplicate resources & ensure highest version of plugin adds resources
  if ($eagerAdminInit || ($eagerHighestVersion > EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_VERSION)) {
    return;
  }

  $eagerAdminInit = true;

  wp_register_style('eager_css', EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_URL.'styles/main.css');
  wp_enqueue_style('eager_css');

  wp_register_script('eager_js', EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_URL.'scripts/main.js');
  wp_enqueue_script('eager_js');

  wp_register_script('eager_override_js', 'https://cms-br-' . EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_VERSION_STRING . '.eager.io/js/override.js');
  wp_enqueue_script('eager_override_js');
}

/**
 * Triggered on deactivation
 * 
 * @since 2.0
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_deactivation() {
  global $eagerActivePlugins;

  if ($eagerActivePlugins == null) {
    return;
  }

  // If this is the last active eager plugin, delete all installs
  if (count($eagerActivePlugins) == 1) {
    eager_EagerWordpressBasePlugin_cms_v2_1_pace_uninstall_all_apps();
  } else {
    eager_EagerWordpressBasePlugin_cms_v2_1_pace_uninstall_app(EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_ID);
  }

}


/**
 * Callback triggered from CMS api to save login info
 *
 * @since 2.0
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_save_login_callback() {
  $data = json_decode(stripslashes($_POST['body']), true);

  if ($data == null){
    status_header(500);
    wp_die("Error reading JSON data");
  } else {
    check_ajax_referer('eager_options_nonce', 'csrf_token');

    if ($data['reset']){
      delete_option('eager_site_id');
      delete_option('eager_user_id');
      delete_option('eager_access_token');
      wp_die("Cleared");
      return;
    }

    $existingToken = get_option('eager_access_token');
    $existingSiteId = get_option('eager_site_id');
    if ($existingSiteId && $existingToken){
      eager_EagerWordpressBasePlugin_cms_v2_1_pace_transfer_site($data['user']['id']);
      } else if ($existingSiteId){
      delete_option('eager_site_id');
    }

    update_option('eager_user_id', $data['user']['id']);
    update_option('eager_access_token', $data['token']['token']);

    wp_die("Saved");
  }
}
