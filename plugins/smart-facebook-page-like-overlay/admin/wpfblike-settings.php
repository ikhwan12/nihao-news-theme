<?php

// if this file is called directly, abort
if ( ! defined( 'ABSPATH' ) ) exit;

define('WPFBLIKE_FBPAGE_DEFAULT_VALUE','wordpress');
define('WPFBLIKE_TITLE_DEFAULT_VALUE',__('Click “Like” to read us on Facebook',WPFBLIKEFREE_PLUGIN_NAME));
define('WPFBLIKE_DONTSHOW_DEFAULT_VALUE',__('Thanks, don\'t show this thing again please!',WPFBLIKEFREE_PLUGIN_NAME));
define('WPFBLIKE_AFTERLIKE_DEFAULT_VALUE',__('You are awesome!',WPFBLIKEFREE_PLUGIN_NAME));

define('WPFBLIKE_PRO_LINK','<a class="wpfb-pro-link" target="_blank" href="http://www.aquacrista.com/wp-smart-facebook-page-like-overlay-for-wordpress/">PRO</a>');

add_action( 'admin_menu', 'wpfblikefree_admin_add_page' );
function wpfblikefree_admin_add_page() {
	add_options_page( 
		'WP Smart Facebook Page Like Overlay', 		// Title of Page
		'WP Smart FB Overlay Free', 				// Title to show on Menu in Dashboard
		'manage_options', 							// Capabilities Required (manage_options = Administrator)
		'wpfblikefree', 							// Slug for Options Page
		'wpfblikefree_options_page' 					// Callback function to display the page
	);
}

// Render the Settings Page
function wpfblikefree_options_page() {
?>
	<div class="wrap">
		<h2>WP Smart Facebook Page Like Overlay</h2>

		<p class="settings-page-desc">
		<?php echo __('Overlay configuration',WPFBLIKEFREE_PLUGIN_NAME); ?>.</p>
		<form action="options.php" method="post">
			<?php settings_fields( 'wpfblikefree' ); ?>
			<?php do_settings_sections( 'wpfblikefree' ); ?>
			<?php submit_button(); ?>
		</form>
	</div>

<?php
}

