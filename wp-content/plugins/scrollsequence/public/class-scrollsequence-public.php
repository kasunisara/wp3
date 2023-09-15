<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       www.scrollsequence.com
 * @since      0.7.0
 *
 * @package    Scrollsequence
 * @subpackage Scrollsequence/public
 */
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Scrollsequence
 * @subpackage Scrollsequence/public
 * @author     Scrollsequence <info@scrollsequence.com>
 */
class Scrollsequence_Public
{
    /**
     * The ID of this plugin.
     *
     * @since    0.7.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private  $plugin_name ;
    /**
     * The version of this plugin.
     *
     * @since    0.7.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private  $version ;
    /**
     * Initialize the class and set its properties.
     *
     * @since    0.7.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version )
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }
    
    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    0.7.0
     */
    public function enqueue_styles()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Scrollsequence_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Scrollsequence_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        if ( is_singular( 'scrollsequence' ) ) {
            // we dont really need CSS, activate line below when situation changes.
            //wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/scrollsequence-public.css', array(), $this->version, 'all' );
        }
    }
    
    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    0.7.0
     */
    public function enqueue_scripts()
    {
        // FREE VERSION ONLY
        wp_register_script(
            $this->plugin_name . '-lib',
            plugin_dir_url( __FILE__ ) . 'js/ssq-lib.js',
            array( 'jquery' ),
            $this->version,
            true
        );
        // SHORTCODE REGISTER SCRIPTS
        // BLOCK START
        // if ( freemius_scrollsequence()->is_plan_or_trial__premium_only('PRO') ) {
        // 		wp_enqueue_script( $this->plugin_name.'-gsap-scrolltrigger', plugin_dir_url( __FILE__ ) . 'js/gsap-scrolltrigger__premium_only.js', array( 'jquery' ), $this->version, true );
        // 	}
        // Wrap all this in IF statement AKTodo
        //wp_enqueue_script( $this->plugin_name.'-ssq-block', plugin_dir_url( __FILE__ ) . 'js/ssq-block.js', array( 'jquery' ), $this->version, true );
        // BLOCK END
    }

}
// End of class