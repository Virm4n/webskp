<?php
/**
 * The maintance for our theme
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

$finix_opt = get_option('finix_redux'); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<!-- Favicon -->
<?php
if ( ! function_exists( 'has_site_icon' ) || ! wp_site_icon() ) {
	if( !empty($finix_opt['site_favicon_icon']['url']) ) { ?>
		<link rel="favicon icon" href="<?php echo esc_url($finix_opt['site_favicon_icon']['url']); ?>" />
	<?php 
	}
	else {
	?>
		<link rel="favicon icon" href="<?php echo esc_url(get_template_directory_uri().'/assets/images/favicon.ico'); ?>" />
	<?php 
	}
}
?>

<?php wp_head(); ?>

</head>

<?php
$maint_mode = $finix_opt['maintenance_type'];

if ( '2' === $maint_mode ) {
$coming_title  =!empty($finix_opt['coming_title']) ?  $finix_opt['coming_title'] : esc_html__( 'Coming Soon', 'finix' );
$coming_desc = !empty($finix_opt['coming_desc']) ? $finix_opt['coming_desc'] : esc_html__('Get Notified when our website is ready.', 'finix' );
} 
else {
$mainte_title  =!empty($finix_opt['mainte_title']) ?  $finix_opt['mainte_title'] : esc_html__( 'We are Under Construction mode.', 'finix' );
$mainte_sub_title = !empty($finix_opt['mainte_sub_title']) ? $finix_opt['mainte_sub_title'] : esc_html__( 'Get Notified when our website is ready.', 'finix' );
}
?>

<body <?php body_class(); ?>>

<?php
$opt = $finix_opt['theme-cursor'];
if ( $opt == 'on' ) {
	?>
<div id="theme-cursor">
	<div class="mouse-cursor cursor-outer"></div>
	<div class="mouse-cursor cursor-inner"></div>
</div>
<!-- Theme Cursor -->
<?php } ?>

<?php wp_body_open(); ?>

<div id="page" class="site header-default">	
	<div class="site-content-contain">
		<div id="content" class="site-content">

			<?php if ( '2' === $maint_mode ) { ?>
			<div class="coming-soon-main">
					<div class="container h-100">
						<div class="row h-100 align-items-center">
							<div class="col-lg-10">
								<?php get_template_part('template-parts/maintenance/logo'); ?>
								<h2 class="title title-coming-soon"><?php echo esc_html($coming_title) ?><span class="coming-soon-inner"><?php echo esc_html($coming_title) ?></span></h2>
								<?php
									if(!empty($finix_opt['coming_date']))
									{
									$date = $finix_opt['coming_date'];
									$date = date_create_from_format('m/d/Y', $date);
									$date = $date->format( 'Y/m/d' );
									?>
									<div class="countdown-soon" data-countdown="<?php echo esc_attr($date);?>"></div>
								<?php } ?>
								<p class="description"><?php echo esc_html($coming_desc) ?></p>
								<?php get_template_part('template-parts/maintenance/newsletter'); ?>
								<?php get_template_part('template-parts/maintenance/social-media'); ?>
						</div>
					</div>
				</div>
			</div>
			<?php }
			else{ ?>
			<div class="maintance-main">
					<div class="container h-100">
						<div class="row h-100 align-items-center">
							<div class="col-lg-7">
								<?php get_template_part('template-parts/maintenance/logo'); ?>
								<h2 class="title title-maintance"><?php echo esc_html($mainte_title) ?></h2>
								<p class="description"><?php echo esc_html($mainte_sub_title) ?></p>
								<?php get_template_part('template-parts/maintenance/newsletter'); ?>
								<?php get_template_part('template-parts/maintenance/social-media'); ?>

						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div><!-- #content -->
    </div><!-- .site-content-contain -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>


			
