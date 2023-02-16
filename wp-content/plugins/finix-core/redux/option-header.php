<?php
/**
 * Header Options
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 * @version 1.5.0
 */

Redux::setSection(
	'finix_redux',
	array(
		'title'            => esc_html__( 'Site Header', 'finix' ),
		'id'               => 'header-editor',
		'icon'             => 'el el-arrow-up',
		'customizer_width' => '500px',
	)
);

Redux::setSection(
	'finix_redux',
	array(
		'title'      => esc_html__( 'Topbar', 'finix' ),
		'id'         => 'header-opt',
		'subsection' => true,
		'fields'     => array(

			array(
				'id'    => 'info_site_header_top',
				'type'  => 'info',
				'style' => 'custom',
				'color' => sanitize_hex_color( '#2b2b2b' ),
				'title' => __( 'Layout Options', 'finix' ),
				'desc'  => __( 'This Section Contain Option For Your Site Layout.', 'finix' ),
			),

			array(
				'id'     => 'section-general',
				'type'   => 'section',
				'indent' => true,
			),

			array(
				'id'       => 'header_top',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Display Topbar', 'finix' ),
				'subtitle' => esc_html__( 'Turn on to display the Email and Phone, Login and Button on header menu.', 'finix' ),
				'options'  => array(
					'on'  => esc_html__( 'On', 'finix' ),
					'off' => esc_html__( 'Off', 'finix' ),
				),
				'default'  => esc_html__( 'off', 'finix' ),
			),

			array(
				'id'       => 'header_topbar_mobile',
				'type'     => 'button_set',
				'title'    => __( 'Topbar Mobile', 'finix' ),
				'required' => array( 'header_top', '=', 'on' ),
				'compiler' => 'true',
				'options'  => array(
					'topbar-mobile-on' => 'On',
					'topbar-mobile-off' => 'Off',
				),
				'default'  => 'topbar-mobile-off',
			),

			array(
				'id'       => 'header-top-blocks',
				'type'     => 'sorter',
				'title'    => 'Topbar Elements',
				'desc'     => 'Organize how you want the layout to appear on the homepage',
				'required' => array( 'header_top', '=', 'on' ),
				'compiler' => 'true',
				'options'  => array(
					'Left'               => array(
						'email' => 'Email',
						'phone' => 'Phone',
					),
					'Right'              => array(
						'text'         => 'Text',
						'social-media' => 'Social Media',
					),
					'Available Elements' => array(
						'topbar-menu' => 'Topbar Menu',
					),
				),
			),

			array(
				'id'          => 'top_bg_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Topbar Background Color', 'finix' ),
				'required'    => array( 'header_top', '=', 'on' ),
				'default'     => '#ffffff',
				'mode'        => 'background',
				'transparent' => false,
			),

			array(
				'id'          => 'top_text_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Topbar Text/Link Color', 'finix' ),
				'required'    => array( 'header_top', '=', 'on' ),
				'default'     => '#757575',
				'mode'        => 'background',
				'transparent' => false,
			),

			array(
				'id'          => 'top_link_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Topbar Link Hover Color', 'finix' ),
				'required'    => array( 'header_top', '=', 'on' ),
				'default'     => '#036ffb',
				'mode'        => 'background',
				'transparent' => false,
			),

			array(
				'id'          => 'top_icon_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Topbar Icon Color', 'finix' ),
				'required'    => array( 'header_top', '=', 'on' ),
				'default'     => '#036ffb',
				'mode'        => 'background',
				'transparent' => false,
			),


		),

	)
);

