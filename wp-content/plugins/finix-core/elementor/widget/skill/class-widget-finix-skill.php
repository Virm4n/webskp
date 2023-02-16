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

class skill extends Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve skill widget name.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget name.
	 */

	public function get_name() {
		return __( 'Skill', 'finix' );
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve skill widget title.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	
	public function get_title() {
		return __( 'Skill', 'finix' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the Skill of categories the skill widget belongs to.
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
	 * Retrieve skill widget icon.
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
	 * Register skill widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.1.0
	 * @access protected
	 */

	protected function _register_controls() {
			
		$this->start_controls_section(
			'skill-setting',
			[
				'label' => __( 'Genral Setting', 'finix' ),
			]
		);

		$this->add_control(
			'skill-style',
			[
				'label'      => __( 'Select Style', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'skill-1',
				'options'    => [
					'skill-1'          => __( 'Style 1', 'finix' ),
					'skill-2'          => __( 'Style 2', 'finix' ),
					'skill-3'          => __( 'Style 3', 'finix' ),	
				],
			]
		);

		$this->add_control(
			'value_position',
			[
				'label' => __( 'Position Outside', 'finix' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'yes' => __( 'yes', 'finix' ),
				'no' => __( 'no', 'finix' ),
			]
        );

        $this->add_control(
			'value_style',
			[
				'label' => __( 'Track Style', 'finix' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'yes' => __( 'yes', 'finix' ),
				'no' => __( 'no', 'finix' ),
			]
        );

		$this->add_control(
			'skill-size',
			[
				'label' => __( 'Skill Size', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],	
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .skill.skill-1 .skill-bar' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .skill.skill-2 .progress-bar' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .skill.skill-3 .progress-bar' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'skill-space',
			[
				'label' => __( 'Skill Space', 'finix' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'default' => [
					'size' => 55,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .skill-bar:not(:first-child)' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); 

		$this->start_controls_section(
			'skill-items',
			[
				'label' => __( 'Skill Items', 'finix' ),
			]
		);

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'title-typography',
				'selector' => '{{WRAPPER}} .skill .progress-title',
			]
		);

		$this->add_control(
			'title-color',
			[
				'label' => __( 'Title Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'separator'        => 'after',
				'selectors' => [
					'{{WRAPPER}} .skill .progress-title' => 'color: {{VALUE}};',
		 		],
			]
		);

		$repeater = new Repeater();
        $repeater->add_control(
			'skill-title',
			[
				'label' => __( 'Title', 'finix' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Skill Title', 'finix' ),
				'placeholder' => __( 'Skill Title', 'finix' ),
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'skill-number',
			[
				'label' => __( 'Skill Number', 'finix' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '85', 'finix' ),
				'placeholder' => __( '85', 'finix' ),
				'label_block' => true,
			]
		);
		   
		$this->add_control(
			'tabs',
			[
				'label' => __( 'Skill Items', 'finix' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'skill-title' => __( 'Skill Items', 'finix' ),  
						'skill-number' => __( '85', 'finix' ),  
					]
				],
			]
		);
		
		$this->end_controls_section(); 

		$this->start_controls_section(
			'style-skill',
			[
				'label' => __( 'Skill Color Options', 'finix' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'color-type',
			[
				'label'      => __( 'Select Color Type', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'color-default',
				'options'    => [
					'color-default'          => __( 'Default', 'finix' ),
					'color-custom'          => __( 'Custom', 'finix' ),			
				]
			]
		);

		$this->add_control(
			'value-bg-color',
			[
				'label' => __( 'Background Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'color-type'=>['color-custom'],
					'skill-style'=>['skill-1']
				],
				'selectors' => [
					'{{WRAPPER}} .skill.skill-1.color-custom .skill-bar' => 'background: {{VALUE}};'
		 		],
			]
		);

		$this->add_control(
			'value-border-color',
			[
				'label' => __( 'Border Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'color-type'=>['color-custom'],
					'skill-style'=>['skill-2','skill-3']
				],
				'selectors' => [
					'{{WRAPPER}} .skill.skill-2.color-custom .skill-bar' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .skill.skill-3.color-custom .skill-bar' => 'border-bottom-color: {{VALUE}};',
		 		],
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'value_gradiant_color',
				'label' => __( 'Hover Background', 'finix' ),
				'condition' => [
					'color-type'=>['color-custom']
				],
                'types' => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .skill.color-custom .progress-bar ',
            ]
        );

        $this->add_control(
			'number-color',
			[
				'label' => __( 'Value Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skill .progress-bar .progress-value' => 'color: {{VALUE}};',
		 		],
			]
		);

		$this->add_control(
			'track-bg-color',
			[
				'label' => __( 'Track BG Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'value_style'=>['yes']
				],
				'selectors' => [
					'{{WRAPPER}} .skill.value-track .progress-bar .progress-value' => 'background: {{VALUE}};',
					'{{WRAPPER}} .skill.value-track .progress-bar .progress-value:after' => 'border-top-color: {{VALUE}};',
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
		
		$settings = $this->get_settings();

		$tabs = $this->get_settings_for_display( 'tabs' ); 

		$this->add_render_attribute( 'skill', 'class', 'skill' );
		$this->add_render_attribute( 'skill', 'class', $settings['color-type'] );
		$this->add_render_attribute( 'skill', 'class', $settings['skill-style'] );

		if($settings['value_position'] == 'yes') {
			$this->add_render_attribute( 'skill', 'class', 'value-outside' ); 
		}
		if($settings['value_style'] == 'yes') {
			$this->add_render_attribute( 'skill', 'class', 'value-track' ); 
		}
		?>
		<div <?php echo $this->get_render_attribute_string( 'skill' ); ?>>
			<?php foreach ( $tabs as $index => $item ){ ?>
			<div class="skill-bar">
				<div class="progress-bar" data-percent="<?php echo esc_html($item['skill-number'],'finix'); ?>" data-delay="0" data-type="%" style="width: 0%;">
                    <h3 class="progress-title"><?php echo sprintf('%1$s',esc_html($item['skill-title'],'finix')) ; ?></h3>
                </div>
			</div>
			<?php } ?>
		</div>
		<?php	
		if ( Plugin::$instance->editor->is_edit_mode() ) :
		?>
		<script>
			jQuery('.progress-bar').each(function(i, elem) {
				var $elem = jQuery(this),
                percent = $elem.attr('data-percent') || "100",
                delay = $elem.attr('data-delay') || "100",
                type = $elem.attr('data-type') || "%";
				if (!$elem.hasClass('progress-animated')) {
					$elem.css({
						'width': '0%'
					});
				}
			var progressBarRun = function () {
				$elem.animate({
					'width': percent + '%'
				}, 'easeInOutCirc').addClass('progress-animated');
				$elem.delay(delay).append('<div class="progress-value"><span class="progress-number animated fadeIn">' + percent + '</span><span class="progress-type animated fadeIn">' + type + '</span></div>');
			};
			jQuery(elem).appear(function () {
					setTimeout(function () {
						progressBarRun();
					}, delay);
				});
			});
		</script>
		<?php endif; 
	}	
}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\skill() );
?>