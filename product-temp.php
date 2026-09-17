<?php
/**
 * Template Name: PRODUCT-TEMP
 * Template Post Type: commercial-solar, home-ess, home-solar, commercial-ess
 */

get_header();

$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

?>


    <div class="page-cl">
        <?php get_template_part('part/page-top'); ?>
        <div class="container">
            <div class="page-cl__wrap">
                <div class="page-cl__left">
                    <?php get_template_part('part/left-bar'); ?>
                </div>
                <div class="page-cl__product">



                    <?=get_field('vs-content');?>


                    <?php
                      $price_title = get_field('price-title');
                      $price_img = get_field('price_photo');
                      if(!$price_img) $price_img = '/wp-content/uploads/2026/08/active-energy-hero-410x230-1.jpg';
                      if($price_title):
                    ?>
                    <div class="page-cl__product-short">
                        <div class="page-cl__product-short-img">
                            <img src="<?=$price_img;?>" alt="<?=$price_title;?>">
                        </div>
                        <div class="page-cl__product-short-info">
                            <div class="page-cl__product-short-title"><?=$price_title;?></div>
                            <div class="page-cl__product-short-price"><?php pll_e('Ціна:'); ?> <span><?=get_field('price_price');?></span></div>
                            <div class="page-cl__product-short-buttons">
                                <button><?php pll_e('Купити'); ?></button>
                                <button><?php pll_e('Питання по станції'); ?></button>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php
                      $ch_title = get_field('char_title');
                      if ($ch_title):
                    ?>
                    <div class="page-cl__product-characteristics">
                        <div class="page-cl__product-characteristics-title"><?=$ch_title;?></div>
                        <div class="page-cl__product-characteristics-list">
                            <?php if( have_rows('ch_list') ): ?>
                                <?php while( have_rows('ch_list') ): the_row(); ?>
                                    <div class="page-cl__product-characteristics-item">
                                        <div class="page-cl__product-characteristics-name"><?php the_sub_field('ch_name');?> -</div>
                                        <div class="page-cl__product-characteristics-value"><?php the_sub_field('ch_value');?></div>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?=get_field('price_after_content');?>

                    <?php get_template_part('part/contact-form'); ?>

                </div>
            </div>
        </div>

    </div>



<?php

get_footer();
