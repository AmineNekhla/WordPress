<?php $nova_theme = nova_get_theme_options(); ?>
<footer class="site-footer">
	<div class="nova-footer footer-type-1">

		<div class="row small-collapse">
			<div class="large-12 columns">

				<div class="nova-footer__copyright-text">
						<?php if( nova_get_option('copyright_text') ): ?>
							<div class="footer-text">
									<?php echo wp_kses_post( do_shortcode($nova_theme['copyright_text']) ); ?>
							</div>
					<?php else: ?>
					<div class="footer-text">
							© 2023 Natsy All rights reserved. Designed by Novaworks
					</div>
				<?php endif; ?>
				</div>

			</div>
		</div>

	</div>

</footer>
