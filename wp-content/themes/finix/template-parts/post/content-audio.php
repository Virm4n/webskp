<?php
/**
 * Template part for displaying audio posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */


$audio           = get_post_meta( get_the_ID(), 'audio_file', true );
$audio_data      = false;

if ( $audio ) {
	$audio_data = finix_get_attachment( $audio );
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	if ( $audio_data ) {
		?>
		<?php if(has_post_thumbnail()) { ?>
		<div class="blog-media">
			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
			<div class="category-main">
			<?php 
				$postcat = get_the_category();
				if ($postcat) {
					foreach ( $postcat as $cat ) {
						echo '<a class="post-categery" href="' . esc_url( get_category_link( $cat->cat_ID ) ) . '">' . esc_html( $cat->name ) . '</a>';
					}
				}
			?></div>
		</div>
		<?php } ?>
		<div class="blog-audio">
			<audio src="<?php echo esc_url( $audio_data['url'] ); ?>" width="100%" controls="controls"></audio>
		</div>
		<?php
	}
	?>
		
	<?php
		$content = apply_filters( 'the_content', get_the_content() );
		$audio   = false;

		// Only get audio from the content if a playlist isn't present.
	if ( false === strpos( $content, 'wp-playlist-script' ) ) {
		$audio = get_media_embedded_in_content( $content, array( 'audio' ) );
	}

	?>

	<div class="blog-content">
		<div class="entry-header">
		
			<?php if(!is_single()) { ?>
				<div class="post-title">
				  <h3 class="title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php the_title(); ?></a></h3>
				</div>
			<?php } ?>

			<?php get_template_part( 'template-parts/post/post-meta' ); ?>
			
		</div>
		<div class="entry-content">
				<?php 

				if ( is_single() ) {
					the_content();
				} else {
					the_excerpt();
				}
				
				wp_link_pages( array(
					'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'finix' ),
					'after'       => '</div>',
					'link_before' => '<span class="page-number">',
					'link_after'  => '</span>',
				) );
				?>
		</div>

		<?php if ( is_single() ) { 
			get_template_part( 'template-parts/post/post-author-meta' );
		} ?>
				
		<?php if(!is_single()){ ?>
		<div class="entry-footer">
		<a class="read-more" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'finix'); ?><i class="ion ion-ios-arrow-thin-right"></i></a>
		</div>
		<?php } ?>
					
	</div>
		
</article>
