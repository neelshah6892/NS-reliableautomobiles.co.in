<?php
/*
Plugin Name: Click to Chat
Plugin URI:  https://wordpress.org/plugins/click-to-chat-for-whatsapp/
Description: Lets make your Web page visitor contact you through WhatsApp with a single click/tap
Version:     1.7.2
Author:      HoliThemes
Author URI:  https://holithemes.com/whatsapp-chat/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: click-to-chat-for-whatsapp
*/

if ( ! defined( 'WPINC' ) ) {
	die('dont try to call this directly');
}

// define HT_CCW_VERSION
if ( ! defined( 'HT_CCW_VERSION' ) ) {
	define( 'HT_CCW_VERSION', '1.7.2' );
}

// define HT_CCW_PLUGIN_FILE
if ( ! defined( 'HT_CCW_PLUGIN_FILE' ) ) {
	define( 'HT_CCW_PLUGIN_FILE', __FILE__ );
}

// include main file
require_once 'prev/inc/class-ht-ccw.php';

// create instance for the main file - HT_CCW
function ht_ccw() {
	return HT_CCW::instance();
}

ht_ccw();