<?php

/**

 *

 * @package [Parent Theme]

 * @author  gaviasthemes <gaviasthemes@gmail.com>

 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License

 * 

 */



function conult_child_scripts() {

   wp_enqueue_style( 'conult-parent-style', get_template_directory_uri(). '/style.css');

   wp_enqueue_style( 'conult-child-style', get_stylesheet_uri());

}

add_action( 'wp_enqueue_scripts', 'conult_child_scripts', 9999 );

function custom_archive_title( $title ) {
   if ( is_post_type_archive('portfolio') ) {
     $title = 'Projects';
   }
   return $title;
 }
 add_filter( 'get_the_archive_title', 'custom_archive_title' );


// Add this to your child theme's functions.php
function child_theme_enqueue_offset_scroll_script() {
    // Ensure jQuery is loaded if using jQuery, but I will write vanilla JS for modern compatibility
    // Enqueue a small inline script for smooth scroll with offset
    $offset = 80; // Adjust this value to your fixed header height
    $inline_script = "
    document.addEventListener('DOMContentLoaded', function() {
        // Attach click listener to internal anchor links
        document.querySelectorAll('a[href^=\"#\"]').forEach(function(anchor) {
            anchor.addEventListener('click', function(e) {
                var targetID = this.getAttribute('href').substring(1);
                var targetElement = document.getElementById(targetID);
                if (targetElement) {
                    e.preventDefault();
                    var headerOffset = {$offset};
                    var elementPosition = targetElement.getBoundingClientRect().top;
                    var offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                    // Update URL hash without jumping
                    history.pushState(null, null, '#'+targetID);
                }
            });
        });
    });
    ";
    wp_add_inline_script( 'jquery-core', $inline_script );
}
add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_offset_scroll_script' );