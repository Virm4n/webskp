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

class social_icons extends Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve social_icons widget name.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget name.
	 */

	public function get_name() {
		return __( 'social_icons', 'finix' );
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve social_icons widget title.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	
	public function get_title() {
		return __( 'Social Icons', 'finix' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the social_icons widget belongs to.
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
	 * Retrieve social_icons widget icon.
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
	 * Register social_icons widget controls.
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
			'icon-style',
			[
				'label'      => __( 'Select Style', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'style-default',
				'options'    => [
					'style-default'          => __( 'Default', 'finix' ),
					'style-border'          => __( 'Border', 'finix' ),
					'style-flat'          => __( 'Flat', 'finix' ),			
				],
			]
		);

		$this->add_control(
			'icon-style2',
			[
				'type'       => Controls_Manager::SELECT,
				'condition' => [
					'icon-style'=>['style-flat']
				],
				'default'    => 'icon-default',
				'options'    => [
					'icon-default'          => __( 'Default', 'finix' ),
					'icon-full-section'     => __( 'Full Section', 'finix' ),			
				],
			]
		);

		$this->add_control(
			'icon-hover-style',
			[
				'label'      => __( 'Icon Hover Style', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'hover-1',
				'options'    => [
					'hover-default'     => __( 'Default', 'finix' ),
					'hover-top'         => __( 'Top', 'finix' ),
					'hover-zoom'        => __( 'Zoom', 'finix' ),
					'hover-animation'   => __( 'Animation', 'finix' ),			
				],
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

		$this->add_responsive_control(
			'icon-size',
			[
				'label' => __( 'Icon Size', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'separator'        => 'before',
				'default' => [
					'size' => 16,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .social-icons li a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon-padding',
			[
				'label' => __( 'Icon Padding', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.5,
					'unit' => 'em',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .social-icons li a' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon-margin',
			[
				'label' => __( 'Icon Space', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .social-icons .social-info' => 'grid-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon-border',
			[
				'label' => __( 'Icon Border', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => [
					'icon-style'=>['style-border','style-flat']
				],
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .social-icons.style-border li a' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .social-icons.style-flat li a' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon-radius',
			[
				'label' => __( 'Icon Radius', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => [
					'icon-style'=>['style-border','style-flat']
				],
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .social-icons.style-border li a' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .social-icons.style-flat li a' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);	
		
		$this->end_controls_section(); 

		$this->start_controls_section(
			'icon_items',
			array(
				'label' => __( 'Icon Items', 'finix' ),
			)
		);

		$repeater = new Repeater();
		
		$repeater->add_control(
			'tab_icon',
			[
				'label' => __( 'Icon', 'finix' ),
				'type' => Controls_Manager::ICONS,
				'separator' => 'before',
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fab fa-facebook-f',
					'library' => 'fa-solid',
				],
				'skin' => 'inline',
				'label_block' => false,
				'svg' => false,
			]
		);

		$repeater->add_control(
			'tab_link',
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

		$repeater->start_controls_tabs('social_icon_color');

			$repeater->start_controls_tab(
				'icon_color_normal',
				[
					'label' => __( 'Normal', 'finix' ),
				]
			);

			$repeater->add_control(
				'icon_color',
				[
					'label' => __( 'Icon Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .social-icons .social-info li a{{CURRENT_ITEM}}' => 'color: {{VALUE}};',
					],
				]
			);

			$repeater->add_control(
				'icon_border_color',
				[
					'label' => __( 'Border Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .social-icons.style-border .social-info li a{{CURRENT_ITEM}}' => 'border-color: {{VALUE}};',
					],
				]
			);

			$repeater->add_control(
				'icon_bg_color',
				[
					'label' => __( 'Background Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .social-icons.style-flat li a{{CURRENT_ITEM}}' => 'background: {{VALUE}};',
					],
				]
			);

			$repeater->end_controls_tab();

			$repeater->start_controls_tab(
				'icon_color_hover',
				[
					'label' => __( 'Hover', 'finix' ),
				]
			);

			$repeater->add_control(
				'icon_hover_color',
				[
					'label' => __( 'Icon Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .social-icons .social-info li a{{CURRENT_ITEM}}:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$repeater->add_control(
				'icon_hover_border_color',
				[
					'label' => __( 'Border Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .social-icons .social-info li a{{CURRENT_ITEM}}:hover' => 'border-color: {{VALUE}};',
					],
				]
			);

			$repeater->add_control(
				'icon_bg_hover_color',
				[
					'label' => __( 'Background Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .social-icons .social-info li a{{CURRENT_ITEM}}:hover' => 'background: {{VALUE}};',
					],
				]
			);

			$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'tabs',
			array(
				'label'       => __( 'Tabs Items', 'finix' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default' => [
					[
						'tab_icon' => [
							'value' => 'fab fa-facebook',
							'library' => 'fa-brands',
						],
						'tab_link' => __( '#', 'finix' ),
					]
				],
				'title_field' => '<# var migrated = "undefined" !== typeof __fa4_migrated, social = ( "undefined" === typeof social ) ? false : social; #>{{{ elementor.helpers.getSocialNetworkNameFromIcon( tab_icon, social, true, migrated, true ) }}}',
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

		$align = $settings['align'];

		$tabs = $this->get_settings_for_display( 'tabs' );

		$icon_style = sprintf('%1$s',esc_html($settings['icon-style'],'finix'));

		$icon_style2 = sprintf('%1$s',esc_html($settings['icon-style2'],'finix'));

		$icon_hover_style = sprintf('%1$s',esc_html($settings['icon-hover-style'],'finix'));
		?>
		<div class="social-icons <?php echo $icon_style; ?> <?php echo $icon_style2; ?> <?php echo esc_attr($align);?>">
			<ul class="social-info <?php echo $icon_hover_style; ?>">
				<?php foreach ( $tabs as $index => $item ){
					$migrated = isset( $item['__fa4_migrated']['tab_icon'] );

					if ( ! isset( $item['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
					// @todo: remove when deprecated
					// added as bc in 2.6
					// add old default
					$item['icon'] = 'fa fa-plus';
					$item['icon_active'] = 'fa fa-minus';
					}

					$is_new = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed();
					$has_icon = ( ! $is_new || ! empty( $item['tab_icon']['value'] ) );

			
					$link_key = 'link_' . $index;

					$this->add_render_attribute( $link_key, 'class', [
						'elementor-repeater-item-' . $item['_id'],
					] );

					$this->add_link_attributes( $link_key, $item['tab_link'] );


					if ( ! empty( $item['tab_link']['url'] ) ) {
						$this->add_link_attributes( 'button', $item['tab_link'] );
					}
				 ?>
					<li><a <?php echo $this->get_render_attribute_string( $link_key ); ?>><?php Icons_Manager::render_icon( $item['tab_icon'] ); ?></a></li>
				<?php } ?>
			</ul>
		</div>
		<?php
    }	    	
}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\social_icons() );
?>