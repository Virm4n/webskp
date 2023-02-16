<?php
/**
 * Page Header Two
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

?>
<div class="page-header-inner page-header-2">
    <div class="container">

            <div class="header2-inner">
                <?php page_header_title(); ?>
            <?php
            if(isset($finix_opt['breadcrumbs']))
            {
            $opt = $finix_opt['breadcrumbs'];
            if($opt == "on")
            {
            ?>

                <div class="breadcrumb">
                    <ul>
                        <?php get_breadcrumb(); ?>
                    </ul>
                </div>
            </div>
            <?php }
            } ?>
        
    </div>
</div>