<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       www.scrollsequence.com
 * @since      0.7.0
 *
 * @package    Scrollsequence
 * @subpackage Scrollsequence/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      0.7.0
 * @package    Scrollsequence
 * @subpackage Scrollsequence/includes
 * @author     Scrollsequence <info@scrollsequence.com>
 */
class Scrollsequence {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    0.7.0
	 * @access   protected
	 * @var      Scrollsequence_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    0.7.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    0.7.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    0.7.0
	 */
	public function __construct() {
		if ( defined( 'SCROLLSEQUENCE_VERSION' ) ) {
			$this->version = SCROLLSEQUENCE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'scrollsequence';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Scrollsequence_Loader. Orchestrates the hooks of the plugin.
	 * - Scrollsequence_i18n. Defines internationalization functionality.
	 * - Scrollsequence_Admin. Defines all hooks for the admin area.
	 * - Scrollsequence_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    0.7.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-scrollsequence-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-scrollsequence-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-scrollsequence-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-scrollsequence-public.php';

		$this->loader = new Scrollsequence_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Scrollsequence_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    0.7.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Scrollsequence_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    0.7.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Scrollsequence_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		// register scrollsequence CPT
		$this->loader->add_action( 'init', $plugin_admin, 'scrollsequence_cpt' );  
		// register  CPT submenu
		$this->loader->add_action( 'init', $plugin_admin, 'scrollsequence_cpt_submenu' );  
		// tutplus.com Step 1
		$this->loader->add_action( 'template_include', $plugin_admin, 'scrollsequence_template' ); 
		//Carbon Fields boot
		$this->loader->add_action( 'after_setup_theme', $plugin_admin, 'scrollsequence_carbon_fields_load' ); 
		//Carbon Fields main fields
		$this->loader->add_action( 'carbon_fields_register_fields', $plugin_admin, 'scrollsequence_carbon_fields_cpt' ); 

		//admin notice (too many img)
		$this->loader->add_action( 'admin_notices', $plugin_admin, 'scrollsequence_admin_notice', 10, 2); 

		//Classic Content Editor Heading
		$this->loader->add_action( 'edit_form_after_title', $plugin_admin, 'scrollsequence_classic_content_html', 9999, 2); 

		// Admin Columns
		$this->loader->add_action( 'manage_scrollsequence_posts_columns', $plugin_admin, 'scrollsequence_admin_columns',5 );
		$this->loader->add_action( 'manage_scrollsequence_posts_custom_column', $plugin_admin, 'scrollsequence_admin_column_content',5,2 );

		// Admin Columns (thumb)
		$this->loader->add_action( 'manage_scrollsequence_posts_columns', $plugin_admin, 'ssq_add_thumbnail_column',5 );
		$this->loader->add_action( 'manage_scrollsequence_posts_custom_column', $plugin_admin, 'ssq_display_thumbnail_column',5,2 );

		// Options page settings 
		$this->loader->add_action( 'admin_init', $plugin_admin, 'scrollsequence_register_options_settings' );  

		// Duplicate button 
		$this->loader->add_action( 'post_row_actions', $plugin_admin, 'ssq_duplicate_post_link', 10, 2);
		$this->loader->add_action( 'admin_action_duplicate_scrollsequence_as_draft', $plugin_admin, 'duplicate_scrollsequence_as_draft' );  
		$this->loader->add_action( 'admin_notices', $plugin_admin, 'ssq_duplication_admin_notice' );  

		// HelpScout Beacon Definition
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'ssq_add_helpscout_beacon' ); 

		//BLOCKSTUFF
		//Carbon Fields block fields
		//$this->loader->add_action( 'carbon_fields_register_fields', $plugin_admin, 'scrollsequence_carbon_fields_block' );


	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    0.7.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Scrollsequence_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts',1 ); // added priority 1.1.6 to make sure GSAP loads nicely (smgic)



	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    0.7.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     0.7.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     0.7.0
	 * @return    Scrollsequence_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     0.7.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
