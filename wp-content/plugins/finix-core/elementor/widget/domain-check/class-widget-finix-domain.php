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

class finix_domain_check extends Widget_Base {

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
		return __( 'finix_domain_check', 'finix' );
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
		return __( 'Domain Check', 'finix' );
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
			[
				'label' => __( 'Genral Setting', 'finix' ),
			]
		);

        $this->add_control(
			'sub_title',
			[
				'label' => __( 'Domain List Title', 'finix' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
                'label_block' => true,
                'default' => __( 'Domain List Title', 'finix' ),
			]
		);


		$this->add_control(
			'title_tag',
			[
				'label'      => __( 'Title Tag', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'h6',
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
				'selector' => '{{WRAPPER}} .web-host-title .main-title',
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
			'icon_items',
			array(
				'label' => __( 'Domain Items', 'finix' ),
			)
		);

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'domain-list-typography',
				'label'   => __( 'Domain List Typography', 'finix' ),
				'selector' => '{{WRAPPER}} .web-host-list ul li',
			]
		);

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'domain-name-typography',
				'label'   => __( 'Domain Name Typography', 'finix' ),
				'selector' => '{{WRAPPER}} .web-host-list ul li span',
			]
		);

		$repeater = new Repeater();
		
		$repeater->add_control(
			'tab_domain_title',
			[
				'label' => __( 'Domain Name', 'finix' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( '.com', 'finix' ),
			]
		);

		$repeater->add_control(
			'tab_domain_content',
			[
				'label' => __( 'Price', 'finix' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( '$11.25', 'finix' ),
			]
		);

		$this->add_control(
			'tabs',
			array(
				'label'       => __( 'Tabs Items', 'finix' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default' => [
					[
						'tab_domain_title' => __( ' .com', 'finix' ),
						'tab_domain_content' => __( '$12.50', 'finix' ),
					],
					[
						'tab_domain_title' => __( ' .org', 'finix' ),
						'tab_domain_content' => __( '$12.30', 'finix' ),
					],
					[
						'tab_domain_title' => __( ' .net', 'finix' ),
						'tab_domain_content' => __( '$11.50', 'finix' ),
					],
					[
						'tab_domain_title' => __( ' .co', 'finix' ),
						'tab_domain_content' => __( '$11.25', 'finix' ),
					],
					[
						'tab_domain_title' => __( ' .info', 'finix' ),
						'tab_domain_content' => __( '$9.00', 'finix' ),
					]
				],
				'title_field' => '{{{ tab_domain_title }}}',
			)
		);
		
		$this->end_controls_section(); 


		$this->start_controls_section(
			'section_color',
			[
				'label' => __( 'Domain List Color', 'finix' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Domain List Tilte Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .web-host-title .main-title' => 'color: {{VALUE}};',
		 		],
				
				
			]
		);

		$this->start_controls_tabs( 'tabs_list_style' );

		$this->start_controls_tab(
			'list_normal',
			[
				'label' => __( 'Normal', 'finix' ),
			]
		);

		$this->add_control(
			'list_text_color',
			[
				'label' => __( 'Text Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .web-host-list ul li' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'list_domain_color',
			[
				'label' => __( 'Domain Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .web-host-list ul li span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'list_bg_normal_color',
			[
				'label' => __( 'Background Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .web-host-list ul li' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'list_border_color',
			[
				'label' => __( 'Border Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .web-host-list ul li' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'list_hover',
			[
				'label' => __( 'Hover', 'finix' ),
			]
		);

		$this->add_control(
			'list_hover_color',
			[
				'label' => __( 'Text Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .web-host-list ul li:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .web-host-list ul li:hover span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'list_bg_hover_color',
			[
				'label' => __( 'Background Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .web-host-list ul li:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'list_border_hover_color',
			[
				'label' => __( 'Border Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .web-host-list ul li:hover' => 'border-color: {{VALUE}};',
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

		$tabs = $this->get_settings_for_display( 'tabs' );

		$this->add_render_attribute( 'web-host-title', 'class', 'domain-check' );
		$this->add_render_attribute( 'web-host-title', 'class', $settings['align'] );
		?>
		<div <?php echo $this->get_render_attribute_string( 'web-host-title' ); ?>>
			<?php
			if ( class_exists( 'WP24_Domain_Check' ) ) {
				echo do_shortcode( '[wp24_domaincheck]' );
			}
			?>
			<div class="web-host-title">
				<<?php echo $settings['title_tag'];  ?> class="main-title"><?php echo __($settings['sub_title'],'finix'); ?></<?php echo $settings['title_tag'];  ?>>
			</div>

			<div class="web-host-list">
				<ul>
				<?php foreach ( $tabs as $index => $item ){ ?>
					<li><span><?php echo $item['tab_domain_title']; ?> </span><?php echo $item['tab_domain_content']; ?></li>
				<?php } ?>
				</ul>
			</div>
		</div>
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\finix_domain_check() );
?>
