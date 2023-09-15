<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       www.scrollsequence.com
 * @since      0.7.0
 *
 * @package    Scrollsequence
 * @subpackage Scrollsequence/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      0.7.0
 * @package    Scrollsequence
 * @subpackage Scrollsequence/includes
 * @author     Scrollsequence <info@scrollsequence.com>
 */
class Scrollsequence_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    0.7.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'scrollsequence',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
