<?php
$nova_theme = nova_get_theme_options();
$header_class = "";
$header_wide = "";
if( isset($nova_theme['header_transparent']) && $nova_theme['header_transparent'] === '1' )
{
	$header_class .= "header-transparent ";
} else {
	$header_class .= "header-static ";
}

if( isset($nova_theme['header_transparent']) && $nova_theme['header_wide'] === '1' ) {
	$header_wide = 'nova-container-fluid';
}else {
	$header_wide = 'nova-container';
}

 ?>
<header id="masthead" class="nova-header header-type-default <?php echo esc_attr($header_class) ?> headroom">
	<div class="<?php echo esc_attr($header_wide)?> align-middle">
		<div class="header-left-items header-items">
			<div class="nova-header__branding header-branding site-secondary-font">

			<?php if ( !empty($nova_theme['header_logo']['url']) ) : ?>

				<div class="site-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img class="logo-dark" src="<?php echo esc_url( $nova_theme['header_logo']['url'] ); ?>" title="<?php bloginfo('name'); ?>" alt="<?php bloginfo('name'); ?>">
						<img class="logo-light" src="<?php echo esc_url( $nova_theme['header_logo_light']['url'] ); ?>" title="<?php bloginfo('name'); ?>" alt="<?php bloginfo('name'); ?>">
					</a>
				</div>

			<?php else : ?>

				<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a></div>

			<?php endif; ?>

		</div>
		</div>
		<div class="header-center-items header-items has-menu">
			<?php
			if ( class_exists( 'Nova_Mega_Menu_Walker' ) ) {
				echo '<nav class="main-navigation header-primary-nav">';
				wp_nav_menu(array(
					'theme_location'    => 'nova_menu_primary',
					'container'         => false,
					'menu_class'        => 'menu nav-menu',
					'link_before'       => '',
					'link_after'        => '',
					'fallback_cb'     	=> 'Nova_Mega_Menu_Walker',
					'walker'            => new Nova_Mega_Menu_Walker(),
				));
				echo '</nav>';
			}else{
				echo '<nav class="main-navigation header-primary-nav">';
				wp_nav_menu(array(
					'theme_location'    => 'nova_menu_primary',
					'container'         => false,
					'menu_class'        => 'menu nav-menu',
					'link_before'       => '',
					'link_after'        => ''
				));
				echo '</nav>';
			}
			?>
		</div>
		<div class="header-right-items header-items">
			<div class="nova-header__right-action">
				<ul class="actions">
					<?php get_template_part( 'template-parts/headers/account-menu' ) ?>
					<?php if ( nova_get_option('header_search',1) == 1 ) : ?>
						<li class="header-search">
							<a id="js_header_search_modal" href="#headerSearchModal">
								<svg class="svg-icon svg-menu-search">
								 <use xlink:href="#natsy-search"></use>
								</svg>
							</a>
						</li>
					<?php endif; ?>
					<?php if ( NOVA_WISHLIST_IS_ACTIVE && nova_get_option('header_wishlist',0) == 1 ) : ?>
					  <li class="header-wishlist">
					    <a href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>">
					      <svg class="svg-icon">
					       <use xlink:href="#natsy-wishlist"></use>
					      </svg>
					    </a>
					  </li>
					<?php endif; ?>
						<?php if ( NOVA_WOOCOMMERCE_IS_ACTIVE ) : ?>
							<?php if ( nova_get_option('header_cart',1) == 1 ) : ?>
								<li class="header-cart">
									<a href="javascript:;" data-toggle="MiniCartCanvas">
										<div class="header-cart-box">
											<svg class="svg-icon svg-bag-icon">
											 <use xlink:href="#natsy-bag"></use>
											</svg>
											<div class="count-badge js_count_bag_item"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></div>
										</div>
									</a>
								</li>
						<?php endif; ?>
					<?php endif; ?>
			</div>
		</div>
	</div>
</header>
