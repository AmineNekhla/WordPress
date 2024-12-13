<div class="nova-interactive-product-categories nova-layout--<?php echo $layout ?>">
<div class="nova-m-items">
<?php
			$i = 0;

		foreach ( $items as $item ) {

			$taxonomy_image_meta = get_term_meta( $item->term_id, 'thumbnail_id', true );
			$cat_thumb_id = get_term_meta( $item->term_id, 'thumbnail_id', true );
			$cat_thumb_url = wp_get_attachment_image_src( $cat_thumb_id, 'woocommerce_thumbnail' );
			?>
			<a itemprop="url" class="nova-m-item" href="<?php echo get_term_link( $item->slug, 'product_cat' ); ?>" target="<?php echo esc_attr( $link_target ); ?>" data-index="<?php echo intval( $i ++ ); ?>">
				<span class="nova-e-title"><?php echo esc_html( $item->name ); ?>
					<span class="nova-e-count">
					<?php echo '(' . esc_html( $item->count ) . ')'; ?>
					</span>
				</span>
				<span class="nova-e-follow-content">
						<span class="nova-e-follow-image">
						<?php natsy_core_template_part( 'interactive-product-categories', 'image', '', $item ); ?>
						</span>
				</span>
			</a>
		<?php }?>
</div>
</div>
