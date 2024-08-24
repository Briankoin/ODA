<?php

/** Exit if accessed directly. */
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography as Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;

class iyi_button_widget extends GVAElement_Base
{
    public function get_name()
    {
        return 'iyi-button-widget';
    }

    public function get_title()
    {
        return esc_html__('iyi Button', 'iyi-plugin');
    }

    public function get_categories()
    {
        return ['theme-elements'];
    }

    public function get_icon()
    {
        return 'eicon-button';
    }

    protected function register_controls()
    {

        //Layout Settings Start
        $this->start_controls_section(
            'section_general_tab',
            [
                'label' => esc_html__('General Settings', 'iyi-plugin'),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'iyi-plugin'),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'text',
                'default' => __('Click me', 'iyi-plugin'),
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __('Button Link', 'iyi-plugin'),
                'type' => Controls_Manager::URL,
                'input_type' => 'url',
                'placeholder' => __('https://example.com', 'iyi-plugin'),
                'label_block' => true,
            ]
        );
        $this->add_responsive_control(
            'btn_align',
            [
                'label' => __('Alignment', 'sominx-themer'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'sominx-themer'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'sominx-themer'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'sominx-themer'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => ['{{WRAPPER}} .btn-wrapper' => 'text-align: {{VALUE}};'],
            ]
        );

        $this->add_control(
			'show_button_icon',
			[
				'label' => esc_html__('Show Icon', 'core-elements'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'core-elements'),
				'label_off' => esc_html__('Hide', 'core-elements'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_control(
            'icon_button',
            [
                'label' => esc_html__('Icon Button', 'core-elements'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon_bt',
                'default' => [
                    'value' => 'fas fa-angle-double-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
					'show_button_icon'	=> 'yes',
				],
            ]
        );
        $this->add_control(
            'button_icon_position',
            [
                'label' => esc_html__('Icon Position', 'core-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'bt_icon_after',
                'options' => [
                    'bt_icon_before'  => esc_html__('Before', 'core-elements'),
                    'bt_icon_after' => esc_html__('After', 'core-elements'),
                ],
                'condition' => [
					'show_button_icon'	=> 'yes',
				],
            ]
        );
        $this->end_controls_section();



        /**** STYLES ******/
        // Start General Style 
        $this->start_controls_section(
            'section_style_general',
            [
                'label' => esc_html__('General', 'iyi-plugin'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'heading_wrapper_border',
            [
                'label' => esc_html__('Wrapper Border', 'iyi-plugin'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'wrapper_border',
                'label'    => __('Wrapper Border', 'iyi-plugin'),
                'selector' => '{{WRAPPER}} .btn-wrapper',
            ]
        );
        $this->add_control(
            'heading_wrapper_border_hover',
            [
                'label' => esc_html__('Wrapper Border Hover', 'iyi-plugin'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'wrapper_border_hover',
                'label'    => __('Wrapper Border Hover', 'iyi-plugin'),
                'selector' => '{{WRAPPER}} .btn-wrapper:hover',
            ]
        );


        $this->add_control(
            'heading_button',
            [
                'label' => esc_html__('Button', 'iyi-plugin'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .btn-theme',
            ]
        );
        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => __('Button Padding', 'iyi-plugin'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .btn-theme' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_btn_border',
            [
                'label' => esc_html__('Button Border', 'iyi-plugin'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
			'btn_border_radius',
			[
				'label'      => __('Border Radius', 'conult-themer'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .btn-theme' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_border',
                'label'    => __('Border', 'iyi-plugin'),
                'selector' => '{{WRAPPER}} .btn-theme',
            ]
        );
        $this->add_control(
            'heading_btn_border_hover',
            [
                'label' => esc_html__('Button Border Hover', 'iyi-plugin'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_border_hover',
                'label'    => __('Border Hover', 'iyi-plugin'),
                'selector' => '{{WRAPPER}} .btn-theme:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'btn_shadow',
                'selector' => '{{WRAPPER}} .btn-theme',
            ]
        );

        $this->add_control(
            'heading_button_background',
            [
                'label' => esc_html__('Background', 'iyi-plugin'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'btn_background',
            [
                'label' => esc_html__('Background Color', 'iyi-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-theme' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btn_hover_background',
            [
                'label' => esc_html__('Background Hover Color', 'iyi-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-theme:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // $this->add_control(
        //     'btn_background_before',
        //     [
        //         'label' => esc_html__('Before Background', 'iyi-plugin'),
        //         'type' => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .btn-theme' => 'background-color: {{VALUE}};',
        //         ],
        //     ]
        // );


        $this->add_control(
            'heading_button_text',
            [
                'label' => esc_html__('Text', 'iyi-plugin'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'btn_color',
            [
                'label' => esc_html__('Text Color', 'iyi-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-theme' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btn_hover_color',
            [
                'label' => esc_html__('Text Hover Color', 'iyi-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-theme:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
			'heading_button_icon',
			[
				'label' => esc_html__('Icon', 'core-elements'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
                'condition' => [
					'show_button_icon'	=> 'yes',
				],
			]
		);
        $this->add_control(
			'icon_color',
			[
				'label'     	=> esc_html__('Icon Color', 'conult-themer'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn-theme i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .btn-theme svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .btn-theme i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .btn-theme svg' => 'fill: {{VALUE}}'
				],
			]
		);
        $this->add_control(
			'icon_color_hover',
			[
				'label'     	=> esc_html__('Icon Color Hover', 'conult-themer'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn-theme:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .btn-theme:hover svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .btn-theme:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .btn-theme:hover svg' => 'fill: {{VALUE}}'
				],
			]
		);
        $this->add_control(
            'button_icon_size',
            [
                'label' => esc_html__('Icon Size', 'core-elements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .btn-theme  i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .btn-theme  svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
					'show_button_icon'	=> 'yes',
				],
            ]
        );
        $this->add_control(
			'button_icon_spacer',
			[
				'label' => esc_html__('Icon Spacer', 'core-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .btn-text.bt_icon_before i' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .btn-text.bt_icon_before svg' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .btn-text.bt_icon_after i' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .btn-text.bt_icon_after svg' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
					'show_button_icon'	=> 'yes',
				],
			]
		);
        $this->end_controls_section();
        // /.End General Style
    }


    protected function render()
    {

        $settings = $this->get_settings_for_display();

        $migrated = isset($settings['__fa4_migrated']['icon_button']);
        $is_new = empty($settings['icon_bt']);

        // Retrieve the button link and text
  
        $button_link = $settings['button_link']['url'];
        $button_target = ($settings['button_link']['is_external'] == "on")?"_blank":"";
        $button_text = $settings['button_text'];

        // Output the button HTML
?>
        <div class="btn-wrapper">
            <a class="btn-theme" href="<?php echo esc_url($button_link); ?>" target="<?php echo $button_target; ?>">
                <span class="btn-text <?php echo esc_attr($settings['button_icon_position']); ?>">

                    <?php
                    if ($settings['button_icon_position'] == 'bt_icon_before' && $settings['show_button_icon'] == 'yes') {

                        if ($is_new || $migrated) {
                            if (isset($settings['icon_button']['value']['url'])) {
                                Icons_Manager::render_icon($settings['icon_button'], ['aria-hidden' => 'true']);
                            } else {
                                echo '<i class="' . esc_attr($settings['icon_button']['value']) . '" aria-hidden="true"></i>';
                            }
                        } else {
                            echo '<i class="' . esc_attr($settings['icon_bt']) . ' aria-hidden="true""></i>';
                        }
                    }

                    echo __($button_text, 'core-elements');

                    if ($settings['button_icon_position'] == 'bt_icon_after' && $settings['show_button_icon'] == 'yes') {

                        if ($is_new || $migrated) {
                            if (isset($settings['icon_button']['value']['url'])) {
                                Icons_Manager::render_icon($settings['icon_button'], ['aria-hidden' => 'true']);
                            } else {
                                echo '<i class="' . esc_attr($settings['icon_button']['value']) . '" aria-hidden="true"></i>';
                            }
                        } else {
                            echo '<i class="' . esc_attr($settings['icon_bt']) . ' aria-hidden="true""></i>';
                        }
                    }

                    ?>

                </span>
            </a>
        </div>
<?php


    }
}

$widgets_manager->register(new iyi_button_widget());