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
		$part_1 = "template-parts/post/content";
		$part_2 = get_post_format();
		if ( ( $part_2 && ! empty( locate_template( "$part_1-$part_2.php" ) ) ) || ( ! empty( locate_template( "$part_1.php" ) ) ) ) {
			get_template_part( $part_1, $part_2 );
		} else {
			get_template_part( 'template-parts/post/content', get_post_format() );
		}
		?>
<?php endwhile; ?>
</div>