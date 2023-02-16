<?php
/**
 * Muffin Builder 3.0 | Admin
 *
 * @package Betheme
 * @author Muffin group
 * @link https://muffingroup.com
 */

if( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly
}

if( ! class_exists( 'Mfn_Builder_Admin' ) )
{
  class Mfn_Builder_Admin {

		private $fields;
		private $inline_shortcodes = [];
		private $options = [];
		private $preview = true; // items preview

    private $sizes = [
      '1/6' => '0.1666',
      '1/5' => '0.2',
      '1/4' => '0.25',
      '1/3' => '0.3333',
      '2/5' => '0.4',
      '1/2' => '0.5',
      '3/5' => '0.6',
      '2/3' => '0.6667',
      '3/4' => '0.75',
      '4/5' => '0.8',
      '5/6' => '0.8333',
      '1/1' => '1',
      'divider' => '1'
    ];

    /**
     * Constructor
     */

    public function __construct( $ajax = false ) {

			if( $ajax ){
				return true;
			}

      // first action hooked into the admin scripts actions
      if( empty( $_GET['action'] ) || $_GET['action'] != 'mfn-live-builder' ){
  			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
  		}

			// get builder options
			$this->options = $this->get_options();

			$this->inline_shortcodes = Mfn_Builder_Fields::get_inline_shortcode();

    }

		/**
		 * GET builder options
		 */

		public function get_options(){

			$options= [
				'simple-view' => false,
				'hover-effects' => true,
				'pre-completed' => true,
			];

			if( isset( $_COOKIE['mfn-builder'] ) ){

				$options_cookie = json_decode( stripslashes( $_COOKIE['mfn-builder'] ), true );

				$options = shortcode_atts( $options, $options_cookie );

				// print_r( $options );

			} else {
				setcookie( 'mfn-builder', json_encode( $options ), strtotime( '+365 days' ), '' );
			}

			return $options;

		}

		/**
		 * SET builder fields
		 */

		public function set_fields(){

			$this->fields = new Mfn_Builder_Fields();

		}

    /**
  	 * Enqueue styles and scripts
  	 */

    public function enqueue()
  	{
      wp_enqueue_style( 'mfn-builder', get_theme_file_uri( '/functions/builder/assets/builder.css' ), false, MFN_THEME_VERSION, 'all' );
  		wp_enqueue_script( 'mfn-builder', get_theme_file_uri( '/functions/builder/assets/builder.js' ), array( 'jquery' ), MFN_THEME_VERSION, true );
  	}

		/**
		 * GET item type
		 */

		public function get_item_placeholder_type( $item ){

			$return = false;

			$array = [
				'standard' => [
					'blog_news', 'blog_slider', 'blog_teaser', 'clients', 'clients_slider', 'offer', 'offer_thumb',
					'portfolio_grid', 'portfolio_photo', 'portfolio_slider', 'shop', 'shop_slider',
				 	'slider', 'testimonials', 'testimonials_list'
				],
				'variable' => [
					'blog', 'portfolio'
				],
			];

			foreach( $array as $type => $items ){
				if( in_array( $item, $items ) ){
					$return = $type;
					break;
				}
			}

			return $return;

		}

    /**
  	 * PRINT single FIELD
  	 */

    public static function field( $field, $value, $type = 'meta', $item_id = false )
  	{

      if( empty( $field['type'] ) ){
        return false;
      }

			// class

			$class = false;
			$row_class = false;

			if( ! empty( $field['class'] ) ){
				$class = $field['class'];
			}

			if( ! empty( $field['row_class'] ) ){
				$row_class = $field['row_class'];
			}

			// item id for tabs field only

			$field['uid'] = $item_id;

			// output -----

			if( isset( $field['type'] ) && 'info' == $field['type'] ){

				$field_class = 'MFN_Options_'. $field['type'];
				require_once( get_template_directory() .'/muffin-options/fields/'. $field['type'] .'/field_'. $field['type'] .'.php' );

				if ( class_exists( $field_class ) ) {
					$field_object = new $field_class( $field, $value );
					$field_object->render( $type );
				}

				return true;
			}

			echo '<div class="mfn-fom-row mfn-row '. esc_attr( $row_class ) .'">';

        echo '<div class="row-column row-column-2">';
          echo '<label class="form-label">'. esc_html( $field['title'] ) .'</label>';
        echo '</div>';

        echo '<div class="row-column row-column-10">';
          echo '<div class="form-content '. esc_attr( $class ) .'">';

						$field_class = 'MFN_Options_'. $field['type'];
						require_once( get_template_directory() .'/muffin-options/fields/'. $field['type'] .'/field_'. $field['type'] .'.php' );

						if ( class_exists( $field_class ) ) {
							$field_object = new $field_class( $field, $value );

							// visual builder
							if( $item_id && $item_id == 'vb' ){
								$field_object->render( $type, true );
							}else{
								$field_object->render( $type );
							}
						}

					echo '</div>';
        echo '</div>';

      echo '</div>';

  	}

    /**
  	 * PRINT single SECTION
  	 */

    public function section( $section = false, $uids = false )
  	{

  		// change section visibility

			$class = [];
			$label = [
				'hide' => __('Hide section', 'mfn-opts'),
				'collapse' => __('Collapse section', 'mfn-opts'),
			];

  		if ( ! empty( $section['attr']['hide'] ) ) {
  			$class[] = 'hide';
  			$label['hide'] = __('Show section', 'mfn-opts');
  		}

  		if ( ! empty( $section['attr']['collapse'] ) ) {
  			$class[] = 'collapse';
				$label['collapse'] = __('Expand section', 'mfn-opts');
			}

			if( empty( $section['wraps'] ) && empty( $section['items'] ) ){
				// FIX | Muffin Builder 2 compatibility | empty( $section['items'] )
				$class[] = 'empty';
			}

			// section styles

			if( ! empty( $section['attr']['style'] ) ){
				if( strpos( $section['attr']['style'], 'full-' ) !== false ){
					$class[] = 'full-width';
				}
			}

			// class

			$class = implode(' ', $class);

  		// attributes

  		if ( ! empty( $section['attr']['title'] ) ) {
  			$title = $section['attr']['title'];
  		} else {
  			$title = '';
  		}

  		if ( ! empty( $section['attr']['section_id'] ) ) {
  			$hash = '#'. $section['attr']['section_id'];
  		} else {
  			$hash = '';
  		}

  		// section ID

  		if( $section ){

  			// section exists

  			if( ! empty( $section['uid'] ) ){
  				// has unique ID
  				$id = $section['uid'];
  			} else {
  				// without unique ID
  				$id = Mfn_Builder_Helper::unique_ID( $uids );
  			}

  			$uids[] = $id;

  		} else {

  			// default empty section

  			$id = false;

  		}

  		// form fields names - only for existing sections, NOT for new sections

			$name = 'name="mfn-section-id[]"';

			if( ! $section ){
				$name = 'data-'. $name;
			}

  		// output -----

			echo '<div class="mfn-section mfn-element '. esc_attr( $class ) .'" data-type="section" data-title="'. esc_html__('Section', 'mfn-opts') .'">';

				echo '<input type="hidden" class="mfn-section-id mfn-element-data" '. $name .' value="'. esc_attr( $id ) .'" />';

				// section | add new before

        echo '<a href="#" class="btn-section-add mfn-icon-add-light mfn-section-add siblings prev" data-position="before">'. esc_html__('Add section', 'mfn-opts') .'</a>';

				// section | header

        echo '<div class="mfn-header mfn-header-green header-large">';

          echo '<div class="options-group">';

            echo '<a class="mfn-option-btn mfn-option-text mfn-option-green btn-large mfn-wrap-add" title="'. esc_html__('Add wrap', 'mfn-opts') .'" href="#"><span class="mfn-icon mfn-icon-add"></span><span class="text">'. esc_html__('Wrap', 'mfn-opts') .'</span></a>';
            echo '<a class="mfn-option-btn mfn-option-text mfn-option-green btn-large mfn-divider-add" title="'. esc_html__('Add divider', 'mfn-opts') .'" href="#"><span class="mfn-icon mfn-icon-add"></span><span class="text">'. esc_html__('Divider', 'mfn-opts') .'</span></a>';

					  echo '<div class="header-label">';
	            echo '<span class="header-label-title">'. esc_html( $title ) .'</span>';
	            echo '<span class="header-label-hashtag">'. esc_html( $hash ) .'</span>';
            echo '</div>';

          echo '</div>';

          echo '<div class="options-group">';

            echo '<div class="mfn-option-dropdown dropdown-large">';

							echo '<a class="mfn-option-btn mfn-option-green  btn-large" title="'. esc_html__('Info', 'mfn-opts') .'" href="#"><span class="mfn-icon mfn-icon-information"></span></a>';

							echo '<div class="dropdown-wrapper mfn-section-info">';

								$hide = [
									'style' => 'hide',
									'custom' => 'hide',
								];

								$attr = [
									'bg_image' => $section['attr']['bg_image'],
									'bg_color' => $section['attr']['bg_color'],
									'bg_position' => ! empty( $section['attr']['bg_position'] ) ? $section['attr']['bg_position'] : ';left top',
									'bg_size' => ! empty( $section['attr']['bg_size'] ) ? $section['attr']['bg_size'] : 'auto',
									'padding_top' => ! empty( $section['attr']['padding_top'] ) ? $section['attr']['padding_top'] : 0,
									'padding_bottom' => ! empty( $section['attr']['padding_bottom'] ) ? $section['attr']['padding_bottom'] : 0,
									'padding_side' => ! empty( $section['attr']['padding_horizontal'] ) ? $section['attr']['padding_horizontal'] : '0px',
									'style' => trim( $section['attr']['style'] ),
									'custom_class' => $section['attr']['class'],
									'custom_id' => $section['attr']['section_id'],
								];

								if( 'no-repeat;center top;fixed;;still' == $attr['bg_position'] ){
				          $attr['bg_position'] = 'fixed';
				          $attr['bg_size'] = 'auto';
				        } else if( 'no-repeat;center;fixed;cover;still' == $attr['bg_position'] ){
				          $attr['bg_position'] = 'fixed';
				          $attr['bg_size'] = 'cover';
				        } else if( 'no-repeat;center top;fixed;cover' == $attr['bg_position'] ){
				          $attr['bg_position'] = 'parallax';
				          $attr['bg_size'] = 'auto';
				        } else {
				          $attr['bg_position'] = explode(';', $attr['bg_position']);
				          $attr['bg_position'] = $attr['bg_position'][1];
				        }

								if( 'cover-ultrawide' == $attr['bg_size'] ){
				          $attr['bg_size'] = 'cover+';
				        }

								if( $attr['style'] ){
									$attr['style'] = explode(' ', $attr['style']);
									$hide['style'] = false;
								}

								if( $attr['custom_class'] || $attr['custom_id'] ){
									$hide['custom'] = false;
								}

								echo '<div class="dropdown-group dropdown-group-background">';

									echo '<h6>Background</h6>';

									echo '<div class="background-image mfn-info-bg-color-preview">';
										echo '<img class="mfn-info-bg-image" src="'. esc_url( $attr['bg_image'] ) .'" alt="" />';
									echo '</div>';

									echo '<div class="inner-grid background">';

										echo '<div class="column">';
											echo '<p><span class="label">Color</span></p>';
											echo '<p><span class="mfn-icon mfn-color-preview mfn-info-bg-color-preview" style="background-color:'. esc_attr( $attr['bg_color'] ) .'"></span><span class="mfn-info-bg-color">'. esc_html( $attr['bg_color'] ) .'</span></p>';
										echo '</div>';

										echo '<div class="column">';
											echo '<p><span class="label">Position</span></p>';
											echo '<p class="mfn-info-bg-position">'. esc_html( $attr['bg_position'] ) .'</p>';
										echo '</div>';

										echo '<div class="column">';
											echo '<p><span class="label">Size</span></p>';
											echo '<p class="mfn-info-bg-size">'. esc_html( $attr['bg_size'] ) .'</p>';
										echo '</div>';

									echo '</div>';

								echo '</div>';

								echo '<div class="dropdown-group dropdown-group-padding">';

									echo '<h6>Padding</h6>';

									echo '<div class="inner-grid padding">';

										echo '<div class="column">';
											echo '<p><span class="mfn-icon mfn-icon-padding-up"></span> <span class="mfn-info-padding-top">'. esc_html( $attr['padding_top'] ) .'</span>px</p>';
										echo '</div>';

										echo '<div class="column">';
											echo '<p><span class="mfn-icon mfn-icon-padding-down"></span> <span class="mfn-info-padding-bottom">'. esc_html( $attr['padding_bottom'] ) .'</span>px</p>';
										echo '</div>';

										echo '<div class="column">';
											echo '<p><span class="mfn-icon mfn-icon-padding-horizontal"></span> <span class="mfn-info-padding-side">'. esc_html( $attr['padding_side'] ) .'</span></p>';
										echo '</div>';

									echo '</div>';

								echo '</div>';

								echo '<div class="dropdown-group dropdown-group-style '. esc_attr( $hide['style'] ).'">';

									echo '<h6>Style</h6>';

									echo '<ul class="mfn-info-style">';

										if( is_array( $attr['style'] ) ){
											foreach( $attr['style'] as $style ){
												echo '<li>'. esc_html( mfna_section_style( $style ) ) .'</li>';
											}
										}

									echo '</ul>';

								echo '</div>';

								echo '<div class="dropdown-group dropdown-group-custom '. esc_attr( $hide['custom'] ).'">';

									echo '<h6>Custom</h6>';

									echo '<p><span class="label">Class:</span> <span class="mfn-info-custom-class">'. esc_html( $attr['custom_class'] ) .'</span></p>';
									echo '<p><span class="label">ID:</span> <span class="mfn-info-custom-id">'. esc_html( $attr['custom_id'] ) .'</span></p>';

								echo '</div>';

              echo '</div>';

            echo '</div>';

            echo '<a class="mfn-option-btn mfn-option-green btn-large mfn-element-edit" title="'. esc_html__('Edit', 'mfn-opts') .'" href="#"><span class="mfn-icon mfn-icon-edit"></span></a>';
            echo '<a class="mfn-option-btn mfn-option-green btn-large mfn-section-clone" title="'. esc_html__('Clone', 'mfn-opts') .'" href="#"><span class="mfn-icon mfn-icon-clone"></span></a>';
            echo '<a class="mfn-option-btn mfn-option-green btn-large mfn-element-delete" title="'. esc_html__('Delete', 'mfn-opts') .'" href="#"><span class="mfn-icon mfn-icon-delete"></span></a>';

						echo '<div class="mfn-option-dropdown">';

              echo '<a class="mfn-option-btn mfn-option-green btn-large" title="'. esc_html__('More', 'mfn-opts') .'" href="#"><span class="mfn-icon mfn-icon-more"></span></a>';

						  echo '<div class="dropdown-wrapper">';

                echo '<h6>'. esc_html__('Actions', 'mfn-opts') .'</h6>';
                echo '<a class="mfn-dropdown-item mfn-section-hide" href="#" data-show="'. esc_html('Show section', 'mfn-opts') .'" data-hide="'. esc_html('Hide section', 'mfn-opts') .'"><span class="mfn-icon mfn-icon-hide"></span><span class="mfn-icon mfn-icon-show"></span><span class="label">'. esc_html( $label['hide'] ) .'</span></a>';
                echo '<a class="mfn-dropdown-item mfn-section-collapse" href="#" data-show="'. esc_html('Expand section', 'mfn-opts') .'" data-hide="'. esc_html('Collapse section', 'mfn-opts') .'"><span class="mfn-icon mfn-icon-arrow-up"></span><span class="mfn-icon mfn-icon-arrow-down"></span><span class="label">'. esc_html( $label['collapse'] ) .'</span></a>';
                echo '<a class="mfn-dropdown-item mfn-section-move-up" href="#"><span class="mfn-icon mfn-icon-move-up"></span> '. esc_html__('Move up', 'mfn-opts') .'</a>';
                echo '<a class="mfn-dropdown-item mfn-section-move-down" href="#"><span class="mfn-icon mfn-icon-move-down"></span> '. esc_html__('Move down', 'mfn-opts') .'</a>';

							  echo '<div class="mfn-dropdown-divider"></div>';

                echo '<h6>'. esc_html__('Copy / Paste', 'mfn-opts') .'</h6>';
                echo '<a class="mfn-dropdown-item mfn-section-copy" href="#"><span class="mfn-icon mfn-icon-export"></span><span class="label">'. esc_html__('Copy section', 'mfn-opts') .'</span></a>';
                echo '<a class="mfn-dropdown-item mfn-section-paste before" href="#"><span class="mfn-icon mfn-icon-import-before"></span><span class="label">'. esc_html__('Paste before', 'mfn-opts') .'</span></a>';
                echo '<a class="mfn-dropdown-item mfn-section-paste after" href="#"><span class="mfn-icon mfn-icon-import-after"></span><span class="label">'. esc_html__('Paste after', 'mfn-opts') .'</span></a>';

							echo '</div>';

            echo '</div>';

          echo '</div>';

        echo '</div>';

				// section | content

        echo '<div class="section-content">';

					// section | sortable

					echo '<div class="mfn-sortable mfn-sortable-section clearfix">';

						// section | new

						echo '<div class="mfn-element mfn-section-new">';

	            echo '<h5>'. esc_html__('Select a wrap layout', 'mfn-opts') .'</h5>';

	            echo '<div class="wrap-layouts">';
	              echo '<div class="wrap-layout wrap-11" data-tooltip="1/1"></div>';
	              echo '<div class="wrap-layout wrap-12" data-tooltip="1/2 | 1/2"><span></span></div>';
	              echo '<div class="wrap-layout wrap-13" data-tooltip="1/3 | 1/3 | 1/3"><span></span><span></span></div>';
	              echo '<div class="wrap-layout wrap-14" data-tooltip="1/4 | 1/4 | 1/4 | 1/4"><span></span><span></span><span></span></div>';
	              echo '<div class="wrap-layout wrap-13-23" data-tooltip="1/3 | 2/3"><span></span></div>';
	              echo '<div class="wrap-layout wrap-23-13" data-tooltip="2/3 | 1/3"><span></span></div>';
	              echo '<div class="wrap-layout wrap-14-12-14" data-tooltip="1/4 | 1/2 | 1/4"><span></span><span></span></div>';
	            echo '</div>';

	            echo '<p>'. esc_html__('or choose from', 'mfn-opts') .'</p>';

	            echo '<a class="mfn-btn mfn-btn-green btn-icon-left mfn-section-pre-built" href="#"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add-light"></span>'. esc_html__('Pre-built sections', 'mfn-opts') .'</span></a>';
	            echo '<a class="mfn-btn mfn-btn-green btn-icon-left mfn-template" href="#"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add-light"></span>'. esc_html__('Templates', 'mfn-opts') .'</span></a>';

						echo '</div>';

						// section | existing content

						if ( $section ){

							// FIX | Muffin Builder 2 compatibility
							// there were no wraps inside section in Muffin Builder 2

							if ( ! isset( $section['wraps'] ) && ! empty( $section['items'] ) ) {
								$fix_wrap = array(
									'size' => '1/1',
									'items' => $section['items'],
								);
								$section['wraps'] = array( $fix_wrap );
							}

							// end FIX

							if ( isset( $section['wraps'] ) && is_array( $section['wraps'] ) ) {
								foreach ( $section['wraps'] as $wrap ) {
									$uids = $this->wrap( $wrap, $id, $uids );
								}
							}

						}

					echo '</div>';

        echo '</div>';

				// section | meta data

				echo '<div class="mfn-element-meta">';

					// section | meta fields

					$section_fields = $this->fields->get_section();

					foreach ( $section_fields as $field ) {

						if( empty( $field['type'] ) ){

							// row header

							Mfn_Post_Type::row_header( $field['title'] );

						} else {

							// field

							// values for existing sections

							if ( $section && isset( $section['attr'][ $field['id'] ] ) ) {
								$value = $section['attr'][ $field['id'] ];
							} else {
								$value = false;
							}

							// default values

							if ( ! isset( $field['std'] ) ) {
								$field['std'] = false;
							}

							if ( ( ! $value ) && ( '0' !== $value ) ) {
								$value = stripslashes( htmlspecialchars( $field['std'], ENT_QUOTES ) );
							}

							// field ID

							$field['id'] = 'mfn-sections['. $field['id'] .']';

							// field ID except accordion, faq & tabs

							if ( 'tabs' != $field['type'] ) {
								$field['id'] .= '[]';
							}

							// PRINT single FIELD

							if ( $section ) {
								$existing = 'existing';
							} else {
								$existing = 'new';
							}

							self::field( $field, $value, $existing );

						}

					}

				echo '</div>';

				// section | add new after

        echo '<a href="#" class="btn-section-add mfn-icon-add-light mfn-section-add siblings next" data-position="after">Add section</a>';

			echo '</div>';

			return $uids;
  	}

    /**
  	 * PRINT single WRAP
  	 */

  	private function wrap( $wrap = false, $parent_id = false, $uids = false )
  	{
			// size

			$size = '1/1';

			if( $wrap ){
				$size = $wrap['size'];
			}

  		// wrap ID

  		if( $wrap ){

  			// wrap exists

  			if( ! empty( $wrap['uid'] ) ){
  				// has unique ID
  				$id = $wrap['uid'];
  			} else {
  				// without unique ID
  				$id = Mfn_Builder_Helper::unique_ID( $uids );
  			}

  			$uids[] = $id;

  		} else {

  			// default empty wrap

  			$id = false;

  		}

  		// attributes

  		$class = [];

			if( empty( $wrap['items'] ) ){
				$class[] = 'empty';
			}

  		if ( 'divider' == $size ) {
  			$class[] = 'divider';
  		}

			$class = implode(' ', $class);

			// form fields names - only for existing wraps, NOT for new wrap

			$name = [
				'id' => 'name="mfn-wrap-id[]"',
				'parent' => 'name="mfn-wrap-parent[]"',
				'size' => 'name="mfn-wrap-size[]"',
			];

			if( ! $wrap ){
				foreach( $name as $nk => $nv ){
					$name[$nk] = 'data-'. $nv;
				}
			}

  		// output -----

			echo '<div class="mfn-wrap mfn-element '. esc_attr( $class ) .'" data-size="'. esc_attr( $this->sizes[ $size ] ) .'" data-type="wrap" data-title="'. esc_html__('Wrap', 'mfn-opts') .'" data-title-divider="'. esc_html__('Divider', 'mfn-opts') .'">';

				echo '<input type="hidden" class="mfn-wrap-id mfn-element-data" '. $name['id'] .' value="'. esc_attr( $id ) .'" />';
				echo '<input type="hidden" class="mfn-wrap-parent mfn-element-data" '. $name['parent'] .' value="'. esc_attr( $parent_id ) .'" />';
				echo '<input type="hidden" class="mfn-wrap-size mfn-element-size mfn-element-data" '. $name['size'] .' value="'. esc_attr( $size ) .'" />';

				// wrap | header

				echo '<div class="wrap-header mfn-header mfn-header-grey">';
					echo '<a class="mfn-option-btn mfn-option-grey mfn-size-decrease" title="'. esc_html__('Decrease', 'mfn-opts') .'" href="#"><span class="mfn-icon mfn-icon-dec"></span></a>';
					echo '<a class="mfn-option-btn mfn-option-grey mfn-size-increase" title="'. esc_html__('Increase', 'mfn-opts') .'" href="#"><span class="mfn-icon mfn-icon-inc"></span></a>';
					echo '<a class="mfn-option-btn mfn-option-text mfn-option-grey mfn-size" title="'. esc_html__('Size', 'mfn-opts') .'"><span class="text mfn-element-size-label">'. esc_attr( $size ) .'</span></a>';
					echo '<a class="mfn-option-btn mfn-option-text btn-icon-left mfn-option-grey mfn-item-add" title="'. esc_html__('Add item', 'mfn-opts') .'" href="#"><span class="mfn-icon mfn-icon-add"></span><span class="text">'. esc_html__('Item', 'mfn-opts') .'</span></a>';
					echo '<a class="mfn-option-btn mfn-option-grey mfn-element-edit" title="'. esc_html__('Edit', 'mfn-opts') .'" href="#"><span class="mfn-icon mfn-icon-edit"></span></a>';
					echo '<a class="mfn-option-btn mfn-option-grey mfn-wrap-clone" title="'. esc_html__('Clone', 'mfn-opts') .'" href="#"><span class="mfn-icon mfn-icon-clone"></span></a>';
					echo '<a class="mfn-option-btn mfn-option-grey mfn-element-delete" title="'. esc_html__('Delete', 'mfn-opts') .'" href="#"><span class="mfn-icon mfn-icon-delete"></span></a>';
				echo '</div>';

				// wrap | content

				echo '<div class="wrap-content clearfix">';

					// wrap | sortable

					echo '<div class="mfn-sortable mfn-sortable-wrap clearfix">';

						// wrap | existing content

						if ( isset( $wrap['items'] ) && is_array( $wrap['items'] ) ) {
  						foreach ( $wrap['items'] as $item ) {
  							$uids = $this->item( $item['type'], $item, $id, $uids );
  						}
  					}

					echo '</div>';

					echo '<div class="mfn-wrap-new">';
						echo '<a href="#" class="mfn-item-add mfn-btn btn-icon-left btn-small mfn-btn-blank2"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add"></span>'. esc_html__('Add item', 'mfn-opts') .'</span></a>';
					echo '</div>';

				echo '</div>';

				// wrap | meta

				echo '<div class="mfn-element-meta">';

					// wrap | meta fields

					$wrap_fields = $this->fields->get_wrap();

					foreach ( $wrap_fields as $field ) {

						if( empty( $field['type'] ) ){

							// row header

							Mfn_Post_Type::row_header( $field['title'] );

						} else {

							// field

							// values for existing wraps

							if ( $wrap && isset( $wrap['attr'][ $field['id'] ] ) ) {
								$value = $wrap['attr'][ $field['id'] ];
							} else {
								$value = false;
							}

							// default values

							if ( ! isset( $field['std'] ) ) {
								$field['std'] = false;
							}

							if ( ( ! $value ) && ( '0' !== $value ) ) {
								$value = stripslashes( htmlspecialchars( $field['std'], ENT_QUOTES ) );
							}

							// field ID

							$field['id'] = 'mfn-wraps['. $field['id'] .']';

							// field ID except accordion, faq & tabs

							if ( 'tabs' != $field['type'] ) {
								$field['id'] .= '[]';
							}

							// PRINT single FIELD

							if ($wrap) {
								$existing = 'existing';
							} else {
								$existing = 'new';
							}

							self::field( $field, $value, $existing );

						}

					}

				echo '</div>';

			echo '</div>';

  		return $uids;
  	}

    /**
  	 * PRINT single ITEM
  	 */

  	private function item( $item_type, $item = false, $parent_id = false, $uids = false )
  	{

  		$item_fields = $this->fields->get_item_fields( $item_type );

			// size

			if( $item ){
				$item_fields['size'] = $item['size'];
			}

  		// item ID

  		if( $item ){

  			// item exists

  			if( ! empty( $item['uid'] ) ){

  				// has unique ID
  				$id = $item['uid'];

  			} else {

  				// without unique ID
  				$id = Mfn_Builder_Helper::unique_ID( $uids );

  			}

  			$uids[] = $id;

  		} else {

  			// default empty item

  			$id = false;

  		}

			// form fields names - only for existing wraps, NOT for new wrap

			$name = [
				'type' => 'name="mfn-item-type[]"',
				'id' => 'name="mfn-item-id[]"',
				'parent' => 'name="mfn-item-parent[]"',
				'size' => 'name="mfn-item-size[]"',
			];

			if( ! $item ){
				foreach( $name as $nk => $nv ){
					$name[$nk] = 'data-'. $nv;
				}
			}

			// label

			$label = false;

			if( ! empty( $item['fields']['title'] ) ){
				$label = $item['fields']['title'];
			}

  		// output -----

			echo '<div class="mfn-item mfn-element mfn-item-'. esc_attr( $item_fields['type'] ) .' mfn-cat-'. esc_attr( $item_fields['cat'] ) .' mfn-card mfn-card-small mfn-shadow-1" data-size="'. esc_attr( $this->sizes[$item_fields['size']] ) .'" data-type="'. esc_attr( $item_fields['type'] ) .'" data-title="'. esc_attr( $item_fields['title'] ) .'">';

				echo '<input type="hidden" class="mfn-item-type mfn-element-data" '. $name['type'] .' value="'. esc_attr( $item_fields['type'] ) .'">';
				echo '<input type="hidden" class="mfn-item-id mfn-element-data" '. $name['id'] .' value="'. esc_attr( $id ) .'" />';
				echo '<input type="hidden" class="mfn-item-parent mfn-element-data" '. $name['parent'] .' value="'. esc_attr( $parent_id ) .'" />';
				echo '<input type="hidden" class="mfn-item-size mfn-element-size mfn-element-data" '. $name['size'] .' value="'. esc_attr( $item_fields['size'] ) .'">';

				echo '<div class="item-header mfn-header mfn-header-blue">';
					echo '<a class="mfn-option-btn mfn-option-blue mfn-size-decrease" title="Decrease" href="#"><span class="mfn-icon mfn-icon-dec"></span></a>';
					echo '<a class="mfn-option-btn mfn-option-blue mfn-size-increase" title="Increase" href="#"><span class="mfn-icon mfn-icon-inc"></span></a>';
					echo '<a class="mfn-option-btn mfn-option-text mfn-option-blue mfn-size" title="Size" href="#"><span class="text mfn-element-size-label">'. esc_attr( $item_fields['size'] ) .'</span></a>';
					echo '<a class="mfn-option-btn mfn-option-blue mfn-element-edit" title="Edit" href="#"><span class="mfn-icon mfn-icon-edit"></span></a>';
					echo '<a class="mfn-option-btn mfn-option-blue mfn-item-clone" title="Clone" href="#"><span class="mfn-icon mfn-icon-clone"></span></a>';
					echo '<a class="mfn-option-btn mfn-option-blue mfn-element-delete" title="Delete" href="#"><span class="mfn-icon mfn-icon-delete"></span></a>';
				echo '</div>';

				echo '<div class="card-header">';
					echo '<div class="card-title-group">';
						echo '<span class="card-icon"></span>';
						echo '<div class="card-desc">';
							echo '<h5 class="card-title">'. esc_html( $item_fields['title'] ) .'</h5>';
							echo '<p class="card-subtitle mfn-item-label">'. esc_html( $label ) .'</p>';
						echo '</div>';
					echo '</div>';
				echo '</div>';

				// item preview

				if( $this->preview ){

					$preview = [
						'image' => '',
						'title' => '',
						'subtitle' => '',
						'content' => '',
						'style' => '',
						'number' => '',
						'category' => '',
						'category-all' => '',
						'icon' => '',
						'tabs' => '',
						'images' => '',
						'align' => '',
					];

					$preview_empty = [];
					$preview_tabs_primary = 'title';

					foreach ( $item_fields['fields'] as $field ) {
						if ( isset( $field['preview'] ) ){

							$prev_key = $field['preview'];
							$prev_id = $field['id'];

							// existing item or default value

							if( $item && isset( $item['fields'][$prev_id] ) ){

								$preview[$prev_key] = $item['fields'][$prev_id];

							} elseif( ! empty( $field['std'] ) ) {

								$preview[$prev_key] = $field['std'];

								if ( empty( $this->options['pre-completed'] ) ){
									if ( in_array( $field['type'], ['tabs', 'text', 'textarea', 'upload'] ) ){
										$preview[$prev_key] = '';
									}
								}

							}

							// tabs

							if( 'tabs' == $field['preview'] ){
								if( ! empty( $field['primary'] ) ){
									$preview_tabs_primary = $field['primary'];
								}
							}

							// category

							if( 'category' == $field['preview'] ){

								if( $preview['category'] ){

									$cat_obj = get_category_by_slug( $preview['category'] );

									if( is_object( $cat_obj ) ){
										$preview['category'] = $cat_obj->name;
									} else {
										$preview['category'] = 'All';
									}

								} else {
									$preview['category'] = 'All';
								}

							}

						}
					}

					// multiple categories

					if ( $preview['category-all'] ){
						$preview['category'] = $preview['category-all'];
					}


					// icon

					if ( in_array( $item_type, ['counter','icon_box','list'] ) && $preview['image'] ){
						// image replaces icon in some items
						$preview['icon'] = '';
					}

					// SVG placeholder

					if ( in_array( $item_type, ['map','map_basic'] ) ){
						$preview['image'] = get_theme_file_uri( '/muffin-options/svg/placeholders/map.svg' );
					}

					if ( in_array( $item_type, ['code','content','fancy_divider','sidebar_widget','slider_plugin','video'] ) ){
						$preview['image'] = get_theme_file_uri( '/muffin-options/svg/placeholders/'. $item_type .'.svg' );
					}

					// empty

					foreach( $preview as $prev_key => $prev_val ){
						if( $prev_val ){
							$preview_empty[ $prev_key ] = '';
						} else {
							$preview_empty[ $prev_key ] = 'empty';
						}
					}

					// content limit

					if ( $preview['content'] ){

						$excerpt = $preview['content'];

						if ( in_array( $item_type, ['column', 'visual'] ) ){

							// remove unwanted HTML tags
							$excerpt = wp_kses( $excerpt, Mfn_Builder_Helper::allowed_html() );

							// wrap shortcodes into span to highlight
							$excerpt = preg_replace( '/(\[(.*?)?\[\/)((.*?)?\])|(\[(.*?)?\])/', '<span class="item-preview-shortcode">$0</span>', $excerpt);

							// autoclose tags
							$excerpt = force_balance_tags( $excerpt );

						} else {

							$excerpt = strip_shortcodes( strip_tags( $excerpt ) );

							$excerpt = preg_split( '/\b/', $excerpt, 16 * 2 + 1 );

							array_pop( $excerpt );
							$excerpt = implode( $excerpt );

							if( strlen( $excerpt ) < strlen( $preview['content'] ) ){
								$excerpt = $excerpt .'...';
							}

						}

						$preview['content'] = $excerpt;

					}

					echo '<div class="card-content item-preview align-'. esc_attr( $preview['align'] ) .'">';

						echo '<div class="preview-group image '. esc_attr( $preview_empty['image'] ) .'">';
							echo '<img class="item-preview-image" src="'. esc_url( $preview['image'] ) .'" />';
						echo '</div>';

						echo '<div class="preview-group content">';

							echo '<p class="item-preview-title '. esc_attr( $preview_empty['title'] ) .'">'. esc_html( $preview['title'] ) .'</p>';
							echo '<p class="item-preview-subtitle '. esc_attr( $preview_empty['subtitle'] ) .'">'. esc_html( $preview['subtitle'] ) .'</p>';
							echo '<div class="item-preview-content '. esc_attr( $preview_empty['content'] ) .'">'. $preview['content'] .'</div>';

							echo '<p class="item-preview-placeholder-parent">';

								$placeholder_type = $this->get_item_placeholder_type( $item_type );

								if( 'standard' == $placeholder_type ){

									$placeholder = get_theme_file_uri( '/muffin-options/svg/placeholders/'. $item_type .'.svg' );
									echo '<img class="item-preview-placeholder" src="'. esc_url( $placeholder ) .'" />';

								} elseif ( 'variable' == $placeholder_type ) {

									if( $item ){
										$item_style = str_replace( array( ',', ' ' ), '-', $item['fields']['style'] );
									} else {
										$item_style = 'grid';
									}

									$placeholder_dir = get_theme_file_uri( '/muffin-options/svg/select/'. $item_type .'/' );
									$placeholder = $placeholder_dir . $item_style .'.svg';

									echo '<img class="item-preview-placeholder" src="'. esc_url( $placeholder ) .'" data-dir="'. esc_url( $placeholder_dir ) .'"/>';

								}

								echo '<span class="item-preview-number '. esc_attr( $preview_empty['number'] ) .'">'. esc_html( $preview['number'] ) .'</span>';

							echo '</p>';

							echo '<p class="item-preview-icon '. esc_attr( $preview_empty['icon'] ) .'"><i class="'. esc_attr( $preview['icon'] ) .'"></i></p>';
							echo '<p class="item-preview-category-parent '. esc_attr( $preview_empty['category'] ) .'"><span class="label">Category:</span><span class="item-preview-category">'. esc_html( $preview['category'] ) .'</span></p>';

							echo '<ul class="item-preview-tabs '. esc_attr( $preview_empty['tabs'] ) .'">';
								if ( $preview['tabs'] ){
									foreach ( $preview['tabs'] as $tab ) {
										echo '<li>'. $tab[$preview_tabs_primary] .'</li>';
									}
								}
							echo '</ul>';

							echo '<ul class="item-preview-images '. esc_attr( $preview_empty['images'] ) .'">';
								if ( $preview['images'] ){
									$preview['images'] = explode( ',', $preview['images'] );
									foreach ( $preview['images'] as $image ){
										echo '<li>'. wp_get_attachment_image( $image, 'thumbnail' ) .'</li>';
									}
								}
							echo '</ul>';

						echo '</div>';

					echo '</div>';

				}

				// item | meta

				echo '<div class="mfn-element-meta">';

					// item | meta fields

					foreach ( $item_fields['fields'] as $field ) {

						if( empty( $field['type'] ) ){

							// row header

							Mfn_Post_Type::row_header( $field['title'] );

						} elseif( 'html' == $field['type'] ) {

							echo $field['html'];

						} else {

							$value = '';

							if ( $item && isset( $item['fields'][ $field['id'] ] ) ) {

								$value = $item['fields'][ $field['id'] ];

							} else {

								if ( isset( $field['std'] ) ){
									$value = $field['std'];
								}

								if ( empty( $this->options['pre-completed'] ) ){
									if ( in_array( $field['type'], ['text', 'textarea', 'upload'] ) ){
										$value = '';
									}
									if ( 'tabs' === $field['type'] ){
										$value = [];
									}
								}

							}

							// field ID

							$field['id'] = 'mfn-items['. $item_fields['type'] .']['. $field['id'] .']';

							// field ID EXCEPT accordion, faq & tabs

							if ( 'tabs' != $field['type'] ) {
								$field['id'] .= '[]';
							}

							// PRINT single FIELD

							if ( $item ) {
								$existing = 'existing';
							} else {
								$existing = 'new';
							}

							self::field( $field, $value, $existing, $id );

						}

					}

				echo '</div>';

			echo '</div>';

  		return $uids;
  	}

    /**
     * PRINT Muffin Builder
     */

    public function show()
    {
      global $post;

      $uids = array();
			$items = $this->fields->get_items(); // default items

      // hide builder if current user does not have a specific capability

      if ( $visibility = mfn_opts_get( 'builder-visibility' ) ) {
        if ( $visibility == 'hide' || ( ! current_user_can( $visibility ) ) ) {
          return false;
        }
      }

			// check if disable items preview

			$theme_disable = mfn_opts_get( 'theme-disable' );

			if( ! empty( $theme_disable['builder-preview'] ) ){
				$this->preview = false;
			}

      // GET items

      $mfn_items = get_post_meta($post->ID, 'mfn-page-items', true);

      // FIX | Muffin Builder 2 compatibility

      if ($mfn_items && ! is_array($mfn_items)) {
        $mfn_items = unserialize(call_user_func('base'.'64_decode', $mfn_items));
      }

      // debug

      // print_r( $mfn_items );
			// exit;

			// builder classes

			$class = [];

			if( ! is_array( $mfn_items ) ){
				$class[] = 'empty';
			}

			if( is_array( $this->options ) ){
				foreach( $this->options as $option_id => $option_val ){
					if( $option_val ){
						$class[] = $option_id;
					}
				}
			}

			$class = implode( ' ', $class )

      ?>

			<input type="hidden" name="mfn-items-save" value="1"/>

      <div id="mfn-builder" class="mfn-ui mfn-builder <?php echo esc_attr( $class ); ?>">

				<div class="mfn-menu">
	        <div class="mfn-menu-inner">

            <?php
							$logo = '<div class="mfnb-logo">Muffin Builder - Powered by Muffin Group</div>';
							$logo = apply_filters('betheme_logo', $logo);

							echo $logo;
						?>

            <nav id="main-menu">
              <ul>
                <li class="mfn-menu-page"><a data-tooltip="<?php esc_html_e('Single page import', 'mfn-opts'); ?>" data-position="left" href="#"><?php esc_html_e('Single page import', 'mfn-opts'); ?></a></li>
                <li class="mfn-menu-sections"><a data-tooltip="<?php esc_html_e('Pre-built sections', 'mfn-opts'); ?>" data-position="left" href="#"><?php esc_html_e('Pre-built sections', 'mfn-opts'); ?></a></li>
                <li class="mfn-menu-revisions"><a data-tooltip="<?php esc_html_e('Revisions', 'mfn-opts'); ?>" data-position="left" href="#"><?php esc_html_e('Revisions', 'mfn-opts'); ?></a></li>
                <li class="mfn-menu-export"><a data-tooltip="<?php esc_html_e('Export / Import', 'mfn-opts'); ?>" data-position="left" href="#"><?php esc_html_e('Export / Import', 'mfn-opts'); ?></a></li>
              </ul>
            </nav>

            <nav id="settings-menu">
              <ul>
                <li class="mfn-menu-preview"><a data-tooltip="<?php esc_html_e('Preview', 'mfn-opts'); ?>" data-position="left" href="<?php echo get_preview_post_link(); ?>"><?php esc_html_e('Preview', 'mfn-opts'); ?></a></li>
                <li class="mfn-menu-settings"><a data-tooltip="<?php esc_html_e('Settings', 'mfn-opts'); ?>" data-position="left" href="#"><?php esc_html_e('Settings', 'mfn-opts'); ?></a></li>
              </ul>
            </nav>

	        </div>
		    </div>

        <div class="mfn-wrapper">

					<div class="mfn-section-start">
            <img alt="" src="<?php echo get_theme_file_uri( 'muffin-options/svg/welcome.svg' ); ?>" width="120">
            <h2><?php esc_html_e('Welcome to ', 'mfn-opts'); echo apply_filters('betheme_label', 'Muffin') ?> Builder <sup>3.0</sup></h2>
            <a class="mfn-btn mfn-btn-green btn-icon-left btn-large mfn-section-add" href="#"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add-light"></span><?php esc_html_e('Start creating', 'mfn-opts'); ?></span></a>
            <?php if( !apply_filters('betheme_disable_support', false) ): ?>
							<p><a class="view-tutorial" target="_blank" href="https://support.muffingroup.com/video-tutorials/an-overview-of-muffin-builder-3/"><?php esc_html_e('View tutorial', 'mfn-opts'); ?></a></p>
						<?php endif; ?>
					</div>

          <div id="mfn-desk" class="clearfix">

            <?php
              // print_r($mfn_items);

              if (is_array($mfn_items)) {
                foreach ($mfn_items as $section) {
                  $uids = $this->section($section, $uids);
                }
              }
            ?>

          </div>

          <div id="mfn-sections" class="mfn-prototype clearfix">
            <?php $this->section(); ?>
          </div>

          <div id="mfn-wraps" class="mfn-prototype clearfix">
            <?php $this->wrap(); ?>
          </div>

          <div id="mfn-items" class="mfn-prototype clearfix">
            <?php
              foreach ( $items as $item ) {
                $this->item( $item['type'] );
                echo "\n";
              }
            ?>
          </div>

        </div>

				<!-- modal: add item -->

				<div class="mfn-modal modal-add-items">
				  <div class="mfn-modalbox mfn-form mfn-shadow-1">

				    <div class="modalbox-header">

				      <div class="options-group">
				        <div class="modalbox-title-group">
				          <span class="modalbox-icon mfn-icon-add-big"></span>
				          <div class="modalbox-desc">
				            <h4 class="modalbox-title"><?php esc_html_e('Add item', 'mfn-opts'); ?></h4>
				          </div>
				        </div>
				      </div>

				      <div class="options-group">
				        <div class="modalbox-search">
				          <div class="form-control">
				            <input class="mfn-form-control mfn-form-input mfn-search" type="text" placeholder="<?php esc_html_e('Search', 'mfn-opts'); ?>">
				          </div>
				        </div>
				      </div>

				      <div class="options-group right">
				        <ul class="modalbox-tabs">
									<li data-filter="*" class="active"><a href="#"><?php esc_html_e('All', 'mfn-opts'); ?></a></li>
									<li data-filter="typography"><a href="#"><?php esc_html_e('Typography', 'mfn-opts'); ?></a></li>
									<li data-filter="boxes"><a href="#"><?php esc_html_e('Boxes', 'mfn-opts'); ?></a></li>
									<li data-filter="blocks"><a href="#"><?php esc_html_e('Blocks', 'mfn-opts'); ?></a></li>
									<li data-filter="elements"><a href="#"><?php esc_html_e('Elements', 'mfn-opts'); ?></a></li>
									<li data-filter="loops"><a href="#"><?php esc_html_e('Loops', 'mfn-opts'); ?></a></li>
									<li data-filter="other"><a href="#"><?php esc_html_e('Other', 'mfn-opts'); ?></a></li>
				        </ul>
				      </div>

				      <div class="options-group">
				        <a class="mfn-option-btn mfn-option-blank btn-large btn-modal-close" href="#"><span class="mfn-icon mfn-icon-close"></span></a>
				      </div>

				    </div>

				    <div class="modalbox-content">
				      <ul class="modalbox-items mfn-items-list clearfix">

								<?php
									foreach ( $items as $item ) {

										echo '<li class="mfn-item-'. esc_attr( $item['type'] ) .' category-'. esc_attr( $item['cat'] ) .'" data-type="'. esc_attr( $item['type'] ) .'">';
											echo '<a href="#">';
												echo '<div class="mfn-icon card-icon"></div>';
												echo '<span class="title">'. esc_html( $item['title'] ) .'</span>';
											echo '</a>';
										echo '</li>';

									}
								?>

				      </ul>
				    </div>

				  </div>
				</div>

				<!-- modal: edit item -->

				<div class="mfn-modal has-footer modal-item-edit">
				  <div class="mfn-modalbox mfn-form mfn-shadow-1">

				    <div class="modalbox-header">

							<div class="options-group">
                <div class="modalbox-title-group">
                  <span class="modalbox-icon mfn-icon-card"></span>
                  <div class="modalbox-desc">
                    <h4 class="modalbox-title">Text column</h4>
                  </div>
                </div>
	            </div>

	            <div class="options-group right">
                <ul class="modalbox-tabs">
                  <li data-card="content" class="active"><a href="#">Content</a></li>
                  <li data-card="settings"><a href="#">Settings</a></li>
                </ul>
	            </div>

							<div class="options-group">
				        <a class="mfn-option-btn mfn-option-blank btn-large btn-modal-close" href="#"><span class="mfn-icon mfn-icon-close"></span></a>
				      </div>

				    </div>

				    <div class="modalbox-content">
							<!-- element meta -->
				    </div>

						<div class="modalbox-footer">
	            <div class="options-group right">
                <a class="mfn-btn mfn-btn-blue btn-modal-close" href="#"><span class="btn-wrapper">Save changes</span></a>
	            </div>
		        </div>

				  </div>
				</div>

				<!-- modal: export import -->

				<div class="mfn-modal has-footer modal-export-import">
			    <div class="mfn-modalbox mfn-form mfn-shadow-1">

		        <div class="modalbox-header">

	            <div class="options-group">
                <div class="modalbox-title-group">
                  <span class="modalbox-icon mfn-icon-export-import"></span>
                  <div class="modalbox-desc">
                    <h4 class="modalbox-title">Export / Import</h4>
                  </div>
                </div>
	            </div>

	            <div class="options-group modalbox-tabber">
                <ul class="modalbox-tabs">
                  <li data-card="export" class="active"><a href="#">Export</a></li>
                  <li data-card="import"><a href="#">Import</a></li>
                  <li data-card="template"><a href="#">Templates</a></li>
									<li data-card="page"><a href="#">Single page import</a></li>
                  <li data-card="seo"><a href="#">Builder → SEO</a></li>
                </ul>
	            </div>

							<div class="options-group">
				        <a class="mfn-option-btn mfn-option-blank btn-large btn-modal-close" href="#"><span class="mfn-icon mfn-icon-close"></span></a>
				      </div>

		        </div>

		        <div class="modalbox-content">

							<div class="modalbox-card modalbox-card-export active">

		            <div class="mfn-form-row mfn-row">
	                <div class="row-column row-column-12">
	                  <div class="form-content form-content-full-width">
	                    <div class="form-group">
	                      <div class="form-control">
	                        <?php echo '<textarea class="mfn-form-control mfn-form-textarea mfn-items-export" placeholder="'. apply_filters('betheme_label', 'Muffin') .' Builder data processing..."></textarea>'; ?>
	                      </div>
	                    </div>
	                  </div>
	                </div>
		            </div>

							</div>

							<div class="modalbox-card modalbox-card-import">

								<div class="mfn-form-row mfn-row">
	                <div class="row-column row-column-12">
	                  <div class="form-content form-content-full-width">
	                    <div class="form-group">
	                      <div class="form-control">
	                        <textarea id="mfn-items-import" class="mfn-form-control mfn-form-textarea" placeholder="Paste import data here"></textarea>
	                      </div>
	                    </div>
	                  </div>
	                </div>
		            </div>

							</div>

							<div class="modalbox-card modalbox-card-page<?php if( ! mfn_is_registered() ){ echo ' unregistered'; } ?>">

								<?php if( ! mfn_is_registered() ): ?>

								<div class="mfn-please-register">

									<img alt="" src="<?php echo get_theme_file_uri( '/muffin-options/svg/others/register-now.svg' ); ?>" width="120">

									<h4>Please register the theme<br >to get access to single page import.</h4>

									<p class="info">This page reload is required after theme registration. Please save your content.</p>

									<a class="mfn-btn mfn-btn-green btn-large" href="admin.php?page=betheme" target="_blank"><span class="btn-wrapper">Register now</span></a>

								</div>

								<?php endif; ?>

								<div class="mfn-form-row mfn-row">
	                <div class="row-column row-column-12">
	                  <div class="form-content form-content-full-width">
	                    <div class="form-group">
												<div class="form-control" style="">

												<img class="icon" alt="" src="<?php echo get_theme_file_uri( '/muffin-options/svg/others/import-page-big.svg' ); ?>">

													<h3>Single page import</h3>
													<p>Paste a <code>link</code> from one of <a target="_blank" href="https://muffingroup.com/betheme/websites/">pre-built websites</a></p>

													<input id="mfn-items-import-page" class="mfn-form-control mfn-form-input" placeholder="https://themes.muffingroup.com/betheme/about/" />

													<p class="hint">Only builder content will be imported. Theme options, sliders and images will not be imported.</p>

												</div>
	                    </div>
	                  </div>
	                </div>
		            </div>

							</div>

							<div class="modalbox-card modalbox-card-template">

								<div class="mfn-form-row mfn-row">
	                <div class="row-column row-column-12">
                    <div class="templates">
                      <h4>Select a template from the list:</h4>
                      <ul class="mfn-items-list mfn-items-import-template">

												<?php

													$args = array(
														'post_type' => 'template',
														'posts_per_page'=> -1,
													);

													$templates = get_posts( $args );

													if ( is_array( $templates ) ) {
														foreach ( $templates as $template ) {
															echo '<li data-id="'. esc_attr($template->ID) .'"><a href="#"><h5>'. esc_html($template->post_title) .'</h5><p>'. esc_html($template->post_modified) .'</p></a></li>';
														}
													}

												?>

												<input type="hidden" id="mfn-items-import-template" val=""/>

                      </ul>
                    </div>
	                </div>
		            </div>

							</div>

							<div class="modalbox-card modalbox-card-seo">

								<div class="mfn-form-row mfn-row">
	                <div class="row-column row-column-12">
	                  <div class="form-content form-content-full-width">
	                    <div class="form-group">
												<div class="form-control" style="">
													<img class="icon" alt="" src="<?php echo get_theme_file_uri( '/muffin-options/svg/others/builder-to-seo.svg' ); ?>">
													<h3>Builder → SEO</h3><p>This option is useful for plugins like Yoast SEO to analyze <?php echo apply_filters('betheme_label', 'Muffin'); ?> Builder content. It will collect content from Muffin Builder and copy it to new Content Block.</p>
													<p>You can hide the content if you set <code>"The content"</code> option to Hide.</p>
	                      </div>
	                    </div>
	                  </div>
	                </div>
		            </div>

							</div>

		        </div>

		        <div class="modalbox-footer">

	            <div class="options-group right">

								<div class="modalbox-card modalbox-card-export active"></div>

								<div class="modalbox-card modalbox-card-import">
									<select id="mfn-import-type" class="mfn-form-control mfn-form-select mfn-import-type">
										<option value="before"><?php esc_html_e('Insert BEFORE current builder content', 'mfn-opts'); ?></option>
										<option value="after"><?php esc_html_e('Insert AFTER current builder content', 'mfn-opts'); ?></option>
										<option value="replace"><?php esc_html_e('REPLACE current builder content', 'mfn-opts'); ?></option>
									</select>
								</div>

								<div class="modalbox-card modalbox-card-page">
									<select id="mfn-import-type-page" class="mfn-form-control mfn-form-select mfn-import-type">
										<option value="before"><?php esc_html_e('Insert BEFORE current builder content', 'mfn-opts'); ?></option>
										<option value="after"><?php esc_html_e('Insert AFTER current builder content', 'mfn-opts'); ?></option>
										<option value="replace"><?php esc_html_e('REPLACE current builder content', 'mfn-opts'); ?></option>
									</select>
								</div>

								<div class="modalbox-card modalbox-card-template">
									<select id="mfn-import-type-template" class="mfn-form-control mfn-form-select mfn-import-type">
										<option value="before"><?php esc_html_e('Insert BEFORE current builder content', 'mfn-opts'); ?></option>
										<option value="after"><?php esc_html_e('Insert AFTER current builder content', 'mfn-opts'); ?></option>
										<option value="replace"><?php esc_html_e('REPLACE current builder content', 'mfn-opts'); ?></option>
									</select>
								</div>

								<div class="modalbox-card modalbox-card-seo"></div>

							</div>

	            <div class="options-group">

								<div class="modalbox-card modalbox-card-export active">
                	<a class="mfn-btn mfn-btn-blue btn-copy-text" href="#"><span class="btn-wrapper">Copy to clipboard</span></a>
								</div>

								<div class="modalbox-card modalbox-card-import">
                	<a class="mfn-btn mfn-btn-blue btn-import" href="#"><span class="btn-wrapper">Import</span></a>
								</div>

								<div class="modalbox-card modalbox-card-page">
                	<a class="mfn-btn mfn-btn-blue btn-page" href="#"><span class="btn-wrapper">Import</span></a>
								</div>

								<div class="modalbox-card modalbox-card-template">
                	<a class="mfn-btn mfn-btn-blue btn-template" href="#"><span class="btn-wrapper">Import</span></a>
								</div>

								<div class="modalbox-card modalbox-card-seo">
                	<a class="mfn-btn mfn-btn-blue btn-seo" href="#"><span class="btn-wrapper">Generate</span></a>
								</div>

	            </div>

		        </div>

			    </div>
				</div>

				<!-- modal: revisions -->

				<div class="mfn-modal has-footer modal-revisions">
			    <div class="mfn-modalbox mfn-form mfn-shadow-1">

		        <div class="modalbox-header">

	            <div class="options-group">
                <div class="modalbox-title-group">
                  <span class="modalbox-icon mfn-icon-export-import"></span>
                  <div class="modalbox-desc">
                    <h4 class="modalbox-title">Revisions</h4>
                  </div>
                </div>
	            </div>

							<div class="options-group">
				        <a class="mfn-option-btn mfn-option-blank btn-large btn-modal-close" href="#"><span class="mfn-icon mfn-icon-close"></span></a>
				      </div>

		        </div>

		        <div class="modalbox-content">
							<div class="mfn-form-row mfn-row">

								<?php
									$revisions = Mfn_Builder_Helper::get_revisions( $post->ID );
								?>

                <div class="row-column row-column-3">

                  <h5>Autosave:</h5>
                  <ul class="mfn-revisions-list" data-type="autosave">
										<?php $this->the_revisions_list( $revisions['autosave'] ); ?>
                  </ul>
									<p class="info">Saved automatically<br>every 5 minutes</p>

                </div>

                <div class="row-column row-column-3">

                  <h5>Update:</h5>
                  <ul class="mfn-revisions-list" data-type="update">
										<?php $this->the_revisions_list( $revisions['update'] ); ?>
                  </ul>
									<p class="info">Saved after<br />every post update</p>

                </div>

                <div class="row-column row-column-3">

                  <h5>Revision:</h5>
                  <ul class="mfn-revisions-list" data-type="revision">
										<?php $this->the_revisions_list( $revisions['revision'] ); ?>
                  </ul>
									<p class="info">Saved using<br />Save revision button</p>

                </div>

                <div class="row-column row-column-3">

                  <h5>Backup:</h5>
                  <ul class="mfn-revisions-list" data-type="backup">
										<?php $this->the_revisions_list( $revisions['backup'] ); ?>
                  </ul>
									<p class="info">Backup created<br />before restore of any revision</p>

                </div>

	            </div>
		        </div>

		        <div class="modalbox-footer">

	            <div class="options-group right"></div>

	            <div class="options-group">
              	<a class="mfn-btn mfn-btn-blue btn-revision" href="#"><span class="btn-wrapper">Save revision</span></a>
	            </div>

		        </div>

			    </div>
				</div>

				<!-- modal: pre-built sections -->

				<div class="mfn-modal modal-sections-library<?php if( ! mfn_is_registered() ){ echo ' unregistered'; } ?>">
			    <div class="mfn-modalbox mfn-form mfn-shadow-1">

						<?php if( ! mfn_is_registered() ): ?>

						<div class="mfn-please-register">

							<img alt="" src="<?php echo get_theme_file_uri( '/muffin-options/svg/others/register-now.svg' ); ?>" width="120">

							<h4>Please register the theme<br >to get access to pre-built websites.</h4>

							<p class="info">This page reload is required after theme registration. Please save your content.</p>

							<a class="mfn-btn mfn-btn-green btn-large" href="admin.php?page=betheme" target="_blank"><span class="btn-wrapper">Register now</span></a>

						</div>

						<?php endif; ?>

		        <div class="modalbox-header">

	            <div class="options-group">
                <div class="modalbox-title-group">
                  <span class="modalbox-icon mfn-icon-predefined-sections"></span>
                  <div class="modalbox-desc">
                    <h4 class="modalbox-title">Pre-built sections</h4>
                  </div>
                </div>
	            </div>

	            <div class="options-group right">
                <ul class="modalbox-tabs">
									<?php

										$categories = Mfn_Pre_Built_Sections::get_categories();

										foreach( $categories as $category_key => $category ){
											echo '<li data-filter="'. esc_attr( $category_key ) .'"><a href="#">'. esc_html( $category ) .'</a></li>';
										}

									?>
                </ul>
	            </div>

	            <div class="options-group">
								<a class="mfn-option-btn mfn-option-blank btn-large btn-modal-close" href="#"><span class="mfn-icon mfn-icon-close"></span></a>
	            </div>

		        </div>

		        <div class="modalbox-content">
	            <ul class="modalbox-sections mfn-sections-list">
								<?php

									$sections = Mfn_Pre_Built_Sections::get_sections();

									foreach( $sections as $section_key => $section ){
										echo '<li class="category-'. esc_attr( $section['category'] ).'" data-id="'. esc_attr( $section_key ).'">';
		                  echo '<div class="photo">';
		                    echo '<img src="'. get_theme_file_uri( '/functions/builder/pre-built/images/'. $section_key .'.png' ) .'" alt="" />';
		                  echo '</div>';
		                  echo '<div class="desc">';
		                    echo '<h6>'. esc_html( $section['title'] ).'</h6>';
		                    echo '<a class="mfn-option-btn mfn-option-text btn-icon-left mfn-option-green mfn-btn-insert" title="Insert" data-tooltip="Insert section" href="#"><span class="mfn-icon mfn-icon-add"></span><span class="text">Insert</span></a>';
		                  echo '</div>';
		                echo '</li>';
									}

								?>
	            </ul>
		        </div>

			    </div>
				</div>

				<!-- modal: delete item -->

				<div class="mfn-modal modal-confirm modal-confirm-element">
					<div class="mfn-modalbox mfn-form mfn-shadow-1">

		        <div class="modalbox-header">

	            <div class="options-group">
                <div class="modalbox-title-group">
                  <span class="modalbox-icon mfn-icon-delete"></span>
                  <div class="modalbox-desc">
                    <h4 class="modalbox-title">Delete element</h4>
                  </div>
                </div>
	            </div>

	            <div class="options-group">
                <a class="mfn-option-btn mfn-option-blank btn-large btn-modal-close" title="Close" href="#"><span class="mfn-icon mfn-icon-close"></span></a>
	            </div>

		        </div>

		        <div class="modalbox-content">

	            <img class="icon" alt="" src="<?php echo get_theme_file_uri( '/muffin-options/svg/warning.svg' ); ?>">
	            <h3>Delete element?</h3>
	            <p>Please confirm. There is no undo.</p>
	            <a class="mfn-btn mfn-btn-red btn-wide btn-modal-confirm" href="#"><span class="btn-wrapper">Delete</span></a>

					 	</div>

			    </div>
		    </div>

				<!-- modal: restore revision -->

				<div class="mfn-modal modal-confirm modal-confirm-revision">
					<div class="mfn-modalbox mfn-form mfn-shadow-1">

		        <div class="modalbox-header">

	            <div class="options-group">
                <div class="modalbox-title-group">
                  <span class="modalbox-icon mfn-icon-undo"></span>
                  <div class="modalbox-desc">
                    <h4 class="modalbox-title">Restore revision</h4>
                  </div>
                </div>
	            </div>

	            <div class="options-group">
                <a class="mfn-option-btn mfn-option-blank btn-large btn-modal-close" title="Close" href="#"><span class="mfn-icon mfn-icon-close"></span></a>
	            </div>

		        </div>

		        <div class="modalbox-content">

	            <img class="icon" alt="" src="<?php echo get_theme_file_uri( '/muffin-options/svg/warning.svg' ); ?>">
	            <h3>Restore revision?</h3>
	            <p>Please confirm. There is no undo.<br />Backup revision will be created.</p>
	            <a class="mfn-btn mfn-btn-blue btn-wide btn-modal-confirm-revision" href="#"><span class="btn-wrapper">Restore</span></a>

					 	</div>

			    </div>
		    </div>

				<!-- modal: add shortcode / edit shortcode -->

				<div class="mfn-modal has-footer modal-small modal-add-shortcode">

					<div class="mfn-modalbox mfn-form mfn-form-verical mfn-shadow-1 mfn-sc-editor">

						<div class="modalbox-header">

							<div class="options-group">
								<div class="modalbox-title-group">
									<span class="modalbox-icon mfn-icon-add-big"></span>
									<div class="modalbox-desc">
										<h4 class="modalbox-title">Shortcode</h4>
									</div>
								</div>
							</div>

							<div class="options-group">
								<a class="mfn-option-btn mfn-option-blank btn-large btn-modal-close" title="Close" href="#">
									<span class="mfn-icon mfn-icon-close"></span>
								</a>
							</div>

						</div>

						<div class="modalbox-content">
							<!-- element meta -->
						</div>

						<div class="modalbox-footer">
							<div class="options-group right">
								<a class="mfn-btn mfn-btn-blue btn-modal-close" href="#"><span class="btn-wrapper">Add Shortcode</span></a>
							</div>
						</div>

					</div>

					<div class="mfn-element-meta mfn-isc-builder">
						<?php
							foreach ( $this->inline_shortcodes as $shortcode ) {
								echo '<div class="mfn-isc-builder-'. esc_attr( $shortcode['type'] ) .'" data-shortcode="'. esc_attr( $shortcode['type'] ) .'">';
									foreach( $shortcode['fields'] as $sc_field ){

										$sc_placeholder = '';

										if( isset( $sc_field['std'] ) ){
										  $sc_placeholder = $sc_field['std'];
										}

										Mfn_Builder_Admin::field( $sc_field, $sc_placeholder, 'new' );

									}
								echo '</div>';
							}
						?>
					</div>

				</div>

				<!-- modal: settings -->

				<div class="mfn-modal modal-settings modal-small">
			    <div class="mfn-modalbox mfn-form mfn-shadow-1">

		        <div class="modalbox-header">

	            <div class="options-group">
                <div class="modalbox-title-group">
                  <span class="modalbox-icon mfn-icon-settings"></span>
                  <div class="modalbox-desc">
                    <h4 class="modalbox-title">Settings</h4>
                  </div>
                </div>
	            </div>

	            <div class="options-group">
                <a class="mfn-option-btn mfn-option-blank btn-large btn-modal-close" href="#"><span class="mfn-icon mfn-icon-close"></span></a>
	            </div>

		        </div>

		        <div class="modalbox-content">

              <div class="mfn-form-row mfn-row">
                <div class="row-column row-column-12">
                  <div class="form-content form-content-full-width">
                    <div class="form-group segmented-options settings">

                      <span class="mfn-icon mfn-icon-simple-view"></span>

                      <div class="setting-label">
                        <h5>Simple view</h5>
                        <p>Simplified version of items</p>
                      </div>

                      <div class="form-control" data-option="simple-view">
                        <ul>
													<li class="active" data-value="0"><a href="#"><span class="text">Off</span></a></li>
                          <li data-value="1"><a href="#"><span class="text">On</span></a></li>
                        </ul>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

              <div class="mfn-form-row mfn-row">
                <div class="row-column row-column-12">
                  <div class="form-content form-content-full-width">
                    <div class="form-group segmented-options settings">

                      <span class="mfn-icon mfn-icon-hover-effects"></span>

                      <div class="setting-label">
                        <h5>Hover effects</h5>
                        <p>Builder item bar shows on hover</p>
                      </div>

                      <div class="form-control" data-option="hover-effects">
                        <ul>
													<li class="active" data-value="0"><a href="#"><span class="text">Off</span></a></li>
                          <li data-value="1"><a href="#"><span class="text">On</span></a></li>
                        </ul>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

              <div class="mfn-form-row mfn-row">
                <div class="row-column row-column-12">
                  <div class="form-content form-content-full-width">
                    <div class="form-group segmented-options settings">

                      <span class="mfn-icon mfn-icon-precompleted-items"></span>

                      <div class="setting-label">
                        <h5>Pre-completed items</h5>
                        <p>Sample content in items</p>
												<a data-tooltip="A page reload is required for this change. Please save your content." title="Info" class="mfn-option-btn info-changed"><span class="mfn-icon mfn-icon-information"></span></a>
                      </div>

                      <div class="form-control" data-option="pre-completed">
                        <ul>
													<li class="active" data-value="0"><a href="#"><span class="text">Off</span></a></li>
                          <li data-value="1"><a href="#"><span class="text">On</span></a></li>
                        </ul>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

              <div class="mfn-form-row mfn-row">
                <div class="row-column row-column-12">
                  <div class="form-content form-content-full-width">
                    <div class="form-group segmented-options settings">

											<span class="mfn-icon mfn-icon-intro-slider"></span>

                      <div class="setting-label">
                        <h5>Introduction guide</h5>
                        <p>See what's new in <?php echo apply_filters('betheme_label', 'Muffin'); ?> Builder 3</p>
                      </div>

                      <div class="form-control">
                        <a href="#" class="introduction-reopen">Reopen</a>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

		        </div>

			    </div>

				</div>

				<?php

					// modal | icon select
					Mfn_Icons::the_modal();

					// introduction
					$this->introduction();

				?>

				<a id="mfn-go-to-top" href="javascript:void(0);" class="mfn-option-btn btn-large"><span class="mfn-icon mfn-icon-move-up"></span></a>

      </div>

      <?php
    }

    /**
  	 * SAVE Muffin Builder
  	 */

  	public function save( $post_id )
  	{

  		// FIX | Visual Composer Frontend

  		if ( isset( $_POST['vc_inline'] ) ) {
  			return false;
  		}

			// debug

			// print_r( $_POST );
			// exit;

  		// variables

  		$mfn_items = array();
  		$mfn_wraps = array();

  		// LOOP sections

  		if ( isset( $_POST['mfn-section-id'] ) && is_array( $_POST['mfn-section-id'] ) ) {

  			foreach ( $_POST['mfn-section-id'] as $sectionID_k => $sectionID ) {

  				$section = array();

  				$section['uid'] = $_POST['mfn-section-id'][$sectionID_k];

  				// $section['attr'] - section attributes

  				if (key_exists('mfn-sections', $_POST) && is_array($_POST['mfn-sections'])) {
  					foreach ($_POST['mfn-sections'] as $section_attr_k => $section_attr) {
  						$section['attr'][$section_attr_k] = stripslashes($section_attr[$sectionID_k]);
  					}
  				}

  				$section['wraps'] = ''; // $section['wraps'] - section wraps will be added in next loop

  				$mfn_items[] = $section;
  			}

  			$section_IDs = $_POST['mfn-section-id'];
  			$section_IDs_key = array_flip($section_IDs);
  		}

  		// LOOP wraps

  		if ( key_exists( 'mfn-wrap-id', $_POST ) && is_array( $_POST['mfn-wrap-id'] ) ) {

  			foreach ( $_POST['mfn-wrap-id'] as $wrapID_k => $wrapID ) {

  				$wrap = array();

  				$wrap['uid'] = $_POST['mfn-wrap-id'][$wrapID_k];
  				$wrap['size'] = $_POST['mfn-wrap-size'][$wrapID_k];
  				$wrap['items'] = ''; // $wrap['items'] - items will be added in the next loop

  				// $wrap['attr'] - wrap attributes

  				if (key_exists('mfn-wraps', $_POST) && is_array($_POST['mfn-wraps'])) {
  					foreach ($_POST['mfn-wraps'] as $wrap_attr_k => $wrap_attr) {
  						$wrap['attr'][$wrap_attr_k] = $wrap_attr[$wrapID_k];
  					}
  				}

  				$mfn_wraps[$wrapID] = $wrap;
  			}

  			$wrap_IDs = $_POST['mfn-wrap-id'];
  			$wrap_IDs_key = array_flip($wrap_IDs);
  			$wrap_parents = $_POST['mfn-wrap-parent'];
  		}

  		// LOOP items

  		if ( isset( $_POST['mfn-item-type'] ) && is_array( $_POST['mfn-item-type'] ) ) {

  			$count = [];
  			$seo_content = '';

  			foreach ( $_POST['mfn-item-type'] as $type_k => $type ) {

  				$item = array(
						'type' => $type,
						'uid' => $_POST['mfn-item-id'][$type_k],
						'size' => $_POST['mfn-item-size'][$type_k],
					);

  				// init count for specified item type

					if ( empty( $count[$type] ) ){
						$count[$type] = 0;
					}

  				if ( isset( $_POST['mfn-items'][$type] ) && is_array( $_POST['mfn-items'][$type] ) ) {
  					foreach ( $_POST['mfn-items'][$type] as $attr_k => $attr ) {

  						if ( 'tabs' == $attr_k ) {

								// field type: TABS

								$item_tabs = $attr[ $item['uid'] ];
								$tabs = [];

								foreach( $item_tabs as $tab_key => $tab_fields ){
									foreach( $tab_fields as $tab_index => $tab_field ){

										$value = stripslashes( $tab_field );

										if ( ! mfn_opts_get( 'builder-storage' ) ) {
		  								// core.trac.wordpress.org/ticket/34845
		  								$value = preg_replace( '~\R~u', "\n", $value );
		  							}

										$tabs[$tab_index][$tab_key] = $value;

										// FIX | Yoast SEO

  									$seo_val = trim( $value );
  									if ( $seo_val && $seo_val !== '1' ) {
  										$seo_content .= $seo_val ."\n";
  									}

									}
								}

								$item['fields']['tabs'] = $tabs;

  						} else {

  							// all other field types

								$value = stripslashes( $attr[$count[$type]] );

  							if ( ! mfn_opts_get( 'builder-storage' ) ) {
  								// core.trac.wordpress.org/ticket/34845
  								$value = preg_replace( '~\R~u', "\n", $value );
  							}

								$item['fields'][$attr_k] = $value;

  							// FIX | Yoast SEO

  							$seo_val = trim( $value );

  							if ( $seo_val && intval( $seo_val ) !== 1 ) {

  								if ( in_array( $attr_k, array( 'image', 'src' ) ) ) {
  									$seo_content .= '<img src="'. esc_url( $seo_val ) .'" alt="'. mfn_get_attachment_data($seo_val, 'alt') .'"/>'."\n";
									} elseif ( 'link' == $attr_k ) {
  									$seo_content .= '<a href="'. esc_url( $seo_val ) .'">'. $seo_val .'</a>'."\n";
  								} else {
  									$seo_content .= $seo_val ."\n";
  								}

  							}

  						}
  					}

  					$seo_content .= "\n";
  				}

  				// increase count for specified item type

  				$count[$type] ++;

  				// parent wrap

  				$parent_wrap_ID = $_POST['mfn-item-parent'][ $type_k ];

  				if ( ! isset( $mfn_wraps[ $parent_wrap_ID ]['items'] ) || ! is_array( $mfn_wraps[ $parent_wrap_ID ]['items'] ) ) {
  					$mfn_wraps[ $parent_wrap_ID ]['items'] = array();
  				}

  				$mfn_wraps[ $parent_wrap_ID ]['items'][] = $item;
  			}
  		}

  		// assign wraps with items to sections

  		foreach ( $mfn_wraps as $wrap_ID => $wrap ) {

  			$wrap_key = $wrap_IDs_key[ $wrap_ID ];
  			$section_ID = $wrap_parents[ $wrap_key ];
  			$section_key = $section_IDs_key[ $section_ID ];

  			if (! isset($mfn_items[ $section_key ]['wraps']) || ! is_array($mfn_items[ $section_key ]['wraps'])) {
  				$mfn_items[ $section_key ]['wraps'] = array();
  			}
  			$mfn_items[ $section_key ]['wraps'][] = $wrap;

  		}

  		// debug
  		// print_r($mfn_items);
  		// exit;

  		// prepare data to save

  		if ( $mfn_items ) {

  			if ( 'encode' == mfn_opts_get('builder-storage') ) {
  				$new = call_user_func( 'base'.'64_encode', serialize( $mfn_items ) );
  			} else {
  				// codex.wordpress.org/Function_Reference/update_post_meta
  				$new = wp_slash( $mfn_items );
  			}

  		}

  		// SAVE data

  		if ( isset( $_POST['mfn-items-save'] ) ) {

  			$field['id'] = 'mfn-page-items';

  			$old = get_post_meta( $post_id, $field['id'], true );

  			if ( isset( $new ) && $new != $old ) {

  				// update post meta if there is at least one builder section
  				update_post_meta( $post_id, $field['id'], $new );

  			} elseif ( $old && ( ! isset( $new ) || ! $new ) ) {

  				// delete post meta if builder is empty
  				delete_post_meta( $post_id, $field['id'] );

  			}

  			// FIX | Yoast SEO

  			if ( isset( $new ) ) {
  				update_post_meta( $post_id, 'mfn-page-items-seo', $seo_content );
  			}

  		}
  	}

		/**
		 * Introduction slider
		 */

		public function introduction(){

			$slides = [
			  '<h1>The new '. apply_filters('betheme_label', 'Muffin') .' Builder <sup>3</sup></h1>',
			  '<h2>Instant access<br />to Pre-Built Sections</h2>',
			  '<h2>Builder Revisions<br />with  easy backup restoration</h2>',
			  '<h2>Import & Export of content<br />or single sections</h2>',
			  '<h2>New Text Editor with code highlighter<br />and shortcode manager</h2>',
			  '<h2>Improved section<br />with tons of new features</h2>',
			  '<h2>Extremely useful icon select with quick search & Font Awesome included</h2>',
			];

			$max = count( $slides );
			$index = 1;

			echo '<div class="mfn-intro-overlay" style="display:none">';
			  echo '<div class="mfn-intro-container">';
			    echo '<a class="mfn-intro-close close-button mfn-option-btn btn-large" href="#"><span class="mfn-icon mfn-icon-close-light"></span></a>';
			    echo '<ul>';

			      foreach( $slides as $slide ){

			        echo '<li class="step-'. $index .'">
			          <div class="pic"></div>
			          <div class="desc">
			            <p class="slide-number">'. $index .' / '. $max .'</p>
			            '. $slide .'
			            <a class="mfn-intro-close start-now" href="#">Skip</a>
			          </div>
			        </li>';

			        $index++;
			      }

			    echo '</ul>';
			  echo '</div>';
			echo '</div>';

		}

		/**
		 * Print revisions list
		 */

		public function the_revisions_list( $revisions ){

			if( ! empty( $revisions ) ){
				foreach( $revisions as $rev_key => $rev_val ){
					echo '<li data-time="'. esc_attr( $rev_key ) .'">';
				    echo '<span class="revision-icon mfn-icon-clock"></span>';
				    echo '<div class="revision">';
			        echo '<h6>'. esc_attr( $rev_val ) .'</h6>';
			        echo '<a class="mfn-option-btn mfn-option-text mfn-option-blue mfn-btn-restore revision-restore" href="#"><span class="text">Restore</span></a>';
				    echo '</div>';
					echo '</li>';
				}
			}

		}

  }
}
