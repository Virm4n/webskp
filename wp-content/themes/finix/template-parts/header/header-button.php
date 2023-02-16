<?php
/**
 * Displays header button
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

$finix_opt = get_option( 'finix_redux' );

if ( isset( $finix_opt['header_button'] ) ) {
	$opt = $finix_opt['header_button'];
	if ( $opt == 'on' ) {
		if ( ( ! empty( $finix_opt['button_title'] ) ) && ( ! empty( $finix_opt['button_link'] ) ) ) {
			$title = $finix_opt['button_title'];
			$link  = $finix_opt['button_link'];
			?>
		<div class="header-button">
			<?php
			$btn_sty = ! empty( $finix_opt['button_style'] ) ? $finix_opt['button_style'] : 'button-flat';
			$btn_color = ! empty( $finix_opt['button_color'] ) ? $finix_opt['button_color'] : 'button-dark';
			$btn_shap = ! empty( $finix_opt['button_shap'] ) ? $finix_opt['button_shap'] : 'button-square';
			?>
			<a class="header-link <?php	if ( ! empty( $btn_sty ) ) {echo esc_attr( $btn_sty ); } ?> <?php if ( ! empty( $btn_color ) ) {echo esc_attr( $btn_color ); } ?> <?php if ( ! empty( $btn_shap ) ) {echo esc_attr( $btn_shap ); } ?>" href="<?php echo esc_url( $link, 'finix' ); ?>"><span><?php echo esc_html( $title, 'finix' ); ?></span></a>
		</div>
		<?php }
	}
} ?>