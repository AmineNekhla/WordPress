<?php

$opt_name = NOVA_FRAMEWORK_VAR;

$link_hover_color = '#008060';
$primary_color = '#BAF120';
$titles_color = '#13160B';
$text_color = '#666666';
$border_color = '#ECECEC';
$input_bg_color = '#FFFFFF';
$background_color = '#FFFFFF';
$content_bg_color = '#FFFACD';
$black = '#000000';
$white = '#FFFFFF';
$s_button_color = '#13160B';
$header_notice_color = '#000000';
/* Blog */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Styling', 'natsy-core'),
    'icon' => 'fa fa-pencil',
    'id' => 'styling'
) );

/* Basic Styling */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Basic Styling', 'natsy-core'),
    // 'icon' => 'el-icon-pencil',
    'parent' => 'styling',
	'fields' => array(
				array(
					'id' => 'bg_color',
					'type' => 'color',
					'title' => esc_html__('Body Background Color ', 'natsy-core'),
					'default' => $background_color,
					'subtitle' =>  esc_html__("Default: ".$background_color, 'natsy-core'),
								'desc' =>  esc_html__('Body background color', 'natsy-core'),
								'transparent' => false,
								'class' => 'nova-hide-transparent',
								'validate' => 'csf_validate_hex_color_transparent',
				),
      array(
				'id' => 'primary_color',
				'type' => 'color',
				'title' => esc_html__('Primary color ', 'natsy-core'),
				'default' => $primary_color,
				'subtitle' =>  esc_html__("Default: ".$primary_color, 'natsy-core'),
	            'desc' =>  esc_html__('Accent color', 'natsy-core'),
	            'transparent' => false,
	            'class' => 'nova-hide-transparent',
	            'validate' => 'csf_validate_hex_color_transparent',
		),

    array(
			'id' => 'titles_color',
			'type' => 'color',
			'title' => esc_html__('Titles Color', 'natsy-core'),
			'default' => $titles_color,
			'subtitle' =>  esc_html__("Default: ".$titles_color, 'natsy-core'),
            // 'desc' =>  esc_html__('Buttons, main links, etc', 'natsy-core'),
			// 'validate' => 'color',
            'transparent' => false,
            'class' => 'nova-hide-transparent',
            'validate' => 'csf_validate_hex_color_transparent',
		),
		array(
			'id' => 'text_color',
			'type' => 'color',
			'title' => esc_html__('Text Color', 'natsy-core'),
			'default' => $text_color,
			'subtitle' =>  esc_html__("Default: ".$text_color, 'natsy-core'),
			//'validate' => 'color',
            'transparent' => false,
            'class' => 'nova-hide-transparent',
            'validate' => 'csf_validate_hex_color_transparent',
        ),
		array(
			'id' => 'border_color',
			'type' => 'color',
			'title' => esc_html__('Border Color', 'natsy-core'),
			'default' => $border_color,
			'subtitle' =>  esc_html__("Default: ".$border_color, 'natsy-core'),
			//'validate' => 'color',
            'transparent' => false,
            'class' => 'nova-hide-transparent',
            'validate' => 'csf_validate_hex_color_transparent',
        ),
	)
) );
/* Buttons */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Buttons/Links', 'natsy-core'),
    // 'icon' => 'el-icon-edit',
    'parent' => 'styling',
	'fields' => array(
        array(
			'id' => 'content_link_color',
			'type' => 'link_color',
			'title' => esc_html__('General link color', 'natsy-core'),
			'subtitle' => esc_html__("Default: $black, Hover: $link_hover_color", 'natsy-core'),
			// 'validate' => 'color',
			'active' => false,
			'default' => array(
				'color' => $black,
                'hover' => $link_hover_color,
			),
            'class' => 'nova-hide-transparent',
        ),
        array(
			'id' => 'primary_button',
			'type' => 'color_group',
			'title' => esc_html__('Primary Button', 'natsy-core'),
			'default' => $titles_color,
            'subtitle' => esc_html__("Default: $primary_color, Text: $titles_color", 'natsy-core'),
            'transparent' => false,
            // 'validate' => 'csf_validate_hex_color',
            'class' => 'nova-hide-transparent',
            'options' => array(
                'background' => 'Background',
                'text_color' => 'Text Color',
            ),
            'default' => array(
                'background' => $primary_color,
                'text_color' => $titles_color,
            )
        ),
        array(
			'id' => 'secondary_button',
			'type' => 'color_group',
			'title' => esc_html__('Secondary Button', 'natsy-core'),
			'default' => $s_button_color,
            'subtitle' => esc_html__("Default: $black, Text: $white", 'natsy-core'),
            'transparent' => false,
            // 'validate' => 'csf_validate_hex_color',
            'class' => 'nova-hide-transparent',
            'options' => array(
                'background' => 'Background',
                'text_color' => 'Text Color',
            ),
            'default' => array(
                'background' => $s_button_color,
                'text_color' => $white,
            )
        ),
		array(
			'id' => 'button_radius',
						'type' => 'slider',
			'title' => esc_html__('Button radius', 'natsy-core'),
			'desc' => esc_html__('Default: 3 pixels.', 'natsy-core'),
			'default' => '3',
			'min' => '0',
			'step' => '1',
						'max' => '100',
						'unit' => 'px',
		),
	)
) );


