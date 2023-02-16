<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
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
$finix_opt = get_option( 'finix_redux' );
$shop_layout = ! empty( $finix_opt['shop_layout'] ) ? $finix_opt['shop_layout'] : '4';
$shop_mobile_layout = ! empty( $finix_opt['shop_mobile_layout'] ) ? $finix_opt['shop_mobile_layout'] : '1';
?>
<ul class="products columns-<?php if (!empty( $shop_layout)) {echo esc_attr( $shop_layout );} ?> mobile-columns-<?php if (!empty( $shop_mobile_layout)) {echo esc_attr( $shop_mobile_layout );} ?>">
