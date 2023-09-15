<?php

/**
 * Fired during plugin activation
 *
 * @link       www.scrollsequence.com
 * @since      0.7.0
 *
 * @package    Scrollsequence
 * @subpackage Scrollsequence/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      0.7.0
 * @package    Scrollsequence
 * @subpackage Scrollsequence/includes
 * @author     Scrollsequence <info@scrollsequence.com>
 */
class Scrollsequence_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    0.7.0
	 */
	public static function activate() {

		// 2 lines below from: https://github.com/JoeSz/WordPress-Plugin-Boilerplate-Tutorial/blob/master/plugin-name/tutorials/custom_post_types.php

		include plugin_dir_path( __DIR__ ) . 'admin/create-cpt.php'; // Ak Experiment
		flush_rewrite_rules(); // 

	}

}
