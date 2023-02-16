<?php
/**
 * Displays header sidemenu
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

$finix_opt = get_option( 'finix_redux' ); 
if ( class_exists( 'ReduxFramework' ) ) {
$opt= $finix_opt['back-to-top'];
    if($opt == "on"){
        if(isset($finix_opt['mobile_ui_setting']))
        {
            $opt = $finix_opt['mobile_ui_setting'];
            if($opt == "mobile-back-top-ui")
            {
        ?>
        <div class="bottom-navbar">
            <div class="mobile-navbar-bg"></div>
            <div class="navbar-trigger">+</div>

            <div class="navbar-inner">
              <div class="navbar-icon"><a href="<?php  echo esc_url( home_url( '/' ) ); ?>"> <i class="ti ti-home"></i></a><span>Home</span></div>
              <div class="navbar-icon"><div id="mobile-search"><i class="ti ti-search"></i></div><span>Search</span></div>
              <div class="navbar-icon"><div id="mobile-go-top"><i class="ti ti-arrow-up"></i></div><span>Top</span></div>
            </div>
        </div>
        <?php
            }
        }
    }
} 
?>