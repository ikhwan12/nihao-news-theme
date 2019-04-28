<?php
add_action( 'admin_init', 'wp_facebook_popup_settings_init' );
function wp_facebook_popup_settings_init() {	
	register_setting( 'wp_facebook_popup_settings', 'wp_facebook_popup_settings' );	
}

add_action( 'admin_menu', 'wp_facebooks_popup_admin_menu' );
function wp_facebooks_popup_admin_menu() {
	add_options_page( 'Facebook Popup', 'Facebook Popup', 'manage_options', 'facebook_popup', 'wp_facebook_popup_settings_content' );	
}

function wp_facebook_popup_settings_content() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	} 
	$data = get_option('wp_facebook_popup_settings') ;
	echo '<h2>DC - Facebook Like Popup Configuration</h2>';
	echo '<div class="wrap wp-facebook_popup">';				
		echo '<form method="post" action="options.php" >';
				settings_fields('wp_facebook_popup_settings');
				do_settings_sections( 'wp_facebook_popup_settings' );
				echo '<div style="margin: 30px 0 15px; padding: 5px; border: 1px solid #ddd; border-radius: 5px; position: relative;">';
					echo '<label style="font-weight: bold; position: absolute; left: 15px; top: -10px; background: #F1F1F1; padding: 0px 10px;">Enable / Disable</label>';
					echo '<div style="background: #DDDDDD; margin: 10px; padding: 10px; position: relative;">';
						echo wp_facebook_popup_settings_get_control('checkbox',  false,  'Enable/Disable',  'wp_facebook_popup_settings_enable_disable_plugin',  'wp_facebook_popup_settings[enable_disable_plugin]',  (isset($data['enable_disable_plugin'])?$data['enable_disable_plugin']:''),  null, 'Enable/Disable The Plugin.');											echo '</div>';
				echo '</div>';
				echo '<div style="margin: 15px 0; padding: 5px; border: 1px solid #ddd; border-radius: 5px; position: relative;">';
					echo '<label style="font-weight: bold; position: absolute; left: 15px; top: -10px; background: #F1F1F1; padding: 0px 10px;">What to Display</label>';
					echo '<div style="background: #DDDDDD; margin: 10px; padding: 10px; position: relative;">';
						echo wp_facebook_popup_settings_get_control('text',  false,  'Title Text',  'wp_facebook_popup_settings_title_text',  'wp_facebook_popup_settings[title_text]',  (isset($data['title_text'])?$data['title_text']:'Follow us on Facebook!'));	
						echo wp_facebook_popup_settings_get_control('text',  false,  'Enter the URL of Your Facebook Fanpage',  'wp_facebook_popup_settings_facebook_fanpage_url',  'wp_facebook_popup_settings[facebook_fanpage_url]',  (isset($data['facebook_fanpage_url'])?$data['facebook_fanpage_url']:'https://www.facebook.com/DARTCreationsFans'),  null, 'Example:https://www.facebook.com/DARTCreationsFans');	
						echo wp_facebook_popup_settings_get_control('checkbox',  false,  'Show Post?',  'wp_facebook_popup_settings_show_post',  'wp_facebook_popup_settings[show_post]',  (isset($data['show_post'])?$data['show_post']:'1'),  null, 'Displays the last post on Your Facebook Page.');	
					echo '</div>';
				echo '</div>';
				echo '<div style="margin: 15px 0; padding: 5px; border: 1px solid #ddd; border-radius: 5px; position: relative;">';
					echo '<label style="font-weight: bold; position: absolute; left: 15px; top: -10px; background: #F1F1F1; padding: 0px 10px;">Where to Display</label>';
					echo '<div style="background: #DDDDDD; margin: 10px; padding: 10px; position: relative;">';
						echo wp_facebook_popup_settings_get_control('checkbox',  false,  'Show In Home',  'wp_facebook_popup_settings_show_in_home',  'wp_facebook_popup_settings[show_in_home]',  (isset($data['show_in_home'])?$data['show_in_home']:''),  null, 'Whether To Show popup In Home.');								
						echo wp_facebook_popup_settings_get_control('checkbox',  false,  'Show In Posts',  'wp_facebook_popup_settings_show_in_post',  'wp_facebook_popup_settings[show_in_post]',  (isset($data['show_in_post'])?$data['show_in_post']:''),  null, 'Whether To Show popup In Post.');	
						echo wp_facebook_popup_settings_get_control('checkbox',  false,  'Show In Pages',  'wp_facebook_popup_settings_show_in_page',  'wp_facebook_popup_settings[show_in_page]',  (isset($data['show_in_page'])?$data['show_in_page']:''),  null, 'Whether To Show popup In Page.');	
						echo wp_facebook_popup_settings_get_control('checkbox',  false,  'Show Everywhere Else',  'wp_facebook_popup_settings_show_everywhere',  'wp_facebook_popup_settings[show_everywhere]',  (isset($data['show_everywhere'])?$data['show_everywhere']:''),  null, 'Whether to Show popup Everywhere.');
					echo '</div>';
				echo '</div>';
				echo '<div style="margin: 15px 0; padding: 5px; border: 1px solid #ddd; border-radius: 5px; position: relative;">';
					echo '<label style="font-weight: bold; position: absolute; left: 15px; top: -10px; background: #F1F1F1; padding: 0px 10px;">When to Display</label>';
					echo '<div style="background: #DDDDDD; margin: 10px; padding: 10px; position: relative;">';
						echo wp_facebook_popup_settings_get_control('checkbox',  false,  'Show to Logged In Users',  'wp_facebook_popup_settings_show_loggedin_users',  'wp_facebook_popup_settings[show_loggedin_users]',  (isset($data['show_loggedin_users'])?$data['show_loggedin_users']:''),  null, 'Whether to Show popup to Logged In Users.');	
						echo wp_facebook_popup_settings_get_control('checkbox',  false,  'Show to Logged Out Users',  'wp_facebook_popup_settings_show_loggedout_users',  'wp_facebook_popup_settings[show_loggedout_users]',  (isset($data['show_loggedout_users'])?$data['show_loggedout_users']:''),  null, 'Whether to Show popup to Logged Out Users.');
					echo '</div>';
				echo '</div>';
				echo '<div style="margin: 15px 0; padding: 5px; border: 1px solid #ddd; border-radius: 5px; position: relative;">';
					echo '<label style="font-weight: bold; position: absolute; left: 15px; top: -10px; background: #F1F1F1; padding: 0px 10px;">How to Display</label>';
					echo '<div style="background: #DDDDDD; margin: 10px; padding: 10px; position: relative;">';
						echo wp_facebook_popup_settings_get_control('checkbox',  false,  'Appear always?',  'wp_facebook_popup_settings_appear_always',  'wp_facebook_popup_settings[appear_always]',  (isset($data['appear_always'])?$data['appear_always']:''),  null, 'Do you want the popup to always appear or only occasionally.');				
						echo wp_facebook_popup_settings_get_control('text',  false,  'Days Until Popup Shows Again?',  'wp_facebook_popup_settings_days_until_popup_shows_again',  'wp_facebook_popup_settings[days_until_popup_shows_again]',  (isset($data['days_until_popup_shows_again'])?$data['days_until_popup_shows_again']:'1'),  null, 'When a User Closes the Popup He Won\'t See It Again Until All These Days Pass. (This setting is inactive when "Appear Always" is enabled.)');				
						echo wp_facebook_popup_settings_get_control('text',  false,  'Seconds for Popup To Appear?',  'wp_facebook_popup_settings_seconds_popup_appear',  'wp_facebook_popup_settings[seconds_popup_appear]',  (isset($data['seconds_popup_appear'])?$data['seconds_popup_appear']:'2'),  null, 'After The Page Is Loaded, Popup Will Be Shown After X Seconds.');												
						echo wp_facebook_popup_settings_get_control('checkbox',  false,  'Lock The Scroll While The Popup is Displayed',  'wp_facebook_popup_settings_lock_scroll',  'wp_facebook_popup_settings[lock_scroll]',  (isset($data['lock_scroll'])?$data['lock_scroll']:''),  null, 'When The Person Close The Popup The Scroll Appear, Is A Way To Attract More Attention.');	
						echo wp_facebook_popup_settings_get_control('checkbox',  false,  'Show tiny link to Author',  'wp_facebook_popup_settings_show_author_link',  'wp_facebook_popup_settings[show_author_link]',  (isset($data['show_author_link'])?$data['show_author_link']:''),  null, 'Show a link to the Authers website at the bottom.');	
					echo '</div>';
				echo '</div>';
				echo '<p class="submit" style="text-align: center"><input type="submit" style="font-weight: bold; height: auto; font-size: 20px; padding: 10px 0px; width: 220px;" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>';
		echo '</form>';	
	echo '</div>';
}
?>