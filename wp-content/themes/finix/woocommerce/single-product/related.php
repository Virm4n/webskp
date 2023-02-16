<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>
	<?php
	if( class_exists( 'ReduxFramework' ) ){
		$finix_opt = get_option('finix_redux');
		$opt       = $finix_opt['related_products'];
		if ( $opt == 'on' ) {
			?>
			<section class="related products">

				<?php
				$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related Products', 'finix' ) );

				if ( $heading ) :
					?>
					<h2><?php echo esc_html( $heading ); ?></h2>
				<?php endif; ?>
				
						<?php //woocommerce_product_loop_start(); ?>

						<ul class="products swiper-container" data-items="4" data-lg-items="3" data-md-items="2" data-sm-items="2" data-xs-items="1" data-space="30" data-bullets="false" data-arrow="false">
        					<div class="swiper-wrapper">

							<?php foreach ( $related_products as $related_product ) : ?>

								<div class="swiper-slide">
									<?php
									$post_object = get_post( $related_product->get_id() );

									setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

									wc_get_template_part( 'content', 'product' );
									?>
								</div>
							<?php endforeach; ?>

							</div>
    					</ul>

						<?php //woocommerce_product_loop_end(); ?>

			</section>
			<?php
		}
	}
endif;

wp_reset_postdata();
