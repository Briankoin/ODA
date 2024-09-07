<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class Amchart extends GVAElement_Base
{

    const TEMPLATE = 'general/amchart.php';

    public function get_name()
    {
        return 'amchart-map';
    }

    public function get_title()
    {
        return esc_html__('Amchart', 'conult-themer');
    }

    public function get_icon()
    {
        return 'eicon-google-maps';
    }

    public function get_categories()
    {
        return ['conult_general'];
    }

    public function get_style_depends()
    {
        return [
            'amchart-css',
        ];
    }

    public function get_script_depends()
    {
        return [
            'amcharts-core',
            'amcharts-maps',
            'amcharts-worldlow',
            'amcharts-animated',
            'amcharts-js'
        ];
    }

    public function register_controls()
    {
        $this->start_controls_section(
            'map-section',
            [
                'label' => esc_html__('Map', 'conult-themer'),

            ]
        );

        $this->add_control(
            'map-heading',
            [
                'label' => esc_html__('Map Heading', 'conult-themer'),
                'type' => Controls_Manager::TEXT,
            ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'map-settings',
            [
                'label' => esc_html__('Map Heading', 'conult-themer'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
            );

            $this->add_control(
                'heading_color',
                [
                    'label' => esc_html__( 'Heading Color', 'conult-themer' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
    
                        '{{WRAPPER}} .map-heading' => 'color: {{VALUE}}', 
    
                    ],
                ]
                );
            
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'map_heading_typography',
                    'selector' => '{{WRAPPER}} .map-heading',
                ]
                );

                $this->end_controls_section();
    }

    public function render()
    {
        $settings = $this->get_settings_for_display();
        $map_heading= $settings['map-heading'];
?>
        <div class="map-container">
            <h2 class="map-heading"><?php echo esc_html($map_heading);?></h2>
            <div id="chartdiv"></div>
        </div>    
<?php

    }
}

$widgets_manager->register(new Amchart());
