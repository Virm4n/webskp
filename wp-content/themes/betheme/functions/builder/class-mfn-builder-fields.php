<?php
/**
 * Custom meta fields | Fields
 *
 * @package Betheme
 * @author Muffin group
 * @link https://muffingroup.com
 */

if( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly
}

if( ! class_exists('Mfn_Builder_Fields') )
{
  class Mfn_Builder_Fields {

    private $sliders;
    private $animations;

    private $section;
    private $wrap;

    private $items;

    /**
      * Constructor
      */

    public function __construct() {

      $this->sliders = array(
        'layer' => Mfn_Builder_Helper::get_sliders('layer'),
        'rev' => Mfn_Builder_Helper::get_sliders('rev'),
      );

      $this->set_animations();

      $this->set_section();
      $this->set_wrap();

      $this->set_items();

    }

    /**
     * GET section fields
     */

    public function get_section(){

      return $this->section;

    }

    /**
     * GET wrap fields
     */

    public function get_wrap(){

      return $this->wrap;

    }

    /**
     * GET items
     */

    public function get_items(){

      return $this->items;

    }

    /**
     * GET item fields
     */

    public function get_item_fields( $item_type ){

      return $this->items[$item_type];

    }

		/**
		 * GET entrance animations
		 */

		public function get_animations(){

			return $this->animations;

		}

		/**
		 * GET placeholder image
		 */

		public function get_placeholder(){

			return get_theme_file_uri( '/muffin-options/svg/placeholders/image.svg' );

		}

    /**
     * SET section fields
   	 */

    private function set_section()
  	{
  		$this->section = array(

  			array(
  				'id' => 'title',
  				'type' => 'text',
  				'title' => __('Title', 'mfn-opts'),
  				'desc' => __('Label in admin panel only', 'mfn-opts'),
  			),

				// background

				array(
					'title' => __('Background', 'mfn-opts'),
				),

  			array(
  				'id' => 'bg_color',
  				'type' => 'color',
  				'title' => __('Color', 'mfn-opts'),
  				'alpha' => true,
  			),

  			array(
  				'id' => 'bg_image',
  				'type' => 'upload',
  				'title' => __('Image', 'mfn-opts'),
  				'desc' => __('Recommended image size <b>1920px x 1080px</b>', 'mfn-opts'),
  			),

  			array(
  				'id' => 'bg_position',
  				'type' => 'select',
  				'title' => __('Position', 'mfn-opts'),
  				'desc' => __('iOS does <b>not</b> support background-position: fixed<br/>For parallax required background image size is at least 1920px x 1080px', 'mfn-opts'),
  				'options' => mfna_bg_position(),
  				'std' => 'center top no-repeat',
  			),

  			array(
  				'id' => 'bg_size',
  				'type' => 'select',
  				'title' => __('Size', 'mfn-opts'),
  				'desc' => __('Does <b>not</b> work with position fixed or parallax', 'mfn-opts'),
  				'options' => mfna_bg_size(),
  			),

  			array(
  				'id' => 'bg_video_mp4',
  				'type' => 'upload',
  				'title' => __('Video MP4', 'mfn-opts'),
  				'desc' => __('Image will be used as placeholder before video loads and on mobile devices', 'mfn-opts'),
  				'data' => 'video',
  			),

  			// padding

  			array(
  				'title' => __('Padding', 'mfn-opts'),
  			),

  			array(
  				'id' => 'padding_top',
  				'type' => 'text',
  				'title' => __('Top', 'mfn-opts'),
  				'after' => 'px',
  				'std' => '0',
  			),

  			array(
  				'id' => 'padding_bottom',
  				'type' => 'text',
  				'title' => __('Bottom', 'mfn-opts'),
  				'after' => 'px',
  				'std' => '0',
  			),

  			array(
  				'id' => 'padding_horizontal',
  				'type' => 'text',
  				'title' => __('Side', 'mfn-opts'),
  				'desc' => __('Use <b>px</b> or <b>%</b>', 'mfn-opts'),
  				'std' => '0',
  			),

  			// decoration

  			array(
  				'title' => __('Decoration', 'mfn-opts'),
  			),

  			array(
  				'id' => 'divider',
  				'type' => 'select',
  				'title' => __('Pattern', 'mfn-opts'),
  				'desc' => __('Please select background color above<br />Does <b>not</b> work with parallax and some section styles', 'mfn-opts'),
  				'options' => array(
  					'' => __('None', 'mfn-opts'),
  					'circle up' => __('Circle up', 'mfn-opts'),
  					'square up' => __('Square up', 'mfn-opts'),
  					'triangle up' => __('Triangle up', 'mfn-opts'),
  					'triple-triangle up' => __('Triple triangle up', 'mfn-opts'),
  					'circle down' => __('Circle down', 'mfn-opts'),
  					'square down' => __('Square down', 'mfn-opts'),
  					'triangle down' => __('Triangle down', 'mfn-opts'),
  					'triple-triangle down' => __('Triple triangle down', 'mfn-opts'),
  				),
  			),

  			array(
  				'id' => 'decor_top',
  				'type' => 'upload',
  				'title' => __('Image top', 'mfn-opts'),
  				'desc' => __('for images from <b> Media library</b><br/>Recommended width: 1920px', 'mfn-opts'),
  			),

  			array(
  				'id' => 'decor_bottom',
  				'type' => 'upload',
  				'title' => __('Image bottom', 'mfn-opts'),
					'desc' => __('for images from <b> Media library</b><br/>Recommended width: 1920px', 'mfn-opts'),
  			),

  			// options

  			array(
  				'title' => __('Options', 'mfn-opts'),
  			),

  			array(
  				'id' => 'style',
  				'type' => 'checkbox_pseudo',
  				'title' => __('Style', 'mfn-opts'),
  				'options' => mfna_section_style(),
  			),

				array(
  				'id' => 'navigation',
  				'type' => 'select',
  				'title' => __('Navigation', 'mfn-opts'),
  				'options' => array(
  					'' => __('None', 'mfn-opts'),
  					'arrows' => __('Arrows', 'mfn-opts'),
  				),
  			),

				array(
  				'id' => 'visibility',
  				'type' => 'select',
  				'title' => __('Responsive visibility', 'mfn-opts'),
  				'options' => array(
  					'' => __('- Default -', 'mfn-opts'),
  					'hide-desktop' => __('Hide on Desktop | 960px +', 'mfn-opts'),			// 960 +
  					'hide-tablet' => __('Hide on Tablet | 768px - 959px', 'mfn-opts'),		// 768 - 959
  					'hide-mobile' => __('Hide on Mobile | - 768px', 'mfn-opts'),			// - 768
  					'hide-desktop hide-tablet' => __('Hide on Desktop & Tablet', 'mfn-opts'),
  					'hide-desktop hide-mobile' => __('Hide on Desktop & Mobile', 'mfn-opts'),
  					'hide-tablet hide-mobile' => __('Hide on Tablet & Mobile', 'mfn-opts'),
  				),
  			),

				// custom

  			array(
  				'title' => __('Custom', 'mfn-opts'),
  			),

  			array(
  				'id' => 'class',
  				'type' => 'pills',
  				'title' => __('CSS classes', 'mfn-opts'),
  			),

  			array(
  				'id' => 'section_id',
  				'type' => 'text',
  				'title' => __('Section ID', 'mfn-opts'),
  				'desc' => __('Use this option to create One Page sites<br />Example: Your <b>Section ID</b> is <b>offer</b> and you want to open this section, please use link: <b>your-url/#offer</b>', 'mfn-opts'),
					'param' => 'id',
  			),

				// hidden attributes

  			array(
  				'id' => 'hide',
  				'type' => 'text',
  				'title' => __('Hide', 'mfn-opts'),
  				'row_class' => 'hidden',
  			),

  			array(
  				'id' => 'collapse',
  				'type' => 'text',
  				'title' => __('Collapse', 'mfn-opts'),
  				'row_class' => 'hidden',
  			),

  		);

  	}

    /**
     * SET wrap fields
   	 */

    private function set_wrap()
  	{
  		$this->wrap = array(

				// background

				array(
					'title' => __('Background', 'mfn-opts'),
				),

  			array(
  				'id' => 'bg_color',
  				'type' => 'color',
  				'title' => __('Color', 'mfn-opts'),
  				'alpha' => true,
  			),

  			array(
  				'id' => 'bg_image',
  				'type' => 'upload',
  				'title' => __('Image', 'mfn-opts'),
  				'desc' => __('Recommended image width <b>320px - 1920px</b> depending on size of the wrap', 'mfn-opts'),
  			),

  			array(
  				'id' => 'bg_position',
  				'type' => 'select',
  				'title' => __('Position', 'mfn-opts'),
					'desc' => __('iOS does <b>not</b> support background-position: fixed<br/>For parallax required background image size is at least 1920px x 1080px', 'mfn-opts'),
  				'options' => mfna_bg_position(),
  				'std' => 'center top no-repeat',
  			),

  			array(
  				'id' => 'bg_size',
  				'type' => 'select',
  				'title' => __('Size', 'mfn-opts'),
					'desc' => __('Does <b>not</b> work with position fixed or parallax', 'mfn-opts'),
  				'options' => mfna_bg_size(),
  			),

				// options

				array(
					'title' => __('Options', 'mfn-opts'),
				),

  			array(
  				'id' => 'move_up',
  				'type' => 'text',
  				'title' => __('Move up', 'mfn-opts'),
  				'desc' => __('Move this wrap to overflow on previous section. Does <b>not</b> work with parallax', 'mfn-opts'),
  				'after' => 'px',
  			),

  			array(
  				'id' => 'padding',
  				'type' => 'text',
  				'title' => __('Padding', 'mfn-opts'),
  				'desc' => __('Use value with <b>px</b> or <b>%</b><br />Example: 20px or 20px 10px 20px 10px or 20px 1%', 'mfn-opts'),
  			),

				// items

				array(
					'title' => __('Items', 'mfn-opts'),
				),

  			array(
  				'id' => 'column_margin',
  				'type' => 'select',
  				'title' => __('Margin bottom', 'mfn-opts'),
  				'options' => array(
  					'' => __('- Default -', 'mfn-opts'),
  					'0px' => '0px',
  					'10px' => '10px',
  					'20px' => '20px',
  					'30px' => '30px',
  					'40px' => '40px',
  					'50px' => '50px',
  				),
  			),

  			array(
  				'id' => 'vertical_align',
  				'type' => 'select',
  				'title' => __('Vertical align', 'mfn-opts'),
  				'desc' => __('for Section style: <b>Equal height of wraps</b>', 'mfn-opts'),
  				'options' => array(
  					'top' => __('Top', 'mfn-opts'),
  					'middle' => __('Middle', 'mfn-opts'),
  					'bottom' => __('Bottom', 'mfn-opts'),
  				),
  			),

				// custom

				array(
					'title' => __('Custom', 'mfn-opts'),
				),

				array(
  				'id' => 'class',
  				'type' => 'pills',
  				'title' => __('CSS classes', 'mfn-opts'),
  			),

				array(
					'id' => 'style',
					'type' => 'text',
					'title' => __('Inline CSS', 'mfn-opts'),
					'desc' => __('Example: <b>border: 1px solid #999;</b>', 'mfn-opts'),
					'class' => 'form-content-full-width',
				),

  		);

  	}

    /**
     * SET items and their fields
   	 */

   	private function set_items(){

   		$this->items = array(

				// Divider  -------------------------------------------------------

   			'divider' => array(
   				'type' => 'divider',
   				'title' => '&bull; '. __('Divider', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'other',
   				'fields' => array(

   					array(
   						'id' => 'height',
   						'type' => 'text',
   						'title' => __('Height', 'mfn-opts'),
							'param' => 'number',
							'class' => 'narrow',
							'after' => 'px',
   					),

   					array(
   						'id' => 'style',
   						'type' => 'switch',
   						'title' => __('Style', 'mfn-opts'),
   						'options' => array(
   							'default' => __('Default', 'mfn-opts'),
   							'dots' => __('Dots', 'mfn-opts'),
   							'zigzag' => __('ZigZag', 'mfn-opts'),
   						),
							'std' => 'default',
   					),

   					array(
   						'id' => 'line',
   						'type' => 'switch',
   						'title' => __('Line', 'mfn-opts'),
   						'desc' => __('for style: default', 'mfn-opts'),
   						'options' => array(
								'' => __('No line', 'mfn-opts'),
   							'default' => __('Default', 'mfn-opts'),
   							'narrow' => __('Narrow', 'mfn-opts'),
   							'wide' => __('Wide', 'mfn-opts'),
   						),
							'std' => '',
   					),

   					array(
   						'id' => 'color',
   						'type' => 'color',
   						'title' => __('Color', 'mfn-opts'),
							'alpha' => true,
   					),

   					array(
   						'id' => 'themecolor',
   						'type' => 'switch',
   						'title' => __('Theme color', 'mfn-opts'),
   						'desc' => __('Overwrites color selected above', 'mfn-opts'),
   						'options' => array(
   							0 => __('No', 'mfn-opts'),
   							1 => __('Yes', 'mfn-opts'),
   						),
							'std' => 0,
   					),

						// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Placeholder ----------------------------------------------------

   			'placeholder' => array(
   				'type' => 'placeholder',
   				'title' => '&bull; '. __('Placeholder', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'other',
   				'fields' => array(

   					array(
   						'id' => 'info',
   						'type' => 'info',
   						'title' => __('This item has no attributes.', 'mfn-opts'),
   					),

   				),
   			),

   			// Accordion  -----------------------------------------------------

   			'accordion' => array(
   				'type' => 'accordion',
   				'title' => __('Accordion', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'blocks',
   				'fields' => array(

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

						// tabs

						array(
   						'title' => __('Tabs', 'mfn-opts'),
   					),

   					array(
   						'id' => 'tabs',
   						'type' => 'tabs',
   						'title' => __('Accordion', 'mfn-opts'),
   						'desc' => __('<b>JavaScript</b> content like Google Maps and some plugins shortcodes do <b>not work</b> in tabs', 'mfn-opts'),
							'options' => [
								'title' => [
									'input',
									__('Title', 'mfn-opts'),
									__('Sample tab', 'mfn-opts'),
								],
								'content' => [
									'textarea',
									__('Content', 'mfn-opts'),
									'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu massa orci.',
								],
							],
							'std' => [
								0 => [
									'title' => __('This is the 1st item', 'mfn-opts'),
									'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu massa orci.',
								],
								1 => [
									'title' => __('This is the 2nd item', 'mfn-opts'),
									'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu massa orci.',
								],
							],
							'preview' => 'tabs',
							// 'primary' => 'title', // default
   					),

						// options

						array(
   						'title' => __('Options', 'mfn-opts'),
   					),

   					array(
   						'id' => 'open1st',
   						'type' => 'switch',
   						'title' => __('Open first', 'mfn-opts'),
   						'options' => array(
   							0 => __('Default', 'mfn-opts'),
   							1 => __('Open first', 'mfn-opts'),
   						),
							'std' => 0,
   					),

   					array(
   						'id' => 'openAll',
   						'type' => 'switch',
							'title' => __('Open all', 'mfn-opts'),
   						'options' => array(
								0 => __('Default', 'mfn-opts'),
   							1 => __('Open all', 'mfn-opts'),
							),
							'std' => 0,
   					),

   					array(
   						'id' => 'style',
   						'type' => 'switch',
   						'title' => __('Style', 'mfn-opts'),
   						'options' => array(
   							'accordion' => __('Accordion', 'mfn-opts'),
   							'toggle' => __('Toggle', 'mfn-opts'),
   						),
							'std' => 'accordion',
   					),

						// custom

						array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Article box  ---------------------------------------------------

   			'article_box' => array(
   				'type' => 'article_box',
   				'title' => __('Article box', 'mfn-opts'),
   				'size' => '1/3',
   				'cat' => 'boxes',
   				'fields' => array(

						array(
   						'id' => 'image',
   						'type' => 'upload',
   						'title' => __('Image', 'mfn-opts'),
   						'desc' => __('Recommended image width <b>384px - 960px</b> depending on size of the item', 'mfn-opts'),
							'std' => $this->get_placeholder(),
							'preview' => 'image',
   					),

   					array(
   						'id' => 'slogan',
   						'type' => 'text',
   						'title' => __('Slogan', 'mfn-opts'),
   						'desc' => __('Allowed HTML tags: span, strong, b, em, i, u', 'mfn-opts'),
							'std' => __('This is the slogan', 'mfn-opts'),
							'preview' => 'subtitle',
   					),

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
   						'desc' => __('Allowed HTML tags: span, strong, b, em, i, u', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

   					// link

   					array(
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'link',
   						'type' => 'text',
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'target',
   						'type' => 'select',
   						'title' => __('Target', 'mfn-opts'),
   						'options' => array(
   							0 => __('Default | _self', 'mfn-opts'),
   							1 => __('New tab or window | _blank', 'mfn-opts'),
   							'lightbox' => __('Lightbox (image or embed video)', 'mfn-opts'),
   						),
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'animate',
   						'type' => 'select',
   						'title' => __('Animation', 'mfn-opts'),
   						'desc' => __('Entrance animation', 'mfn-opts'),
   						'options' => $this->get_animations(),
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Before After  ---------------------------------------------------

   			'before_after' => array(
   				'type' => 'before_after',
   				'title' => __('Before After', 'mfn-opts'),
   				'size' => '1/3',
   				'cat' => 'boxes',
   				'fields' => array(

						// image

						array(
   						'title' => __('Image', 'mfn-opts'),
   					),

   					array(
   						'id' => 'image_before',
   						'type' => 'upload',
   						'title' => __('Before', 'mfn-opts'),
   						'desc' => __('Recommended image width <b>768px - 1920px</b> depending on size of the item', 'mfn-opts'),
							'std' => $this->get_placeholder(),
							'preview' => 'image',
   					),

   					array(
   						'id' => 'image_after',
   						'type' => 'upload',
   						'title' => __('After', 'mfn-opts'),
   						'desc' => __('Both images <b>must have the same size</b>', 'mfn-opts'),
							'std' => $this->get_placeholder(),
   					),

						// custom

						array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Blockquote -----------------------------------------------------

   			'blockquote' => array(
   				'type' => 'blockquote',
   				'title' => __('Blockquote', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'typography',
   				'fields' => array(

   					array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
   						'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
							'class' => 'form-content-full-width',
							'editor' => 'basic',
							'preview' => 'content',
   					),

   					array(
   						'id' => 'author',
   						'type' => 'text',
   						'title' => __('Author', 'mfn-opts'),
   						'std' => __('This is the author', 'mfn-opts'),
   					),

						// link

						array(
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'link',
   						'type' => 'text',
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'target',
   						'type' => 'select',
   						'title' => __('Target', 'mfn-opts'),
   						'options' => array(
   							0 => __('Default | _self', 'mfn-opts'),
   							1 => __('New tab or window | _blank', 'mfn-opts'),
   							'lightbox' => __('Lightbox (image or embed video)', 'mfn-opts'),
   						),
   					),

						// custom

						array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Blog -----------------------------------------------------------

   			'blog' => array(
   				'type' => 'blog',
   				'title' => __('Blog', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'loops',
   				'fields' => array(

   					array(
   						'id' => 'count',
   						'type' => 'text',
   						'title' => __('Posts number', 'mfn-opts'),
   						'std' => '3',
							'after' => 'posts',
							'param' => 'number',
							'class' => 'narrow',
							'preview' => 'number',
   					),

   					array(
   						'id' => 'style',
   						'type' => 'select',
   						'title' => __('Style', 'mfn-opts'),
   						'options' => array(
   							'classic' => __('Classic - 1 column', 'mfn-opts'),
   							'grid' => __('Grid - 2-4 columns', 'mfn-opts'),
   							'masonry' => __('Masonry blog style - 2-4 columns', 'mfn-opts'),
   							'masonry tiles' => __('Masonry tiles - 2-4 columns', 'mfn-opts'),
   							'photo' => __('Photo - 1 column', 'mfn-opts'),
   							'photo2' => __('Photo 2 - 1-3 columns', 'mfn-opts'),
   							'timeline' => __('Timeline - 1 column', 'mfn-opts'),
   						),
   						'std' => 'grid',
   						'preview' => 'style',
   					),

   					array(
   						'id' => 'columns',
   						'type' => 'switch',
   						'title' => __('Columns', 'mfn-opts'),
   						'desc' => __('for style: Grid, Masonry, Photo 2', 'mfn-opts'),
   						'options' => array(
   							2	=> 2,
   							3	=> 3,
   							4	=> 4,
   							5	=> 5,
   							6	=> 6,
   						),
   						'std' => 3,
   					),

						array(
   						'id' => 'title_tag',
   						'type' => 'switch',
   						'title' => __('Title tag', 'mfn-opts'),
   						'options' => array(
   							'h2' => 'H2',
   							'h3' => 'H3',
   							'h4' => 'H4',
   							'h5' => 'H5',
   							'h6' => 'H6',
   						),
   						'std' => 'h2'
   					),

   					array(
   						'id' => 'images',
   						'type' => 'switch',
   						'title' => __('Post image', 'mfn-opts'),
   						'desc' => __('for all styles except Masonry tiles', 'mfn-opts'),
   						'options' => array(
   							'' => 'Default',
   							'images-only' => 'Featured images only',
   						),
   					),

   					// options

   					array(
   						'title' => __('Options', 'mfn-opts'),
   					),

   					array(
   						'id' => 'category',
   						'type' => 'select',
   						'title' => __('Category', 'mfn-opts'),
   						'options' => mfn_get_categories('category'),
   						'preview' => 'category',
   					),

   					array(
   						'id' => 'category_multi',
   						'type' => 'text',
   						'title' => __('Multiple categories', 'mfn-opts'),
   						'desc' => __('Slugs should be separated with <b>coma</b> ( , )', 'mfn-opts'),
							'preview' => 'category-all',
   					),

   					array(
   						'id' => 'orderby',
   						'type' => 'switch',
   						'title' => __('Order by', 'mfn-opts'),
   						'desc' => __('Do <b>not</b> use random order with pagination or load more', 'mfn-opts'),
   						'options' => array(
   							'date' => __('Date', 'mfn-opts'),
   							'title' => __('Title', 'mfn-opts'),
   							'rand' => __('Random', 'mfn-opts'),
   						),
   						'std' => 'date'
   					),

   					array(
   						'id' => 'order',
   						'type' => 'switch',
   						'title' => __('Order', 'mfn-opts'),
   						'options' => array(
								'DESC' => __('Descending', 'mfn-opts'),
   							'ASC' => __('Ascending', 'mfn-opts'),
   						),
   						'std' => 'DESC'
   					),

						// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'exclude_id',
   						'type' => 'text',
   						'title' => __('Exclude posts', 'mfn-opts'),
   						'desc' => __('IDs should be separated with <b>coma</b> ( , )', 'mfn-opts'),
   					),

   					array(
   						'id' => 'filters',
   						'type' => 'select',
   						'title' => __('Filters', 'mfn-opts'),
   						'desc' => __('for style: Masonry and category: All<br />Does <b>not</b> work with pagination or load more', 'mfn-opts'),
   						'options' => array(
   							'0' => __('Hide', 'mfn-opts'),
   							'1' => __('Show', 'mfn-opts'),
   							'only-categories' => __('Show only categories', 'mfn-opts'),
   							'only-tags' => __('Show only tags', 'mfn-opts'),
   							'only-authors' => __('Show only authors', 'mfn-opts'),
   						),
   						'std' => '0'
   					),

						array(
   						'id' => 'excerpt',
   						'type' => 'switch',
							'title' => __('Excerpt', 'mfn-opts'),
   						'options' => array(
								0 => __('Hide', 'mfn-opts'),
   							1 => __('Show', 'mfn-opts'),
							),
   						'std' => 1,
   					),

   					array(
   						'id' => 'more',
   						'type' => 'switch',
							'title' => __('Read more', 'mfn-opts'),
   						'options' => array(
								0 => __('Hide', 'mfn-opts'),
   							1 => __('Show', 'mfn-opts'),
							),
   						'std' => 1,
   					),

						// pagination

   					array(
   						'title' => __('Pagination', 'mfn-opts'),
   					),

   					array(
   						'id' => 'pagination',
   						'type' => 'switch',
   						'title' => __('Pagination', 'mfn-opts'),
   						'desc' => __('Does <b>not</b> work on WMPL homepage', 'mfn-opts'),
							'options' => array(
								0 => __('Hide', 'mfn-opts'),
   							1 => __('Show', 'mfn-opts'),
							),
							'std' => 0,
   					),

   					array(
   						'id' => 'load_more',
   						'type' => 'switch',
   						'title' => __('Load more', 'mfn-opts'),
   						'desc' => __('Sliders will be replaced with featured images', 'mfn-opts'),
   						'options' => array(
								0 => __('Hide', 'mfn-opts'),
   							1 => __('Show', 'mfn-opts'),
   						),
							'std' => 0,
   					),

						// style

   					array(
   						'title' => __('Style', 'mfn-opts'),
   					),

   					array(
   						'id' => 'greyscale',
   						'type' => 'switch',
   						'title' => __('Grayscale', 'mfn-opts'),
							'options' => array(
   							0 => __('Disable', 'mfn-opts'),
   							1 => __('Enable', 'mfn-opts'),
   						),
							'std' => 0,
   					),

   					array(
   						'id' => 'margin',
   						'type' => 'switch',
   						'title' => __('Margin', 'mfn-opts'),
   						'desc' => __('for style: Masonry tiles', 'mfn-opts'),
							'options' => array(
								0 => __('Hide', 'mfn-opts'),
   							1 => __('Show', 'mfn-opts'),
   						),
							'std' => 0,
   					),

						// plugins

   					array(
   						'title' => __('Plugins', 'mfn-opts'),
   					),

   					array(
   						'id' => 'events',
   						'type' => 'switch',
   						'title' => __('Events', 'mfn-opts'),
   						'desc' => __('for category: All<br />requires free The Events Calendar plugin', 'mfn-opts'),
   						'options' => array(
								0 => __('Exclude', 'mfn-opts'),
   							1 => __('Include', 'mfn-opts'),
   						),
							'std' => 0,
   					),

						// custom

						array(
							'title' => __('Custom', 'mfn-opts'),
						),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Blog News ------------------------------------------------------

   			'blog_news' => array(
   				'type' => 'blog_news',
   				'title' => __('Blog News', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'loops',
   				'fields' => array(

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

						array(
   						'id' => 'count',
   						'type' => 'text',
   						'title' => __('Posts number', 'mfn-opts'),
   						'std' => '5',
							'after' => 'posts',
							'param' => 'number',
							'class' => 'narrow',
							'preview' => 'number',
   					),

   					array(
   						'id' => 'style',
   						'type' => 'switch',
   						'title' => __('Style', 'mfn-opts'),
   						'options' => array(
   							'' => __('Default', 'mfn-opts'),
   							'featured' => __('Featured 1st', 'mfn-opts'),
   						),
							'preview' => 'style',
   					),

   					// options

   					array(
   						'title' => __('Options', 'mfn-opts'),
   					),

   					array(
   						'id' => 'category',
   						'type' => 'select',
   						'title' => __('Category', 'mfn-opts'),
   						'options' => mfn_get_categories('category'),
   						'preview' => 'category',
   					),

   					array(
   						'id' => 'category_multi',
   						'type' => 'text',
   						'title' => __('Multiple categories', 'mfn-opts'),
   						'desc' => __('Slugs should be separated with <b>coma</b> ( , )', 'mfn-opts'),
							'preview' => 'category-all',
   					),

   					array(
   						'id' => 'orderby',
   						'type' => 'switch',
   						'title' => __('Order by', 'mfn-opts'),
   						'desc' => __('Do <b>not</b> use random order with pagination or load more', 'mfn-opts'),
   						'options' => array(
   							'date' => __('Date', 'mfn-opts'),
   							'title' => __('Title', 'mfn-opts'),
   							'rand' => __('Random', 'mfn-opts'),
   						),
   						'std' => 'date',
   					),

   					array(
   						'id' => 'order',
   						'type' => 'switch',
   						'title' => __('Order', 'mfn-opts'),
   						'options' => array(
								'DESC' => __('Descending', 'mfn-opts'),
   							'ASC' => __('Ascending', 'mfn-opts'),
   						),
   						'std' => 'DESC',
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'excerpt',
   						'type' => 'switch',
   						'title' => __('Excerpt', 'mfn-opts'),
   						'options' => array(
   							0 => __('Hide', 'mfn-opts'),
   							1 => __('Show', 'mfn-opts'),
   							'featured' => __('Show for featured only', 'mfn-opts'),
   						),
							'std' => 0,
   					),

   					array(
   						'id' => 'link',
   						'type' => 'text',
   						'title' => __('Button link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'link_title',
   						'type' => 'text',
   						'title' => __('Button title', 'mfn-opts'),
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Blog Slider ----------------------------------------------------

   			'blog_slider' => array(
   				'type' => 'blog_slider',
   				'title' => __('Blog Slider', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'loops',
   				'fields' => array(

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

						array(
   						'id' => 'count',
   						'type' => 'text',
   						'title' => __('Posts number', 'mfn-opts'),
   						'std' => '5',
							'after' => 'posts',
							'param' => 'number',
							'class' => 'narrow',
							'preview' => 'number',
   					),

   					// options

   					array(
   						'title' => __('Title', 'mfn-opts'),
   					),

   					array(
   						'id' => 'category',
   						'type' => 'select',
   						'title' => __('Category', 'mfn-opts'),
   						'options' => mfn_get_categories('category'),
							'preview' => 'category',
   					),

   					array(
   						'id' => 'category_multi',
   						'type' => 'text',
   						'title' => __('Multiple categories', 'mfn-opts'),
   						'desc' => __('Slugs should be separated with <b>coma</b> ( , )', 'mfn-opts'),
							'preview' => 'category-all',
   					),

   					array(
   						'id' => 'orderby',
   						'type' => 'switch',
   						'title' => __('Order by', 'mfn-opts'),
   						'desc' => __('Do <b>not</b> use random order with pagination or load more', 'mfn-opts'),
   						'options' => array(
   							'date' => __('Date', 'mfn-opts'),
   							'title' => __('Title', 'mfn-opts'),
   							'rand' => __('Random', 'mfn-opts'),
   						),
   						'std' => 'date',
   					),

   					array(
   						'id' => 'order',
   						'type' => 'switch',
   						'title' => __('Order', 'mfn-opts'),
   						'options' => array(
								'DESC' => __('Descending', 'mfn-opts'),
   							'ASC' => __('Ascending', 'mfn-opts'),

   						),
   						'std' => 'DESC'
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'more',
   						'type' => 'switch',
   						'title' => __('Read more', 'mfn-opts'),
   						'options' => array(
   							0 => __('Hide', 'mfn-opts'),
   							1 => __('Show', 'mfn-opts'),
   						),
   						'std' => 1,
   					),

   					array(
   						'id' => 'style',
   						'type' => 'switch',
   						'title' => __('Style', 'mfn-opts'),
   						'options' => array(
   							'' => __('Default', 'mfn-opts'),
   							'flat' => __('Flat', 'mfn-opts'),
   						),
							'std' => '',
   					),

   					array(
   						'id' => 'navigation',
   						'type' => 'switch',
   						'title' => __('Navigation', 'mfn-opts'),
   						'options' => array(
   							'' => __('Default', 'mfn-opts'),
   							'hide-arrows' => __('Hide arrows', 'mfn-opts'),
   							'hide-dots' => __('Hide dots', 'mfn-opts'),
   							'hide-nav' => __('Hide navigation', 'mfn-opts'),
   						),
							'std' => '',
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Blog Teaser ------------------------------------------------------

   			'blog_teaser' => array(
   				'type' => 'blog_teaser',
   				'title' => __('Blog Teaser', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'loops',
   				'fields' => array(

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

   					array(
   						'id' => 'title_tag',
   						'type' => 'switch',
   						'title' => __('Title tag', 'mfn-opts'),
   						'desc' => __('Title tag for 1st item, others use a smaller one', 'mfn-opts'),
   						'options' => array(
   							'h1' => 'H1',
   							'h2' => 'H2',
   							'h3' => 'H3',
   							'h4' => 'H4',
   							'h5' => 'H5',
   							'h6' => 'H6',
   						),
   						'std' => 'h3'
   					),

   					// options

   					array(
   						'title' => __('Options', 'mfn-opts'),
   					),

   					array(
   						'id' => 'category',
   						'type' => 'select',
   						'title' => __('Category', 'mfn-opts'),
   						'options' => mfn_get_categories('category'),
							'preview' => 'category',
   					),

   					array(
   						'id' => 'category_multi',
   						'type' => 'text',
   						'title' => __('Multiple categories', 'mfn-opts'),
   						'desc' => __('Slugs should be separated with <b>coma</b> ( , )', 'mfn-opts'),
							'preview' => 'category-all',
   					),

   					array(
   						'id' => 'orderby',
   						'type' => 'switch',
   						'title' => __('Order by', 'mfn-opts'),
   						'desc' => __('Do <b>not</b> use random order with pagination or load more', 'mfn-opts'),
   						'options' => array(
   							'date' => __('Date', 'mfn-opts'),
   							'title' => __('Title', 'mfn-opts'),
   							'rand' => __('Random', 'mfn-opts'),
   						),
   						'std' => 'date'
   					),

   					array(
   						'id' => 'order',
   						'type' => 'switch',
   						'title' => __('Order', 'mfn-opts'),
   						'options' => array(
								'DESC' => __('Descending', 'mfn-opts'),
   							'ASC' => __('Ascending', 'mfn-opts'),

   						),
   						'std' => 'DESC'
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'margin',
   						'type' => 'switch',
   						'title' => __('Margin', 'mfn-opts'),
   						'options' => array(
								'0' => __('Disable', 'mfn-opts'),
   							'1' => __('Enable', 'mfn-opts'),
   						),
							'std' => '0'
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Button ----------------------------------------------------

   			'button' => array(
   				'type' => 'button',
   				'title' => __('Button', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'typography',
   				'fields' => array(

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('Click here', 'mfn-opts'),
							'preview' => 'title',
   					),

   					array(
   						'id' => 'link',
   						'type' => 'text',
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'target',
   						'type' => 'select',
   						'title' => __('Link target', 'mfn-opts'),
   						'options' => array(
   							0 => __('Default | _self', 'mfn-opts'),
   							1 => __('New tab or window | _blank', 'mfn-opts'),
   							'lightbox' => __('Lightbox (image or embed video)', 'mfn-opts'),
   						),
   					),

   					array(
   						'id' => 'align',
   						'type' => 'switch',
   						'title' => __('Align', 'mfn-opts'),
   						'options' => array(
   							'' => __('Left', 'mfn-opts'),
   							'center' => __('Center', 'mfn-opts'),
   							'right' => __('Right', 'mfn-opts'),
   						),
							'std' => '',
							'preview' => 'align',
   					),

   					// icon

   					array(
   						'title' => __('Icon', 'mfn-opts'),
   					),

   					array(
   						'id' => 'icon',
   						'type' => 'icon',
   						'title' => __('Icon', 'mfn-opts'),
   					),

   					array(
   						'id' => 'icon_position',
   						'type' => 'switch',
   						'title' => __('Position', 'mfn-opts'),
   						'options' => array(
   							'left' => __('Left', 'mfn-opts'),
   							'right' => __('Right', 'mfn-opts'),
   						),
							'std' => 'left',
   					),

   					// color

   					array(
   						'title' => __('Color', 'mfn-opts'),
   					),

   					array(
   						'id' => 'color',
   						'type' => 'color',
   						'title' => __('Background', 'mfn-opts'),
   						'desc' => __('For theme color button please enter <b>theme</b> in color filed', 'mfn-opts'),
   					),

   					array(
   						'id' => 'font_color',
   						'type' => 'color',
   						'title' => __('Font', 'mfn-opts'),
   					),

   					// style

   					array(
   						'title' => __('Style', 'mfn-opts'),
   					),

   					array(
   						'id' => 'size',
   						'type' => 'switch',
   						'title' => __('Size', 'mfn-opts'),
   						'options' => array(
   							1 => __('Small', 'mfn-opts'),
   							2 => __('Default', 'mfn-opts'),
   							3 => __('Large', 'mfn-opts'),
   							4 => __('XL', 'mfn-opts'),
   						),
   						'std' => 2,
   					),

   					array(
   						'id' => 'full_width',
   						'type' => 'switch',
   						'title' => __('Width', 'mfn-opts'),
   						'options' => array(
   							0 => __('Default', 'mfn-opts'),
   							1 => __('Full width', 'mfn-opts'),
   						),
							'std' => 0,
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'class',
   						'type' => 'text',
   						'title' => __('Class', 'mfn-opts'),
   						'desc' => __('This option is useful when you want to use <b>scroll</b>', 'mfn-opts'),
   					),

						array(
   						'id' => 'download',
   						'type' => 'text',
   						'title' => __('Download', 'mfn-opts'),
   						'desc' => __('Enter the new filename for the downloaded file', 'mfn-opts'),
   					),

   					array(
   						'id' => 'rel',
   						'type' => 'text',
   						'title' => __('Rel', 'mfn-opts'),
   						'before' => 'rel=',
   					),

   					array(
   						'id' => 'onclick',
   						'type' => 'text',
   						'title' => __('Onclick', 'mfn-opts'),
							'before' => 'onclick=',
   					),

   				),
   			),

   			// Call to Action -------------------------------------------------

   			'call_to_action' => array(
   				'type' => 'call_to_action',
   				'title' => __('Call to Action', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'elements',
   				'fields' => array(

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

   					array(
   						'id' => 'icon',
   						'type' => 'icon',
   						'title' => __('Icon', 'mfn-opts'),
   						'std' => 'icon-check',
   						'preview' => 'icon',
   					),

   					array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
							'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
   						'preview' => 'content',
							'class' => 'form-content-full-width',
   					),

   					// link

   					array(
   						'title' => __('Link', 'mfn-opts'),
   					),

						array(
   						'id' => 'button_title',
   						'type' => 'text',
   						'title' => __('Button title', 'mfn-opts'),
   						'desc' => __('Leave this field blank if you want Call to action with big icon', 'mfn-opts'),
   					),

   					array(
   						'id' => 'link',
   						'type' => 'text',
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'target',
   						'type' => 'select',
   						'title' => __('Target', 'mfn-opts'),
   						'options' => array(
   							0 => __('Default | _self', 'mfn-opts'),
   							1 => __('New tab or window | _blank', 'mfn-opts'),
   							'lightbox' => __('Lightbox (image or embed video)', 'mfn-opts'),
   						),
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'class',
   						'type' => 'text',
   						'title' => __('Class', 'mfn-opts'),
   						'desc' => __('This option is useful when you want to use <b>scroll</b>', 'mfn-opts'),
   					),

   					array(
   						'id' => 'animate',
   						'type' => 'select',
   						'title' => __('Animation', 'mfn-opts'),
   						'options' => $this->get_animations(),
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Chart  ---------------------------------------------------------

   			'chart' => array(
   				'type' => 'chart',
   				'title' => __('Chart', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'boxes',
   				'fields' => array(

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

   					// chart

   					array(
   						'title' => __('Chart', 'mfn-opts'),
   					),

   					array(
   						'id' => 'percent',
   						'type' => 'text',
   						'title' => __('Percent', 'mfn-opts'),
   						'desc' => __('0-100', 'mfn-opts'),
							'param' => 'number',
							'after' => '%',
							'class' => 'narrow',
							'preview' => 'number',
							'std' => 50,
   					),

   					array(
   						'id' => 'label',
   						'type' => 'text',
   						'title' => __('Label', 'mfn-opts'),
							'preview' => 'subtitle',
   					),

   					array(
   						'id' => 'icon',
   						'type' => 'icon',
   						'title' => __('Icon', 'mfn-opts'),
							'std' => 'icon-check',
   					),

   					array(
   						'id' => 'image',
   						'type' => 'upload',
   						'title' => __('Image', 'mfn-opts'),
   						'desc' => __('Recommended image size <b>70px x 70px</b>', 'mfn-opts'),
   					),

   					// options

   					array(
   						'title' => __('Options', 'mfn-opts'),
   					),

						array(
   						'id' => 'color',
   						'type' => 'color',
   						'title' => __('Color', 'mfn-opts'),
   						'desc' => __('Overrides color set in Theme Options', 'mfn-opts'),
   					),

   					array(
   						'id' => 'line_width',
   						'type' => 'text',
   						'title' => __('Line thickness', 'mfn-opts'),
							'param' => 'number',
							'after' => 'px',
							'class' => 'narrow',
							'placeholder' => 4,
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Clients  -------------------------------------------------------

   			'clients' => array(
   				'type' => 'clients',
   				'title' => __('Clients', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'loops',
   				'fields' => array(

   					array(
   						'id' => 'in_row',
   						'type' => 'text',
   						'title' => __('Items in row', 'mfn-opts'),
   						'desc' => __('Recommended: 3-6', 'mfn-opts'),
							'after' => 'items',
							'param' => 'number',
							'class' => 'narrow',
   						'std' => 6,
   						'preview' => 'number',
   					),

						array(
   						'id' => 'style',
   						'type' => 'switch',
   						'title' => __('Style', 'mfn-opts'),
   						'options' => array(
   							'' => __('Default', 'mfn-opts'),
   							'tiles' => __('Tiles', 'mfn-opts'),
   						),
							'std' => '',
							'preview' => 'style',
   					),

						// options

   					array(
   						'title' => __('Options', 'mfn-opts'),
   					),

   					array(
   						'id' => 'category',
   						'type' => 'select',
   						'title' => __('Category', 'mfn-opts'),
   						'options' => mfn_get_categories('client-types'),
							'preview' => 'category',
   					),

   					array(
   						'id' => 'orderby',
   						'type' => 'switch',
   						'title' => __('Order by', 'mfn-opts'),
   						'options' => array(
   							'date' => __('Date', 'mfn-opts'),
   							'menu_order' => __('Menu order', 'mfn-opts'),
   							'title' => __('Title', 'mfn-opts'),
   							'rand' => __('Random', 'mfn-opts'),
   						),
   						'std' => 'menu_order'
   					),

   					array(
   						'id' => 'order',
   						'type' => 'switch',
   						'title' => __('Order', 'mfn-opts'),
   						'options' => array(
								'DESC' => __('Descending', 'mfn-opts'),
   							'ASC' => __('Ascending', 'mfn-opts'),
   						),
   						'std' => 'ASC',
   					),

						// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'greyscale',
   						'type' => 'switch',
   						'title' => 'Grayscale',
   						'options' => array(
   							0 => __('Disable', 'mfn-opts'),
   							1 => __('Enable', 'mfn-opts'),
   						),
							'std' => 0,
   					),

						// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Clients Slider -------------------------------------------------

   			'clients_slider' => array(
   				'type' => 'clients_slider',
   				'title' => __('Clients Slider', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'loops',
   				'fields' => array(

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

						// options

   					array(
   						'title' => __('Options', 'mfn-opts'),
   					),

   					array(
   						'id' => 'category',
   						'type' => 'select',
   						'title' => __('Category', 'mfn-opts'),
   						'options' => mfn_get_categories('client-types'),
							'preview' => 'category',
   					),

   					array(
   						'id' => 'orderby',
   						'type' => 'switch',
   						'title' => __('Order by', 'mfn-opts'),
   						'options' => array(
   							'date' => __('Date', 'mfn-opts'),
   							'menu_order' => __('Menu order', 'mfn-opts'),
   							'title' => __('Title', 'mfn-opts'),
   							'rand' => __('Random', 'mfn-opts'),
   						),
   						'std' => 'menu_order'
   					),

   					array(
   						'id' => 'order',
   						'type' => 'switch',
   						'title' => __('Order', 'mfn-opts'),
   						'options' => array(
								'DESC' => __('Descending', 'mfn-opts'),
   							'ASC' => __('Ascending', 'mfn-opts'),
   						),
   						'std' => 'ASC'
   					),

						// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Code  ----------------------------------------------------------

   			'code' => array(
   				'type' => 'code',
   				'title' => __('Code', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'other',
   				'fields' => array(

   					array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
							'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
							'class' => 'form-content-full-width',
   					),

						array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Column  --------------------------------------------------------

   			'column' => array(
   				'type' => 'column',
   				'title' => __('Column', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'typography',
   				'fields' => array(

						// HTML content

						array(
   						'type' => 'html',
   						'html' => '<div class="modalbox-card modalbox-card-content active">',
   					),

   					array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
   						'class' => 'form-content-full-width',
							'editor' => 'full', // basic (bold, i, etc), full (media, shortcodes)
							'preview' => 'content',
							'vbstd' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
   					),

						// HTML end: content

						array(
   						'type' => 'html',
   						'html' => '</div>',
   					),

						// HTML settings

						array(
   						'type' => 'html',
   						'html' => '<div class="modalbox-card modalbox-card-settings">',
   					),

						array(
							'id' => 'title',
							'type' => 'text',
							'title' => __('Label', 'mfn-opts'),
							'desc' => __('This field is only used as label in the builder', 'mfn-opts'),
							'preview' => 'title',
						),

						// text align

   					array(
   						'title' => __('Text align', 'mfn-opts'),
   					),

   					array(
   						'id' => 'align',
   						'type' => 'switch',
   						'title' => __('Text align', 'mfn-opts'),
   						'options' => array(
   							'' => __('Default', 'mfn-opts'),
   							'left' => __('Left', 'mfn-opts'),
								'center' => __('Center', 'mfn-opts'),
   							'right' => __('Right', 'mfn-opts'),
   							'justify' => __('Justify', 'mfn-opts'),
   						),
							'preview' => 'align',
   					),

   					array(
   						'id' => 'align-mobile',
   						'type' => 'switch',
   						'title' => __('Mobile text align', 'mfn-opts'),
   						'options' => array(
   							'' => __('As above', 'mfn-opts'),
   							'left' => __('Left', 'mfn-opts'),
								'center' => __('Center', 'mfn-opts'),
   							'right' => __('Right', 'mfn-opts'),
   							'justify' => __('Justify', 'mfn-opts'),
   						),
   					),

   					// background

   					array(
   						'title' => __('Background', 'mfn-opts'),
   					),

   					array(
   						'id' => 'column_bg',
   						'type' => 'color',
   						'title' => __('Color', 'mfn-opts'),
   						'alpha' => true,
   					),

   					array(
   						'id' => 'bg_image',
   						'type' => 'upload',
   						'title' => __('Image', 'mfn-opts'),
   					),

   					array(
   						'id' => 'bg_position',
   						'type' => 'select',
   						'title' => __('Position', 'mfn-opts'),
   						'options' => mfna_bg_position('column'),
   						'std' => 'center top no-repeat',
   					),

   					array(
   						'id' => 'bg_size',
   						'type' => 'select',
   						'title' => __('Size', 'mfn-opts'),
   						'options' => mfna_bg_size(),
   					),

   					// layout

   					array(
   						'title' => __('Layout', 'mfn-opts'),
   					),

   					array(
   						'id' => 'margin_bottom',
   						'type' => 'select',
   						'title' => __('Margin bottom', 'mfn-opts'),
   						'options' => array(
   							'' => __('- Default -', 'mfn-opts'),
   							'0px' => '0px',
   							'10px' => '10px',
   							'20px' => '20px',
   							'30px' => '30px',
   							'40px' => '40px',
   							'50px' => '50px',
   						),
   					),

   					array(
   						'id' => 'padding',
   						'type' => 'text',
   						'title' => __('Padding', 'mfn-opts'),
   						'desc' => __('Use value with <b>px</b> or <b>%</b>. Example: <b>20px</b> or <b>20px 10px 20px 10px</b> or <b>20px 1%</b>', 'mfn-opts'),
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'animate',
   						'type' => 'select',
   						'title' => __('Animation', 'mfn-opts'),
   						'options' => $this->get_animations(),
   					),

						// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   					array(
   						'id' => 'style',
   						'type' => 'text',
   						'title' => __('Inline CSS', 'mfn-opts'),
   						'desc' => __('Example: <b>border: 1px solid #999;</b>', 'mfn-opts'),
							'class' => 'form-content-full-width',
   					),

						// HTML end: settings

						array(
   						'type' => 'html',
   						'html' => '</div>',
   					),

   				),
   			),

   			// Contact box ----------------------------------------------------

   			'contact_box' => array(
   				'type' => 'contact_box',
   				'title' => __('Contact Box', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'elements',
   				'fields' => array(

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

   					array(
   						'id' => 'address',
   						'type' => 'textarea',
   						'title' => __('Address', 'mfn-opts'),
   						'desc' => __('HTML tags allowed', 'mfn-opts'),
							'std' => 'This is the address',
							'preview' => 'content',
							'class' => 'form-content-full-width',
   					),

   					array(
   						'id' => 'telephone',
   						'type' => 'text',
   						'title' => __('Phone', 'mfn-opts'),
   					),

   					array(
   						'id' => 'telephone_2',
   						'type' => 'text',
   						'title' => __('Second phone', 'mfn-opts'),
   					),

   					array(
   						'id' => 'fax',
   						'type' => 'text',
   						'title' => __('Fax', 'mfn-opts'),
   					),

   					array(
   						'id' => 'email',
   						'type' => 'text',
   						'title' => __('Email', 'mfn-opts'),
   					),

   					array(
   						'id' => 'www',
   						'type' => 'text',
   						'title' => __('WWW', 'mfn-opts'),
   					),

						// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

						array(
   						'id' => 'image',
   						'type' => 'upload',
   						'title' => __('Background image', 'mfn-opts'),
   						'desc' => __('Recommended image width <b>768px - 1920px</b> depending on size of the item', 'mfn-opts'),
   					),

   					array(
   						'id' => 'animate',
   						'type' => 'select',
   						'title' => __('Animation', 'mfn-opts'),
   						'options' => $this->get_animations(),
   					),

						// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Content  -------------------------------------------------------

   			'content' => array(
   				'type' => 'content',
   				'title' => __('Content WP', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'typography',
   				'fields' => array(

   					array(
							'id' => 'info',
   						'type' => 'info',
   						'title' => __('Content from WordPress editor. Can be used once per page.', 'mfn-opts'),
   					),

						// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Countdown  -----------------------------------------------------

   			'countdown' => array(
   				'type' => 'countdown',
   				'title' => __('Countdown', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'boxes',
   				'fields' => array(

   					array(
   						'id' => 'date',
   						'type' => 'text',
   						'title' => __('Launch date', 'mfn-opts'),
   						'desc' => __('month/day/year hour:minute:second', 'mfn-opts'),
   						'std' => '12/30/2021 12:00:00',
							'preview' => 'title',
   					),

   					array(
   						'id' => 'timezone',
   						'type' => 'select',
   						'title' => __('Timezone', 'mfn-opts'),
   						'options' => mfna_utc(),
   						'std' => '0',
   					),

   					// options

   					array(
   						'title' => __('Options', 'mfn-opts'),
   					),

   					array(
   						'id' => 'show',
   						'type' => 'select',
   						'title' => __('Show', 'mfn-opts'),
   						'options' => array(
   							'' => __('days hours minutes seconds', 'mfn-opts'),
   							'dhm' => __('days hours minutes', 'mfn-opts'),
   							'dh' => __('days hours', 'mfn-opts'),
   							'd' => __('days', 'mfn-opts'),
   						),
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Counter  -------------------------------------------------------

   			'counter' => array(
   				'type' => 'counter',
   				'title' => __('Counter', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'boxes',
   				'fields' => array(

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

   					// counter

   					array(
   						'title' => __('Counter', 'mfn-opts'),
   					),

   					array(
   						'id' => 'icon',
   						'type' => 'icon',
   						'title' => __('Icon', 'mfn-opts'),
   						'std' => 'icon-lamp',
   						'preview' => 'icon',
   					),

   					array(
   						'id' => 'color',
   						'type' => 'color',
   						'title' => __('Icon color', 'mfn-opts'),
   					),

   					array(
   						'id' => 'image',
   						'type' => 'upload',
   						'title' => __('Image', 'mfn-opts'),
   						'desc' => __('Replaces icon if uploaded', 'mfn-opts'),
							'preview' => 'image',
   					),

   					array(
   						'id' => 'prefix',
   						'type' => 'text',
   						'title' => __('Prefix', 'mfn-opts'),
							'class' => 'narrow',
   					),

   					array(
   						'id' => 'number',
   						'type' => 'text',
   						'title' => __('Number', 'mfn-opts'),
							'param' => 'number',
							'class' => 'narrow',
							'std' => '50',
							'preview' => 'number',
   					),

   					array(
   						'id' => 'label',
   						'type' => 'text',
   						'title' => __('Postfix', 'mfn-opts'),
							'class' => 'narrow',
   					),

   					// options

   					array(
   						'title' => __('Options', 'mfn-opts'),
   					),

   					array(
   						'id' => 'type',
   						'type' => 'switch',
   						'title' => __('Style', 'mfn-opts'),
   						'desc' => __('Vertical style works for column widths: 1/4, 1/3 & 1/2', 'mfn-opts'),
   						'options' => array(
   							'vertical' => __('Vertical', 'mfn-opts'),
								'horizontal' => __('Horizontal', 'mfn-opts'),
   						),
   						'std' => 'vertical',
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'animate',
   						'type' => 'select',
   						'title' => __('Animation', 'mfn-opts'),
   						'options' => $this->get_animations(),
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),



   			// Fancy Divider  -------------------------------------------------

   			'fancy_divider' => array(
   				'type' => 'fancy_divider',
   				'title' => __('Fancy Divider', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'elements',
   				'fields' => array(

   					array(
							'id' => 'info',
							'type' => 'info',
   						'title' => __('Please use on pages without sidebar.', 'mfn-opts'),
   					),

   					array(
   						'id' => 'style',
   						'type' => 'select',
   						'title' => __('Style', 'mfn-opts'),
   						'options' => array(
   							'circle up' => __('Circle up', 'mfn-opts'),
   							'circle down' => __('Circle down', 'mfn-opts'),
   							'curve up' => __('Curve up', 'mfn-opts'),
   							'curve down' => __('Curve down', 'mfn-opts'),
   							'stamp' => __('Stamp', 'mfn-opts'),
   							'triangle up' => __('Triangle up', 'mfn-opts'),
   							'triangle down' => __('Triangle down', 'mfn-opts'),
   						),
							'std' => 'circle up',
							'preview' => 'style',
   					),

   					array(
   						'id' => 'color_top',
   						'type' => 'color',
   						'title' => __('Color top', 'mfn-opts'),
   					),

   					array(
   						'id' => 'color_bottom',
   						'type' => 'color',
   						'title' => __('Color bottom', 'mfn-opts'),
   					),

						array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Fancy Heading --------------------------------------------------

   			'fancy_heading' => array(
   				'type' => 'fancy_heading',
   				'title' => __('Fancy Heading', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'elements',
   				'fields' => array(

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

   					array(
   						'id' => 'h1',
   						'type' => 'switch',
   						'title' => __('Tag', 'mfn-opts'),
   						'options' => array(
   							1 => 'H1',
								0 => 'H2',
   						),
							'std' => 0
   					),

   					array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
							'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
							'preview' => 'content',
							'class' => 'form-content-full-width',
   					),

   					// style

   					array(
   						'title' => __('Style', 'mfn-opts'),
   					),

   					array(
   						'id' => 'style',
   						'type' => 'switch',
   						'title' => __('Style', 'mfn-opts'),
   						'options' => array(
   							'icon' => __('Icon', 'mfn-opts'),
   							'line' => __('Line', 'mfn-opts'),
   							'arrows' => __('Arrows', 'mfn-opts'),
   						),
							'std' => 'icon',
   					),

   					array(
   						'id' => 'icon',
   						'type' => 'icon',
   						'title' => __('Icon', 'mfn-opts'),
   						'desc' => __('for style: icon', 'mfn-opts'),
   					),

   					array(
   						'id' => 'slogan',
   						'type' => 'text',
   						'title' => __('Slogan', 'mfn-opts'),
   						'desc' => __('for style: line', 'mfn-opts'),
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'animate',
   						'type' => 'select',
   						'title' => __('Animation', 'mfn-opts'),
   						'options' => $this->get_animations(),
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// FAQ  -----------------------------------------------------------

   			'faq' => array(
   				'type' => 'faq',
   				'title' => __('FAQ', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'blocks',
   				'fields' => array(

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

   					array(
   						'id' => 'tabs',
   						'type' => 'tabs',
   						'title' => __('FAQ', 'mfn-opts'),
   						'desc' => __('<b>JavaScript</b> content like Google Maps and some plugins shortcodes do <b>not work</b> in tabs', 'mfn-opts'),
							'options' => [
								'title' => [
									'input',
									__('Question', 'mfn-opts'),
									__('Sample question', 'mfn-opts'),
								],
								'content' => [
									'textarea',
									__('Answer', 'mfn-opts'),
									'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu massa orci.',
								],
							],
							'std' => [
								0 => [
									'title' => __('This is the 1st question', 'mfn-opts'),
									'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu massa orci.',
								],
								1 => [
									'title' => __('This is the 2nd question', 'mfn-opts'),
									'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu massa orci.',
								],
							],
							'preview' => 'tabs',
   					),

						array(
   						'id' => 'open1st',
   						'type' => 'switch',
   						'title' => __('Open first', 'mfn-opts'),
   						'options' => array(
   							0 => __('Default', 'mfn-opts'),
   							1 => __('Open first', 'mfn-opts'),
   						),
							'std' => '0',
   					),

   					array(
   						'id' => 'openAll',
   						'type' => 'switch',
							'title' => __('Open all', 'mfn-opts'),
   						'options' => array(
								0 => __('Default', 'mfn-opts'),
   							1 => __('Open all', 'mfn-opts'),
							),
							'std' => '0',
   					),

						array(
   						'id' => 'style',
   						'type' => 'switch',
   						'title' => __('Style', 'mfn-opts'),
   						'options' => array(
   							'accordion' => __('Accordion', 'mfn-opts'),
   							'toggle' => __('Toggle', 'mfn-opts'),
   						),
							'std' => 'accordion',
   					),

						// custom

						array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Feature Box -------------------------------------------------------

   			'feature_box' => array(
   				'type' => 'feature_box',
   				'title' => __('Feature Box', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'boxes',
   				'fields' => array(

   					array(
   						'id' => 'image',
   						'type' => 'upload',
   						'title' => __('Image', 'mfn-opts'),
   						'desc' => __('Recommended image width <b>384px - 960px</b> depending on size of the item', 'mfn-opts'),
							'std' => $this->get_placeholder(),
							'preview' => 'image',
   					),

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
   						'desc' => __('Allowed HTML tags: span, strong, b, em, i, u', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

   					array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
							'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
							'preview' => 'content',
							'class' => 'form-content-full-width',
   					),

   					array(
   						'id' => 'background',
   						'type' => 'color',
   						'title' => __('Background color', 'mfn-opts'),
   					),

   					// link

   					array(
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'link',
   						'type' => 'text',
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'target',
   						'type' => 'select',
   						'title' => __('Target', 'mfn-opts'),
   						'options' => array(
   							0 => __('Default | _self', 'mfn-opts'),
   							1 => __('New tab or window | _blank', 'mfn-opts'),
   							'lightbox' => __('Lightbox (image or embed video)', 'mfn-opts'),
   						),
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'animate',
   						'type' => 'select',
   						'title' => __('Animation', 'mfn-opts'),
   						'options' => $this->get_animations(),
   					),

						// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Feature List ---------------------------------------------------

   			'feature_list' => array(
   				'type' => 'feature_list',
   				'title' => __('Feature List', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'elements',
   				'fields' => array(

						array(
   						'id' => 'tabs',
   						'type' => 'tabs',
   						'title' => __('Items', 'mfn-opts'),
							'options' => [
								'title' => [
									'input',
									__('Title', 'mfn-opts'),
									__('List item', 'mfn-opts'),
								],
								'icon' => [
									'input',
									__('Icon', 'mfn-opts'),
									'icon-lamp',
								],
								'link' => [
									'input',
									__('Link', 'mfn-opts'),
									'',
								],
								'target' => [
									'input',
									__('Target', 'mfn-opts'),
									'',
								],
								'animate' => [
									'input',
									__('Animate', 'mfn-opts'),
									'',
								],
							],
							'std' => [
								0 => [
									'title' => 'This is the 1st item',
									'icon' => 'icon-book',
									'link' => '',
									'target' => '',
									'animate' => '',
								],
								1 => [
									'title' => 'This is the 2nd item',
									'icon' => 'icon-bucket',
									'link' => '',
									'target' => '',
									'animate' => '',
								],
							],
							'preview' => 'tabs',
   					),

   					array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
   						'preview' => 'content',
							'class' => 'form-content-full-width',
   					),

   					array(
   						'id' => 'columns',
   						'type' => 'switch',
   						'title' => __('Columns', 'mfn-opts'),
   						'options' => array(
   							2	=> 2,
   							3	=> 3,
   							4	=> 4,
   							5	=> 5,
   							6	=> 6,
   						),
   						'std' => 4,
   					),

						array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Flat Box -------------------------------------------------------

   			'flat_box' => array(
   				'type' => 'flat_box',
   				'title' => __('Flat Box', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'boxes',
   				'fields' => array(

   					array(
   						'id' => 'image',
   						'type' => 'upload',
   						'title' => __('Image', 'mfn-opts'),
   						'desc' => __('Recommended image width <b>768px - 1920px</b> depending on size of the item', 'mfn-opts'),
							'std' => $this->get_placeholder(),
							'preview' => 'image',
   					),

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
   						'desc' => __('Allowed HTML tags: span, strong, b, em, i, u', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

   					array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
							'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
							'preview' => 'content',
							'class' => 'form-content-full-width',
   					),

   					// icon

   					array(
   						'title' => __('Icon', 'mfn-opts'),
   					),

   					array(
   						'id' => 'icon',
   						'type' => 'icon',
   						'title' => __('Icon', 'mfn-opts'),
   						'std' => 'icon-lamp',
   					),

   					array(
   						'id' => 'icon_image',
   						'type' => 'upload',
   						'title' => __('Image', 'mfn-opts'),
   						'desc' => __('Replaces icon if uploaded', 'mfn-opts'),
   					),

   					array(
   						'id' => 'background',
   						'type' => 'color',
   						'title' => __('Background', 'mfn-opts'),
   					),

   					// link

   					array(
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'link',
   						'type' => 'text',
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'target',
   						'type' => 'select',
   						'title' => __('Target', 'mfn-opts'),
   						'options' => array(
   							0 => __('Default | _self', 'mfn-opts'),
   							1 => __('New tab or window | _blank', 'mfn-opts'),
   							'lightbox' => __('Lightbox (image or embed video)', 'mfn-opts'),
   						),
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'animate',
   						'type' => 'select',
   						'title' => __('Animation', 'mfn-opts'),
   						'options' => $this->get_animations(),
   					),

						// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Helper -------------------------------------------------------

   			'helper' => array(
   				'type' => 'helper',
   				'title' => __('Helper', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'blocks',
   				'fields' => array(

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

   					array(
   						'id' => 'title_tag',
   						'type' => 'switch',
   						'title' => __('Tag', 'mfn-opts'),
   						'options' => array(
   							'h1' => 'H1',
   							'h2' => 'H2',
   							'h3' => 'H3',
   							'h4' => 'H4',
   							'h5' => 'H5',
   							'h6' => 'H6',
   						),
   						'std' => 'h4',
   					),

						// item 1

   					array(
   						'title' => __('Item 1', 'mfn-opts'),
   					),

   					array(
   						'id' => 'title1',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the 1st item title', 'mfn-opts'),
   					),

   					array(
   						'id' => 'content1',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
   						'desc' => __('Some shortcodes and HTML tags allowed', 'mfn-opts'),
							'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
							'class' => 'form-content-full-width',
   					),

   					array(
   						'id' => 'link1',
   						'type' => 'text',
   						'title' => __('Link', 'mfn-opts'),
   						'desc' => __('Use if you want to link to another page instead of showing the content', 'mfn-opts'),
   					),

   					array(
   						'id' => 'target1',
   						'type' => 'switch',
							'title' => __('Link target', 'mfn-opts'),
   						'options' => array(
								0 => __('_self', 'mfn-opts'),
								1 => __('_blank', 'mfn-opts'),
							),
							'std' => 0,
   					),

   					array(
   						'id' => 'class1',
   						'type' => 'text',
   						'title' => __('Link class', 'mfn-opts'),
   						'desc' => __('e.g. <b>prettyphoto</b> or <b>scroll</b>', 'mfn-opts'),
   					),

						// item 2

   					array(
   						'title' => __('Item 2', 'mfn-opts'),
   					),

   					array(
   						'id' => 'title2',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
   					),

   					array(
   						'id' => 'content2',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
   						'desc' => __('Some shortcodes and HTML tags allowed', 'mfn-opts'),
							'class' => 'form-content-full-width',
   					),

   					array(
   						'id' => 'link2',
   						'type' => 'text',
   						'title' => __('Link', 'mfn-opts'),
   						'desc' => __('Use if you want to link to another page instead of showing the content', 'mfn-opts'),
   					),

   					array(
   						'id' => 'target2',
   						'type' => 'switch',
							'title' => __('Link target', 'mfn-opts'),
   						'options' => array(
								0 => __('_self', 'mfn-opts'),
								1 => __('_blank', 'mfn-opts'),
							),
							'std' => 0,
   					),

   					array(
   						'id' => 'class2',
   						'type' => 'text',
   						'title' => __('Link class', 'mfn-opts'),
   						'desc' => __('e.g. <b>prettyphoto</b> or <b>scroll</b>', 'mfn-opts'),
   					),

						// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Hover Box ------------------------------------------------------

   			'hover_box' => array(
   				'type' => 'hover_box',
   				'title' => __('Hover Box', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'boxes',
   				'fields' => array(

   					array(
   						'id' => 'image',
   						'type' => 'upload',
   						'title' => __('Image', 'mfn-opts'),
   						'desc' => __('Recommended image width <b>768px - 1920px</b> depending on size of the item', 'mfn-opts'),
							'std' => $this->get_placeholder(),
							'preview' => 'image',
   					),

   					array(
   						'id' => 'image_hover',
   						'type' => 'upload',
   						'title' => __('Hover image', 'mfn-opts'),
   						'desc' => __('Images must have the same size', 'mfn-opts'),
							'std' => $this->get_placeholder(),
   					),

						// link

   					array(
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'link',
   						'type' => 'text',
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'target',
   						'type' => 'select',
   						'title' => __('Target', 'mfn-opts'),
   						'options' => array(
   							0 => __('Default | _self', 'mfn-opts'),
   							1 => __('New tab or window | _blank', 'mfn-opts'),
   							'lightbox' => __('Lightbox (image or embed video)', 'mfn-opts'),
   						),
   					),

						// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Hover Color ----------------------------------------------------

   			'hover_color' => array(
   				'type' => 'hover_color',
   				'title' => __('Hover Color', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'elements',
   				'fields' => array(

   					array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
							'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
							'preview' => 'content',
							'class' => 'form-content-full-width',
   					),

   					array(
   						'id' => 'align',
   						'type' => 'switch',
   						'title' => __('Text align', 'mfn-opts'),
   						'options' => array(
   							'left' => __('Left', 'mfn-opts'),
   							'' => __('Center', 'mfn-opts'),
								'right' => __('Right', 'mfn-opts'),
   							'justify' => __('Justify', 'mfn-opts'),
   						),
							'std' => 'left',
   					),

   					array(
   						'id' => 'padding',
   						'type' => 'text',
   						'title' => __('Padding', 'mfn-opts'),
   						'desc' => __('Use value with <b>px</b> or <b>%</b>. Example: <b>20px</b> or <b>20px 10px 20px 10px</b> or <b>20px 1%</b>', 'mfn-opts'),
   						'std' => '40px 30px',
   					),

   					// background

   					array(
   						'title' => __('Background', 'mfn-opts'),
   					),

   					array(
   						'id' => 'background',
   						'type' => 'color',
   						'title' => __('Color', 'mfn-opts'),
   						'std' => '#999999',
   					),

   					array(
   						'id' => 'background_hover',
   						'type' => 'color',
   						'title' => __('Hover color', 'mfn-opts'),
							'std' => '#888888',
   					),

   					// border

   					array(
   						'title' => __('Border', 'mfn-opts'),
   					),

   					array(
   						'id' => 'border',
   						'type' => 'color',
   						'title' => __('Color', 'mfn-opts'),
   					),

   					array(
   						'id' => 'border_hover',
   						'type' => 'color',
   						'title' => __('Hover color', 'mfn-opts'),
   					),

   					array(
   						'id' => 'border_width',
   						'type' => 'text',
   						'title' => __('Width', 'mfn-opts'),
   						'desc' => __('Use value with <b>px</b>. Example: <b>1px</b> or <b>2px 5px 2px 5px</b>', 'mfn-opts'),
   						'std' => '2px',
   					),

   					// link

   					array(
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'link',
   						'type' => 'text',
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'target',
   						'type' => 'select',
   						'title' => __('Target', 'mfn-opts'),
   						'options' => array(
   							0 => __('Default | _self', 'mfn-opts'),
   							1 => __('New tab or window | _blank', 'mfn-opts'),
   							'lightbox' => __('Lightbox (image or embed video)', 'mfn-opts'),
   						),
   					),

   					array(
   						'id' => 'class',
   						'type' => 'text',
   						'title' => __('Class', 'mfn-opts'),
   						'desc' => __('e.g. <b>scroll</b>', 'mfn-opts'),
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   					array(
   						'id' => 'style',
   						'type' => 'text',
   						'title' => __('Inline styles', 'mfn-opts'),
   						'desc' => __('Example: <b>opacity: 0.5;</b>', 'mfn-opts'),
   					),


   				),
   			),

   			// How It Works ---------------------------------------------------

   			'how_it_works' => array(
   				'type' => 'how_it_works',
   				'title' => __('How It Works', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'elements',
   				'fields' => array(

						array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

   					array(
   						'id' => 'image',
   						'type' => 'upload',
   						'title' => __('Background', 'mfn-opts'),
   						'desc' => __('Recommended: Square Image with transparent background.', 'mfn-opts'),
							'preview' => 'image',
   					),

   					array(
   						'id' => 'number',
   						'type' => 'text',
   						'title' => __('Number', 'mfn-opts'),
   						'param' => 'number',
   						'class' => 'narrow',
   						'std' => '1',
							'preview' => 'number',
   					),

   					array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
							'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
							'preview' => 'content',
							'class' => 'form-content-full-width',
   					),

   					// style

   					array(
   						'title' => __('Style', 'mfn-opts'),
   					),

   					array(
   						'id' => 'border',
   						'type' => 'switch',
   						'title' => __('Line', 'mfn-opts'),
   						'options' => array(
   							0 => __('Hide', 'mfn-opts'),
   							1 => __('Show', 'mfn-opts'),
   						),
							'std' => 0,
   					),

   					array(
   						'id' => 'style',
   						'type' => 'select',
   						'title' => __('Style', 'mfn-opts'),
   						'options' => array(
   							'' => __('Small centered image (image size: max 116px)', 'mfn-opts'),
   							'fill' => __('Fill the circle (image size: 200px x 200px)', 'mfn-opts'),
   						),
   					),

   					// link

   					array(
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'link',
   						'type' => 'text',
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'target',
   						'type' => 'select',
   						'title' => __('Target', 'mfn-opts'),
   						'options' => array(
   							0 => __('Default | _self', 'mfn-opts'),
   							1 => __('New tab or window | _blank', 'mfn-opts'),
   							'lightbox' => __('Lightbox (image or embed video)', 'mfn-opts'),
   						),
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'animate',
   						'type' => 'select',
   						'title' => __('Animation', 'mfn-opts'),
   						'options' => $this->get_animations(),
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Icon Box  ------------------------------------------------------

   			'icon_box' => array(
   				'type' => 'icon_box',
   				'title' => __('Icon Box', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'boxes',
   				'fields' => array(

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

   					array(
   						'id' => 'title_tag',
   						'type' => 'switch',
   						'title' => __('Tag', 'mfn-opts'),
   						'options' => array(
   							'h1' => 'H1',
   							'h2' => 'H2',
   							'h3' => 'H3',
   							'h4' => 'H4',
   							'h5' => 'H5',
   							'h6' => 'H6',
   						),
   						'std' => 'h4'
   					),

   					array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
							'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
							'preview' => 'content',
							'class' => 'form-content-full-width',
   					),

   					// icon

   					array(
   						'title' => __('Icon', 'mfn-opts'),
   					),

   					array(
   						'id' => 'icon',
   						'type' => 'icon',
   						'title' => __('Icon', 'mfn-opts'),
   						'std' => 'icon-lamp',
   						'preview' => 'icon',
   					),

						array(
   						'id' => 'icon_position',
   						'type' => 'switch',
   						'title' => __('Icon position', 'mfn-opts'),
   						'desc' => __('Left position works only for column widths: 1/4, 1/3 & 1/2', 'mfn-opts'),
   						'options' => array(
   							'left' => __('Left', 'mfn-opts'),
   							'top' => __('Top', 'mfn-opts'),
   						),
   						'std' => 'top',
   					),

   					array(
   						'id' => 'image',
   						'type' => 'upload',
   						'title' => __('Image', 'mfn-opts'),
							'preview' => 'image',
   					),

   					array(
   						'id' => 'border',
   						'type' => 'switch',
   						'title' => __('Border', 'mfn-opts'),
   						'options' => array(
   							0 => __('Hide', 'mfn-opts'),
   							1 => __('Show', 'mfn-opts'),
   						),
							'std' => 0,
   					),

   					// link

   					array(
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'link',
   						'type' => 'text',
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'target',
   						'type' => 'select',
   						'title' => __('Target', 'mfn-opts'),
   						'options' => array(
   							0 => __('Default | _self', 'mfn-opts'),
   							1 => __('New tab or window | _blank', 'mfn-opts'),
   							'lightbox' => __('Lightbox (image or embed video)', 'mfn-opts'),
   						),
   					),

   					array(
   						'id' => 'class',
   						'type' => 'text',
   						'title' => __('Class', 'mfn-opts'),
   						'desc' => __('e.g. <b>scroll</b>', 'mfn-opts'),
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'animate',
   						'type' => 'select',
   						'title' => __('Animation', 'mfn-opts'),
   						'options' => $this->get_animations(),
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Image  ---------------------------------------------------------

   			'image' => array(
   				'type' => 'image',
   				'title' => __('Image', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'typography',
   				'fields' => array(

   					array(
   						'id' => 'src',
   						'type' => 'upload',
   						'title' => __('Image', 'mfn-opts'),
							'std' => $this->get_placeholder(),
   						'preview' => 'image',
   					),

   					array(
   						'id' => 'size',
   						'type' => 'select',
   						'title' => __('Size', 'mfn-opts'),
   						'desc' => __('Select image size from <a target="_blank" href="options-media.php">Settings > Media > Image sizes</a> (Media Library images only)<br />or use below fields for HTML resize', 'mfn-opts'),
   						'options' => array(
   							'full' => __('Full size', 'mfn-opts'),
   							'large' => __('Large', 'mfn-opts') .' | '. mfn_get_image_sizes('large', 1),
   							'medium' => __('Medium', 'mfn-opts') .' | '. mfn_get_image_sizes('medium', 1),
   							'thumbnail' => __('Thumbnail', 'mfn-opts') .' | '. mfn_get_image_sizes('thumbnail', 1),
   						),
							'std' => 'full',
   					),

   					array(
   						'id' => 'width',
   						'type' => 'text',
   						'title' => __('Width', 'mfn-opts'),
   						'desc' => __('HTML resize, optional', 'mfn-opts'),
   						'param' => 'number',
   						'class' => 'narrow',
   						'after' => 'px',
   					),

   					array(
   						'id' => 'height',
   						'type' => 'text',
   						'title' => __('Height', 'mfn-opts'),
							'param' => 'number',
   						'class' => 'narrow',
   						'after' => 'px',
   					),

						array(
   						'id' => 'stretch',
   						'type' => 'select',
   						'title' => __('Stretch', 'mfn-opts'),
   						'desc' => __('Stretch image to column width, height will be changed proportionally', 'mfn-opts'),
   						'options' => array(
   							'0' => __('No', 'mfn-opts'),
   							'1' => __('Yes', 'mfn-opts'),
   							'ultrawide' => __('Yes, on ultrawide screens only > 1920px', 'mfn-opts'),
   						),
   					),

   					// options

   					array(
   						'title' => __('Options', 'mfn-opts'),
   					),

   					array(
   						'id' => 'align',
   						'type' => 'switch',
   						'title' => __('Align', 'mfn-opts'),
   						'desc' => __('If you want image to be <b>resized</b> to column width use <b>align none</b>', 'mfn-opts'),
   						'options' => array(
   							'' => __('None', 'mfn-opts'),
   							'left' => __('Left', 'mfn-opts'),
   							'center' => __('Center', 'mfn-opts'),
								'right' => __('Right', 'mfn-opts'),
   						),
							'std' => '',
							'preview' => 'align',
   					),

   					array(
   						'id' => 'border',
   						'type' => 'switch',
   						'title' => __('Border', 'mfn-opts'),
   						'options' => array(
   							0 => __('Hide', 'mfn-opts'),
   							1 => __('Show', 'mfn-opts'),
   						),
							'std' => 0,
   					),

						// margin

   					array(
   						'title' => __('Margin', 'mfn-opts'),
   					),

   					array(
   						'id' => 'margin',
   						'type' => 'text',
   						'title' => __('Top', 'mfn-opts'),
   						'param' => 'number',
   						'after' => 'px',
   						'class' => 'narrow',
   					),

   					array(
   						'id' => 'margin_bottom',
   						'type' => 'text',
   						'title' => __('Bottom', 'mfn-opts'),
							'param' => 'number',
   						'after' => 'px',
   						'class' => 'narrow',
   					),

   					// link

   					array(
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'link_image',
   						'type' => 'upload',
   						'title' => __('Popup image', 'mfn-opts'),
   						'desc' => __('This <b>image or embed video</b> will be opened in lightbox', 'mfn-opts'),
   					),

   					array(
   						'id' => 'link',
   						'type' => 'text',
   						'title' => __('Link', 'mfn-opts'),
   					),

						array(
   						'id' => 'target',
   						'type' => 'switch',
							'title' => __('Target', 'mfn-opts'),
   						'options' => array(
								0 => __('_self', 'mfn-opts'),
								1 => __('_blank', 'mfn-opts'),
							),
							'std' => 0,
   					),

   					array(
   						'id' => 'hover',
   						'type' => 'switch',
   						'title' => __('Hover effect', 'mfn-opts'),
   						'desc' => __('Hover effect selected in Theme Options', 'mfn-opts'),
   						'options' => array(
   							'disable' => __('Disable', 'mfn-opts'),
								'' => __('Enable', 'mfn-opts'),
   						),
							'std' => '',
   					),

   					// description

   					array(
   						'title' => __('Description', 'mfn-opts'),
   					),

   					array(
   						'id' => 'alt',
   						'type' => 'text',
   						'title' => __('Alternate text', 'mfn-opts'),
   					),

   					array(
   						'id' => 'caption',
   						'type' => 'text',
   						'title' => __('Caption', 'mfn-opts'),
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'greyscale',
   						'type' => 'select',
   						'title' => 'Grayscale',
   						'options' => array(
   							0 => __('Disable', 'mfn-opts'),
   							1 => __('Enable', 'mfn-opts'),
   						),
							'std' => 0,
   					),

   					array(
   						'id' => 'animate',
   						'type' => 'select',
   						'title' => __('Animation', 'mfn-opts'),
   						'options' => $this->get_animations(),
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Image Gallery  ---------------------------------------------------------

   			'image_gallery' => array(
   				'type' => 'image_gallery',
   				'title' => __('Image Gallery', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'typography',
   				'fields' => array(

   					array(
   						'id' => 'ids',
   						'type' => 'upload_multi',
   						'title' => __('Images', 'mfn-opts'),
   						'preview' => 'images',
   					),

   					// options

   					array(
   						'title' => __('Options', 'mfn-opts'),
   					),

   					array(
   						'id' => 'columns',
   						'type' => 'text',
   						'title' => __('Columns', 'mfn-opts'),
   						'desc' => __('min: <b>1</b> | max: <b>9</b>', 'mfn-opts'),
   						'after' => 'columns',
   						'param' => 'number',
   						'class' => 'narrow',
   						'std' => '3',
   					),

   					array(
   						'id' => 'size',
   						'type' => 'select',
   						'title' => __('Size', 'mfn-opts'),
   						'options' => array(
								'thumbnail' => __('Thumbnail', 'mfn-opts') .' | '. mfn_get_image_sizes('thumbnail', 1),
								'medium' => __('Medium', 'mfn-opts') .' | '. mfn_get_image_sizes('medium', 1),
								'large' => __('Large', 'mfn-opts') .' | '. mfn_get_image_sizes('large', 1),
								'full' => __('Full size', 'mfn-opts'),
   						),
							'std' => 'full',
   					),

   					array(
   						'id' => 'style',
   						'type' => 'switch',
   						'title' => __('Style', 'mfn-opts'),
   						'options' => array(
   							'' => __('Default', 'mfn-opts'),
   							'flat' => __('Flat', 'mfn-opts'),
   							'fancy' => __('Fancy', 'mfn-opts'),
   							'masonry' => __('Masonry', 'mfn-opts'),
   						),
							'std' => '',
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'greyscale',
   						'type' => 'switch',
   						'title' => __('Grayscale', 'mfn-opts'),
   						'options' => array(
   							0 => __('Disable', 'mfn-opts'),
   							1 => __('Enable', 'mfn-opts'),
   						),
							'std' => 0,
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Info box -------------------------------------------------------

   			'info_box' => array(
   				'type' => 'info_box',
   				'title' => __('Info Box', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'elements',
   				'fields' => array(

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

						array(
   						'id' => 'tabs',
   						'type' => 'tabs',
   						'title' => __('Items', 'mfn-opts'),
							'options' => [
								'content' => [
									'input',
									__('Title', 'mfn-opts'),
									__('List item', 'mfn-opts'),
								],
							],
							'std' => [
								0 => [
									'content' => 'This is the 1st item',
								],
								1 => [
									'content' => 'This is the 2nd item',
								],
							],
							'preview' => 'tabs',
							'primary' => 'content',
   					),

   					array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
							'class' => 'form-content-full-width',
   					),

   					array(
   						'id' => 'image',
   						'type' => 'upload',
   						'title' => __('Background image', 'mfn-opts'),
   					),

						// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'animate',
   						'type' => 'select',
   						'title' => __('Animation', 'mfn-opts'),
   						'options' => $this->get_animations(),
   					),

						// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// List -----------------------------------------------------------

   			'list' => array(
   				'type' => 'list',
   				'title' => __('List', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'blocks',
   				'fields' => array(

   					array(
   						'id' => 'icon',
   						'type' => 'icon',
   						'title' => __('Icon', 'mfn-opts'),
   						'std' => 'icon-lamp',
							'preview' => 'icon',
   					),

   					array(
   						'id' => 'image',
   						'type' => 'upload',
   						'title' => __('Image', 'mfn-opts'),
   						'desc' => __('Image replaces icon selected above', 'mfn-opts'),
							'preview' => 'image',
   					),

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

   					array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
							'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
							'preview' => 'content',
							'class' => 'form-content-full-width',
   					),

						array(
   						'id' => 'style',
   						'type' => 'switch',
   						'title' => __('Style', 'mfn-opts'),
   						'options' => array(
   							1 => __('With background', 'mfn-opts'),
   							2 => __('Transparent', 'mfn-opts'),
   							3 => __('Vertical', 'mfn-opts'),
   							4 => __('Ordered list', 'mfn-opts'),
   						),
							'std' => 1,
   					),

						// link

   					array(
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'link',
   						'type' => 'text',
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'target',
   						'type' => 'switch',
   						'title' => __('Target', 'mfn-opts'),
   						'options' => array(
   							0 => __('_self', 'mfn-opts'),
   							1 => __('_blank', 'mfn-opts'),
   						),
							'std' => 0,
   					),

						// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'animate',
   						'type' => 'select',
   						'title' => __('Animation', 'mfn-opts'),
   						'options' => $this->get_animations(),
   					),

						// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Map Basic ------------------------------------------------------------

   			'map_basic' => array(
   				'type' => 'map_basic',
   				'title' => __('Map Basic', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'elements',
   				'fields' => array(

   					// iframe

						array(
							'id' => 'info-iframe',
							'type' => 'info',
							'title' => __('Number of <b>iframe map</b> loads is unlimited.', 'mfn-opts'),
						),

						array(
   						'title' => __('Iframe', 'mfn-opts'),
   					),

   					array(
   						'id' => 'iframe',
   						'type' => 'textarea',
   						'title' => __('Iframe', 'mfn-opts'),
   						'desc' => __('Visit <a target="_blank" href="https://google.com/maps">Google Maps</a> and follow these instructions:<br />1. Find place. 2. Click the share button in the left panel. 3. Select "embed a map" 4. Choose size. 5. Click "copy HTML" and paste it above', 'mfn-opts'),
   					),

   					// embed

						array(
							'id' => 'info-embed',
							'type' => 'info',
							'title' => __('Number of <b>embed map</b> loads is unlimited. Google Maps API key is required.', 'mfn-opts'),
							'label' => __('Enter key', 'mfn-opts'),
							'link' => 'admin.php?page='. apply_filters('betheme_slug','be'). '-options#advanced&options',
						),

   					array(
   						'title' => __('Embed', 'mfn-opts'),
   					),

   					array(
   						'id' => 'address',
   						'type' => 'text',
   						'title' => __('Address or place name', 'mfn-opts'),
   					),

   					array(
   						'id' => 'zoom',
   						'type' => 'text',
   						'title' => __('Zoom', 'mfn-opts'),
   						'param' => 'number',
   						'class' => 'narrow',
   						'std' => 13,
   					),

   					array(
   						'id' => 'height',
   						'type' => 'text',
   						'title' => __('Height', 'mfn-opts'),
							'param' => 'number',
   						'class' => 'narrow',
   						'after' => 'px',
   						'std' => 300,
   					),

   				),
   			),

   			// Map Advanced ------------------------------------------------------------

   			'map' => array(
   				'type' => 'map',
   				'title' => __('Map Advanced', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'elements',
   				'fields' => array(

   					array(
   						'id' => 'info-key',
   						'type' => 'info',
   						'title' => __('Number of free dynamic map loads is limited. Google Maps API key is required.', 'mfn-opts'),
							'label' => __('Enter key', 'mfn-opts'),
							'link' => 'admin.php?page='. apply_filters('betheme_slug','be'). '-options#advanced&options',
   					),

   					array(
   						'id' => 'lat',
   						'type' => 'text',
   						'title' => __('Latitude', 'mfn-opts'),
   						'before' => 'LAT',
   						'placeholder' => '-33.87',
   						'std' => '-33.87',
   					),

   					array(
   						'id' => 'lng',
   						'type' => 'text',
   						'title' => __('Longitude', 'mfn-opts'),
							'before' => 'LNG',
							'placeholder' => '151.21',
							'std' => '151.21',
   					),

   					array(
   						'id' => 'zoom',
   						'type' => 'text',
   						'title' => __('Zoom', 'mfn-opts'),
   						'param' => 'number',
   						'class' => 'narrow',
   						'std' => 13,
   					),

   					array(
   						'id' => 'height',
   						'type' => 'text',
   						'title' => __('Height', 'mfn-opts'),
							'param' => 'number',
   						'class' => 'narrow',
   						'after' => 'px',
   						'std' => 300,
   					),

   					// options

   					array(
   						'title' => __('Options', 'mfn-opts'),
   					),

   					array(
   						'id' => 'type',
   						'type' => 'switch',
   						'title' => __('Type', 'mfn-opts'),
   						'options' => array(
   							'ROADMAP' => __('Map', 'mfn-opts'),
   							'SATELLITE' => __('Satellite', 'mfn-opts'),
   							'HYBRID' => __('Satellite + Map', 'mfn-opts'),
   							'TERRAIN' => __('Terrain', 'mfn-opts'),
   						),
							'std' => 'ROADMAP',
   					),

   					array(
   						'id' => 'controls',
   						'type' => 'select',
   						'title' => __('Controls', 'mfn-opts'),
   						'options' => array(
   							'' => __('Zoom', 'mfn-opts'),
   							'mapType' => __('Map Type', 'mfn-opts'),
   							'streetView' => __('Street View', 'mfn-opts'),
   							'zoom mapType' => __('Zoom & Map Type', 'mfn-opts'),
   							'zoom streetView' => __('Zoom & Street View', 'mfn-opts'),
   							'mapType streetView' => __('Map Type & Street View', 'mfn-opts'),
   							'zoom mapType streetView' => __('Zoom, Map Type & Street View', 'mfn-opts'),
   							'hide' => __('Hide All', 'mfn-opts'),
   						),
   					),

   					array(
   						'id' => 'draggable',
   						'type' => 'switch',
   						'title' => __('Draggable', 'mfn-opts'),
   						'options' => array(
   							'disable' => __('Disable', 'mfn-opts'),
   							'disable-mobile'=> __('Disable on mobile', 'mfn-opts'),
								'' => __('Enable', 'mfn-opts'),
   						),
							'std' => '',
   					),

   					array(
   						'id' => 'border',
   						'type' => 'switch',
   						'title' => __('Border', 'mfn-opts'),
   						'options' => array(
   							0 => __('Hide', 'mfn-opts'),
   							1 => __('Show', 'mfn-opts'),
   						),
							'std' => 0,
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'icon',
   						'type' => 'upload',
   						'title' => __('Marker icon', 'mfn-opts'),
   						'desc' => __('.png', 'mfn-opts'),
   					),

   					array(
   						'id' => 'color',
   						'type' => 'color',
   						'title' => __('Map color', 'mfn-opts'),
   					),

   					array(
   						'id' => 'styles',
   						'type' => 'textarea',
   						'title' => __('Styles', 'mfn-opts'),
   						'desc' => __('You can get predefined styles from <a target="_blank" href="https://snazzymaps.com/explore">snazzymaps.com/explore</a> or generate your own <a target="_blank" href="https://snazzymaps.com/editor">snazzymaps.com/editor</a>', 'mfn-opts'),
							'class' => 'form-content-full-width',
   					),

						// additional markers

   					array(
   						'title' => __('Additional markers', 'mfn-opts'),
   					),

						array(
   						'id' => 'tabs',
   						'type' => 'tabs',
   						'title' => __('Markers', 'mfn-opts'),
							'options' => [
								'lat' => [
									'input',
									__('Lat', 'mfn-opts'),
									'-33.88',
								],
								'lng' => [
									'input',
									__('Lng', 'mfn-opts'),
									'151.21',
								],
								'icon' => [
									'input',
									__('Icon URL (optional)', 'mfn-opts'),
									'',
								],
							],
							'std' => [],
							'primary' => 'lat',
   					),

   					array(
   						'id' => 'latlng',
   						'type' => 'text',
   						'title' => __('Lat,Lng,IconURL', 'mfn-opts'),
   						'desc' => __('This option has been deprecated, please add markers above', 'mfn-opts'),
   						'class' => 'deprecated',
   					),

   					// contact

   					array(
   						'title' => __('Contact box', 'mfn-opts'),
   					),

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
   					),

   					array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Address', 'mfn-opts'),
   						'desc' => __('HTML tags allowed', 'mfn-opts'),
   					),

   					array(
   						'id' => 'telephone',
   						'type' => 'text',
   						'title' => __('Telephone', 'mfn-opts'),
   					),

   					array(
   						'id' => 'email',
   						'type' => 'text',
   						'title' => __('Email', 'mfn-opts'),
   					),

   					array(
   						'id' => 'www',
   						'type' => 'text',
   						'title' => __('WWW', 'mfn-opts'),
   					),

   					array(
   						'id' => 'style',
   						'type' => 'select',
   						'title' => __('Style', 'mfn-opts'),
   						'options' => array(
   							'box' => __('Box on the map (for full width column/wrap)', 'mfn-opts'),
   							'bar' => __('Bar at the top', 'mfn-opts'),
   						),
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

						array(
   						'id' => 'info-pricing',
   						'type' => 'info',
   						'title' => __('If you need more than 28500 map loads per month please check current Google Maps Pricing or choose Map Basic instead.', 'mfn-opts'),
							'label' => __('Google Maps Pricing', 'mfn-opts'),
							'link' => 'https://cloud.google.com/maps-platform/pricing/',
   					),

   				),
   			),

   			// Offer Slider Full ----------------------------------------------

   			'offer' => array(
   				'type' => 'offer',
   				'title' => __('Offer Slider Full', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'loops',
   				'fields' => array(

   					array(
   						'id' => 'info',
   						'type' => 'info',
   						'title' => __('Please use on pages <strong>without sidebar</strong> and within <strong>full width sections</strong>. One item per section.', 'mfn-opts'),
   					),

   					array(
   						'id' => 'category',
   						'type' => 'select',
   						'title' => __('Category', 'mfn-opts'),
   						'options' => mfn_get_categories('offer-types'),
							'preview' => 'category',
   					),

   					array(
   						'id' => 'align',
   						'type' => 'select',
   						'title' => __('Text align', 'mfn-opts'),
   						'desc' => __('Text align center does not affect title if button is active', 'mfn-opts'),
   						'options' => array(
   							'left' => __('Left', 'mfn-opts'),
								'center' => __('Center', 'mfn-opts'),
   							'right' => __('Right', 'mfn-opts'),
   							'justify' => __('Justify', 'mfn-opts'),
   						),
							'std' => 'left',
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Offer Slider Thumb ---------------------------------------------

   			'offer_thumb' => array(
   				'type' => 'offer_thumb',
   				'title' => __('Offer Slider Thumb', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'loops',
   				'fields' => array(

   					array(
   						'id' => 'category',
   						'type' => 'select',
   						'title' => __('Category', 'mfn-opts'),
   						'options' => mfn_get_categories('offer-types'),
							'preview' => 'category',
   					),

   					array(
   						'id' => 'style',
   						'type' => 'switch',
   						'title' => __('Thumbnails position', 'mfn-opts'),
   						'options' => array(
   							'bottom' => __('Bottom', 'mfn-opts'),
   							'' => __('Left', 'mfn-opts'),
   						),
   						'std' => 'bottom',
   					),

   					array(
   						'id' => 'align',
   						'type' => 'switch',
   						'title' => __('Text align', 'mfn-opts'),
   						'desc' => __('Text align center does not affect title if button is active', 'mfn-opts'),
   						'options' => array(
   							'left' => __('Left', 'mfn-opts'),
								'center' => __('Center', 'mfn-opts'),
   							'right' => __('Right', 'mfn-opts'),
   							'justify' => __('Justify', 'mfn-opts'),
   						),
							'std' => 'left',
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Opening Hours --------------------------------------------------

   			'opening_hours' => array(
   				'type' => 'opening_hours',
   				'title' => __('Opening Hours', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'elements',
   				'fields' => array(

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

						array(
   						'id' => 'tabs',
   						'type' => 'tabs',
   						'title' => __('Days', 'mfn-opts'),
							'options' => [
								'days' => [
									'input',
									__('Days', 'mfn-opts'),
									'Monday - Friday',
								],
								'hours' => [
									'input',
									__('Hours', 'mfn-opts'),
									'8am - 4pm',
								],
							],
							'std' => [
								0 => [
									'days' => 'Monday - Friday',
									'hours' => '8am - 4pm',
								],
								1 => [
									'days' => 'Saturday',
									'hours' => '10am - 2pm',
								],
							],
							'primary' => 'days',
							'preview' => 'tabs',
   					),

   					array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
							'preview' => 'content',
							'class' => 'form-content-full-width',
   					),

   					array(
   						'id' => 'image',
   						'type' => 'upload',
   						'title' => __('Background image', 'mfn-opts'),
   						'desc' => __('Recommended image width <b>768px - 1920px</b> depending on size of the item', 'mfn-opts'),
   					),

						// advanced

						array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'animate',
   						'type' => 'select',
   						'title' => __('Animation', 'mfn-opts'),
   						'options' => $this->get_animations(),
   					),

						// custom

						array(
   						'title' => __('Custom', 'mfn-opts'),
   					),


						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Our team -------------------------------------------------------

   			'our_team' => array(
   				'type' => 'our_team',
   				'title' => __('Our Team', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'elements',
   				'fields' => array(

   					array(
   						'id' => 'heading',
   						'type' => 'text',
   						'title' => __('Heading', 'mfn-opts'),
							'std' => __('This is the heading', 'mfn-opts'),
							'preview' => 'title',
   					),

   					array(
   						'id' => 'image',
   						'type' => 'upload',
   						'title' => __('Photo', 'mfn-opts'),
   						'desc' => __('Recommended image width <b>768px - 1920px</b> depending on size of the item', 'mfn-opts'),
							'std' => $this->get_placeholder(),
							'preview' => 'image',
   					),

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'subtitle',
   					),

   					array(
   						'id' => 'subtitle',
   						'type' => 'text',
   						'title' => __('Subtitle', 'mfn-opts'),
							'std' => __('This is the subtitle', 'mfn-opts'),
   					),

   					// description

   					array(
   						'title' => __('Description', 'mfn-opts'),
   					),

   					array(
   						'id' => 'phone',
   						'type' => 'text',
   						'title' => __('Phone', 'mfn-opts'),
   					),

   					array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
   						'desc' => __('Some shortcodes and HTML tags allowed', 'mfn-opts'),
							'class' => 'form-content-full-width',
   					),

   					array(
   						'id' => 'email',
   						'type' => 'text',
   						'title' => __('Email', 'mfn-opts'),
   					),

   					// social

   					array(
   						'title' => __('Social', 'mfn-opts'),
   					),

   					array(
   						'id' => 'facebook',
   						'type' => 'text',
   						'title' => __('Facebook', 'mfn-opts'),
   					),

   					array(
   						'id' => 'twitter',
   						'type' => 'text',
   						'title' => __('Twitter', 'mfn-opts'),
   					),

   					array(
   						'id' => 'linkedin',
   						'type' => 'text',
   						'title' => __('LinkedIn', 'mfn-opts'),
   					),

   					array(
   						'id' => 'vcard',
   						'type' => 'text',
   						'title' => __('vCard', 'mfn-opts'),
   					),

   					// other

   					array(
   						'title' => __('Other', 'mfn-opts'),
   					),

   					array(
   						'id' => 'blockquote',
   						'type' => 'textarea',
   						'title' => __('Blockquote', 'mfn-opts'),
							'class' => 'form-content-full-width',
   					),

   					array(
   						'id' => 'style',
   						'type' => 'switch',
   						'title' => __('Style', 'mfn-opts'),
   						'options' => array(
   							'circle' => __('Circle', 'mfn-opts'),
   							'vertical' => __('Vertical', 'mfn-opts'),
   							'horizontal' => __('Horizontal', 'mfn-opts'),
   						),
   						'std' => 'vertical',
   					),

   					// link

   					array(
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'link',
   						'type' => 'text',
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'target',
   						'type' => 'select',
   						'title' => __('Target', 'mfn-opts'),
   						'options' => array(
   							0 => __('Default | _self', 'mfn-opts'),
   							1 => __('New tab or window | _blank', 'mfn-opts'),
   							'lightbox' => __('Lightbox (image or embed video)', 'mfn-opts'),
   						),
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'animate',
   						'type' => 'select',
   						'title' => __('Animation', 'mfn-opts'),
   						'options' => $this->get_animations(),
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Our team list --------------------------------------------------

   			'our_team_list' => array(
   				'type' => 'our_team_list',
   				'title' => __('Our Team List', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'elements',
   				'fields' => array(

   					array(
   						'id' => 'image',
   						'type' => 'upload',
   						'title' => __('Photo', 'mfn-opts'),
   						'desc' => __('Recommended minimum image width <b>768px</b>', 'mfn-opts'),
							'std' => $this->get_placeholder(),
							'preview' => 'image',
   					),

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

   					array(
   						'id' => 'subtitle',
   						'type' => 'text',
   						'title' => __('Subtitle', 'mfn-opts'),
							'std' => __('This is the subtitle', 'mfn-opts'),
							'preview' => 'subtitle',
   					),

   					// description

   					array(
   						'title' => __('Description', 'mfn-opts'),
   					),

   					array(
   						'id' => 'phone',
   						'type' => 'text',
   						'title' => __('Phone', 'mfn-opts'),
   					),

   					array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
   						'desc' => __('Some shortcodes and HTML tags allowed', 'mfn-opts'),
							'preview' => 'content',
							'class' => 'form-content-full-width',
   					),

   					array(
   						'id' => 'blockquote',
   						'type' => 'textarea',
   						'title' => __('Blockquote', 'mfn-opts'),
							'class' => 'form-content-full-width',
   					),

   					array(
   						'id' => 'email',
   						'type' => 'text',
   						'title' => __('Email', 'mfn-opts'),
   					),

   					// social

   					array(
   						'title' => __('Social', 'mfn-opts'),
   					),

   					array(
   						'id' => 'facebook',
   						'type' => 'text',
   						'title' => __('Facebook', 'mfn-opts'),
   					),

   					array(
   						'id' => 'twitter',
   						'type' => 'text',
   						'title' => __('Twitter', 'mfn-opts'),
   					),

   					array(
   						'id' => 'linkedin',
   						'type' => 'text',
   						'title' => __('LinkedIn', 'mfn-opts'),
   					),

   					array(
   						'id' => 'vcard',
   						'type' => 'text',
   						'title' => __('vCard', 'mfn-opts'),
   					),

   					// link

   					array(
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'link',
   						'type' => 'text',
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'target',
   						'type' => 'select',
   						'title' => __('Target', 'mfn-opts'),
   						'options' => array(
   							0 => __('Default | _self', 'mfn-opts'),
   							1 => __('New tab or window | _blank', 'mfn-opts'),
   							'lightbox' => __('Lightbox (image or embed video)', 'mfn-opts'),
   						),
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Photo Box ------------------------------------------------------

   			'photo_box' => array(
   				'type' => 'photo_box',
   				'title' => __('Photo Box', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'boxes',
   				'fields' => array(

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
   						'desc' => __('Allowed HTML tags: span, strong, b, em, i, u', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

   					array(
   						'id' => 'image',
   						'type' => 'upload',
   						'title' => __('Image', 'mfn-opts'),
   						'desc' => __('Recommended image width <b>768px - 1920px</b> depending on size of the item', 'mfn-opts'),
							'std' => $this->get_placeholder(),
							'preview' => 'image',
   					),

   					array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
   						'desc' => __('Some shortcodes and HTML tags allowed', 'mfn-opts'),
							'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
							'preview' => 'content',
							'class' => 'form-content-full-width',
   					),

   					array(
   						'id' => 'align',
   						'type' => 'switch',
   						'title' => __('Text align', 'mfn-opts'),
   						'options' => array(
   							'left' => __('Left', 'mfn-opts'),
								'' => __('Center', 'mfn-opts'),
   							'right' => __('Right', 'mfn-opts'),
   						),
							'std' => '',
   					),

   					// link

   					array(
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'link',
   						'type' => 'text',
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'target',
   						'type' => 'select',
   						'title' => __('Target', 'mfn-opts'),
   						'options' => array(
   							0 => __('Default | _self', 'mfn-opts'),
   							1 => __('New tab or window | _blank', 'mfn-opts'),
   							'lightbox' => __('Lightbox (image or embed video)', 'mfn-opts'),
   						),
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'greyscale',
   						'type' => 'switch',
   						'title' => __('Grayscale', 'mfn-opts'),
   						'desc' => __('Works only for images with link', 'mfn-opts'),
   						'options' => array(
   							0 => __('Disable', 'mfn-opts'),
   							1 => __('Enable', 'mfn-opts'),
   						),
							'std' => 0,
   					),

   					array(
   						'id' => 'animate',
   						'type' => 'select',
   						'title' => __('Animation', 'mfn-opts'),
   						'options' => $this->get_animations(),
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Portfolio ------------------------------------------------------

   			'portfolio' => array(
   				'type' => 'portfolio',
   				'title' => __('Portfolio', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'loops',
   				'fields' => array(

   					array(
   						'id' => 'count',
   						'type' => 'text',
   						'title' => __('Projects number', 'mfn-opts'),
   						'param' => 'number',
   						'after' => 'projects',
   						'class' => 'narrow',
   						'std' => 3,
							'preview' => 'number',
   					),

   					array(
   						'id' => 'style',
   						'type' => 'select',
   						'title' => __('Style', 'mfn-opts'),
   						'options' => array(
   							'flat' => __('Flat', 'mfn-opts'),
   							'grid' => __('Grid', 'mfn-opts'),
   							'masonry' => __('Masonry blog style', 'mfn-opts'),
   							'masonry-hover' => __('Masonry hover description', 'mfn-opts'),
   							'masonry-minimal' => __('Masonry minimal', 'mfn-opts'),
   							'masonry-flat' => __('Masonry flat', 'mfn-opts'),
   							'list' => __('List', 'mfn-opts'),
   							'exposure' => __('Exposure', 'mfn-opts'),
   						),
   						'std' => 'grid',
							'preview' => 'style',
   					),

   					array(
   						'id' => 'columns',
   						'type' => 'switch',
   						'title' => __('Columns', 'mfn-opts'),
   						'desc' => __('for styles: Flat, Grid, Masonry blog style, Masonry hover description', 'mfn-opts'),
   						'options' => array(
   							2	=> 2,
   							3	=> 3,
   							4	=> 4,
   							5	=> 5,
   							6	=> 6,
   						),
   						'std' => 3,
   					),

   					// options

   					array(
   						'title' => __('Options', 'mfn-opts'),
   					),

   					array(
   						'id' => 'category',
   						'type' => 'select',
   						'title' => __('Category', 'mfn-opts'),
   						'options' => mfn_get_categories('portfolio-types'),
   						'wpml' => 'portfolio-types',
							'preview' => 'category',
   					),

   					array(
   						'id' => 'category_multi',
   						'type' => 'text',
   						'title' => __('Multiple categories', 'mfn-opts'),
   						'desc' => __('Slugs should be separated with <b>coma</b> ( , )', 'mfn-opts'),
							'preview' => 'category-all',
   					),

   					array(
   						'id' => 'orderby',
   						'type' => 'switch',
   						'title' => __('Order by', 'mfn-opts'),
   						'desc' => __('Do <b>not</b> use random order with pagination or load more', 'mfn-opts'),
   						'options' => array(
   							'date' => __('Date', 'mfn-opts'),
   							'menu_order' => __('Menu order', 'mfn-opts'),
   							'title' => __('Title', 'mfn-opts'),
   							'rand' => __('Random', 'mfn-opts'),
   						),
   						'std' => 'date'
   					),

   					array(
   						'id' => 'order',
   						'type' => 'switch',
   						'title' => __('Order', 'mfn-opts'),
   						'options' => array(
   							'ASC' => __('Ascending', 'mfn-opts'),
   							'DESC' => __('Descending', 'mfn-opts'),
   						),
   						'std' => 'DESC'
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'exclude_id',
   						'type' => 'text',
   						'title' => __('Exclude posts', 'mfn-opts'),
   						'desc' => __('IDs should be separated with <b>coma</b> ( , )', 'mfn-opts'),
   					),

   					array(
   						'id' => 'related',
   						'type' => 'switch',
   						'title' => __('Use as related projects', 'mfn-opts'),
   						'desc' => __('Exclude current project on single project page. This option will overwrite exclude posts option above.', 'mfn-opts'),
   						'options' => array(
   							0 => __('Disable', 'mfn-opts'),
   							1 => __('Enable', 'mfn-opts'),
   						),
							'std' => 0,
   					),

   					array(
   						'id' => 'filters',
   						'type' => 'switch',
   						'title' => __('Filters', 'mfn-opts'),
   						'desc' => __('for category: all or multiple categories (only selected categories show in filters)', 'mfn-opts'),
   						'options' => array(
   							0 => __('Hide', 'mfn-opts'),
   							1 => __('Show', 'mfn-opts'),
   						),
							'std' => 0,
   					),

						// pagination

						array(
   						'title' => __('Pagination', 'mfn-opts'),
   					),

   					array(
   						'id' => 'pagination',
   						'type' => 'switch',
   						'title' => __('Pagination', 'mfn-opts'),
   						'desc' => __('Does <b>not</b> work on WMPL homepage', 'mfn-opts'),
   						'options' => array(
   							0 => __('Hide', 'mfn-opts'),
   							1 => __('Show', 'mfn-opts'),
   						),
							'std' => 0,
   					),

   					array(
   						'id' => 'load_more',
   						'type' => 'switch',
   						'title' => __('Load More button', 'mfn-opts'),
   						'desc' => __('Sliders will be replaced with featured images. Please use with pagination enabled.', 'mfn-opts'),
   						'options' => array(
   							0 => __('No', 'mfn-opts'),
   							1 => __('Yes', 'mfn-opts'),
   						),
							'std' => 0,
   					),

						// style

						array(
   						'title' => __('Style', 'mfn-opts'),
   					),

   					array(
   						'id' => 'greyscale',
   						'type' => 'switch',
   						'title' => __('Grayscale', 'mfn-opts'),
   						'options' => array(
   							0 => __('Disable', 'mfn-opts'),
   							1 => __('Enable', 'mfn-opts'),
   						),
							'std' => 0,
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Portfolio Grid -------------------------------------------------

   			'portfolio_grid' => array(
   				'type' => 'portfolio_grid',
   				'title' => __('Portfolio Grid', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'loops',
   				'fields' => array(

						array(
   						'id' => 'count',
   						'type' => 'text',
   						'title' => __('Projects number', 'mfn-opts'),
   						'param' => 'number',
   						'after' => 'projects',
   						'class' => 'narrow',
   						'std' => 4,
							'preview' => 'number',
   					),

   					// options

   					array(
   						'title' => __('Options', 'mfn-opts'),
   					),

   					array(
   						'id' => 'category',
   						'type' => 'select',
   						'title' => __('Category', 'mfn-opts'),
   						'options' => mfn_get_categories('portfolio-types'),
   						'wpml' => 'portfolio-types',
							'preview' => 'category',
   					),

   					array(
   						'id' => 'category_multi',
   						'type' => 'text',
   						'title' => __('Multiple categories', 'mfn-opts'),
   						'desc' => __('Slugs should be separated with <b>coma</b> ( , )', 'mfn-opts'),
							'preview' => 'category-all',
   					),

   					array(
   						'id' => 'orderby',
   						'type' => 'switch',
   						'title' => __('Order by', 'mfn-opts'),
   						'options' => array(
   							'date' => __('Date', 'mfn-opts'),
   							'menu_order' => __('Menu order', 'mfn-opts'),
   							'title' => __('Title', 'mfn-opts'),
   							'rand' => __('Random', 'mfn-opts'),
   						),
   						'std' => 'date',
   					),

   					array(
   						'id' => 'order',
   						'type' => 'switch',
   						'title' => __('Order', 'mfn-opts'),
   						'options' => array(
   							'ASC' => __('Ascending', 'mfn-opts'),
   							'DESC' => __('Descending', 'mfn-opts'),
   						),
   						'std' => 'DESC',
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'greyscale',
   						'type' => 'switch',
   						'title' => 'Grayscale',
   						'options' => array(
   							0 => __('Disable', 'mfn-opts'),
   							1 => __('Enable', 'mfn-opts'),
   						),
							'std' => 0,
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Portfolio Photo ------------------------------------------------

   			'portfolio_photo' => array(
   				'type' => 'portfolio_photo',
   				'title' => __('Portfolio Photo', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'loops',
   				'fields' => array(

						array(
   						'id' => 'count',
   						'type' => 'text',
   						'title' => __('Projects number', 'mfn-opts'),
   						'param' => 'number',
   						'after' => 'projects',
   						'class' => 'narrow',
   						'std' => 5,
							'preview' => 'number',
   					),

   					// options

   					array(
   						'title' => __('Options', 'mfn-opts'),
   					),

   					array(
   						'id' => 'category',
   						'type' => 'select',
   						'title' => __('Category', 'mfn-opts'),
   						'options' => mfn_get_categories('portfolio-types'),
   						'wpml' => 'portfolio-types',
							'preview' => 'category',
   					),

   					array(
   						'id' => 'category_multi',
   						'type' => 'text',
   						'title' => __('Multiple categories', 'mfn-opts'),
   						'desc' => __('Slugs should be separated with <b>coma</b> ( , )', 'mfn-opts'),
							'preview' => 'category-all',
   					),

   					array(
   						'id' => 'orderby',
   						'type' => 'switch',
   						'title' => __('Order by', 'mfn-opts'),
   						'options' => array(
   							'date' => __('Date', 'mfn-opts'),
   							'menu_order' => __('Menu order', 'mfn-opts'),
   							'title' => __('Title', 'mfn-opts'),
   							'rand' => __('Random', 'mfn-opts'),
   						),
   						'std' => 'date',
   					),

   					array(
   						'id' => 'order',
   						'type' => 'switch',
   						'title' => __('Order', 'mfn-opts'),
   						'options' => array(
   							'ASC' => __('Ascending', 'mfn-opts'),
   							'DESC' => __('Descending', 'mfn-opts'),
   						),
   						'std' => 'DESC',
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'target',
   						'type' => 'switch',
   						'title' => __('Link target', 'mfn-opts'),
   						'options' => array(
   							0 => __('_self', 'mfn-opts'),
   							1 => __('_blank', 'mfn-opts'),
   						),
							'std' => 0,
   					),

   					array(
   						'id' => 'greyscale',
   						'type' => 'switch',
   						'title' => __('Grayscale', 'mfn-opts'),
   						'options' => array(
   							0 => __('Disable', 'mfn-opts'),
   							1 => __('Enable', 'mfn-opts'),
   						),
							'std' => 0,
   					),

   					array(
   						'id' => 'margin',
   						'type' => 'switch',
   						'title' => __('Margin', 'mfn-opts'),
   						'options' => array(
   							0 => __('Hide', 'mfn-opts'),
   							1 => __('Show', 'mfn-opts'),
   						),
							'std' => 0,
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Portfolio Slider -----------------------------------------------

   			'portfolio_slider' => array(
   				'type' => 'portfolio_slider',
   				'title' => __('Portfolio Slider', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'loops',
   				'fields' => array(

						array(
   						'id' => 'count',
   						'type' => 'text',
   						'title' => __('Projects number', 'mfn-opts'),
   						'param' => 'number',
   						'after' => 'projects',
   						'class' => 'narrow',
   						'std' => 6,
							'preview' => 'number',
   					),

   					// options

   					array(
   						'title' => __('Options', 'mfn-opts'),
   					),

   					array(
   						'id' => 'category',
   						'type' => 'select',
   						'title' => __('Category', 'mfn-opts'),
   						'options' => mfn_get_categories('portfolio-types'),
   						'wpml' => 'portfolio-types',
							'preview' => 'category',
   					),

   					array(
   						'id' => 'category_multi',
   						'type' => 'text',
   						'title' => __('Multiple categories', 'mfn-opts'),
   						'desc' => __('Slugs should be separated with <strong>coma</strong> (,).', 'mfn-opts'),
							'preview' => 'category-all',
   					),

   					array(
   						'id' => 'orderby',
   						'type' => 'switch',
   						'title' => __('Order by', 'mfn-opts'),
   						'options' => array(
   							'date' => __('Date', 'mfn-opts'),
   							'menu_order' => __('Menu order', 'mfn-opts'),
   							'title' => __('Title', 'mfn-opts'),
   							'rand' => __('Random', 'mfn-opts'),
   						),
   						'std' => 'date',
   					),

   					array(
   						'id' => 'order',
   						'type' => 'switch',
   						'title' => __('Order', 'mfn-opts'),
   						'options' => array(
   							'ASC' => __('Ascending', 'mfn-opts'),
   							'DESC' => __('Descending', 'mfn-opts'),
   						),
   						'std' => 'DESC',
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'arrows',
   						'type' => 'switch',
   						'title' => __('Navigation', 'mfn-opts'),
   						'options' => array(
   							'' => __('Hide', 'mfn-opts'),
   							'always' => __('Show', 'mfn-opts'),
								'hover' => __('Show on hover', 'mfn-opts'),
   						),
							'std' => '',
   					),

   					array(
   						'id' => 'size',
   						'type' => 'switch',
   						'title' => __('Image size', 'mfn-opts'),
   						'options' => array(
   							'small' => __('Small', 'mfn-opts'),
   							'medium' => __('Medium', 'mfn-opts'),
   							'large' => __('Large', 'mfn-opts'),
   						),
							'std' => 'small',
   					),

   					array(
   						'id' => 'scroll',
   						'type' => 'switch',
   						'title' => __('Slides to scroll', 'mfn-opts'),
   						'options' => array(
   							'page' => __('One page', 'mfn-opts'),
   							'slide' => __('Single slide', 'mfn-opts'),
   						),
							'std' => 'page',
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Pricing item ---------------------------------------------------

   			'pricing_item' => array(
   				'type' => 'pricing_item',
   				'title' => __('Pricing Item', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'blocks',
   				'fields' => array(

   					array(
   						'id' => 'image',
   						'type' => 'upload',
   						'title' => __('Image', 'mfn-opts'),
							'std' => $this->get_placeholder(),
							'preview' => 'image',
   					),

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

						// price

   					array(
   						'title' => __('Price', 'mfn-opts'),
   					),

   					array(
   						'id' => 'price',
   						'type' => 'text',
   						'title' => __('Price', 'mfn-opts'),
   						'class' => 'narrow',
							'std' => '99',
							'preview' => 'number',
   					),

   					array(
   						'id' => 'currency',
   						'type' => 'text',
   						'title' => __('Currency', 'mfn-opts'),
   						'class' => 'narrow',
   					),

   					array(
   						'id' => 'currency_pos',
   						'type' => 'switch',
   						'title' => __('Currency position', 'mfn-opts'),
   						'options' => array(
   							'' => __('Left', 'mfn-opts'),
   							'right' => __('Right', 'mfn-opts'),
   						),
							'std' => '',
   					),

   					array(
   						'id' => 'period',
   						'type' => 'text',
   						'title' => __('Period', 'mfn-opts'),
							'class' => 'narrow',
   					),

   					// description

   					array(
   						'title' => __('Description', 'mfn-opts'),
   					),

   					array(
   						'id' => 'subtitle',
   						'type' => 'text',
   						'title' => __('Subtitle', 'mfn-opts'),
   					),

						array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
   						'desc' => __('HTML tags allowed', 'mfn-opts'),
   						'preview' => 'content',
							'class' => 'form-content-full-width',
   					),

						array(
   						'id' => 'tabs',
   						'type' => 'tabs',
   						'title' => __('List', 'mfn-opts'),
							'options' => [
								'title' => [
									'input',
									__('Title', 'mfn-opts'),
									'List item',
								],
							],
							'std' => [
								0 => [
									'title' => __('This is the 1st item', 'mfn-opts'),
								],
								1 => [
									'title' => __('This is the 2nd item', 'mfn-opts'),
								],
							],
							'preview' => 'tabs',
   					),

   					// button

   					array(
   						'title' => __('Button', 'mfn-opts'),
   					),

   					array(
   						'id' => 'link_title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
   					),

   					array(
   						'id' => 'icon',
   						'type' => 'icon',
   						'title' => __('Icon', 'mfn-opts'),
   					),

   					array(
   						'id' => 'link',
   						'type' => 'text',
   						'title' => __('Link', 'mfn-opts'),
   						'desc' => __('Button will appear only if this field is filled.', 'mfn-opts'),
   					),

   					array(
   						'id' => 'target',
   						'type' => 'select',
   						'title' => __('Link target', 'mfn-opts'),
   						'options' => array(
   							0 => __('Default | _self', 'mfn-opts'),
   							1 => __('New tab or window | _blank', 'mfn-opts'),
   							'lightbox' => __('Lightbox (image or embed video)', 'mfn-opts'),
   						),
   					),

   					// style

   					array(
   						'title' => __('Style', 'mfn-opts'),
   					),

   					array(
   						'id' => 'featured',
   						'type' => 'switch',
   						'title' => __('Featured', 'mfn-opts'),
   						'options' => array(
   							'' => __('Default', 'mfn-opts'),
   							1 => __('Featured', 'mfn-opts'),
   						),
							'std' => '',
   					),

   					array(
   						'id' => 'style',
   						'type' => 'switch',
   						'title' => __('Style', 'mfn-opts'),
   						'options' => array(
   							'box' => __('Box', 'mfn-opts'),
   							'table' => __('Table', 'mfn-opts'),
								'label' => __('Table label', 'mfn-opts'),
   						),
							'std' => 'box',
   					),

						// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'animate',
   						'type' => 'select',
   						'title' => __('Animation', 'mfn-opts'),
   						'options' => $this->get_animations(),
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Progress Bars  -------------------------------------------------

   			'progress_bars' => array(
   				'type' => 'progress_bars',
   				'title' => __('Progress Bars', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'boxes',
   				'fields' => array(

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

						array(
   						'id' => 'tabs',
   						'type' => 'tabs',
   						'title' => __('Bars', 'mfn-opts'),
							'options' => [
								'title' => [
									'input',
									__('Title', 'mfn-opts'),
									__('Bar item', 'mfn-opts'),
								],
								'value' => [
									'input',
									__('Value', 'mfn-opts'),
									'50',
								],
								'size' => [
									'input',
									__('Size', 'mfn-opts'),
									'20',
								],
								'color' => [
									'input',
									__('Color (optional)', 'mfn-opts'),
									'',
								],
							],
							'std' => [
								0 => [
									'title' => 'This is the 1st bar',
									'value' => '50',
									'size' => '10',
									'color' => '#72a5d8',
								],
								1 => [
									'title' => 'This is the 2nd bar',
									'value' => '30',
									'size' => '15',
									'color' => 'grey',
								],
							],
							'preview' => 'tabs',
   					),

   					array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
							'class' => 'form-content-full-width',
   					),

						// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Promo Box ------------------------------------------------------

   			'promo_box' => array(
   				'type' => 'promo_box',
   				'title' => __('Promo Box', 'mfn-opts'),
   				'size' => '1/2',
   				'cat' => 'boxes',
   				'fields' => array(

   					array(
   						'id' => 'image',
   						'type' => 'upload',
   						'title' => __('Image', 'mfn-opts'),
   						'desc' => __('Recommended minimum image width <b>768px</b>', 'mfn-opts'),
							'std' => $this->get_placeholder(),
							'preview' => 'image',
   					),

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

   					array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
							'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
							'preview' => 'content',
							'class' => 'form-content-full-width',
   					),

   					// button

   					array(
   						'title' => __('Button', 'mfn-opts'),
   					),

   					array(
   						'id' => 'btn_text',
   						'type' => 'text',
   						'title' => __('Text', 'mfn-opts'),
   					),
   					array(
   						'id' => 'btn_link',
   						'type' => 'text',
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'target',
   						'type' => 'select',
   						'title' => __('Link target', 'mfn-opts'),
   						'options' => array(
   							0 => __('Default | _self', 'mfn-opts'),
   							1 => __('New tab or window | _blank', 'mfn-opts'),
   							'lightbox' => __('Lightbox (image or embed video)', 'mfn-opts'),
   						),
   					),

   					// options

   					array(
   						'title' => __('Options', 'mfn-opts'),
   					),

   					array(
   						'id' => 'position',
   						'type' => 'switch',
   						'title' => __('Image position', 'mfn-opts'),
   						'options' => array(
   							'left' => __('Left', 'mfn-opts'),
   							'right' => __('Right', 'mfn-opts'),
   						),
   						'std' => 'left',
   					),

   					array(
   						'id' => 'border',
   						'type' => 'switch',
   						'title' => __('Border right', 'mfn-opts'),
   						'options' => array(
   							0 => __('Hide', 'mfn-opts'),
   							1 => __('Show', 'mfn-opts'),
   						),
							'std' => 0,
   					),

						// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'animate',
   						'type' => 'select',
   						'title' => __('Animation', 'mfn-opts'),
   						'options' => $this->get_animations(),
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Quick Fact -----------------------------------------------------

   			'quick_fact' => array(
   				'type' => 'quick_fact',
   				'title' => __('Quick Fact', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'boxes',
   				'fields' => array(

   					array(
   						'id' => 'heading',
   						'type' => 'text',
   						'title' => __('Heading', 'mfn-opts'),
							'std' => __('This is the heading', 'mfn-opts'),
							'preview' => 'title',
   					),

						array(
							'id' => 'heading_tag',
							'type' 	=> 'switch',
							'title' => __('Heading tag', 'mfn-opts'),
							'options' => array(
								'h1' => 'H1',
								'h2' => 'H2',
								'h3' => 'H3',
								'h4' => 'H4',
								'h5' => 'H5',
								'h6' => 'H6',
							),
							'std' => 'h4'
						),

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'subtitle',
	   				),

						array(
							'id' => 'title_tag',
							'type' 	=> 'switch',
							'title' => __('Title tag', 'mfn-opts'),
							'options' => array(
								'h1' => 'H1',
								'h2' => 'H2',
								'h3' => 'H3',
								'h4' => 'H4',
								'h5' => 'H5',
								'h6' => 'H6',
							),
							'std' => 'h3'
						),

   					array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
							'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
							'preview' => 'content',
							'class' => 'form-content-full-width',
   					),

   					// quick fact

   					array(
   						'title' => __('Quick fact', 'mfn-opts'),
   					),

   					array(
   						'id' => 'number',
   						'type' => 'text',
   						'title' => __('Number', 'mfn-opts'),
   						'param' => 'number',
   						'class' => 'narrow',
   						'std' => '99',
   						'preview' => 'number',
   					),

   					array(
   						'id' => 'prefix',
   						'type' => 'text',
   						'title' => __('Prefix', 'mfn-opts'),
   						'class' => 'narrow',
   					),

   					array(
   						'id' => 'label',
   						'type' => 'text',
   						'title' => __('Postfix', 'mfn-opts'),
   						'class' => 'narrow',
   					),

   					// options

   					array(
   						'title' => __('Options', 'mfn-opts'),
   					),

   					array(
   						'id' => 'align',
   						'type' => 'switch',
   						'title' => __('Align', 'mfn-opts'),
   						'options' => array(
								'left' => __('Left', 'mfn-opts'),
   							'' => __('Center', 'mfn-opts'),
   							'right' => __('Right', 'mfn-opts'),
   						),
							'std' => '',
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'animate',
   						'type' => 'select',
   						'title' => __('Animation', 'mfn-opts'),
   						'options' => $this->get_animations(),
   					),

						// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),


						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Shop ----------------------------------------------------

   			'shop' => array(
   				'type' => 'shop',
   				'title' => __('Shop', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'loops',
   				'fields' => array(

   					array(
   						'id' => 'limit',
   						'type' => 'text',
   						'title' => __('Products number', 'mfn-opts'),
   						'std' => '6',
   						'after' => 'products',
   						'param' => 'number',
   						'class' => 'narrow',
							'preview' => 'number',
   					),

   					array(
   						'id' => 'columns',
   						'type' => 'switch',
   						'title' => __('Columns', 'mfn-opts'),
							'options' => array(
								2 => 2,
								3 => 3,
								4 => 4,
							),
   						'std' => '3',
   					),

						array(
   						'id' => 'type',
   						'type' => 'select',
   						'title' => __('Display', 'mfn-opts'),
   						'options' => array(
   							'products' => __('- Default -', 'mfn-opts'),
   							'sale_products' => __('On sale', 'mfn-opts'),
   							'best_selling_products' => __('Best selling (order by: Sales)', 'mfn-opts'),
   							'top_rated_products' => __('Top-rated (order by: Rating)', 'mfn-opts'),
   						),
   					),

						// options

   					array(
   						'title' => __('Options', 'mfn-opts'),
   					),

   					array(
   						'id' => 'category',
   						'type' => 'select',
   						'title' => __('Category', 'mfn-opts'),
   						'options' => mfn_get_categories('product_cat'),
							'preview' => 'category',
   					),

   					array(
   						'id' => 'orderby',
   						'type' => 'select',
   						'title' => __('Order by', 'mfn-opts'),
   						'options' => array(
   							'date' => __('Date the product was published', 'mfn-opts'),
   							'id' => __('ID of the product', 'mfn-opts'),
   							'menu_order' => __('Menu order (if set)', 'mfn-opts'),
   							'popularity' => __('Popularity (number of purchases)', 'mfn-opts'),
   							'rating' => __('Rating', 'mfn-opts'),
   							'title' => __('Title', 'mfn-opts'),
								'rand' => __('Random (do not use with pagination)', 'mfn-opts'),
   						),
   						'std' => 'title'
   					),

   					array(
   						'id' => 'order',
   						'type' => 'switch',
   						'title' => __('Order', 'mfn-opts'),
   						'options' => array(
   							'ASC' => __('Ascending', 'mfn-opts'),
   							'DESC' => __('Descending', 'mfn-opts'),
   						),
   						'std' => 'ASC'
   					),

						// advanced

						array(
							'title' => __('Advanced', 'mfn-opts'),
						),

						array(
   						'id' => 'paginate',
   						'type' => 'switch',
   						'title' => __('Pagination', 'mfn-opts'),
   						'options' => array(
   							0 => __('Hide', 'mfn-opts'),
   							1 => __('Show', 'mfn-opts'),
   						),
   						'std' => 0,
   					),


						// custom

						array(
							'title' => __('Custom', 'mfn-opts'),
						),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Shop Slider ----------------------------------------------------

   			'shop_slider' => array(
   				'type' => 'shop_slider',
   				'title' => __('Shop Slider', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'loops',
   				'fields' => array(

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

   					array(
   						'id' => 'count',
   						'type' => 'text',
   						'title' => __('Products number', 'mfn-opts'),
   						'std' => '5',
							'after' => 'products',
   						'param' => 'number',
   						'class' => 'narrow',
							'preview' => 'number',
   					),

   					array(
   						'id' => 'show',
   						'type' => 'select',
   						'title' => __('Display', 'mfn-opts'),
   						'options' => array(
   							'' => __('All (or category selected below)', 'mfn-opts'),
   							'featured' => __('Featured', 'mfn-opts'),
   							'onsale' => __('Onsale', 'mfn-opts'),
   							'best-selling' => __('Best Selling (order by: Sales)', 'mfn-opts'),
   						),
   					),

						// options

   					array(
   						'title' => __('Options', 'mfn-opts'),
   					),

   					array(
   						'id' => 'category',
   						'type' => 'select',
   						'title' => __('Category', 'mfn-opts'),
   						'options' => mfn_get_categories('product_cat'),
							'preview' => 'category',
   					),

   					array(
   						'id' => 'orderby',
   						'type' => 'switch',
   						'title' => __('Order by', 'mfn-opts'),
   						'options' => array(
   							'date' => __('Date', 'mfn-opts'),
   							'title' => __('Title', 'mfn-opts'),
   						),
   						'std' => 'date'
   					),

   					array(
   						'id' => 'order',
   						'type' => 'switch',
   						'title' => __('Order', 'mfn-opts'),
   						'options' => array(
   							'ASC' => __('Ascending', 'mfn-opts'),
   							'DESC' => __('Descending', 'mfn-opts'),
   						),
   						'std' => 'DESC'
   					),

						// custom

						array(
							'title' => __('Custom', 'mfn-opts'),
						),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Sidebar Widget -------------------------------------------------

   			'sidebar_widget' => array(
   				'type' => 'sidebar_widget',
   				'title' => __('Sidebar Widget', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'other',
   				'fields' => array(

   					array(
   						'id' => 'sidebar',
   						'type' => 'select',
   						'title' => __('Select Sidebar', 'mfn-opts'),
   						'desc' => __('1. Create Sidebar in <a target="_blank" href="admin.php?page=be-options#sidebars">Theme Options > Sidebars</a><br />2. Add Widgets<br />3. Select your sidebar.', 'mfn-opts'),
   						'options' => mfn_opts_get('sidebars'),
   					),

						// custom

						array(
							'title' => __('Custom', 'mfn-opts'),
						),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Slider ---------------------------------------------------------

   			'slider' => array(
   				'type' => 'slider',
   				'title' => __('Slider', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'blocks',
   				'fields' => array(

   					array(
   						'id' => 'category',
   						'type' => 'select',
   						'title' => __('Category', 'mfn-opts'),
   						'options' => mfn_get_categories('slide-types'),
							'preview' => 'category',
   					),

   					array(
   						'id' => 'orderby',
   						'type' => 'switch',
   						'title' => __('Order by', 'mfn-opts'),
   						'options' => array(
   							'date' => __('Date', 'mfn-opts'),
   							'menu_order' => __('Menu order', 'mfn-opts'),
   							'title' => __('Title', 'mfn-opts'),
   						),
   						'std' => 'date'
   					),

   					array(
   						'id' => 'order',
   						'type' => 'switch',
   						'title' => __('Order', 'mfn-opts'),
   						'options' => array(
   							'ASC' => __('Ascending', 'mfn-opts'),
   							'DESC' => __('Descending', 'mfn-opts'),
   						),
   						'std' => 'DESC'
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'style',
   						'type' => 'select',
							'title' => __('Style', 'mfn-opts'),
   						'options' => array(
   							'' => __('Default', 'mfn-opts'),
   							'flat' => __('Flat', 'mfn-opts'),
   							'description' => __('Flat with title and description', 'mfn-opts'),
   							'carousel' => __('Flat carousel with titles', 'mfn-opts'),
   							'center' => __('Center mode', 'mfn-opts'),
   						),
							'preview' => 'style',
   					),

   					array(
   						'id' => 'navigation',
   						'type' => 'switch',
   						'title' => __('Navigation', 'mfn-opts'),
   						'options' => array(
   							'' => __('Default', 'mfn-opts'),
   							'hide-arrows' => __('Hide Arrows', 'mfn-opts'),
   							'hide-dots' => __('Hide Dots', 'mfn-opts'),
   							'hide' => __('Hide', 'mfn-opts'),
   						),
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Slider Plugin --------------------------------------------------

   			'slider_plugin' => array(
   				'type' => 'slider_plugin',
   				'title' => __('Slider Plugin', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'other',
   				'fields' => array(

						// revolution slider

   					array(
   						'title' => __('Slider Revolution', 'mfn-opts'),
   					),

   					array(
   						'id' => 'rev',
   						'type' => 'select',
   						'title' => __('Slider', 'mfn-opts'),
   						'options' => $this->sliders['rev'],
   						'preview' => 'slider-rev',
   					),

						// layer slider

   					array(
   						'title' => __('Layer Slider', 'mfn-opts'),
   					),

   					array(
   						'id' => 'layer',
   						'type' => 'select',
   						'title' => __('Slider', 'mfn-opts'),
   						'options' => $this->sliders['layer'],
							'preview' => 'slider-layer',
   					),

						// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Sliding Box ----------------------------------------------------

   			'sliding_box' => array(
   				'type' => 'sliding_box',
   				'title' => __('Sliding Box', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'boxes',
   				'fields' => array(

   					array(
   						'id' => 'image',
   						'type' => 'upload',
   						'title' => __('Image', 'mfn-opts'),
   						'desc' => __('Recommended image width <b>768px - 1920px</b> depending on size of the item', 'mfn-opts'),
							'std' => $this->get_placeholder(),
							'preview' => 'image',
   					),

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
   						'desc' => __('Allowed HTML tags: span, strong, b, em, i, u', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

						// link

						array(
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'link',
   						'type' => 'text',
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'target',
   						'type' => 'select',
   						'title' => __('Target', 'mfn-opts'),
   						'options' => array(
   							0 => __('Default | _self', 'mfn-opts'),
   							1 => __('New tab or window | _blank', 'mfn-opts'),
   							'lightbox' => __('Lightbox (image or embed video)', 'mfn-opts'),
   						),
   					),

						// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'animate',
   						'type' => 'select',
   						'title' => __('Animation', 'mfn-opts'),
   						'options' => $this->get_animations(),
   					),

						// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Story Box ------------------------------------------------------

   			'story_box' => array(
   				'type' => 'story_box',
   				'title' => __('Story Box', 'mfn-opts'),
   				'size' => '1/2',
   				'cat' => 'boxes',
   				'fields' => array(

   					array(
   						'id' => 'image',
   						'type' => 'upload',
   						'title' => __('Image', 'mfn-opts'),
   						'desc' => __('Recommended image width <b>750px - 1500px</b> depending on size of the item', 'mfn-opts'),
							'std' => $this->get_placeholder(),
							'preview' => 'image',
   					),

   					array(
   						'id' => 'style',
   						'type' => 'switch',
   						'title' => __('Style', 'mfn-opts'),
   						'options' => array(
   							'' => __('Horizontal Image', 'mfn-opts'),
   							'vertical' => __('Vertical Image', 'mfn-opts'),
   						),
							'std' => '',
   					),

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

   					array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
							'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
							'preview' => 'content',
							'class' => 'form-content-full-width',
   					),

						// link

   					array(
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'link',
   						'type' => 'text',
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'target',
   						'type' => 'select',
   						'title' => __('Target', 'mfn-opts'),
   						'options' => array(
   							0 => __('Default | _self', 'mfn-opts'),
   							1 => __('New tab or window | _blank', 'mfn-opts'),
   							'lightbox' => __('Lightbox (image or embed video)', 'mfn-opts'),
   						),
   					),

						// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'animate',
   						'type' => 'select',
   						'title' => __('Animation', 'mfn-opts'),
   						'options' => $this->get_animations(),
   					),

						// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Tabs -----------------------------------------------------------

   			'tabs' => array(
   				'type' => 'tabs',
   				'title' => __('Tabs', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'blocks',
   				'fields' => array(

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

   					// tabs

   					array(
   						'title' => __('Tabs', 'mfn-opts'),
   					),

   					array(
   						'id' => 'tabs',
   						'type' => 'tabs',
   						'title' => __('Tabs', 'mfn-opts'),
   						'desc' => __('<b>JavaScript</b> content like Google Maps and some plugins shortcodes do <b>not work</b> in tabs. You can use Drag & Drop to set the order', 'mfn-opts'),
							'options' => [
								'title' => [
									'input',
									__('Title', 'mfn-opts'),
									__('Sample tab', 'mfn-opts'),
								],
								'content' => [
									'textarea',
									__('Content', 'mfn-opts'),
									'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu massa orci.',
								],
							],
							'std' => [
								0 => [
									'title' => __('This is the 1st tab', 'mfn-opts'),
									'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu massa orci.',
								],
								1 => [
									'title' => __('This is the 2nd tab', 'mfn-opts'),
									'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu massa orci.',
								],
							],
							'preview' => 'tabs',
   					),

   					// options

   					array(
   						'title' => __('Options', 'mfn-opts'),
   					),

   					array(
   						'id' => 'type',
   						'type' => 'switch',
   						'title' => __('Style', 'mfn-opts'),
   						'options' => array(
   							'horizontal' => __('Horizontal', 'mfn-opts'),
   							'centered' => __('Horizontal (centered tabs)', 'mfn-opts'),
   							'vertical' => __('Vertical', 'mfn-opts'),
   						),
							'std' => 'horizontal',
   					),

   					array(
   						'id' => 'padding',
   						'type' => 'text',
   						'title' => __('Content padding', 'mfn-opts'),
   						'desc' => __('Use value with <b>px</b> or <b>%</b><br />Example: <b>20px</b> or <b>15px 20px 20px</b> or <b>20px 1%</b>', 'mfn-opts'),
   						'placeholder' => '20px',
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

   					array(
   						'id' => 'uid',
   						'type' => 'text',
   						'title' => __('Unique ID [optional]', 'mfn-opts'),
   						'desc' => __('Use if you want to open specified tab from link (does not work on the same page).<br />For example: Your Unique ID is <b>offer</b> and you want to open 2nd tab, please use link: <b>your-url/#offer-2</b>', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Testimonials ---------------------------------------------------

   			'testimonials' => array(
   				'type' => 'testimonials',
   				'title' => __('Testimonials', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'loops',
   				'fields' => array(

   					array(
   						'id' => 'category',
   						'type' => 'select',
   						'title' => __('Category', 'mfn-opts'),
   						'options' => mfn_get_categories('testimonial-types'),
							'preview' => 'category',
   					),

   					array(
   						'id' => 'orderby',
   						'type' => 'switch',
   						'title' => __('Order by', 'mfn-opts'),
   						'options' => array(
   							'date' => __('Date', 'mfn-opts'),
   							'menu_order' => __('Menu order', 'mfn-opts'),
   							'title' => __('Title', 'mfn-opts'),
   						),
   						'std' => 'date',
   					),

   					array(
   						'id' => 'order',
   						'type' => 'switch',
   						'title' => __('Order', 'mfn-opts'),
   						'options' => array(
   							'ASC' => __('Ascending', 'mfn-opts'),
   							'DESC' => __('Descending', 'mfn-opts'),
   						),
   						'std' => 'DESC',
   					),

   					// options

   					array(
   						'title' => __('Options', 'mfn-opts'),
   					),

   					array(
   						'id' => 'style',
   						'type' => 'switch',
   						'title' => __('Style', 'mfn-opts'),
   						'options' => array(
   							'' => __('Default', 'mfn-opts'),
   							'single-photo' => __('Single photo', 'mfn-opts'),
   						),
							'std' => '',
							'preview' => 'style',
   					),

   					array(
   						'id' => 'hide_photos',
   						'type' => 'switch',
   						'title' => __('Photos', 'mfn-opts'),
   						'options' => array(
								1 => __('Hide', 'mfn-opts'),
   							0 => __('Show', 'mfn-opts'),
   						),
							'std' => 0,
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Testimonials List ----------------------------------------------

   			'testimonials_list' => array(
   				'type' => 'testimonials_list',
   				'title' => __('Testimonials List', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'loops',
   				'fields' => array(

   					array(
   						'id' => 'category',
   						'type' => 'select',
   						'title' => __('Category', 'mfn-opts'),
   						'options' => mfn_get_categories('testimonial-types'),
							'preview' => 'category',
   					),

   					array(
   						'id' => 'orderby',
   						'type' => 'switch',
   						'title' => __('Order by', 'mfn-opts'),
   						'options' => array(
   							'date' => __('Date', 'mfn-opts'),
   							'menu_order' => __('Menu order', 'mfn-opts'),
   							'title' => __('Title', 'mfn-opts'),
   						),
   						'std' => 'date',
   					),

   					array(
   						'id' => 'order',
   						'type' => 'switch',
   						'title' => __('Order', 'mfn-opts'),
   						'options' => array(
   							'ASC' => __('Ascending', 'mfn-opts'),
   							'DESC' => __('Descending', 'mfn-opts'),
   						),
   						'std' => 'DESC',
   					),

						// options

   					array(
   						'title' => __('Options', 'mfn-opts'),
   					),

   					array(
   						'id' => 'style',
   						'type' => 'switch',
   						'title' => __('Style', 'mfn-opts'),
   						'options' => array(
   							'' => __('Default', 'mfn-opts'),
   							'quote' => __('Quote above the author', 'mfn-opts'),
   						),
							'std' => '',
							'preview' => 'style',
   					),

						// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Timeline -------------------------------------------------------

   			'timeline' => array(
   				'type' => 'timeline',
   				'title' => __('Timeline', 'mfn-opts'),
   				'size' => '1/1',
   				'cat' => 'elements',
   				'fields' => array(

   					array(
   						'id' => 'tabs',
   						'type' => 'tabs',
   						'title' => __('Timeline', 'mfn-opts'),
							'desc' => __('<b>JavaScript</b> content like Google Maps and some plugins shortcodes do <b>not work</b> in tabs', 'mfn-opts'),
							'options' => [
								'title' => [
									'input',
									__('Title', 'mfn-opts'),
									__('Sample event', 'mfn-opts'),
								],
								'date' => [
									'input',
									__('Date', 'mfn-opts'),
									'2021',
								],
								'content' => [
									'textarea',
									__('Content', 'mfn-opts'),
									'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu massa orci.',
								],
							],
							'std' => [
								0 => [
									'title' => __('This is the 1st event', 'mfn-opts'),
									'date' => '2021',
									'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu massa orci.',
								],
								1 => [
									'title' => __('This is the 2nd event', 'mfn-opts'),
									'date' => '2022',
									'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu massa orci.',
								],
							],
							'preview' => 'tabs',
   					),

						// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Trailer Box ----------------------------------------------------

   			'trailer_box' => array(
   				'type' => 'trailer_box',
   				'title' => __('Trailer Box', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'boxes',
   				'fields' => array(

   					array(
   						'id' => 'image',
   						'type' => 'upload',
   						'title' => __('Image', 'mfn-opts'),
   						'desc' => __('Recommended image width <b>768px - 1920px</b> depending on size of the item', 'mfn-opts'),
							'std' => $this->get_placeholder(),
							'preview' => 'image',
   					),

						array(
   						'id' => 'orientation',
   						'type' => 'switch',
   						'title' => __('Image orientation', 'mfn-opts'),
   						'options' => array(
   							'' => __('Vertical', 'mfn-opts'),
   							'horizontal' => __('Horizontal', 'mfn-opts'),
   						),
							'std' => '',
   					),

   					array(
   						'id' => 'slogan',
   						'type' => 'text',
   						'title' => __('Slogan', 'mfn-opts'),
							'std' => __('This is the slogan', 'mfn-opts'),
							'preview' => 'subtitle',
   					),

   					array(
   						'id' => 'title',
   						'type' => 'text',
   						'title' => __('Title', 'mfn-opts'),
							'std' => __('This is the title', 'mfn-opts'),
							'preview' => 'title',
   					),

						// link

   					array(
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'link',
   						'type' => 'text',
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'target',
   						'type' => 'select',
   						'title' => __('Target', 'mfn-opts'),
   						'options' => array(
   							0 => __('Default | _self', 'mfn-opts'),
   							1 => __('New tab or window | _blank', 'mfn-opts'),
   							'lightbox' => __('Lightbox (image or embed video)', 'mfn-opts'),
   						),
   					),

   					// advanced

   					array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'style',
   						'type' => 'switch',
   						'title' => __('Style', 'mfn-opts'),
   						'options' => array(
   							'' => __('Default', 'mfn-opts'),
   							'plain' => __('Plain', 'mfn-opts'),
   						),
							'std' => '',
   					),

   					array(
   						'id' => 'animate',
   						'type' => 'select',
   						'title' => __('Animation', 'mfn-opts'),
   						'desc' => __('In some versions of Safari hover works only if you select Not Animated or Fade In', 'mfn-opts'),
   						'options' => $this->get_animations(),
   					),

   					// custom

   					array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Video  --------------------------------------------

   			'video' => array(
   				'type' => 'video',
   				'title' => __('Video', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'elements',
   				'fields' => array(

						// youtube vimeo

   					array(
   						'title' => __('YouTube or Vimeo', 'mfn-opts'),
   					),

   					array(
   						'id' => 'video',
   						'type' => 'text',
   						'title' => __('Video ID', 'mfn-opts'),
   						'desc' => __('<b>YouTube:</b> http://www.youtube.com/watch?v=<u>WoJhnRczeNg</u><br /><b>Vimeo:</b> http://vimeo.com/<u>62954028</u>', 'mfn-opts'),
							'preview' => 'title',
   					),

   					array(
   						'id' => 'parameters',
   						'type' => 'text',
   						'title' => __('Parameters', 'mfn-opts'),
   						'desc' => __('Multiple parameters should be connected with "&"<br />Example: <b>autoplay=1&loop=1</b><br />Notice: Vimeo authors may disable some parameters for their videos', 'mfn-opts'),
   					),

						// html5

						array(
   						'title' => __('HTML5', 'mfn-opts'),
   					),

   					array(
   						'id' => 'mp4',
   						'type' => 'upload',
   						'title' => __('MP4 video', 'mfn-opts'),
   						'desc' => __('Please add both mp4 and ogv for cross-browser compatibility', 'mfn-opts'),
   						'data' => 'video',
   					),

   					array(
   						'id' => 'ogv',
   						'type' => 'upload',
   						'title' => __('OGV video', 'mfn-opts'),
   						'data' => 'video',
   					),

   					array(
   						'id' => 'placeholder',
   						'type' => 'upload',
   						'title' => __('Placeholder image', 'mfn-opts'),
   						'desc' => __('Placeholder Image will be used as video placeholder before video loads and on mobile devices', 'mfn-opts'),
   					),

   					array(
   						'id' => 'html5_parameters',
   						'type' => 'select',
   						'title' => __('Parameters', 'mfn-opts'),
   						'desc' => __('WebKit browsers and iOS do not support autoplay', 'mfn-opts'),
   						'options' => array(
   							'' => __('autoplay controls loop muted', 'mfn-opts'),
   							'a;c;l;' => __('autoplay controls loop', 'mfn-opts'),
   							'a;c;;m' => __('autoplay controls muted', 'mfn-opts'),
   							'a;;l;m' => __('autoplay loop muted', 'mfn-opts'),
   							'a;c;;' => __('autoplay controls', 'mfn-opts'),
   							'a;;l;' => __('autoplay loop', 'mfn-opts'),
   							'a;;;m' => __('autoplay muted', 'mfn-opts'),
   							'a;;;' => __('autoplay', 'mfn-opts'),
   							';c;l;m' => __('controls loop muted', 'mfn-opts'),
   							';c;l;' => __('controls loop', 'mfn-opts'),
   							';c;;m' => __('controls muted', 'mfn-opts'),
   							';c;;' => __('controls', 'mfn-opts'),
   						),
   					),

						// advanced

						array(
   						'title' => __('Advanced', 'mfn-opts'),
   					),

   					array(
   						'id' => 'width',
   						'type' => 'text',
   						'title' => __('Width', 'mfn-opts'),
   						'param' => 'number',
   						'after' => 'px',
   						'class' => 'narrow',
   						'placeholder' => 700,
   					),

   					array(
   						'id' => 'height',
   						'type' => 'text',
   						'title' => __('Height', 'mfn-opts'),
							'param' => 'number',
   						'after' => 'px',
   						'class' => 'narrow',
   						'placeholder' => 400,
   					),

						// custom

						array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Visual Editor  -------------------------------------------------

   			'visual' => array(
   				'type' => 'visual',
   				'title' => __('Visual Editor', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'other',
   				'fields' => array(

   					array(
   						'id' => 'content',
   						'type' => 'visual',
   						'title' => __('Editor', 'mfn-opts'),
							'class' => 'form-content-full-width',
							'preview' => 'content',
							'vbstd' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
   					),

						// custom

						array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   			// Zoom Box -------------------------------------------------------

   			'zoom_box' => array(
   				'type' => 'zoom_box',
   				'title' => __('Zoom Box', 'mfn-opts'),
   				'size' => '1/4',
   				'cat' => 'boxes',
   				'fields' => array(

   					array(
   						'id' => 'image',
   						'type' => 'upload',
   						'title' => __('Image', 'mfn-opts'),
   						'desc' => __('Recommended image width <b>768px - 1920px</b> depending on size of the item', 'mfn-opts'),
							'std' => $this->get_placeholder(),
							'preview' => 'image',
   					),

   					array(
   						'id' => 'content_image',
   						'type' => 'upload',
   						'title' => __('Content image', 'mfn-opts'),
   					),

   					array(
   						'id' => 'content',
   						'type' => 'textarea',
   						'title' => __('Content', 'mfn-opts'),
							'std' => 'Lorem ipsum dolor',
							'preview' => 'content',
							'class' => 'form-content-full-width',
   					),

						array(
   						'id' => 'bg_color',
   						'type' => 'color',
   						'title' => __('Overlay background', 'mfn-opts'),
   						'std' => '#CCCCCC',
   					),

						// link

						array(
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'link',
   						'type' => 'text',
   						'title' => __('Link', 'mfn-opts'),
   					),

   					array(
   						'id' => 'target',
   						'type' => 'select',
   						'title' => __('Target', 'mfn-opts'),
   						'options' => array(
   							0 => __('Default | _self', 'mfn-opts'),
   							1 => __('New tab or window | _blank', 'mfn-opts'),
   							'lightbox' => __('Lightbox (image or embed video)', 'mfn-opts'),
   						),
   					),

						// custom

						array(
   						'title' => __('Custom', 'mfn-opts'),
   					),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

   				),
   			),

   		);

   	}

		/**
		 * GET inline shortcodes for CodeMirror
		 */

		public static function get_inline_shortcode(){

			$shortcode_inline = array(

				'alert' => array(
					'type' => 'alert',
					'title' => __('Alert', 'mfn-opts'),
					'fields' => array(

						array(
							'id' => 'style',
							'type' => 'select',
							'title' => __('Style', 'mfn-opts'),
							'desc' => __('Please select the alert style above', 'mfn-opts'),
							'options' => array(
								'warning' => __('Warning', 'mfn-opts'),
								'error' => __('Error', 'mfn-opts'),
								'info' => __('Info', 'mfn-opts'),
								'success' => __('Success', 'mfn-opts'),
							),
							'std' => 'warning'
						),

						array(
							'id' => 'content',
							'type' => 'textarea',
							'title' => __('Content', 'mfn-opts'),
						)

					),
				),

				'blockquote' => array(
					'type' => 'blockquote',
					'title' => __('Blockquote', 'mfn-opts'),
					'fields' => array(

						array(
							'id' => 'author',
							'type' => 'text',
							'title' => __('Author', 'mfn-opts'),
							'desc' => __('Blockquote author', 'mfn-opts'),
						),

						array(
							'id' => 'link',
							'type' => 'text',
							'title' => __('Link', 'mfn-opts'),
							'desc' => __("Link to author's page", 'mfn-opts'),
						),

						array(
							'id' => 'target',
							'type' => 'select',
							'title' => __('Target', 'mfn-opts'),
							'desc' => __('Link target', 'mfn-opts'),
							'options' => array(
								'0' => __('Default', 'mfn-opts'),
								'_blank' => __('New tab or window', 'mfn-opts'),
								'lightbox' => __('Lightbox', 'mfn-opts'),
							),
							'std' => '0'
						),

						array(
							'id' => 'content',
							'type' => 'textarea',
							'title' => __('Content', 'mfn-opts'),
						),

					),
				),

				'button' => array(
					'type' => 'button',
					'title' => __('Button', 'mfn-opts'),
					'fields' => array(

						array(
							'id' => 'title',
							'type' => 'text',
							'title' => __('Button', 'mfn-opts'),
							'desc' => __('Text on the button', 'mfn-opts'),
							'std' => 'Button'
						),

						array(
							'id' => 'link',
							'type' => 'text',
							'title' => __('Link', 'mfn-opts'),
							'desc' => __('Link (with http://)', 'mfn-opts')
						),

						array(
							'id' => 'target',
							'type' => 'select',
							'title' => __('Target', 'mfn-opts'),
							'desc' => __('Link target', 'mfn-opts'),
							'options' => array(
								'0' => __('Default', 'mfn-opts'),
								'_blank' => __('New tab or window', 'mfn-opts'),
								'lightbox' => __('Lightbox', 'mfn-opts'),
							),
							'std' => '0'
						),

						array(
							'id' => 'align',
							'type' => 'switch',
							'title' => __('Align', 'mfn-opts'),
							'desc' => __('Button align', 'mfn-opts'),
							'options' => array(
								'left' => __('Left', 'mfn-opts'),
								'center' => __('Center', 'mfn-opts'),
								'right' => __('Right', 'mfn-opts')
							),
						),

						array(
							'id' => 'icon',
							'type' => 'icon',
							'title' => __('Icon', 'mfn-opts'),
							'desc' => __('To use a button with an icon, type the icon name here', 'mfn-opts'),
						),

						array(
							'id' => 'icon_position',
							'type' => 'switch',
							'title' => __('Icon position', 'mfn-opts'),
							'desc' => __('Icon position', 'mfn-opts'),
							'options' => array(
								'left' => __('Left', 'mfn-opts'),
								'right' => __('Right', 'mfn-opts')
							),
						),

						array(
							'id' => 'color',
							'type' => 'color',
							'title' => __('Button background color', 'mfn-opts'),
							'alpha' => true
						),

						array(
							'id' => 'font_color',
							'type' => 'color',
							'title' => __('Button text color', 'mfn-opts'),
						),

						array(
							'id' => 'size',
							'type' => 'switch',
							'title' => __('Button Size', 'mfn-opts'),
							'options' => array(
								'1' => __('Small', 'mfn-opts'),
								'2' => __('Default', 'mfn-opts'),
								'3' => __('Large', 'mfn-opts'),
								'4' => __('Very Large', 'mfn-opts')
							),
							'std' => '2'
						),

						array(
							'id' => 'full_width',
							'type' => 'switch',
							'title' => __('Full Width', 'mfn-opts'),
							'desc' => __('Stretch to the width of the column', 'mfn-opts'),
							'options' => array(
								'' => __('No', 'mfn-opts'),
								'1' => __('Yes', 'mfn-opts')
							)
						),

						array(
							'id' => 'class',
							'type' => 'pills',
							'title' => __('Class', 'mfn-opts'),
							'desc' => __('CSS Classes', 'mfn-opts')
						),

						array(
							'id' => 'rel',
							'type' => 'text',
							'title' => __('Rel', 'mfn-opts'),
							'desc' => __('"Rel" attribute to the link', 'mfn-opts'),
							'before' => 'rel='
						),

						array(
							'id' => 'download',
							'type' => 'text',
							'title' => __('Download', 'mfn-opts'),
							'desc' => __('Enter the new filename (if click on button downloads a file)', 'mfn-opts')
						),

						array(
							'id' => 'onclick',
							'type' => 'text',
							'title' => __('onclick', 'mfn-opts'),
							'desc' => __('"Onclick" attribute to the link', 'mfn-opts'),
							'before' => 'onclick='
						),

					),
				),

				'code' => array(
					'type' => 'code',
					'title' => __('Code', 'mfn-opts'),
					'fields' => array(

						array(
							'id' => 'content',
							'type' => 'textarea',
							'title' => __('Content', 'mfn-opts'),
							'desc' => __('Code inside the box', 'mfn-opts'),
						),

					),
				),

				'content_link' => array(
					'type' => 'content_link',
					'title' => __('Content link', 'mfn-opts'),
					'fields' => array(

						array(
							'id' => 'title',
							'type' => 'text',
							'title' => __('Title', 'mfn-opts'),
							'desc' => __('Item title text', 'mfn-opts'),
						),

						array(
							'id' => 'icon',
							'type' => 'icon',
							'title' => __('Icon', 'mfn-opts'),
							'std' => 'icon-lamp'
						),

						array(
							'id' => 'target',
							'type' => 'select',
							'title' => __('Target', 'mfn-opts'),
							'desc' => __('Link target', 'mfn-opts'),
							'options' => array(
								'0' => __('Default', 'mfn-opts'),
								'_blank' => __('New tab or window', 'mfn-opts')
							),
							'std' => '0'
						),

						array(
							'id' => 'class',
							'type' => 'pills',
							'title' => __('Class', 'mfn-opts'),
							'desc' => __('CSS classess', 'mfn-opts')
						),

						array(
							'id' => 'download',
							'type' => 'text',
							'title' => __('Download', 'mfn-opts'),
							'desc' => __('Enter the new filename (if click on button downloads a file)', 'mfn-opts')
						),

					),
				),

				'counter_inline' => array(
					'type' => 'counter_inline',
					'title' => __('Counter Inline', 'mfn-opts'),
					'fields' => array(

						array(
							'id' => 'value',
							'type' => 'text',
							'title' => __('Value', 'mfn-opts'),
							'std' => 500
						),

					),
				),

				'divider' => array(
					'type' => 'divider',
					'title' => __('Divider', 'mfn-opts'),
					'fields' => array(

						array(
							'id' => 'height',
							'type' => 'text',
							'title' => __('Height', 'mfn-opts'),
							'param' => 'number',
							'after' => 'px',
							'std' => 30,
						),

						array(
							'id' => 'style',
							'type' => 'switch',
							'title' => __('Style', 'mfn-opts'),
							'options' => array(
								'default' => __('Default', 'mfn-opts'),
								'dots' => __('Dots', 'mfn-opts'),
								'zigzag' => __('ZigZag', 'mfn-opts'),
							),
							'std' => 'default',
						),

						array(
							'id' => 'line',
							'type' => 'switch',
							'title' => __('Line', 'mfn-opts'),
							'desc' => __('for style: default', 'mfn-opts'),
							'options' => array(
								'' => __('No line', 'mfn-opts'),
								'default' => __('Default', 'mfn-opts'),
								'narrow' => __('Narrow', 'mfn-opts'),
								'wide' => __('Wide', 'mfn-opts'),
							),
							'std' => '',
						),

						array(
							'id' => 'color',
							'type' => 'color',
							'title' => __('Color', 'mfn-opts'),
							'alpha' => true,
						),

						array(
							'id' => 'themecolor',
							'type' => 'switch',
							'title' => __('Theme color', 'mfn-opts'),
							'desc' => __('Overwrites color selected above', 'mfn-opts'),
							'options' => array(
								0 => __('No', 'mfn-opts'),
								1 => __('Yes', 'mfn-opts'),
							),
							'std' => 0
						),

						array(
		  				'id' => 'classes',
		  				'type' => 'pills',
		  				'title' => __('CSS classes', 'mfn-opts'),
		  			),

					),
				),

				'dropcap' => array(
					'type' => 'dropcap',
					'title' => __('Dropcap', 'mfn-opts'),
					'fields' => array(

						array(
							'id' => 'background',
							'type' => 'color',
							'title' => __('Background color', 'mfn-opts'),
							'alpha' => true
						),

						array(
							'id' => 'color',
							'type' => 'color',
							'title' => __('Text color', 'mfn-opts'),
						),

						array(
							'id' => 'circle',
							'type' => 'switch',
							'title' => __('Circle', 'mfn-opts'),
							'desc' => __('The look of dropcap', 'mfn-opts'),
							'options' => array(
								'0' => __('No', 'mfn-opts'),
								'1' => __('Yes', 'mfn-opts')
							),
							'std' => '0'
						),

						array(
							'id' => 'size',
							'type' => 'switch',
							'title' => __('Size', 'mfn-opts'),
							'desc' => __('The size of dropcap', 'mfn-opts'),
							'options' => array(
								'1' => __('Small', 'mfn-opts'),
								'2' => __('Normal', 'mfn-opts'),
								'3' => __('Large', 'mfn-opts')
							),
							'std' => '1'
						),

						array(
							'id' => 'content',
							'type' => 'textarea',
							'title' => __('Text of dropcap', 'mfn-opts')
						),

					),
				),

				'fancy_link' => array(
					'type' => 'fancy_link',
					'title' => __('Fancy Link', 'mfn-opts'),
					'fields' => array(

						array(
							'id' => 'title',
							'type' => 'text',
							'title' => __('Link text', 'mfn-opts'),
						),

						array(
							'id' => 'link',
							'type' => 'text',
							'title' => __('Link (with https://)', 'mfn-opts'),
						),

						array(
							'id' => 'target',
							'type' => 'select',
							'title' => __('Target', 'mfn-opts'),
							'desc' => __('Link target', 'mfn-opts'),
							'options' => array(
								'0' => __('Default', 'mfn-opts'),
								'_blank' => __('New tab or window', 'mfn-opts')
							)
						),

						array(
							'id' => 'style',
							'type' => 'select',
							'title' => __('Style', 'mfn-opts'),
							'desc' => __('Style of fancy link', 'mfn-opts'),
							'options' => array(
								'1' => __('1', 'mfn-opts'),
								'2' => __('2', 'mfn-opts'),
								'3' => __('3', 'mfn-opts'),
								'4' => __('4', 'mfn-opts'),
								'5' => __('5', 'mfn-opts'),
								'6' => __('6', 'mfn-opts'),
								'7' => __('7', 'mfn-opts'),
								'8' => __('8', 'mfn-opts'),
							),
							'std' => '1'
						),

						array(
							'id' => 'class',
							'type' => 'pills',
							'title' => __('Class', 'mfn-opts'),
							'desc' => __('CSS classess', 'mfn-opts')
						),

						array(
							'id' => 'download',
							'type' => 'text',
							'title' => __('Download', 'mfn-opts'),
							'desc' => __('Enter the new filename (if click on button downloads a file)', 'mfn-opts')
						),

					),
				),

				'google_font' => array(
					'type' => 'google_font',
					'title' => __('Google Font', 'mfn-opts'),
					'fields' => array(

						array(
							'id' => 'font',
							'type' => 'text',
							'title' => __('Font', 'mfn-opts'),
							'desc' => __('Google font name', 'mfn-opts'),
							'std' => 'Open Sans'
						),

						array(
							'id' => 'size',
							'type' => 'text',
							'title' => __('Size', 'mfn-opts'),
							'desc' => __('Font size in px', 'mfn-opts')
						),

						array(
							'id' => 'weight',
							'type' => 'select',
							'title' => __('Weight', 'mfn-opts'),
							'desc' => __('Font weight (some fonts only)', 'mfn-opts'),
							'options' => array(
								'100' => __('100', 'mfn-opts'),
								'200' => __('200', 'mfn-opts'),
								'300' => __('300', 'mfn-opts'),
								'400' => __('400', 'mfn-opts'),
								'500' => __('500', 'mfn-opts'),
								'600' => __('600', 'mfn-opts'),
								'700' => __('700', 'mfn-opts'),
								'800' => __('800', 'mfn-opts')
							),
							'std' => '400'
						),

						array(
							'id' => 'italic',
							'type' => 'switch',
							'title' => __('Italic', 'mfn-opts'),
							'desc' => __('Font style: italic (some fonts only)', 'mfn-opts'),
							'options' => array(
								'0' => __('No', 'mfn-opts'),
								'1' => __('Yes', 'mfn-opts')
							),
							'std' => '0'
						),

						array(
							'id' => 'letter_spacing',
							'type' => 'text',
							'title' => __('Letter Spacing', 'mfn-opts'),
							'desc' => __('Letter spacing in px', 'mfn-opts')
						),

						array(
							'id' => 'color',
							'type' => 'color',
							'title' => __('Color', 'mfn-opts'),
							'desc' => __('Color of font', 'mfn-opts'),
							'std' => '#626262'
						),

						array(
							'id' => 'subset',
							'type' => 'text',
							'title' => __('Subset', 'mfn-opts'),
							'desc' => __('Subset for font (multiple separate with comma)', 'mfn-opts')
						),

						array(
							'id' => 'content',
							'type' => 'textarea',
							'title' => __('Content', 'mfn-opts'),
						),

					),
				),

				'heading' => array(
					'type' => 'heading',
					'title' => __('Heading', 'mfn-opts'),
					'fields' => array(

						array(
							'id' => 'tag',
							'type' => 'switch',
							'title' => __('Heading size', 'mfn-opts'),
							'options' => array(
								'h1' => __('H1', 'mfn-opts'),
								'h2' => __('H2', 'mfn-opts'),
								'h3' => __('H3', 'mfn-opts'),
								'h4' => __('H4', 'mfn-opts'),
								'h5' => __('H5', 'mfn-opts'),
								'h6' => __('H6', 'mfn-opts')
							),
							'std' => 'h2'
						),

						array(
							'id' => 'align',
							'type' => 'switch',
							'title' => __('Text align', 'mfn-opts'),
							'options' => array(
								'left' => __('Left', 'mfn-opts'),
								'center' => __('Center', 'mfn-opts'),
								'right' => __('Right', 'mfn-opts')
							),
							'std' => 'center'
						),

						array(
							'id' => 'color',
							'type' => 'color',
							'title' => 'Color',
							'std' => '#000'
						),

						array(
							'id' => 'style',
							'type' => 'switch',
							'title' => __('Style', 'mfn-opts'),
							'options' => array(
								'none' => __('Default', 'mfn-opts'),
								'lines' => __('Lines', 'mfn-opts')
							),
							'std' => 'lines'
						),

						array(
							'id' => 'color2',
							'type' => 'color',
							'title' => 'Color 2',
							'std' => '#000'
						),

						array(
							'id' => 'content',
							'type' => 'textarea',
							'title' => 'Content'
						),

					),
				),

				'highlight' => array(
					'type' => 'highlight',
					'title' => __('Highlight', 'mfn-opts'),
					'fields' => array(

						array(
							'id' => 'color',
							'type' => 'color',
							'title' => 'Color'
						),

						array(
							'id' => 'background',
							'type' => 'color',
							'title' => 'Background color',
							'alpha' => true
						),

						array(
							'id' => 'content',
							'type' => 'textarea',
							'title' => 'Content'
						),

					)
				),

				'hr' => array(
					'type' => 'hr',
					'title' => __('Hr', 'mfn-opts'),
					'fields' => array(

						array(
							'id' => 'height',
							'type' => 'text',
							'title' => __('Height', 'mfn-opts'),
							'std' => 30
						),

						array(
							'id' => 'style',
							'type' => 'switch',
							'title' => __('Line style', 'mfn-opts'),
							'options' => array(
								'0' => __('Default', 'mfn-opts'),
								'dots' => __('Dots', 'mfn-opts'),
								'zigzag' => __('ZigZag', 'mfn-opts')
							),
							'std' => '0'
						),

						array(
							'id' => 'line',
							'type' => 'switch',
							'title' => __('Line width', 'mfn-opts'),
							'desc' => __('for style: default', 'mfn-opts'),
							'options' => array(
								'0' => __('Default', 'mfn-opts'),
								'narrow' => __('Narrow', 'mfn-opts'),
								'wide' => __('Wide', 'mfn-opts')
							),
							'std' => '0'
						),

						array(
							'id' => 'color',
							'type' => 'color',
							'title' => __('Line color', 'mfn-opts'),
						),

						array(
							'id' => 'themecolor',
							'type' => 'switch',
							'title' => __('Theme color', 'mfn-opts'),
							'desc' => 'Use the same color as theme color',
							'options' => array(
								'0' => __('No', 'mfn-opts'),
								'1' => __('Yes', 'mfn-opts')
							),
							'std' => '0'
						),

					),
				),

				'icon' => array(
					'type' => 'icon',
					'title' => __('Icon', 'mfn-opts'),
					'fields' => array(

						array(
							'id' => 'type',
							'type' => 'icon',
							'title' => 'Icon',
							'std' => 'icon-lamp'
						),

						array(
							'id' => 'color',
							'type' => 'color',
							'title' => __('Color', 'mfn-opts'),
						),

					),
				),

				'icon_bar' => array(
					'type' => 'icon_bar',
					'title' => __('Icon Bar', 'mfn-opts'),
					'fields' => array(

						array(
							'id' => 'icon',
							'type' => 'icon',
							'title' => __('Icon', 'mfn-opts'),
							'std' => 'icon-lamp'
						),

						array(
							'id' => 'link',
							'type' => 'text',
							'title' => __('Link', 'mfn-opts'),
						),

						array(
							'id' => 'target',
							'type' => 'select',
							'title' => __('Target', 'mfn-opts'),
							'options' => array(
								'0' => __('Default', 'mfn-opts'),
								'_blank' => __('New tab or window', 'mfn-opts'),
							),
							'std' => '0'
						),

						array(
							'id' => 'size',
							'type' => 'text',
							'title' => __('Size', 'mfn-opts'),
							'desc' => __('If you want large icon, then type large, leave field empty if you want default size', 'mfn-opts')
						),

						array(
							'id' => 'social',
							'type' => 'select',
							'title' => __('Social', 'mfn-opts'),
							'options' => array(
								'' => __('No', 'mfn-opts'),
								'facebook' => __('Facebook', 'mfn-opts'),
								'google' => __('Google', 'mfn-opts'),
								'twitter' => __('Twitter', 'mfn-opts'),
								'vimeo' => __('Vimeo', 'mfn-opts'),
								'youtube' => __('Youtube', 'mfn-opts'),
								'flickr' => __('Flickr', 'mfn-opts'),
								'linkedin' => __('LinkedIn', 'mfn-opts'),
								'pinterest' => __('Pinterest', 'mfn-opts'),
								'dribbble' => __('Dribbble', 'mfn-opts'),
							),
						),

					),
				),

				'icon_block' => array(
					'type' => 'icon_block',
					'title' => __('Icon Block', 'mfn-opts'),
					'fields' => array(

						array(
							'id' => 'icon',
							'type' => 'icon',
							'title' => __('Icon', 'mfn-opts'),
							'std' => 'icon-lamp'
						),

						array(
							'id' => 'align',
							'type' => 'switch',
							'title' => __('Align', 'mfn-opts'),
							'options' => array(
								'0' => __('Default', 'mfn-opts'),
								'left' => __('Left', 'mfn-opts'),
								'center' => __('Center', 'mfn-opts'),
								'right' => __('Right', 'mfn-opts'),
							),
						),

						array(
							'id' => 'color',
							'type' => 'color',
							'title' => __('Color', 'mfn-opts')
						),

						array(
							'id' => 'size',
							'type' => 'text',
							'title' => __('Icon size', 'mfn-opts'),
							'std' => 25
						),

					),
				),

				'idea' => array(
					'type' => 'idea',
					'title' => __('Idea', 'mfn-opts'),
					'fields' => array(

						array(
							'id' => 'content',
							'type' => 'textarea',
							'title' => __('Content', 'mfn-opts')
						),

					),
				),

				'image' => array(
					'type' => 'image',
					'title' => __('Image', 'mfn-opts'),
					'fields' => array(

						array(
							'id' => 'src',
							'type' => 'upload',
							'title' => __('Image', 'mfn-opts')
						),

						array(
							'id' => 'width',
							'type' => 'text',
							'title' => __('Width in px', 'mfn-opts')
						),
						array(
							'id' => 'height',
							'type' => 'text',
							'title' => __('Height in px', 'mfn-opts')
						),

						array(
							'id' => 'align',
							'type' => 'switch',
							'title' => __('Align', 'mfn-opts'),
							'options' => array(
								'0' => __('Default', 'mfn-opts'),
								'left' => __('Left', 'mfn-opts'),
								'center' => __('Center', 'mfn-opts'),
								'right' => __('Right', 'mfn-opts'),
							)
						),

						array(
							'id' => 'border',
							'type' => 'switch',
							'title' => __('Border', 'mfn-opts'),
							'options' => array(
								'0' => __('No', 'mfn-opts'),
								'1' => __('Yes', 'mfn-opts'),
							),
							'std' => '0'
						),

						array(
							'id' => 'margin_top',
							'type' => 'text',
							'title' => __('Margin Top in px', 'mfn-opts')
						),

						array(
							'id' => 'margin_bottom',
							'type' => 'text',
							'title' => __('Margin Bottom in px', 'mfn-opts')
						),

						array(
							'id' => 'link_image',
							'type' => 'upload',
							'title' => __('Image on click', 'mfn-opts'),
							'desc' => __('Link to image to open after click', 'mfn-opts')
						),

						array(
							'id' => 'link',
							'type' => 'text',
							'title' => __('Link', 'mfn-opts'),
							'desc' => __('URL to open on click instead of image url', 'mfn-opts')
						),

						array(
							'id' => 'target',
							'type' => 'select',
							'title' => __('Target', 'mfn-opts'),
							'desc' => __('Link target', 'mfn-opts'),
							'options' => array(
								'0' => __('Default', 'mfn-opts'),
								'_blank' => __('New tab or window', 'mfn-opts')
							)
						),

						array(
							'id' => 'hover',
							'type' => 'switch',
							'title' => __('Hover effect', 'mfn-opts'),
							'options' => array(
								'' => __('ON', 'mfn-opts'),
								'disable' => __('OFF', 'mfn-opts')
							)
						),

						array(
							'id' => 'alt',
							'type' => 'text',
							'title' => __('Alternate text', 'mfn-opts')
						),

						array(
							'id' => 'caption',
							'type' => 'text',
							'title' => __('Caption', 'mfn-opts'),
							'desc' => __('Short text under image', 'mfn-opts'),
						),

						array(
							'id' => 'greyscale',
							'type' => 'switch',
							'title' => __('Grayscale', 'mfn-opts'),
							'options' => array(
								'' => __('OFF', 'mfn-opts'),
								'1' => __('ON', 'mfn-opts')
							)
						),

						array(
							'id' => 'animate',
							'type' => 'select',
							'title' => __('Animation', 'mfn-opts'),
							'desc' => __('Entrance animation', 'mfn-opts'),
							'options' => array(
								'' => esc_html__('- Not Animated -', 'mfn-opts'),
								'fadeIn' => esc_html__('Fade in', 'mfn-opts'),
								'fadeInUp' => esc_html__('Fade in up', 'mfn-opts'),
								'fadeInDown' => esc_html__('Fade in down ', 'mfn-opts'),
								'fadeInLeft' => esc_html__('Fade in left', 'mfn-opts'),
								'fadeInRight' => esc_html__('Fade in right ', 'mfn-opts'),
								'fadeInUpLarge' => esc_html__('Fade in up large', 'mfn-opts'),
								'fadeInDownLarge' => esc_html__('Fade in down large', 'mfn-opts'),
								'fadeInLeftLarge' => esc_html__('Fade in left large', 'mfn-opts'),
								'fadeInRightLarge' => esc_html__('Fade in right large', 'mfn-opts'),
								'zoomIn' => esc_html__('Zoom in', 'mfn-opts'),
								'zoomInUp' => esc_html__('Zoom in up', 'mfn-opts'),
								'zoomInDown' => esc_html__('Zoom in down', 'mfn-opts'),
								'zoomInLeft' => esc_html__('Zoom in left', 'mfn-opts'),
								'zoomInRight' => esc_html__('Zoom in right', 'mfn-opts'),
								'zoomInUpLarge' => esc_html__('Zoom in up large', 'mfn-opts'),
								'zoomInDownLarge' => esc_html__('Zoom in down large', 'mfn-opts'),
								'zoomInLeftLarge' => esc_html__('Zoom in left large', 'mfn-opts'),
								'bounceIn' => esc_html__('Bounce in', 'mfn-opts'),
								'bounceInUp' => esc_html__('Bounce in up', 'mfn-opts'),
								'bounceInDown' => esc_html__('Bounce in down', 'mfn-opts'),
								'bounceInLeft' => esc_html__('Bounce in left', 'mfn-opts'),
								'bounceInRight' => esc_html__('Bounce in right', 'mfn-opts'),
							),
						),

					),
				),

				'popup' => array(
					'type' => 'popup',
					'title' => __('Popup', 'mfn-opts'),
					'fields' => array(

						array(
							'id' => 'title',
							'type' => 'text',
							'title' => __('Title', 'mfn-opts'),
							'desc' => __('Popup link text', 'mfn-opts')
						),

						array(
							'id' => 'padding',
							'type' => 'text',
							'title' => __('Padding', 'mfn-opts'),
							'desc' => __('Inner padding in px', 'mfn-opts')
						),

						array(
							'id' => 'button',
							'type' => 'switch',
							'title' => __('Button', 'mfn-opts'),
							'desc' => __('Use button instead of text link', 'mfn-opts'),
							'options' => array(
								'0' => __('No', 'mfn-opts'),
								'1' => __('Yes', 'mfn-opts')
							)
						),

						array(
							'id' => 'content',
							'type' => 'textarea',
							'title' => __('Content', 'mfn-opts')
						),

					),
				),

				'progress_icons' => array(
					'type' => 'progress_icons',
					'title' => __('Popup', 'mfn-opts'),
					'fields' => array(

						array(
							'id' => 'icon',
							'type' => 'icon',
							'title' => __('Icon', 'mfn-opts'),
							'std' => 'icon-lamp'
						),

						array(
							'id' => 'image',
							'type' => 'upload',
							'title' => __('Image url', 'mfn-opts'),
							'desc' => __('If you dont want to use icon you can enter image URL', 'mfn-opts')
						),

						array(
							'id' => 'count',
							'type' => 'text',
							'title' => __('Number of icons', 'mfn-opts'),
							'std' => 5
						),

						array(
							'id' => 'active',
							'type' => 'text',
							'title' => __('Number of active icons', 'mfn-opts'),
							'std' => 3
						),

						array(
							'id' => 'background',
							'type' => 'color',
							'title' => __('Background', 'mfn-opts'),
							'alpha' => true
						),

					),
				),

				'tooltip' => array(
					'type' => 'tooltip',
					'title' => __('Tooltip', 'mfn-opts'),
					'fields' => array(

						array(
							'id' => 'hint',
							'type' => 'text',
							'title' => __('Popup text', 'mfn-opts'),
							'std' => 'Text'
						),

						array(
							'id' => 'content',
							'type' => 'textarea',
							'title' => __('Content', 'mfn-opts'),
						),

					),
				),

				'tooltip_image' => array(
					'type' => 'tooltip_image',
					'title' => __('Tooltip_Image', 'mfn-opts'),
					'fields' => array(

						array(
							'id' => 'hint',
							'type' => 'text',
							'title' => __('Popup text', 'mfn-opts'),
							'std' => 'Text'
						),

						array(
							'id' => 'image',
							'type' => 'upload',
							'title' => __('Image URL', 'mfn-opts'),
						),

						array(
							'id' => 'content',
							'type' => 'textarea',
							'title' => __('Content', 'mfn-opts'),
						),

					),
				),

				'lorem' => array(
					'type' => 'lorem',
					'title' => __('Lorem ipsum', 'mfn-opts'),
					'fields' => array(

						array(
							'id' => 'type',
							'type' => 'switch',
							'title' => __('Type of listing', 'mfn-opts'),
							'options' => array(
								'paragraphs' => __('Paragraphs', 'mfn-opts'),
								'lists' => __('Lists', 'mfn-opts')
							),
							'std' => 'paragraphs'
						),

						array(
							'id' => 'rows_amount',
							'type' => 'text',
							'title' => __('Amount', 'mfn-opts'),
							'std' => 3
						),

						array(
							'id' => 'min_words_amount',
							'type' => 'text',
							'title' => __('Minimal words amount', 'mfn-opts'),
							'std' => 10
						),

						array(
							'id' => 'max_words_amount',
							'type' => 'text',
							'title' => __('Maximal words amount', 'mfn-opts'),
							'std' => 15
						),

					),
				),

			);

			return $shortcode_inline;
		}

		/**
		 * SET item entrance animations
		 */

		private function set_animations(){

			$this->animations = array(
				'' => esc_html__('- Not Animated -', 'mfn-opts'),
				'fadeIn' => esc_html__('Fade in', 'mfn-opts'),
				'fadeInUp' => esc_html__('Fade in up', 'mfn-opts'),
				'fadeInDown' => esc_html__('Fade in down ', 'mfn-opts'),
				'fadeInLeft' => esc_html__('Fade in left', 'mfn-opts'),
				'fadeInRight' => esc_html__('Fade in right ', 'mfn-opts'),
				'fadeInUpLarge' => esc_html__('Fade in up large', 'mfn-opts'),
				'fadeInDownLarge' => esc_html__('Fade in down large', 'mfn-opts'),
				'fadeInLeftLarge' => esc_html__('Fade in left large', 'mfn-opts'),
				'fadeInRightLarge' => esc_html__('Fade in right large', 'mfn-opts'),
				'zoomIn' => esc_html__('Zoom in', 'mfn-opts'),
				'zoomInUp' => esc_html__('Zoom in up', 'mfn-opts'),
				'zoomInDown' => esc_html__('Zoom in down', 'mfn-opts'),
				'zoomInLeft' => esc_html__('Zoom in left', 'mfn-opts'),
				'zoomInRight' => esc_html__('Zoom in right', 'mfn-opts'),
				'zoomInUpLarge' => esc_html__('Zoom in up large', 'mfn-opts'),
				'zoomInDownLarge' => esc_html__('Zoom in down large', 'mfn-opts'),
				'zoomInLeftLarge' => esc_html__('Zoom in left large', 'mfn-opts'),
				'bounceIn' => esc_html__('Bounce in', 'mfn-opts'),
				'bounceInUp' => esc_html__('Bounce in up', 'mfn-opts'),
				'bounceInDown' => esc_html__('Bounce in down', 'mfn-opts'),
				'bounceInLeft' => esc_html__('Bounce in left', 'mfn-opts'),
				'bounceInRight' => esc_html__('Bounce in right', 'mfn-opts'),
			);

		}

  }
}
