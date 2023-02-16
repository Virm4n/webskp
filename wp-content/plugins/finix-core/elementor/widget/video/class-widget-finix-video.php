<?php
namespace Elementor;

use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) ) exit; 

/**
 * Elementor Blog widget.
 *
 * Elementor widget that displays an eye-catching headlines.
 *
 * @since 1.1.0
 */

class finix_video extends Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve video widget name.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget name.
	 */

	public function get_name() {
		return __( 'finix_video', 'finix' );
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve video widget title.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	
	public function get_title() {
		return __( 'Video', 'finix' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the video widget belongs to.
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
	 * Retrieve video widget icon.
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
	 * Register video widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.1.0
	 * @access protected
	 */

	protected function _register_controls() {
			
		$this->start_controls_section(
			'section',
			[
				'label' => __( 'Genral Setting', 'finix' ),
			]
		);

		$this->add_control(
			'finix-icon',
			[
				'label' => __( 'Icon', 'finix' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-plus',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'chevron-down',
						'angle-down',
						'angle-double-down',
						'caret-down',
						'caret-square-down',
					],
					'fa-regular' => [
						'caret-square-down',
					],
				],
				'skin' => 'inline',
				'label_block' => false,
			]
		);

		$this->add_control(
			'video-btn-style',
			[
				'label'      => __( 'Icon Style', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'style-flat',
				'options'    => [
					'style-flat'        => __( 'Flat', 'finix' ),	
					'style-border'      => __( 'Border', 'finix' ),		
				]
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Video Link', 'finix' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'finix' ),
				'default' => [
					'url' => '#',
				],
			]
		);

		$this->add_control(
			'pulse-effect',
			[
				'label' => __( 'Pulse Effect', 'finix' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'yes' => __( 'yes', 'finix' ),
				'no' => __( 'no', 'finix' ),
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 18,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video-button' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_radius',
			[
				'label' => __( 'Icon Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .style-flat.pulse-effect-active .video-button:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .style-flat.pulse-effect-active .video-button:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .style-border.pulse-effect-active .video-button:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .style-border.pulse-effect-active .video-button:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'video_text',
			[
				'label' => __( 'Video Text', 'elementor' ),
				'separator' => 'before',
				'type' => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'elementor' ),
				'label_on' => __( 'Show', 'elementor' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'finix' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'video_text' => 'yes',
				],
                'label_block' => true,
                'default' => __( 'Title', 'finix' ),
			]
		);

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'condition' => [
						'video_text' => 'yes',
					],
				'selector' => '{{WRAPPER}} .video-box .video-text',
			]
		);

		$this->add_control(
			'video_title_color',
			[
				'label' => __( 'Title Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'video_text' => 'yes',
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .video-box .video-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text-position',
			[
				'label'      => __( 'Text Position', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'title-right',
				'condition' => [
					'video_text' => 'yes',
				],
				'options'    => [
					'title-right'    => __( 'Right', 'finix' ),
					'title-bottom'   => __( 'Bottom', 'finix' ),			
				]
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => __( 'Title Spacing', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => [
					'video_text' => 'yes',
				],
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video-box .title-right .video-text' => 'padding-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .video-box .title-bottom .video-text' => 'padding-top: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .video-box .title-right .video-text' => 'padding-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'show_image_overlay',
			[
				'label' => __( 'Image Overlay', 'elementor' ),
				'separator' => 'before',
				'type' => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'elementor' ),
				'label_on' => __( 'Show', 'elementor' ),
			]
		);

		$this->add_control(
			'image_overlay_color',
			[
				'label' => __( 'Overlay Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'show_image_overlay' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .video-box .video-img:before' => 'background-color: {{VALUE}};',
				],
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
					'show_image_overlay' => 'yes',
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
			]
		);

		$this->add_control(
			'image-radius',
			[
				'label' => __( 'Image Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'condition' => [
					'show_image_overlay' => 'yes',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video-box .video-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section(); 
		
		$this->start_controls_section(
			'section_color',
			[
				'label' => __( 'Video Color', 'finix' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->start_controls_tabs( 'video_button_style' );

		$this->start_controls_tab(
			'video_button_normal',
			[
				'label' => __( 'Normal', 'finix' ),
			]
		);

		$this->add_control(
			'video_icon_color',
			[
				'label' => __( 'Icon Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .video-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label' => __( 'Background Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'video-btn-style'=>['style-flat']
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .style-flat .video-button' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .style-flat.pulse-effect-active .video-button:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .style-flat.pulse-effect-active .video-button:after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_border_color',
			[
				'label' => __( 'Border Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'video-btn-style'=>['style-border']
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .style-border .video-button' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .style-border .video-button:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .style-border .video-button:after' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'video_button_hover',
			[
				'label' => __( 'Hover', 'finix' ),
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label' => __( 'Icon Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .video-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_bg_hover_color',
			[
				'label' => __( 'Background Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .style-flat .video-button:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .style-border .video-button:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .style-flat.pulse-effect-active .video-button:hover:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_border_hover_color',
			[
				'label' => __( 'Border Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'video-btn-style'=>['style-border']
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .style-border .video-button:hover' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .style-border .video-button:hover:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .style-border .video-button:hover:after' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

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

		if($settings['show_image_overlay'] == 'yes')
		{
			if ( ! empty( $settings['image']['url'] ) ) 
			{
				$this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
				$this->add_render_attribute( 'image', 'srcset', $settings['image']['url'] );
				$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
				$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );
				$media_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );
			}
		}

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'button', $settings['link'] );
			$this->add_render_attribute( 'button', 'class', 'video-button popup-vimeo' );
			$this->add_render_attribute( 'button', 'title', 'Video' );
			$this->add_render_attribute( 'video_class', 'class', $settings['video-btn-style'] );
			if($settings['video_text'] == 'yes') { 
				$this->add_render_attribute( 'video_class', 'class', $settings['text-position'] );
			}
			if($settings['show_image_overlay'] == 'yes')
			{
				$this->add_render_attribute( 'video_class', 'class', 'video-image' );
			}
		}

		$migrated = isset( $settings['__fa4_migrated']['finix-icon'] );

		if ( $settings['pulse-effect'] == 'yes' ) {
			$this->add_render_attribute( 'video_class', 'class', 'pulse-effect-active' );
		}

		if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// @todo: remove when deprecated
			// added as bc in 2.6
			// add old default
			$settings['icon'] = 'fa fa-plus';
			$settings['icon_active'] = 'fa fa-minus';
			$settings['icon_position'] = $this->get_settings( 'icon_position' );
		}

		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
		$has_icon = ( ! $is_new || ! empty( $settings['finix-icon']['value'] ) );
		?>
		<div class="video-box">
			<?php if($settings['show_image_overlay'] == 'yes') { ?>
				<div class="video-img"><?php echo $media_html; ?></div>
			<?php } ?>
			<div <?php echo $this->get_render_attribute_string( 'video_class' ); ?>>
				<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
					<?php Icons_Manager::render_icon( $settings['finix-icon'] ); ?>
				</a>
				<?php if($settings['video_text'] == 'yes') { ?>
					<span class="video-text"><?php echo sprintf('%1$s',esc_html($settings['title'],'finix')); ?></span>
				<?php } ?>
			</div>
		</div>
		<?php
    }	    	
}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\finix_video() );
?>