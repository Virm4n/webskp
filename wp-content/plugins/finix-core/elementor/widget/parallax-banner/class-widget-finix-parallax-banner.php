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

class parallax_banner extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Parallax Banner widget name.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget name.
	 */

	public function get_name() {
		return __( 'parallax_banner', 'finix' );
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Parallax Banner widget title.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */

	public function get_title() {
		return __( 'Parallax Banner', 'finix' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Parallax Banner widget belongs to.
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
	 * Retrieve Parallax Banner widget icon.
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
	 * Register Parallax Banner widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.1.0
	 * @access protected
	 */

	protected function _register_controls() {

		$this->start_controls_section(
			'sub_title-setting',
			array(
				'label' => __( 'Parallax Main Image', 'finix' ),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'   => __( 'Main Image', 'finix' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array(
					'active' => true,
				),
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_responsive_control(
			'width',
			[
				'label' => __( 'Image Width', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .parallax-banner .main-img img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .parallax-banner' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .parallax-banner .main-img' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section(); 

		$this->start_controls_section(
			'parallax-images1',
			[
				'label' => __( 'Parallax Images', 'finix' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_images',
			array(
				'label'   => __( 'Parallax Images', 'finix' ),
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
			'parallax-depth',
			array(
				'label' => __( 'Data Depth', 'elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'default' => [
					'size' => 50,
				],
			)
		);

		$repeater->add_responsive_control(
			'inner-img-width',
			[
				'label' => __( 'Image Width', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'separator'   => 'after',
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .parallax-img{{CURRENT_ITEM}} img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_responsive_control(
			'horizontal-align',
			array(
				'label'   => __( 'Horizontal Alignment', 'finix' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'pos-left'   => array(
						'title' => __( 'Left', 'finix' ),
						'icon'  => 'eicon-h-align-left',
					),
					'pos-right'  => array(
						'title' => __( 'Right', 'finix' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
			)
		);

		$repeater->add_responsive_control(
			'horizontal_size',
			array(
				'label'     => __( 'Horizontal Size', 'finix' ),
				'type'      => Controls_Manager::SLIDER,
				'default' => [
					'size' => '0',
				],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%', 'vw', 'vh' ],
				'selectors' => array(
					'{{WRAPPER}} .parallax-img{{CURRENT_ITEM}}.pos-left' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .parallax-img{{CURRENT_ITEM}}.pos-right' => 'right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$repeater->add_responsive_control(
			'vertical-align',
			array(
				'label'   => __( 'Vertical Alignment', 'finix' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'pos-top'    => array(
						'title' => __( 'Top', 'finix' ),
						'icon'  => 'eicon-v-align-top',
					),
					'pos-bottom' => array(
						'title' => __( 'Bottom', 'finix' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
			)
		);

		$repeater->add_responsive_control(
			'vertical_size',
			array(
				'label'     => __( 'Vertical Size', 'finix' ),
				'type'      => Controls_Manager::SLIDER,
				'default' => [
					'size' => '0',
				],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%', 'vw', 'vh' ],
				'selectors' => array(
					'{{WRAPPER}} .parallax-img{{CURRENT_ITEM}}.pos-top' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .parallax-img{{CURRENT_ITEM}}.pos-bottom' => 'bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$repeater->add_responsive_control(
			'_z_index',
			[
				'label' => __( 'Z-Index', 'elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'selectors' => [
					'{{WRAPPER}} .parallax-img{{CURRENT_ITEM}}' => 'z-index: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$repeater->add_responsive_control(
			'hide-tablet',
			[
				'label' => __( 'Hide Tablet', 'finix' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'yes' => __( 'yes', 'finix' ),
				'no' => __( 'no', 'finix' ),
			]
		);

		$repeater->add_responsive_control(
			'hide-mobile',
			[
				'label' => __( 'Hide Mobile', 'finix' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'yes' => __( 'yes', 'finix' ),
				'no' => __( 'no', 'finix' ),
			]
		);

		$this->add_control(
			'tabs',
			array(
				'label'       => __( 'Tabs Items', 'finix' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'range' => [
					'min' => 0,
					'max' => 5,
				],
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
		
		if ( ! empty( $settings['image']['url'] ) ) {
			$this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
			$this->add_render_attribute( 'image', 'srcset', $settings['image']['url'] );
			$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
			$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );
			$image = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );
		}

		?>
		<div class="parallax-banner">
			<div class="images-parallax js-scene">
				<?php
				$i = 0;
				foreach ( $tabs as $index => $item ) {
					
					$link_key = 'link_' . $index;

					$this->add_render_attribute( $link_key, 'class', [
						'parallax-img layer elementor-repeater-item-' . $item['_id'], $item['horizontal-align'], $item['vertical-align'],
					] );

					if ( ! empty( $item['tab_images']['url'] ) ) {
						$tab_images = $item['tab_images']['url'];
					}

					if($item['hide-tablet'] == 'yes'){ $this->add_render_attribute( $link_key, 'class', 'parallax-hide-tablet' ); }
					if($item['hide-mobile'] == 'yes'){ $this->add_render_attribute( $link_key, 'class', 'parallax-hide-mobile' ); }
				?>
				<div <?php echo $this->get_render_attribute_string( $link_key ); ?> data-depth="0.<?php echo esc_html($item['parallax-depth']['size'],'finix'); ?>"><img src="<?php echo $tab_images; ?>" alt="image1"/></div>
				<?php } ?>
				<div class="main-img"><?php echo $image; ?></div>
			</div>
		</div>
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\parallax_banner() );
?>
