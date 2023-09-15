<?php

/**
 * 
 * Tento plugin je venovan me zene Veronice, synu Alexovi a dceri Agatce.
 * 
 *
 * @link              www.scrollsequence.com
 * @since             0.7.0
 * @package           Scrollsequence
 *
 * @wordpress-plugin
 * Plugin Name:       Scrollsequence
 * Plugin URI:        www.scrollsequence.com
 * Description:       Create stunning image animation that play and rewind on scroll. Make your website come alive with just few clicks.  
 * Version:           1.4.3
 * Author:            Scrollsequence
 * Author URI:        www.scrollsequence.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       scrollsequence
 * Domain Path:       /languages
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if ( function_exists( 'freemius_scrollsequence' ) ) {
    freemius_scrollsequence()->set_basename( false, __FILE__ );
} else {
    // DO NOT REMOVE THIS IF, IT IS ESSENTIAL FOR THE `function_exists` CALL ABOVE TO PROPERLY WORK.
    
    if ( !function_exists( 'freemius_scrollsequence' ) ) {
        // ... Freemius integration snippet ...
        // FREEMIUS  COPY START
        
        if ( !function_exists( 'freemius_scrollsequence' ) ) {
            // Create a helper function for easy SDK access.
            function freemius_scrollsequence()
            {
                global  $freemius_scrollsequence ;
                
                if ( !isset( $freemius_scrollsequence ) ) {
                    // Include Freemius SDK.
                    require_once dirname( __FILE__ ) . '/includes/freemius/start.php';
                    $freemius_scrollsequence = fs_dynamic_init( array(
                        'id'              => '5856',
                        'slug'            => 'scrollsequence',
                        'premium_slug'    => 'scrollsequence-pro',
                        'type'            => 'plugin',
                        'public_key'      => 'pk_ea24bea874c80814ebc58bc230264',
                        'is_premium'      => false,
                        'has_addons'      => false,
                        'has_paid_plans'  => true,
                        'trial'           => array(
                        'days'               => 14,
                        'is_require_payment' => false,
                    ),
                        'has_affiliation' => 'all',
                        'menu'            => array(
                        'slug'       => 'edit.php?post_type=scrollsequence',
                        'first-path' => 'admin.php?page=scrollsequence-dashboard',
                        'support'    => false,
                    ),
                        'is_live'         => true,
                    ) );
                }
                
                return $freemius_scrollsequence;
            }
            
            // Init Freemius.
            freemius_scrollsequence();
            // Signal that SDK was initiated.
            do_action( 'freemius_scrollsequence_loaded' );
        }
        
        // FREEMIUS COPY END
    }
    
    // ... Your plugin's main file logic ...
    // If this file is called directly, abort.
    if ( !defined( 'WPINC' ) ) {
        die;
    }
    /**
     * Currently plugin version.
     * Start at version 0.7.0 and use SemVer - https://semver.org
     * Rename this for your plugin and update it as you release new versions.
     */
    define( 'SCROLLSEQUENCE_VERSION', '1.4.3' );
    /**
     * The code that runs during plugin activation.
     * This action is documented in includes/class-scrollsequence-activator.php
     */
    function activate_scrollsequence()
    {
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-scrollsequence-activator.php';
        Scrollsequence_Activator::activate();
    }
    
    /**
     * The code that runs during plugin deactivation.
     * This action is documented in includes/class-scrollsequence-deactivator.php
     */
    function deactivate_scrollsequence()
    {
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-scrollsequence-deactivator.php';
        Scrollsequence_Deactivator::deactivate();
    }
    
    register_activation_hook( __FILE__, 'activate_scrollsequence' );
    register_deactivation_hook( __FILE__, 'deactivate_scrollsequence' );
    /**
     * The core plugin class that is used to define internationalization,
     * admin-specific hooks, and public-facing site hooks.
     */
    require plugin_dir_path( __FILE__ ) . 'includes/class-scrollsequence.php';
    /**
     * Begins execution of the plugin.
     *
     * Since everything within the plugin is registered via hooks,
     * then kicking off the plugin from this point in the file does
     * not affect the page life cycle.
     *
     * @since    1.0.0
     */
    function run_scrollsequence()
    {
        $plugin = new Scrollsequence();
        $plugin->run();
    }
    
    run_scrollsequence();
}
