<?php

/*
 * Copyright 2013-2017, Theia Sticky Sidebar, WeCodePixels, http://wecodepixels.com
 */

class TssAdmin_Dashboard {
	public $showPreview = true;

	public function echoPage() {
		?>
		<form method="post" action="options.php">
			<h3><?php _e( "Version", 'theia-sticky-sidebar' ); ?></h3>

			<p>
				You are using
				<a href="http://wecodepixels.com/theia-sticky-sidebar-for-wordpress/?utm_source=theia-sticky-sidebar-for-wordpress"
				   target="_blank"><b>Theia Sticky Sidebar</b></a>
				version <b class="theiaSmartThumbnails_adminVersion"><?php echo TSS_VERSION; ?></b>, developed
				by
				<a href="http://wecodepixels.com/?utm_source=theia-sticky-sidebar-for-wordpress"
				   target="_blank"><b>WeCodePixels</b></a>.
				<br>
			</p>
			<br>

			<h3><?php _e( "Support", 'theia-sticky-sidebar' ); ?></h3>

			<p>
				1. If you have any problems or questions, you should first check
				<a href="http://wecodepixels.com/theia-sticky-sidebar-for-wordpress/docs/?utm_source=theia-sticky-sidebar-for-wordpress"
				   class="button"
				   target="_blank">
					The Documentation
				</a>
			</p>

			<form method="post" action="options.php">
				<?php settings_fields( 'tss_options_dashboard' ); ?>

				<p>
					2. If the plugin is misbehaving, try to <input name="tss_dashboard[reset_to_defaults]"
					                                               type="submit"
					                                               class="button"
					                                               value="Reset to Default Settings"
					                                               onclick="if(!confirm('Are you sure you want to reset all settings to their default values?')) return false;">
				</p>
			</form>


			<p>
				3. Deactivate all plugins. If the issue is solved, then re-activate them one-by-one to pinpoint the exact cause.
			</p>
			<p>
				4. If your issue persists, please proceed to
				<a href="http://wecodepixels.com/theia-sticky-sidebar-for-wordpress/support/?utm_source=theia-sticky-sidebar-for-wordpress"
				   class="button"
				   target="_blank">Submit a Ticket</a>
			</p>
			<br>

			<h3><?php _e( "Updates and Announcements", 'theia-sticky-sidebar' ); ?></h3>
			<iframe class="theiaStickySidebar_news"
			        src="//wecodepixels.com/theia-sticky-sidebar-for-wordpress-news"></iframe>
		</form>

	<?php
	}
}
