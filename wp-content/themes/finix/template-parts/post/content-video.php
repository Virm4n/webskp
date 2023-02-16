<?php
/**
 * Template part for displaying video posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

$video_type = get_post_meta( get_the_ID(), 'video_type', true );

if ( function_exists( 'get_field' ) ) {
	$post_video_youtube = get_field( 'post_video_youtube' );
} else {
	$post_video_youtube = get_post_meta( get_the_ID(), 'post_video_youtube', true );
	$post_video_youtube = wp_oembed_get( $post_video_youtube );
}
if ( function_exists( 'get_field' ) ) {
	$post_video_vimeo = get_field( 'post_video_vimeo' );
} else {
	$post_video_vimeo = get_post_meta( get_the_ID(), 'post_video_vimeo', true );
	$post_video_vimeo = wp_oembed_get( $post_video_vimeo );
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
		// Check if video type is html5 and have rows.
		if ( 'youtube' === $video_type && $post_video_youtube ) {
			// use preg_match to find iframe src.
			preg_match( '/src="(.+?)"/', $post_video_youtube, $matches );
			$src = isset( $matches[1] ) ? $matches[1] : '';

			// Remove existing params.
			$src = remove_query_arg( array( 'feature' ), $src );

			// add extra params to iframe src.
			$params  = array(
				'rel' => 0,
			);
			$new_src = add_query_arg( $params, $src );
			?>
			<div class="blog-media blog-youtube">
				<div class="video-iframe [youtube, widescreen]">
					<?php
						echo '<iframe src="' . esc_url( $new_src ) . '" frameborder="0" allowfullscreen></iframe>';
					?>
				</div>
			</div>
			<?php
		} elseif ( 'vimeo' === $video_type && $post_video_vimeo ) {
			// use preg_match to find iframe src.
			preg_match( '/src="(.+?)"/', $post_video_vimeo, $matches );
			$src = isset( $matches[1] ) ? $matches[1] : '';
			?>
			<div class="blog-media blog-vimeo">
				<div class="video-iframe [vimeo, widescreen]">
					<?php
						echo '<iframe src="' . esc_url( $src ) . '" frameborder="0" allowfullscreen="" mozallowfullscreen="" webkitallowfullscreen=""></iframe>';
					?>

				</div>
			</div>
			<?php
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
	
</article><!-- #post-<?php the_ID(); ?> -->
