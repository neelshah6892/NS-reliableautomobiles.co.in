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
function theme_sqt_layout_register_settings() {
	register_setting( 'theme_sqt_layout_group', 'theme_sqt_layout' );
}
add_action( 'admin_init', 'theme_sqt_layout_register_settings' );
/**
 * Register the settings page
 */
function theme_sqt_layout_menu() {
	add_theme_page( __( 'Layout options' ), __( 'Layout options' ), 'edit_theme_options', 'theme_sqt_layout', 'theme_sqt_layout_page' );
}
add_action( 'admin_menu', 'theme_sqt_layout_menu' );

function wpdocs_theme_name_scripts() {
	$options = get_option( 'theme_sqt_layout' );
	$layout_selected = $options['layout_selection'];
    if(!is_front_page()){
    	wp_enqueue_style( 'internal-page', home_url().'/wp-content/themes/altitude-pro/css/internal-pages/'.$layout_selected.'.css' );
    }

    $blog_layout_selected = $options['blog_layout_selection'];
    if(!is_front_page()){
    	wp_enqueue_style( 'blog-page', home_url().'/wp-content/themes/altitude-pro/css/blogs/'.$blog_layout_selected.'.css' );
    }
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );

/**
 * Render the settings page
 */
function theme_sqt_layout_page() {
	$options = get_option( 'theme_sqt_layout' ); ?>
	<style>
		form.options_form {background: #FFF; padding: 10px 15px; }
		.form-table td {padding: 10px 10px;}
		input[type=radio] {margin-top: -130px !important;}
		.floL {float: left; margin-right: 20px;}
		.laytext{text-align: center;}
	</style>
	<div class="wrap">
		<h2 style="margin-bottom:20px;"><?php _e('SQT Theme Layout Settings'); ?></h2>
		<form method="post" action="options.php" class="options_form">
			<?php settings_fields( 'theme_sqt_layout_group' ); 

			if( isset( $options['layout_selection'] ) ) {
				$layout_selected = $options['layout_selection'];
			}
			else{
				$layout_selected = 'design1';
			}

			if( isset( $options['blog_layout_selection'] ) ) {
				$blog_layout_selected = $options['blog_layout_selection'];
			}
			else{
				$blog_layout_selected = 'design1';
			}

			?>
			<table class="form-table">
				<tr>
					<th colspan="2" style="padding: 0px 10px 0px 0;"><h3>General Settings</h3></th>
				</tr>
				<tr valign="top">
					<th scop="row">
						<span><?php _e( 'Select design of internal page' ); ?></span>
					</th>
					<td>
						<div class="floL">
							<input class="radio" type="radio" value="design1" id="design1" name="theme_sqt_layout[layout_selection]" <?php if($layout_selected == 'design1'){ echo "checked"; } ?>/> <label for="design1"><img src="<?= home_url(); ?>/wp-content/themes/altitude-pro/lib/admin/layout-preview1.jpg"/> <div class="laytext">Layout1</div></label>
						</div>
						<div class="floL">
							<input class="radio" type="radio" value="design2" id="design2" name="theme_sqt_layout[layout_selection]" <?php if($layout_selected =='design2'){ echo "checked"; } ?>/> <label for="design2"><img src="<?= home_url(); ?>/wp-content/themes/altitude-pro/lib/admin/layout-preview2.jpg" /> <div class="laytext">Layout2</div></label>
						</div>
						<div class="floL">
							<input class="radio" type="radio" value="design3" id="design3" name="theme_sqt_layout[layout_selection]" <?php if($layout_selected == 'design3'){ echo "checked"; } ?>/> <label for="design3"><img src="<?= home_url(); ?>/wp-content/themes/altitude-pro/lib/admin/layout-preview.png" /> <div class="laytext">Layout3</div></label>
						</div>
						<div class="floL">
							<input class="radio" type="radio" value="design4" id="design4" name="theme_sqt_layout[layout_selection]" <?php if($layout_selected == 'design4'){ echo "checked"; } ?>/> <label for="design4"><img src="<?= home_url(); ?>/wp-content/themes/altitude-pro/lib/admin/layout-preview.png" /> <div class="laytext">Layout4</div></label>
						</div>
					</td>
				</tr>
				<tr valign="top">
					<th scop="row">
						<span><?php _e( 'Select design of Blog page' ); ?></span>
					</th>
					<td>
						<div class="floL">
							<input class="radio" type="radio" value="blog_design1" id="blog_design1" name="theme_sqt_layout[blog_layout_selection]" <?php if($blog_layout_selected == 'blog_design1'){ echo "checked"; } ?>/> <label for="blog_design1"><img src="<?= home_url(); ?>/wp-content/themes/altitude-pro/lib/admin/layout-preview.png"/> <div class="laytext">Layout1</div></label>
						</div>
						<div class="floL">
							<input class="radio" type="radio" value="blog_design2" id="blog_design2" name="theme_sqt_layout[blog_layout_selection]" <?php if($blog_layout_selected =='blog_design2'){ echo "checked"; } ?>/> <label for="blog_design2"><img src="<?= home_url(); ?>/wp-content/themes/altitude-pro/lib/admin/layout-preview.png" /> <div class="laytext">Layout2</div></label>
						</div>
						<div class="floL">
							<input class="radio" type="radio" value="blog_design3" id="blog_design3" name="theme_sqt_layout[blog_layout_selection]" <?php if($blog_layout_selected == 'blog_design3'){ echo "checked"; } ?>/> <label for="blog_design3"><img src="<?= home_url(); ?>/wp-content/themes/altitude-pro/lib/admin/layout-preview.png" /> <div class="laytext">Layout3</div></label>
						</div>
						<div class="floL">
							<input class="radio" type="radio" value="blog_design4" id="blog_design4" name="theme_sqt_layout[blog_layout_selection]" <?php if($blog_layout_selected == 'blog_design4'){ echo "checked"; } ?>/> <label for="blog_design4"><img src="<?= home_url(); ?>/wp-content/themes/altitude-pro/lib/admin/layout-preview.png" /> <div class="laytext">Layout4</div></label>
						</div>
					</td>
				</tr>
				<!-- <tr>
					<th scop="row">
						<label for="theme_sqt_layout[text]"><?php //_e( 'Text' ); ?></label>
					</th>
					<td>
						<input class="regular-text" placeholder="https://www.text.com/" type="text" id="theme_sqt_layout[text]" style="width: 400px;" name="theme_sqt_layout[text]" value="<?php if( isset( $options['text'] ) ) { echo esc_attr( $options['text'] ); } ?>"/>
						<p class="description"><?php //_e( 'Enter full URL of text.' ); ?></p>
					</td>
				</tr> -->
			</table>
			<?php submit_button('Update layout settings &rarr;'); ?>
		</form>
		<div class="metabox-holder">
			<div class="postbox">
				<h3><span><?php _e( 'Export Settings' ); ?></span></h3>
				<div class="inside">
					<p><?php _e( 'Export the plugin settings for this site as a .json file. This allows you to easily import the configuration into another site.' ); ?></p>
					<form method="post">
						<p><input type="hidden" name="theme_sqt_layout_action" value="export_settings" /></p>
						<p>
							<?php wp_nonce_field( 'theme_sqt_layout_export_nonce', 'theme_sqt_layout_export_nonce' ); ?>
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
							<input type="hidden" name="theme_sqt_layout_action" value="import_settings"/>
							<?php wp_nonce_field( 'theme_sqt_layout_import_nonce', 'theme_sqt_layout_import_nonce' ); ?>
							<?php submit_button( __( 'Import' ), 'secondary', 'submit', false ); ?>
						</p>
					</form>
				</div><!-- .inside -->
			</div><!-- .postbox -->
		</div><!-- .metabox-holder -->
	</div><!--end .wrap-->
	<div style="float: right; margin-right: 23px; font-size: 10px;" title="Layout options by RaVi VAdHEl">Layout options by RaVi VAdHEl</div>
	<?php
}
/**
 * Process a settings export that generates a .json file of the shop settings
 */
function theme_sqt_layout_process_settings_export() {
	if( empty( $_POST['theme_sqt_layout_action'] ) || 'export_settings' != $_POST['theme_sqt_layout_action'] )
		return;
	if( ! wp_verify_nonce( $_POST['theme_sqt_layout_export_nonce'], 'theme_sqt_layout_export_nonce' ) )
		return;
	if( ! current_user_can( 'manage_options' ) )
		return;
	$settings = get_option( 'theme_sqt_layout' );
	ignore_user_abort( true );
	nocache_headers();
	header( 'Content-Type: application/json; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename=theme_sqt_layout-settings-export-' . date( 'm-d-Y' ) . '.json' );
	header( "Expires: 0" );
	echo json_encode( $settings );
	exit;
}
add_action( 'admin_init', 'theme_sqt_layout_process_settings_export' );
/**
 * Process a settings import from a json file
 */
function theme_sqt_layout_process_settings_import() {
	if( empty( $_POST['theme_sqt_layout_action'] ) || 'import_settings' != $_POST['theme_sqt_layout_action'] )
		return;
	if( ! wp_verify_nonce( $_POST['theme_sqt_layout_import_nonce'], 'theme_sqt_layout_import_nonce' ) )
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
	update_option( 'theme_sqt_layout', $settings );
	wp_safe_redirect( admin_url( 'themes.php?page=theme_sqt_layout' ) ); exit;
}
add_action( 'admin_init', 'theme_sqt_layout_process_settings_import' );