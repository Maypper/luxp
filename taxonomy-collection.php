<?php
get_header();
$term = get_queried_object();
$tax_id = $term->term_id;
$text = get_field('banner_text', $term);
$banner_image = get_field('banner_img', $term);
?>
    <section class="shop-banner<?php if ($banner_image) { echo ' white-content';} ?>" style="background-image: url('<?php echo $banner_image?>')">
        <div class="container">
            <?php echo get_breadcrumbs(); ?>
            <div class="shop-banner__wrapper">
                <h3><?php echo $term->name; ?></h3>
                <p><?php echo $text ?></p>
            </div>
        </div>
    </section>
<section class="products">
    <div class="container">
        <?php get_template_part('template-parts/product-loop-filter');
        wp_reset_query();
        $args = array('post_type' => 'product',
            'tax_query' => array(
                array(
                    'taxonomy' => 'collection',
                    'field' => 'slug',
                    'terms' => $term->slug,
                ),
            ),
            'posts_per_page' => 8,
        );
        $loop = new WP_Query($args);
        ?>
        <div class="products__count">
            <?php
            $count = $loop->found_posts;
            ?>
            <p class="small"><span><?php echo $count ?></span> <?php _e('items', 'luxperfume'); ?></p>
        </div>
        <div class="products__wrapper">
            <?php
            if($loop->have_posts()) {
                while ($loop->have_posts()) {
                    $loop->the_post();
                    get_template_part('template-parts/cards/product-card', 'loop');
                }
            }
            ?>
        </div>
        <?php
        global $wp_query;

        $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
        $max_pages = $loop->max_num_pages;

        if( $paged < $max_pages ) {
            echo '<div id="loadmore" style="text-align:center;">
<div data-max_pages="' . $max_pages . '" data-paged="' . $paged . '" class="lds-ellipsis loadmore-btn"><div></div><div></div><div></div><div></div></div>
	</div>';
        }
        ?>
    </div>
</section>
<?php
$subtitle = get_field('subtitle_newsletter', 'options');
$title = get_field('title_newsletter', 'options');
$text = get_field('text_newsletter', 'options');
$form = get_field('form_newsletter', 'options');
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
<?php
get_footer();