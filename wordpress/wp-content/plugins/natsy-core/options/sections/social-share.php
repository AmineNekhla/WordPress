<?php

$opt_name = NOVA_FRAMEWORK_VAR;

/* Social Profiles */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Social Share', 'natsy-core'),
	'icon' => 'fa fa-user',
	'customizer' => false,
	'fields' => array(
		array(
			'id' => 'sharing_facebook',
			'type' => 'switcher',
			'title' => esc_html__('Facebook', 'natsy-core'),
			'default' => 1
		),
		array(
			'id' => 'sharing_twitter',
			'type' => 'switcher',
			'title' => esc_html__('Twitter', 'natsy-core'),
			'default' => 1
		),
		array(
			'id' => 'sharing_reddit',
			'type' => 'switcher',
			'title' => esc_html__('Reddit', 'natsy-core'),
			'default' => 0
		),
		array(
			'id' => 'sharing_linkedin',
			'type' => 'switcher',
			'title' => esc_html__('Linkedin', 'natsy-core'),
			'default' => 1
		),
		array(
			'id' => 'sharing_tumblr',
			'type' => 'switcher',
			'title' => esc_html__('Tumblr', 'natsy-core'),
			'default' => 1
		),
		array(
			'id' => 'sharing_pinterest',
			'type' => 'switcher',
			'title' => esc_html__('Pinterest', 'natsy-core'),
			'default' => 1
		),
		array(
			'id' => 'sharing_line',
			'type' => 'switcher',
			'title' => esc_html__('Line', 'natsy-core'),
			'default' => 0
		),
		array(
			'id' => 'sharing_vk',
			'type' => 'switcher',
			'title' => esc_html__('Vk', 'natsy-core'),
			'default' => 0
		),
		array(
			'id' => 'sharing_whatapps',
			'type' => 'switcher',
			'title' => esc_html__('Whatapps', 'natsy-core'),
			'default' => 0
		),
		array(
			'id' => 'sharing_telegram',
			'type' => 'switcher',
			'title' => esc_html__('Telegram', 'natsy-core'),
			'default' => 0
		),
		array(
			'id' => 'sharing_email',
			'type' => 'switcher',
			'title' => esc_html__('Email', 'natsy-core'),
			'default' => 0
		),
	)
) );
