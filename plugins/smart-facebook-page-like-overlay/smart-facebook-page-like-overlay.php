<?php
/**
 * Plugin Name: WP Smart Facebook Page Like Overlay, Free Version
 * Description: Promote your Facebook Fan Page with our slick overlay.
 * Author: Aquacrista
 * Version: 1.22
 * License: GPLv2 or later
 */

// if this file is called directly, abort
if ( ! defined( 'ABSPATH' ) ) exit;

define('WPFBLIKEFREE_PLUGIN_NAME',basename(__FILE__,'.php'));

// Load Settings File
require_once ( plugin_dir_path(__FILE__) . 'admin/wpfblike-settings.php' );
require_once 'smart-facebook-page-like-overlay-helper.php';

$SMART_FBOVERLAY_Helper = new SMART_FBOVERLAY_HELPER();

// Activation
function wpfblikefree_activate_plugin() {
    if( is_plugin_active('smart-facebook-page-like-overlay-pro/smart-facebook-page-like-overlay-pro.php') ){
        add_action('update_option_active_plugins', 'wpfblikefree_deactivate_full_plugin');
    }
}

function wpfblikefree_deactivate_full_plugin() {
    deactivate_plugins('smart-facebook-page-like-overlay-pro/smart-facebook-page-like-overlay-pro.php');
}

register_activation_hook( __FILE__, 'wpfblikefree_activate_plugin' );

// Deactivation
function wpfblikefree_deactivate_plugin() {
}
register_deactivation_hook( __FILE__, 'wpfblikefree_deactivate_plugin' );

// Uninstalling
function wpfblikefree_uninstall_plugin() {
    delete_option('wpfblikefree');
}
register_uninstall_hook( __FILE__, 'wpfblikefree_uninstall_plugin' );

// Add Settings Link to Plugins Page
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'wpfblikefree_add_action_links' );

add_action( 'admin_enqueue_scripts', 'wpfblikefree_admin_enqueue_scripts' );

function wpfblikefree_add_action_links ( $links ) {
	$mylinks = array(
		'<a href="' . admin_url( 'options-general.php?page=wpfblikefree' ) . '">'.__('Settings').'</a>',
	);
return array_merge( $links, $mylinks );
}

function wpfblikefree_admin_enqueue_scripts() {
    wp_register_style( 'wpfblike_admin_css', 
        plugin_dir_url(__FILE__) . 'admin/wpfblike_admin_css.css', false, '1.0.0' );
    wp_enqueue_style( 'wpfblike_admin_css' );    
}

/*-------------------------------------------*
* Enqueue Scripts & Styles
/*-------------------------------------------*/
function wpfblikefree_assets() {

  global $SMART_FBOVERLAY_Helper;

	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'jquery_cookie', plugin_dir_url(__FILE__) . 'assets/jquery.cookie.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'wpfblike_script_common', plugin_dir_url(__FILE__) . 'assets/wpfblike-script-common.js', array( 'jquery','jquery_cookie' ), null, true );
    wp_enqueue_script( 'wpfblike_script_others', plugin_dir_url(__FILE__) . 'assets/wpfblike-script-time-and-scroll.js', array( 'jquery','jquery_cookie','wpfblike_script_common' ), null, true );

    wp_enqueue_script( 'wpfblike_facebook_all', '//connect.facebook.net/'.get_locale().'/all.js', array(), null, true );
    wp_enqueue_script( 'adaptjs', plugin_dir_url(__FILE__) . 'assets/adapt.min.js', array( 'jquery', 'wpfblike_script_common' ), null, true );

  $wpfblike_script_vars = $SMART_FBOVERLAY_Helper->getScriptVars();

	wp_localize_script( 'wpfblike_script_common', 'wpfblike_script_data', $wpfblike_script_vars );
	wp_enqueue_style( 'wpfblike_style', plugin_dir_url(__FILE__) . 'assets/wpfblike.css' );
}
add_action( 'wp_enqueue_scripts', 'wpfblikefree_assets' );

// Add Facebook's SDK for the Page Plugin to Display
function wpfblikefree_sdk() {

  global $SMART_FBOVERLAY_Helper;
  $SMART_FBOVERLAY_Helper->echoFBSDK();
}

// Render Popup On the Site
function wpfblikefree_show() {

  global $SMART_FBOVERLAY_Helper;
  $SMART_FBOVERLAY_Helper->echoOverlay();

}

function wpfblikefree_plugins_loaded() {
  load_plugin_textdomain(WPFBLIKEFREE_PLUGIN_NAME, FALSE, dirname(plugin_basename( __FILE__)));
}

add_action( 'wp_head', 'wpfblikefree_sdk');
add_action( 'wp_head', 'wpfblikefree_show');
add_action( 'plugins_loaded', 'wpfblikefree_plugins_loaded' ); 
