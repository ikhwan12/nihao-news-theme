<?php

/*
 * Copyright 2013-2017, Theia Sticky Sidebar, WeCodePixels, http://wecodepixels.com
 */

class TssAdmin_General {
	public function echoPage() {
		if ( TssTemplates::getTemplate() !== null && TssTemplates::areSettingsDifferentFromTemplate() ) {
			if ( isset( $_POST['usePredefinedSettings'] ) ) {
				TssTemplates::useTemplate();
			} else {
				?>
				<div class="updated" style="margin: 14px 0 0 0; padding: 10px;">
					<form method="post" action="options-general.php?page=tss&tab=general">
						There are predefined settings available for the current theme.
						<input type="submit"
						       name="usePredefinedSettings"
						       class="button-primary"
						       value="Use predefined settings"
						       style="margin-left: 5px">
					</form>
				</div>
				<?php
			}
		}
		?>

		<form method="post" action="options.php">
			<?php
			settings_fields( 'tss_options_general' );
			$options  = get_option( 'tss_general' );
			$options  = is_array( $options ) ? $options : array();
			$sidebars = TssOptions::get( 'sidebars' );

			// Fetch post names.
			foreach ( $sidebars as &$sidebar ) {
				if ( '' == $sidebar['enabledPosts'] ) {
					$sidebar['enabledPosts'] = array();
					continue;
				}

				$postIds                 = explode( ',', $sidebar['enabledPosts'] );
				$sidebar['enabledPosts'] = array();
				foreach ( $postIds as $postId ) {
					$post                               = get_post( (int) $postId );
					$sidebar['enabledPosts'][ $postId ] = TssAjax::getPostText( $post );
				}
			}
			?>

			<input type="hidden" name="tss_general[currentTheme]" value="<?php echo wp_get_theme()->Name ?>">

			<input id="sidebarsData"
			       name="tss_general[sidebars]"
			       type="hidden"
			       value="<?php echo htmlspecialchars( json_encode( $sidebars ) ); ?>">

			<table id="sidebarsTable" class="form-table widefat">
				<thead>
				<tr>
					<td></td>
					<td>Sidebars</td>
					<td></td>
				</tr>
				</thead>
				<tbody>
				<tr style="display: none">
					<td></td>
					<td id="sidebarsTemplate">
						<table class="form-table">
							<tr valign="top">
								<th scope="row">
									<label><?php _e( "Name", 'theia-sticky-sidebar' ); ?></label>
								</th>
								<td>
									<input type="text" class="sidebarName large-text">
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label><?php _e( "Sidebar CSS selector", 'theia-sticky-sidebar' ); ?></label>
								</th>
								<td>
									<input type="text" class="sidebarSelector large-text">

									<p class="description">
										Leave blank to try to guess automatically.
										This is the selector used to identify the sidebar(s). It's usually something
										like
										"#sidebar"
										or "#secondary". You can add multiple selectors by separating them with a comma
										",".
									</p>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label><?php _e( "Container CSS selector", 'theia-sticky-sidebar' ); ?></label>
								</th>
								<td>
									<input type="text" class="containerSelector large-text">

									<p class="description">
										Leave blank to try to guess automatically.
										This must identify the element that contains both the sidebar(s) and the page
										content.
										It's
										usually something like "#main" or "#main-content".
									</p>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label><?php _e( "Sidebar additional top margin (px)", 'theia-sticky-sidebar' ); ?></label>
								</th>
								<td>
									<input type="text" class="additionalMarginTop">
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label><?php _e( "Sidebar additional bottom margin (px)", 'theia-sticky-sidebar' ); ?></label>
								</th>
								<td>
									<input type="text" class="additionalMarginBottom">
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label><?php _e( "Minimum width (px)", 'theia-sticky-sidebar' ); ?></label>
								</th>
								<td>
									<input type="text" class="minWidth">

									<p class="description">
										The plugin will be disabled when the user's window width is below this value.
										Useful for
										responsive themes.
									</p>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label><?php _e( "Sidebar behavior", 'theia-sticky-sidebar' ); ?></label>
								</th>
								<td class="sidebarBehavior">
									<label>
										<input type="radio" value="modern" checked>
										Modern
									</label>

									<p class="description">
										Scrolling back up will immediately scroll the sidebar as well. Thus, the user
										can easily
										scroll to any part of the sidebar.
									</p>

									<br>

									<label>
										<input type="radio" value="stick-to-top">
										Stick to top
									</label>

									<p class="description">
										Scrolling down will reveal the lower part of the sidebar only once you reach the
										page footer.
										In other words, only the top of the sidebar is visible most of the time.
									</p>

									<br>

									<label>
										<input type="radio" value="stick-to-bottom">
										Stick to bottom
									</label>

									<p class="description">
										Scrolling back up will reveal the upper part of the sidebar only once you reach
										the page header.
										In other words, only the bottom of the sidebar is visible most of the time.
									</p>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<?php _e( "Only enable on the following posts/pages:", 'theia-sticky-sidebar' ); ?>
								</th>
								<td>
									<p>
										<select class="enabledPosts" style="width: 99%" multiple="multiple">
										</select>
									</p>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<?php _e( "Troubleshooting:", 'theia-sticky-sidebar' ); ?>
								</th>
								<td>
									<p>
										<label>
											<input type="checkbox" value="true" class="updateSidebarHeight">
											Update sidebar height
										</label>
									</p>

									<p class="description">
										Try this if the sidebar loses its background color.
									</p>

									<br>

									<p>
										<label>
											<input type="checkbox"
											       value="true"
											       class="disableOnResponsiveLayouts"
											       checked>
											Try to automatically disable on responsive layouts (i.e. enable on desktop, disable on mobile/tablet).
										</label>
									</p>

									<p class="description">
										The plugin will be disabled if the specified container has a smaller or equal width than the sidebar.
									</p>
								</td>
							</tr>
						</table>
					</td>
					<td>

					</td>
				</tr>
				</tbody>
			</table>

			<button type="button" class="button add-another-sidebar">
				<span class="dashicons dashicons-plus"></span>
				Add another sidebar
			</button>

			<div class="tss-initial-options">
				<table class="form-table tss-table-general-tab">
					<tr valign="top">
						<th scope="row">
							<?php _e( "Troubleshooting:", 'theia-sticky-sidebar' ); ?>
						</th>
						<td>
							<p>
								<label>
									<?php
									$checked = array_key_exists( 'preRenderContainersForSidebars', $options ) && $options['preRenderContainersForSidebars'];
									?>
									<input type='hidden' value='false' name='tss_general[preRenderContainersForSidebars]'>
									<input type="checkbox"
									       value="true"
									       id="tss_disableOnHomePage"
									       name="tss_general[preRenderContainersForSidebars]"<?php echo $checked ? ' checked' : ''; ?>>
									Pre-render the inner container for each sidebar
								</label>
							</p>
							<p class="description">
								Use this if your ads stop working.
								The plugin requires your sidebars to have an inner &lt;div class="theiaStickySidebar"&gt;,
								which can be pre-rendered directly in the HTML output or added via JavaScript.
							</p>

							<br>

							<p>
								<label>
									<?php
									$checked = array_key_exists( 'disableOnHomePage', $options ) && $options['disableOnHomePage'];
									?>
									<input type='hidden' value='false' name='tss_general[disableOnHomePage]'>
									<input type="checkbox"
									       value="true"
									       id="tss_disableOnHomePage"
									       name="tss_general[disableOnHomePage]"<?php echo $checked ? ' checked' : ''; ?>>
									Disable on the home page
								</label>
							</p>

							<p>
								<label>
									<?php
									$checked = array_key_exists( 'disableOnCategoryPages', $options ) && $options['disableOnCategoryPages'];
									?>
									<input type='hidden' value='false' name='tss_general[disableOnCategoryPages]'>
									<input type="checkbox"
									       value="true"
									       id="tss_disableOnCategoryPages"
									       name="tss_general[disableOnCategoryPages]"<?php echo $checked ? ' checked' : ''; ?>>
									Disable on category pages
								</label>
							</p>

							<p>
								<label>
									<?php
									$checked = array_key_exists( 'disableOnPages', $options ) && $options['disableOnPages'];
									?>
									<input type='hidden' value='false' name='tss_general[disableOnPages]'>
									<input type="checkbox"
									       value="true"
									       id="tss_disableOnPages"
									       name="tss_general[disableOnPages]"<?php echo $checked ? ' checked' : ''; ?>>
									Disable on pages
								</label>
							</p>

							<p>
								<label>
									<?php
									$checked = array_key_exists( 'disableOnPosts', $options ) && $options['disableOnPosts'];
									?>
									<input type='hidden' value='false' name='tss_general[disableOnPosts]'>
									<input type="checkbox"
									       value="true"
									       id="tss_disableOnPosts"
									       name="tss_general[disableOnPosts]"<?php echo $checked ? ' checked' : ''; ?>>
									Disable on posts
								</label>
							</p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<?php _e( "Custom CSS:", 'theia-sticky-sidebar' ); ?>
						</th>
						<td>
						<textarea class="large-text code"
						          rows="10"
						          name="tss_general[customCss]"><?php echo $options['customCss']; ?></textarea>
						</td>
					</tr>
				</table>
			</div>

			<p class="submit">
				<input type="submit"
				       class="button-primary"
				       value="<?php _e( 'Save Changes', 'theia-sticky-sidebar' ) ?>" />
			</p>
		</form>

		<script>
			(function ($) {
				var sidebars = JSON.parse($('#sidebarsData').val());
				var sidebarsTable = $('#sidebarsTable');
				var getPostsNonce = <?php echo json_encode( wp_create_nonce( TssAjax::GET_POSTS_NONCE ) ); ?>;

				// Load JSON into fields.
				function loadJson() {
					for (var i = 0; i < sidebars.length; i++) {
						renderSidebarRow(sidebars[i]);
					}
				}

				// Save fields into JSON.
				function saveJson() {
					var sidebars = [];

					sidebarsTable.find('.sidebar').each(function () {
						var $this = $(this);
						var sidebar = {
							'sidebarName': $this.find('.sidebarName').val(),
							'sidebarSelector': $this.find('.sidebarSelector').val(),
							'containerSelector': $this.find('.containerSelector').val(),
							'additionalMarginTop': $this.find('.additionalMarginTop').val(),
							'additionalMarginBottom': $this.find('.additionalMarginBottom').val(),
							'minWidth': $this.find('.minWidth').val(),
							'sidebarBehavior': $this.find('.sidebarBehavior input:checked').val(),
							'updateSidebarHeight': $this.find('.updateSidebarHeight').prop('checked'),
							'disableOnResponsiveLayouts': $this.find('.disableOnResponsiveLayouts').prop('checked'),
							'enabledPosts': $this.find('.enabledPosts.original').select2('data').map(function (e) {
								return e.id;
							}).join(',')
						};

						sidebars.push(sidebar);
					});

					$('#sidebarsData').val(JSON.stringify(sidebars));
				}

				function buttonAddSidebars() {
					renderSidebarRow();
				}

				function renderSidebarRow(data) {
					var count = sidebarsTable.find('.sidebar').length;

					var tdNumber = $('<td class="tdNumber">#' + (count + 1) + '</td>');

					var tdContent = $('#sidebarsTemplate').clone();

					var showHideButton = '<button type="button" class="button button-show-hide"><span class="dashicons dashicons-visibility"></span> <span class="span-show-hide">Show</span></button>';
					var tdButtons = $('<td class="tdButtons" style="text-align: center;">' + showHideButton + '<button type="button" class="button button-remove"><span class="dashicons dashicons-trash"></span> Remove</button></td>');
					tdButtons.find('.button-remove').on('click', function () {
						var r = confirm('Are you sure you want to remove this sidebar?');
						if (r) {
							$(this).closest('.sidebar').remove();
						}
					});

					var tr = $('<tr class="sidebar"></tr>')
						.append(tdNumber)
						.append(tdContent)
						.append(tdButtons);

					if (count % 2) {
						tr.addClass('alternate');
					}

					// Set unique attributes.
					tdContent.find('.sidebarBehavior input').attr('name', 'sidebarBehavior-' + count);

					// Set values.
					var enabledPostsSelect = tdContent.find('.enabledPosts');
					if (data) {
						var texts = [
							'sidebarName',
							'sidebarSelector',
							'containerSelector',
							'additionalMarginTop',
							'additionalMarginBottom',
							'minWidth'
						];
						for (var i = 0; i < texts.length; i++) {
							var value = texts[i];

							tdContent.find('.' + value).val(data[value]);
						}

						tdContent.find('.sidebarBehavior input[value=' + data['sidebarBehavior'] + ']').attr('checked', true);
						tdContent.find('.updateSidebarHeight').attr('checked', data['updateSidebarHeight']);
						tdContent.find('.disableOnResponsiveLayouts').attr('checked', data['disableOnResponsiveLayouts']);

						// Setup enabledPosts.
						for (var postId in data['enabledPosts']) {
							var option = $('<option></option>');

							option.attr('value', postId);
							option.attr('selected', 'selected');
							option.html(data['enabledPosts'][postId]);
							enabledPostsSelect.append(option);
						}
					}

					enabledPostsSelect.select2({
						ajax: {
							url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
							dataType: 'json',
							delay: 250,
							data: function (params) {
								return {
									action: 'tss_get_posts',
									_wpnonce: getPostsNonce,
									q: params.term,
									page: params.page
								};
							},
							processResults: function (data, params) {
								params.page = params.page || 1;

								return {
									results: data.items,
									pagination: {
										more: data.more
									}
								};
							},
							cache: false
						},
						minimumInputLength: 0
					}).addClass('original');

					sidebarsTable.children('tbody').append(tr);
				}

				function initiallyHideSidebars() {
					$('.sidebar').find('tr:not(:first-child)').hide();
				}

				function showHideSidebar() {
					var button = $('.button-show-hide');
					button.on('click', function () {
						var currentSidebar = $(this).parent().parent().find('tr:not(:first-child)');

						if (!currentSidebar.is(':hidden')) {
							currentSidebar.fadeOut('slow');
							$(this).find('.span-show-hide').text('Show');
						}
						else {
							currentSidebar.fadeIn('slow');
							$(this).find('.span-show-hide').text('Hide');
						}
					});
				}

				// Submit button
				$('p.submit').on('click', function () {
					saveJson();
				});

				// Add another sidebar
				$('.add-another-sidebar').on("click", function () {
					buttonAddSidebars();
				});

				// Init
				$(document).ready(function () {
					loadJson();
					initiallyHideSidebars();
					showHideSidebar();
				});
			})(jQuery);
		</script>
		<?php
	}
}