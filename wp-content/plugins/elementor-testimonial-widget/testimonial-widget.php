<?php
/**
 * Plugin Name: Testimonial Card Widget
 * Description: A custom Elementor testimonial card widget with full styling controls.
 * Version:     1.0.0
 * Author:      Abdullah Ijaz
 * Text Domain: testimonial-widget
 *
 * Requires Elementor 3.0+
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'TCW_VERSION', '1.0.0' );
define( 'TCW_PATH', plugin_dir_path( __FILE__ ) );
define( 'TCW_URL',  plugin_dir_url( __FILE__ ) );

/**
 * Check Elementor is active before loading anything.
 */
function tcw_init() {
    if ( ! did_action( 'elementor/loaded' ) ) {
        add_action( 'admin_notices', 'tcw_missing_elementor_notice' );
        return;
    }

    if ( ! version_compare( ELEMENTOR_VERSION, '3.0.0', '>=' ) ) {
        add_action( 'admin_notices', 'tcw_old_elementor_notice' );
        return;
    }

    add_action( 'elementor/frontend/after_enqueue_styles', 'tcw_enqueue_styles' );
    add_action( 'elementor/widgets/register', 'tcw_register_widgets', 10, 1 );
}
add_action( 'plugins_loaded', 'tcw_init' );

function tcw_register_widgets( $widgets_manager ) {
    require_once TCW_PATH . 'widgets/class-testimonial-card-widget.php'; 
    $widgets_manager->register( new \TCW\Testimonial_Card_Widget() );
}

function tcw_enqueue_styles() {
    wp_enqueue_style(
        'tcw-testimonial-card',
        TCW_URL . 'assets/testimonial-card.css',
        [],
        TCW_VERSION
    );
}

function tcw_missing_elementor_notice() {
    echo '<div class="notice notice-warning"><p><strong>Testimonial Card Widget</strong> requires Elementor to be installed and activated.</p></div>';
}

function tcw_old_elementor_notice() {
    echo '<div class="notice notice-warning"><p><strong>Testimonial Card Widget</strong> requires Elementor 3.0 or higher.</p></div>';
}
