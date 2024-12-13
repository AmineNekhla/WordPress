<?php

// -----------------------------------------------------------------------------
// Define Constants
// -----------------------------------------------------------------------------

define( 'NOVA_WOOCOMMERCE_IS_ACTIVE', 	class_exists( 	'WooCommerce' ) );
define( 'NOVA_VISUAL_COMPOSER_IS_ACTIVE', defined( 		'WPB_VC_VERSION' ) );
define( 'NOVA_REV_SLIDER_IS_ACTIVE', 		class_exists( 	'RevSlider' ) );
define( 'NOVA_WPML_IS_ACTIVE', 			defined( 		'ICL_SITEPRESS_VERSION' ) );
define( 'NOVA_WISHLIST_IS_ACTIVE', 		class_exists( 	'YITH_WCWL' ) );
define( 'NOVA_KIRKI_IS_ACTIVE', 			class_exists( 	'Kirki' ) );
define( 'NOVA_GERMANIZED_IS_ACTIVE', 		class_exists( 	'WooCommerce_Germanized' ) );
define( 'NOVA_RWMB_IS_ACTIVE', 		class_exists( 	'RWMB_Core' ) );
define( 'KITIFY_IS_ACTIVE', 		class_exists( 	'Kitify' ) );


// -----------------------------------------------------------------------------
// String to Slug
// -----------------------------------------------------------------------------

if ( ! function_exists( 'nova_string_to_slug' ) ) :
function nova_string_to_slug($str) {
	$str = strtolower(trim($str));
	$str = preg_replace('/[^a-z0-9-]/', '_', $str);
	$str = preg_replace('/-+/', "_", $str);
	return $str;
}
endif;


// -----------------------------------------------------------------------------
// Theme Name
// -----------------------------------------------------------------------------

if ( ! function_exists( 'nova_theme_name' ) ) :
function nova_theme_name() {
	$nova_theme = wp_get_theme();
	return $nova_theme->get('Name');
}
endif;

// -----------------------------------------------------------------------------
// Parent Theme Name
// -----------------------------------------------------------------------------

if ( ! function_exists( 'nova_parent_theme_name' ) ) :
function nova_parent_theme_name()
{
	$theme = wp_get_theme();
	if ($theme->parent()):
		$theme_name = $theme->parent()->get('Name');
	else:
		$theme_name = $theme->get('Name');
	endif;

	return $theme_name;
}
endif;


// -----------------------------------------------------------------------------
// Theme Slug
// -----------------------------------------------------------------------------

if ( ! function_exists( 'nova_theme_slug' ) ) :
function nova_theme_slug() {
	$nova_theme = wp_get_theme();
	return nova_string_to_slug( $nova_theme->get('Name') );
}
endif;


// -----------------------------------------------------------------------------
// Theme Author
// -----------------------------------------------------------------------------

if ( ! function_exists( 'nova_theme_author' ) ) :
function nova_theme_author() {
	$nova_theme = wp_get_theme();
	return $nova_theme->get('Author');
}
endif;


// -----------------------------------------------------------------------------
// Theme Description
// -----------------------------------------------------------------------------

if ( ! function_exists( 'nova_theme_description' ) ) :
function nova_theme_description() {
	$nova_theme = wp_get_theme();
	return $nova_theme->get('Description');
}
endif;


// -----------------------------------------------------------------------------
// Theme Version
// -----------------------------------------------------------------------------

if ( ! function_exists( 'nova_theme_version' ) ) :
function nova_theme_version() {
	$nova_theme = wp_get_theme();
	return $nova_theme->get('Version');
}
endif;

// -----------------------------------------------------------------------------
// Convert hex to rgb
// -----------------------------------------------------------------------------

function nova_hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);
	return implode(",", $rgb); // returns the rgb values separated by commas
	//return $rgb; // returns an array with the rgb values
}


// -----------------------------------------------------------------------------
// Page ID
// -----------------------------------------------------------------------------

function nova_get_page_id() {
	$page_id = "";
	if ( is_single() || is_page() ) {
	    $page_id = get_the_ID();
	} else {
	    $page_id = get_option('page_for_posts');
	}
	return $page_id;
}


