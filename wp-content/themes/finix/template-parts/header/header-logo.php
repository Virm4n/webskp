<?php 
/**
 * Displays header site branding
 *
 * @package Finix
 * @subpackage finix
 * @since finix 1.0
 * @version 1.7
 */

$finix_opt = get_option( 'finix_redux' );
if ( class_exists( 'ReduxFramework' ) ) { ?>
<div class="header-logo">
    <?php if($finix_opt['site_logo_type'] == 1)
    {
    ?>
        <a href="<?php  echo esc_url( home_url( '/' ) ); ?>">
        <?php
        if(!empty($finix_opt['logo_text']))
        {
        ?>
        <h1 class="site-logo-text"><?php echo esc_html($finix_opt['logo_text']); ?></h1>
        <?php
        }
        ?>
        </a>
    <?php
    }
    else if($finix_opt['site_logo_type'] == 2){
    ?>
        <?php
        if(isset($finix_opt['site_logo']['url']))
        {
            $logo = $finix_opt['site_logo']['url'];
        ?>
        <a class="site-logo" href="<?php  echo esc_url( home_url( '/' ) ); ?>">
            <img src="<?php echo esc_url($logo); ?>" class="img-fluid" alt="<?php  esc_attr_e( 'finix', 'finix' ); ?>">
        </a>
        <?php } ?>
        <?php
        if(isset($finix_opt['site_sticky_logo']['url']))
        {
            $sticky_logo = $finix_opt['site_sticky_logo']['url'];
        ?>
        <a class="sticky-site-logo" href="<?php  echo esc_url( home_url( '/' ) ); ?>">
            <img src="<?php echo esc_url($sticky_logo); ?>" class="img-fluid" alt="<?php  esc_attr_e( 'finix', 'finix' ); ?>">
        </a>
        <?php } ?>
    <?php }
    else{ ?>
        <a class="site-logo" href="<?php  echo esc_url( home_url( '/' ) ); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" class="img-fluid" alt="<?php  esc_attr_e( 'finix', 'finix' ); ?>" />
        </a>
        <a class="sticky-site-logo" href="<?php  echo esc_url( home_url( '/' ) ); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" class="img-fluid" alt="<?php  esc_attr_e( 'finix', 'finix' ); ?>">
        </a>
    <?php } ?>

    <?php
    $opt = $finix_opt['site_description'];
    if($opt == "1")
    {
    $description = get_bloginfo( 'description', 'display' );
    if ( $description || is_customize_preview() ) :
        ?>
        <p class="site-description"><?php echo esc_html($description); ?></p>
    <?php endif; 
    }
    ?>
</div>
<?php }
else { ?>
<div class="header-logo">
        <a class="site-logo" href="<?php  echo esc_url( home_url( '/' ) ); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" class="img-fluid" alt="<?php  esc_attr_e( 'finix', 'finix' ); ?>" />
        </a>
        <a class="sticky-site-logo" href="<?php  echo esc_url( home_url( '/' ) ); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" class="img-fluid" alt="<?php  esc_attr_e( 'finix', 'finix' ); ?>">
        </a>
</div>
<?php } ?>