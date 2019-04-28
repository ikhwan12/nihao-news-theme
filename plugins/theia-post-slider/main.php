<?php
/*
Plugin Name: Theia Post Slider
Plugin URI: http://wecodepixels.com/theia-post-slider-for-wordpress/?utm_source=theia-post-slider-for-wordpress
Description: Display multi-page posts using a slider, as a slideshow.
Author: WeCodePixels
Author URI: http://wecodepixels.com/?utm_source=theia-post-slider-for-wordpress
Version: 2.0.0
Copyright: WeCodePixels
*/

/*
 * Copyright 2012-2018, Theia Post Slider, WeCodePixels, http://wecodepixels.com
 */

/*
 * Plugin version. Used to forcefully invalidate CSS and JavaScript caches by appending the version number to the
 * filename (e.g. "style.css?ver=TPS_VERSION").
 */
define( 'TPS_VERSION', '2.0.0' );

// Include other files.
include( __DIR__ . '/vendor/wecodepixels/wordpress-plugin/WcpOptions.php' );
include( __DIR__ . '/TpsMisc.php' );
include( __DIR__ . '/TpsNavigationBar.php' );
include( __DIR__ . '/TpsContent.php' );
include( __DIR__ . '/TpsColors.php' );
include( __DIR__ . '/TpsEnqueues.php' );
include( __DIR__ . '/TpsShortCodes.php' );
include( __DIR__ . '/TpsOptions.php' );
include( __DIR__ . '/TpsPostOptions.php' );
include( __DIR__ . '/TpsAjax.php' );
include( __DIR__ . '/TpsHelper.php' );
include( __DIR__ . '/TpsAdmin.php' );
include( __DIR__ . '/TpsAdminTemplates.php' );
include( __DIR__ . '/TpsUpdateChecker.php' );
include( __DIR__ . '/src/Admin/VectorIconsPicker.php' );
