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

class counter extends Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve counter widget name.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget name.
	 */

	public function get_name() {
		return __( 'Counter', 'finix' );
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve counter widget title.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	
	public function get_title() {
		return __( 'Counter', 'finix' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the Skill of categories the counter widget belongs to.
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
	 * Retrieve counter widget icon.
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
	 * Register counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.1.0
	 * @access protected
	 */

	protected function _register_controls() {
			
		$this->start_controls_section(
			'counter-setting',
			[
				'label' => __( 'Genral Setting', 'finix' ),
			]
		);

		$this->add_control(
			'counter-style',
			[
				'label'      => __( 'Select Style', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'counter-style-1',
				'options'    => [
					'counter-style-1'          => __( 'Style 1', 'finix' ),
					'counter-style-2'          => __( 'Style 2', 'finix' ),
					'counter-style-3'          => __( 'Style 3', 'finix' ),	
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'finix' ),
				'type' => Controls_Manager::CHOOSE,
				'condition'   => array(
					'counter-style' => array( 'counter-style-1')
				),
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

		$this->end_controls_section(); 

		$this->start_controls_section(
			'icon-setting',
			[
				'label' => __( 'Icon Setting', 'finix' ),
			]
		);


		$this->add_control(
			'media-type',
			[
				'label'      => __( 'Select Icon', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'icon',
				'options'    => [
					'none'          => __( 'None', 'finix' ),
					'icon'          => __( 'Icon', 'finix' ),			
				]
			]
		);

		$this->add_control(
			'icon-position',
			[
				'label' => __( 'Icon Position', 'finix' ),
				'type' => Controls_Manager::CHOOSE,
		 		'condition' => array(
					'media-type' => 'icon',
					'counter-style' => 'counter-style-2',
				),
				'default' => 'icon-left',
				'options' => [
					'icon-left' => [
						'title' => __( 'Left', 'finix' ),
						'icon' => 'eicon-h-align-left',
					],
					'icon-right' => [
						'title' => __( 'Right', 'finix' ),
						'icon' => 'eicon-h-align-right',
					],
				],
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
			'icon-color',
			[
				'label' => __( 'Icon Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'media-type' => 'icon',
				],
				'selectors' => [
					'{{WRAPPER}} .counter .counter-icon' => 'color: {{VALUE}};',
		 		],
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
					'size' => 50,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .counter-default .counter-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Icon Space', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => [
					'media-type' => 'icon',
					'counter-style'=>['counter-style-1','counter-style-2']
				],
				'default' => [
					'size' => 20,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .counter-style-1 .counter-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .counter-style-2.icon-left .counter-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .counter-style-2.icon-right .counter-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .counter-style-3 .number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .counter-style-2.icon-left .counter-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .counter-style-2.icon-right .counter-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_position_left',
			[
				'label' => __( 'Icon Position Left', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => [
					'media-type' => 'icon',
					'counter-style'=> 'counter-style-3',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .counter-style-3 .counter-icon' => 'left: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .counter-style-3 .counter-icon' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_position_top',
			[
				'label' => __( 'Icon Position Top', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => [
					'media-type' => 'icon',
					'counter-style'=> 'counter-style-3',
				],
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .counter-style-3 .counter-icon' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'number-suffix',
			[
				'label' => __( 'Number & Suffix', 'finix' ),
			]
		);

        $this->add_control(
			'counter-no',
			[
				'label' => __( 'Counter Number', 'finix' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '90', 'finix' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'counter-suffix',
			[
				'label' => __( 'Suffix', 'finix' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '%', 'finix' ),
				'label_block' => true,
			]
		);


		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'number-typography',
				'selector' => '{{WRAPPER}} .counter-default .number',
			]
		);

		$this->add_control(
			'counter-color',
			[
				'label' => __( 'Number Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .counter .timer' => 'color: {{VALUE}};',
		 		],
			]
		);

		$this->add_control(
			'suffix-color',
			[
				'label' => __( 'Suffix Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .counter .suffix' => 'color: {{VALUE}};',
		 		],
			]
		);

		$this->end_controls_section(); 

		$this->start_controls_section(
			'title-description',
			[
				'label' => __( 'Title & Description', 'finix' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'title-typography',
				'selector' => '{{WRAPPER}} .counter-default .counter-title',
			]
		);

		$this->add_control(
			'counter-title',
			[
				'label' => __( 'Title', 'finix' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Counter Title', 'finix' ),
				'placeholder' => __( 'Counter Title', 'finix' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'title-color',
			[
				'label' => __( 'Title Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .counter .counter-title' => 'color: {{VALUE}};',
		 		],
			]
		);

		$this->add_control(
			'counter-description',
			[
				'label' => __( 'Description', 'finix' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'We make websites are the number one ranked design team.', 'finix' ),
			]
		);

		$this->add_control(
			'description-color',
			[
				'label' => __( 'Description Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .counter .counter-text' => 'color: {{VALUE}};',
		 		],
			]
		);

		$this->add_responsive_control(
			'content_space',
			[
				'label' => __( 'Content Space', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .counter-default .number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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

		$counter_style = sprintf('%1$s',esc_html($settings['counter-style'],'finix'));

		if($settings['media-type'] == 'icon')
		{
			$media_html = sprintf('<i aria-hidden="true" class="%1$s"></i>',esc_attr($settings['finix-icon']['value'],'finix'));
			$align .= sprintf(' %1$s',esc_html($settings['icon-position'],'finix'));
		}
		?>
		<div class="counter counter-default <?php echo $counter_style; ?> <?php echo esc_attr($align);?>">
			<?php if($settings['media-type'] != 'none') { ?>
			<div class="counter-icon"><?php echo $media_html; ?></div>
			<?php } ?>	
			<div class="counter-info">
				<h2 class="number">
					<?php if($settings['counter-no']) { ?>
					<span class="timer" data-from="0" data-to="<?php echo sprintf('%1$s',esc_html($settings['counter-no'],'finix')); ?>" data-speed="2000" data-refresh-interval="6">0</span>
					<?php } ?>
					<?php if($settings['counter-suffix']) { ?>
					<span class="suffix"><?php echo sprintf('%1$s',esc_html($settings['counter-suffix'],'finix')); ?></span>
					<?php } ?>
				</h2>
				<?php if($settings['counter-title']) { ?>
				<h5 class="counter-title"><?php echo sprintf('%1$s',esc_html($settings['counter-title'],'finix')); ?></h5>
				<?php } ?>
				<?php if($settings['counter-description']) { ?>
				<div class="counter-text"><?php echo sprintf('%1$s',esc_html($settings['counter-description'],'finix'));?></div>
				<?php } ?>
			</div>			
		</div>
		<?php	
		if ( Plugin::$instance->editor->is_edit_mode() ) :
		?>
		<script>
			jQuery('.counter').each(function() {
				var timer = jQuery('.timer');
				if(timer.length) {
					timer.appear(function () {
					timer.countTo();
				});
				}
			});
		</script>
		<?php endif; 	
	}	
}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\counter() );
?>