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
    'title' => esc_html__('Search Settings','finix'),
    'id'    => 'search-section',
    'icon'  => 'el el-search',
    'fields'=> array(

        array(
            'id' => 'search_type',
            'type' => 'image_select',
            'title'   => esc_html__( 'Select Search Page Type', 'finix' ),
            'options' => array(
                '1' => array(
                    'title' => esc_html__('Classic', 'finix') ,
                    'img' => get_template_directory_uri() . '/assets/images/theme-option/blog/classic.png',
                ) ,
                '2' => array(
                    'title' => esc_html__('Grid', 'finix') ,
                    'img' => get_template_directory_uri() . '/assets/images/theme-option/blog/grid.png',
                ) ,
                '3' => array(
                    'title' => esc_html__('List', 'finix') ,
                    'img' => get_template_directory_uri() . '/assets/images/theme-option/blog/list.png',
                ) ,
            ) ,
            'default'  => '1'
        ),

        array(
            'id' => 'search_sidebar',
            'type' => 'image_select',
            'title'   => esc_html__( 'Search Page Sidebar', 'finix' ),
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
        ),

    )
));
?>