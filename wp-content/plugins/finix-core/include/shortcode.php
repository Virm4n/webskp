<?php
/**
 * Finix Shortcode
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 */

// Footer Menu Shortcode.
add_shortcode('finix-footer-menu', 'finix_copyright_menu_shortcode'); 
function finix_copyright_menu_shortcode() { 
    if ( has_nav_menu( 'footer' ) ) : ?>
            <?php wp_nav_menu( array(
            'theme_location' => 'footer',
            'menu_class'     => 'nav footer-nav',
            'menu_id'        => 'footer-menu-ul',
            'container_id'   => 'footer-menu',
            ) ); ?>
    <?php endif; 
} 

// Year Shortcode.
add_shortcode('finix-year', 'finix_copyright_year'); 
function finix_copyright_year() { 
    return date('Y');
} 

// Site Title Shortcode.
add_shortcode('finix-site-title', 'finix_copyright_site_title'); 
function finix_copyright_site_title() { 
    return get_bloginfo('name');
}

// Static Blocks.
if ( ! function_exists( 'finix_get_static_blocks' ) ) {
	/**
	 * Function to get the list of id and title of Static blocks
	 */
	function finix_get_static_blocks() {

		$cms_blocks = array();

		$args = array(
			'post_type'      => 'static_block',
			'post_status'    => 'publish',
			'posts_per_page' => -1, // phpcs:ignore WPThemeReview.CoreFunctionality.PostsPerPage.posts_per_page_posts_per_page
		);

		$loop = new WP_Query( $args );

		while ( $loop->have_posts() ) :
			$loop->the_post();
			$cms_blocks[ get_the_ID() ] = esc_html( get_the_title() );
		endwhile;

		wp_reset_postdata();

		return $cms_blocks;
	}
}

// Social Media Shortcode.
add_shortcode('finix-social-icon', 'finix_copiright_social_media'); 
function finix_copiright_social_media() { 
    ?>
        <div class="footer-info-social">
            <ul>
                <?php finix_social_links() ?>
            </ul>
        </div>
    <?php 
} 

// Elementor template Shortcde.
if ( ! function_exists( 'finix_elementor_template' ) ) {
    function finix_elementor_template( $atts ) {
        extract(
            shortcode_atts(
                array(
                    'id' => 0,
                ),
                $atts
            )
        );
        ob_start();
        $template = new \Elementor\Frontend;
        echo $template->get_builder_content_for_display( $id, true );
        return ob_get_clean();
    }
    add_shortcode( 'finix_elementor_template', 'finix_elementor_template' );
}
?>