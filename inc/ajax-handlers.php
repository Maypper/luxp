<?php
add_action( 'wp_ajax_product_filter', 'product_filter' );
add_action( 'wp_ajax_nopriv_product_filter', 'product_filter' );
function product_filter() {
    $form_data = $_REQUEST['form_data'];
    $gender = false;
    $collections = false;
    $price = false;
    $instock = false;
    $sort = false;
    $output = '';
    if (array_key_exists('collections', $form_data)) {
        $collections = $form_data['collections'];
    }
    if (array_key_exists('gender', $form_data)) {
        $gender = $form_data['gender'];
    }
    if (array_key_exists('price', $form_data)) {
        $price = $form_data['price'];
    }
    if (array_key_exists('instock', $form_data)) {
        $instock = $form_data['instock'];
    }
    if (array_key_exists('sort', $form_data)) {
        $sort = $form_data['sort'];
    }
    $tax_query = array();
    if ($collections) {
        $tax_query[] = array(
            'taxonomy' => 'collection',
            'field' => 'name',
            'terms' => $collections,
        );
    }
    if ($gender) {
        $tax_query[] = array(
            'taxonomy' => 'product_cat',
            'field' => 'name',
            'terms' => $gender,
        );
    }
    $meta_query = array();
    if ($price) {
        $price_query = array(
            'relation' => 'OR',
        );
        $min = 9999999;
        $max = 0;
        foreach ($price as $item) {
            $prices = explode('-', $item);
            $price_query[] = array(
                'key' => '_price',
                'value' => $prices,
                'type'    => 'numeric',
                'compare' => 'BETWEEN'
            );
        }
        $meta_query[] = $price_query;
    }
    if ($instock) {
        $instock_query = array(
            'relation' => 'OR',
        );
        foreach ($instock as $item) {
            $instock_query[] = array(
                'key' => '_stock_status',
                'value' => $item,
            );
        }
        $meta_query[] = $instock_query;
    }
    wp_reset_query();
    $args = array('post_type' => 'product',
        'tax_query' => $tax_query,
        'meta_query' => $meta_query,
        'posts_per_page' => 8,
    );
    if ($sort) {
        $args['orderby'] = 'meta_value_num';
        if ($sort == 'pricelow') {
            $args['meta_key'] = '_price';
            $args['order'] = 'asc';
        }
        if ($sort == 'pricehigh') {
            $args['meta_key'] = '_price';
            $args['order'] = 'DESC';
        }
    }
    $loop = new WP_Query($args);

    if($loop->have_posts()) {
        while ($loop->have_posts()) {
            $loop->the_post();
            get_template_part('template-parts/cards/product-card', 'loop');
        }
    }
    wp_die();
}

add_action( 'wp_ajax_loadmore', 'loadmore_callback' );
add_action( 'wp_ajax_nopriv_loadmore', 'loadmore_callback' );

function loadmore_callback() {

    $paged = ! empty( $_POST[ 'paged' ] ) ? $_POST[ 'paged' ] : 1;
    $paged++;


    $form_data = $_REQUEST['form_data'];
    $gender = false;
    $collections = false;
    $price = false;
    $instock = false;
    $sort = false;
    if (array_key_exists('collections', $form_data)) {
        $collections = $form_data['collections'];
    }
    if (array_key_exists('gender', $form_data)) {
        $gender = $form_data['gender'];
    }
    if (array_key_exists('price', $form_data)) {
        $price = $form_data['price'];
    }
    if (array_key_exists('instock', $form_data)) {
        $instock = $form_data['instock'];
    }
    if (array_key_exists('sort', $form_data)) {
        $sort = $form_data['sort'];
    }
    $tax_query = array();
    if ($collections) {
        $tax_query[] = array(
            'taxonomy' => 'collection',
            'field' => 'name',
            'terms' => $collections,
        );
    }
    if ($gender) {
        $tax_query[] = array(
            'taxonomy' => 'product_cat',
            'field' => 'name',
            'terms' => $gender,
        );
    }
    $meta_query = array();
    if ($price) {
        $price_query = array(
            'relation' => 'OR',
        );
        $min = 9999999;
        $max = 0;
        foreach ($price as $item) {
            $prices = explode('-', $item);
            $price_query[] = array(
                'key' => '_price',
                'value' => $prices,
                'type'    => 'numeric',
                'compare' => 'BETWEEN'
            );
        }
        $meta_query[] = $price_query;
    }
    if ($instock) {
        $instock_query = array(
            'relation' => 'OR',
        );
        foreach ($instock as $item) {
            $instock_query[] = array(
                'key' => '_stock_status',
                'value' => $item,
            );
        }
        $meta_query[] = $instock_query;
    }
    wp_reset_query();
    $args = array(
        'post_type' => 'product',
        'tax_query' => $tax_query,
        'meta_query' => $meta_query,
        'posts_per_page' => 8,
        'paged' => $paged,
        'post_status' => 'publish'
    );
    if ($sort) {
        $args['orderby'] = 'meta_value_num';
        if ($sort == 'pricelow') {
            $args['meta_key'] = '_price';
            $args['order'] = 'asc';
        }
        if ($sort == 'pricehigh') {
            $args['meta_key'] = '_price';
            $args['order'] = 'DESC';
        }
    }


    $loop = new WP_Query($args);

    if($loop->have_posts()) {
        while ($loop->have_posts()) {
            $loop->the_post();
            get_template_part('template-parts/cards/product-card', 'loop');
        }
    }

    wp_die();

}