<?php
if( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly
}

class Mfn_Helper {

	/**
	 * Initialises and connects the WordPress Filesystem
	 */

	public static function filesystem(){

		if( ! defined( 'FS_METHOD' ) ){
			define( 'FS_METHOD', 'direct' );
			WP_Filesystem();
		}

		if( ! defined( 'FS_CHMOD_DIR' ) ){
			define( 'FS_CHMOD_DIR', ( 0755 & ~ umask() ) );
		}

		if( ! defined( 'FS_CHMOD_FILE' ) ){
			define( 'FS_CHMOD_FILE', ( 0644 & ~ umask() ) );
		}

		global $wp_filesystem;

		if( empty( $wp_filesystem ) ){
			require_once wp_normalize_path( ABSPATH . '/wp-admin/includes/file.php' );
			WP_Filesystem();
		}

		return $wp_filesystem;
	}

	/**
	 * Registration modal
	 */

	public static function the_modal_register(){

		?>

			<div class="mfn-register-now">
				<div class="inner-content">
					<div class="be">
						<img class="be-logo" src="<?php echo get_theme_file_uri( 'muffin-options/svg/others/be-gradient.svg' ); ?>" alt="Be">
					</div>
					<div class="info">
						<img alt="" src="<?php echo get_theme_file_uri( 'muffin-options/svg/others/register-now.svg' ); ?>" width="120">
						<h4>Please register the license<br />to get the access to Muffin Options</h4>
						<p class="">This page reload is required after theme registration</p>
						<a class="mfn-btn mfn-btn-green btn-large" href="admin.php?page=betheme" target="_blank"><span class="btn-wrapper">Register now</span></a>
					</div>
				</div>
			</div>

		<?php

	}

}
