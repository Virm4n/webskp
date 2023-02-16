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
    <div class="header-sidemenu">
        <a href="javascript: void(0)">
            <span></span>
            <span></span>
            <span></span>
        </a>
    </div>        
    <?php
    }
} ?>