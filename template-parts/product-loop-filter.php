<?php
$term = get_queried_object();
?>
<div class="products__filter">
    <form action="#" method="post">
        <div class="form__left">
            <div class="filter-select mobile-only filter-open">
                <span><?php _e('Filters', 'luxperfume'); ?></span>
            </div>
            <div class="form__left--wrapper">
                <div class="filter-select price">
                    <span><?php _e('Price', 'luxperfume'); ?></span>
                    <div class="filter-select__choices">
                        <?php
                        if (have_rows('prices_filter', 'options')):
                            while (have_rows('prices_filter', 'options')):
                                the_row();
                                $min = get_sub_field('min');
                                $max = get_sub_field('max');
                                if (!$min) {
                                    $min = 0;
                                }
                                if (!$max) {
                                    $max = 999999;
                                }
                                ?>
                                <label>
                                    <input type="checkbox"<?php echo $checked ?> class="price-checkbox" data-val="<?php echo get_woocommerce_currency_symbol() . $min . '.00 - ' . get_woocommerce_currency_symbol() . $max . '.00' ?>" name="filt_price[]" value="<?php echo $min . '-' . $max ?>">
                                    <?php echo get_woocommerce_currency_symbol() . $min . '.00 - ' . get_woocommerce_currency_symbol() . $max . '.00' ?>
                                </label>
                                <input type="hidden" name="filt_price[]" value="">
                            <?php
                            endwhile;
                        endif;
                        ?>
                    </div>
                </div>
                <div class="filter-select gender">
                    <span><?php _e('Gender', 'luxperfume'); ?></span>
                    <div class="filter-select__choices">
                        <?php
                        $cats = get_categories( [
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
                        foreach ($cats as $cat) {
                            if ($cat->slug == 'men' || $cat->slug == 'women') {
                                $checked = '';
                                if (in_array($cat->name, $_POST['gender'])) {
                                    $checked = ' checked';
                                }
                                ?>
                                <label>
                                    <input type="checkbox"<?php echo $checked ?> name="gender[]" value="<?php echo $cat->name; ?>">
                                    <?php echo $cat->name; ?>
                                </label>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="filter-select collection">
                    <span><?php _e('Collection', 'luxperfume'); ?></span>
                    <div class="filter-select__choices">
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
                        foreach ($collections as $coll) {
                            $checked = '';
                            if ($coll->slug == $term->slug) {
                                $checked = ' checked';
                            }
                            if (in_array($coll->name, $_POST['collections'])) {
                                $checked = ' checked';
                            }
                            ?>
                            <label>
                                <input type="checkbox"<?php echo $checked; ?> name="collections[]" value="<?php echo $coll->name; ?>">
                                <?php echo $coll->name; ?>
                            </label>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="filter-select collection">
                    <span><?php _e('In Stock', 'luxperfume'); ?></span>
                    <div class="filter-select__choices">
                        <label>
                            <input type="checkbox" name="in-stock[]" value="instock">
                            In stock
                        </label>
                        <label>
                            <input type="checkbox" name="in-stock[]" value="outofstock">
                            Coming Soon
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="filter-select sort">
            <span><?php _e('Sort', 'luxperfume'); ?></span>
            <div class="filter-select__choices">
                <label>
                    <input class="sort-radio" type="radio" name="sort" value="pricelow">
                    by Price (low to high)
                </label>
                <label>
                    <input class="sort-radio" type="radio" name="sort" value="pricehigh">
                    by Price (high to low)
                </label>
            </div>
        </div>
    </form>
    <div class="products__filter--labels">
        <?php
        if (array_key_exists('filt_price', $_POST)) {
            foreach ($_POST['filt_price'] as $item) {
                echo '<span>' . $item . '</span>';
            }
        }
        if (array_key_exists('gender', $_POST)) {
            foreach ($_POST['gender'] as $item) {
                echo '<span>' . $item . '</span>';
            }
        }
        if (array_key_exists('collections', $_POST)) {
            foreach ($_POST['collections'] as $item) {
                echo '<span>' . $item . '</span>';
            }
        }
        if ($term) {
            echo '<span>' . $term->name . '</span>';
        }
        ?>
    </div>
</div>