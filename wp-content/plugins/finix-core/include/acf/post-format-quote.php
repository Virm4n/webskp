<?php
/**
 * Finix Quote Option
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 */

 /**
 * ACF Quote Option
 */
if ( function_exists( 'acf_add_local_field_group' ) ) :
	acf_add_local_field_group(
		array(
		'key'                   => 'post_format_quote',
		'title'                 => 'Post Format - Quote',
		'fields'                => array(
			array(
				'key'               => 'post_format_quote_1',
				'label'             => 'Quote',
				'name'              => 'quote',
				'type'              => 'textarea',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'default_value'     => '',
				'placeholder'       => '',
				'maxlength'         => '',
				'rows'              => '',
				'new_lines'         => 'br',
			),
			array(
				'key'               => 'post_format_quote_2',
				'label'             => 'Quote Author',
				'name'              => 'quote_author',
				'type'              => 'text',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'default_value'     => '',
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
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
					'value'    => 'quote',
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'field',
		'hide_on_screen'        => '',
		'active'                => true,
		'description'           => '',
		)
	);
endif;

