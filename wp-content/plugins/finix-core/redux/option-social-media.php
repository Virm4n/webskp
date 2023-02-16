<?php
/**
 * Social links Options
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 * @version 1.5.0
 */

Redux::setSection( 'finix_redux',  array(
    'title'     => esc_html__( 'Social links', 'finix' ),
    'id'        => 'social_link',
    'icon'      => 'dashicons dashicons-share',
    'fields'    => array(

        array(
            'id'    => 'facebook',
            'type'  => 'text',
            'title' => esc_html__( 'Facebook', 'finix' ),
            'default'	 => '#'
        ),

        array(
            'id'    => 'twitter',
            'type'  => 'text',
            'title' => esc_html__( 'Twitter', 'finix' ),
            'default'	  => '#'
        ),

        array(
            'id'    => 'instagram',
            'type'  => 'text',
            'title' => esc_html__( 'Instagram', 'finix' ),
        ),

        array(
            'id'    => 'linkedin',
            'type'  => 'text',
            'title' => esc_html__( 'LinkedIn', 'finix' ),
            'default'	  => '#'
        ),

        array(
            'id'    => 'youtube',
            'type'  => 'text',
            'title' => esc_html__( 'Youtube', 'finix' ),
        ),

        array(
            'id'    => 'dribbble',
            'type'  => 'text',
            'title' => esc_html__( 'Dribbble', 'finix' ),
        ),

        array(
            'id'    => 'github',
            'type'  => 'text',
            'title' => esc_html__( 'GitHub', 'finix' ),
        ),

    ),
));
?>