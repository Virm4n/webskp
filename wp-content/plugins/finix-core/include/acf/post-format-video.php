<?php
/**
 * Finix Video Option
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 */

 /**
 * ACF Video Option
 */
if ( function_exists( 'acf_add_local_field_group' ) ) :
	acf_add_local_field_group(
		array(
			'key'                   => 'post_video',
			'title'                 => 'Post Format - Video',
			'fields'                => array(
				array(
					'key'               => 'post_video_type',
					'label'             => 'Video Type',
					'name'              => 'video_type',
					'type'              => 'radio',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'choices'           => array(
						'youtube' => 'YouTube',
						'vimeo'   => 'Vimeo',
					),
					'allow_null'        => 0,
					'other_choice'      => 0,
					'save_other_choice' => 0,
					'default_value'     => 'youtube',
					'layout'            => 'horizontal',
					'return_format'     => 'value',
				),
				array(
					'key'               => 'post_video_youtube',
					'label'             => 'YouTube Video',
					'name'              => 'post_video_youtube',
					'type'              => 'oembed',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => array(
						array(
							array(
								'field'    => 'post_video_type',
								'operator' => '==',
								'value'    => 'youtube',
							),
						),
					),
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'width'             => '',
					'height'            => '',
				),
				array(
					'key'               => 'post_video_vimeo',
					'label'             => 'Vimeo Video',
					'name'              => 'post_video_vimeo',
					'type'              => 'oembed',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => array(
						array(
							array(
								'field'    => 'post_video_type',
								'operator' => '==',
								'value'    => 'vimeo',
							),
						),
					),
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'width'             => '',
					'height'            => '',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'post',
					),
					array(
						'param'    => 'post_format',
						'operator' => '==',
						'value'    => 'video',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'field',
			'hide_on_screen'        => '',
			'active'                => 1,
			'description'           => '',
			'modified'              => 1487679234,
		)
	);
endif;

