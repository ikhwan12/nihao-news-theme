<?php

/*
 * Copyright 2012-2018, Theia Post Slider, WeCodePixels, http://wecodepixels.com
 */

// Include updater plugin.
{
	$includeFiles = array();

	// Use this when installed from official ZIP file.
	$includeFiles[] = __DIR__ . '/vendor/yahnis-elsts/plugin-update-checker/plugin-update-checker.php';

	// Use this when installed via Bedrock.
	if ( isset( $GLOBALS ) && array_key_exists( 'root_dir', $GLOBALS ) ) {
		$includeFiles[] = $GLOBALS['root_dir'] . '/vendor/yahnis-elsts/plugin-update-checker/plugin-update-checker.php';
	}

	foreach ( $includeFiles as $file ) {
		if ( is_file( $file ) ) {
			include_once $file;
			break;
		}
	}
}

TpsUpdateChecker::$updateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://wecodepixels.com/theia-post-slider-for-wordpress/?get_update_json',
	__DIR__ . '/main.php',
	'wcp-theia-post-slider'
);
TpsUpdateChecker::$updateChecker->addQueryArgFilter( 'TpsUpdateChecker::addQueryArgFilter' );

add_action( 'in_plugin_update_message-' . plugin_basename( __DIR__ ) . '/main.php', 'TpsUpdateChecker::in_plugin_update_message', 10, 2 );

class TpsUpdateChecker {
	/* @var Puc_v4p2_Plugin_UpdateChecker */
	public static $updateChecker;

	public static function addQueryArgFilter( $queryArgs ) {
		$queryArgs['purchase_code'] = TpsOptions::get( 'purchase_code' );

		return $queryArgs;
	}

	public static function in_plugin_update_message( $pluginData, $response ) {
		if ( ! TpsOptions::get( 'purchase_code' ) ) {
			$message = sprintf(
				'<br>To enable updates, please enter your purchase code in the <a href="%s">Dashboard</a>. If you don\'t have a purchase code, please see <a href="%s" target="_blank">Details and Pricing</a>.',
				admin_url( 'options-general.php?page=tps&tab=dashboard' ),
				'https://wecodepixels.com/theia-post-slider-for-wordpress/?utm_source=theia-post-slider-for-wordpress'
			);

			echo $message;
		} else if ( ! $pluginData['package'] ) {
			$message = sprintf(
				'<br><strong>Your purchase code appears to be invalid or expired</strong>. To enable updates, please confirm your purchase code in the <a href="%s">Dashboard</a>. If you don\'t have a valid purchase code, please see <a href="%s" target="_blank">Details and Pricing</a>.',
				admin_url( 'options-general.php?page=tps&tab=dashboard' ),
				'https://wecodepixels.com/theia-post-slider-for-wordpress/?utm_source=theia-post-slider-for-wordpress'
			);

			echo $message;
		}
	}
}
