<?php 
/**
 * CSS/JS Options
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 * @version 1.5.0
 */

Redux::setSection( 'finix_redux', array(
    'title' => esc_html__('Custom CSS/JS','finix'),
    'id'    => 'custom-css-js',
    'icon'  => 'el el-lines',
    'desc'  => esc_html__('Add Your Custom CSS and JS Code Here.','finix'),
    'fields'=> array(

        array(
			'id'       => 'custom_css',
			'type'     => 'ace_editor',
			'title'    => esc_html__( 'Custom CSS', 'finix' ),
			'mode'     => 'css',
			'theme'    => 'chrome',
			'subtitle' => esc_html__( 'Add your CSS code here.', 'finix' ),
		),
		array(
			'id'       => 'custom_header_js',
			'type'     => 'ace_editor',
			'title'    => esc_html__( 'Header JS', 'finix' ),
			'mode'     => 'javascript',
			'theme'    => 'chrome',
			'subtitle' => esc_html__( 'Add your JS code in header.', 'finix' ),
			'default'  => "jQuery(document).ready(function($){\n\n});",
		),
		array(
			'id'       => 'custom_js',
			'type'     => 'ace_editor',
			'title'    => esc_html__( 'Custom JS', 'finix' ),
			'mode'     => 'javascript',
			'theme'    => 'chrome',
			'subtitle' => esc_html__( 'Add your JS code here.', 'finix' ),
			'default'  => "jQuery(document).ready(function($){\n\n});",
		),

    )) 
);
?>