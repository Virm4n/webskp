<?php
/**
 * Recent Post
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

if( class_exists( 'ReduxFramework' ) ){
	$finix_opt = get_option( 'finix_redux' );
	$opt             = $finix_opt['related_post'];
	if ( $opt == 'on' ) {
		?>
	<div class="recent-post">
		<h3 class="main-title"><?php esc_html_e( 'Recent Posts', 'finix' ); ?></h3>
		<div class="swiper-container" data-items="2" data-lg-items="2" data-md-items="2" data-sm-items="1" data-xs-items="1" data-space="0" data-bullets="false" data-arrow="false">
			<div class="swiper-wrapper">
				<?php
				$args = array(
					'post_type'      => 'post',
					'posts_per_page' => -1,
				);
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) :
					$loop->the_post();
					?>
				<div class="swiper-slide">
					<div class="latest-post">
						<?php if ( has_post_thumbnail() ) { ?>
						<div class="post-image">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
							<div class="meta-date">
								<i class="ti ti-calendar"></i>
								<?php
								$date = date_create( $post->post_date );
									echo finix_time_link();
								?>
							</div>
						</div>
						<?php } ?>
						<div class="post-content">
							<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="post-description">
										<?php
										$content_words = 12;
										$total_words   = str_word_count( get_the_content() );

										if ( $content_words > $total_words ) {
											$content_words = $total_words - 1;
										}

										if ( has_excerpt() ) {
											$excerpt_data = get_the_excerpt();

											echo wp_kses( $excerpt_data, array() );
										} else {
											$excerpt_data = get_the_content();

											$excerpt_data = strip_shortcodes( $excerpt_data );
											$excerpt_data = wp_trim_words( $excerpt_data, $content_words, '...' );
											echo wp_kses( $excerpt_data, array() );
										}
										?>
									</div>
							<div class="post-link">
								<a class="read-more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'finix' ); ?><i class="ion ion-ios-arrow-thin-right"></i></a>
							</div>
						</div>
					</div>
				</div>
					<?php
				endwhile;
				?>
			</div>
		</div>
	</div>	
	<?php }
} ?>
