<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

$finix_opt = get_option( 'finix_redux' );
$footer_nav = function_exists( 'get_field' ) ? get_field( 'footer_nav' ) : 'enable';
$footer_nav = isset($footer_nav) ? $footer_nav : 'enable';
?>

		</div><!-- #content -->
	</div><!-- .site-content-contain -->

	<?php if ( $footer_nav == 'enable' ) { ?>
		<footer class="site-footer">
			<?php
				if( class_exists( 'ReduxFramework' ) ){
					$opt= $finix_opt['display_footer'];
					if($opt == "on") { 
						get_template_part( 'template-parts/footer/footer', 'widgets' );
					}
					$copy_opt= $finix_opt['display_copyright'];
					if($copy_opt == "on") { 
						get_template_part( 'template-parts/footer/site', 'info' );
					}
				}
				else{

					get_template_part( 'template-parts/footer/default', 'widgets' );
					
					get_template_part( 'template-parts/footer/site', 'info' );
				}
			?>
		</footer>
			<?php } ?>
</div><!-- #page -->

<?php 
if ( class_exists( 'ReduxFramework' ) ) {
	$opt= $finix_opt['back-to-top'];
	if($opt == "on") { ?>
	<div id="back-to-top">
		<a class="top arrow" href="#top"><i class="ti ti-arrow-up"></i></a>
	</div>
	<!-- Back to Top -->
	<?php }
}
else { ?>
	<div id="back-to-top">
		<a class="top arrow" href="#top"><i class="ti ti-arrow-up"></i></a>
	</div>
	<!-- Back to Top -->
<?php } ?>

<?php
if ( class_exists( 'ReduxFramework' ) ) {
	$opt= $finix_opt['mobile_click_setting'];
	if($opt == "on") { ?>
		<audio id="click-audio" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/click.mp3' ); ?>" preload="auto"></audio>
	<!-- Back to Top -->
	<?php }
} ?>

<?php get_template_part('template-parts/footer/footer-mobile'); ?>

<?php get_template_part('template-parts/footer/footer-search'); ?>

<?php get_template_part('template-parts/footer/footer-slide'); ?>

<?php wp_footer(); ?>
</body>
</html>
