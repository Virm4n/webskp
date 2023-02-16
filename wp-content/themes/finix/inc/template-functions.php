<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function finix_body_classes( $classes ) {
	// Add class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Add class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add class if we're viewing the Customizer for easier styling of theme options.
	if ( is_customize_preview() ) {
		$classes[] = 'finix-customizer';
	}

	// Add class on front page.
	if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
		$classes[] = 'finix-front-page';
	}

	// Add a class if there is a custom header.
	if ( has_header_image() ) {
		$classes[] = 'has-header-image';
	}

	// Add class if sidebar is used.
	if ( is_active_sidebar( 'sidebar-1' ) && ! is_page() ) {
		$classes[] = 'has-sidebar';
	}

	// Add class for one or two column page layouts.
	if ( is_page() || is_archive() ) {
		if ( 'one-column' === get_theme_mod( 'page_layout' ) ) {
			$classes[] = 'page-one-column';
		} else {
			$classes[] = 'page-two-column';
		}
	}

	// Add class if the site title and tagline is hidden.
	if ( 'blank' === get_header_textcolor() ) {
		$classes[] = 'title-tagline-hidden';
	}

	//Layout Option
	if ( class_exists( 'ReduxFramework' ) ) {
		$finix_opt = get_option('finix_redux');

		$opt= $finix_opt['site_layout'];
		if($opt == "1"){ $classes[] = 'layout-default';  } 
		if($opt == "2"){ $classes[] = 'layout-boxed';  }
		elseif($opt == "3"){ $classes[] = 'layout-frame'; }

		$opt= $finix_opt['display_sticky_footer'];
		if($opt == "on"){ $classes[] = 'sticky-footer';}

		// New Class
		$opt= $finix_opt['mobile_ui_setting'];
		if($opt == "mobile-back-top-off"){ $classes[] = 'mobile-back-top-off';}
		if($opt == "mobile-back-top-default"){ $classes[] = 'mobile-back-top-default';}
		elseif($opt == "mobile-back-top-ui"){ $classes[] = 'mobile-back-top-ui';}

		$maint_mode = $finix_opt['maintenance_type'];
		if ( '1' === $maint_mode ) { $classes[] = 'maintenance-page';  }
		if ( '2' === $maint_mode ) { $classes[] = 'coming-soon-page';  }
	}

	return $classes;
}
add_filter( 'body_class', 'finix_body_classes' );

/**
 * Count our number of active panels.
 *
 * Primarily used to see if we have any panels active, duh.
 */
function finix_panel_count() {

	$panel_count = 0;

	/**
	 * Filter number of front page sections in Finix.
	 *
	 * @since finix 1.0
	 *
	 * @param int $num_sections Number of front page sections.
	 */
	$num_sections = apply_filters( 'finix_front_page_sections', 4 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		if ( get_theme_mod( 'panel_' . $i ) ) {
			$panel_count++;
		}
	}

	return $panel_count;
}

/**
 * Checks to see if we're on the front page or not.
 */
function finix_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

if ( ! function_exists( 'finix_recent_post' ) ) {
	/**
	 * Get recent post
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	function finix_recent_post() {
		get_template_part( 'template-parts/post/recent-post' );
	}
}

if ( ! function_exists( 'finix_recent_portfolio' ) ) {
	/**
	 * Get recent post
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	function finix_recent_portfolio() {
		get_template_part( 'template-parts/post/recent-portfolio' );
	}
}
