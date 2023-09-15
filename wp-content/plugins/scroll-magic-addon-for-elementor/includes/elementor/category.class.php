<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Wpmp_add_category' ) ) {
    
    class Wpmp_add_category{

        public function __construct(){
            add_action( 'elementor/elements/categories_registered', [$this,'add_elementor_widget_categories'] );
        }

        function add_elementor_widget_categories( $elements_manager ) {

            $elements_manager->add_category(
                WPMP_CATEGORY,
                [
                    'title' => __( 'Scroll Magic', 'wpmp' ),
                    'icon' => 'fa fa-plug',
                ]
            );
        
        }

    }

    new Wpmp_add_category();
}