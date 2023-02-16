<?php
/**
 * Custom post type: Post
 *
 * @package Betheme
 * @author Muffin group
 * @link https://muffingroup.com
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (! class_exists('Mfn_Post_Type_Post')) {
	class Mfn_Post_Type_Post extends Mfn_Post_Type
	{

		/**
		 * Mfn_Post_Type_Post constructor
		 */

		public function __construct()
		{
			parent::__construct();

			// admin only methods

			if( is_admin() ){
				$this->fields = $this->set_fields();
				$this->builder = new Mfn_Builder_Admin();
			}

		}

		/**
		 * Set post type fields
		 */

		public function set_fields(){

			return array(
      	'id' => 'mfn-meta-post',
      	'title' => esc_html__('Post Options', 'mfn-opts'),
      	'page' => 'post',
      	'fields' => array(

					// layout

  				array(
  					'title' => __('Layout', 'mfn-opts'),
  				),

					array(
  					'id' => 'mfn-post-hide-content',
  					'type' => 'switch',
  					'title' => __('The content', 'mfn-opts'),
  					'desc' => __('The content from the WordPress editor', 'mfn-opts'),
  					'options'	=> array(
							'1' => __('Hide', 'mfn-opts'),
							'0' => __('Show', 'mfn-opts'),
						),
  					'std' => '0'
  				),

					array(
						'id' => 'mfn-post-layout',
						'type' => 'radio_img',
						'title' => __('Layout', 'mfn-opts'),
						'desc' => __('Full width sections works only without sidebars', 'mfn-opts'),
						'options' => array(
							'no-sidebar' => __('Full width', 'mfn-opts'),
							'left-sidebar' => __('Left sidebar', 'mfn-opts'),
							'right-sidebar' => __('Right sidebar', 'mfn-opts'),
							'both-sidebars' => __('Both sidebars', 'mfn-opts'),
						),
						'std' => 'no-sidebar',
						'alias' => 'sidebar',
						'class' => 'form-content-full-width small',
					),

					array(
  					'id' => 'mfn-post-sidebar',
  					'type' => 'select',
  					'title' => __('Sidebar', 'mfn-opts'),
  					'desc' => __('Shows only if layout with sidebar is selected', 'mfn-opts'),
  					'options' => mfn_opts_get('sidebars'),
  				),

  				array(
  					'id' => 'mfn-post-sidebar2',
  					'type' => 'select',
  					'title' => __('Sidebar 2nd', 'mfn-opts'),
  					'desc' => __('Shows only if layout with both sidebars is selected', 'mfn-opts'),
  					'options' => mfn_opts_get('sidebars'),
  				),

      		array(
      			'id' => 'mfn-post-template',
      			'type' => 'select',
      			'title' => __('Template', 'mfn-opts'),
      			'options' => array(
      				'' => __('-- Default --', 'mfn-opts'),
      				'builder' => __('Builder', 'mfn-opts'),
      				'intro' => __('Intro Header', 'mfn-opts'),
      			),
      		),

      		// media

  				array(
  					'title' => __('Media', 'mfn-opts'),
  				),

					array(
  					'id' => 'mfn-post-slider',
  					'type' => 'select',
  					'title' => __('Slider Revolution', 'mfn-opts'),
  					'options' => Mfn_Builder_Helper::get_sliders('rev'),
  				),

  				array(
  					'id' => 'mfn-post-slider-layer',
  					'type' => 'select',
  					'title' => __('Layer Slider', 'mfn-opts'),
  					'options' => Mfn_Builder_Helper::get_sliders('layer'),
  				),

					array(
      			'id' => 'mfn-post-header-bg',
      			'type' => 'upload',
      			'title' => __('Header image', 'mfn-opts'),
      		),

  				array(
  					'id' => 'mfn-post-subheader-image',
  					'type' => 'upload',
  					'title' => __('Subheader image', 'mfn-opts'),
  				),

      		array(
      			'id' => 'mfn-post-video',
      			'type' => 'text',
      			'title' => __('Video ID', 'mfn-opts'),
      			'desc' => __('YouTube or Vimeo', 'mfn-opts'),
      		),

      		array(
      			'id' => 'mfn-post-video-mp4',
      			'type' => 'upload',
      			'title' => __('Video MP4', 'mfn-opts'),
      			'data' => 'video',
      		),

      		// options

      		array(
      			'title' => __('Options', 'mfn-opts'),
      		),

					array(
  					'id' => 'mfn-post-hide-title',
  					'type' => 'switch',
  					'title' => __('Subheader', 'mfn-opts'),
  					'options'	=> array(
							'1' => __('Hide', 'mfn-opts'),
							'0' => __('Show', 'mfn-opts'),
						),
  					'std' => '0'
  				),

  				array(
  					'id' => 'mfn-post-remove-padding',
  					'type' => 'switch',
  					'title' => __('Content top padding', 'mfn-opts'),
  					'options' => array(
							'1' => __('Hide', 'mfn-opts'),
							'0' => __('Show', 'mfn-opts'),
						),
  					'std' => '0'
  				),

      		array(
      			'id' => 'mfn-post-hide-image',
      			'type' => 'switch',
      			'title' => __('Featured image', 'mfn-opts'),
      			'options'	=> array(
							'1' => __('Hide', 'mfn-opts'),
							'0' => __('Show', 'mfn-opts'),
						),
						'std' => '0'
      		),

      		// advanced

					array(
      			'title' => __('Advanced', 'mfn-opts'),
      		),

      		array(
      			'id' => 'mfn-post-link',
      			'type' => 'text',
      			'title' => __('External link', 'mfn-opts'),
      			'desc' => __('for Post Format: Link', 'mfn-opts'),
      		),

      		array(
      			'id' => 'mfn-post-bg',
      			'type' => 'color',
      			'title' => __('Background color', 'mfn-opts'),
      			'desc' => __('for blog Layout: Masonry Tiles and Template: Intro', 'mfn-opts'),
      		),

					// intro

					array(
      			'title' => __('Intro header', 'mfn-opts'),
      		),

      		array(
      			'id' => 'mfn-post-intro',
      			'type' => 'checkbox',
      			'title' => __('Options', 'mfn-opts'),
      			'desc' => __('for Template: Intro', 'mfn-opts'),
      			'options' => array(
      				'light' => __('Light image, dark text', 'mfn-opts'),
      				'full-screen' => __('Full Screen', 'mfn-opts'),
      				'parallax' => __('Parallax', 'mfn-opts'),
      				'cover' => __('Background size: Cover<span>enabled by default in parallax</span>', 'mfn-opts'),
      			),
      		),

					// seo

  				array(
  					'title' => __('SEO', 'mfn-opts'),
  				),

  				array(
  					'id' => 'mfn-meta-seo-title',
  					'type' => 'text',
  					'title' => __('Title', 'mfn-opts'),
  				),

  				array(
  					'id' => 'mfn-meta-seo-description',
  					'type' => 'text',
  					'title' => __('Description', 'mfn-opts'),
  				),

  				array(
  					'id' => 'mfn-meta-seo-keywords',
  					'type' => 'text',
  					'title' => __('Keywords', 'mfn-opts'),
  				),

  				array(
  					'id' => 'mfn-meta-seo-og-image',
  					'type' => 'upload',
  					'title' => __('Open Graph image', 'mfn-opts'),
  					'desc' => __('Facebook share image', 'mfn-opts'),
  				),

      	),
      );

		}

	}
}

new Mfn_Post_Type_Post();
