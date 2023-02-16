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
?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container">
				<div class="row">
                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post();

                        get_template_part( 'template-parts/post/content', 'team' );
                        
                    endwhile; // End of the loop.
                    wp_reset_postdata();                     
                    ?>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->
<?php
get_footer();
