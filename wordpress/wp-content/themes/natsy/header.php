<?php
$nova_theme = nova_get_theme_options();
?>
<!DOCTYPE html>

<html <?php language_attributes(); ?> class="no-js">

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div class="site-wrapper">

		<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ):?>
			<?php get_template_part( 'template-parts/headers/search-modal' ) ?>
			<?php get_template_part( 'template-parts/headers/header', 'type-default' ) ?>
			<?php get_template_part( 'template-parts/headers/header-mobiles' ) ?>
		<?php endif; ?>
		<div id="site-content" class="site-content-wrapper">
