<?php
/**
 * Displays footer site info
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

$finix_opt = get_option('finix_redux');
?>
<div class="site-info">
	<div class="container">
		<div class="copyright-info">
			<div class="row">
			<?php if( class_exists( 'ReduxFramework' ) ){ ?>
				<div class="col-sm-6 text-left">
					<?php
					if(isset($finix_opt['copyright_left'])) {  
						echo do_shortcode($finix_opt['copyright_left']); 
					}
					?>
				</div>
				<div class="col-sm-6 text-right">
					<?php
					if(isset($finix_opt['copyright_right'])) {  
						echo do_shortcode($finix_opt['copyright_right']); 
					}
					?>
				</div>
			<?php } 
			else {	
				?>
				<div class="col-sm-12">
				<?php
				if ( function_exists( 'the_privacy_policy_link' ) ) {
					the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
				}
				?>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'finix' ) ); ?>" class="imprint">
					<?php printf( esc_html__( 'Proudly powered by %s', 'finix' ), 'WordPress' ); ?>
				</a>
				</div>
				<?php
			} ?>
			</div>
		</div>
	</div>
</div><!-- .site-info -->
