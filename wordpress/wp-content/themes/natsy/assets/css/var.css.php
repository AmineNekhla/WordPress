<?php
$nova_theme = nova_get_theme_options();
$size_width = 1440;
$header_height = 100;
$logo_width = 115;
$black = '#000000';
$white = '#FFFFFF';
$page_header_bg_color = '#F6F6F6';
$page_header_font_color = '#F6F6F6';
$page_header_heading_color = '#FFFFFF';
$page_header_height = 300;
$page_header_font_size = 60;
$s_button_color = '#13160B';
$bg_color = '#FFFFFF';
$text_color = '#777777';
$primary_color = '#BAF120';
$titles_color = '#13160B';
$border_color = '#ECECEC';
$shop_filter_height = 150;
$font_size =  '';
$main_font = '';
$main_font_w = '';
$secondary_font = '';
$secondary_font_w = '';
$link_color = $black;
$link_hover = '#008060';
$button_color = $titles_color;
$button_bg = $primary_color;
$button_scolor = $titles_color;
$button_s_color = '#FFFFFF';
$button_s_bg = $s_button_color;

if( defined('NOVA_PLUGIN_PATH') && !empty($nova_theme) ) {
  $font_size = $nova_theme['body_font']['font-size'];
  $main_font = $nova_theme['body_font']['font-family'];
  $main_font_w = $nova_theme['body_font']['font-weight'];
  $secondary_font = $nova_theme['primary_titles_font']['font-family'];
  $secondary_font_w = $nova_theme['primary_titles_font']['font-weight'];
  if($nova_theme['content_link_color']['color']) {
    $link_color = $nova_theme['content_link_color']['color'];
  }
  if($nova_theme['content_link_color']['hover']) {
    $link_hover = $nova_theme['content_link_color']['hover'];
  }
  if($nova_theme['primary_button']['text_color']) {
    $button_color = $nova_theme['primary_button']['text_color'];
  }
  if($nova_theme['primary_button']['background']) {
    $button_bg = $nova_theme['primary_button']['background'];
  }
  if($nova_theme['secondary_button']['text_color']) {
    $button_s_color = $nova_theme['secondary_button']['text_color'];
  }
  if($nova_theme['secondary_button']['background']) {
    $button_s_bg = $nova_theme['secondary_button']['background'];
  }
}

