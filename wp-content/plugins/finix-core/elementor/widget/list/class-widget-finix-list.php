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

class list_element extends Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve list widget name.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget name.
	 */

	public function get_name() {
		return __( 'List', 'finix' );
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve list widget title.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	
	public function get_title() {
		return __( 'List', 'finix' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the list widget belongs to.
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
	 * Retrieve list widget icon.
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
	 * Register list widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.1.0
	 * @access protected
	 */

	protected function _register_controls() {
			
		$this->start_controls_section(
			'list-setting',
			[
				'label' => __( 'Genral Setting', 'finix' ),
			]
		);

		$repeater = new Repeater();
        $repeater->add_control(
			'tab-title',
			[
				'label' => __( 'Title', 'finix' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Tab Title', 'finix' ),
				'placeholder' => __( 'Tab Title', 'finix' ),
				'label_block' => true,
			]
        );
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .list li',
			]
		);

		$this->add_control(
			'media-type',
			[
				'label'      => __( 'List Type', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'icon',
				'options'    => [
					'none'          => __( 'None', 'finix' ),
					'list-style'    => __( 'Style Type', 'finix' ),	
					'icon'          => __( 'Icon', 'finix' ),			
				]
			]
		);

		$this->add_control(
			'style-type',
			[
				'label'      => __( 'List Style Type', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'list-circle',
				'condition' => [
					'media-type' => 'list-style',
				],
				'options'    => [
					'list-circle'          => __( 'Circle', 'finix' ),
					'list-square'          => __( 'Square', 'finix' ),
					'list-disc' 		   => __( 'Disc', 'finix' ),
					'list-decimal'         => __( 'Decimal', 'finix' ),
					'list-decimal-zero'    => __( 'Decimal Leading Zero', 'finix' ),
					'list-lower-alpha'     => __( 'Lower Alpha', 'finix' ),
					'list-upper-alpha'     => __( 'Upper Alpha', 'finix' ),
					'list-lower-roman'     => __( 'Lower Roman', 'finix' ),				
				]
			]
		);
		
		$this->add_control(
			'icon-style',
			[
				'label'      => __( 'Icon Type', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'icon-default',
				'condition' => [
					'media-type' => 'icon',
				],
				'options'    => [
					'icon-default'          => __( 'Default', 'finix' ),
					'icon-border'          => __( 'Border', 'finix' ),
					'icon-flat'          => __( 'Flat', 'finix' ),			
				]
			]
		);

		$this->add_control(
			'icon-size',
			[
				'label'      => __( 'Icon Size', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'size-extra-small',
				'condition' => [
					'media-type' => 'icon',
				],
				'options'    => [
					'size-extra-small'    => __( 'Extra Small', 'finix' ),
					'size-small'          => __( 'Small', 'finix' ),
					'size-mediam'         => __( 'Mediam', 'finix' ),
					'size-large' 		  => __( 'Large', 'finix' ),
					'size-extra-large' 	  => __( 'Extra Large', 'finix' ),		
				]
			]
		);

		$this->add_control(
			'icon-shap',
			[
				'label'      => __( 'Icon Shap', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'icon-square',
				'condition' => [
					'media-type' => 'icon',
					'icon-style'=>['icon-border','icon-flat']
				],
				'options'    => [
					'icon-square'          => __( 'Square', 'finix' ),
					'icon-round'          => __( 'Round', 'finix' ),
					'icon-rounded'          => __( 'Rounded', 'finix' ),				
				]
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Icon Spacing', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => [
					'media-type' => 'icon',
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
					'{{WRAPPER}} .list li i' => 'margin-right: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .list li i' => 'margin-left: {{SIZE}}{{UNIT}};',
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
				]
			]
		);

		$this->end_controls_section(); 

		$this->start_controls_section(
			'list-items',
			[
				'label' => __( 'List Items', 'finix' ),
			]
		);
		
		$this->add_control(
			'tabs',
			[
				'label' => __( 'Lists Items', 'finix' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tab-title' => __( 'List Items', 'finix' ),  
					]
				],
			]
		);

		$this->add_responsive_control(
			'list_space',
			[
				'label' => __( 'List Spacing', 'finix' ),
				'type' => Controls_Manager::SLIDER,
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
					'{{WRAPPER}} .list ul li' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); 

		

		$this->start_controls_section(
			'style-list',
			[
				'label' => __( 'List Color Options', 'finix' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'color-type',
			[
				'label'      => __( 'Select Color Type', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'color-default',
				'options'    => [
					'color-default'          => __( 'Default', 'finix' ),
					'color-custom'          => __( 'Custom', 'finix' ),			
				]
			]
		);

		$this->add_control(
			'title-color',
			[
				'label' => __( 'Title Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'color-type'=>['color-custom']
				],
				'selectors' => [
					'{{WRAPPER}} .list ul li' => 'color: {{VALUE}};',
		 		],
			]
		);

		$this->add_control(
			'icon-color',
			[
				'label' => __( 'Icon Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'color-type'=>['color-custom'],
				],
				'selectors' => [
					'{{WRAPPER}} .list.color-custom.icon-default li i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .list.color-custom.icon-border li i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .list.color-custom.icon-flat li i' => 'color: {{VALUE}};',
		 		],
			]
		);

		$this->add_control(
			'icon-bg-color',
			[
				'label' => __( 'Icon Background Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'icon-style'=>['icon-flat'],
					'color-type'=>['color-custom']
				],
				'selectors' => [
					'{{WRAPPER}} .list.color-custom.icon-flat li i' => 'background: {{VALUE}};',
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

		$tabs = $this->get_settings_for_display( 'tabs' );  

		if($settings['media-type'] == 'icon')
		{
			$media_html = sprintf('<i aria-hidden="true" class="%1$s"></i>',esc_attr($settings['finix-icon']['value'],'finix'));
		}
		$align = $settings['align'];
		if($settings['media-type'] == 'icon')
		{
			$align .= sprintf(' %1$s',esc_html($settings['icon-style'],'finix'));
			$align .= sprintf(' %1$s',esc_html($settings['icon-size'],'finix'));
		}
		if($settings['media-type'] == 'list-style')
		{
			$align .= sprintf(' %1$s',esc_html($settings['style-type'],'finix'));
		}

		if($settings['icon-style'] != 'icon-default') {
			$align .= sprintf(' %1$s',esc_html($settings['icon-shap'],'finix'));
		}

		$color_type = sprintf('%1$s',esc_html($settings['color-type'],'finix'));
		?>
		<div class="list <?php echo $color_type; ?> <?php echo esc_attr($align);?>">
			<ul>
				<?php foreach ( $tabs as $index => $item ){ ?>
					<li>
					<?php if($settings['media-type'] == 'icon') { ?>
					<?php echo $media_html; ?>
					<?php } ?>
					<span><?php echo esc_html($item['tab-title'],'finix'); ?></span>
					</li>
				<?php } ?>
			</ul>
		</div>
		<?php	
	}	
}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\list_element() );
?>