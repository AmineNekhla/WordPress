<?php
if( !defined('NOVA_ABSPATH') ) define('NOVA_ABSPATH', get_template_directory() );
if( !defined('NOVA_THEMEPATH') ) define('NOVA_THEMEPATH', get_template_directory_uri() );
if( !defined('NOVA_THEMEPREFIX') ) define('NOVA_THEMEPREFIX', 'nova');
if( !defined('NOVA_FRAMEWORK_VAR') ) define('NOVA_FRAMEWORK_VAR', 'nova_theme');
if( !defined('NOVA_THEMENAME') ) define('NOVA_THEMENAME', 'Natsy' );
if( !defined('NOVA_THEMESLUG') ) define('NOVA_THEMESLUG', 'natsy' ); // Do not change
define( 'NOVA_DEBUG', true );
// Vendors
require_once( get_template_directory() . '/functions/admin-setup.php' );

// Helpers
require_once( get_template_directory() . '/functions/helpers.php' );

// Filters
require_once( get_template_directory() . '/functions/filters.php' );

// Breadcrumbs
require_once( get_template_directory() . '/functions/breadcrumbs.php' );

// Ajax
require_once( get_template_directory()	. '/functions/ajax-setup.php' );

// Body Classes
require_once( get_template_directory() . '/functions/body-classes.php' );

// Menus
require_once( get_template_directory() . '/inc/menus/menus.php' );

// Elementor
require_once( get_template_directory() . '/functions/nova-elementor.php' );

require_once( get_template_directory() . '/functions/nova-kitify.php' );
// Metabox
if ( NOVA_RWMB_IS_ACTIVE ) {
require_once( get_template_directory() . '/functions/metabox.php' );
}
// Customiser
require_once( get_template_directory() . '/inc/fonts/AddCustomFonts.php' );
require_once( get_template_directory() . '/inc/fonts/functions.php' );

// Theme Setup
require_once( get_template_directory() . '/functions/menu-walkers.php' );
require_once( get_template_directory() . '/functions/mega-menu.php' );
require_once( get_template_directory() . '/functions/theme-setup.php' );
require_once( get_template_directory() . '/functions/ajax-search.php' );

// Enqueue Styles & Scripts
require_once( get_template_directory() . '/functions/enqueue/default-fonts.php' );
require_once( get_template_directory() . '/functions/enqueue/theme-icon-fonts.php' );
require_once( get_template_directory() . '/functions/enqueue/styles.php' );
require_once( get_template_directory() . '/functions/enqueue/scripts.php' );
require_once( get_template_directory() . '/functions/enqueue/admin-styles.php' );
require_once( get_template_directory() . '/functions/enqueue/admin-scripts.php' );

// WP
require_once( get_template_directory() . '/functions/wp/filters.php' );
require_once( get_template_directory() . '/functions/wp/archive-title.php' );
require_once( get_template_directory() . '/functions/wp/archive-meta.php' );

// WC
require_once( get_template_directory() . '/functions/wc/actions.php' );
require_once( get_template_directory() . '/functions/wc/filters.php' );
require_once( get_template_directory() . '/functions/wc/custom.php' );
require_once( get_template_directory() . '/functions/wc/wc-config.php' );

// Widgets
require_once( get_template_directory() . '/inc/widgets/widget-areas.php' );
