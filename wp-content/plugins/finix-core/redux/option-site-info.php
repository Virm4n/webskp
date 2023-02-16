<?php
/**
 * Site Info Options
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 * @version 1.5.0
 */

Redux::setSection( 'finix_redux',  array(
    'title' => esc_html__( 'Site Info', 'finix' ),
    'id'    => 'site_info', 
    'icon'  => 'el el-map-marker',
    'fields'           => array(

        array(
            'id'       => 'site_phone',
            'type'     => 'text',
            'title'    => esc_html__( 'Phone', 'finix' ),
            'subtitle' => esc_html__( 'Add Phone Number.', 'finix' ),
            'desc'     => esc_html__( 'Field Description', 'finix' ),
            'preg' => array(
                'pattern' => '/[^0-9_ -+()]/s', 
                'replacement' => ''
            ),
            'default'  => esc_html__('+0123456789','finix' ),
        ),

    
        array(
            'id'       => 'site_email',
            'type'     => 'text',
            'title'    => esc_html__( 'Email', 'finix' ),
            'subtitle' => esc_html__( 'Add Email Address for.', 'finix' ),
            'desc'     => esc_html__( 'Field Description', 'finix' ),
            'validate' => 'email',
            'msg'      => esc_html__('custom error message','finix' ),
            'default'  => esc_html__('support@gmail.com','finix' ),
        ),

        array(
            'id'       => 'online_order_text',
            'type'     => 'text',
            'title'    => esc_html__( 'Text', 'finix' ),
            'subtitle' => esc_html__( 'Add Description for Site.', 'finix' ),
            'desc'     => esc_html__( 'Field Description', 'finix' ),
            'default'  => esc_html__('Order Online Call Us ','finix' ),
        ),

        array(
            'id'       => 'site_location',
            'type'     => 'text',
            'title'    => esc_html__( 'Site Adddress', 'finix' ),
            'subtitle' => esc_html__( 'Add Site Adddress.', 'finix' ),
            'desc'     => esc_html__( 'Field Description', 'finix' ),
            'default'  => esc_html__('Eiusmod 147 New York','finix' ),
        ),
                    
    ) 
) );
?>