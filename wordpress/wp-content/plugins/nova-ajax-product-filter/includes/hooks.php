<?php
/**
 * List of hooks in Nova Ajax Product Filter plugin.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

$novaapf = new NOVAAPF();

add_action('woocommerce_before_shop_loop', array('NOVAAPF', 'beforeProductsHolder'), 0);
add_action('woocommerce_after_shop_loop', array('NOVAAPF', 'afterProductsHolder'), 200);
add_action('woocommerce_before_template_part', array('NOVAAPF', 'beforeNoProducts'), 0);
add_action('woocommerce_after_template_part', array('NOVAAPF', 'afterNoProducts'), 200);

add_action('paginate_links', array('NOVAAPF', 'paginateLinks'));

// frontend sctipts
add_action('wp_enqueue_scripts', array($novaapf, 'frontendScripts'));

// filter products
add_action('woocommerce_product_query', array($novaapf, 'setFilter'));

// clear old transients
add_action('create_term', 'novaapf_clear_transients');
add_action('edit_term', 'novaapf_clear_transients');
add_action('delete_term', 'novaapf_clear_transients');

add_action('save_post', 'novaapf_clear_transients');
add_action('delete_post', 'novaapf_clear_transients');