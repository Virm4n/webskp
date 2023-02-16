<?php
/**
 * Footer Options
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 * @version 1.5.0
 */

Redux::setSection( 'finix_redux', array(
    'title' => esc_html__( 'Footer', 'finix' ),
    'id'    => 'footer-editor',
    'icon'  => 'el el-arrow-down',
    'customizer_width' => '500px',
) );

Redux::setSection( 'finix_redux', array(
    'title' => esc_html__('Footer Option','finix'),
    'id'    => 'footer-opt',
    'subsection' => true,
    'fields'=> array(

        array(
            'id' => 'info_footer',
            'type' => 'info',
            'style' => 'custom',            
            'color' => sanitize_hex_color('#2b2b2b'),
            'title' => __('Layout Options', 'finix') ,
            'desc' => __('This Section Contain Option For Your Site Layout.','finix'),
        ) ,

        array(
            'id' => 'section-general',
            'type' => 'section',            
            'indent' => true
        ) ,

        array(
            'id'        => 'display_footer',
            'type'      => 'button_set',
            'title'     => esc_html__( 'Display Footer','finix'),
            'subtitle' => esc_html__( 'Display Footer Top On All page', 'finix' ),
            'options'   => array(
                            'on' => esc_html__('ON','finix'),
                            'off' => esc_html__('OFF','finix')
                        ),
            'default'   => esc_html__('on','finix')
        ),
        
        array(
            'id'        => 'footer_variation',
            'type'      => 'image_select',
            'title'     => esc_html__( 'Footer Layout Type','finix' ),
            'required'  => array( 'display_footer', '=', 'on' ),
            'subtitle'  => wp_kses( __( '<br />Choose among these structures (1 Column, 2 Column, 3 Column and 4 Column) for your footer section.<br />To filling these column sections you should go to appearance > widget.<br />And put every widget that you want in these sections.','finix' ), array( 'br' => array() ) ),            
            'options'   => array(
                                '1' => array( 'title' => esc_html__( '12','finix' ), 'img' => get_template_directory_uri() . '/assets/images/backend/footer_first.png' ),
                                '2' => array( 'title' => esc_html__( '6+6','finix' ), 'img' => get_template_directory_uri() . '/assets/images/backend/footer_second.png' ),
                                '3' => array( 'title' => esc_html__( '4+4+4','finix' ), 'img' => get_template_directory_uri() . '/assets/images/backend/footer_third.png' ),
                                '4' => array( 'title' => esc_html__( '3+3+3+3','finix' ), 'img' => get_template_directory_uri() . '/assets/images/backend/footer_four.png' ),                                   
                            ),
            'default'   => '4',
        ),

        array(
            'id'       => 'sidebar-1',
            'type'     => 'select',
            'title'    => esc_html__('Footer 1 Alignment', 'finix'), 
            'subtitle' => esc_html__( 'Choose Footer 1 Column Alignment', 'finix' ),
            'required'  => array( 'display_footer', '=', 'on' ),
            'options'  => array(
                'text-left'     => 'Left',
                'text-right'    => 'Right',
                'text-center'   => 'Center',
            ),
            'default'  => 'text-left',
        ),

        array(
            'id'       => 'sidebar-2',
            'type'     => 'select',
            'title'    => esc_html__('Footer 2 Alignment', 'finix'), 
            'subtitle' => esc_html__( 'Choose Footer 2 Column Alignment', 'finix' ),
            'required'  => array( 'display_footer', '=', 'on' ),
            'options'  => array(
                'text-left'     => 'Left',
                'text-right'    => 'Right',
                'text-center'   => 'Center',
            ),
            'default'  => 'text-left',
        ),

        array(
            'id'       => 'sidebar-3',
            'type'     => 'select',
            'title'    => esc_html__('Footer 3 Alignment', 'finix'), 
            'subtitle' => esc_html__( 'Choose Footer 3 Column Alignment', 'finix' ),
            'required'  => array( 'display_footer', '=', 'on' ),
            'options'  => array(
                'text-left'     => 'Left',
                'text-right'    => 'Right',
                'text-center'   => 'Center',
            ),
            'default'  => 'text-left',
        ),

        array(
            'id'       => 'sidebar-4',
            'type'     => 'select',
            'title'    => esc_html__('Footer 4 Alignment', 'finix'),
            'subtitle' => esc_html__( 'Choose Footer 4 Column Alignment', 'finix' ),
            'required'  => array( 'display_footer', '=', 'on' ), 
            'options'  => array(
                'text-left'     => 'Left',
                'text-right'    => 'Right',
                'text-center'   => 'Center',
            ),
            'default'  => 'text-left',
        ),

        array(
            'id'       => 'sidebar-5',
            'type'     => 'select',
            'title'    => esc_html__('Footer 5 Alignment', 'finix'),
            'subtitle' => esc_html__( 'Choose Footer 5 Column Alignment', 'finix' ),
            'required'  => array( 'display_footer', '=', 'on' ), 
            'options'  => array(
                'text-left'     => 'Left',
                'text-right'    => 'Right',
                'text-center'   => 'Center',
            ),
            'default'  => 'text-left',
        ),

        array(
            'id'        => 'display_sticky_footer',
            'type'      => 'button_set',
            'title'     => esc_html__( 'Footer Sticky','finix'),
            'subtitle' => esc_html__( 'Footer Sticky On/Off', 'finix' ),
            'required'  => array( 'display_footer', '=', 'on' ), 
            'options'   => array(
                            'on' => esc_html__('ON','finix'),
                            'off' => esc_html__('OFF','finix')
                        ),
            'default'   => esc_html__('off','finix')
        ),

        array(
            'id'        => 'footer_bg',
            'type'      => 'button_set',
            'title'     => esc_html__( 'Footer Background Type','finix'),
            'subtitle' => esc_html__( 'Select this option for Background Type Color or image.', 'finix' ),
            'required'  => array( 'display_footer', '=', 'on' ), 
            'options'   => array(
                            '1' => esc_html__('Image','finix'),
                            '2' => esc_html__('Color','finix')
                        ),
            'default'   => esc_html__('1','finix')
        ),

        array(
            'id'       => 'footer_image',
            'type'     => 'background',
            'background-color'      => false,
            'required'  => array( 'footer_bg', '=', '1' ),
            'output'   => array( '.site-footer' ),
            'title'    => __( 'Footer Background', 'finix' ),
            'subtitle' => __( 'Footer background with image, color, etc.', 'finix' ),
        ),

        array(
            'id'        => 'image_opicity',
            'type'      => 'button_set',
            'title'     => esc_html__( 'Footer Opacity','finix'),
            'subtitle' => esc_html__( 'Display Footer Opacity On All page', 'finix' ),
            'required'  => array( 'footer_bg', '=', '1' ), 
            'options'   => array(
                            '1' => esc_html__('None','finix'),
                            '2' => esc_html__('Custom','finix')
                        ),
            'default'   => esc_html__('1','finix')
        ),

        array(
            'id'            => 'footer_opt_color',
            'type'          => 'color_rgba',
            'title'         => esc_html__( 'Background Gradient Color', 'finix' ),
            'required'  => array( 'image_opicity', '=', '2' ),
            'subtitle'      => esc_html__( 'Choose body Gradient background color', 'finix' ),
            'default'       => 'rgba(2, 13, 30, 0.9)',
            'transparent'   => false
        ),

        array(
            'id'            => 'footer_bg_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Footer Background Color', 'finix' ),
            'required'  => array( 'footer_bg', '=', '2' ),
            'default'       =>'#ffffff',
            'mode'          => 'background',
            'transparent'   => false
        ),

        array(
            'id'       => 'footer_title_size',
            'type'     => 'select',
            'title'    => esc_html__('Select Footer Title Size', 'finix'),
            'required'  => array( 'display_footer', '=', 'on' ), 
            'options'  => array(
                'h2' => 'h2',
                'h3' => 'h3',
                'h4' => 'h4',
                'h5' => 'h5',
                'h6' => 'h6',
            ),
            'default'  => 'h3',
        ),

        array(
            'id'            => 'footer_title_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Footer Title Color', 'finix' ),
            'required'  => array( 'display_footer', '=', 'on' ),
            'default'       =>'#212121', 
            'mode'          => 'background',
            'transparent'   => false
        ),

        array(
            'id'            => 'footer_text_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Footer Text Color', 'finix' ),
            'required'  => array( 'display_footer', '=', 'on' ), 
            'default'       =>'#757575',
            'mode'          => 'background',
            'transparent'   => false
        ),

        array(
            'id'            => 'footer_link_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Footer Link Color', 'finix' ),
            'required'  => array( 'display_footer', '=', 'on' ), 
            'default'       =>'#757575',
            'mode'          => 'background',
            'transparent'   => false
        ),

        array(
            'id'            => 'footer_link_hover_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Footer Link Hover Color', 'finix' ),
            'required'  => array( 'display_footer', '=', 'on' ), 
            'default'       =>'#fc692b',
            'mode'          => 'background',
            'transparent'   => false
        ),
    )
));

