<?php
/**
 * HTML markup for Settings page.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}
?>
<div class="wrap">
	<h1><?php _e('Nova Ajax Product Filter', 'novaapf'); ?></h1>
	<form method="post" action="options.php">
		<?php
		settings_fields('novaapf_settings');
		do_settings_sections('novaapf_settings');

		// check if filter is applied
		$settings = apply_filters('novaapf_settings', get_option('novaapf_settings'));
		?>

		<?php if (has_filter('novaapf_settings')): ?>
			<p><span class="dashicons dashicons-info"></span> <?php _e('Filter has been applied and that may modify the settings below.', 'novaapf'); ?></p>
		<?php endif ?>

		<table class="form-table">
			<tr>
				<th scope="row"><?php _e('Shop loop container', 'novaapf'); ?></th>
				<td>
					<input type="text" name="novaapf_settings[shop_loop_container]" size="50" value="<?php echo '.novaapf-before-products'; ?>" >
					<br />
					<span><?php _e('Selector for tag that is holding the shop loop. Most of cases you won\'t need to change this.', 'novaapf'); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('No products container', 'novaapf'); ?></th>
				<td>
					<input type="text" name="novaapf_settings[not_found_container]" size="50" value="<?php echo '.novaapf-before-products'; ?>" >
					<br />
					<span><?php _e('Selector for tag that is holding no products found message. Most of cases you won\'t need to change this.', 'novaapf'); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Pagination container', 'novaapf'); ?></th>
				<td>
					<input type="text" name="novaapf_settings[pagination_container]" size="50" value="<?php echo '.woocommerce-pagination'; ?>" >
					<br />
					<span><?php _e('Selector for tag that is holding the pagination. Most of cases you won\'t need to change this.', 'novaapf'); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Overlay background color', 'novaapf'); ?></th>
				<td>
					<input type="text" name="novaapf_settings[overlay_bg_color]" size="50" value="<?php echo isset($settings['overlay_bg_color']) ? esc_attr($settings['overlay_bg_color']) : '#fff'; ?>">
					<br />
					<span><?php _e('Change this color according to your theme, eg: #fff', 'novaapf'); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Product sorting', 'novaapf'); ?></th>
				<td>
					<input type="checkbox" name="novaapf_settings[sorting_control]" value="1" <?php (!empty($settings['sorting_control'])) ? checked(1, $settings['sorting_control'], true) : 1; ?>>
					<span><?php _e('Check if you want to sort your products via ajax.', 'novaapf'); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Scroll to top', 'novaapf'); ?></th>
				<td>
					<input type="checkbox" name="novaapf_settings[scroll_to_top]" value="1" <?php (!empty($settings['scroll_to_top'])) ? checked(1, $settings['scroll_to_top'], true) : 1; ?>>
					<span><?php _e('Check if to enable scroll to top after updating shop loop.', 'novaapf'); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Scroll to top offset', 'novaapf'); ?></th>
				<td>
					<input type="text" name="novaapf_settings[scroll_to_top_offset]" size="50" value="<?php echo isset($settings['scroll_to_top_offset']) ? esc_attr($settings['scroll_to_top_offset']) : 150; ?>">
					<br />
					<span><?php _e('You need to change this value to match with your theme, eg: 150', 'novaapf'); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Enable Font Awesome', 'novaapf'); ?></th>
				<td>
					<input type="checkbox" name="novaapf_settings[enable_font_awesome]" value="1" <?php (!empty($settings['enable_font_awesome'])) ? checked(1, $settings['enable_font_awesome'], true) : ''; ?>>
					<span><?php _e('If your theme/plugins load font awesome then you can disable by unchecking it.', 'novaapf'); ?></span>
				</td>
			</tr>
			<tr style="display: none;">
				<th scope="row"><?php _e('Custom JavaScript after update', 'novaapf'); ?></th>
				<td>
					<textarea name="novaapf_settings[custom_scripts]" rows="5" cols="70"><?php echo ''; ?></textarea>
					<br />
					<span><?php _e('If you want to add custom scripts that would be loaded after updating shop loop, eg: alert("hello");', 'novaapf'); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Disable Transients', 'novaapf'); ?></th>
				<td>
					<input type="checkbox" name="novaapf_settings[disable_transients]" value="1" <?php (!empty($settings['disable_transients'])) ? checked(1, $settings['disable_transients'], true) : ''; ?>>
					<span><?php _e('To disable transients check this checkbox.', 'novaapf'); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Clear Transients', 'novaapf'); ?></th>
				<td>
					<input type="checkbox" name="novaapf_settings[clear_transients]" value="1">
					<span><?php _e('To clean transients check this checkbox and then press \'Save Changes\' button.', 'novaapf'); ?></span>
				</td>
			</tr>
		</table>
		<?php submit_button() ?>
	</form>
</div>
