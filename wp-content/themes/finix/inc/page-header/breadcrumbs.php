<?php
/**
 * Page Header Breadcrumb
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

function get_breadcrumb() {

    $showCurrent = 1;

    $homeLink = esc_html(home_url());

    if (is_front_page()) { 
        echo '<li><a href="'.home_url().'" rel="nofollow"><i class="fa fa-home"></i>Home</a></li>';
    }
    else 
    { 
        echo '<li><a href="'.home_url().'" rel="nofollow"><i class="fa fa-home"></i>Home</a></li>';
        if( is_home()){ 
            echo  '<li><span>'.esc_html__('Blogs', 'finix').'</span></li>';
         }
         elseif ( get_post_type() == 'product' ) {
            echo  '<li><span>'.esc_html__('Shop', 'finix').'</span></li>';
         }
        elseif ( is_single() && !is_attachment() ) { 
            if ( get_post_type() != 'post' ) {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<li><span><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></span></li>';
            if ($showCurrent == 1) echo '<li><span>'. get_the_title().'</span></li>';
            } else {
            $cat = get_the_category(); $cat = $cat[0];
            
            if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s\s$#", "$1", $cats);
            echo '<li><span>'.get_category_parents($cat, TRUE, '  ').'</span></li>';
            if ($showCurrent == 1) echo  '<li><span class="current-page">'.get_the_title().'</span></li>';
            }
        } 
        elseif (is_page()) {
            echo '<li><span class="current-page">';
            echo the_title();
            echo '</span></li>';
        } 
        elseif (is_search()) {
            echo  '<li><span>'.esc_html__('Search results for : ', 'finix').'' . get_search_query() . '</span></li>';
        }
        elseif ( is_404() ) {
            echo  '<li><span>'.esc_html__('Error 404', 'finix').'</span></li>';
          }
    }
}
?>