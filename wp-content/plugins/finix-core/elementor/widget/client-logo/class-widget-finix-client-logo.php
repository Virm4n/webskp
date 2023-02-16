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

class client_logo extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve client logo widget name.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget name.
	 */

	public function get_name() {
		return __( 'client_logo', 'finix' );
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve client logo widget title.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */

	public function get_title() {
		return __( 'Client Logo', 'finix' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the client logo widget belongs to.
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
	 * Retrieve client logo widget icon.
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
	 * Register client logo widget controls.
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
				'label' => __( 'Genral Setting', 'finix' ),
			)
		);

		$this->add_control(
			'image-style',
			array(
				'label'   => __( 'Image Style', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-default',
				'options' => array(
					'style-default'   => __( 'Default', 'finix' ),
					'style-border'    => __( 'Border', 'finix' ),
					'style-greyscale' => __( 'Greyscale', 'finix' ),
				),
			)
		);

		$this->add_control(
			'client-style',
			array(
				'label'   => __( 'Select Style', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'slider',
				'options' => array(
					'slider' => __( 'Slider', 'finix' ),
					'grid'   => __( 'Gride', 'finix' ),
				),
			)
		);

		$this->add_control(
			'grid-option',
			array(
				'label'     => __( 'Gride Option', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'grid-column-2',
				'condition' => array( 'client-style' => array( 'grid' ) ),
				'options'   => array(
					'grid-column-2' => __( '2 Column', 'finix' ),
					'grid-column-3' => __( '3 Column', 'finix' ),
					'grid-column-4' => __( '4 Column', 'finix' ),
					'grid-column-5' => __( '5 Column', 'finix' ),
					'grid-column-6' => __( '6 Column', 'finix' ),
				),
			)
		);

		$this->add_control(
			'mobile-grid-option',
			array(
				'label'     => __( 'Mobile Gride', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'mob-column-2',
				'condition' => array( 'client-style' => array( 'grid' ) ),
				'options'   => array(
					'mob-column-1' => __( '1 Column', 'finix' ),
					'mob-column-2' => __( '2 Column', 'finix' ),
					'mob-column-3' => __( '3 Column', 'finix' ),
				),
			)
		);

		$this->add_control(
			'slider-desk',
			array(
				'label'       => __( 'Desktop view', 'finix' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array( 'client-style' => array( 'slider' ) ),
				'label_block' => true,
				'default'     => '5',
			)
		);

		$this->add_control(
			'slider-laptop',
			array(
				'label'       => __( 'Laptop view', 'finix' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array( 'client-style' => array( 'slider' ) ),
				'label_block' => true,
				'default'     => '4',
			)
		);

		$this->add_control(
			'slider-tab',
			array(
				'label'       => __( 'Tablet view', 'finix' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array( 'client-style' => array( 'slider' ) ),
				'label_block' => true,
				'default'     => '3',
			)
		);

		$this->add_control(
			'slider-mobile',
			array(
				'label'       => __( 'Mobile view', 'finix' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array( 'client-style' => array( 'slider' ) ),
				'label_block' => true,
				'default'     => '2',
			)
		);

		$this->add_control(
			'slider-mobile-portal',
			array(
				'label'       => __( 'Mobile Portal View', 'finix' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array( 'client-style' => array( 'slider' ) ),
				'label_block' => true,
				'default'     => '1',
			)
		);

		$this->add_control(
			'autoplay',
			array(
				'label'     => __( 'Autoplay', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'true',
				'condition' => array( 'client-style' => array( 'slider' ) ),
				'options'   => array(
					'true'  => __( 'True', 'finix' ),
					'false' => __( 'False', 'finix' ),

				),
			)
		);

		$this->add_control(
			'loop',
			array(
				'label'     => __( 'Loop', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'true',
				'condition' => array( 'client-style' => array( 'slider' ) ),
				'options'   => array(
					'true'  => __( 'True', 'finix' ),
					'false' => __( 'False', 'finix' ),

				),
			)
		);

		$this->add_control(
			'slider-dots',
			array(
				'label'     => __( 'Dots', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'true',
				'condition' => array( 'client-style' => array( 'slider' ) ),
				'options'   => array(
					'true'  => __( 'True', 'finix' ),
					'false' => __( 'False', 'finix' ),

				),
			)
		);

		$this->add_control(
			'slider-arrow',
			array(
				'label'     => __( 'Arrow', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'true',
				'condition' => array( 'client-style' => array( 'slider' ) ),
				'options'   => array(
					'true'  => __( 'True', 'finix' ),
					'false' => __( 'False', 'finix' ),

				),
			)
		);

		$this->add_control(
			'arrow-style',
			array(
				'label'   => __( 'Arrow Style', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'condition' => array(
					'client-style' => array( 'slider' ),
					'slider-arrow' => array( 'true' )
				),
				'default' => 'arrow-default',
				'options' => array(
					'arrow-default' => __( 'Default', 'finix' ),
					'arrow-style2'  => __( 'Style 2', 'finix' ),
					'arrow-style3' 	=> __( 'Style 3', 'finix' ),
				),
			)
		);

		$this->add_responsive_control(
			'data-space',
			array(
				'label'     => __( 'Margin', 'elementor' ),
				'condition' => array( 'client-style' => array( 'slider' ) ),
				'type'      => Controls_Manager::SLIDER,
			)
		);

		$this->add_responsive_control(
			'grid-margin',
			[
				'label' => __( 'Margin', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => array( 'client-style' => array( 'grid' ) ),
				'default' => [
					'size' => 20,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .client-logo-main .client-logo-inner.grid-column-1' => 'grid-gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .client-logo-main .client-logo-inner.grid-column-2' => 'grid-gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .client-logo-main .client-logo-inner.grid-column-3' => 'grid-gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .client-logo-main .client-logo-inner.grid-column-4' => 'grid-gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .client-logo-main .client-logo-inner.grid-column-5' => 'grid-gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .client-logo-main .client-logo-inner.grid-column-6' => 'grid-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'finix' ),
				'type' => Controls_Manager::DIMENSIONS,
				'condition' => [
					'image-style'=>['style-border'],
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .client-logo-main.style-border .client-logo' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'client-items',
			array(
				'label' => __( 'Client Logo', 'finix' ),
			)
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'image',
			array(
				'label'   => __( 'Client Image', 'finix' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array(
					'active' => true,
				),

				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater->add_control(
			'link',
			array(
				'label'       => __( 'Link', 'finix' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => __( 'https://your-link.com', 'finix' ),
				'default'     => array(
					'url' => '#',
				),
			)
		);

		$this->add_control(
			'tabs',
			array(
				'label'  => __( 'Skill Items', 'finix' ),
				'type'   => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_color',
			[
				'label' => __( 'Slider Control Color', 'finix' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'logo-padding',
			[
				'label' => __( 'Logo Padding', 'finix' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .client-logo-main.style-border .client-logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'logo_border_color',
			[
				'label' => __( 'Border Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'image-style' => 'style-border',
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .client-logo-main.style-border .client-logo' => 'border-color: {{VALUE}};',
				],
			]
		);	

		$this->start_controls_tabs( 
			'slider_arrow_style',
			array(
				'condition' => [
					'client-style'=>['slider']
				],
			)
		);

		$this->start_controls_tab(
			'slider_arrow_normal',
			[
				'label' => __( 'Normal', 'finix' ),
			]
		);

		$this->add_control(
			'bullet_color',
			[
				'label' => __( 'Bullet Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => array( 'client-style' => array( 'slider' )),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .client-logo-main .swiper-container .swiper-pagination-bullet' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'arrow_color',
			[
				'label' => __( 'Arrow Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .swiper-container .swiper-button-next i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .swiper-container .swiper-button-prev i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'arrow_bg_color',
			[
				'label' => __( 'Arrow BG Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'arrow-style'=>['arrow-default', 'arrow-style2'],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .swiper-container .swiper-button-next i' => 'background: {{VALUE}};',
					'{{WRAPPER}} .swiper-container .swiper-button-prev i' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'slider_arrow_hover',
			[
				'label' => __( 'Hover', 'finix' ),
			]
		);

		$this->add_control(
			'bullet_active_color',
			[
				'label' => __( 'Bullet Active Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => array( 'client-style' => array( 'slider' )),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .client-logo-main .swiper-container .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background: {{VALUE}};',
					'{{WRAPPER}} .client-logo-main .swiper-container .swiper-pagination-bullet.swiper-pagination-bullet-active:before' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'arrow_hover_color',
			[
				'label' => __( 'Arrow Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-container .swiper-button-next:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .swiper-container .swiper-button-prev:hover i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'arrow_bg_hover_color',
			[
				'label' => __( 'Arrow BG Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .swiper-container .swiper-button-next:hover i' => 'background: {{VALUE}};',
					'{{WRAPPER}} .swiper-container .swiper-button-prev:hover i' => 'background: {{VALUE}};',
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
		$tabs     = $this->get_settings_for_display( 'tabs' );

		$image_style = sprintf( '%1$s', esc_html( $settings['image-style'], 'finix' ) );
		$arrow_style = sprintf( '%1$s', esc_html( $settings['arrow-style'], 'finix' ) );
		?>
		<div class="client-logo-main <?php echo $image_style; ?> <?php echo $arrow_style; ?>">
		<?php
		if ( $settings['client-style'] === 'slider' ) {

			$this->add_render_attribute( 'client', 'class', 'swiper-container' );
			$this->add_render_attribute( 'client', 'data-items', $settings['slider-desk'] );
			$this->add_render_attribute( 'client', 'data-lg-items', $settings['slider-laptop'] );
			$this->add_render_attribute( 'client', 'data-md-items', $settings['slider-tab'] );
			$this->add_render_attribute( 'client', 'data-sm-items', $settings['slider-mobile'] );
			$this->add_render_attribute( 'client', 'data-xs-items', $settings['slider-mobile-portal'] );
			$this->add_render_attribute( 'client', 'data-space', $settings['data-space']['size'] );
			$this->add_render_attribute( 'client', 'data-arrow', $settings['slider-arrow'] );
			$this->add_render_attribute( 'client', 'data-bullets', $settings['slider-dots'] );
			$this->add_render_attribute( 'client', 'data-autoplay', $settings['autoplay'] );
			$this->add_render_attribute( 'client', 'data-loop', $settings['loop'] );
			?>
		<div <?php echo $this->get_render_attribute_string( 'client' ); ?>>
			<div class="swiper-wrapper">
				<?php
				foreach ( $tabs as $index => $item ) {
					
					$link_key = 'link_' . $index;

					$this->add_link_attributes( $link_key, $item['link'] );
					?>
				<div class="swiper-slide">
					<div class="client-logo">
						<a <?php echo $this->get_render_attribute_string( $link_key ); ?>>
							<img src="<?php echo esc_url( $item['image']['url'] ); ?>" class="img-fluid" alt="" />
						</a>
					</div>
				</div>
				<?php } ?>
			</div>

			<div class="swiper-pagination"></div>
			<div class="swiper-button-next"><i class="fas fa-chevron-right"></i></div>
			<div class="swiper-button-prev"><i class="fas fa-chevron-left"></i></div>

		</div>
			<?php
		}
		if ( $settings['client-style'] === 'grid' ) {
			$grid_opt    = sprintf( '%1$s', esc_html( $settings['grid-option'], 'finix' ) );
			$mo_grid_opt = sprintf( '%1$s', esc_html( $settings['mobile-grid-option'], 'finix' ) );
			?>
			<div class="client-logo-inner <?php echo $grid_opt; ?> <?php echo $mo_grid_opt; ?>">
				<?php
				foreach ( $tabs as $index => $item ) {
				
					$link_key = 'link_' . $index;

					$this->add_link_attributes( $link_key, $item['link'] );
					?>
				<div class="client-logo">
					<a <?php echo $this->get_render_attribute_string( $link_key ); ?>>
						<img src="<?php echo esc_url( $item['image']['url'] ); ?>" class="img-fluid" alt="" />
					</a>
				</div>
				<?php } ?>
			</div>
			<?php
		}
		?>
		</div>
		<?php
		if ( Plugin::$instance->editor->is_edit_mode() ) :
			?>
		<script>
			jQuery('.swiper-container' ).each(function () {
				var swiper = new Swiper( jQuery( this ), {
				slidesPerView:  ((jQuery(this).attr('data-items')) ? jQuery(this).attr('data-items') : 4),
				spaceBetween:   ((jQuery(this).attr('data-space')) ? jQuery(this).data('space') : 15),
				autoplay:       ((jQuery(this).attr('data-autoplay')) ? jQuery(this).data('autoplay') : false),
				loop:           ((jQuery(this).attr('data-loop')) ? jQuery(this).data('loop') : false),
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
				pagination: {
					el: '.swiper-pagination',
					clickable: true,
				},
				breakpoints: {
					1200: {slidesPerView: ((jQuery(this).attr('data-items')) ? jQuery(this).attr('data-items') : 4),},
					992:  {slidesPerView: ((jQuery(this).attr('data-lg-items')) ? jQuery(this).attr('data-lg-items') : 3),},
					768:  {slidesPerView: ((jQuery(this).attr('data-md-items')) ? jQuery(this).attr('data-md-items') : 2),},
					480:  {slidesPerView: ((jQuery(this).attr('data-sm-items')) ? jQuery(this).attr('data-sm-items') : 1),},
					0:  {slidesPerView: ((jQuery(this).attr('data-xs-items')) ? jQuery(this).attr('data-xs-items') : 1),}
				}
				});
			});
		</script>
		<?php endif;
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\client_logo() );
?>
