<?php
/**
 * Body Options
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 * @version 1.5.0
 */

$opt_name;
Redux::setSection( 'finix_redux', array(
    'title' => esc_html__('Body Backgrond', 'finix') ,
    'id' => 'body-backgrond-layout',
    'icon' => 'el el-globe',
    'customizer_width' => '500px',
    'fields'=> array(

        array(
            'id' => 'section-general',
            'type' => 'section',            
            'indent' => true
        ) ,

        array(
            'id' => 'site_layout',
            'type' => 'image_select',
            'title'    => esc_html__( 'Body Layout', 'finix' ),
			'subtitle' => esc_html__( 'Select the design variation that you want to use for body type.', 'finix' ),
            'desc' => __('<p>Choose From Above Suitable Option For Your Site.</p>','finix'),
            'options' => array(
                '1' => array(
                    'title' => esc_html__('Default', 'finix') ,
                    'img' => get_template_directory_uri() . '/assets/images/theme-option/layout-setting/default.png',
                ) ,
                '2' => array(
                    'title' => esc_html__('Boxed', 'finix') ,
                    'img' => get_template_directory_uri() . '/assets/images/theme-option/layout-setting/boxed.png',
                ) ,
                '3' => array(
                    'title' => esc_html__('Frame', 'finix') ,
                    'img' => get_template_directory_uri() . '/assets/images/theme-option/layout-setting/frame.png',
                ) ,
            ) ,
            'default'  => '1'
        ) ,

        array(
            'id' => 'section-general',
            'type' => 'section',            
            'indent' => true
        ) ,

        array(
            'id'       => 'body_background',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Body Background', 'finix' ),
            'subtitle' => esc_html__( 'Select this option for body color or image of the theme.', 'finix' ),
            'options'  => array(
                '1' => 'Color',
                '2' => 'Image'
            ),
            'default'  => '1'
        ),

        array(
            'id'            => 'body_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Select Body Color', 'finix' ),
            'subtitle'      => esc_html__( 'Choose Body Color', 'finix' ),
            'required'      => array( 'body_background', '=', '1' ),
            'default'       =>'#ffffff',
            'mode'          => 'background',
            'transparent'   => false
        ),

        array(
            'id'       => 'body_image',
            'type'     => 'background',
            'title'    => __( 'Body Background', 'finix' ),
            'subtitle' => __( 'Body background with image, color, etc.', 'finix' ),
            'background-color'      => false,
            'required' => array( 'body_background', '=', '2' ),
            'output'   => array( 'body' ),
        ),

        array(
            'id'       => 'theme_layout',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Theme Layout', 'finix' ),
            'subtitle' => esc_html__( 'Select this option for theme layout color of the theme.', 'finix' ),
            'options'  => array(
                '1' => 'Light',
                '2' => 'Dark'
            ),
            'default'  => '1'
        ),
      
    )
));
