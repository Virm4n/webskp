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
    'title' => esc_html__('404','finix'),
    'id'    => 'opt-404',
    'icon'  => 'el-icon-error',
    'desc'  => esc_html__('This section contains options for 404.','finix'),
    'fields'=> array(

        array(
            'id'        => 'error_title',
            'type'      => 'text',
            'title'     => esc_html__( '404 Page Title','finix'),
            'default'   => esc_html__( '404','finix' )
        ),

        array(
            'id'        => 'error_contant',
            'type'      => 'text',
            'title'     => esc_html__( '404 Page Contant','finix'),
            'default'   => esc_html__( 'Ohhh! Page Not Found','finix' )
        ),

        array(
            'id'        => 'error_description',
            'type'      => 'textarea',
            'title'     => esc_html__( '404 Page Description','finix'),
            'default'   => esc_html__( 'The Page You are Looking for does Not Exits.','finix' )
        ),
    )) 
);
?>