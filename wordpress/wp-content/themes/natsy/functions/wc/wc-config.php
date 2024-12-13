<?php
//==============================================================================
//	Kitify
//==============================================================================
if( ! function_exists( 'nova_add_product_thumbnails_start' ) ) {
	function nova_add_product_thumbnails_start(){
			$enable_alt_image = wc_get_loop_prop('kitify_enable_alt_image', false);
			$class = '';
			if( $enable_alt_image ) {
				$class = ' second_image_enabled';
			}
			echo '<div class="product-item__thumbnail-placeholder'.esc_attr($class).'">';
	}
	add_action( 'nova_loop_thumbnail_start', 'nova_add_product_thumbnails_start' );
}

if( ! function_exists( 'nova_add_product_thumbnails_end' ) ) {
	function nova_add_product_thumbnails_end(){
			echo '</div>';
	}
	add_action( 'nova_loop_thumbnail_end', 'nova_add_product_thumbnails_end' );
}
if( ! function_exists( 'nova_add_product_thumbnails_to_loop' ) ) {
	function nova_add_product_thumbnails_to_loop(){
			$image_size = wc_get_loop_prop('kitify_image_size', 'woocommerce_thumbnail');
			$enable_alt_image = wc_get_loop_prop('kitify_enable_alt_image', false);

			global $product;

			$output = woocommerce_get_product_thumbnail( $image_size );
			if($enable_alt_image){
					$gallery_image_ids = $product->get_gallery_image_ids();
					if(!empty($gallery_image_ids[0])){
							$image_url = wp_get_attachment_image_url($gallery_image_ids[0], $image_size);
							$output .= sprintf('<span class="product_second_image" style="background-image: url(\'%1$s\')"></span>', esc_url( $image_url ));
					}
			}
			echo $output; // PHPCS: XSS ok
	}
	add_action( 'nova_loop_thumbnail', 'nova_add_product_thumbnails_to_loop' );
}
if( ! function_exists( 'nova_loop_item_add_product_title' ) ) {
	function nova_loop_item_add_product_title(){
			$html_tag = 'h2';
			if( KITIFY_IS_ACTIVE ) {
				$html_tag = wc_get_loop_prop('kitify_item_html_tag', 'h2');
				$html_tag = kitify_helper()->validate_html_tag($html_tag);
			}
			the_title( sprintf( '<a href="%1s" class="title"><%2$s class="woocommerce-loop-product__title">', esc_url( get_the_permalink() ), $html_tag ), sprintf('</%1$s></a>', $html_tag) );
	}
	add_action( 'woocommerce_shop_loop_item_title', 'nova_loop_item_add_product_title' );
}

if ( ! function_exists( 'kitify_add_grid_list_display' ) ) :
function kitify_add_grid_list_display() {
  echo '<div class="shop-display-type">
				<span class="shop-display-grid active">
					<svg class="natsy-grid-icon">
					 <use xlink:href="#natsy-grid"></use>
					</svg>
				</span>
				<span class="shop-display-list">
					<svg class="natsy-list-icon">
					 <use xlink:href="#natsy-list"></use>
					</svg>
				</span>
			</div>';
}
endif;

