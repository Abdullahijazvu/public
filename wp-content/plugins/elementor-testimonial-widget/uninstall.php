<?php
/**
 * Runs when the plugin is deleted from WordPress.
 *
 * @package TCW
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

// Nothing stored in the database currently.
// Add cleanup here if you store options in future, e.g.:
// delete_option( 'tcw_settings' );