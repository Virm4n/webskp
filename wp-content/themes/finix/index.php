<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Finix
 * @subpackage Finix
 * @since 1.0
 * @version 1.7
 */

get_header(); 
$finix_opt = get_option('finix_redux');
$blog_type = !empty($finix_opt['blog_type']) ? $finix_opt['blog_type'] : '1';
if(is_front_page()){ 
    require_once get_template_directory() . '/inc/index.php';
}
?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <div class="container">
				<div class="row">

                    <?php
                    if ( class_exists( 'ReduxFramework' ) ) {
                        $opt= $finix_opt['blog_sidebar_opt'];
                        if($opt == 1)
                        {
                            if ( ! is_active_sidebar('sidebar-1') ) { ?>
                                <div class="col-lg-12 col-md-12">
                            <?php } else { ?>
                                <div class="col-xl-9 col-lg-8 blog-content-area">
                            <?php } 
                        }
                        else if($opt == 2)
                        {
                            if ( ! is_active_sidebar('sidebar-1') ) { ?>
                                <div class="col-lg-12 col-md-12">
                            <?php } else { ?>
                                <div class="col-xl-9 col-lg-8 blog-content-area order-lg-2">
                            <?php } 
                        } 
                        else if($opt == 3)
                        {
                            ?>
                                <div class="col-lg-12 col-md-12">
                            <?php  
                        }
                    }
                    else{ 
                        if ( ! is_active_sidebar('sidebar-1') ) { ?>
                            <div class="col-lg-12 col-md-12">
                        <?php } else { ?>
                            <div class="col-xl-9 col-lg-8 blog-content-area">
                        <?php } 
                    } ?>

                    <?php
                    if ( have_posts() ) :

                        if ( $blog_type == '1' ) {
                            ?>
                            <div class="blog-layout-classic">
                            <?php
                            /* Start the Loop */
                            while ( have_posts() ) :
                            the_post();
    
                                get_template_part( 'template-parts/post/content', get_post_format());
    
                            endwhile;
                            ?>
                            </div>
                            <?php
                        }
                        elseif ( $blog_type == '2' ) { 
    
                            get_template_part( 'template-parts/post/content-grid', get_post_format());

                                
                        }
                        elseif ( $blog_type == '3' ) {
                                           
                            get_template_part( 'template-parts/post/content-list' );
                               
                        }
                        else
                        {
                            ?>
                            <div class="blog-layout-classic">
                            <?php
                            /* Start the Loop */
                            while ( have_posts() ) :
                            the_post();
    
                                get_template_part( 'template-parts/post/content', get_post_format());
    
                            endwhile;
                            ?>
                            </div>
                            <?php
                        }

                        if( class_exists( 'ReduxFramework' ) ){
                            $finix_opt = get_option('finix_redux');
                            $optpag= $finix_opt['opt-pagination'];
                            if($optpag == "on") { 
                                finix_pagination();
                            }
                        }
                        else{
                            finix_pagination();
                        }

                    else :

                        get_template_part( 'template-parts/post/content', 'none' );

                    endif;
                    ?>

                    </div>
                    <?php
                    if ( class_exists( 'ReduxFramework' ) ) {
                        $opt= $finix_opt['blog_sidebar_opt'];
                        if($opt == 1 || $opt == 2)
                        {
                        if ( is_active_sidebar('sidebar-1') ) { ?>		
                        <div class="col-xl-3 col-lg-4 blog-sidebar sidebar">
                            <?php get_sidebar(); ?>
                        </div>
                        <?php }
                        }
                        else if($opt == 3){ }
                    } 
                    else{
                        if ( is_active_sidebar('sidebar-1') ) { ?>		
                        <div class="col-xl-3 col-lg-4 blog-sidebar sidebar">
                            <?php get_sidebar(); ?>
                        </div>
                        <?php }
                    } ?>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->
<?php
get_footer();
