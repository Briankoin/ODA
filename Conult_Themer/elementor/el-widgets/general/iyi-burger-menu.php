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

    public function get_categories()
    {
        return ['conult_general'];
    }

    public function get_title()
    {
        return __('IYI Burger', 'conult-themer');
    }

    public function get_keywords()
    {
        return ['button'];
    }

    // private function get_posts()
    // {
    //     $countyposts = array();

    //     $loop = new \WP_Query(array(
    //         'post_type' => array('counties'),
    //         'posts_per_page' => -1,
    //         'post_status' => array('publish'),
    //     ));

    //     $countyposts['none'] = __('None', 'conult-themer');

    //     while ($loop->have_posts()) : $loop->the_post();
    //         $id = get_the_ID();
    //         $title = get_the_title();
    //         $countyposts[$id] = $title;
    //     endwhile;

    //     wp_reset_postdata();

    //     return $countyposts;
    // }

    protected function register_controls()
    {
        $this->start_controls_section(
            'menu_content',
            [
                'label' => __('Content', 'conult-themer'),
            ]
        );

        $this->add_control(
            'query_menu_heading',
            [
                'label'   => __('Menu County', 'fdsa-themer'),
                'type'    => Controls_Manager::HEADING,
            ]
        );


        // $this->add_control(
        // 	'active_menu_county',
        // 	[
        // 		'label' => __('Select County', 'fdsa-themer'),
        // 		'type' => Controls_Manager::SELECT2,
        // 		'default' => '',
        // 		'multiple'    => true,
        // 		'label_block' => true,
        // 		'options'   => $this->get_posts()
        // 	]
        // );

        $this->end_controls_section();
        // Button Style Controls
        $this->start_controls_section(
            'button_style',
            [
                'label' => __('Button', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('button_tabs');

        // Normal State
        $this->start_controls_tab(
            'button_normal',
            [
                'label' => __('Normal', 'plugin-name'),
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label'     => __('Background Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dropdown-button' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     => __('Text Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dropdown-button' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'selector' => '{{WRAPPER}} .dropdown-button',
            ]
        );

        $this->end_controls_tab();

        // Hover State
        $this->start_controls_tab(
            'button_hover',
            [
                'label' => __('Hover', 'plugin-name'),
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label'     => __('Background Hover Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dropdown-button:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_hover_text_color',
            [
                'label'     => __('Text Hover Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dropdown-button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // List Items Style Controls
        $this->start_controls_section(
            'menu_style',
            [
                'label' => __('Menu Items', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'menu_bg_color',
            [
                'label'     => __('Background Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dropdown-menu' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'menu_typography',
                'selector' => '{{WRAPPER}} .dropdown-menu li a',
            ]
        );

        $this->end_controls_section();
    }
    // Add the menu container to the footer
    public function inject_slide_menu()
    {

        $counties = new \WP_Query(array(
            'post_type' => array('counties'),
            'posts_per_page' => -1,
            'post_status' => array('publish'),
        ));
        if ($counties->have_posts()) :
?>
            <div class="counties-dropdown-container">
                <ul class="counties-dropdown-menu">
                    <?php
                    while ($counties->have_posts()) : $counties->the_post();
                        $link = get_post_meta(get_the_ID(), '_counties_link', true);
                        $countiestitle = get_post_meta(get_the_ID(), '_counties_title', true);
                        if (!empty($link)) {
                    ?>
                            <li class="county-menu-item">
                                <a href="<?php echo esc_attr($link); ?>">
                                    <?php echo esc_attr($countiestitle); ?>
                                </a>
                            </li>
                    <?php
                        }
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </ul>
            </div>
        <?php
        endif;
        ?>
    <?php
    }
    protected function render()
    {
        add_action('wp_footer', [$this, 'inject_slide_menu']); // Add the menu to the footer

        $settings = $this->get_settings_for_display();
        // $selected_counties =  $settings['active_menu_county'] ;

    ?>
        <style>
            /* Ensure the container slides in from the right */
            .counties-dropdown-container {
                position: fixed;
                top: 50%;
                right: -300px;
                /* Start off-screen */
                transform: translateY(-50%);
                width: 300px;
                background-color: white;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                transition: right 0.4s ease-in-out;
                z-index: 9999;
                /* High z-index to stay above all content */
            }

            /* Menu items inside the container */
            .counties-dropdown-menu {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .counties-dropdown-menu li a {
                display: block;
                padding: 5px 10px;
                font-size: 14px;
                text-decoration: none;
                color: #333;
                transition: background-color 0.3s, color 0.3s;
            }

            .counties-dropdown-menu li a:hover {
                background-color: #f1f1f1;
                color: black;
            }

            /* Active state: Slide in the container from the right */
            .menu-active .counties-dropdown-container {
                right: 0;
            }


            .counties-dropdown-button {
                background-color: var(--button-bg-color, #3498db);
                color: var(--button-text-color, white);
                border: none;
                padding: 10px 20px;
                font-size: 16px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: 200px;
                position: relative;
                z-index: 10;
                /* Ensure the button is above other elements */
            }

            .counties-dropdown-button .counties-dropdown-icon {
                margin-left: 10px;
            }
        </style>
        <div class="counties-dropdown">
            <button class="counties-dropdown-button">
                Select Country<span class="counties-dropdown-icon"><i class="fas fa-bars"></i></span>
            </button>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const dropdownButton = document.querySelector('.counties-dropdown-button');
                const dropdownContainer = document.querySelector('.counties-dropdown-container');

                // Toggle the 'menu-active' class to slide in/out the container
                dropdownButton.addEventListener('click', () => {
                    document.body.classList.toggle('menu-active');
                });

                // Close the menu when clicking outside of the container
                document.addEventListener('click', (event) => {
                    if (!dropdownContainer.contains(event.target) && event.target !== dropdownButton) {
                        document.body.classList.remove('menu-active');
                    }
                });
            });
        </script>
<?php

    }
}

$widgets_manager->register(new iyi_burger_button_widget());
