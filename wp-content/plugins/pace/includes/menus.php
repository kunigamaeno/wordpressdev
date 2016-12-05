<?php

/**
 * Display activation/opt-in page & menu
 *
 * @since 2.0
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_activation_menu() {
  add_menu_page('Eager Opt In', 'Install PACE', 'activate_plugins', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_optin_handle', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_optin_page');
  add_submenu_page(null, 'Eager Activate', 'Eager Activate', 'activate_plugins', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_activate_handle', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_activate_page');
  add_submenu_page(null, 'PACE Deactivate', 'PACE Deactivate', 'activate_plugins', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_deactivate_handle', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_deactivate_page');
}


/**
 * Display base menu
 *
 * Make sure the latest version of the plugin creates the menu, and that it only does it once. If only one plugin and
 * app is installed, display the minimal version of the menu. Otherwise, display the full version.
 *
 * @since 2.0
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_base_menu() {
  global $eagerActivePlugins;
  global $eagerActiveApps;
  global $eagerMenuActivated;
  global $eagerHighestVersion;
  global $eagerMinimalMenu;

  // Don't create duplicate menus & ensure highest version of plugin creates the menu
  if ($eagerMenuActivated || ($eagerHighestVersion > EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_VERSION)) {
    return;
  }

  $eagerMenuActivated = true;

  // $eagerActiveApps is only used version 1.3.4.0 and below, but needs to be merged to support any plugins using it
  if (count($eagerActiveApps)) {
    $eagerActivePlugins = array_merge($eagerActivePlugins, $eagerActiveApps);
  }

  $installs = eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_installs();

  $uninstalledApps = $eagerActivePlugins;
  if ($uninstalledApps == null) {
    $uninstalledApps = array();
  }

  $eagerMinimalMenu = true;

  if ($installs){
    foreach ($installs as $install) {
      unset($uninstalledApps[$install['app']['id']]);
      unset($uninstalledApps[$install['app']['alias']]);
      if ($install['app']['id'] !== 'kYKTiQjoVjQk') {
        $eagerMinimalMenu = false;
      }
    }
  }

  if (count($eagerActivePlugins) > 1) {
    $eagerMinimalMenu = false;
  }

  if ($eagerMinimalMenu) {
    add_menu_page('PACE', 'PACE', 'activate_plugins', 'eager_app_kYKTiQjoVjQk_options', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_app_options_page');

    if (!get_option('eager_hide_list_apps')) {
      add_menu_page('Eager Apps', 'Add More Apps', 'activate_plugins', 'eager_options_handle', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_list_apps_page');
    } else {
      add_submenu_page(NULL, 'Add Eager App', '+ Browse Apps', 'activate_plugins', 'eager_options_handle', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_list_apps_page');
    }

    add_submenu_page(null, 'Install App', 'Install App', 'activate_plugins', 'eager_install_app_handle', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_install_app_page');
    add_submenu_page(null, 'View App', 'View App', 'activate_plugins', 'eager_view_app', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_view_app_page');
  } else {
    add_menu_page('Eager Apps', 'Eager App Store', 'activate_plugins', 'eager_options_handle', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_options_page');
    foreach ($uninstalledApps as $appId => $app) {
      add_submenu_page('eager_options_handle', $app['title'], $app['title'] . ' (inactive)', 'activate_plugins',  'eager_app_'.$appId.'_options', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_app_options_page');
    }

    if ($installs){
      foreach ($installs as $install) {
        add_submenu_page('eager_options_handle', $install['app']['title'], $install['app']['title'], 'activate_plugins',  'eager_app_'.$install['appId'].'_options', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_app_options_page');
      }
    }

    add_submenu_page('eager_options_handle', 'Add Eager App', '+ Browse Apps', 'activate_plugins', 'eager_list_apps', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_list_apps_page');

  }

  add_submenu_page(null, 'Install App', 'Install App', 'activate_plugins', 'eager_install_app_handle', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_install_app_page');
  add_submenu_page(null, 'View App', 'View App', 'activate_plugins', 'eager_view_app', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_view_app_page');
  add_submenu_page(null, 'Remove Eager', 'Remove Eager', 'activate_plugins', 'eager_remove_list_apps', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_remove_list_apps_page');

}

?>
