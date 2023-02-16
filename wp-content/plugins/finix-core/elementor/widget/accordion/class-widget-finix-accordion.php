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

class Finix_accordion extends Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve accordion widget name.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget name.
	 */

	public function get_name() {
		return __( 'finix_accordion', 'finix' );
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve accordion widget title.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	
	public function get_title() {
		return __( 'Accordion', 'finix' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the accordion widget belongs to.
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
	 * Retrieve accordion widget icon.
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
	 * Register accordion widget controls.
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
				'label' => __( 'General Setting', 'finix' ),
			]
		);

		$this->add_control(
			'accordion-style',
			[
				'label'      => __( 'Select Style', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'accordion-1',
				'options'    => [
					'accordion-1'          => __( 'Style 1', 'finix' ),
					'accordion-2'          => __( 'Style 2', 'finix' ),	
					'accordion-3'          => __( 'Style 3', 'finix' ),
					'accordion-4'          => __( 'Style 4', 'finix' ),
					'accordion-5'          => __( 'Style 5', 'finix' ),	
				],
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label' => __( 'Title HTML Tag', 'finix' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				],
				'default' => 'h6',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'items_section',
			[
				'label' => __( 'Accordion Items', 'finix' ),
			]
		);

		$repeater = new Repeater();

        $repeater->add_control(
			'tab_title',
			[
				'label' => __( 'Title & Description', 'finix' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Accordion Title', 'finix' ),
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tab_content',
			[
				'label' => __( 'Content', 'finix' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'Accordion Content', 'finix' ),
				'show_label' => false,
			]
		);

		$this->add_control(
			'tabs',
			[
				'label' => __( 'Accordion Items', 'finix' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tab_title' => __( ' These cases are perfectly simple.', 'finix' ),
						'tab_content' => __( 'We make websites are the number one ranked design, build and marketing team. Creative and beautiful websites that will make you more successful. sunt in culpa qui officia deserunt mollit anim id est laborum.', 'finix' ),
					],
					[
						'tab_title' => __( 'Etiam mollis libero vitae pulvinar bibendum.', 'finix' ),
						'tab_content' => __( 'We make websites are the number one ranked design, build and marketing team. Creative and beautiful websites that will make you more successful. sunt in culpa qui officia deserunt mollit anim id est laborum.', 'finix' ),
					],
					[
						'tab_title' => __( 'Sed do eiusmod tempor incididunt ut labore.', 'finix' ),
						'tab_content' => __( 'We make websites are the number one ranked design, build and marketing team. Creative and beautiful websites that will make you more successful. sunt in culpa qui officia deserunt mollit anim id est laborum.', 'finix' ),
					],
				],
				'title_field' => '{{{ tab_title }}}',
			]
		);


		$this->add_responsive_control(
			'accordion_space',
			[
				'label' => __( 'Accordion Spacing', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => ['accordion-style'=>['accordion-1','accordion-2','accordion-3','accordion-5']],
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
					'{{WRAPPER}} .accordion .card' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'accordion_radius',
			[
				'label' => __( 'Accordion Radius', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => [
					'accordion-style'=>['accordion-1','accordion-2','accordion-5']
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .accordion.accordion-1 .card-header button' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .accordion.accordion-2 .card-header button' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .accordion.accordion-5 .card' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section(); 

		$this->start_controls_section(
			'style_icon',
			[
				'label' => __( 'Icon Setting', 'finix' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'finix-icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'finix-icon',
			[
				'label' => __( 'Icon', 'finix' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-plus',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'chevron-down',
						'angle-down',
						'angle-double-down',
						'caret-down',
						'caret-square-down',
					],
					'fa-regular' => [
						'caret-square-down',
					],
				],
				'skin' => 'inline',
				'label_block' => false,
			]
		);

		$this->add_control(
			'active-icon',
			[
				'label' => __( 'Active Icon', 'finix' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon_active',
				'default' => [
					'value' => 'fas fa-minus',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'chevron-up',
						'angle-up',
						'angle-double-up',
						'caret-up',
						'caret-square-up',
					],
					'fa-regular' => [
						'caret-square-up',
					],
				],
				'skin' => 'inline',
				'label_block' => false,
				'condition' => [
					'finix-icon[value]!' => '',
				],
			]
		);


		$this->add_control(
			'icon_position',
			[
				'label' => __( 'Alignment', 'finix' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'accordion-icon-left' => [
						'title' => __( 'Start', 'finix' ),
						'icon' => 'eicon-h-align-left',
					],
					'accordion-icon-right' => [
						'title' => __( 'End', 'finix' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				//'default' => is_rtl() ? 'accordion-icon-right' : 'accordion-icon-left',
				'default' => 'accordion-icon-left',
				'toggle' => false,
			]
		);

		$this->add_control(
			'icon-style',
			[
				'label'      => __( 'Icon Type', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'icon-default',
				'options'    => [
					'icon-default'          => __( 'Default', 'finix' ),
					'icon-flat'          => __( 'Flat', 'finix' ),			
				]
			]
		);

		$this->start_controls_tabs( 'accordion_icon_style' );

			$this->start_controls_tab(
				'accordion_icon_normal',
				array(
					'label' => __( 'Normal', 'finix' ),
				)
			);

			$this->add_control(
				'normal_icon_color',
				[
					'label' => __( 'Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .accordion .card-header .elementor-accordion-icon-closed i' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'normal_icon_bg_color',
				[
					'label' => __( 'Background Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'condition' => [
						'icon-style'=>['icon-flat']
					],
					'selectors' => [
						'{{WRAPPER}} .accordion.icon-flat .card-header .elementor-accordion-icon-closed i' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'accordion_icon_active',
				array(
					'label' => __( 'Active', 'finix' ),
				)
			);

			$this->add_control(
				'active_icon_color',
				[
					'label' => __( 'Active Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .accordion .card-header .elementor-accordion-icon-opened i' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'active_icon_bg_color',
				[
					'label' => __( 'Active Background Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'condition' => [
						'icon-style'=>['icon-flat']
					],
					'selectors' => [
						'{{WRAPPER}} .accordion.icon-flat .card-header .elementor-accordion-icon-opened i' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 13,   
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .accordion .card-header .accordion-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_radius',
			[
				'label' => __( 'Icon Radius', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => [
					'icon-style'=>['icon-flat']
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .accordion.icon-flat .card-header .elementor-accordion-icon-closed i' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .accordion.icon-flat .card-header .elementor-accordion-icon-opened i' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Spacing', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .accordion .accordion-icon-left .elementor-accordion-icon-opened' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .accordion .accordion-icon-left .elementor-accordion-icon-closed' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .accordion .accordion-icon-right .elementor-accordion-icon-opened' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .accordion .accordion-icon-right .elementor-accordion-icon-closed' => 'margin-left: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .accordion .accordion-icon-left .elementor-accordion-icon-opened' => 'margin-left: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .accordion .accordion-icon-left .elementor-accordion-icon-closed' => 'margin-left: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .accordion .accordion-icon-right .elementor-accordion-icon-opened' => 'margin-right: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .accordion .accordion-icon-right .elementor-accordion-icon-closed' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_toggle_style_title',
			[
				'label' => __( 'Title', 'finix' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'     => 'typography',
					'label'    => __( 'Title Typography', 'finix' ),
					'selector' => '{{WRAPPER}} .accordion .card-header .accordion-title button',
				)
			);

			$this->add_responsive_control(
				'accordion_border_width',
				[
					'label' => __( 'Border Width', 'finix' ),
					'type' => Controls_Manager::SLIDER,
					'condition' => ['accordion-style'=>['accordion-2','accordion-3','accordion-4']],
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
						'{{WRAPPER}} .accordion.accordion-2 .card-header .accordion-title button' => 'border-width: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .accordion.accordion-3 .card' => 'border-bottom-width: {{SIZE}}{{UNIT}} !important;',
						'{{WRAPPER}} .accordion.accordion-4' => 'border-width: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .accordion.accordion-4 .card-header .accordion-title button' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .accordion.accordion-4 .card .card-body' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'accordion_3-4_border_color',
				array(
					'label'     => __( 'Border Color', 'finix' ),
					'type'      => Controls_Manager::COLOR,
					'condition' => ['accordion-style'=>['accordion-3','accordion-4']],
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} .accordion.accordion-3 .card' => 'border-bottom-color: {{VALUE}} !important;',
						'{{WRAPPER}} .accordion.accordion-4' => 'border-color: {{VALUE}};',
						'{{WRAPPER}} .accordion.accordion-4 .card-header .accordion-title button' => 'border-color: {{VALUE}};',
						'{{WRAPPER}} .accordion.accordion-4 .card .card-body' => 'border-color: {{VALUE}};',
					),
				)
			);

		$this->start_controls_tabs( 'accordion_color_style' );

			$this->start_controls_tab(
				'accordion_normal',
				array(
					'label' => __( 'Normal', 'finix' ),
				)
			);

			$this->add_control(
				'accordion_normal_title_color',
				array(
					'label'     => __( 'Title Color', 'finix' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} .accordion .card-header .accordion-title button.collapsed' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'accordion_normal_border_color',
				array(
					'label'     => __( 'Border Color', 'finix' ),
					'type'      => Controls_Manager::COLOR,
					'condition' => ['accordion-style'=>['accordion-2']],
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} .accordion .card-header .accordion-title button.collapsed' => 'border-color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'accordion_normal_bg_color',
				array(
					'label'     => __( 'Background Color', 'finix' ),
					'type'      => Controls_Manager::COLOR,
					'condition' => ['accordion-style'=>['accordion-1','accordion-4','accordion-5']],
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} .accordion .card-header .accordion-title button.collapsed' => 'background: {{VALUE}};',
					),
				)
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'accordion_active',
				array(
					'label' => __( 'Active', 'finix' ),
				)
			);

			$this->add_control(
				'accordion_active_title_color',
				array(
					'label'     => __( 'Title Color', 'finix' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .accordion .card-header .accordion-title button' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'accordion_active_border_color',
				array(
					'label'     => __( 'Border Color', 'finix' ),
					'type'      => Controls_Manager::COLOR,
					'condition' => ['accordion-style'=>['accordion-2']],
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} .accordion .card-header .accordion-title button' => 'border-color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'accordion_active_bg_color',
				array(
					'label'     => __( 'Background Color', 'finix' ),
					'type'      => Controls_Manager::COLOR,
					'condition' => ['accordion-style'=>['accordion-1','accordion-2','accordion-4','accordion-5']],
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} .accordion .card-header .accordion-title button' => 'background: {{VALUE}};',
					),
				)
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'accordion_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'condition' => ['accordion-style'	=>['accordion-1','accordion-2','accordion-4','accordion-5']],
				'selector' => '{{WRAPPER}} .accordion.accordion-1 .card-header .accordion-title button,
				{{WRAPPER}} .accordion.accordion-2 .card-header .accordion-title button,
				{{WRAPPER}} .accordion.accordion-4 .card-header .accordion-title button,
				{{WRAPPER}} .accordion.accordion-5 .card',
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => __( 'Padding', 'finix' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .accordion .card-header .accordion-title button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_toggle_style_content',
			[
				'label' => __( 'Content', 'finix' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'contact_typography',
				'label'    => __( 'Contact Typography', 'finix' ),
				'selector' => '{{WRAPPER}} .accordion .card-body',
			)
		);

		$this->add_control(
			'content_background_color',
			[
				'label' => __( 'Background', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .accordion .card-body' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .accordion .card-body' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Padding', 'finix' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .accordion .card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$settings = $this->get_settings_for_display();
		$migrated = isset( $settings['__fa4_migrated']['finix-icon'] );

		if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// @todo: remove when deprecated
			// added as bc in 2.6
			// add old default
			$settings['icon'] = 'fa fa-plus';
			$settings['icon_active'] = 'fa fa-minus';
			$settings['icon_position'] = $this->get_settings( 'icon_position' );
		}

		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
		$has_icon = ( ! $is_new || ! empty( $settings['finix-icon']['value'] ) );
		$id_int = substr( $this->get_id_int(), 0, 3 );

		$icon_style = sprintf('%1$s',esc_html($settings['icon-style'],'finix'));

		$accordion_style = sprintf('%1$s',esc_html($settings['accordion-style'],'finix'));

		$i=1;

		?>
		<div class="accordion <?php echo $accordion_style; ?> <?php echo $icon_style; ?>" id="accordion<?php echo esc_attr( $id_int); ?>">
			<?php 
			foreach ( $settings['tabs'] as $index => $item ) : 
			$tab_count = $index + 1;
	
			?>
			<div class="card">
				<div class="card-header" id="heading-<?php echo esc_attr( $id_int . $tab_count ); ?>">
				<<?php echo $settings['title_html_tag']; ?> class="accordion-title">
					<button type="button" data-toggle="collapse" data-target="#accordion-<?php echo esc_attr( $id_int . $tab_count ); ?>" aria-expanded="true" class="<?php  if($i != 1){ $coll = "collapsed"; echo esc_attr( $coll ); $i++; } ?>" aria-controls="accordion-<?php echo esc_attr( $id_int . $tab_count ); ?>">
					<span class="accordion-icon <?php echo esc_attr( $settings['icon_position'] ); ?>">
						<?php
						if ( $is_new || $migrated ) { ?>
							<span class="elementor-accordion-icon-closed"><?php Icons_Manager::render_icon( $settings['finix-icon'] ); ?></span>
							<span class="elementor-accordion-icon-opened"><?php Icons_Manager::render_icon( $settings['active-icon'] ); ?></span>
						<?php } else { ?>
							<i class="elementor-accordion-icon-closed <?php echo esc_attr( $settings['icon'] ); ?>"></i>
							<i class="elementor-accordion-icon-opened <?php echo esc_attr( $settings['icon_active'] ); ?>"></i>
						<?php } ?>
					</span>
					<span class="finix-accordion-title"><?php echo $item['tab_title']; ?></span>
					</button>
				</<?php echo $settings['title_html_tag']; ?>>
				</div>
				
				<?php  ?>
				<div id="accordion-<?php echo esc_attr( $id_int . $tab_count ); ?>"  class="collapse <?php  if($i == 1){ $show = "show"; echo esc_attr( $show ); $i++; } ?>" aria-labelledby="heading-<?php echo esc_attr( $id_int . $tab_count ); ?>" data-parent="#accordion<?php echo esc_attr( $id_int); ?>">
				<div class="card-body">
					<?php echo $this->parse_text_editor( $item['tab_content'] ); ?>
				</div>
				</div>
				<?php ?>
			</div>
			<?php 
			endforeach; ?>
		</div>
		<?php
	}   
}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Finix_accordion() );
?>