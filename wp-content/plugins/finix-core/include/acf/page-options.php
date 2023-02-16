<?php
/**
 * Finix Page Option
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 */

 /**
 * ACF Page Option
 */
if ( function_exists( 'acf_add_local_field_group' ) ) :

	acf_add_local_field_group(
		array(
			'key'                   => 'page_setting',
			'title'                 => 'Page Options',
			'fields'                => array(

				array(
					'key'               => 'field_2',
					'label'             => 'Header',
					'name'              => '',
					'type'              => 'tab',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'placement'         => 'left',
					'endpoint'          => 0,
				),

				array(
					'key'               => 'field_header_1',
					'name'              => 'header_nav',
					'label'             => 'Site Header',
					'type'              => 'button_group',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'choices'           => array(
						// 'default' => 'Default',
						'enable'  => 'Enable',
						'disable' => 'Disable',
					),
					'allow_null'        => 0,
					'default_value'     => 'enable',
					'layout'            => 'horizontal',
					'return_format'     => 'value',
				),

				array(
					'key'               => 'field_header_2',
					'label'             => 'Header Layout',
					'name'              => 'header_style',
					'type'              => 'select',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => array(
						array(
							array(
								'field'    => 'field_header_1',
								'operator' => '==',
								'value'    => 'enable',
							),
						),
					),
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'choices'           => array(
						'default' => 'Default',
						'1'       => 'Header-1',
						'2'       => 'Header-2',
						'3'       => 'Header-3',
					),
					'default_value'     => 'default',
					'allow_null'        => 0,
					'multiple'          => 0,
					'ui'                => 0,
					'return_format'     => 'value',
					'ajax'              => 0,
					'placeholder'       => '',
				),

				array(
					'key'               => 'field_1',
					'label'             => 'Page Header',
					'name'              => '',
					'type'              => 'tab',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'placement'         => 'left',
					'endpoint'          => 0,
				),

				array(
					'key'               => 'field_ph_1',
					'name'              => 'pageheader_nav',
					'label'             => 'Page Header',
					'type'              => 'button_group',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'choices'           => array(
						'enable'  => 'Enable',
						'disable' => 'Disable',
					),
					'allow_null'        => 0,
					'default_value'     => 'enable',
					'layout'            => 'horizontal',
					'return_format'     => 'value',
				),

				array(
					'key'               => 'field_ph_7',
					'label'             => 'Header Layout',
					'name'              => 'page_header_style',
					'type'              => 'select',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => array(
						array(
							array(
								'field'    => 'field_ph_1',
								'operator' => '==',
								'value'    => 'enable',
							),
						),
					),
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'choices'           => array(
						'default' => 'Default',
						'1'       => 'Style-1',
						'2'       => 'Style-2',
						'3'       => 'Style-3',
					),
					'default_value'     => 'default',
					'allow_null'        => 0,
					'multiple'          => 0,
					'ui'                => 0,
					'return_format'     => 'value',
					'ajax'              => 0,
					'placeholder'       => '',
				),

				array(
					'key'               => 'field_ph_8',
					'label'             => 'Page Header 1 Alignment',
					'name'              => 'ph_alignment',
					'type'              => 'select',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => array(
						array(
							array(
								'field'    => 'field_ph_7',
								'operator' => '==',
								'value'    => '1',
							),
						),
					),
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => '',
					),
					'choices'           => array(
						'default' => 'Default',
						'1'       => 'Left',
						'2'       => 'Right',
						'3'       => 'Center',
					),
					'default_value'     => '2',
					'allow_null'        => 0,
					'multiple'          => 0,
					'ui'                => 0,
					'return_format'     => 'value',
					'ajax'              => 0,
					'placeholder'       => '',
				),

				array(
					'key'               => 'field_ph_9',
					'label'             => 'Page Header 3 Alignment',
					'name'              => 'ph_three_alignment',
					'type'              => 'select',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => array(
						array(
							array(
								'field'    => 'field_ph_7',
								'operator' => '==',
								'value'    => '3',
							),
						),
					),
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'choices'           => array(
						'default' => 'Default',
						'1'       => 'Breadcrume Left/Title Right',
						'2'       => 'Title Left/Breadcrume Right',
					),
					'default_value'     => '1',
					'allow_null'        => 0,
					'multiple'          => 0,
					'ui'                => 0,
					'return_format'     => 'value',
					'ajax'              => 0,
					'placeholder'       => '',
				),

				array(
					'key'               => 'field_3',
					'label'             => 'Footer',
					'name'              => '',
					'type'              => 'tab',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'placement'         => 'left',
					'endpoint'          => 0,
				),

				array(
					'key'               => 'field_footer_1',
					'name'              => 'footer_nav',
					'label'             => 'Footer',
					'type'              => 'button_group',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => '',
					),
					'choices'           => array(
						// 'default' => 'Default',
						'enable'  => 'Enable',
						'disable' => 'Disable',
					),
					'allow_null'        => 0,
					'default_value'     => 'enable',
					'layout'            => 'horizontal',
					'return_format'     => 'value',
				),

			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'page',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'           => '',
		)
	);

	acf_add_local_field_group(
		array(
			'key'                   => 'team_user_quote',
			'title'                 => 'User Quote',
			'fields'                => array(

				array(
					'key'               => 'field_team_14',
					'label'             => 'User Quote',
					'name'              => 'user_quote',
					'type'              => 'textarea',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
					'placement'         => 'left',
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
						'value'    => 'team',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'           => '',
		)
	);

	acf_add_local_field_group(
		array(
			'key'                   => 'team_setting',
			'title'                 => 'Social Info',
			'fields'                => array(

				array(
					'key'               => 'field_team_1',
					'label'             => 'Facebook',
					'name'              => 'facebook',
					'type'              => 'text',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
					'placement'         => 'left',
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				),

				array(
					'key'               => 'field_team_2',
					'label'             => 'Twitter',
					'name'              => 'twitter',
					'type'              => 'text',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
					'placement'         => 'left',
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				),

				array(
					'key'               => 'field_team_3',
					'label'             => 'Linkedin',
					'name'              => 'linkedin',
					'type'              => 'text',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
					'placement'         => 'left',
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				),

				array(
					'key'               => 'field_team_4',
					'label'             => 'Instagram',
					'name'              => 'instagram',
					'type'              => 'text',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
					'placement'         => 'left',
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				),

				array(
					'key'               => 'field_team_5',
					'label'             => 'Position',
					'name'              => 'position',
					'type'              => 'text',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
					'placement'         => 'left',
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
						'value'    => 'team',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'           => '',
		)
	);

	acf_add_local_field_group(
		array(
			'key'                   => 'team_contact_details',
			'title'                 => 'Personal Information',
			'fields'                => array(

				array(
					'key'               => 'field_team_6',
					'label'             => 'Address',
					'name'              => 'address',
					'type'              => 'text',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
					'placement'         => 'left',
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				),

				array(
					'key'               => 'field_team_7',
					'label'             => 'Email',
					'name'              => 'email',
					'type'              => 'text',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
					'placement'         => 'left',
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				),

				array(
					'key'               => 'field_team_8',
					'label'             => 'Phone Number',
					'name'              => 'phone_number',
					'type'              => 'text',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
					'placement'         => 'left',
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				),

				array(
					'key'               => 'field_team_12',
					'label'             => 'Fax Number',
					'name'              => 'fax_number',
					'type'              => 'text',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
					'placement'         => 'left',
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				),

				array(
					'key'               => 'field_team_9',
					'label'             => 'Site URL',
					'name'              => 'site_url',
					'type'              => 'text',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
					'placement'         => 'left',
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				),

				array(
					'key'               => 'field_team_10',
					'label'             => 'Button Name',
					'name'              => 'team_button',
					'type'              => 'text',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
					'placement'         => 'left',
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				),

				array(
					'key'               => 'field_team_11',
					'label'             => 'Button URL',
					'name'              => 'team_button_url',
					'type'              => 'text',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
					'placement'         => 'left',
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				),

				array(
					'key'               => 'field_team_13',
					'label'             => 'Experience',
					'name'              => 'experience',
					'type'              => 'text',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
					'placement'         => 'left',
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
						'value'    => 'team',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'           => '',
		)
	);

	acf_add_local_field_group(
		array(
			'key'                   => 'testimonial_setting',
			'title'                 => 'Testimonial Options',
			'fields'                => array(

				array(
					'key'               => 'field_testimonial_1',
					'label'             => 'Designation',
					'name'              => 'designation',
					'type'              => 'text',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
					'placement'         => 'left',
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
						'value'    => 'testimonial',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'           => '',
		)
	);

endif;
