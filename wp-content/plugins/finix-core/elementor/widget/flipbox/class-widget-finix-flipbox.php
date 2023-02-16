<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Elementor Blog widget.
 *
 * Elementor widget that displays an eye-catching headlines.
 *
 * @since 1.1.0
 */

class finix_flipbox extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve flipbox widget name.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget name.
	 */

	public function get_name() {
		return __( 'flipbox', 'finix' );
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve flipbox widget title.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */

	public function get_title() {
		return __( 'Flip Box', 'finix' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the flipbox widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */

	public function get_categories() {
		return array( 'finix' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve flipbox widget icon.
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
	 * Register flipbox widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.1.0
	 * @access protected
	 */

	protected function _register_controls() {

		$this->start_controls_section(
			'section',
			array(
				'label' => __( 'Genral Setting', 'finix' ),
			)
		);

		$this->add_control(
			'flipbox-style',
			array(
				'label'   => __( 'Select Style', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'flipbox-1',
				'options' => array(
					'flipbox-1' => __( 'Style 1', 'finix' ),
					'flipbox-2' => __( 'Style 2', 'finix' ),
					'flipbox-3' => __( 'Style 3', 'finix' ),
					'flipbox-4' => __( 'Style 4', 'finix' ),
				),
			)
		);

		$this->add_control(
			'rotate-style',
			array(
				'label'   => __( 'Rotate Style', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'flipbox-top',
				'options' => array(
					'flipbox-top'    => __( 'Top', 'finix' ),
					'flipbox-bottom' => __( 'Bottom', 'finix' ),
					'flipbox-left'   => __( 'Left', 'finix' ),
					'flipbox-right'  => __( 'Right', 'finix' ),
				),
			)
		);

		$this->add_responsive_control(
			'flipbox_height',
			array(
				'label'     => __( 'Flipbox Height', 'finix' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 250,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .flipbox-main .flipbox-inner' => 'min-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'flipbox_padding',
			array(
				'label'      => __( 'Padding', 'finix' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .flipbox-main .flipbox-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'finix' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .flipbox-main .flipbox-content, .flipbox-main .flipbox-content.image-enable:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'shadow',
			array(
				'label'   => __( 'Infobox Shadow', 'finix' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'yes'     => __( 'yes', 'finix' ),
				'no'      => __( 'no', 'finix' ),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'flipbox_shadow',
				'condition' => array(
					'shadow' => array( 'yes' ),
				),
				'selector'  => '{{WRAPPER}} .flipbox-main.shadow-enable .flipbox-content',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'front-section',
			array(
				'label' => __( 'Front Content', 'finix' ),
			)
		);

		$this->add_control(
			'front-finix-icon',
			array(
				'label'            => __( 'Icon', 'finix' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'condition'        => array( 'flipbox-style' => array( 'flipbox-1', 'flipbox-3', 'flipbox-4' ) ),
				'default'          => array(
					'value'   => 'fas fa-plus',
					'library' => 'fa-solid',
				),
				'recommended'      => array(
					'fa-solid'   => array(
						'chevron-down',
						'angle-down',
						'angle-double-down',
						'caret-down',
						'caret-square-down',
					),
					'fa-regular' => array(
						'caret-square-down',
					),
				),
				'skin'             => 'inline',
				'label_block'      => false,
			)
		);

		$this->add_responsive_control(
			'front_icon_size',
			array(
				'label'     => __( 'Icon Size', 'finix' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 40,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 80,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .flipbox-main .flip-front .flipbox-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'front-title',
			array(
				'label'       => __( 'Title', 'finix' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Accordion Title', 'finix' ),
				'condition'   => array( 'flipbox-style' => array( 'flipbox-1', 'flipbox-3' ) ),
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
			)
		);

		$this->add_control(
			'front-title-tag',
			array(
				'label'     => __( 'Title Tag', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'h2',
				'condition' => array( 'flipbox-style' => array( 'flipbox-1', 'flipbox-3' ) ),
				'options'   => array(
					'h2' => __( 'h2', 'finix' ),
					'h3' => __( 'h3', 'finix' ),
					'h4' => __( 'h4', 'finix' ),
					'h5' => __( 'h5', 'finix' ),
					'h6' => __( 'h6', 'finix' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'front-title-typography',
				'label'    => __( 'Sub Title Typography', 'finix' ),
				'selector' => '{{WRAPPER}} .flipbox-main .flip-front .flipbox-title .title',
			)
		);

		$this->add_control(
			'front-description',
			array(
				'label'      => __( 'Description', 'finix' ),
				'type'       => Controls_Manager::TEXTAREA,
				'condition'  => array( 'flipbox-style' => array( 'flipbox-1' ) ),
				'default'    => __( 'Accordion Content', 'finix' ),
				'show_label' => false,
			)
		);

		$this->add_control(
			'front-button',
			array(
				'label'     => __( 'Button', 'elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => array( 'flipbox-style' => array( 'flipbox-2', 'flipbox-4' ) ),
				'label_off' => __( 'OFF', 'elementor' ),
				'label_on'  => __( 'ON', 'elementor' ),
			)
		);

		$this->add_control(
			'front-button-style',
			array(
				'label'     => __( 'Button Style', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-flat',
				'condition' => array(
					'front-button' => 'yes',
				),
				'options'   => array(
					'style-default' => __( 'Default', 'finix' ),
					'style-border' => __( 'Border', 'finix' ),
					'style-flat'   => __( 'Flat', 'finix' ),
				),
			)
		);

		$this->add_control(
			'front-button-hover',
			array(
				'label'     => __( 'Hover Effect', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'hover-default',
				'condition' => array(
					'front-button' => 'yes',
					'front-button-style'=> ['style-border','style-flat']
				),
				'options'   => array(
					'hover-default' 		=> __( 'Default', 'finix' ),
					'hover-slide-top' 		=> __( 'Slide Top', 'finix' ),
					'hover-slide-bottom'  	=> __( 'Slide Bottom', 'finix' ),
					'hover-slide-left'   	=> __( 'Slide Left', 'finix' ),
					'hover-slide-right'   	=> __( 'Slide Right', 'finix' ),
				),
			)
		);

		$this->add_control(
			'front-button-text',
			array(
				'label'       => __( 'Text', 'finix' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'front-button' => 'yes',
				),
				'default'     => __( 'Click here', 'finix' ),
				'placeholder' => __( 'Click here', 'finix' ),
			)
		);

		$this->add_control(
			'front-link',
			array(
				'label'       => __( 'Link', 'finix' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'front-button' => 'yes',
				),
				'placeholder' => __( 'https://your-link.com', 'finix' ),
				'default'     => array(
					'url' => '#',
				),
			)
		);

		$this->add_responsive_control(
			'front_button_spacing',
			array(
				'label'     => __( 'Button Spacing', 'finix' ),
				'type'      => Controls_Manager::SLIDER,
				'condition' => array(
					'front-button' => 'yes',
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .flipbox-main .flip-front .flipbox-btn' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'front_button_padding',
			array(
				'label'      => __( 'Button Padding', 'finix' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'condition'   => array(
					'front-button' => 'yes',
					'front-button-style'=>['style-border','style-flat']
				),
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .flipbox-main .flip-front .flipbox-btn .style-border' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .flipbox-main .flip-front .flipbox-btn .style-flat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'front_button_radius',
			array(
				'label'      => __( 'Border Radius', 'finix' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'condition'   => array(
					'front-button' => 'yes',
					'front-button-style'=>['style-border','style-flat']
				),
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .flipbox-main .flip-front .flipbox-btn .style-border' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .flipbox-main .flip-front .flipbox-btn .style-flat' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'front-media-type',
			array(
				'label'   => __( 'Icon / Image', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'color',
				'options' => array(
					'color' => __( 'Color', 'finix' ),
					'image' => __( 'Image', 'finix' ),
				),
			)
		);

		$this->add_control(
			'front-image',
			array(
				'label'     => __( 'Choose Image', 'finix' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'front-media-type' => 'image',
				),
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'front-image-color',
			array(
				'label'     => __( 'Image Opicity Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'front-media-type' => 'image',
				),
				'selectors' => array(
					'{{WRAPPER}} .flipbox-main .flip-front.image-enable:before' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'front-color',
			array(
				'label'     => __( 'Backround Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'front-media-type' => 'color',
				),
				'selectors' => array(
					'{{WRAPPER}} .flipbox-main .flipbox-content.flip-front' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'front_gradiant_color',
				'label'     => __( 'Gradient Background', 'finix' ),
				'condition' => array(
					'front-media-type' => 'color',
				),
				'types'     => array( 'gradient' ),
				'selector'  => '{{WRAPPER}} .flipbox-main .flipbox-content.flip-front',
			)
		);

		$this->add_responsive_control(
			'front-horizontal-align',
			array(
				'label'   => __( 'Horizontal Alignment', 'finix' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'align-h-left'   => array(
						'title' => __( 'Left', 'finix' ),
						'icon'  => 'eicon-h-align-left',
					),
					'align-h-center' => array(
						'title' => __( 'Center', 'finix' ),
						'icon'  => 'eicon-h-align-center',
					),
					'align-h-right'  => array(
						'title' => __( 'Right', 'finix' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
			)
		);

		$this->add_responsive_control(
			'front-vertical-align',
			array(
				'label'   => __( 'Vertical Alignment', 'finix' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'align-v-top'    => array(
						'title' => __( 'Top', 'finix' ),
						'icon'  => 'eicon-v-align-top',
					),
					'align-v-middle' => array(
						'title' => __( 'Middle', 'finix' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'align-v-bottom' => array(
						'title' => __( 'Bottom', 'finix' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'back-section',
			array(
				'label' => __( 'Back Content', 'finix' ),
			)
		);

		$this->add_control(
			'back-finix-icon',
			array(
				'label'            => __( 'Icon', 'finix' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value'   => 'fas fa-plus',
					'library' => 'fa-solid',
				),
				'condition'        => array( 'flipbox-style' => array( 'flipbox-4' ) ),
				'recommended'      => array(
					'fa-solid'   => array(
						'chevron-down',
						'angle-down',
						'angle-double-down',
						'caret-down',
						'caret-square-down',
					),
					'fa-regular' => array(
						'caret-square-down',
					),
				),
				'skin'             => 'inline',
				'label_block'      => false,
			)
		);

		$this->add_responsive_control(
			'back_icon_size',
			array(
				'label'     => __( 'Icon Size', 'finix' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 40,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 80,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .flipbox-main .flip-back .flipbox-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'back-title',
			array(
				'label'       => __( 'Title', 'finix' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Accordion Title', 'finix' ),
				'condition'   => array( 'flipbox-style' => array( 'flipbox-2', 'flipbox-4' ) ),
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
			)
		);

		$this->add_control(
			'back-title-tag',
			array(
				'label'     => __( 'Title Tag', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'condition' => array( 'flipbox-style' => array( 'flipbox-2', 'flipbox-4' ) ),
				'default'   => 'h2',
				'options'   => array(
					'h2' => __( 'h2', 'finix' ),
					'h3' => __( 'h3', 'finix' ),
					'h4' => __( 'h4', 'finix' ),
					'h5' => __( 'h5', 'finix' ),
					'h6' => __( 'h6', 'finix' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'back-title-typography',
				'label'    => __( 'Button Typography', 'finix' ),
				'selector' => '{{WRAPPER}} .flipbox-main .flip-back .flipbox-btn > a',
			)
		);

		$this->add_control(
			'back-description',
			array(
				'label'      => __( 'Description', 'finix' ),
				'type'       => Controls_Manager::TEXTAREA,
				'condition'  => array( 'flipbox-style' => array( 'flipbox-2', 'flipbox-3', 'flipbox-4' ) ),
				'default'    => __( 'Accordion Content', 'finix' ),
				'show_label' => false,
			)
		);

		$this->add_control(
			'back-button',
			array(
				'label'     => __( 'Button', 'elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'OFF', 'elementor' ),
				'label_on'  => __( 'ON', 'elementor' ),
			)
		);

		$this->add_control(
			'back-button-style',
			array(
				'label'     => __( 'Button Style', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-flat',
				'condition' => array(
					'back-button' => 'yes',
				),
				'options'   => array(
					'style-default' => __( 'Default', 'finix' ),
					'style-border' => __( 'Border', 'finix' ),
					'style-flat'   => __( 'Flat', 'finix' ),
				),
			)
		);

		$this->add_control(
			'back-button-hover',
			array(
				'label'     => __( 'Hover Effect', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'hover-default',
				'condition' => array(
					'back-button' => 'yes',
					'back-button-style'=> ['style-border','style-flat']
				),
				'options'   => array(
					'hover-default' 		=> __( 'Default', 'finix' ),
					'hover-slide-top' 		=> __( 'Slide Top', 'finix' ),
					'hover-slide-bottom'  	=> __( 'Slide Bottom', 'finix' ),
					'hover-slide-left'   	=> __( 'Slide Left', 'finix' ),
					'hover-slide-right'   	=> __( 'Slide Right', 'finix' ),
				),
			)
		);

		$this->add_control(
			'back-button-text',
			array(
				'label'       => __( 'Text', 'finix' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'back-button' => 'yes',
				),
				'default'     => __( 'Click here', 'finix' ),
				'placeholder' => __( 'Click here', 'finix' ),
			)
		);

		$this->add_control(
			'back-link',
			array(
				'label'       => __( 'Link', 'finix' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'back-button' => 'yes',
				),
				'placeholder' => __( 'https://your-link.com', 'finix' ),
				'default'     => array(
					'url' => '#',
				),
			)
		);

		$this->add_responsive_control(
			'back_button_spacing',
			array(
				'label'     => __( 'Button Spacing', 'finix' ),
				'type'      => Controls_Manager::SLIDER,
				'condition' => array(
					'back-button' => 'yes',
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .flipbox-main .flip-back .flipbox-btn' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'back_button_padding',
			array(
				'label'      => __( 'Button Padding', 'finix' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'condition'   => array(
					'back-button' => 'yes',
					'back-button-style'=>['style-border','style-flat']
				),
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .flipbox-main .flip-back .flipbox-btn .style-border' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .flipbox-main .flip-back .flipbox-btn .style-flat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'back_button_radius',
			array(
				'label'      => __( 'Border Radius', 'finix' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'condition'   => array(
					'back-button' => 'yes',
					'back-button-style'=>['style-border','style-flat']
				),
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .flipbox-main .flip-back .flipbox-btn .style-border' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .flipbox-main .flip-back .flipbox-btn .style-flat' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'back-media-type',
			array(
				'label'   => __( 'Icon / Image', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'color',
				'options' => array(
					'color' => __( 'Color', 'finix' ),
					'image' => __( 'Image', 'finix' ),
				),
			)
		);

		$this->add_control(
			'back-image',
			array(
				'label'     => __( 'Choose Image', 'finix' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'back-media-type' => 'image',
				),
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'back-image-color',
			array(
				'label'     => __( 'Image Opicity Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'back-media-type' => 'image',
				),
				'selectors' => array(
					'{{WRAPPER}} .flipbox-main .flip-back.image-enable:before' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'back-color',
			array(
				'label'     => __( 'Background Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'back-media-type' => 'color',
				),
				'selectors' => array(
					'{{WRAPPER}} .flipbox-main .flipbox-content' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'back_gradiant_color',
				'label'     => __( 'Gradient Background', 'finix' ),
				'condition' => array(
					'back-media-type' => 'color',
				),
				'types'     => array( 'gradient' ),
				'selector'  => '{{WRAPPER}} .flipbox-main .flipbox-content.flip-back',
			)
		);

		$this->add_responsive_control(
			'back-horizontal-align',
			array(
				'label'   => __( 'Horizontal Alignment', 'finix' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'align-h-left'   => array(
						'title' => __( 'Left', 'finix' ),
						'icon'  => 'eicon-h-align-left',
					),
					'align-h-center' => array(
						'title' => __( 'Center', 'finix' ),
						'icon'  => 'eicon-h-align-center',
					),
					'align-h-right'  => array(
						'title' => __( 'Right', 'finix' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
			)
		);

		$this->add_responsive_control(
			'back-vertical-align',
			array(
				'label'   => __( 'Vertical Alignment', 'finix' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'align-v-top'    => array(
						'title' => __( 'Top', 'finix' ),
						'icon'  => 'eicon-v-align-top',
					),
					'align-v-middle' => array(
						'title' => __( 'Middle', 'finix' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'align-v-bottom' => array(
						'title' => __( 'Bottom', 'finix' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'front_section_color',
			array(
				'label' => __( 'Front Color', 'finix' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'front-icon-color',
			array(
				'label'     => __( 'Icon Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'flipbox-style'=>['flipbox-1','flipbox-3','flipbox-4']
				],
				'selectors' => array(
					'{{WRAPPER}} .flipbox-main .flip-front .flipbox-icon i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'front-title-color',
			array(
				'label'     => __( 'Title Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'flipbox-style'=>['flipbox-1','flipbox-3']
				],
				'selectors' => array(
					'{{WRAPPER}} .flipbox-main .flip-front .flipbox-title .title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'front-description-color',
			array(
				'label'     => __( 'Description Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'flipbox-style'=>['flipbox-1']
				],
				'selectors' => array(
					'{{WRAPPER}} .flipbox-main .flip-front .flipbox-description' => 'color: {{VALUE}};',
				),
			)
		);

		$this->start_controls_tabs( 
			'front_tabs_button_style',
			array(
				'condition' => [
					'flipbox-style'=>['flipbox-2','flipbox-4']
				],
			)
		);
	
			$this->start_controls_tab(
				'front_tab_button_normal',
				[
					'label' => __( 'Normal', 'finix' ),
				]
			);


			$this->add_control(
				'front_normal_text_color',
				[
					'label' => __( 'Text Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .flipbox-main .flip-front .flipbox-btn > a' => 'color: {{VALUE}};',
						'{{WRAPPER}} .flipbox-main .flip-front .flipbox-btn .style-default:after' => 'background: {{VALUE}};',
						'{{WRAPPER}} .flipbox-main .flip-front .flipbox-btn .style-default:before' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'front_normal_bg_color',
				[
					'label' => __( 'BG Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'condition' => [
						'front-button-style'=>['style-flat']
					],
					'selectors' => [
						'{{WRAPPER}} .flipbox-main .flip-front .flipbox-btn .style-flat' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'      => 'front_normal_gradiant_color',
					'label'     => __( 'Gradient Background', 'finix' ),
					'condition' => [
						'front-button-style'=>['style-flat']
					],
					'types'     => array( 'gradient' ),
					'selector'  => '{{WRAPPER}} .flipbox-main .flip-front .flipbox-btn .style-flat',
				)
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'front_tab_button_hover',
				[
					'label' => __( 'Hover', 'finix' ),
				]
			);

			$this->add_control(
				'front_hover_text_color',
				[
					'label' => __( 'Text Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .flipbox-main .flip-front .flipbox-btn > a:hover' => 'color: {{VALUE}};',
						'{{WRAPPER}} .flipbox-main .flip-front .flipbox-btn .style-default:hover:after' => 'background: {{VALUE}};',
						'{{WRAPPER}} .flipbox-main .flip-front .flipbox-btn .style-default:hover:before' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'front_hover_border_color',
				[
					'label' => __( 'Border Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'condition' => [
						'front-button-style'=>['style-border']
					],
					'selectors' => [
						'{{WRAPPER}} .flipbox-main .flip-front .flipbox-btn .style-border:hover' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'front_hover_bg_color',
				[
					'label' => __( 'BG Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'condition' => [
						'front-button-style'=>['style-border','style-flat']
					],
					'selectors' => [
						'{{WRAPPER}} .flipbox-main .flip-front .flipbox-btn .style-border:before' => 'background: {{VALUE}};',
						'{{WRAPPER}} .flipbox-main .flip-front .flipbox-btn .style-flat:before' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'      => 'front_normal_hover_gradiant_color',
					'label'     => __( 'Gradient Background', 'finix' ),
					'condition' => [
						'front-button-style'=>['style-flat']
					],
					'types'     => array( 'gradient' ),
					'selector'  => '{{WRAPPER}} .flipbox-main .flip-front .flipbox-btn .style-flat:before',
				)
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'back_section_color',
			array(
				'label' => __( 'Back Color', 'finix' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'back-icon-color',
			array(
				'label'     => __( 'Icon Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'flipbox-style'=>['flipbox-0']
				],
				'selectors' => array(
					'{{WRAPPER}} .flipbox-main .flip-back .flipbox-icon i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'back-title-color',
			array(
				'label'     => __( 'Title Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'flipbox-style'=>['flipbox-2','flipbox-4']
				],
				'selectors' => array(
					'{{WRAPPER}} .flipbox-main .flip-back .flipbox-title .title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'back-description-color',
			array(
				'label'     => __( 'Description Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'flipbox-style'=>['flipbox-2','flipbox-3','flipbox-4']
				],
				'selectors' => array(
					'{{WRAPPER}} .flipbox-main .flip-back .flipbox-description' => 'color: {{VALUE}};',
				),
			)
		);

		$this->start_controls_tabs(
			'tabs_button_style',
			array(
				'condition' => [
					'flipbox-style'=>['flipbox-1','flipbox-3','flipbox-4']
				],
			)
		);
	
			$this->start_controls_tab(
				'tab_button_normal',
				[
					'label' => __( 'Normal', 'finix' ),
				]
			);

			$this->add_control(
				'normal_text_color',
				[
					'label' => __( 'Text Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .flipbox-main .flip-back .flipbox-btn > a' => 'color: {{VALUE}};',
						'{{WRAPPER}} .flipbox-main .flip-back .flipbox-btn .style-default:after' => 'background: {{VALUE}};',
						'{{WRAPPER}} .flipbox-main .flip-back .flipbox-btn .style-default:before' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'normal_bg_color',
				[
					'label' => __( 'BG Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'condition' => [
						'back-button-style'=>['style-flat']
					],
					'selectors' => [
						'{{WRAPPER}} .flipbox-main .flip-back .flipbox-btn .style-flat' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'      => 'normal_gradiant_color',
					'label'     => __( 'Gradient Background', 'finix' ),
					'condition' => [
						'back-button-style'=>['style-flat']
					],
					'types'     => array( 'gradient' ),
					'selector'  => '{{WRAPPER}} .flipbox-main .flip-back .flipbox-btn .style-flat',
				)
			);


			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_button_hover',
				[
					'label' => __( 'Hover', 'finix' ),
				]
			);

			$this->add_control(
				'hover_text_color',
				[
					'label' => __( 'Text Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .flipbox-main .flip-back .flipbox-btn > a:hover' => 'color: {{VALUE}};',
						'{{WRAPPER}} .flipbox-main .flip-back .flipbox-btn .style-default:hover:after' => 'background: {{VALUE}};',
						'{{WRAPPER}} .flipbox-main .flip-back .flipbox-btn .style-default:hover:before' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'hover_border_color',
				[
					'label' => __( 'Border Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'condition' => [
						'back-button-style'=>['style-border']
					],
					'selectors' => [
						'{{WRAPPER}} .flipbox-main .flip-back .flipbox-btn .style-border:hover' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'hover_bg_color',
				[
					'label' => __( 'BG Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'condition' => [
						'back-button-style'=>['style-border','style-flat']
					],
					'selectors' => [
						'{{WRAPPER}} .flipbox-main .flip-back .flipbox-btn .style-border:before' => 'background: {{VALUE}};',
						'{{WRAPPER}} .flipbox-main .flip-back .flipbox-btn .style-flat:before' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'      => 'normal_hover_gradiant_color',
					'label'     => __( 'Gradient Background', 'finix' ),
					'condition' => [
						'back-button-style'=>['style-flat']
					],
					'types'     => array( 'gradient' ),
					'selector'  => '{{WRAPPER}} .flipbox-main .flip-back .flipbox-btn .style-flat:before',
				)
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

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

		if ( $settings['front-button'] == 'yes' ) {
			$this->add_link_attributes( 'front-button', $settings['front-link'] );
			$this->add_render_attribute( 'front-button', 'class', $settings['front-button-style'] );
			$this->add_render_attribute( 'front-button', 'class', $settings['front-button-hover'] );
		}

		if ( $settings['back-button'] == 'yes' ) {
			$this->add_link_attributes( 'back-button', $settings['back-link'] );
			$this->add_render_attribute( 'back-button', 'class', $settings['back-button-style'] );
			$this->add_render_attribute( 'back-button', 'class', $settings['back-button-hover'] );
		}

		$this->add_render_attribute( 'flipbox', 'class', 'flipbox-main' );
		$this->add_render_attribute( 'flipbox', 'class', $settings['flipbox-style'] );
		$this->add_render_attribute( 'flipbox', 'class', $settings['rotate-style'] );

		if ( $settings['shadow'] == 'yes' ) {
			$this->add_render_attribute( 'flipbox', 'class', 'shadow-enable' );
		}

		$migrated = isset( $settings['__fa4_migrated']['front-finix-icon'] );

		if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// @todo: remove when deprecated
			// added as bc in 2.6
			// add old default
			$settings['icon']          = 'fa fa-plus';
			$settings['icon_active']   = 'fa fa-minus';
			$settings['icon_position'] = $this->get_settings( 'icon_position' );
		}

		$is_new   = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
		$has_icon = ( ! $is_new || ! empty( $settings['front-finix-icon']['value'] ) );

		$migrated = isset( $settings['__fa4_migrated']['back-finix-icon'] );

		if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// @todo: remove when deprecated
			// added as bc in 2.6
			// add old default
			$settings['icon']          = 'fa fa-plus';
			$settings['icon_active']   = 'fa fa-minus';
			$settings['icon_position'] = $this->get_settings( 'icon_position' );
		}

		$is_new   = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
		$has_icon = ( ! $is_new || ! empty( $settings['back-finix-icon']['value'] ) );

		$this->add_render_attribute( 'front-flipbox', 'class', 'flipbox-content flip-front' );
		$this->add_render_attribute( 'front-flipbox', 'class', $settings['front-horizontal-align'] );
		$this->add_render_attribute( 'front-flipbox', 'class', $settings['front-vertical-align'] );
		if ( $settings['front-media-type'] == 'image' ) {
			$this->add_render_attribute( 'front-flipbox', 'class', 'image-enable' );
		}

		$this->add_render_attribute( 'back-flipbox', 'class', 'flipbox-content flip-back' );
		$this->add_render_attribute( 'back-flipbox', 'class', $settings['back-horizontal-align'] );
		$this->add_render_attribute( 'back-flipbox', 'class', $settings['back-vertical-align'] );
		if ( $settings['back-media-type'] == 'image' ) {
			$this->add_render_attribute( 'back-flipbox', 'class', 'image-enable' );
		}

		if ( $settings['front-media-type'] == 'image' ) {
			if ( ! empty( $settings['front-image']['url'] ) ) {
				$front_image = $settings['front-image']['url'];
			}
		}

		if ( $settings['back-media-type'] == 'image' ) {
			if ( ! empty( $settings['back-image']['url'] ) ) {
				$back_image = $settings['back-image']['url'];
			}
		}
		?>

	<div <?php echo $this->get_render_attribute_string( 'flipbox' ); ?>>
		<div class="main-inner">
			<div <?php echo $this->get_render_attribute_string( 'front-flipbox' ); ?> <?php
			if ( $settings['front-media-type'] == 'image' ) {

				?>
	 style="background-image: url( <?php echo $front_image; ?> );" <?php } ?>>
				<div class="flipbox-inner">
					<?php if ( $settings['flipbox-style'] == 'flipbox-1' || $settings['flipbox-style'] == 'flipbox-3' || $settings['flipbox-style'] == 'flipbox-4' ) { ?>
					<div class="flipbox-icon"><?php Icons_Manager::render_icon( $settings['front-finix-icon'] ); ?></div>
					<?php } ?>
					<?php
					if ( $settings['flipbox-style'] == 'flipbox-1' || $settings['flipbox-style'] == 'flipbox-3' ) {
						if ( $settings['front-title'] ) {
							?>
						<div class="flipbox-title"><<?php echo $settings['front-title-tag']; ?> class="title"><?php echo sprintf( '%1$s', esc_html( $settings['front-title'], 'finix' ) ); ?></<?php echo $settings['front-title-tag']; ?>></div>
							<?php
						}
					}
					?>
					<?php
					if ( $settings['flipbox-style'] == 'flipbox-1' ) {
						if ( $settings['front-description'] ) {
							?>
					<div class="flipbox-description"><?php echo sprintf( '%1$s', esc_html( $settings['front-description'], 'finix' ) ); ?></div>
							<?php
						}
					}
					?>
					<?php if ( $settings['front-button'] == 'yes' ) { ?>
					<div class="flipbox-btn"><a <?php echo $this->get_render_attribute_string( 'front-button' ); ?>><?php echo sprintf( '%1$s', esc_html( $settings['front-button-text'], 'finix' ) ); ?></a></div>
					<?php } ?>
				</div>
			</div>
			<div <?php echo $this->get_render_attribute_string( 'back-flipbox' ); ?> <?php
			if ( $settings['back-media-type'] == 'image' ) {

				?>
	 style="background-image: url( <?php echo $back_image; ?> );" <?php } ?>>
				<div class="flipbox-inner">
					<?php if ( $settings['flipbox-style'] == 'flipbox-4' ) { ?>
					<div class="flipbox-icon"><?php Icons_Manager::render_icon( $settings['back-finix-icon'] ); ?></div>
					<?php } ?>
					<?php
					if ( $settings['flipbox-style'] == 'flipbox-2' || $settings['flipbox-style'] == 'flipbox-4' ) {
						if ( $settings['back-title'] ) {
							?>
						<div class="flipbox-title"><<?php echo $settings['back-title-tag']; ?> class="title"><?php echo sprintf( '%1$s', esc_html( $settings['back-title'], 'finix' ) ); ?></<?php echo $settings['back-title-tag']; ?>></div>
							<?php
						}
					}
					?>
					<?php
					if ( $settings['flipbox-style'] == 'flipbox-2' || $settings['flipbox-style'] == 'flipbox-3' || $settings['flipbox-style'] == 'flipbox-4' ) {
						if ( $settings['back-description'] ) {
							?>
					<div class="flipbox-description"><?php echo sprintf( '%1$s', esc_html( $settings['back-description'], 'finix' ) ); ?></div>
							<?php
						}
					}
					?>
					<?php if ( $settings['back-button'] == 'yes' ) { ?>
					<div class="flipbox-btn"><a <?php echo $this->get_render_attribute_string( 'back-button' ); ?>><?php echo sprintf( '%1$s', esc_html( $settings['back-button-text'], 'finix' ) ); ?></a></div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\finix_flipbox() );
?>
