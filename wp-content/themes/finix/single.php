<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

get_header();
$finix_opt = get_option('finix_redux');
?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container">
				<div class="row">

				<?php
                    if ( class_exists( 'ReduxFramework' ) ) {
                        $opt= $finix_opt['single_sidebar_opt'];
                        if($opt == 1)
                        {
                            if ( ! is_active_sidebar('sidebar-1') ) { ?>
                                <div class="col-md-12 col-sm-12">
                            <?php } else { ?>
                                <div class="col-xl-9 col-lg-8 blog-content-area">
                            <?php } 
                        }
                        else if($opt == 2)
                        {
                            if ( ! is_active_sidebar('sidebar-1') ) { ?>
                                <div class="col-md-12 col-sm-12">
                            <?php } else { ?>
                                <div class="col-xl-9 col-lg-8 blog-content-area order-lg-2">
                            <?php } 
                        } 
                        else if($opt == 3)
                        {
                            ?>
                                <div class="col-md-12 col-sm-12">
                            <?php  
                        }
                    } else{ 
                            if ( ! is_active_sidebar('sidebar-1') ) { ?>
                                <div class="col-md-12 col-sm-12">
                            <?php } else { ?>
                                <div class="col-xl-9 col-lg-8 blog-content-area">
                            <?php } 
                    } 
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

                            get_template_part( 'template-parts/post/content', get_post_format() );
                            
                            // Recent Post.
                            finix_recent_post();

                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;

						endwhile; // End of the loop.
                        wp_reset_postdata();                     
                        ?>

					</div>

					<?php
                    if ( class_exists( 'ReduxFramework' ) ) {
                        $opt= $finix_opt['single_sidebar_opt'];
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
