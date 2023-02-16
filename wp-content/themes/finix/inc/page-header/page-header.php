<?php
/**
 * Page Header
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

function finix_page_header(){
    $finix_opt = get_option('finix_redux');
    if(!is_front_page()) {
            if( class_exists( 'ReduxFramework' ) ){
                
                ?>
                <div class="page-header">
                <?php
                $page_header = function_exists( 'get_field' ) ? get_field( 'page_header_style' ) : '';
                if( !empty($page_header) && $page_header != 'default' ) {
                    $opt = $page_header;
                }
                else{
                    $opt = !empty($finix_opt['page_header_type']) ? $finix_opt['page_header_type'] : '';
                }
                
                if($opt == "1")
                { 
                    require_once get_template_directory() . '/inc/page-header/page-header-one.php';
                }
                else if($opt == "2")
                {
                    require_once get_template_directory() . '/inc/page-header/page-header-two.php';
                }
                else if($opt == "3")
                { 
                    require_once get_template_directory() . '/inc/page-header/page-header-three.php';
                }
                else if($opt == "4")
                { 
                    require_once get_template_directory() . '/inc/page-header/page-header-four.php';
                }
                else
                {
                    require_once get_template_directory() . '/inc/page-header/page-header-one.php';
                }
                ?>
                </div>
            <?php
            }
            else{
                require_once get_template_directory() . '/inc/page-header/page-header-default.php';
            }  
    }
}
?>