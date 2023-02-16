<?php
/**
 * Topbar Text
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

$finix_opt = get_option( 'finix_redux' ); 
if(!empty($finix_opt['online_order_text']))
{
?>
<div class="header-text">
<?php echo esc_html($finix_opt['online_order_text']); ?>
</div>
<?php } ?>