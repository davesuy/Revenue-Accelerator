<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       dev@itmooti.com
 * @since      1.0.0
 *
 * @package    Black_Belt_Profile
 * @subpackage Black_Belt_Profile/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Black_Belt_Profile
 * @subpackage Black_Belt_Profile/includes
 * @author     ITMOOTI <dev@itmooti.com>
 */
class Black_Belt_Profile_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'black-belt-profile',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
