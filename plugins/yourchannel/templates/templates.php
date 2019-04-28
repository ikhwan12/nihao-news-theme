<script type="text/template" id="yrc-main-tmpl">
	<div id="yrc-channels" class="wpb-hidden yrc-content">
		<div class="yrc-content-header wpb-clr">
			<h2 class="wpb-float-left"><?php _e('Channels', 'YourChannel'); ?></h2>
			<div class="yrc-content-buttons wpb-float-right"></div>
		</div>
		<table class="widefat">
			<thead>
				<tr>
					<th><?php _e('Username', 'YourChannel'); ?></th>
					<th><?php _e('Channel', 'YourChannel'); ?></th>
					<th><?php _e('Shortcode', 'YourChannel'); ?></th>
					<th colspan="3"></th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
	<div id="yrc-editor"></div>
	<div id="yrc-live" class="wpb-hidden"></div>
	<div id="yrc-version-info" class="wpb-hidden" style="padding:.5em;border:1px solid #000;margin:.35em 0;">
		<h3><b><?php _e('New version', 'YourChannel'); ?>: <span class="yrc-version"></span></b></h3>
		<p><?php _e('If something seems off please edit and save your channel', 'YourChannel'); ?>.</p>
	</div>
	<div id="pbc-feedback">
		<a class="button" href="mailto:suggest@plugin.builders?subject=Extend YourChannel"><?php _e('Suggest Feature', 'YourChannel'); ?></a>
		<a class="button" href="mailto:support@plugin.builders?subject=YourChannel Problem"><?php _e('Report Issue', 'YourChannel'); ?></a>
		<a class="button" href="https://wordpress.org/support/view/plugin-reviews/yourchannel?#postform" target="_blank"><?php _e('Write a review', 'YourChannel'); ?></a>
		<a class="button" href="https://plugin.builders/yourchannel/support" target="_blank"><?php _e('Docs & Troubleshooting', 'YourChannel'); ?></a>
	</div>
	<div id="yrc-do-upgrade">
		<?php if( method_exists($this, 'proFeatures') ): ?>
			<h3>Pro version features:</h3>
			<a class="button button-primary" target="_blank" href="https://plugin.builders/yourchannel/?from=wp&v=<?php echo WPB_YourChannel::$version; ?>">Upgrade</a>
			<a class="button" target="_blank" href="mailto:enquiry@plugin.builders?subject=YourChannel Enquiry">Pre-Purchase Question?</a>
			<ul>
				<?php $this->proFeatures(); ?>
			</ul>
			<a class="button button-primary" target="_blank" href="https://plugin.builders/yourchannel/?from=wp&v=<?php echo WPB_YourChannel::$version; ?>">Upgrade</a>
			<a class="button" target="_blank" href="mailto:enquiry@plugin.builders?subject=YourChannel Enquiry">Pre-Purchase Question?</a>
		<?php endif; ?>
	</div>
</script>				

