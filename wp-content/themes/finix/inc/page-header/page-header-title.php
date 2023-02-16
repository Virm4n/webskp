<?php
/**
 * Page Header Title
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

function page_header_title() {
    if ( class_exists( 'WooCommerce' ) ) {
        if(is_shop()){
        ?>
        <h1 class="page-title"><?php esc_html_e( 'Shop', 'finix' ); ?></h1>
        <?php  
        }
    }
    if(is_archive()){
    ?>
    <h1 class="page-title"><?php the_archive_title();  ?></h1>
    <?php
    }
    elseif(is_search()){
    if ( have_posts() ) : ?>
    <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'finix' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

    <?php else : ?>
    <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'finix' ); ?></h1>

    <?php endif;
    } 
    elseif(is_404()){
    ?>
    <h1 class="page-title"><?php esc_html_e( 'Error 404', 'finix' ); ?></h1>
    <?php 
    } 
    elseif(is_home()){ ?>
    <h1 class="page-title"><?php esc_html_e( 'Blog', 'finix' ); ?></h1>
    <?php }
    else { ?>
            <h1 class="page-title"><?php single_post_title(); ?></h1>
    <?php } 
    
} ?>