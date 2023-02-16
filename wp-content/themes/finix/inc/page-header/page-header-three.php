<?php
/**
 * Page Header Three
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

$finix_opt = get_option('finix_redux'); 
$ph_three_alignment = function_exists( 'get_field' ) ? get_field( 'ph_three_alignment' ) : '';
if( !empty($ph_three_alignment) && $ph_three_alignment != 'default' ) {
    $opt = $ph_three_alignment;
}
else{
    $opt = !empty($finix_opt['pg_three_align']) ? $finix_opt['pg_three_align'] : '';
}
if($opt == "1")
{
?>
<div class="page-header-inner page-header-3 breadcrumb-left">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-lg-2">
                <?php page_header_title(); ?>
            </div>
            <?php
                if(isset($finix_opt['breadcrumbs']))
                {
                $opt = $finix_opt['breadcrumbs'];
                if($opt == "on")
                {
                ?>
                <div class="col-lg-6 order-lg-1">
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
</div>
<?php
}
if($opt == "2")
{
?>
<div class="page-header-inner page-header-3 breadcrumb-right">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <?php page_header_title(); ?>
            </div>
            <?php
            if(isset($finix_opt['breadcrumbs']))
            {
            $opt = $finix_opt['breadcrumbs'];
            if($opt == "on")
            {
            ?>
            <div class="col-lg-6">
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
</div>
<?php } ?>