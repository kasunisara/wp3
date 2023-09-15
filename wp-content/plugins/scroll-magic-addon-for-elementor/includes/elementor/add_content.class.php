<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Wpmp_add_content' ) ) {
    
    
    class Wpmp_add_content{

        public function __construct(){
            add_action( 'elementor/widget/render_content',[$this,'render_content'], 10, 2 );
        }

        function render_content( $content, $widget ) {

            $settings = $widget->get_settings();
            $attr = "";
            $split_text = 'split-text = {';
            foreach ($settings as $key => $setting ) {
                if( strpos( $key,"wpmp") > -1 && 'wpmp_all_url'!==$key){
                    if('wpmp_list_scenes'==$key){
                        $attr.= 'effect = {';
                        foreach ( $setting as $key2 => $setting2 ){
                            
                            $attr.=  "'".$key2."':{";
                            $transform = "'transform':'";
                            foreach ( $setting2 as $key3 => $setting3 ){
                               
                                if('_id'==$key3 || 'title_effect'==$key3 ||( empty($setting3)&& $setting3!==0) ){
                                }elseif(in_array($key3, ['wpmp_translateX','wpmp_translateY','wpmp_translateZ'] )){
                                    $transform .= $key3."(".$setting3."px)";
                                }elseif(in_array($key3, ['wpmp_scaleX','wpmp_scaleY','wpmp_scaleZ'] )){
                                    $transform .= $key3."(".$setting3.")";
                                }elseif(in_array($key3, ['wpmp_rotateX','wpmp_rotateY','wpmp_rotateZ','wpmp_skewX','wpmp_skewY'] )){
                                    $transform .= $key3."(".$setting3."deg)";
                                }else{
                                    $attr.="'".$key3."':'".$setting3."',";
                                }

                            }
                            $transform .= "',";
                            
                            $attr.= $transform.'},';
                        }
                        $attr.= '} ';
                    }elseif( strpos( $key,"wpmp-splittext_") > -1 && ( !empty( $setting ) || $setting === 0) ){
                        $split_text .="'".$key."':'".$setting."',";
                    }else{
                        $attr .= $setting? $key.'="'.$setting.'" ':"";
                    }
                }
            }
            $attr .= $split_text."}";
            $content = '<span id="scroll'.uniqid().'"  class="scrollMagicControl" type="hidden" '.$attr.' value="scrollmagic"></span>'. $content;
            
            return $content;

        }

    } 

    new Wpmp_add_content();
}