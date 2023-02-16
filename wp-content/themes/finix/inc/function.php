<?php
/**
 * Enqueue script and style
 *
 * @package Finix
 * @subpackage finix
 * @since finix 1.0
 */


/**
 * Enqueue
 */
function finix_css_js() {

	/* Custom CSS */
	wp_enqueue_style( 'bootstrap', FINIX_URI . '/assets/css/bootstrap.min.css', array(), '4.1.3', 'all' );
	wp_enqueue_style( 'magnificpopup', FINIX_URI . '/assets/css/magnific-popup/magnific-popup.css', array(), '4.1.3', 'all' );
	wp_enqueue_style( 'fontawesome', FINIX_URI . '/assets/css/fonts/font-awesome.min.css', array(), '2.0.0', 'all' );
	wp_enqueue_style( 'fontawesome-all', FINIX_URI . '/assets/css/fonts/all.min.css', array(), '5.12.0', 'all' );
	wp_enqueue_style( 'linearicons', FINIX_URI . '/assets/css/fonts/linearicons.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'simple-line', FINIX_URI . '/assets/css/fonts/simple-line-icons.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'themify-icons', FINIX_URI . '/assets/css/fonts/themify-icons.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'flaticon-icons', FINIX_URI . '/assets/css/fonts/flaticon.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'ionicons-icons', FINIX_URI . '/assets/css/fonts/ionicons.css', array(), '2.0.1', 'all' );
	wp_enqueue_style( 'swiper', FINIX_URI . '/assets/css/swiper.min.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'slicknav', FINIX_URI . '/assets/css/slicknav.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'finix-woocommerce', FINIX_URI . '/assets/css/woocommerce.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'main-style', FINIX_URI . '/assets/css/style.css', array(), '1.0', 'all' );
	
	$finix_opt = get_option('finix_redux');
	$theme_layout = $finix_opt['theme_layout'];
	if ( $theme_layout == '2' ) {
		wp_enqueue_style( 'theme-layout-dark', FINIX_URI . '/assets/css/style-dark.css', array(), '1.0', 'all' );
	}

	wp_enqueue_style( 'finix-responsive', FINIX_URI . '/assets/css/responsive.css', array(), '1.0', 'all' );

	/* Custom JS */
	wp_enqueue_script( 'bootstrap', FINIX_URI . '/assets/js/bootstrap.min.js', array(), '4.1.3', true );
	wp_enqueue_script( 'imagesloaded', FINIX_URI . '/assets/js/isotope/imagesLoaded.js', array(), '1.0', true );
	wp_enqueue_script( 'isotope', FINIX_URI . '/assets/js/isotope/isotope.pkgd.min.js', array(), '1.0', true );
	wp_enqueue_script( 'jquery-magnific', FINIX_URI . '/assets/js/magnific-popup/jquery.magnific-popup.min.js', array(), '1.0', true );
	wp_enqueue_script( 'jquery-appear', FINIX_URI . '/assets/js/jquery.appear.js', array(), '1.0', true );
	wp_enqueue_script( 'jquery-countTo', FINIX_URI . '/assets/js/jquery.countTo.js', array(), '1.0', true );
	wp_enqueue_script( 'jquery-scrollTo', FINIX_URI . '/assets/js/jquery.scrollTo.js', array(), '1.0', true );
	wp_enqueue_script( 'jquery-piechart', FINIX_URI . '/assets/js/jquery.piechart.js', array(), '1.0', true );
	wp_enqueue_script( 'jquery-slicknav', FINIX_URI . '/assets/js/jquery.slicknav.js', array(), '1.0', true );
	wp_enqueue_script( 'swiper', FINIX_URI . '/assets/js/swiper.min.js', array(), '1.0', true );
	wp_enqueue_script( 'jquery-parallax', FINIX_URI . '/assets/js/jquery.parallax.js', array(), '1.0', true );
	wp_enqueue_script( 'jquery-countdown', FINIX_URI . '/assets/js/jquery.countdown.js', array(), '1.0', true );
	wp_enqueue_script( 'finix-custom', FINIX_URI . '/assets/js/custom.js', array(), '1.0', true );

	if ( class_exists( 'ReduxFramework' ) ) {
	$finix_opt = get_option('finix_redux');
	$opt = $finix_opt['theme-cursor'];
		if ( $opt == 'on' ) {
			wp_enqueue_script( 'finix-mousecursor', FINIX_URI . '/assets/js/jquery.mousecursor.js', array(), '1.0', true );
		}
	}

}
add_action( 'wp_enqueue_scripts', 'finix_css_js' );

function finix_admin_style() {

	// Load the Theme Option CSS.
	wp_enqueue_style( 'finix-admin', FINIX_URI . '/assets/css/admin.css', array(), '1.0', 'all' );

}
add_action( 'admin_enqueue_scripts', 'finix_admin_style' );

require_once get_template_directory() . '/inc/helper/init.php';

