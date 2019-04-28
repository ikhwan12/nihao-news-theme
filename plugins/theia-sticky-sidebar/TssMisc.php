<?php

/*
 * Copyright 2013-2017, Theia Sticky Sidebar, WeCodePixels, http://wecodepixels.com
 */

add_action( 'wp_enqueue_scripts', 'TssMisc::wp_enqueue_scripts' );
add_action( 'admin_enqueue_scripts', 'TssMisc::admin_enqueue_scripts', 1000 );
add_action( 'wp_footer', 'TssMisc::wp_footer' );
add_action( 'dynamic_sidebar_before', 'TssMisc::dynamic_sidebar_before' );
add_action( 'dynamic_sidebar_after', 'TssMisc::dynamic_sidebar_after' );

class TssMisc {
	public static $enabledSidebars = array();

	public static function wp_enqueue_scripts() {
		if ( self::is_disabled() ) {
			return;
		}

		// Check which sidebars are enabled, if any.
		$sidebars = TssOptions::get( 'sidebars' );
		foreach ( $sidebars as $sidebar ) {
			if ( '' != $sidebar['enabledPosts'] ) {
				if ( ! is_single() && ! is_page() ) {
					continue;
				}
				$currentPostId = get_the_ID();
				$enabledPosts  = explode( ',', $sidebar['enabledPosts'] );
				if ( ! in_array( $currentPostId, $enabledPosts ) ) {
					continue;
				}
			}

			self::$enabledSidebars[] = $sidebar;
		}

		if ( count( self::$enabledSidebars ) > 0 ) {
			wp_enqueue_script( 'theia-sticky-sidebar/ResizeSensor.js', plugins_url( 'js/ResizeSensor.js', __FILE__ ), array( 'jquery' ), TSS_VERSION, true );
			wp_enqueue_script( 'theia-sticky-sidebar/theia-sticky-sidebar.js', plugins_url( 'js/theia-sticky-sidebar.js', __FILE__ ), array( 'jquery', 'theia-sticky-sidebar/ResizeSensor.js' ), TSS_VERSION, true );
			wp_enqueue_script( 'theia-sticky-sidebar/main.js', plugins_url( 'js/main.js', __FILE__ ), array( 'jquery', 'theia-sticky-sidebar/theia-sticky-sidebar.js' ), TSS_VERSION, true );
		}
	}

	public static function admin_enqueue_scripts() {
		$screen = get_current_screen();
		if ( get_class( $screen ) != 'WP_Screen' || $screen->id != 'settings_page_tss' ) {
			return;
		}

		// Include select2 library.
		{
			// Remove any other version of select2.
			wp_deregister_script( 'select2' );
			wp_deregister_style( 'select2' );

			// Remove incompatible select2 scripts from other plugins.
			wp_deregister_script( 'gt-admin-select2' );
			wp_deregister_style( 'gt-admin-select2' );

			// Include our version.
			wp_enqueue_script( 'select2', plugin_dir_url( __FILE__ ) . 'select2/dist/js/select2.min.js', array( 'jquery' ), TSS_VERSION, true );
			wp_enqueue_style( 'select2', plugin_dir_url( __FILE__ ) . 'select2/dist/css/select2.css', array(), TSS_VERSION );
		}

		// Include custom CSS.
		wp_enqueue_style( 'theiaStickySidebar-admin', plugins_url( 'css/admin.css', __FILE__ ), TSS_VERSION );
	}

	public static function wp_footer() {
		if ( self::is_disabled() ) {
			return;
		}

		foreach ( self::$enabledSidebars as $sidebar ) {
			self::echo_sidebar( $sidebar );
		}
	}

	public static function echo_sidebar( $sidebar ) {
		$sidebar_selector = $sidebar['sidebarSelector'];

		$options = array(
			'containerSelector'          => $sidebar['containerSelector'],
			'additionalMarginTop'        => $sidebar['additionalMarginTop'],
			'additionalMarginBottom'     => $sidebar['additionalMarginBottom'],
			'updateSidebarHeight'        => $sidebar['updateSidebarHeight'],
			'minWidth'                   => $sidebar['minWidth'],
			'sidebarBehavior'            => $sidebar['sidebarBehavior'],
			'disableOnResponsiveLayouts' => $sidebar['disableOnResponsiveLayouts'],
		);
		if ( self::is_disabled() ) {
			return;
		}
		if ( $sidebar_selector == '' ) {
			$sidebar_selector = '#secondary, #sidebar, .sidebar, #primary';
		}

		if ( $customCss = TssOptions::get( 'customCss' ) ) {
			echo "\n<style>\n" . $customCss . "\n</style>\n";
		}

		?>
		<div data-theiaStickySidebar-sidebarSelector='<?php echo json_encode( $sidebar_selector ); ?>'
		     data-theiaStickySidebar-options='<?php echo json_encode( $options ); ?>'></div>
		<?php
	}

	public static function is_disabled() {
		return
			is_admin() ||
			( TssOptions::get( 'disableOnHomePage' ) && ( is_home() || is_front_page() ) ) ||
			( TssOptions::get( 'disableOnCategoryPages' ) && is_category() ) ||
			( TssOptions::get( 'disableOnPages' ) && is_page() ) ||
			( TssOptions::get( 'disableOnPosts' ) && is_single() );
	}

	public static function dynamic_sidebar_before( $widget_id ) {
		if ( ! is_admin() && TssOptions::get( 'preRenderContainersForSidebars' ) ) {
			echo '<div class="theiaStickySidebar">';
		}
	}

	public static function dynamic_sidebar_after( $widget_id ) {
		if ( ! is_admin() && TssOptions::get( 'preRenderContainersForSidebars' ) ) {
			echo '</div>';
		}
	}
}
