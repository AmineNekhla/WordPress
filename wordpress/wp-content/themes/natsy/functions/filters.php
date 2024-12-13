<?php
// -----------------------------------------------------------------------------
// Add Schemes color
// -----------------------------------------------------------------------------

if ( ! function_exists( 'nova_schemes_color_css' ) ) :
	function nova_schemes_color_css(){
	require_once( get_template_directory() . '/assets/css/var.css.php' );
	}
	add_action( 'wp_head', 'nova_schemes_color_css',98);
endif;

if ( ! function_exists( 'nova_kses_allowed_html' ) ) :
function nova_kses_allowed_html($tags, $context) {
  switch($context) {
    case 'simple':
      $tags = array(
        'div' => array(
					'id' => array(),
					'class' => array()
				),
        'ul' => array(
					'id' => array(),
					'class' => array()
				),
        'li' => array(
					'id' => array(),
					'class' => array()
				),
        'span' => array(
					'class' => array()
				),
				'a' => array(
		        'href' => array(),
		        'target' => array(),
		        'data-toggle' => array(),
		        'title' => array()
		    ),
				'img' => array(
		        'src' => array(),
		        'class' => array()
		    ),
				'i' => array(
					'class' => array()
				)
      );
      return $tags;
    default:
      return $tags;
  }
}
add_filter( 'wp_kses_allowed_html', 'nova_kses_allowed_html', 10, 2);
endif;

// -----------------------------------------------------------------------------
// Disable Wishlist Responsive
// -----------------------------------------------------------------------------
add_filter( 'yith_wcwl_is_wishlist_responsive', '__return_false' );
// -----------------------------------------------------------------------------
// Remove menu item id
// -----------------------------------------------------------------------------
add_filter('nav_menu_item_id', 'nova_css_attributes_filter', 100, 1);
function nova_css_attributes_filter($var) {
  return is_array($var) ? array_intersect($var, array('current-menu-item')) : '';
}
