<?php

add_action( 'widgets_init', 'codesnippets_widgets' );
function codesnippets_widgets() {
/* <?php dynamic_sidebar( 'sidebar-head-t' ); ?> */
register_sidebar( array(
	'id' => 'sidebar-head-t','name' => __( 'sidebar-head-t', 'generic' ),
	)   );
register_sidebar( array(
	'id' => 'sidebar-head-b', 'name' => __( 'sidebar-head-b', 'generic' ),
	)   );

register_sidebar( array(
	'id' => 'sidebar-body-t','name' => __( 'sidebar-body-t', 'generic' ),
	)		);
register_sidebar(		array(
	'id' => 'sidebar-body-b', 'name' => __( 'sidebar-body-b', 'generic' ),
	)		);

register_sidebar(		array(
	'id' => 'sidebar-footer-t',	'name' => __( 'sidebar-footer-t', 'generic' ),
	)		);
register_sidebar(		array(
	'id' => 'sidebar-footer-b',	'name' => __( 'sidebar-footer-b', 'generic' ),
	)		);
}


function wp_cs_fasthead()
{
$s = <<< EOF
<!-- s wp_cs_fasthead() -->
    <!--<link href="https://slg-kunigamaeno.c9users.io/wp-content/themes/codesnippet/pak/lib/normalize.min.css" rel="stylesheet">-->
    <link href="https://slg-kunigamaeno.c9users.io/wp-content/themes/codesnippet/pak/cht-scroll.css" rel="stylesheet">
    <link href="https://slg-kunigamaeno.c9users.io/wp-content/themes/codesnippet/pak/lib/bootstrap.min.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="https://slg-kunigamaeno.c9users.io/wp-content/themes/codesnippet/pak/lib/highlight.github.min.css">-->
<!-- e wp_cs_fasthead() -->
EOF;
return $s;

}

function wp_cs_latefooter()
{
$s =<<< EOF
<!-- s wp_cs_latefooter() -->

<script src="https://slg-kunigamaeno.c9users.io/wp-content/themes/codesnippet/pak/lib/split.min.js" type="text/javascript"></script>

<script src="https://slg-kunigamaeno.c9users.io/wp-content/themes/codesnippet/pak/lib/nanobar.min.js" type="text/javascript"></script>
<script src="https://slg-kunigamaeno.c9users.io/wp-content/themes/codesnippet/pak/lib/clipboard.min.js" type="text/javascript"></script>

<script src="https://slg-kunigamaeno.c9users.io/wp-content/themes/codesnippet/pak/codesnippet.js" type="text/javascript"></script>

<!-- <script src="https://slg-kunigamaeno.c9users.io/wp-content/themes/codesnippet/pak/lib/highlight.min.js"></script> -->

<!-- wp_cs_latefooter() -->
EOF;
return $s;

/*
*/

}

 //
 require_once( get_template_directory() . '/pak/cht-functions.php' );
 cht_init();
 //
