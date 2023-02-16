<?php
/**
 * Finix custom post type
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 */

/**
 * Register Team
 */
function finix_post_type_team() {
	$supports = array(
	'title', // post title
	'editor', // post content
	'thumbnail', // featured images
	'category', // post category
	'tag', // post tag
	);
	$labels = array(
	'name' => esc_html__('Team', 'plural'),
	'singular_name' => esc_html__('Team', 'singular'),
	'menu_name' => esc_html__('Team', 'admin menu'),
	'name_admin_bar' => esc_html__('Team', 'admin bar'),
	'add_new' => esc_html__('Add New', 'add new'),
	'add_new_item' => __('Add New Team'),
	'new_item' => esc_html__('New Team'),
	'edit_item' => esc_html__('Edit Team'),
	'view_item' => esc_html__('View Team'),
	'all_items' => esc_html__('All Team'),
	'search_items' => esc_html__('Search Team'),
	'not_found' => esc_html__('No Team found.'),
	);
	$args = array(
	'supports' => $supports,
	'labels' => $labels,
	'public' => true,
	'query_var' => true,
	'rewrite' => array('slug' => 'team'),
	'has_archive' => true,
	'hierarchical' => false,
	'menu_icon'          => 'dashicons-businessman',
	);
	register_post_type('team', $args);
	}
add_action('init', 'finix_post_type_team');

 
add_action( 'after_setup_theme', 'finix_team_taxonomy' );
function finix_team_taxonomy() {
	register_taxonomy(
		'team-categories',
		'team',
		array(
			'label' => esc_html__( 'Team Category', 'finix' ),
			'rewrite' => true,
			'hierarchical' => true,
		)
	);
	register_taxonomy(
		'team-tag',
		'team',
		array(
			'label' => esc_html__( 'Team Tag', 'finix' ),
			'rewrite' => true,
			'hierarchical' => true,
		)
	);
}
?>