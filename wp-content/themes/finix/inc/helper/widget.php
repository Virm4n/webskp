<?php
/**
 * Finix Widget
 *
 * @package Finix
 * @subpackage finix
 * @since finix 1.0
*/

/**
 * Add custom side bar start from here.
 */
function finix_right_widgets_init() {

	$finix_opt = get_option( 'finix_redux' );

	$f_t_size = ! empty( $finix_opt['footer_title_size'] ) ? $finix_opt['footer_title_size'] : 'h3';

	$sidebar1 = ! empty( $finix_opt['sidebar-1'] ) ? $finix_opt['sidebar-1'] : 'text-left';
	register_sidebar( array(
		'name'          => esc_html__('Footer 1','finix'),
		'class'         => 'nav-list',
		'id'            => 'sidebar-two',
		'before_widget' => '<div id="%1$s" class="widget %2$s '. esc_attr($sidebar1).'">',
		'after_widget'  => '</div>',
		'before_title'  => '<'. esc_attr($f_t_size).' class="widget-title">',
		'after_title'   => '</'. esc_attr($f_t_size).'>',
	) );
	
	$sidebar2 = ! empty( $finix_opt['sidebar-2'] ) ? $finix_opt['sidebar-2'] : 'text-left';
	register_sidebar( array(
		'name'          => esc_html__('Footer 2','finix'),
		'class'         => 'nav-list',
		'id'            => 'sidebar-3',
		'before_widget' => '<div id="%1$s" class="widget %2$s '. esc_attr($sidebar2).'">',
		'after_widget'  => '</div>',
		'before_title'  => '<'. esc_attr($f_t_size).' class="widget-title">',
		'after_title'   => '</'. esc_attr($f_t_size).'>',
	) );

	$sidebar3 = ! empty( $finix_opt['sidebar-3'] ) ? $finix_opt['sidebar-3'] : 'text-left';
	register_sidebar( array(
		'name'          => esc_html__('Footer 3','finix'),
		'class'         => 'nav-list',
		'id'            => 'sidebar-4',
		'before_widget' => '<div id="%1$s" class="widget %2$s '. esc_attr($sidebar3).'">',
		'after_widget'  => '</div>',
		'before_title'  => '<'. esc_attr($f_t_size).' class="widget-title ">',
		'after_title'   => '</'. esc_attr($f_t_size).'>',
	) );

	$sidebar4 = ! empty( $finix_opt['sidebar-4'] ) ? $finix_opt['sidebar-4'] : 'text-left';
	register_sidebar( array(
		'name'          => esc_html__('Footer 4','finix'),
		'class'         => 'nav-list',
		'id'            => 'sidebar-5',
		'before_widget' => '<div id="%1$s" class="widget %2$s '. esc_attr($sidebar4).'">',
		'after_widget'  => '</div>',
		'before_title'  => '<'. esc_attr($f_t_size).' class="widget-title ">',
		'after_title'   => '</'. esc_attr($f_t_size).'>',
	) );

	$sidebar5 = ! empty( $finix_opt['sidebar-5'] ) ? $finix_opt['sidebar-5'] : 'text-left';
	register_sidebar( array(
		'name'          => esc_html__('Footer 5','finix'),
		'class'         => 'nav-list',
		'id'            => 'sidebar-6',
		'before_widget' => '<div id="%1$s" class="widget %2$s '. esc_attr($sidebar5).'">',
		'after_widget'  => '</div>',
		'before_title'  => '<'. esc_attr($f_t_size).' class="widget-title ">',
		'after_title'   => '</'. esc_attr($f_t_size).'>',
	) );

	register_sidebar( array(
		'name'          => esc_html__('Footer Top Area','finix'),
		'class'         => 'nav-list',
		'id'            => 'footer_top_area',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<'. esc_attr($f_t_size).' class="widget-title ">',
		'after_title'   => '</'. esc_attr($f_t_size).'>',
	) );

	register_sidebar( array(
		'name'          => esc_html__('Services Sidebar','finix'),
		'class'         => 'nav-list',
		'id'            => 'services-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<'. esc_attr($f_t_size).' class="widget-title ">',
		'after_title'   => '</'. esc_attr($f_t_size).'>',
	) );

	register_sidebar( array(
		'name'          => esc_html__('Header Sidemenu','finix'),
		'class'         => 'nav-list',
		'id'            => 'header_sidemenu',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<'. esc_attr($f_t_size).' class="widget-title ">',
		'after_title'   => '</'. esc_attr($f_t_size).'>',
	) );
}
add_action( 'widgets_init', 'finix_right_widgets_init' );
?>