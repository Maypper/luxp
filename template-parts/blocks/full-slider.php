<section class="full-slider">
    <div class="full-width-swiper swiper">
        <div class="swiper-wrapper">
            <?php
            if (have_rows('slides')):
                while (have_rows('slides')):
                    the_row();
                    $img = get_sub_field('img');
                    $img_mobile = get_sub_field('img_mobile');
                    $subtitle = get_sub_field('subtitle');
                    $title = get_sub_field('title');
                    $text = get_sub_field('text');
                    $btn = get_sub_field('btn');
                    $is_reverse = get_sub_field('is_reverse');
                    if ($is_reverse) {
                        $is_reverse = ' reverse-style';
                    } else {
                        $is_reverse = '';
                    }
                    ?>
                <div class="swiper-slide" style="background-image: url('<?php echo $img; ?>')">
                    <div class="container">
                        <div class="full-slider__slide<?php echo $is_reverse; ?>">
                            <p class="subtitle"><?php echo $subtitle ?></p>
                            <h2><?php echo $title ?></h2>
                            <p><?php echo $text; ?></p>
                            <?php if ($btn): ?>
                                <a class="btn main-btn" href="<?php echo $btn['url']; ?>" target="<?php echo $btn['target']; ?>"><?php echo $btn['title']; ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if ($img_mobile): ?>
                    <div class="bg-mobile" style="background-image: url('<?php echo $img_mobile ?>')"></div>
                    <?php endif; ?>
                </div>
            <?php
                endwhile;
            endif;
            ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>
