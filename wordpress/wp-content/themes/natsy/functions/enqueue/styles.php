<?php

// =============================================================================
// Enqueue Styles (Front-end)
// =============================================================================

if ( ! function_exists('nova_styles') ) :
function nova_styles() {
	$theme_version = defined('NOVA_DEBUG') && NOVA_DEBUG ? time() : nova_theme_version();
	$adobe_font_id = apply_filters('kitify/adobe_fonts/id','');
	if ( NOVA_WOOCOMMERCE_IS_ACTIVE ) {
			wp_enqueue_style('select2');
	}
	$prefix = NOVA_THEMEPREFIX.'-';
	wp_enqueue_style('fontawesome-pro', get_template_directory_uri() . '/assets/vendor/fontawesome-pro/css/all.css', NULL, '5.1.0', 'all');
	wp_enqueue_style('normalize', get_template_directory_uri() . '/assets/vendor/animatedModal.js/css/normalize.min.css', NULL, '3.0.2', 'all');
	wp_enqueue_style('animate', get_template_directory_uri() . '/assets/vendor/animatedModal.js/css/animate.min.css', NULL, $theme_version, 'all');
	wp_enqueue_style('nova-natsy-layout', get_template_directory_uri() . '/assets/css/layout.css', NULL, $theme_version, 'all');
	wp_enqueue_style('nova-natsy-styles', get_template_directory_uri() . '/assets/css/app.css', NULL, $theme_version, 'all');
	wp_register_style('fancybox', get_template_directory_uri() . '/assets/vendor/fancybox/jquery.fancybox.min.css', NULL, '3.5.7', 'all');
	if( $adobe_font_id ) {
		wp_enqueue_style('typekit','https://use.typekit.net/'.$adobe_font_id.'.css', NULL, $theme_version, 'all');
	}
	wp_register_style($prefix.'google-fonts', nova_google_fonts_url(), NULL, NULL);
	wp_enqueue_style($prefix.'google-fonts');
}
add_action( 'wp_enqueue_scripts', 'nova_styles' );
endif;

if ( ! function_exists('nova_google_fonts_url') ) :
function nova_google_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* Translators: If there are characters in your language that are not supported by Outfit, translate this to 'off'. Do not translate into your own language. */

		if ( 'off' !== _x( 'on', 'Outfit font: on or off', 'natsy' ) ) {
				$fonts[] = 'Outfit:wght@300;400;500;600;700;800';
		}
		if ( 'off' !== _x( 'on', 'Syne font: on or off', 'natsy' ) ) {
			$fonts[] = 'Syne:wght@400;500;600;700;800';
		}

		if ( $fonts ) {
				$fonts_url = add_query_arg( array(
						'family' => implode( '&family=', $fonts ),
						'display' => 'swap',
				), 'https://fonts.googleapis.com/css2' );
		}
		return $fonts_url;
}
endif;
