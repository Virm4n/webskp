<?php
/**
 * Displays maintenance newsletter
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

$finix_opt = get_option('finix_redux');
$opt= $finix_opt['maint_newsletter'];
if($opt == "on") {
	if(isset($finix_opt['mailchimp_shortcode'])){ 
		$mailchimp_shortcode = $finix_opt['mailchimp_shortcode']; 
	}
	echo do_shortcode($mailchimp_shortcode);
}
?>