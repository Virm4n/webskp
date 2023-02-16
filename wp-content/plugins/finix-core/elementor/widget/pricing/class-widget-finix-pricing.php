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

class finix_pricing extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve pricing widget name.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget name.
	 */

	public function get_name() {
		return __( 'finix_pricing', 'finix' );
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve pricing widget title.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */

	public function get_title() {
		return __( 'Pricing Table', 'finix' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the pricing widget belongs to.
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
	 * Retrieve pricing widget icon.
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
	 * Register pricing widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.1.0
	 * @access protected
	 */

	protected function _register_controls() {

		$this->start_controls_section(
			'genral_setting',
			array(
				'label' => __( 'Genral Setting', 'finix' ),
			)
		);

		$this->add_control(
			'pricing-style',
			array(
				'label'   => __( 'Select Style', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'pricing-1',
				'options' => array(
					'pricing-1' => __( 'Style 1', 'finix' ),
					'pricing-2' => __( 'Style 2', 'finix' ),
					'pricing-3' => __( 'Style 3', 'finix' ),
					'pricing-4' => __( 'Style 4', 'finix' ),
				),
			)
		);

		$this->add_control(
			'price_active',
			array(
				'label'     => __( 'Pricing Highlite', 'elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Off', 'elementor' ),
				'label_on'  => __( 'On', 'elementor' ),
			)
		);

		$this->add_control(
			'pricing1_selected_color',
			array(
				'label'     => __( 'Border Top Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'price_active'  => array( 'yes' ),
					'pricing-style' => array( 'pricing-1'),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pricing-table.pricing-1.selected' => 'border-top-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'pricing1_selected_bg_color',
			array(
				'label'     => __( 'Background Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'price_active'  => array( 'yes' ),
					'pricing-style' => array( 'pricing-1'),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pricing-table.pricing-1.selected' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'pricing_background_normal_color',
			array(
				'label'     => __( 'Background Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'pricing-style' => array( 'pricing-3', 'pricing-2' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pricing-table.pricing-2' => 'background: {{VALUE}};',
					'{{WRAPPER}} .pricing-table.pricing-3' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'pricing4_background_color',
			array(
				'label'     => __( 'Box Background Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'pricing-style' => array( 'pricing-4' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pricing-table.pricing-4' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'value_gradiant_color',
				'label'     => __( 'Gradient Background', 'finix' ),
				'condition' => array(
					'price_active'  => array( 'yes' ),
					'pricing-style' => array( 'pricing-2', 'pricing-3', 'pricing-4' ),
				),
				'types'     => array( 'gradient' ),
				'selector'  => '{{WRAPPER}} .pricing-table.pricing-2.selected, {{WRAPPER}} .pricing-table.pricing-3.selected, .pricing-table.pricing-4.selected .pricing-header',
			)
		);

		$this->add_control(
			'pricing3_selected_color',
			array(
				'label'     => __( 'Border Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'pricing-style' => array( 'pricing-3' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pricing-table.pricing-3' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'pricing_selected4_color',
			array(
				'label'     => __( 'Background Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'pricing-style' => array( 'pricing-4' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pricing-table.pricing-4 .pricing-header' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'highlite_label',
			array(
				'label'     => __( 'Highlite Label', 'elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'separator'   => 'before',
				'label_off' => __( 'Off', 'elementor' ),
				'label_on'  => __( 'On', 'elementor' ),
				'condition' => array(
					'price_active'  => array( 'yes' ),
				),
			)
		);

		$this->add_control(
			'highlite_title',
			array(
				'label'       => __( 'Highlite Title', 'finix' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'condition' => array(
					'highlite_label'  => array( 'yes' ),
				),
				'label_block' => true,
				'default'     => __( 'Popular', 'finix' ),
			)
		);

		$this->add_control(
			'highlite_title_color',
			array(
				'label'     => __( 'Title Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'highlite_label'  => array( 'yes' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pricing-table .highlite-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'highlite_title_bg_color',
			array(
				'label'     => __( 'Title Background', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'highlite_label'  => array( 'yes' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pricing-table .highlite-title' => 'background: {{VALUE}};',
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
					'{{WRAPPER}} .pricing-table.pricing-1.selected' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .pricing-table.pricing-2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .pricing-table.pricing-3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .pricing-table.pricing-4' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'pricing_header',
			array(
				'label' => __( 'Pricing Header', 'finix' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Pricing Title', 'finix' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
				'default'     => __( 'Section Title', 'finix' ),
			)
		);

		$this->add_control(
			'title_tag',
			array(
				'label'   => __( 'Title Tag', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => array(
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
				'name'     => 'header-typography',
				'selector' => '{{WRAPPER}} .pricing-table .pricing-title',
			)
		);

		$this->add_control(
			'header_title_color',
			array(
				'label'     => __( 'Title Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pricing-table .pricing-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'pricing4_background_normal_color',
			array(
				'label'     => __( 'Background Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'pricing-style' => array( 'pricing-4' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pricing-table.pricing-4 .pricing-title' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'finix-icon',
			array(
				'label'            => __( 'Icon', 'finix' ),
				'type'             => Controls_Manager::ICONS,
				'separator'        => 'before',
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value'   => 'fas fa-plus',
					'library' => 'fa-solid',
				),
				'skin'             => 'inline',
				'label_block'      => false,
			)
		);

		$this->add_control(
			'header_icon_color',
			array(
				'label'     => __( 'Icon Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pricing-table .pricing-icon i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'price_input',
			array(
				'label'       => __( 'Price Input', 'finix' ),
				'type'        => Controls_Manager::TEXT,
				'separator'   => 'before',
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
				'default'     => __( '$45', 'finix' ),
			)
		);

		$this->add_control(
			'header_price_color',
			array(
				'label'     => __( 'Price Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pricing-table .pricing-price' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'price_interval',
			array(
				'label'       => __( 'Price Interval', 'finix' ),
				'type'        => Controls_Manager::TEXT,
				'separator'        => 'before',
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
				'default'     => __( 'Per Month', 'finix' ),

			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pricing-typography',
				'selector' => '{{WRAPPER}} .pricing-table .pricing-price',
			)
		);

		$this->add_control(
			'header_interval_color',
			array(
				'label'     => __( 'Interval Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pricing-table .pricing-price > span' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'header_icon_size',
			array(
				'label'     => __( 'Icon Size', 'finix' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 50,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .pricing-table .pricing-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'align',
			array(
				'label'     => __( 'Alignment', 'finix' ),
				'type'      => Controls_Manager::CHOOSE,
				'condition' => array(
					'pricing-style' => array( 'pricing-1', 'pricing-2' ),
				),
				'options'   => array(
					'text-left'   => array(
						'title' => __( 'Left', 'finix' ),
						'icon'  => 'eicon-text-align-left',
					),
					'text-center' => array(
						'title' => __( 'Center', 'finix' ),
						'icon'  => 'eicon-text-align-center',
					),
					'text-right'  => array(
						'title' => __( 'Right', 'finix' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'pricing_items',
			array(
				'label' => __( 'Pricing Items', 'finix' ),
			)
		);

		$this->add_control(
			'icon-position',
			array(
				'label'   => __( 'Select Icon Position', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon-left',
				'options' => array(
					'icon-left'   => __( 'Left', 'finix' ),
					'icon-right	' => __( 'Right', 'finix' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'item-typography',
				'selector' => '{{WRAPPER}} .pricing-table .pricing-list li',
			)
		);

		$this->add_control(
			'item_text_color',
			array(
				'label'     => __( 'Text Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pricing-table .pricing-list li' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'item_border_color',
			array(
				'label'     => __( 'Border Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'separator'        => 'after',
				'condition' => array(
					'pricing-style' => array( 'pricing-1', 'pricing-2', 'pricing-3' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .pricing-table.pricing-1 .pricing-header' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .pricing-table.pricing-2 .pricing-list li' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .pricing-table.pricing-3 .pricing-header' => 'border-bottom-color: {{VALUE}};',
				),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title',
			array(
				'label'       => __( 'Title', 'finix' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Tab Title', 'finix' ),
				'placeholder' => __( 'Tab Title', 'finix' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'tab-icon',
			array(
				'label'            => __( 'Icon', 'finix' ),
				'type'             => Controls_Manager::ICONS,
				'separator'        => 'before',
				'fa4compatibility' => 'icon',
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
				'svg'              => false,
			)
		);

		$repeater->add_control(
			'item_icon_color',
			array(
				'label'     => __( 'Icon Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pricing-table .pricing-list li{{CURRENT_ITEM}} i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tabs',
			array(
				'label'       => __( 'Tabs Items', 'finix' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'tab_title' => __( 'Tab #1', 'finix' ),
					),
					array(
						'tab_title' => __( 'Tab #2', 'finix' ),
					),
					array(
						'tab_title' => __( 'Tab #3', 'finix' ),
					),
				),
				'title_field' => '{{{ tab_title }}}',
			)
		);

		$this->add_control(
			'header_item_spacing',
			array(
				'label'     => __( 'Itam Spacing', 'finix' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 15,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .pricing-table .pricing-list li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pricing-table.pricing-2 .pricing-list li' => 'padding-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pricing-table.pricing-4 .pricing-list li' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// $this->add_control(
		// 'item_text_color',
		// [
		// 'label' => __( 'Text Color', 'finix' ),
		// 'type' => Controls_Manager::COLOR,
		// 'default' => '',
		// 'selectors' => [
		// '{{WRAPPER}} .pricing-table .pricing-list li' => 'color: {{VALUE}};',
		// ],
		// ]
		// );

		// $this->add_control(
		// 'item_icon_color',
		// [
		// 'label' => __( 'Icon Color', 'finix' ),
		// 'type' => Controls_Manager::COLOR,
		// 'default' => '',
		// 'selectors' => [
		// '{{WRAPPER}} .pricing-table .pricing-list li i' => 'color: {{VALUE}};',
		// ],
		// ]
		// );

		$this->add_responsive_control(
			'item_align',
			array(
				'label'     => __( 'Alignment', 'finix' ),
				'type'      => Controls_Manager::CHOOSE,
				'condition' => array(
					'pricing-style' => array( 'pricing-1', 'pricing-2' ),
				),
				'options'   => array(
					'text-left'   => array(
						'title' => __( 'Left', 'finix' ),
						'icon'  => 'eicon-text-align-left',
					),
					'text-center' => array(
						'title' => __( 'Center', 'finix' ),
						'icon'  => 'eicon-text-align-center',
					),
					'text-right'  => array(
						'title' => __( 'Right', 'finix' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'pricing_button',
			array(
				'label' => __( 'Pricing Button', 'finix' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'button',
			array(
				'label'     => __( 'Button', 'elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'OFF', 'elementor' ),
				'label_on'  => __( 'ON', 'elementor' ),
			)
		);

		$this->add_control(
			'button-text',
			array(
				'label'       => __( 'Text', 'finix' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'button' => 'yes',
				),
				'default'     => __( 'Click here', 'finix' ),
				'placeholder' => __( 'Click here', 'finix' ),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'       => __( 'Link', 'finix' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'button' => 'yes',
				),
				'placeholder' => __( 'https://your-link.com', 'finix' ),
				'default'     => array(
					'url' => '#',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button-typography',
				'selector' => '{{WRAPPER}} .pricing-table .pricing-button .pricing-btn',
			)
		);

		$this->add_control(
			'button-style',
			array(
				'label'     => __( 'Button Style', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-flat',
				'condition' => array(
					'button' => 'yes',
				),
				'options'   => array(
					'style-border' => __( 'Border', 'finix' ),
					'style-flat'   => __( 'Flat', 'finix' ),
				),
			)
		);

		$this->add_control(
			'button_radius',
			array(
				'label'      => __( 'Border Radius', 'finix' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'condition'  => array(
					'button'       => 'yes',
					'button-style' => array( 'style-border', 'style-flat' ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .pricing-table .pricing-button .pricing-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_align',
			array(
				'label'     => __( 'Alignment', 'finix' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'text-left'    => array(
						'title' => __( 'Left', 'finix' ),
						'icon'  => 'eicon-text-align-left',
					),
					'text-center'  => array(
						'title' => __( 'Center', 'finix' ),
						'icon'  => 'eicon-text-align-center',
					),
					'text-right'   => array(
						'title' => __( 'Right', 'finix' ),
						'icon'  => 'eicon-text-align-right',
					),
					'text-justify' => array(
						'title' => __( 'Justified', 'finix' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'default'   => '',
				'condition' => array(
					'button'        => 'yes',
					'pricing-style' => array( 'pricing-1', 'pricing-2' ),
				),
				'selectors' => array(
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_color',
			array(
				'label' => __( 'Button Color', 'finix' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

			$this->start_controls_tab(
				'pricing_tab_normal',
				array(
					'label' => __( 'Normal', 'finix' ),
				)
			);

			$this->add_control(
				'pricing_button_color',
				array(
					'label'     => __( 'Text Color', 'finix' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} .pricing-table .pricing-button .pricing-btn' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'pricing_button_bg',
				array(
					'label'     => __( 'Background Color', 'finix' ),
					'type'      => Controls_Manager::COLOR,
					'condition' => array(
						'button'       => 'yes',
						'button-style' => array( 'style-flat' ),
					),
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} .pricing-table .pricing-button .style-flat' => 'background: {{VALUE}};',
					),
				)
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'pricing_tab_hover',
				array(
					'label' => __( 'Hover', 'finix' ),
				)
			);

			$this->add_control(
				'pricing_hover_color',
				array(
					'label'     => __( 'Hover Color', 'finix' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .pricing-table .pricing-button .pricing-btn:hover' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'pricing_button_bg_hover',
				array(
					'label'     => __( 'Background Hover Color', 'finix' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} .pricing-table .pricing-button .style-border:hover' => 'background: {{VALUE}};',
						'{{WRAPPER}} .pricing-table .pricing-button .style-flat:hover' => 'background: {{VALUE}};',
					),
				)
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

		$align = $settings['align'];

		$item_align = $settings['item_align'];

		$btn_align = $settings['button_align'];

		$tabs = $this->get_settings_for_display( 'tabs' );

		$id_int = substr( $this->get_id_int(), 0, 3 );

		$migrated = isset( $settings['__fa4_migrated']['finix-icon'] );

		if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// @todo: remove when deprecated
			// added as bc in 2.6
			// add old default
			$settings['icon']          = 'fa fa-plus';
			$settings['icon_active']   = 'fa fa-minus';
			$settings['icon_position'] = $this->get_settings( 'icon_position' );
		}

		$is_new   = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
		$has_icon = ( ! $is_new || ! empty( $settings['finix-icon']['value'] ) );

		$icon_position = sprintf( '%1$s', esc_html( $settings['icon-position'], 'finix' ) );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'button', $settings['link'] );
			$this->add_render_attribute( 'button', 'class', 'pricing-btn' );
			$this->add_render_attribute( 'button', 'class', $settings['button-style'] );
		}

		$this->add_render_attribute( 'pricing', 'class', 'pricing-table' );
		$this->add_render_attribute( 'pricing', 'class', $settings['pricing-style'] );

		if ( $settings['price_active'] == 'yes' ) {
			$this->add_render_attribute( 'pricing', 'class', 'selected' );
		}
		?>
		<div <?php echo $this->get_render_attribute_string( 'pricing' ); ?>>
			<header class="pricing-header <?php echo esc_attr( $align ); ?>">
				<?php if($settings['highlite_label'] == 'yes') { ?>
					  <div class="highlite-title"><?php echo sprintf( '%1$s', esc_html( $settings['highlite_title'], 'finix' ) ); ?></div>
				<?php } ?>
				<?php if ( $settings['title'] ) { ?>
					  <<?php echo $settings['title_tag']; ?> class="pricing-title"><?php echo sprintf( '%1$s', esc_html( $settings['title'], 'finix' ) ); ?></<?php echo $settings['title_tag']; ?>>
				<?php } ?>
				<div class="pricing-icon"><?php Icons_Manager::render_icon( $settings['finix-icon'] ); ?></div>
				<div class="pricing-price"><?php echo sprintf( '%1$s', esc_html( $settings['price_input'], 'finix' ) ); ?><span>
				<?php echo sprintf( '%1$s', esc_html( $settings['price_interval'], 'finix' ) ); ?></span></div>
			</header>
			<div class="pricing-content <?php echo esc_attr( $item_align ); ?>">
				<ul class="pricing-list <?php echo $icon_position; ?>">
					<?php
					foreach ( $tabs as $index => $item ) {
						$migrated = isset( $item['__fa4_migrated']['tab-icon'] );

						$tab_count = $index + 1;

						if ( ! isset( $item['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
							// @todo: remove when deprecated
							// added as bc in 2.6
							// add old default
							$item['icon']        = 'fa fa-plus';
							$item['icon_active'] = 'fa fa-minus';
							// $item['icon_position'] = $this->get_settings( 'icon_position' );
						}

						$is_new   = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed();
						$has_icon = ( ! $is_new || ! empty( $item['tab-icon']['value'] ) );

						$this->add_render_attribute( 'color', 'class', [
							'elementor-repeater-item-' . $item['_id'],
						] );

						?>
					<li <?php echo $this->get_render_attribute_string( 'color' ); ?>><?php Icons_Manager::render_icon( $item['tab-icon'] ); ?><span><?php echo $item['tab_title']; ?></span></li>
					<?php } ?>
				</ul>
			</div>
			<?php if ( $settings['button'] == 'yes' ) { ?>
			<div class="pricing-button <?php echo esc_attr( $btn_align ); ?>">
				<a <?php echo $this->get_render_attribute_string( 'button' ); ?>><?php echo sprintf( '%1$s', esc_html( $settings['button-text'], 'finix' ) ); ?></a>
			</div>
			<?php } ?>
		</div>
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\finix_pricing() );

