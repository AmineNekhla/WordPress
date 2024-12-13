<?php
/**
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bakerfresh WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
get_header();


if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
    while (have_posts()) :
        the_post();
        ?>

        <main <?php post_class('site-main'); ?> role="main">

            <div id="site-content-wrap">

                <div class="site-content--default">

                    <div class="page-content">

                        <?php

                        the_content();
                        ?>

                    </div><!-- .page-content -->
                    <div class="clearfix"></div>
                    <?php

                    wp_link_pages( array(
                        'before' => '<div class="clearfix"></div><div class="page-links">' . esc_html__( 'Pages:', 'natsy' ),
                        'after'  => '</div>',
                    ) );
                    ?>

                </div>
            </div>

        </main>

    <?php
    endwhile;
}

get_footer();
