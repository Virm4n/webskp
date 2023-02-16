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

class blog extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve blog widget name.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget name.
	 */

	public function get_name() {
		return __( 'blog', 'finix' );
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve blog widget title.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */

	public function get_title() {
		return __( 'Blog', 'finix' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the blog widget belongs to.
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
	 * Retrieve blog widget icon.
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
	 * Register blog widget controls.
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
			'blog-style',
			array(
				'label'   => __( 'Blog Style', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'blog-style-1',
				'options' => array(
					'blog-style-1' => __( 'Style 1', 'finix' ),
					'blog-style-2' => __( 'Style 2', 'finix' ),
					'blog-style-3' => __( 'Style 3', 'finix' ),
				),
			)
		);

		$this->add_control(
			'color-scheme',
			array(
				'label'   => __( 'Color Type', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'color-dark',
				'options' => array(
					'color-dark'  => __( 'Dark', 'finix' ),
					'color-light' => __( 'Light', 'finix' ),
				),
			)
		);

		$this->add_responsive_control(
			'contant-word',
			array(
				'label'   => __( 'Contant Word', 'elementor' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => array(
					'size' => 20,
				),
				'range'   => array(
					'px' => array(
						'min' => 0,
						'max' => 30,
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default'   => 'large',
				'separator' => 'none',
			)
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
			'blog_color',
			array(
				'label' => __( 'Blog Color', 'finix' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title-typography',
				'label'    => __( 'Title Typography', 'finix' ),
				'selector' => '{{WRAPPER}} .blog-post-main .post-inner .post-content .post-title',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'link-typography',
				'label'     => __( 'Read More Typography', 'finix' ),
				'condition' => array(
					'blog-style' => array( 'blog-style-2', 'blog-style-3' ),
				),
				'selector'  => '{{WRAPPER}} .blog-post-main .post-inner .post-link .read-link',
			)
		);

		$this->add_control(
			'background_color',
			array(
				'label'     => __( 'Background Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'blog-style' => array( 'blog-style-1', 'blog-style-2' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .blog-style-1 .post-inner .post-content' => 'background: {{VALUE}};',
					'{{WRAPPER}} .blog-style-2 .post-inner .post-content:before' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .blog-post-main .post-inner .post-content .post-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'title_hover_color',
			array(
				'label'     => __( 'Title Hover Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .blog-post-main .post-inner .post-content .post-title a:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => __( 'Description Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .blog-post-main .post-inner .post-content .post-description' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'link_color',
			array(
				'label'     => __( 'Link Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'blog-style' => array( 'blog-style-2', 'blog-style-3' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .blog-style-2 .post-inner .post-content .read-link' => 'color: {{VALUE}};',
					'{{WRAPPER}} .blog-style-3 .post-inner .post-link .read-link' => 'color: {{VALUE}};',
					'{{WRAPPER}} .blog-style-3 .post-inner .post-link .read-link:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .blog-style-3 .post-inner .post-link .read-link:after' => 'background: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'blog_info_color',
			array(
				'label' => __( 'Blog Info Color', 'finix' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'category_bg_color',
			array(
				'label'     => __( 'Category BG Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'blog-style' => array( 'blog-style-1', 'blog-style-2' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .blog-post-main .post-inner .post-category' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'category_text_color',
			array(
				'label'     => __( 'Category Text Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'blog-style' => array( 'blog-style-1', 'blog-style-2' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .blog-post-main .post-inner .post-category' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'date_bg_color',
			array(
				'label'     => __( 'Date BG Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'blog-style' => array( 'blog-style-3' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .blog-style-3 .post-inner .meta-date' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'date_color',
			array(
				'label'     => __( 'Date Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .blog-style-1 .post-inner .post-content .meta-date' => 'color: {{VALUE}};',
					'{{WRAPPER}} .blog-style-2 .post-inner .meta-date' => 'color: {{VALUE}};',
					'{{WRAPPER}} .blog-style-3 .post-inner .meta-date' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'author_color',
			array(
				'label'     => __( 'Author Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'blog-style' => array( 'blog-style-1' ),
					'blog-style' => array( 'blog-style-3' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .blog-style-1 .post-inner .post-content .meta-author a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .blog-style-3 .post-inner .post-meta a, .blog-style-3 .post-inner .post-meta span' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __( 'Icon Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'blog-style' => array( 'blog-style-1' ),
					'blog-style' => array( 'blog-style-3' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .blog-style-1 .post-inner .post-content .meta-date i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .blog-style-3 .post-inner .post-meta i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_color',
			array(
				'label' => __( 'Slider Control Color', 'finix' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .blog-post-main .swiper-container .swiper-pagination-bullet' => 'background: {{VALUE}};',
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
			'bullet_active_color',
			array(
				'label'     => __( 'Bullet Active Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .blog-post-main .swiper-container .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background: {{VALUE}};',
					'{{WRAPPER}} .blog-post-main .swiper-container .swiper-pagination-bullet.swiper-pagination-bullet-active:before' => 'border-color: {{VALUE}};',
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
	 * Render Blog widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.1.0
	 * @access protected
	 */

	protected function render() {

		$settings = $this->get_settings();

		$args = array(
			'post_type'        => 'post',
			'post_status'      => 'publish',
			'posts_per_page'   => $settings['total-count'],
			'numberposts'      => -1,
			'suppress_filters' => 0,
		);

		$the_query = new \WP_Query( $args );

		$arrow_style = sprintf( '%1$s', esc_html( $settings['arrow-style'], 'finix' ) );

		global $post;

		$this->add_render_attribute( 'blog', 'class', 'blog-post-slider swiper-container' );
		$this->add_render_attribute( 'blog', 'data-items', $settings['slider-desk'] );
		$this->add_render_attribute( 'blog', 'data-lg-items', $settings['slider-laptop'] );
		$this->add_render_attribute( 'blog', 'data-md-items', $settings['slider-tab'] );
		$this->add_render_attribute( 'blog', 'data-sm-items', $settings['slider-mobile'] );
		$this->add_render_attribute( 'blog', 'data-xs-items', $settings['slider-mobile-portal'] );
		$this->add_render_attribute( 'blog', 'data-space', $settings['data-space']['size'] );
		$this->add_render_attribute( 'blog', 'data-arrow', $settings['slider-arrow'] );
		$this->add_render_attribute( 'blog', 'data-bullets', $settings['slider-dots'] );
		$this->add_render_attribute( 'blog', 'data-autoplay', $settings['autoplay'] );
		$this->add_render_attribute( 'blog', 'data-loop', $settings['loop'] );

		$blog_style = sprintf( '%1$s', esc_html( $settings['blog-style'], 'finix' ) );

		?>
		<div class="blog-post-main <?php echo $blog_style; ?> <?php echo $arrow_style; ?>">
			<div <?php echo $this->get_render_attribute_string( 'blog' ); ?>>
				<div class="swiper-wrapper">
				<?php

				if ( $settings['blog-style'] === 'blog-style-1' ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						$blog_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
						?>
						<div class="swiper-slide">
							<div class="post-inner">
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="post-image">
										<a href="#"><img class="img-fluid" src="<?php echo esc_url( $blog_image[0] ); ?>" alt=""></a>
									<?php
									$blogcat = get_the_category();
									if ( $blogcat ) {
										foreach ( $blogcat as $cat ) {
											echo '<a class="post-category" href="' . esc_url( get_category_link( $cat->cat_ID ) ) . '">' . esc_html( $cat->name ) . '</a>';
										}
									}
									?>
								</div>
								<?php } ?>
								<div class="post-content">
									<div class="post-meta">

									<div class="meta-author">
										<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
											<?php echo get_avatar( get_the_author_meta( 'ID' ), 110, '', esc_attr__( 'author avatar', 'finix' ) ); ?>
											<?php the_author(); ?>
										</a>
									</div>

									<div class="meta-date"><i class="ti ti-calendar"></i><?php echo sprintf( '%s', get_the_date() ); ?></div>
									</div>
									<div class="post-info">
									<h3 class="post-title"><a href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><?php echo sprintf( '%s', esc_html__( get_the_title( $the_query->ID ), 'finix' ) ); ?></a></h3>
									<div class="post-description">
										<?php
										$content_words = $settings['contant-word']['size'];
										$total_words   = str_word_count( get_the_content() );

										if ( $content_words > $total_words ) {
											$content_words = $total_words - 1;
										}

										if ( has_excerpt() ) {
											$excerpt_data = get_the_excerpt();

											echo wp_kses( $excerpt_data, array() );
										} else {
											$excerpt_data = get_the_content();

											$excerpt_data = strip_shortcodes( $excerpt_data );
											$excerpt_data = wp_trim_words( $excerpt_data, $content_words, '...' );
											echo wp_kses( $excerpt_data, array() );
										}
										?>
									</div>
									</div>
								</div>
							</div>
						</div>

						
						<?php
					}
					wp_reset_postdata();
				}
				if ( $settings['blog-style'] === 'blog-style-2' ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						$blog_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
						?>
					<div class="swiper-slide">
						<div class="post-inner">
							<div class="post-content" style="background-image: url(<?php echo esc_url( $blog_image[0] ); ?>);">
								<div class="post-meta">	
									<?php
										$blogcat = get_the_category();
									if ( $blogcat ) {
										foreach ( $blogcat as $cat ) {
											echo '<a class="post-category" href="' . esc_url( get_category_link( $cat->cat_ID ) ) . '">' . esc_html( $cat->name ) . '</a>';
										}
									}
									?>
									<div class="meta-date"><i class="ti ti-calendar"></i><?php echo sprintf( '%s', get_the_date() ); ?></div>
								</div>
								<div class="post-info">
									<h3 class="post-title"><a href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><?php echo sprintf( '%s', esc_html__( get_the_title( $the_query->ID ), 'finix' ) ); ?></a></h3>
									<div class="post-description">
										<?php
										$content_words = $settings['contant-word']['size'];
										$total_words   = str_word_count( get_the_content() );

										if ( $content_words > $total_words ) {
											$content_words = $total_words - 1;
										}

										if ( has_excerpt() ) {
											$excerpt_data = get_the_excerpt();

											echo wp_kses( $excerpt_data, array() );
										} else {
											$excerpt_data = get_the_content();

											$excerpt_data = strip_shortcodes( $excerpt_data );
											$excerpt_data = wp_trim_words( $excerpt_data, $content_words, '...' );
											echo wp_kses( $excerpt_data, array() );
										}
										?>
									</div>
									<div class="post-link">
									<a class="read-link" href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>">Read More<i aria-hidden="true" class="ion ion-ios-arrow-thin-right"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
						<?php
					}
					wp_reset_postdata();
				}
				if ( $settings['blog-style'] === 'blog-style-3' ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						$blog_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
						?>
						<div class="swiper-slide">
								<div class="post-inner">
									<?php if ( has_post_thumbnail() ) { ?>
											<div class="post-image">
												<a href="#"><img class="img-fluid" src="<?php echo esc_url( $blog_image[0] ); ?>" alt=""></a>
												<div class="meta-date"><?php echo sprintf( '%s', get_the_date( 'd' ) ); ?><span><?php echo sprintf( '%s', get_the_date( 'M' ) ); ?></span></div>
										</div>
										<?php } ?>
									<div class="post-content">
										
										<div class="post-meta">

										<?php $author_img = get_avatar( get_the_author_meta( $the_query->ID ), 20 ); ?>

											<div class="meta-author">
											<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
											<i class="ti ti-user"></i><?php the_author(); ?></a>
											</div>
											<div class="meta-comments">
												<i class="ti ti-comment-alt"></i> 
												<span><?php echo finix_get_comments_number_text(); ?></span>
											</div>
											</div>
										<div class="post-info">
										
										<h3 class="post-title"><a href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><?php echo sprintf( '%s', esc_html__( get_the_title( $the_query->ID ), 'finix' ) ); ?></a></h3>
										<div class="post-description">
											<?php
											$content_words = $settings['contant-word']['size'];
											$total_words   = str_word_count( get_the_content() );

											if ( $content_words > $total_words ) {
												$content_words = $total_words - 1;
											}

											if ( has_excerpt() ) {
												$excerpt_data = get_the_excerpt();

												echo wp_kses( $excerpt_data, array() );
											} else {
												$excerpt_data = get_the_content();

												$excerpt_data = strip_shortcodes( $excerpt_data );
												$excerpt_data = wp_trim_words( $excerpt_data, $content_words, '...' );
												echo wp_kses( $excerpt_data, array() );
											}
											?>
										</div>
										<div class="post-link">
											<a class="read-link" href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>">Read More<i aria-hidden="true" class="ion ion-ios-arrow-thin-right"></i></a>
										</div>
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
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\blog() );
?>
