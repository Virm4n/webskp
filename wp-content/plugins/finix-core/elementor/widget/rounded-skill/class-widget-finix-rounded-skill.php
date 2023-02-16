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

class finix_rounded_skill extends Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve section title widget name.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget name.
	 */

	public function get_name() {
		return __( 'rounded-skill', 'finix' );
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve section title widget title.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	
	public function get_title() {
		return __( 'Rounded Skill', 'finix' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the section title widget belongs to.
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
	 * Retrieve section title widget icon.
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
	 * Register section title widget controls.
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
				'label' => __( 'Rounded Skill', 'finix' ),
			]
		);

		$this->add_control(
			'line-cap',
			[
				'label'      => __( 'Line Cap', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'square',
				'options'    => [
					'square'          => __( 'Square', 'finix' ),
					'round'          => __( 'Round', 'finix' ),	
				],
			]
		);

		$this->add_responsive_control(
			'skill-width',
			[
				'label' => __( 'Width', 'finix' ),
				'type' => Controls_Manager::SLIDER,	
				'default' => [
					'size' => 8,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],			
			]
		);

		$this->add_responsive_control(
			'max-sz',
			[
				'label' => __( 'Size', 'finix' ),
				'type' => Controls_Manager::SLIDER,	
				'default' => [
					'size' => 100,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],			
			]
		);

		$this->add_control(
			'skill_track_color',
			[
				'label' => __( 'Track Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rounded-skill' => 'color: {{VALUE}};',
		 		],
			]
		);

		$this->add_control(
			'skill_bg_color',
			[
				'label' => __( 'Skill Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .rounded-skill' => 'color: {{VALUE}};',
		 		],
			]
		);

		$this->add_control(
			'value-no',
			[
				'label' => __( 'Value Number', 'finix' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '60', 'finix' ),
				'placeholder' => __( '60', 'finix' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'value-sufix',
			[
				'label' => __( 'Value Sufix', 'finix' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '%', 'finix' ),
				'placeholder' => __( '%', 'finix' ),
				'label_block' => true,
			]
		);

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'value-typography',
				'selector' => '{{WRAPPER}} .rounded-skill .counter',
			]
		);

		$this->add_control(
			'value_color',
			[
				'label' => __( 'Value Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rounded-skill .counter' => 'color: {{VALUE}};',
		 		],
			]
		);

		
		$this->end_controls_section(); 
		
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content Information', 'finix' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title-contant',
			[
				'label' => __( 'Skill Info', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => __( 'OFF', 'elementor' ),
				'label_on' => __( 'ON', 'elementor' ),
			]
		);

		$this->add_control(
			'skill-position',
			[
				'label' => __( 'Skill Position', 'finix' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'skill-top',
				'condition' => [
					'title-contant' => 'yes',
				],
				'options' => [
					'skill-left' => [
						'title' => __( 'Left', 'finix' ),
						'icon' => 'eicon-h-align-left',
					],
					'skill-top' => [
						'title' => __( 'Top', 'finix' ),
						'icon' => 'eicon-v-align-top',
					],
					'skill-right' => [
						'title' => __( 'Right', 'finix' ),
						'icon' => 'eicon-h-align-right',
					],
				],
			]
		);

		$this->add_responsive_control(
			'content_spacing',
			[
				'label' => __( 'Content Spacing', 'finix' ),
				'type' => Controls_Manager::SLIDER,	
				'default' => [
					'size' => 25,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .skill-fuature.skill-left .fuature-inner' => 'padding-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .skill-fuature.skill-top .fuature-inner' => 'padding-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .skill-fuature.skill-right .fuature-inner' => 'padding-right: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .skill-fuature.skill-left .fuature-inner' => 'padding-right: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .skill-fuature.skill-right .fuature-inner' => 'padding-left: {{SIZE}}{{UNIT}};',
				],		
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Skill Title', 'finix' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'title-contant' => 'yes',
				],
                'label_block' => true,
                'default' => __( 'Infobox Title', 'finix' ),
			]
		);

		$this->add_control(
			'title-tag',
			[
				'label'      => __( 'Title Tag', 'finix' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'h2',
				'condition' => [
					'title-contant' => 'yes',
				],
				'options'    => [
					'h2'          => __( 'h2', 'finix' ),
					'h3'          => __( 'h3', 'finix' ),
					'h4'          => __( 'h4', 'finix' ),
					'h5'          => __( 'h5', 'finix' ),
					'h6'          => __( 'h6', 'finix' ),					
				],
			]
		);

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'info-typography',
				'condition' => [
					'title-contant' => 'yes',
				],
				'selector' => '{{WRAPPER}} .skill-fuature .feature-info .title',
			]
		);

		$this->add_control(
			'info-title_color',
			[
				'label' => __( 'Title Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'title-contant' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .skill-fuature .feature-info .title' => 'color: {{VALUE}};',
		 		],
			]
		);

		$this->add_control(
			'info-content_color',
			[
				'label' => __( 'Contant Color', 'finix' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'title-contant' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .skill-fuature .feature-info p' => 'color: {{VALUE}};',
		 		],
			]
		);

		$this->add_control(
			'contant',
			[
				'label' => __( 'Contant', 'finix' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'title-contant' => 'yes',
				],
				'placeholder' => __( 'Enter your Contant', 'finix' ),
				'default' => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'finix' ),
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'finix' ),
				'type' => Controls_Manager::CHOOSE,
				'condition' => [
					'title-contant' => 'yes',
					'skill-position' => 'skill-top',
				],
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
				'prefix_class' => 'finix-align-',
				'default' => '',
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
		$align = $settings['align'];

		$skill_position = sprintf('%1$s',esc_html($settings['skill-position'],'finix'));

		?>
		<div class="skill-fuature <?php echo $skill_position; ?> <?php echo esc_attr($align);?>">
			<div class="skill-inner">
				<div class="rounded-skill" data-percent="<?php echo $settings['value-no'];  ?>" data-trackcolor="<?php echo $settings['skill_track_color'];  ?>" data-color="<?php echo $settings['skill_bg_color'];  ?>" data-width="<?php echo $settings['skill-width']['size'];  ?>" data-cap="<?php echo $settings['line-cap'];  ?>" data-speed="3000" data-size="<?php echo $settings['max-sz']['size'];  ?>">
				<div class="counter"><span class="timer" data-speed="3000" data-to="<?php echo $settings['value-no'];  ?>"><?php echo $settings['value-no'];  ?></span><?php echo $settings['value-sufix'];  ?></div>
				</div>
			</div>
			<?php if($settings['title-contant'] == 'yes') { ?>
			<div class="fuature-inner">
				<div class="feature-box">
				<div class="feature-info">
					<?php if($settings['title']) { ?>
						<<?php echo $settings['title-tag'];  ?> class="title"><?php echo sprintf('%1$s',esc_html($settings['title'],'finix')); ?></<?php echo $settings['title-tag'];  ?>>
					<?php } if($settings['contant']) { ?>
						<p><?php echo sprintf('%1$s',esc_html($settings['contant'],'finix'));?></p>
					<?php } ?>
				</div>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php	
		if ( Plugin::$instance->editor->is_edit_mode() ) :
		?>
		<script>
			var $roundedSkillEl = jQuery('.rounded-skill');
		      if( $roundedSkillEl.length > 0 ){
		        $roundedSkillEl.each(function(){
		          var element = jQuery(this);
		          var roundSkillSize = element.attr('data-size');
		          var roundSkillSpeed = element.attr('data-speed');
		          var roundSkillWidth = element.attr('data-width');
		          var roundSkillColor = element.attr('data-color');
		          var roundSkillCap = element.attr('data-cap');
		          var roundSkillTrackColor = element.attr('data-trackcolor');
		          if( !roundSkillSize ) { roundSkillSize = 140; }
		          if( !roundSkillSpeed ) { roundSkillSpeed = 2000; }
		          if( !roundSkillWidth ) { roundSkillWidth = 8; }
		          if( !roundSkillColor ) { roundSkillColor = '#0093BF'; }
		          if( !roundSkillCap ) { roundSkillCap = 'square'; }
		         if( !roundSkillTrackColor ) { roundSkillTrackColor = 'rgba(200,200,200,0.2)'; }
		          var properties = {roundSkillSize:roundSkillSize, roundSkillSpeed:roundSkillSpeed, roundSkillWidth:roundSkillWidth, roundSkillColor:roundSkillColor, roundSkillCap:roundSkillCap, roundSkillTrackColor:roundSkillTrackColor};
		           element.css({'width':roundSkillSize+'px','height':roundSkillSize+'px','line-height':roundSkillSize+'px'}).animate({opacity:1}, 10);
		            element.appear(function () {
		              if (!element.hasClass('skills-animated')) {
		                var t = setTimeout( function(){ element.css({opacity: 1}); }, 100 );
		                runRoundedSkills( element, properties );
		                element.addClass('skills-animated');
		              }
		            });
		        });      

		       }
		    function runRoundedSkills( element, properties){
		      element.easyPieChart({
		        size: Number(properties.roundSkillSize),
		        animate: Number(properties.roundSkillSpeed),
		        scaleColor: false,
		        trackColor: properties.roundSkillTrackColor,
		        lineWidth: Number(properties.roundSkillWidth),
		        lineCap: properties.roundSkillCap,
		        barColor: properties.roundSkillColor
		      });
		    }
		</script>
		<?php endif; 
    }	    	
}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\finix_rounded_skill() );
?>