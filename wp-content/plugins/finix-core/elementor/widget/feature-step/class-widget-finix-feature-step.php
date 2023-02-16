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

class feature_step extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve section title widget name.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget name.
	 */

	public function get_name() {
		return __( 'feature_step', 'finix' );
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Feature Step widget title.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */

	public function get_title() {
		return __( 'Feature Step', 'finix' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Feature Step widget belongs to.
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
	 * Retrieve Feature Step widget icon.
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
	 * Register Feature Step widget controls.
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
			'steps-style',
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
			'step_position',
			[
				'label' => __( 'Step Position', 'finix' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'step-left' => [
						'title' => __( 'Start', 'finix' ),
						'icon' => 'eicon-h-align-left',
					],
					'step-right' => [
						'title' => __( 'End', 'finix' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				//'default' => is_rtl() ? 'step-right' : 'step-left',
				'default' => 'step-left',
				'toggle' => false,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'step-number-setting',
			array(
				'label' => __( 'Step Number', 'finix' ),
			)
		);

		$this->add_control(
			'step-number',
			array(
				'label'       => __( 'Step Number', 'finix' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
				'default'     => __( '01', 'finix' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'step-number-typography',
				'label'   => __( 'Number Typography', 'finix' ),
				'selector' => '{{WRAPPER}} .features-step .icons-info .step-number',
			]
		);

		$this->add_control(
			'step-icon',
			array(
				'label'            => __( 'Step Icon', 'finix' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'condition' => [
					'steps-style'=>['style-1']
				],
				'default'          => array(
					'value'   => 'far fa-sun',
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

		$this->end_controls_section();

		$this->start_controls_section(
			'step-title-setting',
			array(
				'label' => __( 'Step Information', 'finix' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Step Title', 'finix' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
				'default'     => __( 'Section Title', 'finix' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'step-title-typography',
				'label'   => __( 'Title Typography', 'finix' ),
				'selector' => '{{WRAPPER}} .features-step .step-info .title',
			]
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

		$this->end_controls_section();

		$this->start_controls_section(
			'step-color-setting',
			[
				'label' => __( 'Step Number Color', 'finix' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'step-icon[value]!' => '',
				],
			]
		);			

		$this->add_control(
			'step-number-color',
			array(
				'label'     => __( 'Number Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .features-step .step-number' => 'color: {{VALUE}};',
				),

			)
		);

		$this->add_control(
			'step-number-bg-color',
			array(
				'label'     => __( 'Background Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .features-step .step-number' => 'background: {{VALUE}};',
					'{{WRAPPER}} .features-step.step-style-1 .step-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .features-step .step-number:before' => 'background: {{VALUE}};',
				),

			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'step-info-color',
			array(
				'label' => __( 'Step Info Color', 'finix' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Tilte Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .features-step .step-info .title' => 'color: {{VALUE}};',
				),

			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => __( 'Description Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .features-step .step-info .description' => 'color: {{VALUE}};',
				),
			)
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

		$style = sprintf('%1$s',esc_html($settings['steps-style'],'finix'));

		$migrated = isset( $settings['__fa4_migrated']['step-icon'] );

		if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// @todo: remove when deprecated
			// added as bc in 2.6
			// add old default
			$settings['icon']          = 'fa fa-plus';
			$settings['step_position'] = $this->get_settings( 'step_position' );
		}

		$is_new   = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
		$has_icon = ( ! $is_new || ! empty( $settings['step-icon']['value'] ) );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'button', $settings['link'] );
		}
		?>
		<div class="features-step step-<?php echo $style; ?> <?php echo esc_attr( $settings['step_position'] ); ?>">
			<div class="step-inner">
				<div class="icons-info">
					<span class="step-number"><?php echo __($settings['step-number'],'finix'); ?></span>
					<?php if($settings['steps-style'] == 'style-1')
						{
							?>
								<div class="step-icon"><?php Icons_Manager::render_icon( $settings['step-icon'] ); ?></div>
						<?php 
				} ?>
				</div>
				<div class="step-info">
					<<?php echo $settings['title_tag'];  ?> class="title"><?php echo __($settings['title'],'finix'); ?></<?php echo $settings['title_tag'];  ?>>
					<div class="description"><?php echo sprintf('%1$s',esc_html($settings['description'],'finix'));?></div>
				</div>
			</div>
		</div>
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\feature_step() );
?>
