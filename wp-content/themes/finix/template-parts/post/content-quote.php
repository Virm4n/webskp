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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php
		$quote = get_post_meta( get_the_ID(), 'quote', true );
		$quote_author = get_post_meta( get_the_ID(), 'quote_author', true );
		
		if ( ! empty( $quote ) ) {
			?>
			<div class="blog-media">
				<blockquote>
					<div class="icon-quote"><i class="ion ion-quote"></i></div>
					<h3 class="quote-text"><?php echo esc_html( $quote ); ?></h3>
					<cite>- <?php echo esc_html( $quote_author ); ?></cite>
				</blockquote>
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

				if(is_single()){ 
					the_content();
				}else{
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