<script type="text/template" id="yrc-form-tmpl">
	<form class="pbc-pane" id="pbc-form">
		<div class="pbc-row">
			<div class="pbc-row-label wpb-inline"><?php _e('API Key', 'YourChannel'); ?></div>
			<div class="pbc-row-field wpb-inline">
				<input name="apikey" value="<%= meta.apikey %>" class="wpb-raw"/>
				<p style="margin:.25em 0">Please create your own API key by following <a href="http://plugin.builders/yourchannel-setup/" target="_blank">instructions here,</a> not doing so might show just <strong>Loading...</strong></p>
			</div>
		</div>
	
		<div class="pbc-row">
			<div class="pbc-row-label wpb-inline"><?php _e('YouTube', 'YourChannel'); ?></div>
			<div class="pbc-row-field wpb-inline" id="yrc-user-fields">
				<div class="pbc-field wpb-inline">
					<label class="pbc-field-label"><?php _e('Username', 'YourChannel'); ?>: <input name="user" value="<%= meta.user %>" class="wpb-raw" id="yrc-username" placeholder="<?php _e('Username', 'YourChannel'); ?>"/><span> <?php _e('OR', 'YourChannel'); ?> </span></label>
				</div></br></br>
				<div class="pbc-field wpb-inline">
					<label class="pbc-field-label"><?php _e('Channel', 'YourChannel'); ?> <?php _e('ID', 'YourChannel'); ?>: <input name="channel" value="<%= meta.channel %>" class="wpb-raw" id="yrc-channel" placeholder="<?php _e('Channel', 'YourChannel'); ?>"/></label>
				</div>
				<div class="pbc-field wpb-inline">
					<a class="button" id="yrc-get-channel-id"><?php _e('Check', 'YourChannel'); ?></a>
				</div>
				<div class="pbc-form-message" id="yrc-ac-error"></div>
			</div>
		</div>
		
		<div class="pbc-row">
			<div class="pbc-row-label wpb-inline"><?php _e('Cache Refresh', 'YourChannel'); ?></div>
			<div class="pbc-row-field wpb-inline">
				<input type="number" value="<%= meta.cache %>" name="cache" class="wpb-raw"/> <?php _e('minutes', 'YourChannel'); ?>
			</div>
		</div>
							
		<div class="pbc-row">
			<div class="pbc-row-label wpb-inline"><?php _e('Show', 'YourChannel'); ?></div>
			<div class="pbc-row-field wpb-inline" id="pbc-show-sections">
				<div class="pbc-field wpb-inline">
					<label class="pbc-field-label"><input type="checkbox" name="uploads" <%- style.uploads ? 'checked' : '' %>/>: <?php _e('Videos', 'YourChannel'); ?> </label>
				</div>

				<div class="pbc-field wpb-inline">
					<label class="pbc-field-label"><input type="checkbox" name="playlists" <%- style.playlists ? 'checked' : '' %>/>: <?php _e('Playlists', 'YourChannel'); ?> </label>
				</div>
								
				<div class="pbc-field wpb-inline">
					<label class="pbc-field-label"><input type="checkbox" name="banner" <%- style.banner ? 'checked' : '' %>/>: <?php _e('Banner', 'YourChannel'); ?> </label>
				</div>
			</div>
		</div>
		
		<div class="pbc-row">
			<div class="pbc-row-label wpb-inline"><?php _e('Style', 'YourChannel'); ?></div>
			<div class="pbc-row-field wpb-inline">
				<a class="button pbc-field-toggler"><?php _e('Show Options', 'YourChannel'); ?></a>
				<div class="pbc-togglable-field wpb-force-hide" id="pbc-style-field">	
					
					<%
					var t = 0, titles = {'videos': '<?php _e('Videos Theme', 'YourChannel'); ?>', 'playlists': '<?php _e('Playlists Theme', 'YourChannel'); ?>'};
					delete style.theme.a;
					for( var theme in style.theme ){ var th = style.theme[theme]; %>
					<div class="pbc-row yrc-theme" data-theme="<%= theme %>">
						<div class="pbc-row-label wpb-inline"><%= titles[theme] %></div>
						<div class="pbc-row-field wpb-inline">
							<div class="pbc-field wpb-inline">
								<label class="pbc-row-label wpb-inline">Style: &nbsp;&nbsp;
									<select class="yrc-theme-style" name="style">
										<% var styles = <?php echo json_encode( apply_filters('yrc_list_theme_types', array( array('__grid', __('Grid', 'YourChannel')), array('__list', __('List', 'YourChannel')) )) ); ?>;
											styles.filter(function(style){
												if(theme === 'playlists') return style[0] !== '__sidebar';
												return true;
											}).forEach(function(style){ %>
												<option value="<%= style[0] %>" <%- th.style === style[0] ? 'selected' : '' %>><%= style[1] %></option>
										<%	}); %>
									</select>
								</label>
							</div>
							
							<div class="pbc-row pbc-border-bot" data-show="['__sidebar']">
								<p>This theme is best used when you have checked only <strong>Videos</strong> or <strong>Playlists</strong> or <strong>Search</strong> in <strong>Show</strong> section above.</p>
							</div>
							
							<div class="pbc-row pbc-border-both" data-show="['__grid']">
								<div class="pbc-row-label wpb-inline"><?php _e('Thumb size', 'YourChannel'); ?>: </div>
								<div class="pbc-row-field wpb-inline yrc-thumb-styles">
									<div class="pbc-field wpb-inline">
										<label><input type="radio" name="video_size[<%= t %>]" value="small" class="wpb-raw" <%- th.thumb[0] === 'small' ? 'checked' : ''  %>/><?php _e('Small', 'YourChannel'); ?></label>
									</div>
									
									<div class="pbc-field wpb-inline">
										<label><input type="radio" name="video_size[<%= t %>]" value="large" class="wpb-raw" <%- th.thumb[0] === 'large' ? 'checked' : ''  %>/><?php _e('Large', 'YourChannel'); ?></label>
									</div>
								</div>
							</div>
							<div class="pbc-row">
								<div class="pbc-row-label wpb-inline"><?php _e('Meta', 'YourChannel'); ?>: </div>
								<div class="pbc-row-field wpb-inline yrc-thumb-styles">
									<div class="pbc-field wpb-inline">
										<label><input type="radio" name="video_meta[<%= t %>]" value="none" class="wpb-raw" <%- th.thumb[1] === 'none' ? 'checked' : ''  %>/><?php _e('None', 'YourChannel'); ?></label>
									</div>
									
									<div class="pbc-field wpb-inline">
										<label><input type="radio" name="video_meta[<%= t %>]" value="open" class="wpb-raw" <%- th.thumb[1] === 'open' ? 'checked' : ''  %>/><?php _e('Bottom', 'YourChannel'); ?></label>
									</div>
									
									<div class="pbc-field wpb-inline">
										<label><input type="radio" name="video_meta[<%= t %>]" value="adjacent" class="wpb-raw" <%- th.thumb[1] === 'adjacent' ? 'checked' : ''  %>/><?php _e('Right', 'YourChannel'); ?></label>
									</div>
									
									<div class="pbc-field wpb-inline">
										<label><input type="radio" name="video_meta[<%= t %>]" value="closed" class="wpb-raw" <%- th.thumb[1] === 'closed' ? 'checked' : ''  %>/><?php _e('Show on Hover', 'YourChannel'); ?></label>
									</div>
								</div>
							</div>
							
							<div class="pbc-row">
								<div class="pbc-row-label wpb-inline"><?php _e('Show Description', 'YourChannel'); ?>: </div>
								<div class="pbc-row-field wpb-inline">
									<div class="pbc-field wpb-inline">
										<label><input type="checkbox" name="desc" class="wpb-raw" <%- th.desc ? 'checked' : ''  %>/></label>
									</div>
								</div>
							</div>
							
							<div class="pbc-field wpb-inline" data-show="['__carousel', '__grid-PRO']">
								<label>Columns: <input type="number" min="0" max="12" value="<%= th.carousel.thumbs %>" name="carousel-thumbs"/></label>
							</div>
							<div class="pbc-field wpb-inline" data-show="['__carousel']">
								<label>Columns to slide: <input type="number" min="0" max="12" value="<%= th.carousel.thumbs_to_slide %>" name="carousel-thumbs_to_slide"/></label>
							</div>
							<div class="pbc-field wpb-inline" data-show="['__grid', '__carousel', '__list', '__sidebar']">
								<label>Gutter: <input type="number" min="0" max="48" value="<%= th.carousel.spacing %>" name="carousel-spacing"/>px</label>
							</div>
							
							<div class="pbc-row pbc-border-top" data-show="['__carousel', '__slides']">
								<% var cn = th.carousel_nav; %>
								<label class="pbc-row-label" style="margin-bottom:.5em;display:block">Slider Nav: </label>
								<div class="pbc-field wpb-inline">
									<label title="<?php _e('Style', 'YourChannel'); ?>"><?php _e('Style', 'YourChannel'); ?>: <select name="carousel_nav-modifier">
										<% [['__sides', '<?php _e('Sides', 'YourChannel'); ?>'], ['__fixed', '<?php _e('Inside', 'YourChannel'); ?>'], ['__apart', '<?php _e('Outside', 'YourChannel'); ?>']].forEach(function(st){ %>
											<option <%- cn.modifier === st[0] ? 'selected' : '' %> value="<%= st[0] %>"><%= st[1] %></option>
										<% }); %>
									</select></label>
								</div>
								<div class="pbc-field wpb-inline">
									<label title="<?php _e('Align', 'YourChannel'); ?>"><?php _e('Align', 'YourChannel'); ?>: <select name="carousel_nav-position">
										<% [['left-none', '<?php _e('Left', 'YourChannel'); ?>'], ['right-none', '<?php _e('Right', 'YourChannel'); ?>'], ['center-none', '<?php _e('Center', 'YourChannel'); ?>'], ['left-right', '<?php _e('Across', 'YourChannel'); ?>']].forEach(function(st){ %>
											<option <%- cn.position === st[0] ? 'selected' : '' %> value="<%= st[0] %>"><%= st[1] %></option>
										<% }); %>
									</select></label>
								</div>
								<div class="pbc-field wpb-inline">
									<label title="<?php _e('Before or after the slider', 'YourChannel'); ?>"><?php _e('Location', 'YourChannel'); ?>: <select name="carousel_nav-location">
										<% [['prepend', '<?php _e('Before', 'YourChannel'); ?>'], ['append', '<?php _e('After', 'YourChannel'); ?>']].forEach(function(st){ %>
											<option <%- cn.location === st[0] ? 'selected' : '' %> value="<%= st[0] %>"><%= st[1] %></option>
										<% }); %>
									</select></label>
								</div>
							</div>
							
						</div>
					</div>
					<% t++; } %>
									
					<div class="pbc-row wpb-force-hide">
						<div class="pbc-row-label wpb-inline"><?php _e('Thumb image size', 'YourChannel'); ?></div>
						<div class="pbc-row-field wpb-inline">
							<div class="pbc-field wpb-inline">
								<label><input type="radio" name="thumb_image_size" value="medium" class="wpb-raw" <%- style.thumb_image_size === 'medium' ? 'checked' : ''  %>/><?php _e('Medium', 'YourChannel'); ?></label>
							</div>
							
							<div class="pbc-field wpb-inline">
								<label><input type="radio" name="thumb_image_size" value="high" class="wpb-raw" <%- style.thumb_image_size === 'high' ? 'checked' : ''  %>/><?php _e('Large', 'YourChannel'); ?></label>
							</div>
						</div>
					</div>
										
					<div class="pbc-row">
						<div class="pbc-row-label wpb-inline"><?php _e('Play icon', 'YourChannel'); ?></div>
						<div class="pbc-row-field wpb-inline">
							<div class="pbc-field wpb-inline">
								<label><input type="radio" name="play_icon" value="all" class="wpb-raw" <%- style.play_icon === 'all' ? 'checked' : ''  %>/><?php _e('Show', 'YourChannel'); ?></label>
							</div>
							
							<div class="pbc-field wpb-inline">
								<label><input type="radio" name="play_icon" value="hover" class="wpb-raw" <%- style.play_icon === 'hover' ? 'checked' : ''  %>/><?php _e('Show on Hover', 'YourChannel'); ?></label>
							</div>
							
							<div class="pbc-field wpb-inline">
								<label><input type="radio" name="play_icon" value="" class="wpb-raw" <%- style.play_icon === '' ? 'checked' : ''  %>/>None</label>
							</div> | 
							
							&nbsp; &nbsp; <div class="pbc-field wpb-inline">
								<label><input type="checkbox" name="youtube_play_icon" value="" class="wpb-raw" <%- style.youtube_play_icon ? 'checked' : ''  %>/>Use YouTube icon</label>
							</div>
						</div>
					</div>
										
					<div class="pbc-row">
						<div class="pbc-row-label wpb-inline"><?php _e('Player', 'YourChannel'); ?></div>
						<div class="pbc-row-field wpb-inline" id="yrc-player-options">
							<div class="pbc-field wpb-inline">
								<label><input type="radio" name="player_mode" value="1" class="wpb-raw" <%- parseInt(style.player_mode) ? 'checked' : ''  %>/><?php _e('Inline', 'YourChannel'); ?></label>
							</div>
							
							<div class="pbc-field wpb-inline">
								<label><input type="radio" name="player_mode" value="3" class="wpb-raw" <%- (parseInt(style.player_mode) === 3) ? 'checked' : ''  %>/><?php _e('At Top', 'YourChannel'); ?></label>
							</div>
							
							<div class="pbc-field wpb-inline">
								<label><input type="radio" name="player_mode" value="0" class="wpb-raw" <%- parseInt(style.player_mode) ? '' : 'checked'  %>/><?php _e('Lightbox', 'YourChannel'); ?></label>
							</div>
							
							<div class="pbc-field wpb-inline">
								<label><input type="radio" name="player_mode" value="2" class="wpb-raw" <%- (parseInt(style.player_mode) === 2) ? 'checked' : ''  %>/><?php _e('YouTube', 'YourChannel'); ?></label>
							</div>
						</div>
					</div>
					
					<div class="pbc-row">
						<div class="pbc-row-label wpb-inline"><?php _e('Sticky Player', 'YourChannel'); ?></div>
						<div class="pbc-row-field wpb-inline">		
							<div class="pbc-field wpb-inline" style="margin-top:.45em">
								<label><input type="checkbox" name="enable_sticky" <%- (style.sticky.enable) ? 'checked' : '' %> class="wpb-raw"/><?php _e('Enable', 'YourChannel'); ?></label>
							</div>
							
							&nbsp; &nbsp; <div class="pbc-field wpb-inline yrc-only-pro">
								<label><?php _e('Player Width', 'YourChannel'); ?> <input type="number" name="sticky_width" value="<%= style.sticky.width %>" max="1000" min="0" class="wpb-raw"/>px</label>
							</div>
				
							&nbsp; &nbsp; <div class="pbc-field wpb-inline yrc-only-pro">
								<label title="Minimum screen width to show sticky player in"><?php _e('Minimum screen width', 'YourChannel'); ?> <input type="number" name="sticky_only_above" value="<%= style.sticky.only_above %>" max="" min="0" class="wpb-raw"/>px</label>
							</div>
							
							</br><div class="pbc-field wpb-inline yrc-only-pro">
								<label><?php _e('Position', 'YourChannel'); ?></label>
								<select id="yrc-sticky-position">
									<% [['top-left', 'Top Left'], ['top-right', 'Top Right'], ['bottom-left', 'Bottom Left'], ['bottom-right', 'Bottom Right']].forEach(function(m){ %>
										<option value="<%= m[0] %>" <%- style.sticky.position === m[0] ? 'selected' : '' %> ><%= m[1] %></option>
									<% }); %>
								</select>
							</div>
							
							&nbsp; &nbsp; <div class="pbc-field wpb-inline yrc-only-pro">
								<label title="Distance from screen edges"><?php _e('Margin', 'YourChannel'); ?> <input type="number" name="sticky_margin" value="<%= style.sticky.margin %>" max="100" min="0" class="wpb-raw"/>px</label>
							</div>
						</div>
					</div>
										
					<div class="pbc-row">
						<div class="pbc-row-label wpb-inline"><?php _e('Titles', 'YourChannel'); ?></div>
						<div class="pbc-row-field wpb-inline">
							<div class="pbc-field wpb-inline">
								<label><input type="checkbox" name="truncate" class="wpb-raw" <%- style.truncate ? 'checked' : ''  %>/><?php _e('Single line', 'YourChannel'); ?></label>
							</div>
						</div>
					</div>
										
				</div>	
			</div>
		</div>
				
		<div class="pbc-row">
			<div class="pbc-row-label wpb-inline"><?php _e('Videos missing', 'YourChannel'); ?></div>
			<div class="pbc-row-field wpb-inline">
				<label><input type="checkbox" <%- meta.onlyonce ? 'checked' : '' %> name="onlyonce" class="wpb-raw"/><?php _e('Check this ONLY IF some videos are missing, sorting won\'t be available', 'YourChannel'); ?>.</label>
			</div>
		</div>
		
		<div class="pbc-row">
			<div class="pbc-row-label wpb-inline"><?php _e('Videos per load', 'YourChannel'); ?></div>
			<div class="pbc-row-field wpb-inline">
				<input type="number" value="<%= meta.per_page %>" name="per_page" class="wpb-raw"/>
			</div>
		</div>
		
		<div class="pbc-row">
			<div class="pbc-row-label wpb-inline"><?php _e('Max Videos', 'YourChannel'); ?></div>
			<div class="pbc-row-field wpb-inline">
				<input type="number" value="<%= meta.maxv %>" name="maxv" class="wpb-raw"/><small><?php _e('Leave empty for no limit', 'YourChannel'); ?>.</small>
			</div>
		</div>
															
		<div class="pbc-form-save">
			<div class="pbc-form-message"></div>
			<button class="button button-primary"><?php _e('Save', 'YourChannel'); ?></button>
			<% if(meta.key !== 'nw'){ %>
				<a class="button" id="pbc-cancel-form"><?php _e('Cancel', 'YourChannel'); ?></a>
				<a class="button" id="pbc-delete-form"><?php _e('Delete', 'YourChannel'); ?></a>
			<% } %>	
		</div>
		
		</br><small><?php _e('Some style changes may not take effect in preview.', 'YourChannel'); ?></small>
	</form>
