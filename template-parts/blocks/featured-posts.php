<?php
$title= get_field('title');
$link = get_field('link');

$query = new WP_Query( array(
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => 0,
    'posts_per_page' => 10
) );
?>
<section class="featured-posts">
    <div class="container">
        <div class="featured-posts__top">
            <h3><?php echo $title ?></h3>
            <?php if ($link): ?>
                <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" class="link arrow-link"><?php echo $link['title']; ?></a>
            <?php endif; ?>
        </div>
        <div class="featured-posts__slider">
            <div class="slider-4-slides basic-swiper-styles changeble-width-slides swiper">
                <div class="swiper-wrapper">
                    <?php
                    if ( $query->have_posts() ) {
                        $i = 0;
                        while ( $query->have_posts() ) {
                            $query->the_post();
                            $post_id = $post->ID;
                            ?>
                            <div class="swiper-slide<?php if ($i == 0) { echo ' hovered'; } ?>">
                                <div class="blog-card blog-slider-card">
                                    <?php echo get_the_post_thumbnail($post_id, 'blog-slide-card'); ?>
                                    <span class="date"><?php echo get_the_date('d/m/Y'); ?></span>
                                    <h4><?php echo get_the_title(); ?></h4>
                                    <p><?php echo get_the_excerpt(); ?></p>
                                </div>
                            </div>
                            <?php
                            $i++;
                        }
                        ?>
                        <div class="swiper-slide hidden-slide"></div>
                        <div class="swiper-slide hidden-slide"></div>
                    <?php
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
