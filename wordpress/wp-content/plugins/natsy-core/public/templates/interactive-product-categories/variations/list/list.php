<div class="nova-interactive-product-categories nova-layout--<?php echo $layout ?>">
	<div class="nova-grid-inner">
		<?php foreach ( $items as $item ) { ?>

			<div class="nova-list nova-grid-item">
				<div class="nova-list-inner">

					<div class="nova-list-title-wrapper">
						<<?php echo esc_attr( $html_tag ); ?> class="nova-list-title">
							<a itemprop="url" href=<?php echo get_term_link( $item -> slug, 'product_cat' ); ?>  target="<?php echo esc_attr( $link_target ); ?>">
								<?php echo esc_html( $item -> name ); ?>
							</a>
						</<?php echo esc_attr( $html_tag ); ?>>

						<div class="nova-list-count">
							<?php echo '(' . esc_html( $item -> count ) . ')' ; ?>
						</div>

						<div class="nova-list-image">
							<a itemprop="url" href=<?php echo get_term_link( $item -> slug, 'product_cat' ); ?> target="<?php echo esc_attr( $link_target ); ?>">
                            <?php natsy_core_template_part( 'interactive-product-categories', 'image', '', $item ); ?>
							</a>
						</div>
					</div>
				<div class="nova-list-button">
					<a class="nova-button" itemprop="url" href=<?php echo get_term_link( $item -> slug, 'product_cat' ); ?>  target="<?php echo esc_attr( $link_target ); ?>">
					<?php echo $icon_html; ?>
					</a>
				</div>
			</div>
			</div>

		<?php } ?>
	</div>
</div>
