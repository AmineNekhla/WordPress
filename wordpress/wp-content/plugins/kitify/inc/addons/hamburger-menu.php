<?php
/**
 * Class: Kitify_Hamburger_Menu
 * Name: Hamburger Menu
 * Slug: kitify-hamburger-menu
 */
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Kitify_Hamburger_Menu extends Kitify_Base {
    protected function enqueue_addon_resources(){
        wp_register_style( $this->get_name(), kitify()->plugin_url('assets/css/addons/hamburger-menu.css'), ['kitify-base'], kitify()->get_version());
  
        $this->add_style_depends( $this->get_name() );
    }
  
	public function get_name() {
		return 'kitify-hamburger-menu';
	}

	public function get_widget_title() {
		return esc_html__( 'Hamburger Menu', 'kitify' );
	}

	public function get_icon() {
		return 'kitify-icon-hamburger-panel';
	}
    protected function register_controls() {
        $menus   = $this->get_available_menus();
        $default = '';
    
        if ( ! empty( $menus ) ) {
            $ids     = array_keys( $menus );
            $default = $ids[0];
        }
        $this->start_controls_section(
            'section_menu',
            array(
                'label' => esc_html__( 'Menu', 'kitify' ),
            )
        );
        $this->_add_control(
            'panel_menu',
            array(
                'label'   => esc_html__( 'Select Menu', 'kitify' ),
                'type'    => Controls_Manager::SELECT,
                'default' => $default,
                'options' => $menus,
            )
        );
        $this->_add_advanced_icon_control(
            'trigger_icon',
            array(
                'label'       => esc_html__( 'Trigger Icon', 'kitify' ),
                'label_block' => false,
                'type'        => Controls_Manager::ICON,
                'skin'        => 'inline',
                'default'     => 'dlicon ui-2_menu-34',
                'fa5_default' => array(
                    'value'   => 'dlicon ui-2_menu-34',
                    'library' => 'dlicon',
                ),
            )
        );
        $this->_end_controls_section();
        $css_scheme = \apply_filters(
            'kitify/hamburger-menu/css-scheme',
            array(
                'mobile_menu_canvas'        => '.site-canvas-menu',
                'mobile_menu_item_active'        => '.site-canvas-menu li.current-menu-item > a',
            )
        );
        $this->_start_controls_section(
            'mobile_menu_style',
            array(
                'label'      => esc_html__( 'Panel Style', 'kitify' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );
    
        $this->_add_control(
            'mobile_bg_color',
            array(
                'label'  => esc_html__( 'Background Color', 'kitify' ),
                'type'   => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} '. $css_scheme['mobile_menu_canvas'] => 'background-color: {{VALUE}}',
                ),
            ),
            25
        );
        $this->_add_control(
            'mobile_items_color',
            array(
                'label'  => esc_html__( 'Text Color', 'kitify' ),
                'type'   => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} '. $css_scheme['mobile_menu_canvas'].'  a' => 'color: {{VALUE}}',
                ),
            ),
            25
        );
        $this->_add_control(
            'mobile_items_hover_color',
            array(
                'label'  => esc_html__( 'Text Hover Color', 'kitify' ),
                'type'   => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} '. $css_scheme['mobile_menu_canvas'].'  a:hover' => 'color: {{VALUE}}',
                ),
            ),
            25
        );
    
        $this->_add_control(
            'mobile_items_active_color',
            array(
                'label'  => esc_html__( 'Text Active Color', 'kitify' ),
                'type'   => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} '. $css_scheme['mobile_menu_item_active'] => 'color: {{VALUE}}',
                ),
            ),
            25
        );
    
        $this->end_controls_section();
        $this->_start_controls_section(
            'mobile_trigger_styles',
            array(
                'label'      => esc_html__( 'Mobile Trigger', 'kitify' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );
        $this->_add_responsive_control(
            'nova_menu_trigger_alignment',
            array(
                'label'   => esc_html__( 'Menu Alignment', 'kitify' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'flex-start',
                'options' => array(
                    'flex-start' => array(
                        'title' => esc_html__( 'Left', 'kitify' ),
                        'icon'  => 'eicon-h-align-left',
                    ),
                    'center' => array(
                        'title' => esc_html__( 'Center', 'kitify' ),
                        'icon'  => 'eicon-h-align-center',
                    ),
                    'flex-end' => array(
                        'title' => esc_html__( 'Right', 'kitify' ),
                        'icon'  => 'eicon-h-align-right',
                    ),
                    'space-between' => array(
                        'title' => esc_html__( 'Justified', 'kitify' ),
                        'icon'  => 'eicon-h-align-stretch',
                    ),
                ),
                'selectors_dictionary' => array(
                    'flex-start'    => 'justify-content: flex-start; text-align: left;',
                    'center'        => 'justify-content: center; text-align: center;',
                    'flex-end'      => 'justify-content: flex-end; text-align: right;',
                    'space-between' => 'justify-content: space-between; text-align: left;',
                ),
                'selectors' => array(
                    '{{WRAPPER}} .kitify-nova-menu.kitify-active--mbmenu .kitify-nova-menu__mobile-trigger' => '{{VALUE}}',
                )
            )
        );
        $this->_start_controls_tabs( 'tabs_mobile_trigger_style' );
    
        $this->_start_controls_tab(
            'mobile_trigger_normal',
            array(
                'label' => esc_html__( 'Normal', 'kitify' ),
            )
        );
    
        $this->_add_control(
            'mobile_trigger_bg_color',
            array(
                'label'  => esc_html__( 'Background Color', 'kitify' ),
                'type'   => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .kitify-nova-menu__mobile-trigger' => 'background-color: {{VALUE}}',
                ),
            ),
            25
        );
    
        $this->_add_control(
            'mobile_trigger_color',
            array(
                'label'  => esc_html__( 'Text Color', 'kitify' ),
                'type'   => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .kitify-nova-menu__mobile-trigger' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .kitify-nova-menu__mobile-trigger i' => 'color: {{VALUE}}',
                ),
            ),
            25
        );
    
        $this->_end_controls_tab();
    
        $this->_start_controls_tab(
            'mobile_trigger_hover',
            array(
                'label' => esc_html__( 'Hover', 'kitify' ),
            )
        );
    
        $this->_add_control(
            'mobile_trigger_bg_color_hover',
            array(
                'label'  => esc_html__( 'Background Color', 'kitify' ),
                'type'   => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .kitify-nova-menu__mobile-trigger:hover' => 'background-color: {{VALUE}}',
                ),
            ),
            25
        );
    
        $this->_add_control(
            'mobile_trigger_color_hover',
            array(
                'label'  => esc_html__( 'Text Color', 'kitify' ),
                'type'   => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .kitify-nova-menu__mobile-trigger i:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .kitify-nova-menu__mobile-trigger:hover i' => 'color: {{VALUE}}',
                ),
            ),
            25
        );
    
        $this->_add_control(
            'mobile_trigger_hover_border_color',
            array(
                'label' => esc_html__( 'Border Color', 'kitify' ),
                'type' => Controls_Manager::COLOR,
                'condition' => array(
                    'mobile_trigger_border_border!' => '',
                ),
                'selectors' => array(
                    '{{WRAPPER}} .kitify-nova-menu__mobile-trigger:hover' => 'border-color: {{VALUE}};',
                ),
            ),
            75
        );
    
        $this->_end_controls_tab();
    
        $this->_end_controls_tabs();
    
        $this->_add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'mobile_trigger_border',
                'label'       => esc_html__( 'Border', 'kitify' ),
                'placeholder' => '1px',
                'selector'    => '{{WRAPPER}} .kitify-nova-menu__mobile-trigger',
                'separator'   => 'before',
            ),
            75
        );
    
        $this->_add_control(
            'mobile_trigger_border_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'kitify' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .kitify-nova-menu__mobile-trigger' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            ),
            75
        );
    
        $this->_add_responsive_control(
            'mobile_trigger_width',
            array(
                'label'      => esc_html__( 'Width', 'kitify' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array( 'px', '%' ),
                'range'      => array(
                    'px' => array(
                        'min' => 20,
                        'max' => 200,
                    ),
                    '%' => array(
                        'min' => 10,
                        'max' => 100,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .kitify-nova-menu__mobile-trigger' => 'width: {{SIZE}}{{UNIT}};',
                ),
                'separator' => 'before',
            ),
            50
        );
    
        $this->_add_responsive_control(
            'mobile_trigger_height',
            array(
                'label'      => esc_html__( 'Height', 'kitify' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array( 'px', '%' ),
                'range'      => array(
                    'px' => array(
                        'min' => 20,
                        'max' => 200,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .kitify-nova-menu__mobile-trigger' => 'height: {{SIZE}}{{UNIT}};',
                ),
            ),
            50
        );
    
        $this->_add_responsive_control(
            'mobile_trigger_icon_size',
            array(
                'label'      => esc_html__( 'Icon Size', 'kitify' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array( 'px' ),
                'range'      => array(
                    'px' => array(
                        'min' => 10,
                        'max' => 100,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .kitify-nova-menu__mobile-trigger' => 'font-size: {{SIZE}}{{UNIT}};',
                ),
            ),
            50
        );
    
        $this->_end_controls_section();
    
    }
    /**
     * Get available menus list
     *
     * @return array
     */
    public function get_available_menus() {

        $raw_menus = wp_get_nav_menus();
        $menus     = wp_list_pluck( $raw_menus, 'name', 'term_id' );

        return $menus;
    }
    protected function render() {

        $settings = $this->get_settings();
    
        if ( ! $settings['panel_menu'] ) {
            return;
        }
        include $this->_get_global_template( 'mobile-trigger' );
        add_action('kitify/theme/canvas_panel', [ $this, 'add_panel' ] );
      }
    public function add_panel() {
        include $this->_get_global_template( 'mobile-canvas' );
    }
}