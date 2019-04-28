<?php

/*
 * Copyright 2012-2018, Theia Post Slider, WeCodePixels, http://wecodepixels.com
 */

class TpsAdmin_Dashboard {
	public $showPreview = false;

	public function echoPage() {
		?>
		<form method="post" action="options.php">
			<?php settings_fields( 'tps_options_dashboard' ); ?>
			<?php $options = get_option( 'tps_dashboard' ); ?>

			<table class="form-table">
				<tr valign="top">
					<th scope="row">
						<label for="tps_navigation_text"><?php _e( "Purchase Code:", 'theia-post-slider' ); ?></label>
					</th>
					<td>
						<input type="text"
						       name="tps_dashboard[purchase_code]"
						       value="<?php echo htmlentities( $options['purchase_code'] ); ?>"
						       class="regular-text">
						<input type="submit" class="button-primary" value="Save">

						<p class="description">
							Used for updates.
							<a target="_blank" href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-">Where is my purchase code?</a>
						</p>
					</td>
				</tr>
			</table>

			<h3 class="support-title"><?php _e( "Support", 'theia-post-slider' ); ?></h3>

			<p>
				1. If you have any problems or questions, you should first check
				<a href="http://wecodepixels.com/theia-post-slider-for-wordpress/docs/?utm_source=theia-post-slider-for-wordpress"
				   class=""
				   target="_blank">The Documentation</a>.
			</p>
			<p>
				2. If the plugin is misbehaving, try to

				<a href="#" onclick="if (confirm('Are you sure you want to reset The Global Settings to their default values?')) { jQuery('#reset_global_settings_to_default').click(); } ">
					Reset Global Settings to Default
				</a>
				<input name="tps_dashboard[reset_global_settings_to_default]"
				       id="reset_global_settings_to_default"
				       type="submit"
				       class=""
				       value="true"
				       style="display: none">
				or

				<a href="#" onclick="if (confirm('Are you sure you want to reset All Post Settings to their default values?')) { jQuery('#reset_all_post_settings_to_default').click(); } ">
					Reset All Post Settings to Default
				</a>.
				<input name="tps_dashboard[reset_all_post_settings_to_default]"
				       id="reset_all_post_settings_to_default"
				       type="submit"
				       class=""
				       value="<?php echo wp_generate_password( 16, false ) ?>"
				       style="display: none">
			</p>
			<p>
				3. Deactivate all plugins. If the issue is solved, then re-activate them one-by-one to pinpoint the exact cause.
			</p>
			<p>
				4. If your issue persists, please proceed to
				<a href="http://wecodepixels.com/theia-post-slider-for-wordpress/support/?utm_source=theia-post-slider-for-wordpress"
				   class=""
				   target="_blank">Submit a Ticket</a>.
			</p>
		</form>

		<br>

		<iframe class="theiaPostSlider_news" src="https://wecodepixels.com/theia-post-slider-for-wordpress-news/" scrolling="no"></iframe>
		<script src="<?php echo plugin_dir_url( __FILE__ ) ?>/node_modules/iframe-resizer/js/iframeResizer.min.js"></script>
		<script>
            iFrameResize({log: true}, '.theiaPostSlider_news');
		</script>
		<?php
	}
}