</script>

<script type="text/template" id="yrc-channel-tmpl">
	<tr data-down="<%= meta.key %>" class="pbc-down">
		<td><span><%= meta.user %></span></td>
		<td><span><%= meta.channel %></span></td>
		<td><span>[yourchannel user="<%= meta.user %>"<%- meta.tag ? ' tag="'+meta.tag+'"' : '' %>]</span></td>
		<td>
			<a class="button pbc-edit" data-down="<%= meta.key %>"><?php _e('Edit', 'YourChannel'); ?></a>
			<a class="button pbc-clear-cache" data-down="<%= meta.key %>"><?php _e('Clear Cache', 'YourChannel'); ?></a>
			<% if(YC.is_pro){ %> <a class="button pbc-copy" data-down="<%= meta.key %>"><?php _e('Duplicate', 'YourChannel'); ?></a> <% } %>
		</td>
	</tr>
</script>

<script type="text/template" id="yrc-lang-form-tmpl">
	<form id="yrc-lang-form" class="pbc-front-form">
	<h2 class="wpb-pointer pbc-front-form-header"><?php _e('Quick Translation', 'YourChannel'); ?></h2>
	<div id="pbc-lang-inputs" class="pbc-front-form-inputs wpb-zero">
		<% for(var t in terms){ %>
			<div class="pbc-field wpb-inline">
				<label><%= YC.lang.form_labels[t] %><input type="text" name="<%= t %>" value="<%= terms[t] %>"/></label>
			</div>
		<% } %>
		<div>
			<button class="button button-primary"><?php _e('Save', 'YourChannel'); ?></button>
			<a class="button" id="yrc-delete-terms"><?php _e('Clear', 'YourChannel'); ?></a>
		</div>
	</div>
	</form>
	<div id="yrc-defined-css" class="wpb-hidden">
		<h2 class="">CSS</h2>
		<ul>
			<li>Hide video views: <code>.yrc-video-views{ display:none; }</code></li>
			<li>Hide video date: <code>.yrc-video-date{ display:none; }</code></li>
			<li>Hide top banner: <code>.yrc-banner:first-child{ display:none; }</code></li>
			<li>Hide bottom banner: <code>.yrc-banner:last-child{ display:none; }</code></li>
			<li>Sorting dropdown background: <code>.yrc-sort-uploads{ background: white; }</code></li>
		</ul>
	</div>
