<?php if ( 'mini' == nova_get_option('page_header_style', 'mini') ) : ?>
<div class="page-header-content">
<?php
if ( !is_home() ) {
  nova_site_breadcrumb();
}
if( is_realy_woocommerce_page() && ( NOVA_WOOCOMMERCE_IS_ACTIVE ) ) {
  printf( '<h1 class="page-title woocommerce-page-title">%s</h1>', woocommerce_page_title('', false) );
} else {
  if ( ! is_singular() && !is_home() ) {
    the_archive_title( '<h1 class="page-title">', '</h1>' );
  } else {
    printf( '<h1 class="page-title">%s</h1>', single_post_title( '', false ) );
  }
}
?>
</div>
<?php endif; ?>