// -----------------------------------------------------------------------------
// File Contents
// -----------------------------------------------------------------------------

function nova_get_local_file_contents($file_path) {

    $url_get_contents_data = false;

	if (function_exists('ob_start') && function_exists('ob_get_clean') && ($url_get_contents_data == false))
    {
        ob_start();
	    include $file_path;
	    $url_get_contents_data = ob_get_clean();
    }

    return $url_get_contents_data;

}

// -----------------------------------------------------------------------------
// Display the main breadcrumb
// -----------------------------------------------------------------------------

function nova_site_breadcrumb() {

	if ( nova_get_option('page_header_breadcrumb_toggle',1) == false ) {
		return;
	}

	$yoast = get_option( 'wpseo_internallinks' );

	if ( function_exists( 'yoast_breadcrumb' ) && $yoast && $yoast['breadcrumbs-enable'] ) {
		yoast_breadcrumb( '<div class="breadcrumb">', '</div>' );
	} elseif ( ( NOVA_WOOCOMMERCE_IS_ACTIVE ) ) {
		woocommerce_breadcrumb();
	} else {
		echo '<nav class="woocommerce-breadcrumb">';
		nova_breadcrumbs();
		echo '</nav>';
	}
}

// -----------------------------------------------------------------------------
// Check Woocommerce Page
// -----------------------------------------------------------------------------

function is_realy_woocommerce_page () {
    if( function_exists ( "is_woocommerce" ) && is_woocommerce()){
        return true;
    }
    $woocommerce_keys = array ( "woocommerce_shop_page_id" ,"woocommerce_terms_page_id") ;

    foreach ( $woocommerce_keys as $wc_page_id ) {
        if ( nova_get_page_id () == get_option ( $wc_page_id , 0 ) ) {
            return true ;
        }
    }
    return false;
}
function nova_page_need_header () {
	if(is_404()) {
		return false;
	}
	if( function_exists ( "is_product" ) && is_product()){
			return false;
	}
	return true;
}
//==============================================================================
// remove_js_autop
//==============================================================================
if( ! function_exists('nova_remove_js_autop') ):
	function nova_remove_js_autop($content, $autop = false){
			if ( $autop ) {
					$content = preg_replace( '/<\/?p\>/', "\n", $content );
					$content = preg_replace( '/<p[^>]*><\\/p[^>]*>/', "", $content );
					$content = wpautop( $content . "\n" );
			}
			return do_shortcode( shortcode_unautop( $content ) );
	}
endif;
//==============================================================================
// Footer Builder Template
//==============================================================================
if(!function_exists('nova_get_config_footer_layout_opts')) {
	function nova_get_config_footer_layout_opts(){

			$args = array(
					'post_type' => 'elementor_library',
					'posts_per_page' => -1,
					'post_status' => 'publish',
					'nopaging' => true,
					// 'tax_query' => array(
					// 		array(
					// 				'taxonomy' => 'elementor_library_type',
					// 				'field' => 'slug',
					// 				'terms' => 'footer'
					// 		)
					// )
			);

			wp_reset_postdata();

			$query = new WP_Query($args);
			// echo "<pre>";
			// print_r($query);
			// echo "</pre>";
			// die();
			$options = array();

			if($query->have_posts()){
					while ($query->have_posts()){
							$query->the_post();
							$options[get_the_ID()] = get_the_title();
					}
			}
			wp_reset_postdata();
			return $options;
	}
}

//==============================================================================
// Render Post Meta
//==============================================================================
if ( ! function_exists( 'nova_get_post_meta' ) ) {
    function nova_get_post_meta( $object_id, $sub_key = '', $meta_key = '', $single = true ) {

        if (!is_numeric($object_id)) {
            return false;
        }

        if (empty($meta_key)) {
            $meta_key = '_natsy_post_options';
        }

        $object_value = get_post_meta($object_id, $meta_key, $single);

        if(!empty($sub_key)){
            if( $single ) {
                if(isset($object_value[$sub_key])){
                    return $object_value[$sub_key];
                }
                else{
                    return false;
                }
            }
            else{
                $tmp = array();
                if( ! empty( $object_value ) ) {
                    foreach( $object_value as $k => $v ){
                        $tmp[] = (isset($v[$sub_key])) ? $v[$sub_key] : '';
                    }
                }
                return $tmp;
            }
        }
        else{
            return $object_value;
        }
    }
}
 //==============================================================================
 // Render single post format content
 //==============================================================================