add_action( 'admin_init', 'wpfblikefree_admin_init' );
function wpfblikefree_admin_init(){
	// Create Settings
	register_setting( 
		'wpfblikefree', 
		'wpfblikefree' 
	);

	// !!! SECTION !!! Create Facebook Page Info Section
	add_settings_section( 
		'wpfblikefree_fb_page_info_settings_section', 				// ID of the Facebook Page Info Settings Section
		__('Facebook page settings',WPFBLIKEFREE_PLUGIN_NAME), //'Facebook Page Info', 	// Title of the Facebook Page Info Settings Sections
		'wpfblikefree_fb_page_info_settings_section_display', 		// Callback function to display the Section Description Text
		'wpfblikefree'												// Page on which to display the Facebook Page Info Settings Section
	);
	
	// Add Facebook URL field to Facebook Page Info Section
	add_settings_field( 
		'wpfblikefree_fbpage',									// ID for the Facebook Page URL Field
		__('Facebook page/group url',WPFBLIKEFREE_PLUGIN_NAME), //'Facebook Page URL', 	// Title for the Facebook Page URL Field
		'wpfblikefree_fbpage_display', 							// Callback function to display the Facebook URL Field
		'wpfblikefree', 										// Page on which to display the Facebook Page URL Field
		'wpfblikefree_fb_page_info_settings_section' 			// Section in which to display the Facebook Page URL Field
	);


	// !!! SECTION !!! Create Popup Settings Section
	add_settings_section( 
		'wpfblikefree_popup_settings_section', 					
		__('Overlay display settings',WPFBLIKEFREE_PLUGIN_NAME), //'Popup Settings', 									
		'wpfblikefree_popup_settings_section_display', 			
		'wpfblikefree'											
	);

	// Ввод заголовка оверлея
	add_settings_field( 
		'wpfblikefree_title',							
		__('Overlay title',WPFBLIKEFREE_PLUGIN_NAME),	
		'wpfblikefree_title_display',	 				
		'wpfblikefree', 								
		'wpfblikefree_popup_settings_section'			
	);

	// Ввод сообщения внизу оверлея "не показывать мне это больше"
	add_settings_field( 
		'wpfblikefree_dontshow',							
		__('Don\'t show again message',WPFBLIKEFREE_PLUGIN_NAME),
		'wpfblikefree_dontshow_display', 					
		'wpfblikefree', 									
		'wpfblikefree_popup_settings_section'				
	);

	// Сообщение после лайка 
	add_settings_field(
		'wpfblikefree_afterlike',
		__('Post-like message',WPFBLIKEFREE_PLUGIN_NAME),
		'wpfblikefree_afterlike_display',
		'wpfblikefree', 									
		'wpfblikefree_popup_settings_section'				
	);
	
	// Положение оверлея: top-left, top-right, bottom-left, bottom-right, center
	add_settings_field( 
		'wpfblikefree_position', 						
		__('Display location',WPFBLIKEFREE_PLUGIN_NAME), 
		'wpfblikefree_position_display', 				
		'wpfblikefree', 								
		'wpfblikefree_popup_settings_section'			
	);

	// !!! SECTION !!! Параметры показа оверлея
	add_settings_section( 
		'wpfblikefree_overlay_show_settings_section', 
		__('Display settings',WPFBLIKEFREE_PLUGIN_NAME), 
		'wpfblikefree_overlay_show_settings_section_display', 			
		'wpfblikefree'
	);

	// Как показывать оверлей: при прокрутке до низа страницы или по времени
	add_settings_field( 
		'wpfblikefree_showtype', 						
		__('When to show',WPFBLIKEFREE_PLUGIN_NAME), 	
		'wpfblikefree_showtype_display', 				
		'wpfblikefree', 								
		'wpfblikefree_overlay_show_settings_section'			
	);

	// Время до первого показа, если показывается по времени
	add_settings_field( 
		'wpfblikefree_show1sttime', 					
		__('Time interval before the first appearance',WPFBLIKEFREE_PLUGIN_NAME), 
		'wpfblikefree_show1sttime_display', 			
		'wpfblikefree', 								
		'wpfblikefree_overlay_show_settings_section'			
	);

	// Время до следующего показа, если предыдущее окно закрыто крестиком
	add_settings_field( 
		'wpfblikefree_show2ndtime', 					
		__('Time interval before further appearances (after “close overlay” was selected)',WPFBLIKEFREE_PLUGIN_NAME),
		'wpfblikefree_show2ndtime_display', 			
		'wpfblikefree', 								
		'wpfblikefree_overlay_show_settings_section'			
	);	

	// На каких страницах показывать: home, blog, archive, pages, others
	add_settings_field( 
		'wpfblikefree_show_on', 						
		__('Pages to show on',WPFBLIKEFREE_PLUGIN_NAME), 					
		'wpfblikefree_show_on_display', 				
		'wpfblikefree', 								
		'wpfblikefree_overlay_show_settings_section'			
	);

	// Show to logged in / not logged in users
	add_settings_field( 
		'wpfblikefree_show_to',
		__('Show to',WPFBLIKEFREE_PLUGIN_NAME), 					
		'wpfblikefree_show_to_display', 				
		'wpfblikefree', 								
		'wpfblikefree_overlay_show_settings_section'			
	);

	// Exclude mobile users
	add_settings_field( 
		'wpfblikefree_exclude_mobile',
		__('Exclude mobile users',WPFBLIKEFREE_PLUGIN_NAME),
		'wpfblikefree_exclude_mobile_display', 				
		'wpfblikefree', 								
		'wpfblikefree_overlay_show_settings_section'			
	);

	
}

// Description of Facebook Page Info Settings Section
function wpfblikefree_fb_page_info_settings_section_display() {
}

// Description of Popup Settings Section
function wpfblikefree_popup_settings_section_display() {
}

function wpfblikefree_overlay_show_settings_section_display() {
}

function wpfblikefree_fbpage_display() {
	$options  	= (array)get_option('wpfblikefree');
	if (isset($options['wpfblikefree_fbpage']))
		$url = $options['wpfblikefree_fbpage']; // Facebook Page URL Option	
	else 
		$url = 'wordpress';

	echo '
		https://www.facebook.com/<input name="wpfblikefree[wpfblikefree_fbpage]" id="wpfblikefree_fbpage" value="'; 
		if (isset($url)) { 
			echo sanitize_text_field($url);

		}
	echo '" />';
}

