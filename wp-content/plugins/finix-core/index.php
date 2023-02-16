<?php
/**
 * Finix core
 *
 * Plugin Name: Finix Core
 * Description: Finix plugin provides custom post type, elementor custom shortcode and redux options.
 * Author: Power-Squall
 * Version: 1.5.0
 * Author URI: http://finix.powersquall.com/
 * Text Domain: finix-core
 *
 * @package Finix Core
 */

define( 'FINIX_THEME_ROOT', plugin_dir_path( __FILE__ ) );
if ( ! defined( 'FINIX_THEME_URL' ) ) {
	define( 'FINIX_THEME_URL', plugins_url( '', __FILE__ ) );
}

if ( ! function_exists( 'finix_core_textdomain' ) ) {
	function finix_core_textdomain() {
		load_plugin_textdomain( 'finix-core', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
	}
	add_action( 'plugins_loaded', 'finix_core_textdomain' );
}

// Redux Framework
if ( class_exists( 'ReduxFramework' ) ) {
	require_once FINIX_THEME_ROOT . 'redux/opt-init.php';
}

require plugin_dir_path( __FILE__ ) . '/include/acf/page-options.php';
require plugin_dir_path( __FILE__ ) . '/include/shortcode.php';
require plugin_dir_path( __FILE__ ) . '/include/acf/post-format-quote.php';
require plugin_dir_path( __FILE__ ) . '/include/acf/post-format-audio.php';
require plugin_dir_path( __FILE__ ) . '/include/acf/post-format-video.php';

// Elementer
require_once FINIX_THEME_ROOT . 'elementor/init.php';

// Widget
require_once FINIX_THEME_ROOT . 'widget/class-finix-widget-init.php';

// Post Type
require_once FINIX_THEME_ROOT . 'post-type/testimonial.php';
require_once FINIX_THEME_ROOT . 'post-type/portfolio.php';
require_once FINIX_THEME_ROOT . 'post-type/team.php';

// Post Type
require_once FINIX_THEME_ROOT . 'include/maintenance.php';

function finix_core_script() {
	wp_enqueue_style( 'finix-elements', FINIX_THEME_URL . '/assest/css/elements.css', false, '1.0.0' );
	wp_enqueue_style( 'finix-elements-responsive', FINIX_THEME_URL . '/assest/css/elements-responsive.css', false, '1.0.0' );
	wp_enqueue_style( 'finix-elements-admin', FINIX_THEME_URL . '/assest/css/admin.css', false, '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'finix_core_script' );
