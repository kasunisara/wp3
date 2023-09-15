<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; 

class Scroll_magic_draw_svg extends Widget_Base
{

    public function get_name()
    {
        return 'scroll_magic_draw_svg';
    }

    public function get_title()
    {
        return esc_html__('SVG Draw', 'wpmp');
    }

    public function get_icon()
    {
        return 'fa fa-diamond';
    }

    public function get_categories()
    {
        return ['basic',WPMP_CATEGORY];
    }


    protected function _register_controls()
    {

		// Content Controls
        $this->start_controls_section(
            'ELdrawSvg',
            [
                'label' => esc_html__('General', 'wpmp')
            ]
        );

        $this->add_control(
			'svg',
			[
				'label' => __( 'svg', 'wpmp' ),
				'type' => \Elementor\Controls_Manager::CODE,
				'language' => 'html',
				'rows' => 40,
				'default' => '<svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
								x="0px" y="0px" width="570px" height="150px" viewBox="0 0 570 150" xml:space="preserve">
								<circle fill="none" cx="71.5" cy="77.5" r="51.5" stroke="#88CE02" stroke-width="4"/>
								<ellipse fill="none" stroke="#88CE02" stroke-width="4" stroke-miterlimit="10" cx="241.4" cy="77.5" rx="78.9" ry="51.5"/>
								<rect x="354" y="26" fill="none" stroke="#88CE02" stroke-linecap="square" stroke-width="4" stroke-miterlimit="30" width="103" height="103" id="rect" />
								<polyline class="hu123" fill="none" stroke="#88CE02" stroke-width="4" stroke-miterlimit="10" points="536.1,129 487.3,74.2 536.1,26 "/>
							</svg>',
			]
		);

        $this->add_control(
			'wpmp_draw_from',
			[
				'label' => __( 'Draw from (%)', 'wpmp' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 0,
			]
        );
        
        $this->add_control(
			'wpmp_draw_to',
			[
				'label' => __( 'Draw to (%)', 'wpmp' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 100,
			]
        );
        $this->end_controls_section();

    }

    protected function render(){   
		$settings = $this->get_settings_for_display();
		echo '<div class="scrollmagic-ele drawsvg">'.$settings['svg'].'</div>';
    }

    protected function _content_template(){
        ?>
		<div class="scrollmagic-ele drawsvg">
			{{{ settings.svg }}}
		</div>
		<?php
    }

}
Plugin::instance()->widgets_manager->register_widget_type(new Scroll_magic_draw_svg());
