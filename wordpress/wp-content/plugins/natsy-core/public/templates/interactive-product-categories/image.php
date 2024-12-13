<?php
$term_id = $params -> term_id;

$taxonomy_image_meta = get_term_meta( $term_id, 'thumbnail_id', true );
$taxonomy_image      = ! empty( $taxonomy_image_meta ) ? $taxonomy_image_meta : get_option( 'woocommerce_placeholder_image', 0 );

if ( ! empty( $term_id ) ) {
	echo natsy_core_get_list_shortcode_item_image( 'full', $taxonomy_image );
}
