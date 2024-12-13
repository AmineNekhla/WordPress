<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if(!function_exists('nova_get_all_image_sizes')){
    function nova_get_all_image_sizes() {

        global $_wp_additional_image_sizes;

        $sizes  = get_intermediate_image_sizes();
        $result = array();

        foreach ( $sizes as $size ) {
            if ( in_array( $size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
                $result[ $size ] = ucwords( trim( str_replace( array( '-', '_' ), array( ' ', ' ' ), $size ) ) );
            } else {
                $result[ $size ] = sprintf(
                    '%1$s (%2$sx%3$s)',
                    ucwords( trim( str_replace( array( '-', '_' ), array( ' ', ' ' ), $size ) ) ),
                    $_wp_additional_image_sizes[ $size ]['width'],
                    $_wp_additional_image_sizes[ $size ]['height']
                );
            }
        }

        return array_merge( array( 'full' => esc_html__( 'Full', 'novaworks' ) ), $result );
    }
}
if( !function_exists('nova_build_link_from_atts')) {
    function nova_build_link_from_atts($value){
        $result = array( 'url' => '', 'title' => '', 'target' => '', 'rel' => '' );
        $params_pairs = explode( '|', $value );
        if ( ! empty( $params_pairs ) ) {
            foreach ( $params_pairs as $pair ) {
                $param = preg_split( '/\:/', $pair );
                if ( ! empty( $param[0] ) && isset( $param[1] ) ) {
                    $result[ $param[0] ] = rawurldecode( $param[1] );
                }
            }
        }
        return $result;
    }
}

if( !function_exists('nova_get_param_slider_shortcode')) {
  function nova_get_param_slider_shortcode( $atts, $param_column = 'columns' ){
      $slider_type    = $slide_to_scroll = $speed = $infinite_loop = $autoplay = $autoplay_speed = '';
      $lazyload       = $arrows = $dots = $dots_icon = $next_icon = $prev_icon = $dots_color = $draggable = $touch_move = '';
      $rtl            = $arrow_color = $arrow_size = $el_class = '';
      $slides_column = $autowidth = $css_ad_carousel = $pauseohover = $centermode = $adaptive_height = '';

      extract( shortcode_atts( array(
          'slider_type' => 'horizontal',
          'slide_to_scroll' => 'all',
          'slides_column' => '',
          'infinite_loop' => '',
          'speed' => '300',
          'autoplay' => '',
          'autoplay_speed' => '5000',
          'arrows' => '',
          'next_icon' => 'novaicon-arrow-right1',
          'prev_icon' => 'novaicon-arrow-left1',
          'custom_nav' => '',
          'dots' => '',
          'dots_color' => '#333333',
          'dots_icon' => 'novaicon-dot7',
          'draggable' => 'yes',
          'touch_move' => 'yes',
          'rtl' => '',
          'adaptive_height' => '',
          'pauseohover' => '',
          'centermode' => '',
          'autowidth' => '',
          'item_space' => '15',
          'el_class' => '',
          'css_ad_carousel' => ''
      ), $atts ) );

      if(isset($atts[$param_column])){
          $slides_column = $atts[$param_column];
      }

      $slides_column = nova_get_column_from_param_shortcode($slides_column);

      $custom_dots = $arr_style = $wrap_data = '';


      if ( $slide_to_scroll == 'all' ) {
          $slide_to_scroll = $slides_column['xlg'];
      } else {
          $slide_to_scroll = 1;
      }

      $setting_obj = array();
      $setting_obj['slidesToShow'] = absint($slides_column['xlg']);
      $setting_obj['slidesToScroll'] = absint($slide_to_scroll);

      if ( $dots == 'yes' ) {
          $setting_obj['dots'] = true;
      } else {
          $setting_obj['dots'] = false;
      }
      if ( $autoplay == 'yes' ) {
          $setting_obj['autoplay'] = true;
      }
      if ( $autoplay_speed !== '' ) {
          $setting_obj['autoplaySpeed'] = absint($autoplay_speed);
      }
      if ( $speed !== '' ) {
          $setting_obj['speed'] = absint($speed);
      }
      if ( $infinite_loop == 'yes' ) {
          $setting_obj['infinite'] = true;
      } else {
          $setting_obj['infinite'] = false;
      }
      if ( $lazyload == 'yes' ) {
          $setting_obj['lazyLoad'] = true;
      }

      if ( is_rtl() ) {
          $setting_obj['rtl'] = true;
          if ( $arrows == 'yes' ) {
              $setting_obj['arrows'] = true;
          } else {
              $setting_obj['false'] = false;
          }
      } else {
          if ( $arrows == 'yes' ) {
              $setting_obj['arrows'] = true;
          } else {
              $setting_obj['arrows'] = false;
          }
      }

      if ( $draggable == 'yes' ) {
          $setting_obj['swipe'] = true;
          $setting_obj['draggable'] = true;
      } else {
          $setting_obj['swipe'] = false;
          $setting_obj['draggable'] = false;
      }

      if ( $touch_move == 'yes' ) {
          $setting_obj['touchMove'] = true;
      } else {
          $setting_obj['touchMove'] = false;
      }

      if ( $rtl == 'yes' ) {
          $setting_obj['rtl'] = true;
      }

      if ( $slider_type == 'vertical' ) {
          $setting_obj['vertical'] = true;
      }

      if ( $pauseohover == 'yes' ) {
          $setting_obj['pauseOnHover'] = true;
      } else {
          $setting_obj['pauseOnHover'] = false;
      }

      if ( $centermode == 'yes' ) {
          $setting_obj['centerMode'] = true;
          $setting_obj['centerPadding'] = '12%';
      }

      if ( $autowidth == 'yes' ) {
          $setting_obj['variableWidth'] = true;
          $wrap_data .= ' aria-autowidth="true"';
      }

      if ( $adaptive_height == 'yes' ) {
          $setting_obj['adaptiveHeight'] = true;
      }

      $setting_obj['responsive'] = array(
          array(
              'breakpoint' => 1824,
              'settings' => array(
                  'slidesToShow' => $slides_column['lg'],
                  'slidesToScroll' => $slides_column['lg']
              )
          ),
          array(
              'breakpoint' => 1200,
              'settings' => array(
                  'slidesToShow' => $slides_column['md'],
                  'slidesToScroll' => $slides_column['md']
              )
          ),
          array(
              'breakpoint' => 992,
              'settings' => array(
                  'slidesToShow' => $slides_column['sm'],
                  'slidesToScroll' => $slides_column['sm']
              )
          ),
          array(
              'breakpoint' => 768,
              'settings' => array(
                  'slidesToShow' => $slides_column['xs'],
                  'slidesToScroll' => $slides_column['xs']
              )
          ),
          array(
              'breakpoint' => 480,
              'settings' => array(
                  'slidesToShow' => $slides_column['mb'],
                  'slidesToScroll' => $slides_column['mb']
              )
          )
      );

      $setting_obj['pauseOnDotsHover'] = true;

      $wrap_data .= "data-slick='". esc_attr(wp_json_encode($setting_obj)) ."'";

      return $wrap_data;
  }
}

if( !function_exists('nova_get_column_from_param_shortcode')) {
  function nova_get_column_from_param_shortcode( $atts ){
      $array = array(
          'xlg'	=> 3,
          'lg' 	=> 3,
          'md' 	=> 2,
          'sm' 	=> 1,
          'xs' 	=> 1,
          'mb' 	=> 1
      );
      $atts = explode(';',$atts);
      if(!empty($atts)){
          foreach($atts as $val){
              $val = explode(':',$val);
              if(isset($val[0]) && isset($val[1])){
                  if(isset($array[$val[0]])){
                      $array[$val[0]] = absint($val[1]);
                  }
              }
          }
      }
      return $array;
  }
}

if( !function_exists('nova_field_column')) {
  function nova_field_column($options = array()){
      return array_merge(array(
          'type' 			=> 'nova_column',
          'heading' 		=> esc_html__('Column', 'reddot'),
          'param_name' 	=> 'column',
          'unit'			=> '',
          'media'			=> array(
              'xlg'	=> 1,
              'lg'	=> 1,
              'md'	=> 1,
              'sm'	=> 1,
              'xs'	=> 1,
              'mb'	=> 1
          )
      ), $options);
  }
}

if( !function_exists('nova_get_param_index')) {
  function nova_get_param_index($array, $attr){
      foreach ($array as $index => $entry) {
          if ($entry['param_name'] == $attr) {
              return $index;
          }
      }
      return -1;
  }
}

if( !function_exists('nova_get_responsive_media_css')) {
  function nova_get_responsive_media_css( $args = array() ){
      $content = '';
      if(!empty($args) && !empty($args['target']) && !empty($args['media_sizes'])){
          $content .=  " data-el_target='".esc_attr($args['target'])."' ";
          $content .=  " data-el_media_sizes='".esc_attr(wp_json_encode($args['media_sizes']))."' ";
      }
      return $content;
  }
}

if( !function_exists('nova_render_ressponive_media_css')) {
  function nova_render_ressponive_media_css(&$css = array(), $args = array()){

      if(!empty($args) && !empty($args['target']) && !empty($args['media_sizes'])){
          $target = $args['target'];
          foreach( $args['media_sizes'] as $css_attribute => $items ){
              $media_sizes =  explode(';', $items);
              if(!empty($media_sizes)){
                  foreach($media_sizes as $value ){
                      $tmp = explode(':', $value);
                      if(!empty($tmp[1])){
                          if(!isset($css[$tmp[0]])){
                              $css[$tmp[0]] = '';
                          }
                          $css[$tmp[0]] .= $target . '{' . $css_attribute . ':'. $tmp[1] .'}';
                      }
                  }
              }
          }
      }
      return $css;
  }
}

if( !function_exists('nova_render_responsive_media_style_tags')) {
  function nova_render_responsive_media_style_tags( $custom_css = array() ){
      $output = '';
      if(function_exists('vc_is_inline') && vc_is_inline() && !empty($custom_css)){
          foreach($custom_css as $media => $value){
              switch($media){
                  case 'lg':
                      $output .= $value;
                      break;
                  case 'xlg':
                      $output .= '@media (min-width: 1824px){'.$value.'}';
                      break;
                  case 'md':
                      $output .= '@media (max-width: 1199px){'.$value.'}';
                      break;
                  case 'sm':
                      $output .= '@media (max-width: 991px){'.$value.'}';
                      break;
                  case 'xs':
                      $output .= '@media (max-width: 767px){'.$value.'}';
                      break;
                  case 'mb':
                      $output .= '@media (max-width: 479px){'.$value.'}';
                      break;
              }
          }
      }
      if(!empty($output)){
          echo '<style type="text/css">'.$output.'</style>';
      }
  }

}
if( !function_exists('nova_shortcode_products_list')) {
  function nova_shortcode_products_list($atts, $product_type = 'recent'){
    global $woocommerce_loop;

    extract(shortcode_atts(array(
      'category' 						=> '',
      'tax' 								=> 'product_cat',
      'limit' 							=> '12',
      'orderby'							=> 'title',
      'order'								=> 'ASC',
      'layout' 							=> 'grid',
      'columns'							=> 4,
      'enable_ajax_loader' 	=> '',
    ), $atts));
    $cat = (!empty($category)) ? explode(',',$category) 	: '';
    $carousel_configs = nova_get_param_slider_shortcode( $atts );
    // setup query
		$tax_query = array();
		if($product_type == 'featured') {
			$tax_query[] = array('relation' => 'AND');
		  $tax_query[] =array(
		        'taxonomy' => 'product_visibility',
		        'field'    => 'name',
		        'terms'    => 'featured',
		        'operator' => 'IN',
		      );
		}
		if($product_type == 'best-selling') {
			$tax_query[] =array(
							'key' 		=> 'total_sales',
							'value' 	=> 0,
							'compare' 	=> '>',
						);
		}
    if($cat != "") {
      $tax_query[] =array(
                      'taxonomy' 	=> $tax,
                      'field' 	=> 'slug',
                      'terms' 	=> $cat
                );
    }

    $args = array(
      'post_type'				=> 'product',
      'post_status' 			=> 'publish',
      'ignore_sticky_posts'	=> 1,
      'posts_per_page' 		=> $limit,
      'tax_query' 			=> $tax_query,
      'orderby' => $orderby,
      'order'   => $order,
    );

    // query database
    $products = new WP_Query( $args );
    $content = '';
    if ( $products->have_posts() ) :
      $content .='<div class="nova-product-shortcodes woocommerce">';
        if ($layout == 'slider'):
        $content .='<ul class="products slick-carousel" '.$carousel_configs.'>';
        else:
          $content .='<ul class="products columns-'.$columns.'">';
        endif;
          //woocommerce_product_loop_start();
          while ( $products->have_posts() ) : $products->the_post();
            ob_start();
            wc_get_template_part( 'content', 'product' );
            $content .= ob_get_clean();
          endwhile; // end of the loop.
          //woocommerce_product_loop_end();
        $content .='</ul>';
        $content .='</div>';
    endif;
    wp_reset_postdata();
  return $content;

  }
}
if( !function_exists('nova_shortcode_products_list_ajax')) {
  function nova_shortcode_products_list_ajax($atts, $product_type = 'recent'){
    $atts = wp_json_encode($atts);
    $content = '';
    $content .= '<div class="elm-ajax-container-wrapper clearfix">';
    	$content .= '<div class="elm-ajax-loader" data-query-settings="'.esc_attr( $atts ).'" data-product-type="'.esc_attr( $product_type ).'">';
      $content .= '<div class="nova-shortcode-loading"><span></span></div>';
    	$content .= '</div>';
    $content .= '</div>';
    return $content;
  }
}
if( !function_exists('nova_redirect')) {
	function nova_redirect( $location, $status = 302, $x_redirect_by = 'WordPress' ) {
	    global $is_IIS;

	    if ( ! $location ) {
	        return false;
	    }

	    //$location = wp_sanitize_redirect( $location );

	    if ( ! $is_IIS && PHP_SAPI != 'cgi-fcgi' ) {
	        status_header( $status ); // This causes problems on IIS and some FastCGI setups
	    }

	    header( "Location: $location", true, $status );

	    return true;
	}
}
if( !function_exists('nova_addons_recurse_parse_args')) {
	function nova_addons_recurse_parse_args( $args, $default = array() ) {
		$args   = (array) $args;
		$result = $default;

		foreach ( $args as $key => $value ) {
			if ( is_array( $value ) && isset( $result[ $key ] ) ) {
				$result[ $key ] = nova_addons_recurse_parse_args( $value, $result[ $key ] );
			} else {
				$result[ $key ] = $value;
			}
		}

		return $result;
	}
}
if( !function_exists('nova_get_changeset_url')) {
	function nova_get_changeset_url () {

		$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
		$changeset_url = 'http://' . $_SERVER['HTTP_HOST'] . $uri_parts[0];

		if (isset($_GET["nova-changeset"]))
		{
		  $nova_changeset = $_GET["nova-changeset"];
		} else {
		  $nova_changeset = "";
		}
		if ($nova_changeset != "") {
			if ($nova_changeset != "default") {
				$data = array('customize_changeset_uuid'=>$nova_changeset);
				$queryString =  http_build_query($data);
				nova_redirect($changeset_url.'?'.$queryString);
				exit;
			}else {
				nova_redirect($changeset_url);
				exit;
			}
		}
	}
}
if( function_exists('nova_get_changeset_url')) {
  nova_get_changeset_url();
}

if ( ! function_exists( 'nova_excerpt' ) ) {

	function nova_excerpt( $length = 30 ) {
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
if( function_exists('nova_is_elementor_updated')) {
	function nova_is_elementor_updated() {
		if ( class_exists( 'Elementor\Icons_Manager' ) ) {
			return true;
		} else {
				return false;
		}
	}
}
if(!function_exists('nova_get_custom_breakpoints')){
    function nova_get_custom_breakpoints(){
	    $custom_breakpoints = get_option('la_custom_breakpoints');
	    $sm = !empty($custom_breakpoints['sm']) ? absint($custom_breakpoints['sm']) : 576;
	    $md = !empty($custom_breakpoints['md']) ? absint($custom_breakpoints['md']) : 992;
	    $lg = !empty($custom_breakpoints['lg']) ? absint($custom_breakpoints['lg']) : 1280;
	    $xl = !empty($custom_breakpoints['xl']) ? absint($custom_breakpoints['xl']) : 1700;

	    if( $sm <= 380 || $sm >= 992 ){
		    $sm = 576;
	    }
	    if( $md <= 992 || $md >= 1280 ){
		    $md = 992;
	    }
	    if( $lg <= 1280 || $lg >= 1700 ){
		    $lg = 1280;
	    }
	    if($lg > $xl){
		    $xl = $lg + 2;
	    }
	    if($xl > 2000){
		    $xl = 1700;
	    }

	    return [
		    'xs' => 0,
		    'sm' => $sm,
		    'md' => $md,
		    'lg' => $lg,
		    'xl' => $xl,
		    'xxl' => 2000
	    ];
    }
}
if(!function_exists('nova_entry_meta_item_category_list')){
    function nova_entry_meta_item_category_list($before = '', $after = '', $separator = ', ', $parents = '', $post_id = false){
        $categories_list = get_the_category_list('{{_}}', $parents, $post_id );
        if ( $categories_list ) {
            printf(
                '%3$s<span class="screen-reader-text">%1$s </span><span>%2$s</span>%4$s',
                esc_html_x('Posted in', 'front-view', 'vedbo'),
                str_replace('{{_}}', $separator, $categories_list),
                $before,
                $after
            );
        }
    }
}
if(!function_exists('nova_is_local')){
    function nova_is_local(){
        $is_local = false;
        if (isset($_SERVER['X_FORWARDED_HOST']) && !empty($_SERVER['X_FORWARDED_HOST'])) {
            $hostname = $_SERVER['X_FORWARDED_HOST'];
        } else {
            $hostname = $_SERVER['HTTP_HOST'];
        }
        if ( strpos($hostname, '.novaworks.net') !== false ) {
            $is_local = true;
        }
        return $is_local;
    }
}
if(!function_exists('novaworks_get_theme_support')){
    function novaworks_get_theme_support( $prop = '', $default = null ) {
        $theme_support = get_theme_support( 'novaworks' );
        $theme_support = is_array( $theme_support ) ? $theme_support[0] : false;

        if ( ! $theme_support ) {
            return $default;
        }

        if ( $prop ) {
            $prop_stack = explode( '::', $prop );
            $prop_key   = array_shift( $prop_stack );

            if ( isset( $theme_support[ $prop_key ] ) ) {
                $value = $theme_support[ $prop_key ];

                if ( count( $prop_stack ) ) {
                    foreach ( $prop_stack as $prop_key ) {
                        if ( is_array( $value ) && isset( $value[ $prop_key ] ) ) {
                            $value = $value[ $prop_key ];
                        } else {
                            $value = $default;
                            break;
                        }
                    }
                }
            } else {
                $value = $default;
            }

            return $value;
        }

        return $theme_support;
    }
}
//==============================================================================
// Render Social Sharing
//==============================================================================
if ( ! function_exists('nova_social_sharing') ) {
    function nova_social_sharing( $post_link = '', $post_title = '', $image = '', $post_excerpt = '', $echo = true){
        if(empty($post_link) || empty($post_title)){
            return;
        }
        if(!$echo){
            ob_start();
        }
        echo '<span class="social--sharing">';
        if( '1' == nova_get_option('sharing_facebook',1) ){
            printf('<a target="_blank" href="%1$s" rel="nofollow" class="facebook" title="%2$s"><i class="fab fa-facebook-f"></i></a>',
                esc_url( 'https://www.facebook.com/sharer.php?u=' . $post_link ),
                esc_attr_x('Share this post on Facebook', 'front-view', 'novaworks')
            );
        }
        if( '1' == nova_get_option('sharing_twitter',1) ){
            printf('<a target="_blank" href="%1$s" rel="nofollow" class="twitter" title="%2$s"><i class="fab fa-twitter"></i></a>',
                esc_url( 'https://twitter.com/intent/tweet?text=' . $post_title . '&url=' . $post_link ),
                esc_attr_x('Share this post on Twitter', 'front-view', 'novaworks')
            );
        }
        if( '1' == nova_get_option('sharing_reddit') ){
            printf('<a target="_blank" href="%1$s" rel="nofollow" class="reddit" title="%2$s"><i class="fab fa-reddit-alien"></i></a>',
                esc_url( 'https://www.reddit.com/submit?url=' . $post_link . '&title=' . $post_title ),
                esc_attr_x('Share this post on Reddit', 'front-view', 'novaworks')
            );
        }
        if( '1' == nova_get_option('sharing_linkedin',1) ){
            printf('<a target="_blank" href="%1$s" rel="nofollow" class="linkedin" title="%2$s"><i class="fab fa-linkedin-in"></i></a>',
                esc_url( 'https://www.linkedin.com/shareArticle?mini=true&url=' . $post_link . '&title=' . $post_title ),
                esc_attr_x('Share this post on Linked In', 'front-view', 'novaworks')
            );
        }
        if( '1' == nova_get_option('sharing_tumblr',1) ){
            printf('<a target="_blank" href="%1$s" rel="nofollow" class="tumblr" title="%2$s"><i class="fab fa-tumblr"></i></a>',
                esc_url( 'https://www.tumblr.com/share/link?url=' . $post_link ) ,
                esc_attr_x('Share this post on Tumblr', 'front-view', 'novaworks')
            );
        }
        if( '1' == nova_get_option('sharing_pinterest', 1) ){
            printf('<a target="_blank" href="%1$s" rel="nofollow" class="pinterest" title="%2$s"><i class="fab fa-pinterest-p"></i></a>',
                esc_url( 'https://pinterest.com/pin/create/button/?url=' . $post_link . '&media=' . $image . '&description=' . $post_title) ,
                esc_attr_x('Share this post on Pinterest', 'front-view', 'novaworks')
            );
        }
        if( '1' == nova_get_option('sharing_line') ){
            printf('<a target="_blank" href="%1$s" rel="nofollow" class="network-line" title="%2$s"><i class="fab fa-line"></i></a>',
                esc_url( 'https://social-plugins.line.me/lineit/share?url=' . $post_link ),
                esc_attr_x('LINE it!', 'front-view', 'novaworks')
            );

        }
        if( '1' == nova_get_option('sharing_vk') ){
            printf('<a target="_blank" href="%1$s" rel="nofollow" class="vk" title="%2$s"><i class="fab fa-vk"></i></a>',
                esc_url( 'https://vkontakte.ru/share.php?url=' . $post_link . '&title=' . $post_title ) ,
                esc_attr_x('Share this post on VK', 'front-view', 'novaworks')
            );
        }
        if( '1' == nova_get_option('sharing_whatapps') ){
            printf('<a href="%1$s" rel="nofollow" class="whatsapp" data-action="share/whatsapp/share" title="%2$s"><i class="fab fa-whatsapp"></i></a>',
                'whatsapp://send?text=' . esc_attr( $post_title . ' ' . $post_link ),
                esc_attr_x('Share via Whatsapp', 'front-view', 'novaworks')
            );
        }
        if( '1' == nova_get_option('sharing_telegram') ){
            printf('<a href="%1$s" rel="nofollow" class="telegram" title="%2$s"><i class="fab fa-telegram-plane"></i></a>',
                esc_attr( add_query_arg(array( 'url' => $post_link, 'text' => $post_title ), 'https://telegram.me/share/url') ),
                esc_attr_x('Share via Telegram', 'front-view', 'novaworks')
            );
        }
        if( '1' == nova_get_option('sharing_email') ){
            printf('<a target="_blank" href="%1$s" rel="nofollow" class="email" title="%2$s"><i class="fal fa-envelope"></i></a>',
                esc_url( 'mailto:?subject=' . $post_title . '&body=' . $post_link ),
                esc_attr_x('Share this post via Email', 'front-view', 'novaworks')
            );
        }
        echo '</span>';
        if(!$echo){
            return ob_get_clean();
        }
    }
}
if( ! function_exists('nova_single_product_share') ){
	function nova_single_product_share() {
		global $post, $product;

		$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false, ''); //Get the Thumbnail URL
		$html  = '<div class="woocommerce-product-details__share-box">';
			$html .= '<a href="//www.facebook.com/sharer/sharer.php?u=' . urlencode(get_permalink()) . '" target="_blank"><i class="fa fa-facebook"></i></a>';
			$html .= '<a href="//twitter.com/share?url=' . urlencode(get_permalink()) . '" target="_blank"><i class="fa fa-twitter"></i></a>';
			$html .= '<a href="//pinterest.com/pin/create/button/?url= '. get_permalink() .'&amp;media= '. esc_url($src[0]) .'&amp;description= ' . urlencode(get_the_title()) .'"><i class="fa fa-pinterest"></i></a>';
			$html .= '</div>';
		print wp_kses($html,'simple');
	}
}
if ( ! function_exists( 'nova_framework_get_template_with_slug' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $temp temp path to file that is being loaded
	 * @param string $slug slug that should be checked if exists
	 *
	 * @return string - string with template path
	 */
	function nova_framework_get_template_with_slug( $temp, $slug ) {
		$template = '';

		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";

				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}

		return $template;
	}
}
if ( ! function_exists( 'nova_framework_execute_template_with_params' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template path to template that is going to be included
	 * @param array $params params that are passed to template
	 *
	 * @return string - template html
	 */
	function nova_framework_execute_template_with_params( $template, $params ) {
		if ( ! empty( $template ) && file_exists( $template ) ) {
			//Extract params so they could be used in template
			if ( is_array( $params ) && count( $params ) ) {
				extract( $params, EXTR_SKIP ); // @codingStandardsIgnoreLine
			}

			ob_start();
			include( $template );
			$html = ob_get_clean();

			return $html;
		} else {
			return '';
		}
	}
}
if ( ! function_exists( 'nova_framework_get_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $root path of root folder to start templating from
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return string - string containing html of template
	 */
	function nova_framework_get_template_part( $root, $module, $template, $slug = '', $params = array() ) {
		$temp = $root . '/' . $module . '/' . $template;

		$template = nova_framework_get_template_with_slug( $temp, $slug );

		if ( is_file( $template ) ) {
			return nova_framework_execute_template_with_params( $template, $params );
		}
	}
}
if ( ! function_exists( 'natsy_core_get_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $module   name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array  $params   array of parameters to pass to template
	 *
	 * @return string - string containing html of template
	 */
	function natsy_core_get_template_part( $module, $template, $slug = '', $params = array() ) {
		$root = MINITURE_CORE_TEMP_PATH;
		return nova_framework_get_template_part( $root, $module, $template, $slug, $params );
	}
}
if ( ! function_exists( 'natsy_core_template_part' ) ) {
	/**
	 * Echo module template part.
	 *
	 * @param string $module   name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array  $params   array of parameters to pass to template
	 *
	 */
	function natsy_core_template_part( $module, $template, $slug = '', $params = array() ) {
		echo natsy_core_get_template_part( $module, $template, $slug, $params );
	}
}
if ( ! function_exists( 'natsy_core_get_list_shortcode_item_image_url' ) ) {
	/**
	 * Function that return thumbnail img url for list shortcodes
	 *
	 * @param string $image_dimension
	 * @param int $attachment_id
	 *
	 * @return string
	 */
	function natsy_core_get_list_shortcode_item_image_url( $image_dimension, $attachment_id = 0 ) {

		if ( ! empty( $attachment_id ) ) {
			$image = wp_get_attachment_image_src( intval( $attachment_id ), $image_dimension );
			$url   = is_array( $image ) ? $image[0] : '';
		} else {
			$url = get_the_post_thumbnail_url( get_the_ID(), $image_dimension );
		}

		return $url;
	}
}
if ( ! function_exists( 'natsy_core_get_custom_post_type_taxonomy_query_args' ) ) {
	/**
	 * Function that return query parameters
	 *
	 * @param array $params  - options value
	 * @param array $include - additional query arguments
	 *
	 * @return array
	 */
	function natsy_core_get_custom_post_type_taxonomy_query_args( $params, $include = array() ) {
		$args = array();

		if ( isset( $params['taxonomy'] ) && ! empty( $params['taxonomy'] ) ) {
			$args['taxonomy'] = $params['taxonomy'];
		}

		if ( isset( $params['posts_per_page'] ) && ! empty( $params['posts_per_page'] ) ) {
			$args['number'] = $params['posts_per_page'];
		}

		if ( isset( $params['orderby'] ) && ! empty( $params['orderby'] ) ) {
			$args['orderby'] = $params['orderby'];
		}

		if ( isset( $params['order'] ) && ! empty( $params['order'] ) ) {
			$args['order'] = $params['order'];
		}

		$args['hide_empty'] = isset( $params['hide_empty'] ) && 'yes' === $params['hide_empty'];

		if ( isset( $params['taxonomy_ids'] ) && ! empty( $params['taxonomy_ids'] ) ) {
			$args['include'] = explode( ',', trim( $params['taxonomy_ids'] ) );
		}

		if ( ! empty( $include ) ) {
			foreach ( $include as $key => $value ) {
				if ( ! array_key_exists( $key, $args ) ) {
					$args[$key] = $value;
				}
			}
		}

		return $args;
	}
}
if ( ! function_exists( 'natsy_core_get_list_shortcode_item_image_url' ) ) {
	/**
	 * Function that return thumbnail img url for list shortcodes
	 *
	 * @param string $image_dimension
	 * @param int $attachment_id
	 *
	 * @return string
	 */
	function natsy_core_get_list_shortcode_item_image_url( $image_dimension, $attachment_id = 0 ) {

		if ( ! empty( $attachment_id ) ) {
			$image = wp_get_attachment_image_src( intval( $attachment_id ), $image_dimension );
			$url   = is_array( $image ) ? $image[0] : '';
		} else {
			$url = get_the_post_thumbnail_url( get_the_ID(), $image_dimension );
		}

		return $url;
	}
}
if ( ! function_exists( 'natsy_core_get_list_shortcode_item_image' ) ) {
	/**
	 * Function that generates thumbnail img tag for list shortcodes
	 *
	 * @param string $image_dimension
	 * @param int $attachment_id
	 * @param int $custom_image_width
	 * @param int $custom_image_height
	 *
	 * @return string generated img tag
	 *
	 * @see qode_framework_generate_thumbnail()
	 */
	function natsy_core_get_list_shortcode_item_image( $image_dimension, $attachment_id = 0, $custom_image_width = 0, $custom_image_height = 0, $attr = array() ) {
		$item_id = get_the_ID();

		if ( 'custom' !== $image_dimension ) {
			if ( ! empty( $attachment_id ) ) {
				$html = wp_get_attachment_image( $attachment_id, $image_dimension, false, $attr );
			} else {
				$html = get_the_post_thumbnail( $item_id, $image_dimension, $attr );
			}
		}
		return apply_filters( 'natsy_core_filter_list_shortcode_item_image', $html, $attachment_id );
	}
}