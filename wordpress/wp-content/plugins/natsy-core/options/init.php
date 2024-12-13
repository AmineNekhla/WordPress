<?php

    if ( ! class_exists( 'CSF' ) ) {
        return;
    }

    $opt_name = NOVA_FRAMEWORK_VAR;

    $theme = wp_get_theme( NOVA_THEMESLUG );

    $footer_text = $theme->name.' v'.$theme->version.' by <a href="https://1.envato.market/nova-works" target="_blank">Nova-works</a>';


    CSF::createOptions( $opt_name, array(
    'framework_title'         => 'Natsy Theme Options <small>by Nova-works</small>',
    // menu settings
    'menu_title'              => 'Theme Options',
    'menu_slug'               => 'nova-theme-options',

    // menu extras
    'show_in_customizer'      => true,

    // footer
    'footer_text'             => $footer_text,
    'footer_credit'           => __('Thank you for creating with a product from <a href="https://1.envato.market/nova-works" target="_blank">Nova-works</a> themes.', 'natsy-core'),

    // contextual help
    'contextual_help' => array(
            array(
                'id'      => 'nova-help-tab-1',
                'title'   => __('Support', 'natsy-core'),
                'content' => __('<p>If you have any kind of problem with our theme options panel don\'t hesitate on contact us via our <a href="https://novaworks.ticksy.com/" target="_blank">Ticket System.</a></p>', 'natsy-core')
            ),
        ),
    'contextual_help_sidebar' => '',

    // typography options
    'enqueue_webfont'         => false,
    'async_webfont'           => false,

    // theme and wrapper classname
    'theme'                   => 'dark',

    ) );

    require_once('sections/site.php');
    require_once('sections/header.php');
    require_once('sections/footer.php');
    require_once('sections/styling.php');
    require_once('sections/typography.php');
    require_once('sections/blog.php');
    if(class_exists( 	'WooCommerce' )) {
      require_once('sections/shop.php');  
    }
    // require_once('sections/social-profiles.php');
    require_once('sections/social-share.php');
    require_once('sections/advanced-settings.php');
    require_once('sections/backup.php');
