<?php

// =============================================================================
// Enqueue Scripts
// =============================================================================

if ( ! function_exists('nova_scripts') ) :
function nova_scripts() {
	$theme_version = defined('NOVA_DEBUG') && NOVA_DEBUG ? time() : nova_theme_version();
	wp_enqueue_script('imagesloaded');
	if ( NOVA_WOOCOMMERCE_IS_ACTIVE ) {
		wp_enqueue_script('select2');
		wp_enqueue_script('flexslider');
		wp_enqueue_script('wc-single-product');
		wp_enqueue_script('wc-add-to-cart-variation');
	}

	if ( NOVA_VISUAL_COMPOSER_IS_ACTIVE) // If VC exists/active load scripts after VC
	{
		$dependencies = array('jquery', 'wpb_composer_front_js');
	}
	else // Do not depend on VC
	{
		$dependencies = array('jquery');
	}
	wp_enqueue_script('foundation', get_template_directory_uri() . '/assets/vendor/foundation/dist/js/foundation.min.js', $dependencies, $theme_version, TRUE);
	wp_enqueue_script('cookies', get_template_directory_uri() . '/assets/vendor/cookies/js.cookie.js', $dependencies, $theme_version, TRUE);
	wp_enqueue_script('jquery-visible', get_template_directory_uri() . '/assets/vendor/jquery-visible/jquery.visible.js', $dependencies, $theme_version, TRUE);
	wp_enqueue_script('scrollTo', get_template_directory_uri() . '/assets/vendor/scrollTo/jquery.scrollTo.min.js', $dependencies, $theme_version, TRUE);
	wp_enqueue_script('hoverIntent', get_template_directory_uri() . '/assets/vendor/hoverIntent/jquery.hoverIntent.min.js', $dependencies, $theme_version, TRUE);
	wp_enqueue_script('perfect-scrollbar', get_template_directory_uri() . '/assets/vendor/jquery.perfect-scrollbar.min.js', $dependencies, '0.7.1', TRUE);
	wp_enqueue_script('mojs', get_template_directory_uri() . '/assets/vendor/mojs/mo.min.js', $dependencies, $theme_version, TRUE);
	wp_enqueue_script('anime', get_template_directory_uri() . '/assets/vendor/anime/anime.min.js', $dependencies, $theme_version, TRUE);
	wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/vendor/swiper/js/swiper-bundle.min.js', $dependencies, $theme_version, TRUE);
	wp_enqueue_script('headroom', get_template_directory_uri() . '/assets/vendor/headroom.js/headroom.min.js', $dependencies, $theme_version, TRUE);
	wp_enqueue_script('slick', get_template_directory_uri() . '/assets/vendor/slick/slick.min.js', $dependencies, $theme_version, TRUE);
	wp_enqueue_script('sticky-kit', get_template_directory_uri() . '/assets/vendor/sticky-kit/jquery.sticky-kit.min.js', $dependencies, $theme_version, TRUE);
	wp_enqueue_script('jquery-loading-overlay', get_template_directory_uri() . '/assets/vendor/jquery-loading-overlay/loadingoverlay.min.js', $dependencies, $theme_version, TRUE);
	wp_enqueue_script('readmore', get_template_directory_uri() . '/assets/vendor/readmore/readmore.js', $dependencies, nova_theme_version(), TRUE);
	wp_enqueue_script('isotope', get_template_directory_uri() . '/assets/vendor/isotope/isotope.pkgd.min.js', $dependencies, nova_theme_version(), TRUE);
	wp_enqueue_script('video-popup', get_template_directory_uri() . '/assets/vendor/video.popup.js', $dependencies, nova_theme_version(), TRUE);
	wp_enqueue_script('animatedModal', get_template_directory_uri() . '/assets/vendor/animatedModal.js/animatedModal.js', $dependencies, nova_theme_version(), TRUE);
	if( nova_get_option('site_preloader',1) ) {
		wp_enqueue_script('jquery-easing', get_template_directory_uri() . '/assets/js/lib/jquery.easing.js', $dependencies, '2.1', TRUE);
		wp_enqueue_script('topbar', get_template_directory_uri() . '/assets/js/lib/topbar.min.js', $dependencies, '2.1', TRUE);
		wp_enqueue_script('jpreloader', get_template_directory_uri() . '/assets/js/lib/jpreloader.js', $dependencies, '2.1', TRUE);
		wp_enqueue_script('circle-progress', get_template_directory_uri() . '/assets/js/lib/circle-progress.min.js', $dependencies, '1.2.2', TRUE);
	}
	wp_enqueue_script('nova-app', get_template_directory_uri() . '/assets/js/app.js', $dependencies, $theme_version, TRUE);
	wp_register_script('fancybox', get_template_directory_uri() . '/assets/vendor/fancybox/jquery.fancybox.min.js', $dependencies, '3.5.7', TRUE);


	// Send wp variables to js

	$nova_js_vars = array(
		'js_path' 						=> esc_attr(get_template_directory_uri() . '/assets/js/vendor/'),
		'js_min'        				=> true,
		'site_preloader' 				=> nova_get_option('site_preloader',1),
		'topbar_progress' 				=> nova_get_option('topbar_progress',1),
		'select_placeholder'        	=> esc_html__( 'Choose an option', 'natsy' ),
		'blog_pagination_type' 			=> nova_get_option('blog_pagination','default'),
		'load_more_btn'        			=> esc_html__( 'Load more', 'natsy' ),
		'read_more_btn'        			=> esc_html__( 'Read more', 'natsy' ),
		'read_less_btn'        			=> esc_html__( 'Read less', 'natsy' ),
		'enable_header_sticky' 			=> nova_get_option('enable_sticky_header'),
		'shop_pagination_type' 			=> nova_get_option('shop_pagination','infinite_scroll'),
		'accent_color' 					=> esc_html(nova_get_option('primary_color')),
		'shop_display'							=> 'grid',
		'popup_show_after'					=> 2000,
		'product_image_zoom'				=> nova_get_option('product_image_zoom',1),
		'is_customize_preview'			=> is_customize_preview()
	);

	wp_localize_script( 'nova-app', 'nova_js_var', $nova_js_vars );

	if (is_singular() && comments_open() && get_option( 'thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

}
add_action( 'wp_enqueue_scripts', 'nova_scripts' );
endif;
