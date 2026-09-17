<?php
/**
 * Template Name: GALLERY
 * Template Post Type: about
 */

get_header();

$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

?>


    <div class="page-cl">
        <div class="page-cl__top" <?php if ($thumbnail_url):?> style="background-image: url('<?=esc_url($thumbnail_url);?>');" <?php endif; ?>>
            <div class="container">
                <div class="page-cl__title">
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="page-cl__wrap">
                <div class="page-cl__left">
                    <?php get_template_part('part/left-bar'); ?>
                </div>
                <div class="page-cl__partners">

                    <?php  the_content(); ?>

                    <div class="page-cl__partners-list">
                        <?php if( have_rows('klyent') ): ?>
                            <?php while( have_rows('klyent') ): the_row(); ?>
                                <div class="page-cl__partners-item">
                                    <img src="<?php the_sub_field('yzobrazhenye'); ?>" alt="">
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>

    </div>



<?php

get_footer();
