<?php
/* 
Plugin Name: DC - Facebook Like Box Popup (Increase Facebook Fans)
Version: 1.1 
Description: This WordPress plugin helps you add Facebook Fans by popping up a window with a Facebook Like box.
Contributors: dattardwp-21
Author URI: https://www.collectiveray.com
Author: CollectiveRay
Donate link: https://www.collectiveray.com/joomla-25-and-joomla-3-modules/75-donate-a-beer
Tags: wordpress, facebook, like, popin, responsive
Requires at least: 3.0.1
Tested up to: 4.3
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
if(!defined('WP_FACEBOOK_POPUP_URL'))
	define('WP_FACEBOOK_POPUP_URL',WP_PLUGIN_URL.'/dc-facebook-like-box-popup-increase-facebook-fans');
require_once (dirname(__FILE__).'/settings.php');
require_once (dirname(__FILE__).'/controls.php');
require_once (dirname(__FILE__).'/footer.php');
/* Begin MCE Button */
add_action('admin_enqueue_scripts', 'wp_facebook_popup_admin_enqueue_scripts');
function wp_facebook_popup_admin_enqueue_scripts() {
	wp_enqueue_style('wp-facebook-popup', WP_FACEBOOK_POPUP_URL.'/css/mce.css');		
}

add_action('init', 'wp_facebook_popup_admin_head');
function wp_facebook_popup_admin_head() {
	if(!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
		return;
	}
	if('true' == get_user_option('rich_editing')) {
		add_filter('mce_external_plugins', 'wp_facebook_popup_mce_external_plugins');
		add_filter('mce_buttons', 'wp_facebook_popup_mce_buttons');
	}
}

function wp_facebook_popup_mce_external_plugins($plugin_array) {
	$plugin_array['wp_facebook_popup'] = WP_FACEBOOK_POPUP_URL.'/js/mce.js';
	return $plugin_array;	 
}

function wp_facebook_popup_mce_buttons($buttons) {
	array_push($buttons, 'wp_facebook_popup');
	return $buttons;
}
/* End MCE Button */
?>