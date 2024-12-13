<?php

$opt_name = NOVA_FRAMEWORK_VAR;

/* Shop Settings */

CSF::createSection( $opt_name, array(
    'id' => 'shop',
    'title' => esc_html__('Shop', 'natsy-core'),
    'icon' => 'fa fa-shopping-bag'
) );

/* Shop Layout */
CSF::createSection( $opt_name, array(
    'title' => esc_html__('Shop Layout', 'natsy-core'),
    // 'icon' => 'fa fa-dollar',
    'parent' => 'shop',
	'fields' => array(
    array(
      'id' => 'shop_layout_width',
      'type' => 'button_set',
      'title' => esc_html__('Shop Width', 'natsy-core'),
      'subtitle' => '',
      'options' => array('boxed' => 'Boxed', 'wide' => 'Wide'),
      'default' => 'boxed',
    ),
    array(
  		'id' => 'shop_sidebar',
  		'type' => 'switcher',
  		'title' => esc_html__('Shop Sidebar', 'natsy-core'),
  		'default' => 1
    ),
    array(
      'id' => 'shop_sidebar_position',
      'type' => 'button_set',
      'title' => esc_html__('Sidebar Position', 'natsy-core'),
      'subtitle' => '',
      'options' => array('left' => 'Left', 'right' => 'Right'),
      'default' => 'left',
      'dependency' => array('shop_sidebar', '==', '1'),
    ),
    array(
  		'id' => 'shop_filter_active',
  		'type' => 'switcher',
  		'title' => esc_html__('Shop Filters', 'natsy-core'),
  		'default' => 1,
      'dependency' => array('shop_sidebar', '==', '0'),
    ),
    array(
      'id' => 'shop_filter_height',
            'type' => 'slider',
      'title' => esc_html__('Widget Scrollbar Max Height', 'natsy-core'),
      'desc' => esc_html__('Default: 150 pixels.', 'natsy-core'),
      'default' => '150',
      'min' => '150',
      'step' => '1',
            'max' => '1000',
            'unit' => 'px',
    ),
    array(
      'id' => 'shop_pagination',
      'type' => 'button_set',
      'title' => esc_html__('Pagination', 'natsy-core'),
      'subtitle' => '',
      'options' => array(
        'default' => 'Classic',
        'load_more_button' => 'Load More',
        'infinite_scroll' => 'Infinite',
      ),
      'default' => 'infinite_scroll',
    ),
    array(
      'id' => 'shop_mobile_columns',
            'type' => 'slider',
      'title' => esc_html__('Number of Columns on Mobile', 'natsy-core'),
      'desc' => esc_html__('Default: 2', 'natsy-core'),
      'default' => '2',
      'min' => '1',
      'step' => '1',
            'max' => '2',
            'unit' => '',
    ),
  )
) );

/* Shop Catalog Mode */
CSF::createSection( $opt_name, array(
    'title' => esc_html__('Catalog Mode', 'natsy-core'),
    // 'icon' => 'fa fa-dollar',
    'parent' => 'shop',
	'fields' => array(
    array(
  		'id' => 'catalog_mode',
  		'type' => 'switcher',
  		'title' => esc_html__('Catalog Mode', 'natsy-core'),
  		'default' => 0
    ),
    array(
      'id' => 'catalog_mode_price',
      'type' => 'switcher',
      'dependency' => array('catalog_mode', '==', '1'),
      'title' => esc_html__('Remove Product Price', 'natsy-core'),
      'default' => 0
    ),
  )
) );

