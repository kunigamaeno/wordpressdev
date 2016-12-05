<?php function arzine_custom_header_setup() {
    $args = array(
        'default-text-color' => '515151',
        'default-image' => '',
        'height' => 250,
        'width' => 960,
        'max-width' => 2000,
        'flex-height' => true,
        'flex-width' => true,
        'random-default' => false,
        'wp-head-callback' => 'arzine_header_style',
        'admin-head-callback' => 'arzine_admin_header_style',
        'admin-preview-callback' => 'arzine_admin_header_image',
    );
    add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'arzine_custom_header_setup' );

function arzine_header_style() {
    $text_color = get_header_textcolor();
    if ( $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
        return; ?>
    <style type="text/css">
        <?php if ( ! display_header_text() ) : ?>
            .blog-title,
            .site-description {
                position: absolute !important;
                clip: rect(1px 1px 1px 1px); /* IE7 */
                clip: rect(1px, 1px, 1px, 1px);
            }
        <?php else : ?>
            .blog-title a,
            .site-description {
                color: #<?php echo $text_color; ?> !important;
            }
        <?php endif; ?>
    </style>
    <?php }

function arzine_admin_header_style() { ?>
    <style type="text/css">
        .appearance_page_custom-header #headimg {
            border: 0;
        }

        #headimg h1, 
        #headimg h2 {
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        #headimg h1 {
            font-size: 30px;
        }

        #headimg h1 a,
        #headimg h1 a:visited {
            color: #111111;
            text-decoration: none;
        }

        #headimg h1 a:hover {
            color: #444444;
        }

        #headimg h2 {
            color: #333333;
            font: normal 16px/1.8 Open Sans, verdana, sans-serif;
            margin-bottom: 24px;
        }

        #headimg img {
            max-width: <?php echo get_theme_support( 'custom-header', 'max-width' ); ?>px;
        }
    </style>
<?php }

function arzine_admin_header_image() { ?>
    <div id="headimg">
        <?php if ( ! display_header_text() )
            $style = ' style="display:none;"';
        else 
            $style = ' style="color:#' . get_header_textcolor() . ';"'; ?>
            <h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
            <h2 id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></h2>
            <?php $header_image = get_header_image();
        if ( ! empty( $header_image ) ) : ?>
            <img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
        <?php endif; ?>
    </div>
<?php }