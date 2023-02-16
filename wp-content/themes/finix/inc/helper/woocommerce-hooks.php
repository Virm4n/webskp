<?php
add_filter( 'woocommerce_show_page_title', '__return_false' );

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_before_shop_loop_item_title', 'finix_loop_product_thumbnail', 10);

remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

add_action('woocommerce_before_shop_loop_item', 'finix_woocommerce_product_loop_start', -1);

remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

// Single
remove_action('woocommerce_single_product_summary','woocommerce_template_single_title',5);
add_action('woocommerce_single_product_summary', 'woocommerce_my_single_title',5);

add_theme_support('woocommerce');
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_product_loop_action_start', 10);

?>