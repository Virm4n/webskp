<?php
/**
 * Logo Options
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 * @version 1.5.0
 */

Redux::setSection( 'finix_redux', array(
    'title' => esc_html__('Site Logo','finix'),
    'id'    => 'site-logo',
    'icon'  => 'el el-flag',
    'fields'=> array(

        array(
            'id' => 'section-general',
            'type' => 'section',            
            'indent' => true
        ) ,

        array(
            'id'       => 'site_logo_type',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Logo Type', 'finix' ),
            'subtitle' => esc_html__( 'Select this option for Logo as Text/Image.', 'finix' ),
            'options'  => array(
                '1' => ' Logo as Text',
                '2' => ' Logo as Image',
            ),
            'default'  => '2'
        ),

        array(
            'id'       => 'site_logo',         
            'type'     => 'media',
            'url'      => false,
            'title'    => esc_html__( 'Upload Logo','finix'),
            'required'  => array( 'site_logo_type', '=', '2' ),
            'read-only'=> false,
            'default'  => array( 'url' => get_template_directory_uri() .'/assets/images/logo.svg' ),
            'subtitle' => esc_html__( 'Upload Logo image for your Website. Otherwise site title will be displayed in place of Logo.','finix'),
        ), 

        array(
            'id'             => 'logo_height',
            'type'           => 'dimensions',
            'units'          => array( 'em', 'px', '%' ),    // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',  // Allow users to select any type of unit
            'title'          => __( 'Logo Dimensions', 'finix' ),
            'required'  => array( 'site_logo_type', '=', '2' ),
            'subtitle'       => __( 'Set a Custom Height for your upload logo.', 'finix' ),
            'output'    => array( '.site-header .header-logo img' ),
            'width'         => false,
        ),

        array(
            'id'       => 'site_sticky_logo',         
            'type'     => 'media',
            'url'      => false,
            'title'    => esc_html__( 'Sticky Logo','finix'),
            'required'  => array( 'site_logo_type', '=', '2' ),
            'read-only'=> false,
            'default'  => array( 'url' => get_template_directory_uri() .'/assets/images/logo.svg' ),
            'subtitle' => esc_html__( 'Upload Sticky Logo.','finix'),
        ), 

        array(
            'id'             => 'sticky_logo_height',
            'type'           => 'dimensions',
            'units'          => array( 'em', 'px', '%' ),    // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',  // Allow users to select any type of unit
            'title'          => __( 'Sticky Logo Dimensions', 'finix' ),
            'required'  => array( 'site_logo_type', '=', '2' ),
            'subtitle'       => __( 'Set a Custom Height for your Sticky upload logo.', 'finix' ),
            'output'    => array( '.site-header.sticky .header-logo img' ),
            'width'         => false,
        ),

    
        array(
            'id'       => 'logo_text',
            'type'     => 'text',
            'title'    => esc_html__( 'Logo Text', 'finix' ),
            'desc'     => esc_html__( 'Enter the text to be used instead of the logo image', 'finix' ),
            'required'  => array( 'site_logo_type', '=', '1' ),
            'msg'      => esc_html__('custom error message','finix' ),
            'default'  => esc_html__('finix','finix' ),
        ),

        array(
            'id'          => 'logo_font',
            'type'        => 'typography',
            'title'       => __( 'Typography h2.site-description', 'finix' ),
            'required'  => array( 'site_logo_type', '=', '1' ),
            'compiler'      => true,  // Use if you want to hook in your own CSS compiler
            'google'      => true,
            'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
            'subsets'       => false, // Only appears if google is true and subsets not set to false
            'font-size'     => true,
            'line-height'   => false,
            'word-spacing'  => false,  // Defaults to false
            'letter-spacing'=> false,  // Defaults to false
            'color'         => false,
            'preview'       => false, // Disable the previewer
            'all_styles'  => false,
            // Enable all Google Font style/weight variations to be added to the page
            'output'      => array( '.site-header .header-logo .site-logo-text' ),
            // An array of CSS selectors to apply this font style to dynamically
            'compiler'    => array( 'site-description-compiler' ),
            // An array of CSS selectors to apply this font style to dynamically
            'units'       => 'px',
            'subtitle'    => __( 'Typography option with each property can be called individually.', 'finix' ),
            'default'     => array(
                'font-family' => 'Abel',
                'google'      => true,
                'font-size'   => '50px',
            ),
        ),

        array(
            'id'            => 'logo_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Text Color', 'finix' ),
            'subtitle'      => esc_html__( 'Choose Text Color', 'finix' ),
            'required'      => array( 'site_logo_type', '=', '1' ),
            'default'       =>'#ffffff',
            'mode'          => 'background',
            'transparent'   => false
        ),

        array(
            'id' => 'section-general',
            'type' => 'section',            
            'indent' => true
        ) ,

        array(
            'id'       => 'site_favicon_icon',         
            'type'     => 'media',
            'url'      => false,
            'title'    => esc_html__( 'Favicon Icon','finix'),
            'read-only'=> false,
            'default'  => array( 'url' => get_template_directory_uri() .'/assets/images/favicon.png' ),
            'subtitle' => esc_html__( 'Upload Favicon Logo image for your Website. Otherwise site title will be displayed in place of Favicon Logo.','finix'),
        ), 

        array(
            'id' => 'section-general',
            'type' => 'section',            
            'indent' => true
        ) ,

        array(
            'id'        => 'site_description',
            'type'      => 'button_set',
            'title'     => esc_html__( 'Header Description','finix'),
            'subtitle' => esc_html__( 'Turn on to display Site Description Below Logo.','finix'),
            'options'   => array(
                            '1' => esc_html__('On','finix'),
                            '2' => esc_html__('Off','finix')
                        ),
            'default'   => esc_html__('2','finix')
        ),
        
    )
));   
?>