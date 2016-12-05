<?php

/**
 * Install app page
 *
 * Where the user is taken when they click "preview" from list-apps page. Doesn't appear in the menu.
 *
 * @since 2.0
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_install_app_page() {
  if ( !isset($_GET['appId']) ) {
    $url = admin_url("admin.php?page=eager_options_handle");
    echo '<script>window.location = "' . $url . '";</script>';
    return;
  }

  if (!current_user_can('activate_plugins'))  {
    wp_die(__('You do not have sufficient permissions to access this page.'));
  }

  $appId = $_GET['appId'];

  $ip = gethostbyname($_SERVER['SERVER_NAME']);

  echo '<div class="wrap">';
  echo '<eager-options cms-name="wordpress" site-id="' . eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_site_id() . '" user-id="' . eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_user_id() . '" 
  token="' . eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_token() . '" app-id="' . $appId . '" version="'. EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_VERSION_STRING
.'"</eager-options>';
  echo '<script src="https://cms-br-' . EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_VERSION_STRING . '.eager.io/js/options.js"></script>';
  echo '</div>';
}


/**
 * Eager settings page
 *
 * @since 2.0
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_options_page() {
  if (!current_user_can('activate_plugins'))  {
    wp_die(__('You do not have sufficient permissions to access this page.'));
  }

  $userId = eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_user_id();
  $siteId = eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_site_id();
  $token = eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_token();

  $csrfToken = wp_create_nonce('eager_options_nonce');

  echo '<div class="wrap">';
  echo '<eager-cms-settings cms-name="wordpress" user-id="'.$userId.'" site-id="'.$siteId.'" token="'.$token.'" 
  csrf-token="'.$csrfToken.'" version="'. EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_VERSION_STRING .'"></eager-cms-settings>';
  echo '<script src="https://cms-br-' . EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_VERSION_STRING . '.eager.io/js/settings.js"></script>';
  echo '</div>';
}


/**
 * App options page
 *
 * @since 2.0
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_app_options_page($args) {
  global $plugin_page;
  
  $matches = null;
  if (!preg_match("/eager_app_([a-zA-Z0-9\-_]+)_options/", $plugin_page, $matches)){
    wp_die("Plugin page not understood");
    return;
  }

  $id = $matches[1];

  if (!current_user_can('activate_plugins'))  {
    wp_die(__('You do not have sufficient permissions to access this page.'));
  }

  $ip = gethostbyname($_SERVER['SERVER_NAME']);

  echo '<div class="wrap">';
  echo '<eager-options cms-name="wordpress" site-id="' . eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_site_id() . '" user-id="' . eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_user_id() . '" 
  token="' . eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_token() . '" app-id="' . $id . '" version="'. EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_VERSION_STRING
.'"></eager-options>';
  echo '<script src="https://cms-br-' . EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_VERSION_STRING . '.eager.io/js/options.js"></script>';
  echo '</div>';
}

/**
 * List apps page
 *
 * @since 2.0
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_list_apps_page(){
  $userId = eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_user_id();
  $siteId = eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_site_id();
  $token = eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_token();

  if ($userId == '!EXISTS') {
    $csrfToken = wp_create_nonce('eager_options_nonce');

    echo '<div class="wrap">';
    echo '<eager-cms-settings cms-name="wordpress" user-id="'.$userId.'" site-id="'.$siteId.'" token="'.$token.'" 
    csrf-token="'.$csrfToken.'" version="'. EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_VERSION_STRING .'"></eager-cms-settings>';
    echo '<script src="https://cms-br-' . EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_VERSION_STRING . '.eager.io/js/settings.js"></script>';
    echo '</div>';

  } else {
    global $eagerMinimalMenu;
    $hideCms = $eagerMinimalMenu ? 'true' : 'false';

    echo '<div class="wrap">';
    echo '<eager-list-apps cms-name="wordpress" site-id="' . $siteId . '" user-id="' . $userId . '" token="' . $token . '" version="'.
      EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_VERSION_STRING .'" can-hide-cms="'. $hideCms .'"></eager-list-apps>';
    echo '<script src="https://cms-br-' . EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_VERSION_STRING . '.eager.io/js/listApps.js"></script>';
    echo '</div>';
  }

}

/**
 * View app page
 *
 * @since 2.0
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_view_app_page() {
  if ( !isset($_GET['appId']) ) {
    $url = admin_url("admin.php?page=eager_options_handle");
    echo '<script>window.location = "' . $url . '";</script>';
    return;
  }

  if (!current_user_can('activate_plugins'))  {
    wp_die(__('You do not have sufficient permissions to access this page.'));
  }

  $appId = $_GET['appId'];

  echo '<div class="wrap">';
  echo '<eager-view-app cms-name="wordpress" site-id="' . eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_site_id() . '" user-id="' . eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_user_id() . '" 
  token="' . eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_token() . '" app-id="' . $appId . '" version="'. EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_VERSION_STRING
.'"></eager-view-app>';
  echo '<script src="https://cms-br-' . EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_VERSION_STRING . '.eager.io/js/viewApp.js"></script>';
  echo '</div>';
}


/**
 * Opt-in page
 *
 * @since 2.0
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_optin_page() {
  if (!current_user_can('activate_plugins'))  {
    wp_die(__('You do not have sufficient permissions to access this page.'));
  }
  echo <<<HTML
    <style>
      .eager-confirm {
        font-family: "proxima-nova", "Helvetica Neue", Helvetica, Arial, sans-serif;
        padding-top: 15px;
      }
      .eager-confirm a {
        color: #e90f92;
        text-decoration: none;
        -webkit-tap-highlight-color: transparent;
      }
      .eager-confirm a:hover, .eager-confirm a:active {
        color: #ba0c75;
      }
      .eager-confirm-intro {
        float: left;
        margin: 0 0 1em 1em;
      }
      .eager-confirm-intro h1 {
        margin: 12px 0;
      }
      .eager-confirm-logo {
        height: 72px;
        float: left;
      }
      .eager-inline-text {
        display: inline;
        line-height: 28px;
        padding-left: 10px;
      }
        
      .eager-privacy-info {
        clear: both;
        padding: 1px 15px;
        max-width: 70em;
        background-color: rgba(255, 255, 255, 0.5);
      }
      .eager-privacy-info ul {
        list-style: disc inside;
      }
      .eager-privacy-info ul li {
        margin-bottom: 4px;
      }
      .eager-privacy-info ul, .eager-privacy-info p {
        font-size: 90%;
      }
    </style>
    <div class="eager-confirm">
      <img class="eager-confirm-logo" src="https://www.filepicker.io/api/file/E7eTycXrTTGpFBM1uU0S?h=144">
      <div class="eager-confirm-intro">
        <h1>Welcome to PACE!</h1>
        <p>Automatically show a progress bar when the page is loading.</p>
      </div>
      <div class="eager-privacy-info">
        <p>Please note that installing this app will share the following information with PACE and its service providers:</p>
        <ul>
          <li>Your Name
          <li>Your Email Address
          <li>Your Website’s URL
        </ul>
        <p>All information you share is covered by our Privacy Policy and we will never sell your email address or other personal information.</p>
      </div>
      <p>Would you like to finish installing PACE?</p>
      <a href="admin.php?page=eager_EagerWordpressBasePlugin_cms_v2_1_pace_activate_handle" class="button button-primary">Yes, Install PACE</a>
      <p class="eager-inline-text">
        (<a href="admin.php?page=eager_EagerWordpressBasePlugin_cms_v2_1_pace_deactivate_handle">Deactivate</a> the PACE plugin to decline)
      </p>
    </div>
HTML;
}

/**
 * Activation page
 *
 * User is taken here after opting-in in order to set the 'eager_optin' option in the database, then redirected to
 * the Eager settings page.
 *
 * @since 2.0
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_activate_page() {
  global $eagerBugsnag;

  $optin = update_option('eager_optin', 'true');
  if ($optin) {
    $url = admin_url("admin.php?page=eager_app_" . EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_ID . "_options");
    echo '<h1>Awesome!</h1>';
    echo '<h3>Taking you to the PACE configuration now...</h3>';
    echo '<script>window.location = "' . $url . '";</script>';
  } else {
    $eagerBugsnag->notifyError('activate_plugin', 'Error activating plugin after opt-in.', null, 'error');
    wp_die('There was an error when trying to install the Eager plugin. You can reload this page to try again. If this error persists, please contact Eager at help@eager.io.');
  }
}

/**
 * Plugin deactivation page
 *
 * If user decides not to opt in, the plugin is deactivated and they're redirected back to the plugins page
 *
 * @since 2.0
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_deactivate_page() {
  $plugin = 'eager-pace/base.php';
    if (is_plugin_active($plugin)) {
      deactivate_plugins($plugin);
    }
    $url = admin_url('plugins.php');
    add_settings_error(
      'eager_app_deactivated',
      esc_attr( 'eager_app_deactivated' ),
      'PACE successfully deactivated. Redirecting you to plugins page now...',
      'updated'
    );
    echo settings_errors();
    echo '<script>window.location = "' . $url . '";</script>';
}

/**
 * Embed some javascript on the plugins page
 *
 * We want to warn the user that deactivating the last active eager plugin would uninstall ALL installed Eager apps
 * on their site. Embedding this javascript allows us to have access to the installed eager apps immediately upon
 * page load (as opposed to using an AJAX request)
 *
 * @since 2.0
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_plugins_page($hook) {
  if ($hook !== 'plugins.php') {
    return;
  }

  global $eagerActivePlugins;
  $installs = eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_installs();

  $data = array(
    "plugins" => $eagerActivePlugins,
    "installs" => $installs
  );

  $data = json_encode($data);

  echo <<<SCRIPT
  <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
      var data = $data
      var installs = data.installs;
      var plugins = data.plugins;
      if (installs.length) {
        var installedApps = '';
        for (var i = 0; i < installs.length; i++) {
          installedApps += installs[i].app.title + '\\n';
        }
  
        // Get an array of all the active plugins
        var activePlugins = [];
  
        for (var appId in plugins) {
          var title;
          if (!plugins[appId].pluginTitle) {
            // Used for any plugins version 1.3.4.0 and below
            title = plugins[appId].title;
          } else {
            title = plugins[appId].pluginTitle;
          }
          title = title.toLowerCase().split(' ').join('-');
          var active = document.querySelector(".active[id*='" + title + "'] .deactivate a");
          
          // For WP 4.5.2 and newer
          if (!active) {
            active = document.querySelector(".active[data-slug*='" + title + "'] .deactivate a");
          }
          
          activePlugins.push(active)
        }
  
        // Only alert the user if there is just one active Eager plugin remaining
        if (activePlugins.length === 1) {
          activePlugins[0].addEventListener("click", function(e) {
            var confirmed = confirm("By deactivating this Eager plugin, you'll be deactivating the following Eager apps: \\n\\n" + installedApps + "\\nAre you sure you want to do this?");
            if (!confirmed) {
              e.preventDefault();
            }
          });
        }
  
      }
    });
  </script>
SCRIPT;

}
/**
 * Remove the list-apps page/menu item
 *
 * By setting the option in the database accordingly, the menu item won't be created. Do nothing if we're not using a minimal menu
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_remove_list_apps_page() {
  global $eagerMinimalMenu;

  if ($eagerMinimalMenu) {
    update_option('eager_hide_list_apps', true);
    $url = admin_url("admin.php?page=eager_app_kYKTiQjoVjQk_options");
  } else {
    $url = admin_url("admin.php?page=eager_options_handle");
  }

  echo '<h1>Removing Eager...</h1>';
  echo '<script>window.location = "' . $url . '";</script>';
  return;

}
