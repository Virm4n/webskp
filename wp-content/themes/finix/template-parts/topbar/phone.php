<?php
/**
 * Topbar Phone
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

$finix_opt = get_option( 'finix_redux' ); 
if(!empty($finix_opt['site_phone']))
{
?>
<a class="header-call" href="tel:<?php echo str_replace(str_split('(),-" '), '',$finix_opt['site_phone']); ?>">
    <i class="ti ti-headphone-alt"></i>
    <?php echo esc_html($finix_opt['site_phone']); ?>
</a>
<?php } ?>