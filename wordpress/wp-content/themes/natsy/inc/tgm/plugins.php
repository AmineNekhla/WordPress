<?php


function natsy_theme_register_required_plugins() {

  $plugins = array(

    'kitify' => array(
      'name'               => esc_html__('Kitify','natsy'),
      'slug'               => 'kitify',
      'source'             => 'http://assets.novaworks.net/plugins/kitify.zip',
      'required'           => true,
      'description'        => esc_html__('A perfect plugin for Elementor','natsy'),
      'demo_required'      => true,
      'version'            => '1.1.4'
    ),
    'natsy-core' => array(
      'name'               => esc_html__('Natsy Core','natsy'),
      'slug'               => 'natsy-core',
      'source'             => 'http://assets.novaworks.net/plugins/natsy-core.zip',
      'required'           => true,
      'description'        => esc_html__('Extends the functionality of Natsy with theme specific shortcodes and page builder elements.','natsy'),
      'demo_required'      => true,
      'version'            => '1.0.0'
    ),
    'elementor' => array(
      'name'               => esc_html__('Elementor Page Builder','natsy'),
      'slug'               => 'elementor',
      'required'           => true,
      'description'        => esc_html__('The most advanced frontend drag & drop page builder. Create high-end, pixel perfect websites at record speeds. Any theme, any page, any design.','natsy'),
      'demo_required'      => true
    ),
    'wc-ajax-product-filter' => array(
      'name'               => esc_html__('Nova Ajax Product Filters','natsy'),
      'slug'               => 'nova-ajax-product-filter',
      'source'             => 'http://assets.novaworks.net/plugins/nova-ajax-product-filter.zip',
      'required'           => true,
      'description'        => esc_html__('A plugin to filter woocommerce products with AJAX request.','natsy'),
      'demo_required'      => true,
      'version'            => '1.0.0'
    ),
    'woocommerce' => array(
      'name'               => esc_html__('WooCommerce','natsy'),
      'slug'               => 'woocommerce',
      'required'           => true,
      'description'        => esc_html__('The eCommerce engine','natsy'),
      'demo_required'      => true
    ),
    'revslider' => array(
      'name'               => esc_html__('Slider Revolution','natsy'),
      'slug'               => 'revslider',
      'source'				     => 'http://assets.novaworks.net/plugins/revslider.zip',
      'required'           => false,
      'demo_required'      => true
    ),
    'natsy-demo-data' => array(
      'name'               => esc_html__('Natsy Package Demo Data','natsy'),
      'slug'               => 'natsy-demo-data',
      'source'				     => 'http://assets.novaworks.net/plugins/natsy/natsy-demo-data.zip',
      'required'           => false,
      'demo_required'      => true,
      'version'            => '1.0.0'
    ),
    'woo-variation-swatches' => array(
      'name'               => esc_html__('Variation Swatches for WooCommerce','natsy'),
      'slug'               => 'woo-variation-swatches',
      'required'           => false,
      'description'        => esc_html__('Beautiful colors, images and buttons variation swatches for woocommerce product attributes. Requires WooCommerce 3.2+','natsy'),
      'demo_required'      => true
    ),
    'yith-woocommerce-wishlist' => array(
      'name'               => esc_html__('YITH WooCommerce Wishlist','natsy'),
      'slug'               => 'yith-woocommerce-wishlist',
      'required'           => false,
      'description'        => esc_html__('YITH WooCommerce Wishlist gives your users the possibility to create, fill, manage and share their wishlists allowing you to analyze their interests and needs to improve your marketing strategies.','natsy'),
      'demo_required'      => true
    ),
    'contact-form-7' => array(
      'name'               => esc_html__('Contact Form 7','natsy'),
      'slug'               => 'contact-form-7',
      'required'           => false,
      'description'        => esc_html__('Just another contact form plugin. Simple but flexible.','natsy'),
      'demo_required'      => true
    ),
    'envato-market' => array(
      'name'               => esc_html__('Envato Market','natsy'),
      'slug'               => 'envato-market',
      'source'             => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
      'required'           => false,
      'description'        => esc_html__('Automatically update your Envato theme','natsy'),
      'demo_required'      => true
    ),
  );

	$config = array(
	  'id'                => 'natsy',
		'default_path'      => '',
		'parent_slug'       => 'themes.php',
		'menu'              => 'tgmpa-install-plugins',
		'has_notices'       => true,
		'is_automatic'      => true,
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'natsy_theme_register_required_plugins' );
