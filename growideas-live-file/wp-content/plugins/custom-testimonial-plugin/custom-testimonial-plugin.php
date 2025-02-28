<?php
/**
 * Plugin Name: Custom Testimonial Plugin
 * Description: A custom plugin by GROWIDEAS Innovations to manage and display testimonials with ease.
 * Plugin URI: https://growideasinnovations.com/
 * Author: GROWIDEAS Innovations
 * Version: 1.0.0
 * Author URI: https://growideasinnovations.com/
 *
 * Text Domain: custom-testimonial-plugin
 *
 * @package CustomTestimonialPlugin
 * @category Core
 *
 * Custom Testimonial Plugin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * Custom Testimonial Plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * Usage Instructions:
 * - Use the [testimonial_slider] shortcode to display the testimonial slider on any page or post.
 * - Use the [testimonial_form] shortcode to display the testimonial submission form on any page or post.
 */

// Add settings link in the plugins page
function ctp_add_settings_link($links) {
    $settings_link = '<a href="' . admin_url('admin.php?page=ctp-testimonials') . '">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'ctp_add_settings_link');

// Database table creation on plugin activation
function ctp_install() {
    global $wpdb;
    global $ctp_db_version;

    $table_name = $wpdb->prefix . 'ctp_testimonials';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        role varchar(100),
        testimonial text NOT NULL,
        photo_url varchar(255),
        is_visible boolean DEFAULT true,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    add_option('ctp_db_version', $ctp_db_version);
}
register_activation_hook(__FILE__, 'ctp_install');

// Shortcode for testimonial form
function ctp_testimonial_form() {
    ob_start();
    include plugin_dir_path(__FILE__) . 'includes/form.php';
    return ob_get_clean();
}
add_shortcode('testimonial_form', 'ctp_testimonial_form');

// Enqueue assets
function ctp_enqueue_assets() {
    wp_enqueue_style('ctp-styles', plugin_dir_url(__FILE__) . 'css/style.css');
    wp_enqueue_script('ctp-slider', plugin_dir_url(__FILE__) . 'js/slider.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'ctp_enqueue_assets');

// Shortcode for testimonial slider
function ctp_testimonial_slider() {
    ob_start();
    include plugin_dir_path(__FILE__) . 'includes/display.php';
    return ob_get_clean();
}
add_shortcode('testimonial_slider', 'ctp_testimonial_slider');

// Admin menu for testimonials
function ctp_register_testimonial_menu() {
    add_menu_page(
        'Testimonials',
        'Testimonials',
        'manage_options',
        'ctp-testimonials',
        'ctp_testimonial_admin_page',
        'dashicons-testimonial',
        20
    );
}
add_action('admin_menu', 'ctp_register_testimonial_menu');

// Admin page callback
function ctp_testimonial_admin_page() {
    include plugin_dir_path(__FILE__) . 'includes/admin.php';
}

// AJAX handler for testimonial submission
/*function ctp_submit_testimonial() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'ctp_testimonials';
    
    $inserted = $wpdb->insert($table_name, [
        'name' => sanitize_text_field($_POST['name']),
        'role' => sanitize_text_field($_POST['role']),
        'testimonial' => sanitize_textarea_field($_POST['testimonial']),
        'photo_url' => esc_url_raw($_POST['photo_url']),
        'is_visible' => 1,
    ]);

    if ($inserted) {
        wp_send_json_success(['redirect_url' => home_url()]);
    } else {
        wp_send_json_error('Failed to save testimonial.');
    }
}
add_action('wp_ajax_ctp_submit_testimonial', 'ctp_submit_testimonial');
add_action('wp_ajax_nopriv_ctp_submit_testimonial', 'ctp_submit_testimonial');*/

function ctp_submit_testimonial() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'ctp_testimonials';

    // Check if the file is uploaded
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $uploaded_file = $_FILES['photo'];

        // Check the file type (e.g., JPEG, PNG)
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($uploaded_file['type'], $allowed_types)) {
            wp_send_json_error('Invalid file type. Only JPEG, PNG, and GIF are allowed.');
            return;
        }

        // Get the WordPress upload directory
        $upload_dir = wp_upload_dir();
        $target_path = $upload_dir['path'] . '/' . basename($uploaded_file['name']);

        // Move the uploaded file to the target directory
        if (move_uploaded_file($uploaded_file['tmp_name'], $target_path)) {
            $file_url = $upload_dir['url'] . '/' . basename($uploaded_file['name']);
        } else {
            wp_send_json_error('Failed to move the uploaded file.');
            return;
        }
    } else {
        wp_send_json_error('No file uploaded or file upload error.');
        return;
    }

    // Insert the testimonial data into the database
    $inserted = $wpdb->insert($table_name, [
        'name' => sanitize_text_field($_POST['name']),
        'role' => sanitize_text_field($_POST['role']),
        'testimonial' => sanitize_textarea_field($_POST['testimonial']),
        'photo_url' => esc_url_raw($file_url),  // Save the file URL
        'is_visible' => 1,
    ]);

    if ($inserted) {
        wp_send_json_success(['redirect_url' => home_url()]);
    } else {
        wp_send_json_error('Failed to save testimonial.');
    }
}
add_action('wp_ajax_ctp_submit_testimonial', 'ctp_submit_testimonial');
add_action('wp_ajax_nopriv_ctp_submit_testimonial', 'ctp_submit_testimonial');
