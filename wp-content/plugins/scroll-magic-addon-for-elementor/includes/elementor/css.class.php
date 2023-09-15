<?php

use Elementor\Controls_Manager;
use Elementor\Element_Base;
use Elementor\Core\Files\CSS\Post;
use Elementor\Core\DynamicTags\Dynamic_CSS;

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}
if(defined('ELEMENTOR_PRO_VERSION')){
	return;
}

class Prefix_Custom_Css {
	/**
	 * Add Action hook
	 */
	public function __construct() {
		add_action('elementor/element/parse_css', [$this, 'add_post_css'], 10, 2);
		add_action( 'elementor/editor/after_enqueue_scripts', [$this, 'enqueue_editor_scripts']);
	}
	/**
	 * @param $post_css Post
	 * @param $element  Element_Base
	 */
	public function add_post_css($post_css, $element) {
		if ($post_css instanceof Dynamic_CSS) {
			return;
		}
		$element_settings  = $element->get_settings();
		$default_css = '{';
		$transform_css = 'transform:';
		$group1 = ['width','height',];
		$group2 = ['background-color','color','opacity','display','transform-origin'];
		$group3 = ['rotateX','rotateY','rotateZ','skewY','skewX'];
		$group4 = ['translateX','translateY','translateZ'];
		foreach( $element_settings as $key => $value ){
			if(empty($value) && $value !==0 ){
			}else{
				if( strpos( $key,"wpmp-def_") > -1 ){
					$key = str_replace("wpmp-def_",'',$key);
					if(in_array($key,$group1)){
						$default_css .= $key.':'.$value.'px;';
					}elseif(in_array($key,$group2)){
						$default_css .= $key.':'.$value.';';
					}elseif(in_array($key,$group3)){
						$transform_css  .= $key.'('.$value.'deg)';
					}elseif(in_array($key,$group4)){
						$transform_css  .= $key.'('.$value.'px)';
					}else{
						$transform_css  .= $key.'('.$value.')';
					}
				}
			}
		}
		if($transform_css != 'transform:'){
			$default_css .=$transform_css .";";
		}

		if($default_css == '{'){
			return;
		}else{
			$default_css .=	'}';
			$default_css =	$post_css->get_element_unique_selector($element).' .elementor-widget-container > *:not(.scrollMagicControl):not(.scrollmagic-pin-spacer),'.$post_css->get_element_unique_selector($element).' .elementor-widget-container .scrollmagic-pin-spacer > *'.$default_css;
		}

		$post_css->get_stylesheet()->add_raw_css( $default_css );

	}

	public function enqueue_editor_scripts() {
		wp_enqueue_script('prefix-editor-support-js', WPMP_SMG_ELE_URL.'/assets/public/js/edittor-shupport.js', array('jquery'), WPMP_SMG_ELE_VERSION, true);
	}

}
new Prefix_Custom_Css();