<?php
/**
 * Plugin Name: Settings Import / Export Example Plugin
 * Plugin URI: http://pippinsplugins.com/building-settings-import-export-feature/
 * Description: An example plugin that shows how to create a settings import and export feature
 * Author: Pippin Williamson
 * Author URI: http://pippinsplugins.com
 * Version: 1.0
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Register the plugin options
 */
function theme_sqt_register_settings() {
	register_setting( 'theme_sqt_group', 'theme_sqt' );
}
add_action( 'admin_init', 'theme_sqt_register_settings' );
/**
 * Register the settings page
 */
function theme_sqt_menu() {
	add_theme_page( __( 'Theme options' ), __( 'Theme options' ), 'edit_theme_options', 'theme_sqt', 'theme_sqt_page' );
}
add_action( 'admin_menu', 'theme_sqt_menu' );
/**
 * Render the settings page
 */
function theme_sqt_page() {
	$options = get_option( 'theme_sqt' ); ?>
	<style>
		form.options_form {background: #FFF; padding: 10px 15px; }
		.form-table td {padding: 10px 10px;}
	</style>
	<div class="wrap">
		<h2 style="margin-bottom:20px;"><?php _e('SQT Theme Settings'); ?></h2>
		<form method="post" action="options.php" class="options_form">
			<?php settings_fields( 'theme_sqt_group' ); ?>
			<table class="form-table">
				<tr>
					<th colspan="2" style="padding: 0px 10px 0px 0;"><h3>General Settings</h3></th>
				</tr>
				<tr valign="top">
					<th scop="row">
						<label for="theme_sqt[header_phone]"><?php _e( 'Header Phone' ); ?></label>
					</th>
					<td>
						<input class="regular-text" type="text" id="theme_sqt[header_phone]" style="width: 400px;" name="theme_sqt[header_phone]" value="<?php if( isset( $options['header_phone'] ) ) { echo esc_attr( $options['header_phone'] ); } ?>"/>
						<p class="description"><?php _e( 'Enter phone number which you want to show on header area.'); ?></p>
					</td>
				</tr>
				<tr>
					<th scop="row">
						<label for="theme_sqt[header_email]"><?php _e( 'Header Email' ); ?></label>
					</th>
					<td>
						<input class="regular-text" type="email" id="theme_sqt[header_email]" style="width: 400px;" name="theme_sqt[header_email]" value="<?php if( isset( $options['header_email'] ) ) { echo esc_attr( $options['header_email'] ); } ?>"/>
						<p class="description"><?php _e( 'Enter email ID which you want to show on header area.'); ?></p>
					</td>
				</tr>
				<tr>
					<th scop="row">
						<label for="theme_sqt[footer_phone]"><?php _e( 'Footer Phone' ); ?></label>
					</th>
					<td>
						<input class="regular-text" type="text" id="theme_sqt[footer_phone]" style="width: 400px;" name="theme_sqt[footer_phone]" value="<?php if( isset( $options['footer_phone'] ) ) { echo esc_attr( $options['footer_phone'] ); } ?>"/>
						<p class="description"><?php _e( 'Enter phone number which you want to show on footer area.'); ?></p>
					</td>
				</tr>
				<tr>
					<th scop="row">
						<label for="theme_sqt[footer_email]"><?php _e( 'Footer Email' ); ?></label>
					</th>
					<td>
						<input class="regular-text" type="email" id="theme_sqt[footer_email]" style="width: 400px;" name="theme_sqt[footer_email]" value="<?php if( isset( $options['footer_email'] ) ) { echo esc_attr( $options['footer_email'] ); } ?>"/>
						<p class="description"><?php _e( 'Enter email ID which you want to show on footer area.'); ?></p>
					</td>
				</tr>
				<tr>
					<th colspan="2" style="padding: 0px 10px 0px 0;"><hr/><h3>Social Media</h3></th>
				</tr>
				<tr>
					<th scop="row">
						<label for="theme_sqt[facebook]"><?php _e( 'Facebook' ); ?></label>
					</th>
					<td>
						<input class="regular-text" placeholder="https://www.facebook.com/" type="text" id="theme_sqt[facebook]" style="width: 400px;" name="theme_sqt[facebook]" value="<?php if( isset( $options['facebook'] ) ) { echo esc_attr( $options['facebook'] ); } ?>"/>
						<p class="description"><?php _e( 'Enter full URL of Facebook.' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scop="row">
						<label for="theme_sqt[twitter]"><?php _e( 'Twitter' ); ?></label>
					</th>
					<td>
						<input class="regular-text" placeholder="https://www.twitter.com/" type="text" id="theme_sqt[twitter]" style="width: 400px;" name="theme_sqt[twitter]" value="<?php if( isset( $options['twitter'] ) ) { echo esc_attr( $options['twitter'] ); } ?>"/>
						<p class="description"><?php _e( 'Enter full URL of Twitter.' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scop="row">
						<label for="theme_sqt[gplus]"><?php _e( 'Google+' ); ?></label>
					</th>
					<td>
						<input class="regular-text" placeholder="https://www.plus.google.com/" type="text" id="theme_sqt[gplus]" style="width: 400px;" name="theme_sqt[gplus]" value="<?php if( isset( $options['gplus'] ) ) { echo esc_attr( $options['gplus'] ); } ?>"/>
						<p class="description"><?php _e( 'Enter full URL of Google+.' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scop="row">
						<label for="theme_sqt[youtube]"><?php _e( 'Youtube' ); ?></label>
					</th>
					<td>
						<input class="regular-text" placeholder="https://www.youtube.com/" type="text" id="theme_sqt[youtube]" style="width: 400px;" name="theme_sqt[youtube]" value="<?php if( isset( $options['youtube'] ) ) { echo esc_attr( $options['youtube'] ); } ?>"/>
						<p class="description"><?php _e( 'Enter full URL of Youtube.' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scop="row">
						<label for="theme_sqt[linkedin]"><?php _e( 'Linkedin' ); ?></label>
					</th>
					<td>
						<input class="regular-text" placeholder="https://www.linkedin.com/" type="text" id="theme_sqt[linkedin]" style="width: 400px;" name="theme_sqt[linkedin]" value="<?php if( isset( $options['linkedin'] ) ) { echo esc_attr( $options['linkedin'] ); } ?>"/>
						<p class="description"><?php _e( 'Enter full URL of Linkedin.' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scop="row">
						<label for="theme_sqt[instagram]"><?php _e( 'Instagram' ); ?></label>
					</th>
					<td>
						<input class="regular-text" placeholder="https://www.instagram.com/" type="text" id="theme_sqt[instagram]" style="width: 400px;" name="theme_sqt[instagram]" value="<?php if( isset( $options['instagram'] ) ) { echo esc_attr( $options['instagram'] ); } ?>"/>
						<p class="description"><?php _e( 'Enter full URL of Instagram.' ); ?></p>
					</td>
				</tr>
			</table>
			<?php submit_button('Update options &rarr;'); ?>
		</form>
		<div class="metabox-holder">
			<div class="postbox">
				<h3><span><?php _e( 'Export Settings' ); ?></span></h3>
				<div class="inside">
					<p><?php _e( 'Export the plugin settings for this site as a .json file. This allows you to easily import the configuration into another site.' ); ?></p>
					<form method="post">
						<p><input type="hidden" name="theme_sqt_action" value="export_settings" /></p>
						<p>
							<?php wp_nonce_field( 'theme_sqt_export_nonce', 'theme_sqt_export_nonce' ); ?>
							<?php submit_button( __( 'Export' ), 'secondary', 'submit', false ); ?>
						</p>
					</form>
				</div><!-- .inside -->
			</div><!-- .postbox -->
			<div class="postbox">
				<h3><span><?php _e( 'Import Settings' ); ?></span></h3>
				<div class="inside">
					<p><?php _e( 'Import the plugin settings from a .json file. This file can be obtained by exporting the settings on another site using the form above.' ); ?></p>
					<form method="post" enctype="multipart/form-data">
						<p>
							<input type="file" name="import_file" required/>
						</p>
						<p>
							<input type="hidden" name="theme_sqt_action" value="import_settings"/>
							<?php wp_nonce_field( 'theme_sqt_import_nonce', 'theme_sqt_import_nonce' ); ?>
							<?php submit_button( __( 'Import' ), 'secondary', 'submit', false ); ?>
						</p>
					</form>
				</div><!-- .inside -->
			</div><!-- .postbox -->
		</div><!-- .metabox-holder -->
	</div><!--end .wrap-->
	<div style="float: right; margin-right: 23px; font-size: 10px;" title="Theme options by RaVi VAdHEl">Theme options by RaVi VAdHEl</div>
	<?php
}
/**
 * Process a settings export that generates a .json file of the shop settings
 */
function theme_sqt_process_settings_export() {
	if( empty( $_POST['theme_sqt_action'] ) || 'export_settings' != $_POST['theme_sqt_action'] )
		return;
	if( ! wp_verify_nonce( $_POST['theme_sqt_export_nonce'], 'theme_sqt_export_nonce' ) )
		return;
	if( ! current_user_can( 'manage_options' ) )
		return;
	$settings = get_option( 'theme_sqt' );
	ignore_user_abort( true );
	nocache_headers();
	header( 'Content-Type: application/json; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename=theme_sqt-settings-export-' . date( 'd-m-Y h-i-s' ) . '.json' );
	header( "Expires: 0" );
	echo json_encode( $settings );
	exit;
}
add_action( 'admin_init', 'theme_sqt_process_settings_export' );
/**
 * Process a settings import from a json file
 */
function theme_sqt_process_settings_import() {
	if( empty( $_POST['theme_sqt_action'] ) || 'import_settings' != $_POST['theme_sqt_action'] )
		return;
	if( ! wp_verify_nonce( $_POST['theme_sqt_import_nonce'], 'theme_sqt_import_nonce' ) )
		return;
	if( ! current_user_can( 'manage_options' ) )
		return;
	if($_FILES['import_file']['name'] != ""){
		$extension = end( explode( '.', $_FILES['import_file']['name'] ) );
		if( $extension != 'json' ) {
			wp_die( __( 'Please upload a valid .json file' ) );
		}
		$import_file = $_FILES['import_file']['tmp_name'];
		if( empty( $import_file ) ) {
			wp_die( __( 'Please upload a file to import' ) );
		}
	}
	// Retrieve the settings from the file and convert the json object to an array.
	$settings = (array) json_decode( file_get_contents( $import_file ) );
	update_option( 'theme_sqt', $settings );
	wp_safe_redirect( admin_url( 'themes.php?page=theme_sqt' ) ); exit;
}
add_action( 'admin_init', 'theme_sqt_process_settings_import' );