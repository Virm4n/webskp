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
class finix_tab extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve tab widget name.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return __( 'finix_tab', 'finix' );
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve tab widget title.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Tabs', 'finix' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the tab widget belongs to.
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
	 * Retrieve tab widget icon.
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
	 * Register tab widget controls.
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
				'label' => __( 'Tabs', 'finix' ),
			)
		);

		$this->add_control(
			'tab-style',
			array(
				'label'   => __( 'Tab Style', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'tab-style1',
				'options' => array(
					'tab-style1' => __( 'Style 1', 'finix' ),
					'tab-style2' => __( 'Style 2', 'finix' ),
					'tab-style3' => __( 'Style 3', 'finix' ),
				),
			)
		);

		$this->add_control(
			'style1-border-color',
			array(
				'label'     => __( 'Border Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'tab-style' => array( 'tab-style1', 'tab-style3' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tab.tab-style1 .nav-tabs' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .tab.tab-style1 .nav-tabs .nav-item' => 'border-right-color: {{VALUE}};',
					'{{WRAPPER}} .tab.tab-style3 .nav-tabs' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .tab.tab-style3 .nav-tabs .nav-item' => 'border-right-color: {{VALUE}}; border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .tab.tab-style3 .tab-content' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tabs-border',
			array(
				'label'     => __( 'Tabs Border', 'finix' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array( 'tab-style' => array( 'tab-style2' ) ),
				'yes'       => __( 'yes', 'finix' ),
				'no'        => __( 'no', 'finix' ),
			)
		);

		$this->add_control(
			'tabs-border-color',
			array(
				'label'     => __( 'Border Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'tab-style'   => array( 'tab-style2' ),
					'tabs-border' => array( 'yes' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tab.tab-style2.tabs-border .nav-tabs .nav-link' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tabs-shadow',
			array(
				'label'     => __( 'Tabs Shadow', 'finix' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array( 'tab-style' => array( 'tab-style2' ) ),
				'yes'       => __( 'yes', 'finix' ),
				'no'        => __( 'no', 'finix' ),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'label'     => __( 'Tabs Shadow', 'finix' ),
				'name'      => 'image_box_shadow',
				'condition' => array(
					'tab-style'   => array( 'tab-style2' ),
					'tabs-shadow' => array( 'yes' ),
				),
				'exclude'   => array(
					'box_shadow_position',
				),
				'selector'  => '{{WRAPPER}} .tab.tab-style2.tabs-shadow .nav-tabs .nav-link',
			)
		);

		$this->add_responsive_control(
			'tabs_padding',
			[
				'label' => __( 'Padding', 'finix' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tab .nav-tabs .nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'finix' ),
				'type' => Controls_Manager::DIMENSIONS,
				'condition' => [
					'tab-style'=>['tab-style2'],
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tab.tab-style2 .nav-tabs .nav-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'icon-setting',
			array(
				'label' => __( 'Tabs Items', 'finix' ),
			)
		);

		$this->add_control(
			'icon-position',
			array(
				'label'     => __( 'Select Icon Position', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'icon-top',
				'condition' => array( 'tab-style' => array( 'tab-style2' ) ),
				'options'   => array(
					'icon-top'    => __( 'Top', 'finix' ),
					'icon-left'   => __( 'Left', 'finix' ),
					'icon-right	' => __( 'Right', 'finix' ),
				),
			)
		);

		$this->add_responsive_control(
			'tabs_icon_size',
			[
				'label' => __( 'Icon Size', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 24,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tab .nav-tabs .nav-link i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tabs_icon_spacing',
			[
				'label' => __( 'Icon Spacing', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => array( 'tab-style' => array( 'tab-style2' ) ),
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
					'{{WRAPPER}} .tab.tab-style2 .nav-tabs.icon-top .nav-link i' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tab.tab-style2 .nav-tabs.icon-left .nav-link i' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tab.tab-style2 .nav-tabs.icon-right .nav-link i' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'typography',
				'selector' => '{{WRAPPER}} .tab .nav-tabs .nav-link',
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title',
			array(
				'label'       => __( 'Tab Title', 'finix' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Tab Title', 'finix' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'tab_content',
			array(
				'label'       => __( 'Content', 'finix' ),
				'default'     => __( 'Tab Content', 'finix' ),
				'placeholder' => __( 'Tab Content', 'finix' ),
				'type'        => Controls_Manager::WYSIWYG,
				'show_label'  => false,
			)
		);

		$repeater->add_control(
			'media-type',
			array(
				'label'   => __( 'Icon / Image', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => array(
					'none'  => __( 'None', 'finix' ),
					'icon'  => __( 'Icon', 'finix' ),
					'image' => __( 'Image', 'finix' ),
				),
			)
		);

		$repeater->add_control(
			'finix-icon',
			array(
				'label'            => __( 'Icon', 'finix' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'condition'        => array(
					'media-type' => 'icon',
				),
				'default'          => array(
					'value' => 'fas fa-star',

				),
			)
		);

		$repeater->add_control(
			'image',
			array(
				'label'     => __( 'Choose Image', 'finix' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'media-type' => 'image',
				),
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater->add_control(
			'icon-shap',
			array(
				'label'     => __( 'Select Icon Shap', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'icon-square',
				'condition' => array( 'infobox-style' => array( 'style-border', 'style-flat' ) ),
				'options'   => array(
					'icon-square'  => __( 'Square', 'finix' ),
					'icon-round'   => __( 'Round', 'finix' ),
					'icon-rounded' => __( 'Rounded', 'finix' ),
				),
			)
		);

		$this->add_control(
			'tabs',
			array(
				'label'       => __( 'Tabs Items', 'finix' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'tab_title'   => __( 'Tab #1', 'finix' ),
						'tab_content' => __( 'We make websites are the number one ranked design, build and marketing team. Creative and beautiful websites that will make you more successful. sunt in culpa qui officia deserunt mollit anim id est laborum.', 'finix' ),
					),
					array(
						'tab_title'   => __( 'Tab #2', 'finix' ),
						'tab_content' => __( 'We make websites are the number one ranked design, build and marketing team. Creative and beautiful websites that will make you more successful. sunt in culpa qui officia deserunt mollit anim id est laborum.', 'finix' ),
					),
					array(
						'tab_title'   => __( 'Tab #3', 'finix' ),
						'tab_content' => __( 'We make websites are the number one ranked design, build and marketing team. Creative and beautiful websites that will make you more successful. sunt in culpa qui officia deserunt mollit anim id est laborum.', 'finix' ),
					),
				),
				'title_field' => '{{{ tab_title }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content-setting',
			array(
				'label' => __( 'Tabs Content', 'finix' ),
			)
		);

		$this->add_responsive_control(
			'tabs_content_spacing',
			[
				'label' => __( 'Content Padding', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => array( 'tab-style' => array( 'tab-style1','tab-style2' ) ),
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tab.tab-style1 .tab-content' => 'padding-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tab.tab-style2 .tab-content' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tabs_content_spacing3',
			[
				'label' => __( 'Content Padding', 'finix' ),
				'type' => Controls_Manager::DIMENSIONS,
				'condition' => array( 'tab-style' => array( 'tab-style3' ) ),
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tab.tab-style3 .tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_color',
			array(
				'label' => __( 'Tabs Color', 'finix' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => __( 'Normal', 'finix' ),
			)
		);

		$this->add_control(
			'tabs_text_color',
			array(
				'label'     => __( 'Text Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tab.tab-style1 .nav-tabs .nav-link' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tab.tab-style2 .nav-tabs .nav-link' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tab.tab-style3 .nav-tabs .nav-link' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tabs_icon_color',
			array(
				'label'     => __( 'Icon Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'condition' => array(
					'tab-style' => array( 'tab-style2', 'tab-style3' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .tab.tab-style2 .nav-tabs .nav-link i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tab.tab-style3 .nav-tabs .nav-link i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tabs_background_color',
			array(
				'label'     => __( 'Background Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'condition' => array(
					'tab-style' => array( 'tab-style2', 'tab-style3' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .tab.tab-style2 .nav-tabs .nav-link' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .tab.tab-style3 .nav-tabs .nav-link' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_button_active',
			array(
				'label' => __( 'Active', 'finix' ),
			)
		);

		$this->add_control(
			'tabs_active_color',
			array(
				'label'     => __( 'Active Text Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tab.tab-style1 .nav-tabs .nav-link.active' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tab.tab-style2 .nav-tabs .nav-link.active' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tab.tab-style3 .nav-tabs .nav-link.active' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tab.tab-style1 .nav-tabs .nav-link:before' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tabs_active_icon',
			array(
				'label'     => __( 'Active Icon Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'tab-style' => array( 'tab-style2', 'tab-style3' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .tab.tab-style2 .nav-tabs .nav-link.active i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tab.tab-style3 .nav-tabs .nav-link.active i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tabs_active_background',
			array(
				'label'     => __( 'Active Background Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'tab-style' => array( 'tab-style2', 'tab-style3' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tab.tab-style2 .nav-tabs .nav-link.active' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .tab.tab-style3 .nav-tabs .nav-link.active' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .tab.tab-style2 .nav-tabs .nav-link.active:after' => 'border-top-color: {{VALUE}};',

				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_section();

		$this->start_controls_section(
			'content_color',
			array(
				'label' => __( 'Content Color', 'finix' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'content_text_color',
			array(
				'label'     => __( 'Content Text Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'tab-style' => array('tab-style3' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tab.tab-style3 .tab-content' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tab.tab-style3 .tab-content .tab-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'content_bg_color',
			array(
				'label'     => __( 'Content BG Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'tab-style' => array('tab-style3' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tab.tab-style3 .tab-content' => 'background-color: {{VALUE}};',

				),
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

		$tabs = $this->get_settings_for_display( 'tabs' );

		$id_int = substr( $this->get_id_int(), 0, 3 );

		$tab_style = sprintf( '%1$s', esc_html( $settings['tab-style'], 'finix' ) );

		if ( $settings['tabs-border'] == 'yes' ) {
			$tab_style .= ' tabs-border';}
		if ( $settings['tabs-shadow'] == 'yes' ) {
			$tab_style .= ' tabs-shadow';}

		$icon_position = sprintf( '%1$s', esc_html( $settings['icon-position'], 'finix' ) );
		?>
	<div class="tab <?php echo $tab_style; ?>">
		<ul class="nav nav-tabs <?php echo $icon_position; ?>">
			<?php
			$i = 0;
			foreach ( $tabs as $index => $item ) {
				$media_html = '';

				$tab_count = $index + 1;

				if ( $item['media-type'] == 'image' ) {
					if ( ! empty( $item['image']['url'] ) ) {
						$this->add_render_attribute( 'image', 'src', $item['image']['url'] );
						$this->add_render_attribute( 'image', 'srcset', $item['image']['url'] );
						$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $item['image'] ) );
						$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $item['image'] ) );
						$media_html = Group_Control_Image_Size::get_attachment_image_html( $item, 'thumbnail', 'image' );
					}
				}
				if ( $item['media-type'] == 'icon' ) {
					$media_html = sprintf( '<i aria-hidden="true" class="%1$s"></i>', esc_attr( $item['finix-icon']['value'], 'finix' ) );
				}
				?>
			<li class="nav-item">
				<a class="nav-link 
				<?php
				if ( $i == 0 ) {
					$show = 'active show';
					echo esc_attr( $show );
					$i++; }
				?>
				" data-toggle="tab" href="#tab1-<?php echo esc_attr( $id_int . $tab_count ); ?>">
				<?php echo $media_html; ?><?php echo $item['tab_title']; ?></a>
			</li>
			<?php } ?>
		</ul>
		<div class="tab-content">
			<?php
			$i = 0;
			foreach ( $tabs as $index => $item ) {
				$tab_count = $index + 1;
				?>
			<div class="tab-pane fade 
				<?php
				if ( $i == 0 ) {
					$show = 'active show';
					echo esc_attr( $show );
					$i++; }
				?>
			" id="tab1-<?php echo esc_attr( $id_int . $tab_count ); ?>">
				<?php echo $this->parse_text_editor( $item['tab_content'] ); ?>
			</div>
			<?php } ?>
		</div>
	</div>
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\finix_tab() );
?>
