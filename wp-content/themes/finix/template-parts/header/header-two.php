<?php
/**
 * Displays header two
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

$finix_opt = get_option( 'finix_redux' ); 
$opt= $finix_opt['header_sticky'];
if($opt == "on"){ $header_sticky = esc_html__('sticky-on','finix'); }
$submenu_color = ! empty( $finix_opt['submenu-color'] ) ? $finix_opt['submenu-color'] : 'submenu-light';
$header_topbar_mobile = ! empty( $finix_opt['header_topbar_mobile'] ) ? $finix_opt['header_topbar_mobile'] : 'topbar-mobile-on';
?>
<!-- Header Classic -->
 <header id="site-header" class="site-header header-loading header-classic <?php if(!empty($header_sticky)) { echo esc_attr($header_sticky); } ?> <?php if ( ! empty( $submenu_color ) ) { echo esc_attr( $submenu_color ); } ?> <?php  if ( ! empty( $header_topbar_mobile ) ) { echo esc_attr( $header_topbar_mobile ); } ?>">
    
    <?php get_template_part('template-parts/header/top-bar'); ?>

    <div class="header-main">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12">
           <div class="header-inner">

           <?php get_template_part('template-parts/header/header-logo'); ?>
           
            <div class="header-info">

              <?php 
              if(!empty($finix_opt['site_phone']))
              {
              ?>
              <div class="feature-box info-call icon-left">
                 <div class="feature-icon"><i class="ti ti-headphone-alt"></i></div>
                 <div class="feature-info">
                    <h4 class="title mb-0"><?php echo esc_html__('Contact Number', 'finix'); ?></h4>
                    <p><a href="tel:<?php echo str_replace(str_split('(),-" '), '',$finix_opt['site_phone']); ?>"><?php echo esc_html($finix_opt['site_phone']); ?></a></p>
                 </div>
              </div>
              <?php } ?>

              <?php 
              if(!empty($finix_opt['site_email']))
              {
              ?>
              <div class="feature-box icon-left">
                 <div class="feature-icon"><i class="ti ti-email"></i></div>
                 <div class="feature-info">
                    <h4 class="title mb-0"><?php echo esc_html__('Our Emails', 'finix'); ?></h4>
                    <p><a href="mailto:<?php echo esc_html($finix_opt['site_email']); ?>"><?php echo esc_html($finix_opt['site_email']); ?></a></p>
                 </div>
              </div>
              <?php } ?>

              <?php 
              if(!empty($finix_opt['site_location']))
              {
              ?>
              <div class="feature-box icon-left">
                 <div class="feature-icon"><i class="ti ti-location-pin"></i></div>
                 <div class="feature-info">
                    <h4 class="title mb-0"><?php echo esc_html__('Our Location', 'finix'); ?></h4>
                    <p><?php echo esc_html($finix_opt['site_location']); ?></p>
                 </div>
              </div>
              <?php } ?>

            </div>

            <div class="main-navigation <?php	if ( ! empty( $submenu_color ) ) { echo esc_attr( $submenu_color ); } ?>">
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
  <div class="header-bottom">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="navigation-inner">
              <div class="main-navigation">
                <?php if ( has_nav_menu( 'primary' ) ) : ?>
                    <?php wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'nav navbar-nav',
                    'menu_id'        => 'bottom-menu',
                    'container_id'   => 'bottom-primary-menu',
                    ) ); ?>
                <?php endif; ?>
              </div>

              <div class="search-button">
                <?php get_template_part('template-parts/header/header-search'); ?>
                <?php get_template_part('template-parts/header/header-cart'); ?>
                <?php get_template_part('template-parts/header/header-slide'); ?>
                <?php get_template_part('template-parts/header/header-button'); ?>
              </div>

            </div>
          </div>
        </div>
      </div>
  </div>
  </header>
  <!-- End : Header Classic -->