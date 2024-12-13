<?php

// @version 1.6.4

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header( 'shop' );
?>
<div class="nova-container display-flex">
	<?php if ( nova_get_option('single_product_sidebar',0) === true && nova_get_option('single_product_sidebar_position','right') == 'left' ): ?>
	<div class="product-sidebar-area show-for-large">
		<?php dynamic_sidebar( 'single-product-widget-area' ); ?>
	</div>
	<?php endif; ?>
	<div class="product-content-area">
		<div class="site-content">

			<?php do_action( 'woocommerce_before_main_content' ); ?>

				<?php while ( have_posts() ) : the_post(); ?>
					<?php wc_get_template_part( 'content', 'single-product' ); ?>
				<?php endwhile; // end of the loop. ?>

			<?php do_action( 'woocommerce_after_main_content' ); ?>

			<?php do_action( 'woocommerce_sidebar' ); ?>

		</div>

	</div>
	<?php if ( nova_get_option('single_product_sidebar',0) === true && nova_get_option('single_product_sidebar_position','right') == 'right' ): ?>
	<div class="product-sidebar-area show-for-large">
		<?php dynamic_sidebar( 'single-product-widget-area' ); ?>
	</div>
	<?php endif; ?>
</div>

<?php get_footer( 'shop' );
