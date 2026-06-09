<?php
/**
 * Plugin Name: Testimonial Card Widget
 * Description: A custom Elementor testimonial card slider widget with full styling controls.
 * Version:     1.1.0
 * Author:      Abdullah Ijaz
 * Author URI:  https://www.linkedin.com/in/abdullahijaz320/
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: testimonial-card-widget
 *
 * @package TCW
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'TCW_VERSION', '1.1.0' );
define( 'TCW_PATH', plugin_dir_path( __FILE__ ) );
define( 'TCW_URL',  plugin_dir_url( __FILE__ ) );

add_action( 'init', function() {
    load_plugin_textdomain( 'testimonial-card-widget', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
} );

add_action( 'elementor/widgets/register', function( $widgets_manager ) {
    if ( ! defined( 'ELEMENTOR_VERSION' ) ) return;
    require_once TCW_PATH . 'widgets/class-testimonial-card-widget.php';
    $widgets_manager->register( new \TCW\Testimonial_Card_Widget() );
} );

add_action( 'elementor/frontend/after_enqueue_styles', function() {
    wp_enqueue_style( 'tcw-testimonial-card', TCW_URL . 'assets/testimonial-card.css', [], TCW_VERSION );
} );

add_action( 'admin_notices', function() {
    if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
        echo '<div class="notice notice-warning is-dismissible"><p><strong>Testimonial Card Widget</strong> ' . esc_html__( 'requires Elementor to be installed and activated.', 'testimonial-widget' ) . '</p></div>';
    }
} );