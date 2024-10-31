<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://nowebsite.yet
 * @since      1.0.0
 *
 * @package    Role_Based_Storage_Limiter
 * @subpackage Role_Based_Storage_Limiter/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Role_Based_Storage_Limiter
 * @subpackage Role_Based_Storage_Limiter/includes
 * @author     Marc Luther Capulong <mlccapulong@gmail.com>
 */
class Role_Based_Storage_Limiter_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'role-based-storage-limiter',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
