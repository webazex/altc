<?php
/**
 * Template Name: ABOUT-CL
 * Template Post Type: about, services, technology, economy, home-solar, commercial-ess
 */

get_header();



?>


    <div class="page-cl">
        <?php get_template_part('part/page-top'); ?>
        <div class="container">
            <div class="page-cl__wrap">
                <div class="page-cl__left">
                    <?php get_template_part('part/left-bar'); ?>
                </div>
                <div class="page-cl__right">
                   <?php  the_content(); ?>
                   <?php get_template_part('part/contact-form'); ?>
                </div>
            </div>
        </div>

    </div>



<?php

get_footer();
