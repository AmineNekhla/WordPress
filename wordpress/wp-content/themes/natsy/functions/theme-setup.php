<?php

// =============================================================================
// Theme Setup
// =============================================================================

if ( ! function_exists( 'nova_theme_setup' ) ) :

	function nova_theme_setup() {

		load_theme_textdomain( 'natsy', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'custom-header' );
		add_theme_support( 'custom-background' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'woocommerce', array(

			'product_grid'          => array(
		        'default_rows'    => 3,
		        'min_rows'        => 1,
		        'max_rows'        => 10,

		        'default_columns' => 4,
		        'min_columns'     => 1,
		        'max_columns'     => 6,
		    ),
		) );
		add_theme_support('novaworks', [
				'kitify'    => true,
				'kitify-woo' => [
					'product-loop'    			=> true,
					'show-cat-in-list'    		=> true,
					'show-rating-in-list'    	=> true,
				],
				'elementor'       => [
						'kitify-hamburger-panel'  => false,
						'css-transform'     			=> false,
						'floating-effects'  			=> false,
						'wrapper_links'     			=> false,
						'custom-fonts'      			=> false,
						'mega-menu'         			=> false,
				],
		]);
		add_editor_style('editor-style.css');
		// gutenberg
		add_theme_support( 'align-wide' );
		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		remove_theme_support( 'wc-product-gallery-zoom' );

		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));
		//Image size
		add_image_size( 'nova-image-square', 1100, 1100, true );
		add_image_size( 'natsy-product-03', 600, 345, true );
		//Kitify

		$kitsetting = get_option('kitify-settings', []);
		if(empty($kitsetting)){
				$kitsetting = [];
		}
		$kitsetting = array_merge($kitsetting, [
				'single_post_template' => 'templates/fullwidth.php',
				'single_page_template' => 'templates/fullwidth.php',
		]);
		update_option('kitify-settings', $kitsetting);
		update_option('natsy_has_init', true);
		update_option( 'elementor_cpt_support', array( 'page', 'post') );
		update_option( 'elementor_page_title_selector', '.page-header' );
		update_option( 'elementor_editor_break_lines', 1 );
		update_option( 'elementor_space_between_widgets', '0' );
		update_option( 'elementor_unfiltered_files_upload', 1 );
		update_option( 'elementor_edit_buttons', 'on' );
	}

	add_action( 'after_setup_theme', 'nova_theme_setup', 100 );

	if ( ! isset( $content_width ) ) {
		$content_width = 1920; // pixels
	}

endif;

// =============================================================================
// WC Notification Classes
// =============================================================================

add_filter('woocommerce_add_success', 'custom_wc_notices_class', 10, 1);
add_filter('woocommerce_add_error', 'custom_wc_notices_class', 10, 1);
function custom_wc_notices_class( $message) {
	$class = 'no-button';
	if ( (strpos($message, '</a>') !== false) || (strpos($message, '<button') !== false) ) {
	    $class = 'with-button';
	}

	return '<p class="'.$class.'">'.$message.'</p>';
}

// ==============================================================================
// Add a pingback url auto-discovery header for single posts, pages, or attachments.
// ==============================================================================
if ( ! function_exists( 'nova_pingback_header' ) ) {
	function nova_pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
		}
	}
	add_action( 'wp_head', 'nova_pingback_header' );
}
