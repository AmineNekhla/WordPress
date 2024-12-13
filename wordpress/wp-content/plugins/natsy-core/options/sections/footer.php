<?php

$opt_name = NOVA_FRAMEWORK_VAR;

/* Footer */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Footer', 'natsy-core'),
	'icon' => 'fa fa-columns',
	'fields' => array(
        array(
			'id' => 'copyright_text',
			'type' => 'wp_editor',
			'title' => esc_html__('Footer copyright text (optional)', 'natsy-core'),
			'subtitle' => esc_html__('HTML and Shortcodes are allowed', 'natsy-core'),
            'desc' => '',
            'media_buttons' => false,
		),
	)
) );
