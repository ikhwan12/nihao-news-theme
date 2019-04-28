<?php

/*
 * Copyright 2012-2018, Theia Post Slider, WeCodePixels, http://wecodepixels.com
 */

class TpsAdmin_Troubleshooting {
	public $showPreview = false;

	public function echoPage() {
		?>
		<form method="post" action="options.php">
			<?php settings_fields( 'tps_options_troubleshooting' ); ?>
			<?php $options = get_option( 'tps_troubleshooting' ); ?>

			<table class="form-table">
				<tr valign="top">
					<th scope="row">
						<label><?php _e( "Compatibility options:", 'theia-post-slider' ); ?></label>
					</th>
					<td>
						<label>
							<input type='hidden' value='false' name='tps_troubleshooting[remove_canonical_rel]'>
							<input type="checkbox"
							       name="tps_troubleshooting[remove_canonical_rel]"
							       value="true" <?php echo $options['remove_canonical_rel'] ? 'checked' : ''; ?>>
							Disable canonical URLs on slides.
							<p class="description">
								Canonical URLs are added by WordPress on each subsequent page, which could prevent
								your slides to be indexed by Google.
							</p>
						</label>
						<br>
						<label>
							<input type='hidden' value='false' name='tps_troubleshooting[do_not_check_for_multiple_instances]'>
							<input type="checkbox"
							       name="tps_troubleshooting[do_not_check_for_multiple_instances]"
							       value="true" <?php echo $options['do_not_check_for_multiple_instances'] ? 'checked' : ''; ?>>
							Do not check for multiple instances of the same post.
							<p class="description">
								Try this if the entire page refreshes on each slide when it shouldn't.
							</p>
						</label>
						<br>
						<label>
							<input type='hidden' value='false' name='tps_troubleshooting[do_not_cache_rendered_html]'>
							<input type="checkbox"
							       id="tps_troubleshooting_do_not_cache_rendered_html"
							       name="tps_troubleshooting[do_not_cache_rendered_html]"
							       onchange="updateForm()"
							       value="true" <?php echo $options['do_not_cache_rendered_html'] ? 'checked' : ''; ?>>
							Do not cache rendered HTML.
							<p class="description">
								Enable this if you use Twitter embeds, or any other plugin that generates iframes.
							</p>
						</label>
						<br>
						<label>
							<input type='hidden' value='false' name='tps_troubleshooting[try_to_fix_broken_html]'>
							<input type="checkbox"
							       id="try_to_fix_broken_html"
							       name="tps_troubleshooting[try_to_fix_broken_html]"
							       value="true" <?php echo $options['try_to_fix_broken_html'] ? 'checked' : ''; ?>>
							Try to fix broken HTML.
							<p class="description">
								This will use either <a href="http://php.net/manual/en/book.tidy.php">PHP Tidy</a> (if installed) or <a href="http://htmlpurifier.org/">HTMLPurifier</a> to fix posts with broken HTML. Note that this can cause your pages to load slower or have compatibility issues with other plugins. Therefore, we recommend disabling this option and manually validating your posts' code.
							</p>
						</label>
						<br>
						<label>
							<input type='hidden' value='false' name='tps_troubleshooting[document_ready_js]'>
							<input type="checkbox"
							       name="tps_troubleshooting[document_ready_js]"
							       value="true" <?php echo $options['document_ready_js'] ? 'checked' : ''; ?>>
							Trigger <strong>jQuery(document).ready()</strong> upon navigating to another slide.
							<p class="description">
								Try this when only the first slide is displayed correctly.
							</p>
						</label>
						<br>
						<label>
							<input type='hidden' value='false' name='tps_troubleshooting[window_load_js]'>
							<input type="checkbox"
							       name="tps_troubleshooting[window_load_js]"
							       value="true" <?php echo $options['window_load_js'] ? 'checked' : ''; ?>>
							Trigger <strong>jQuery(window).load()</strong> upon navigating to another slide.
							<p class="description">
								Try this when only the first slide is displayed correctly.
							</p>
						</label>
						<br>
						<label>
							<input type='hidden' value='false' name='tps_troubleshooting[domcontentloaded_js]'>
							<input type="checkbox"
							       name="tps_troubleshooting[domcontentloaded_js]"
							       value="true" <?php echo $options['domcontentloaded_js'] ? 'checked' : ''; ?>>
							Trigger <strong>DOMContentLoaded</strong> upon navigating to another slide.
							<p class="description">
								Try this when only the first slide is displayed correctly.
							</p>
						</label>
						<br>
						<label>
							<input type='hidden' value='false' name='tps_troubleshooting[document_resize_js]'>
							<input type="checkbox"
							       name="tps_troubleshooting[document_resize_js]"
							       value="true" <?php echo $options['document_resize_js'] ? 'checked' : ''; ?>>
							Trigger <strong>jQuery(document).resize()</strong> upon navigating to another slide.
							<p class="description">
								Try this when only the first slide is displayed correctly.
							</p>
						</label>
						<br>
						<label>
							<input type='hidden' value='false' name='tps_troubleshooting[document_scroll_js]'>
							<input type="checkbox"
							       name="tps_troubleshooting[document_scroll_js]"
							       value="true" <?php echo $options['document_scroll_js'] ? 'checked' : ''; ?>>
							Trigger <strong>jQuery(document).scroll()</strong> upon navigating to another slide.
							<p class="description">
								Try this when only the first slide is displayed correctly.
							</p>
						</label>
						<br>
						<label>
							<input type='hidden' value='false' name='tps_troubleshooting[add_header_to_excerpt]'>
							<input type="checkbox"
							       name="tps_troubleshooting[add_header_to_excerpt]"
							       value="true" <?php echo $options['add_header_to_excerpt'] ? 'checked' : ''; ?>>
							Include text from [tps_header] and [tps_footer] in excerpts.
							<p class="description">
								You might want to do this depending on the theme you are using.
							</p>
						</label>
						<br>
						<label>
							<input type='hidden' value='false' name='tps_troubleshooting[disable_rocketscript]'>
							<input type="checkbox"
							       name="tps_troubleshooting[disable_rocketscript]"
							       value="true" <?php echo $options['disable_rocketscript'] ? 'checked' : ''; ?>>
							Disable CloudFlare's Rocket Loader (Rocketscript) for Theia Post Slider's JavaScript files, and for the jQuery library.
							<p class="description">
								This adds <strong>data-cfasync="false"</strong> to the aforementioned script tags.
							</p>
						</label>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="tps_troubleshooting_excludedWords"><?php _e( "Force a page refresh when navigating to slides that include any of the following keywords:", 'theia-post-slider' ); ?></label>
					</th>
					<td>
						<textarea class="large-text code"
						          rows="5"
						          id="tps_troubleshooting_excludedWords"
						          name="tps_troubleshooting[excludedWords]"><?php echo htmlspecialchars( $options['excludedWords'] ); ?></textarea>
						<p class="description">
							Enter one keyword per line. Only works when "<b>Do not cache rendered HTML</b>" is enabled.
						</p>
					</td>
				</tr>
			</table>

			<h3><?php _e( "Danger zone", 'theia-post-slider' ); ?></h3>
			<table class="form-table">
				<tr valign="top">
					<th scope="row">
						<label for="tps_the_content_early_priority"><?php _e( "Priority for the the_content action hook:", 'theia-post-slider' ); ?></label>
					</th>
					<td>
						<input type="number"
						       class="small-text"
						       id="tps_the_content_early_priority"
						       name="tps_troubleshooting[the_content_early_priority]"
						       value="<?php echo $options['the_content_early_priority']; ?>">
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="tps_beginning_post_content_separator"><?php _e( "Beginning post content separator:", 'theia-post-slider' ); ?></label>
					</th>
					<td>
						<input type="text"
						       class="regular-text"
						       id="tps_beginning_post_content_separator"
						       name="tps_troubleshooting[beginning_post_content_separator]"
						       value="<?php echo htmlspecialchars( $options['beginning_post_content_separator'] ); ?>">
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="tps_ending_post_content_separator"><?php _e( "Ending post content separator:", 'theia-post-slider' ); ?></label>
					</th>
					<td>
						<input type="text"
						       class="regular-text"
						       id="tps_ending_post_content_separator"
						       name="tps_troubleshooting[ending_post_content_separator]"
						       value="<?php echo htmlspecialchars( $options['ending_post_content_separator'] ); ?>">
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

				var doNotCacheRenderedHtml = $('#tps_troubleshooting_do_not_cache_rendered_html').attr('checked') == 'checked';
				$('#tps_troubleshooting_excludedWords').attr('disabled', !doNotCacheRenderedHtml);
			}

			updateForm();
		</script>
		<?php
	}
}
