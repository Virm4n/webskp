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

class finix_newsletter extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve button widget name.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget name.
	 */

	public function get_name() {
		return __( 'finix_newsletter', 'finix' );
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve button widget title.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */

	public function get_title() {
		return __( 'Newsletter', 'finix' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the button widget belongs to.
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
	 * Retrieve button widget icon.
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
	 * Register button widget controls.
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
				'label' => __( 'Newsletter', 'finix' ),
			)
		);

		$this->add_control(
			'newsletter-style',
			array(
				'label'   => __( 'Newsletter Style', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'newsletter-style-1',
				'options' => array(
					'newsletter-style-1' => __( 'Style 1', 'finix' ),
					'newsletter-style-2' => __( 'Style 2', 'finix' ),
				),
			)
		);

		$this->add_control(
			'newsletter-button-position',
			array(
				'label'   => __( 'Button Position', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'button-right',
				'options' => array(
					'button-right' => __( 'Right', 'finix' ),
					'button-bottom' => __( 'Bottom', 'finix' ),
				),
			)
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'typography',
				'label'   => __( 'Button Typography', 'finix' ),
				'selector' => '{{WRAPPER}} .newsletter-main .button-area button',
			)
		);

		$this->add_responsive_control(
			'button-space',
			[
				'label' => __( 'Button Space', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .newsletter-main.button-right .button-area' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .newsletter-main.button-bottom .mc4wp-form-fields .button-area' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'finix' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .newsletter-main .input-area input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .newsletter-main .button-area button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);



		$this->add_responsive_control(
			'newsletter_align',
			[
				'label' => __( 'Alignment', 'finix' ),
				'type' => Controls_Manager::CHOOSE,
				'condition' => [
					'newsletter-button-position'=>['button-bottom'],
				],
				'default' => 'align-left',
				'options' => [
					'align-left'    => [
						'title' => __( 'Left', 'finix' ),
						'icon' => 'eicon-text-align-left',
					],
					'align-center' => [
						'title' => __( 'Center', 'finix' ),
						'icon' => 'eicon-text-align-center',
					],
					'align-right' => [
						'title' => __( 'Right', 'finix' ),
						'icon' => 'eicon-text-align-right',
					],
					'align-justify' => [
						'title' => __( 'Justified', 'finix' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
			]
		);

		$this->end_controls_section();

			$this->start_controls_section(
				'newsletter_color',
				[
					'label' => __( 'Newsletter Color', 'finix' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'input_text_color',
				[
					'label' 		=> __( 'Text Color', 'finix' ),
					'type' 			=> Controls_Manager::COLOR,
					'default' 		=> '',
					'selectors' 	=> [
						'{{WRAPPER}} .newsletter-main .input-area input' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'input_bg_color',
				[
					'label' 		=> __( 'Background Color', 'finix' ),
					'type' 			=> Controls_Manager::COLOR,
					'default' 		=> '',
					'condition' => [
						'newsletter-style'=>['newsletter-style-1'],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .newsletter-main .input-area input' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'input_border_color',
				[
					'label' 		=> __( 'Border Color', 'finix' ),
					'type' 			=> Controls_Manager::COLOR,
					'default' 		=> '',
					'condition' => [
						'newsletter-style'=>['newsletter-style-2'],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .newsletter-main .input-area input' => 'border-color: {{VALUE}};',
					],
				]
			);
			
			$this->start_controls_tabs( 'newsletter_button_color' );

			$this->start_controls_tab(
				'button_normal',
				[
					'label' => __( 'Normal', 'finix' ),
				]
			);

			$this->add_control(
				'button_text_normal',
				[
					'label' => __( 'Text Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .newsletter-main .button-area button' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'button_bg_normal',
				[
					'label' => __( 'Background Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .newsletter-main .button-area button' => 'background: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'button_hover',
				[
					'label' => __( 'Hover', 'finix' ),
				]
			);

			$this->add_control(
				'button_text_hover',
				[
					'label' => __( 'Text Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .newsletter-main .button-area button:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'button_bg_hover',
				[
					'label' => __( 'Background Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .newsletter-main .button-area button:hover' => 'background: {{VALUE}};',
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

		$this->add_render_attribute( 'newsletter', 'class', 'newsletter-main' );
		$this->add_render_attribute( 'newsletter', 'class', $settings['newsletter-style'] );
		$this->add_render_attribute( 'newsletter', 'class', $settings['newsletter-button-position'] );
		$this->add_render_attribute( 'newsletter', 'class', $settings['newsletter_align'] );

		?>
		<div <?php echo $this->get_render_attribute_string( 'newsletter' ); ?>>
			<?php
			$finix_opt = get_option( 'finix_redux' );

			if ( isset( $finix_opt['mailchimp_shortcode'] ) ) {
				$mailchimp_shortcode = $finix_opt['mailchimp_shortcode'];
			}

			echo do_shortcode( $mailchimp_shortcode );
			?>
		</div>
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\finix_newsletter() );
?>
