<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Elementor team widget.
 *
 * Elementor widget that displays an eye-catching headlines.
 *
 * @since 1.1.0
 */

class team extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve team widget name.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget name.
	 */

	public function get_name() {
		return __( 'Team Slider', 'finix' );
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve team widget title.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */

	public function get_title() {
		return __( 'Team Slider', 'finix' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the team widget belongs to.
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
	 * Retrieve team widget icon.
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
	 * Register team widget controls.
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
			'team-style',
			array(
				'label'   => __( 'team Style', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'team-style-1',
				'options' => array(
					'team-style-1' => __( 'Style 1', 'finix' ),
					'team-style-2' => __( 'Style 2', 'finix' ),
					'team-style-3' => __( 'Style 3', 'finix' ),
					'team-style-4' => __( 'Style 4', 'finix' ),
					'team-style-5' => __( 'Style 5', 'finix' ),
					'team-style-6' => __( 'Style 6', 'finix' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'name-typography',
				'label'    => __( 'Name Typography', 'finix' ),
				'selector' => '{{WRAPPER}} .team-member .member-info .member-name',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'position-typography',
				'label'    => __( 'Position Typography', 'finix' ),
				'selector' => '{{WRAPPER}} .team-member .member-info .member-position',
			)
		);

		$this->add_control(
			'team_grayscale',
			[
				'label' => __( 'Image Grayscale', 'finix' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'yes' => __( 'yes', 'finix' ),
				'no' => __( 'no', 'finix' ),
			]
        );

		$this->add_responsive_control(
			'image_space',
			[
				'label' => __( 'Image Space', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => [
					'team-style' => 'team-style-6',
				],
				'size_units' => [ 'px', '%' ],
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .team-member.team-style-6 .member-image' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .team-member.team-style-6 .member-image' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_radius',
			[
				'label' => __( 'Image Radius', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => [
					'team-style' => 'team-style-6',
				],
				'size_units' => [ 'px', '%' ],
				'default' => [
					'size' => 50,
				],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .team-member.team-style-6 .member-image' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
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
			'team_color',
			array(
				'label' => __( 'Team Color', 'finix' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);


		$this->add_control(
			'all-text-color',
			array(
				'label'     => __( 'Text Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'team-style' => array('team-style-3','team-style-4'),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .team-member.team-style-3 .team-social li a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .team-member.team-style-3 .member-info .member-name a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .team-member.team-style-3 .member-info .member-position' => 'color: {{VALUE}};',
					'{{WRAPPER}} .team-member.team-style-4 .member-info .member-name a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .team-member.team-style-4 .member-info .member-position' => 'color: {{VALUE}};',
					'{{WRAPPER}} .team-member.team-style-4 .team-social li a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'gradiant-s3-color',
				'label'     => __( 'Background Color', 'finix' ),
				'condition' => array(
					'team-style' => array('team-style-3'),
				),
				'types'     => array( 'gradient' ),
				'selector'  => '{{WRAPPER}} .team-member.team-style-3 .member-inner',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'gradiant-s4-color',
				'label'     => __( 'Background Color', 'finix' ),
				'condition' => array(
					'team-style' => array('team-style-4'),
				),
				'types'     => array( 'gradient' ),
				'selector'  => '{{WRAPPER}} .team-member.team-style-4 .member-info:before',
			)
		);

		$this->add_control(
			'style5-bg-color',
			array(
				'label'     => __( 'Background Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'team-style' => array('team-style-5'),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .team-member.team-style-5 .team-social ul li a' => 'background: {{VALUE}};',
				),
			)
		);		

		$this->start_controls_tabs(
				'teams_color-tabs',
				array(
					'condition' => [
						'team-style'=>['team-style-1','team-style-2','team-style-6']
					],
				)
			);

			$this->start_controls_tab(
				'team_color_normal',
				array(
					'label' => __( 'Normal', 'finix' ),
				)
			);

			$this->add_control(
				'member-name',
				array(
					'label'     => __( 'Name Color', 'finix' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} .team-member .member-info .member-name' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'member-position',
				array(
					'label'     => __( 'Position Color', 'finix' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} .team-member .member-info .member-position' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'      => 'gradiant-bg-color',
					'label'     => __( 'Background Color', 'finix' ),
					'condition' => array(
						'team-style' => array('team-style-1'),
					),
					'types'     => array( 'gradient' ),
					'selector'  => '{{WRAPPER}} .team-member.team-style-1 .member-info',
				)
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'team_color_hover',
				array(
					'label' => __( 'Hover', 'finix' ),
				)
			);

			$this->add_control(
				'member-hover-name',
				array(
					'label'     => __( 'Name Color', 'finix' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} .team-member .team-member-inner:hover .member-info .member-name a' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'member-hover-position',
				array(
					'label'     => __( 'Position Color', 'finix' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} .team-member .team-member-inner:hover .member-info .member-position' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'      => 'gradiant-hover-bg-color',
					'label'     => __( 'Background Color', 'finix' ),
					'condition' => array(
						'team-style' => array('team-style-1'),
					),
					'types'     => array( 'gradient' ),
					'selector'  => '{{WRAPPER}} .team-member.team-style-1 .team-member-inner .member-info:before',
				)
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();



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
					'team-style' => array( 'team-style-2', 'team-style-3' ),
				),
				'selector'  => '{{WRAPPER}} .team-member .post-inner .post-link .read-link',
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
					'{{WRAPPER}} .team-member .swiper-container .swiper-pagination-bullet' => 'background: {{VALUE}};',
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
					'{{WRAPPER}} .team-member .swiper-container .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background: {{VALUE}};',
					'{{WRAPPER}} .team-member .swiper-container .swiper-pagination-bullet.swiper-pagination-bullet-active:before' => 'border-color: {{VALUE}};',
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
	 * Render team widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.1.0
	 * @access protected
	 */

	protected function render() {

		$settings = $this->get_settings();

		$args = array(
			'post_type'        => 'team',
			'post_status'      => 'publish',
			'posts_per_page'   => $settings['total-count'],
			'numberposts'      => -1,
			'suppress_filters' => 0,
		);

		$the_query = new \WP_Query( $args );

		global $post;

		$this->add_render_attribute( 'team', 'class', 'team-member-slider swiper-container' );
		$this->add_render_attribute( 'team', 'data-items', $settings['slider-desk'] );
		$this->add_render_attribute( 'team', 'data-lg-items', $settings['slider-laptop'] );
		$this->add_render_attribute( 'team', 'data-md-items', $settings['slider-tab'] );
		$this->add_render_attribute( 'team', 'data-sm-items', $settings['slider-mobile'] );
		$this->add_render_attribute( 'team', 'data-xs-items', $settings['slider-mobile-portal'] );
		$this->add_render_attribute( 'team', 'data-space', $settings['data-space']['size'] );
		$this->add_render_attribute( 'team', 'data-arrow', $settings['slider-arrow'] );
		$this->add_render_attribute( 'team', 'data-bullets', $settings['slider-dots'] );
		$this->add_render_attribute( 'team', 'data-autoplay', $settings['autoplay'] );
		$this->add_render_attribute( 'team', 'data-loop', $settings['loop'] );
		
		$this->add_render_attribute( 'team-class', 'class', 'team-member' ); 
		$this->add_render_attribute( 'team-class', 'class', $settings['team-style'] );
		$this->add_render_attribute( 'team-class', 'class', $settings['arrow-style'] );

		if($settings['team_grayscale'] == 'yes') {
				$this->add_render_attribute( 'team-class', 'class', 'team-grayscale' ); 
			}

		?>
		<div <?php echo $this->get_render_attribute_string( 'team-class' ) ?>>
			<div <?php echo $this->get_render_attribute_string( 'team' ); ?>>
				<div class="swiper-wrapper">
				<?php

				if ( $settings['team-style'] === 'team-style-1' ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						$team_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
						?>
						<div class="swiper-slide">
							<div class="team-member-inner">
								<?php if ( has_post_thumbnail() ) { ?>
								<div class="member-image">
									<img src="<?php echo esc_url( $team_image[0] ); ?>" alt="" class=" img-fluid">
									<div class="team-social">
										<ul>
											<?php
											$facebook = get_post_meta( get_the_ID(), 'facebook', true );
											if ( ! empty( $facebook ) ) {
												?>
											<li><a href="#"><i class="fab fa-facebook"></i></a></li>
											<?php } ?>
											<?php
											$twitter = get_post_meta( get_the_ID(), 'twitter', true );
											if ( ! empty( $twitter ) ) {
												?>
											<li><a href="#"><i class="fab fa-twitter"></i></a></li>
											<?php } ?>
											<?php
											$linkedin = get_post_meta( get_the_ID(), 'linkedin', true );
											if ( ! empty( $linkedin ) ) {
												?>
											<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
											<?php } ?>
											<?php
											$instagram = get_post_meta( get_the_ID(), 'instagram', true );
											if ( ! empty( $instagram ) ) {
												?>
											<li><a href="#"><i class="fab fa-instagram"></i></a></li>
											<?php } ?>
										</ul>
									</div>
								</div>
								<?php } ?>
								<div class="member-info">
									<h3 class="member-name"><a href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><?php echo sprintf( '%s', esc_html( get_the_title( $post->ID ), 'finix' ) ); ?></a></h3>
									<?php
									$position = get_post_meta( get_the_ID(), 'position', true );
									if ( ! empty( $position ) ) {
										?>
									<span class="member-position"><?php echo sprintf( '%s', esc_html( $position, 'finix' ) ); ?></span>
									<?php } ?>
								</div>
							</div>
						</div>
						<?php
					}
					wp_reset_postdata();
				}
				if ( $settings['team-style'] === 'team-style-2' ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						$team_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
						?>
						<div class="swiper-slide">
							<div class="team-member-inner">
							<div class="member-image">
								<img src="<?php echo esc_url( $team_image[0] ); ?>" alt="" class=" img-fluid">
								<div class="team-social">
									<ul>
										<?php
										$facebook = get_post_meta( get_the_ID(), 'facebook', true );
										if ( ! empty( $facebook ) ) {
											?>
										<li><a href="<?php echo sprintf( '%s', esc_html( $facebook, 'finix' ) ); ?>"><i class="fab fa-facebook"></i></a></li>
										<?php } ?>
										<?php
										$twitter = get_post_meta( get_the_ID(), 'twitter', true );
										if ( ! empty( $twitter ) ) {
											?>
										<li><a href="<?php echo sprintf( '%s', esc_html( $twitter, 'finix' ) ); ?>"><i class="fab fa-twitter"></i></a></li>
										<?php } ?>
										<?php
										$linkedin = get_post_meta( get_the_ID(), 'linkedin', true );
										if ( ! empty( $linkedin ) ) {
											?>
										<li><a href="<?php echo sprintf( '%s', esc_html( $linkedin, 'finix' ) ); ?>"><i class="fab fa-linkedin"></i></a></li>
										<?php } ?>
										<?php
										$instagram = get_post_meta( get_the_ID(), 'instagram', true );
										if ( ! empty( $instagram ) ) {
											?>
										<li><a href="<?php echo sprintf( '%s', esc_html( $instagram, 'finix' ) ); ?>"><i class="fab fa-instagram"></i></a></li>
										<?php } ?>
									</ul>
								</div>
							</div>
							<div class="member-info">
								<h3 class="member-name"><a href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><?php echo sprintf( '%s', esc_html( get_the_title( $post->ID ), 'finix' ) ); ?></a></h3>
								<?php
								$position = get_post_meta( get_the_ID(), 'position', true );
								if ( ! empty( $position ) ) {
									?>
								<span class="member-position"><?php echo sprintf( '%s', esc_html( $position, 'finix' ) ); ?></span>
								<?php } ?>
							</div>
							</div>
						</div>
						<?php
					}
					wp_reset_postdata();
				}
				if ( $settings['team-style'] === 'team-style-3' ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						$team_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
						?>
						<div class="swiper-slide">
							<div class="team-member-inner">
								<div class="member-image">
									<img src="<?php echo esc_url( $team_image[0] ); ?>" alt="" class=" img-fluid">
									<div class="member-inner">
										<div class="team-social">
											<ul>
												<?php
												$facebook = get_post_meta( get_the_ID(), 'facebook', true );
												if ( ! empty( $facebook ) ) {
													?>
												<li><a href="<?php echo sprintf( '%s', esc_html( $facebook, 'finix' ) ); ?>"><i class="fab fa-facebook"></i></a></li>
												<?php } ?>
												<?php
												$twitter = get_post_meta( get_the_ID(), 'twitter', true );
												if ( ! empty( $twitter ) ) {
													?>
												<li><a href="<?php echo sprintf( '%s', esc_html( $twitter, 'finix' ) ); ?>"><i class="fab fa-twitter"></i></a></li>
												<?php } ?>
												<?php
												$linkedin = get_post_meta( get_the_ID(), 'linkedin', true );
												if ( ! empty( $linkedin ) ) {
													?>
												<li><a href="<?php echo sprintf( '%s', esc_html( $linkedin, 'finix' ) ); ?>"><i class="fab fa-linkedin"></i></a></li>
												<?php } ?>
												<?php
												$instagram = get_post_meta( get_the_ID(), 'instagram', true );
												if ( ! empty( $instagram ) ) {
													?>
												<li><a href="<?php echo sprintf( '%s', esc_html( $instagram, 'finix' ) ); ?>"><i class="fab fa-instagram"></i></a></li>
												<?php } ?>
											</ul>
										</div>
										<div class="member-info">
										<h3 class="member-name"><a href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><?php echo sprintf( '%s', esc_html( get_the_title( $post->ID ), 'finix' ) ); ?></a></h3>
										<?php
										$position = get_post_meta( get_the_ID(), 'position', true );
										if ( ! empty( $position ) ) {
											?>
										<span class="member-position"><?php echo sprintf( '%s', esc_html( $position, 'finix' ) ); ?></span>
										<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					wp_reset_postdata();
				}
				if ( $settings['team-style'] === 'team-style-4' ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						$team_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
						?>
						<div class="swiper-slide">
							<div class="team-member-inner">
								<?php if ( has_post_thumbnail() ) { ?>
								<div class="member-image">
									<img src="<?php echo esc_url( $team_image[0] ); ?>" alt="" class=" img-fluid">
								</div>
								<?php } ?>
								<div class="member-info">
									<div class="member-name-pos">
										<?php
										$position = get_post_meta( get_the_ID(), 'position', true );
										if ( ! empty( $position ) ) {
											?>
										<span class="member-position"><?php echo sprintf( '%s', esc_html( $position, 'finix' ) ); ?></span>
										<?php } ?>
										<h3 class="member-name"><a href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><?php echo sprintf( '%s', esc_html( get_the_title( $post->ID ), 'finix' ) ); ?></a></h3>
									</div>

									<div class="team-social">
										<ul>
											<?php
											$facebook = get_post_meta( get_the_ID(), 'facebook', true );
											if ( ! empty( $facebook ) ) {
												?>
											<li><a href="<?php echo sprintf( '%s', esc_html( $facebook, 'finix' ) ); ?>"><i class="fab fa-facebook"></i></a></li>
											<?php } ?>
											<?php
											$twitter = get_post_meta( get_the_ID(), 'twitter', true );
											if ( ! empty( $twitter ) ) {
												?>
											<li><a href="<?php echo sprintf( '%s', esc_html( $twitter, 'finix' ) ); ?>"><i class="fab fa-twitter"></i></a></li>
											<?php } ?>
											<?php
											$linkedin = get_post_meta( get_the_ID(), 'linkedin', true );
											if ( ! empty( $linkedin ) ) {
												?>
											<li><a href="<?php echo sprintf( '%s', esc_html( $linkedin, 'finix' ) ); ?>"><i class="fab fa-linkedin"></i></a></li>
											<?php } ?>
											<?php
											$instagram = get_post_meta( get_the_ID(), 'instagram', true );
											if ( ! empty( $instagram ) ) {
												?>
											<li><a href="<?php echo sprintf( '%s', esc_html( $instagram, 'finix' ) ); ?>"><i class="fab fa-instagram"></i></a></li>
											<?php } ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					wp_reset_postdata();
				}
				if ( $settings['team-style'] === 'team-style-5' ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						$team_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
						?>
						<div class="swiper-slide">
							<div class="team-member-inner">
								<div class="member-image">
									<img src="<?php echo esc_url( $team_image[0] ); ?>" alt="" class=" img-fluid">
									<div class="team-social">
											<ul>
												<?php
												$facebook = get_post_meta( get_the_ID(), 'facebook', true );
												if ( ! empty( $facebook ) ) {
													?>
												<li><a href="<?php echo sprintf( '%s', esc_html( $facebook, 'finix' ) ); ?>"><i class="fab fa-facebook"></i></a></li>
												<?php } ?>
												<?php
												$twitter = get_post_meta( get_the_ID(), 'twitter', true );
												if ( ! empty( $twitter ) ) {
													?>
												<li><a href="<?php echo sprintf( '%s', esc_html( $twitter, 'finix' ) ); ?>"><i class="fab fa-twitter"></i></a></li>
												<?php } ?>
												<?php
												$linkedin = get_post_meta( get_the_ID(), 'linkedin', true );
												if ( ! empty( $linkedin ) ) {
													?>
												<li><a href="<?php echo sprintf( '%s', esc_html( $linkedin, 'finix' ) ); ?>"><i class="fab fa-linkedin"></i></a></li>
												<?php } ?>
												<?php
												$instagram = get_post_meta( get_the_ID(), 'instagram', true );
												if ( ! empty( $instagram ) ) {
													?>
												<li><a href="<?php echo sprintf( '%s', esc_html( $instagram, 'finix' ) ); ?>"><i class="fab fa-instagram"></i></a></li>
												<?php } ?>
											</ul>
										</div>
									<div class="member-inner">
										<div class="member-info">
										<h3 class="member-name"><a href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><?php echo sprintf( '%s', esc_html( get_the_title( $post->ID ), 'finix' ) ); ?></a></h3>
										<?php
										$position = get_post_meta( get_the_ID(), 'position', true );
										if ( ! empty( $position ) ) {
											?>
										<span class="member-position"><?php echo sprintf( '%s', esc_html( $position, 'finix' ) ); ?></span>
										<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					wp_reset_postdata();
				}
				if ( $settings['team-style'] === 'team-style-6' ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						$team_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'finix_500x500' );
						?>
						<div class="swiper-slide">
							<div class="team-member-inner">
								<?php if ( has_post_thumbnail() ) { ?>
								<div class="member-image">
									<img src="<?php echo esc_url( $team_image[0] ); ?>" alt="" class=" img-fluid">
								</div>
								<?php } ?>
								<div class="member-info">
									<h3 class="member-name"><a href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><?php echo sprintf( '%s', esc_html( get_the_title( $post->ID ), 'finix' ) ); ?></a></h3>
									<?php
									$position = get_post_meta( get_the_ID(), 'position', true );
									if ( ! empty( $position ) ) {
										?>
									<span class="member-position"><?php echo sprintf( '%s', esc_html( $position, 'finix' ) ); ?></span>
									<?php } ?>
									<div class="team-social">
										<ul>
											<?php
											$facebook = get_post_meta( get_the_ID(), 'facebook', true );
											if ( ! empty( $facebook ) ) {
												?>
											<li><a href="#"><i class="fab fa-facebook"></i></a></li>
											<?php } ?>
											<?php
											$twitter = get_post_meta( get_the_ID(), 'twitter', true );
											if ( ! empty( $twitter ) ) {
												?>
											<li><a href="#"><i class="fab fa-twitter"></i></a></li>
											<?php } ?>
											<?php
											$linkedin = get_post_meta( get_the_ID(), 'linkedin', true );
											if ( ! empty( $linkedin ) ) {
												?>
											<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
											<?php } ?>
											<?php
											$instagram = get_post_meta( get_the_ID(), 'instagram', true );
											if ( ! empty( $instagram ) ) {
												?>
											<li><a href="#"><i class="fab fa-instagram"></i></a></li>
											<?php } ?>
										</ul>
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
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\team() );
?>
