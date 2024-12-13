<?php
	/**
	 * Plugin Name: Natsy Core
	 * Plugin URI: https://novaworks.net/
	 * Description: The plugin for Natsy WordPress Theme
	 * Author: Novaworks
	 * Author URI: https://novaworks.net
	 * Version:          1.0.1
	 * License:           GNU General Public License v2
	 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
	 * Domain Path:       /languages
	 * Text Domain:       natsy-core
	 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( !class_exists('nova_theme_functions') ) {
	/**
	 * Currently plugin version.
	 */
	define( 'MINITURE_CORE_VERSION', '1.0.0' );
	define('NOVA_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
	define('MINITURE_CORE_TEMP_PATH', plugin_dir_path( __FILE__ ).'/public/templates' );
	define('NOVA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
	if( !defined('NOVA_THEMEPREFIX') ) define('NOVA_THEMEPREFIX', 'nova');

	class nova_theme_functions {
		public function __construct() {
			/* Check if Natsy Theme is activated */
			if( get_template() != 'natsy' ){
					return;
			}
			load_theme_textdomain('natsy-core', NOVA_PLUGIN_PATH.'/languages');

			add_action('init', array( $this, 'register_script' ) );
			add_action('wp_enqueue_scripts', array( $this, 'enqueue_style' ) );
			add_action('admin_enqueue_scripts', array( $this, 'enqueue_admin_style' ) );


			/* Theme Options */
			add_action('after_setup_theme', array( $this, 'load_csf_framework' ) );
			add_action('rest_api_init', array( $this, 'load_csf_framework_widgets' ) );

			/* Load Helpers */
			require_once(NOVA_PLUGIN_PATH.'/includes/helpers.php');

			/* Load Theme Functions */
			require_once(NOVA_PLUGIN_PATH.'/includes/theme-functions.php');

			/* Load Custom Styles */
			require_once(NOVA_PLUGIN_PATH.'/includes/custom-styles.php');

			/* Load Mega Menu */
			require_once(NOVA_PLUGIN_PATH.'/includes/mega-menu.php');

			/* Load Widgets */
			add_action( 'widgets_init', array( $this, 'load_widget' ) );

			/* Load ELementor Addons */
			require_once(NOVA_PLUGIN_PATH.'/includes/elementor-addons.php');
			natsy_elementor_addons()->init();

			/* Schema */
			add_action( 'wp_head', array( $this, 'insert_fb_in_head'), 1 );
			add_filter('language_attributes', array( $this, 'add_opengraph_doctype') );

			add_action( 'init', array( $this, 'set_notice_cookie') );


		}
		public function add_opengraph_doctype( $output ) {
				global $nova_theme;
				if( isset($nova_theme['enable_open_graph']) && $nova_theme['enable_open_graph'] !== '0' ){
						return $output . ' prefix="og: http://ogp.me/ns#"';
				}
				return $output;
		}
		public function insert_fb_in_head() {

				global $post, $nova_theme, $wp;

				if( isset($nova_theme['enable_open_graph']) && $nova_theme['enable_open_graph'] !== '0' ){

						$obj = get_queried_object();

						$image = '';

						$locale = get_locale();
						$site_name = get_bloginfo('name');
						$title = get_the_title(). ' - '. $site_name;
						$content = get_the_excerpt();
						$permalink = home_url( $wp->request );
						$canonical_url = wp_get_canonical_url();
						$type = 'article';

						// Home
						if( is_home() || is_front_page() ){
								$title = $site_name;
								$content = get_bloginfo('description');
								$type = 'website';
								$permalink = site_url();
								$canonical_url = site_url();
								if( isset($nova_theme['header_logo']['url']) && $nova_theme['header_logo']['url'] != '' ) { // No image
										$image = $nova_theme['header_logo']['url'];
								}
						}
						// Post or pages
						if( is_singular() ){
								if(!has_post_thumbnail( $post->ID ) && isset($nova_theme['header_logo']['url']) && $nova_theme['header_logo']['url'] != '' ) { // No image
										$image = $nova_theme['header_logo']['url'];
								}else{
										$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
										if( !empty($thumbnail_src) ){
												$image = $thumbnail_src[0];
										}
								}
						}
						// Arcvhives and Categories
						if( is_archive() ){
								$title = get_the_archive_title(). ' - '. $site_name;
								$type = 'object';
								$image = '';
								if( is_category() ){
										$content = term_description();
										if( !empty($obj) ){
												$term_meta = get_term_meta( $obj->term_id, 'nova_post_categories', true );
												if( !empty($term_meta) && $term_meta['archives_image']['id'] != '' ){
														$thumb_url = wp_get_attachment_image_src($term_meta['archives_image']['id'], 'large');
														$image = $thumb_url[0];
												}
										}
								}
						}

						echo '<!-- Novaworks Meta Tags -->' ."\n";
						if( $content ) echo '<meta property="description" content="' . esc_attr($content). '"/>'."\n";
						echo '<meta property="og:locale" content="' . esc_attr($locale) . '" />'."\n";
						echo '<meta property="og:title" content="' . esc_attr( $title) . '"/>'."\n";
						echo '<meta property="og:description" content="' . esc_attr($content). '"/>'."\n";
						if( isset($image) && $image != '' ) echo '<meta property="og:image" content="' . esc_attr( $image ) . '"/>'."\n";
						echo '<meta property="og:type" content="'.esc_attr($type).'"/>'."\n";
						echo '<meta property="og:url" content="' . esc_url( user_trailingslashit( $permalink ) ) . '"/>'."\n";
						echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '"/>'."\n";

						if( is_single() ){
								echo '<meta property="article:published_time" content="'.get_the_date('Y-m-d\TH:i:sP').'" />'."\n";
								echo '<meta property="article:modified_time" content="'.get_the_modified_date('Y-m-d\TH:i:sP').'" />'."\n";
						}

						// Twitter
						echo '<meta name="twitter:card" content="summary_large_image" />'."\n";
						echo '<meta name="twitter:description" content="'. esc_attr( $content ).'" />'."\n";
						echo '<meta name="twitter:title" content="'. esc_attr( $title ) .'" />'."\n";
						if( isset($image) && $image != '' ) echo '<meta name="twitter:image" content="'. esc_url($image) .'" />'."\n";

						echo '<!-- End Novaworks Meta Tags -->'."\n";

				}
		}
		public function load_csf_framework( ) {

		if( is_admin() || is_customize_preview() ){

				/* Theme Options */

				require_once(NOVA_PLUGIN_PATH.'/options/csf/codestar-framework.php');
				require_once(NOVA_PLUGIN_PATH.'/options/init.php'); // Initializes the framework
				require_once(NOVA_PLUGIN_PATH.'/options/custom-functions.php'); // Just some modifications to the panel


				}
		}

		public function load_csf_framework_widgets( ) {
				include(NOVA_PLUGIN_PATH.'/options/csf/codestar-framework.php');
		}
		public function load_widget() {
				require_once(NOVA_PLUGIN_PATH.'/includes/widgets/nova-widget-recent-posts.php');
				register_widget( 'Novaworks_Widget_Recent_Posts' );
		}

		public function register_script() {
		    wp_register_style( 'novaworks_plugin_fontend', plugins_url('public/css/frontend.css', __FILE__), false, MINITURE_CORE_VERSION, 'all');
		    wp_register_style( 'novaworks_plugin_backend', plugins_url('admin/css/admin.css', __FILE__), false, MINITURE_CORE_VERSION, 'all');
		}
		public function enqueue_style(){
		   wp_enqueue_style( 'novaworks_plugin_fontend' );
		}
		public function enqueue_admin_style() {
			wp_enqueue_style( 'novaworks_plugin_backend' );
		}
		public function set_notice_cookie(){
				global $wp;
				if( isset($_GET['nova-action']) && $_GET['nova-action'] == 'remove-notice') {
						setcookie( 'nova_show_notice', 'false', time() + ( DAY_IN_SECONDS * 5 ), COOKIEPATH, COOKIE_DOMAIN );
						wp_redirect( home_url( $wp->request ) );
						exit();
				}
		}
	}
	new nova_theme_functions();

}
