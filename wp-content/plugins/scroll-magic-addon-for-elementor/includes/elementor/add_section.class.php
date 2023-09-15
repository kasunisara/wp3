<?php

use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Wpmp_add_section' ) ) {


    class Wpmp_add_section{

        public function __construct(){
            add_action( 'elementor/element/before_section_start', [$this,'add_scroll_magic_control'], 10, 3 );
            add_action( 'elementor/element/after_section_end', [$this,'add_scroll_magic_default'], 10, 3 );
            add_action( 'elementor/element/after_section_end', [$this,'add_scroll_magic_effect'], 10, 3 );
        }

        function add_scroll_magic_control( $element, $section_id, $args ) {
            $except = ['column','section'];
            if(in_array($element->get_name(),$except )) return;
            if ( 'section_effects' === $section_id  ) {
                $element->start_controls_section(
                    'section_scrollmagic_control',
                    [
                        'tab' => Controls_Manager::TAB_STYLE,
                        'label' => __( 'Scroll Magic control', 'wpmp' ),
                    ]
                );
                $element->add_control(
                    'wpmp_enable_desktop',
                    [
                        'label' => __( 'Hide On Desktop', 'wpmp' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __( 'Hide', 'wpmp' ),
                        'label_off' => __( 'Show', 'wpmp' ),
                        'return_value' => 'yes',
                        'default' => 'yes',
                    ]
                );
                $element->add_control(
                    'wpmp_enable_tablet',
                    [
                        'label' => __( 'Hide On Tablet', 'wpmp' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __( 'Hide', 'wpmp' ),
                        'label_off' => __( 'Show', 'wpmp' ),
                        'return_value' => 'yes',
                        'default' => 'yes',
                    ]
                );
                $element->add_control(
                    'wpmp_enable_mobile',
                    [
                        'label' => __( 'Hide On Mobile', 'wpmp' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __( 'Hide', 'wpmp' ),
                        'label_off' => __( 'Show', 'wpmp' ),
                        'return_value' => 'yes',
                        'default' => 'yes',
                    ]
                );
                $element->add_control(
                    'wpmp_trigger_hook',
                    [
                    'type' => Controls_Manager::NUMBER,
                    'label' => __( 'Trigger Hook', 'wpmp' ),
                    'min' => '0','max' => '1','step' => '0.1',
                    'default' => '0.5'
                    ]
                );
                $element->add_control(
                    'wpmp_reverse',
                    [
                        'label' => __( 'Reverse', 'wpmp' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __( 'On', 'wpmp' ),
                        'label_off' => __( 'Off', 'wpmp' ),
                        'return_value' => 'yes',
                        'default' => 'yes',
                    ]
                );
                $element->add_control(
                    'wpmp_pin',
                    [
                        'label' => __( 'Pin', 'wpmp' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __( 'On', 'wpmp' ),
                        'label_off' => __( 'Off', 'wpmp' ),
                        'return_value' => 'yes',
                        'default' => '',
                    ]
                );
                $element->add_control(
                    'wpmp_pushFollowers',
                    [
                        'label' => __( 'pushFollowers', 'wpmp' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __( 'On', 'wpmp' ),
                        'label_off' => __( 'Off', 'wpmp' ),
                        'return_value' => 'yes',
                        'default' => '',
                    ]
                );
                $element->add_control(
                    'wpmp_tween_changes',
                    [
                        'label' => __( 'TweenChanges', 'wpmp' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __( 'On', 'wpmp' ),
                        'label_off' => __( 'Off', 'wpmp' ),
                        'return_value' => 'yes',
                        'default' => '',
                    ]
                );
                $element->add_control(
                    'wpmp_duration',
                    [
                    'type' => Controls_Manager::NUMBER,
                    'label' => __( 'Duration', 'wpmp' ),
                    'step' => '1',
                    'default' => '0'
                    ]
                );
                $element->add_control(
                    'wpmp_offset',
                    [
                    'type' => Controls_Manager::NUMBER,
                    'label' => __( 'Offset', 'wpmp' ),
                    'step' => '1',
                    'default' => '0'
                    ]
                );
                $element->add_control(
                    'wpmp_enable_class_toggle',
                    [
                        'label' => __( 'Enable Class toggle', 'wpmp' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __( 'On', 'wpmp' ),
                        'label_off' => __( 'Off', 'wpmp' ),
                        'return_value' => 'yes',
                        'default' => '',
                    ]
                );
                $element->add_control(
                    'wpmp_class_CSS ',
                    [
                        'label' => __( 'Class CSS', 'wpmp' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'custom',
                        'options' => [
                            'custom' => esc_html__("custom", "wpmp"),
                            'magic' => esc_html__("magic", "wpmp"),
                            'twisterInDown' => esc_html__("twisterInDown", "wpmp"),
                            'twisterInUp' => esc_html__("twisterInUp", "wpmp"),
                            'swap' => esc_html__("swap", "wpmp"),
                            'puffIn' => esc_html__("puffIn", "wpmp"),
                            'puffOut' => esc_html__("puffOut", "wpmp"),
                            'vanishOut' => esc_html__("vanishOut", "wpmp"),
                            'bounce' => esc_html__("bounce", "wpmp"),
                            'flash' => esc_html__("flash", "wpmp"),
                            'pulse' => esc_html__("pulse", "wpmp"),
                            'rubberBand' => esc_html__("rubberBand", "wpmp"),
                            'shake' => esc_html__("shake", "wpmp"),
                            'swing' => esc_html__("swing", "wpmp"),
                            'tada' => esc_html__("tada", "wpmp"),
                            'wobble' => esc_html__("wobble", "wpmp"),
                            'jello' => esc_html__("jello", "wpmp"),
                            'bounceIn' => esc_html__("bounceIn", "wpmp"),
                            'bounceInDown' => esc_html__("bounceInDown", "wpmp"),
                            'bounceInLeft' => esc_html__("bounceInLeft", "wpmp"),
                            'bounceInRight' => esc_html__("bounceInRight", "wpmp"),
                            'bounceInUp' => esc_html__("bounceInUp", "wpmp"),
                            'bounceOut' => esc_html__("bounceOut", "wpmp"),
                            'bounceOutDown' => esc_html__("bounceOutDown", "wpmp"),
                            'bounceOutLeft' => esc_html__("bounceOutLeft", "wpmp"),
                            'bounceOutRight' => esc_html__("bounceOutRight", "wpmp"),
                            'bounceOutUp' => esc_html__("bounceOutUp", "wpmp"),
                            'fadeIn' => esc_html__("fadeIn", "wpmp"),
                            'fadeInDown' => esc_html__("fadeInDown", "wpmp"),
                            'fadeInDownBig' => esc_html__("fadeInDownBig", "wpmp"),
                            'fadeInLeft' => esc_html__("fadeInLeft", "wpmp"),
                            'fadeInLeftBig' => esc_html__("fadeInLeftBig", "wpmp"),
                            'fadeInRight' => esc_html__("fadeInRight", "wpmp"),
                            'fadeInRightBig' => esc_html__("fadeInRightBig", "wpmp"),
                            'fadeInUp' => esc_html__("fadeInUp", "wpmp"),
                            'fadeInUpBig' => esc_html__("fadeInUpBig", "wpmp"),
                            'fadeOut' => esc_html__("fadeOut", "wpmp"),
                            'fadeOutDown' => esc_html__("fadeOutDown", "wpmp"),
                            'fadeOutDownBig' => esc_html__("fadeOutDownBig", "wpmp"),
                            'fadeOutLeft' => esc_html__("fadeOutLeft", "wpmp"),
                            'fadeOutLeftBig' => esc_html__("fadeOutLeftBig", "wpmp"),
                            'fadeOutRight' => esc_html__("fadeOutRight", "wpmp"),
                            'fadeOutRightBig' => esc_html__("fadeOutRightBig", "wpmp"),
                            'fadeOutUp' => esc_html__("No", "wpmp"),
                            'fadeOutUpBig' => esc_html__("fadeOutUpBig", "wpmp"),
                            'flip' => esc_html__("flip", "wpmp"),
                            'flipInX' => esc_html__("flipInX", "wpmp"),
                            'flipInY' => esc_html__("flipInY", "wpmp"),
                            'flipOutX' => esc_html__("flipOutX", "wpmp"),
                            'flipOutY' => esc_html__("flipOutY", "wpmp"),
                            'lightSpeedIn' => esc_html__("lightSpeedIn", "wpmp"),
                            'lightSpeedOut' => esc_html__("lightSpeedOut", "wpmp"),
                            'rotateIn' => esc_html__("rotateIn", "wpmp"),
                            'rotateInDownLeft' => esc_html__("rotateInDownLeft", "wpmp"),
                            'rotateInDownRight' => esc_html__("rotateInDownRight", "wpmp"),
                            'rotateInUpLeft' => esc_html__("rotateInUpLeft", "wpmp"),
                            'rotateInUpRight' => esc_html__("rotateInUpRight", "wpmp"),
                            'rotateOut' => esc_html__("rotateOut", "wpmp"),
                            'rotateOutDownLeft' => esc_html__("rotateOutDownLeft", "wpmp"),
                            'rotateOutDownRight' => esc_html__("rotateOutDownRight", "wpmp"),
                            'rotateOutUpLeft' => esc_html__("rotateOutUpLeft", "wpmp"),
                            'rotateOutUpRight' => esc_html__("rotateOutUpRight", "wpmp"),
                            'slideInUp' => esc_html__("slideInUp", "wpmp"),
                            'slideInDown' => esc_html__("slideInDown", "wpmp"),
                            'slideInLeft' => esc_html__("slideInLeft", "wpmp"),
                            'slideInRight' => esc_html__("slideInRight", "wpmp"),
                            'slideOutUp' => esc_html__("slideOutUp", "wpmp"),
                            'slideOutDown' => esc_html__("slideOutDown", "wpmp"),
                            'slideOutLeft' => esc_html__("slideOutLeft", "wpmp"),
                            'slideOutRight' => esc_html__("slideOutRight", "wpmp"),
                            'zoomIn' => esc_html__("zoomIn", "wpmp"),
                            'zoomInDown' => esc_html__("zoomInDown", "wpmp"),
                            'zoomInLeft' => esc_html__("zoomInLeft", "wpmp"),
                            'zoomInRight' => esc_html__("zoomInRight", "wpmp"),
                            'zoomInUp' => esc_html__("zoomInUp", "wpmp"),
                            'zoomOut' => esc_html__("zoomOut", "wpmp"),
                            'zoomOutDown' => esc_html__("zoomOutDown", "wpmp"),
                            'zoomOutLeft' => esc_html__("zoomOutLeft", "wpmp"),
                            'zoomOutRight' => esc_html__("zoomOutRight", "wpmp"),
                            'zoomOutUp' => esc_html__("zoomOutUp", "wpmp"),
                            'hinge' => esc_html__("hinge", "wpmp"),
                            'rollIn' => esc_html__("rollIn", "wpmp"),
                            'rollOut' => esc_html__("rollOut", "wpmp"),
                            'openDownLeft' => esc_html__("openDownLeft", "wpmp"),
                            'openDownRight' => esc_html__("openDownRight", "wpmp"),
                            'openUpLeft' => esc_html__("openUpLeft", "wpmp"),
                            'openUpRight' => esc_html__("openUpRight", "wpmp"),
                            'openDownLeftReturn' => esc_html__("openDownLeftReturn", "wpmp"),
                            'openDownRightReturn' => esc_html__("openDownRightReturn", "wpmp"),
                            'openUpLeftReturn	' => esc_html__("openUpLeftReturn", "wpmp"),
                            'openUpRightReturn' => esc_html__("openUpRightReturn", "wpmp"),
                            'openDownLeftOut' => esc_html__("openDownLeftOut", "wpmp"),
                            'openDownRightOut' => esc_html__("openDownRightOut", "wpmp"),
                            'openUpLeftOut' => esc_html__("openUpLeftOut", "wpmp"),
                            'openUpRightOut' => esc_html__("openUpRightOut", "wpmp"),
                            'perspectiveDown' => esc_html__("perspectiveDown", "wpmp"),
                            'perspectiveUp' => esc_html__("perspectiveUp", "wpmp"),
                            'perspectiveLeft' => esc_html__("perspectiveLeft", "wpmp"),
                            'perspectiveRight' => esc_html__("perspectiveRight", "wpmp"),
                            'perspectiveDownReturn' => esc_html__("perspectiveDownReturn", "wpmp"),
                            'perspectiveUpReturn' => esc_html__("perspectiveUpReturn", "wpmp"),
                            'perspectiveLeftReturn' => esc_html__("perspectiveLeftReturn", "wpmp"),
                            'perspectiveRightReturn' => esc_html__("perspectiveRightReturn", "wpmp"),
                            'rotateDown' => esc_html__("rotateDown", "wpmp"),
                            'rotateUp' => esc_html__("rotateUp", "wpmp"),
                            'rotateLeft' => esc_html__("rotateLeft", "wpmp"),
                            'rotateRight' => esc_html__("rotateRight", "wpmp"),
                            'slideDown' => esc_html__("slideDown", "wpmp"),
                            'slideUp' => esc_html__("slideUp", "wpmp"),
                            'slideLeft' => esc_html__("slideLeft", "wpmp"),
                            'slideRight' => esc_html__("slideRight", "wpmp"),
                            'slideDownReturn' => esc_html__("slideDownReturn", "wpmp"),
                            'slideUpReturn' => esc_html__("slideUpReturn", "wpmp"),
                            'slideLeftReturn' => esc_html__("slideLeftReturn", "wpmp"),
                            'slideRightReturn' => esc_html__("slideRightReturn", "wpmp"),
                            'swashOut' => esc_html__("swashOut", "wpmp"),
                            'swashIn' => esc_html__("swashIn", "wpmp"),
                            'foolishIn' => esc_html__("foolishIn", "wpmp"),
                            'holeOut' => esc_html__("holeOut", "wpmp"),
                            'tinRightOut' => esc_html__("tinRightOut", "wpmp"),
                            'tinLeftOut' => esc_html__("tinLeftOut", "wpmp"),
                            'tinUpOut' => esc_html__("tinUpOut", "wpmp"),
                            'tinDownOut' => esc_html__("tinDownOut", "wpmp"),
                            'tinRightIn' => esc_html__("tinRightIn", "wpmp"),
                            'tinLeftIn' => esc_html__("tinLeftIn", "wpmp"),
                            'tinUpIn' => esc_html__("tinUpIn", "wpmp"),
                            'tinDownIn' => esc_html__("tinDownIn", "wpmp"),
                            'bombRightOut' => esc_html__("bombRightOut", "wpmp"),
                            'bombLeftOut' => esc_html__("bombLeftOut", "wpmp"),
                            'boingInUp' => esc_html__("boingInUp", "wpmp"),
                            'boingOutDown' => esc_html__("boingOutDown", "wpmp"),
                            'spaceOutUp' => esc_html__("spaceOutUp", "wpmp"),
                            'spaceOutRight' => esc_html__("spaceOutRight", "wpmp"),
                            'spaceOutDown' => esc_html__("spaceOutDown", "wpmp"),
                            'spaceOutLeft' => esc_html__("spaceOutLeft", "wpmp"),
                            'spaceInUp' => esc_html__("spaceInUp", "wpmp"),
                            'spaceInRight' => esc_html__("spaceInRight", "wpmp"),
                            'spaceInDown' => esc_html__("spaceInDown", "wpmp"),
                            'spaceInLeft' => esc_html__("spaceInLeft", "wpmp")
                        ],
                    ]
                );
                $element->add_control(
                    'wpmp_custom_class',
                    [
                        'label' => __( 'Custom Class', 'wpmp' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( '', 'wpmp' ),
                        'placeholder' => __( 'Enter your class css', 'wpmp' ),
                    ]
                );

                $element->add_control(
                    'wpmp_debug',
                    [
                        'label' => __( 'Enable Debug', 'wpmp' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __( 'On', 'wpmp' ),
                        'label_off' => __( 'Off', 'wpmp' ),
                        'return_value' => 'yes',
                        'default' => '',
                    ]
                );

                $element->end_controls_section();
            }
        }

        function add_scroll_magic_default( $element, $section_id, $args ) {
            if ( 'section_scrollmagic_control' === $section_id  ) {
                $element->start_controls_section(
                    'section_scrollmagic_default',
                    [
                        'tab' => Controls_Manager::TAB_STYLE,
                        'label' => __( 'Scroll Magic default', 'wpmp' ),
                    ]
                );
                $element->add_control(
                    'wpmp-def_width',
                    [
                        'label' => __( 'Wight', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 1,
                        'default' => "",
                    ]
                );
                $element->add_control(
                    'wpmp-def_height',
                    [
                        'label' => __( 'Height', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 1,
                        'default' => "",
                    ]
                );
                $element->add_control(
                    'wpmp-def_opacity',
                    [
                        'label' => __( 'Opacity', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 0.1,'min' => 0,'max' => 1,
                        'default' => "",
                    ]
                );
                $element->add_control(
                    'wpmp-def_color',
                    [
                        'label' => __( 'Color', 'wpmp' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .title' => 'color: {{VALUE}}',
                        ],
                    ]
                );
                $element->add_control(
                    'wpmp-def_background-color',
                    [
                        'label' => __( 'Background Color', 'wpmp' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .title' => 'color: {{VALUE}}',
                        ],
                    ]
                );
                $element->add_control(
                    'wpmp-def_display',
                    [
                        'label' => __( 'Display', 'wpmp' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            'block'  => __( 'Block', 'wpmp' ),
                            'inline' => __( 'Inline', 'wpmp' ),
                            'inline-block' => __( 'Inline-block', 'wpmp' ),
                            'none' => __( 'None', 'wpmp' ),
                            'flex' => __( 'Flex', 'wpmp' ),
                            'inline-flex'  => __( 'Inline-flex', 'wpmp' ),
                            'inherit' => __( 'Inherit', 'wpmp' ),
                            'initial' => __( 'Initial', 'wpmp' ),
                        ],
                    ]
                );
                // HR tranfom
                $element->add_control(
                    'hr',
                    [
                        'type' => Controls_Manager::DIVIDER,
                    ]
                );

                $element->add_control(
                    'wpmp-def_transform-origin',
                    [
                        'label' => __( 'Transform Origin', 'wpmp' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            'top left'  => __( 'Top Left', 'wpmp' ),
                            'top center' => __( 'Top Center', 'wpmp' ),
                            'top right' => __( 'Top Right', 'wpmp' ),
                            'center left' => __( 'Middle Left', 'wpmp' ),
                            'center center' => __( 'Middle Center', 'wpmp' ),
                            'center right' => __( 'Middle Right', 'wpmp' ),
                            'bottom left' => __( 'Bottom Lef', 'wpmp' ),
                            'bottom center' => __( 'Bottom Center', 'wpmp' ),
                            'bottom right' => __( 'Bottom Right', 'wpmp' ),
                        ],
                    ]
                );
                $element->add_control(
                    'wpmp-def_translateX',
                    [
                        'label' => __( 'Translate-X', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 1,
                        'default' => "",
                    ]
                );
                $element->add_control(
                    'wpmp-def_translateY',
                    [
                        'label' => __( 'Translate-Y', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 1,
                        'default' => "",
                    ]
                );
                $element->add_control(
                    'wpmp-def_translateZ',
                    [
                        'label' => __( 'Translate-Z', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 1,
                        'default' => "",
                    ]
                );
                $element->add_control(
                    'wpmp-def_scaleX',
                    [
                        'label' => __( 'Scale-X', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 0,2,
                        'default' => "",
                    ]
                );
                $element->add_control(
                    'wpmp-def_scaleY',
                    [
                        'label' => __( 'Scale-Y', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 0,2,
                        'default' => "",
                    ]
                );
                $element->add_control(
                    'wpmp-def_scaleZ',
                    [
                        'label' => __( 'Scale-Z', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 0,2,
                        'default' => "",
                    ]
                );
                $element->add_control(
                    'wpmp-def_rotateX',
                    [
                        'label' => __( 'Rotate-X', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 0,2,
                        'default' => "",
                    ]
                );
                $element->add_control(
                    'wpmp-def_rotateY',
                    [
                        'label' => __( 'Rotate-Y', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 0,2,
                        'default' => "",
                    ]
                );
                $element->add_control(
                    'wpmp-def_rotateZ',
                    [
                        'label' => __( 'Rotate-Z', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 1,
                        'default' => "",
                    ]
                );
                $element->add_control(
                    'wpmp-def_skewX',
                    [
                        'label' => __( 'Skew-Y', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 1,
                        'default' => "",
                    ]
                );
                $element->add_control(
                    'wpmp-def_skewY',
                    [
                        'label' => __( 'Skew-Z', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 1,
                        'default' => "",
                    ]
                );

                $element->end_controls_section();
            }
        }

        function add_scroll_magic_effect( $element, $section_id, $args ) {
            if ( 'section_scrollmagic_control' === $section_id  ) {
                $element->start_controls_section(
                    'section_scrollmagic_effect',
                    [
                        'tab' => Controls_Manager::TAB_STYLE,
                        'label' => __( 'Scroll Magic effect', 'wpmp' ),
                    ]
                );
                $repeater_e = new Repeater();
                $repeater_e->add_control(
                    'title_effect',
                    [
                        'label' => __( 'Title', 'wpmp' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Scenes', 'wpmp' ),
                        'placeholder' => __( 'Enter Scenes title', 'wpmp' ),
                    ]
                );
                $repeater_e->add_control(
                    'wpmp_duration',
                    [
                        'label' => __( 'Duration', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 1,
                        'default' => "1",
                    ]
                );
                $repeater_e->add_control(
                    'wpmp_ease',
                    [
                        'label' => __( 'Ease', 'wpmp' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'Power0.easeNone',
                        'options' => [
                            'Power0.easeNone' => esc_html__("Power0.easeNone", "wpmp"),
                            'Power1.easeIn' => esc_html__("Power1.easeIn", "wpmp"),
                            'Power1.easeInOut' => esc_html__("Power1.easeInOut", "wpmp"),
                            'Power1.easeOut' => esc_html__("Power1.easeOut", "wpmp"),
                            'Power2.easeIn' => esc_html__("Power2.easeIn", "wpmp"),
                            'Power2.easeInOut' => esc_html__("Power2.easeInOut", "wpmp"),
                            'Power2.easeOut' => esc_html__("Power2.easeOut", "wpmp"),
                            'Power3.easeIn' => esc_html__("Power3.easeIn", "wpmp"),
                            'Power3.easeInOut' => esc_html__("Power3.easeInOut", "wpmp"),
                            'Power3.easeOut' => esc_html__("Power3.easeOut", "wpmp"),
                            'Power4.easeIn' => esc_html__("Power4.easeIn", "wpmp"),
                            'Power4.easeInOut' => esc_html__("Power4.easeInOut", "wpmp"),
                            'Power4.easeOut' => esc_html__("Power4.easeOut", "wpmp"),
                            'Back.easeIn.config(1.7)' => esc_html__("Back.easeIn", "wpmp"),
                            'Back.easeInOut.config(1.7)' => esc_html__("Back.easeInOut", "wpmp"),
                            'Back.easeOut.config(1.7)' => esc_html__("Back.easeOut.config", "wpmp"),
                            'Elastic.easeIn.config(1,0.3)' => esc_html__("Elastic.easeIn.config", "wpmp"),
                            'Elastic.easeInOut.config(1,0.3)' => esc_html__("Elastic.easeInOut.config(1, 0.3)", "wpmp"),
                            'Elastic.easeOut.config(1,0.3)' => esc_html__("Elastic.easeOut.config", "wpmp"),
                            'Bounce.easeIn' => esc_html__("Bounce.easeIn", "wpmp"),
                            'Bounce.easeInOut' => esc_html__("Bounce.easeInOut", "wpmp"),
                            'SlowMo.ease.config(0.7,0.7,false)' => esc_html__("SlowMo", "wpmp"),
                            'SteppedEase.config(12)' => esc_html__("Stepped", "wpmp"),
                            'Circ.easeIn' => esc_html__("Circ.easeIn", "wpmp"),
                            'Circ.easeInOut' => esc_html__("Circ.easeInOut", "wpmp"),
                            'Circ.easeOut' => esc_html__("Circ.easeOut", "wpmp"),
                            'Expo.easeIn' => esc_html__("Expo.easeIn", "wpmp"),
                            'Expo.easeInOut' => esc_html__("Expo.easeInOut", "wpmp"),
                            'Expo.easeOut' => esc_html__("Expo.easeOut", "wpmp"),
                            'Sine.easeIn' => esc_html__("Sine.easeIn", "wpmp"),
                            'Sine.easeInOut' => esc_html__("Sine.easeInOut", "wpmp"),
                            'Sine.easeOut' => esc_html__("Sine.easeOut", "wpmp"),
                        ],
                    ]
                );
                $repeater_e->add_control(
                    'wpmp_width',
                    [
                        'label' => __( 'Wight', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 1,
                        'default' => "",
                    ]
                );
                $repeater_e->add_control(
                    'wpmp_height',
                    [
                        'label' => __( 'Height', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 1,
                        'default' => "",
                    ]
                );
                $repeater_e->add_control(
                    'wpmp_opacity',
                    [
                        'label' => __( 'Opacity', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 0.1,'min' => 0,'max' => 1,
                        'default' => 1,
                    ]
                );
                $repeater_e->add_control(
                    'wpmp_color',
                    [
                        'label' => __( 'Color', 'wpmp' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .title' => 'color: {{VALUE}}',
                        ],
                    ]
                );
                $repeater_e->add_control(
                    'wpmp_backgroundColor',
                    [
                        'label' => __( 'Background Color', 'wpmp' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .title' => 'color: {{VALUE}}',
                        ],
                    ]
                );
                $repeater_e->add_control(
                    'wpmp_display',
                    [
                        'label' => __( 'Display', 'wpmp' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'block',
                        'options' => [
                            'block'  => __( 'Block', 'wpmp' ),
                            'inline' => __( 'Inline', 'wpmp' ),
                            'inline-block' => __( 'Inline-block', 'wpmp' ),
                            'none' => __( 'None', 'wpmp' ),
                            'flex' => __( 'Flex', 'wpmp' ),
                            'inline-flex'  => __( 'Inline-flex', 'wpmp' ),
                            'inherit' => __( 'Inherit', 'wpmp' ),
                            'initial' => __( 'Initial', 'wpmp' ),
                        ],
                    ]
                );
                // HR tranfom
                $repeater_e->add_control(
                    'hr',
                    [
                        'type' => Controls_Manager::DIVIDER,
                    ]
                );
                $repeater_e->add_control(
                    'wpmp_transformOrigin',
                    [
                        'label' => __( 'Transform Origin', 'wpmp' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'top-left',
                        'options' => [
                            'top-left'  => __( 'Top Left', 'wpmp' ),
                            'top-center' => __( 'Top Center', 'wpmp' ),
                            'top-right' => __( 'Top Right', 'wpmp' ),
                            'center-left' => __( 'Middle Left', 'wpmp' ),
                            'center-center' => __( 'Middle Center', 'wpmp' ),
                            'center-right' => __( 'Middle Right', 'wpmp' ),
                            'bottom-left' => __( 'Bottom Lef', 'wpmp' ),
                            'bottom-center' => __( 'Bottom Center', 'wpmp' ),
                            'bottom-right' => __( 'Bottom Right', 'wpmp' ),
                        ],
                    ]
                );
                $repeater_e->add_control(
                    'wpmp_translateX',
                    [
                        'label' => __( 'Translate-X', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 1,
                        'default' => "",
                    ]
                );
                $repeater_e->add_control(
                    'wpmp_translateY',
                    [
                        'label' => __( 'Translate-Y', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 1,
                        'default' => "",
                    ]
                );
                $repeater_e->add_control(
                    'wpmp_translateZ',
                    [
                        'label' => __( 'Translate-Z', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 1,
                        'default' => "",
                    ]
                );
                $repeater_e->add_control(
                    'wpmp_scaleX',
                    [
                        'label' => __( 'Scale-X', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 0,2,
                        'default' => "",
                    ]
                );
                $repeater_e->add_control(
                    'wpmp_scaleY',
                    [
                        'label' => __( 'Scale-Y', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 0,2,
                        'default' => "",
                    ]
                );
                $repeater_e->add_control(
                    'wpmp_scaleZ',
                    [
                        'label' => __( 'Scale-Z', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 0,2,
                        'default' => "",
                    ]
                );
                $repeater_e->add_control(
                    'wpmp_rotateX',
                    [
                        'label' => __( 'Rotate-X', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 0,2,
                        'default' => "",
                    ]
                );
                $repeater_e->add_control(
                    'wpmp_rotateY',
                    [
                        'label' => __( 'Rotate-Y', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 0,2,
                        'default' => "",
                    ]
                );
                $repeater_e->add_control(
                    'wpmp_rotateZ',
                    [
                        'label' => __( 'Rotate-Z', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 1,
                        'default' => "",
                    ]
                );
                $repeater_e->add_control(
                    'wpmp_skewX',
                    [
                        'label' => __( 'Skew-Y', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 1,
                        'default' => "",
                    ]
                );
                $repeater_e->add_control(
                    'wpmp_skewY',
                    [
                        'label' => __( 'Skew-Z', 'wpmp' ),
                        'type' => Controls_Manager::NUMBER,
                        'step' => 1,
                        'default' => "",
                    ]
                );
                $repeater_e->add_control(
                    'hr2',
                    [
                        'type' => Controls_Manager::DIVIDER,
                    ]
                );
                $repeater_e->add_control(
                    'wpmp_yoyo',
                    [
                        'label' => __( 'Set yoyo', 'wpmp' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __( 'On', 'wpmp' ),
                        'label_off' => __( 'Off', 'wpmp' ),
                        'return_value' => 'yes',
                        'default' => '',
                    ]
                );
                $repeater_e->add_control(
                    'wpmp_repeat',
                    [
                    'type' => Controls_Manager::NUMBER,
                    'label' => __( 'Repeat effect', 'wpmp' ),
                    'step' => '1',
                    'default' => '0'
                    ]
                );
                $element->add_control(
                    'wpmp_list_scenes',
                    [
                        'label' => __( 'Scenes', 'wpmp' ),
                        'type' => Controls_Manager::REPEATER,
                        'fields' => $repeater_e->get_controls(),
                        'default' => [],
                        'title_field' => '{{{title_effect}}}',
                    ]
                );

                $element->end_controls_section();
            }
        }


    }

    new Wpmp_add_section();

}