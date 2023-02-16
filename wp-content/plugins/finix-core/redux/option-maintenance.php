<?php
/**
 * Maintenance Options
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 * @version 1.5.0
 */

Redux::setSection( 'finix_redux', array(
    'title' => esc_html__( 'Maintenance', 'finix' ),
    'id'    => 'opt-maintenance', 
    'icon'  => 'el el-off',
    'fields'           => array(

        array(
            'id' => 'info_maintenance',
            'type' => 'info',
            'style' => 'custom',            
            'color' => sanitize_hex_color('#2b2b2b'),
            'title' => __('Layout Options', 'finix') ,
            'desc' => __('This Section Contain Option For Your Site Layout.','finix'),
        ) ,

        array(
            'id' => 'section-maintenance',
            'type' => 'section',            
            'indent' => true
        ) ,

        array(
            'id'        => 'maintenance_opt',
            'type'      => 'button_set',
            'title'     => esc_html__( 'On/Off Maintenance or Coming Soon mode','finix'),
            'subtitle' => esc_html__( 'Turn on to active Maintenance or Coming Soon mode.','finix'),
            'options'   => array(
                            'on' => esc_html__('On','finix'),
                            'off' => esc_html__('Off','finix')
                        ),
            'default'   => esc_html__('off','finix')
        ),

        
        array(
            'id'       => 'maintenance_type',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Maintenance Mode', 'finix' ),
            'subtitle' => esc_html__( 'Select Maintenance Mode.', 'finix' ),
            'required'  => array( 'maintenance_opt', '=', 'on' ),
            'options'  => array(
                '1' => 'Maintenance',
                '2' => 'Coming Soon',
            ),
            'default'  => '1'
        ),

        array(
            'id'       => 'maintenance_logo_type',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Maintenance Logo Option', 'finix' ),
            'required'  => array( 'maintenance_opt', '=', 'on' ),
            'subtitle' => esc_html__( 'Select this option for Maintenance Page Logo Option.', 'finix' ),
            'options'  => array(
                '1' => 'Default',
                '2' => 'Custom',
            ),
            'default'  => '2'
        ),

        array(
            'id'       => 'maintenance_logo',         
            'type'     => 'media',
            'url'      => false,
            'title'    => esc_html__( 'Maintenance Logo','finix'),
            'required'  => array( 'maintenance_logo_type', '=', '2' ),
            'read-only'=> false,
            'default'  => array( 'url' => get_template_directory_uri() .'/assets/images/logo.png' ),
            'subtitle' => esc_html__( 'Upload Logo image for your Website. Otherwise site title will be displayed in place of Logo.','finix'),
        ), 

        array(
            'id'       => 'mainte_title',
            'type'     => 'text',
            'title'    => esc_html__( 'Maintenance Title', 'finix' ),
            'desc'     => esc_html__( 'Field Description', 'finix' ),
            'required'  => array( 'maintenance_type', '=', '1' ),
            'default'  => esc_html__('The website is in Maintenance mode.','finix' ),
        ),

        array(
            'id'       => 'mainte_sub_title',
            'type'     => 'text',
            'title'    => esc_html__( 'Maintenance Description', 'finix' ),
            'desc'     => esc_html__( 'Field Description', 'finix' ),
            'required'  => array( 'maintenance_type', '=', '1' ),
            'default'  => esc_html__('Please Check Back in Sometime.','finix' ),
        ),

        array(
            'id'       => 'coming_title',
            'type'     => 'text',
            'title'    => esc_html__( 'Coming Soon Title', 'finix' ),
            'desc'     => esc_html__( 'Field Description', 'finix' ),
            'required'  => array( 'maintenance_type', '=', '2' ),
            'default'  => esc_html__('COMING SOON','finix' ),
        ),

        array(
            'id'       => 'coming_desc',
            'type'     => 'text',
            'title'    => esc_html__( 'Coming Soon Description', 'finix' ),
            'desc'     => esc_html__( 'Field Description', 'finix' ),
            'required'  => array( 'maintenance_type', '=', '2' ),
            'default'  => esc_html__('Get Notified when our website is ready.','finix' ),
        ),

        array(
            'id'          => 'coming_date',
            'type'        => 'date',
            'title'       => esc_html__('Coming Soon Date', 'finix'), 
            'required'  => array( 'maintenance_type', '=', '2' ),
            'placeholder' => 'Click to enter a date'
        ),
                
        array(
            'id'        => 'maint_newsletter',
            'type'      => 'button_set',
            'title'     => esc_html__( 'Maintenance newsletter','finix'),
            'required'  => array( 'maintenance_opt', '=', 'on' ),
            'subtitle' => esc_html__( 'Turn on to active Maintenance newsletter.','finix'),
            'options'   => array(
                            'on' => esc_html__('On','finix'),
                            'off' => esc_html__('Off','finix')
                        ),
            'default'   => esc_html__('off','finix')
        ),

        array(
            'id'        => 'maint_social_media',
            'type'      => 'button_set',
            'title'     => esc_html__( 'Maintenance social media','finix'),
            'required'  => array( 'maintenance_opt', '=', 'on' ),
            'subtitle' => esc_html__( 'Turn on to active Maintenance social media.','finix'),
            'options'   => array(
                            'on' => esc_html__('On','finix'),
                            'off' => esc_html__('Off','finix')
                        ),
            'default'   => esc_html__('off','finix')
        ),
                    
    ) 
) );
?>
