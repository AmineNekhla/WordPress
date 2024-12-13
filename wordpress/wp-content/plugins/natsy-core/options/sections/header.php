<?php
$opt_name = NOVA_FRAMEWORK_VAR;
$bg_color = '#F6F6F6';
$font_color = '#777777';
$heading_color = '#111111';
$page_header_height = 300;
$page_header_font_size = 60;
$header_logo_width = 130;

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Header', 'natsy-core'),
    'icon' => 'fa fa-columns',
    'id' => 'header'
) );

/* Header */
CSF::createSection( $opt_name, array(
	'title' => esc_html__('Site Header', 'natsy-core'),
	'parent' => 'header',
	'description' => esc_html__('This settings apply for Header default only. If you using Header Builder. Please go to Kitify >> Theme Builder >> Header to change settings for header.', 'natsy-core'),
	'fields' => array(
			array(
				'id' => 'title_header',
	       'type' => 'subheading',
				'title' => __( 'Headers', 'natsy-core')
			),
      array(
				'id' => 'header_wide',
				'type' => 'switcher',
				'title' => esc_html__('Header Wide', 'natsy-core'),
				'desc' => '',
				'default' => 0
      ),
      array(
				'id' => 'header_transparent',
				'type' => 'switcher',
				'title' => esc_html__('Header Transparent', 'natsy-core'),
				'desc' => '',
				'default' => 0
      ),
      array(
				'id' => 'enable_sticky_header',
				'type' => 'switcher',
				'title' => esc_html__('Enable sticky header', 'natsy-core'),
				'desc' => '',
				'default' => 0
      ),
			array(
				'id' => 'header_height',
							'type' => 'slider',
				'title' => esc_html__('Header Height', 'natsy-core'),
				'desc' => esc_html__('Default: 100 pixels.', 'natsy-core'),
				'default' => '100',
				'min' => '80',
				'step' => '1',
							'max' => '300',
							'unit' => 'px',
			),
			array(
				'id' => 'header_font_size',
							'type' => 'slider',
				'title' => esc_html__('Header Text Size', 'natsy-core'),
				'desc' => esc_html__('Default: 16 pixels.', 'natsy-core'),
				'default' => '16',
				'min' => '9',
				'step' => '1',
							'max' => '24',
							'unit' => 'px',
			),
		array(
			'id' => 'title_logo',
            'type' => 'subheading',
			'title' => __( 'Logo', 'natsy-core')
		),

    // Image logo
		array(
			'id' => 'header_logo',
			'type' => 'media',
			'url' => true,
			'preview'=> true,
			'title' => esc_html__('Logo', 'natsy-core'),
			'default'     => array(
				'url' => get_template_directory_uri() . '/assets/images/logo.svg',
				'thumbnail' => get_template_directory_uri() . '/assets/images/logo.svg',
			),
		),
		array(
			'id' => 'header_logo_light',
			'type' => 'media',
			'url' => true,
			'preview'=> true,
			'title' => esc_html__('Logo Light', 'natsy-core'),
			'default'     => array(
				'url' => get_template_directory_uri() . '/assets/images/logo_light.svg',
				'thumbnail' => get_template_directory_uri() . '/assets/images/logo_light.svg',
			),
		),
		array(
			'id' => 'header_logo_width',
			'type' => 'number',
			'title' => esc_html__('Logo width (Optional)', 'natsy-core'),
			'subtitle' => esc_html__('Default: '.$header_logo_width.' (pixels)', 'natsy-core'),
			'desc' => esc_html__('Note: this is the half width of your uploaded logo for retina display purposes.', 'natsy-core'),
            'default' => $header_logo_width,
            'unit' => 'px'
    ),
		array(
			'id' => 'title_icons',
						'type' => 'subheading',
			'title' => __( 'Action Icons', 'natsy-core')
		),
		array(
			'id' => 'header_burger_menu',
			'type' => 'switcher',
			'title' => esc_html__('Burger Menu', 'natsy-core'),
			'desc' => '',
			'default' => 0
		),
		array(
			'id' => 'header_wishlist',
			'type' => 'switcher',
			'title' => esc_html__('Wishlist', 'natsy-core'),
			'desc' => '',
			'default' => 0
		),
		array(
			'id' => 'header_cart',
			'type' => 'switcher',
			'title' => esc_html__('Cart', 'natsy-core'),
			'desc' => '',
			'default' => 1
		),
		array(
			'id' => 'header_account',
			'type' => 'switcher',
			'title' => esc_html__('Account Menu', 'natsy-core'),
			'desc' => '',
			'default' => 1
		),
		array(
			'id' => 'header_search',
			'type' => 'switcher',
			'title' => esc_html__('Search', 'natsy-core'),
			'desc' => '',
			'default' => 1
		),
	)
) );

