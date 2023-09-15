<?php
/*
Plugin Name: Scroll Magic Addon for Elementor
Plugin URI: https://scrollmagic-elementor.magicpages.tech/
Description: ScrollMagic for Elementor makes it easy to react to a user's current scroll position.
Version: 1.1.1
Author: MagicPages
*/
if (!defined('WPINC')) {
    die;
}

defined('WPMP_SMG_ELE_VERSION') or define('WPMP_SMG_ELE_VERSION', '1.1.0');
defined('WPMP_SMG_ELE_URL') or define('WPMP_SMG_ELE_URL', plugins_url('/', __FILE__));

defined('WPMP_CATEGORY') or define('WPMP_CATEGORY', 'Wpmp_SM_ctgr');

if (!class_exists('Wpmp_ScrollMagic_Elementor')) {

    class Wpmp_ScrollMagic_Elementor
    {
        public function __construct()
        {
            add_action('init', [$this, 'actionInit']);
        }

        function actionInit()
        {
            include_once 'includes/index.php';
            add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);
        }

        public function enqueueScripts()
        {
            wp_enqueue_style('wpmp-css', WPMP_SMG_ELE_URL . 'assets/public/css/wpmp.css');
            wp_enqueue_style('animate', WPMP_SMG_ELE_URL . 'assets/lib/animate/animate.min.css');
            wp_enqueue_style('magic', WPMP_SMG_ELE_URL . 'assets/lib/animate/magic.min.css');
            wp_enqueue_script('jQuery');
            wp_enqueue_script('gsap', WPMP_SMG_ELE_URL . 'assets/lib/gsap/gsap.min.js', array('jquery'), WPMP_SMG_ELE_VERSION, true);
            wp_enqueue_script('DrawSVG', WPMP_SMG_ELE_URL . 'assets/lib/gsap/DrawSVG.min.js', array('jquery'), WPMP_SMG_ELE_VERSION, true);
            wp_enqueue_script('SplitText3', WPMP_SMG_ELE_URL . 'assets/lib/gsap/SplitText3.min.js', array('jquery'), WPMP_SMG_ELE_VERSION, true);
            wp_enqueue_script('ScrollMagic', WPMP_SMG_ELE_URL . 'assets/lib/scrollmagic/minified/ScrollMagic.min.js', array('jquery'), WPMP_SMG_ELE_VERSION, true);
            wp_enqueue_script('animation-gsap', WPMP_SMG_ELE_URL . 'assets/lib/scrollmagic/minified/plugins/animation.gsap.min.js', array('jquery'), WPMP_SMG_ELE_VERSION, true);
            wp_enqueue_script('debug-addIndicators', WPMP_SMG_ELE_URL . 'assets/lib/scrollmagic/minified/plugins/debug.addIndicators.min.js', array('jquery'), WPMP_SMG_ELE_VERSION, true);
            wp_enqueue_script('wpmp-js', WPMP_SMG_ELE_URL . 'assets/public/js/wpmp.js', array('jquery'), WPMP_SMG_ELE_VERSION, true);

        }
    }

    new Wpmp_ScrollMagic_Elementor();
}

