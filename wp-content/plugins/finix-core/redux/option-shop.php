<?php 
/**
 * 404 Options
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 * @version 1.5.0
 */

Redux::setSection( 'finix_redux', array(
    'title' => esc_html__('Woocommerce','finix'),
    'id'    => 'opt-shop',
    'icon'  => 'dashicons dashicons-cart',
    'desc'  => esc_html__('This section contains options for shop.','finix'),
    'fields'=> array(

        array(
            'id'     => 'header-cart-section',
            'type'   => 'section',
            'title'  => esc_html__( 'Header Cart', 'finix' ),
            'indent' => true,
        ),


        array(
            'id'       => 'header_cart',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Header Cart', 'finix' ),
            'subtitle' => esc_html__( 'Turn on to display the cart Icon in top header.', 'finix' ),
            'options'  => array(
                'on'  => esc_html__( 'On', 'finix' ),
                'off' => esc_html__( 'Off', 'finix' ),
            ),
            'default'  => esc_html__( 'off', 'finix' ),
        ),

        array(
            'id'     => 'shop-page',
            'type'   => 'section',
            'title'  => esc_html__( 'Shop Listing Page', 'finix' ),
            'indent' => true,
        ),

        array(
            'id'       => 'cart_button',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Cart Button', 'finix' ),
            'subtitle' => esc_html__( 'Turn on to display the cart button on Product Hover Style.', 'finix' ),
            'options'  => array(
                'on'  => esc_html__( 'On', 'finix' ),
                'off' => esc_html__( 'Off', 'finix' ),
            ),
            'default'  => esc_html__( 'on', 'finix' ),
        ),

        array(
            'id' => 'shop_sidebar',
            'type' => 'image_select',
            'title'   => esc_html__( 'Shop Sidebar', 'finix' ),
            'options' => array(
                '1' => array(
                    'title' => esc_html__('Right Sidebar', 'finix') ,
                    'img' => get_template_directory_uri() . '/assets/images/theme-option/blog/right-sidebar.png',
                ) ,
                '2' => array(
                    'title' => esc_html__('Left Sidebar', 'finix') ,
                    'img' => get_template_directory_uri() . '/assets/images/theme-option/blog/left-sidebar.png',
                ) ,
                '3' => array(
                    'title' => esc_html__('FullWidth', 'finix') ,
                    'img' => get_template_directory_uri() . '/assets/images/theme-option/blog/full-width.png',
                ) ,
            ) ,
            'default'  => '1'
        ),

        array(
            'id'       => 'shop_layout',
            'type'     => 'button_set',
            'title'    => __( 'Product Listing Column', 'finix' ),
            'subtitle' => __( 'Select Product Listing Column', 'finix' ),
            'options'  => array(
                '3' => 'Columns 3',
                '4' => 'Columns 4',
                '5' => 'Columns 5',
            ),
            'default'  => '4',
        ),

        array(
            'id'       => 'shop_mobile_layout',
            'type'     => 'button_set',
            'title'    => __( 'Mobile Product Listing Column', 'finix' ),
            'subtitle' => __( 'Select Mobile Product Listing Column', 'finix' ),
            'options'  => array(
                '1' => 'Columns 1',
                '2' => 'Columns 2',
            ),
            'default'  => '1',
        ),

        array(
            'id'     => 'shop-product-page',
            'type'   => 'section',
            'title'  => esc_html__( 'Product Detail Page', 'finix' ),
            'indent' => true,
        ),

        array(
            'id'       => 'related_products',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Related Products', 'finix' ),
            'subtitle' => esc_html__( 'Turn on to display related products in singal products.', 'finix' ),
            'options'  => array(
                'on'  => esc_html__( 'On', 'finix' ),
                'off' => esc_html__( 'Off', 'finix' ),
            ),
            'default'  => esc_html__( 'off', 'finix' ),
        ),

    )) 
);
?>