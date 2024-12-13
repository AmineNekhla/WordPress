<?php
$opt_name = NOVA_FRAMEWORK_VAR;

/* Typography */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Typography', 'natsy-core'),
	'icon' => 'fa fa-font',
	'fields' => array(

		array(
			'id' => 'general_fonts',
			'type' => 'subheading',
			'title' => __('Generals Fonts', 'natsy-core'),
			'subtitle' => __('Global font families for all sections, including pages, posts, sidebar and footer.', 'natsy-core'),
			'indent' => true
		),
		array(
			'id' => 'body_font',
			'type' => 'typography',
			'title' => esc_html__('Regular Text Font', 'natsy-core'),
			'subtitle' => esc_html__('Default: Jost, 16px normal', 'natsy-core'),
			'google' => true,
			'subset' => true,
			'font_size' => true,
			'line_height' => false,
            'text_align' => false,
            'text_transform' => false,
            'letter_spacing' => false,
			'color' => false,
			'default' => array(
				'font-size' => '16',
				'font-family' => '',
				'font-weight' => ''
			)
		),
		array(
			'id' => 'primary_titles_font',
			'type' => 'typography',
			'title' => esc_html__('Primary Titles Font Family', 'natsy-core'),
			'subtitle' => esc_html__('Default: Syne, Medium (700)', 'natsy-core'),
			'desc' => esc_html__('e.g. Article titles, box titles, page titles, etc.', 'natsy-core'),
			'google' => true,
			'subset' => true,
            'font_size' => false,
			'line_height' => false,
            'text_align' => false,
            'text_transform' => false,
            'letter_spacing' => false,
			'color' => false,
			'default' => array(
				'font-family' => '',
				'font-weight' => '',
			)
		),

	)
) );
