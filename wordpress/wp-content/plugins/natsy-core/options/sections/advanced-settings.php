<?php
$opt_name = NOVA_FRAMEWORK_VAR;

CSF::createSection( $opt_name, array(
    'title'       => esc_html__('Advanced Settings', 'natsy-core'),
    'icon'        => 'fa fa-cogs',
    'description' => __('Remember to backup your Theme Options before&nbsp;<b>Update the Theme.</b>', 'natsy-core'),
    'fields'      => array(
        array(
			'id' => 'enable_open_graph',
			'type' => 'switcher',
			'title' => esc_html__('Enable Meta Tags (Open Graph)', 'natsy-core'),
            'subtitle' => esc_html__('Example: og:image', 'natsy-core'),
			'desc' => esc_html__('Enable Open Graph basic support, if you are using Yoast SEO, it is recommended to disable this option.', 'natsy-core'),
			'default' => 1
		),
		array(
			'id' => 'css_code',
			'type' => 'code_editor',
			'title' => esc_html__('Custom CSS Code', 'natsy-core'),
			'desc' => esc_html__('e.g. #header{ background: #000; } Dont use &lt;style&gt; tags', 'natsy-core'),
			'subtitle' => esc_html__('Paste your CSS code here.', 'natsy-core'),
            'settings' => array(
                'theme'  => 'dracula',
                'mode'   => 'css',
                'tabSize' => 4
            ),
            'sanitize' => false
        ),
        array(
			'id' => 'custom_scripts',
			'type' => 'code_editor',
			'title' => esc_html__('Custom Scripts Below <head>', 'natsy-core'),
            'desc' => esc_html__('Here you can paste your Google Analytics code (not your id) or Adsense code. If you dont have it or you are already using one, just leave blank.', 'natsy-core'),
            'settings' => array(
                'theme'  => 'dracula',
                'mode'   => 'htmlmixed',
                'tabSize' => 4
            ),
            'sanitize' => false
        ),
        array(
			'id' => 'custom_scripts_body',
			'type' => 'code_editor',
			'title' => esc_html__('Custom Scripts just after opening <body>', 'natsy-core'),
            'desc' => esc_html__('Here you can paste your any custom script that will be included on Body with high priority, like Google Tag code.', 'natsy-core'),
            'settings' => array(
                'theme'  => 'dracula',
                'mode'   => 'htmlmixed',
                'tabSize' => 4
            ),
            'sanitize' => false
        ),
        array(
			'id' => 'custom_scripts_footer',
			'type' => 'code_editor',
			'title' => esc_html__('Custom Scripts on Footer before closing </body>', 'natsy-core'),
            'desc' => esc_html__('Here you can paste your any custom script that will be included on Footer with less priority.', 'natsy-core'),
            'settings' => array(
                'theme'  => 'dracula',
                'mode'   => 'htmlmixed',
                'tabSize' => 4
            ),
            'sanitize' => false
        ),
    )
) );
