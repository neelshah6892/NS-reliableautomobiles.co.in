<?php
ob_start();

class Secure_Copy_Content_Protection_Actions {
	private $plugin_name;

	public function __construct( $plugin_name ) {
		$this->plugin_name = $plugin_name;
	}

	public function store_data( $data ) {
		global $wpdb;
		if (isset($data["sccp_action"]) && wp_verify_nonce($data["sccp_action"], 'sccp_action')) {
			$enable_protection = isset($data['sccp_enable_all_posts']) ? true : false;
			$except_types      = isset($data['sccp_except_post_types']) ? json_encode($data['sccp_except_post_types']) : '';
			$protection_text   = isset($data['sccp_notification_text']) ? stripslashes($data['sccp_notification_text']) : __('You cannot copy content of this page', $this->plugin_name);
			$audio             = isset($data['upload_audio_url']) ? trim($data['upload_audio_url']) : "";
			$options           = array(
				"left_click"      => (isset($data["sccp_enable_left_click"])) ? "checked" : "",
				"developer_tools" => (isset($data["sccp_enable_developer_tools"])) ? "checked" : "",
				"context_menu"    => (isset($data["sccp_enable_context_menu"])) ? "checked" : "",
				"drag_start"      => (isset($data["sccp_enable_drag_start"])) ? "checked" : "",
				"ctrlc"           => (isset($data["sccp_enable_ctrlc"])) ? "checked" : "",
				"ctrlv"           => (isset($data["sccp_enable_ctrlv"])) ? "checked" : "",
				"ctrls"           => (isset($data["sccp_enable_ctrls"])) ? "checked" : "",
				"ctrla"           => (isset($data["sccp_enable_ctrla"])) ? "checked" : "",
				"ctrlx"           => (isset($data["sccp_enable_ctrlx"])) ? "checked" : "",
				"ctrlu"           => (isset($data["sccp_enable_ctrlu"])) ? "checked" : "",
				"ctrlf"           => (isset($data["sccp_enable_ctrlf"])) ? "checked" : "",
				"f12"             => (isset($data["sccp_enable_f12"])) ? "checked" : "",
				"printscreen"     => (isset($data["sccp_enable_printscreen"])) ? "checked" : "",

				"left_click_mess"      => (isset($data["sccp_enable_left_click_mess"])) ? "checked" : "",
				"developer_tools_mess" => (isset($data["sccp_enable_developer_tools_mess"])) ? "checked" : "",
				"context_menu_mess"    => (isset($data["sccp_enable_context_menu_mess"])) ? "checked" : "",
				"drag_start_mess"      => (isset($data["sccp_enable_drag_start_mess"])) ? "checked" : "",
				"ctrlc_mess"           => (isset($data["sccp_enable_ctrlc_mess"])) ? "checked" : "",
				"ctrlv_mess"           => (isset($data["sccp_enable_ctrlv_mess"])) ? "checked" : "",
				"ctrls_mess"           => (isset($data["sccp_enable_ctrls_mess"])) ? "checked" : "",
				"ctrla_mess"           => (isset($data["sccp_enable_ctrla_mess"])) ? "checked" : "",
				"ctrlx_mess"           => (isset($data["sccp_enable_ctrlx_mess"])) ? "checked" : "",
				"ctrlu_mess"           => (isset($data["sccp_enable_ctrlu_mess"])) ? "checked" : "",
				"ctrlf_mess"           => (isset($data["sccp_enable_ctrlf_mess"])) ? "checked" : "",
				"f12_mess"             => (isset($data["sccp_enable_f12_mess"])) ? "checked" : "",
				"printscreen_mess"     => (isset($data["sccp_enable_printscreen_mess"])) ? "checked" : "",

				"left_click_audio"      => (isset($data["sccp_enable_left_click_audio"])) ? "checked" : "",
				"developer_tools_audio" => (isset($data["sccp_enable_developer_tools_audio"])) ? "checked" : "",
				"right_click_audio"     => (isset($data["sccp_enable_right_click_audio"])) ? "checked" : "",
				"drag_start_audio"      => (isset($data["sccp_enable_drag_start_audio"])) ? "checked" : "",
				"ctrlc_audio"           => (isset($data["sccp_enable_ctrlc_audio"])) ? "checked" : "",
				"ctrlv_audio"           => (isset($data["sccp_enable_ctrlv_audio"])) ? "checked" : "",
				"ctrls_audio"           => (isset($data["sccp_enable_ctrls_audio"])) ? "checked" : "",
				"ctrla_audio"           => (isset($data["sccp_enable_ctrla_audio"])) ? "checked" : "",
				"ctrlx_audio"           => (isset($data["sccp_enable_ctrlx_audio"])) ? "checked" : "",
				"ctrlu_audio"           => (isset($data["sccp_enable_ctrlu_audio"])) ? "checked" : "",
				"ctrlf_audio"           => (isset($data["sccp_enable_ctrlf_audio"])) ? "checked" : "",
				"f12_audio"             => (isset($data["sccp_enable_f12_audio"])) ? "checked" : "",
				"printscreen_audio"     => (isset($data["sccp_enable_printscreen_audio"])) ? "checked" : "",

				"enable_text_selecting" => (isset($data["sccp_enable_text_selecting"])) ? "checked" : "",
				"timeout"               => (isset($data["sscp_timeout"]) && $data["sscp_timeout"] > 0) ? absint($data["sscp_timeout"]) : 1000,

			);
			$styles            = array(
				"bg_color"         => isset($data['bg_color']) ? $data['bg_color'] : "#ffffff",
				"text_color"       => isset($data['text_color']) ? $data['text_color'] : "#ff0000",
				"font_size"        => isset($data['font_size']) ? $data['font_size'] : "12",
				"border_color"     => isset($data['border_color']) ? $data['border_color'] : "#b7b7b7",
				"border_width"     => isset($data['border_width']) ? $data['border_width'] : "1",
				"border_radius"    => isset($data['border_radius']) ? $data['border_radius'] : "3",
				"border_style"     => isset($data['border_style']) ? $data['border_style'] : "solid",
				"tooltip_position" => isset($data['tooltip_position']) ? $data['tooltip_position'] : "mouse",
				"custom_css"       => isset($data['custom_css']) ? $data['custom_css'] : "",
			);

			$count = $wpdb->get_var("SELECT COUNT(*) FROM " . SCCP_TABLE);

			if ($count == 0) {
				$result = $wpdb->insert(
					SCCP_TABLE,
					array(
						"protection_text"   => $protection_text,
						"except_post_types" => $except_types,
						"protection_status" => $enable_protection,
						"blocked_ips"       => "",
						"styles"            => json_encode($styles),
						"options"           => json_encode($options),
						"audio"             => $audio,
					)
				);
			} else {
				$result = $wpdb->update(
					SCCP_TABLE,
					array(
						"protection_text"   => $protection_text,
						"except_post_types" => $except_types,
						"protection_status" => $enable_protection,
						"blocked_ips"       => "",
						"styles"            => json_encode($styles),
						"options"           => json_encode($options),
						"audio"             => $audio
					),
					array('id' => 1)
				);
			}

			$sccp_tab = isset($data['sccp_tab']) ? $data['sccp_tab'] : 'tab1';
			if ($result >= 0) {
				$url = esc_url_raw(add_query_arg(array(
					"sccp_tab" => $sccp_tab,
				)));
				wp_redirect($url);
			}

		}
	}

