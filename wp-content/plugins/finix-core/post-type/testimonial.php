<?php
/**
 * Finix custom post type
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 */

/**
 * Register Testimonial
 */
function finix_post_type_testimonial() {
	$supports = array(
	'title', // post title
	'editor', // post content
	'thumbnail', // featured images
	'category', // post category
	'tag', // post tag
	);
	$labels = array(
	'name' => esc_html__('Testimonial', 'plural'),
	'singular_name' => esc_html__('Testimonial', 'singular'),
	'menu_name' => esc_html__('Testimonial', 'admin menu'),
	'name_admin_bar' => esc_html__('Testimonial', 'admin bar'),
	'add_new' => esc_html__('Add New', 'add new'),
	'add_new_item' => __('Add New Testimonial'),
	'new_item' => esc_html__('New Testimonial'),
	'edit_item' => esc_html__('Edit Testimonial'),
	'view_item' => esc_html__('View Testimonial'),
	'all_items' => esc_html__('All Testimonial'),
	'search_items' => esc_html__('Search Testimonial'),
	'not_found' => esc_html__('No Testimonial found.'),
	);
	$args = array(
	'supports' => $supports,
	'labels' => $labels,
	'public' => true,
	'query_var' => true,
	'rewrite' => array('slug' => 'testimonial'),
	'has_archive' => true,
	'hierarchical' => false,
	'menu_icon'          => 'dashicons-format-gallery',
	);
	register_post_type('testimonial', $args);
	}
add_action('init', 'finix_post_type_testimonial');

 
add_action( 'after_setup_theme', 'finix_testimonial_taxonomy' );
function finix_testimonial_taxonomy() {
	register_taxonomy(
		'testimonial-categories',
		'testimonial',
		array(
			'label' => esc_html__( 'Testimonial Category', 'finix' ),
			'rewrite' => true,
			'hierarchical' => true,
		)
	);
	register_taxonomy(
		'testimonial-tag',
		'testimonial',
		array(
			'label' => esc_html__( 'Testimonial Tag', 'finix' ),
			'rewrite' => true,
			'hierarchical' => true,
		)
	);
}
?>