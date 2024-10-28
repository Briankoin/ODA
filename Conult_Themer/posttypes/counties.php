<?php

if(!function_exists('gavias_post_type_Counties')){

	function gavias_post_type_Counties(){

		$labels = array(

			'name'               => __( 'counties', "gaviasthemer" ),

			'singular_name'      => __( 'County', "gaviasthemer" ),

			'add_new'            => __( 'Add New Counties', "gaviasthemer" ),

			'add_new_item'       => __( 'Add New Counties', "gaviasthemer" ),

			'edit_item'          => __( 'Edit Counties', "gaviasthemer" ),

			'new_item'           => __( 'New Counties', "gaviasthemer" ),

			'view_item'          => __( 'View Counties', "gaviasthemer" ),

			'search_items'       => __( 'Search Counties', "gaviasthemer" ),

			'not_found'          => __( 'No Counties found', "gaviasthemer" ),

			'not_found_in_trash' => __( 'No Counties found in Trash', "gaviasthemer" ),

			'parent_item_colon'  => __( 'Parent Counties:', "gaviasthemer" ),

			'menu_name'          => __( 'Counties', "gaviasthemer" ),

		);



		$args = array(

			'labels'              => $labels,

			'hierarchical'        => true,

			'description'         => 'List Counties',

			'supports'            => array( 'title', 'editor', 'author', 'thumbnail','excerpt', 'post-formats'  ), 

			'taxonomies'          => array( 'counties_category','post_tag' ),

			'post-formats'        => false,

			'public'              => true,

			'show_ui'             => true,

			'show_in_menu'        => true,

			'menu_position'       => 5,

            'menu_icon'           => 'dashicons-location',

			'show_in_nav_menus'   => true,

			'publicly_queryable'  => true,

			'exclude_from_search' => false,

			'has_archive'         => true,

			'query_var'           => true,

			'can_export'          => true,

			'rewrite'             => array(

				'slug'  => 'counties'

			),

			'capability_type'     => 'post'

		);



		$slug = apply_filters('gavias-post-type/slug-counties', '');

		if($slug){

		  $args['rewrite']['slug'] = $slug;

		}

		register_post_type( 'counties', $args );



		$labels = array(

		  'name'              => __( 'Categories', "gaviasthemer" ),

		  'singular_name'     => __( 'Category', "gaviasthemer" ),

		  'search_items'      => __( 'Search Category', "gaviasthemer" ),

		  'all_items'         => __( 'All Categories', "gaviasthemer" ),

		  'parent_item'       => __( 'Parent Category', "gaviasthemer" ),

		  'parent_item_colon' => __( 'Parent Category:', "gaviasthemer" ),

		  'edit_item'         => __( 'Edit Category', "gaviasthemer" ),

		  'update_item'       => __( 'Update Category', "gaviasthemer" ),

		  'add_new_item'      => __( 'Add New Category', "gaviasthemer" ),

		  'new_item_name'     => __( 'New Category Name', "gaviasthemer" ),

		  'menu_name'         => __( 'Categories', "gaviasthemer" ),

		);

		// Now register the taxonomy

		register_taxonomy('category_counties',array('counties'),

			array(

			  	'hierarchical'      => true,

			  	'labels'            => $labels,

			  	'show_ui'           => true,

			  	'show_admin_column' => true,

			  	'query_var'         => true,

			  	'show_in_nav_menus' => false,

			  	'rewrite'           => array( 'slug' => 'category-counties'

			),

		));

  	}

  add_action( 'init','gavias_post_type_counties' );



  	add_action( 'init', 'gavias_counties_remove_post_type_support', 10 );

  	function gavias_counties_remove_post_type_support() {

	 	remove_post_type_support( 'Counties', 'post-formats' );

  	}

}



function gaviasthemer_counties_query( $args ){

 	$ds = array(

		'post_type'   => 'Counties',

		'posts_per_page'  =>  12

 	);

 	$args = array_merge( $ds , $args );

 	$loop = new WP_Query($args);

 	return $loop;

	}



function gaviasthemer_counties_terms(){

 	return get_terms( 'category_counties', array('orderby'=>'id') );

}

function gavias_counties_add_meta_boxes() {
    add_meta_box(
        'counties_meta_box', 

        'Counties Information', 

        'gavias_counties_meta_box_callback',

        'counties', 

        'normal', 

        'default' 
    );
}
add_action('add_meta_boxes', 'gavias_counties_add_meta_boxes');

function gavias_counties_meta_box_callback($post){

    wp_nonce_field('gavias_counties_save_meta_box_data', 'gavias_counties_meta_box_nonce');

    $link = get_post_meta($post->ID, '_counties_link', true);
    $title = get_post_meta($post->ID, '_counties_title', true);
    $path = get_post_meta($post->ID, '_counties_path', true);

    ?>
    <p>
        <label for="counties_link">Link:</label>
        <input type="url" id="counties_link" name="counties_link" value="<?php echo esc_attr($link); ?>" size="125" />
    </p>
    <p>
        <label for="counties_title">Title:</label>
        <input type="text" id="counties_title" name="counties_title" value="<?php echo esc_attr($title); ?>" size="125" />
    </p>
    <p>
        <label for="counties_path">Path:</label>
        <textarea id="counties_path" name="counties_path" rows="1" cols="125"><?php echo esc_textarea($path); ?></textarea>
    </p>
    <?php

}

function gavias_counties_save_meta_box_data($post_id) {
    
    if (!isset($_POST['gavias_counties_meta_box_nonce'])) {
        return;
    }

    
    if (!wp_verify_nonce($_POST['gavias_counties_meta_box_nonce'], 'gavias_counties_save_meta_box_data')) {
        return;
    }

    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    
    if (isset($_POST['counties_link'])) {
        $link = sanitize_text_field($_POST['counties_link']);
        update_post_meta($post_id, '_counties_link', $link);
    }

    
    if (isset($_POST['counties_title'])) {
        $title = sanitize_text_field($_POST['counties_title']);
        update_post_meta($post_id, '_counties_title', $title);
    }

    
    if (isset($_POST['counties_path'])) {
        $path = sanitize_text_field($_POST['counties_path']);
        update_post_meta($post_id, '_counties_path', $path);
    }
}
add_action('save_post', 'gavias_counties_save_meta_box_data');



