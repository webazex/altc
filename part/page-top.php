<?php $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
<div class="page-cl__top" <?php if ($thumbnail_url):?> style="background-image: url('<?=esc_url($thumbnail_url);?>');" <?php endif; ?>>
    <div class="page-cl__title-bg">
    <div class="container">
        <div class="page-cl__title">
                <h1><?php the_title(); ?></h1>
        </div>
    </div>
    </div>
</div>