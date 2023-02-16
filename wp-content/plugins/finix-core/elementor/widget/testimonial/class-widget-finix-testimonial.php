<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Elementor testimonial widget.
 *
 * Elementor widget that displays an eye-catching headlines.
 *
 * @since 1.1.0
 */

class testimonial extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve testimonial widget name.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget name.
	 */

	public function get_name() {
		return __( 'Testimonial', 'finix' );
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve testimonial widget title.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */

	public function get_title() {
		return __( 'Testimonial', 'finix' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the testimonial widget belongs to.
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
	 * Retrieve testimonial widget icon.
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
	 * Register testimonial widget controls.
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
			'testimonial-style',
			array(
				'label'   => __( 'testimonial Style', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'testimonial-style-1',
				'options' => array(
					'testimonial-style-1' => __( 'Style 1', 'finix' ),
					'testimonial-style-2' => __( 'Style 2', 'finix' ),
					'testimonial-style-3' => __( 'Style 3', 'finix' ),
				),
			)
		);

		$this->add_control(
			'arrow-position',
			array(
				'label'     => __( 'Arrow Position', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'condition' => array(
					'testimonial-style' => 'testimonial-style-2',
					'slider-arrow' => array( 'true' ),
				),
				'default'   => 'position-default',
				'options'   => array(
					'position-default' => __( 'Default', 'finix' ),
					'position-center' => __( 'Center Visible', 'finix' ),
					'position-bottom'  => __( 'Bottom Visible', 'finix' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description-typography',
				'label'    => __( 'Typography', 'finix' ),
				'selector' => '{{WRAPPER}} .testimonial-main .testimonial-inner .author-description',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'name-typography',
				'label'    => __( 'Name Typography', 'finix' ),
				'selector' => '{{WRAPPER}} .testimonial-main .author-details .author-name',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'position-typography',
				'label'    => __( 'Position Typography', 'finix' ),
				'selector' => '{{WRAPPER}} .testimonial-main .author-details .author-position',
			)
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'finix' ),
				'type' => Controls_Manager::DIMENSIONS,
				'condition' => [
					'testimonial-style'=>['testimonial-style-1','testimonial-style-3'],
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-main.testimonial-style-1 .testimonial-inner .author-description' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .testimonial-main.testimonial-style-3 .testimonial-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'testimonial_2_padding',
			[
				'label' => __( 'Padding', 'finix' ),
				'type' => Controls_Manager::DIMENSIONS,
				'condition' => [
					'testimonial-style' => 'testimonial-style-2',
				],
				'size_units' => [ 'px', 'em', '%' ],
				'allowed_dimensions' => 'horizontal',
				'placeholder' => [
					'top' => 'auto',
					'right' => '',
					'bottom' => 'auto',
					'left' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .testimonial-style-2 .testimonial-inner' => 'padding-left:  {{left}}{{UNIT}}; padding-right: {{right}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'finix' ),
				'type' => Controls_Manager::CHOOSE,
				'condition' => [
					'testimonial-style' => 'testimonial-style-2',
				],
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
			'slider_setting',
			array(
				'label' => __( 'Slider Setting', 'finix' ),
			)
		);

		$this->add_control(
			'total-count',
			array(
				'label'       => __( 'Total Count', 'finix' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
				'default'     => '5',
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
				'label_block' => true,
				'default'     => '1',
			)
		);

		$this->add_control(
			'autoplay',
			array(
				'label'   => __( 'Autoplay', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => array(
					'true'  => __( 'True', 'finix' ),
					'false' => __( 'False', 'finix' ),

				),
			)
		);

		$this->add_control(
			'loop',
			array(
				'label'   => __( 'Loop', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => array(
					'true'  => __( 'True', 'finix' ),
					'false' => __( 'False', 'finix' ),

				),
			)
		);

		$this->add_control(
			'slider-dots',
			array(
				'label'   => __( 'Dots', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => array(
					'true'  => __( 'True', 'finix' ),
					'false' => __( 'False', 'finix' ),

				),
			)
		);

		$this->add_control(
			'slider-arrow',
			array(
				'label'   => __( 'Arrow', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => array(
					'true'  => __( 'True', 'finix' ),
					'false' => __( 'False', 'finix' ),

				),
			)
		);

		$this->add_control(
			'arrow-style',
			array(
				'label'     => __( 'Arrow Style', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'condition' => array(
					'slider-arrow' => array( 'true' ),
				),
				'default'   => 'arrow-default',
				'options'   => array(
					'arrow-default' => __( 'Default', 'finix' ),
					'arrow-style2'  => __( 'Style 2', 'finix' ),
					'arrow-style3'  => __( 'Style 3', 'finix' ),
				),
			)
		);

		$this->add_responsive_control(
			'data-space',
			array(
				'label' => __( 'Margin', 'elementor' ),
				'type'  => Controls_Manager::SLIDER,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'testimonial_color',
			array(
				'label' => __( 'Testimonial Color', 'finix' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'testimonial_bg_color',
			[
				'label' => __( 'Background Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'testimonial-style'=>['testimonial-style-1','testimonial-style-3']
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-main.testimonial-style-1 .testimonial-inner .author-description' => 'background: {{VALUE}};',
					'{{WRAPPER}} .testimonial-main.testimonial-style-1 .testimonial-inner .author-description:before' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .testimonial-main.testimonial-style-3 .testimonial-inner' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'testimonial_description_color',
			[
				'label' => __( 'Description Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-main.testimonial-style-1 .testimonial-inner .author-description' => 'color: {{VALUE}};',
					'{{WRAPPER}} .testimonial-main.testimonial-style-1 .testimonial-inner .icon-quote' => 'color: {{VALUE}};',
					'{{WRAPPER}} .testimonial-main.testimonial-style-2 .testimonial-inner .author-description' => 'color: {{VALUE}};',
					'{{WRAPPER}} .testimonial-main.testimonial-style-3 .testimonial-inner .author-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'testimonial_quote_color',
			[
				'label' => __( 'Quote Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'testimonial-style'=>['testimonial-style-2','testimonial-style-3']
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-main.testimonial-style-2 .testimonial-inner .icon-quote' => 'color: {{VALUE}};',
					'{{WRAPPER}} .testimonial-main.testimonial-style-3 .testimonial-inner .icon-quote' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'testimonial_name_color',
			[
				'label' => __( 'Name Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-main .author-details .author-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'testimonial_position_color',
			[
				'label' => __( 'Position Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-main .author-details .author-position' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_color',
			array(
				'label' => __( 'Slider Control Color', 'finix' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'link-typography',
				'label'     => __( 'Read More Typography', 'finix' ),
				'condition' => array(
					'testimonial-style' => array( 'testimonial-style-2', 'testimonial-style-3' ),
				),
				'selector'  => '{{WRAPPER}} .testimonial-member .post-inner .post-link .read-link',
			)
		);

		$this->start_controls_tabs( 'slider_arrow_style' );

		$this->start_controls_tab(
			'slider_arrow_normal',
			array(
				'label' => __( 'Normal', 'finix' ),
			)
		);

		$this->add_control(
			'bullet_color',
			array(
				'label'     => __( 'Bullet Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .testimonial-member .swiper-container .swiper-pagination-bullet' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'arrow_color',
			array(
				'label'     => __( 'Arrow Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .swiper-container .swiper-button-next i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .swiper-container .swiper-button-prev i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'arrow_bg_color',
			array(
				'label'     => __( 'Arrow BG Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'arrow-style' => array( 'arrow-default', 'arrow-style2' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .swiper-container .swiper-button-next i' => 'background: {{VALUE}};',
					'{{WRAPPER}} .swiper-container .swiper-button-prev i' => 'background: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'slider_arrow_hover',
			array(
				'label' => __( 'Hover', 'finix' ),
			)
		);

		$this->add_control(
			'bullet_hover_color',
			array(
				'label'     => __( 'Bullet hover Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .testimonial-member .swiper-container .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background: {{VALUE}};',
					'{{WRAPPER}} .testimonial-member .swiper-container .swiper-pagination-bullet.swiper-pagination-bullet-active:before' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'arrow_hover_color',
			array(
				'label'     => __( 'Arrow Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .swiper-container .swiper-button-next:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .swiper-container .swiper-button-prev:hover i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'arrow_bg_hover_color',
			array(
				'label'     => __( 'Arrow BG Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .swiper-container .swiper-button-next:hover i' => 'background: {{VALUE}};',
					'{{WRAPPER}} .swiper-container .swiper-button-prev:hover i' => 'background: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_section();

	}
	/**
	 * Render testimonial widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.1.0
	 * @access protected
	 */

	protected function render() {

		$settings = $this->get_settings();
		$align = $settings['align'];

		$args = array(
			'post_type'        => 'testimonial',
			'post_status'      => 'publish',
			'posts_per_page'   => $settings['total-count'],
			'numberposts'      => -1,
			'suppress_filters' => 0,
		);

		$the_query = new \WP_Query( $args );

		$arrow_style = sprintf( '%1$s', esc_html( $settings['arrow-style'], 'finix' ) );
		$arrow_position = sprintf( '%1$s', esc_html( $settings['arrow-position'], 'finix' ) );

		global $post;

		$this->add_render_attribute( 'testimonial', 'class', 'testimonial-slider swiper-container' );
		$this->add_render_attribute( 'testimonial', 'data-items', $settings['slider-desk'] );
		$this->add_render_attribute( 'testimonial', 'data-lg-items', $settings['slider-laptop'] );
		$this->add_render_attribute( 'testimonial', 'data-md-items', $settings['slider-tab'] );
		$this->add_render_attribute( 'testimonial', 'data-sm-items', $settings['slider-mobile'] );
		$this->add_render_attribute( 'testimonial', 'data-xs-items', $settings['slider-mobile-portal'] );
		$this->add_render_attribute( 'testimonial', 'data-space', $settings['data-space']['size'] );
		$this->add_render_attribute( 'testimonial', 'data-arrow', $settings['slider-arrow'] );
		$this->add_render_attribute( 'testimonial', 'data-bullets', $settings['slider-dots'] );
		$this->add_render_attribute( 'testimonial', 'data-autoplay', $settings['autoplay'] );
		$this->add_render_attribute( 'testimonial', 'data-loop', $settings['loop'] );

		$testimonial_style = sprintf( '%1$s', esc_html( $settings['testimonial-style'], 'finix' ) );

		?>
		<div class="testimonial-main <?php echo $testimonial_style; ?> <?php echo $arrow_style; ?> <?php echo $arrow_position; ?> <?php echo esc_attr($align);?>">
			<div <?php echo $this->get_render_attribute_string( 'testimonial' ); ?>>
				<div class="swiper-wrapper">
				<?php

				if ( $settings['testimonial-style'] === 'testimonial-style-1' ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						$testimonial_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
						?>
						<div class="swiper-slide">
							<div class="testimonial-inner">
								<div class="icon-quote"><i class="ion ion-quote"></i></div>
									<div class="author-description">
									<?php the_content( $post->ID ); ?>
									</div>
								<div class="author-details">
									<div class="author-photo"><img class="img-fluid rounded-circle" src="<?php echo esc_url( $testimonial_image[0] ); ?>" alt=""></div>
									<div class="author-info">
									<h5 class="author-name"><?php echo sprintf( '%s', esc_html( get_the_title( $post->ID ), 'finix' ) ); ?></h5>
									<?php
									$designation = get_post_meta( get_the_ID(), 'designation', true );
									if ( ! empty( $designation ) ) {
										?>
									<span class="author-position"><?php echo sprintf( '%s', esc_html( $designation, 'finix' ) ); ?></span>
									<?php } ?>
								</div>
								</div>
							</div>
						</div>
						<?php
					}
					wp_reset_postdata();
				}
				if ( $settings['testimonial-style'] === 'testimonial-style-2' ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						$testimonial_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
						?>
						<div class="swiper-slide">
							<div class="testimonial-inner <?php echo esc_attr($align);?>">
								<div class="author-photo"><img class="img-fluid rounded-circle" src="<?php echo esc_url( $testimonial_image[0] ); ?>" alt=""><span class="quote"><i class="ti ti-quote-left"></i></span></div>
								<div class="icon-quote"><i class="ti ti-quote-left"></i></div>
								<div class="author-description">
									<?php the_content( $post->ID ); ?>
								</div>
								<div class="author-details">
									<div class="author-info">
									<h5 class="author-name"><?php echo sprintf( '%s', esc_html( get_the_title( $post->ID ), 'finix' ) ); ?></h5>
									<?php
									$designation = get_post_meta( get_the_ID(), 'designation', true );
									if ( ! empty( $designation ) ) {
										?>
									<span class="author-position"><?php echo sprintf( '%s', esc_html( $designation, 'finix' ) ); ?></span>
									<?php } ?>
								</div>
								</div>
							</div>
						</div>
						<?php
					}
					wp_reset_postdata();
				}
				if ( $settings['testimonial-style'] === 'testimonial-style-3' ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						$testimonial_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
						?>
						<div class="swiper-slide">
							<div class="testimonial-inner">
								<div class="icon-quote"><i class="ion ion-quote"></i></div>
									<div class="author-description">
									<?php the_content( $post->ID ); ?>
									</div>
								<div class="author-details">
									<div class="author-photo"><img class="img-fluid rounded-circle" src="<?php echo esc_url( $testimonial_image[0] ); ?>" alt=""></div>
									<div class="author-info">
									<h5 class="author-name"><?php echo sprintf( '%s', esc_html( get_the_title( $post->ID ), 'finix' ) ); ?></h5>
									<?php
									$designation = get_post_meta( get_the_ID(), 'designation', true );
									if ( ! empty( $designation ) ) {
										?>
									<span class="author-position"><?php echo sprintf( '%s', esc_html( $designation, 'finix' ) ); ?></span>
									<?php } ?>
								</div>
								</div>
							</div>
						</div>
						<?php
					}
					wp_reset_postdata();
				}
				?>
				</div>

				<div class="swiper-pagination"></div>
				<div class="swiper-button-next"><i class="fas fa-chevron-right"></i></div>
				<div class="swiper-button-prev"><i class="fas fa-chevron-left"></i></div>

			</div>
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
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\testimonial() );
?>
