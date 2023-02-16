<?php
/**
 * Finix Maintenance
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.5.0
 */

function finix_maintenace() { 
	$finix_opt = get_option('finix_redux');
	if(isset($finix_opt['maintenance_opt']))
	{ 
		$opt = $finix_opt['maintenance_opt'];
		if($opt == "on")
		{  			
			if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) { 
				
				require_once get_template_directory() . '/template-parts/maintenance/maintenance.php';

				die;
			}
		}
	}
}
add_action('get_header', 'finix_maintenace');
?>