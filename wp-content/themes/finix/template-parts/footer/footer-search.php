<?php
/**
 * Displays footer search
 *
 * @package Finix
 * @subpackage Finix
 * @since finix 1.0
 * @version 1.7
 */

$finix_opt = get_option( 'finix_redux' ); 

if(isset($finix_opt['header_search']))
{
    $opt = $finix_opt['header_search'];
    if($opt == "on")
    {
    ?>
       
    <div class="search-main">
        <div class="search-close"><i class="ti ti-close"></i></div>
        <div class="search-main-form">
            <span class="search-label">Search here...</span>
            <?php get_search_form(); ?>
        </div>
    </div>
    
    <?php
    }
} ?>