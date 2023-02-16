<?php
/**
 * Color Options
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 * @version 1.5.0
 */

Redux::setSection( 'finix_redux', array(
    'title' => esc_html__( 'Color Option','finix' ),
    'id'    => 'color-section',
    'icon'  => 'el el-brush',
    'desc'  => esc_html__('This section change the site default color.','finix'),
    'fields'=> array(

        array(
            'id' => 'info_site_color',
            'type' => 'info',
            'style' => 'custom',            
            'color' => sanitize_hex_color('#2b2b2b'),
            'title' => __('Color Options', 'finix') ,
            'desc' => __('This Section Contain Option For Your Site Layout.','finix'),
        ) ,

        array(
            'id' => 'section-general',
            'type' => 'section',            
            'indent' => true
        ) ,

        array(
            'id'            => 'primary_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Set Primary Singal Color', 'finix' ),
            'subtitle'      => esc_html__( 'Choose primary color for main theme color and main background color.', 'finix'),
            'mode'          => 'background',
            'default'       =>'#fc692b',
            'transparent'   => false
        ),

        array(
            'id'            => 'primary_gradient_color',
            'type'          => 'color',
            'title'         => esc_html__('Set Primary Gradient Color', 'finix' ),
            'subtitle'      => esc_html__('Choose primary gradient color for main theme color and main background color.', 'finix'),
            'mode'          => 'background',
            'default'       =>'#fe506a',
            'transparent'   => false
        ),

        array(
            'id'            => 'secondary_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Set Secondary Color', 'finix' ),
            'subtitle'      => esc_html__( 'Choose secondary color for dark title and background.', 'finix' ),
            'mode'          => 'background',
            'default'       =>'#212121',
            'transparent'   => false
        ),

        array(
            'id'            => 'tertiary_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Set Tertiary Color', 'finix' ),
            'subtitle'      => esc_html__( 'Choose tertiary color for description color and border colors', 'finix' ),
            'mode'          => 'background',
            'default'       =>'#757575',
            'transparent'   => false
        ),
       
    )
));
?>