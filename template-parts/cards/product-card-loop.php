<?php
global $product;
$product_id = get_the_ID();
$product_bage = get_field('product_bage', $product_id);
?>
<a class="shop-card card-loop" href="<?php echo get_post_permalink($product_id); ?>">
    <div class="shop-card__img">
        <?php if ($product_bage): ?>
            <span class="product-bage"><?php echo $product_bage; ?></span>
        <?php
        endif;
        echo get_the_post_thumbnail($product_id, 'product-card')
        ?>
    </div>
    <p class="big"><?php echo get_the_title(); ?></p>
    <?php echo $product->get_price_html(); ?>
    <div class="circle-btn">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.3244 5.17559C17.2072 5.05859 17.0574 5 16.875 5H13.75C13.7238 3.93203 13.3592 3.04668 12.6562 2.34375C11.9533 1.64082 11.068 1.27617 10 1.25C8.93203 1.27617 8.04668 1.64082 7.34375 2.34375C6.64082 3.04668 6.27617 3.93203 6.25 5H3.125C2.94238 5 2.79258 5.05859 2.67559 5.17559C2.55859 5.29277 2.5 5.44258 2.5 5.625V18.125C2.5 18.3076 2.5584 18.4574 2.67559 18.5744C2.79277 18.6914 2.94258 18.75 3.125 18.75H16.875C17.0576 18.75 17.2074 18.6916 17.3244 18.5744C17.4414 18.4572 17.5 18.3074 17.5 18.125V5.625C17.5 5.44238 17.4416 5.29258 17.3244 5.17559ZM8.23242 3.23242C8.70742 2.75703 9.29668 2.51289 10 2.5C10.7029 2.51328 11.2922 2.75742 11.7676 3.23242C12.243 3.70742 12.4871 4.29668 12.5 5H7.5C7.51328 4.29707 7.75742 3.70781 8.23242 3.23242ZM16.25 17.5H3.75V6.25H6.25V8.75H7.5V6.25H12.5V8.75H13.75V6.25H16.25V17.5Z" fill="#3F3F3F"/>
        </svg>
    </div>
</a>
