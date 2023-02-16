<?php
/**
 * Recent Portfolio
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

?>
<div class="recent-portfolio">
    <h3 class="main-title"><?php esc_html_e( 'Recent Portfolio', 'finix' ); ?></h3>
    <div class="swiper-container" data-items="3" data-lg-items="2" data-md-items="2" data-sm-items="2" data-xs-items="1" data-space="30" data-bullets="false" data-arrow="false">
        <div class="swiper-wrapper">
            <?php
            $args = array( 'post_type' => 'portfolio', 'posts_per_page' => -1 );
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post();
                $term_list = wp_get_post_terms( get_the_ID(), 'portfolio-categories' );
                $slugs     = array();
                foreach ( $term_list as $term ) {
                    $slugs[] = $term->slug;
                }
                $portfolio_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'finix_500x400' );
            ?>
            <div class="swiper-slide">
                <div class="latest-portfolio">
                    <div class="portfolio-image">
                        <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( $portfolio_image[0] ); ?>" alt="Design" /></a>
                    </div>
                    <div class="portfolio-content">
                        <div class="portfolio-inner">
                            <span class="portfolio-category"><?php echo esc_html($term->name); ?></span>
                            <h3 class="portfolio-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        </div>
                        <a class="portfolio-link" href="<?php the_permalink(); ?>"><i class="ti ti-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <?php
            endwhile;
            ?>
        </div>
    </div>
</div>	