<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 1.7
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
$finix_opt = get_option('finix_redux');
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="container">
			<div class="row">
				<?php
				if ( class_exists( 'ReduxFramework' ) ) {
					$opt= $finix_opt['shop_sidebar']; 
					if($opt == 1)
					{
						if ( ! is_active_sidebar('shop-sidebar') ) { ?>
							<div class="col-md-12 col-sm-12">
						<?php } else { ?>
							<div class="col-xl-9 col-lg-8 shop-content-area">
						<?php } 
					}
					else if($opt == 2)
					{
						if ( ! is_active_sidebar('shop-sidebar') ) { ?>
							<div class="col-md-12 col-sm-12">
						<?php } else { ?>
							<div class="col-xl-9 col-lg-8 order-lg-2 shop-content-area">
						<?php } 
					} 
					else if($opt == 3)
					{
						?>
							<div class="col-md-12 col-sm-12">
						<?php  
					}
				} else{ 
					if ( ! is_active_sidebar('shop-sidebar') ) { ?>
						<div class="col-md-12 col-sm-12">
					<?php } else { ?>
						<div class="col-xl-9 col-lg-8 shop-content-area">
					<?php } 
				} ?>
			
				<?php
				if ( woocommerce_product_loop() ) {

					/**
					 * Hook: woocommerce_before_shop_loop.
					 *
					 * @hooked woocommerce_output_all_notices - 10
					 * @hooked woocommerce_result_count - 20
					 * @hooked woocommerce_catalog_ordering - 30
					 */
					do_action( 'woocommerce_before_shop_loop' );

					woocommerce_product_loop_start();

					if ( wc_get_loop_prop( 'total' ) ) {
						while ( have_posts() ) {
							the_post();

							/**
							 * Hook: woocommerce_shop_loop.
							 */
							do_action( 'woocommerce_shop_loop' );

							wc_get_template_part( 'content', 'product' );
						}
					}

					woocommerce_product_loop_end();

					/**
					 * Hook: woocommerce_after_shop_loop.
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					do_action( 'woocommerce_after_shop_loop' );
				} else {
					/**
					 * Hook: woocommerce_no_products_found.
					 *
					 * @hooked wc_no_products_found - 10
					 */
					do_action( 'woocommerce_no_products_found' );
				}
				?>
				</div>
				<?php
				if ( class_exists( 'ReduxFramework' ) ) {
					$opt= $finix_opt['shop_sidebar']; 
					if($opt == 1 || $opt == 2)
					{
					if ( is_active_sidebar('shop-sidebar') ) { ?>		
					<div class="col-xl-3 col-lg-4 sidebar shop-widget-sidebar">
						<?php dynamic_sidebar( 'shop-sidebar' ); ?>
					</div>
					<?php }
					}
					else if($opt == 3){ }
				}
				else{
					if ( is_active_sidebar('shop-sidebar') ) { ?>		
					<div class="col-xl-3 col-lg-4 sidebar shop-widget-sidebar">
						<?php dynamic_sidebar( 'shop-sidebar' ); ?>
					</div>
					<?php }
				}
				/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' ); ?>
				<?php get_footer( 'shop' ); ?>
			</div>
		</div>
	</main>
</div>
