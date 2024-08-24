<?php

if (!defined('ABSPATH')) {
		exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class GVAElement_Icon_Box_Group extends GVAElement_Base{
	const NAME = 'gva_icon_box_group';
	const TEMPLATE = 'booking/booking';
	const CATEGORY = 'conult_general';

	public function get_categories() {
		return array(self::CATEGORY);
	}
		
	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return esc_html__('Icon Box Group', 'conult-themer');
	}

	public function get_keywords() {
		return [ 'icon', 'box', 'content', 'carousel', 'grid' ];
	}

	public function get_script_depends() {
		return [
			'swiper',
			'gavias.elements',
		];
	}

	public function get_style_depends() {
		return array('swiper');
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__('Content', 'conult-themer'),
			]
		);
		$this->add_control( // xx Layout
			'layout_heading',
			[
				'label'   => esc_html__('Layout', 'conult-themer'),
				'type'    => Controls_Manager::HEADING,
			]
		);
		
		$this->add_control(
			'layout',
			[
				'label'   => esc_html__('Layout Display', 'conult-themer'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => [
					'grid'      => esc_html__('Grid', 'conult-themer'),
					'carousel'  => esc_html__('Carousel', 'conult-themer')
				]
			]
		);

		$this->add_control(
			'style',
			[
				'label' 		=> esc_html__('Style', 'conult-themer'),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'style-1' => esc_html__('Style I', 'conult-themer'),
					'style-2' => esc_html__('Style II', 'conult-themer'),
				],
				'default' => 'style-1',
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__('Title', 'conult-themer'),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Add your Title',
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'desc',
			[
				'label'       => esc_html__('Description', 'conult-themer'),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'Lorem ipsum is simply sit of free text dolor.',
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'selected_icon',
			[
				'label'      	=> esc_html__('Choose Icon', 'conult-themer'),
				'type'       	=> Controls_Manager::ICONS,
				'default' 		=> [
					'value' 		=> 'icon-conult-strategy',
					'library' 	=> 'conult-icons-theme'
				]
			]
		);
		$repeater->add_control(
			'link',
			[
				'label'     	=> esc_html__('Link', 'conult-themer'),
				'type'      	=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__('https://your-link.com', 'conult-themer'),
				'label_block' 	=> true
			]
		);
		$repeater->add_control(
			'icon_color',
			[
				'label'     	=> esc_html__('Icon Color', 'conult-themer'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .style-1 {{CURRENT_ITEM}} .icon-box-content .box-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .style-1 {{CURRENT_ITEM}} .icon-box-content .box-icon svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .style-2 {{CURRENT_ITEM}} .icon-box-content .box-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .style-2 {{CURRENT_ITEM}} .icon-box-content .box-icon svg' => 'fill: {{VALUE}}'
				],
			]
		);
		$repeater->add_control(
			'active',
			[
				'label' 			=> esc_html__('Active', 'conult-themer'),
				'type' 			=> Controls_Manager::SWITCHER,
				'placeholder' 	=> esc_html__('Active', 'conult-themer'),
				'default' 		=> 'no'
			]
		);

		$this->add_control(
			'icon_boxs',
			[
				'label'       => esc_html__('Brand Content Item', 'conult-themer'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
					array(
						'title'  					=> esc_html__('Wealth Management', 'conult-themer'),
						'selected_icon' 			=> array('value' => 'icon-conult-strategy')
					),
					array(
						'title'  					=> esc_html__('Audit Marketing', 'conult-themer'),
						'selected_icon' 			=> array('value' => 'icon-conult-point-of-sale')
					),
					array(
						'title'  					=> esc_html__('Finance Consulting', 'conult-themer'),
						'selected_icon' 			=> array('value' => 'icon-conult-consumer-behavior')
					),
					array(
						'title'  					=> esc_html__('Banking Advising', 'conult-themer'),
						'selected_icon' 			=> array('value' => 'icon-conult-strategy')
					),
					array(
						'title'  					=> esc_html__('Consumer Product', 'conult-themer'),
						'selected_icon' 			=> array('value' => 'icon-conult-point-of-sale')
					),
					array(
						'title'  					=> esc_html__('Marketing Rules', 'conult-themer'),
						'selected_icon' 			=> array('value' => ' icon-conult-consumer-behavior')
					)
				)
			]
		);
		
		$this->add_control(
			'active_bg',
			[
				'label' => esc_html__('Color', 'conult-themer'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-group.style-1 .icon-box-item:after' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'style' => ['style-1'],
				],
			]
		);

		$this->end_controls_section();

		$this->add_control_carousel(false, array('layout' => 'carousel'));

		$this->add_control_grid(array('layout' => 'grid'));

		// Icon Styling
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__('Icon', 'conult-themer'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' 		=> esc_html__('Icon Color', 'conult-themer'),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-content .box-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-content svg' => 'fill: {{VALUE}};'
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' 		=> esc_html__('Size', 'conult-themer'),
				'type' 		=> Controls_Manager::SLIDER,
				'default' 	=> [
					'size' 	=> 60
				],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-content .box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-content .box-icon svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .gsc-icon-box-group.style-2 .icon-box-item .icon-box-content .box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .gsc-icon-box-group.style-2 .icon-box-item .icon-box-content .box-icon i' => 'width: {{SIZE}}{{UNIT}};',
					
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' 		=> esc_html__('Spacing', 'conult-themer'),
				'type' 		=> Controls_Manager::SLIDER,
				'default' 	=> [
					'size' 	=> 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-content .icon-inner' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__('Padding', 'conult-themer'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-content .icon-inner .box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__('Content', 'conult-themer'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => esc_html__('Title', 'conult-themer'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => esc_html__('Spacing', 'conult-themer'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size'  => 5
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-content .title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		); 

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'conult-themer'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-content .title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-content .title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .gsc-icon-box-group .icon-box-content .title, {{WRAPPER}} .gsc-icon-box-group .icon-box-content .title a',
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => esc_html__('Description', 'conult-themer'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__('Color', 'conult-themer'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-content .desc' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gsc-icon-box-group.style-1 .icon-box-item .content-inner .desc' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .gsc-icon-box-group .icon-box-content, {{WRAPPER}} .gsc-icon-box-group.style-1 .icon-box-item .icon-box-content .content-inner .desc',
			] 
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		printf('<div class="gva-element-%s gva-element">', $this->get_name() );
			if( !empty($settings['layout']) ){
				include $this->get_template('general/icon-box-group/' . $settings['layout'] . '.php');
			}
		print '</div>';
	}

}

$widgets_manager->register(new GVAElement_Icon_Box_Group());
