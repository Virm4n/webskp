<?php
/**
 * Displays content for front page
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'finix-panel ' ); ?> >

	<?php
	if ( has_post_thumbnail() ) :
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'finix-featured-image' );

		// Calculate aspect ratio: h / w * 100%.
		$ratio = $thumbnail[2] / $thumbnail[1] * 100;
		?>

		<div class="panel-image" style="background-image: url(<?php echo esc_url( $thumbnail[0] ); ?>);">
			<div class="panel-image-prop" style="padding-top: <?php echo esc_attr( $ratio ); ?>%"></div>
		</div><!-- .panel-image -->

	<?php endif; ?>

	<div class="panel-content">
		<div class="wrap">
			
			<div class="entry-content">
				<?php
					/* translators: %s: Name of current post */
					the_content(
						sprintf(
							wp_kses( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'finix' ),
							get_the_title()
						)
					);
					?>
			</div><!-- .entry-content -->

		</div><!-- .wrap -->
	</div><!-- .panel-content -->

</article><!-- #post-<?php the_ID(); ?> -->
