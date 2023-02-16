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

class finix_quick_info extends Widget_Base {
	
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
		return __( 'finix_quick_info', 'finix' );
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
		return __( 'Quick Info', 'finix' );
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
		return [ 'finix' ];
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
			[
				'label' => __( 'Quick Info', 'finix' ),
			]
		);

		$this->add_control(
			'image',
			array(
				'label'   => __( 'Upload Image', 'finix' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array(
					'active' => true,
				),
				'separator' => 'after',
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'quick-info-icon',
			[
				'label' => __( 'Quick Info Icon', 'finix' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before',
				'default' => 'no',
				'yes' => __( 'yes', 'finix' ),
				'no' => __( 'no', 'finix' ),
			]
		);

		$this->add_control(
			'finix-icon',
			[
				'label' => __( 'Select Icon', 'finix' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'condition' => ['quick-info-icon' => 'yes'],
				'default' => [
					'value' => 'ion ion-plus-round'
					
				]
			]
		);

		$this->add_control(
			'finix-icon-bg',
			[
				'label' => __( 'Icon Background', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => ['quick-info-icon' => 'yes'],
				'selectors' => [
					'{{WRAPPER}} .quick-info .small-images i' => 'background-color: {{VALUE}};',
		 		],
			]
		);

		$this->add_control(
			'finix-icon-border',
			[
				'label' => __( 'Icon Border Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => ['quick-info-icon' => 'yes'],
				'selectors' => [
					'{{WRAPPER}} .quick-info .small-images i' => 'border-color: {{VALUE}};',
		 		],
			]
		);

		$this->add_control(
			'finix-icon-color',
			[
				'label' => __( 'Icon Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => ['quick-info-icon' => 'yes'],
				'selectors' => [
					'{{WRAPPER}} .quick-info .small-images i' => 'color: {{VALUE}};',
		 		],
			]
		);

		$this->end_controls_section(); 

		$this->start_controls_section(
			'style-info',
			[
				'label' => __( 'Text Setting', 'finix' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text-position',
			array(
				'label'     => __( 'Text Position', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'text-left',
				'options'   => array(
					'text-left' => __('Left', 'finix' ),
					'text-top' => __( 'Top', 'finix' ),
				),
			)
		);
		
		$this->add_control(
			'text',
			[
				'label' => __( 'Text', 'finix' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
                'label_block' => true,
			]
		);

		$this->add_control(
			'description',
			[
				'label' => __( 'Description', 'finix' ),
				'type' => Controls_Manager::WYSIWYG,
				'separator' => 'after',
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Description', 'finix' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tex-typography',
				'label' => __( 'Text Typography', 'finix' ),
				'selector' => '{{WRAPPER}} .quick-info .info-text span',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description-typography',
				'label' => __( 'Description Typography', 'finix' ),
				'selector' => '{{WRAPPER}} .quick-info .info-text',
			]
		);

		$this->add_control(
			'text-color',
			[
				'label' => __( 'Text Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quick-info .info-text span' => 'color: {{VALUE}};',
		 		],
			]
		);

		$this->add_control(
			'description-color',
			[
				'label' => __( 'Description Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quick-info .info-text' => 'color: {{VALUE}};',
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
		$image_position = sprintf( '%1$s', esc_html( $settings['text-position'], 'finix' ) );

		if($settings['quick-info-icon'] == 'yes'){
			$media_html = sprintf('<i aria-hidden="true" class="%1$s"></i>',esc_attr($settings['finix-icon']['value'],'finix'));
		}
		?>
		<div class="quick-info <?php echo $image_position; ?>">
			<div class="small-images"><img src="<?php echo esc_url( $settings['image']['url'] ); ?>" class="img-fluid" alt="" /><?php if($settings['quick-info-icon'] == 'yes'){ echo $media_html; } ?></div>
			<div class="info-text"><span><?php echo $settings['text']; ?></span><div><?php echo $settings['description']; ?></div></div>
		</div>
	<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\finix_quick_info() );
?>