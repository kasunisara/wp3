<?php
namespace Elementor;
use Elementor\Core\Schemes;

if (!defined('ABSPATH')) exit; 

class Scroll_magic_split_text extends Widget_Base
{

    public function get_name()
    {
        return 'scroll_magic_split_text';
    }

    public function get_title()
    {
        return esc_html__('Split Text 3', 'wpmp');
    }

    public function get_icon()
    {
        return 'fa fa-font';
    }

    public function get_categories()
    {
        return ['basic',WPMP_CATEGORY];
    }


    protected function _register_controls() {
		$this->start_controls_section(
			'section_editor',
			[
				'label' => __( 'Text Editor', 'elementor' ),
			]
		);

		$this->add_control(
			'editor',
			[
				'label' => '',
				'type' => Controls_Manager::WYSIWYG,
				'default' => '<p>' . __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ) . '</p>',
			]
		);
		$this->add_control(
			'wpmp-splittext_opacity',
			[
				'label' => __( 'Opacity', 'wpmp' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'step' => 0.1,'min' => 0,'max' => 1,
				'default' => 0,
			]
		);
		$this->add_control(
			'wpmp-splittext_transformOrigin',
			[
				'label' => __( 'Transform Origin', 'wpmp' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
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
		$this->add_control(
			'wpmp-splittext_translateX',
			[
				'label' => __( 'Translate-X', 'wpmp' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'step' => 1,
				'default' => "",
			]
		);
		$this->add_control(
			'wpmp-splittext_translateY',
			[
				'label' => __( 'Translate-Y', 'wpmp' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'step' => 1,
				'default' => "",
			]
		);
		$this->add_control(
			'wpmp-splittext_translateZ',
			[
				'label' => __( 'Translate-Z', 'wpmp' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'step' => 1,
				'default' => "",
			]
		);
		$this->add_control(
			'wpmp-splittext_scale',
			[
				'label' => __( 'Scale', 'wpmp' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'step' => 0,2,
				'default' => "",
			]
		);
		$this->add_control(
			'wpmp-splittext_rotateX',
			[
				'label' => __( 'Rotate-X', 'wpmp' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'step' => 0,2,
				'default' => "",
			]
		);
		$this->add_control(
			'wpmp-splittext_rotateY',
			[
				'label' => __( 'Rotate-Y', 'wpmp' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'step' => 0,2,
				'default' => "",
			]
		);
		$this->add_control(
			'wpmp-splittext_rotateZ',
			[
				'label' => __( 'Rotate-Z', 'wpmp' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'step' => 1,
				'default' => "",
			]
		);
		$this->add_control(
			'wpmp-splittext_skewX',
			[
				'label' => __( 'Skew-Y', 'wpmp' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'step' => 1,
				'default' => "",
			]
		);
		$this->add_control(
			'wpmp-splittext_skewY',
			[
				'label' => __( 'Skew-Z', 'wpmp' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'step' => 1,
				'default' => "",
			]
		);
		$this->add_control(
			'wpmp-splittext_stagger',
			[
				'label' => __( 'Stagger', 'wpmp' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'step' => 0.01,'min' => 0.01,
				'default' => 0.01,
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Text Editor', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-text-editor' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'scheme' => Schemes\Typography::TYPOGRAPHY_3,
			]
		);

		$text_columns = range( 1, 10 );
		$text_columns = array_combine( $text_columns, $text_columns );
		$text_columns[''] = __( 'Default', 'elementor' );

		$this->add_responsive_control(
			'text_columns',
			[
				'label' => __( 'Columns', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'separator' => 'before',
				'options' => $text_columns,
				'selectors' => [
					'{{WRAPPER}} .elementor-text-editor' => 'columns: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'column_gap',
			[
				'label' => __( 'Columns Gap', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'vw' ],
				'range' => [
					'px' => [
						'max' => 100,
					],
					'%' => [
						'max' => 10,
						'step' => 0.1,
					],
					'vw' => [
						'max' => 10,
						'step' => 0.1,
					],
					'em' => [
						'max' => 10,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-text-editor' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

	}

	/**
	 * Render text editor widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$editor_content = $this->get_settings_for_display( 'editor' );

		$editor_content = $this->parse_text_editor( $editor_content );

		$this->add_render_attribute( 'editor', 'class', [ 'elementor-text-editor', 'elementor-clearfix' ,'scrollmagic-ele','splitText' ] );

		$this->add_inline_editing_attributes( 'editor', 'advanced' );
		?>
		<div <?php echo $this->get_render_attribute_string( 'editor' ); ?>><?php echo $editor_content; ?></div>
		<?php
	}

	/**
	 * Render text editor widget as plain content.
	 *
	 * Override the default behavior by printing the content without rendering it.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function render_plain_content() {
		// In plain mode, render without shortcode
		echo $this->get_settings( 'editor' );
	}

	/**
	 * Render text editor widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template() {
		?>
		<#
		view.addRenderAttribute( 'editor', 'class', [ 'elementor-text-editor', 'elementor-clearfix' ] );

		view.addInlineEditingAttributes( 'editor', 'advanced' );
		#>
		<div {{{ view.getRenderAttributeString( 'editor' ) }}}>{{{ settings.editor }}}</div>
		<?php
	}

}
Plugin::instance()->widgets_manager->register_widget_type(new Scroll_magic_split_text());
