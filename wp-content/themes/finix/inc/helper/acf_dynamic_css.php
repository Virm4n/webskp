<?php
/**
 * Finix ACF Dynamic
 *
 * @package Finix
 * @subpackage finix
 * @since finix 1.0
*/

function finix_acf_dynamic_css() {  
    
    $dynamic_css = '';

    $banner_text_color = get_field('banner_text_color');

    if ( !empty($banner_text_color) ) {
        $dynamic_css .= ".breadcrumb_content h1, .breadcrumb_content p { color: $banner_text_color; }";
    }

    /**
     * Page Padding controls
     */
    $page_header_padding = function_exists( 'get_field'  ) ? get_field( 'page_header_padding'  ) : '';
    // Padding top
    if ( isset($page_header_padding['padding_top']) ) {
        $dynamic_css .= "
        .page-header .page-header-inner {
                padding-top: {$page_header_padding['padding_top']}px;
            }";
    }

    // Padding bottom
    if ( isset($page_header_padding['padding_bottom']) ) {
        $dynamic_css .= "
        .page-header .page-header-inner {
            padding-bottom: {$page_header_padding['padding_bottom']}px;
        } ";
    }

    wp_add_inline_style( 'finix-responsive', $dynamic_css );
}
add_action( 'wp_enqueue_scripts', 'finix_acf_dynamic_css', 10);
?>