<?php
/**
 * Displays maintenance logo
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

 $finix_opt = get_option( 'finix_redux' ); 
if($finix_opt['maintenance_logo_type'] == 1)
{ 
    get_template_part('template-parts/header/header-logo');
}
if($finix_opt['maintenance_logo_type'] == 2)
{ 
    if(isset($finix_opt['maintenance_logo']['url']))
    {
        $mant_logo = $finix_opt['maintenance_logo']['url'];
    ?>
    <div class="header-logo"><img src="<?php echo esc_url($mant_logo); ?>" class="img-fluid logo" alt="<?php  esc_attr_e( 'finix', 'finix' ); ?>" /></div>
    <?php } 
} ?>