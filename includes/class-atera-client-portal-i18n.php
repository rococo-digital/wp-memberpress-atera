<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://rococodigital.co.uk
 * @since      0.1
 *
 * @package    Atera_Client_Portal
 * @subpackage Atera_Client_Portal/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      0.1
 * @package    Atera_Client_Portal
 * @subpackage Atera_Client_Portal/includes
 * @author     Matt Jones <matt@rococodigital.co.uk>
 */
class Atera_Client_Portal_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    0.1
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'atera-client-portal',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