function wpfblikefree_title_display() {
	$options  	= (array)get_option('wpfblikefree');
	if (isset($options['wpfblikefree_title']))
		$title = $options['wpfblikefree_title']; 
	else
		$title = WPFBLIKE_TITLE_DEFAULT_VALUE;

	echo '		
		<textarea name="wpfblikefree[wpfblikefree_title]" id="wpfblikefree_title" 
			style="width: 360px;" >'; 
		if (isset($title)) { 
			echo sanitize_text_field($title);

		}
	echo '</textarea>';	
}

function wpfblikefree_afterlike_display() {
	$options  	= (array)get_option('wpfblikefree');
	if ($options['wpfblikefree_afterlike'])
		$afterlike = $options['wpfblikefree_afterlike']; 
	else
		$afterlike = WPFBLIKE_AFTERLIKE_DEFAULT_VALUE;

	echo '		
		<textarea name="wpfblikefree[wpfblikefree_afterlike]" id="wpfblikefree_afterlike" 
			style="width: 360px;" >'; 
		if (isset($afterlike)) { 
			echo sanitize_text_field($afterlike);

		}
	echo '</textarea>';	
}

function wpfblikefree_dontshow_display() {
	$options  	= (array)get_option('wpfblikefree');
	if (isset($options['wpfblikefree_dontshow']))
		$dontshow = $options['wpfblikefree_dontshow']; 
	else
		$dontshow = WPFBLIKE_DONTSHOW_DEFAULT_VALUE;

	echo '		
		<textarea name="wpfblikefree[wpfblikefree_dontshow]" id="wpfblikefree_dontshow" 
			style="width: 360px;" >'; 
		if (isset($dontshow)) { 
			echo sanitize_text_field($dontshow);

		}
	echo '</textarea>';	
}

function wpfblikefree_position_display() {
	$options  	= (array)get_option('wpfblikefree');
	$position 	= $options['wpfblikefree_position']; 

	echo '
		<input type="radio" name="wpfblikefree[wpfblikefree_position]" id="wpfblikefree_position_topleft" value="top-left"
			disabled > '.__('Top left corner',WPFBLIKEFREE_PLUGIN_NAME).'  <br/>

		<input type="radio" name="wpfblikefree[wpfblikefree_position]" id="wpfblikefree_position_topright" value="top-right"
			disabled > '.__('Top right corner',WPFBLIKEFREE_PLUGIN_NAME).' <br/>

		<input type="radio" name="wpfblikefree[wpfblikefree_position]" id="wpfblikefree_position_bottomleft" value="bottom-left"
			disabled> '.__('Bottom left corner',WPFBLIKEFREE_PLUGIN_NAME).' <br/>
		
		<input type="radio" name="wpfblikefree[wpfblikefree_position]" id="wpfblikefree_position_bottomright" value="bottom-right"
			disabled> '.__('Bottom right corner',WPFBLIKEFREE_PLUGIN_NAME).'  <br/>

		<input type="radio" name="wpfblikefree[wpfblikefree_position]" id="wpfblikefree_position_center" value="center"
			checked disabled> '.__('Center',WPFBLIKEFREE_PLUGIN_NAME).' <br/>
		'.WPFBLIKE_PRO_LINK.'
	';

}

function wpfblikefree_showtype_display() {
	$options  	= (array)get_option('wpfblikefree');
	$showtype 	= $options['wpfblikefree_showtype'];

	echo '
		<input type="radio" name="wpfblikefree[wpfblikefree_showtype]" id="wpfblikefree_showtype_notshow" value="notshow"
		disabled> '.__('Do not show',WPFBLIKEFREE_PLUGIN_NAME).' <br/>

		<input type="radio" name="wpfblikefree[wpfblikefree_showtype]" id="wpfblikefree_showtype_time" value="time"
		disabled checked> '.__('Based on specified time interval',WPFBLIKEFREE_PLUGIN_NAME).'  <br/>

		<input type="radio" name="wpfblikefree[wpfblikefree_showtype]" id="wpfblikefree_showtype_scroll" value="scroll"
		disabled> '.__('Based on page scroll ( bottom of the page )',WPFBLIKEFREE_PLUGIN_NAME),' <br/>
		'.WPFBLIKE_PRO_LINK.'
	';

}

