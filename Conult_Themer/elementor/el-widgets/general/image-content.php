<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

class GVAElement_Image_Content extends GVAElement_Base {
	const NAME = 'gva-image-content';
	const TEMPLATE = 'general/image-content';
	const CATEGORY = 'conult_general';

   public function get_categories() {
		return array(self::CATEGORY);
	}

	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return __( 'Image Content', 'conult-themer' );
	}
	
	public function get_keywords() {
		return [ 'image', 'content' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Content', 'conult-themer' ),
			]
		);
		$this->add_control(
			'style',
			[
				'label' => __( 'Style', 'conult-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'skin-v1' => esc_html__('Style I', 'conult-themer'),
					'skin-v2' => esc_html__('Style II', 'conult-themer'),
					'skin-v3' => esc_html__('Style III', 'conult-themer'),
					'skin-v4' => esc_html__('Style IV', 'conult-themer'),
					'skin-v5' => esc_html__('Style V', 'conult-themer'),
					'skin-v6' => esc_html__('Style VI', 'conult-themer'),
					'skin-v7' => esc_html__('Style VII', 'conult-themer')
				],
				'default' => 'skin-v1',
			]
		);
		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title', 'conult-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'conult-themer' ),
				'default' => __( 'Quality Standards', 'conult-themer' ),
				'label_block' => true,
				'condition' => [
					'style!' => ['skin-v2']
				],
			]
		);
		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'conult-themer' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => GAVIAS_CONULT_PLUGIN_URL . 'elementor/assets/images/image-5.jpg',
				],
			]
		);

		$this->add_control(
			'image_second',
			[
				'label' => __( 'Choose Image Second', 'tolips-themer' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => GAVIAS_CONULT_PLUGIN_URL . 'elementor/assets/images/image-4.jpg',
				],
				'condition' => [
					'style' => ['skin-v5']
				],
			]
		);
		
		$this->add_group_control(
         Elementor\Group_Control_Image_Size::get_type(),
         [
            'name'      => 'image',
            'default'   => 'full',
            'separator' => 'none',
	         'condition' => [
					'style!' => ['skin-v5'],
				]
         ]
      );
      
		$this->add_control(
			'description_text',
			[
				'label' => __( 'Description', 'conult-themer' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter Your Description', 'conult-themer' ),
				'condition' => [
					'style!' => ['skin-v1', 'skin-v2', 'skin-v3'],
				],
			]
		);
		
		$this->add_control(
			'header_tag',
			[
				'label' => __( 'HTML Tag', 'conult-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
				'condition' => [
					'style!' => ['skin-v2']
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'conult-themer' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'conult-themer' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'link_text',
			[
				'label' => __( 'Text Link', 'conult-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Read More', 'conult-themer' ),
				'default' => __( 'Read More', 'conult-themer' ),
				'condition' => [
					'style!' => ['skin-v1', 'skin-v2'],
				],
			]
		);

		$this->end_controls_section();

		// Icon Box Content
		$this->start_controls_section(
			'section_icon_box_content',
			[
				'label' => __( 'Icon Box', 'conult-themer' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'style' => ['skin-v1']
				],
			]
		);

		$this->add_control(
       	'selected_icon',
       	[
         	'label'      => __('Choose Icon', 'conult-themer'),
         	'type'       => Controls_Manager::ICONS,
         	'default' => [
           		'value' => 'fas fa-home',
           		'library' => 'fa-solid',
         	]
       	]
     	);

		$this->add_control(
       	'icon_box_title',
       	[
         	'label'      => __('Title', 'conult-themer'),
         	'type'       => Controls_Manager::TEXT,
         	'default' 	 => esc_html__('Book Tour Now', 'conult-themer'),
       	]
     	);

     	$this->add_control(
       	'icon_box_desc',
       	[
         	'label'      => __('Description', 'conult-themer'),
         	'type'       => Controls_Manager::TEXT,
         	'default' 	 => esc_html__('66888000', 'conult-themer')
       	]
     	);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Box', 'conult-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_primary_color',
			[
				'label' => __( 'Primary Color', 'conult-themer' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-image-content.skin-v1 .line-color:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .gsc-image-content.skin-v3 .box-background::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .gsc-image-content.skin-v3 .image::after' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'box_second_color',
			[
				'label' => __( 'Second Color', 'conult-themer' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-image-content.skin-v1 .line-color:before' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'style' => ['skin-v1'],
				],
			]
		);
		$this->end_controls_section();

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
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-image-content .box-content .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .gsc-image-content .box-content .title',
			]
		);

		$this->add_control(
			'title_space_bottom',
			[
				'label' => __( 'Space Bottom', 'conult-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-image-content .box-content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content', 'conult-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => ['skin-v2', 'skin-v4'],
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Text Color', 'conult-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-image-content .box-content .desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_desc',
				'selector' => '{{WRAPPER}} .gsc-image-content .box-content .desc',
			]
		);

		$this->add_control(
			'content_space_bottom',
			[
				'label' => __( 'Space Bottom', 'conult-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-image-content .box-content .desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
      printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
         include $this->get_template(self::TEMPLATE . '.php');
      print '</div>';
	}

}

 $widgets_manager->register(new GVAElement_Image_Content());