	public function get_data() {
		global $wpdb;
		$data = $wpdb->get_row("SELECT * FROM " . SCCP_TABLE . " WHERE id=1", ARRAY_A);

		if (!empty($data)) {
			$enable_protection = (isset($data['protection_status']) && $data['protection_status'] == 1) ? "checked" : "";
			$except_types      = (isset($data['except_post_types'])) ? json_decode($data['except_post_types']) : array();
			$protection_text   = (isset($data['protection_text']) && $data['protection_text'] != "") ? wpautop(stripslashes($data['protection_text'])) : __('You cannot copy content of this page', $this->plugin_name);
			$audio             = (isset($data['audio']) && $data['audio'] != "") ? $data['audio'] : '';
			$styles            = (isset($data['styles']) && $data['styles'] != "") ? json_decode($data['styles'], true) : array(
				"bg_color"         => "#ffffff",
				"text_color"       => "#ff0000",
				"font_size"        => "12",
				"border_color"     => "#b7b7b7",
				"border_width"     => "1",
				"border_radius"    => "3",
				"border_style"     => "solid",
				"tooltip_position" => "mouse",
				"custom_css"       => "",
			);
			$options           = (isset($data['options']) && $data['options'] != "") ? json_decode($data['options'], true) : array(
				"left_click"            => "",
				"developer_tools"       => "checked",
				"context_menu"          => "checked",
				"drag_start"            => "checked",
				"ctrlc"                 => "checked",
				"ctrlv"                 => "checked",
				"ctrls"                 => "checked",
				"ctrla"                 => "checked",
				"ctrlx"                 => "checked",
				"ctrlu"                 => "checked",
				"ctrlf"                 => "checked",
				"f12"                   => "checked",
				"printscreen"           => "checked",
				"left_click_mess"       => "",
				"developer_tools_mess"  => "checked",
				"context_menu_mess"     => "checked",
				"drag_start_mess"       => "checked",
				"ctrlc_mess"            => "checked",
				"ctrlv_mess"            => "checked",
				"ctrls_mess"            => "checked",
				"ctrla_mess"            => "checked",
				"ctrlx_mess"            => "checked",
				"ctrlu_mess"            => "checked",
				"ctrlf_mess"            => "checked",
				"f12_mess"              => "checked",
				"printscreen_mess"      => "checked",
				"enable_text_selecting" => "",
			);
		} else {
			$enable_protection = "checked";
			$except_types      = array();
			$protection_text   = __('You cannot copy content of this page', $this->plugin_name);
			$audio             = '';
			$styles            = array(
				"bg_color"         => "#ffffff",
				"text_color"       => "#ff0000",
				"font_size"        => "12",
				"border_color"     => "#b7b7b7",
				"border_width"     => "1",
				"border_radius"    => "3",
				"border_style"     => "solid",
				"tooltip_position" => "mouse",
				"custom_css"       => "",
			);
			$options           = array(
				"left_click"            => "",
				"developer_tools"       => "checked",
				"context_menu"          => "checked",
				"drag_start"            => "checked",
				"ctrlc"                 => "checked",
				"ctrlv"                 => "checked",
				"ctrls"                 => "checked",
				"ctrla"                 => "checked",
				"ctrlx"                 => "checked",
				"ctrlu"                 => "checked",
				"ctrlf"                 => "checked",
				"f12"                   => "checked",
				"printscreen"           => "checked",
				"left_click_mess"       => "",
				"developer_tools_mess"  => "checked",
				"context_menu_mess"     => "checked",
				"drag_start_mess"       => "checked",
				"ctrlc_mess"            => "checked",
				"ctrlv_mess"            => "checked",
				"ctrls_mess"            => "checked",
				"ctrla_mess"            => "checked",
				"ctrlx_mess"            => "checked",
				"ctrlu_mess"            => "checked",
				"ctrlf_mess"            => "checked",
				"f12_mess"              => "checked",
				"printscreen_mess"      => "checked",
				"enable_text_selecting" => "",
			);
		}

		return array(
			"enable_protection" => $enable_protection,
			"except_types"      => $except_types,
			"protection_text"   => $protection_text,
			"styles"            => $styles,
			"options"           => $options,
			"audio"             => $audio
		);
	}
}