<?php
/**
 * Page Settings Options
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 * @version 1.5.0
 */

Redux::setSection( 'finix_redux', array(
    'title' => esc_html__('Page Settings','finix'),
    'id'    => 'page-section',
    'icon'  => 'el el-cog',
    'fields'=> array(
        

        array(
            'id' => 'page_sidebar',
            'type' => 'image_select',
            'title'   => esc_html__( 'Page Sidebar', 'finix' ),
            'options' => array(
                '1' => array(
                    'title' => esc_html__('Right Sidebar', 'finix') ,
                    'img' => get_template_directory_uri() . '/assets/images/theme-option/blog/right-sidebar.png',
                ) ,
                '2' => array(
                    'title' => esc_html__('Left Sidebar', 'finix') ,
                    'img' => get_template_directory_uri() . '/assets/images/theme-option/blog/left-sidebar.png',
                ) ,
                '3' => array(
                    'title' => esc_html__('FullWidth', 'finix') ,
                    'img' => get_template_directory_uri() . '/assets/images/theme-option/blog/full-width.png',
                ) ,
            ) ,
            'default'  => '1'
        ) ,

        array(
            'id' => 'archive_sidebar',
            'type' => 'image_select',
            'title'   => esc_html__( 'Archive Sidebar', 'finix' ),
            'options' => array(
                '1' => array(
                    'title' => esc_html__('Right Sidebar', 'finix') ,
                    'img' => get_template_directory_uri() . '/assets/images/theme-option/blog/right-sidebar.png',
                ) ,
                '2' => array(
                    'title' => esc_html__('Left Sidebar', 'finix') ,
                    'img' => get_template_directory_uri() . '/assets/images/theme-option/blog/left-sidebar.png',
                ) ,
                '3' => array(
                    'title' => esc_html__('FullWidth', 'finix') ,
                    'img' => get_template_directory_uri() . '/assets/images/theme-option/blog/full-width.png',
                ) ,
            ) ,
            'default'  => '1'
        ) ,
        
    )
));
?>