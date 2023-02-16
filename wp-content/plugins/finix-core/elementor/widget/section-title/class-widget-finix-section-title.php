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

class section_title extends Widget_Base {
	
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
		return __( 'section_title', 'finix' );
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve section title widget title.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	
	public function get_title() {
		return __( 'Section title', 'finix' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the section title widget belongs to.
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
	 * Retrieve section title widget icon.
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
	 * Register section title widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.1.0
	 * @access protected
	 */

	protected function _register_controls() {
			
		$this->start_controls_section(
			'sub_title-setting',
			[
				'label' => __( 'Sub Section Title', 'finix' ),
			]
		);

        $this->add_control(
			'sub_title-section',
			[
				'label' => __( 'Sub Section Title', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => __( 'OFF', 'elementor' ),
				'label_on' => __( 'ON', 'elementor' ),
			]
		);

		$this->add_control(
			'sub_title-style',
			[
				'label'      => __( 'Select Style', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'sub_title-1',
				'condition' => [
					'sub_title-section' => 'yes',
				],
				'options'    => [
					'sub_title-1'          => __( 'Style 1', 'finix' ),
					'sub_title-2'          => __( 'Style 2', 'finix' ),
				],
			]
		);

        $this->add_control(
			'title',
			[
				'label' => __( 'Section Sub Title', 'finix' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'sub_title-section' => 'yes',
				],
				'dynamic' => [
					'active' => true,
				],
                'label_block' => true,
                'default' => __( 'Section Sub Title', 'finix' ),
			]
		);

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'sub-title-typography',
				'label'   => __( 'Sub Title Typography', 'finix' ),
				'condition' => [
					'sub_title-section' => 'yes',
				],
				'selector' => '{{WRAPPER}} .section-title .title-tagline',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'finix' ),
				'type' => Controls_Manager::CHOOSE,
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
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sub_title_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'condition' => [
					'sub_title-section' => 'yes',
					'sub_title-style' => 'sub_title-2',
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .section-title.sub_title-2 .title-tagline' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); 

		$this->start_controls_section(
			'title-setting',
			[
				'label' => __( 'Section Title', 'finix' ),
			]
		);

		$this->add_control(
			'sub_title',
			[
				'label' => __( 'Section Title', 'finix' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
                'label_block' => true,
                'default' => __( 'Section Title', 'finix' ),
			]
		);


		$this->add_control(
			'title_tag',
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

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'title-typography',
				'label'   => __( 'Title Typography', 'finix' ),
				'selector' => '{{WRAPPER}} .section-title .main-title',
			]
		);

		$this->add_control(
			'title_divider',
			[
				'label' => __( 'Title Divider', 'finix' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'yes' => __( 'yes', 'finix' ),
				'no' => __( 'no', 'finix' ),
			]
        );

	
		$this->end_controls_section(); 
		
		$this->start_controls_section(
			'section_color',
			[
				'label' => __( 'Title Color', 'finix' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		

		$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'      => 'gradiant-bg-color',
					'label'     => __( 'Background Color', 'finix' ),
					'condition' => [
						'sub_title-section' => 'yes',
						'sub_title-style' => 'sub_title-2',
					],
					'types'     => array( 'gradient' ),
					'selector'  => '{{WRAPPER}} .section-title.sub_title-2 .title-tagline',
				)
			);

		$this->add_control(
			'sub_title_color',
			[
				'label' => __( 'Sub Title Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'separator'        => 'after',
				'condition' => [
					'sub_title-section' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .section-title .title-tagline' => 'color: {{VALUE}};',
					'{{WRAPPER}} .section-title .title-tagline:before' => 'border-bottom-color: {{VALUE}};',
		 		],	
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Tilte Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-title .main-title' => 'color: {{VALUE}};',
		 		],
				
				
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __( 'Divider Backgropund Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'title_divider' => 'yes',
					],
				'selectors' => [
					'{{WRAPPER}} .section-title .divider' => 'background-color: {{VALUE}};',
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

		$align = $settings['align'];
		if(empty($align))
		{
			$align .= 'text-left';
		}
		$this->add_render_attribute( 'section-title', 'class', $settings['sub_title-style'] );
		$this->add_render_attribute( 'section-title', 'class', 'section-title' );
		$this->add_render_attribute( 'section-title', 'class', $align);
		?>
		<div <?php echo $this->get_render_attribute_string( 'section-title' ); ?>>
			<?php if($settings['sub_title-section'] == 'yes') { ?>
				<span class="title-tagline"><?php echo __($settings['title'],'finix'); ?></span>
			<?php } ?>
			<<?php echo $settings['title_tag'];  ?> class="main-title"><?php echo __($settings['sub_title'],'finix'); ?></<?php echo $settings['title_tag'];  ?>>
			<?php
			if($settings['title_divider'] == 'yes') { ?>
			<div class="divider"></div>
			<?php } ?>
		</div>
	<?php
    }	    	
}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\section_title() );
?>