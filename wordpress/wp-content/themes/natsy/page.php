<?php get_header(); ?>
<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ):?>
<?php get_template_part( 'template-parts/headers/page-header' ); ?>
 <div class="nova-container">
	 <div class="grid-x">
		 <div class="cell small-12">
			 <div class="site-content">
				 <?php
						 // Elementor `single` location
                  get_template_part( 'template-parts/global/page-header' );
								 while ( have_posts() ) : the_post();
										 get_template_part( 'template-parts/content/content', 'page' );

								 endwhile;

								 wp_reset_postdata();

						 ?>
			 </div>

		 </div>
	 </div>
   </div>
   <?php endif; ?>
	 <?php if ( comments_open() || get_comments_number() ) : ?>
  <div class="nova-container">
	 <div class="single-comments-container">
		 <div class="grid-x">
			 <div class="cell large-12">
				 <div class="site-content">
					<?php comments_template(); ?>
				 </div>
			 </div>
		 </div>
	 </div>
    </div>
	 <?php endif; ?>

<?php
get_footer();
