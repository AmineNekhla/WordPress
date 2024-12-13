<?php $nova_theme = nova_get_theme_options(); ?>
<div class="header-mobiles-wrapper">
	<header id="header-mobile" class="header-mobiles">
		<?php if ( has_nav_menu( 'nova_menu_primary' ) ): ?>
		<div class="header-mobiles-menu">

			<a data-toggle="MenuOffCanvas">
				<svg class="natsy-burger-menu">
			 		<use xlink:href="#natsy-burger-menu"></use>
				</svg>
			</a>

		</div>
		<?php endif; ?>
		<div class="header-mobiles-branding">

			<?php if ( !empty($nova_theme['header_logo']['url']) ) : ?>

			<div class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $nova_theme['header_logo']['url'] ); ?>" title="<?php bloginfo('name'); ?>" alt="<?php bloginfo('name'); ?>"></a></div>

			<?php else : ?>

			<div class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php bloginfo('name'); ?>
				</a>
			</div>

			<?php endif; ?>

		</div>

		<div class="header-mobiles-actions">
			<ul class="header-act">
				<?php if ( nova_get_option('header_search',1) == 1 ) : ?>
				<li class="header-mobiles-search">
						<a id="js_mobile_search_modal" href="#headerSearchModal">
						<svg class="svg-icon">
						 <use xlink:href="#natsy-search"></use>
						</svg>
					</a>
				</li>
				<?php endif; ?>
			</ul>
		</div>
	</header>
	<div id="handheld_bar" class="header-handheld-header-bar">
		<div class="header-handheld__inner">
			<?php if ( has_nav_menu( 'nova_topbar_menu' ) ):?>
			<div class="handheld_component handheld_component--dropdown-menu nova_compt_iem nova_com_action--dropdownmenu">
				<a rel="nofollow" class="component-target" href="javascript:;">
					<svg class="natsy-settings-bar">
					 <use xlink:href="#natsy-menu-bar"></use>
					</svg>
				</a>
				<div class="settings-bar-dropdown">
					<?php
						wp_nav_menu(array(
							'theme_location'    => 'nova_topbar_menu',
							'container'         => false,
							'menu_class'        => 'vertical menu drilldown settings-menu',
							'items_wrap'        => '<ul id="%1$s" class="%2$s" data-drilldown data-auto-height="true" data-animate-height="true" data-parent-link="true">%3$s</ul>',
							'link_before'       => '<span>',
							'link_after'        => '</span>',
							'fallback_cb'     	=> '',
							'walker'            => new Foundation_Drilldown_Menu_Walker(),
						));
					?>
				</div>
			</div>
			<?php endif; ?>
			<?php get_template_part( 'template-parts/headers/account-menu-mobile' ) ?>
			<?php if ( NOVA_WISHLIST_IS_ACTIVE ) : ?>
			<?php if ( nova_get_option('header_wishlist', 0) == 1 ) : ?>
			<div class="handheld_component handheld_component--wishlist nova_compt_iem nova_com_action--wishlist ">
				<a rel="nofollow" class="component-target" href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>">
					<svg class="natsy-wishlist-bar">
					 <use xlink:href="#natsy-wishlist-bar"></use>
					</svg>
					<div class="component-target-badget js-count-wishlist-item"><?php echo yith_wcwl_count_products(); ?></div>
				</a>
			</div>
		<?php endif; ?>
		<?php endif; ?>

		<?php if ( NOVA_WOOCOMMERCE_IS_ACTIVE ) : ?>
		<?php if ( nova_get_option('header_cart', 1) == 1 ) : ?>
			<div class="handheld_component handheld_component--cart nova_compt_iem nova_com_action--cart ">
				<a rel="nofollow" class="component-target" href="javascript:;" data-toggle="MiniCartCanvas">
					<svg class="natsy-bag-bar">
					 <use xlink:href="#natsy-bag-bar"></use>
					</svg>
					<span class="component-target-badget js_count_bag_item"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>
      </a>
			</div>
		<?php endif; ?>
		<?php endif; ?>

		</div>
	</div>
</div>
