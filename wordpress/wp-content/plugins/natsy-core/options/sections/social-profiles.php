<?php

$opt_name = NOVA_FRAMEWORK_VAR;

/* Social Profiles */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Social Profiles', 'natsy-core'),
	'desc' => esc_html__('Social profiles are used in different places inside the theme.', 'natsy-core'),
	'icon' => 'fa fa-user',
	'customizer' => false,
	'fields' => array(
    array(
			'id' => 'twitter_link',
            'type' => 'text',
            'sanitize' => 'sanitize_url',
			'title' => '<i class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x"></i></i> '.esc_html__('Twitter URL', 'natsy-core'),
			'desc' => esc_html__('e.g. https://twitter.com/nova-works', 'natsy-core')
		),
		array(
			'id' => 'facebook_link',
			'type' => 'text',
			'sanitize' => 'sanitize_url',
			'title' => '<i class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x"></i></i> '.esc_html__('Facebook URL', 'natsy-core'),
			'desc' => esc_html__('e.g. http://www.facebook.com/nova-works', 'natsy-core')
		),
		array(
			'id' => 'instagram_link',
			'type' => 'text',
			'sanitize' => 'sanitize_url',
			'title' => '<i class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-instagram fa-stack-1x"></i></i> '.esc_html__('Instagram url', 'natsy-core'),
			'desc' => esc_html__('e.g. https://instagram.com/wordpress', 'natsy-core')
        ),
        array(
			'id' => 'linkedin_link',
			'type' => 'text',
			'sanitize' => 'sanitize_url',
			'title' => '<i class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-linkedin fa-stack-1x"></i></i> '.esc_html__('Linkedin url', 'natsy-core'),
			'desc' => esc_html__('e.g. https://www.linkedin.com/in/my-name/', 'natsy-core')
		),
		array(
			'id' => 'pinterest_link',
			'type' => 'text',
			'sanitize' => 'sanitize_url',
			'title' => '<i class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-pinterest fa-stack-1x"></i></i> '.esc_html__('Pinterest url', 'natsy-core'),
			'desc' => esc_html__('e.g. https://www.pinterest.com/envato', 'natsy-core')
		),
		array(
			'id' => 'dribbble_link',
			'type' => 'text',
			'sanitize' => 'sanitize_url',
			'title' => '<i class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-dribbble fa-stack-1x"></i></i> '.esc_html__('Dribbble url', 'natsy-core'),
			'desc' => esc_html__('e.g. http://dribbble.com/wordpress', 'natsy-core')
		),
		array(
			'id' => 'tumblr_link',
			'type' => 'text',
			'sanitize' => 'sanitize_url',
			'title' => '<i class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-tumblr fa-stack-1x"></i></i> '.esc_html__('Tumblr URL', 'natsy-core'),
			'desc' => esc_html__('e.g. http://iamcollis.tumblr.com', 'natsy-core')
		),
		array(
			'id' => 'youtube_link',
			'type' => 'text',
			'sanitize' => 'sanitize_url',
			'title' => '<i class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-youtube fa-stack-1x"></i></i> '.esc_html__('Youtube url', 'natsy-core'),
			'desc' => esc_html__('e.g. https://www.youtube.com/user/wordpress', 'natsy-core')
		),
		array(
			'id' => 'vimeo_link',
			'type' => 'text',
			'sanitize' => 'sanitize_url',
			'title' => '<i class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-vimeo fa-stack-1x"></i></i> '.esc_html__('Vimeo url', 'natsy-core'),
			'desc' => esc_html__('e.g. https://vimeo.com/wordpress', 'natsy-core')
		),
		array(
			'id' => 'flickr_link',
			'type' => 'text',
			'sanitize' => 'sanitize_url',
			'title' => '<i class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-flickr fa-stack-1x"></i></i> '.esc_html__('Flickr url', 'natsy-core'),
			'desc' => esc_html__('e.g. http://www.flickr.com/photos/wordpress', 'natsy-core')
        ),
        array(
			'id' => 'twitch_link',
			'type' => 'text',
			'sanitize' => 'sanitize_url',
			'title' => '<i class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-twitch fa-stack-1x"></i></i> '.esc_html__('Twitch url', 'natsy-core'),
			'desc' => esc_html__('e.g. https://www.twitch.tv/name', 'natsy-core')
        ),
        array(
			'id' => 'vk_link',
			'type' => 'text',
			'sanitize' => 'sanitize_url',
			'title' => '<i class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-vk fa-stack-1x"></i></i> '.esc_html__('Vkontakte url', 'natsy-core'),
			'desc' => esc_html__('e.g. https://www.vk.com/name', 'natsy-core')
        ),
        array(
			'id' => 'telegram_link',
			'type' => 'text',
			'sanitize' => 'sanitize_url',
			'title' => '<i class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-telegram fa-stack-1x"></i></i> '.esc_html__('Telegram url', 'natsy-core'),
			'desc' => esc_html__('e.g. https://t.me/username', 'natsy-core')
        ),
        array(
			'id' => 'tiktok_link',
			'type' => 'text',
			'sanitize' => 'sanitize_url',
			'title' => '<i class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-music fa-stack-1x"></i></i> '.esc_html__('TikTok url', 'natsy-core'),
			'desc' => esc_html__('e.g. https://www.tiktok.com/@username', 'natsy-core')
        ),
        array(
			'id' => 'email_link',
			'type' => 'text',
			// 'sanitize' => 'sanitize_url',
			'title' => '<i class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-envelope fa-stack-1x"></i></i> '.esc_html__('Email', 'natsy-core'),
			'desc' => esc_html__('e.g. https://www.yourwebsite.com/contact OR direct email: johndoe@gmail.com', 'natsy-core')
		),
		array(
			'id' => 'rss_link',
			'type' => 'text',
			'sanitize' => 'sanitize_url',
			'title' => '<i class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-rss fa-stack-1x"></i></i> '.esc_html__('RSS URL', 'natsy-core'),
			'desc' => esc_html__('e.g. http://nova-works.com/feed', 'natsy-core')
		),
	)
) );
