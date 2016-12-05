<?php

/**
 * Initialize the plugin by grabbing the userId and siteId
 *
 * @since 2.0
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_init() {
  global $eagerBugsnag;
  $wpUser = wp_get_current_user();

  $userId = eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_user_id();
  $siteId = eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_site_id();

  $eagerBugsnag = new Bugsnag_Client("cd1360e2ca678d5fe9518ec2079c8133");
  $eagerBugsnag->setAppVersion(EAGER_EagerWordpressBasePlugin_cms_v2_1_pace_VERSION);
  $eagerBugsnag->setAutoNotify(FALSE);
  $eagerBugsnag->setType('wordpress');

  $eagerBugsnag->setUser(array(
    'id'      =>  $userId,
    'siteId'  =>  $siteId,
    'email'   =>  $wpUser->user_email
  ));

  $eagerBugsnag->setMetaData(array(
    'appAlias'   =>  'pace',
    'appId'      =>  'kYKTiQjoVjQk'
  ));
}

/**
 * Create the site in the Eager API
 *
 * @since 2.0
 * @return string $siteId
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_create_site(){
  global $eagerBugsnag;

  $userId = eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_user_id();
  if ($userId == '!EXISTS'){
    return '';
  }

  $url = "https://api.eager.io/sites/register/cms";
  $body = array(
    'homepageURL' => home_url(),
    'metadata' => array(
      'cms' => 'wordpress',
    ),
    'userId' => $userId,
    'title' => get_option('blogname'),
  );

  $resp = wp_remote_post($url, array(
    'headers' => array(
      'Content-Type' => 'application/json',
      'Authorization' => eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_token(),
    ),
    'body' => json_encode($body),
  ));

  if (is_wp_error($resp) || $resp['response']['code'] >= 400) {
    $meta = is_array($resp) ? $resp : array('errors' => $resp->errors, 'error_data' => $resp->error_data);
    error_log("Error creating Eager site:\n" . print_r($resp, true));
    $eagerBugsnag->notifyError('create_site', 'Error creating Eager site', $meta, 'error');
    wp_die(__('Error creating Eager site') . ' (' . $resp['response']['code'] . ')');
    return;
  } else {
    $site = json_decode($resp['body'], true);
  }

  update_option('eager_site_id', $site['id']);

  return $site['id'];
}

/**
 * Fetch all installs from Eager API
 *
 * @since 2.0
 * @return array $installs
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_installs(){
  global $eagerBugsnag;

  $siteId = eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_site_id();

  // If no siteId, user needs to log in first, so return NULL
  if (!$siteId) {
    return NULL;
  }

  $url = "https://api.eager.io/sites/" . $siteId . "/installs";
  $resp = wp_remote_get($url, array(
    'headers' => array(
      'Authorization' => eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_token(),
    ),
  ));

  if (is_wp_error($resp) || $resp['response']['code'] >= 400) {
    $meta = is_array($resp) ? $resp : array('errors' => $resp->errors, 'error_data' => $resp->error_data);
    $eagerBugsnag->notifyError('get_installs', 'Error loading Eager installs', $meta, 'error');
    error_log("Error loading Eager installs:\n" . print_r($resp, true));
    $installs = NULL;
  } else {
    $installs = json_decode($resp['body'], true);
  }

  return $installs;
}

/**
 * Uninstall app
 *
 * Ensures the app is active and not pending, then calls helper function to delete from API
 *
 * @param string $appId The ID of the app to uninstall
 * @since 2.0
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_uninstall_app($appId){
  $installs = eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_installs();

  foreach ($installs as $install) {
    if ($install['appId'] == $appId && $install['active'] && !$install['pending']){
      eager_EagerWordpressBasePlugin_cms_v2_1_pace_delete_install($install['id']);
    }
  }
}

/**
 * Uninstall ALL apps through Eager API
 *
 * @since 2.0
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_uninstall_all_apps(){
$installs = eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_installs();

  foreach ($installs as $install) {
    if ($install['active'] && !$install['pending']){
      return eager_EagerWordpressBasePlugin_cms_v2_1_pace_delete_install($install['id']);
    }
  }
}

/**
 * Helper function that deletes app installs from Eager API
 *
 * @since 2.0
 * @param string $installId ID of the install to delete
 * @return boolean
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_delete_install($installId){
  global $eagerBugsnag;

  $url = "https://api.eager.io/installs/" . $installId;
  $resp = wp_remote_request($url, array(
    'method' => 'DELETE',
    'headers' => array(
      'Authorization' => eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_token(),
    ),
  ));

  if (is_wp_error($resp) || $resp['response']['code'] >= 400) {
    $meta = is_array($resp) ? $resp : array('errors' => $resp->errors, 'error_data' => $resp->error_data);
    $eagerBugsnag->notifyError('delete_install', 'Error deleting Eager install', $meta, 'error');
    error_log("Error loading deleting Eager install:\n" . print_r($resp, true));
    wp_die(__('Error loading deleting Eager install') . ' (' . $resp['response']['code'] . ')');
    return;
  }

  return true;
}

/**
 * Create the user
 *
 * If the user already exists, we return !EXISTS and force the user to login.
 *
 * @since 2.0
 * @return string $userId
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_create_user(){
  global $eagerBugsnag;

  $wpUser = wp_get_current_user();

  $url = "https://api.eager.io/user/register/cms";
  $body = array(
    'metadata' => array(
      'cms' => 'wordpress',
      'cmsURL' => home_url(),
    ),
    'email' => $wpUser->user_email
  );

  if ($wpUser->first_name) {
    $body['firstName'] = $wpUser->first_name;
      if ($wpUser->last_name) {
          $body['lastName'] = $wpUser->last_name;
      }
  } else {
     $body['firstName'] = $wpUser->user_login != 'admin' ? $wpUser->user_login : 'Wordpress Admin';
  }

  $resp = wp_remote_post($url, array(
    'body' => json_encode($body),
    'headers' => array(
      'Content-Type' => 'application/json',
    ),
  ));

  if (!is_wp_error($resp))
    $body = json_decode($resp['body'], true);

  if (is_wp_error($resp) || $resp['response']['code'] >= 400) {
    if (!is_wp_error($resp) && $resp['response']['code'] == 409 && $body['error']['code'] == 'dup-email'){
      return '!EXISTS';
    }
    $meta = is_array($resp) ? $resp : array('errors' => $resp->errors, 'error_data' => $resp->error_data);
    $eagerBugsnag->notifyError('create_user', 'Error creating Eager user', $meta, 'error');
    error_log("Error creating Eager user:\n" . print_r($resp, true));
    wp_die(__('Error creating Eager user') . ' (' . $resp['response']['code'] . ')');
    return;
  }
    
  update_option('eager_user_id', $body['user']['id']);
  update_option('eager_access_token', $body['token']['token']);

  return $body['user']['id'];
}

/**
 * Get siteId
 *
 * If it exists in the database, retrieve it. If not, we need to create the site.
 *
 * @since 2.0
 * @return string $siteId
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_site_id(){
  $siteId = get_option('eager_site_id');

  if (!$siteId){
    $siteId = eager_EagerWordpressBasePlugin_cms_v2_1_pace_create_site();
  }

  return $siteId;
}

/**
 * Get userId
 *
 * If it exists in the database, retrieve it. If not, we need to create the user.
 *
 * @since 2.0
 * @return string $userId
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_user_id(){
  $userId = get_option('eager_user_id');

  if (!$userId){
    $userId = eager_EagerWordpressBasePlugin_cms_v2_1_pace_create_user();
  }

  return $userId;
}

/**
 * Retrieve token from DB
 *
 * Ensure the user is logged in first
 *
 * @since 2.0
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_token(){
  eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_user_id();
  
  return get_option('eager_access_token');
}

/**
 * Transfer the site to current user
 *
 * @since 2.0
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_transfer_site($destUserId){
  global $eagerBugsnag;

  $url = "https://api.eager.io/site/" . eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_site_id() . "/transfer";
  $body = array(
    'destinationUserId' => $destUserId,
  );

  $resp = wp_remote_post($url, array(
    'body' => json_encode($body),
    'headers' => array(
      'Content-Type' => 'application/json',
      'Authorization' => eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_token(),
    ),
  ));

  if (is_wp_error($resp) || $resp['response']['code'] >= 400) {
    $meta = is_array($resp) ? $resp : array('errors' => $resp->errors, 'error_data' => $resp->error_data);
    $eagerBugsnag->notifyError('transfer_site', 'Error transferring Eager site', $meta, 'error');
    error_log("Error transferring Eager site:\n" . print_r($resp, true));
    wp_die(__('Error transferring Eager site') . ' (' . $resp['response']['code'] . ')');
    return;
  }
}

