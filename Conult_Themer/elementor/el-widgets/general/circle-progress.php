<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;

class GVAElement_Circle_Progress extends GVAElement_Base {
	const NAME = 'gva-circle-progress';
   const TEMPLATE = 'general/circle-progress';
   const CATEGORY = 'conult_general';

	public function get_name() {
      return self::NAME;
   }

   public function get_categories() {
      return array(self::CATEGORY);
   }

	public function get_title() {
		return __( 'GVA Circle Progress', 'conult-themer' );
	}

	public function get_script_depends() {
		return [
			'circle-progress',
			'gavias.elements'
		];
	}

	public function get_keywords() {
		return [ 'circle', 'progress' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Content', 'conult-themer' ),
			]
		);
		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'conult-themer' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter your title', 'conult-themer' ),
				'default'	  => esc_html__( 'Quality of Work', 'conult-themer' )
			]
		);
		$this->add_control(
			'empty_fill',
			[
				'label' => __( 'Color EmptyFill', 'conult-themer' ),
				'type' => Controls_Manager::COLOR
			]
		);
		$this->add_control(
			'color',
			[
				'label' => __( 'Color', 'conult-themer' ),
				'type' => Controls_Manager::COLOR
			]
		);
		$this->add_control(
			'width',
			[
			  	'label' => __( 'Width', 'conult-themer' ),
			  	'type' => Controls_Manager::NUMBER,
				'min' => 5,
			  	'max' => 300,
			  	'step' => 1,
			  	'default' => 122,
			]
	 	);
		$this->add_control(
			'number',
			[
			  	'label' => __( 'Percentage', 'conult-themer' ),
			  	'type' => Controls_Manager::NUMBER,
				'min' => 5,
			  	'max' => 100,
			  	'step' => 1,
			  	'default' => 50,
			]
	 	);
	 	$this->add_control(
			'thickness',
			[
			  	'label' => __( 'Thickness', 'conult-themer' ),
			  	'type' => Controls_Manager::NUMBER,
				'min' => 1,
			  	'max' => 50,
			  	'step' => 1,
			  	'default' => 3,
			]
	 	);
  	
		$this->end_controls_section();


		//Style Title
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'conult-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
 
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'conult-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-circle-progress .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_title',
				'selector' => '{{WRAPPER}} .gsc-circle-progress .title',
			]
		);
		$this->end_controls_section();
		
		//Style Percentage
		$this->start_controls_section(
			'section_percentage_style',
			[
				'label' => __( 'Percentage', 'conult-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
 
		$this->add_control(
			'percentage_color',
			[ 
				'label' => __( 'Percentage Color', 'conult-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-circle-progress .circle-progress strong' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_percentage',
				'selector' => '{{WRAPPER}} .gsc-circle-progress .circle-progress strong',
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render heading widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		
		printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
			include $this->get_template(self::TEMPLATE . '.php');
		print '</div>';
	}

}

 $widgets_manager->register(new GVAElement_Circle_Progress());
