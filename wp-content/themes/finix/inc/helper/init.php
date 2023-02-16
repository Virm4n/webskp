<?php
/**
 * Finix Main File
 *
 * @package Finix
 * @subpackage finix
 * @since finix 1.0
*/

/**
 * All Function File
 */

// Widget
require_once get_template_directory() . '/inc/helper/widget.php';
// Breadcrumbs
require_once get_template_directory() . '/inc/page-header/breadcrumbs.php';
// Page Title
require_once get_template_directory() . '/inc/page-header/page-header-title.php';
// Banner
require_once get_template_directory() . '/inc/page-header/page-header.php';
// Comment
require_once get_template_directory() . '/inc/helper/comment.php';
// Paginataion
require_once get_template_directory() . '/inc/helper/pagination.php';
// Finix helper function
require_once get_template_directory() . '/inc/helper/helper_function.php';
require_once get_template_directory() . '/inc/helper/acf_functions.php';
// Woocommerce
require_once get_template_directory() . '/inc/helper/woocommerce.php';
require_once get_template_directory() . '/inc/helper/woocommerce-hooks.php';
// TGM
require_once get_template_directory() . '/inc/tgm/required-plugins.php';
// Demo
require_once get_template_directory() . '/inc/importer/import.php';

// Dynamic CSS
if ( function_exists( 'get_field' ) ) {
	require_once get_template_directory() . '/inc/helper/acf_dynamic_css.php';
}
if ( class_exists( 'ReduxFramework' ) ) {
	require_once get_template_directory() . '/inc/helper/dynamic_css.php';

	require_once get_template_directory() . '/inc/helper/color_customization.php';
}

function finix_myscript() {
	$finix_opt = get_option( 'finix_redux' );
	if ( ! empty( $finix_opt['custom_js'] ) ) {
		?>
	<script type="text/javascript">
		<?php echo wp_specialchars_decode( $finix_opt['custom_js'] ); ?>
	</script>
		<?php
	}
}
add_action( 'wp_footer', 'finix_myscript' );

function finix_header_jquery() {
	$finix_opt = get_option( 'finix_redux' );
	if ( ! empty( $finix_opt['custom_header_js'] ) ) {
		?>
	<script type="text/javascript">
		<?php echo wp_specialchars_decode( $finix_opt['custom_header_js'] ); ?>
	</script>
		<?php
	}
}
add_action( 'wp_head', 'finix_header_jquery' );

/**
 * Exclude pages from WordPress Search
 */
if ( ! is_admin() ) {
	function finix_search_filter( $query ) {
		if ( $query->is_search ) {
			$query->set( 'post_type', 'post' );
		}
		return $query;
	}
	add_filter( 'pre_get_posts', 'finix_search_filter' );
}
?>
