<?php
/**
 * MailChimp Shortcode Options
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 * @version 1.5.0
 */

Redux::setSection( 'finix_redux', array(
    'title'      => esc_html__( 'MailChimp ID', 'finix' ),
    'id'         => 'finix-subscribe',
    'icon'       => 'el el-envelope',
    'fields'     => array(

        array(
            'id'        => 'mailchimp_shortcode',
            'type'      => 'text',
            'title'     => esc_html__( 'Subscribe Shortcode','finix'),
            'subtitle'  => wp_kses( __( '<br />Put you Mailchimp for WP Shortcode here','finix' ), array( 'br' => array() ) ),
        ),

    )) 
);
?>