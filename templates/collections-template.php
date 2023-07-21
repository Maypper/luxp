<?php
/*
Template Name: Collections
Template Post Type: page
*/
get_header();
?>
<section class="collections">
    <div class="container">
        <h2><?php echo get_the_title(); ?></h2>
        <div class="collections__wrapper">
            <?php
            $collections = get_categories( [
                'taxonomy'     => 'collection',
                'type'         => 'product',
                'child_of'     => 0,
                'parent'       => '',
                'orderby'      => 'name',
                'order'        => 'ASC',
                'hide_empty'   => 0,
                'hierarchical' => 0,
                'exclude'      => '',
                'include'      => '',
                'number'       => 0,
                'pad_counts'   => false,
            ] );
            foreach ($collections as $collection) {
                $collection_slider = get_field('collection_slider', $collection);
                ?>
                <a href="<?php echo get_term_link($collection); ?>" class="collection-item <?php echo $collection->slug ?>">
                    <h4><?php echo $collection->name ?></h4>
                    <div class="collection-slider swiper">
                        <div class="swiper-wrapper">
                            <?php
                            if (have_rows('collection_slider', $collection)):
                                while (have_rows('collection_slider', $collection)):
                                    the_row();
                                    $img = get_sub_field('image');
                                    $img_url = wp_get_attachment_image_url($img, 'collection');
                                    ?>
                                    <div class="swiper-slide" style="background-image: url('<?php echo $img_url; ?>')"></div>
                                <?php
                                endwhile;
                            endif;
                            ?>
                        </div>
                        <span class="btn main-btn"><?php _e('EXPLORE', 'luxperfume'); ?></span>
                        <div class="collection-item__overlay">
                        </div>
                    </div>
                </a>
                <?php
            }
            ?>
        </div>
    </div>
</section>
<?php
get_footer();