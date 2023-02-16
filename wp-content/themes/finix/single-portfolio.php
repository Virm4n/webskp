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
					<div class="col-sm-12">
						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

								the_content();

								if ( is_singular( 'portfolio' ) ) {
									// Previous/next post navigation.
									$next_post = get_next_post();
    								$previous_post = get_previous_post();
									the_post_navigation( array(
										'next_text' => '<div class="next-info"><span class="nav-text" aria-hidden="true">' . __( 'Next', 'finix' ) . '</span> ' .
											'<span class="screen-reader-text">' . __( 'Next post:', 'finix' ) . '</span> ' .
											'<h4 class="post-title">%title</h4></div>' . get_the_post_thumbnail($next_post,'thumbnail'),
							
										'prev_text' => get_the_post_thumbnail($previous_post,'thumbnail') . '<div class="prev-info"><span class="nav-text" aria-hidden="true">' . __( 'Previous', 'finix' ) . '</span> ' .
											'<span class="screen-reader-text">' . __( 'Previous post:', 'finix' ) . '</span> '.
											'<h4 class="post-title">%title</h4></div>',
									) );
								}

								// Recent Portfolio.
								finix_recent_portfolio();
							
						endwhile; // End of the loop.
						wp_reset_postdata();
						?>
					</div>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->
<?php
get_footer();