Redux::setSection(
	'finix_redux',
	array(
		'title'            => esc_html__( 'Header Main', 'finix' ),
		'id'               => 'header-main',
		'subsection'       => true,
		'customizer_width' => '400px',
		'desc'             => esc_html__( 'This section contains options for header.', 'finix' ),
		'fields'           => array(

			array(
				'id'       => 'header_type',
				'type'     => 'image_select',
				'title'    => esc_html__( 'Header Layout', 'finix' ),
				'subtitle' => esc_html__( 'Select the design variation that you want to use for site header.', 'finix' ),
				'options'  => array(
					'1' => array(
						'alt' => 'Style1',
						'img' => get_template_directory_uri() . '/assets/images/theme-option/site-header/header-1.jpg',
					),
					'2' => array(
						'alt' => 'Style2',
						'img' => get_template_directory_uri() . '/assets/images/theme-option/site-header/header-2.jpg',
					),
					'3' => array(
						'alt' => 'Style3',
						'img' => get_template_directory_uri() . '/assets/images/theme-option/site-header/header-3.jpg',
					),
				),
				'default'  => '1',
			),

			array(
				'id'       => 'header_setting',
				'type'     => 'button_set',
				'title'    => __( 'Header Setting', 'finix' ),
				'required' => array(
					array( 'header_type', '!=', '2' ),
				),
				'subtitle' => __( 'Select the Header Setting want to use with site header.', 'finix' ),
				'options'  => array(
					'default' => 'Default',
					'transparnt' => 'Transparnt',
					'transparnt-light' => 'Transparnt Light',
				),
				'default'  => 'default',
			),

			array(
				'id'     => 'header-sticky-section',
				'type'   => 'section',
				'title'  => esc_html__( 'Header Sticky', 'finix' ),
				'indent' => true,
			),

			array(
				'id'       => 'header_sticky',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Header Sticky', 'finix' ),
				'subtitle' => esc_html__( 'Turn on to display enable the sticky header.', 'finix' ),
				'options'  => array(
					'on'  => esc_html__( 'On', 'finix' ),
					'off' => esc_html__( 'Off', 'finix' ),
				),
				'default'  => esc_html__( 'on', 'finix' ),
			),

			array(
				'id'     => 'header-search-section',
				'type'   => 'section',
				'title'  => esc_html__( 'Header Search', 'finix' ),
				'indent' => true,
			),


			array(
				'id'       => 'header_search',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Header Search', 'finix' ),
				'subtitle' => esc_html__( 'Turn on to display the search Icon in top header.', 'finix' ),
				'options'  => array(
					'on'  => esc_html__( 'On', 'finix' ),
					'off' => esc_html__( 'Off', 'finix' ),
				),
				'default'  => esc_html__( 'on', 'finix' ),
			),

			array(
				'id'     => 'header-submenu-color',
				'type'   => 'section',
				'title'  => esc_html__( 'Submenu Color', 'finix' ),
				'indent' => true,
			),

			array(
				'id'       => 'submenu-color',
				'type'     => 'button_set',
				'title'    => __( 'Submenu Color Scheme', 'finix' ),
				'subtitle' => esc_html__( 'Choose Submenu Color Scheme.', 'finix' ),
				'options'  => array(
					'submenu-light' => 'Light',
					'submenu-dark' => 'Dark',
				),
				'default'  => 'submenu-light',
			),

			array(
				'id'     => 'header_custom_font',
				'type'   => 'section',
				'title'  => esc_html__( 'Menu Typography', 'finix' ),
				'indent' => true,
			),

			array(
				'id'       => 'nav-typography',
				'type'     => 'button_set',
				'title'    => __( 'Menu Typography', 'finix' ),
				'subtitle' => __( 'Specify the Main Navigation font properties.', 'finix' ),
				'required' => array( 'header_button', '=', 'on' ),
				'options'  => array(
					'1' => 'Default',
					'2' => 'Custom',
				),
				'default'  => '1',
			),

			array(
				'id'             => 'button-typography2',
				'type'           => 'typography',
				'title'          => __( 'Menu Font', 'finix' ),
				'subtitle'       => __( 'Specify the Header Menu font properties.', 'finix' ),
				'required'       => array( 'nav-typography', '=', '2' ),
				'google'         => true,
				'letter-spacing' => true,
				'font-backup'    => false,
				'text-transform' => true,
				'text-align'     => false,
				'color'          => false,
				'output'         => array( '.main-navigation .navbar-nav > li > a' ),
			),

		),
	)
);