// Page header
CSF::createSection( $opt_name, array(
	'title' => esc_html__('Page Header', 'natsy-core'),
  'parent' => 'header',
	'fields' => array(
		array(
			'id' => 'page_header_style',
			'type' => 'button_set',
			'title' => esc_html__('Page Header Type', 'natsy-core'),
			'subtitle' => '',
			'options' => array('large' => 'Large', 'mini' => 'Mini'),
			'default' => 'mini'
		),
		// Page header Large
		array(
			'id' => 'page_header_background_image',
			'type' => 'media',
			'dependency' => array('page_header_style', '==', 'large'),
			'url' => true,
			'preview'=> true,
			'title' => esc_html__('Background Image', 'natsy-core'),
		),
		array(
			'id' => 'pager_header_background_color',
			'type' => 'color',
			'dependency' => array('page_header_style', '==', 'large'),
			'title' => esc_html__('Page Header Background Color', 'natsy-core'),
			'default' => $bg_color,
			'transparent' => true
		),
		array(
			'id' => 'pager_header_overlay_color',
			'type' => 'color',
			'dependency' => array('page_header_style', '==', 'large'),
			'title' => esc_html__('Page Header Background Overlay Color', 'natsy-core'),
			'default' => '',
			'transparent' => true
		),
		array(
			'id' => 'pager_header_font_color',
			'type' => 'color',
			'dependency' => array('page_header_style', '==', 'large'),
			'title' => esc_html__('Page Header Font Color', 'natsy-core'),
			'default' => $font_color,
			'transparent' => false
		),
		array(
			'id' => 'pager_header_heading_color',
			'type' => 'color',
			'dependency' => array('page_header_style', '==', 'large'),
			'title' => esc_html__('Page Header Heading Color', 'natsy-core'),
			'default' => $heading_color,
			'transparent' => false
		),
		array(
			'id' => 'page_header_height',
			'type' => 'number',
			'dependency' => array('page_header_style', '==', 'large'),
			'title' => esc_html__('Page Header Height', 'natsy-core'),
			'subtitle' => esc_html__('Default: 300 (pixels)', 'natsy-core'),
            'default' => $page_header_height,
            'unit' => 'px'
    ),
		array(
		'id' => 'page_header_font_size',
				'type' => 'slider',
				'dependency' => array('page_header_style', '==', 'large'),
		'title' => esc_html__('Font Size', 'natsy-core'),
		'desc' => esc_html__('Default: 60 pixels.', 'natsy-core'),
		'default' => $page_header_font_size,
		'min' => '18',
		'step' => '1',
				'max' => '200',
				'unit' => 'px',
		),
		array(
			'id' => 'title_breadcrumb',
			 'type' => 'subheading',
			'title' => __( 'Breadcrumb', 'natsy-core')
		),
		array(
			'id' => 'page_header_breadcrumb_toggle',
			'type' => 'switcher',
			'title' => esc_html__('Site Breadcrumb', 'natsy-core'),
			'desc' => '',
			'default' => 1
		),
	)
) );
