<?php
/**
 * Template part for displaying page header
 */
 $lazy_class = '';
 $nova_theme = nova_get_theme_options();

 if ( !empty($nova_theme['page_header_background_image']['url']) ) {
	 $lazy_class = ' nova-lazyload-image';
 }
 if ( 'large' == nova_get_option('page_header_style','mini') ):
?>
<div class="nova-page-header <?php echo nova_get_option('page_header_style','mini')?><?php echo esc_attr($lazy_class); ?>"<?php if( !empty($nova_theme['page_header_background_image']['url']) ) { echo ' data-background-image="'.esc_url( $nova_theme['page_header_background_image']['url'] ).'"'; }?>>
	<?php if( '' !=  nova_get_option('pager_header_overlay_color') ):?>
		<div class="nova-page-header__overlay"></div>
	<?php endif; ?>
  <div class="nova-container">
    <div class="row">
      <div class="small-12">
      <div class="nova-page-header__inner">
            <?php
            if( is_realy_woocommerce_page() && ( NOVA_WOOCOMMERCE_IS_ACTIVE ) ) {
              printf( '<h1 class="page-title woocommerce-page-title">%s</h1>', woocommerce_page_title('', false) );
            } else {
              if ( ! is_singular() && !is_home() ) {
                the_archive_title( '<h1 class="page-title">', '</h1>' );
              } else {
                printf( '<h1 class="page-title">%s</h1>', single_post_title( '', false ) );
              }
            }
            nova_site_breadcrumb();
            ?>
          </div>
        </div>
    </div>
  </div>
</div>
<?php endif ?>
