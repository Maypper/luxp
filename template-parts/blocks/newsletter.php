<?php
$subtitle = get_field('subtitle');
$title = get_field('title');
$text = get_field('text');
$form = get_field('form');
?>
<section class="newsletter">
    <div class="container">
        <div class="newsletter__wrapper">
            <p class="subtitle"><?php echo $subtitle; ?></p>
            <h3><?php echo $title; ?></h3>
            <p><?php echo $text; ?></p>
            <?php
            if ($form){
                $shortcode = '[contact-form-7 id="' . $form->ID . '" title="' . $form->post_title . '"]';
                echo do_shortcode($shortcode);
            }
            ?>
        </div>
    </div>
</section>
