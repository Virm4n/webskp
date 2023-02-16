<?php
/**
 * Displays header one
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

$finix_opt = get_option('finix_redux');
if ( class_exists( 'ReduxFramework' ) ) {
	$opt= $finix_opt['header_sticky'];
	if($opt == "on"){ $header_sticky = esc_html__('sticky-on','finix'); }
}
$submenu_color = ! empty( $finix_opt['submenu-color'] ) ? $finix_opt['submenu-color'] : 'submenu-light';
$header_topbar_mobile = ! empty( $finix_opt['header_topbar_mobile'] ) ? $finix_opt['header_topbar_mobile'] : 'topbar-mobile-on';
?>
<!-- Header Default -->
<header id="site-header" class="site-header header-loading header-default <?php if(!empty($header_sticky)) { echo esc_attr($header_sticky); } ?> <?php	if ( ! empty( $submenu_color ) ) { echo esc_attr( $submenu_color ); } ?> <?php	if ( ! empty( $header_topbar_mobile ) ) { echo esc_attr( $header_topbar_mobile ); } ?>">

	<?php get_template_part('template-parts/header/top-bar'); ?>

	<div class="header-main">
		<div class="container">
			<div class="row">
			<div class="col-12">
				<div class="header-inner">

					<?php get_template_part('template-parts/header/header-logo'); ?>

					<div class="main-navigation">
						<?php if ( has_nav_menu( 'primary' ) ) : ?>
								<?php wp_nav_menu( array(
								'theme_location' => 'primary',
								'menu_class'     => 'nav navbar-nav',
								'menu_id'        => 'menu',
								'container_id'   => 'primary-menu',
								) ); ?>
						<?php endif; ?>
					</div>
					
					<?php get_template_part('template-parts/header/header-search'); ?>
					<?php get_template_part('template-parts/header/header-cart'); ?>
					<?php get_template_part('template-parts/header/header-slide'); ?>
					<?php get_template_part('template-parts/header/header-button'); ?>
					<div id="slicknav_menu"></div>

				</div>
			</div>
			</div>
		</div>
	</div>
</header>
<!-- End : Header Default -->