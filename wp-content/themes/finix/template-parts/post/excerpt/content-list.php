<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */
?>
<div class="blog-layout-list">
		<?php
		/* Start the Loop */
		while ( have_posts() ) :
		the_post();
		?>
		<?php
		get_template_part( 'template-parts/post/content', 'excerpt' );
		?>
<?php endwhile; ?>
</div>