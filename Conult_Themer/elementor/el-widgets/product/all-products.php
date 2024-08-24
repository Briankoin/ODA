<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

class GVAElement_AllProducts extends GVAElement_Base{
    const NAME = 'gva-products';
   const TEMPLATE = 'product/all-products/';
   const CATEGORY = 'conult_woocommerce';

    public function get_name() {
      return self::NAME;
    }

    public function get_categories() {
      return array(self::CATEGORY);
    }

    public function get_title() {
        return __('All Products', 'conult-themer');
    }

    public function get_keywords() {
        return [ 'product', 'content', 'carousel', 'grid' ];
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

    private function get_categories_list(){
        $categories = array();

        $categories['none'] = __( 'None', 'conult-themer' );
        $taxonomy = 'product_cat';
        $tax_terms = get_terms( $taxonomy );
        if ( ! empty( $tax_terms ) && ! is_wp_error( $tax_terms ) ){
            foreach( $tax_terms as $item ) {
                $categories[$item->term_id] = $item->name;
            }
        }
        return $categories;
    }

    private function get_posts() {
        $posts = array();

        $loop = new \WP_Query( array(
            'post_type' => array('product'),
            'posts_per_page' => -1,
            'post_status'=>array('publish'),
        ) );

        $posts['none'] = __('None', 'conult-themer');

        while ( $loop->have_posts() ) : $loop->the_post();
            $id = get_the_ID();
            $title = get_the_title();
            $posts[$id] = $title;
        endwhile;

        wp_reset_postdata();

        return $posts;
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_query',
            [
                'label' => __('Query & Layout', 'conult-themer'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control( // xx Layout
            'layout_heading',
            [
                'label'   => __( 'Layout', 'conult-themer' ),
                'type'    => Controls_Manager::HEADING,
            ]
        );
         $this->add_control(
            'layout',
            [
                'label'   => __( 'Layout Display', 'conult-themer' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid'              => __( 'Grid', 'conult-themer' ),
                    'carousel'          => __( 'Carousel', 'conult-themer' )
                ]
            ]
        );
        $this->add_control(
            'style',
            [
                'label'     => __('Style', 'conult-themer'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default' => 'style-1',
                'options' => [
                    'style-1'         => __( 'Item Style I', 'conult-themer' ),
                    'style-2'         => __( 'Item Style II', 'conult-themer' ),
                    'style-3'         => __( 'Item Style III', 'conult-themer' )
                ],
                'condition' => [
                    'layout' => array('grid', 'carousel')
                ]
            ]
        );
        $this->add_control(
            'image_size',
            [
               'label'     => __('Image Style', 'conult-themer'),
               'type'      => \Elementor\Controls_Manager::SELECT,
               'options'   => $this->get_thumbnail_size(),
               'default'   => 'conult_medium'
            ]
        );
        

        $this->add_control( // xx Layout
            'query_heading',
            [
                'label'   => __( 'Query', 'conult-themer' ),
                'type'    => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'category_ids',
            [
                'label' => __( 'Select By Category', 'conult-themer' ),
                'type' => Controls_Manager::SELECT2,
                'multiple'    => true,
                'default' => '',
                'label_block' => true,
                'options'   => $this->get_categories_list()
            ]
        );

        $this->add_control(
            'post_ids',
            [
                'label' => __( 'Select Individually', 'conult-themer' ),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple'    => true,
                'label_block' => true,
                'options'   => $this->get_posts()
            ]  
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __( 'Posts Per Page', 'conult-themer' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_control(
            'featured',
            [
                'label'     => __('Show Only Featured Campaign', 'conult-themer'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no'
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => __( 'Order By', 'conult-themer' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'post_date',
                'options' => [
                    'post_date'  => __('Date', 'conult-themer'),
                    'post_title' => __('Title', 'conult-themer'),
                    'rand'       => __('Random', 'conult-themer')
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => __( 'Order', 'conult-themer' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc'  => __( 'ASC', 'conult-themer' ),
                    'desc' => __( 'DESC', 'conult-themer' ),
                ],
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label'     => __('Pagination', 'conult-themer'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no',
                'condition' => [
                    'layout' => 'grid'
                ],
            ]
        );

        $this->end_controls_section();

        $this->add_control_carousel(false, array('layout' => ['carousel', 'carousel_center']));

        $this->add_control_grid(array('layout' => 'grid'));

        // Styling Posts Grid & Carousel
        $this->start_controls_section(
            'section_styling_post_content',
            [
                'label' => __( 'Post Content', 'conult-themer' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout' => ['grid', 'carousel']
                ],
            ]
        );

        $this->add_responsive_control(
            'post_box_padding',
            [
                'label' => __( 'Padding Post Content', 'conult-themer' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .campaign-block-2 .campaign-content, {{WRAPPER}} .campaign-block .campaign-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'post_box_background',
            [
                'label' => __( 'Background Post Content', 'conult-themer' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .campaign-block-2 .campaign-content, {{WRAPPER}} .campaign-block .campaign-content' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();

        // Styling post title
        $this->start_controls_section(
            'section_styling_post_title',
            [
                'label' => __( 'Post Title', 'conult-themer' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout' => ['grid', 'carousel']
                ],
            ]
        );

        $this->add_control(
            'post_box_title_color',
            [
                'label' => __( 'Color Title', 'conult-themer' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .campaign-block .campaign-content .campaign-title h4 a, {{WRAPPER}} .campaign-block-2 .campaign-content .campaign-title h4 a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'post_box_title_color_hover',
            [
                'label' => __( 'Color Title Hover', 'conult-themer' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .campaign-block .campaign-content .campaign-title h4 a:hover, {{WRAPPER}} .campaign-block-2 .campaign-content .campaign-title h4 a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_box_title_typography',
                'selector' => '{{WRAPPER}} .campaign-block .campaign-content .campaign-title h4 a, {{WRAPPER}} .campaign-block-2 .campaign-content .campaign-title h4 a',
            ]
        );

        $this->add_control(
            'post_box_meta_color',
            [
                'label' => __( 'Category Background Color', 'conult-themer' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .campaign-block .campaign-content .campaign-meta .campaign-categories' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .campaign-block-2 .campaign-content .campaign-meta .campaign-categories' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

       

    }

    public static function get_query_args(  $settings ) {
        global $woocommerce;
        $defaults = [
            'post_ids'          => '',
            'category_ids'      => '',
            'orderby'           => 'date',
            'order'             => 'desc',
            'posts_per_page'    => 3,
            'offset'            => 0
        ];

        $settings = wp_parse_args( $settings, $defaults );
        $cats = $settings['category_ids'];
        $ids = $settings['post_ids'];

        $query_args = [
            'post_type' => 'product',
            'posts_per_page' => $settings['posts_per_page'],
            'orderby' => $settings['orderby'],
            'order' => $settings['order'],
            'ignore_sticky_posts' => 1,
            'post_status' => 'publish'
        ];
       
        if($cats){
            if( is_array($cats) && count($cats) > 0 ){
                $field_name = is_numeric($cats[0]) ? 'term_id':'slug';
                $taxquery['relation'] = 'AND';
                $taxquery[] = array(
                  'taxonomy' => 'product_cat',
                  'terms' => $cats,
                  'field' => $field_name,
                  'include_children' => false
                );
            }
        }
        if( $ids ){
          if( is_array($ids) && count($ids) > 0 ){
            $query_args['post__in'] = $ids;
            $query_args['orderby'] = 'post__in';
          }
        }
        
        $taxquery[] = array(
            'taxonomy' => 'product_visibility',
            'field'    => 'name',
            'terms'    => 'exclude-from-catalog',
            'operator' => 'NOT IN',
        );

        if($settings['featured'] == 'yes'){
            $taxquery[] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
                'operator' => 'IN',
            );
        }

        $query_args['tax_query'] = $taxquery;

        if(is_front_page()){
            $query_args['paged'] = (get_query_var('page')) ? get_query_var('page') : 1;
        }else{
            $query_args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }
 
        return $query_args;
    }

    public function query_posts() {
        $query_args = $this->get_query_args( $this->get_settings() );
        return new WP_Query($query_args);
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        printf('<div class="gva-element-%s gva-element">', $this->get_name());
        if( !empty($settings['layout']) ){
            include $this->get_template(self::TEMPLATE . $settings['layout'] . '.php');
        }
        print '</div>'; 
    }
}

$widgets_manager->register(new GVAElement_AllProducts());