if(!function_exists('nova_single_post_thumbnail')){
    function nova_single_post_thumbnail( $thumbnail_size = 'full' ) {
        if ( post_password_required() || is_attachment() ) {
            return;
        }
        if(has_post_thumbnail()){ ?>
            <div class="post-thumbnail">
							<a<?php
							if( 'video' == get_post_format() && NOVA_RWMB_IS_ACTIVE  ){
									$popup_video_link = rwmb_meta('natsy_post_video_url');
									$id = rand();
									if(!empty($popup_video_link)) {
										printf(' data-video-url="%s" id="%s" class="js-video-popup-btn post-thumbnail__link"', $popup_video_link,$id );
									}
							}
							else{
									?> class="post-thumbnail__link" href="<?php the_permalink();?>"<?php
							}
							?>>
                    <figure class="blog_item--thumbnail figure__object_fit">
                        <?php echo get_the_post_thumbnail(get_the_ID(), $thumbnail_size, array('class' => 'post-thumbnail__img')); ?>
                    </figure>
										<?php
										if( 'video' == get_post_format() && NOVA_RWMB_IS_ACTIVE  ){
												$popup_video_link = rwmb_meta('natsy_post_video_url');
												if(!empty($popup_video_link)) {
													printf('<span class="video-play-btn"></span>', $popup_video_link );
												}
										}
										?>
                </a>
            </div>
            <?php
        }

    }
}

 //==============================================================================
 // Return correct schema markup
 //==============================================================================
if ( ! function_exists( 'nova_get_schema_markup' ) ) {

    function nova_get_schema_markup( $location, $original_render = false ) {

        // Default
        $schema = $itemprop = $itemtype = '';

        // HTML
        if ( 'html' == $location ) {
            $schema = 'itemscope itemtype="//schema.org/WebPage"';
        }

        // Header
        elseif ( 'header' == $location ) {
            $schema = 'itemscope="itemscope" itemtype="//schema.org/WPHeader"';
        }

        // Logo
        elseif ( 'logo' == $location ) {
            $schema = 'itemscope itemtype="//schema.org/Brand"';
        }

        // Navigation
        elseif ( 'site_navigation' == $location ) {
            $schema = 'itemscope="itemscope" itemtype="//schema.org/SiteNavigationElement"';
        }

        // Main
        elseif ( 'main' == $location ) {
            $itemtype = '//schema.org/WebPageElement';
            $itemprop = 'mainContentOfPage';
            if ( is_singular( 'post' ) ) {
                $itemprop = '';
                $itemtype = '//schema.org/Blog';
            }
        }

        // Breadcrumb
        elseif ( 'breadcrumb' == $location ) {
            $schema = 'itemscope itemtype="//schema.org/BreadcrumbList"';
        }

        // Breadcrumb list
        elseif ( 'breadcrumb_list' == $location ) {
            $schema = 'itemprop="itemListElement" itemscope itemtype="//schema.org/ListItem"';
        }

        // Breadcrumb itemprop
        elseif ( 'breadcrumb_itemprop' == $location ) {
            $schema = 'itemprop="breadcrumb"';
        }

        // Sidebar
        elseif ( 'sidebar' == $location ) {
            $schema = 'itemscope="itemscope" itemtype="//schema.org/WPSideBar"';
        }

        // Footer widgets
        elseif ( 'footer' == $location ) {
            $schema = 'itemscope="itemscope" itemtype="//schema.org/WPFooter"';
        }

        // Headings
        elseif ( 'headline' == $location ) {
            $schema = 'itemprop="headline"';
        }

        // Posts
        elseif ( 'entry_content' == $location ) {
            $schema = 'itemprop="text"';
        }

        // Publish date
        elseif ( 'publish_date' == $location ) {
            $schema = 'itemprop="datePublished"';
        }

        // Author name
        elseif ( 'author_name' == $location ) {
            $schema = 'itemprop="name"';
        }

        // Author link
        elseif ( 'author_link' == $location ) {
            $schema = 'itemprop="author" itemscope="itemscope" itemtype="//schema.org/Person"';
        }

        // Item
        elseif ( 'item' == $location ) {
            $schema = 'itemprop="item"';
        }

        // Url
        elseif ( 'url' == $location ) {
            $schema = 'itemprop="url"';
        }

        // Position
        elseif ( 'position' == $location ) {
            $schema = 'itemprop="position"';
        }

        // Image
        elseif ( 'image' == $location ) {
            $schema = 'itemprop="image"';
        }

        // Name
        elseif ( 'name' == $location ) {
            $schema = 'itemprop="name"';
        }
        else{
            if($original_render){
                $schema = $location;
            }
        }
        return ' ' . apply_filters( 'nova_schema_markup', $schema, $location );

    }

}

