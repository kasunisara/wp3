<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; 

class Scroll_magic_image_sequence extends Widget_Base
{

    public function get_name()
    {
        return 'scroll_magic_image_sequence';
    }

    public function get_title()
    {
        return esc_html__('Image Sequence', 'wpmp');
    }

    public function get_icon()
    {
        return 'fa fa-clone';
    }

    public function get_categories()
    {
        return ['basic',WPMP_CATEGORY];
    }


    protected function _register_controls()
    {

		// Content Controls
        $this->start_controls_section(
            'ElSequenceImg',
            [
                'label' => esc_html__('General', 'wpmp')
            ]
        );

        $this->add_control(
			'wpmp_all_url',
			[
				'label' => __( 'Add Images', 'wpmp' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'default' => [
					[
						'url' => WPMP_SMG_ELE_URL.'public/imgs/placeholder.png'
					],
				],
			]
		);
		$this->add_control(
			'wpmp_repeat_sequence_img',
			[
				'label' => __( 'Repeat', 'wpmp' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'step' => 1,
				'default' => 0,
			]
		);
		$this->end_controls_section();

	}

	protected function render() {
		
		$settings = $this->get_settings_for_display();

		$all_Url =  array_map(function($value){return $value['url'];},$settings['wpmp_all_url']);

		$all_Url = implode(",", $all_Url);
		echo '<div class="scrollmagic-ele imageSequence">';
		echo '<img class="wpmp_image_sequence" src="' . $settings['wpmp_all_url'][0]['url'] . '" wpmp_repeat_sequence_img="' . $settings['wpmp_repeat_sequence_img'] . '" data-src="'.$all_Url.'" >';
		echo '</div>';
	}

	protected function _content_template() {
	?>	
		<# if( settings.wpmp_all_url[0] ) { #>
			<img src="{{ settings.wpmp_all_url[0].url }}">
		<# }; #>
	<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type(new Scroll_magic_image_sequence());
