<?php 
/**
 * Header top
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

if ( class_exists( 'ReduxFramework' ) ) {
    $finix_opt = get_option( 'finix_redux' );
    $opt= $finix_opt['header_top'];
    if($opt == "on")
    { ?>
    <div class="header-topbar">
        <div class="container">
            <div class="row">
                <?php if(!empty($finix_opt['header-top-blocks']['Left']))
                {
                ?>
                <div class="col-md-6 topbar-left text-center text-md-left">
                <?php
                $layout = $finix_opt['header-top-blocks']['Left'];
                if ($layout): foreach ($layout as $key=>$value) {

                switch($key) {

                case 'email': get_template_part( 'template-parts/topbar/email', 'email' );
                break;

                case 'phone': get_template_part( 'template-parts/topbar/phone', 'phone' );
                break;

                case 'text': get_template_part( 'template-parts/topbar/text', 'text' );
                break;

                case 'social-media': get_template_part( 'template-parts/topbar/social-media', 'social-media' );    
                break; 

                case 'topbar-menu': get_template_part( 'template-parts/topbar/topbar-menu', 'topbar-menu' );    
                break; 
                }

                }
                endif;
                        ?>
                    </div>
                    <?php
                } 
                
                if(!empty($finix_opt['header-top-blocks']['Right']))
                {
                ?>
                <div class="col-md-6 topbar-right text-center text-md-right">
                    <?php 

                        $layout2 = $finix_opt['header-top-blocks']['Right'];
                        if ($layout2): foreach ($layout2 as $key=>$value) {
    
                            switch($key) {
                        
                                case 'email': get_template_part( 'template-parts/topbar/email', 'email' );
                                break;
                        
                                case 'phone': get_template_part( 'template-parts/topbar/phone', 'phone' );
                                break;
                        
                                case 'text': get_template_part( 'template-parts/topbar/text', 'text' );
                                break;
                        
                        
                                case 'social-media': get_template_part( 'template-parts/topbar/social-media', 'social-media' );    
                                break;  
                                
                                case 'topbar-menu': get_template_part( 'template-parts/topbar/topbar-menu', 'topbar-menu' );    
                                break; 
                            }
                        }
                        endif;
                    ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php }
} ?>