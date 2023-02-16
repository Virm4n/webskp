<?php
/**
 * Displays footer widgets if assigned
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

if ( is_active_sidebar( 'sidebar-two' ) ||
is_active_sidebar( 'sidebar-3' ) ||
is_active_sidebar( 'sidebar-4' ) ||
is_active_sidebar( 'sidebar-5' ) ||
is_active_sidebar( 'sidebar-6' ) ) :
?>
<div class="footer-main">
	<div class="container">
		<div class="row">
			<?php
			if ( is_active_sidebar( 'sidebar-two' ) ) {
				?>
				<div class="col-lg-3 col-md-6 widget-column">
					<?php dynamic_sidebar( 'sidebar-two' ); ?>
				</div>
				<?php
			}
			if ( is_active_sidebar( 'sidebar-3' ) ) {
				?>
				<div class="col-lg-3 col-md-6 widget-column">
					<?php dynamic_sidebar( 'sidebar-3' ); ?>
				</div>
			<?php }
			if ( is_active_sidebar( 'sidebar-4' ) ) {
				?>
				<div class="col-lg-3 col-md-6 widget-column">
					<?php dynamic_sidebar( 'sidebar-4' ); ?>
				</div>
			<?php }
			if ( is_active_sidebar( 'sidebar-5' ) ) {
				?>
				<div class="col-lg-3 col-md-6 widget-column">
					<?php dynamic_sidebar( 'sidebar-5' ); ?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php endif; ?>
