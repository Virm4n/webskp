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

class small_icon_box extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Small IconBox widget name.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget name.
	 */

	public function get_name() {
		return __( 'Small IconBox', 'finix' );
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Small IconBox widget title.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */

	public function get_title() {
		return __( 'Small Icon Box', 'finix' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Small IconBox widget belongs to.
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
	 * Retrieve Small IconBox widget icon.
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
	 * Register Small IconBox widget controls.
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
			'iconbox-style',
			[
				'label'      => __( 'Select Style', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'style-1',
				'options'    => [
					'style-1'          => __( 'Style 1', 'finix' ),
					'style-2'          => __( 'Style 2', 'finix' ),			
				],
			]
		);

		$this->add_control(
			'iconhover-effect',
			[
				'label' => __( 'Icon Hover Effect', 'finix' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'yes' => __( 'yes', 'finix' ),
				'no' => __( 'no', 'finix' ),
			]
		);

		$this->add_responsive_control(
			'iconbox_padding',
			[
				'label' => __( 'Padding', 'finix' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .small-feature .feature-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'iconbox_radius',
			array(
				'label'     => __( 'Border Radius', 'finix' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 3,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .small-feature .feature-inner' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'align',
			array(
				'label'     => __( 'Alignment', 'finix' ),
				'type'      => Controls_Manager::CHOOSE,
				'condition' => 
					['iconbox-style'=>['style-1']
				],
				'default'   => 'text-center',
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
				'selectors' => array(
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title-setting',
			array(
				'label' => __( 'Title Setting', 'finix' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title-typography',
				'label'    => __( 'Title Typography', 'finix' ),
				'selector' => '{{WRAPPER}} .small-feature .feature-inner .feature-title',
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'finix' ),
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

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'finix' ),
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

		$this->end_controls_section();

		$this->start_controls_section(
			'style_icon',
			[
				'label' => __( 'Icon Setting', 'finix' ),
			]
		);

		$this->add_control(
			'finix-icon',
			array(
				'label'            => __( 'Icon', 'finix' ),
				'type'             => Controls_Manager::ICONS,
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
			'iconbox_position',
			[
				'label' => __( 'Iconbox Position', 'finix' ),
				'type' => Controls_Manager::CHOOSE,
				'condition' => 
					['iconbox-style'=>['style-2']
				],
				'options' => [
					'iconbox-left' => [
						'title' => __( 'Start', 'finix' ),
						'icon' => 'eicon-h-align-left',
					],
					'iconbox-right' => [
						'title' => __( 'End', 'finix' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				//'default' => is_rtl() ? 'iconbox-right' : 'iconbox-left',
				'default' => 'iconbox-left',
				'toggle' => false,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'     => __( 'Icon Size', 'finix' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .small-feature .feature-inner .feature-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_space',
			array(
				'label'     => __( 'Icon Space', 'finix' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 20,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .small-feature.feature-style-1 .feature-inner .feature-icon i' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .small-feature.feature-style-2.iconbox-left .feature-inner .feature-icon i' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .small-feature.feature-style-2.iconbox-right .feature-inner .feature-icon i' => 'margin-left: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .small-feature.feature-style-2.iconbox-left .feature-inner .feature-icon i' => 'margin-left: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .small-feature.feature-style-2.iconbox-right .feature-inner .feature-icon i' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'iconbox_color',
			array(
				'label' => __( 'Icon Box Color', 'finix' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'iconbox_color-tabs' );

			$this->start_controls_tab(
				'iconbox_color_normal',
				array(
					'label' => __( 'Normal', 'finix' ),
				)
			);

			$this->add_control(
				'normal_icon_color',
				[
					'label' => __( 'Icon Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .small-feature .feature-inner .feature-icon i' => 'color: {{VALUE}};',
						'{{WRAPPER}} .small-feature.feature-style-2 .feature-inner .feature-bg-icon' => 'color: {{VALUE}};',
					 ],
				]
			);

			$this->add_control(
				'normal_title_color',
				[
					'label' => __( 'Tilte Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .small-feature .feature-inner .feature-title' => 'color: {{VALUE}};',
					 ],
				]
			);

			$this->add_control(
				'normal_bg_color',
				[
					'label' => __( 'Background Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .small-feature .feature-inner' => 'background: {{VALUE}};',
					 ],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'iconbox_color_hover',
				array(
					'label' => __( 'Hover', 'finix' ),
				)
			);

			$this->add_control(
				'hover_icon_color',
				[
					'label' => __( 'Icon Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .small-feature:hover .feature-inner .feature-icon i' => 'color: {{VALUE}};',
						'{{WRAPPER}} .small-feature.feature-style-2:hover .feature-inner .feature-bg-icon' => 'color: {{VALUE}};',
					 ],
				]
			);

			$this->add_control(
				'hover_title_color',
				[
					'label' => __( 'Tilte Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .small-feature:hover .feature-inner .feature-title' => 'color: {{VALUE}};',
					 ],
				]
			);

			$this->add_control(
				'hover_bg_color',
				[
					'label' => __( 'Background Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .small-feature:hover .feature-inner' => 'background: {{VALUE}};',
					 ],
				]
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

		$align = $settings['align'];

		$style = sprintf('%1$s',esc_html($settings['iconbox-style'],'finix'));

		$migrated = isset( $settings['__fa4_migrated']['finix-icon'] );
		if($settings['iconhover-effect'] == 'yes'){  $align .= ' hover-enable'; }

		if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// @todo: remove when deprecated
			// added as bc in 2.6
			// add old default
			$settings['icon']          = 'fa fa-plus';
			$settings['iconbox_position'] = $this->get_settings( 'iconbox_position' );
		}

		$is_new   = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
		$has_icon = ( ! $is_new || ! empty( $settings['finix-icon']['value'] ) );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'button', $settings['link'] );
		}
		?>
		<div class="small-feature feature-<?php echo $style; ?> <?php echo esc_attr($align);?> <?php echo esc_attr( $settings['iconbox_position'] ); ?>">
			<div class="feature-inner">
			<?php if($settings['iconbox-style'] == 'style-2')
				{
					?>
						<div class="feature-bg-icon"><?php Icons_Manager::render_icon( $settings['finix-icon'] ); ?></div>
				<?php 
			} ?>
				<div class="feature-icon"><?php Icons_Manager::render_icon( $settings['finix-icon'] ); ?></div>
				<<?php echo $settings['title_tag'];  ?> class="feature-title"><a <?php echo $this->get_render_attribute_string( 'button' ); ?>><?php echo __($settings['title'],'finix'); ?></a></<?php echo $settings['title_tag'];  ?>>
			</div>
		</div>
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\small_icon_box() );
?>
