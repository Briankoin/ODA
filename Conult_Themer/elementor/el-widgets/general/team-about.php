<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class My_Profile_Card_Widget extends GVAElement_Base
{

    public function get_name()
    {
        return 'my-profile-card';
    }

    public function get_title()
    {
        return esc_html__('My Profile Card', 'conult-themer');
    }

    public function get_icon()
    {
        return 'eicon-person';
    }

    public function get_categories()
    {
        return ['team'];
    }

    public function get_style_depends()
    {
        return [
            'team-about'
        ];
    }

    protected function register_controls()
    {

        // Profile Image Control
        $this->start_controls_section(
            'section_profile_image',
            [
                'label' => esc_html__('Profile Image', 'conult-themer'),
            ]
        );

        $this->add_control(
            'profile_image',
            [
                'label' => esc_html__('Choose Image', 'conult-themer'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_profile_details',
            [
                'label' => esc_html__('Profile Details', 'conult-themer'),
            ]
        );

        $this->add_control(
            'name',
            [
                'label' => esc_html__('Name', 'conult-themer'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('John Doe', 'conult-themer'),
            ]
        );

        $this->add_control(
            'position',
            [
                'label' => esc_html__('Position', 'conult-themer'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Manager', 'conult-themer'),
            ]
        );

        $this->add_control(
            'background',
            [
                'label' => esc_html__('Background', 'conult-themer'),
                'type' => \Elementor\Controls_Manager::WYSIWYG, // Or TEXTAREA if less formatting is needed
                'default' => esc_html__('Some background information about the person.', 'conult-themer'),
            ]
        );

        $this->end_controls_section();

        // Social Icons Section
        $this->start_controls_section(
            'section_social_icons',
            [
                'label' => esc_html__('Social Icons', 'conult-themer'),
            ]
        );

        $this->add_control(
            'facebook_link',
            [
                'label' => esc_html__('Facebook Link', 'conult-themer'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://www.facebook.com/', 'conult-themer'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->add_control(
            'twitter_link',
            [
                'label' => esc_html__('Twitter Link', 'conult-themer'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://twitter.com/', 'conult-themer'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->add_control(
            'linkedin_link',
            [
                'label' => esc_html__('LinkedIn Link', 'conult-themer'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://www.linkedin.com/', 'conult-themer'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->add_control(
            'instagram_link',
            [
                'label' => esc_html__('Instagram Link', 'conult-themer'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://www.instagram.com/', 'conult-themer'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'container_style',
            [
                'label' => esc_html__('Container Syle', 'conult-themer'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,

            ]
        );

        $this->add_responsive_control(
            'container_padding',
            [
                'label' => esc_html('Container Padding', 'conult-themer'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .profile-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'container_background_color',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .profile-info',

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'card_name_position_style',
            [
                'label' => esc_html__('Name And Postion Style', 'conult-themer'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_person_name',
            [
                'label' => esc_html__('Name Color', 'conult-themer'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [

                    '{{WRAPPER}} .profile-name' => 'color: {{VALUE}}',

                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'card_person_name_typography',
                'selector' => '{{WRAPPER}} .profile-info h2',
            ]
        );

        $this->add_control(
            'card_person_position',
            [
                'label' => esc_html__('Position Color', 'conult-themer'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [

                    '{{WRAPPER}} .profile-position' => 'color: {{VALUE}}',

                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'card_person_position_typography',
                'selector' => '{{WRAPPER}} .profile-info p',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'Background Style',
            [
                'label' => esc_html__('Background Style', 'conult-themer'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'align_description',
            [
                'label' => __('Alignment', 'conult-themer'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'conult-themer'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'conult-themer'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'conult-themer'),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justify', 'conult-themer'),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .content p' => 'text-align: {{VALUE}};',
                ],
                'default' => 'justify',

            ]
        );
        $this->add_control(
            'card_background_color',
            [
                'label' => esc_html__(' Background Message Color', 'conult-themer'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [

                    '{{WRAPPER}} .content p' => 'color: {{VALUE}}',

                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'card_background_typography',
                'selector' => '{{WRAPPER}} .content p',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $profile_image_url = $settings['profile_image']['url'];
        $name = $settings['name'];
        $position = $settings['position'];
        $background = $settings['background'];
        $facebook_link = $settings['facebook_link']['url'];
        $x_link = $settings['twitter_link']['url'];
        $linkedin_link = $settings['linkedin_link']['url'];
        $instagram_link = $settings['instagram_link']['url'];
        // ... other social links

        // Sanitize output (especially for the background message)
        $background = wp_kses_post($background);

?>
        <div class="container">
            <div class="profile">
                <img src="<?php echo esc_url($profile_image_url); ?>" alt="<?php echo esc_attr($name); ?>">
                <div class="circle"></div>
                <div class="profile-info">
                    <h2 class="profile-name"><?php echo esc_html($name); ?></h2>
                    <p class="profile-position"><?php echo esc_html($position); ?></p>
                </div>
            </div>
            <div class="content">
                <h3> BACKGROUND EXPERIENCE </h3>
                <p class="background-text"><?php echo wp_kses_post($background); ?></p>
                <div class="social-icons">
                    <span class="connect-on"> CONNECT ON </span>
                    <?php if (! empty($facebook_link)) : ?>
                        <div class="connect">
                            <a href="<?php echo esc_url($facebook_link); ?>" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        <?php endif; ?>

                        <?php if (! empty($x_link)) : ?>
                            <a href="<?php echo esc_url($x_link); ?>" target="_blank">
                                <i class="fab fa-x-twitter"></i>
                            </a>
                        <?php endif; ?>

                        <?php if (! empty($linkedin_link)) : ?>
                            <a href="<?php echo esc_url($linkedin_link); ?>" target="_blank">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        <?php endif; ?>

                        <?php if (! empty($instagram_link)) : ?>
                            <a href="<?php echo esc_url($instagram_link); ?>" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        <?php endif; ?>
                        </div>
                </div>
            </div>
        </div>
<?php
    }
}

$widgets_manager->register(new My_Profile_Card_Widget());
