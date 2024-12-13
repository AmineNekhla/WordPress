<?php
/**
 * Class: Kitify_Product_Categories
 * Name: Interactive Product Categories
 * Slug: kitify-product-categories
 */

namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if (!defined('WPINC')) {
    die;
}
class Kitify_Product_Categories extends Kitify_Base {
    public function get_name() {
        return 'kitify-product-categories';
    }
  
    public function get_categories() {
        return [ 'kitify-woocommerce' ];
    }
  
    protected function get_widget_title() {
        return esc_html__( 'Interactive Product Categories', 'natsy-core' );
    }
    public function get_icon() {
        return 'kitify-icon-post-terms';
    }
    protected function register_controls() {
        $layout = apply_filters(
            'kitify/natsy-product-categories/control/layout',
            array(
                'interactive-list' => __( 'Interactive List', 'kitify' ),
                'list' => __( 'List', 'kitify' ),
            )
        );
        $this->start_controls_section(
            'section_general',
            array(
                'label' => esc_html__( 'General', 'kitify' ),
            )
        );
        $this->add_control(
            'layout',
            array(
                'label'     => esc_html__( 'Layout', 'kitify' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'interactive-list',
                'options'   => $layout
            )
        );
    
        $this->_add_advanced_icon_control(
            'item_icon',
            array(
                'label'       => esc_html__( 'Item Icon', 'kitify' ),
                'label_block' => false,
                'type'        => Controls_Manager::ICON,
                'skin'        => 'inline',
                'default'     => 'novaicon-arrow-right',
                'fa5_default' => array(
                    'value'   => 'novaicon-arrow-right',
                    'library' => 'novaicon',
                ),
                'condition'   => array(
                    'layout' => 'list',
                ),
            )
        );

        $this->add_control(
            'html_tag',
            [
                'label' => __( 'HTML Tag', 'kitify' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'p' => 'p',
                    'div' => 'div',
                    'span' => 'span',
                ],
                'default' => 'h2',
            ]
        );

        $this->add_control(
            'link_target',
            [
                'label' => __( 'Link Target', 'kitify' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Default', 'kitify' ),
                    '_self' => esc_html__( 'Same Window', 'kitify' ),
                    '_blank' => esc_html__( 'New Window', 'kitify' ),
                ],
                'default' => '',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_query',
            array(
              'label' => __( 'Query', 'kitify' ),
              'tab'   => Controls_Manager::TAB_CONTENT
            )
          );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__( 'Posts per Page', 'kitify' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '9',
                'render_type' => 'template',
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
            ]
        );

        $this->add_control(
            'orderby',
            array(
              'label'   => __( 'Order by', 'kitify' ),
              'type'    => Controls_Manager::SELECT,
              'default' => '',
              'options' => array(
                ''       => __( 'Default', 'kitify' ),
                'id'       => __( 'ID', 'kitify' ),
                'name'       => __( 'Name', 'kitify' ),
                'slug'       => __( 'Slug', 'kitify' ),
                'desc'       => __( 'Description', 'kitify' ),
                'count'      => __( 'Count', 'kitify' ),
                'menu_order' => __( 'Menu Order', 'kitify' ),
              ),
            )
          );
          $this->add_control(
            'order',
            array(
              'label'   => __( 'Order', 'kitify' ),
              'type'    => Controls_Manager::SELECT,
              'default' => 'desc',
              'options' => array(
                'desc' => __( 'Descending', 'kitify' ),
                'asc'  => __( 'Ascending', 'kitify' ),
              ),
            )
          );
          $this->add_control(
            'hide_empty',
            array(
              'label'        => __( 'Hidden Empty Categories', 'kitify' ),
              'type'         => Controls_Manager::SWITCHER,
              'default'      => 'yes',
              'label_on'     => 'Yes',
              'label_off'    => 'No',
              'return_value' => 'yes',
            )
          );

          $this->add_control(
            'additional_params',
            array(
              'label'   => __( 'Additional Params', 'kitify' ),
              'type'    => Controls_Manager::SELECT,
              'default' => '',
              'options' => array(
                '' => __( 'None', 'kitify' ),
                'id'  => __( 'ID', 'kitify' ),
              ),
            )
          );
          $this->_add_control(
            'taxonomy_ids',
            array(
                'label' => esc_html__('Taxonomy IDs', 'kitify'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'description' => esc_html__( 'Separate taxonomy IDs with commas', 'kitify' ),
                'condition' => [
                    'additional_params' => 'id'
                ]
            )
        );
        $this->end_controls_section();

		$this->_start_controls_section(
            'item_style',
            array(
                    'label'      => esc_html__( 'Item', 'kitify' ),
                    'tab'        => Controls_Manager::TAB_STYLE,
                    'condition'    => array(
                        'layout' => 'list',
                    ),
            )
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'item_border',
                'label'       => esc_html__( 'Border', 'kitify' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector' => '{{WRAPPER}} .nova-interactive-product-categories.nova-layout--list .nova-grid-item',
            )
        );
        $this->end_controls_section();
    

		$this->_start_controls_section(
            'item_title',
            array(
                    'label'      => esc_html__( 'Title', 'kitify' ),
                    'tab'        => Controls_Manager::TAB_STYLE,
            )
        );
        $this->_add_control(
			'banner_title_color',
			array(
				'label'     => esc_html__( 'Title Color', 'kitify' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .nova-interactive-product-categories .nova-list-title-wrapper .nova-list-title a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .nova-interactive-product-categories.nova-layout--interactive-list .nova-list-title' => 'color: {{VALUE}}',
				),
			),
			25
		);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'title_typography',
                'condition'    => array(
					'layout' => 'list',
				),
                'selector' => '{{WRAPPER}} .nova-interactive-product-categories .nova-list-title-wrapper .nova-list-title',
            )
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'title_typography_2',
                'condition'    => array(
					'layout' => 'interactive-list',
				),
                'selector' => '{{WRAPPER}} .nova-interactive-product-categories.nova-layout--interactive-list .nova-list-title',
            )
        );
        $this->end_controls_section();
        $this->_start_controls_section(
            'item_image_style',
            array(
                    'label'      => esc_html__( 'Item Image', 'kitify' ),
                    'tab'        => Controls_Manager::TAB_STYLE,
            )
        );
        $this->add_responsive_control(
            'item_image_max_width',
            [
                'label' => __( 'Max Width', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => [ '%', 'px', 'vw' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .nova-interactive-product-categories .nova-list-image' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    
    }
    public function render() {
        $atts = $this->get_settings_for_display();
        $atts['items'] = get_terms( natsy_core_get_custom_post_type_taxonomy_query_args( $atts, array( 'taxonomy' => 'product_cat' ) ) );
        ob_start();
        $this->_icon( 'item_icon', '<span class="nova-interactive-product-categories__icon">%s</span>' );
        $atts['icon_html'] = ob_get_contents();
        ob_end_clean();
        $html = natsy_core_get_template_part('interactive-product-categories', 'variations/' . $atts['layout'] . '/' . $atts['layout'], '', $atts );
        echo $html;

    }
}