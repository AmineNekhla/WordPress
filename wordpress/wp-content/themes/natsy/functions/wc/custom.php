<?php

//==============================================================================
// WooCommerce Number of Products per Page Allow
//==============================================================================
if(!function_exists('nova_woo_get_product_per_page_array')){
    function nova_woo_get_product_per_page_array(){
        $per_page_array = apply_filters('natsy/filter/get_product_per_page_array', nova_get_option('product_per_page_allow','12,15,30'));
        if(!empty($per_page_array)){
            $per_page_array = explode(',', $per_page_array);
            $per_page_array = array_map('trim', $per_page_array);
            $per_page_array = array_map('absint', $per_page_array);
            asort($per_page_array);
            return $per_page_array;
        }
        else{
            return array();
        }
    }
}

if (! function_exists( 'nova_get_parameter_per_page')):
function nova_get_parameter_per_page($per_page) {
		if (isset($_GET['per_page']) && ($_per_page = $_GET['per_page'])) {
				$param_allow = nova_woo_get_product_per_page_array();
				if(!empty($param_allow) && in_array($_per_page, $param_allow)){
						$per_page = $_per_page;
				}
		}
		return $per_page;
}
endif;

if (! function_exists( 'nova_set_cookie_default')):
function nova_set_cookie_default(){
		if (isset($_GET['per_page']) && $per_page = $_GET['per_page']) {
				add_filter('natsy/filter/get_product_per_page','nova_get_parameter_per_page');
		}
}
add_action('init','nova_set_cookie_default', 2 );
endif;

if(!function_exists('nova_woo_get_product_per_page')){
    function nova_woo_get_product_per_page(){
      global $nova_theme;
        return apply_filters('natsy/filter/get_product_per_page', $nova_theme['shop_product_per_page']);
    }
}
if(!function_exists('nova_woo_get_product_per_row')){
    function nova_woo_get_product_per_row(){
        global $nova_theme;
        return apply_filters('natsy/filter/get_product_per_row', $nova_theme['shop_product_columns']);
    }
}
/**
 * Adds custom classes to product image gallery
 *
 * @param array $classes Gallery classes.
 *
 * @return array
 */
if( !function_exists('nova_woo_gallery_classes')  ) {
	function nova_woo_gallery_classes( $classes ) {
		global $product;

		if ( current_theme_supports( 'wc-product-gallery-lightbox' ) ) {
			$classes[] = 'lightbox-support';
		}

		if ( current_theme_supports( 'wc-product-gallery-zoom' ) ) {
			$classes[] = 'zoom-support';
		}

		$attachment_ids = $product->get_gallery_image_ids();

		if ( ! $attachment_ids ) {
			$classes[] = 'no-thumbnails';
		}

		return $classes;
	}
}
/**
 * Change the image size of product style_3.
 *
 * @param string $size Image size name.
 *
 * @return string
 */
if( !function_exists('nova_gallery_image_size_large')  ) {
	function nova_gallery_image_size_large( $size ) {
		return 'woocommerce_single';
	}
}
/**
 * Adds stock progress bar
 *
 */
  if ( ! function_exists( 'nova_stock_progress_bar' ) ) {
		function nova_stock_progress_bar() {
			$product_id  = get_the_ID();
			$total_stock = (int) get_post_meta( $product_id, 'nova_total_stock_quantity', true );

			if ( ! $total_stock ) {
				return;
			}

			$current_stock = round( (int) get_post_meta( $product_id, '_stock', true ) );

			$total_sold = $total_stock > $current_stock ? $total_stock - $current_stock : 0;
			$percentage = $total_sold > 0 ? round( $total_sold / $total_stock * 100 ) : 0;
			 $total = $total_sold + $current_stock;
			if ( $current_stock > 0 ) {
				echo '<div class="kitify-progress-bar kitify-stock-progress-bar">';
					echo '<div class="stock-info">';
						echo '<div class="total-sold">' . esc_html__( 'Sold:', 'natsy' ) . '<span> ' . esc_html( $total_sold ) . '/'.$total.'</span></div>';
					echo '</div>';
					echo '<div class="progress-area" title="' . esc_html__( 'Sold', 'natsy' ) . ' ' . esc_attr( $percentage ) . '%">';
						echo '<div class="progress-bar" style="width:' . esc_attr( $percentage ) . '%;"></div>';
					echo '</div>';
				echo '</div>';
			}
	}
}
 if ( ! function_exists( 'nova_total_stock_quantity_input' ) ) {
 	function nova_total_stock_quantity_input() {
 		echo '<div class="options_group">';
 			woocommerce_wp_text_input(
 				array(
 					'id'          => 'nova_total_stock_quantity',
 					'label'       => esc_html__( 'Initial number in stock', 'natsy' ),
 					'desc_tip'    => 'true',
 					'description' => esc_html__( 'Required for stock progress bar option', 'natsy' ),
 					'type'        => 'text',
 				)
 			);
 		echo '</div>';
 	}

 	add_action( 'woocommerce_product_options_inventory_product_data', 'nova_total_stock_quantity_input' );
 }
 if ( ! function_exists( 'nova_save_total_stock_quantity' ) ) {
 	function nova_save_total_stock_quantity( $post_id ) { // phpcs:ignore
 		$stock_quantity = isset( $_POST['nova_total_stock_quantity'] ) && $_POST['nova_total_stock_quantity'] ? wc_clean( $_POST['nova_total_stock_quantity'] ) : ''; // phpcs:ignore

 		update_post_meta( $post_id, 'nova_total_stock_quantity', $stock_quantity );
 	}

 	add_action( 'woocommerce_process_product_meta_simple', 'nova_save_total_stock_quantity' );
 	add_action( 'woocommerce_process_product_meta_variable', 'nova_save_total_stock_quantity' );
 	add_action( 'woocommerce_process_product_meta_grouped', 'nova_save_total_stock_quantity' );
 	add_action( 'woocommerce_process_product_meta_external', 'nova_save_total_stock_quantity' );
 }
