<?php
/**
 * One Click Demo
 *
 * @package Finix
 * @subpackage finix
 * @since finix 1.0
 */

/**
 * One Click Demo Import Array
 */
function finix_import_files() {
	return array(
		array(
			'import_file_name'             => esc_html__( 'SEO', 'finix' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-1/finix-xml.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-1/finix-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-1/finix-export.dat',
			'local_import_redux'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-1/finix_redux.json',
					'option_name' => 'finix_redux',
				),
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/inc/importer/elementer/demo-1/demo1.jpg',
			'preview_url'                  => 'http://finix.powersquall.com/',
		),
		array(
			'import_file_name'             => esc_html__( 'Mobile App', 'finix' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-2/finix-xml.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-2/finix-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-2/finix-export.dat',
			'local_import_redux'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-2/finix_redux.json',
					'option_name' => 'finix_redux',
				),
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/inc/importer/elementer/demo-2/demo2.jpg',
			'preview_url'                  => 'http://finix.powersquall.com/mobile-app/',
		),
		array(
			'import_file_name'             => esc_html__( 'Saas', 'finix' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-3/finix-xml.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-3/finix-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-3/finix-export.dat',
			'local_import_redux'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-3/finix_redux.json',
					'option_name' => 'finix_redux',
				),
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/inc/importer/elementer/demo-3/demo3.jpg',
			'preview_url'                  => 'http://finix.powersquall.com/saas/',
		),
		array(
			'import_file_name'             => esc_html__( 'Web Hosting', 'finix' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-4/finix-xml.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-4/finix-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-4/finix-export.dat',
			'local_import_redux'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-4/finix_redux.json',
					'option_name' => 'finix_redux',
				),
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/inc/importer/elementer/demo-4/demo4.jpg',
			'preview_url'                  => 'http://finix.powersquall.com/web-hosting/',
		),
		array(
			'import_file_name'             => esc_html__( 'Data Science', 'finix' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-5/finix-xml.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-5/finix-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-5/finix-export.dat',
			'local_import_redux'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-5/finix_redux.json',
					'option_name' => 'finix_redux',
				),
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/inc/importer/elementer/demo-5/demo5.jpg',
			'preview_url'                  => 'http://finix.powersquall.com/data-science/',
		),
		
		array(
			'import_file_name'             => esc_html__( 'IT Solution', 'finix' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-6/finix-xml.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-6/finix-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-6/finix-export.dat',
			'local_import_redux'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-6/finix_redux.json',
					'option_name' => 'finix_redux',
				),
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/inc/importer/elementer/demo-6/demo6.jpg',
			'preview_url'                  => 'http://finix.powersquall.com/it-solution/',
		),
		
		array(
			'import_file_name'             => esc_html__( 'Web Agency', 'finix' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-7/finix-xml.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-7/finix-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-7/finix-export.dat',
			'local_import_redux'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-7/finix_redux.json',
					'option_name' => 'finix_redux',
				),
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/inc/importer/elementer/demo-7/demo7.jpg',
			'preview_url'                  => 'http://finix.powersquall.com/web-agency/',
		),
		
		array(
			'import_file_name'             => esc_html__( 'Web Development', 'finix' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-8/finix-xml.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-8/finix-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-8/finix-export.dat',
			'local_import_redux'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-8/finix_redux.json',
					'option_name' => 'finix_redux',
				),
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/inc/importer/elementer/demo-8/demo8.jpg',
			'preview_url'                  => 'http://finix.powersquall.com/web-development/',
		),

		array(
			'import_file_name'             => esc_html__( 'SEO Optimization', 'finix' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-9/finix-xml.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-9/finix-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-9/finix-export.dat',
			'local_import_redux'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-9/finix_redux.json',
					'option_name' => 'finix_redux',
				),
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/inc/importer/elementer/demo-9/demo9.jpg',
			'preview_url'                  => 'http://finix.powersquall.com/seo-optimization/',
		),

		array(
			'import_file_name'             => esc_html__( 'Cyber Security', 'finix' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-10/finix-xml.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-10/finix-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-10/finix-export.dat',
			'local_import_redux'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-10/finix_redux.json',
					'option_name' => 'finix_redux',
				),
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/inc/importer/elementer/demo-10/demo10.jpg',
			'preview_url'                  => 'http://finix.powersquall.com/cyber-security/',
		),

		array(
			'import_file_name'             => esc_html__( 'NFT', 'finix' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-11/finix-xml.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-11/finix-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-11/finix-export.dat',
			'local_import_redux'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-11/finix_redux.json',
					'option_name' => 'finix_redux',
				),
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/inc/importer/elementer/demo-11/demo11.jpg',
			'preview_url'                  => 'http://finix.powersquall.com/nft/',
		),

		array(
			'import_file_name'             => esc_html__( 'Default Dark', 'finix' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-12/finix-xml.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-12/finix-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-12/finix-export.dat',
			'local_import_redux'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/importer/elementer/demo-12/finix_redux.json',
					'option_name' => 'finix_redux',
				),
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/inc/importer/elementer/demo-12/demo12.jpg',
			'preview_url'                  => 'http://finix.powersquall.com/default-dark/',
		),
	);
}
add_filter( 'pt-ocdi/import_files', 'finix_import_files' );

