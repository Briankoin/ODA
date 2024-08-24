<?php
use Elementor\Plugin;
use Elementor\Core\Settings\Page\Manager as PageManager;

function conult_themer_path_demo_content(){
  return (__DIR__.'/demo-data/');
}
add_filter('wbc_importer_dir_path', 'conult_themer_path_demo_content');

//Way to set menu, import revolution slider, and set home page.
function conult_themer_import_sample($demo_active_import , $demo_directory_path){

	reset($demo_active_import);
	$current_key = key($demo_active_import);

	if ( class_exists( 'RevSlider' ) ) {
		$wbc_sliders_array = array( 'slider-1.zip', 'slider-2.zip', 'slider-3.zip' );
		$slider = new RevSlider();
		foreach ($wbc_sliders_array as $s) {
			if(file_exists( conult_themer_path_demo_content() . 'main/'. $s )){
				$slider->importSliderFromPost(true, true, conult_themer_path_demo_content().'main/'.$s);
			}
		}
	}

	//Setting Menus
	$wbc_menu_array = array( 'main' );
	if( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
		$top_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
		if ( isset( $top_menu->term_id ) ) {
			set_theme_mod( 'nav_menu_locations', array(
				'primary' => $top_menu->term_id
			));
	 	}
	}

	//Set HomePage
	$wbc_home_pages = array(
		'main' => 'Home 1'
	);
	
	if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
		$page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
		if (isset($page->ID)) {
			update_option( 'page_on_front', $page->ID );
			update_option( 'show_on_front', 'page' );
		}
	}

	// Import Settings of Elementor
	$options_elementor = maybe_unserialize('a:12:{s:13:"system_colors";a:4:{i:0;a:3:{s:3:"_id";s:7:"primary";s:5:"title";s:7:"Primary";s:5:"color";s:7:"#0787D9";}i:1;a:3:{s:3:"_id";s:9:"secondary";s:5:"title";s:9:"Secondary";s:5:"color";s:7:"#00294B";}i:2;a:3:{s:3:"_id";s:4:"text";s:5:"title";s:4:"Text";s:5:"color";s:7:"#696969";}i:3;a:3:{s:3:"_id";s:6:"accent";s:5:"title";s:6:"Accent";s:5:"color";s:7:"#61CE70";}}s:13:"custom_colors";a:0:{}s:17:"system_typography";a:4:{i:0;a:5:{s:3:"_id";s:7:"primary";s:5:"title";s:7:"Primary";s:21:"typography_typography";s:6:"custom";s:22:"typography_font_family";s:6:"Roboto";s:22:"typography_font_weight";s:3:"600";}i:1;a:5:{s:3:"_id";s:9:"secondary";s:5:"title";s:9:"Secondary";s:21:"typography_typography";s:6:"custom";s:22:"typography_font_family";s:11:"Roboto Slab";s:22:"typography_font_weight";s:3:"400";}i:2;a:5:{s:3:"_id";s:4:"text";s:5:"title";s:4:"Text";s:21:"typography_typography";s:6:"custom";s:22:"typography_font_family";s:6:"Roboto";s:22:"typography_font_weight";s:3:"400";}i:3;a:5:{s:3:"_id";s:6:"accent";s:5:"title";s:6:"Accent";s:21:"typography_typography";s:6:"custom";s:22:"typography_font_family";s:6:"Roboto";s:22:"typography_font_weight";s:3:"500";}}s:17:"custom_typography";a:0:{}s:21:"default_generic_fonts";s:10:"Sans-serif";s:9:"site_name";s:44:"Conult - Consulting Business WordPress Theme";s:16:"site_description";s:27:"Just another WordPress site";s:15:"container_width";a:3:{s:4:"unit";s:2:"px";s:4:"size";i:1200;s:5:"sizes";a:0:{}}s:19:"page_title_selector";s:14:"h1.entry-title";s:15:"activeItemIndex";i:1;s:11:"viewport_md";i:768;s:11:"viewport_lg";i:1025;}', true);
	$active_kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();
	update_post_meta($active_kit_id, '_elementor_page_settings', $options_elementor);
	update_option('use_extendify_templates', '0');

	update_option( 'elementor_experiment-e_dom_optimization', 'inactive' );
	update_option( 'elementor_experiment-a11y_improvements', 'inactive' );
   update_option( 'elementor_editor_break_lines', '1' );
   update_option( 'elementor_unfiltered_files_upload', '1' );
   update_option( 'elementor_experiment-container', 'inactive' );
   update_option( 'elementor_experiment-e_optimized_assets_loading', 'inactive' );
   update_option( 'elementor_experiment-additional_custom_breakpoints', 'inactive' );
   update_option( 'elementor_experiment-e_swiper_latest', 'inactive' );
   update_option( 'elementor_experiment-e_optimized_css_loading', 'inactive' );
   update_option( 'elementor_experiment-e_font_icon_svg', 'inactive' );
}

add_action('wbc_importer_after_content_import', 'conult_themer_import_sample', 10, 2);