/* Forms */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Forms', 'natsy-core'),
    // 'icon' => 'el-icon-edit',
    'parent' => 'styling',
	'fields' => array(
        array(
            'id'   => 'info_forms',
            'type' => 'subheading',
            'title' => esc_html__('Important:', 'natsy-core'),
            'subtitle' => esc_html__('All these options affects contact and comments form.', 'natsy-core')
        ),
		array(
			'id' => 'field_radius',
						'type' => 'slider',
			'title' => esc_html__('Field radius', 'natsy-core'),
			'desc' => esc_html__('Default: 0 pixels.', 'natsy-core'),
			'default' => '0',
			'min' => '0',
			'step' => '1',
						'max' => '100',
						'unit' => 'px',
		),
        array(
			'id' => 'input_bg_color',
			'type' => 'color',
			'title' => esc_html__('Input box background color', 'natsy-core'),
			'default' => $input_bg_color,
            'subtitle' =>  esc_html__('Default: '.$input_bg_color, 'natsy-core'),
			// 'validate' => 'color',
			'transparent' => false
        ),
        array(
			'id' => 'input_text_color',
			'type' => 'color',
			'title' => esc_html__('Input box text color', 'natsy-core'),
			'default' => $text_color,
            'subtitle' =>  esc_html__('Default: '.$text_color, 'natsy-core'),
			// 'validate' => 'color',
			'transparent' => false
        ),
        array(
			'id' => 'label_text_color',
			'type' => 'color',
			'title' => esc_html__('Label text color', 'natsy-core'),
			'default' => $text_color,
            'subtitle' =>  esc_html__('Default: '.$text_color, 'natsy-core'),
			// 'validate' => 'color',
			'transparent' => false
        ),
        array(
			'id' => 'submit_bg_color',
			'type' => 'color',
			'title' => esc_html__('Submit button background color', 'natsy-core'),
			'default' => $primary_color,
            'subtitle' =>  esc_html__("Default: ".$primary_color, 'natsy-core'),
			// 'validate' => 'color',
            'transparent' => false,
            // 'class' => 'nova-hide-transparent',
            'validate' => 'csf_validate_hex_color',
        ),
        array(
			'id' => 'submit_text_color',
			'type' => 'color',
			'title' => esc_html__('Submit button text color', 'natsy-core'),
			'default' => $white,
            'subtitle' =>  esc_html__('Default: '.$white, 'natsy-core'),
			// 'validate' => 'color',
			'transparent' => false
        ),
	)
) );

