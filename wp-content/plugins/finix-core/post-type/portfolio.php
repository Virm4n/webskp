<?php
/**
 * Finix custom post type
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 */

/**
 * Register Portfolio
 */
function finix_post_type_portfolio() {
	$supports = array(
	'title', // post title
	'editor', // post content
	'thumbnail', // featured images
	'category', // post category
	'tag', // post tag
	);
	$labels = array(
	'name' => esc_html__('Portfolio', 'plural'),
	'singular_name' => esc_html__('Portfolio', 'singular'),
	'menu_name' => esc_html__('Portfolio', 'admin menu'),
	'name_admin_bar' => esc_html__('Portfolio', 'admin bar'),
	'add_new' => esc_html__('Add New', 'add new'),
	'add_new_item' => __('Add New Portfolio'),
	'new_item' => esc_html__('New Portfolio'),
	'edit_item' => esc_html__('Edit Portfolio'),
	'view_item' => esc_html__('View Portfolio'),
	'all_items' => esc_html__('All Portfolio'),
	'search_items' => esc_html__('Search Portfolio'),
	'not_found' => esc_html__('No Portfolio found.'),
	);
	$args = array(
	'supports' => $supports,
	'labels' => $labels,
	'public' => true,
	'query_var' => true,
	'rewrite' => array('slug' => 'portfolio'),
	'has_archive' => true,
	'hierarchical' => false,
	'menu_icon'          => 'dashicons-schedule',
	);
	register_post_type('portfolio', $args);
	}
add_action('init', 'finix_post_type_portfolio');

 
add_action( 'after_setup_theme', 'finix_portfolio_taxonomy' );
function finix_portfolio_taxonomy() {
	register_taxonomy(
		'portfolio-categories',
		'portfolio',
		array(
			'label' => esc_html__( 'Portfolio Category', 'finix' ),
			'rewrite' => true,
			'hierarchical' => true,
		)
	);
	register_taxonomy(
		'portfolio-tag',
		'portfolio',
		array(
			'label' => esc_html__( 'Portfolio Tag', 'finix' ),
			'rewrite' => true,
			'hierarchical' => true,
		)
	);
}
?>