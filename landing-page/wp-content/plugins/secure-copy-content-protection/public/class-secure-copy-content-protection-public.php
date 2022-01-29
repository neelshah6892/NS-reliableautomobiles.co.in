<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://ays-pro.com/
 * @since      1.0.0
 *
 * @package    Secure_Copy_Content_Protection
 * @subpackage Secure_Copy_Content_Protection/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Secure_Copy_Content_Protection
 * @subpackage Secure_Copy_Content_Protection/public
 * @author     Security Team <info@ays-pro.com>
 */
class Secure_Copy_Content_Protection_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		//Elementor plugin conflict solution
		if ( isset( $_GET['action'] ) && $_GET['action'] == 'elementor' ) {
			return false;
		}

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Secure_Copy_Content_Protection_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Secure_Copy_Content_Protection_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */


		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/secure-copy-content-protection-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		//Elementor plugin conflict solution
		if ( isset( $_GET['action'] ) && $_GET['action'] == 'elementor' ) {
			return false;
		}
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Secure_Copy_Content_Protection_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Secure_Copy_Content_Protection_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */


		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/secure-copy-content-protection-public.js', array('jquery'), $this->version, false );
		wp_enqueue_script( 'jquery-mobile', plugin_dir_url( __FILE__ ) . 'js/jquery.mobile.custom.min.js', array('jquery'), '1.4.5' );


	}

	public function ays_get_notification_text() {
		global $wpdb;
		$count = $wpdb->get_var( "SELECT COUNT(*) FROM " . SCCP_TABLE );
		if ( $count == 0 ) {
			$enable_protection = 0;
			$except_types      = array();
			$styles            = array(
				"bg_color"         => "#ffffff",
				"text_color"       => "#ff0000",
				"font_size"        => "12",
				"border_color"     => "#b7b7b7",
				"border_width"     => "1",
				"border_radius"    => "3",
				"border_style"     => "solid",
				"tooltip_position" => "mouse"
			);
			$notf_text         = __( 'You cannot copy content of this page', $this->plugin_name );
			$audio             = '';
		} else {
			$data = $wpdb->get_row( "SELECT * FROM " . SCCP_TABLE . " WHERE id = 1", ARRAY_A );

			$enable_protection = ( isset( $data['protection_status'] ) && $data['protection_status'] == 1 ) ? 1 : 0;
			$except_types      = ( isset( $data['except_post_types'] ) && ! empty( $data['except_post_types'] ) ) ? json_decode( $data['except_post_types'], true ) : array();
			$notf_text         = $data['protection_text'];
			$style             = json_decode( $data["styles"], true );
			$styles            = array(
				"bg_color"         => isset( $style['bg_color'] ) ? $style['bg_color'] : "#ffffff",
				"text_color"       => isset( $style['text_color'] ) ? $style['text_color'] : "#ff0000",
				"font_size"        => isset( $style['font_size'] ) ? $style['font_size'] : "12",
				"border_color"     => isset( $style['border_color'] ) ? $style['border_color'] : "#b7b7b7",
				"border_width"     => isset( $style['border_width'] ) ? $style['border_width'] : "1",
				"border_radius"    => isset( $style['border_radius'] ) ? $style['border_radius'] : "3",
				"border_style"     => isset( $style['border_style'] ) ? $style['border_style'] : "solid",
				"tooltip_position" => isset( $style['tooltip_position'] ) ? $style['tooltip_position'] : "mouse",
				"custom_css"       => isset( $style['custom_css'] ) ? $style['custom_css'] : "",
			);
			$audio             = $data['audio'];
		}
		if ( is_front_page() ) {
			$this_post_type = "page";
		} else {
			$this_post_type = get_post_type();
		}

		if ( $enable_protection == 1 && ! in_array( $this_post_type, $except_types ) ) {

			if ( ! empty( $audio ) ) {
				echo "<audio id='sccp_public_audio'>
                  <source src=" . $audio . " type='audio/mpeg'>
                </audio>";
			}
			echo '<div id="ays_tooltip">' . $notf_text . '</div>
                    <style>
                        #ays_tooltip{
                            background-color: ' . $this->hex2rgba( $styles["bg_color"], '0.9' ) . ';
                            color: ' . $this->hex2rgba( $styles["text_color"], '1' ) . ';
                            border: ' . $styles["border_width"] . 'px ' . $styles["border_style"] . ' ' . $this->hex2rgba( $styles["border_color"], '1' ) . ';
                            font-size: ' . ( isset( $styles["font_size"] ) ? $styles["font_size"] : "12" ) . 'px;
                            border-radius: ' . $styles["border_radius"] . 'px;
                        }
                       ' . ( isset( $styles["custom_css"] ) ? $styles["custom_css"] : "" ) . '
                    </style>
            ';
			include_once( 'partials/secure-copy-content-protection-public-display.php' );
		}
	}

	public function hex2rgba( $color, $opacity = false ) {

		$default = 'rgb(0,0,0)';

		//Return default if no color provided
		if ( empty( $color ) ) {
			return $default;
		}

		//Sanitize $color if "#" is provided
		if ( $color[0] == '#' ) {
			$color = substr( $color, 1 );
		}

		//Check if color has 6 or 3 characters and get values
		if ( strlen( $color ) == 6 ) {
			$hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
		} elseif ( strlen( $color ) == 3 ) {
			$hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
		} else {
			return $default;
		}

		//Convert hexadec to rgb
		$rgb = array_map( 'hexdec', $hex );

		//Check if opacity is set(rgba or rgb)
		if ( $opacity ) {
			if ( abs( $opacity ) > 1 ) {
				$opacity = 1.0;
			}
			$output = 'rgba(' . implode( ",", $rgb ) . ',' . $opacity . ')';
		} else {
			$output = 'rgb(' . implode( ",", $rgb ) . ')';
		}

		//Return rgb(a) color string
		return $output;
	}


}
