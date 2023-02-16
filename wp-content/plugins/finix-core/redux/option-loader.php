<?php
/**
 * Site Loader Options
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 * @version 1.5.0
 */

Redux::setSection( 'finix_redux', array(
    'title' => esc_html__('Site Loader','finix'),
    'id'    => 'site-loader',
    'icon'  => 'el el-refresh',
    'fields'=> array(

        array(
            'id' => 'section-general',
            'type' => 'section',            
            'indent' => true
        ) ,

        array(
            'id'        => 'display_loader',
            'type'      => 'button_set',
            'title'     => esc_html__( 'Site Loader','finix'),
            'subtitle' => wp_kses('Turn on to show the icon/images Loader animation before Site Load.', 'finix'),
            'options'   => array(
                            'yes' => esc_html__('ON','finix'),
                            'no' => esc_html__('OFF','finix')
                        ),
            'default'   => esc_html__('yes','finix')
        ),

        array(
            'id'            => 'loader_bg_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Loader Background Color', 'finix' ),
            'required'  => array( 'display_loader', '=', 'yes' ),
            'subtitle'      => esc_html__( 'Choose Loader Background Color', 'finix' ),
            'default'       => '#ffffff',
            'transparent'   => false
        ),

        array(
            'id'            => 'loader_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Loader Color', 'finix' ),
            'required'  => array( 'display_loader', '=', 'yes' ),
            'subtitle'      => esc_html__( 'Choose Loader Color', 'finix' ),
            'default'       => '#fc692b',
            'transparent'   => false
        ),

        array(
            'id'       => 'loader_style',
            'type'     => 'button_set',
            'title'    => __( 'Loader Setting', 'finix' ),
            'required'  => array( 'display_loader', '=', 'yes' ),
            'subtitle' => __( 'Select Loader Display Type.', 'finix' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Default',
                '2' => 'Loader',
                '3' => 'Custom'
            ),
            'default'  => '1'
        ),

        array(
            'id'      => 'loader_type',
            'class'   => 'loader_images',
            'type'    => 'image_select',
            'title'   => esc_html__( 'Loader Style', 'finix' ),
            'required'  => array( 'loader_style', '=', '2' ),
            'subtitle' => esc_html__( 'Select the design variation that you want to use for site header.', 'finix' ),
            'options' => array(
                '1'      => array(
                    'alt' => 'Style1',
                    'img' => get_template_directory_uri() . '/assets/images/loader/loading-1.jpg',
                ),  
                '2'      => array(
                    'alt' => 'Style2',
                    'img' => get_template_directory_uri() . '/assets/images/loader/loading-2.jpg',
                ), 
                '3'      => array(
                    'alt' => 'Style3',
                    'img' => get_template_directory_uri() . '/assets/images/loader/loading-3.jpg',
                ),  
                '4'      => array(
                    'alt' => 'Style4',
                    'img' => get_template_directory_uri() . '/assets/images/loader/loading-4.jpg',
                ),  
                '5'      => array(
                    'alt' => 'Style5',
                    'img' => get_template_directory_uri() . '/assets/images/loader/loading-5.jpg',
                ), 
                '6'      => array(
                    'alt' => 'Style6',
                    'img' => get_template_directory_uri() . '/assets/images/loader/loading-6.jpg',
                ),
                '7'      => array(
                    'alt' => 'Style7',
                    'img' => get_template_directory_uri() . '/assets/images/loader/loading-7.jpg',
                ),
                '8'      => array(
                    'alt' => 'Style8',
                    'img' => get_template_directory_uri() . '/assets/images/loader/loading-8.jpg',
                ),                              
            ),
            'default' => '1'
        ),
        
        array(
            'id'       => 'loader_image',         
            'type'     => 'media',
            'url'      => true,
            'title'    => esc_html__( 'Add GIF image for loader','finix'),
            'read-only'=> false,
            'required'  => array( 'loader_style', '=', '3' ),
            'default'  => array( 'url' => get_template_directory_uri() .'/assets/images/loader.gif' ),
            'subtitle' => esc_html__( 'Upload Loader GIF image for your Website.','finix'),
        ),
      
    )
));
?>