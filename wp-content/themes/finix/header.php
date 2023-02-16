<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php $finix_opt = get_option( 'finix_redux' ); ?>

<!-- Favicon -->
<?php
if ( ! function_exists( 'has_site_icon' ) || ! wp_site_icon() ) {
	if ( ! empty( $finix_opt['site_favicon_icon']['url'] ) ) {
		?>
		<link rel="favicon icon" href="<?php echo esc_url( $finix_opt['site_favicon_icon']['url'] ); ?>" />
		<?php
	} else {
		?>
		<link rel="favicon icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon.ico' ); ?>" />
		<?php
	}
}
?>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php
if ( class_exists( 'ReduxFramework' ) ) {
	$opt = $finix_opt['theme-cursor'];
	if ( $opt == 'on' ) {
		?>
	<div id="theme-cursor">
		<div class="mouse-cursor cursor-outer"></div>
		<div class="mouse-cursor cursor-inner"></div>
	</div>
	<!-- Theme Cursor -->
	<?php }
} ?>

<?php wp_body_open(); ?>

<?php get_template_part( 'template-parts/header/preloader' ); ?>

<?php
$header_set = ! empty( $finix_opt['header_setting'] ) ? $finix_opt['header_setting'] : 'default';
?>

<div id="page" class="site header-<?php if (!empty( $header_set)) {echo esc_attr( $header_set );} ?>
">
		
	<?php
		$header_nav = function_exists( 'get_field' ) ? get_field( 'header_nav' ) : 'enable';
		$header_nav = isset( $header_nav ) ? $header_nav : 'enable';

	if ( $header_nav == 'enable' ) {

		$header_style = function_exists( 'get_field' ) ? get_field( 'header_style' ) : '';

		if ( ! empty( $header_style ) && $header_style != 'default' ) { 
			$header_opt = $header_style;
		} else {
			$header_opt = ! empty( $finix_opt['header_type'] ) ? $finix_opt['header_type'] : '';
		}

		if ( $header_opt == '1' ) {
			get_template_part( 'template-parts/header/header', 'one' );
		} elseif ( $header_opt == '2' ) {
			get_template_part( 'template-parts/header/header', 'two' );
		} elseif ( $header_opt == '3' ) {
			get_template_part( 'template-parts/header/header', 'three' );
		} else {
			get_template_part( 'template-parts/header/header', 'one' );
		}
	}
	?>
		 
	<?php
	$page_header = function_exists( 'get_field' ) ? get_field( 'pageheader_nav' ) : 'enable';
	$page_header = isset( $page_header ) ? $page_header : 'enable';
	if ( $page_header == 'enable' ) {
		finix_page_header();
	}
	?>

	<div class="site-content-contain">
		<div id="content" class="site-content">
