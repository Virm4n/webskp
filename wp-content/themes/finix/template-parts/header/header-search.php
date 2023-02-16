<?php
/**
 * Header Search
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

$finix_opt = get_option( 'finix_redux' ); 

if(isset($finix_opt['header_search']))
{
    $opt = $finix_opt['header_search'];
    if($opt == "on")
    {
    ?>
    <div class="header-search">
        <div class="search-btn"><i class="fa fa-search"></i></div>
    </div>
        
    <?php
    }
} ?>