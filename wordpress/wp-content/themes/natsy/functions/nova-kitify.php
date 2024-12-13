<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class Nova_Kitify {

  function __construct($settings = []) {
    add_action( 'kitify/wooproduct/loop_action', array( $this, 'custom_loop_action' ), 10 );
  }
  public function custom_loop_action() {
    add_action('woocommerce_before_shop_loop',  'kitify_setup_toolbar' , -999 );
    add_action('woocommerce_before_shop_loop',  'kitify_add_toolbar_open' , 15 );
    add_action('woocommerce_before_shop_loop',  'kitify_add_toolbar_close' , 35 );
	add_action( 'nova_woocommerce_catalog_ordering', 'kitify_add_grid_list_display', 35, 0 );
    remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
    add_action( 'woocommerce_after_shop_loop', [ $this, 'woocommerce_pagination' ], 10 );
	add_action('woocommerce_before_shop_loop_item_title', [ $this, 'add_product_loop_category' ], 15 );
	add_action( 'woocommerce_after_shop_loop_item_title', [ $this, 'add_rating_star' ], 20);
  }
	public function add_product_loop_category() {
		global $product;
		$enable_category = wc_get_loop_prop('kitify_enable_product_cat', false);

		if($enable_category) {
			$categories = explode(', ', wc_get_product_category_list( $product->get_id() ) );
			$categories = array_filter( $categories );
			$i = 0;
			if ( !empty( $categories ) ) :
				echo '<div class="product-item__category">';
				foreach ( $categories as $category ):
					if ( $i < 1 ) {
					echo preg_replace('/(<a)(.+\/a>)/i', '${1} class="content-product-cat" ${2}', $category);
					}
					$i++;
				endforeach;
				echo '</div>';
			endif;
		}
	}
	public function add_rating_star() {
		$enable_rating = wc_get_loop_prop('kitify_enable_rating', false);
		if($enable_rating) {
			woocommerce_template_loop_rating();
		}
	}
  public function woocommerce_pagination(){
      ob_start();
      woocommerce_pagination();
      $output = ob_get_clean();

      $output = str_replace('woocommerce-pagination', 'woocommerce-pagination kitify-pagination clearfix kitify-ajax-pagination', $output);

      echo $output; // PHPCS: XSS ok
  }
}
$Nova_Kitify = new Nova_Kitify;
