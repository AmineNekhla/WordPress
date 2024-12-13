<div class="<?php echo ( 1 == nova_get_option('blog_wide_layout') ) ? 'nova-container-fluid' : 'nova-container' ?>">
	<div class="blog-listing listing-search sidebar-status">
		<div class="site-content">
			<div class="grid-x">
				<?php if ( 1 == nova_get_option('blog_sidebar', 1) && is_active_sidebar( 'blog-widget-area' ) && 'left' == nova_get_option('blog_sidebar_position', 'right') ) : ?>
					<div id="sidebar_primary" class="nova-sidebar cell small-12 large-3">
						<div class="nova-sidebar__overlay js-sidebar-toogle"></div>
						<div class="nova-sidebar__container">
							<a class="nova-sidebar__toggle js-sidebar-toogle" href="javascript:void(0)"></a>
							<div class="woocommerce-sidebar-sticky sidebar-scrollable">
								<?php if (is_active_sidebar( 'blog-widget-area' )) : ?>
									<?php get_sidebar(); ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>

			<div class="cell small-12 <?php echo ( 1 == nova_get_option('blog_sidebar', 1) && is_active_sidebar( 'blog-widget-area' ) ) ? 'large-8 xlarge-9' : 'large-12' ?> site-main-content-wrapper">

					<div class="site-main-content">

						<div class="blog-articles">
							<?php
							if ( have_posts() ) {
								while ( have_posts() ) : the_post();
									get_template_part( 'template-parts/content/content');
								endwhile;
							}else {
								get_template_part( 'template-parts/content/content', 'none' );
							}
							?>
						</div>

						<?php
						the_posts_navigation(array(
							'prev_text' => esc_html__( 'Older posts', 'natsy' ),
							'next_text' => esc_html__( 'Newer posts', 'natsy' ),
						));
						?>

					</div>

				</div>

				<?php if ( 1 == nova_get_option('blog_sidebar', 1) && is_active_sidebar( 'blog-widget-area' ) && 'right' == nova_get_option('blog_sidebar_position', 'right') ) : ?>
					
					<div id="sidebar_primary" class="nova-sidebar cell small-12 large-3">
						<div class="nova-sidebar__overlay js-sidebar-toogle"></div>
						<div class="nova-sidebar__container">
							<a class="nova-sidebar__toggle js-sidebar-toogle" href="javascript:void(0)"></a>
							<div class="woocommerce-sidebar-sticky sidebar-scrollable">
								<?php if (is_active_sidebar( 'blog-widget-area' )) : ?>
									<?php get_sidebar(); ?>
								<?php endif; ?>
							</div>
						</div>
					</div>

				<?php endif; ?>
			</div>

		</div>
	</div>
</div>