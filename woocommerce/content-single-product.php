<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );
if ( post_password_required() ) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
//remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
//remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

$content = get_the_content();
$content = str_replace('<p><strong>', '<p class="product__includes">', $content);
$content = str_replace('</strong></p>', '</p>', $content);
$content = str_replace('<p>', '<p class="product__data">', $content);
$currentcats = $product->get_category_ids();

?>
<div class="container breadcrumbs-container">
    <?php echo get_breadcrumbs(); ?>
</div>
    <section id="product-<?php the_ID(); ?>" class="product">
        <div class="container">
            <div class="product__wrapper">
                <div class="product__img">
                    <div class="vertical-pagination">
                        <span class="vertical-pagination__item active" data-num="0"><?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'product-pagination') ?></span>
                        <?php
                        $gallery_images = $product->get_gallery_image_ids();
                        if ($gallery_images) {
                            $i = 1;
                            foreach ($gallery_images as $gallery_image) {
                                echo '<span class="vertical-pagination__item" data-num="'. $i .'">' . wp_get_attachment_image($gallery_image, 'product-pagination') . '</span>';
                                $i++;
                            }
                        }
                        ?>
                    </div>
                    <div class="vertical-slider swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" >
                                <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'product-single') ?>
                            </div>
                            <?php
                            if ($gallery_images) {
                                foreach ($gallery_images as $gallery_image) {
                                    ?>
                                    <div class="swiper-slide">
                                        <?php echo wp_get_attachment_image($gallery_image, 'product-single'); ?>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    $product_bage = get_field('product_bage', $product->get_id());
                    if ($product_bage) {
                        ?>
                        <span class="product-bage"><?php echo $product_bage; ?></span>
                    <?php } ?>
                </div>
                <div class="product__info-text">
                    <h4><?php echo get_the_title() ?></h4>
                    <?php
                    echo $content;
                    do_action( 'woocommerce_single_product_summary' );
                    if ( !$product->is_type( 'variable' ) ) {
                        ?>
                        <style>
                            .product__info-text form.cart {
                                display: flex;
                                gap: 10px;
                            }
                        </style>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
<?php
$tax_query[] = array(
    'taxonomy' => 'product_visibility',
    'field'    => 'name',
    'terms'    => 'featured',
    'operator' => 'IN',
);

// The query
$query = new WP_Query( array(
    'post_type'           => 'product',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => 1,
    'tax_query'           => $tax_query,
    'posts_per_page' => 4,
) );
?>
<section class="featured-products">
    <div class="container">
        <div class="featured-products__top">
            <h3><?php _e('Featured fragrances', 'luxperfume') ?></h3>
        </div>
        <div class="featured-products__slider">
            <div class="basic-swiper basic-swiper-styles swiper">
                <div class="swiper-wrapper">
                    <?php
                    if ( $query->have_posts() ) {
                        while ( $query->have_posts() ) {
                            $query->the_post();
                            echo '<div class="swiper-slide">';
                            get_template_part('template-parts/cards/product-card');
                            echo '</div>';
                        }
                    }
                    ?>
                </div>

                <!-- scrollbar -->
                <div class="swiper-scrollbar"></div>

                <!-- buttons -->
                <div class="swiper-button-prev">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="40" height="40" rx="20" transform="matrix(4.37114e-08 1 1 -4.37114e-08 0 0)" fill="white" fill-opacity="0.6"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.3348 19.049C15.8885 19.4953 15.8885 20.219 16.3348 20.6653L22.0491 26.3796C22.4954 26.8259 23.219 26.8259 23.6653 26.3796C24.1117 25.9332 24.1117 25.2096 23.6653 24.7633L18.7592 19.8571L23.6653 14.951C24.1117 14.5047 24.1117 13.781 23.6653 13.3347C23.219 12.8884 22.4954 12.8884 22.0491 13.3347L16.3348 19.049Z" fill="#3F3F3F"/>
                    </svg>
                </div>
                <div class="swiper-button-next">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="40" width="40" height="40" rx="20" transform="rotate(90 40 0)" fill="white" fill-opacity="0.6"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M23.6651 19.049C24.1115 19.4953 24.1115 20.219 23.6651 20.6653L17.9509 26.3796C17.5045 26.8259 16.7809 26.8259 16.3346 26.3796C15.8883 25.9332 15.8883 25.2096 16.3346 24.7633L21.2408 19.8571L16.3346 14.951C15.8883 14.5047 15.8883 13.781 16.3346 13.3347C16.7809 12.8884 17.5045 12.8884 17.9509 13.3347L23.6651 19.049Z" fill="#3F3F3F"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$display_steps = get_field('steps_product_display', 'options');
if ($display_steps):
    $title = get_field('steps_product_title', 'options');
    $text = get_field('steps_product_text', 'options');
?>
<section class="text-steps">
    <div class="container">
        <div class="text-steps__wrapper">
            <div class="text-steps__title">
                <h3><?php echo $title; ?></h3>
                <?php echo $text; ?>
            </div>
            <div class="text-steps__steps">
                <?php
                if (have_rows('steps_product', 'options')) :
                    $number = 1;
                    while (have_rows('steps_product', 'options')):
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
<?php
endif;
//do_action( 'woocommerce_after_single_product_summary' );
/**
 * Hook: woocommerce_after_single_product_summary.
 *
 * @hooked woocommerce_output_product_data_tabs - 10
 * @hooked woocommerce_upsell_display - 15
 * @hooked woocommerce_output_related_products - 20
 */

$average_rating = $product->get_average_rating();
$average_star_rating = wc_get_rating_html($average_rating);
$rating_count = $product->get_rating_count();
$average_rating = number_format($average_rating, 1, '.', '');
?>
    <section class="reviews">
        <div class="container">
            <div class="reviews__wrapper">
                <h3><?php _e('Reviews', 'luxperfume'); ?></h3>
                <div class="reviews__wrapper--each">
                    <?php
                    for ($star = 5; $star > 0; $star--) {
                        $current_rating_count = $product->get_rating_count($star);
                        $percents = $current_rating_count / ($rating_count / 100);
                        $svg_percents = (176.552/100) * $percents;
                        $percents = round($percents);
                        ?>
                        <div class="star-reviews-count">
                            <span><?php echo $star . ' ' . __('star', 'luxperfume'); ?></span>
                            <div class="progressbar">
                                <div class="bar" style="width: <?php echo $percents ?>%;"></div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="177" height="5" viewBox="0 0 177 5" fill="none">
                                    <rect x="0.207031" width="176.552" height="5" rx="2.5" fill="#E8E4DF"/>
                                    <rect x="0.207031" width="<?php echo $svg_percents ?>" height="5" rx="2.5" fill="#BEB2A4"/>
                                </svg>
                            </div>
                            <span><?php echo $percents . '%' ?></span>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="reviews__wrapper--average">
                    <p><?php _e('Overall rating', 'luxperfume'); ?></p>
                    <div class="average-rating">
                        <h2><?php echo $average_rating; ?></h2>
                        <div class="average-rating__stars">
                            <div class="stars"><?php echo $average_star_rating; ?> <p class="small"><?php echo round($average_rating, 1) . '/5'; ?></p> </div>
                            <?php
                            if ($rating_count == 1) {
                                $reviews_label = __('review');
                            } else {
                                $reviews_label = __('reviews');
                            }

                            ?>
                            <span class="grey"><?php echo $rating_count . ' ' . $reviews_label; ?></span>
                        </div>
                    </div>
                </div>
                <div class="reviews__wrapper--form">
                    <a href="#" class="btn secondary-btn open-comment-form"><?php _e('Add review', 'luxperfume'); ?></a>
                    <?php
                    if (is_user_logged_in()) {
                        $current_user = wp_get_current_user();
                    } else {
                        $current_user = false;
                    }
                    ?>
                    <div class="review-form-collapse">
                        <?php
                        if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
                            <div class="review_form_wrapper">
                                <?php
                                if ($current_user) {
                                    $user_avatar = get_user_meta($current_user->ID, 'user_avater', true);
                                    if ($user_avatar) {
                                        echo '<img class="avatar" src="' . $user_avatar . '">';
                                    } else {
                                        echo '<div class="avatar-default">' . substr($current_user->user_firstname, 0, 1) . '</div>';
                                    }
                                }
                                ?>
                                <div id="review_form" class="contact__box review-form">
                                    <?php
                                    if ($current_user) {
                                        echo '<h5>' . $current_user->user_firstname . ' ' . substr($current_user->user_lastname, 0, 1) .'.</h5>';
                                    }
                                    $commenter    = wp_get_current_commenter();
                                    $comment_form = array(
                                        /* translators: %s is product title */
                                        /* translators: %s is product title */
                                        'title_reply_to'      => false,
                                        'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
                                        'title_reply_after'   => '</span>',
                                        'comment_notes_after' => '',
                                        'label_submit'        => esc_html__( 'Send', 'woocommerce' ),
                                        'logged_in_as'        => '',
                                        'comment_field'       => '',
                                    );

                                    $name_email_required = (bool) get_option( 'require_name_email', 1 );
                                    $fields              = array(
                                        'author' => array(
                                            'placeholder' => 'Name',
                                            'type'     => 'text',
                                            'value'    => $commenter['comment_author'],
                                            'required' => $name_email_required,
                                        ),
                                        'email'  => array(
                                            'placeholder' => 'Email',
                                            'type'     => 'email',
                                            'value'    => $commenter['comment_author_email'],
                                            'required' => $name_email_required,
                                        ),
                                    );

                                    $comment_form['fields'] = array();

                                    foreach ( $fields as $key => $field ) {
                                        $field_html  = '<p class="comment-form-' . esc_attr( $key ) . '">';

                                        $field_html .= '<input class="input" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" value="' . esc_attr( $field['value'] ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' /></p>';

                                        $comment_form['fields'][ $key ] = $field_html;
                                    }

                                    $account_page_url = wc_get_page_permalink( 'myaccount' );
                                    if ( $account_page_url ) {
                                        /* translators: %s opening and closing link tags respectively */
                                        $comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'woocommerce' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
                                    }

                                    if ( wc_review_ratings_enabled() ) {
                                        $comment_form['comment_field'] = '<p class="form-title">' . __( 'Your review will be posted publicly on the web', 'luxperfume' ) . '</p><div class="comment-form-rating">
<select name="rating" id="rating" required>
						<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
						<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
						<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
						<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
						<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
						<option value="1">' . esc_html__( 'Very poor', 'woocommerce' ) . '</option>
					</select></div>';
                                    }

                                    $comment_form['comment_field'] .= '<p class="comment-form-comment"><textarea placeholder="Message" id="comment" name="comment" cols="45" rows="8" required></textarea></p>';

                                    comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
                                    ?>
                                </div>
                            </div>
                        <?php if (!$current_user): ?>
                                <style>
                                    #commentform {
                                        display: flex;
                                        flex-direction: column;
                                    }
                                    .comment-form-rating {
                                        margin-bottom: 30px;
                                    }
                                    p.form-title {
                                        order: 1;
                                    }
                                    p.comment-form-email {
                                        order: 2;
                                    }
                                    p.comment-form-author {
                                        order: 3;
                                    }
                                    p.comment-form-comment {
                                        order: 4;
                                    }
                                    p.comment-form-cookies-consent {
                                        order: 5;
                                    }
                                    p.form-submit {
                                        order: 6;
                                    }
                                </style>
                        <?php endif; ?>
                        <?php else : ?>
                            <p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
            global $wpdb;

            $args = apply_filters('product_reviews_args', array(
                'status' => 'approve',
                'orderby' => 'comment_ID',
                'order' => 'ASC',
                'post_type' => 'product',
                'post_id' => $product->get_id()
            ));
            $comment_query = new WP_Comment_Query;
            $comments = $comment_query->query($args);
            if (count($comments) > 0): ?>
                <div class="reviews__cards">
                    <div class="comments-slider basic-swiper-styles swiper">
                        <div class="swiper-wrapper">
                            <?php
                            foreach ($comments as $comment) :
                                $comment_ID = $comment->comment_ID;
                                $comment_rating = get_comment_meta($comment_ID, 'rating', true);
                                $meta = get_comment_meta($comment_ID);
                                ?>
                                <div class="swiper-slide">
                                    <div class="reviews__cards--card">
                                        <div class="review-top">
                                            <?php
                                            $user = get_user_by('email', $comment->comment_author_email);
                                            if ($user) {
                                                $user_avatar = get_user_meta($user->ID, 'user_avater', true);
                                                if ($user_avatar) {
                                                    echo '<img class="avatar" src="' . $user_avatar . '">';
                                                } else {
                                                    echo '<div class="avatar-default">' . substr($user->user_firstname, 0, 1) . '</div>';
                                                }
                                            } else {
                                                echo '<div class="avatar-default">' . substr($comment->comment_author, 0, 1) . '</div>';
                                            }
                                            ?>
                                            <div class="review-top__rating">
                                                <?php
                                                if ($user) {
                                                    echo '<h5>' . $current_user->user_firstname . ' ' . substr($current_user->user_lastname, 0, 1) .'.</h5>';
                                                } else {
                                                    echo '<h5>'. $comment->comment_author .'</h5>';
                                                }
                                                ?>
                                                <div class="stars">
                                                    <?php
                                                    $comment_star_rating = wc_get_rating_html($comment_rating);
                                                    echo $comment_star_rating;
                                                    ?>
                                                    <p class="small">
                                                        <?php echo round($comment_rating, 1) . '/5'; ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="review-top__date">
                                                <p class="small"><?php echo get_comment_date('d/m/Y', $comment_ID); ?></p>
                                            </div>
                                        </div>
                                        <p class="review-body"><?php echo $comment->comment_content; ?></p>
                                    </div>
                                </div>
                            <?php
                            endforeach;
                            ?>
                        </div>

                        <!-- scrollbar -->
                        <div class="swiper-scrollbar"></div>

                        <!-- buttons -->
                        <div class="swiper-button-prev">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="40" height="40" rx="20" transform="matrix(4.37114e-08 1 1 -4.37114e-08 0 0)" fill="white" fill-opacity="0.6"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M16.3348 19.049C15.8885 19.4953 15.8885 20.219 16.3348 20.6653L22.0491 26.3796C22.4954 26.8259 23.219 26.8259 23.6653 26.3796C24.1117 25.9332 24.1117 25.2096 23.6653 24.7633L18.7592 19.8571L23.6653 14.951C24.1117 14.5047 24.1117 13.781 23.6653 13.3347C23.219 12.8884 22.4954 12.8884 22.0491 13.3347L16.3348 19.049Z" fill="#3F3F3F"/>
                            </svg>
                        </div>
                        <div class="swiper-button-next">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="40" width="40" height="40" rx="20" transform="rotate(90 40 0)" fill="white" fill-opacity="0.6"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M23.6651 19.049C24.1115 19.4953 24.1115 20.219 23.6651 20.6653L17.9509 26.3796C17.5045 26.8259 16.7809 26.8259 16.3346 26.3796C15.8883 25.9332 15.8883 25.2096 16.3346 24.7633L21.2408 19.8571L16.3346 14.951C15.8883 14.5047 15.8883 13.781 16.3346 13.3347C16.7809 12.8884 17.5045 12.8884 17.9509 13.3347L23.6651 19.049Z" fill="#3F3F3F"/>
                            </svg>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
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
do_action( 'woocommerce_after_single_product' ); ?>

