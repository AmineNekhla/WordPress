<?php

$opt_name = NOVA_FRAMEWORK_VAR;

/* Blog Settings */

CSF::createSection( $opt_name, array(
    'id' => 'blog',
    'title' => esc_html__('Blog', 'natsy-core'),
    'icon' => 'fa fa-pencil-square-o'
) );

CSF::createSection( $opt_name, array(
    'title' => esc_html__('Blog Archives', 'natsy-core'),
    // 'icon' => 'fa fa-dollar',
    'parent' => 'blog',
	'fields' => array(
    array(
    	'id' => 'blog_wide_layout',
    	'type' => 'switcher',
    	'title' => esc_html__('Wide Layout', 'natsy-core'),
    	'default' => 0
    ),
    array(
    	'id' => 'blog_post_excerpt',
    	'type' => 'switcher',
    	'title' => esc_html__('Display Excerpt', 'natsy-core'),
    	'default' => 1
    ),
    array(
      'id' => 'blog_show_readmore_button',
      'type' => 'switcher',
      'title' => esc_html__('Display Readmore button', 'natsy-core'),
      'default' => 1
    ),
    array(
  		'id' => 'blog_sidebar',
  		'type' => 'switcher',
  		'title' => esc_html__('Blog Sidebar', 'natsy-core'),
  		'default' => 1
    ),
    array(
      'id' => 'blog_sidebar_position',
      'type' => 'button_set',
      'title' => esc_html__('Sidebar Position', 'natsy-core'),
      'subtitle' => '',
      'options' => array('left' => 'Left', 'right' => 'Right'),
      'default' => 'right',
      'dependency' => array('blog_sidebar', '==', '1'),
    ),
    array(
      'id' => 'blog_pagination',
      'type' => 'button_set',
      'title' => esc_html__('Pagination', 'natsy-core'),
      'subtitle' => '',
      'options' => array('default' => 'Classic', 'load_more_button' => 'Load More button', 'infinite_scroll' => 'Infinite'),
      'default' => 'default',
    ),
	)
) );
CSF::createSection( $opt_name, array(
    'title' => esc_html__('Blog Single', 'natsy-core'),
    // 'icon' => 'fa fa-dollar',
    'parent' => 'blog',
	'fields' => array(
    array(
    	'id' => 'blog_single_sidebar',
    	'type' => 'switcher',
    	'title' => esc_html__('Single Sidebar', 'natsy-core'),
    	'default' => 1
    ),
    array(
      'id' => 'blog_single_sidebar_position',
      'type' => 'button_set',
      'title' => esc_html__('Sidebar Position', 'natsy-core'),
      'subtitle' => '',
      'options' => array('left' => 'Left', 'right' => 'Right'),
      'default' => 'right',
      'dependency' => array('blog_single_sidebar', '==', '1'),
    ),
    array(
      'id' => 'blog_single_featured',
      'type' => 'switcher',
      'title' => esc_html__('Display Featured Image', 'natsy-core'),
      'default' => 1
    ),
    array(
      'id' => 'blog_single_social_share',
      'type' => 'switcher',
      'title' => esc_html__('Display Social Share', 'natsy-core'),
      'default' => 0
    ),
    array(
      'id' => 'blog_single_author_box',
      'type' => 'switcher',
      'title' => esc_html__('Display Author Box', 'natsy-core'),
      'default' => 0
    ),
    array(
      'id' => 'blog_single_post_nav',
      'type' => 'switcher',
      'title' => esc_html__('Display Post Navigation', 'natsy-core'),
      'default' => 0
    ),
  )
) );
