<?php
$categories = get_categories( [
    'taxonomy'     => 'product_cat',
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
$all_image = get_field('all_products_image');
$all_btn = get_field('all_products_button_text');
?>
<section class="product-categories">
    <div class="container">
        <div class="product-categories__wrapper">
            <div class="product-categories__category" style="background-image: url('<?php echo $all_image; ?>')">
                <div class="product-categories__category--wrapper">
                    <span><?php _e('fragrances', 'luxperfume'); ?></span>
                    <h4><?php _e('All Products', 'luxperfume'); ?></h4>
                    <a href="<?php echo get_home_url('/shop'); ?>" class="btn main-btn desktop-only"><?php echo $all_btn; ?></a>
                </div>
                <a href="#" class="circle-btn mobile-only"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 15.8333L15.8333 5M15.8333 5V15.4M15.8333 5H5.43333" stroke="#3F3F3F" stroke-width="1.5625" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
            <?php
            if( $categories ):
                foreach( $categories as $cat ):
                    $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
                    if ($cat->slug != 'uncategorized'):
                    ?>
                    <div class="product-categories__category" style="background-image: url('<?php echo wp_get_attachment_url( $thumbnail_id ); ?>')">
                        <div class="product-categories__category--wrapper">
                            <span><?php _e('fragrances', 'luxperfume'); ?></span>
                            <h4><?php echo $cat->name; ?></h4>
                            <a href="<?php echo get_home_url('/shop'); ?>" class="btn main-btn desktop-only"><?php _e('Browse Now', 'luxperfume'); ?></a>
                        </div>
                        <a href="#" class="circle-btn mobile-only"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 15.8333L15.8333 5M15.8333 5V15.4M15.8333 5H5.43333" stroke="#3F3F3F" stroke-width="1.5625" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                    <?php
                    endif;
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>