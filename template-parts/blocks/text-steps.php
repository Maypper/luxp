<?php
$title = get_field('title');
?>
<section class="text-steps">
    <div class="container">
        <div class="text-steps__wrapper">
            <div class="text-steps__title">
                <h3><?php echo $title; ?></h3>
            </div>
            <div class="text-steps__steps">
                <?php
                if (have_rows('steps')) :
                    $number = 1;
                    while (have_rows('steps')):
                        the_row();
                        $is_image = get_sub_field('is_image');
                        if (!$is_image) {
                            $title = get_sub_field('title');
                            $text = get_sub_field('text');
                            echo '<div class="text-steps__steps--step">';
                            ?>
                            <div class="step-title">
                                <span class="number"><?php if ($number <= 9) { echo '0';} echo $number; ?></span>
                                <h4><?php echo $title; ?></h4>
                            </div>
                            <p><?php echo $text; ?></p>
                <?php
                            $number++;
                        } else {
                            $img = get_sub_field('img');
                            echo '<div class="text-steps__steps--step is-image">';
                            echo '<img src="'. $img["url"] .'" alt="'. $img["alt"] .'">';
                        }
                        echo '</div>';

                    endwhile;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>
