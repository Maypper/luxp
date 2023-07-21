<?php
/**
 * luxperfume functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package luxperfume
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

add_action('init', 'custom_taxonomy_flush_rewrite');
function custom_taxonomy_flush_rewrite() {
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function luxperfume_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on luxperfume, use a find and replace
		* to change 'luxperfume' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'luxperfume', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );
    add_theme_support('woocommerce');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'luxperfume' ),
            'footer-menu' => esc_html__( 'Footer', 'luxperfume' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'luxperfume_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'luxperfume_setup' );



// Register Custom Taxonomy
function custom_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Collections', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Collection', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Collections', 'text_domain' ),
        'all_items'                  => __( 'All Items', 'text_domain' ),
        'parent_item'                => __( 'Parent Item', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
        'new_item_name'              => __( 'New Item Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Item', 'text_domain' ),
        'edit_item'                  => __( 'Edit Item', 'text_domain' ),
        'update_item'                => __( 'Update Item', 'text_domain' ),
        'view_item'                  => __( 'View Item', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Items', 'text_domain' ),
        'search_items'               => __( 'Search Items', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No items', 'text_domain' ),
        'items_list'                 => __( 'Items list', 'text_domain' ),
        'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                       => '/collection',
        'with_front'                 => true,
        'hierarchical'               => false,
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'rewrite'                    => $rewrite,
    );
    register_taxonomy( 'collection', array( 'product' ), $args );

}
add_action( 'init', 'custom_taxonomy', 0 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function luxperfume_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'luxperfume_content_width', 640 );
}
add_action( 'after_setup_theme', 'luxperfume_content_width', 0 );


// add custom image sizes
if ( function_exists( 'add_theme_support' ) ) {

    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 150, 150 );
}

if ( function_exists( 'add_image_size' ) ) {

    add_image_size( 'product-card', 320, 389, true );
    add_image_size( 'blog-slide-card', 650, 310, true );
    add_image_size( 'collection', 760, 375, true );
    add_image_size( 'product-single', 410, 410, true );
    add_image_size( 'product-pagination', 60, 60, true );

}

// generate breadcrubs
function get_breadcrumbs() {
    $separator = '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.99439 9.74862L7.64839 6.00012L3.99439 2.25162C3.92897 2.18464 3.89235 2.09474 3.89235 2.00112C3.89235 1.9075 3.92897 1.81759 3.99439 1.75062C4.02616 1.71819 4.06409 1.69243 4.10594 1.67484C4.1478 1.65725 4.19274 1.64819 4.23814 1.64819C4.28354 1.64819 4.32848 1.65725 4.37034 1.67484C4.41219 1.69243 4.45012 1.71819 4.48189 1.75062L8.36989 5.73837C8.43815 5.8084 8.47635 5.90232 8.47635 6.00012C8.47635 6.09791 8.43815 6.19184 8.36989 6.26187L4.48264 10.2496C4.45084 10.2823 4.41283 10.3082 4.37083 10.326C4.32884 10.3437 4.28372 10.3528 4.23814 10.3528C4.19256 10.3528 4.14744 10.3437 4.10545 10.326C4.06346 10.3082 4.02544 10.2823 3.99364 10.2496C3.92822 10.1826 3.8916 10.0927 3.8916 9.99912C3.8916 9.9055 3.92822 9.81559 3.99364 9.74862L3.99439 9.74862Z" fill="#3F3F3F"/></svg>';
    echo '<div class="breadcrumbs">';
    echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
    if (is_category()) {
        echo $separator;
        the_category(' &bull; ');

    } elseif (is_single()) {
        echo $separator;

        echo '<span class="current">' . get_the_title() . '</span>';
    } elseif (is_taxonomy('collection')) {
        echo $separator;
        echo '<a href="' . home_url('/collections') . '">' . __('Collections', 'lexperfume') . '</a>';
        echo $separator . '123123123';
        $term = get_queried_object();
        echo '<span class="current">' . $term->name . '</span>';
    } elseif (is_page()) {
        echo $separator;
        echo '<span class="current">' . the_title() . '</span>';
    } elseif (is_search()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
    echo '</div>';
}

function get_total_reviews_count(){
    return get_comments(array(
        'status'   => 'approve',
        'post_status' => 'publish',
        'post_type'   => 'product',
        'count' => true
    ));
}

function get_products_ratings(){
    global $wpdb;

    return $wpdb->get_results("
        SELECT t.slug, tt.count
        FROM {$wpdb->prefix}terms as t
        JOIN {$wpdb->prefix}term_taxonomy as tt ON tt.term_id = t.term_id
        WHERE t.slug LIKE 'rated-%' AND tt.taxonomy LIKE 'product_visibility'
        ORDER BY t.slug
    ");
}

function products_count_by_rating_html(){
    $star = 1;
    $html = '';
    foreach( get_products_ratings() as $values ){
        $star_text = '<strong>'.$star.' '._n('Star', 'Stars', $star, 'woocommerce').'<strong>: ';
        $html .= '<li class="'.$values->slug.'">'.$star_text.$values->count.'</li>';
        $star++;
    }
    return '<ul class="products-rating">'.$html.'</ul>';
}

function products_rating_average_html(){
    $stars = 1;
    $average = 0;
    $total_count = 0;
    if( sizeof(get_products_ratings()) > 0 ) :
        foreach( get_products_ratings() as $values ){
            $average += $stars * $values->count;
            $total_count += $values->count;
            $stars++;
        }
        return '<p class="rating-average">'.round($average / $total_count, 1).' / 5 '. __('Stars average').'</p>';
    else :
        return '<p class="rating-average">'. __('No reviews yet', 'woocommerce').'</p>';
    endif;
}

add_action( 'init', 'my_remove_breadcrumbs' );
function my_remove_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}


// Change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_add_to_cart_button_text_single' );
function woocommerce_add_to_cart_button_text_single() {
    return __( 'Add To Bag', 'woocommerce' );
}

// Change add to cart text on product archives page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_add_to_cart_button_text_archives' );
function woocommerce_add_to_cart_button_text_archives() {
    return __( 'Add To Bag', 'woocommerce' );
}

add_action( 'woocommerce_before_single_product', 'wf_move_variations_single_price', 1 );
function wf_move_variations_single_price(){
    global $product, $post;
    if ( $product->is_type( 'variable' ) ) {
        add_action( 'woocommerce_single_product_summary', 'wf_replace_variation_single_price', 10 );
    }
}
function wf_replace_variation_single_price() {
    ?>
    <style>
        .woocommerce-variation-price {
            display: none;
        }
    </style>
    <script>
        jQuery(document).ready(function($) {
            var priceselector = '.product p.price';
            var originalprice = $(priceselector).html();

            $( document ).on('show_variation', function() {
                $(priceselector).html($('.single_variation .woocommerce-variation-price').html());
            });
            $( document ).on('hide_variation', function() {
                $(priceselector).html(originalprice);
            });
        });
    </script>
    <?php
}


add_action( 'woocommerce_before_variations_form', 'add_quantity_field_before_variations_form', 10 );
function add_quantity_field_before_variations_form()
{
    global $product;

    do_action('woocommerce_before_add_to_cart_quantity');
    woocommerce_quantity_input(
        array(
            'min_value' => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
            'max_value' => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
            'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
        )
    );
    do_action('woocommerce_after_add_to_cart_quantity');
}
/**
 * Include all styles and scripts
 */
require get_template_directory() . '/inc/enqueue-all-scripts.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
/**
 * ACF functions
 */
require get_template_directory() . '/inc/acf.php';

/**
 * custom walker
 */
require get_template_directory() . '/inc/custom-walker.php';
require get_template_directory() . '/inc/custom-walker-mobile.php';

/**
 * AJAX
 */
require get_template_directory() . '/inc/ajax-handlers.php';