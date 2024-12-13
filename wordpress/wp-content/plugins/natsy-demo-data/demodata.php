<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function nova_natsy_get_demo_array($dir_url, $dir_path){

    $demo_items = array(
        'demo-01' => array(
            'link'          => 'https://natsy.novaworks.net/',
            'title'         => 'Home',
            'data_sample'   => 'data.json',
            'data_product'  => 'products.csv',
            'data_widget'   => 'widget.json',
            'data_slider'   => 'home_v1.zip',
            'data_elementor'=> [
                'header'       => [
                    'location' => 'header',
                    'value' => [
                        'header-1' => 'include/general',
                    ],
                ],
                'footer'       => [
                    'location' => 'footer',
                    'value' => [
                        'footer-1' => 'include/general',
                    ],
                ],
            ],
            'category'      => array(
                'Demo',
	            'Sports'
            )
        ),
        'demo-02' => array(
            'link'          => 'https://natsy.novaworks.net/home-v2',
            'title'         => 'Home v2',
            'data_sample'   => 'data.json',
            'data_product'  => 'products.csv',
            'data_widget'   => 'widget.json',
            'data_slider'   => 'home-v2.zip',
            'data_elementor'=> [
                'header'       => [
                    'location' => 'header',
                    'value' => [
                        'header-1' => 'include/general',
                    ],
                ],
                'footer'       => [
                    'location' => 'footer',
                    'value' => [
                        'footer-1' => 'include/general',
                    ],
                ],
            ],
            'category'      => array(
                'Demo',
	            'Sports'
            )
        ),
        'demo-03' => array(
            'link'          => 'https://natsy.novaworks.net/home-v3',
            'title'         => 'Home v3',
            'data_sample'   => 'data.json',
            'data_product'  => 'products.csv',
            'data_widget'   => 'widget.json',
            'data_elementor'=> [
                'header'       => [
                    'location' => 'header',
                    'value' => [
                        'header-1' => 'include/general',
                    ],
                ],
                'footer'       => [
                    'location' => 'footer',
                    'value' => [
                        'footer-1' => 'include/general',
                    ],
                ],
            ],
            'category'      => array(
                'Demo',
	            'Sports'
            )
        ),
        'demo-04' => array(
            'link'          => 'https://natsy.novaworks.net/home-v4',
            'title'         => 'Home v4',
            'data_sample'   => 'data.json',
            'data_product'  => 'products.csv',
            'data_widget'   => 'widget.json',
            'data_elementor'=> [
                'header'       => [
                    'location' => 'header',
                    'value' => [
                        'header-1' => 'include/general',
                    ],
                ],
                'footer'       => [
                    'location' => 'footer',
                    'value' => [
                        'footer-1' => 'include/general',
                    ],
                ],
            ],
            'category'      => array(
                'Demo',
	            'Sports'
            )
        ),
        'demo-05' => array(
            'link'          => 'https://natsy.novaworks.net/home-v5',
            'title'         => 'Home v5',
            'data_sample'   => 'data.json',
            'data_product'  => 'furniture.csv',
            'data_widget'   => 'widget.json',
            'data_slider'   => 'home-v5.zip',
            'data_elementor'=> [
                'header'       => [
                    'location' => 'header',
                    'value' => [
                        'header-1' => 'include/general',
                    ],
                ],
                'footer'       => [
                    'location' => 'footer',
                    'value' => [
                        'footer-1' => 'include/general',
                    ],
                ],
            ],
            'category'      => array(
                'Demo',
	            'Sports'
            )
        ),
    );

    $default_image_setting = array(
        'woocommerce_single_image_width' => 1000,
        'woocommerce_thumbnail_image_width' => 700,
        'woocommerce_thumbnail_cropping' => 'custom',
        'woocommerce_thumbnail_cropping_custom_width' => 1000,
        'woocommerce_thumbnail_cropping_custom_height' => 1000
    );

    $default_menu = array(
        'nova_menu_primary'             => 'Main Menu',
    );

    $default_page = array(
        'page_for_posts' 	            => 'Blog',
        'woocommerce_shop_page_id'      => 'Shop',
        'woocommerce_cart_page_id'      => 'Cart',
        'woocommerce_checkout_page_id'  => 'Checkout',
        'woocommerce_myaccount_page_id' => 'My account'
    );

    $slider = $dir_path . 'Slider/';
    $content = $dir_path . 'Content/';
    $product = $dir_path . 'Product/';
    $widget = $dir_path . 'Widget/';
    $setting = $dir_path . 'Setting/';
    $preview = $dir_url;

    $default_elementor = [
        'archive'           => [
            'location' => 'archive',
            'value' => [
                '' => 'include/archive'
            ]
        ],
        'search-results'    => [
            'location' => 'archive',
            'value'    => '',
            'default' => [
                'name' => 'include/archive/search'
            ],
        ],
        'product'           => [
            'location' => 'single',
            'value' => [
                'single-product-01' => 'include/product'
            ]
        ],
        'product-archive'   => [
            'location' => 'archive',
            'value' => [
                'shop-left-sidebar' => 'include/product_archive'
            ]
        ],
    ];
    $elementor_kit_settings = json_decode('{"template":"default","space_between_widgets":{"column":"0","row":"0","isLinked":true,"unit":"px","size":0},"page_title_selector":"h1.entry-title","active_breakpoints":["viewport_mobile","viewport_mobile_extra","viewport_tablet","viewport_tablet_extra","viewport_laptop"],"viewport_mobile":767,"viewport_md":768,"viewport_mobile_extra":991,"viewport_tablet":1024,"viewport_tablet_extra":1279,"viewport_lg":1025,"viewport_laptop":1599,"system_colors":[{"_id":"primary","title":"Primary","color":"#BAF120"},{"_id":"secondary","title":"Secondary","color":"#13160B"},{"_id":"text","title":"Text","color":"#777777"},{"_id":"accent","title":"Border","color":"#E1E1E1"}],"system_typography":[{"_id":"primary","title":"Primary"},{"_id":"secondary","title":"Secondary"},{"_id":"text","title":"Text"},{"_id":"accent","title":"Accent"}],"colors_enable_styleguide_preview":"yes","custom_colors":[{"_id":"50356c0","title":"White","color":"#FFFFFF"}],"typography_enable_styleguide_preview":"yes","custom_typography":[],"default_generic_fonts":"Sans-serif","container_width":{"unit":"px","size":1440,"sizes":[]},"container_padding":{"unit":"px","top":"0","right":"0","bottom":"0","left":"0","isLinked":false},"activeItemIndex":1,"default_page_template":"elementor_header_footer"}', true);
    $data_return = array();

    foreach ($demo_items as $demo_key => $demo_detail){
	    $value = array();
	    $value['title']             = $demo_detail['title'];
	    $value['category']          = !empty($demo_detail['category']) ? $demo_detail['category'] : array('Demo');
	    $value['demo_preset']       = $demo_key;
	    $value['demo_url']          = $demo_detail['link'];
	    $value['preview']           = !empty($demo_detail['preview']) ? $demo_detail['preview'] : ($preview . $demo_key . '.jpg');
	    $value['content']           = !empty($demo_detail['data_sample']) ? $content . $demo_detail['data_sample'] : $content . 'sample-data.json';
	    $value['option']            = !empty($demo_detail['data_option']) ? $setting . $demo_detail['data_option'] : $setting . 'settings.json';
	    $value['product']           = !empty($demo_detail['data_product']) ? $product . $demo_detail['data_product'] : $product . 'sample-product.json';
	    $value['widget']            = !empty($demo_detail['data_widget']) ? $widget . $demo_detail['data_widget'] : $widget . 'widget.json';
	    $value['pages']             = array_merge( $default_page, array( 'page_on_front' => $demo_detail['title'] ));
	    $value['menu-locations']    = array_merge( $default_menu, isset($demo_detail['menu-locations']) ? $demo_detail['menu-locations'] : array());
	    $value['other_setting']     = array_merge( $default_image_setting, isset($demo_detail['other_setting']) ? $demo_detail['other_setting'] : array());
	    if(!empty($demo_detail['data_slider'])){
		    $value['slider'] = $slider . $demo_detail['data_slider'];
	    }
      $value['elementor']         = array_merge( $default_elementor, isset($demo_detail['data_elementor']) ? $demo_detail['data_elementor'] : array());
      $value['elementor_kit_settings']         = array_merge( $elementor_kit_settings, isset($demo_detail['elementor_kit_settings']) ? $demo_detail['elementor_kit_settings'] : array());
	    $data_return[$demo_key] = $value;
    }

    return $data_return;
}
