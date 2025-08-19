<?php
/**
 * Plugin Name: MoversCo Form
 * Plugin URI: https://fadigitals.com/plugins/moversco-form
 * Description: 🚚 A modern and efficient WordPress plugin for managing and processing MoversCo form submissions. Built with performance and reliability in mind.
 * Version: 2.6.3
 * Author: Faizan Ali
 * Author URI: https://fadigitals.com
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: moversco
 * Domain Path: /languages
 */


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin directory.
define( 'MOVERSCO_FORM_DIR', plugin_dir_path( __FILE__ ) );
define( 'MOVERSCO_URL',  plugin_dir_url(  __FILE__ ) ); 

// plugin file constant
if (!defined('MOVERSCO_FORM_FILE')) {
    define('MOVERSCO_FORM_FILE', __FILE__);
}

/**
 * Load plugin textdomain.
 */
function moversco_load_textdomain() {
    load_plugin_textdomain(
        'moversco',
        false,
        dirname(plugin_basename(__FILE__)) . '/languages'
    );
}
add_action('admin_init', 'moversco_load_textdomain', 0);

// Debug translations (remove in production)
add_action('init', function() {
    error_log('Current locale: ' . get_locale());
    error_log('Translation file path: ' . dirname(plugin_basename(__FILE__)) . '/languages');
    error_log('Translation loaded: ' . (is_textdomain_loaded('moversco') ? 'yes' : 'no'));
});

// Include necessary files.
require_once MOVERSCO_FORM_DIR . 'includes/admin/class-admin-menu.php';
require_once MOVERSCO_FORM_DIR . 'includes/admin/class-mvco-settings.php';
require_once MOVERSCO_FORM_DIR . 'includes/api/class-apicheck-handler.php';
require_once MOVERSCO_FORM_DIR . 'includes/api/class-address-lookup.php';
require_once MOVERSCO_FORM_DIR . 'includes/api/class-street-search.php';
require_once MOVERSCO_FORM_DIR . 'includes/shortcodes/class-moversco-form-shortcode.php';
require_once MOVERSCO_FORM_DIR . 'includes/ajax/movers-admin-ajax.php';
require_once MOVERSCO_FORM_DIR . 'includes/ajax/ajax-locations.php';
require_once MOVERSCO_FORM_DIR . 'includes/admin/class-form-products.php';
require_once MOVERSCO_FORM_DIR . 'includes/admin/class-mvco-orders.php';
require_once MOVERSCO_FORM_DIR . 'includes/core/class-core-functions.php';

new MoversCoForm_Core_Functions();


add_action( 'wp_enqueue_scripts', 'moversco_enqueue_scripts' );
function moversco_enqueue_scripts() {
    wp_enqueue_script(
        'moversco-translate',
        plugin_dir_url( __FILE__ ) . 'assets/js/translate.js',
        [],
        '1.0',
        true
    );

    wp_localize_script( 'moversco-translate', 'moverscoLang', [
        'defaultLang' => 'en',
        'langPath'    => plugin_dir_url( __FILE__ ) . 'assets/js/lang/',
    ] );
}

// Initialize the plugin.
function moversco_form_init() {
    // Register admin menu.
    new AdminMenu();

    // Register shortcode.
    new MoversCoFormShortcode();

    new MVCO_Settings();
}
add_action('plugins_loaded', 'moversco_form_init', 10);