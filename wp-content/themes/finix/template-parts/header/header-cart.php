<?php
/**
 * Header Mini-Cart
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

$finix_opt = get_option( 'finix_redux' ); 
if ( class_exists( 'WooCommerce' ) ) {
    if(isset($finix_opt['header_cart']))
    {
        $opt = $finix_opt['header_cart'];
        if($opt == "on")
        {
        ?>
        <div class="header-cart-btn">
            <a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'finix' ); ?>">
                <?php
                if ( ! WC()->cart ) {
                    echo sprintf( _n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'finix' ) ); }
                ?>										 
                <i class="fa fa-shopping-cart"></i>
            </a>
            <div class="header-shopping-cart cart">
                <div class="mini-cart-content">
                    <?php woocommerce_mini_cart(); ?>
                </div>
            </div>
        </div>
        <?php
        }
    }
}