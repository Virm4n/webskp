<?php
namespace Elementor; 
if ( ! defined( 'ABSPATH' ) ) exit; 

/**
 * Elementor Blog widget.
 *
 * Elementor widget that displays an eye-catching headlines.
 *
 * @since 1.1.0
 */

class info_box extends Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve info_box widget name.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget name.
	 */

	public function get_name() {
		return __( 'info_box', 'finix' );
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve info_box widget title.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	
	public function get_title() {
		return __( 'Infobox', 'finix' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the info_box widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */

	public function get_categories() {
		return [ 'finix' ];
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve info_box widget icon.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */

	public function get_icon() {
		return 'eicon-slider-push finix-icon';
	}

	/**
	 * Register info_box widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.1.0
	 * @access protected
	 */

	protected function _register_controls() {
			
		$this->start_controls_section(
			'genral-setting',
			[
				'label' => __( 'Genral Setting', 'finix' ),
			]
		);

		$this->add_control(
			'infobox-style',
			[
				'label'      => __( 'Select Style', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'style-default',
				'options'    => [
					'style-default'          => __( 'Style 1', 'finix' ),
					'style-border'          => __( 'Style 2', 'finix' ),
					'style-flat'          => __( 'Style 3', 'finix' ),
					'style-shadow'          => __( 'Style 4', 'finix' ),
					'style-icon-bg'          => __( 'Style 5', 'finix' ),				
				],
			]
		);

		$this->add_control(
			'shadow',
			[
				'label' => __( 'Infobox Shadow', 'finix' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition' => ['infobox-style'=>['style-default','style-border','style-flat']],
				'yes' => __( 'yes', 'finix' ),
				'no' => __( 'no', 'finix' ),
			]
		);

		$this->add_control(
			'border-hover',
			[
				'label' => __( 'Border Hover', 'finix' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'infobox-style'=>['style-default','style-border','style-flat'],
					'shadow'=>['yes']
				],
				'default' => 'no',
				'yes' => __( 'yes', 'finix' ),
				'no' => __( 'no', 'finix' ),
			]
		);

		$this->add_control(
			'box-bg-color',
			[
				'label' => __( 'Box Background', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'infobox-style'=>['style-default','style-border','style-flat'],
					'shadow'=>['yes'],
				],
				'selectors' => [
					'{{WRAPPER}} .feature-box.shadow-enable' => 'background: {{VALUE}};',
					'{{WRAPPER}} .feature-box.border-hover' => 'background: {{VALUE}};',
		 		],
			]
		);

		$this->add_control(
			'info4-bg-color',
			[
				'label' => __( 'Box Background', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'infobox-style'=>['style-shadow'],
				],
				'selectors' => [
					'{{WRAPPER}} .feature-box.style-shadow' => 'background: {{VALUE}};',
		 		],
			]
		);

		$this->add_control(
			'hover-bg-color',
			[
				'label' => __( 'Box Hover Background', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'infobox-style'=>['style-shadow'],
				],
				'selectors' => [
					'{{WRAPPER}} .feature-box.style-shadow:hover' => 'background: {{VALUE}};',
		 		],
			]
		);

		$this->add_responsive_control(
			'feature_padding',
			[
				'label' => __( 'Padding', 'finix' ),
				'type' => Controls_Manager::DIMENSIONS,
				'condition' => [
					'infobox-style'=>['style-default','style-border','style-flat'],
					'shadow'=>['yes']
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .feature-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'finix' ),
				'type' => Controls_Manager::DIMENSIONS,
				'condition' => [
					'infobox-style'=>['style-default','style-border','style-flat'],
					'shadow'=>['yes']
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .feature-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'feature_padding_shadow',
			[
				'label' => __( 'Padding', 'finix' ),
				'type' => Controls_Manager::DIMENSIONS,
				'condition' => [
					'infobox-style'=>['style-shadow'],
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .feature-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'feature_shadow_radius',
			[
				'label' => __( 'Border Radius', 'finix' ),
				'type' => Controls_Manager::DIMENSIONS,
				'condition' => [
					'infobox-style'=>['style-shadow'],
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .feature-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'finix' ),
				'type' => Controls_Manager::CHOOSE,
				'condition' => [
					'icon-position' => 'icon-top',
				],
				'options' => [
					'text-left' => [
						'title' => __( 'Left', 'finix' ),
						'icon' => 'eicon-text-align-left',
					],
					'text-center' => [
						'title' => __( 'Center', 'finix' ),
						'icon' => 'eicon-text-align-center',
					],
					'text-right' => [
						'title' => __( 'Right', 'finix' ),
						'icon' => 'eicon-text-align-right',
					]
				]
			]
		);

		$this->add_control(
			'text-tablet',
			[
				'label' => __( 'Text Left Tablet', 'finix' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition' => [
					'media-type' => 'icon',
					'icon-position' => 'icon-top',
				],
				'yes' => __( 'yes', 'finix' ),
				'no' => __( 'no', 'finix' ),
			]
		);

		$this->add_control(
			'text-mobile',
			[
				'label' => __( 'Text Left Mobile', 'finix' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition' => [
					'media-type' => 'icon',
					'icon-position' => 'icon-top',
				],
				'yes' => __( 'yes', 'finix' ),
				'no' => __( 'no', 'finix' ),
			]
		);

		$this->end_controls_section(); 

		$this->start_controls_section(
			'title-setting',
			[
				'label' => __( 'Section Title', 'finix' ),
			]
		);

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'title-typography',
				'label' => __( 'Title Typography', 'finix' ),
				'selector' => '{{WRAPPER}} .feature-box .title',
			]
		);

		$this->add_control(
			'title-tag',
			[
				'label'      => __( 'Title Tag', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'h2',
				'options'    => [
					'h2'          => __( 'h2', 'finix' ),
					'h3'          => __( 'h3', 'finix' ),
					'h4'          => __( 'h4', 'finix' ),
					'h5'          => __( 'h5', 'finix' ),
					'h6'          => __( 'h6', 'finix' ),					
				],
			]
		);
		
		$this->add_control(
			'title',
			[
				'label' => __( 'Infobox Title', 'finix' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
                'label_block' => true,
                'default' => __( 'Infobox Title', 'finix' ),
			]
		);

		$this->add_control(
			'title-color',
			[
				'label' => __( 'Title Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .feature-box .title' => 'color: {{VALUE}};',
		 		],
			]
		);

		$this->add_responsive_control(
			'title_space',
			[
				'label' => __( 'Title & Description Space', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .feature-box .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); 

		$this->start_controls_section(
			'description-setting',
			[
				'label' => __( 'Section Description', 'finix' ),
			]
		);

		$this->add_control(
			'description',
			[
				'label' => __( 'Description', 'finix' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Description', 'finix' ),
				'default' => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'finix' ),
			]
		);

		$this->add_control(
			'description-color',
			[
				'label' => __( 'Description Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .feature-box .feature-info p' => 'color: {{VALUE}};',
		 		],
			]
		);
		
		$this->add_control(
			'infobox-link',
			[
				'label' => __( 'Link Enable', 'finix' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before',
				'default' => 'no',
				'yes' => __( 'yes', 'finix' ),
				'no' => __( 'no', 'finix' ),
			]
		);

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'link-typography',
				'label' => __( 'Link Typography', 'finix' ),
				'condition' => ['infobox-link' => 'yes'],
				'selector' => '{{WRAPPER}} .feature-box .feature-link',
			]
		);
		
		$this->add_control(
			'button-text',
			[
				'label' => __( 'Button Text', 'finix' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
                'label_block' => true,
				'default' => __( 'Read More', 'finix' ),
				'condition' => ['infobox-link' => 'yes']
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Button Link', 'finix' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'finix' ),
				'default' => [
					'url' => '#',
				],
				'condition' => ['infobox-link' => 'yes']
			]
		);

		$this->add_control(
			'link-color',
			[
				'label' => __( 'Link Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => ['infobox-link' => 'yes'],
				'selectors' => [
					'{{WRAPPER}} .feature-box .feature-link' => 'color: {{VALUE}};',
					'{{WRAPPER}} .feature-box .feature-link:after' => 'background: {{VALUE}};',
					'{{WRAPPER}} .feature-box .feature-link:before' => 'background: {{VALUE}};',
		 		],
			]
		);

		$this->end_controls_section(); 

		$this->start_controls_section(
			'style-info',
			[
				'label' => __( 'Icon Setting', 'finix' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'media-type',
			[
				'label'      => __( 'Icon / Image', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'icon',
				'options'    => [
					'none'          => __( 'None', 'finix' ),
					'icon'          => __( 'Icon', 'finix' ),
					'image'          => __( 'Image', 'finix' ),					
				]
			]
		);

		$this->add_control(
			'icon-position',
			[
				'label' => __( 'Icon Position', 'finix' ),
				'type' => Controls_Manager::CHOOSE,
				'condition' => [
					'media-type' =>['icon','image'],
					'infobox-style'=>['style-default','style-border','style-flat','style-shadow'],
				],
				'default' => 'icon-top',
				'options' => [
					'icon-left' => [
						'title' => __( 'Left', 'finix' ),
						'icon' => 'eicon-h-align-left',
					],
					'icon-top' => [
						'title' => __( 'Top', 'finix' ),
						'icon' => 'eicon-v-align-top',
					],
					'icon-right' => [
						'title' => __( 'Right', 'finix' ),
						'icon' => 'eicon-h-align-right',
					],
				],
			]
		);

		$this->add_control(
			'icon-tablet',
			[
				'label' => __( 'Icon Left Tablet', 'finix' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition' => [
					'media-type' => 'icon',
					'icon-position' => 'icon-right',
				],
				'yes' => __( 'yes', 'finix' ),
				'no' => __( 'no', 'finix' ),
			]
		);

		$this->add_control(
			'icon-mobile',
			[
				'label' => __( 'Icon Left Mobile', 'finix' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition' => [
					'media-type' => 'icon',
					'icon-position' => 'icon-right',
				],
				'yes' => __( 'yes', 'finix' ),
				'no' => __( 'no', 'finix' ),
			]
		);

		$this->add_control(
			'finix-icon',
			[
				'label' => __( 'Icon', 'finix' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'condition' => [
					'media-type' => 'icon',
				],
				'default' => [
					'value' => 'fas fa-star'
					
				]
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'finix' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'media-type' => 'image',
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => [
					'media-type' => 'icon',
				],
				'default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .feature-box .feature-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_image_size',
			[
				'label' => __( 'Icon Size', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => [
					'media-type' => 'image',
				],
				'default' => [
					'size' => 70,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .feature-box .feature-icon img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Icon Space', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => [
					'media-type' =>['icon','image'],
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .feature-box.icon-top .feature-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .feature-box.icon-left .feature-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .feature-box.icon-right .feature-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .feature-box.icon-left .feature-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .feature-box.icon-right .feature-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'condition' => [
					'infobox-style'=>[
						'style-border','style-flat'
					]
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .feature-box.style-border .feature-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .feature-box.style-flat .feature-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon-color',
			[
				'label' => __( 'Icon Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'media-type' =>['icon','image'],
				],
				'selectors' => [
					'{{WRAPPER}} .feature-box .feature-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .feature-box.border-hover:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .feature-box.style-icon-bg .feature-icon:after' => 'background: {{VALUE}};',
		 		],
			]
		);

		$this->add_control(
			'icon-border-color',
			[
				'label' => __( 'Icon Border Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'infobox-style'=>['style-border'],
				],
				'selectors' => [
					'{{WRAPPER}} .feature-box .feature-icon i' => 'border-color: {{VALUE}};',
		 		],
			]
		);

		$this->add_control(
			'icon-bg-color',
			[
				'label' => __( 'Icon Background Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'infobox-style'=>['style-flat'],
				],
				'selectors' => [
					'{{WRAPPER}} .feature-box .feature-icon i' => 'background: {{VALUE}};',
					'{{WRAPPER}} .feature-box.style-flat.border-hover:before' => 'background: {{VALUE}};',
		 		],
			]
		);

		$this->end_controls_section(); 

	}
	/**
	 * Render Blog widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.1.0
	 * @access protected
	 */
	
	protected function render() {
		
		$settings = $this->get_settings();
				
		$media_html = '';

		if($settings['media-type'] == 'image')
		{
			if ( ! empty( $settings['image']['url'] ) ) 
			{
				$this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
				$this->add_render_attribute( 'image', 'srcset', $settings['image']['url'] );
				$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
				$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );
				$media_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );
			}
			//$icon_html = sprintf('%1$s',esc_html($settings['image-style'],'finix'));
		}
		if($settings['media-type'] == 'icon')
		{
			$media_html = sprintf('<i aria-hidden="true" class="%1$s"></i>',esc_attr($settings['finix-icon']['value'],'finix'));
			//$icon_html = sprintf('%1$s',esc_html($settings['icon-style'],'finix'));
			//$icon_shap = sprintf('%1$s',esc_html($settings['icon-shap'],'finix'));
		}

		$url = $settings['link']['url'];
		$this->add_render_attribute( 'infobox-class', 'class', esc_attr('feature-link') ); 
		$this->add_render_attribute( 'infobox-class', 'href', esc_url($url) );
		
		$icon_position = sprintf('%1$s',esc_html($settings['icon-position'],'finix'));

		$infobox_style = sprintf('%1$s',esc_html($settings['infobox-style'],'finix'));

		$align = $settings['align'];
		if($settings['shadow'] == 'yes'){  $align .= ' shadow-enable'; } 
		if($settings['border-hover'] == 'yes'){  $align .= ' border-hover'; }
		if($settings['text-tablet'] == 'yes'){  $align .= ' tablet-text-left'; }
		if($settings['text-mobile'] == 'yes'){  $align .= ' mobile-text-left'; }
		if($settings['icon-tablet'] == 'yes'){  $align .= ' tablet-icon-left'; }
		if($settings['icon-mobile'] == 'yes'){  $align .= ' mobile-icon-left'; }
		
		//$color_type = sprintf('%1$s',esc_html($settings['color-type'],'finix'));
		?>
		<div class="feature-box <?php echo $infobox_style; ?> <?php echo $icon_position; ?> <?php echo esc_attr($align);?>">
			<?php if($settings['media-type'] != 'none') { ?>
			<div class="feature-icon"><?php echo $media_html; ?></div>
			<?php } ?>
            <div class="feature-info">
				<?php if($settings['title']) { ?>
              		<<?php echo $settings['title-tag'];  ?> class="title"><?php echo sprintf('%1$s',esc_html($settings['title'],'finix')); ?></<?php echo $settings['title-tag'];  ?>>
				<?php } if($settings['description']) { ?>
              		<p><?php echo sprintf('%1$s',esc_html($settings['description'],'finix'));?></p>
				<?php } ?>
				<?php if($settings['infobox-link'] == 'yes') { ?>
				<a <?php echo $this->get_render_attribute_string( 'infobox-class' ) ?>><?php echo sprintf('%1$s',esc_html($settings['button-text'],'finix'));?></a>
				<?php } ?>
            </div>
        </div>
		<?php
	}	
}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\info_box() );
?>