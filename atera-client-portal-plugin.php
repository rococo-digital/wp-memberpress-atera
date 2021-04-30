<?php

/**
 *
 * @link              https://rococodigital.co.uk
 * @since             0.1
 * @package           Atera-client-portal
 *
 * @wordpress-plugin
 * Plugin Name:       Atera Client Portal
 * Plugin URI:        https://rococodigital.co.uk/atera-client-portal/
 * Description:       Connects wordpress user portal to Atera API.
 * Version:           0.1
 * Author:            Rococo Digital
 * Author URI:        https://rococodigital.co.uk
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       atera-client-portal-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
define( 'ATERA_CLIENT_PORTAL_VERSION', '0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-atera-client-portal-activator.php
 */
function activate_atera_client_portal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-atera-client-portal-activator.php';
	Atera_Client_Portal_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-atera-client-portal-deactivator.php
 */
function deactivate_atera_client_portal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-atera-client-portal-deactivator.php';
	Atera_Client_Portal_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_atera_client_portal' );
register_deactivation_hook( __FILE__, 'deactivate_atera_client_portal' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-atera-client-portal.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.1
 */
function run_atera_client_portal() {

	$plugin = new Atera_Client_Portal();
	$plugin->run();

}
run_atera_client_portal();
