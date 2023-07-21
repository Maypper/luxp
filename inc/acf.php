<?php
//create custom blocks category for acf fields
add_filter( 'block_categories_all' , function( $categories ) {

    // Adding a new category.
    $categories[] = array(
        'slug'  => 'luxprerfume',
        'title' => 'Luxprerfume Blocks'
    );

    return $categories;
} );

add_action('acf/init', 'my_acf_blocks_init');
function my_acf_blocks_init() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // Register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'home_hero',
            'title'             => __('Home Hero'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/home-hero.php',
            'category'          => 'luxprerfume',
        ));
        acf_register_block_type(array(
            'name'              => 'categories_block',
            'title'             => __('Categories'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/categories.php',
            'category'          => 'luxprerfume',
        ));
        acf_register_block_type(array(
            'name'              => 'featured_products',
            'title'             => __('Featured Products'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/featured-products.php',
            'category'          => 'luxprerfume',
        ));
        acf_register_block_type(array(
            'name'              => 'text_with_steps',
            'title'             => __('Text Block with steps'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/text-steps.php',
            'category'          => 'luxprerfume',
        ));
        acf_register_block_type(array(
            'name'              => 'full_slider',
            'title'             => __('Full Width Slider'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/full-slider.php',
            'category'          => 'luxprerfume',
        ));
        acf_register_block_type(array(
            'name'              => 'text_video',
            'title'             => __('Text block with video'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/text-video.php',
            'category'          => 'luxprerfume',
        ));
        acf_register_block_type(array(
            'name'              => 'featured_posts',
            'title'             => __('Featured Posts'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/featured-posts.php',
            'category'          => 'luxprerfume',
        ));
        acf_register_block_type(array(
            'name'              => 'newsletter',
            'title'             => __('Newsletter'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/newsletter.php',
            'category'          => 'luxprerfume',
        ));
    }
}

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Footer Settings',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'theme-general-settings',
    ));

}