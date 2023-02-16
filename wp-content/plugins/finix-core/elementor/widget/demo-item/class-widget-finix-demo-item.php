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

class finix_demo_item extends Widget_Base {
	
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
		return __( 'finix_demo_item', 'finix' );
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
		return __( 'Demo Item', 'finix' );
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
				'label' => __( 'Demo Item', 'finix' ),
			]
		);

		$this->add_control(
			'new-demo',
			[
				'label' => __( 'New Label', 'finix' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'after',
				'default' => 'no',
				'yes' => __( 'yes', 'finix' ),
				'no' => __( 'no', 'finix' ),
			]
		);

		$this->add_control(
			'demo-image',
			array(
				'label'   => __( 'Demo Image', 'finix' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array(
					'active' => true,
				),
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'demo-title',
			[
				'label' => __( 'Demo Title', 'finix' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
                'label_block' => true,
                'default' => __( 'Demo Name', 'finix' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title-typography',
				'label' => __( 'Title Typography', 'finix' ),
				'selector' => '{{WRAPPER}} .quick-info .info-text span',
			]
		);

		$this->add_control(
			'text-color',
			[
				'label' => __( 'Title Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quick-info .info-text span' => 'color: {{VALUE}};',
		 		],
			]
		);

		$this->end_controls_section(); 

		$this->start_controls_section(
			'button-setting',
			[
				'label' => __( 'Button Setting', 'finix' ),
			]
		);

		$this->add_control(
			'demo-link',
			[
				'label' => __( 'Demo Button 1', 'finix' ),
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
				'label' => __( 'Button Typography', 'finix' ),
				'condition' => ['demo-link' => 'yes'],
				'selector' => '{{WRAPPER}} .feature-box .demo-button',
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
				'condition' => ['demo-link' => 'yes']
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
				'condition' => ['demo-link' => 'yes']
			]
		);

		$this->add_control(
			'demo-link-two',
			[
				'label' => __( 'Demo Button 2', 'finix' ),
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
				'name' => 'link-typography-two',
				'label' => __( 'Button Typography', 'finix' ),
				'condition' => ['demo-link-two' => 'yes'],
				'selector' => '{{WRAPPER}} .feature-box .demo-button',
			]
		);
		
		$this->add_control(
			'button-text-two',
			[
				'label' => __( 'Button Text', 'finix' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
                'label_block' => true,
				'default' => __( 'Read More', 'finix' ),
				'condition' => ['demo-link-two' => 'yes']
			]
		);

		$this->add_control(
			'link-two',
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
				'condition' => ['demo-link-two' => 'yes']
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
		$url = $settings['link']['url'];
		$this->add_render_attribute( 'demo-class', 'class', esc_attr('demo-button') ); 
		$this->add_render_attribute( 'demo-class', 'href', esc_url($url) );

		$url_two = $settings['link-two']['url'];
		$this->add_render_attribute( 'demo-class-two', 'class', esc_attr('demo-button') ); 
		$this->add_render_attribute( 'demo-class-two', 'href', esc_url($url_two) );

		?>
		<div class="demo-item">
			<?php if($settings['new-demo'] == 'yes') { ?>
				<span class="new-label">New</span>
			<?php } ?>
			<div class="demo-item-image">
				<img src="<?php echo esc_url( $settings['demo-image']['url'] ); ?>" class="img-fluid" alt="" />
					<div class="builder-button">
						<?php if($settings['demo-link'] == 'yes') { ?>
						<a <?php echo $this->get_render_attribute_string( 'demo-class' ) ?>><?php echo sprintf('%1$s',esc_html($settings['button-text'],'finix'));?></a>
						<?php } ?>
						<?php if($settings['demo-link-two'] == 'yes') { ?>
						<a <?php echo $this->get_render_attribute_string( 'demo-class-two' ) ?>><?php echo sprintf('%1$s',esc_html($settings['button-text-two'],'finix'));?></a>
						<?php } ?>
					</div>				
			</div>
			<div class="demo-name"><?php echo $settings['demo-title']; ?></div>
		</div>
	<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\finix_demo_item() );
?>