function wpfblikefree_show1sttime_display() {
	$options  	= (array)get_option('wpfblikefree');
	$time 		= $options['wpfblikefree_show1sttime'];

	echo '
		<input type="number" 	name="wpfblikefree[wpfblikefree_show1sttime]" 
								id="wpfblikefree_show1sttime" 
			value="15" style="width:80px;" disabled> '.__('seconds',WPFBLIKEFREE_PLUGIN_NAME).'
		&nbsp;'.WPFBLIKE_PRO_LINK.'
	';
}

function wpfblikefree_show2ndtime_display() {
	$options  	= (array)get_option('wpfblikefree');
	$time 		= $options['wpfblikefree_show2ndtime'];

	echo '
		<input type="number" 	name="wpfblikefree[wpfblikefree_show2ndtime]" 
								id="wpfblikefree_show2ndtime" 
			value="60" style="width:80px;" disabled> '.__('minutes',WPFBLIKEFREE_PLUGIN_NAME).'
		&nbsp;'.WPFBLIKE_PRO_LINK.'
	';
}

function wpfblikefree_show_on_display() {
	$options  	= (array)get_option('wpfblikefree');
	$showon 	= $options['wpfblikefree_show_on'];

	// На каких страницах показывать: home, blog, archive, pages, others
	echo '
		<input name="wpfblikefree[wpfblikefree_show_on][]" id="wpfblikefree_show_on_home" type="checkbox" 
			value="home" checked disabled> '.__('Homepage',WPFBLIKEFREE_PLUGIN_NAME).'<br/>
		<input name="wpfblikefree[wpfblikefree_show_on][]" id="wpfblikefree_show_on_blog" type="checkbox" 
			value="blog" checked disabled> '.__('Blog',WPFBLIKEFREE_PLUGIN_NAME).'<br/>
		<input name="wpfblikefree[wpfblikefree_show_on][]" id="wpfblikefree_show_on_archive" type="checkbox"
			value="archive" checked disabled> '.__('Archive',WPFBLIKEFREE_PLUGIN_NAME).'<br/>
		<input name="wpfblikefree[wpfblikefree_show_on][]" id="wpfblikefree_show_on_pages" type="checkbox"
			value="pages" checked disabled> '.__('Pages',WPFBLIKEFREE_PLUGIN_NAME).'<br/>
		<input name="wpfblikefree[wpfblikefree_show_on][]" id="wpfblikefree_show_on_others" type="checkbox"
			value="others" checked disabled> '.__('Other',WPFBLIKEFREE_PLUGIN_NAME).'<br/>
		'.WPFBLIKE_PRO_LINK.'
	';

}

function wpfblikefree_show_to_display() {
	$options  	= (array)get_option('wpfblikefree');
	$showto 	= $options['wpfblikefree_show_to'];

	// Кому показывать: logged in, not-logged in
	echo '
		<input name="wpfblikefree[wpfblikefree_show_to][]" id="wpfblikefree_show_to_logged" type="checkbox" 
			value="logged" checked disabled> '.__('logged in users',WPFBLIKEFREE_PLUGIN_NAME).'<br/>
		<input name="wpfblikefree[wpfblikefree_show_to][]" id="wpfblikefree_show_to_notlogged" type="checkbox" 
			value="notlogged" checked disabled> '.__('not-logged in users',WPFBLIKEFREE_PLUGIN_NAME).'<br/>
		'.WPFBLIKE_PRO_LINK.'
	';

}


function wpfblikefree_exclude_mobile_display() {
	$options  	= (array)get_option('wpfblikefree');
	$exclude 	= $options['wpfblikefree_exclude_mobile'];

	echo '
		<input name="wpfblikefree[wpfblikefree_exclude_mobile]" id="wpfblikefree_not_exclude_mobile" type="hidden" 
			value="0">
		<input name="wpfblikefree[wpfblikefree_exclude_mobile]" id="wpfblikefree_exclude_mobile" type="checkbox" 
			value="1" disabled>	
		'.WPFBLIKE_PRO_LINK.'
		<br/>
	';

}