Redux::setSection( 'finix_redux', array(
    'title'      => esc_html__( 'Footer Copyright', 'finix' ),
    'id'         => 'footer-copyright',
    'subsection' => true,
    'fields'     => array(

        array(
            'id'        => 'display_copyright',
            'type'      => 'button_set',
            'title'     => esc_html__( 'Display Footer Copyright','finix'),
            'subtitle' => esc_html__( 'Display Footer Copyright On All page', 'finix' ),
            'options'   => array(
                            'on' => esc_html__('On','finix'),
                            'no' => esc_html__('Off','finix')
                        ),
            'default'   => esc_html__('on','finix')
        ),

        array(
            'id'        => 'copyright_left',
            'type'      => 'editor',
            'required'  => array( 'display_copyright', '=', 'on' ),
            'title'     => esc_html__( 'Copyright Text Left  ','finix'),
            'subtitle' => sprintf( wp_kses(__('You can use following shortcode in footer text: <br>
                            <span class="code">[finix-footer-menu]</span><br>
                            <span class="code">[finix-social-icon]</span><br>
                            <span class="code">[finix-year]</span><br>
                            <span class="code">[finix-site-title]</span>', 'finix' ),
                          array('span' => array('class' => true,),
                          'br'  => array(),
                          )
                        )
                    ),
            'default'   => esc_html__( 'Copyright © 2022 Finix All Rights Reserved.','finix'),
        ),

        array(
            'id'        => 'copyright_right',
            'type'      => 'editor',
            'required'  => array( 'display_copyright', '=', 'on' ),
            'title'     => esc_html__( 'Copyright Text Right  ','finix'),
            'subtitle' => sprintf( wp_kses(__('You can use following shortcode in footer text: <br>
                            <span class="code">[finix-footer-menu]</span><br>
                            <span class="code">[finix-social-icon]</span><br>
                            <span class="code">[finix-year]</span><br>
                            <span class="code">[finix-site-title]</span>', 'finix' ),
                          array('span' => array('class' => true,),
                          'br'  => array(),
                          )
                        )
                    ),
        ),

        array(
            'id'            => 'copyright_bg_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Set Copyright Background Color', 'finix' ),
            'required'  => array( 'display_copyright', '=', 'on' ), 
            'default'       =>'#ffffff', 
            'mode'          => 'background',
            'transparent'   => false
        ),

        array(
            'id'            => 'copyright_text_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Set Copyright Text Color', 'finix' ),
            'required'  => array( 'display_copyright', '=', 'on' ), 
            'default'       =>'#757575', 
            'mode'          => 'background',
            'transparent'   => false
        ),

        array(
            'id'            => 'copyright_link_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Set Copyright Link Color', 'finix' ),
            'required'  => array( 'display_copyright', '=', 'on' ), 
            'default'       =>'#fc692b', 
            'mode'          => 'background',
            'transparent'   => false
        ),

    )) 
);