if($main_font == '') {
  $main_font = 'Outfit';
}
if($secondary_font == '') {
  $secondary_font = 'Syne';
}
if($main_font_w == '') {
  $main_font_w = '400';
}
if($secondary_font_w == '') {
  $secondary_font_w = '700';
}
if($font_size == '') {
  $font_size = '16';
}
?>
<style>
:root {
  --site-bg-color: <?php echo esc_html(nova_get_option('bg_color',$bg_color)) ?>;
  --site-font-size: <?php echo esc_html($font_size) ?>px;
  --site-font-weight: <?php echo esc_html($main_font_w) ?>;
  --site-text-color: <?php echo esc_html(nova_get_option('text_color', $text_color)) ?>;
  --site-heading-color: <?php echo esc_html(nova_get_option('titles_color', $titles_color)) ?>;
  --site-accent-color: <?php echo esc_html(nova_get_option('primary_color', $primary_color)) ?>;
  --site-border-color: <?php echo esc_html(nova_get_option('border_color', $border_color)) ?>;
  --site-link-color: <?php echo esc_html($link_color) ?>;
  --site-link-hover-color: <?php echo esc_html($link_hover) ?>;
  --site-width: <?php echo esc_html(nova_get_option('site_width',$size_width)) ?>px;
  --site-main-font: <?php echo "'" . esc_html($main_font) . "'" ?>, sans-serif;
  --site-secondary-font: <?php echo "'" . esc_html($secondary_font) . "'" ?>, serif;
  --heading-font-weight: <?php echo esc_html($secondary_font_w) ?>;

  --site-wc-price: <?php echo "rgba(" . nova_hex2rgb(esc_html(nova_get_option('titles_color', $titles_color))) 	. ",0.8)";?>;
  --site-wc-price-old: <?php echo "rgba(" . nova_hex2rgb(esc_html(nova_get_option('titles_color', $titles_color))) 	. ",0.5)";?>;

  --site-primary-button-color: <?php echo esc_html($button_color) ?>;
  --site-primary-button-bg: <?php echo esc_html($button_bg) ?>;
  --site-secondary-button-color: <?php echo esc_html($button_s_color) ?>;
  --site-secondary-button-bg: <?php echo esc_html($button_s_bg) ?>;

  --site-header-height: <?php echo esc_html(nova_get_option('header_height',$header_height)) ?>px;
  --site-header-logo-width: <?php echo esc_html(nova_get_option('header_logo_width',$logo_width)) ?>px;
  --site-header-bg-color: #FFFFFF;
  --site-header-text-color: <?php echo esc_html(nova_get_option('text_color', $text_color)); ?>;
  --site-header-accent-color: <?php echo esc_html( nova_get_option('primary_color', $primary_color) ) ?>;
  --site-header-border-color: <?php echo "rgba(" . nova_hex2rgb(esc_html(nova_get_option('text_color', $text_color))) 	. ",0.15)";?>;

  --site-main-menu-bg-color: <?php echo esc_html($bg_color); ?>;
  --site-main-menu-text-color: <?php echo esc_html($titles_color); ?>;
  --site-main-menu-accent-color: <?php echo esc_html($primary_color); ?>;
  --site-main-menu-border-color: <?php echo esc_html($border_color); ?>;

  --mobile-header-bg-color: #FFFFFF;
  --mobile-header-text-color: #000000;
  --mobile-pre-header-bg-color: #000000;
  --mobile-pre-header-text-color: #FFFFFF;
  --mobile-pre-header-border-color: #000000;

  --page-header-bg-color: <?php echo esc_html(nova_get_option('pager_header_background_color', $page_header_bg_color)) ?>;
  <?php
    if( '' != nova_get_option('pager_header_overlay_color') ) {
      $page_header_overlay_color = nova_get_option('pager_header_overlay_color');
    }else {
      $page_header_overlay_color = '#000000';
    }
  ?>
  --page-header-overlay-color: <?php echo esc_html( $page_header_overlay_color ) ?>;
  --page-header-text-color: <?php echo esc_html(nova_get_option('pager_header_font_color', $page_header_font_color)) ?>;
  --page-header-heading-color: <?php echo esc_html(nova_get_option('pager_header_heading_color',$page_header_heading_color)) ?>;
  --page-header-height: <?php echo esc_html(nova_get_option('page_header_height',$page_header_height)) ?>px;
  --page-header-font-size: <?php echo esc_html(nova_get_option('page_header_font_size', $page_header_font_size)) ?>px;

  --dropdown-bg-color: #FFFFFF;
  --dropdown-text-color: <?php echo esc_html(nova_get_option('text_color', $text_color)); ?>;
  --dropdown-accent-color: <?php echo esc_html( nova_get_option('primary_color', $primary_color) ) ?>;
  --dropdown-secondary-color: <?php echo "rgba(" . nova_hex2rgb(esc_html(nova_get_option('text_color', $text_color))) 	. ",0.7)";?>;
  --dropdown-grey-color: <?php echo "rgba(" . nova_hex2rgb(esc_html(nova_get_option('text_color', $text_color))) 	. ",0.5)";?>;
  --dropdown-border-color: <?php echo "rgba(" . nova_hex2rgb(esc_html(nova_get_option('text_color', $text_color))) 	. ",0.15)";?>;


  --site-filter-widget-height: <?php echo esc_html(nova_get_option('shop_filter_height', $shop_filter_height)) ?>px;

  --site-button-radius: <?php echo esc_html(nova_get_option('button_radius',0)) ?>px;
  --site-field-radius: <?php echo esc_html(nova_get_option('field_radius',0)) ?>px;

}
.styling__quickview {
  --qv-bg-color: #FFFFFF;
  --qv-text-color: <?php echo esc_html(nova_get_option('text_color', $text_color)); ?>;
  --qv-heading-color: <?php echo esc_html(nova_get_option('titles_color', $titles_color)) ?>;
  --qv-border-color: <?php echo "rgba(" . nova_hex2rgb(esc_html(nova_get_option('titles_color', $titles_color))) 	. ",0.15)";?>;
}
.error-404 {
  --p404-text-color: #000000;
}
body, body .kitify {

  --kitify-primary-color: <?php echo esc_html(nova_get_option('primary_color', $primary_color)) ?>;
  --kitify-pagination-link-hover-bg-color: <?php echo esc_html(nova_get_option('primary_color', $primary_color)) ?>;
  --kitify-secondary-color: <?php echo esc_html(nova_get_option('titles_color', $titles_color)) ?>;
  --kitify-body-color: <?php echo esc_html(nova_get_option('text_color', $text_color)) ?>;
  --kitify-border-color: <?php echo esc_html(nova_get_option('border_color', $border_color)) ?>;
}
.isPageSpeed .nova-image-loading,
body > div.pace {
    display: none;
    visibility: hidden;
    /*content-visibility: hidden;*/
}
body:not(.body-loaded) .kitify-text-marquee .kititfy-m-content{
    display: none;
}
body.elementor-editor-active .kitify-text-marquee .kititfy-m-content {
    display: block !important;
}
.isPageSpeed .site-wrapper .elementor-top-section + .elementor-top-section ~ .elementor-top-section,
.isPageSpeed .elementor-kitify-nova-menu,
.isPageSpeed .elementor-location-footer {
    /*content-visibility: hidden;*/
    visibility: hidden;
    margin: 0;
    padding: 0;
}
<?php if ( nova_get_option('catalog_mode', 0) == 1 && nova_get_option('catalog_mode_price', 0) == 1 ) : ?>
    ul.products .product .product-item .product-item__description .product-item__description--info span.price,
    .woocommerce-Price-amount,
    span.onsale,
    stock.out-of-stock {
    	display: none !important;
    }
<?php endif; ?>
/********************************************************************/
/* Shop *************************************************************/
/********************************************************************/

<?php if ( nova_get_option('shop_mobile_columns', 2) == 1 ) : ?>

    @media screen and ( max-width: 480px )
    {
        ul.products:not(.shop_display_list) .product
        {
            width: 100%;
        }
    }

<?php endif; ?>
</style>
<?php if( !empty($nova_theme['css_code']) ):?>
<style id="nova-theme-custom-css">
<?php echo esc_html($nova_theme['css_code']); ?>
</style>
<?php endif; ?>