/* Shop Archives */
CSF::createSection( $opt_name, array(
    'title' => esc_html__('Shop Archives', 'natsy-core'),
    // 'icon' => 'fa fa-dollar',
    'parent' => 'shop',
	'fields' => array(
    array(
      'id' => 'title_general',
       'type' => 'subheading',
      'title' => __( 'General', 'natsy-core')
    ),
    array(
      'id' => 'shop_product_columns',
            'type' => 'slider',
      'title' => esc_html__('Number of Columns', 'natsy-core'),
      'desc' => esc_html__('Default: 3', 'natsy-core'),
      'default' => '3',
      'min' => '1',
      'step' => '1',
            'max' => '6',
            'unit' => '',
    ),
    array(
      'id'      => 'product_per_page_allow',
      'type'    => 'text',
      'title'   => esc_html__( 'WooCommerce Number of Products per Page Allow', 'natsy-core' ),
      'default' => esc_html__( '12,15,30', 'natsy-core' ),
      'desc' => esc_html__('Comma-separated. ( i.e: 3,6,9 )', 'natsy-core'),
    ),
    array(
      'id' => 'shop_product_per_page',
      'type' => 'slider',
      'title' => esc_html__( 'WooCommerce Number of Products per Page', 'natsy-core' ),
      'description' => esc_html__('The value of field must be as one value of setting above.', 'natsy'),
      'default' => '12',
      'min' => '1',
      'step' => '1',
            'max' => '100',
            'unit' => '',
    ),
    array(
      'id' => 'shop_product_addtocart_button',
      'type' => 'switcher',
      'title' => esc_html__('Show add to cart button', 'natsy-core'),
      'default' => 1
    ),
    array(
      'id' => 'shop_product_wishlist_button',
      'type' => 'switcher',
      'title' => esc_html__('Show Wishlist button', 'natsy-core'),
      'default' => 1
    ),
    array(
      'id' => 'shop_product_quickview_button',
      'type' => 'switcher',
      'title' => esc_html__('Show Quickview button', 'natsy-core'),
      'default' => 1
    ),
    array(
      'id' => 'shop_second_image',
      'type' => 'switcher',
      'title' => esc_html__('Product Image on Hover', 'natsy-core'),
      'default' => 0
    ),
    array(
      'id' => 'title_toolbar',
       'type' => 'subheading',
      'title' => __( 'Toolbar', 'natsy-core')
    ),
    array(
      'id' => 'shop_toolbar_grid_list',
      'type' => 'switcher',
      'title' => esc_html__('Show Grid List Switch', 'natsy-core'),
      'default' => 1
    ),
    array(
      'id' => 'title_sale',
       'type' => 'subheading',
      'title' => __( 'Sale Badge', 'natsy-core')
    ),
    array(
      'id' => 'sale_page_badge',
      'type' => 'switcher',
      'title' => esc_html__('Show Sale Label', 'natsy-core'),
      'default' => 1
    ),
    array(
      'id' => 'sale_page_badge_type',
      'type' => 'switcher',
      'title' => esc_html__('Show Discount percentage', 'natsy-core'),
      'dependency' => array('sale_page_badge', '==', '1'),
      'default' => 0
    ),
    array(
      'id'      => 'sale_page_badge_text',
      'type'    => 'text',
      'title'   => esc_html__( 'Sale Badge Wording', 'natsy-core' ),
      'default' => esc_html__( 'Sale!', 'natsy-core' ),
      'dependency' => array('sale_page_badge', '==', '1'),
    ),
    array(
      'id' => 'title_new',
       'type' => 'subheading',
      'title' => __( 'New Badge', 'natsy-core')
    ),
    array(
      'id' => 'new_products_badge',
      'type' => 'switcher',
      'title' => esc_html__('New badge', 'natsy-core'),
      'default' => 1
    ),
    array(
      'id'      => 'new_products_badge_text',
      'type'    => 'text',
      'title'   => esc_html__( 'New Products Badge Wording', 'natsy-core' ),
      'default' => esc_html__( 'New!', 'natsy-core' ),
      'dependency' => array('new_products_badge', '==', '1'),
    ),
    array(
      'id' => 'new_products_number_type',
      'type' => 'button_set',
      'title' => esc_html__('Show new products by:', 'natsy-core'),
      'subtitle' => '',
      'dependency' => array('new_products_badge', '==', '1'),
      'options' => array(
        'day' => 'Day Added',
        'last_added' => 'Last Added',
      ),
      'default' => 'last_added',
    ),
    array(
      'id' => 'new_products_number',
      'type' => 'slider',
      'title' => esc_html__('Show products added in the past <i>x</i> days:', 'natsy-core'),
      'desc' => esc_html__('Default: 8', 'natsy-core'),
      'dependency' => array(
        array('new_products_badge', '==', '1'),
        array('new_products_number_type', '==', 'day'),
      ),
      'default' => '8',
      'min' => '1',
      'step' => '1',
            'max' => '360',
            'unit' => '',
    ),
    array(
      'id' => 'new_products_number_last',
      'type' => 'slider',
      'title' => esc_html__('Show last <i>x</i> products:', 'natsy-core'),
      'desc' => esc_html__('Default: 8', 'natsy-core'),
      'dependency' => array(
        array('new_products_badge', '==', '1'),
        array('new_products_number_type', '==', 'last_added'),
      ),
      'default' => '8',
      'min' => '1',
      'step' => '1',
            'max' => '20',
            'unit' => '',
    ),
  )
) );

/* Shop Single */
CSF::createSection( $opt_name, array(
    'title' => esc_html__('Shop Single', 'natsy-core'),
    // 'icon' => 'fa fa-dollar',
    'parent' => 'shop',
	'fields' => array(
    array(
      'id' => 'general_title',
       'type' => 'subheading',
      'title' => __( 'General', 'natsy-core')
    ),
    array(
      'id' => 'single_product_sidebar',
      'type' => 'switcher',
      'title' => esc_html__('Single Product Sidebar', 'natsy-core'),
      'default' => 0
    ),
    array(
      'id' => 'single_product_sidebar_position',
      'type' => 'button_set',
      'title' => esc_html__('Sidebar Position', 'natsy-core'),
      'subtitle' => '',
      'options' => array('left' => 'Left', 'right' => 'Right'),
      'default' => 'right',
      'dependency' => array('single_product_sidebar', '==', '1'),
    ),
    array(
      'id' => 'single_product_social_share',
      'type' => 'switcher',
      'title' => esc_html__('Display Social Share', 'natsy-core'),
      'default' => 0
    ),
    array(
      'id' => 'upsell_products',
      'type' => 'switcher',
      'title' => esc_html__('Up-sells Display', 'natsy-core'),
      'default' => 0
    ),
    array(
      'id' => 'related_products',
      'type' => 'switcher',
      'title' => esc_html__('Related Products Display', 'natsy-core'),
      'default' => 1
    ),
    array(
      'id' => 'related_products_column',
      'type' => 'slider',
      'title' => esc_html__('Number of Related Products', 'natsy-core'),
      'desc' => esc_html__('Default: 4', 'natsy-core'),
      'dependency' => array(
        array('related_products', '==', '1'),
      ),
      'default' => '4',
      'min' => '2',
      'step' => '1',
            'max' => '6',
            'unit' => '',
    ),
    array(
      'id' => 'image_gallery',
       'type' => 'subheading',
      'title' => __( 'Image Gallery', 'natsy-core')
    ),
    array(
      'id' => 'product_image_zoom',
      'type' => 'switcher',
      'title' => esc_html__('Image Zoom', 'natsy-core'),
      'desc' => esc_html__( 'Zooms in where your cursor is on the image', 'natsy' ),
      'default' => 1
    ),
    array(
      'id' => 'product_image_lightbox',
      'type' => 'switcher',
      'title' => esc_html__('Image Lightbox', 'natsy-core'),
      'desc' => esc_html__( 'Opens your images against a dark backdrop', 'natsy' ),
      'default' => 1
    ),
  )
) );