Redux::setSection(
	'finix_redux',
	array(
		'title'            => esc_html__( 'Header Button', 'finix' ),
		'id'               => 'header-button',
		'subsection'       => true,
		'customizer_width' => '400px',
		'desc'             => esc_html__( 'This section contains options for header.', 'finix' ),
		'fields'           => array(

			array(
				'id'       => 'header_button',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Header Button', 'finix' ),
				'subtitle' => esc_html__( 'Turn on to display the Header button in top header.', 'finix' ),
				'options'  => array(
					'on'  => esc_html__( 'On', 'finix' ),
					'off' => esc_html__( 'Off', 'finix' ),
				),
				'default'  => esc_html__( 'on', 'finix' ),
			),

			array(
				'id'       => 'header_btn_typography',
				'type'     => 'button_set',
				'title'    => __( 'Button Typography', 'finix' ),
				'subtitle' => __( 'Choose Header Button font properties.', 'finix' ),
				'required' => array( 'header_button', '=', 'on' ),
				'options'  => array(
					'1' => 'Default',
					'2' => 'Custom',
				),
				'default'  => '1',
			),

			array(
				'id'             => 'button-typography',
				'type'           => 'typography',
				'title'          => __( 'Button Font', 'finix' ),
				'subtitle'       => __( 'Specify the Header Button font properties.', 'finix' ),
				'required'       => array( 'header_btn_typography', '=', '2' ),
				'google'         => true,
				'letter-spacing' => true,
				'font-backup'    => false,
				'text-transform' => true,
				'text-align'     => false,
				'color'          => false,
			),

			array(
				'id'       => 'button_title',
				'type'     => 'text',
				'title'    => esc_html__( 'Button Text', 'finix' ),
				'subtitle' => __( 'Add Button text.', 'finix' ),
				'required' => array( 'header_button', '=', 'on' ),
				'default'  => 'Get Started',
				'desc'     => esc_html__( 'Change Title (e.g.Download).', 'finix' ),
			),

			array(
				'id'       => 'button_link',
				'type'     => 'text',
				'title'    => esc_html__( 'Button Link', 'finix' ),
				'subtitle' => __( 'Add Button link.', 'finix' ),
				'required' => array( 'header_button', '=', 'on' ),
				'desc'     => esc_html__( 'Add download link.', 'finix' ),
			),

			array(
				'id'       => 'button_style',
				'type'     => 'button_set',
				'title'    => __( 'Button Style', 'finix' ),
				'subtitle' => __( 'Select Button Style.', 'finix' ),
				'required' => array( 'header_button', '=', 'on' ),
				'options'  => array(
					'button-flat' => 'Flat',
					'button-border' => 'Border',
				),
				'default'  => 'button-flat',
				'desc'     => esc_html__( 'Button Style Option Not Working in Header Style 2.', 'finix' ),
			),

			array(
				'id'       => 'button_shap',
				'type'     => 'button_set',
				'title'    => __( 'Button Shap', 'finix' ),
				'subtitle' => __( 'Choose Button Shap.', 'finix' ),
				'required' => array( 'header_button', '=', 'on' ),
				'options'  => array(
					'button-square' => 'Square',
					'button-round' => 'Round',
					'button-rounded' => 'Rounded',
				),
				'default'  => 'button-square',
				'desc'     => esc_html__( 'Button Shap Option Not Working in Header Style 2.', 'finix' ),
			),

			array(
				'id'       => 'button_color',
				'type'     => 'button_set',
				'title'    => __( 'Button Color', 'finix' ),
				'subtitle' => __( 'Choose Button Color Scheme.', 'finix' ),
				'required' => array( 'header_button', '=', 'on' ),
				'options'  => array(
					'button-dark' => 'Dark',
					'button-light' => 'Light',
					'button-theme' => 'Theme',
					'button-gradient' => 'Gradient',
				),
				'default'  => 'button-dark',
			),
		),
	)
);


// Redux::setSection(
// 	'finix_redux',
// 	array(
// 		'title'            => esc_html__( 'Header Sidemenu', 'finix' ),
// 		'id'               => 'header-sidemenu',
// 		'subsection'       => true,
// 		'customizer_width' => '400px',
// 		'desc'             => esc_html__( 'This section contains options for header.', 'finix' ),
// 		'fields'           => array(

// 			array(
// 				'id'       => 'header_sidemenu',
// 				'type'     => 'button_set',
// 				'title'    => esc_html__( 'Header Sidemenu', 'finix' ),
// 				'subtitle' => esc_html__( 'Turn on to display the Header button in top header.', 'finix' ),
// 				'options'  => array(
// 					'on'  => esc_html__( 'On', 'finix' ),
// 					'off' => esc_html__( 'Off', 'finix' ),
// 				),
// 				'default'  => esc_html__( 'on', 'finix' ),
// 			),
// 		),
// 	)
// );
