<?php
/**
 * Blog Options
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 * @version 1.5.0
 */

Redux::setSection( 'finix_redux', array(
    'title' => esc_html__( 'Blog', 'finix' ),
    'id'    => 'editor',
    'icon'  => 'el el-quotes',
    'customizer_width' => '500px',
) );

Redux::setSection( 'finix_redux', array(
    'title' => esc_html__('General Blogs','finix'),
    'id'    => 'blog-section',
    'subsection' => true,
    'desc'  => esc_html__('This section contains options for blog.','finix'),
    'fields'=> array(

        array(
            'id' => 'info_site_blog',
            'type' => 'info',
            'style' => 'custom',            
            'color' => sanitize_hex_color('#2b2b2b'),
            'title' => __('Layout Options', 'finix') ,
            'desc' => __('This Section Contain Option For Your Site Layout.','finix'),
        ) ,

        array(
            'id' => 'section-general',
            'type' => 'section',            
            'indent' => true
        ) ,

        array(
            'id' => 'blog_type',
            'type' => 'image_select',
            'title'   => esc_html__( 'Select Blog Type', 'finix' ),
            'options' => array(
                '1' => array(
                    'title' => esc_html__('Classic', 'finix') ,
                    'img' => get_template_directory_uri() . '/assets/images/theme-option/blog/classic.png',
                ) ,
                '2' => array(
                    'title' => esc_html__('Grid', 'finix') ,
                    'img' => get_template_directory_uri() . '/assets/images/theme-option/blog/grid.png',
                ) ,
                '3' => array(
                    'title' => esc_html__('List', 'finix') ,
                    'img' => get_template_directory_uri() . '/assets/images/theme-option/blog/list.png',
                ) ,
            ) ,
            'default'  => '1'
        ) ,

        array(
            'id' => 'blog_sidebar_opt',
            'type' => 'image_select',
            'title'   => esc_html__( 'Select Sidebar', 'finix' ),
            'options' => array(
                '1' => array(
                    'title' => esc_html__('Right Sidebar', 'finix') ,
                    'img' => get_template_directory_uri() . '/assets/images/theme-option/blog/right-sidebar.png',
                ) ,
                '2' => array(
                    'title' => esc_html__('Left Sidebar', 'finix') ,
                    'img' => get_template_directory_uri() . '/assets/images/theme-option/blog/left-sidebar.png',
                ) ,
                '3' => array(
                    'title' => esc_html__('FullWidth', 'finix') ,
                    'img' => get_template_directory_uri() . '/assets/images/theme-option/blog/full-width.png',
                ) ,
            ) ,
            'default'  => '1'
        ) ,

        
        array(
            'id'        => 'opt-pagination',
            'type'      => 'button_set',
            'title'     => esc_html__( 'Display Pagination','finix'),
            'options'   => array(
                            'on' => esc_html__('On','finix'),
                            'off' => esc_html__('Off','finix')
                        ),
            'default'   => esc_html__('on','finix')
        ),

    )
));

Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Blog Singal Post', 'finix' ),
    'id'         => 'blog_singal_page',
    'subsection' => true,
    'fields'     => array(

            array(
                'id' => 'single_sidebar_opt',
                'type' => 'image_select',
                'title'   => esc_html__( 'Select Singal  Page Sidebar', 'finix' ),
                'options' => array(
                    '1' => array(
                        'title' => esc_html__('Right Sidebar', 'finix') ,
                        'img' => get_template_directory_uri() . '/assets/images/theme-option/blog/right-sidebar.png',
                    ) ,
                    '2' => array(
                        'title' => esc_html__('Left Sidebar', 'finix') ,
                        'img' => get_template_directory_uri() . '/assets/images/theme-option/blog/left-sidebar.png',
                    ) ,
                    '3' => array(
                        'title' => esc_html__('FullWidth', 'finix') ,
                        'img' => get_template_directory_uri() . '/assets/images/theme-option/blog/full-width.png',
                    ) ,
                ) ,
                'default'  => '1'
            ) ,

            array(
                'id'       => 'post_metabox',
                'type'     => 'checkbox',
                'title'    => __('Multi Checkbox Option', 'finix'), 
                'subtitle' => __('No validation can be done on this field type', 'finix'),
                'desc'     => __('This is the description field, again good for additional info.', 'finix'),
             
                //Must provide key => value pairs for multi checkbox options
                'options'  => array(
                    '1' => 'Author',
                    '2' => 'Date',
                    '3' => 'Comment'
                ),
             
                //See how default has changed? you also don't need to specify opts that are 0.
                'default' => array(
                    '1' => '1', 
                    '2' => '1', 
                    '3' => '1'
                )
            ),

            array(
				'id'      => 'singal-blog-meta',
				'type'    => 'button_set',
				'title'   => esc_html__( 'Blog Meta', 'finix' ),
				'options' => array(
					'on'  => esc_html__( 'On', 'finix' ),
					'off' => esc_html__( 'Off', 'finix' ),
				),
				'default' => esc_html__( 'off', 'finix' ),
			),

            array(
				'id'       => 'singal-blog-tag',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Blog Tags', 'finix' ),
				'required' => array( 'singal-blog-meta', '=', 'on' ),
				'options'  => array(
					'on'  => esc_html__( 'On', 'finix' ),
					'off' => esc_html__( 'Off', 'finix' ),
				),
				'default'  => esc_html__( 'off', 'finix' ),
			),

			array(
				'id'       => 'singal-blog-share',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Blog Social Share', 'finix' ),
				'required' => array( 'singal-blog-meta', '=', 'on' ),
				'options'  => array(
					'on'  => esc_html__( 'On', 'finix' ),
					'off' => esc_html__( 'Off', 'finix' ),
				),
				'default'  => esc_html__( 'off', 'finix' ),
			),

			array(
				'id'       => 'singal-blog-author',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Blog Author Detail', 'finix' ),
				'required' => array( 'singal-blog-meta', '=', 'on' ),
				'options'  => array(
					'on'  => esc_html__( 'On', 'finix' ),
					'off' => esc_html__( 'Off', 'finix' ),
				),
				'default'  => esc_html__( 'off', 'finix' ),
			),

			array(
				'id'       => 'singal-blog-pagination',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Blog Pagination', 'finix' ),
				'required' => array( 'singal-blog-meta', '=', 'on' ),
				'options'  => array(
					'on'  => esc_html__( 'On', 'finix' ),
					'off' => esc_html__( 'Off', 'finix' ),
				),
				'default'  => esc_html__( 'off', 'finix' ),
			),

            array(
                'id'        => 'related_post',
                'type'      => 'button_set',
                'title'     => esc_html__( 'Display Related Post','finix'),
                'options'   => array(
                                'on' => esc_html__('On','finix'),
                                'off' => esc_html__('Off','finix')
                            ),
                'default'   => esc_html__('off','finix')
            ),

        )) 
    );

?>