<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
						$opt= $finix_opt['archive_sidebar'];
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
							<div class="col-lg-9 col-md-8">
						<?php } 
					} ?>

					<?php
					if ( have_posts() ) :
						?>
						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/*
							* Include the Post-Format-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Format name) and that will be used instead.
							*/
							get_template_part( 'template-parts/post/content', get_post_format() );

						endwhile;

						finix_pagination();

					else :

						get_template_part( 'template-parts/post/content', 'none' );

					endif;
					?>
					</div>
					<?php
					if ( class_exists( 'ReduxFramework' ) ) {
						$opt= $finix_opt['archive_sidebar'];
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