//==============================================================================
// Add Wishlist Icon in Product Card
//==============================================================================
function add_wishlist_icon_in_product_card() {
	global $nova_theme;
  if( 1 ==  $nova_theme['shop_product_wishlist_button'] ):
    if (class_exists('YITH_WCWL')) :
      global $product;
    ?>

      <a href="<?php echo YITH_WCWL()->is_product_in_wishlist($product->get_id())? esc_url(YITH_WCWL()->get_wishlist_url()) : esc_url(add_query_arg('add_to_wishlist', $product->get_id())); ?>"
        data-product-id="<?php echo esc_attr($product->get_id()); ?>"
        data-product-type="<?php echo esc_attr($product->get_type()); ?>"
        data-wishlist-url="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>"
        data-browse-wishlist-text="<?php echo esc_attr(get_option('yith_wcwl_browse_wishlist_text')); ?>"
        class="nova_product_wishlist_btn <?php echo YITH_WCWL()->is_product_in_wishlist($product->get_id())? 'clicked added' : 'add_to_wishlist'; ?>" rel="nofollow">
        <i class="inova ic-favorite"></i>
        <span class="hidden add-text"><?php echo esc_attr(get_option('yith_wcwl_add_to_wishlist_text')); ?></span>
        <span class="hidden added-text"><?php echo esc_attr(get_option('yith_wcwl_browse_wishlist_text')); ?></span>
      </a>

    <?php
    endif;
  endif;
}
//==============================================================================
//	Product Quick View
//==============================================================================
if ( !function_exists('nova_product_quick_view_button')):
function nova_product_quick_view_button() {
  global $product, $custom_shop_quick_view, $nova_theme;
  if( 1 ==  $nova_theme['shop_product_quickview_button'] ):
    echo '<a href="#" class="nova_product_quick_view_btn" data-product-id="' . $product->get_id() . '" rel="nofollow"><i class="inova ic-zoom"></i></a>';
  endif;
}
endif;

if ( !function_exists('nova_product_quick_view_button_v2')):
function nova_product_quick_view_button_v2() {
  global $product, $custom_shop_quick_view, $nova_theme;
  if( 1 ==  $nova_theme['shop_product_quickview_button'] ):
    echo '
      <a href="#" class="nova_product_quick_view_btn" data-product-id="' . $product->get_id() . '" rel="nofollow"><svg class="natsy-plus"><use xlink:href="#natsy-plus" xmlns:xlink="http://www.w3.org/1999/xlink"></use></svg></a>
    ';
  endif;
}
endif;

if ( !function_exists('kitify_add_toolbar_open')):
function kitify_add_toolbar_open(){
    if(wc_get_loop_prop('kitify_loop_allow_extra_filters')){
        echo '<div class="shop_header_placeholder kitify-active">';
        echo '<header class="woocommerce-archive-header">';
    }
}
endif;

if ( !function_exists('kitify_add_toolbar_close')):
function kitify_add_toolbar_close(){
    if(wc_get_loop_prop('kitify_loop_allow_extra_filters')){
      $per_page_array = nova_woo_get_product_per_page_array();
      $per_page = nova_woo_get_product_per_page();
      $current_url = add_query_arg(null, null);

      echo '<div class="woocommerce-archive-header-inside">';
      do_action( 'nova_woocommerce_result_count' );
      echo '<div class="woocommerce-archive-toolbar sh--color">';
      do_action( 'kitify/products/toolbar/filter' );
      if(!empty($per_page_array)):
        echo '<div class="nova-custom-view">';
        echo '<label>'.esc_html__( 'Show','natsy' ).'</label>';
        echo '<ul>';
        $active_a = '';
        foreach ($per_page_array as $page_val){
          if($per_page == $page_val) {
            $active_a = ' class="active"';
          }else {
            $active_a = '';
          }
          echo '<li'.$active_a.'><a href="'.esc_url(add_query_arg('per_page', $page_val, $current_url)).'">'.esc_html( $page_val ).'</a></li>';
        }
        echo '</ul>';
        echo '</div>';
      endif;
      do_action( 'nova_woocommerce_catalog_ordering' );
      echo '</div>';
      echo '</div>';

      echo '</header>';
      echo '</div>';
    }
}
endif;

if ( !function_exists('kitify_setup_toolbar')):
function kitify_setup_toolbar(){
    if(empty(wc_get_loop_prop('kitify_loop_before')) && (is_shop() || is_product_taxonomy())){
        wc_set_loop_prop('kitify_loop_allow_extra_filters', true);
    }
}
endif;

if( ! function_exists( 'nova_add_product_stock_bar' ) ) {
	function nova_add_product_stock_bar(){
			$enable = wc_get_loop_prop('kitify_enable_stock_progress_bar', false);
			$class = '';
			if( $enable ) {
				nova_stock_progress_bar();
			}
	}
	add_action( 'woocommerce_after_shop_loop_item_title', 'nova_add_product_stock_bar', 15 );
}
