<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://ays-pro.com/
 * @since      1.0.0
 *
 * @package    Secure_Copy_Content_Protection
 * @subpackage Secure_Copy_Content_Protection/admin/partials
 */

//$all_post_types = get_post_types('','objects');
if (isset($_GET['sccp_tab'])) {
	$sccp_tab = $_GET['sccp_tab'];
} else {
	$sccp_tab = 'tab1';
}
$all_post_types = array(
	array('name' => 'post', 'label' => 'Posts'),
	array('name' => 'page', 'label' => 'Pages')
);
$actions        = new Secure_Copy_Content_Protection_Actions($this->plugin_name);
if (isset($_REQUEST['ays_submit'])) {
	$actions->store_data($_REQUEST);
}

$data = $actions->get_data();

?>
<div class="wrap">
    <div class="copy_protection_wrap container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form method="post" enctype="multipart/form-data">
                    <h1 class="wp-heading-inline">
						<?= esc_html(get_admin_page_title()); ?>
						<?php
						submit_button(__('Save changes', $this->plugin_name), 'primary ays-button', 'ays_submit', false, array('id' => 'ays-button-top'));
						?>
                    </h1>
                    <hr>
                    <input type="hidden" name="sccp_tab" value="<?= $sccp_tab; ?>">
					<?php
					wp_nonce_field('sccp_action', 'sccp_action');
					?>
                    <div class="nav-tab-wrapper">
                        <a href="#tab1" data-tab="tab1"
                           class="nav-tab <?= ($sccp_tab == 'tab1') ? 'nav-tab-active' : ''; ?>">
							<?= __('General', $this->plugin_name); ?>
                        </a>
                        <a href="#tab2" data-tab="tab2"
                           class="nav-tab <?= ($sccp_tab == 'tab2') ? 'nav-tab-active' : ''; ?>">
							<?= __('Options', $this->plugin_name); ?>
                        </a>
                        <a href="#tab5" data-tab="tab5"
                           class="nav-tab <?= ($sccp_tab == 'tab5') ? 'nav-tab-active' : ''; ?>">
							<?= __('Styles', $this->plugin_name); ?>
                        </a>
                        <a href="#tab3" data-tab="tab3"
                           class="nav-tab <?= ($sccp_tab == 'tab3') ? 'nav-tab-active' : ''; ?>">
							<?= __('Block IPs', $this->plugin_name); ?>
                        </a>
                        <a href="#tab4" data-tab="tab4"
                           class="nav-tab <?= ($sccp_tab == 'tab4') ? 'nav-tab-active' : ''; ?>">
							<?= __('Block Country', $this->plugin_name); ?>
                        </a>
                        <a href="#tab6" data-tab="tab6"
                           class="nav-tab <?= ($sccp_tab == 'tab6') ? 'nav-tab-active' : ''; ?>">
							<?= __('Content Blocker', $this->plugin_name); ?>
                        </a>
                        <a href="#tab7" data-tab="tab7"
                           class="nav-tab <?= ($sccp_tab == 'tab7') ? 'nav-tab-active' : ''; ?>">
							<?= __('PayPal', $this->plugin_name); ?>
                        </a>
                    </div>

                    <div id="tab1"
                         class="nav-tab-content <?= ($sccp_tab == 'tab1') ? 'nav-tab-content-active' : ''; ?>">
                        <div class="copy_protection_header">
                            <h5><?= __("General", $this->plugin_name); ?></h5>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-4">
                                <label for="sccp_enable_all_posts"><?= __("Enable copy protection in all post types", $this->plugin_name); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?= __('Enable Options category of the plugin', $this->plugin_name) ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-8">
                                <input type="checkbox" class="modern-checkbox" id="sccp_enable_all_posts"
                                       name="sccp_enable_all_posts" <?= $data["enable_protection"]; ?>
                                       value="true">
                                <label for="sccp_enable_all_posts"></label>
                            </div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-4">
                                <label for="sccp_post_types"><?= __("Except this", $this->plugin_name); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?= __('Disable copy paste option for the website, except selected post types', $this->plugin_name) ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-8">
                                <select name="sccp_except_post_types[]" id="sccp_post_types" class="form-control"
                                        multiple="multiple">
									<?php
									foreach ( $all_post_types as $post_type ) {
										$checked = (in_array($post_type['name'], isset($data["except_types"]) ? $data["except_types"] : array())) ? "selected" : "";
										echo "<option value='{$post_type['name']}' {$checked}>{$post_type['label']}</option>";
									}
									?>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-4">
                                <label for="sccp_enable_text_selecting"><?= __("Enable text selecting", $this->plugin_name); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?= __('Enable text selecting. This option will work only on desktop, on mobile devices text selecting is always disabled.', $this->plugin_name) ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-8">
                                <input type="checkbox" class="modern-checkbox" id="sccp_enable_text_selecting"
                                       name="sccp_enable_text_selecting" <?= isset($data["options"]["enable_text_selecting"]) ? $data["options"]["enable_text_selecting"] : "" ?>
                                       value="true">
                                <label for="sccp_enable_text_selecting"></label>
                            </div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-4">
                                <label for="sccp_notification_text"><?= __("Notification text", $this->plugin_name); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?= __('The warning text that appears after copy attempt', $this->plugin_name) ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-8">
								<?php
								$content   = $data["protection_text"];
								$editor_id = 'sccp_notification_text';

								wp_editor($content, $editor_id);
								?>
                            </div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-4">
                                <label for="sccp_upload_audio"><?= __("Upload Audio", $this->plugin_name); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?= __('The audio that plays after copy attempt', $this->plugin_name) ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="javascript:void(0)" class="btn btn-primary upload_audio">Upload audio</a>
                            </div>
                            <div class="col-sm-5">
                                <div class="sccp_upload_audio">
									<?php if (isset($data['audio']) && !empty($data['audio'])) { ?>
                                        <audio id="sccp_audio" controls>
                                            <source src="<?= (isset($data['audio']) && !empty($data['audio'])) ? $data['audio'] : ""; ?>"
                                                    type="audio/mpeg">
                                        </audio>
									<?php } ?>
                                </div>
                                <input type="hidden" class="upload_audio_url" name="upload_audio_url"
                                       value="<?= (isset($data['audio']) && !empty($data['audio'])) ? $data['audio'] : ""; ?>">
                            </div>
                        </div>
                        <hr>
                        <div class="sccp_pro " title="This feature will available in PRO version">
                            <div class="pro_features sccp_general_pro">
                                <div>
                                    <p>
										<?= __("This feature available only in ", $this->plugin_name); ?>
                                        <a href="https://ays-pro.com/index.php/wordpress/secure-copy-content-protection"
                                           target="_blank"
                                           title="PRO feature"><?= __("PRO version!!!", $this->plugin_name); ?></a>
                                    </p>
                                </div>
                            </div>
                            <div class="copy_protection_container form-group row">
                                <div class="col-sm-4">
                                    <label for="sccp_enable_all_posts_for"><?= __("Enable For", $this->plugin_name); ?></label>
                                    <a class="ays_help" data-toggle="tooltip"
                                       title="<?= __('Enable copy protection for the whole website or for one part of it', $this->plugin_name) ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <label for="sccp_enable_all_posts_for_all"><?= __("All", $this->plugin_name); ?></label>
                                    <input type="radio" id="sccp_enable_all_posts_for_all">
                                </div>
                                <div class="col-sm-2">
                                    <label for="sccp_enable_all_posts_for_except"><?= __("Except", $this->plugin_name); ?></label>
                                    <input type="radio" id="sccp_enable_all_posts_for_except" checked>
                                </div>
                                <div class="col-sm-4">
                                    <label for="sccp_enable_all_posts_for_selected"><?= __("Selected", $this->plugin_name); ?></label>
                                    <input type="radio" id="sccp_enable_all_posts_for_selected">
                                </div>
                            </div>
                            <div class="enable_all_posts_for_except">
                                <hr>
                                <div class="copy_protection_container form-group row ">
                                    <div class="col-sm-4">
                                        <label for="sccp_post_types_1"><?= __("Post type ", $this->plugin_name); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?= __('Disable copy protection for certain posts or pages', $this->plugin_name) ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-8">
                                        <select id="sccp_post_types_1" class="form-control" multiple="multiple">
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row ">
                                    <div class="col-sm-4">
                                        <label for="sccp_post_types_2"><?= __("Posts", $this->plugin_name); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?= __('select the titles of the posts', $this->plugin_name) ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-8">
                                        <select id="sccp_post_types_2" class="form-control" multiple="multiple">
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row ">
                                    <div class="col-sm-4">
                                        <label for="sccp_post_types"><?= __("Enable copy protection for roles", $this->plugin_name); ?></label>
                                    </div>
                                    <div class="col-sm-8">

                                        <div class="">
                                            <label for="sccp_enable_all_for_administrator"><?= __("Administrator", $this->plugin_name); ?></label>
                                            <input type="checkbox" id="sccp_enable_all_for_administrator"
                                                   value="Administrator" name="sccp_enable_all_for_administrator"
                                                   checked>
                                        </div>
                                        <div class="">
                                            <label for="sccp_enable_all_for_subscriber"><?= __("Subscriber", $this->plugin_name); ?></label>
                                            <input type="checkbox" id="sccp_enable_all_for_subscriber"
                                                   value="Subscriber" name="sccp_enable_all_for_subscriber" checked>
                                        </div>
                                        <div class="">
                                            <label for="sccp_enable_all_for_contributor"><?= __("Contributor", $this->plugin_name); ?></label>
                                            <input type="checkbox" id="sccp_enable_all_for_contributor"
                                                   value="Contributor" name="sccp_enable_all_for_contributor" checked>
                                        </div>
                                        <div class="">
                                            <label for="sccp_enable_all_for_author"><?= __("Author", $this->plugin_name); ?></label>
                                            <input type="checkbox" id="sccp_enable_all_for_author" value="Author"
                                                   name="sccp_enable_all_for_author" checked>
                                        </div>
                                        <div class="">
                                            <label for="sccp_enable_all_for_editor"><?= __("Editor", $this->plugin_name); ?></label>
                                            <input type="checkbox" id="sccp_enable_all_for_editor" value="Editor"
                                                   name="sccp_enable_all_for_editor" checked>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab2"
                         class="nav-tab-content <?= ($sccp_tab == 'tab2') ? 'nav-tab-content-active' : ''; ?>">
                        <div class="copy_protection_header row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-2">
                                <h5><?= __("Copy Options", $this->plugin_name); ?></h5>
                            </div>
                            <div class="col-sm-2">
                                <h5><?= __("Show Message", $this->plugin_name); ?></h5>
                            </div>
                            <div class="col-sm-2">
                                <h5><?= __("Play Audio", $this->plugin_name); ?></h5>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-3">
                                <label for="sccp_enable_left_click"><?= __("Disable left click", $this->plugin_name); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?= __('Left click is not allowed', $this->plugin_name) ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox-options left" id="sccp_enable_left_click"
                                       name="sccp_enable_left_click" <?= isset($data["options"]["left_click"]) ? $data["options"]["left_click"] : "" ?>
                                       value="true">
                                <label for="sccp_enable_left_click"></label>
                            </div>
                            <div class="col-sm-2 ">
                                <input type="checkbox" class="modern-checkbox left-mess"
                                       id="sccp_enable_left_click_mess"
                                       name="sccp_enable_left_click_mess" <?= isset($data["options"]["left_click_mess"]) ? $data["options"]["left_click_mess"] : ''; ?>
                                       value="true">
                                <label for="sccp_enable_left_click_mess"></label>
                            </div>
                            <div class="col-sm-2 ">
                                <input type="checkbox" class="modern-checkbox left-audio"
                                       id="sccp_enable_left_click_audio"
                                       name="sccp_enable_left_click_audio" <?= isset($data["options"]["left_click_audio"]) ? $data["options"]["left_click_audio"] : ''; ?>
                                       value="true">
                                <label for="sccp_enable_left_click_audio"></label>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-3">
                                <label for="sccp_enable_context_menu"><?= __("Disable right click", $this->plugin_name); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?= __('Right click is not allowed', $this->plugin_name) ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox-options right"
                                       id="sccp_enable_context_menu"
                                       name="sccp_enable_context_menu" <?= isset($data["options"]["context_menu"]) ? $data["options"]["context_menu"] : 'checked'; ?>
                                       value="true">
                                <label for="sccp_enable_context_menu"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox right-mess"
                                       id="sccp_enable_context_menu_mess"
                                       name="sccp_enable_context_menu_mess" <?= isset($data["options"]["context_menu_mess"]) ? $data["options"]["context_menu_mess"] : "checked"; ?>
                                       value="true">
                                <label for="sccp_enable_context_menu_mess"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox right-audio"
                                       id="sccp_enable_right_click_audio"
                                       name="sccp_enable_right_click_audio" <?= isset($data["options"]["right_click_audio"]) ? $data["options"]["right_click_audio"] : ''; ?>
                                       value="true">
                                <label for="sccp_enable_right_click_audio"></label>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-3">
                                <label for="sccp_enable_developer_tools"><?= __("Disable Developer Tools Hot-Keys", $this->plugin_name); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?= __('Not allowed to open developer tools by CTRL+SHIFT+C/CMD+
                                   +C, CTRL+SHIFT+J/CMD+OPT+J, CTRL+SHIFT+I/CMD+OPT+I', $this->plugin_name) ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox-options devtool"
                                       id="sccp_enable_developer_tools"
                                       name="sccp_enable_developer_tools" <?= isset($data["options"]["developer_tools"]) ? $data["options"]["developer_tools"] : 'checked'; ?>
                                       value="true">
                                <label for="sccp_enable_developer_tools"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox devtool-mess"
                                       id="sccp_enable_developer_tools_mess"
                                       name="sccp_enable_developer_tools_mess" <?= isset($data["options"]["developer_tools_mess"]) ? $data["options"]["developer_tools_mess"] : 'checked'; ?>
                                       value="true">
                                <label for="sccp_enable_developer_tools_mess"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox devtool-audio"
                                       id="sccp_enable_developer_tools_audio"
                                       name="sccp_enable_developer_tools_audio" <?= isset($data["options"]["developer_tools_audio"]) ? $data["options"]["developer_tools_audio"] : ''; ?>
                                       value="true">
                                <label for="sccp_enable_developer_tools_audio"></label>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-3">
                                <label for="sccp_enable_drag_start"><?= __("Disable Drag Start", $this->plugin_name); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?= __('Not allowed to move the text', $this->plugin_name) ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox-options dragstart"
                                       id="sccp_enable_drag_start"
                                       name="sccp_enable_drag_start" <?= isset($data["options"]["drag_start"]) ? $data["options"]["drag_start"] : 'checked'; ?>
                                       value="true">
                                <label for="sccp_enable_drag_start"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox dragstart-mess"
                                       id="sccp_enable_drag_start_mess"
                                       name="sccp_enable_drag_start_mess" <?= isset($data["options"]["drag_start_mess"]) ? $data["options"]["drag_start_mess"] : 'checked'; ?>
                                       value="true">
                                <label for="sccp_enable_drag_start_mess"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox dragstart-audio"
                                       id="sccp_enable_drag_start_audio"
                                       name="sccp_enable_drag_start_audio" <?= isset($data["options"]["drag_start_audio"]) ? $data["options"]["drag_start_audio"] : ''; ?>
                                       value="true">
                                <label for="sccp_enable_drag_start_audio"></label>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-3">
                                <label for="sccp_enable_f12"><?= __("Disable F12", $this->plugin_name); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?= __('Inspect element is not available', $this->plugin_name) ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox-options f12" id="sccp_enable_f12"
                                       name="sccp_enable_f12" <?= isset($data["options"]["f12"]) ? $data["options"]["f12"] : 'checked'; ?>
                                       value="true">
                                <label for="sccp_enable_f12"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox f12-mess" id="sccp_enable_f12_mess"
                                       name="sccp_enable_f12_mess" <?= isset($data["options"]["f12_mess"]) ? $data["options"]["f12_mess"] : 'checked'; ?>
                                       value="true">
                                <label for="sccp_enable_f12_mess"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox f12-audio" id="sccp_enable_f12_audio"
                                       name="sccp_enable_f12_audio" <?= isset($data["options"]["f12_audio"]) ? $data["options"]["f12_audio"] : ''; ?>
                                       value="true">
                                <label for="sccp_enable_f12_audio"></label>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-3">
                                <label for="sccp_enable_ctrlc"><?= __("Disable CTRL-C/CMD-C", $this->plugin_name); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?= __('Not allowed to copy the highlighted text', $this->plugin_name) ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox-options ctrlc" id="sccp_enable_ctrlc"
                                       name="sccp_enable_ctrlc" <?= isset($data["options"]["ctrlc"]) ? $data["options"]["ctrlc"] : 'checked'; ?>
                                       value="true">
                                <label for="sccp_enable_ctrlc"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox ctrlc-mess" id="sccp_enable_ctrlc_mess"
                                       name="sccp_enable_ctrlc_mess" <?= isset($data["options"]["ctrlc_mess"]) ? $data["options"]["ctrlc_mess"] : 'checked'; ?>
                                       value="true">
                                <label for="sccp_enable_ctrlc_mess"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox ctrlc-audio" id="sccp_enable_ctrlc_audio"
                                       name="sccp_enable_ctrlc_audio" <?= isset($data["options"]["ctrlc_audio"]) ? $data["options"]["ctrlc_audio"] : ''; ?>
                                       value="true">
                                <label for="sccp_enable_ctrlc_audio"></label>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-3">
                                <label for="sccp_enable_ctrlv"><?= __("Disable CTRL-V/CMD-V", $this->plugin_name); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?= __('Not allowed to paste the highlighted text', $this->plugin_name) ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox-options ctrlv" id="sccp_enable_ctrlv"
                                       name="sccp_enable_ctrlv" <?= isset($data["options"]["ctrlv"]) ? $data["options"]["ctrlv"] : 'checked'; ?>
                                       value="true">
                                <label for="sccp_enable_ctrlv"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox ctrlv-mess" id="sccp_enable_ctrlv_mess"
                                       name="sccp_enable_ctrlv_mess" <?= isset($data["options"]["ctrlv_mess"]) ? $data["options"]["ctrlv_mess"] : 'checked'; ?>
                                       value="true">
                                <label for="sccp_enable_ctrlv_mess"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox ctrlv_audio" id="sccp_enable_ctrlv_audio"
                                       name="sccp_enable_ctrlv_audio" <?= isset($data["options"]["ctrlv_audio"]) ? $data["options"]["ctrlv_audio"] : ''; ?>
                                       value="true">
                                <label for="sccp_enable_ctrlv_audio"></label>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-3">
                                <label for="sccp_enable_ctrls"><?= __("Disable CTRL-S/CMD-S", $this->plugin_name); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?= __('Not allowed to save the highlighted text', $this->plugin_name) ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox-options ctrls" id="sccp_enable_ctrls"
                                       name="sccp_enable_ctrls" <?= isset($data["options"]["ctrls"]) ? $data["options"]["ctrls"] : 'checked'; ?>
                                       value="true">
                                <label for="sccp_enable_ctrls"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox ctrls-mess" id="sccp_enable_ctrls_mess"
                                       name="sccp_enable_ctrls_mess" <?= isset($data["options"]["ctrls_mess"]) ? $data["options"]["ctrls_mess"] : 'checked'; ?>
                                       value="true">
                                <label for="sccp_enable_ctrls_mess"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox ctrls-audio" id="sccp_enable_ctrls_audio"
                                       name="sccp_enable_ctrls_audio" <?= isset($data["options"]["ctrls_audio"]) ? $data["options"]["ctrls_audio"] : ''; ?>
                                       value="true">
                                <label for="sccp_enable_ctrls_audio"></label>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-3">
                                <label for="sccp_enable_ctrla"><?= __("Disable CTRL-A/CMD-A", $this->plugin_name); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?= __('Not allowed to select all', $this->plugin_name) ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox-options ctrla" id="sccp_enable_ctrla"
                                       name="sccp_enable_ctrla" <?= isset($data["options"]["ctrla"]) ? $data["options"]["ctrla"] : 'checked'; ?>
                                       value="true">
                                <label for="sccp_enable_ctrla"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox ctrla-mess" id="sccp_enable_ctrla_mess"
                                       name="sccp_enable_ctrla_mess" <?= isset($data["options"]["ctrla_mess"]) ? $data["options"]["ctrla_mess"] : 'checked'; ?>
                                       value="true">
                                <label for="sccp_enable_ctrla_mess"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox ctrla-audio" id="sccp_enable_ctrla_audio"
                                       name="sccp_enable_ctrla_audio" <?= isset($data["options"]["ctrla_audio"]) ? $data["options"]["ctrla_audio"] : ''; ?>
                                       value="true">
                                <label for="sccp_enable_ctrla_audio"></label>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-3">
                                <label for="sccp_enable_ctrlx"><?= __("Disable CTRL-X/CMD-X", $this->plugin_name); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?= __('Not allowed to cut the highlighted text', $this->plugin_name) ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox-options ctrlx" id="sccp_enable_ctrlx"
                                       name="sccp_enable_ctrlx" <?= isset($data["options"]["ctrlx"]) ? $data["options"]["ctrlx"] : 'checked'; ?>
                                       value="true">
                                <label for="sccp_enable_ctrlx"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox ctrlx-mess" id="sccp_enable_ctrlx_mess"
                                       name="sccp_enable_ctrlx_mess" <?= isset($data["options"]["ctrlx_mess"]) ? $data["options"]["ctrlx_mess"] : 'checked'; ?>
                                       value="true">
                                <label for="sccp_enable_ctrlx_mess"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox ctrlx-audio" id="sccp_enable_ctrlx_audio"
                                       name="sccp_enable_ctrlx_audio" <?= isset($data["options"]["ctrlx_audio"]) ? $data["options"]["ctrlx_audio"] : ''; ?>
                                       value="true">
                                <label for="sccp_enable_ctrlx_audio"></label>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-3">
                                <label for="sccp_enable_ctrlu"><?= __("Disable CTRL-U/CMD-U", $this->plugin_name); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?= __('Not allowed to view source of the page', $this->plugin_name) ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox-options ctrlu" id="sccp_enable_ctrlu"
                                       name="sccp_enable_ctrlu" <?= isset($data["options"]["ctrlu"]) ? $data["options"]["ctrlu"] : 'checked'; ?>
                                       value="true">
                                <label for="sccp_enable_ctrlu"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox ctrlu-mess" id="sccp_enable_ctrlu_mess"
                                       name="sccp_enable_ctrlu_mess" <?= isset($data["options"]["ctrlu_mess"]) ? $data["options"]["ctrlu_mess"] : 'checked'; ?>
                                       value="true">
                                <label for="sccp_enable_ctrlu_mess"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox ctrlu-audio" id="sccp_enable_ctrlu_audio"
                                       name="sccp_enable_ctrlu_audio" <?= isset($data["options"]["ctrlu_audio"]) ? $data["options"]["ctrlu_audio"] : ''; ?>
                                       value="true">
                                <label for="sccp_enable_ctrlu_audio"></label>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-3">
                                <label for="sccp_enable_ctrlf"><?= __("Disable CTRL-F/CMD-F", $this->plugin_name); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?= __('Not allowed to find text on the page', $this->plugin_name) ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox-options ctrlf" id="sccp_enable_ctrlf"
                                       name="sccp_enable_ctrlf" <?= isset($data["options"]["ctrlf"]) ? $data["options"]["ctrlf"] : 'checked'; ?>
                                       value="true">
                                <label for="sccp_enable_ctrlf"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox ctrlf-mess" id="sccp_enable_ctrlf_mess"
                                       name="sccp_enable_ctrlf_mess" <?= isset($data["options"]["ctrlf_mess"]) ? $data["options"]["ctrlf_mess"] : 'checked'; ?>
                                       value="true">
                                <label for="sccp_enable_ctrlf_mess"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox ctrlf-audio" id="sccp_enable_ctrlf_audio"
                                       name="sccp_enable_ctrlf_audio" <?= isset($data["options"]["ctrlf_audio"]) ? $data["options"]["ctrlf_audio"] : ''; ?>
                                       value="true">
                                <label for="sccp_enable_ctrlf_audio"></label>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-3">
                                <label for="sccp_enable_printscreen"><?= __("Disable Print Screen", $this->plugin_name); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?= __('Not allowed to print screen', $this->plugin_name) ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox-options printscreen"
                                       id="sccp_enable_printscreen"
                                       name="sccp_enable_printscreen" <?= isset($data["options"]["printscreen"]) ? $data["options"]["printscreen"] : 'checked'; ?>
                                       value="true">
                                <label for="sccp_enable_printscreen"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox printscreen-mess"
                                       id="sccp_enable_printscreen_mess"
                                       name="sccp_enable_printscreen_mess" <?= isset($data["options"]["printscreen_mess"]) ? $data["options"]["printscreen_mess"] : 'checked'; ?>
                                       value="true">
                                <label for="sccp_enable_printscreen_mess"></label>
                            </div>
                            <div class="col-sm-2">
                                <input type="checkbox" class="modern-checkbox printscreen-audio"
                                       id="sccp_enable_printscreen_audio"
                                       name="sccp_enable_printscreen_audio" <?= isset($data["options"]["printscreen_audio"]) ? $data["options"]["printscreen_audio"] : ''; ?>
                                       value="true">
                                <label for="sccp_enable_printscreen_audio"></label>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <hr>
                        <div class="sccp_pro" title="This feature will available in PRO version">
                            <div class="sccp_pro_bg"></div>
                            <div class="copy_protection_container form-group row">
                                <div class="col-sm-3">
                                    <label for="sccp_enable_f12"><?= __("Disable REST API", $this->plugin_name); ?></label>
                                    <a class="ays_help" data-toggle="tooltip"
                                       title="<?= __('', $this->plugin_name) ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <input type="checkbox" class="modern-checkbox-options rest_api"
                                           id="sccp_enable_rest_api" value="true">
                                    <label for="sccp_enable_rest_api"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab3"
                         class="nav-tab-content only_pro <?= ($sccp_tab == 'tab3') ? 'nav-tab-content-active' : ''; ?>">
                        <div class="pro_features">
                            <div>
                                <p>
									<?= __("This feature available only in ", $this->plugin_name); ?>
                                    <a href="https://ays-pro.com/index.php/wordpress/secure-copy-content-protection"
                                       target="_blank"
                                       title="PRO feature"><?= __("PRO version!!!", $this->plugin_name); ?></a>
                                </p>
                            </div>
                        </div>
                        <div class="copy_protection_header">
                            <h5><?= __("Block IPs", $this->plugin_name); ?></h5>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-4">
                                <button type="button" class="button add_ip_to_block" data-toggle="modal"
                                        data-target="#add_ip_modal"><?= __("Add IP", $this->plugin_name); ?></button>
                            </div>
                            <div class="col-sm-12">
                                <table id="blocked_ips" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Blocked IP</th>
                                        <th>Reason</th>
                                        <th>Block Admin</th>
                                        <th>Block Front</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>192.168.1.1</td>
                                        <td>Unlimited traffic noticed</td>
                                        <td>True</td>
                                        <td>False</td>
                                        <td>2018-12-14</td>
                                    </tr>
                                    <tr>
                                        <td>176.25.43.12</td>
                                        <td>Malware attacks</td>
                                        <td>True</td>
                                        <td>True</td>
                                        <td>2018-12-13</td>
                                    </tr>
                                    <tr>
                                        <td>175.32.16.87</td>
                                        <td>Spammer</td>
                                        <td>True</td>
                                        <td>False</td>
                                        <td>2018-12-14</td>
                                    </tr>
                                    <tr>
                                        <td>192.168.1.1</td>
                                        <td>Unlimited traffic noticed</td>
                                        <td>False</td>
                                        <td>True</td>
                                        <td>2018-12-14</td>
                                    </tr>
                                    <tr>
                                        <td>176.25.43.12</td>
                                        <td>Malware attacks</td>
                                        <td>True</td>
                                        <td>True</td>
                                        <td>2018-12-13</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="tab4"
                         class="nav-tab-content only_pro <?= ($sccp_tab == 'tab4') ? 'nav-tab-content-active' : ''; ?>">
                        <div class="pro_features">
                            <div>
                                <p>
									<?= __("This feature available only in ", $this->plugin_name); ?>
                                    <a href="https://ays-pro.com/index.php/wordpress/secure-copy-content-protection"
                                       target="_blank"
                                       title="PRO feature"><?= __("PRO version!!!", $this->plugin_name); ?></a>
                                </p>
                            </div>
                        </div>
                        <div class="copy_protection_header">
                            <h5><?= __("Block Country", $this->plugin_name); ?></h5>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-4">
                                <button type="button" class="button add_country_to_block" data-toggle="modal"
                                        data-target="#add_country_modal"><?= __("Add Country", $this->plugin_name); ?></button>
                            </div>
                            <div class="col-sm-12">
                                <table id="blocked_countries" class="table table-striped table-bordered"
                                       style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Blocked Country</th>
                                        <th>Reason</th>
                                        <th>Block Admin</th>
                                        <th>Block Front</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>United Arab Emirates</td>
                                        <td>Unlimited traffic noticed</td>
                                        <td>True</td>
                                        <td>False</td>
                                        <td>2018-12-14</td>
                                    </tr>
                                    <tr>
                                        <td>Australia</td>
                                        <td>Malware attacks</td>
                                        <td>True</td>
                                        <td>True</td>
                                        <td>2018-12-13</td>
                                    </tr>
                                    <tr>
                                        <td>Egypt</td>
                                        <td>Spammer</td>
                                        <td>False</td>
                                        <td>True</td>
                                        <td>2018-12-14</td>
                                    </tr>
                                    <tr>
                                        <td>Hong Kong</td>
                                        <td>Unlimited traffic noticed</td>
                                        <td>True</td>
                                        <td>True</td>
                                        <td>2018-12-14</td>
                                    </tr>
                                    <tr>
                                        <td>Yemen</td>
                                        <td>Malware attacks</td>
                                        <td>False</td>
                                        <td>True</td>
                                        <td>2018-12-13</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="tab5"
                         class="nav-tab-content container-fluid <?= ($sccp_tab == 'tab5') ? 'nav-tab-content-active' : ''; ?>">
                        <div class="copy_protection_header">
                            <h5><?= __('Styles', $this->plugin_name); ?></h5>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-6">
                                        <label for="tooltip_position"><?= __('Tooltip position', $this->plugin_name); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?= __('Position of tooltip on window', $this->plugin_name) ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        <select id="tooltip_position" class="form-control" name="tooltip_position">
											<?php
											$tpositions = array(
												"mouse"         => __("Mouse current position", $this->plugin_name),
												"center_center" => __("Center center", $this->plugin_name),
												"left_top"      => __("Left top", $this->plugin_name),
												"left_bottom"   => __("Left bottom", $this->plugin_name),
												"right_top"     => __("Right top", $this->plugin_name),
												"right_bottom"  => __("Right bottom", $this->plugin_name),
											);
											foreach ( $tpositions as $value => $text ) {
												$selected = (isset($data["styles"]["tooltip_position"]) && $data["styles"]["tooltip_position"] == $value) ? "selected" : "";
												echo "<option value='{$value}' {$selected}>{$text}</option>";
											}
											?>
                                        </select>
                                    </div>
                                </div>
                                <hr/>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-6">
                                        <label for="sscp_timeout"><?= __('Tooltip show time (ms)', $this->plugin_name); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?= __('Tooltip show time in milliseconds. 1000ms is default value.', $this->plugin_name) ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" id="sscp_timeout" name="sscp_timeout"
                                               value="<?= isset($data["options"]["timeout"]) ? $data["options"]["timeout"] : 1000 ?>"/>
                                    </div>
                                </div>
                                <hr/>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-6">
                                        <label for="bg_color"><?= __('Tooltip background color', $this->plugin_name); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?= __('Filler color of tooltip', $this->plugin_name) ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="color" id="bg_color" name="bg_color"
                                               value="<?= $data["styles"]["bg_color"]; ?>"/>
                                    </div>
                                </div>
                                <hr/>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-6">
                                        <label for="text_color"><?= __('Tooltip text color', $this->plugin_name); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?= __('Color of tooltip text', $this->plugin_name) ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="color" id="text_color" name="text_color"
                                               value="<?= $data["styles"]["text_color"]; ?>"/>
                                    </div>
                                </div>
                                <hr/>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-6">
                                        <label for="font_size"><?= __('Tooltip Font size', $this->plugin_name); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?= __('Size of tooltip text', $this->plugin_name) ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" id="font_size" name="font_size" class="form-control"
                                               value="<?= isset($data["styles"]["font_size"]) ? $data["styles"]["font_size"] : '12'; ?>"/>
                                    </div>
                                </div>
                                <hr/>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-6">
                                        <label for="border_color"><?= __('Tooltip border color', $this->plugin_name); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?= __('Color of tooltip border', $this->plugin_name) ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="color" id="border_color" name="border_color"
                                               value="<?= $data["styles"]["border_color"]; ?>"/>
                                    </div>
                                </div>
                                <hr/>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-6">
                                        <label for="border_width"><?= __('Tooltip border width', $this->plugin_name); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?= __('This shows the thickness of the border in pixels', $this->plugin_name) ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" id="border_width" name="border_width" class="form-control"
                                               value="<?= $data["styles"]["border_width"]; ?>"/>
                                    </div>
                                </div>
                                <hr/>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-6">
                                        <label for="border_radius"><?= __('Tooltip border radius', $this->plugin_name); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?= __('This shows if the border has curvature', $this->plugin_name) ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" id="border_radius" name="border_radius"
                                               class="form-control"
                                               value="<?= $data["styles"]["border_radius"]; ?>"/>
                                    </div>
                                </div>
                                <hr/>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-6">
                                        <label for="border_style"><?= __('Tooltip border style', $this->plugin_name); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?= __('This shows if the border is highlighted with style', $this->plugin_name) ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        <select id="border_style" class="form-control" name="border_style">
											<?php
											$bstyles      = array("none", "solid", "double", "dotted", "dashed");
											$bstyles_text = array(
												__("None", $this->plugin_name),
												__("Solid", $this->plugin_name),
												__("Double", $this->plugin_name),
												__("Dotted", $this->plugin_name),
												__("Dashed", $this->plugin_name)
											);
											foreach ( $bstyles as $key => $bstyle ) {
												$selected = ($data["styles"]["border_style"] == $bstyle) ? "selected" : "";
												echo "<option value='{$bstyle}' {$selected}>" . $bstyles_text[$key] . "</option>";
											}
											?>
                                        </select>
                                    </div>
                                </div>
                                <hr/>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-6">
                                        <label for="sccp_custom_css">
											<?= __('Custom CSS', $this->plugin_name) ?>
                                            <a class="ays_help" data-toggle="tooltip"
                                               title="<?= __('Field for entering your own CSS code', $this->plugin_name) ?>">
                                                <i class="ays_fa ays_fa_info_circle"></i>
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-6">
                                        <textarea class="ays-textarea" id="sccp_custom_css" name="custom_css" cols="33"
                                                  rows="7"><?= isset($data["styles"]["custom_css"]) ? $data["styles"]["custom_css"] : '' ?></textarea>
                                    </div>
                                </div>
                                <hr/>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-6">
                                        <label for="reset_to_default">
											<?php echo __('Reset styles', $this->plugin_name) ?>
                                            <a class="ays_help" data-toggle="tooltip"
                                               title="<?php echo __('Reset tooltip styles to default values', $this->plugin_name) ?>">
                                                <i class="ays_fa ays_fa_info_circle"></i>
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="button" class="ays-button button-secondary"
                                                id="reset_to_default"><?= __("Reset", $this->plugin_name) ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="copy_protection_container ays_tooltip_container">
                                    <div id="ays_tooltip"><?= isset($data['protection_text']) ? $data['protection_text'] : 'You cannot copy content of this page' ?></div>
                                    <style>
                                        #ays_tooltip {
                                            width: fit-content;
                                            background-color: <?= isset($data["styles"]["bg_color"]) ? $data["styles"]["bg_color"] : '#ffffff' ?>;;
                                            color: <?= isset($data["styles"]["text_color"]) ? $data["styles"]["text_color"] : '#ff0000' ?>;
                                            border-color: <?= isset($data["styles"]["border_color"]) ? $data["styles"]["border_color"] : '#b7b7b7' ?>;
                                            border-width: <?= isset($data["styles"]["border_width"]) ? $data["styles"]["border_width"].'px' : '1px' ?>;
                                            border-radius: <?= isset($data["styles"]["border_radius"]) ? $data["styles"]["border_radius"].'px' : '3px' ?>;
                                            border-style: <?= isset($data["styles"]["border_style"]) ? $data["styles"]["border_style"] : 'solid' ?>;
                                            padding: 5px;
                                            box-sizing: border-box;
                                            margin: 50px auto;
                                        }
                                    </style>
                                    <style id="ays-sccp-custom-styles">
                                        <?= isset($data["styles"]["custom_css"]) ? $data["styles"]["custom_css"] : '' ?>
                                    </style>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="tab6"
                         class="nav-tab-content only_pro <?= ($sccp_tab == 'tab6') ? 'nav-tab-content-active' : ''; ?>">
                        <div class="pro_features">
                            <div>
                                <p>
									<?= __("This feature available only in ", $this->plugin_name); ?>
                                    <a href="https://ays-pro.com/index.php/wordpress/secure-copy-content-protection"
                                       target="_blank"
                                       title="PRO feature"><?= __("PRO version!!!", $this->plugin_name); ?></a>
                                </p>
                            </div>
                        </div>
                        <div class="copy_protection_header">
                            <h5><?= __("Content Blocker", $this->plugin_name); ?></h5>
                        </div>
                        <hr>
                        <button type="button" class="button add_new_content_blocker"
                                style="margin-bottom: 20px"><?= __("Add new", $this->plugin_name) ?></button>
                        <div class="content_blocker_all">
                            <div class="content_blocker_one">
                                <div class="copy_protection_container form-group row">
                                    <div class="col-md-4">
                                        <label for="content_block_post"><?= __('Post', $this->plugin_name); ?></label>
                                        <input type="text" class="form-control" value="Hello World!">
                                    </div>
                                    <div class="col-md-1">
                                        <br>
                                        <p style="margin-top: 15px"><?= __('OR', $this->plugin_name); ?></p>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="content_block_url"><?= __('URL', $this->plugin_name); ?></label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="content_block_pass"><?= __('Password', $this->plugin_name); ?></label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" value="123456">
                                            <div class="input-group-append">
                                                <span class="input-group-text show_password"><i class="fa fa-eye"
                                                                                                aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <br>
                                        <p class="content_delete_icon"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="content_blocker_one">
                                <div class="copy_protection_container form-group row">
                                    <div class="col-md-4">
                                        <label for="content_block_post"><?= __('Post', $this->plugin_name); ?></label>
                                        <input id="content_block_post" type="text" class="form-control" value="Ays Pro">
                                    </div>
                                    <div class="col-md-1">
                                        <br>
                                        <p style="margin-top: 15px"><?= __('OR', $this->plugin_name); ?></p>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="content_block_url"><?= __('URL', $this->plugin_name); ?></label>
                                        <input id="content_block_url" type="text" class="form-control"
                                               value="https://freedemo.ays-pro.com/">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="content_block_pass"><?= __('Password', $this->plugin_name); ?></label>
                                        <div class="input-group">
                                            <input id="content_block_pass" autocomplete="new-password"
                                                   aria-autocomplete="none" type="password" class="form-control"
                                                   value="123456">
                                            <div class="input-group-append">
                                                <span class="input-group-text show_password"><i class="fa fa-eye"
                                                                                                aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <br>
                                        <p class="content_delete_icon"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div id="tab7"
                         class="nav-tab-content only_pro <?= ($sccp_tab == 'tab7') ? 'nav-tab-content-active' : ''; ?>">
                        <div class="pro_features">
                            <div>
                                <p>
									<?= __("This feature available only in ", $this->plugin_name); ?>
                                    <a href="https://ays-pro.com/index.php/wordpress/secure-copy-content-protection"
                                       target="_blank"
                                       title="PRO feature"><?= __("PRO version!!!", $this->plugin_name); ?></a>
                                </p>
                            </div>
                        </div>
                        <div class="copy_protection_header">
                            <h5><?= __('PayPal', $this->plugin_name); ?></h5>
                        </div>
                        <hr/>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-3">
                                <label for="sccp_paypal_client_id"><?= __('PayPal Client ID', $this->plugin_name); ?></label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="ays-text-input select2_style"/>
                            </div>
                        </div>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-12">
                                <blockquote>
									<?= __("You can get your Client ID from", $this->plugin_name); ?>
                                </blockquote>
                            </div>
                        </div>
                        <hr>
                        <button type="button" class="button add_new_paypal"
                                style="margin-bottom: 20px"><?= __('Add new', $this->plugin_name); ?></button>
                        <div class="all_paid_contents">
                            <div class="paypal_one">
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-4">
                                        <label for="sccp_paypal_shortcode"><?= __('Shortcode', $this->plugin_name); ?></label>
                                        <input type="text" class="ays-text-input sccp_paypal_shortcode select2_style"
                                               value="[content id='1']" readonly>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sccp_paypal_amount"><?= __('Amount', $this->plugin_name); ?></label>
                                        <input type="text" class="ays-text-input select2_style" value="100">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="sccp_paypal_currency"><?= __('Currency', $this->plugin_name); ?></label>
                                        <input type="text" class="form-control" value="USD - United States Dollar">
                                    </div>
                                    <div class="col-sm-1">
                                        <br>
                                        <p class="paypal_delete_icon"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="paypal_one">
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-4">
                                        <label for="sccp_paypal_shortcode"><?= __('Shortcode', $this->plugin_name); ?></label>
                                        <input type="text" class="ays-text-input sccp_paypal_shortcode select2_style"
                                               value="[content id='2']" readonly>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sccp_paypal_amount"><?= __('Amount', $this->plugin_name); ?></label>
                                        <input type="text" class="ays-text-input select2_style" value="25">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="sccp_paypal_currency"><?= __('Currency', $this->plugin_name); ?></label>
                                        <input type="text" class="form-control" value="Euro - British Pound Sterling">
                                    </div>
                                    <div class="col-sm-1">
                                        <br>
                                        <p class="paypal_delete_icon"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

					<?php
					//					wp_nonce_field('sccp_action', 'sccp_action');
					submit_button(__('Save changes', $this->plugin_name), 'primary ays-button', 'ays_submit', true, array('id' => 'ays-button'));
					?>
                </form>
            </div>
        </div>
        <div class="modal fade" id="add_ip_modal" tabindex="-1" role="dialog" aria-labelledby="add_ip_modalLabel"
             aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="add_ip_modalLabel"><?= __("Blacklist modal", $this->plugin_name); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-12">
                                <label><?= __("Add IP parts", $this->plugin_name); ?></label>
                            </div>
                            <div class="col-sm-12">
                                <table style="width: 100%">
                                    <tr>
                                        <td><input type="number" maxlength="255" id="ip_first"/></td>
                                        <td><input type="number" maxlength="255" id="ip_second"/></td>
                                        <td><input type="number" maxlength="255" id="ip_third"/></td>
                                        <td><input type="number" maxlength="255" id="ip_fourth"/></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button button-secondary"
                                data-dismiss="modal"><?= __("Close", $this->plugin_name); ?></button>
                        <button type="button"
                                class="button button-primary"><?= __("Add IP", $this->plugin_name); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>