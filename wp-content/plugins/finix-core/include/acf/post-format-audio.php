<?php
/**
 * Finix post format
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 */

 /**
 * Post Format Audio
 */
if ( function_exists( 'acf_add_local_field_group' ) ) :
	acf_add_local_field_group(
		array(
			'key'                   => 'post_format_audio',
			'title'                 => 'Post Format - Audio',
			'fields'                => array(
				array(
					'key'               => 'post_format_audio_1',
					'label'             => 'Audio File',
					'name'              => 'audio_file',
					'type'              => 'file',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'return_format'     => 'array',
					'library'           => 'all',
					'min_size'          => '',
					'max_size'          => '',
					'mime_types'        => 'mp3',
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
						'value'    => 'audio',
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
			'modified'              => 1487679141,
		)
	);
endif;

