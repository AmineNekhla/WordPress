<?php
add_action('wp_enqueue_scripts', 'nova_enqueue_scripts_plugin', 11);
function nova_enqueue_scripts_plugin() {
  $prefix = NOVA_THEMEPREFIX.'-';
  $nova_theme = nova_get_theme_options();
  if (!empty($nova_theme)) {
    $fonts = array(
        $nova_theme['primary_titles_font'],
        $nova_theme['body_font'],
    );
    wp_register_style( $prefix . 'theme-options-google-fonts' , nova_theme_options_google_fonts( $fonts ), NULL, NULL );
    wp_enqueue_style( $prefix . 'theme-options-google-fonts' );
  }
}
function nova_theme_options_google_fonts($google_fonts) {
    $link = $fonts_url = "";
    $subsets = array();
    $fonts = array();
    foreach ( $google_fonts as $font ) {
        $link = '';
        if(  isset($font['type']) && $font['type'] == 'google' ){

            $link .= $font['font-family'];
            if( !empty($font['font-family']) && !empty($font['font-weight']) ){
                $font_w = "";
                if($font['font-weight'] == 'normal') {
                  $font_w = "400";
                }else {
                  $font_w = $font['font-weight'] ;
                }
                $link .= ':wght@'.$font_w ;
            }

            if( $link ){
                $fonts[] = $link;
            }

            if ( ! empty( $font['subsets'] ) ) {
                if ( ! in_array( $font['subsets'], $subsets ) ) {
                    array_push( $subsets, $font['subsets'] );
                }
            }
        }

    }

    if ( $fonts ) {
        $fonts_url = add_query_arg( array(
            'family' => implode( '&family=', $fonts ),
            'display' => 'swap',
        ), 'https://fonts.googleapis.com/css2' );
    }

    return $fonts_url;
}
?>