</script>

<?php
	$admin_terms = array(
		'does_not_exist' => __("doesn't exist", 'YourChannel'),
		'saving' => __('Saving', 'YourChannel'),
		'enter_api_key' => __('Please enter your API key', 'YourChannel'),
		'invalid_inputs' => __('Your inputs are invalid, please have a look at them', 'YourChannel'),
		'save' => __('Save', 'YourChannel'),
		'edit' => __('Edit', 'YourChannel'),
		'deleting' => __('Deleting', 'YourChannel'),
		'clear' => __('Clear', 'YourChannel'),
		'clearing' => __('Clearing', 'YourChannel')
	);
	
	$admin_terms = apply_filters('yrc_admin_ui_terms', $admin_terms);
?>

<script>
	<?php WPB_YourChannel::translateTerms(); ?>
	var yrc_lang_terms = {
		'aui': <?php echo json_encode($admin_terms); ?>,
		'form': <?php $ft = get_option('yrc_lang_terms'); echo json_encode($ft ? $ft : WPB_YourChannel::$terms['form']); ?>,
		'fui': <?php echo json_encode(WPB_YourChannel::$terms['front_ui']); ?>
	};
	var yrc_is_pro = <?php echo json_encode(WPB_YourChannel::$is_pro); ?>;
</script>
