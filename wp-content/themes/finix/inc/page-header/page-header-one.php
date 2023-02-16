<?php
/**
 * Page Header One
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

$finix_opt = get_option('finix_redux'); 
$ph_alignment = function_exists( 'get_field' ) ? get_field( 'ph_alignment' ) : '';
if( !empty($ph_alignment) && $ph_alignment != 'default' ) {
    $opt = $ph_alignment;
}
else{
    $opt = !empty($finix_opt['pg_one_align']) ? $finix_opt['pg_one_align'] : '';
}
if($opt == "1"){ $pg_one = esc_html__('left','finix'); } 
elseif($opt == "2"){ $pg_one = esc_html__('right','finix'); }
elseif($opt == "3"){ $pg_one = esc_html__('center','finix'); }
?>
<div class="page-header-inner page-header-1 header-<?php if(!empty($pg_one)) { echo esc_attr($pg_one); } ?>">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="header1-inner">
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
                    <?php }
                    } ?>
                </div>
            </div>                
        </div>
    </div>
</div>