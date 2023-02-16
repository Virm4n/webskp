<?php 
/**
 * Post Author Meta
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

if( class_exists( 'ReduxFramework' ) ){
	$finix_opt = get_option('finix_redux');
	$opt       = $finix_opt['singal-blog-meta'];
	if ( $opt == 'on' ) {
	?>
		<div class="entry-share-info">
			<?php
			$opt       = $finix_opt['singal-blog-tag'];
			if ( $opt == 'on' ) {
			$posttag = get_the_tags();
			if ( $posttag ) {
				?>
				<div class="entry-tags">
					<div class="tags-title"><?php esc_html_e( 'Tags :', 'finix' ); ?></div>
					<div class="tags-inner">
						<?php
						foreach ( $posttag as $tag ) {
							echo '<a class="tags-item" href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a>';
						}
						?>
					</div>
				</div>
			<?php }
			}
			$opt       = $finix_opt['singal-blog-share'];
			if ( $opt == 'on' ) { ?>
				<div class="entry-social">
					<div class="social-title"><?php esc_html_e( 'Social Icon :', 'finix' ); ?></div>
					<ul class="social-list">
						<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="http://twitter.com/intent/tweet?text=<?php the_title(); ?>&<?php the_permalink(); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
						<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&summary=<?php the_excerpt(); ?>" target="_blank"><i class="fab fa-linkedin"></i></a></li>
					</ul>
				</div>
			<?php } ?>
		</div>
		
		<?php
		$opt       = $finix_opt['singal-blog-author'];
		if ( $opt == 'on' ) {
		?>
		<div class="finix-profile-cover">
			<div class="finix-profile-avatar">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 110, '', esc_attr__( 'author avatar', 'finix' ) ); ?>
			</div>
			<?php
			$finix_info = get_the_author_meta( 'finix_info' );
			?>
			<div class="author-bio">
				<h4 class="author-title">
					<a class="name">
						<?php echo get_the_author(); ?>
					</a>
				</h4>

				<?php if ( isset( $finix_info['designation'] ) && $finix_info['designation'] ) : ?>
				<span><?php echo esc_html( $finix_info['designation'] ); ?></span>
				<?php endif; ?>

				<p><?php echo the_author_meta( 'description' ); ?></p>

				<ul class="author-social-media">
					<?php if ( isset( $finix_info['facebook'] ) && $finix_info['facebook'] ) : ?>
						<li>
							<a href="<?php echo esc_url( $finix_info['facebook'] ); ?>" class="facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
						</li>
					<?php endif; ?>
					<?php if ( isset( $finix_info['twitter'] ) && $finix_info['twitter'] ) : ?>
						<li>
							<a href="<?php echo esc_url( $finix_info['twitter'] ); ?>" class="twitter" target="_blank"><i class="fab fa-twitter"></i></a>
						</li>
					<?php endif; ?>

					<?php if ( isset( $finix_info['instagram'] ) && $finix_info['instagram'] ) : ?>
						<li>
							<a href="<?php echo esc_url( $finix_info['instagram'] ); ?>" class="instagram" target="_blank"><i class="fab fa-instagram"></i></a>
						</li>
					<?php endif; ?>

					<?php if ( isset( $finix_info['linkedin'] ) && $finix_info['linkedin'] ) : ?>
						<li>
							<a href="<?php echo esc_url( $finix_info['linkedin'] ); ?>" class="linkedin" target="_blank"><i class="fab fa-linkedin-in"></i></a>
						</li>
					<?php endif; ?>

					<?php if ( isset( $finix_info['youtube'] ) && $finix_info['youtube'] ) : ?>
						<li>
							<a href="<?php echo esc_url( $finix_info['youtube'] ); ?>" class="youtube" target="_blank"><i class="fab fa-youtube"></i></a>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
		<?php
		}
		$opt       = $finix_opt['singal-blog-pagination'];
		if ( $opt == 'on' ) {
			if ( is_singular( 'post' ) ) {
				// Previous/next post navigation.
				the_post_navigation(
					array(
						'prev_text' => '<div class="next-btn">
							<span class="nav-subtitle" aria-hidden="true">Previous Article</span> ' .
							'<h5 class="post-title">%title</h5></div>' . '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'finix' ) . '</span> ',
						'next_text' => '<div class="previous-btn">
							<span class="nav-subtitle" aria-hidden="true">Next Article</span> ' .
							'<h5 class="post-title">%title</h5> </div>' . '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'finix' ) . '</span>' ,
					)
				);
			}
		}
		?>
<?php }
} ?>