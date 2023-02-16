<?php
/**
 * Topbar Menu
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

if ( has_nav_menu( 'topbar' ) ) : ?>
        <?php wp_nav_menu( array(
        'theme_location' => 'topbar',
        'menu_class'     => 'nav topbar-nav',
        'menu_id'        => 'top-menu',
        'container_id'   => 'topbar-menu',
        ) ); ?>
<?php endif; ?>