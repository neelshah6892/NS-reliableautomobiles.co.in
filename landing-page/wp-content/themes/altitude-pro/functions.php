<?php
@ob_start();
/**
 * Altitude Pro.
 *
 * This file adds the functions to the Altitude Pro Theme.
 *
 * @package Altitude
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/altitude/
 */
// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );
// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );
// Set Localization (do not remove).
add_action( 'after_setup_theme', 'altitude_localization_setup' );
function altitude_localization_setup(){ load_child_theme_textdomain( 'altitude-pro', get_stylesheet_directory() . '/languages' ); }
// Add the theme helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );
// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );
// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );
// Include the WooCommerce setup functions.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );
// Include the WooCommerce custom CSS if customized.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );
// Include notice to install Genesis Connect for WooCommerce.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );
// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Altitude Pro' );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/altitude/' );
define( 'CHILD_THEME_VERSION', '1.1.3' );
// Enqueue scripts and styles.
add_action( 'wp_footer', 'altitude_enqueue_scripts_styles' );
function altitude_enqueue_scripts_styles() {
	wp_enqueue_script( 'altitude-global', get_stylesheet_directory_uri() . '/js/global.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_style( 'dashicons' );
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'altitude-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menus' . $suffix . '.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script('altitude-responsive-menu', 'genesis_responsive_menu', altitude_responsive_menu_settings() );
}
// Define our responsive menu settings.
function altitude_responsive_menu_settings() {
	$settings = array(
		'mainMenu'    => __( 'Menu', 'altitude-pro' ),
		'subMenu'     => __( 'Submenu', 'altitude-pro' ),
		'menuClasses' => array(
			'combine' => array(
				'.nav-primary',
				'.nav-secondary',
			),
		),
	);
	return $settings;
}
// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );
// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );
// Add new image sizes.
add_image_size( 'featured-page', 1140, 400, TRUE );
// Add support for 1-column footer widget area.
add_theme_support( 'genesis-footer-widgets', 1 );
// Add support for footer menu.
add_theme_support( 'genesis-menus', array( 'secondary' => __( 'Before Header Menu', 'altitude-pro' ), 'primary' => __( 'Header Menu', 'altitude-pro' ), 'footer' => __( 'Footer Menu', 'altitude-pro' ) ) );
// Unregister the header right widget area.
unregister_sidebar( 'header-right' );
// Reposition the primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );
// Remove output of primary navigation right extras.
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );
// Remove navigation meta box.
add_action( 'genesis_theme_settings_metaboxes', 'altitude_remove_genesis_metaboxes' );
function altitude_remove_genesis_metaboxes( $_genesis_theme_settings_pagehook ) {
    remove_meta_box( 'genesis-theme-settings-nav', $_genesis_theme_settings_pagehook, 'main' );
}
// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_header', 'genesis_do_subnav', 5 );
// Remove skip link for primary navigation.
add_filter( 'genesis_skip_links_output', 'altitude_skip_links_output' );
function altitude_skip_links_output( $links ) {
	if ( isset( $links['genesis-nav-primary'] ) ) {
		unset( $links['genesis-nav-primary'] );
	}
	return $links;
}
// Add secondary-nav class if secondary navigation is used.
add_filter( 'body_class', 'altitude_secondary_nav_class' );
function altitude_secondary_nav_class( $classes ) {
	$menu_locations = get_theme_mod( 'nav_menu_locations' );
	if ( ! empty( $menu_locations['secondary'] ) ) {
		$classes[] = 'secondary-nav';
	}
	return $classes;
}
// Hook menu in footer.
add_action( 'genesis_footer', 'altitude_footer_menu', 7 );
function altitude_footer_menu() {
	genesis_nav_menu( array('theme_location' => 'footer', 'container'=> false, 'depth'=> 1, 'fallback_cb'=> false, 'menu_class'=> 'genesis-nav-menu', ) );
}
// Add Attributes for Footer Navigation.
add_filter( 'genesis_attr_nav-footer', 'genesis_attributes_nav' );
// Unregister layout settings.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
// Unregister secondary sidebar.
unregister_sidebar( 'sidebar-alt' );
// Add support for custom header.
add_theme_support( 'custom-header', array('flex-height'=> true, 'width' => 720, 'height'=> 152, 'header-selector' => '.site-title a', 'header-text'     => false, ) );
// Add support for structural wraps.
add_theme_support( 'genesis-structural-wraps', array('header', 'nav', 'subnav', 'footer-widgets', 'footer', ) );
// Modify the size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'altitude_author_box_gravatar' );
function altitude_author_box_gravatar( $size ) {
	return 176;
}
// Modify the size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'altitude_comments_gravatar' );
function altitude_comments_gravatar( $args ) {
	$args['avatar_size'] = 120;
	return $args;
}
// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );
// Relocate after entry widget.
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );
// Setup widget counts.
function altitude_count_widgets( $id ) {
	$sidebars_widgets = wp_get_sidebars_widgets();
	if ( isset( $sidebars_widgets[ $id ] ) ) {
		return count( $sidebars_widgets[ $id ] );
	}
}
function altitude_widget_area_class( $id ) {
	$count = altitude_count_widgets( $id );
	$class = '';
	if ( $count == 1 ) {$class .= ' widget-full'; } elseif ( $count % 3 == 1 ) {$class .= ' widget-thirds'; } elseif ( $count % 4 == 1 ) {$class .= ' widget-fourths'; } elseif ( $count % 2 == 0 ) {$class .= ' widget-halves uneven'; } else {$class .= ' widget-halves'; }
	return $class;
}
// Relocate the post info.
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
// add_action( 'genesis_entry_header', 'genesis_post_info', 5 );
// Customize the entry meta in the entry header.
add_filter( 'genesis_post_info', 'altitude_post_info_filter' );
function altitude_post_info_filter( $post_info ) {$post_info = '[post_date format="M d Y"] [post_edit]'; return $post_info; }

