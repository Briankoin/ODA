<?php

/** Exit if accessed directly. */
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

use Elementor\Controls_Manager;


class iyi_burger_button_widget extends GVAElement_Base
{
    public function get_name()
    {
        return 'iyi-burger-button-widget';
    }

    public function get_categories() {
        return ['conult_general'];
     }
  
      public function get_title() {
          return __( 'IYI Burger', 'conult-themer' );
      }
  
      public function get_keywords() {
          return [ 'button'];
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
			'menu_content',
			[
				'label' => __( 'Content', 'conult-themer' ),
			]
		);

        $this->add_control( 
			'query_menu_heading',
			[
				'label'   => __('Menu County', 'fdsa-themer'),
				'type'    => Controls_Manager::HEADING,
			]
		);


		$this->add_control(
			'active_menu_county',
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
    }

    protected function render(){

        $settings = $this->get_settings_for_display();
        $selected_counties =  $settings['active_menu_county'] ;

        ?>
        <div>
            <?php
        if(!empty($selected_counties)){
            ?>
            <ul>
                <?php
                    foreach($selected_counties as $county_id){    
                        $county_title = get_the_title($county_id);
                        ?>
                    <li><?php echo esc_html($county_title);?></li>
                    <?php
                }
                ?></ul><?php
        }else{
                ?> <p><?php echo esc_html('No Countries Selected', 'conult-themer');?></p>
                <?php
                }
            ?>
        </div>
    <?php        

    }
}

$widgets_manager->register(new iyi_burger_button_widget());