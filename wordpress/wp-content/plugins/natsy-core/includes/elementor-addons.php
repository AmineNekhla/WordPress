<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( ! class_exists( 'Natsy_Elementor_Addons' ) ) {
	/**
	 * Define Natsy_Elementor_Addons class
	 */
	class Natsy_Elementor_Addons {
        /**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Check if processing elementor widget
		 *
		 * @var boolean
		 */
		private $is_elementor_ajax = false;

        public $sys_messages = [];

		/**
		 * Initalize integration hooks
		 *
		 * @return void
		 */
        public function init() {
            add_filter( 'kitify/allowed-vendor-widgets', array( $this, 'list_addons' ) );
        }
        public function list_addons () {
            $woo_conditional = array(
                'cb'  => 'class_exists',
                'arg' => 'WooCommerce',
            );
            $addons = array(
                'natsy_product_categories' => array(
                    'file' => NOVA_PLUGIN_PATH.'includes/addons/product-categories.php',
                    'conditional' => $woo_conditional,
                ),
                'woo_products' => array(
                    'file' => kitify()->plugin_path(
                        'inc/addons/vendor/woo-products.php'
                    ),
                    'conditional' => $woo_conditional,
                ),
                'woo_size_guide' => array(
                        'file' => kitify()->plugin_path(
                                'inc/addons/vendor/woo-size-guide.php'
                        ),
                        'conditional' => $woo_conditional,
                ),
                'woo_menu_cart' => array(
                    'file' => kitify()->plugin_path(
                        'inc/addons/vendor/woo-menu-cart.php'
                    ),
                    'conditional' => $woo_conditional,
                ),
                'nova_menu_cart' => array(
                    'file' => kitify()->plugin_path(
                        'inc/addons/vendor/nova-menu-cart.php'
                    ),
                    'conditional' => $woo_conditional,
                ),
                'woo_menu_account ' => array(
                    'file' => kitify()->plugin_path(
                        'inc/addons/vendor/woo-menu-account.php'
                    ),
                    'conditional' => $woo_conditional,
                ),
                'woo_pages' => array(
                    'file' => kitify()->plugin_path(
                        'inc/addons/vendor/woo-pages.php'
                    ),
                    'conditional' => $woo_conditional,
                ),
                'woo_add_to_cart' => array(
                    'file' => kitify()->plugin_path(
                        'inc/addons/vendor/woo-add-to-cart.php'
                    ),
                    'conditional' => $woo_conditional,
                ),
                'woo_single_product_title' => array(
                    'file' => kitify()->plugin_path(
                        'inc/addons/vendor/woo-single-product-title.php'
                    ),
                    'conditional' => $woo_conditional,
                ),
                'woo_single_product_images' => array(
                    'file' => kitify()->plugin_path(
                        'inc/addons/vendor/woo-single-product-images.php'
                    ),
                    'conditional' => $woo_conditional,
                ),
                'woo_single_product_price' => array(
                    'file' => kitify()->plugin_path(
                        'inc/addons/vendor/woo-single-product-price.php'
                    ),
                    'conditional' => $woo_conditional,
                ),
                'woo_single_product_addtocart' => array(
                    'file' => kitify()->plugin_path(
                        'inc/addons/vendor/woo-single-product-addtocart.php'
                    ),
                    'conditional' => $woo_conditional,
                ),
                'woo_single_product_rating' => array(
                    'file' => kitify()->plugin_path(
                        'inc/addons/vendor/woo-single-product-rating.php'
                    ),
                    'conditional' => $woo_conditional,
                ),
                'woo_single_product_stock' => array(
                    'file' => kitify()->plugin_path(
                        'inc/addons/vendor/woo-single-product-stock.php'
                    ),
                    'conditional' => $woo_conditional,
                ),
                'woo_single_product_stock_progress_bar' => array(
                    'file' => kitify()->plugin_path(
                        'inc/addons/vendor/woo-single-stock-progress-bar.php'
                    ),
                    'conditional' => $woo_conditional,
                ),
                'woo_single_product_meta' => array(
                    'file' => kitify()->plugin_path(
                        'inc/addons/vendor/woo-single-product-meta.php'
                    ),
                    'conditional' => $woo_conditional,
                ),
                'woo_single_product_shortdescription' => array(
                    'file' => kitify()->plugin_path(
                        'inc/addons/vendor/woo-single-product-shortdescription.php'
                    ),
                    'conditional' => $woo_conditional,
                ),
                'woo_single_product_content' => array(
                    'file' => kitify()->plugin_path(
                        'inc/addons/vendor/woo-single-product-content.php'
                    ),
                    'conditional' => $woo_conditional,
                ),
                'woo_single_product_datatabs' => array(
                    'file' => kitify()->plugin_path(
                        'inc/addons/vendor/woo-single-product-datatabs.php'
                    ),
                    'conditional' => $woo_conditional,
                ),
                'woo_single_product_additional_information' => array(
                    'file' => kitify()->plugin_path(
                        'inc/addons/vendor/woo-single-product-additional-information.php'
                    ),
                    'conditional' => $woo_conditional,
                ),
                'contact_form7' => array(
                    'file' => kitify()->plugin_path(
                        'inc/addons/vendor/contact-form7.php'
                    ),
                    'conditional' => [
                        'cb'  => 'class_exists',
                        'arg' => 'WPCF7',
                    ],
                ),
                'wishlist_button' => array(
                    'file' => kitify()->plugin_path(
                        'inc/addons/vendor/wishlist-button.php'
                    ),
                    'conditional' => [
                        'cb'  => 'class_exists',
                        'arg' => 'YITH_WCWL',
                    ],
                ),
            );
            return $addons;
        }
        /**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return object
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
    }
}
/**
 * Returns instance of Natsy_Elementor_Addons
 *
 * @return object
 */
function natsy_elementor_addons() {
	return Natsy_Elementor_Addons::get_instance();
}