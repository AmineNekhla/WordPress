<?php

// @version 3.6.0

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
//Product Title
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title',5 );
add_action( 'natsy/action/wc_product_title', 'woocommerce_template_single_title',5 );

//Product Rating & Price
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating',10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price',10 );
add_action( 'natsy/action/wc_price_rating', 'woocommerce_template_single_price',5 );
add_action( 'natsy/action/wc_price_rating', 'woocommerce_template_single_rating',10 );

// Social Share Products
if ( 1 == nova_get_option('single_product_social_share', 0) && defined('MINITURE_CORE_VERSION') ) {
	add_action('woocommerce_single_product_summary', 'nova_single_product_share', 30);
}
// Upsells Products
if ( 1 != nova_get_option('upsell_products', 0) ) {
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
}

// Related Products
if ( 1 != nova_get_option('related_products', 1) ) {
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
}
$page_header_images = array();
if ( NOVA_RWMB_IS_ACTIVE ) {
$page_header_images = rwmb_meta( 'natsy_product_page_header_image', array( 'limit' => 1 ) );
}
$page_header_image = reset( $page_header_images );
if(! $page_header_image) {
	add_action('natsy/action/wc_product_title', 'nova_site_breadcrumb', 0);
}
// Adds a class of the lightbox to product gallery.
add_filter( 'woocommerce_single_product_image_gallery_classes','nova_woo_gallery_classes' );
?>


<?php
	do_action( 'woocommerce_before_single_product' );

	if ( post_password_required() ) {
		echo get_the_password_form();
		return;
	}
?>

<div id="product-<?php the_ID(); ?>" <?php function_exists('wc_product_class')? wc_product_class('product') : post_class('product'); ?>>
	<div class="product_infos product-infor-detail">
		<div class="grid-x">
			<div class="cell small-12 large-7">

				<div class="before-product-summary-wrapper">

					<?php do_action( 'woocommerce_before_single_product_summary' ); ?>

					<div class="product-item__badges">
						<?php do_action( 'woocommerce_product_badges' ); ?>
					</div>

					<div class="single-product__actions">
						<?php do_action( 'single_product_actions' ); ?>
					</div>

				</div>

			</div>

			<div class="cell small-12 large-5">
				<div class="summary entry-summary">
					<?php do_action( 'natsy/action/wc_product_title' ); ?>
					<div class="nova-custom__price-rating-box">
						<?php do_action( 'natsy/action/wc_price_rating' ); ?>
					</div>
					<?php do_action( 'woocommerce_single_product_summary' ); ?>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="grid-x">
	<div class="cell large-12">
		<div class="after-product-summary">
			<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
		</div>
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
