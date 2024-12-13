<?php

$opt_name = NOVA_FRAMEWORK_VAR;
$bg_color = '#FFFFFF';
$site_w  = 1440;

/* General Settings */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Site Settings', 'natsy-core'),
	'icon' => ' fa fa-cog',
	'fields' => array(
        array(
					'id' => 'title_site_global',
		            'type' => 'subheading',
					'title' => __( 'Global Options', 'natsy-core')
				),
				array(
					'id' => 'site_width',
					'type' => 'slider',
					'title' => esc_html__('Site Width', 'natsy-core'),
					'desc' => esc_html__('Default: '.$site_w.' pixels.', 'natsy-core'),
					'default' => $site_w,
					'min' => '800',
					'step' => '1',
								'max' => '1920',
								'unit' => 'px',
				),
        array(
				'id' => 'site_preloader',
				'type' => 'switcher',
				'title' => esc_html__('Site Preloader', 'natsy-core'),
				'default' => true
        ),
		array(
			'id' => 'topbar_progress',
			'type' => 'switcher',
			'title' => esc_html__('Top Loading Progress Bar', 'natsy-core'),
			'default' => true,
			'dependency' => array('site_preloader', '==', '1'),
		),
	)
) );
