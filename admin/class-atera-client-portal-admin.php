<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://rococodigital.co.uk
 * @since      0.1
 *
 * @package    Atera_Client_Portal
 * @subpackage Atera_Client_Portal/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Atera_Client_Portal
 * @subpackage Atera_Client_Portal/admin
 * @author     Matt Jones <matt@rococodigital.co.uk>
 */
class Atera_Client_Portal_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.1
	 * @access   private
	 * @var      string    $Atera_Client_Portal    The ID of this plugin.
	 */
	private $Atera_Client_Portal;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.1
	 * @param      string    $Atera_Client_Portal       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $Atera_Client_Portal, $version ) {

		$this->Atera_Client_Portal = $Atera_Client_Portal;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    0.1
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->Atera_Client_Portal, plugin_dir_url( __FILE__ ) . 'css/atera-client-portal-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'bulma-css', plugin_dir_url( __FILE__ ) . 'css/bulma.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    0.1
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->Atera_Client_Portal, plugin_dir_url( __FILE__ ) . 'js/atera-client-portal-admin.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Add our custom menu.
	 *
	 * @since    0.1
	 */
	public function atera_menu(){
		add_menu_page( 'Atera CP settings', 'Atera CP', 'manage_options', 'atera-client-portal-plugin/mainsettings.php', array( $this, 'atera_cp_admin_page'), '🔗', 250 );
	}

	public function atera_cp_admin_page(){
		//return views
		require_once 'partials/atera-client-portal-admin-display.php';
	}

	/**
	 * Register custom fields for Atera admin.
	 *
	 * @since    0.1
	 */
	public function register_atera_settings(){
		//Register all settings
		register_setting( 'atera-admin-settings', 'atera-api-key' );

	}

}
