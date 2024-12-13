<?php
$nova_theme = nova_get_theme_options();
// -----------------------------------------------------------------------------
// Body Class - Preloader
// -----------------------------------------------------------------------------
function nova_preloader_class($classes) {
    global $nova_theme;
    if( isset($nova_theme['site_preloader']) && $nova_theme['site_preloader'] === '1' ) $classes[] = 'beforePreload';
    return $classes;
}
// -----------------------------------------------------------------------------
// Body Class - Header Sticky
// -----------------------------------------------------------------------------
function nova_header_sticky_class($classes) {
  global $nova_theme;
    if( isset($nova_theme['enable_sticky_header']) && $nova_theme['enable_sticky_header'] === '1' ) $classes[] = 'sticky-header-enabled';
    return $classes;
}
// -----------------------------------------------------------------------------
// Body Class - Header Transparent
// -----------------------------------------------------------------------------
function nova_header_transparent($classes) {
  global $nova_theme;
    if( isset($nova_theme['header_transparent']) && $nova_theme['header_transparent'] === '1' ) $classes[] = 'has-transparent-header';
    return $classes;
}

// -----------------------------------------------------------------------------
// Body Class - Blog Sidebar
// -----------------------------------------------------------------------------

function nova_blog_sidebar($classes) {
    if ( !is_single() ) {
        if ( 1 == nova_get_option('blog_sidebar',1) ) {
            $classes[] = 'blog-sidebar-active';
            $classes[] = 'blog-sidebar-' . nova_get_option('blog_sidebar_position','right');
        }
    } else if ( is_single() ) {
            $classes[] = 'blog-sidebar-active';
            $classes[] = 'blog-sidebar-' . nova_get_option('blog_single_sidebar_position','right');
    }
    if ( 1 == nova_get_option('blog_single_sidebar',1) ) {
        $classes[] = 'single-blog-sidebar-active';
    }
    return $classes;
}

// -----------------------------------------------------------------------------
// Body Class - Page Without Title
// -----------------------------------------------------------------------------

function nova_page_title($classes) {

    $page_title_option_class            = '';
    $page_title_option_class_no_title   = 'page-without-title';

    if (get_post_meta( nova_get_page_id(), 'meta_box_page_header_enable', true )) {

        $page_title_option = get_post_meta( nova_get_page_id(), 'meta_box_page_header_enable', true );

        switch ( $page_title_option ) {
            case "off":
                $page_title_option_class = $page_title_option_class_no_title;
                break;
        }

    }
    $classes[] = $page_title_option_class;

    if (get_post_meta( nova_get_page_id(), 'meta_box_page_header_center', true )) {
      $classes[] = 'page-header-center';
    }
    return $classes;
}

// -----------------------------------------------------------------------------
// Body Class - Shop
// -----------------------------------------------------------------------------

function nova_shop($classes) {

    if ( NOVA_WOOCOMMERCE_IS_ACTIVE ) {
        if ( is_shop() || is_product_category() || is_product_tag() || (is_tax() && is_woocommerce()) ) {
            $classes[] = 'woocommerce-shop';
        }
    }
    return $classes;
}

// -----------------------------------------------------------------------------
// Body Class - Shop Pagination
// -----------------------------------------------------------------------------

function nova_shop_pagination($classes) {

    if ( NOVA_WOOCOMMERCE_IS_ACTIVE ) {
        if ( is_shop() || is_product_category() || is_product_tag() || (is_tax() && is_woocommerce()) ) {
            $classes[] = 'shop-pagination-' . nova_get_option('shop_pagination','infinite_scroll');
        }
    }
    return $classes;
}

// -----------------------------------------------------------------------------
// Body Class - Shop Sidebar
// -----------------------------------------------------------------------------

function nova_shop_sidebar($classes) {
    if ( NOVA_WOOCOMMERCE_IS_ACTIVE ) {
        if ( is_shop() || is_product_category() || is_product_tag() || (is_tax() && is_woocommerce()) ) {
            if ( 1 == nova_get_option('shop_sidebar', 1) ) {
                $classes[] = 'shop-sidebar-active';
                $classes[] = 'shop-sidebar-' . nova_get_option('shop_sidebar_position','left');
            }
        }
    }
    return $classes;
}

// -----------------------------------------------------------------------------
// Body Class - Single Product Sidebar
// -----------------------------------------------------------------------------

function nova_single_product_sidebar($classes) {
    if ( NOVA_WOOCOMMERCE_IS_ACTIVE ) {
        if ( is_product() ) {
            if ( 1 == nova_get_option('single_product_sidebar', 0) ) {
                $classes[] = 'single-product-sidebar-active';
                $classes[] = 'single-product-sidebar-' . nova_get_option('single_product_sidebar_position','right');
            }
        }
    }
    return $classes;
}

// -----------------------------------------------------------------------------
// Body Class - Catalog Mode
// -----------------------------------------------------------------------------

function nova_catalog_mode($classes) {
    if ( 1 == nova_get_option('catalog_mode', 0) ) $classes[] = 'catalog-mode';
    return $classes;
}

// -----------------------------------------------------------------------------
// Body Class - Shop Pagination
// -----------------------------------------------------------------------------
function nova_blog_pagination($classes) {

    if ( is_home() || is_archive() || is_search() ) {
        $classes[] = 'blog-pagination-' . nova_get_option('blog_pagination','default');
    }

    return $classes;
}


// -----------------------------------------------------------------------------
// Print Body Classes
// -----------------------------------------------------------------------------

function nova_customiser_body_classes() {

    add_filter( 'body_class', 'nova_preloader_class' );
    add_filter( 'body_class', 'nova_header_sticky_class' );
    add_filter( 'body_class', 'nova_header_transparent' );
    add_filter( 'body_class', 'nova_blog_sidebar' );
    add_filter( 'body_class', 'nova_page_title' );
    add_filter( 'body_class', 'nova_shop' );
    add_filter( 'body_class', 'nova_shop_pagination' );
    add_filter( 'body_class', 'nova_shop_sidebar' );
    add_filter( 'body_class', 'nova_single_product_sidebar' );
    add_filter( 'body_class', 'nova_blog_pagination' );
}

add_action( 'wp_head', 'nova_customiser_body_classes', 100 );