if ( ! function_exists( 'finix_after_import' ) ) :
	/**
	 * Menu Setting
	 *
	 * @param array $selected_import .
	 */
	function finix_after_import( $selected_import ) {

		// remove default post
		wp_delete_post( 1 );

		// Assign menus to their locations.
		$locations = get_theme_mod( 'nav_menu_locations' ); // registered menu locations in theme
		$menus     = wp_get_nav_menus(); // registered menus

		if ( $menus ) {
			foreach ( $menus as $menu ) { // assign menus to theme locations

				if ( $menu->name == 'Primary Menu' ) {
					$locations['primary'] = $menu->term_id;
				}

				if ( $menu->name == 'Footer Menu' ) {
					$locations['footer'] = $menu->term_id;
				}
			}
		}
		set_theme_mod( 'nav_menu_locations', $locations );

		if ( 'SEO' === $selected_import['import_file_name'] ) {
			// Same codes as above for the demo 1
			$front_page_id = get_page_by_title( 'Home' );
			$blog_page_id  = get_page_by_title( 'Blog' );

			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page_id->ID );
			update_option( 'page_for_posts', $blog_page_id->ID );
		} elseif ( 'Mobile App' === $selected_import['import_file_name'] ) {
			// Same codes as above for the demo 2
			$front_page_id = get_page_by_title( 'Home' );
			$blog_page_id  = get_page_by_title( 'Blog' );

			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page_id->ID );
			update_option( 'page_for_posts', $blog_page_id->ID );
		} elseif ( 'Saas' === $selected_import['import_file_name'] ) {
			// Same codes as above for the demo 3
			$front_page_id = get_page_by_title( 'Home' );
			$blog_page_id  = get_page_by_title( 'Blog' );

			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page_id->ID );
			update_option( 'page_for_posts', $blog_page_id->ID );
		} elseif ( 'Web Hosting' === $selected_import['import_file_name'] ) {
			// Same codes as above for the demo 4
			$front_page_id = get_page_by_title( 'Home' );
			$blog_page_id  = get_page_by_title( 'Blog' );

			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page_id->ID );
			update_option( 'page_for_posts', $blog_page_id->ID );
		} elseif ( 'Data Science' === $selected_import['import_file_name'] ) {
			// Same codes as above for the demo 5
			$front_page_id = get_page_by_title( 'Home' );
			$blog_page_id  = get_page_by_title( 'Blog' );

			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page_id->ID );
			update_option( 'page_for_posts', $blog_page_id->ID );
		} elseif ( 'IT Solution' === $selected_import['import_file_name'] ) {
			// Same codes as above for the demo 5
			$front_page_id = get_page_by_title( 'Home' );
			$blog_page_id  = get_page_by_title( 'Blog' );

			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page_id->ID );
			update_option( 'page_for_posts', $blog_page_id->ID );
		} elseif ( 'Web Agency' === $selected_import['import_file_name'] ) {
			// Same codes as above for the demo 5
			$front_page_id = get_page_by_title( 'Home' );
			$blog_page_id  = get_page_by_title( 'Blog' );

			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page_id->ID );
			update_option( 'page_for_posts', $blog_page_id->ID );
		} elseif ( 'Web Development' === $selected_import['import_file_name'] ) {
			// Same codes as above for the demo 5
			$front_page_id = get_page_by_title( 'Home' );
			$blog_page_id  = get_page_by_title( 'Blog' );

			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page_id->ID );
			update_option( 'page_for_posts', $blog_page_id->ID );
		} elseif ( 'SEO Optimization' === $selected_import['import_file_name'] ) {
			// Same codes as above for the demo 5
			$front_page_id = get_page_by_title( 'Home' );
			$blog_page_id  = get_page_by_title( 'Blog' );

			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page_id->ID );
			update_option( 'page_for_posts', $blog_page_id->ID );
		} elseif ( 'Cyber Security' === $selected_import['import_file_name'] ) {
			// Same codes as above for the demo 5
			$front_page_id = get_page_by_title( 'Home' );
			$blog_page_id  = get_page_by_title( 'Blog' );

			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page_id->ID );
			update_option( 'page_for_posts', $blog_page_id->ID );
		} elseif ( 'NFT' === $selected_import['import_file_name'] ) {
			// Same codes as above for the demo 5
			$front_page_id = get_page_by_title( 'Home' );
			$blog_page_id  = get_page_by_title( 'Blog' );

			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page_id->ID );
			update_option( 'page_for_posts', $blog_page_id->ID );
		} elseif ( 'Default Dark' === $selected_import['import_file_name'] ) {
			// Same codes as above for the demo 5
			$front_page_id = get_page_by_title( 'Home' );
			$blog_page_id  = get_page_by_title( 'Blog' );

			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page_id->ID );
			update_option( 'page_for_posts', $blog_page_id->ID );
		} 

		// Import Revolution Slider.
		if ( class_exists( 'RevSlider' ) ) {
			$slider_array = array(
				get_template_directory() . '/inc/importer/slider/mobile-app-slider.zip',
				get_template_directory() . '/inc/importer/slider/web-hosting-slider.zip',				
			);

			$slider = new RevSlider();

			foreach ( $slider_array as $filepath ) {
				$slider->importSliderFromPost( true, true, $filepath );
			}
		}
	
	}
	add_action( 'pt-ocdi/after_import', 'finix_after_import' );
endif;
	
// Elementor Site Setting
update_option( 'elementor_disable_color_schemes', 'yes' );
update_option( 'elementor_disable_typography_schemes', 'yes' );

$default_kit = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_title = 'Default Kit' AND post_type ='elementor_library'" );
if ( $default_kit ) {
	update_option( 'elementor_active_kit', $default_kit );
}