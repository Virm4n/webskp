<?php
/**
 * Displays top navigation
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

?>
<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'finix' ); ?>">
	<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
		<?php
		echo finix_get_svg( array( 'icon' => 'bars' ) );
		echo finix_get_svg( array( 'icon' => 'close' ) );
		_e( 'Menu', 'finix' );
		?>
	</button>

	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'top',
			'menu_id'        => 'top-menu',
		)
	);
	?>

	<?php if ( ( finix_is_frontpage() || ( is_home() && is_front_page() ) ) && has_custom_header() ) : ?>
		<a href="#content" class="menu-scroll-down"><?php echo finix_get_svg( array( 'icon' => 'arrow-right' ) ); ?><span class="screen-reader-text"><?php esc_html_e( 'Scroll down to content', 'finix' ); ?></span></a>
	<?php endif; ?>
</nav><!-- #site-navigation -->
