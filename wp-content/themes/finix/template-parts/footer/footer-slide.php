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

if(isset($finix_opt['header_sidemenu']))
{
    $opt = $finix_opt['header_sidemenu'];
    if($opt == "on")
    {
?>
<div class="sidemenu-main">
	<div class="sidemenu-overlay"></div>
	<div class="sidemenu">
		<div class="sidemenu-close"><i class="ti ti-close"></i></div>
		<div class="sidemenu-inner">
			<?php dynamic_sidebar( 'header_sidemenu' ); ?>
		</div>
	</div>
</div>
<?php
    }
} ?>