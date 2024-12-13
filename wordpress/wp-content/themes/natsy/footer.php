
        </div><!-- .site-content-wrapper -->
        <?php
        if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
            get_template_part( 'template-parts/footers/footer', 'type-mini' );
        }
        ?>
        <?php if( NOVA_WOOCOMMERCE_IS_ACTIVE ): ?>
        <?php get_template_part( 'template-parts/footers/footer-quickview') ?>
        <?php endif; ?>
    </div><!-- .site-wrapper -->
    <?php get_template_part( 'template-parts/footers/footer-canvas' ) ?>
    <?php get_template_part( 'template-parts/footers/footer-popup' ) ?>
    <?php if( nova_get_option('site_preloader',1) &&  nova_get_option('topbar_progress',1) != '1'): ?>
      <?php get_template_part( 'template-parts/footers/preloader' ) ?>
    <?php endif; ?>
    <?php get_template_part( 'template-parts/global/svg-icons' ) ?>
    <div class="nova-overlay-global"></div>
    <?php wp_footer(); ?>
</body>
</html>
