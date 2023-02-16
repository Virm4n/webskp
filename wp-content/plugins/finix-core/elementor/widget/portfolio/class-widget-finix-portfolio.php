<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Elementor portfolio widget.
 *
 * Elementor widget that displays an eye-catching headlines.
 *
 * @since 1.1.0
 */

class portfolio extends Widget_Base {

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
		return __( 'Portfolio', 'finix' );
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
		return __( 'Portfolio', 'finix' );
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
			'portfolio-type',
			array(
				'label'   => __( 'Portfolio Type', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'type-grid',
				'options' => array(
					'type-grid' => __( 'Grid', 'finix' ),
					'type-masonry' => __( 'Masonry', 'finix' ),
					'type-slider' => __( 'Slider', 'finix' ),					
				),
			)
		);

		$this->add_control(
			'portfolio-style',
			array(
				'label'   => __( 'Portfolio Style', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'portfolio-style-1',
				'options' => array(
					'portfolio-style-1' => __( 'Style 1', 'finix' ),
					'portfolio-style-2' => __( 'Style 2', 'finix' ),
					'portfolio-style-3' => __( 'Style 3', 'finix' ),
				),
			)
		);

		$this->add_control(
			'filter',
			array(
				'label'   => __( 'Filter', 'finix' ),
				'type'    => Controls_Manager::SWITCHER,
				'condition' => array(
					'portfolio-type' => array( 'type-grid','type-masonry' ),
				),
				'default' => 'yes',
				'yes'     => __( 'yes', 'finix' ),
				'no'      => __( 'no', 'finix' ),
			)
		);

		$this->add_control(
			'filter-style',
			array(
				'label'   => __( 'Filter Style', 'finix' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'filter-style-1',
				'condition' => array(
					'portfolio-type' => array( 'type-grid','type-masonry' ),
				),
				'options' => array(
					'filter-style-1' => __( 'Style 1', 'finix' ),
					'filter-style-2' => __( 'Style 2', 'finix' ),
					'filter-style-3' => __( 'Style 3', 'finix' ),
				),
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
				'default'     => '3',
			)
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'grid_setting',
			array(
				'label'     => __( 'Column Setting', 'finix' ),
				'condition' => array(
					'portfolio-type' => array( 'type-grid','type-masonry' ),
				),
			)
		);
        
        $this->add_control(
			'grid-desk',
			array(
				'label'     => __( 'Desktop view', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'desk-grid-4',
				'options'   => array(
					'desk-grid-2' => __( '2 Column', 'finix' ),
					'desk-grid-3' => __( '3 Column', 'finix' ),
					'desk-grid-4' => __( '4 Column', 'finix' ),
					'desk-grid-5' => __( '5 Column', 'finix' ),
				),
			)
        );
        
        $this->add_control(
			'grid-lap',
			array(
				'label'     => __( 'Laptop view', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'lap-grid-3',
				'options'   => array(
					'lap-grid-2' => __( '2 Column', 'finix' ),
					'lap-grid-3' => __( '3 Column', 'finix' ),
					'lap-grid-4' => __( '4 Column', 'finix' ),
				),
			)
        );

        $this->add_control(
			'grid-tab',
			array(
				'label'     => __( 'Tablet view', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'tab-grid-3',
				'options'   => array(
					'tab-grid-2' => __( '2 Column', 'finix' ),
					'tab-grid-3' => __( '3 Column', 'finix' ),
					'tab-grid-4' => __( '4 Column', 'finix' ),
				),
			)
        );
        
        $this->add_control(
			'grid-mobile',
			array(
				'label'     => __( 'Mobile view', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'mob-grid-2',
				'options'   => array(
                    'mob-grid-1' => __( '1 Column', 'finix' ),
                    'mob-grid-2' => __( '2 Column', 'finix' ),
					'mob-grid-3' => __( '3 Column', 'finix' ),
				),
			)
        );
        
        $this->add_control(
			'grid-mportal',
			array(
				'label'     => __( 'Mobile Portal view', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'mpor-grid-1',
				'options'   => array(
                    'mpor-grid-1' => __( '1 Column', 'finix' ),
                    'mpor-grid-2' => __( '2 Column', 'finix' ),
				),
			)
		);
        
		$this->add_control(
			'grid-space',
			array(
				'label'     => __( 'Margin', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'grid-space-30',
				'options'   => array(
		            'grid-space-0' => __( '0', 'finix' ),
		            'grid-space-10' => __( '10', 'finix' ),
		            'grid-space-20' => __( '20', 'finix' ),
		            'grid-space-30' => __( '30', 'finix' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_setting',
			array(
				'label'     => __( 'Slider Setting', 'finix' ),
				'condition' => array(
					'portfolio-type' => array( 'type-slider' ),
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
				'label_block' => true,
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
			'slider-data-space',
			array(
				'label' => __( 'Margin', 'elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'condition' => array(
					'portfolio-type' => array( 'type-slider' ),
				),
			)
		);

		$this->add_control(
			'slider-space',
			array(
				'label'     => __( 'Margin', 'finix' ),
				'type'      => Controls_Manager::SELECT,
				'condition' => array(
					'portfolio-type' => array( 'type-grid','type-masonry' ),
				),
				'default'   => 'slider-space-15',
				'options'   => array(
		            'slider-space-0' => __( 'Space 0', 'finix' ),
		            'slider-space-5' => __( 'Space 5', 'finix' ),
		            'slider-space-10' => __( 'Space 10', 'finix' ),
		            'slider-space-15' => __( 'Space 15', 'finix' ),
		            'slider-space-20' => __( 'Space 20', 'finix' ),
		            'slider-space-25' => __( 'Space 25', 'finix' ),
		            'slider-space-30' => __( 'Space 30', 'finix' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_color',
			[
				'label' => __( 'Filter Color', 'finix' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'filter' => array( 'yes' ),
				),
			]
		);
		
			$this->start_controls_tabs( 'filter_color_style' );

			$this->start_controls_tab(
				'filter_button_normal',
				[
					'label' => __( 'Normal', 'finix' ),
				]
			);

			$this->add_control(
				'filter_text_normal',
				[
					'label' => __( 'Text Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .portfolio-main .b-isotope-filter li a' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'filter_bg_normal',
				[
					'label' => __( 'Background Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'condition' => array(
						'portfolio-style' => array('portfolio-style-1'),
					),
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .portfolio-main .b-isotope-filter.filter-style-1 li a' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'filter_border_normal',
				[
					'label' => __( 'Border Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'condition' => array(
						'portfolio-style' => array('portfolio-style-2','portfolio-style-3'),
					),
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .portfolio-main .b-isotope-filter.filter-style-2 li a' => 'border-bottom-color: {{VALUE}};',
						'{{WRAPPER}} .portfolio-main .b-isotope-filter.filter-style-3 li a' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'filter_button_active',
				[
					'label' => __( 'Active', 'finix' ),
				]
			);

			$this->add_control(
				'filter_text_active',
				[
					'label' => __( 'Text Active Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .portfolio-main .b-isotope-filter li.current a' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'filter_bg_active',
				[
					'label' => __( 'Background Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'condition' => array(
						'portfolio-style' => array('portfolio-style-1'),
					),
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .portfolio-main .b-isotope-filter.filter-style-1 li.current a' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'filter_border_active',
				[
					'label' => __( 'Border Color', 'finix' ),
					'type' => Controls_Manager::COLOR,
					'condition' => array(
						'portfolio-style' => array('portfolio-style-2','portfolio-style-3'),
					),
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .portfolio-main .b-isotope-filter.filter-style-2 li.current a' => 'border-bottom-color: {{VALUE}};',
						'{{WRAPPER}} .portfolio-main .b-isotope-filter.filter-style-3 li.current a' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

		$this->end_controls_section();

		$this->start_controls_section(
			'portfolio_color',
			array(
				'label' => __( 'Portfolio Color', 'finix' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'portfolio_background_color',
			array(
				'label'     => __( 'Background Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .portfolio-main .portfolio-style-1 .portfolio-control' => 'background: {{VALUE}};',
					'{{WRAPPER}} .portfolio-main .portfolio-style-2 .grid-item .item-info' => 'background: {{VALUE}};',
					'{{WRAPPER}} .portfolio-main .portfolio-style-3 .grid-item .item-info' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'portfolio_gradiant-bg-color',
				'label'     => __( 'Background Color', 'finix' ),
				'types'     => array( 'gradient' ),
				'selector'  => '{{WRAPPER}} .portfolio-main .portfolio-style-1 .portfolio-control, {{WRAPPER}} .portfolio-main .portfolio-style-2 .grid-item .item-info, {{WRAPPER}} .portfolio-main .portfolio-style-3 .grid-item .item-info',
			)
		);

		$this->add_control(
			'portfolio_link_color',
			array(
				'label'     => __( 'Icon Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .portfolio-main .portfolio-style-1 .portfolio-control .popup-link' => 'color: {{VALUE}};',
					'{{WRAPPER}} .portfolio-main .portfolio-style-2 .item-info .popup-link' => 'color: {{VALUE}};',
					'{{WRAPPER}} .portfolio-main .portfolio-style-3 .item-info .popup-link' => 'color: {{VALUE}};',
					'{{WRAPPER}} .portfolio-main .portfolio-style-3 .portfolio-item .popup-link' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'portfolio_link_hover_bg',
			array(
				'label'     => __( 'Icon Hover Background', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'condition' => array(
					'portfolio-style' => array( 'portfolio-style-3' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .portfolio-main .portfolio-style-3 .item-info .popup-link:hover' => 'background: {{VALUE}};',
					'{{WRAPPER}} .portfolio-main .portfolio-style-3 .portfolio-item .popup-link:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'portfolio_link_hover_color',
			array(
				'label'     => __( 'Icon Hover Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'portfolio-style' => array( 'portfolio-style-3' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .portfolio-main .portfolio-style-3 .item-info .popup-link:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'portfolio_info',
			array(
				'label' => __( 'Portfolio Info', 'finix' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'name-typography',
				'label'   => __( 'Name Typography', 'finix' ),
				'selector' => '{{WRAPPER}} .portfolio-main .item-info .portfolio-title',
			]
		);

		$this->add_control(
			'portfolio_name_color',
			array(
				'label'     => __( 'Name Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'after',
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .portfolio-main .grid-item .item-info .portfolio-title .title-link' => 'color: {{VALUE}};',
				),
			)
		);

		// $this->add_control(
		// 	'portfolio_name_hover_color',
		// 	array(
		// 		'label'     => __( 'Name Hover Color', 'finix' ),
		// 		'type'      => Controls_Manager::COLOR,
		// 		'default'   => '',
		// 		'selectors' => array(
		// 			'{{WRAPPER}} .portfolio-main .grid-item .item-info .portfolio-title .title-link:hover' => 'color: {{VALUE}};',
		// 		),
		// 	)
		// );

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'category-typography',
				'label'   => __( 'Category Typography', 'finix' ),
				'selector' => '{{WRAPPER}} .portfolio-main .item-info .portfolio-category',
			]
		);

		$this->add_control(
			'portfolio_category_color',
			array(
				'label'     => __( 'Category Color', 'finix' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .portfolio-main .grid-item .item-info .portfolio-category' => 'color: {{VALUE}};',
				),
			)
		);

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

		$args = array(
			'post_type'        => 'portfolio',
			'post_status'      => 'publish',
			'posts_per_page'   => $settings['total-count'],
			'numberposts'      => -1,
			'suppress_filters' => 0,
		);

		$the_query = new \WP_Query( $args );

		global $post;

		$portfolio_style = sprintf( '%1$s', esc_html( $settings['portfolio-style'], 'finix' ) );
		?>
		
		<?php if ( $settings['portfolio-type'] === 'type-grid' ) {
			$this->add_render_attribute( 'portfolio-grid', 'class', 'portfolio-main type-grid' );
			$this->add_render_attribute( 'portfolio-grid', 'class', $settings['grid-desk'] );
			$this->add_render_attribute( 'portfolio-grid', 'class', $settings['grid-lap'] );
			$this->add_render_attribute( 'portfolio-grid', 'class', $settings['grid-tab'] );
			$this->add_render_attribute( 'portfolio-grid', 'class', $settings['grid-mobile'] );
			$this->add_render_attribute( 'portfolio-grid', 'class', $settings['grid-mportal'] );
			$this->add_render_attribute( 'portfolio-grid', 'class', $settings['grid-space'] );
		 ?>
			<div <?php echo $this->get_render_attribute_string( 'portfolio-grid' ); ?>>
				<div class="b-isotope portfolio-wrapper <?php echo $portfolio_style; ?> portfolio-column-3">
				<?php 
				if ( $settings['filter'] == 'yes' ) {
				$filter_style = sprintf( '%1$s', esc_html( $settings['filter-style'], 'finix' ) );
				 ?>
				<ul class="b-isotope-filter clearfix <?php echo $filter_style; ?>">
					<?php $terms = get_terms( array( 'taxonomy' => 'portfolio-categories' ) ); ?>
				<li class="current"><a href="" data-filter="*">All</a></li>
					<?php foreach ( $terms as $term ) { ?>
				<li><a href="" data-filter=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></li>
				<?php } ?>
				</ul>
				<?php } ?>
				<ul class="b-isotope-grid grid list-unstyled">
					<li class="grid-sizer"></li>
					<?php
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						$term_list = wp_get_post_terms( get_the_ID(), 'portfolio-categories' );
						$slugs     = array();
						foreach ( $term_list as $term ) {
							$slugs[] = $term->slug;
						}
						$portfolio_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'finix_500x500' );
						?>
						<?php if ( $settings['portfolio-style'] === 'portfolio-style-1' ) { ?>
							<li class="grid-item <?php echo implode( ' ', $slugs ); ?>">
							<div class="portfolio-item">
								<div class="item-img">
									<div class="portfolio-control">
										<!-- <a class="popup-img" href="<?php echo esc_url( $portfolio_image[0] ); ?>"><i class="fa fa-search"></i></a> -->
										<a class="popup-link" href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><i class="ti ti-plus"></i></a>
									</div>
									<img src="<?php echo esc_url( $portfolio_image[0] ); ?>" alt="Design" /> 
								</div>
								<div class="item-info">
									<h3 class="portfolio-title"><a class="title-link" href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><?php echo sprintf( '%s', esc_html( get_the_title( $post->ID ), 'finix' ) ); ?></a></h3>
									<span class="portfolio-category"><?php echo $term->name; ?></span> 
								</div>
							</div>
							</li>
						<?php } ?>
						<?php if ( $settings['portfolio-style'] === 'portfolio-style-2' ) { ?>
						<li class="grid-item <?php echo implode( ' ', $slugs ); ?>">
						<div class="portfolio-item">
							<div class="item-img">
								<img src="<?php echo esc_url( $portfolio_image[0] ); ?>" alt="Design" /> 
							</div>
							<div class="item-info">
								<div class="info-inner">
									<h3 class="portfolio-title"><a class="title-link" href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><?php echo sprintf( '%s', esc_html( get_the_title( $post->ID ), 'finix' ) ); ?></a></h3>
									<span class="portfolio-category"><?php echo $term->name; ?></span>
								</div>
								<a class="popup-link" href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><i class="ti ti-arrow-right"></i></a>
							</div>
						</div>
					</li>
					<?php } ?>
					<?php if ( $settings['portfolio-style'] === 'portfolio-style-3' ) { ?>
						<li class="grid-item <?php echo implode( ' ', $slugs ); ?>">
						<div class="portfolio-item">
							<div class="item-img">
								<img src="<?php echo esc_url( $portfolio_image[0] ); ?>" alt="Design" /> 
							</div>
							<div class="item-info">
								<div class="info-inner">
									<span class="portfolio-category"><?php echo $term->name; ?></span>
									<h3 class="portfolio-title"><a class="title-link" href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><?php echo sprintf( '%s', esc_html( get_the_title( $post->ID ), 'finix' ) ); ?></a></h3>
								</div>
								<a class="popup-link" href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><i class="ti ti-arrow-right"></i></a>
							</div>
						</div>
					</li>
					<?php } ?>
						<?php
					}
					wp_reset_postdata();
					?>
				</ul>
				</div>
			</div>
		<?php } ?>
		<?php if ( $settings['portfolio-type'] === 'type-masonry' ) {
			$this->add_render_attribute( 'portfolio-grid', 'class', 'portfolio-main type-masonry' );
			$this->add_render_attribute( 'portfolio-grid', 'class', $settings['grid-desk'] );
			$this->add_render_attribute( 'portfolio-grid', 'class', $settings['grid-lap'] );
			$this->add_render_attribute( 'portfolio-grid', 'class', $settings['grid-tab'] );
			$this->add_render_attribute( 'portfolio-grid', 'class', $settings['grid-mobile'] );
			$this->add_render_attribute( 'portfolio-grid', 'class', $settings['grid-mportal'] );
			$this->add_render_attribute( 'portfolio-grid', 'class', $settings['grid-space'] );
		 ?>
			<div <?php echo $this->get_render_attribute_string( 'portfolio-grid' ); ?>>
				<div class="b-isotope portfolio-wrapper <?php echo $portfolio_style; ?> portfolio-column-3">
				<?php 
				if ( $settings['filter'] == 'yes' ) {
				$filter_style = sprintf( '%1$s', esc_html( $settings['filter-style'], 'finix' ) );
				 ?>
				<ul class="b-isotope-filter clearfix <?php echo $filter_style; ?>">
					<?php $terms = get_terms( array( 'taxonomy' => 'portfolio-categories' ) ); ?>
				<li class="current"><a href="" data-filter="*">All</a></li>
					<?php foreach ( $terms as $term ) { ?>
				<li><a href="" data-filter=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></li>
				<?php } ?>
				</ul>
				<?php } ?>
				<ul class="b-isotope-grid grid list-unstyled">
					<li class="grid-sizer"></li>
					<?php
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						$term_list = wp_get_post_terms( get_the_ID(), 'portfolio-categories' );
						$slugs     = array();
						foreach ( $term_list as $term ) {
							$slugs[] = $term->slug;
						}
						
						$portfolio_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
						?>
						<?php if ( $settings['portfolio-style'] === 'portfolio-style-1' ) { ?>
							<li class="grid-item <?php echo implode( ' ', $slugs ); ?>">
							<div class="portfolio-item">
								<div class="item-img">
									<div class="portfolio-control">
										<!-- <a class="popup-img" href="<?php echo esc_url( $portfolio_image[0] ); ?>"><i class="fa fa-search"></i></a> -->
										<a class="popup-link" href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><i class="ti ti-plus"></i></a>
									</div>
									<img src="<?php echo esc_url( $portfolio_image[0] ); ?>" alt="Design" /> 
								</div>
								<div class="item-info">
									<h3 class="portfolio-title"><a class="title-link" href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><?php echo sprintf( '%s', esc_html( get_the_title( $post->ID ), 'finix' ) ); ?></a></h3>
									<span class="portfolio-category"><?php echo $term->name; ?></span> 
								</div>
							</div>
							</li>
						<?php } ?>
						<?php if ( $settings['portfolio-style'] === 'portfolio-style-2' ) { ?>
						<li class="grid-item <?php echo implode( ' ', $slugs ); ?>">
						<div class="portfolio-item">
							<div class="item-img">
								<img src="<?php echo esc_url( $portfolio_image[0] ); ?>" alt="Design" /> 
							</div>
							<div class="item-info">
								<div class="info-inner">
									<h3 class="portfolio-title"><a class="title-link" href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><?php echo sprintf( '%s', esc_html( get_the_title( $post->ID ), 'finix' ) ); ?></a></h3>
									<span class="portfolio-category"><?php echo $term->name; ?></span>
								</div>
								<a class="popup-link" href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><i class="ti ti-arrow-right"></i></a>
							</div>
						</div>
					</li>
					<?php } ?>
					<?php if ( $settings['portfolio-style'] === 'portfolio-style-3' ) { ?>
						<li class="grid-item <?php echo implode( ' ', $slugs ); ?>">
						<div class="portfolio-item">
							<div class="item-img">
								<img src="<?php echo esc_url( $portfolio_image[0] ); ?>" alt="Design" /> 
							</div>
							<div class="item-info">
								<div class="info-inner">
									<span class="portfolio-category"><?php echo $term->name; ?></span>
									<h3 class="portfolio-title"><a class="title-link" href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><?php echo sprintf( '%s', esc_html( get_the_title( $post->ID ), 'finix' ) ); ?></a></h3>
								</div>
								<a class="popup-link" href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><i class="ti ti-arrow-right"></i></a>
							</div>
						</div>
					</li>
					<?php } ?>
						<?php
					}
					wp_reset_postdata();
					?>
				</ul>
				</div>
			</div>
		<?php } ?>
		<?php if ( $settings['portfolio-type'] === 'type-slider' ) { 

				$arrow_style = sprintf( '%1$s', esc_html( $settings['arrow-style'], 'finix' ) );
				
				$this->add_render_attribute( 'portfolio-slider', 'class', 'portfolio-slider swiper-container' );
				$this->add_render_attribute( 'portfolio-slider', 'data-items', $settings['slider-desk'] );
				$this->add_render_attribute( 'portfolio-slider', 'data-lg-items', $settings['slider-laptop'] );
				$this->add_render_attribute( 'portfolio-slider', 'data-md-items', $settings['slider-tab'] );
				$this->add_render_attribute( 'portfolio-slider', 'data-sm-items', $settings['slider-mobile'] );
				$this->add_render_attribute( 'portfolio-slider', 'data-xs-items', $settings['slider-mobile-portal'] );
				$this->add_render_attribute( 'portfolio-slider', 'data-space', $settings['slider-data-space']['size'] );
				$this->add_render_attribute( 'portfolio-slider', 'data-arrow', $settings['slider-arrow'] );
				$this->add_render_attribute( 'portfolio-slider', 'data-bullets', $settings['slider-dots'] );
				$this->add_render_attribute( 'portfolio-slider', 'data-autoplay', $settings['autoplay'] );
				$this->add_render_attribute( 'portfolio-slider', 'data-loop', $settings['loop'] );
				?>
			<div class="portfolio-main type-slider <?php echo $arrow_style; ?>">
				<div class="b-isotope portfolio-wrapper <?php echo $portfolio_style; ?> portfolio-column-3">
					<div <?php echo $this->get_render_attribute_string( 'portfolio-slider' ); ?>>
						<div class="swiper-wrapper">						
							<?php
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								$term_list = wp_get_post_terms( get_the_ID(), 'portfolio-categories' );
								$slugs     = array();
								foreach ( $term_list as $term ) {
									$slugs[] = $term->slug;
								}								
								$portfolio_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'finix_500x500' );								
								?>
								<div class="swiper-slide grid-item">
									<?php if ( $settings['portfolio-style'] === 'portfolio-style-1' ) { ?>
									<div class="portfolio-item">
										<div class="item-img">
											<div class="portfolio-control">
												<!-- <a class="popup-img" href="<?php echo esc_url( $portfolio_image[0] ); ?>"><i class="fa fa-search"></i></a> -->
												<a class="popup-link" href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><i class="ti ti-plus"></i></a>
											</div>
											<img src="<?php echo esc_url( $portfolio_image[0] ); ?>" alt="Design" /> 
										</div>
										<div class="item-info">
											<h3 class="portfolio-title"><a class="title-link" href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><?php echo sprintf( '%s', esc_html( get_the_title( $post->ID ), 'finix' ) ); ?></a></h3>
											<span class="portfolio-info"><?php echo $term->name; ?></span> 
										</div>
									</div>
									<?php } ?>
									<?php if ( $settings['portfolio-style'] === 'portfolio-style-2' ) { ?>
										<div class="portfolio-item">
										<div class="item-img">
											<img src="<?php echo esc_url( $portfolio_image[0] ); ?>" alt="Design" /> 
										</div>
										<div class="item-info">
										<div class="info-inner">
												<h3 class="portfolio-title"><a class="title-link" href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><?php echo sprintf( '%s', esc_html( get_the_title( $post->ID ), 'finix' ) ); ?></a></h3>
												<span class="portfolio-category"><?php echo $term->name; ?></span>
											</div>
											<a class="popup-link" href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><i class="ti ti-arrow-right"></i></a>
										</div>
									</div>
									<?php } ?>
									<?php if ( $settings['portfolio-style'] === 'portfolio-style-3' ) { ?>
										<div class="portfolio-item">
										<div class="item-img">
											<img src="<?php echo esc_url( $portfolio_image[0] ); ?>" alt="Design" /> 
										</div>
										<div class="item-info">
										<div class="info-inner">
												<span class="portfolio-category"><?php echo $term->name; ?></span>
												<h3 class="portfolio-title"><a class="title-link" href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><?php echo sprintf( '%s', esc_html( get_the_title( $post->ID ), 'finix' ) ); ?></a></h3>
											</div>
											<a class="popup-link" href="<?php echo esc_url( get_permalink( $the_query->ID ) ); ?>"><i class="ti ti-arrow-right"></i></a>
										</div>
									</div>
									<?php } ?>
								</div>
								<?php
							}
							wp_reset_postdata();
							?>
						</div>
					
						<div class="swiper-pagination"></div>
						<div class="swiper-button-next"><i class="fas fa-chevron-right"></i></div>
						<div class="swiper-button-prev"><i class="fas fa-chevron-left"></i></div>
					
					</div>

				</div>
			</div>										
		<?php } ?>
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
		<?php
	}

}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\portfolio() );
?>
