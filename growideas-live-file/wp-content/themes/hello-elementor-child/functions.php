<?php
function hello_elementor_child_enqueue_assets() {
    // Enqueue the parent theme style
    wp_enqueue_style('hello-elementor-parent-style', get_template_directory_uri() . '/style.css');

    // Enqueue the child theme style
    wp_enqueue_style('hello-elementor-child-style', get_stylesheet_directory_uri() . '/style.css', array('hello-elementor-parent-style'));

    // Enqueue the custom CSS file
    wp_enqueue_style('hello-elementor-custom-style', get_stylesheet_directory_uri() . '/assets/custom.css');

    // Enqueue the custom JavaScript file
    wp_enqueue_script('hello-elementor-custom-js', get_stylesheet_directory_uri() . '/assets/custom.js', array('jquery'), null, true);
    
    // Enqueue Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
}
add_action('wp_enqueue_scripts', 'hello_elementor_child_enqueue_assets');

