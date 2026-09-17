<?php
/**
 * Template Name: TEAM
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
                <div class="page-cl__komanda">
                    <?php  the_content(); ?>
                    <div class="page-cl__komanda-slogan"><?php pll_e('Кращі спеціалісти своєї справи');?></div>
                    <div class="page-cl__komanda-title">
                        <?php pll_e('Команда <span>Alteco</span>');?>
                    </div>
                    <div class="page-cl__komanda-list">
                        <?php if( have_rows('chlen_komand') ): ?>
                                <?php while( have_rows('chlen_komand') ): the_row(); ?>
                                <div class="page-cl__komanda-item">
                                    <div class="page-cl__komanda-item-img">
                                        <img src="<?php the_sub_field('foto'); ?>" alt="">
                                    </div>
                                    <div class="page-cl__komanda-item-name"><?php the_sub_field('ymya'); ?></div>
                                    <div class="page-cl__komanda-item-role"><?php the_sub_field('dolzhnost'); ?></div>
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
