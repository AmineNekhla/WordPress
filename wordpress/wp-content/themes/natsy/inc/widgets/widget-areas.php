<?php

// =============================================================================
// Register Widget Areas
// =============================================================================

function nova_theme_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__('Blog Sidebar', 'natsy'),
		'id'            => 'blog-widget-area',
		'description'   => '',
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'natsy' ),
		'id'            => 'shop-widget-area',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Single Product Sidebar', 'natsy' ),
		'id'            => 'single-product-widget-area',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

}
add_action( 'widgets_init', 'nova_theme_widgets_init' );
