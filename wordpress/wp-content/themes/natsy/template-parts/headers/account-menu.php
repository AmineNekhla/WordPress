<?php if ( NOVA_WOOCOMMERCE_IS_ACTIVE && nova_get_option('header_account',1) ) : ?>
  <?php if ( is_user_logged_in() ){ ?>
    <li class="header-account">
      <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
        <svg class="svg-icon">
         <use xlink:href="#natsy-menu-user"></use>
        </svg>
      </a>
      <ul class="sub-menu">
      <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
        <li class="menu-item">
          <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
        </li>
      <?php endforeach; ?>
      </ul>
    </li>
  <?php }else { ?>
  <li class="header-account">
    <a data-toggle="AcccountCanvas_Popup">
      <svg class="svg-icon">
       <use xlink:href="#natsy-menu-user"></use>
      </svg>
    </a>
  </li>
<?php } ?>
<?php endif; ?>
