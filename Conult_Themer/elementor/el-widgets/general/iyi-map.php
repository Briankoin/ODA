<?php
if(!defined('ABSPATH')){ exit; }


use Elementor\Controls_Manager;

class Iyi_map extends GVAElement_Base{

    public function get_name() {
        return 'iyi-map';
     }


     public function get_categories() {
        return ['conult_general'];
     }
  
      public function get_title() {
          return __( 'IYI Map', 'conult-themer' );
      }
  
      public function get_keywords() {
          return [ 'map'];
      }


      public function script_depends(){
        return ['select2-script'];
      }


      public function style_depends(){
        return ['select2-style', 'map-style'];
      }

      private function get_posts()
	{
		$countyposts = array();

		$loop = new \WP_Query(array(
			'post_type' => array('counties'),
			'posts_per_page' => -1,
			'post_status' => array('publish'),
		));

		$countyposts['none'] = __('None', 'conult-themer');

		while ($loop->have_posts()) : $loop->the_post();
			$id = get_the_ID();
			$title = get_the_title();
			$countyposts[$id] = $title;
		endwhile;

		wp_reset_postdata();

		return $countyposts;
	}


      protected function register_controls() {
		$this->start_controls_section(
			'map_content',
			[
				'label' => __( 'Content', 'conult-themer' ),
			]
		);

        $this->add_control( 
			'query_heading',
			[
				'label'   => __('Active County', 'fdsa-themer'),
				'type'    => Controls_Manager::HEADING,
			]
		);


		$this->add_control(
			'active_county',
			[
				'label' => __('Select County', 'fdsa-themer'),
				'type' => Controls_Manager::SELECT2,
				'default' => '',
				'multiple'    => true,
				'label_block' => true,
				'options'   => $this->get_posts()
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'map_control',
			[
				'label' => __( 'Display', 'conult-themer' ),
			]
		);

        $this->add_responsive_control(
            'map_width',
            [
                'label' => __( 'Map Width', 'conult-themer' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],

                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                        ],

                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        ],
                ],

                'default' => [
                    'unit' => 'px',
                    'size' => 300,
                ],

                'selectors' => [
                    '{{WRAPPER}} .kenya-map' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'map_height',
            [
                'label' => __( 'Map Height', 'conult-themer' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],

                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                        ],

                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        ],
                ],

                'default' => [
                    'unit' => 'px',
                    'size' => 300,
                ],

                'selectors' => [
                    '{{WRAPPER}} .kenya-map' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'map_colour',
            [
                'label' => __('Map Colour', 'conult-themer'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this-> add_control(
            'active_color',
            [
                'label' => __('Active Color', 'conult-themer'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#4CAF50',
                'selectors' => [

                '{{WRAPPER}} .map-item.active path' => 'fill: {{VALUE}};',

                ]
            ]
        );

        $this-> add_control(
            'inactive_color',
            [
                'label' => __('Inactive Color', 'conult-themer'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#4CAF50',

                'selectors' => [

                '{{WRAPPER}} .map-item' => 'fill: {{VALUE}};',

                ]
            ]
        );

        $this-> add_control(
            'hover_color',
            [
                'label' => __('Hover Color', 'conult-themer'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#4CAF50',
                'selectors' => [

                '{{WRAPPER}} .map-item:hover path' => 'fill: {{VALUE}};',

                ]
            ]
        );

        $this-> add_control(
            'stroke_color',
            [
                'label' => __('Border Color', 'conult-themer'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#4CAF50',
                'selectors' => [

                '{{WRAPPER}} .map-item path' => 'stroke: {{VALUE}};',

                ]
            ]
        );


    }

    protected function render(){

        $settings = $this->get_settings_for_display();
        $mapheight = $settings['map_height'];
        $mapwidth = $settings['map_width']; 
        $active = $settings['active_county'];
        $active_colour = $settings['active_color'];
        $inactive_colour = $settings['inactive_color'];
        $hover_colour = $settings['hover_color'];

        $countyposts = new \WP_Query(array(
            'post_type' => array('counties'),
            'posts_per_page' => -1,
            'post_status' => array('publish'),
        ));

        ?>

<div class="county-map-wrapper">
        <div id="info-box"></div>
        <div class="countymap2">
            <svg class="kenya-map" id="kenya-map" xmlns:mapsvg="http://mapsvg.com" 
                xmlns:dc="http://purl.org/dc/elements/1.1/" 
                xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" 
                xmlns:svg="http://www.w3.org/2000/svg" 
                xmlns="http://www.w3.org/2000/svg"
                mapsvg:geoViewBox="33.909821 5.033421 41.906896 -4.679658"
                width="<?php $mapwidth ?>" 
                height="<?php $mapheight ?>"
                preserveAspectRatio="xMidYMid meet"
                viewBox="0 0 457.63434 580.54065">
                
                <?php
                if ($countyposts->have_posts()) :
                    while ($countyposts->have_posts()) : $countyposts->the_post();
                        $path = get_post_meta(get_the_ID(), '_counties_path', true);
                        $link = get_post_meta(get_the_ID(), '_counties_link', true);
                        $countiestitle = get_post_meta(get_the_ID(), '_counties_title', true);

                        if (is_string($active)) {
                            $active = explode(',', $active); 
                        }

                        $is_active = in_array(get_the_ID(), $active);
                        $fill_color = $is_active ? $active_colour : $inactive_colour; 
                        
                        ?>
                        <a class="map-item" xlink:href="<?php echo esc_attr($link); ?>" target="_top" >
                        <title><?php echo esc_attr($countiestitle); ?></title>
                            <path data-info="<?php echo esc_attr($countiestitle); ?>" 
                                  fill="<?php echo esc_attr($fill_color); ?>" 
                                  stroke-width="0.75" 
                                  d="<?php echo esc_attr($path); ?>" />
                        </a>
                        
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo 'No Counties Located';
                endif;
                ?>
            </svg>
        </div>
    </div>
        <?php
    }

}

$widgets_manager->register( new Iyi_map);