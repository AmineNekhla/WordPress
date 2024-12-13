<?php
add_filter( 'novathemes_fonts_choices','nova_kirki_fonts_choices' );
/**
* Add support wp-custom-fonts in Kirki
*/
function nova_kirki_fonts_choices( $settings = [] ) {

	$fonts_list = apply_filters( 'novathemes_fonts_list', [] );
	if ( ! $fonts_list ) {
		return $settings;
	}

	$fonts_settings = [
		'fonts' => [
			'google' => [],
			'families' => isset( $fonts_list[ 'families' ] ) ? $fonts_list[ 'families' ] : null,
			'variants' => isset( $fonts_list[ 'variants' ] ) ? $fonts_list[ 'variants' ] : null
		]
	];

	$fonts_settings = array_merge( (array) $fonts_settings, (array) $settings );
	return $fonts_settings;
}
if( ! function_exists( 'nova_custom_font_family' ) ) {

function nova_custom_font_family( $fonts ) {

    $fonts_list = apply_filters( 'novatheme_options_fonts_list', [] );
		if ( ! $fonts_list ) {
			return $fonts;
		}
		// print_r($fonts_list['variants']  );
		// die();
    // Adding new fonts
    //$fonts['MyFont'] = array( '300', 'normal', 'italic', '700', '700italic' );
    return $fonts_list['variants'] ;

  }
  add_filter( 'csf_field_typography_customwebfonts', 'nova_custom_font_family' );
}
// print_r(apply_filters(
// 	'novathemes_fonts_choices', [
// 		'variant' => [
// 			'300',
// 			'400',
// 			'500',
// 			'600',
// 			'700',
// 		]
// 	]
// ));
// die();