//==============================================================================
//  Post excerpt limit words.
//==============================================================================
if ( ! function_exists( 'natsy_excerpt' ) ) {

	function natsy_excerpt( $length = 30 ) {
		global $post;

		// Check for custom excerpt
		if ( has_excerpt( $post->ID ) ) {
			$output = $post->post_excerpt;
		}

		// No custom excerpt
		else {

			// Check for more tag and return content if it exists
			if ( strpos( $post->post_content, '<!--more-->' ) || strpos( $post->post_content, '<!--nextpage-->' ) ) {
				$output = apply_filters( 'the_content', get_the_content() );
			}

			// No more tag defined
			else {
				$output = wp_trim_words( strip_shortcodes( $post->post_content ), $length );
			}

		}

		return $output;

	}

}
if ( ! function_exists( 'nova_post_time_ago' ) ) {
	function nova_post_time_ago( $type = 'post' ) {
	    $d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';

	    return human_time_diff($d('U'), current_time('timestamp')) . " " . esc_html__('ago','natsy');

	}
}
/* Fullscreen menu check */
function nova_load_menu_location($location) {

	if (has_nav_menu( $location )) {
		$menu = $location;
	} else if (has_nav_menu( 'nova_menu_primary' )) {
		$menu = 'nova_menu_primary';
	} else {
		$menu = false;
	}

	return $menu;
}

// Replace global $nova_theme with function (security)
if( !function_exists('nova_get_theme_options') ){
    function nova_get_theme_options() {
        if( !defined('NOVA_PLUGIN_PATH') ) return false;
        global $nova_theme;
        if( empty($nova_theme) ){
            $nova_theme = get_option( NOVA_FRAMEWORK_VAR );
        }
        if( !empty($nova_theme) ){
            return $nova_theme;
        }else{
            return false;
        }
    }
}
if( !function_exists('nova_get_option') ){
    function nova_get_option( $option = '', $default = '' ) {
        global $nova_theme;
        if( empty($nova_theme) && defined('NOVA_PLUGIN_PATH') ){
            $nova_theme = get_option( NOVA_FRAMEWORK_VAR );
        }
        if( !empty($nova_theme) && isset( $nova_theme[ $option ] ) && defined('NOVA_PLUGIN_PATH') ){
            return $nova_theme[ $option ];
        }else{
            if( $default !== '' ){
                return $default;
            }
            return false;
        }
    }
}

if ( ! function_exists( 'nova_elementor_has_location' ) ) {
	function nova_elementor_has_location( $location ) {
		if ( ! KITIFY_IS_ACTIVE  ) {
			return false;
		}
		if(kitify()->has_elementor_pro()){
				$conditions_manager = \ElementorPro\Modules\ThemeBuilder\Module::instance()->get_conditions_manager();
		}
		else{
				$conditions_manager = \KitifyThemeBuilder\Modules\ThemeBuilder\Module::instance()->get_conditions_manager();
		}
		$documents = $conditions_manager->get_documents_for_location( $location );
		return !empty( $documents );
	}
}