// Customize the entry meta in the entry footer.
add_filter( 'genesis_post_meta', 'altitude_post_meta_filter' );
function altitude_post_meta_filter( $post_meta ) {// $post_meta = 'Written by [post_author_posts_link] [post_categories before=" &middot; Categorized: "]  [post_tags before=" &middot; Tagged: "]'; $post_meta = ''; return $post_meta; 
}

// Register widget areas.
genesis_register_sidebar( array(
	'id'          => 'front-page-1',
	'name'        => __( 'Front Page 1', 'altitude-pro' ),
	'description' => __( 'This is the front page 1 section.', 'altitude-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-2',
	'name'        => __( 'Front Page 2', 'altitude-pro' ),
	'description' => __( 'This is the front page 2 section.', 'altitude-pro' ),
) );

//* Add support for structural wraps
add_theme_support('genesis-structural-wraps', array('header', 'nav', 'subnav', 'footer-widgets', 'footer'));
//* Remove comment form allowed tags
add_filter('comment_form_defaults', 'altitude_remove_comment_form_allowed_tags');
function altitude_remove_comment_form_allowed_tags($defaults) { $defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . _x('Comment', 'noun', 'altitude') . '</label> <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>'; $defaults['comment_notes_after'] = ''; return $defaults; }

//* Add support for after entry widget
add_theme_support('genesis-after-entry-widget-area');
//* Relocate the post info
remove_action('genesis_entry_header', 'genesis_post_info', 12);
add_action('genesis_entry_header', 'genesis_post_info', 5);
remove_action('wp_head', 'rel_canonical');
function at_remove_dup_canonical_link() {return false;}

add_filter('wpseo_canonical', 'at_remove_dup_canonical_link');
add_filter('genesis_seo_title', 'child_header_title', 10, 3);
function child_header_title($title, $inside, $wrap) {$inside = sprintf('<a href="' . site_url() . '" title="%s">%s</a>', esc_attr(get_bloginfo('name')), get_bloginfo('name')); return sprintf('<%1$s class="site-title">%2$s</%1$s>', $wrap, $inside); }
remove_action('genesis_entry_header', 'genesis_entry_header_markup_open', 5);
remove_action('genesis_entry_header', 'genesis_entry_header_markup_close', 15);
remove_action('genesis_entry_header', 'genesis_do_post_title');
remove_action('genesis_entry_header', 'genesis_post_info', 12);
remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_footer', 'genesis_footer_markup_close', 15);

function rw_jquery_updater2()
{
    // jQuery
    // Deregister core jQuery
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery','/wp-content/themes/altitude-pro/js/jquery-3.2.1.min.js', false, '3.2.1');

    // jQuery Migrate
    // Deregister core jQuery Migrate
    wp_deregister_script('jquery-migrate');
    wp_enqueue_script('jquery-migrate','/wp-content/themes/altitude-pro/js/jquery-migrate-3.0.0.min.js', array('jquery'), '3.0.0'); // require jquery, as loaded above
}
// Front-End
add_action('wp_enqueue_scripts', 'rw_jquery_updater2');

//==================================================  Above are THEME SETTING, please do not touch to it.   =====================================================
//================================================================== Below is the custom code. ==================================================================

// Menu Display code start
include_once( CHILD_DIR . '/lib/image-cropping.php' );
require_once( CHILD_DIR . '/lib/admin/theme-options.php' );
require_once( CHILD_DIR . '/lib/admin/layout-options.php' );

//After header for featured image before the content
add_filter('genesis_after_header', 'genesis_after_header_inner');
function genesis_after_header_inner() {

	if(is_post_type_archive( 'projects' )){
		echo '
		<div class="outer-div">
		    <div class="inner-div">
		        <div class="h1">Projects</div>
		    </div>
		</div>';
	}
	else if(!is_front_page() && !is_category()){
		$post_id = get_the_ID();
        $feat_image =  wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full' );
        $image_url = $feat_image[0];

        echo '<div class="featured_image_area" style="background:url('.$image_url.');">
	            <div class="wrap">
	            	<div class="header-title">
	        	    	<div class="h1 inner-heading" itemprop="headline">' . get_the_title() . '</div>
	        		</div>
	        	</div>
             </div>';
	}
}

//Footer area code
add_action( 'genesis_footer', 'genesis_do_footer2' );
function genesis_do_footer2(){
	$options = get_option( 'theme_sqt' );
	$facebook = $options['facebook'];
    $twitter = $options['twitter'];
    $gplus = $options['gplus'];
    $youtube = $options['youtube'];
    $linkedin = $options['linkedin'];
    $instagram = $options['instagram'];
	if ($facebook != "") {
        echo '<a href="' . $facebook . '" title="Visit our Facebook page" target="_blank">
        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"width="25px" height="25px" viewBox="0 0 96.124 96.123" style="enable-background:new 0 0 96.124 96.123;"xml:space="preserve"> <g> <path d="M72.089,0.02L59.624,0C45.62,0,36.57,9.285,36.57,23.656v10.907H24.037c-1.083,0-1.96,0.878-1.96,1.961v15.803 c0,1.083,0.878,1.96,1.96,1.96h12.533v39.876c0,1.083,0.877,1.96,1.96,1.96h16.352c1.083,0,1.96-0.878,1.96-1.96V54.287h14.654 c1.083,0,1.96-0.877,1.96-1.96l0.006-15.803c0-0.52-0.207-1.018-0.574-1.386c-0.367-0.368-0.867-0.575-1.387-0.575H56.842v-9.246 c0-4.444,1.059-6.7,6.848-6.7l8.397-0.003c1.082,0,1.959-0.878,1.959-1.96V1.98C74.046,0.899,73.17,0.022,72.089,0.02z"/> </g> </svg>
        </a>';
    }
    if ($twitter != "") {
        echo '<a href="' . $twitter . '" title="Visit our Twitter handler" target="_blank">
        	<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"width="25px" height="25px" viewBox="0 0 512.002 512.002" style="enable-background:new 0 0 512.002 512.002;"xml:space="preserve"> <g> <path d="M512.002,97.211c-18.84,8.354-39.082,14.001-60.33,16.54c21.686-13,38.342-33.585,46.186-58.115 c-20.299,12.039-42.777,20.78-66.705,25.49c-19.16-20.415-46.461-33.17-76.674-33.17c-58.011,0-105.042,47.029-105.042,105.039 c0,8.233,0.929,16.25,2.72,23.939c-87.3-4.382-164.701-46.2-216.509-109.753c-9.042,15.514-14.223,33.558-14.223,52.809 c0,36.444,18.544,68.596,46.73,87.433c-17.219-0.546-33.416-5.271-47.577-13.139c-0.01,0.438-0.01,0.878-0.01,1.321 c0,50.894,36.209,93.348,84.261,103c-8.813,2.399-18.094,3.687-27.674,3.687c-6.769,0-13.349-0.66-19.764-1.888 c13.368,41.73,52.16,72.104,98.126,72.949c-35.95,28.176-81.243,44.967-130.458,44.967c-8.479,0-16.84-0.496-25.058-1.471 c46.486,29.807,101.701,47.197,161.021,47.197c193.211,0,298.868-160.062,298.868-298.872c0-4.554-0.104-9.084-0.305-13.59 C480.111,136.775,497.92,118.275,512.002,97.211z"/> </g></svg>
        </a>';
    }
    if ($gplus != "") {
        echo '<a href="' . $gplus . '" title="Visit our Google+ page" target="_blank">
        	<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"width="25px" height="25px"viewBox="0 0 491.858 491.858" style="enable-background:new 0 0 491.858 491.858;" xml:space="preserve"> <g> <path d="M377.472,224.957H201.319v58.718H308.79c-16.032,51.048-63.714,88.077-120.055,88.077 c-69.492,0-125.823-56.335-125.823-125.824c0-69.492,56.333-125.823,125.823-125.823c34.994,0,66.645,14.289,89.452,37.346 l42.622-46.328c-34.04-33.355-80.65-53.929-132.074-53.929C84.5,57.193,0,141.693,0,245.928s84.5,188.737,188.736,188.737 c91.307,0,171.248-64.844,188.737-150.989v-58.718L377.472,224.957L377.472,224.957z"/> <polygon points="491.858,224.857 455.827,224.857 455.827,188.826 424.941,188.826 424.941,224.857 388.91,224.857 388.91,255.74 424.941,255.74 424.941,291.772 455.827,291.772 455.827,255.74 491.858,255.74 			"/> </g> </svg>
        </a>';
    }
    if ($linkedin != "") {
        echo '<a href="' . $linkedin . '" title="Visit our Linkedin profile" target="_blank">
        	<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"width="25px" height="25px" viewBox="0 0 438.536 438.535" style="enable-background:new 0 0 438.536 438.535;"xml:space="preserve"> <g> <rect x="5.424" y="145.895" width="94.216" height="282.932"/> <path d="M408.842,171.739c-19.791-21.604-45.967-32.408-78.512-32.408c-11.991,0-22.891,1.475-32.695,4.427 c-9.801,2.95-18.079,7.089-24.838,12.419c-6.755,5.33-12.135,10.278-16.129,14.844c-3.798,4.337-7.512,9.389-11.136,15.104 v-40.232h-93.935l0.288,13.706c0.193,9.139,0.288,37.307,0.288,84.508c0,47.205-0.19,108.777-0.572,184.722h93.931V270.942 c0-9.705,1.041-17.412,3.139-23.127c4-9.712,10.037-17.843,18.131-24.407c8.093-6.572,18.13-9.855,30.125-9.855 c16.364,0,28.407,5.662,36.117,16.987c7.707,11.324,11.561,26.98,11.561,46.966V428.82h93.931V266.664 C438.529,224.976,428.639,193.336,408.842,171.739z"/> <path d="M53.103,9.708c-15.796,0-28.595,4.619-38.4,13.848C4.899,32.787,0,44.441,0,58.529c0,13.891,4.758,25.505,14.275,34.829 c9.514,9.325,22.078,13.99,37.685,13.99h0.571c15.99,0,28.887-4.661,38.688-13.99c9.801-9.324,14.606-20.934,14.417-34.829 c-0.19-14.087-5.047-25.742-14.561-34.973C81.562,14.323,68.9,9.708,53.103,9.708z"/> </g> </svg>
        </a>';
    }
    if ($youtube != "") {
        echo '<a href="' . $youtube . '" title="Visit our Youtube channel" target="_blank">
        	<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"width="25px" height="25px" viewBox="0 0 90 90" style="enable-background:new 0 0 90 90;" xml:space="preserve"> <g> <path id="YouTube__x28_alt_x29_" d="M90,26.958C90,19.525,83.979,13.5,76.55,13.5h-63.1C6.021,13.5,0,19.525,0,26.958v36.084 C0,70.475,6.021,76.5,13.45,76.5h63.1C83.979,76.5,90,70.475,90,63.042V26.958z M36,60.225V26.33l25.702,16.947L36,60.225z"/> </g></svg>
        </a>';
    }
    if ($instagram != "") {
        echo '<a href="' . $instagram . '" title="Visit our Instagram page" target="_blank">
        	<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"width="25px" height="25px" viewBox="0 0 169.063 169.063" style="enable-background:new 0 0 169.063 169.063;"xml:space="preserve"> <g> <path d="M122.406,0H46.654C20.929,0,0,20.93,0,46.655v75.752c0,25.726,20.929,46.655,46.654,46.655h75.752 c25.727,0,46.656-20.93,46.656-46.655V46.655C169.063,20.93,148.133,0,122.406,0z M154.063,122.407 c0,17.455-14.201,31.655-31.656,31.655H46.654C29.2,154.063,15,139.862,15,122.407V46.655C15,29.201,29.2,15,46.654,15h75.752 c17.455,0,31.656,14.201,31.656,31.655V122.407z"/> <path d="M84.531,40.97c-24.021,0-43.563,19.542-43.563,43.563c0,24.02,19.542,43.561,43.563,43.561s43.563-19.541,43.563-43.561 C128.094,60.512,108.552,40.97,84.531,40.97z M84.531,113.093c-15.749,0-28.563-12.812-28.563-28.561 c0-15.75,12.813-28.563,28.563-28.563s28.563,12.813,28.563,28.563C113.094,100.281,100.28,113.093,84.531,113.093z"/> <path d="M129.921,28.251c-2.89,0-5.729,1.17-7.77,3.22c-2.051,2.04-3.23,4.88-3.23,7.78c0,2.891,1.18,5.73,3.23,7.78 c2.04,2.04,4.88,3.22,7.77,3.22c2.9,0,5.73-1.18,7.78-3.22c2.05-2.05,3.22-4.89,3.22-7.78c0-2.9-1.17-5.74-3.22-7.78 C135.661,29.421,132.821,28.251,129.921,28.251z"/> </g> </svg>
        </a>';
    }

}

function remove_menus(){
  // remove_menu_page( 'edit.php' );                   //Posts
  // remove_menu_page( 'upload.php' );                 //Media
  // remove_menu_page( 'edit-comments.php' );          //Comments
  // remove_menu_page( 'themes.php' );                 //Appearance
  // remove_menu_page( 'plugins.php' );                //Plugins
  // remove_menu_page( 'tools.php' );                  //Tools
  // remove_menu_page( 'users.php' );                  //Users
  // remove_menu_page( 'options-general.php' );        //Settings
}
// add_action( 'admin_menu', 'remove_menus' );
define( 'DISALLOW_FILE_EDIT', true );

function pagination($pages = '', $range = 4)
{  
     $showitems = ($range * 2)+1;  
     global $paged;
     if(empty($paged)) $paged = 1;
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }  
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}
?>