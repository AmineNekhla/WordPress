<?php
/**
 * Nova Ajax Product Filter by Price
 */
if (!class_exists('NOVAAPF_Price_Filter_Widget')) {
	class NOVAAPF_Price_Filter_Widget extends WP_Widget {
		/**
		 * Register widget with WordPress.
		 */
		function __construct() {
			parent::__construct(
				'novaapf-price-filter', // Base ID
				__('Nova Ajax Product Filter by Price', 'novaapf'), // Name
				array('description' => __('Filter woocommerce products by price.', 'novaapf')) // Args
			);
		}

		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 *
		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		public function widget($args, $instance) {
			if (!is_post_type_archive('product') && !is_tax(get_object_taxonomies('product'))) {
				return;
			}

			global $novaapf;

			// price range for filtered products
			$filtered_price_range = $novaapf->getPriceRange(true);

			// price range for all published products
			$unfiltered_price_range = $novaapf->getPriceRange(false);

			$html = '';

			// to be sure that these values are number
			$min_val = $max_val = 0;

			if (sizeof($unfiltered_price_range) === 2) {
				$min_val = $unfiltered_price_range[0];
				$max_val = $unfiltered_price_range[1];
			}

			// display type, slider or list
			$display_type = $instance['display_type'];

			// required scripts
			// enqueue necessary scripts
			wp_enqueue_style('novaapf-style');
			wp_enqueue_style('font-awesome');
			wp_enqueue_script('novaapf-script');

			if ($display_type === 'slider') {
				wp_enqueue_script('novaapf-nouislider-script');
				wp_enqueue_script('novaapf-price-filter-script');
				wp_enqueue_style('novaapf-nouislider-style');

				// get values from url
				$set_min_val = null;
				if (isset($_GET['min-price']) && !empty($_GET['min-price'])) {
					$set_min_val = (int)$_GET['min-price'];
				}

				$set_max_val = null;
				if (isset($_GET['max-price']) && !empty($_GET['max-price'])) {
					$set_max_val = (int)$_GET['max-price'];
				}
			} else {
				$price_lists = $instance['price_list'];
				$show_currency = $instance['show_currency'];

				if (class_exists('WOOCS')) {
					$woocs = new WOOCS();
					$woocs_currencies = $woocs->get_currencies();
					$woocs_current_currency = $woocs->current_currency;

					$currency_symbol = $woocs_currencies[$woocs_current_currency]['symbol'];
					$currency_position = $woocs_currencies[$woocs_current_currency]['position'];
				} else {
					$currency_symbol = get_woocommerce_currency_symbol();
					$currency_position = get_option('woocommerce_currency_pos');
				}
			}

			// HTML markup for price slider
			// Slider markup
			if ($display_type === 'slider') {
				$html .= '<div class="novaapf-price-filter-wrapper">';
					$html .= '<div id="novaapf-noui-slider" class="noUi-extended" data-min="' . $min_val . '" data-max="' . $max_val . '" data-set-min="' . $set_min_val . '" data-set-max="' . $set_max_val . '"></div>';
					$html .= '<br />';
					$html .= '<div class="slider-values">';
						$html .= '<p>' . apply_filters( 'novaapf_min_price_text',  esc_html__('Min Price:', 'novaapf' ) ) . ' <span class="novaapf-slider-value" id="novaapf-noui-slider-value-min"></span></p>';
						$html .= '<p>' . apply_filters( 'novaapf_max_price_text',  esc_html__('Max Price:', 'novaapf' ) ) . ' <span class="novaapf-slider-value" id="novaapf-noui-slider-value-max"></span></p>';
					$html .= '</div>';
				$html .= '</div>';
			}

			// List markup
			elseif ($display_type === 'list') {
				$html .= '<div class="novaapf-layered-nav">';
					$html .= '<ul>';
						foreach ($price_lists as $price_list) {

							if (isset($_GET['min-price']) && (int)$_GET['min-price'] == $price_list['min']) {
								$html .= '<li class="chosen">';
							} elseif (isset($_GET['max-price']) && (int)$_GET['max-price'] == $price_list['max']) {
								$html .= '<li class="chosen">';
							} else {
								$html .= '<li>';
							}

							$html .= '<a href="javascript:void(0)" data-key-min="min-price" data-value-min="' . $price_list['min'] . '" data-key-max="max-price" data-value-max="' . $price_list['max'] . '">';

								if (!$show_currency) {
									if ($price_list['min']) {
										$html .= '<span class="min">' . $price_list['min'] . '</span>';
										$html .= ' ';
									}

									$html .= '<span class="to">' . $price_list['to'] . '</span>';

									if ($price_list['max']) {
										$html .= ' ';
										$html .= '<span class="max">' . $price_list['max'] . '</span>';
									}
								} else {
									if ($currency_position === 'left') {
										if ($price_list['min']) {
											$html .= '<span class="min">' . $currency_symbol . $price_list['min'] . '</span>';
											$html .= ' ';
										}

										$html .= '<span class="to">' . $price_list['to'] . '</span>';

										if ($price_list['max']) {
											$html .= ' ';
											$html .= '<span class="max">' . $currency_symbol . $price_list['max'] . '</span>';
										}
									} elseif ($currency_position === 'left_space') {
										if ($price_list['min']) {
											$html .= '<span class="min">' . $currency_symbol . ' ' . $price_list['min'] . '</span>';
											$html .= ' ';
										}

										$html .= '<span class="to">' . $price_list['to'] . '</span>';

										if ($price_list['max']) {
											$html .= ' ';
											$html .= '<span class="max">' . $currency_symbol . ' ' . $price_list['max'] . '</span>';
										}
									} elseif ($currency_position === 'right') {
										if ($price_list['min']) {
											$html .= '<span class="min">' . $price_list['min'] . $currency_symbol . '</span>';
											$html .= ' ';
										}

										$html .= '<span class="to">' . $price_list['to'] . '</span>';

										if ($price_list['max']) {
											$html .= ' ';
											$html .= '<span class="max">' . $price_list['max'] . $currency_symbol . '</span>';
										}
									} elseif ($currency_position === 'right_space') {
										if ($price_list['min']) {
											$html .= '<span class="min">' . $price_list['min'] . ' ' . $currency_symbol . '</span>';
											$html .= ' ';
										}

										$html .= '<span class="to">' . $price_list['to'] . '</span>';

										if ($price_list['max']) {
											$html .= ' ';
											$html .= '<span class="max">' . $price_list['max'] . ' ' . $currency_symbol . '</span>';
										}
									}
								}

							$html .= '</a></li>';
						}
					$html .= '</ul>';
				$html .= '</div>';
			}

			extract($args);

			// Add class to before_widget from within a custom widget
			// http://wordpress.stackexchange.com/questions/18942/add-class-to-before-widget-from-within-a-custom-widget

			if ($display_type === 'slider') {
				$widget_class = 'woocommerce novaapf-price-filter-widget';
			} else {
				$widget_class = 'woocommerce novaapf-price-filter-widget novaapf-ajax-term-filter';
			}

			// no class found, so add it
			if (strpos($before_widget, 'class') === false) {
				$before_widget = str_replace('>', 'class="' . $widget_class . '"', $before_widget);
			}
			// class found but not the one that we need, so add it
			else {
				$before_widget = str_replace('class="', 'class="' . $widget_class . ' ', $before_widget);
			}

			echo $before_widget;

			if (!empty($instance['title'])) {
				echo $args['before_title'] . apply_filters('widget_title', $instance['title']). $args['after_title'];
			}

			echo $html;

			echo $args['after_widget'];
		}

		/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */
		public function form($instance) {
			?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php printf(__('Title:', 'novaapf')); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo (!empty($instance['title']) ? esc_attr($instance['title']) : __( 'Filter by price', 'novaapf' )); ?>">
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('display_type'); ?>"><?php printf(__('Display Type:', 'novaapf')); ?></label>
				<select class="widefat price-filter-display-type" id="<?php echo $this->get_field_id('display_type'); ?>" name="<?php echo $this->get_field_name('display_type'); ?>">
					<option value="slider" <?php echo ((!empty($instance['display_type']) && $instance['display_type'] === 'slider') ? 'selected="selected"' : ''); ?>><?php printf(__('Slider', 'novaapf')); ?></option>
					<option value="list" <?php echo ((!empty($instance['display_type']) && $instance['display_type'] === 'list') ? 'selected="selected"' : ''); ?>><?php printf(__('List', 'novaapf')); ?></option>
				</select>
			</p>
			<p class="price-list-currency <?php echo (!isset($instance['display_type']) || $instance['display_type'] === 'slider') ? 'hidden' : ''; ?>">
				<input id="<?php echo $this->get_field_id('show_currency'); ?>" name="<?php echo $this->get_field_name('show_currency'); ?>" type="checkbox" value="1" <?php echo (!empty($instance['show_currency']) && $instance['show_currency'] == true) ? 'checked="checked"' : ''; ?>>
				<label for="<?php echo $this->get_field_id('show_currency'); ?>"><?php printf(__('Show currency', 'novaapf')); ?></label>
			</p>
			<div class="price-list-wrapper <?php echo (!isset($instance['display_type']) || $instance['display_type'] === 'slider') ? 'hidden' : ''; ?>">
				<?php if (isset($instance['price_list']) && !empty($instance['price_list'])): ?>
					<?php foreach ($instance['price_list'] as $price_list): ?>
						<p class="price-list">
							<input type="text" class="widefat min" name="<?php echo $this->get_field_name('price_list'); ?>[min][]" value="<?php echo $price_list['min']; ?>" placeholder="<?php printf(__('Min price', 'novaapf')); ?>" />
							<input type="text" class="widefat to" name="<?php echo $this->get_field_name('price_list'); ?>[to][]" value="<?php echo $price_list['to']; ?>" placeholder="<?php printf(__('to', 'novaapf')); ?>" />
							<input type="text" class="widefat max" name="<?php echo $this->get_field_name('price_list'); ?>[max][]" value="<?php echo $price_list['max']; ?>" placeholder="<?php printf(__('Max price', 'novaapf')); ?>" />
							<a href="javascript:void(0)" class="remove-price-list">&times;</a>
						</p>
					<?php endforeach ?>
				<?php else: ?>
					<p class="price-list">
						<input type="text" class="widefat min" name="<?php echo $this->get_field_name('price_list'); ?>[min][]" value="" placeholder="<?php printf(__('Min price', 'novaapf')); ?>" />
						<input type="text" class="widefat to" name="<?php echo $this->get_field_name('price_list'); ?>[to][]" value="" placeholder="<?php printf(__('to', 'novaapf')); ?>" />
						<input type="text" class="widefat max" name="<?php echo $this->get_field_name('price_list'); ?>[max][]" value="" placeholder="<?php printf(__('Max price', 'novaapf')); ?>" />
						<a href="javascript:void(0)" class="remove-price-list">&times;</a>
					</p>
				<?php endif ?>
			</div>
			<p class="add-price-list-button-wrapper <?php echo (!isset($instance['display_type']) || $instance['display_type'] === 'slider') ? 'hidden' : ''; ?>">
				<a href="javascript:void(0)" class="button add-price-list"><?php printf(__('Add', 'novaapf')); ?></a>
			</p>
			<div class="price-list-empty hidden">
				<p class="price-list">
					<input type="text" class="widefat min" name="<?php echo $this->get_field_name('price_list'); ?>[min][]" value="" placeholder="<?php printf(__('Min price', 'novaapf')); ?>" />
					<input type="text" class="widefat to" name="<?php echo $this->get_field_name('price_list'); ?>[to][]" value="" placeholder="<?php printf(__('to', 'novaapf')); ?>" />
					<input type="text" class="widefat max" name="<?php echo $this->get_field_name('price_list'); ?>[max][]" value="" placeholder="<?php printf(__('Max price', 'novaapf')); ?>" />
					<a href="javascript:void(0)" class="remove-price-list">&times;</a>
				</p>
			</div>
			<style type="text/css">
				.price-list .min,
				.price-list .max {
					width: 15%;
				}
				.price-list .to {
					width: 15%;
				}
				.price-list .min,
				.price-list .to,
				.price-list .max {
					margin-right: 3%;
				}
				.remove-price-list {
					font-size: 16px;
					border: none;
					background-color: transparent;
					color: #ff0000;
					text-decoration: none;
				}
			</style>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					// Hide and show price lists
					$('.price-filter-display-type').change(function(event) {
						var display_type = $(this).val(),
							widget = $(this).parent().parent();

						if (display_type == 'list') {
							widget.find('.price-list-currency').removeClass('hidden');
							widget.find('.price-list-product-count').removeClass('hidden');
							widget.find('.price-list-wrapper').removeClass('hidden');
							widget.find('.add-price-list-button-wrapper').removeClass('hidden');
						} else {
							widget.find('.price-list-currency').addClass('hidden');
							widget.find('.price-list-product-count').addClass('hidden');
							widget.find('.price-list-wrapper').addClass('hidden');
							widget.find('.add-price-list-button-wrapper').addClass('hidden');
						}
					});

					// Add price list
					$('.add-price-list').unbind().on('click', function(event) {
						var widget = $(this).parent().parent(),
							wrapper = widget.find('.price-list-wrapper'),
							markup = widget.find('.price-list-empty').clone().children();

						$(markup).appendTo(wrapper);
						return false;
					});

					// Remove price list
					$(document).find('.price-list-wrapper').unbind().on('click', '.remove-price-list', function(event) {
						$(this).parent().hide().remove();
						return false;
					});
				});
			</script>
			<?php
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @see WP_Widget::update()
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 */
		public function update($new_instance, $old_instance) {
			$instance = array();
			$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
			$instance['display_type'] = (!empty($new_instance['display_type'])) ? strip_tags($new_instance['display_type']) : '';
			$instance['show_currency'] = (!empty($new_instance['show_currency'])) ? strip_tags($new_instance['show_currency']) : '';

			// price list
			if (isset($new_instance['price_list'])) {
				$min = $new_instance['price_list']['min'];
				$to = $new_instance['price_list']['to'];
				$max = $new_instance['price_list']['max'];
				$price_list = array();

				foreach ($min as $key => $mmin) {
					$mmin = $mmin;
					$mmax = $max[$key];
					$mto = !empty($to[$key]) ? $to[$key] : '-';

					if (!empty($mmin) || !empty($mmax)) {
						$price_list[] = array(
							'min' => $mmin,
							'to'  => $mto,
							'max' => $mmax,
						);
					}
				}

				$instance['price_list'] = $price_list;

			}

			return $instance;
		}
	}
}

// register widget
if (!function_exists('novaapf_register_price_filter_widget')) {
	function novaapf_register_price_filter_widget() {
		register_widget('NOVAAPF_Price_Filter_Widget');
	}
	add_action('widgets_init', 'novaapf_register_price_filter_widget');
}
