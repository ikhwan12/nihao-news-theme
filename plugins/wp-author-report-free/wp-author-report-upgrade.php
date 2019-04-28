<?php

	function wpar_add_upgrade_page()
	{
	#add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
	add_submenu_page( WPAR_PLUGIN_SLUG, "WP Author Report Upgrade", "Upgrade", 'manage_options', __FILE__, 'wpar_upgrade_page' );
	}
   add_action('admin_menu', 'wpar_add_upgrade_page');
   
	function wpar_upgrade_page()
	{
	echo "<div style=\"width: 1010px; padding-left: 10px;\" class=\"wrap\">";
		echo "<div style=\"width: 800px; float:left;\">";
			author_report_header();?>
			<div style="font-size:30px; font-weight:bold; color:#4A8500; line-height:30px; margin:10px auto; text-align:center;">Upgrade to Premium</div>
			<div style="color:#006699; font-size:20px; font-weight:bold; text-align:center; line-height:25px;">Click "Buy Now" button below to purchase premium version. Or you could get our "Auto Upgradable" basic version freely downloadable from <a style="color:#D54E21" href="" target="_blank">LOL !!!</a>.</div>
			<h1 style="text-align:center; font-size:50px;"><a href="" target="_blank">Just Kidding! Don't be to serious :P</a></h1>
			<?php
		echo "</div>";
		include_once(WPAR_PLUGIN_PATH."wp-author-report-sidebar.php");
		echo '<div style="clear:both"></div>';
	echo "</div>";
	}


?>