<?php
/*
Plugin Name: Theia Sticky Sidebar
Plugin URI: http://wecodepixels.com/products/theia-sticky-sidebar-for-wordpress/?utm_source=theia-sticky-sidebar
Description: Glues your website's sidebars, making them permanently visible while scrolling.
Author: WeCodePixels
Author URI: http://wecodepixels.com/?utm_source=theia-sticky-sidebar
Version: 1.7.0
Copyright: WeCodePixels
*/

/*
 * Copyright 2013-2017, Theia Sticky Sidebar, WeCodePixels, http://wecodepixels.com
 */

/*
 * Plugin version. Used to forcefully invalidate CSS and JavaScript caches by appending the version number to the
 * filename (e.g. "style.css?ver=TSS_VERSION").
 */
define( 'TSS_VERSION', '1.7.0' );

// Include other files.
include( dirname( __FILE__ ) . '/TssMisc.php' );
include( dirname( __FILE__ ) . '/TssOptions.php' );
include( dirname( __FILE__ ) . '/TssAdmin.php' );
include( dirname( __FILE__ ) . '/TssTemplates.php' );
include( dirname( __FILE__ ) . '/TssAjax.php' );
