<?php
add_action ( 'wp_head', 'nova_generate_header_codes', 1 );
function nova_generate_header_codes(){
    global $nova_theme;
    if( isset( $nova_theme['custom_scripts'] ) && $nova_theme['custom_scripts'] ){
        echo $nova_theme['custom_scripts'];
    }
}

add_action ( 'wp_footer', 'nova_generate_footer_codes', 100 );
function nova_generate_footer_codes(){
    global $nova_theme;
    if( isset( $nova_theme['custom_scripts_footer'] ) && $nova_theme['custom_scripts_footer'] ){
        echo $nova_theme['custom_scripts_footer'];
    }
}
function nova_custom_scripts_body() {
    global $nova_theme;
    if( isset( $nova_theme['custom_scripts_body'] ) && $nova_theme['custom_scripts_body'] ){
        echo $nova_theme['custom_scripts_body'];
    }
}
add_action('wp_body_open', 'nova_custom_scripts_body', 1);
