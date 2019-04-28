
<script type="text/html" id="yrc-shortcode-instructions">
	<div class="yrc-ics">
		<div class="yrc-ics-header">
			<h2>YourChannel Instructions</h2>
			<p>We're working on a visual shortcode editor, until then please follow these instructions.</p>
			<p>Email us to <a href="mailto:support@plugin.builders?subject=YourChannel Shortcode Instructions" target="_blank">support@plugin.builders</a> for any problems, we'll be fast.</p>
			<?php if( !self::$is_pro ): ?>
				<div style="margin-top:.65em"><a href="https://plugin.builders/yourchannel/?from=wp&v=<?php echo self::$version; ?>&ics=1" class="button button-primary" target="_blank">Upgrade to PRO</a></div>
			<?php endif; ?>
		</div>
		<div>
			
			<div class="yrc-ics-set">
				<h3>Show single videos</h3>
				<div>
					<h4>Show video by URL or Video ID</h4>
					<ul>
						<li>Put <code>[yourchannel user="<em>your username</em>" video="https://www.youtube.com/watch?v=e3dVDn1A4C8"]</code></li>
						<li>Or <code>[yourchannel user="<em>your username</em>" video="e3dVDn1A4C8"]</code></li>
						<li>You can also leave the <code>user="..."</code> part, now your shortcode'll look like: <code>[yourchannel video="e3dVDn1A4C8"]</code>. Any styles needed will be taken from the first channel you have in YourChannel page.</li>
					</ul>
					<h4 class="yrc-ics-pro">Show video by getting video IDs from URL</h4>
					<ul class="yrc-ics-pro">
						<li>Add <code>?v=<em>https://www.youtube.com/watch?v=e3dVDn1A4C8</em></code> to your site URL and put <code>[yourchannel video_from="url_parameter" url_parameter="<em>v</em>"]</code> in your post. You can use any term in place of the <code>v</code>, they just need to be same in both URL and <code>url_parameter</code> field of shortcode. You can enter multiple video URLs or IDs separated by commas in the URL and YourChannel will show multiple videos one after another.</li>
					</ul>
					<h4 class="yrc-ics-pro">Show video from search results</h4>
					<ul class="yrc-ics-pro">
						<li>Add <code>[yourchannel video_from="search" search="<em>what to search</em>"]</code> to the post and it'll show first video from the search results. You can show multiple videos by adding <code>limit="<em>n</em>"</code> to shortcode, replace <code>n</code> with a number.</li>
					</ul>
					<h4 class="yrc-ics-pro">Show video from a playlist</h4>
					<ul class="yrc-ics-pro">
						<li>Add <code>[yourchannel video_from="playlist" playlist="<em>https://www.youtube.com/watch?v=e3dVDn1A4C8&list=RDe3dVDn1A4C8</em>"]</code> to the post and it'll show first video from the playlist. You can show multiple videos by adding <code>limit="<em>n</em>"</code> to shortcode, replace <code>n</code> with a number.</li>
					</ul>
				</div>
			</div>
			
			<div class="yrc-ics-set">
				<h3>Show channels / streams</h3>
				<div>
					<h4>Show a channel</h4>
					<ul>
						<li>Add <code>[yourchannel user="<em>your username</em>"]</code> to your post. This will show the channel you created in YourChannel page. Copy & Paste the shortcode in YourChannel page.</li>
					</ul>
					<h4 class="yrc-ics-pro">Show a different channel</h4>
					<ul class="yrc-ics-pro">
						<li>Add <code>[yourchannel user="<em>your username</em>" channel="<em>https://www.youtube.com/channel/UCnOTVWVaIh3NoJsbwq4Tucg</em>"]</code> to your post. This will show everything (Banner, Videos, Playlists) of this channel in shortcode.</li>
					</ul>
					<h4 class="yrc-ics-pro">Show videos from a playlist in Videos tab</h4>
					<ul class="yrc-ics-pro">
						<li>Add <code>playlist="<em>https://www.youtube.com/watch?v=e3dVDn1A4C8&list=RDe3dVDn1A4C8</em>"</code> to the shortcode.</li>
					</ul>
					<h4 class="yrc-ics-pro">Show videos by a search term in Videos tab</h4>
					<ul class="yrc-ics-pro">
						<li>Add <code>search="<em>what to search</em>"</code> to the shortcode. Add <code>own="1"</code> to shortcode if you want to restrict the search to your channel. You can also add <code>channel="<em>https://www.youtube.com/channel/UCEkBEbI7ME92qqjMjqvuIQA</em>"</code> to shortcode to search any specific channel.</li>
					</ul>
					<h4 class="yrc-ics-pro">Show videos from a custom playlist</h4>
					<ul class="yrc-ics-pro">
						<li>Add <code>custom="<em>custom_playlist_name</em>"</code> to the shortcode. You must have created a custom playlist in YourChannel page with the name <code><em>custom_playlist_name</em></code>. You can also create custom playlists in the shortcode itself, add <code>custom="<em>3pLWskANffo,jNebrSB-r7Q</em>"</code> (video IDs or URLs separated by commas) to shortcode.</li>
					</ul>
				</div>
			</div>
			
			<div class="yrc-ics-set">
				<h3>Other important options</h3>
				<div>
					<h4>Autoplay video</h4>
					<ul>
						<li>Add <code>autoplay="1"</code> to the shortcode. Add <code>autoplay=""</code> if the channel has autoplay enabled in its form in YourChannel page and you want to disable it for this shortcode. *This option only works with single videos in Free version.</li>
					</ul>
					<h4>Sticky (Floating) player</h4>
					<ul>
						<li>Add <code>sticky="1"</code> to shortcode to make player for this shortcode sticky when user scrolls out of view. You can customise more sticky options in <strong>Style > Show Options > Sticky Player</strong> section of YourChannel form.</li>
					</ul>
					<h4>Pagination</h4>
					<ul>
						<li>Add <code>limit="<em>n</em>"</code> to shortcode to show <code><em>n</em></code> videos per load. Add <code>max="<em>n</em>"</code> to show maximum of <code><em>n</em></code> videos (There'll be no <strong>Load more</strong> button after this many videos are shown).</li>
					</ul>
					<h4>Ads</h4>
					<ul>
						<li>We use some workarounds to show ads in videos that are autoplayed (YouTube doesn't show ads in videos that are not just <code>iframe</code> embeds without autoplay). Because of this, you might notice sometimes videos don't start playing immediately, add <code>ads=""</code> to shortcode to fix this (you won't see ads). <strong>But you'll generally not notice the delay caused by workaround.</strong></li>
					</ul>
					<h4 class="yrc-ics-pro">Video start time</h4>
					<ul class="yrc-ics-pro">
						<li>Add <code>start="n"</code> to the shortcode. Replace <code>n</code> with number of seconds to start at.</li>
					</ul>
					<h4 class="yrc-ics-pro">Initial player volume</h4>
					<ul class="yrc-ics-pro">
						<li>Add <code>volume="n"</code> to the shortcode. Replace <code>n</code> with a number between <code>0</code> and <code>100</code>.</li>
					</ul>
					<h4 class="yrc-ics-pro">Rich player</h4>
					<ul class="yrc-ics-pro">
						<li>Add <code>show_meta="1"</code> to show player title, uploader & statistics under the player. Add <code>show_desc="1"</code> to show description. And add <code>show_comments="1"</code> to show comments.</li>
					</ul>
					<h4 class="yrc-ics-pro">Sorting</h4>
					<ul class="yrc-ics-pro">
						<li>Add <code>sortby="sorting_method"</code> to shortcode to sort videos in a certain way. <code>sorting_method</code> must be one of <code>date</code>, <code>rating</code>, <code>viewCount</code> or <code>title</code>.</li>
					</ul>
				</div>
			</div>
						
		</div>
	</div>
</script>
