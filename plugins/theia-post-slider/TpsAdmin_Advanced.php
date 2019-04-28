<?php

/*
 * Copyright 2012-2018, Theia Post Slider, WeCodePixels, http://wecodepixels.com
 */

class TpsAdmin_Advanced {
	public $showPreview = false;

	public function echoPage() {
		?>
		<form method="post" action="options.php">
			<?php settings_fields( 'tps_options_advanced' ); ?>
			<?php $options = get_option( 'tps_advanced' ); ?>

			<table class="form-table">
				<tr valign="top">
					<th scope="row">
						<label for="default_activation_behavior"><?php _e( "Default activation behavior:", 'theia-post-slider' ); ?></label>
					</th>
					<td>
						<select id="default_activation_behavior" name="tps_advanced[default_activation_behavior]">
							<option value="1" <?php echo $options['default_activation_behavior'] == 1 ? 'selected' : ''; ?>>
								Enable by default on all posts
							</option>
							<option value="0" <?php echo $options['default_activation_behavior'] == 0 ? 'selected' : ''; ?>>
								Disable by default on all posts
							</option>
						</select>

						<p class="description">
							You can also enable or disable the slider on a post-by-post basis.
						</p>

						<p></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="post_types"><?php _e( "Post types:", 'theia-post-slider' ); ?></label>
					</th>
					<td>
						<?php
						$postTypes = get_post_types( array(), 'objects' );
						?>
						<select id="post_types" name="tps_advanced_post_types[]" size="10" multiple>
							<?php
							foreach ( $postTypes as $key => $type ) {
								?>
								<option value="<?php echo $key; ?>" <?php echo in_array( $key, $options['post_types'] ) ? 'selected' : ''; ?>>
									<?php echo $type->labels->name; ?>
								</option>
								<?php
							}
							?>
						</select>

						<p class="description">
							By default, the slider is enabled only for <b>posts</b>. Use Ctrl+Click or CommandKey+Click
							to select multiple types.
						</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="touch_gestures"><?php _e( "Touch gestures:", 'theia-post-slider' ); ?></label>
					</th>
					<td>
						<label>
							<input type='hidden' value='false' name='tps_advanced[enable_touch_gestures]'>
							<input type="checkbox"
							       id="touch_gestures"
							       name="tps_advanced[enable_touch_gestures]"
							       value="true" <?php echo $options['enable_touch_gestures'] ? 'checked' : ''; ?>>
							Enable touch gestures for sliding left/right to the previous/next slide.
							<p></p>
						</label>

						<p></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="override_subtitles"><?php _e( "Subpage titles:", 'theia-post-slider' ); ?></label>
					</th>
					<td>
						<label>
							<input type='hidden' value='false' name='tps_advanced[override_subtitles]'>
							<input type="checkbox"
							       id="override_subtitles"
							       name="tps_advanced[override_subtitles]"
							       value="true" <?php echo $options['override_subtitles'] ? 'checked' : ''; ?>>
							Override subpage titles.
							<p></p>
						</label>

						<p class="description">
							Recommended. Prevent duplicate title tags. Set a title for each subpage using <strong>[tps_title]Your Title[/tps_title]</strong>.
						</p>
					</td>
				</tr>
			</table>

			<h3><?php _e( "Slide Loading Mechanism", 'theia-post-slider' ); ?></h3>
			<table class="form-table">
				<?php TpsAdminTemplates::get_slide_loading_mechanism_html( $options ); ?>
			</table>
			<br>

			<h3><?php _e( "Ad behavior", 'theia-post-slider' ); ?></h3>
			<table class="form-table">
				<tr valign="top">
					<th scope="row">
						<label for="tps_refresh_ads"><?php _e( "Ad refreshing:", 'theia-post-slider' ); ?></label>
					</th>
					<td>
						<label>
							<input type="checkbox"
							       id="tps_refresh_ads"
							       name="tps_advanced[refresh_ads]"
							       onchange="updateForm()"
							       value="true" <?php echo $options['refresh_ads'] ? 'checked' : ''; ?>>
							Refresh ads when navigating to another slide.
							<p></p>
						</label>

						<p></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="tps_refresh_ads_every_n_slides"><?php _e( "Refresh ads every N slides:", 'theia-post-slider' ); ?></label>
					</th>
					<td>
						<input type="number"
						       class="small-text"
						       id="tps_refresh_ads_every_n_slides"
						       name="tps_advanced[refresh_ads_every_n_slides]"
						       value="<?php echo htmlentities( $options['refresh_ads_every_n_slides'] ); ?>">

						<p class="description">
							Use "1" to refresh ads on every slide.
						</p>

						<p></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label><?php _e( "Ad refreshing mechanism:", 'theia-post-slider' ); ?></label>
					</th>
					<td>
						<label>
							<input type="radio"
							       id="tps_ad_refreshing_mechanism_javascript"
							       name="tps_advanced[ad_refreshing_mechanism]"
							       value="javascript" <?php echo $options['ad_refreshing_mechanism'] == 'javascript' ? 'checked' : ''; ?>>
							Refresh ads using JavaScript.
							<p class="description">
								Works with Google DoubleClick and partners. Requires that you use
								<strong>
									<a href="https://support.google.com/dfp_premium/answer/177207">
										GPT (Google Publishing Tags)
									</a>
								</strong>
								and
								<strong>
									<a href="https://support.google.com/dfp_premium/answer/183282">
										asynchronous rendering
									</a>
								</strong>.
								DART tags are not supported. Google AdSense is not supported because their Terms of
								Service forbid this kind of behavior.
							</p>
						</label>
						<br>
						<label>
							<input type="radio"
							       id="tps_ad_refreshing_mechanism_page"
							       name="tps_advanced[ad_refreshing_mechanism]"
							       value="page" <?php echo $options['ad_refreshing_mechanism'] == 'page' ? 'checked' : ''; ?>>
							Refresh ads by refreshing the entire page.
							<p class="description">
								Works with any other ads, including Google AdSense. Transition effects will not be used
								when refreshing the page.
							</p>
						</label>

						<p></p>
					</td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit"
				       class="button-primary"
				       value="<?php _e( 'Save All Changes', 'theia-post-slider' ) ?>" />
			</p>
		</form>
		<script type="text/javascript">
			function updateForm() {
				var $ = jQuery;

				var refreshAds = $('#tps_refresh_ads').attr('checked') == 'checked';
				$('#tps_refresh_ads_every_n_slides').attr('readonly', !refreshAds);
				$('#tps_ad_refreshing_mechanism_javascript').attr('disabled', !refreshAds);
				$('#tps_ad_refreshing_mechanism_page').attr('disabled', !refreshAds);
			}

			updateForm();
		</script>
		<?php
	}
}
