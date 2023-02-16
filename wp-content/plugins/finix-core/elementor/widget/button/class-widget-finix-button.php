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

class finix_button extends Widget_Base {
	
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
		return __( 'finix_button', 'finix' );
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
		return __( 'Buttton', 'finix' );
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
				'label' => __( 'Buttton', 'finix' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .btn-default',
			]
		);

		$this->add_control(
			'button-style',
			[
				'label'      => __( 'Button Type', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'style-default',
				'options'    => [
					'style-default'          => __( 'Link', 'finix' ),
					'style-border'          => __( 'Border', 'finix' ),
					'style-flat'          => __( 'Flat', 'finix' ),			
				],
			]
		);

        $this->add_control(
			'text',
			[
				'label' => __( 'Text', 'finix' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Click here', 'finix' ),
				'placeholder' => __( 'Click here', 'finix' ),
			]
		);

		$this->add_control(
			'link',
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

		$this->add_control(
			'hover-effect',
			[
				'label'      => __( 'Hover Effect', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'condition'  => [
					'button-style'=>['style-border', 'style-flat'],
				],
				'default'    => 'hover-default',
				'options'    => [
					'hover-default'       => __( 'Default', 'finix' ),
					'hover-slide-top'     => __( 'Slide Top', 'finix' ),
					'hover-slide-bottom'  => __( 'Slide Bottom', 'finix' ),
					'hover-slide-left'    => __( 'Slide Left', 'finix' ),
					'hover-slide-right'   => __( 'Slide Right', 'finix' ),		
				],
			]
		);

		$this->add_control(
			'top_hover',
			[
				'label' => __( 'Top on Hover', 'finix' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition' => [
					'button-style'=>['style-border', 'style-flat'],
				],
				'yes' => __( 'On', 'finix' ),
				'no' => __( 'Off', 'finix' ),
			]
        );

        $this->add_control(
			'btn_full',
			[
				'label' => __( 'Button Full Width', 'finix' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition' => [
					'button-style'=>['style-border', 'style-flat'],
				],
				'yes' => __( 'On', 'finix' ),
				'no' => __( 'Off', 'finix' ),
			]
        );

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __( 'Padding', 'finix' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'separator'  => 'before',
				'condition' => [
					'button-style'=>['style-border', 'style-flat'],
				],
				'selectors' => [
					'{{WRAPPER}} .btn-default.style-border' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .btn-default.style-flat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'finix' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'condition' => [
					'button-style'=>['style-border', 'style-flat'],
				],
				'selectors' => [
					'{{WRAPPER}} .btn-default.style-border' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .btn-default.style-flat' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn-align',
			[
				'label' => __( 'Alignment', 'finix' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'text-left'    => [
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
					],
				],
				'prefix_class' => 'finix%s-align-',
				'default' => '',
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
				'label'      => __( 'Icon / Image', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'icon',
				'options'    => [
					'none'          => __( 'None', 'finix' ),
					'icon'          => __( 'Icon', 'finix' ),			
				]
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label' => __( 'Icon', 'finix' ),
				'type' => Controls_Manager::ICONS,
				'condition' => [
					'media-type' => 'icon',
				],
				'fa4compatibility' => 'icon',
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' => __( 'Icon Position', 'finix' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'left',
				'condition' => [
					'media-type' => 'icon',
				],
				'options' => [
					'left' => [
						'title' => __( 'Left', 'finix' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'finix' ),
						'icon' => 'eicon-h-align-right',
					],
				],
			]
		);

		$this->add_control(
			'icon_animation',
			[
				'label' => __( 'Icon Animation', 'finix' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition' => [
					'button-style'=>['style-border', 'style-flat'],
				],
				'yes' => __( 'On', 'finix' ),
				'no' => __( 'Off', 'finix' ),
			]
        );

        $this->add_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => [
					'media-type' => 'icon',
				],
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .button-wrapper  .finix-button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'icon_spacing',
			[
				'label' => __( 'Icon Spacing', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => [
					'media-type' => 'icon',
				],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .btn-default .finix-align-icon-left' => 'padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .btn-default .finix-align-icon-right' => 'padding-left: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .btn-default .finix-align-icon-left' => 'padding-left: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .btn-default .finix-align-icon-right' => 'padding-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_css_id',
			[
				'label' => __( 'Button ID', 'finix' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => '',
				'title' => __( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'finix' ),
				'description' => __( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'finix' ),
				'separator' => 'before',

			]
		);

		
		$this->end_controls_section(); 
		
		$this->start_controls_section(
			'section_color',
			[
				'label' => __( 'Button Color', 'finix' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->start_controls_tabs( 'tabs_button_style' );

		
		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'finix' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .btn-default' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'border-color',
			[
				'label' => __( 'Border Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'button-style'=>['style-border'],
				],
				'selectors' => [
					'{{WRAPPER}} .btn-default.style-border' => 'border-color: {{VALUE}};',
		 		],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __( 'Background Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'button-style'=>['style-default','style-flat'],
				],
				'selectors' => [
					'{{WRAPPER}} .btn-default.style-default:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .btn-default.style-default:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .btn-default.style-flat' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'value_gradiant_color',
				'label' => __( 'Gradient Background', 'finix' ),
				'condition' => [
					'button-style'=>['style-flat'],
				],
                'types' => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .btn-default.style-flat',
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'finix' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => __( 'Text Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn-default:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'button-style'=>['style-border'],
				],
				'selectors' => [
					'{{WRAPPER}} .btn-default.style-border:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' => __( 'Background Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn-default.style-default:hover:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .btn-default.style-default:hover:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .btn-default.style-border:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .btn-default.style-flat:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'value_gradiant_color_hover',
				'label' => __( 'Gradient Hover Background', 'finix' ),
				'condition' => [
					'button-style'=>['style-flat'],
				],
                'types' => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .btn-default.style-flat:before',
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

		$btn_align = $settings['btn-align'];

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'button', $settings['link'] );
			$this->add_render_attribute( 'button', 'class', 'btn-default default-theme btn-icon' );
			$this->add_render_attribute( 'button', 'class', $settings['button-style'] );
			$this->add_render_attribute( 'button', 'class', $settings['hover-effect'] );
		}

		if ( ! empty( $settings['button_css_id'] ) ) {
			$this->add_render_attribute( 'button', 'id', $settings['button_css_id'] );
		}

		if($settings['top_hover'] == 'yes'){
			$this->add_render_attribute( 'button', 'class', 'btn-top-hover' );
		}

		if($settings['btn_full'] == 'yes'){
			$this->add_render_attribute( 'button', 'class', 'btn-full-width' );
		}

		if($settings['icon_animation'] == 'yes'){
			$this->add_render_attribute( 'button', 'class', 'icon-animation' );
		}

		?>
		<div class="button-wrapper <?php echo esc_attr( $btn_align ); ?>">
			<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
				<?php $this->render_text(); ?>
			</a>
		</div>
	<?php
	}
	
	/**
	 * Render button text.
	 *
	 * Render button widget text.
	 *
	 * @since 1.5.0
	 * @access protected
	 */
	protected function render_text() {
		$settings = $this->get_settings_for_display();

		$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

		if ( ! $is_new && empty( $settings['icon_align'] ) ) {
			// @todo: remove when deprecated
			// added as bc in 2.6
			//old default
			$settings['icon_align'] = $this->get_settings( 'icon_align' );
		}

		$this->add_render_attribute( [
			'content-wrapper' => [
				'class' => 'finix-button-inner',
			],
			'icon-align' => [
				'class' => [
					'finix-button-icon',
					'finix-align-icon-' . $settings['icon_align'],
				],
			],
			'text' => [
				'class' => 'finix-button-text',
			],
		] );

		$this->add_inline_editing_attributes( 'text', 'none' );
		?>
		<span <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>
			<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ) : ?>
			<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
				<?php if ( $is_new || $migrated ) :
					Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
				else : ?>
					<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
				<?php endif; ?>
			</span>
			<?php endif; ?>
			<span <?php echo $this->get_render_attribute_string( 'text' ); ?>><?php echo $settings['text']; ?></span>
		</span>
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\finix_button() );
?>