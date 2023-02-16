<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

get_header(); 
$finix_opt = get_option('finix_redux');
$error_title  =!empty($finix_opt['error_title']) ?  $finix_opt['error_title'] : esc_html__( '404', 'finix' );
$error_contant = !empty($finix_opt['error_contant']) ? $finix_opt['error_contant'] : esc_html__( 'Ohhh! Page Not Found', 'finix' );
$error_description = !empty($finix_opt['error_description']) ? $finix_opt['error_description'] : esc_html__("The Page You are Looking for does Not Exits.", "finix");
?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 offset-sm-2 text-center">
						<div class="error-404-main">
						<h2 class="text-404"><?php echo esc_html($error_title); ?>
							<span class="text-404 inner-text"><?php echo esc_html($error_title); ?></span>
						</h2>
						<h4 class="error-tagline"><?php echo esc_html($error_contant); ?></h4>
						<p><?php echo esc_html($error_description); ?></p>
							<?php get_search_form(); ?>
						<span class="error-text"><?php esc_html_e('Please return to', 'finix'); ?><a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Homepage', 'finix'); ?></a></span>
						</div>
					</div>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php
get_footer();
