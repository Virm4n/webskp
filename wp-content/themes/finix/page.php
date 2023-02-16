<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="container">
			<div class="row">
				<?php
				if ( class_exists( 'ReduxFramework' ) ) {
					$opt= $finix_opt['page_sidebar']; 
					if($opt == 1)
					{
						if ( ! is_active_sidebar('sidebar-1') ) { ?>
							<div class="col-md-12 col-sm-12">
						<?php } else { ?>
							<div class="col-xl-9 col-lg-8">
						<?php } 
					}
					else if($opt == 2)
					{
						if ( ! is_active_sidebar('sidebar-1') ) { ?>
							<div class="col-md-12 col-sm-12">
						<?php } else { ?>
							<div class="col-xl-9 col-lg-8 order-xl-2">
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
						<div class="col-xl-9 col-lg-8">
					<?php } 
				} ?>

				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/page/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
				</div>
				<?php
				if ( class_exists( 'ReduxFramework' ) ) {
					$opt= $finix_opt['page_sidebar']; 
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
<?php
get_footer();
