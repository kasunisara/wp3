<?php

use  Carbon_Fields\Container ;
use  Carbon_Fields\Field ;
//use Carbon_Fields\Block; //not at the moment
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.scrollsequence.com
 * @since      0.7.0
 *
 * @package    Scrollsequence
 * @subpackage Scrollsequence/admin
 */
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Scrollsequence
 * @subpackage Scrollsequence/admin
 * @author     Scrollsequence <info@scrollsequence.com>
 */
class Scrollsequence_Admin
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
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version )
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        add_shortcode( 'scrollsequence', array( $this, 'scrollsequence_shortcode' ) );
    }
    
    /**
     * Register the stylesheets for the admin area.
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
        // Ak: I want to add an IF statement to enqueue scripts only to my CPT
        global  $post_type ;
        if ( 'scrollsequence' == $post_type ) {
            wp_enqueue_style(
                $this->plugin_name,
                plugin_dir_url( __FILE__ ) . 'css/scrollsequence-admin.css',
                array(),
                $this->version,
                'all'
            );
        }
        // Ak: end
    }
    
    /**
     * Register the JavaScript for the admin area.
     *
     * @since    0.7.0
     */
    public function enqueue_scripts()
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
        // Ak: I want to add an IF statement to enqueue scripts only to my CPT
        global  $post_type ;
        global  $pagenow ;
        if ( 'scrollsequence' == $post_type && ('post-new.php' === $pagenow || 'post.php' === $pagenow) ) {
            // Free
            wp_enqueue_script(
                $this->plugin_name,
                plugin_dir_url( __FILE__ ) . 'js/scrollsequence-admin.js',
                array( 'jquery' ),
                $this->version,
                true
            );
        }
        // Ak: end
    }
    
    /**
     * Register Scrollsequence CPT .
     *
     * @since    0.7.0
     */
    public function scrollsequence_cpt()
    {
        require_once "create-cpt.php";
    }
    
    /**
     * Register Scrollsequence CPT .
     *
     * @since    0.7.3
     */
    public function scrollsequence_cpt_submenu()
    {
        add_submenu_page(
            'edit.php?post_type=scrollsequence',
            /*parent_slug*/
            'Dashboard Scrollsequence',
            /*page title*/
            'Dashboard',
            /*menu title*/
            'edit_posts',
            /*roles and capability needed*/
            // Update 0.9.93
            'scrollsequence-dashboard',
            /*menu slug*/
            'scrollsequence_cpt_dashboard_callback'
        );
        function scrollsequence_cpt_dashboard_callback()
        {
            require_once "partials/scrollsequence-admin-display.php";
        }
    
    }
    
    /**
     * Single file custom template for scrollsequence. I am following this: 
     *  https://code.tutsplus.com/tutorials/a-guide-to-wordpress-custom-post-types-creation-display-and-meta-boxes--wp-27645
     * ref "tutsplus" in class-scrollsequence add action thing
     * @since 0.7.0
     * @uses i dont know
     * Step 1 https://blog.wplauncher.com/add-meta-box-wordpress-custom-post-type/
     */
    public function scrollsequence_template( $template_path )
    {
        if ( get_post_type() == 'scrollsequence' ) {
            if ( is_single() ) {
                // checks if the file exists in the theme first,
                // otherwise serve the file from the plugin
                
                if ( $theme_file = locate_template( array( 'single-scrollsequence.php' ) ) ) {
                    $template_path = $theme_file;
                } else {
                    $template_path = plugin_dir_path( __DIR__ ) . 'public/partials/single-scrollsequence.php';
                }
            
            }
        }
        return $template_path;
    }
    
    /**
     * Carbon Fields Boot function. This function boots up carbon fields.
     * 
     * @since    0.9.8
     */
    public function scrollsequence_carbon_fields_load()
    {
        require_once __DIR__ . '/../includes/carbonfields/autoload.php';
        \Carbon_Fields\Carbon_Fields::boot();
    }
    
    /**
     * Carbon Fields Main Function (Scrollsequence CPT)
     * 
     * @since    0.9.8
     */
    public function scrollsequence_carbon_fields_cpt()
    {
        /* TRANSLATION IS MISSING FOR STRINGS BELOW */
        $scrollsequence_advert_html = '<h4>Full animation settings are available in <a href=' . admin_url( "admin.php?page=scrollsequence-pricing" ) . '>Scrollsequence PRO</a>.</h4><strong>NEW: </strong>We offer <a href=' . admin_url( "admin.php?page=scrollsequence-pricing&trial=true" ) . '>14 days FREE trial</a> - no card required, no risk. ';
        $scrollsequence_left_center_right = '
		<div style="float: left">' . __( 'Left', 'scrollsequence' ) . '</div>
		<div style="float: right">' . __( 'Right', 'scrollsequence' ) . '</div>
		<div style="margin: 0 auto; width: 100px;"></div>
		';
        $scrollsequence_bottom_center_top = '
		<div style="float: left">' . __( 'Top', 'scrollsequence' ) . '</div>
		<div style="float: right">' . __( 'Bottom', 'scrollsequence' ) . '</div>
		<div style="margin: 0 auto; width: 100px;"></div>
		';
        $scrollsequence_trigger_start = '
		<div style="float: left">' . __( 'Start Sooner', 'scrollsequence' ) . '</div>
		<div style="float: right">' . __( 'Default', 'scrollsequence' ) . '</div>
		<div style="margin: 0 auto; width: 100px;"></div>
		';
        $scrollsequence_trigger_end = '
		<div style="float: left">' . __( 'Default', 'scrollsequence' ) . '</div>
		<div style="float: right">' . __( 'End Later', 'scrollsequence' ) . '</div>
		<div style="margin: 0 auto; width: 100px;"></div>
		';
        /* TRANSLATION IS MISSING FOR STRINGS BELOW */
        $scrollsequence_aglignmentadv = '<p>More Scale and Alignment settings are available in <a href=' . admin_url( "admin.php?page=scrollsequence-pricing" ) . '>Scrollsequence PRO</a>. </p><p><strong>NEW: </strong>We offer <a href=' . admin_url( "admin.php?page=scrollsequence-pricing&trial=true" ) . '>14 days FREE trial</a> - no card required, no risk.</p>';
        $scrollsequence_condition_need_images = array(
            'relation' => 'AND',
            array(
            'field'   => 'scrollsequence_p_images',
            'value'   => '',
            'compare' => '!=',
        ),
        );
        // FREE VERSION
        Container::make( 'post_meta', 'Scrollsequence' )->where( 'post_type', '=', 'scrollsequence' )->set_context( 'carbon_fields_after_title' )->add_fields( array( Field::make( 'complex', 'scrollsequence_page', __( 'Scene', 'scrollsequence' ) )->setup_labels( array(
            'plural_name'   => __( 'Scenes', 'scrollsequence' ),
            'singular_name' => __( 'Scene', 'scrollsequence' ),
        ) )->set_layout( 'tabbed-horizontal' )->set_required( true )->set_max( 3 )->add_fields( array(
            Field::make( 'rich_text', 'scrollsequence_p_wysiwyg', __( 'Fixed Content', 'scrollsequence' ) )->set_conditional_logic( $scrollsequence_condition_need_images )->set_default_value( '<div class="ssq-center-center"><h1 id="on-earth">' . __( 'Another day on Earth', 'scrollsequence' ) . '</h1></div>' ),
            Field::make( 'media_gallery', 'scrollsequence_p_images', __( 'Image Sequence', 'scrollsequence' ) )->set_type( array( 'image' ) )->set_required( true )->set_duplicates_allowed( true )->set_classes( 'scrollsequence-custom-class' ),
            Field::make( 'complex', 'ssqnce_anim', __( 'Fixed Content Animation', 'scrollsequence' ) )->set_conditional_logic( $scrollsequence_condition_need_images )->set_layout( 'tabbed-vertical' )->setup_labels( array(
                'plural_name'   => __( 'Animations', 'scrollsequence' ),
                'singular_name' => __( 'Animation', 'scrollsequence' ),
            ) )->add_fields( 'ssqnce_anim_io', 'Animate From/To', array(
                Field::make( 'text', 'ssqnce_anim_io_id', __( 'Selector', 'scrollsequence' ) )->set_width( 20 )->set_required( true )->set_help_text( __( 'Enter #id or .class selector', 'scrollsequence' ) ),
                Field::make( 'text', 'ssqnce_anim_io_start', __( 'Start', 'scrollsequence' ) )->set_width( 20 )->set_required( true )->set_help_text( __( 'Enter image number where element becomes visible', 'scrollsequence' ) )->set_attribute( 'type', 'number' )->set_attribute( 'min', '0' )->set_attribute( 'step', '1' ),
                Field::make( 'text', 'ssqnce_anim_io_end', __( 'End', 'scrollsequence' ) )->set_width( 20 )->set_required( true )->set_help_text( __( 'Enter image number where element is hidden', 'scrollsequence' ) )->set_attribute( 'type', 'number' )->set_attribute( 'min', '0' )->set_attribute( 'step', '1' ),
                // Free advert
                Field::make( 'separator', 'scrollsequence_advert', __( 'Animation Settings Not Available in Free Version', 'scrollsequence' ) )->set_help_text( $scrollsequence_advert_html ),
            ) )->set_header_template( __( 'Animation', 'scrollsequence' ) . '
						    <% if (ssqnce_anim_io_id) { %>
						         - <%- ssqnce_anim_io_id %>  
						    <% } %> 
						' ),
            // PRO ONLY END1
            // Field::make( 'text', 'scrollsequence_p_duration', __( 'Page Height (vh)' ) )
            // 	->set_conditional_logic($scrollsequence_condition_need_images)
            // 	->set_attribute( 'type', 'number' )
            // 	->set_required( true )
            // 	->set_default_value('200')
            // 				->set_attribute( 'min', '20' )
            //  			->set_attribute( 'max', '2000' )
            //  			->set_attribute( 'step', '1' )
            //  			->help_text('This sets the amount of scroll needed to get past this page.'),
            Field::make( 'text', 'scrollsequence_p_imgdur', __( 'Image Duration (px)', 'scrollsequence' ) )->set_conditional_logic( $scrollsequence_condition_need_images )->set_attribute( 'type', 'number' )->set_required( true )->set_default_value( '25' )->set_attribute( 'min', '5' )->set_attribute( 'max', '500' )->set_attribute( 'step', '1' )->help_text( __( 'This sets how far the images are apart.', 'scrollsequence' ) ),
            // PANORAMA (MOBILE)
            Field::make( 'html', 'scrollsequence_info_html_panorama' )->set_conditional_logic( $scrollsequence_condition_need_images )->set_html( '<h3>' . __( 'Image Scale and Alignment', 'scrollsequence' ) . '</h3>' ),
            Field::make( 'select', 'scrollsequence_p_scaleto_mobile', __( 'Portrait (Mobile)', 'scrollsequence' ) )->set_conditional_logic( $scrollsequence_condition_need_images )->set_width( 30 )->set_default_value( 'fill' )->set_options( array(
                'fill' => __( 'Scale to fill', 'scrollsequence' ),
                'fit'  => __( 'Scale to fit', 'scrollsequence' ) . ' 100%',
                '0.5'  => __( 'Scale to fit', 'scrollsequence' ) . ' 50%',
            ) ),
            Field::make( 'text', 'scrollsequence_p_alignx_mobile', __( 'Horizontal Align', 'scrollsequence' ) )->set_conditional_logic( $scrollsequence_condition_need_images )->set_help_text( $scrollsequence_left_center_right )->set_width( 35 )->set_attribute( 'type', 'range' )->set_classes( 'ssq-range-slider' )->set_default_value( '0.5' )->set_attribute( 'min', '0' )->set_attribute( 'max', '1' )->set_attribute( 'step', '0.5' ),
            // ROADM
            Field::make( 'text', 'scrollsequence_p_aligny_mobile', __( 'Vertical Align', 'scrollsequence' ) )->set_conditional_logic( $scrollsequence_condition_need_images )->set_help_text( $scrollsequence_bottom_center_top )->set_width( 35 )->set_attribute( 'type', 'range' )->set_classes( 'ssq-range-slider' )->set_default_value( '0.5' )->set_attribute( 'min', '0' )->set_attribute( 'max', '1' )->set_attribute( 'step', '0.5' ),
            // ROADM
            // LANDSCAPE (DESKTOP)
            Field::make( 'select', 'scrollsequence_p_scaleto_desktop', __( 'Landscape (Desktop)', 'scrollsequence' ) )->set_conditional_logic( $scrollsequence_condition_need_images )->set_width( 30 )->set_default_value( 'fill' )->set_options( array(
                'fill' => __( 'Scale to fill', 'scrollsequence' ),
                'fit'  => __( 'Scale to fit', 'scrollsequence' ) . ' 100%',
                '0.5'  => __( 'Scale to fit', 'scrollsequence' ) . ' 50%',
            ) ),
            Field::make( 'text', 'scrollsequence_p_alignx_desktop', __( 'Horizontal Align', 'scrollsequence' ) )->set_conditional_logic( $scrollsequence_condition_need_images )->set_help_text( $scrollsequence_left_center_right )->set_width( 35 )->set_attribute( 'type', 'range' )->set_classes( 'ssq-range-slider' )->set_default_value( '0.5' )->set_attribute( 'min', '0' )->set_attribute( 'max', '1' )->set_attribute( 'step', '0.5' ),
            // ROADM
            Field::make( 'text', 'scrollsequence_p_aligny_desktop', __( 'Vertical Align', 'scrollsequence' ) )->set_conditional_logic( $scrollsequence_condition_need_images )->set_help_text( $scrollsequence_bottom_center_top )->set_width( 35 )->set_attribute( 'type', 'range' )->set_classes( 'ssq-range-slider' )->set_default_value( '0.5' )->set_attribute( 'min', '0' )->set_attribute( 'max', '1' )->set_attribute( 'step', '0.5' ),
            // ROADM
            Field::make( 'html', 'scrollsequence_info_html_freealignadv' )->set_conditional_logic( $scrollsequence_condition_need_images )->set_html( $scrollsequence_aglignmentadv ),
        ) )->set_header_template( __( 'Scene', 'scrollsequence' ) . ' <%- $_index %>' ) ) );
        // FREE
        $scrub_field = Field::make( 'html', 'scrollsequence_hidden', '' )->set_html( '
			<style>
			.nevim{
line-height: 1.4;
font-size: 13px;
cursor: pointer;
vertical-align: middle;
display: block;
padding-bottom: 5px;
font-weight: 600;
color: #23282d;				
			}


			</style>
			<div class="nevim">' . __( 'Scroll Delay', 'scrollsequence' ) . '</div>
			<select  disabled>
			<option value="0">0s (instant)</option>
			</select>
			<p>' . __( 'Scroll Delay Settings available only in', 'scrollsequence' ) . ' <a href=' . admin_url( "admin.php?page=scrollsequence-pricing" ) . '>Scrollsequence PRO</a>.</p>' );
        $debug_multi_options_array = array(
            'debug'        => __( 'General Debug', 'scrollsequence' ),
            'preloaddebug' => __( 'Image Preload Debug', 'scrollsequence' ),
            'detectdebug'  => __( 'Device Detect Debug', 'scrollsequence' ),
        );
        $scrollsequence_trigger_start_field = Field::make( 'hidden', 'scrollsequence_trigger_start_hidden', '' )->set_classes( 'schovej-to-policko' );
        $scrollsequence_trigger_end_field = Field::make( 'hidden', 'scrollsequence_trigger_end_hidden', '' )->set_classes( 'schovej-to-policko' );
        // END OF FREE  __(,'scrollsequence')
        Container::make( 'post_meta', 'Scrollsequence Settings' )->where( 'post_type', '=', 'scrollsequence' )->set_context( 'side' )->set_priority( 'low' )->add_fields( array(
            $scrollsequence_trigger_start_field,
            $scrollsequence_trigger_end_field,
            Field::make( 'select', 'scrollsequence_position', __( 'Position', 'scrollsequence' ) )->help_text( __( 'Sticky position fixes animation to the viewport. Static makes it flow with the rest of the page. Sticky behavior can be controlled via options. See more in documentation. ', 'scrollsequence' ) )->add_options( array(
                'sticky'   => __( 'Sticky (default)', 'scrollsequence' ),
                'absolute' => __( 'Absolute', 'scrollsequence' ),
                'static'   => __( 'Static', 'scrollsequence' ),
            ) ),
            $scrub_field,
            Field::make( 'select', 'scrollsequence_image_full_width', __( 'Image Width', 'scrollsequence' ) )->add_options( array(
                false => __( 'Content Width (default)', 'scrollsequence' ),
                true  => __( 'Force Full Width', 'scrollsequence' ),
            ) )->help_text( __( 'Select "Force Full Width" to overrride your templates default width. If the setting does not work, use full width template included in your Theme.', 'scrollsequence' ) ),
            Field::make( 'text', 'scrollsequence_image_opacity', __( 'Image Opacity', 'scrollsequence' ) )->set_attribute( 'type', 'number' )->set_required( true )->set_default_value( '1' )->set_attribute( 'min', '0' )->set_attribute( 'max', '1' )->set_attribute( 'step', '0.01' ),
            // THIS IS QUITE COMPLEX - ACTIVATE LATER ???
            // Field::make( 'text', 'scrollsequence_image_zindex', __( 'Image z-index (optional)' ) )
            // 	//->set_help_text( '' )
            // 	->set_attribute( 'type', 'number' )
            // 	->set_attribute( 'min', '-9999' )
            // 	->set_attribute( 'max', '9999' )
            // 	->set_attribute( 'step', '1' ),
            // Field::make( 'select', 'scrollsequence_content_spacer', 'Classic Content Position' ) // LEGACY
            //     ->add_options( array( 									// LEGACY
            //         'after100' => 'End of Document (default)',			// LEGACY
            //         'after' => 'End of Document (with overlap) ',		// LEGACY
            //         'during' => 'Start of Document',
            //     ) ),
            Field::make( 'textarea', 'scrollsequence_custom_css', __( 'Custom CSS', 'scrollsequence' ) )->set_default_value( '.ssq-center-center{
position: absolute;
left: 50%;
top: 50%;
transform: translate(-50%, -50%);
text-shadow: 0 0 8px white;
text-align: center;
}
' )->help_text( __( 'Enter custom CSS here.', 'scrollsequence' ) ),
            Field::make( "multiselect", "scrollsequence_debug_multi", __( "Show Development Information", 'scrollsequence' ) )->add_options( $debug_multi_options_array ),
        ) );
        /* 
         * SIDE CONTEXT - ADVANCED SETTINGS 
         */
        Container::make( 'post_meta', 'Custom Post Settings' )->where( 'post_type', '=', 'scrollsequence' )->set_context( 'side' )->set_priority( 'low' )->add_fields( array(
            Field::make( 'color', 'scrollsequence_bodybgcolor', __( 'Body Background Color', 'scrollsequence' ) )->help_text( __( 'Set CSS attribute <i><strong>background-color</strong></i> of <i><strong>body.single-scrollsequence</strong></i> class.', 'scrollsequence' ) ),
            // Field::make( 'color', 'scrollsequence_classic_content_after_bgcolor', __( 'Background Color - After Scrollsequence' ) )
            // 	->help_text('Use in case you want to have different background color after the scrollsequence is finished. Only active when there is content after the image sequence. ')
            // 	,
            Field::make( 'checkbox', 'scrollsequence_show_sidebar', __( 'Show Sidebar', 'scrollsequence' ) )->set_option_value( 'yes' )->help_text( __( 'Experimental, take care', 'scrollsequence' ) ),
            Field::make( 'checkbox', 'scrollsequence_show_footer', __( 'Show Footer', 'scrollsequence' ) )->set_option_value( 'yes' )->help_text( __( 'Experimental, take care. <br>(This setting displays footer element and  changes z-index to 9999)', 'scrollsequence' ) ),
        ) );
    }
    
    // END OF CARBON FIELD MAIN FUNCTION (CPT)
    /**
     * ROADM Alert Too Many Pages and Images
     * 
     * @since    0.7.4
     */
    public function scrollsequence_admin_notice()
    {
        // Ak: I want to add an IF statement to add admin notice only to scrollsequence post php
        global  $post_type ;
        global  $pagenow ;
        
        if ( $pagenow == 'post.php' && 'scrollsequence' == $post_type || $pagenow == 'post-new.php' && 'scrollsequence' == $post_type ) {
            echo  '<div class="notice notice-warning" id="scrollsequence_notice_toomanyimg" style="display:none" ><p>' . __( 'Warning: Image limit reached. For performance reasons, free version allows maximum of 100 images on a single page. Images marked with "X" will not be displayed.', 'scrollsequence' ) . ' <a href="' . admin_url( 'admin.php?page=scrollsequence-pricing' ) . '">' . __( 'Upgrade to display unlimited images in your Scrollsequence', 'scrollsequence' ) . '</a>.</p></div>' ;
            echo  '<div class="notice notice-warning" id="scrollsequence_notice_toomanypages" style="display:none" ><p>' . __( 'Warning: Scene limit reached. For performance reasons, free version allows maximum of 3 scenes.', 'scrollsequence' ) . ' <a href="' . admin_url( 'admin.php?page=scrollsequence-pricing' ) . '">' . __( 'Upgrade to display unlimited scenes in your Scrollsequence', 'scrollsequence' ) . ' </a>.</p></div>' ;
        }
        
        // Ak: end
    }
    
    /**
     * Classic Content Editor Heading
     * 
     * @since    0.9.94
     */
    /*			OBSOLETE
    				<h2><strong> Shortcode options:</strong> </h2>
    				<p><i>[scrollsequence margintop="-200px"]</i>  Animation will have a 200px overlap. Useful when you have a gap at the top where animation starts.</p>
    				<p><i>[scrollsequence marginbottom="-600px"]</i>  Animation will have a 600px overlap. Useful when you want to seamlessly join content after the animation ends.</p>
    	*/
    public function scrollsequence_classic_content_html()
    {
        // Ak: I want to add an IF statement to add admin notice only to scrollsequence post php
        global  $post_type ;
        global  $pagenow ;
        if ( $pagenow == 'post.php' && 'scrollsequence' == $post_type || $pagenow == 'post-new.php' && 'scrollsequence' == $post_type ) {
            // IF Condition Changed 1.0.076
            echo  __( '<h1>Content Editor </h1>
				<p><strong>Place shortcode <i>[scrollsequence]</i> anywhere in the classic content to control image sequence position.<br> If not specified <i>[scrollsequence]</i> shortcode will be placed at the start of content automatically, rendering the image sequence at the begining of the page. </strong></p>', 'scrollsequence' ) . '

				' ;
        }
        // Ak: end
    }
    
    /**
     * Function that makes the scrollsequence shortcode happen..
     *
     * Shortcode: [scrollsequence id="###"]
     *	
     *
     * @since    0.9.95
     */
    public function scrollsequence_shortcode( $atts )
    {
        // Extract atts
        extract( shortcode_atts( array(
            'id'           => get_the_id(),
            'margintop'    => 0,
            'marginbottom' => 0,
            'hide'         => false,
        ), $atts ) );
        // Get info from database
        $ssqInputZeroObject = array(
            'debug'             => carbon_get_post_meta( $id, 'scrollsequence_debug_multi' ),
            'show_footer'       => carbon_get_post_meta( $id, 'scrollsequence_show_footer' ),
            'show_sidebar'      => carbon_get_post_meta( $id, 'scrollsequence_show_sidebar' ),
            'preloadPercentage' => esc_attr( get_option( 'ssq_option_preload_percentage', 0.12 ) ),
            'ssqFyiId'          => $id,
            'siteUrl'           => get_option( 'siteurl' ),
        );
        $ssqInputObject = array(
            'ssqId'          => $id,
            'bodyBgColor'    => carbon_get_post_meta( $id, 'scrollsequence_bodybgcolor' ),
            'imageOpacity'   => carbon_get_post_meta( $id, 'scrollsequence_image_opacity' ),
            'scrub'          => (double) carbon_get_post_meta( $id, 'scrollsequence_scrub' ),
            'forceFullWidth' => carbon_get_post_meta( $id, 'scrollsequence_image_full_width' ),
            'zIndex'         => carbon_get_post_meta( $id, 'scrollsequence_image_zindex' ),
            'triggerStart'   => carbon_get_post_meta( $id, 'scrollsequence_trigger_start' ),
            'triggerEnd'     => carbon_get_post_meta( $id, 'scrollsequence_trigger_end' ),
            'canvasDPR'      => esc_attr( get_option( 'ssq_option_canvas_dpr', 'quality' ) ),
        );
        // Rename info from database in JS format
        $ssqInputObject['page'] = array();
        $ssqPageFromUI = carbon_get_post_meta( $id, 'scrollsequence_page' );
        foreach ( $ssqPageFromUI as $x => $val ) {
            $ssqInputObject['page'][$x]['alignX']['desktop'] = $ssqPageFromUI[$x]['scrollsequence_p_alignx_desktop'];
            $ssqInputObject['page'][$x]['alignX']['mobile'] = $ssqPageFromUI[$x]['scrollsequence_p_alignx_mobile'];
            $ssqInputObject['page'][$x]['alignY']['desktop'] = $ssqPageFromUI[$x]['scrollsequence_p_aligny_desktop'];
            $ssqInputObject['page'][$x]['alignY']['mobile'] = $ssqPageFromUI[$x]['scrollsequence_p_aligny_mobile'];
            // $ssqInputObject['page'][$x]['pageDuration']= (float)$ssqPageFromUI[$x]['scrollsequence_p_duration'];
            $ssqInputObject['page'][$x]['imgDur'] = (double) $ssqPageFromUI[$x]['scrollsequence_p_imgdur'];
            $ssqInputObject['page'][$x]['scaleTo']['desktop'] = $ssqPageFromUI[$x]['scrollsequence_p_scaleto_desktop'];
            $ssqInputObject['page'][$x]['scaleTo']['mobile'] = $ssqPageFromUI[$x]['scrollsequence_p_scaleto_mobile'];
            // Loop Through Anim
            $ssqInputObject['page'][$x]['animEl'] = array();
            // in case of empty
            foreach ( $ssqPageFromUI[$x]['ssqnce_anim'] as $z => $animvar ) {
                $ssqInputObject['page'][$x]['animEl'][$z] = $ssqPageFromUI[$x]['ssqnce_anim'][$z];
            }
        }
        // If there is "hide" parameter -> enqueue mobile detect script and act based on parameter values.
        
        if ( $hide ) {
            $showDetectNotice = in_array( "detectdebug", carbon_get_post_meta( $id, 'scrollsequence_debug_multi' ) );
            //echo '<!--Scrollsequence - Hide Parameter Exists: -->';
            require_once 'mobile_detect/mobile_detect.php';
            $detect = new Mobile_Detect();
            //	var_dump($detect);
            // Any mobile device (phones or tablets).
            if ( $detect->isMobile() && str_contains( strtolower( $hide ), 'ismobile' ) ) {
                return '<div class="scrollsequence-mobile-detect-message" ' . (( $showDetectNotice ? '' : 'style="display:none' )) . '"> Scrollsequence Debug - MobileDetect: Hide because device isMobile </div>';
            }
            if ( !$detect->isMobile() && str_contains( strtolower( $hide ), 'isnotmobile' ) ) {
                return '<div class="scrollsequence-mobile-detect-message" ' . (( $showDetectNotice ? '' : 'style="display:none' )) . '"> Scrollsequence Debug - MobileDetect: Hide because device isNotMobile </div>';
            }
            // Any tablet device.
            if ( $detect->isTablet() && str_contains( strtolower( $hide ), 'istablet' ) ) {
                return '<div class="scrollsequence-mobile-detect-message" ' . (( $showDetectNotice ? '' : 'style="display:none' )) . '"> Scrollsequence Debug - MobileDetect: Hide because device isTablet </div>';
            }
            if ( !$detect->isTablet() && str_contains( strtolower( $hide ), 'isnottablet' ) ) {
                return '<div class="scrollsequence-mobile-detect-message" ' . (( $showDetectNotice ? '' : 'style="display:none' )) . '"> Scrollsequence Debug - MobileDetect: Hide because device isNotTablet </div>';
            }
            // Exclude tablets.
            if ( $detect->isMobile() && !$detect->isTablet() && str_contains( strtolower( $hide ), 'isphone' ) ) {
                return '<div class="scrollsequence-mobile-detect-message" ' . (( $showDetectNotice ? '' : 'style="display:none' )) . '"> Scrollsequence Debug - MobileDetect: Hide because device isPhone </div>';
            }
            if ( !($detect->isMobile() && !$detect->isTablet()) && str_contains( strtolower( $hide ), 'isnotphone' ) ) {
                return '<div class="scrollsequence-mobile-detect-message" ' . (( $showDetectNotice ? '' : 'style="display:none' )) . '"> Scrollsequence Debug - MobileDetect: Hide because device isNotPhone </div>';
            }
            // Check for a specific platform with the help of the magic methods:
            if ( $detect->isiOS() && str_contains( strtolower( $hide ), 'isios' ) ) {
                return '<div class="scrollsequence-mobile-detect-message" ' . (( $showDetectNotice ? '' : 'style="display:none' )) . '"> Scrollsequence Debug - MobileDetect: Hide because device isiOs </div>';
            }
            if ( !$detect->isiOS() && str_contains( strtolower( $hide ), 'isnotios' ) ) {
                return '<div class="scrollsequence-mobile-detect-message" ' . (( $showDetectNotice ? '' : 'style="display:none' )) . '"> Scrollsequence Debug - MobileDetect: Hide because device isNotiOs </div>';
            }
            if ( $detect->isAndroidOS() && str_contains( strtolower( $hide ), 'isandroidos' ) ) {
                return '<div class="scrollsequence-mobile-detect-message" ' . (( $showDetectNotice ? '' : 'style="display:none' )) . '"> Scrollsequence Debug - MobileDetect: Hide because device isAndroidOs </div>';
            }
            if ( !$detect->isAndroidOS() && str_contains( strtolower( $hide ), 'isnotandroidos' ) ) {
                return '<div class="scrollsequence-mobile-detect-message" ' . (( $showDetectNotice ? '' : 'style="display:none' )) . '"> Scrollsequence Debug - MobileDetect: Hide because device isNotAndroidOs </div>';
            }
        }
        
        // FREE
        foreach ( $ssqPageFromUI as $x => $val ) {
            // Loop Through IMAGES
            $ssqInputObject['page'][$x]['imagesFull'] = array( plugin_dir_url( __DIR__ ) . 'public/img/noimg.jpg' );
            //if empty
            
            if ( function_exists( 'get_rocket_cdn_url' ) ) {
                foreach ( $ssqPageFromUI[$x]['scrollsequence_p_images'] as $y => $imgvar ) {
                    $ssqInputObject['page'][$x]['imagesFull'][$y] = get_rocket_cdn_url( wp_get_attachment_image_src( $ssqPageFromUI[$x]['scrollsequence_p_images'][$y], 'full' )[0] );
                }
            } else {
                foreach ( $ssqPageFromUI[$x]['scrollsequence_p_images'] as $y => $imgvar ) {
                    $ssqInputObject['page'][$x]['imagesFull'][$y] = wp_get_attachment_image_src( $ssqPageFromUI[$x]['scrollsequence_p_images'][$y], 'full' )[0];
                }
            }
            
            $ssqInputObject['page'][$x]['imagesFull'] = array_splice( $ssqInputObject['page'][$x]['imagesFull'], 0, 100 );
        }
        // Calculate lengths, spacers and  absSpacers (SC is calculated in JS)
        $ssqInputObject['pageLength'] = count( $ssqInputObject['page'] );
        $ssqInputObject['scSpacer'] = 0;
        $pageAbsSpacerTotal = 0;
        foreach ( $ssqPageFromUI as $x => $val ) {
            $ssqInputObject['page'][$x]['imagesLength'] = count( $ssqInputObject['page'][$x]['imagesFull'] );
            $ssqInputObject['page'][$x]['animElLength'] = count( $ssqInputObject['page'][$x]['animEl'] );
            $ssqInputObject['page'][$x]['pageSpacer'] = $ssqInputObject['page'][$x]['imagesLength'] * $ssqInputObject['page'][$x]['imgDur'];
            $ssqInputObject['scSpacer'] = $ssqInputObject['scSpacer'] + $ssqInputObject['page'][$x]['pageSpacer'];
            $ssqInputObject['page'][$x]['pageAbsBegin'] = $pageAbsSpacerTotal;
            $pageAbsSpacerTotal = $pageAbsSpacerTotal + $ssqInputObject['page'][$x]['pageSpacer'];
            $ssqInputObject['page'][$x]['pageAbsEnd'] = $pageAbsSpacerTotal;
        }
        // Sticky JS/CSS or Static - Deal with all here early on. - Since 1.3.0
        $stickyOptionFromSettings = get_option( 'ssq_option_position_sticky', 'sticky-js' );
        // second argument must be the same as default value, it needs to be here to cover if null
        
        if ( carbon_get_post_meta( $id, 'scrollsequence_position' ) == 'sticky' && $stickyOptionFromSettings == 'sticky-js' ) {
            // sticky js
            $ssqInputObject['position'] = 'sticky-js';
            $stickyStyle = 'position:relative;box-sizing: border-box;';
            $ssqDomSpacer = $ssqInputObject['scSpacer'];
            $ssqWrapStylePosition = '';
            $absoluteScrollsequenceStyle = '';
        } else {
            
            if ( carbon_get_post_meta( $id, 'scrollsequence_position' ) == 'sticky' && $stickyOptionFromSettings == 'sticky-css' ) {
                // sticky css
                $ssqInputObject['position'] = 'sticky-css';
                $stickyStyle = 'position: -webkit-sticky;position:sticky;top:0;box-sizing: border-box;';
                $ssqDomSpacer = $ssqInputObject['scSpacer'];
                $ssqWrapStylePosition = '';
                $absoluteScrollsequenceStyle = '';
            } else {
                
                if ( carbon_get_post_meta( $id, 'scrollsequence_position' ) == 'absolute' && $stickyOptionFromSettings == 'sticky-js' ) {
                    // sticky js
                    $ssqInputObject['position'] = 'sticky-js';
                    $stickyStyle = 'position:relative;box-sizing: border-box;';
                    $ssqDomSpacer = $ssqInputObject['scSpacer'];
                    $ssqWrapStylePosition = 'position:absolute;';
                    $absoluteScrollsequenceStyle = 'style="display:block;position:relative;"';
                } else {
                    
                    if ( carbon_get_post_meta( $id, 'scrollsequence_position' ) == 'absolute' && $stickyOptionFromSettings == 'sticky-css' ) {
                        // sticky css
                        $ssqInputObject['position'] = 'sticky-css';
                        $stickyStyle = 'position: -webkit-sticky;position:sticky;top:0;box-sizing: border-box;';
                        $ssqDomSpacer = $ssqInputObject['scSpacer'];
                        $ssqWrapStylePosition = 'position:absolute;';
                        $absoluteScrollsequenceStyle = 'style="display:block;position:relative;"';
                    } else {
                        // static
                        //$ssqInputObject['carbongetpostmetascrollsequenceposition'] = carbon_get_post_meta( $id, 'scrollsequence_position');
                        //$ssqInputObject['get_optionssqoptionpositionsticky'] =$stickyOptionFromSettings;
                        $ssqInputObject['position'] = 'static';
                        $stickyStyle = 'position:relative;box-sizing: border-box; ';
                        $ssqDomSpacer = 0;
                        $ssqWrapStylePosition = '';
                        $absoluteScrollsequenceStyle = 'style="display:block;position:relative;"';
                    }
                
                }
            
            }
        
        }
        
        // Localize/Inline Script
        static  $ssqScCount = 0 ;
        
        if ( !$ssqScCount ) {
            // First run we need to declare variable and input
            $inlineData = 'var ssqInput={};
				ssqInput=' . json_encode( $ssqInputZeroObject ) . ';
				ssqInput.sc=[];
				ssqInput.sc[' . $ssqScCount . ']=' . json_encode( $ssqInputObject ) . ';';
        } else {
            // All other runs just input
            $inlineData = 'ssqInput.sc[' . $ssqScCount . ']=' . json_encode( $ssqInputObject ) . ';';
        }
        
        wp_enqueue_script( 'scrollsequence-lib' );
        // Prepare for returning onlyonece HTML
        
        if ( !$ssqScCount ) {
            // First run
            $onlyonceHtml = '
			
  <style>
  	.scrollsequence-pages-wrap {height:100vh}
  	.scrollsequence-page {position:absolute;display:none}

	.gsap-marker-scroller-start {z-index:999999!important;} 
  </style>			
  <noscript> 
	  <style>
	  .scrollsequence-wrap {height:initial!important;}
	  .scrollsequence-pages-wrap {height:initial}
	  .scrollsequence-page {position:relative;opacity:initial;display:block  ;visibility:initial}	   
	  </style> 
  </noscript>

  <div style="position: fixed;z-index:99999;bottom:50px;left: 100px;background:#383131b0;color:white; padding: 0.5rem; display:none" class="ssq-alert-container" id="ssqalert" >
  </div>

			';
        } else {
            $onlyonceHtml = '';
        }
        
        //all other runs
        // Style for each SC
        $customCssVar = '';
        if ( !empty(carbon_get_post_meta( $id, 'scrollsequence_custom_css' )) ) {
            $customCssVar = '
		<style>
			' . carbon_get_post_meta( $id, 'scrollsequence_custom_css' ) . '
		</style>
				';
        }
        // end of if not empty
        // Prepare for returning pages html
        $pagesHtml = array();
        foreach ( $ssqPageFromUI as $p => $pagevar ) {
            /** 
             *	Filter Stuff 
             *	 Since 1.1.2.
             *	 Inspired from: https://wordpress.stackexchange.com/questions/134582/apply-filtersthe-content-content-alternative
             *		    List of standard filters for the_content 
             *		    source: https://core.trac.wordpress.org/browser/tags/5.7.2/src/wp-includes/default-filters.php#L131
             *	 		search for "the_content" to find what things are applied as standard	
             */
            $filterSsqPageContent = do_blocks( $ssqPageFromUI[$p]['scrollsequence_p_wysiwyg'] );
            // priority 9 // Introduced 5.0
            $filterSsqPageContent = wptexturize( $filterSsqPageContent );
            // Introduced  0.71
            $filterSsqPageContent = wpautop( $filterSsqPageContent );
            // Introduced  0.71
            $filterSsqPageContent = do_shortcode( $filterSsqPageContent );
            // Introduced 2.5
            $filterSsqPageContent = shortcode_unautop( $filterSsqPageContent );
            // Introduced in 2.9
            $filterSsqPageContent = prepend_attachment( $filterSsqPageContent );
            // Introduced in 2.0
            // $filterSsqPageContent = wp_filter_content_tags($filterSsqPageContent); // Introducted in 5.5 - cannot use (yet)
            // $filterSsqPageContent = wp_replace_insecure_home_url($filterSsqPageContent); // Introducted WP 5.7 - cannot use (yet)
            $filterSsqPageContent = convert_smilies( $filterSsqPageContent );
            // priority 20? // Introduced longtimeago
            // Page HTML
            $pagesHtml[$p] = '
		<div class="scrollsequence-page" id="ssq-page-' . $ssqScCount . '-' . $p . '" style="box-sizing: border-box;height:100vh;width:100%;overflow:hidden!important;">
				' . $filterSsqPageContent . '
		</div>  
				';
        }
        // return
        $returnvar = '

<!-- Scrollsequence WP Plugin  -->
<scrollsequence ' . $absoluteScrollsequenceStyle . '>	
' . $onlyonceHtml . $customCssVar . '
<section class="scrollsequence-wrap ssq-wrap-' . $ssqScCount . ' " id="ssq-uid-' . get_the_id() . '-' . $ssqScCount . '-' . $id . '" style="' . $ssqWrapStylePosition . ';height: calc(100vh + ' . $ssqDomSpacer . 'px);padding:0;margin:0; margin-top:' . $margintop . ';margin-bottom:' . $marginbottom . '; width:100%; max-width:initial;box-sizing: border-box;border:-1px dashed blue;">
  	<div class="scrollsequence-sticky" style="' . $stickyStyle . '">
  		<canvas class="scrollsequence-canvas" style="position:absolute;"></canvas>
		<div class="scrollsequence-pages-wrap" style="position:relative; margin:0; padding:0; box-sizing: border-box;">
' . implode( " ", $pagesHtml ) . '		
		</div>
	</div><!-- .scrollsequence-sticky -->


</section><!-- .scrollsequence-wrap -->
		' . '<script class="scrollsequence-input-script">
		' . $inlineData . '
		</script>
</scrollsequence>
		';
        // Free
        $ssqScCount++;
        
        if ( $ssqScCount <= 1 ) {
            return $returnvar;
        } else {
            return '<section><h5 style="border:2px solid; padding:20px">' . __( 'For performance reasons only one shortcode is allowed in Scrollsequence FREE.', 'scrollsequence' ) . '<br><br> <a href="' . admin_url( 'admin.php?page=scrollsequence-pricing' ) . '">' . __( 'Upgrade to PRO version for unlimited shortcodes.', 'scrollsequence' ) . '</a> </h5></section>';
        }
        
        // end of else  count other than zero
        // end of free
    }
    
    // end of scrollsequence_shortcode function
    /**
     * Add Columns to Custom Post Type List
     *
     *
     */
    function scrollsequence_admin_columns( $columns )
    {
        $columns = array(
            'cb'            => $columns['cb'],
            'title'         => __( 'Title', 'scrollsequence' ),
            'ssq_shortcode' => __( 'Shortcode', 'scrollsequence' ),
            'date'          => __( 'Date', 'scrollsequence' ),
            'author'        => __( 'Author', 'scrollsequence' ),
        );
        return $columns;
    }
    
    function scrollsequence_admin_column_content( $column, $id )
    {
        if ( 'ssq_shortcode' == $column ) {
            echo  '[scrollsequence id="' . $id . '"]' ;
        }
    }
    
    /**
     * Admin Columns - FEATURED IMAGE
     * 
     * Since 1.2.0
     * 
     * 
     */
    function ssq_add_thumbnail_column( $columns )
    {
        $columns['ssq_post_thumb'] = __( 'Featured Image', 'scrollsequence' );
        return $columns;
    }
    
    function ssq_display_thumbnail_column( $column_name, $post_id )
    {
        switch ( $column_name ) {
            case 'ssq_post_thumb':
                $post_thumbnail_id = get_post_thumbnail_id( $post_id );
                
                if ( $post_thumbnail_id ) {
                    $post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'thumbnail' );
                    echo  '<img width="64" src="' . $post_thumbnail_img[0] . '" />' ;
                } else {
                    // no thumbnail, try to use something else
                    $idOfFirstImage = carbon_get_post_meta( get_the_ID(), 'scrollsequence_page' );
                    //var_dump($idOfFirstImage);
                    // Check that is array check that images is array and finally check that count of images is bigger than one.
                    
                    if ( is_array( $idOfFirstImage ) && count( $idOfFirstImage ) > 0 && is_array( $idOfFirstImage[0]['scrollsequence_p_images'] ) && count( $idOfFirstImage[0]['scrollsequence_p_images'] ) > 0 ) {
                        // first image in sequence exists
                        echo  '<img width="64" src="' . wp_get_attachment_image_src( $idOfFirstImage[0]['scrollsequence_p_images'][0], 'thumbnail' )[0] . '" />' ;
                    } else {
                        // there are no images here
                        echo  'No Image' ;
                    }
                
                }
                
                break;
        }
    }
    
    /**
     * Register Settings Options in Scrollsequence Options Dashboard
     *
     * @since    1.1.1
     */
    function scrollsequence_register_options_settings()
    {
        // whitelist options
        register_setting( 'scrollsequence-settings-group', 'ssq_option_preload_percentage', array(
            'default' => 0.12,
        ) );
        register_setting( 'scrollsequence-settings-group', 'ssq_option_position_sticky', array(
            'default' => 'sticky-js',
        ) );
        // since 1.3.0
        register_setting( 'scrollsequence-settings-group', 'ssq_option_canvas_dpr', array(
            'default' => 'quality',
        ) );
        // since 1.3.3
        // TODO
        // register_setting( 'scrollsequence-settings-group', 'ssq_option_scroller_proxy' ); // not implemented yet
        // register_setting( 'scrollsequence-settings-group', 'ssq_option_elementor_widget' ); // not implemented yet
    }
    
    /**
     *  DUPLICATE SCROLLSEQUENCE
     * @snippet  Duplicate posts and pages without plugins
     * @author   Misha Rudrastyh
     * @url      https://rudrastyh.com/wordpress/duplicate-post.html
     * 
     */
    // Add the duplicate link to action list for post_row_actions for "post" and custom post types
    function ssq_duplicate_post_link( $actions, $post )
    {
        if ( !current_user_can( 'edit_posts' ) ) {
            return $actions;
        }
        if ( $post->post_type !== 'scrollsequence' ) {
            return $actions;
        }
        $url = wp_nonce_url( add_query_arg( array(
            'action' => 'duplicate_scrollsequence_as_draft',
            'post'   => $post->ID,
        ), 'admin.php' ), basename( __FILE__ ), 'duplicate_ssq_nonce' );
        $actions['duplicate_ssq'] = '<a href="' . $url . '" title="' . __( 'Duplicate Scrollsequence' ) . '" rel="permalink">' . __( 'Duplicate' ) . '</a>';
        return $actions;
    }
    
    /*
     * Function creates post duplicate as a draft and redirects then to the edit post screen
     */
    function duplicate_scrollsequence_as_draft()
    {
        // check if post ID has been provided and action
        if ( empty($_GET['post']) ) {
            wp_die( 'No post to duplicate has been provided!' );
        }
        // Nonce verification
        if ( !isset( $_GET['duplicate_ssq_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_ssq_nonce'], basename( __FILE__ ) ) ) {
            return;
        }
        // Get the original post id
        $post_id = absint( $_GET['post'] );
        // And all the original post data then
        $post = get_post( $post_id );
        /*
         * if you don't want current user to be the new post author,
         * then change next couple of lines to this: $new_post_author = $post->post_author;
         */
        $current_user = wp_get_current_user();
        $new_post_author = $current_user->ID;
        // if post data exists (I am sure it is, but just in a case), create the post duplicate
        
        if ( $post ) {
            // new post data array
            $args = array(
                'comment_status' => $post->comment_status,
                'ping_status'    => $post->ping_status,
                'post_author'    => $new_post_author,
                'post_content'   => $post->post_content,
                'post_excerpt'   => $post->post_excerpt,
                'post_name'      => $post->post_name,
                'post_parent'    => $post->post_parent,
                'post_password'  => $post->post_password,
                'post_status'    => 'draft',
                'post_title'     => $post->post_title . '_duplicate',
                'post_type'      => $post->post_type,
                'to_ping'        => $post->to_ping,
                'menu_order'     => $post->menu_order,
            );
            // insert the post by wp_insert_post() function
            $new_post_id = wp_insert_post( $args );
            /*
             * get all current post terms ad set them to the new post draft
             */
            $taxonomies = get_object_taxonomies( get_post_type( $post ) );
            // returns array of taxonomy names for post type, ex array("category", "post_tag");
            if ( $taxonomies ) {
                foreach ( $taxonomies as $taxonomy ) {
                    $post_terms = wp_get_object_terms( $post_id, $taxonomy, array(
                        'fields' => 'slugs',
                    ) );
                    wp_set_object_terms(
                        $new_post_id,
                        $post_terms,
                        $taxonomy,
                        false
                    );
                }
            }
            // duplicate all post meta
            $post_meta = get_post_meta( $post_id );
            if ( $post_meta ) {
                foreach ( $post_meta as $meta_key => $meta_values ) {
                    if ( '_wp_old_slug' == $meta_key ) {
                        // do nothing for this meta key
                        continue;
                    }
                    foreach ( $meta_values as $meta_value ) {
                        add_post_meta( $new_post_id, $meta_key, $meta_value );
                    }
                }
            }
            // finally, redirect to the edit post screen for the new draft
            // wp_safe_redirect(
            // 	add_query_arg(
            // 		array(
            // 			'action' => 'edit',
            // 			'post' => $new_post_id
            // 		),
            // 		admin_url( 'post.php' )
            // 	)
            // );
            // exit;
            // or we can redirect to all posts with a message
            wp_safe_redirect( add_query_arg( array(
                'post_type' => ( 'post' !== get_post_type( $post ) ? get_post_type( $post ) : false ),
                'saved'     => 'post_duplication_created',
            ), admin_url( 'edit.php' ) ) );
            exit;
        } else {
            wp_die( 'Post creation failed, could not find original post.' );
        }
    
    }
    
    /*
     * In case we decided to add admin notices
     */
    function ssq_duplication_admin_notice()
    {
        // Get the current screen
        $screen = get_current_screen();
        if ( 'edit' !== $screen->base ) {
            return;
        }
        //Checks if settings updated
        if ( isset( $_GET['saved'] ) && 'post_duplication_created' == $_GET['saved'] ) {
            echo  '<div class="notice notice-success is-dismissible"><p>' . __( 'Copy created.' ) . '</p></div>' ;
        }
    }
    
    // end of duplicate
    /**
     * This function defines helpscout beacon
     * 
     * 
     */
    public function ssq_add_helpscout_beacon()
    {
        global  $post_type ;
        //var_dump($post_type);
        global  $pagenow ;
        //var_dump($pagenow);
        
        if ( 'scrollsequence' == $post_type && ('post-new.php' === $pagenow || 'post.php' === $pagenow) || 'scrollsequence' == $post_type && 'edit.php' === $pagenow || 'admin.php' === $pagenow && isset( $_GET['page'] ) && $_GET['page'] === 'scrollsequence-dashboard' || 'admin.php' === $pagenow && isset( $_GET['page'] ) && $_GET['page'] === 'scrollsequence-account' || 'admin.php' === $pagenow && isset( $_GET['page'] ) && $_GET['page'] === 'scrollsequence-contact' ) {
            // Inline Script on admin screen - not ready yet, too few articles in the thing.
            ?>
					<script type="text/javascript">!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});</script>
					<script type="text/javascript">window.Beacon('init', '751bcab8-88ed-4f04-9255-788822978f93')</script>			
				<?php 
        }
    
    }

}
// end of class Scrollsequence_Admin