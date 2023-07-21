<?php
function luxperfume_scripts() {
    wp_enqueue_style( 'bootstrap-style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css', array(), _S_VERSION );
    wp_enqueue_style( 'swiper-style', 'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css', array(), _S_VERSION );

    wp_enqueue_style( 'luxperfume-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_style_add_data( 'luxperfume-style', 'rtl', 'replace' );
    wp_enqueue_style( 'luxperfume-theme-style', get_template_directory_uri() . '/assets/styles/main.css', array(), _S_VERSION );


    wp_enqueue_script( 'bootstrap-scripts', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'swiper-scripts', 'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'luxperfume-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'luxperfume-custom', get_template_directory_uri() . '/assets/js/custom.js', array(), _S_VERSION, true );
    if (is_taxonomy('collection') || is_shop() || is_taxonomy('product_cat')) {
        wp_enqueue_script( 'luxperfume-filter', get_template_directory_uri() . '/assets/js/filters.js', array(), _S_VERSION, true );
        wp_localize_script( 'luxperfume-filter', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
    }

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'luxperfume_scripts' );