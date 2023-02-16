<?php
/**
 * Page Header Options
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 * @version 1.5.0
 */

Redux::setSection( 'finix_redux', array(
    'title' => esc_html__('Page Header','finix'),
    'id'    => 'breadcrumbs-favicon',
    'icon'  => 'el el-cog',
    'customizer_width' => '500px',
    'desc'  => esc_html__('This section contains options for Breadcrumbs.','finix'),
    'fields'=> array(

       
        array(
            'id'      => 'page_header_type',
            'type'    => 'image_select',
            'title'   => esc_html__( 'Select Page Header Style.', 'finix' ),
            'subtitle' => esc_html__( 'Select the design variation that you want to use for Page Header.', 'finix' ),
            'options' => array(
                '1'      => array(
                    'alt' => 'Style1',
                    'img' => get_template_directory_uri() . '/assets/images/backend/bg-3.jpg',
                ),
                '2'      => array(
                    'alt' => 'Style2',
                    'img' => get_template_directory_uri() . '/assets/images/backend/bg-2.jpg',
                ),
                '3'      => array(
                    'alt' => 'Style3',
                    'img' => get_template_directory_uri() . '/assets/images/backend/bg-1.jpg',
                ),
                '4'      => array(
                    'alt' => 'Style3',
                    'img' => get_template_directory_uri() . '/assets/images/backend/bg-4.jpg',
                ),
            ),
            'default' => '1'
        ),

        array(
            'id'            => 'shape_bg_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Shape Background Color', 'finix' ),
            'required'  => array( 'page_header_type', '=', '4' ),
            'subtitle'      => esc_html__( 'Choose Shape background color', 'finix' ),
            'default'       => '#ffffff',
            'transparent'   => false
        ),

        array(
            'id'       => 'pg_one_align',
            'type'     => 'select',
            'title'    => esc_html__('Page Header Alignment', 'finix'), 
            'subtitle' => esc_html__( 'Select Page Header Alignment.', 'finix' ),
            'required'  => array( 'page_header_type', '=', '1' ),
            'options'  => array(
                '1' => 'All Left',
                '2' => 'All Right',
                '3' => 'All Center',
            ),
            'default'  => '3',
        ),

        array(
            'id'       => 'pg_three_align',
            'type'     => 'select',
            'title'    => esc_html__('Select Page Header Alignment.', 'finix'), 
            'required'  => array( 'page_header_type', '=', '3' ),
            'options'  => array(
                '1' => 'Breadcrume Left/Title Right',
                '2' => 'Title Left/Breadcrume Right',
            ),
            'default'  => '2',
        ),

        array(
            'id'             => 'opt-spacing-expanded',
            'type'           => 'spacing',
            'mode'           => 'padding',
            // absolute, padding, margin, defaults to padding
            'all'            => false,
            // Have one field that applies to all
            'top'           => true,     // Disable the top
            'bottom'        => true,     // Disable the bottom
            'right'         => false,     // Disable the right
            'left'          => false,     // Disable the left
            'units'          => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',    // Allow users to select any type of unit
            //'display_units' => 'false',   // Set to false to hide the units if the units are specified
            'output'    => array( '.page-header .page-header-inner' ),
            'title'          => __( 'Padding Option', 'finix' ),
            'subtitle'       => __( 'Allow your users to choose the spacing or Padding they want.', 'finix' ),
            'desc'           => __( 'You can enable or disable any piece of this field. Top, Right, Bottom, Left, or Units.', 'finix' ),
            'default'        => array(
                'padding-top'    => '125px',
                'padding-bottom' => '125px',
            )
        ),

        array(
            'id'             => 'ph-mobile-padding',
            'type'           => 'spacing',
            'mode'           => 'padding',
            // absolute, padding, margin, defaults to padding
            'all'            => false,
            // Have one field that applies to all
            'top'           => true,     // Disable the top
            'bottom'        => true,     // Disable the bottom
            'right'         => false,     // Disable the right
            'left'          => false,     // Disable the left
            'units'          => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',    // Allow users to select any type of unit
            //'display_units' => 'false',   // Set to false to hide the units if the units are specified
            'output'    => array( '.page-header.mobile-page-header .page-header-inner' ),
            'title'          => __( 'Mobile Padding Option', 'finix' ),
            'subtitle'       => __( 'Allow your users to choose the spacing or Padding they want for Mobile View.', 'finix' ),
            'desc'           => __( 'You can enable or disable any piece of this field. Top, Right, Bottom, Left, or Units.', 'finix' ),
            'default'        => array(
                'padding-top'    => '80px',
                'padding-bottom' => '80px',
            )
        ),
               
        array(
            'id'       => 'ph_type',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Page Header Background Type', 'finix' ),
            'subtitle' => esc_html__( 'Select this option for Background Type Color or image.', 'finix' ),
            'options'  => array(
                '1' => 'Color',
                '2' => 'Image',
            ),
            'default'  => '1'
        ),

        array(
            'id'       => 'page_header_image',
            'type'     => 'background',
            'background-color'      => false,
            'required'  => array( 'ph_type', '=', '2' ),
            'output'   => array( '.page-header' ),
            'title'    => __( 'Page Header Background', 'finix' ),
            'subtitle' => __( 'Page Header background with image, color, etc.', 'finix' ),
        ),

        array(
            'id'            => 'page_header_bg_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Set Page Header Background Color', 'finix' ),
            'subtitle'      => esc_html__( 'Choose Page Header Background Color', 'finix' ),
            'required'  => array( 'ph_type', '=', '1' ),
            'default'       =>'#222733',
            'mode'          => 'background',
            'transparent'   => false
        ),

        array(
            'id'       => 'page_header_opacity',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Background Opacity', 'finix' ),
            'required' => array( 
                array('ph_type','!=','1') 
            ),
            'subtitle' => esc_html__( 'Select this option for Background Opacity Color.', 'finix' ),
            'options'  => array(
                '1' => 'None',
                '2' => 'Custom'
            ),
            'default'  => '1'
        ),

        array(
            'id'            => 'opacity_color',
            'type'          => 'color_rgba',
            'title'         => esc_html__( 'Opacity Color', 'finix' ),
            'required'  => array( 'page_header_opacity', '=', '2' ),
            'subtitle'      => esc_html__( 'Choose body Gradient background color', 'finix' ),
            'default'       => 'rgba(2, 13, 30, 0.9)',
            'transparent'   => false
        ),

        array(
            'id'            => 'opacity_gradient_color',
            'type'          => 'color_rgba',
            'title'         => esc_html__('Opacity Gradient Color', 'finix' ),
            'required'  => array( 'page_header_opacity', '=', '2' ),
            'subtitle'      => esc_html__('Choose primary gradient color for Page Header background color.', 'finix'),
            'mode'          => 'background',
            'default'       =>'#fe506a',
            'transparent'   => false
        ),

        array(
            'id'     => 'header_typography',
            'type'   => 'section',
            'title'  => esc_html__( 'Page Header Typography', 'finix' ),
            'indent' => true,
        ),

        array(
            'id'       => 'page_header_typography',
            'type'     => 'button_set',
            'title'    => __( 'Page Header Typography', 'finix' ),
            'required' => array( 'header_type', '=', '1' ),
            'options'  => array(
                '1' => 'Default',
                '2' => 'Custom',
            ),
            'default'  => '1',
        ),

        array(
            'id'       => 'page-header-typography',
            'type'     => 'typography',
            'title'    => __( 'Page Header Font', 'finix' ),
            'subtitle' => __( 'Specify the Page Header font properties.', 'finix' ),
            'required' => array( 'page_header_typography', '=', '2' ),
            'google'   => false,
            'letter-spacing'=> true, 
            'font-backup' => false,
            'text-transform'  => true,
            'text-align'    => false,  
            'color'         => false,
            //'output' => array('.page-header .page-title'),
        ),

        array(
            'id'            => 'page_header_title_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Page Title Color', 'finix' ),
            'subtitle'      => esc_html__( 'Choose Title Color', 'finix' ),
            'default'       =>'#ffffff',
            'mode'          => 'background',
            'transparent'   => false
        ),

        array(
            'id'     => 'page_header_breadcrumbs',
            'type'   => 'section',
            'title'  => esc_html__( 'Breadcrumbs', 'finix' ),
            'indent' => true,
        ),

        array(
            'id'        => 'breadcrumbs',
            'type'      => 'button_set',
            'title'     => esc_html__( 'Display Breadcrumbs on Banner','finix'),
            'options'   => array(
                            'on' => esc_html__('On','finix'),
                            'off' => esc_html__('Off','finix')
                        ),
            'default'   => esc_html__('on','finix')
        ),

        array(
            'id'            => 'breadcrumbs_link_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Breadcrumbs Link Color', 'finix' ),
            'subtitle'      => esc_html__( 'Choose Title Color', 'finix' ),
            'required'  => array( 'breadcrumbs', '=', 'on' ),
            'default'       =>'#ffffff',
            'mode'          => 'background',
            'transparent'   => false
        ),

        array(
            'id'            => 'breadcrumbs_hover_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Breadcrumbs Hover Color', 'finix' ),
            'subtitle'      => esc_html__( 'Choose Title Color', 'finix' ),
            'required'  => array( 'breadcrumbs', '=', 'on' ),
            'default'       =>'#fc692b',
            'mode'          => 'background',
            'transparent'   => false
        ),

    )
)); 
?>