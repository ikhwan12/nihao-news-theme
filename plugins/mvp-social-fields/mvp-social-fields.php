<?php
/**
 * Plugin Name: MVP Themes Social Fields
 * Plugin URI: http://themeforest.net/user/mvpthemes
 * Description: Creates additional fields in user profiles for various social social sites
 * Version: 1.0
 * Author: MVP Themes
 * Author URI: http://premium.wpmudev.org
 * License: GNU General Public License v3 or later
 */

if ( !function_exists( 'mvp_new_contactmethods' ) ) {
function mvp_new_contactmethods( $contactmethods ) {
    $contactmethods['facebook'] = 'Facebook'; // Add Facebook
    $contactmethods['twitter'] = 'Twitter'; // Add Twitter
    $contactmethods['pinterest'] = 'Pinterest'; // Add Pinterest
    $contactmethods['googleplus'] = 'Google Plus'; // Add Google Plus
    $contactmethods['instagram'] = 'Instagram'; // Add Instagram
    $contactmethods['linkedin'] = 'LinkedIn'; // Add LinkedIn

    return $contactmethods;
}
}
add_filter('user_contactmethods','mvp_new_contactmethods',10,1);

?>