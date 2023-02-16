<?php
/**
 * Woocommerce Custom function
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

add_action( 'after_setup_theme', 'finix_woocommerce_support' );
function finix_woocommerce_support() {
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'wc-product-gallery-lightbox' );
}

add_filter( 'woocommerce_add_to_cart_fragments', 'finix_mini_cart_ajax_refresh' );
function finix_mini_cart_ajax_refresh( $fragments ) {
	// 1. Refreshing mini cart subtotal amount
	$fragments['#mcart-stotal'] = '<span id="mcart-stotal">' . WC()->cart->get_cart_subtotal() . '</span>';
	// 2. Refreshing cart subtotal
	ob_start();
	echo '<span class="mcart-widget">';
	woocommerce_mini_cart();
	echo '</span>';
	$fragments['.mcart-widget'] = ob_get_clean();
	echo '<div class="mini-cart-content">';
	woocommerce_mini_cart();
	echo '</div>';
	$fragments['.mini-cart-content'] = ob_get_clean();
	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'finix_header_add_to_cart_fragment', 30, 1 );
function finix_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
	<a class="cart-customlocation" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'finix' ); ?>"><span><?php echo sprintf( _n( '%d', '%d', $woocommerce->cart->cart_contents_count, 'finix' ), $woocommerce->cart->cart_contents_count ); ?></span><i class="fa fa-shopping-cart"></i></a>
	<?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
}

if ( ! function_exists( 'finix_loop_product_thumbnail' ) ) { 
	function finix_loop_product_thumbnail() { 
		global $product;
		if ( ! $product ) {
			return '';
		}
		$gallery    = $product->get_gallery_image_ids();		
		?>
		<div class="product-thumbnail">
			<?php
			// images.
			if (count($gallery) > 0){
				echo '<div class="product-main-image">' . $product->get_image( 'shop_catalog' ) . wp_get_attachment_image( $gallery[0], 'shop_catalog hover_image' ) . '</div>';
			}
			else{
				echo '<div class="product-main-image">' . $product->get_image( 'shop_catalog' ) . '</div>';
			}

			// add to cart button.
			$finix_opt = get_option( 'finix_redux' );
			if(isset($finix_opt['cart_button']))
			{
				$opt = $finix_opt['cart_button'];
				if($opt == "on")
				{
					woocommerce_template_loop_add_to_cart();
				}
			}
			woocommerce_template_loop_product_link_open();
			woocommerce_template_loop_product_link_close();
			if ( function_exists( 'yith_wishlist_install' ) ) {
				echo do_shortcode( '[yith_wcwl_add_to_wishlist]');
			}
			?>
		
		</div>
		<?php
	}
}


if ( ! function_exists( 'finix_template_loop_product_thumbnail' ) ) {
	function finix_template_loop_product_thumbnail( $size = 'woocommerce_thumbnail', $deprecated1 = 0, $deprecated2 = 0 ) {
		echo finix_loop_product_thumbnail();

	}
}

/**
 * Show the product title in the product loop.
*/
if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
	function woocommerce_template_loop_product_title() {
		echo '<h3 class="product-title">
				<a href="' . esc_url_raw( get_the_permalink() ) . '">' . get_the_title() . '</a>
			</h3>
			<div class="price-detail">';
	}
}

if ( ! function_exists( 'finix_woocommerce_product_loop_image_end' ) ) {
	function finix_woocommerce_product_loop_image_end() {
		echo '</div>';
		echo '</div>';
	}
}

if ( ! function_exists( 'finix_woocommerce_product_loop_start' ) ) {
	function finix_woocommerce_product_loop_start() {
		echo '<div class="product-block-inner">';
	}
}

if ( ! function_exists( 'finix_woocommerce_product_loop_end' ) ) {
	function finix_woocommerce_product_loop_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'finix_woocommerce_product_loop_action_start' ) ) {
	function finix_woocommerce_product_loop_action_start() {
		echo '<div class="finix-product-caption th1">';
	}
}

if ( ! function_exists( 'finix_woocommerce_product_loop_action_end' ) ) {
	function finix_woocommerce_product_loop_action_end() {
		echo '</div></div>';
	}
}

if ( ! function_exists( 'finix_woocommerce_product_loop_caption_end' ) ) {
	function finix_woocommerce_product_loop_caption_end() {
		echo '</div>';
	}
}

// single
if ( ! function_exists( 'woocommerce_my_single_title' ) ) {
	function woocommerce_my_single_title() {
		?>
		<h1 itemprop="name" class="product_title entry-title"><span><?php the_title(); ?></span></h1>
		<?php
	}
}


if (!function_exists('woocommerce_product_loop_action_start')) {
    function woocommerce_product_loop_action_start()
    {
        echo '<div class="product-info">';
		echo '<div class="product-description">';
		the_excerpt();
		echo '</div>';
    }
}
