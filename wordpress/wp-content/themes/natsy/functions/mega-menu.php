<?php

//==============================================================================
//	Hook into Walker to output our megamenu
//==============================================================================

if ( !function_exists( 'nova_widedropdown_css_classes' )) :

	add_filter( 'nav_menu_css_class', 'nova_widedropdown_css_classes',10,4);
	/**
	 * Add megamenu specific classes to megamenu marked items
	 *
	 * @param  array $classes <li> classes
	 * @param  object $item    menu item
	 * @param  object $args    menu object
	 * @param  int $depth
	 *
	 * @return array  an array of classes
	 */
	function nova_widedropdown_css_classes ( $classes, $item, $args, $depth ) {
		if ( $args->theme_location === 'nova_menu_primary' ) // Is there a megamenu option on this item
		{
			$classes[] = 'nova_widedropdown';
		}
		return $classes;
	}
endif;

if ( !function_exists( 'nova_widedropdown_item' )) :

	add_filter( 'walker_nav_menu_start_el', 'nova_widedropdown_item', 10, 4);
	/**
	 * Add our megamenu html to megamenu items
	 *
	 * @param  string $item_output html output of menu item
	 * @param  object $item        menu item
	 * @param  int $depth
	 * @param  object $args        menu object
	 *
	 * @return string            html for the menu item
	 */
	function nova_widedropdown_item ( $item_output, $item, $depth, $args ) {

		if ($args->theme_location === 'nova_menu_primary' ) {

			$id_fragment = 'primary-';

			$item_output = '<a data-toggle="'.$id_fragment.'panel-'.$item->ID.'" href="'.$item->url.'"><span>' . $item->title .'</span></a>';

			$megamenu_content = '';
			$mega_wrapper = 'class="foundation-mega-menu-content dropdown-pane" data-dropdown data-hover="true" data-hover-pane="true"';

			if ($args->theme_location == 'nova_menu_primary') {
				add_action($id_fragment . 'nova_widedropdown', function() use ( $megamenu_content ) { print wp_kses($megamenu_content,'simple'); });
			}
		}

		return $item_output;

	}
endif;