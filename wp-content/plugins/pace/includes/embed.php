<?php
/**
 * Embed the Eager script on non admin pages
 *
 * @since 2.0
 */
function eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_embed_html() {
  if (!is_admin()){
    $host = "fast.eager.io";

    if ($_GET['__eager_embed']){
      add_filter('show_admin_bar', '__return_false');

      $host = "fast-direct.eager.io";

      echo <<<HTML
        <script>
          if (window.parent && window.parent.postMessage){
            window.parent.postMessage({type: "eager-proxy:loaded", info: {}}, "*")
          }
        </script>
HTML;
    }

    echo '<script data-cfasync="false" data-pagespeed-no-defer src="//' . $host . '/' . eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_site_id() . '.js"></script>';
  }
}

if (!$GLOBALS['eagerEmbedBound'])
  add_action('wp_head', 'eager_EagerWordpressBasePlugin_cms_v2_1_pace_get_embed_html');

$GLOBALS['eagerEmbedBound'] = true;
?>
