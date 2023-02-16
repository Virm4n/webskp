<?php
/**
 * Layout Options
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 * @version 1.5.0
 */

$opt_name;
Redux::setSection( 'finix_redux', array(
    'title' => esc_html__('General Setting', 'finix') ,
    'id' => 'editer-layout',
    'icon' => 'el el-globe',
    'customizer_width' => '500px',
    'fields'=> array(

        array(
            'id' => 'section-general',
            'type' => 'section',            
            'indent' => true
        ) ,

        array(
            'id'     => 'theme-cursor-setting',
            'type'   => 'section',
            'title'  => esc_html__( 'Theme Cursor', 'finix' ),
            'indent' => true,
        ),

        array(
            'id'        => 'theme-cursor',
            'type'      => 'button_set',
            'title'     => esc_html__( 'Select Cursor Style','finix'),
            'subtitle' => wp_kses('Choose Cursor Style', 'finix'),
            'options'   => array(
                            'off' => esc_html__('Default','finix'),
                            'on' => esc_html__('Fancy','finix')
                        ),
            'default'   => esc_html__('off','finix')
        ),

        array(
            'id'            => 'cursor_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Theme Cursor Color', 'finix' ),
            'required'      => array( 'theme-cursor', '=', 'on' ),
            'subtitle'      => esc_html__( 'Choose Cursor Custom Color', 'finix' ),
            'default'       => '#212121',
            'desc'          => __('If you have not selected the color, then the primary color will apply by Default.','finix'),
            'transparent'   => false,
        ),

        array(
            'id'     => 'header-sidemenu-setting',
            'type'   => 'section',
            'title'  => esc_html__( 'Header Sidemenu', 'finix' ),
            'indent' => true,
        ),

        array(
            'id'       => 'header_sidemenu',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Header Sidemenu', 'finix' ),
            'subtitle' => esc_html__( 'Turn on to display the Header button in top header.', 'finix' ),
            'options'  => array(
                'on'  => esc_html__( 'On', 'finix' ),
                'off' => esc_html__( 'Off', 'finix' ),
            ),
            'default'  => esc_html__( 'off', 'finix' ),
        ),

        array(
            'id'     => 'mobile-sound',
            'type'   => 'section',
            'title'  => esc_html__( 'Click Sound Effect', 'finix' ),
            'indent' => true,
        ),

        array(
            'id'       => 'mobile_click_setting',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Click Sound Effect in Mobile', 'finix' ),
            'subtitle' => wp_kses('Turn on to Enable Click Sound Effect in Mobile.', 'finix'),
            'desc'     => __('This option will work only on Main Menu Trigger and Back to Top Trigger in Mobile View.','finix'),
            'options'  => array(
                'on'  => esc_html__( 'On', 'finix' ),
                'off' => esc_html__( 'Off', 'finix' ),
            ),
            'default'  => esc_html__( 'off', 'finix' ),
        ),

        array(
            'id'     => 'back-top-setting',
            'type'   => 'section',
            'title'  => esc_html__( 'Back to Top Setting', 'finix' ),
            'indent' => true,
        ),

        array(
            'id'        => 'back-to-top',
            'type'      => 'button_set',
            'title'     => esc_html__( 'Back to Top Desktop','finix'),
            'subtitle' => wp_kses('Turn on to show Back to Top in Desktop.', 'finix'),
            'options'   => array(
                            'on' => esc_html__('On','finix'),
                            'off' => esc_html__('Off','finix')
                        ),
            'default'   => esc_html__('on','finix')
        ),

        array(
            'id'       => 'mobile_ui_setting',
            'type'     => 'button_set',
            'title'    => __( 'Back to Top Mobile Option', 'finix' ),
            'subtitle' => __( 'Select Mobile View Option.', 'finix' ),
            'required'      => array( 'back-to-top', '=', 'on' ),
            'options'  => array(
                'mobile-back-top-off' => 'Off',
                'mobile-back-top-default' => 'Default',
                'mobile-back-top-ui' => 'Mobile UI',
            ),
            'default'  => 'mobile-back-top-ui',
        ),
      
    )
));
