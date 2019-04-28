<?php
/*
Plugin Name: WP Job Portal by Jane
Description: The easiest way to manage your organization's open positions and all your resumes. WP Job Portal displays your jobs on your careers page and then funnels applicants and their resumes into your very own applicant tracking system.
Author: Janehires.com
Version: 2.2
*/

$janehires_base_url = 'https://go.janehires.com/';
$janehires_api_url = $janehires_base_url . 'WPPluginAPI/';
$jobops = false;

add_action('admin_menu', 'jhwpjp_plugin_setup_menu');
add_shortcode('wp-job-portal', 'jhwpjp_plugin_shortcode');
add_shortcode('wp-job-portal-job', 'jhwpjp_plugin_shortcode_job');
add_action('admin_init', 'jhwpjp_plugin_admin_init');
add_action( 'widgets_init', 'jhwpjp_plugin_register_widgets' ); 

// CSS
add_action( 'wp_enqueue_scripts', 'jhwpjp_widget_shortcode_css' );
add_action( 'admin_enqueue_scripts', 'jhwpjp_plugin_css' );


function jhwpjp_plugin_setup_menu(){
        // add_menu_page( 'WP Job Portal by Jane', 'WP Job Portal by Jane', 'manage_options', 'janehires-plugin', 'jhwpjp_init' );
		add_options_page('WP Job Portal by Jane Settings', 'WP Job Portal by Jane', 'manage_options', 'janehires-plugin', 'jhwpjp_plugin_options_page');			
}

function jhwpjp_plugin_register_widgets() {
	register_widget( 'JaneHiresWidget' );
}
 
function jhwpjp_init(){

}
  
function jhwpjp_widget_shortcode_css()
{
	wp_enqueue_script('jquery');	
	wp_enqueue_style( 'jhwpjp_shortcode_and_widget_css', plugins_url( '/css/shortcode-widget.css', __FILE__), nil, filemtime( dirname(__FILE__) . '/css/shortcode-widget.css' ) );
	wp_enqueue_script( 'jhwpjp_shortcode_and_widget_js', plugins_url( '/js/shortcode-widget.js', __FILE__), nil, filemtime( dirname(__FILE__) . '/js/shortcode-widget.js' ) );
}

function jhwpjp_plugin_css($hook) {
	if($hook != 'settings_page_janehires-plugin') {
		return;
	}
	wp_enqueue_script('jquery');
	wp_enqueue_style( 'jhwpjp_plugin_admin_css', plugins_url( '/css/plugin.css', __FILE__), nil, filemtime( dirname(__FILE__) . '/css/plugin.css' ) );
	wp_enqueue_script( 'jhwpjp_plugin_admin_js', plugins_url( '/js/plugin.js', __FILE__), nil, filemtime( dirname(__FILE__) . '/js/plugin.js' ) );	
}	


 function jhwpjp_GetAPIKey() {
	 $plugin_options = get_option('jhwpjp_plugin_options');
	 return $plugin_options['plugin_api_key'];
 }
 
 
 
function jhwpjp_plugin_admin_init(){
	global $jobops;
	
	if( jhwpjp_get_plugin_setting( 'run_setup' ) ) {
		wp_redirect( admin_url( 'options-general.php?page=janehires-plugin' ) );
		jhwpjp_set_plugin_setting( 'run_setup', false );
		exit();
	}	
	
	// table
	include( plugin_dir_path( __FILE__ ) . 'jhwpjp_plugin_List_Table.php');
	
	// job form
	include( plugin_dir_path( __FILE__ ) . 'jhwpjp_plugin_JobForm.php');	
	
	$current_step = jhwpjp_get_plugin_setting('current_step');
	
	// settings
	register_setting( 'jhwpjp_plugin_options', 'jhwpjp_plugin_options', 'jhwpjp_plugin_options_validate' );
	add_settings_section('plugin_main', 'Already have a Jane account?', 'jhwpjp_plugin_section_text', 'plugin');
	add_settings_field('plugin_api_key', 'Janehires API Key', 'jhwpjp_plugin_setting_string', 'plugin', 'plugin_main'); 

	// setup options
	add_settings_section('plugin_setup_step1', '', 'jhwpjp_plugin_setup_step1_header', 'plugin_setup_step1_page');
	add_settings_field('firstname', 'First Name', 'jhwpjp_plugin_setup_step1_fields', 'plugin_setup_step1_page', 'plugin_setup_step1', array('firstname', 'label_for' => 'firstname')); 
	add_settings_field('lastname', 'Last Name', 'jhwpjp_plugin_setup_step1_fields', 'plugin_setup_step1_page', 'plugin_setup_step1', array('lastname', 'label_for' => 'lastname')); 
	add_settings_field('email', 'Your email', 'jhwpjp_plugin_setup_step1_fields', 'plugin_setup_step1_page', 'plugin_setup_step1', array('email', 'label_for' => 'email')); 
	add_settings_field('company_name', 'Company Name', 'jhwpjp_plugin_setup_step1_fields', 'plugin_setup_step1_page', 'plugin_setup_step1', array('company_name', 'label_for' => 'company_name')); 
	add_settings_field('default_location_city', 'Default Job Location', 'jhwpjp_plugin_setup_step1_fields_location', 'plugin_setup_step1_page', 'plugin_setup_step1', array('default_location_city', 'label_for' => 'default_location_city')); 
	add_settings_field('default_location_state', '', 'jhwpjp_plugin_setup_step1_fields_location', 'plugin_setup_step1_page', 'plugin_setup_step1', array('default_location_state'));
	add_settings_field('default_location_zip', '', 'jhwpjp_plugin_setup_step1_fields_location', 'plugin_setup_step1_page', 'plugin_setup_step1', array('default_location_zip'));
	
	
	add_settings_section('plugin_setup_step2', '', 'jhwpjp_plugin_setup_step2_header', 'plugin_setup_step2_page');
	add_settings_field('create_careers_page', '', 'jhwpjp_plugin_setup_step2_fields', 'plugin_setup_step2_page', 'plugin_setup_step2', array('create_careers_page'));
	add_settings_field('create_careers_page_title', '', 'jhwpjp_plugin_setup_step2_fields', 'plugin_setup_step2_page', 'plugin_setup_step2', array('create_careers_page_title'));
	add_settings_field('create_sample_jobs', '', 'jhwpjp_plugin_setup_step2_fields', 'plugin_setup_step2_page', 'plugin_setup_step2', array('create_sample_jobs'));
		
	
	if($_GET){
		if( "true" == $_GET['reset_plugin_api_key'] ){
			update_option('jhwpjp_plugin_options', null);
			jhwpjp_set_plugin_setting( 'plugin_api_key', '' );
			jhwpjp_set_plugin_setting( 'current_step', 1 );
			jhwpjp_reload_plugin_page();
		}
	
		if( !empty( $_GET['step'] ) ) {
			$step = intval( $_GET['step'] );
			jhwpjp_set_plugin_setting( 'current_step', $step );
			$current_step = $step;
		}
		
		if( !empty( $_GET['invite'] ) && !empty( $_GET['inviteType'] )) {
			$invite = sanitize_email( $_GET['invite'] );
			$inviteType = intval( $_GET['inviteType'] );
			jhwpjp_invite( $invite, $inviteType );
		}				
		
		if( ( $_GET['action'] == 'addJob' ) || ( $_GET['action'] == 'editJob' ) ) {
			$jobops = true;
		}		
	}

	if($_POST){	
		if( ( $_POST['action'] == 'addJob' ) || ( $_POST['action'] == 'editJob' ) ) {
			jhwpjp_JobForm_Save();
		}
	}
	
	if( empty($current_step) ) {
		jhwpjp_set_plugin_setting( 'current_step', 1 );
	}
}

function jhwpjp_plugin_options_page(){
	global $jobops;
	$api_key = jhwpjp_GetAPIKey();
	
	if( $jobops ) {
		jhwpjp_JobForm();
		return;
	}
	
	// route according to setup step
	$current_step = jhwpjp_get_plugin_setting('current_step');
	
	switch($current_step) {
		case 1:
			jhwpjp_show_step1();
			return;
		case 2:
			jhwpjp_show_step2();
			return;			
		case 3:
			jhwpjp_show_step3();
			return;
		case 4:
			jhwpjp_show_step4();
			return;				
		case 5:
			jhwpjp_show_currentJaneUserSetup();
			return;	
		case 910:
			jhwpjp_show_inviteUser("admin");
			return;					
		case 920:
			jhwpjp_show_inviteUser("manager");
			return;			
	}		
		
}


function jhwpjp_plugin_setup_step1_header() {}  
function jhwpjp_plugin_setup_step2_header() {} 

function jhwpjp_plugin_setup_step1_fields($args) {
	$options = get_option('jhwpjp_plugin_options');
	echo "<input id='" . $args[0] . "' name='jhwpjp_plugin_options[" . $args[0] . "]' size='40' type='text' value='" . esc_attr( $options[$args[0]] ) . "' required />";
} 

function jhwpjp_plugin_setup_step1_fields_location($args) {
	$options = get_option('jhwpjp_plugin_options');
	
	if( $options['default_location_zip'] == 0 ) { $options['default_location_zip'] = ''; }

	if( $args[0] == 'default_location_city' ) {
		echo "<input placeholder='City' id='" . $args[0] . "' name='jhwpjp_plugin_options[" . $args[0] . "]' size='40' type='text' value='" . esc_attr( $options[$args[0]] ) . "' required />";	
		echo "<select id='default_location_state' name='jhwpjp_plugin_options[default_location_state]'><option value='' disabled selected>State</option><option value='AL'>Alabama</option><option value='AK'>Alaska</option><option value='AZ'>Arizona</option><option value='AR'>Arkansas</option><option value='CA'>California</option><option value='CO'>Colorado</option><option value='CT'>Connecticut</option><option value='DE'>Delaware</option><option value='DC'>District Of Columbia</option><option value='FL'>Florida</option><option value='GA'>Georgia</option><option value='HI'>Hawaii</option><option value='ID'>Idaho</option><option value='IL'>Illinois</option><option value='IN'>Indiana</option><option value='IA'>Iowa</option><option value='KS'>Kansas</option><option value='KY'>Kentucky</option><option value='LA'>Louisiana</option><option value='ME'>Maine</option><option value='MD'>Maryland</option><option value='MA'>Massachusetts</option><option value='MI'>Michigan</option><option value='MN'>Minnesota</option><option value='MS'>Mississippi</option><option value='MO'>Missouri</option><option value='MT'>Montana</option><option value='NE'>Nebraska</option><option value='NV'>Nevada</option><option value='NH'>New Hampshire</option><option value='NJ'>New Jersey</option><option value='NM'>New Mexico</option><option value='NY'>New York</option><option value='NC'>North Carolina</option><option value='ND'>North Dakota</option><option value='OH'>Ohio</option><option value='OK'>Oklahoma</option><option value='OR'>Oregon</option><option value='PA'>Pennsylvania</option><option value='RI'>Rhode Island</option><option value='SC'>South Carolina</option><option value='SD'>South Dakota</option><option value='TN'>Tennessee</option><option value='TX'>Texas</option><option value='UT'>Utah</option><option value='VT'>Vermont</option><option value='VA'>Virginia</option><option value='WA'>Washington</option><option value='WV'>West Virginia</option><option value='WI'>Wisconsin</option><option value='WY'>Wyoming</option></select>";
		echo "<input placeholder='Zip' id='default_location_zip' name='jhwpjp_plugin_options[default_location_zip]' size='5' type='number' value='" . esc_attr( $options['default_location_zip'] ) . "' required />";	
	}
}

function jhwpjp_plugin_setup_step2_fields($args) {
	$options = get_option('jhwpjp_plugin_options');

	if( $args[0] == 'create_careers_page' ) {
		echo "<input type='hidden' id='create_careers_page' name ='jhwpjp_plugin_options[create_careers_page]' value='0' />";
		echo "<input type='hidden' id='create_sample_jobs' name ='jhwpjp_plugin_options[create_sample_jobs]' value='0' />";
		
		echo "<div class='move-form-left'>";
		echo "<input type='checkbox' id='create_careers_page' name ='jhwpjp_plugin_options[create_careers_page]' value='1' checked='checked' /> <label for='create_careers_page'>Create careers page titled </label> ";
		echo "<input id='create_careers_page_title' name='jhwpjp_plugin_options[create_careers_page_title]' size='40' type='text' value='Careers' /><br/>";				
		echo "<input type='checkbox' id='create_sample_jobs' name ='jhwpjp_plugin_options[create_sample_jobs]' value='1' checked='checked' /> <label for='create_sample_jobs'>Create sample jobs to quickly get me started</label>";
		echo "</div>";
	}
}	
 
 
function jhwpjp_show_step1() {
	$asterisk_image = plugins_url('/assets/icon-128x128.png', __FILE__);
	$user_email = jhwpjp_GetUserEmail();
	if( !empty($user_email) ) { jhwpjp_set_plugin_setting( 'email', $user_email );	}

?>
<div>
	<div>
	<h2><img class="logo" src="<?php echo esc_url( $asterisk_image ); ?>" /> WP Job Portal by Jane Setup</h2>
	
		<table cellpadding=0 cellspacing=2 border=0 id='jh-plugin-setup-table'>	
			<thead>
				<th class="selected">1. Setup Company Info</th>
				<th class="future">2. Careers Page & Sample Jobs</th>
				<th class="future">3. Done!</th>
			</thead>
			<tbody>
				<tr>
					<td colspan=3>

						Thank you for installing WP Job Portal!

						This setup wizard will help you get started quickly by:
						<ul>
							<li>Setting up your default company and job info</li>
							<li>Creating a careers page for your company if you do not have one</li>
							<li>Generating sample jobs so you can see what your jobs listing will look like on your site</li>
						</ul>
					
					</td>
				<tr>
					<td colspan=3>
					
						<form id="setup_step1" action="options.php" method="post">
						
							<?php settings_fields('jhwpjp_plugin_options'); ?>
							<?php do_settings_sections('plugin_setup_step1_page'); ?>					
							<input name="jhwpjp_plugin_options[current_step]" type="hidden" value="2" />
							<br/>
							<a href="javascript:alreadyHaveAnAccount();" class="button" style="background-color: rgba(0, 255, 134, 0.36)!important;">I already have a Janehires account!</a>
							<input name="Submit" type="submit" class="button button-primary" value="<?php esc_attr_e('Save and Continue'); ?>" />						
						
						</form>
					
						<form id="setup_step1b" action="options.php" method="post" style="display:none;">
							<?php settings_fields('jhwpjp_plugin_options'); ?>
							<input name="jhwpjp_plugin_options[current_step]" type="hidden" value="4" />
						</form>
					</td>
				</tr>
				</tr>			
			</tbody>
		</table>
		
	</div>	
</div>	
<script type="text/javascript">
   function alreadyHaveAnAccount() { document.getElementById('setup_step1b').submit(); }
</script>

<?php
}

function jhwpjp_show_step2() {
	$asterisk_image = plugins_url('/assets/icon-128x128.png', __FILE__);
?>
<div>
	<div>
	<h2><img class="logo" src="<?php echo esc_url( $asterisk_image ); ?>" /> WP Job Portal by Jane Setup</h2>
	
		<table cellpadding=0 cellspacing=2 border=0 id='jh-plugin-setup-table'>	
			<thead>
				<th class="future">1. Setup Company Info</th>
				<th class="selected">2. Careers Page & Sample Jobs</th>
				<th class="future">3. Done!</th>
			</thead>
			<tbody>
				<tr>
					<td colspan=3>
					
						<h3>Create a careers page for your company if you do not already have one:</h3>
					
						<form id="setup_step2" action="options.php" method="post">
						
							<?php settings_fields('jhwpjp_plugin_options'); ?>
							<?php do_settings_sections('plugin_setup_step2_page'); ?>					
							<br/>
							<input name="jhwpjp_plugin_options[current_step]" type="hidden" value="3" />
							<input name="Submit" type="submit" class="button button-primary" value="<?php esc_attr_e('Save and Continue'); ?>" />						
						
						</form>
					
					</td>
				</tr>
			</tbody>
		</table>
		
	</div>	
</div>	


<?php
}




function jhwpjp_show_step3() {
	global $janehires_api_url;
	global $janehires_base_url;	
	
	$asterisk_image = plugins_url('/assets/icon-128x128.png', __FILE__);	
	$existingAPIKey = jhwpjp_GetAPIKey();
	$problem = false;

	$create_careers_page = ( jhwpjp_get_plugin_setting('create_careers_page') == 1 );
	$create_careers_page_title = jhwpjp_get_plugin_setting('create_careers_page_title');			
	
	if( empty( $existingAPIKey ) ) {
	
		// get all the settings data and hit the jane site
		$email = jhwpjp_get_plugin_setting('email');	
		$firstname = jhwpjp_get_plugin_setting('firstname');	
		$lastname = jhwpjp_get_plugin_setting('lastname');	
		$company_name =	jhwpjp_get_plugin_setting('company_name');
		$default_location_city = jhwpjp_get_plugin_setting('default_location_city');
		$default_location_state = jhwpjp_get_plugin_setting('default_location_state');
		$default_location_zip =	jhwpjp_get_plugin_setting('default_location_zip');

		/*
		echo( $janehires_api_url . 'CreateNewAccount_v2?email=' . $email . '&company_name=' . $company_name . '&default_location_city=' . $default_location_city . '&default_location_state=' . $default_location_state . '&default_location_zip=' . $default_location_zip . '&firstname=' . $firstname . '&lastname=' . $lastname );	
		*/
		
		// generate a new account
		$rawJSON = jhwpjp_get_data( $janehires_api_url . 'CreateNewAccount_v2?email=' . urlencode($email) . '&company_name=' . urlencode($company_name) . '&default_location_city=' . urlencode($default_location_city) . '&default_location_state=' . urlencode($default_location_state) . '&default_location_zip=' . urlencode($default_location_zip) . '&firstname=' . urlencode($firstname) . '&lastname=' . urlencode($lastname) );	
		$newAPIKey = json_decode( $rawJSON );
		jhwpjp_set_plugin_setting( 'plugin_api_key', $newAPIKey );
		$problem = empty( $newAPIKey );
	}
	
	jhwpjp_set_plugin_setting( 'current_step', 5 );
	
	if( $create_careers_page ) {
		$careers_page = array(
			'post_type' => 'page',
			'post_title' => $create_careers_page_title,
			'post_content' => '[wp-job-portal]',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'careers'
		);

		$post_id = wp_insert_post($careers_page);		
		jhwpjp_set_plugin_setting('careers_page_post_id', $post_id);
	}		
	
	$api_key = jhwpjp_GetAPIKey();
	jhwpjp_check_defaults();	
?>

<?php if( $problem ) { ?>
<div class="notice notice-error jh-plugin-notice">
	<p><?php _e( "<strong>Problem!</strong> We weren't able to complete setup. Please remove the WP Job Portal by Jane plugin and try again." ); ?></p>
</div>		
<?php } else { ?>	

<div>
	<div>
	
	<h2><img class="logo" src="<?php echo esc_url( $asterisk_image ); ?>" /> WP Job Portal by Jane Setup</h2>
	
		<table cellpadding=0 cellspacing=2 border=0 id='jh-plugin-setup-table'>	
			<thead>
				<th class="future">1. Setup Company Info</th>
				<th class="future">2. Careers Page & Sample Jobs</th>
				<th class="selected">3. Done!</th>
			</thead>
			<tbody>
				<tr>
					<td colspan=3>
					
						<h3>All Done!</h3>
					
						<p>You're all set to begin using the WP Job Portal by Jane plugin.</p>
						<p>
							<a class="button button-primary" href="<?php esc_attr_e( admin_url( "options-general.php?page=".$_GET["page"] ) ); ?>">View and Add Jobs</a>
						</p> 	
						<p>&nbsp;</p>
						<p>Want to learn more about how to get the most out of WP Job Portal?</p>
						<p>Checkout: <a href="http://www.wpjobportal.com/setup" target="_blank">http://www.wpjobportal.com/setup</a></p>				
				
						
						<?php
							/*
							foreach( get_option('jhwpjp_plugin_options') as $key => $val ) {
								echo "<p><b>" . $key . "</b>: " . $val . "</p>";
							}
							*/
						?>
						
					</td>
				</tr>
			</tbody>
		</table>
		
	</div>	
</div>	

<?php } ?>	

<?php
}


function jhwpjp_show_step4() {
	global $janehires_base_url;
	$asterisk_image = plugins_url('/assets/icon-128x128.png', __FILE__);	
?>
<div>
	<div>
	<h2><img class="logo" src="<?php echo esc_url( $asterisk_image ); ?>" /> WP Job Portal by Jane Setup</h2>
	
		<table cellpadding=0 cellspacing=2 border=0 id='jh-plugin-setup-table'>	
			<thead>
				<th class="selected">1. Setup Company Info</th>
				<th class="future">2. Careers Page & Sample Jobs</th>
				<th class="future">3. Done!</th>
			</thead>
			<tbody>
				<tr>
					<td colspan=3>
					
						<form id="setup_step4" action="options.php" method="post">
						
							<?php settings_fields('jhwpjp_plugin_options'); ?>
							<?php do_settings_sections('plugin'); ?>					
							<br/>
							<input name="reset_plugin_api_key" type="hidden" value="false" />
							<input name="jhwpjp_plugin_options[current_step]" type="hidden" value="2" />
							<input name="Submit" type="submit" class="button button-primary" value="<?php esc_attr_e('Save and Continue'); ?>" />						
						
						</form>
					
					</td>
				</tr>
			</tbody>
		</table>
		
	</div>	
</div>	


<?php
}


function jhwpjp_check_defaults() {
		global $janehires_api_url;
		$problem = true;
		$api_key = jhwpjp_GetAPIKey();
		$options = null;

		if( !empty( $api_key ) ) {
			$rawJSON = jhwpjp_get_data( $janehires_api_url . 'GetOptions/' . $api_key );	
			$options = json_decode( $rawJSON );			
			$problem = empty( $rawJSON );
		}
		
		$default_location_city = jhwpjp_get_plugin_setting('default_location_city');
		$default_location_state = jhwpjp_get_plugin_setting('default_location_state');
		
		// check default city
		if( !$problem && empty( $default_location_city ) ) {
			jhwpjp_set_plugin_setting( 'default_location_city', $options->DefaultCity );
		}
		
		// check default state
		if( !$problem && empty( $default_location_state ) ) {
			jhwpjp_set_plugin_setting( 'default_location_state', $options->DefaultState );
		}		
}
 
 
function jhwpjp_show_currentJaneUserSetup(){
		global $janehires_base_url;
		global $janehires_api_url;
		
		$problem = true;
		$asterisk_image = plugins_url('/assets/icon-128x128.png', __FILE__);
		
		$api_key = jhwpjp_GetAPIKey();
		$options = null;
		$jobs = null;
		$careers_page_url = jhwpjp_GetCareersPageUrl();

		$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );		

		if( !empty( $api_key ) ) {
			$rawJSON = jhwpjp_get_data( $janehires_api_url . 'GetOptions/' . $api_key );	
			$options = json_decode( $rawJSON );			
			$problem = empty( $rawJSON );
			
			$rawJSON_jobs = jhwpjp_get_data( $janehires_api_url . 'GetJobListings/' . $api_key );	
			$jobs = json_decode( $rawJSON_jobs, true );						
		}		
		
	?>

	
<?php if( $problem ) { ?>
<div class="notice notice-error jh-plugin-notice">
	<p><?php _e( "<strong>Problem!</strong> There was a problem setting up the WP Job Portal by Jane plugin. Please remove the plugin and try again." ); ?></p>
</div>		
<?php } else { ?>		
		
	<?php if( !empty($options) && ( $options->NeedPasswordSet == true ) ) { ?>
	<div class="notice notice-warning is-dismissible jh-plugin-notice">
		<p><?php _e( "<strong>Don't forget:</strong> we created an account for you on Janehires.com, but you still need to set your password!" ); ?></p>
		<a href="<?php echo $janehires_base_url . 'Jane/Signup/FirstLogin/?apiKey=' . $api_key; ?>" target="_blank">Set your password now</a>
	</div>		
	<?php } ?>	
		
	<div>
	<h2><img style="height:25px;vertical-align:middle;padding-right:3px;" src="<?php echo esc_url( $asterisk_image ); ?>" /> WP Job Portal by Jane</h2>
	<hr>

	<?php if( empty($api_key) ) { ?>

	<form action="options.php" method="post">
	<?php settings_fields('jhwpjp_plugin_options'); ?>
	<?php do_settings_sections('plugin'); ?>
	<input name="reset_plugin_api_key" type="hidden" value="false" />
	<input name="jhwpjp_plugin_options[current_step]" type="hidden" value="4" />
	<input name="Submit" type="submit" class="button button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
	</form>

	<?php } else { ?>
	<br>	
	
	<ul class='tabs'>
	  <li><a href='#tab1'>All Jobs</a></li>
	  <li><a href='#tab2'>Invite Users</a></li>
	  <li><a href='#tab3'>Settings</a></li>
	</ul>
	<div class="tab-content">	
		<div id='tab1'>

			<?php jhwpjp_plugin_jobs_table($jobs); ?>
		
		</div>
		<div id='tab2'>

		  <?php if( !empty($options) && $options->CanInviteHiringManager == true ) { ?>
		  <p>Invite your HR manager or managers who are hiring to add their open positions.</p>
		  <p>
			<a class="button button-primary" href="<?php echo esc_url( $escaped_url ); ?>&step=920">Invite User</a>
		  </p> 
		  <?php } ?>  		
		
		  <p>
		   Through WP Job Portal, you can invite up to 5 users who can add jobs.<br><br>
		   To add more users or manage your users access, go to:<br>
		   <a target="_blank" href="https://go.janehires.com/Corporate/Dashboard/UserManager/">https://go.janehires.com/Corporate/Dashboard/UserManager/</a> 
		  </p>
		  <p>
			Questions? Email <a href="mailto:support@janehires.com">support@janehires.com</a> or call us at (844) HEY JANE
		  </p>		  
		</div>
		<div id='tab3'>

		  <h2> <?php if( !empty($options) ) { esc_html_e( $options->CompanyName ); } ?></h2>	
	
		  Your API Key is:	<br/>
		  <code><?php esc_html_e( $api_key ); ?></code>
		  
		
		 <?php if( empty( $careers_page_url ) ) { ?>
		   <p>
			Add this shortcode to your careers page and your open jobs will automatically be displayed: <input type='text' class='jhwpjp-shortcode' value='[wp-job-portal]' onfocus='this.select()' onmouseup='this.select()' style='width:155px;' />
		   </p>
		 <?php } ?>
		  <p>
			To display your open jobs along the sidebar or footer, go to <b>Appearance &gt; Widgets</b> to drag and drop your WP Job Portal by Jane widget into the appropriate area.  
		  </p>
		  <p>
			For complete access to all your company's Account Settings go to: <br> <a target="_blank" href="https://go.janehires.com/Corporate/Account">https://go.janehires.com/Corporate/Account</a> 
		  </p>			  
		  <p>
			Questions? Email <a href="mailto:support@janehires.com">support@janehires.com</a> or call us at (844) HEY JANE
		  </p>		
		
		</div>	
	</div>		


	<?php } ?>


	</div> 
	
<?php } ?>
	
	<?php
}

function jhwpjp_show_inviteUser( $userType ){

		$userTypeName = "";
		$userTypeCode = 0;

		switch( $userType ) {
			case "admin":
				$userTypeName = "Administrator Account";
				$userTypeCode = 7;
				break;
			case "manager":
				$userTypeName = "Hiring Manager";
				$userTypeCode = 1;
				break;
		}

	?>

<div>

	<p>Enter <?php _e( $userTypeName ); ?> email:</p>
	
	<form method="get">
		<input name="page" type="hidden" value="janehires-plugin" />
		<input name="inviteType" type="hidden" value="<?php esc_attr_e( $userTypeCode ); ?>" />
		<input name="invite" type="text" value="" required />
		<input name="Submit" class="button button-primary" type="submit" value="<?php esc_attr_e('Next >'); ?>" />
		<a class="button button-primary" href="javascript:cancelInvite()">Cancel</a>	
	</form>		

</div>		

<script type="text/javascript">
   function cancelInvite() { window.location = window.location.href.split("?")[0] + "?page=janehires-plugin&step=5"; }
</script>

	<?php
}


function jhwpjp_plugin_section_text() {
	global $janehires_base_url;
	echo '<p>Login to Janehires.com and <a target="_blank" href="' . esc_url( $janehires_base_url . 'Corporate/Account/WordpressAPIKey' ) . '">get your API key from the "My Account" section</a>.</p>';
}

function jhwpjp_plugin_setting_string() {
	$options = get_option('jhwpjp_plugin_options');
	echo "<input id='plugin_api_key' name='jhwpjp_plugin_options[plugin_api_key]' size='40' type='text' value='" . esc_attr( $options['plugin_api_key'] ) . "' required />";
} 

function jhwpjp_plugin_options_validate($input) {
	
	$sanitized_input = array();

	$existingOptions = get_option('jhwpjp_plugin_options');
	foreach ( $existingOptions as $key => $val ) {
		$sanitized_input[$key] = $val;
	}

	foreach ( $input as $key => $val ) {
		switch($key) {
			case "company_name":
			case "default_location_city":
			case "default_location_state":
			case "create_careers_page_title":
			case "plugin_api_key":				
			case "firstname":
			case "lastname":
				$sanitized_input[$key] = sanitize_text_field( $val );
				break;
			case "email":
				$sanitized_input[$key] = sanitize_email( $val );
				break;				
			case "careers_page_post_id":
			case "default_location_zip":
			case "current_step":
				$sanitized_input[$key] = intval( $val );
				break;
			case "create_careers_page":
			case "create_sample_jobs":
				$sanitized_input[$key] = ($val == 1 ? 1 : 0 );
				break;
		}
	}
	
	return $sanitized_input;
} 

function jhwpjp_get_plugin_setting( $setting_key ) {
	$plugin_options = get_option('jhwpjp_plugin_options');
	return $plugin_options[$setting_key];		
}

function jhwpjp_set_plugin_setting( $setting_key, $setting_value ) {
	$plugin_options = get_option('jhwpjp_plugin_options');
	$plugin_options[$setting_key] = $setting_value;		
	update_option('jhwpjp_plugin_options', $plugin_options);	
}

function jhwpjp_reload_plugin_page() {
	echo '<script type="text/javascript">
			   window.location = window.location.href.split("?")[0] + "?page=janehires-plugin";
		  </script>';
}

/*
function jhwpjp_reload_plugin_page_with_email($email) {
	echo '<script type="text/javascript">
			   window.location = window.location.href.split("?")[0] + "?page=janehires-plugin&email=' . sanitize_email( $email ) . '";' .
		  '</script>';
}
*/

function jhwpjp_invite( $invite, $inviteType ) {
	
	global $janehires_api_url;
	$rawJSON = jhwpjp_get_data( $janehires_api_url . 'InviteUser/' . jhwpjp_GetAPIKey() . '?email=' . urlencode( sanitize_email( $invite ) ) . '&userType=' . intval( $inviteType ) );	
	$result = json_decode( $rawJSON );	
	
	if( $result == true  ) {
		jhwpjp_set_plugin_setting( 'current_step', 5 );
		jhwpjp_reload_plugin_page();		
	} else {
		echo "Problem sending invite!";
	}
	
}


/* gets the data from a URL */
function jhwpjp_get_data($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}

function jhwpjp_parseJsonDate($date, $type = 'date') {
    preg_match( '/\/Date\((\d+)\)/', $date, $matches); // Match the time stamp (microtime) and the timezone offset (may be + or -)

    $date = date( 'm/d/Y', $matches[1]/1000 ); // convert to seconds from microseconds

    switch($type)
    {    
        case 'date':
            return $date; // returns '05-04-2012'
            break;

        case 'array':
            return explode('-', $date); // return array('05', '04', '2012')
            break;

        case 'string':
            return $matches[1] . $matches[2]; // returns 1336197600000-0600
            break;
    }    
}  
 
 
class JaneHiresWidget extends WP_Widget {

	function __construct() {
		// Instantiate the parent object
		// parent::__construct( false, 'Janehires.com' );
		$widget_ops = array( 
			'classname' => 'JaneHiresWidget',
			'description' => 'List your jobs from Janehires.com!',
		);
		parent::__construct( 'JaneHiresWidget', 'WP Job Portal by Jane', $widget_ops );	
	}

	function widget( $args, $instance ) {
		// Widget output
		echo '<section class="widget">';
        echo '<h2 class="widget-title">Active Jobs</h2>';
		jhwpjp_plugin_widget_output();
		echo "</section>";
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
	}

	function form( $instance ) {
		// Output admin widget options form
	}
}


 function jhwpjp_plugin_shortcode() { 
	global $janehires_api_url;
	global $janehires_base_url;
	$purplesquiggly_image = plugins_url('/assets/purplesquiggly.png', __FILE__);
	$create_sample_jobs = ( jhwpjp_get_plugin_setting('create_sample_jobs') == 1 );
	
	$default_location_city = jhwpjp_get_plugin_setting('default_location_city');
	$default_location_state = jhwpjp_get_plugin_setting('default_location_state');	
	
	$shortCodeOutput = '';
	$rawJSON = jhwpjp_get_data( $janehires_api_url . 'GetJobListings/' . jhwpjp_GetAPIKey() );
	$jobsJsonObject = json_decode( $rawJSON );
		 

	$shortCodeOutput = $shortCodeOutput . "<div id='jhwpjp_jobs'>";
	$shortCodeOutput = $shortCodeOutput . "<table cellpadding=0 cellspacing=2 border=0 class='jh-plugin-table'>";		 
		 
	foreach($jobsJsonObject as $job) {
		$job_page_url = jhwpjp_GetJobPageUrl( $job->ApplicationPageID, $job->Title, $job->Url, true );
		if( $job->IsPublic || current_user_can('editor') || current_user_can('administrator') )
			$shortCodeOutput = $shortCodeOutput . "<tr" . ( !$job->IsPublic ? " style='background-color:lightgray;'" : "" ) . "><td><a href='" . esc_url( $job_page_url) . "'>" . esc_html( $job->Title ) . "</a></td><td><span>" . esc_html( $job->City ) . ", " . esc_html( $job->State ) . "</span></td><td><span>" . esc_html( jhwpjp_parseJsonDate($job->PostedDate) ) . "</span></td></tr>";
	}	 	 
	
	// inject sample jobs
	if(( count($jobsJsonObject) == 0 ) && $create_sample_jobs ) {
		$shortCodeOutput = $shortCodeOutput . "<tr><td><a href='#'>Sample Job Title One</a></td><td><span>" . esc_html( $default_location_city ) . ", " . esc_html( $default_location_state ) . "</span></td><td><span>" . esc_html( date("m/d/Y") ) . "</span></td></tr>";
		
		$shortCodeOutput = $shortCodeOutput . "<tr><td><a href='#'>Sample Job Title Two</a></td><td><span>" . esc_html( $default_location_city ) . ", " . esc_html( $default_location_state ) . "</span></td><td><span>" . esc_html( date("m/d/Y") ) . "</span></td></tr>";

		$shortCodeOutput = $shortCodeOutput . "<tr><td><a href='#'>Sample Job Title Three</a></td><td><span>" . esc_html( $default_location_city ) . ", " . esc_html( $default_location_state ) . "</span></td><td><span>" . esc_html( date("m/d/Y") ) . "</span></td></tr>";
		
		
	}	
	
	$shortCodeOutput = $shortCodeOutput . "</table>";	
	$shortCodeOutput = $shortCodeOutput . "</div>";
	
	// job descriptions
	foreach($jobsJsonObject as $job) {
		if( $job->IsPublic || current_user_can('editor') || current_user_can('administrator') ) {
			$applyLink = $janehires_base_url . '/Candidate/Enrollment/Apply/' . $job->ApplicationPageID . '?lite=true';
			$shortCodeOutput = $shortCodeOutput . "<div id='" . esc_attr( $job->ApplicationPageID ) . "' class='jobDesc'>";
			$shortCodeOutput = $shortCodeOutput . "<div class='jobTitle'><h2>" . esc_html( $job->Title ) . "</h2> <!-- <img src='". $purplesquiggly_image ."' /> --> </div>";
			
			if( current_user_can('editor') || current_user_can('administrator') ) {
				$shortCodeOutput = $shortCodeOutput . "<p><i>You can use this shortcode to embed this specific job: </i><br><input type='text' class='jhwpjp-shortcode' value='[wp-job-portal-job apid=\"" . $job->ApplicationPageID . "\"]' onfocus='this.select()' onmouseup='this.select()' /></p>";	
			}		
			
			$shortCodeOutput = $shortCodeOutput . "<button class='applyButton' onclick=\"ApplyModal('" . $applyLink . "')\">Apply</button>";
			$shortCodeOutput = $shortCodeOutput . "<p><i>" . esc_html( $job->City ) . ", " . esc_html( $job->State ) . "</i></p>";
			$shortCodeOutput = $shortCodeOutput . "<p>" . $job->JobDescription . "</p>";
			
			if( !empty($job->CompensationDescription) ) {
				$shortCodeOutput = $shortCodeOutput . "<h4>Compensation and Benefits</h4>";
				$shortCodeOutput = $shortCodeOutput . "<p>" . esc_html( $job->CompensationDescription ) . "</p>";
			}
			
			$shortCodeOutput = $shortCodeOutput . "<div>&nbsp;</div>";
			
			$shortCodeOutput = $shortCodeOutput . "<button class='applyButton' onclick=\"ApplyModal('" . $applyLink . "')\">Apply</button>";
			$shortCodeOutput = $shortCodeOutput . "</div>";
		}
	}		
	
	return $shortCodeOutput;
 }
 
 
 //// single job
 function jhwpjp_plugin_shortcode_job( $atts ) { 

    $args = shortcode_atts( array(
        'apid' => '',
		'showTitle' => 'false'
    ), $atts ); 
 
	$apid = $atts['apid'];
	$showTitle = $atts['showtitle'];
	
	global $janehires_api_url;
	global $janehires_base_url;
	$purplesquiggly_image = plugins_url('/assets/purplesquiggly.png', __FILE__);
	
	$shortCodeOutput = '';

	$job = jhwpjp_GetJob( $apid );
	$applyLink = $janehires_base_url . '/Candidate/Enrollment/Apply/' . $job->ApplicationPageID . '?lite=true';
	
	if( !$job->IsPublic && !( current_user_can('editor') || current_user_can('administrator') ) ) {
		return "<div class='privateJob'><p>This job is not currently viewable.</p></div>";	
	}
		 
	// solo job description
	$shortCodeOutput = $shortCodeOutput . "<div id='" . esc_attr( $job->ApplicationPageID ) . "' class='jobDescSolo'>";
	
	if( $showTitle == 'true' ) {
		$shortCodeOutput = $shortCodeOutput . "<div class='jobTitle'><h2>" . esc_html( $job->Title ) . "</h2> <!-- <img src='". $purplesquiggly_image ."' /> --> </div>";	
	}
	
	$shortCodeOutput = $shortCodeOutput . "<button class='applyButton' onclick=\"ApplyModal('" . $applyLink . "')\">Apply</button>";
	$shortCodeOutput = $shortCodeOutput . "<p><i>" . esc_html( $job->City ) . ", " . esc_html( $job->State ) . "</i></p>";
	$shortCodeOutput = $shortCodeOutput . "<p>" . $job->JobDescription . "</p>";
	
	if( !empty($job->CompensationDescription) ) {
		$shortCodeOutput = $shortCodeOutput . "<h4>Compensation and Benefits</h4>";
		$shortCodeOutput = $shortCodeOutput . "<p>" . esc_html( $job->CompensationDescription ) . "</p>";		
	}		
	
	$shortCodeOutput = $shortCodeOutput . "<div>&nbsp;</div>";	
	
	$shortCodeOutput = $shortCodeOutput . "<button class='applyButton' onclick=\"ApplyModal('" . $applyLink . "')\">Apply</button>";
	$shortCodeOutput = $shortCodeOutput . "</div>";
	
	return $shortCodeOutput;
 } 
 
  function jhwpjp_plugin_widget_output() {
	global $janehires_api_url;
	
	$careers_page_url = jhwpjp_GetCareersPageUrl();
	$create_sample_jobs = ( jhwpjp_get_plugin_setting('create_sample_jobs') == 1 );
	$rawJSON = jhwpjp_get_data( $janehires_api_url . 'GetJobListings/' . jhwpjp_GetAPIKey() );
	$jobsJsonObject = json_decode( $rawJSON );
		 
	echo "<ul>";	 

	foreach($jobsJsonObject as $job) {
		if( $job->IsPublic ) {
			$job_page_url = jhwpjp_GetJobPageUrl( $job->ApplicationPageID, $job->Title, $job->Url );
			echo( "<li><a target='_blank' href='" . esc_url( $job_page_url ) . "'>" . esc_html( $job->Title ) . "</a></li>" );
		}
	}	 	 
	
	// inject sample jobs
	if(( count($jobsJsonObject) == 0 ) && $create_sample_jobs ) {
		echo( "<li><a target='_blank' href='#'>Sample Job Title One</a></li>" );
		echo( "<li><a target='_blank' href='#'>Sample Job Title Two</a></li>" );
		echo( "<li><a target='_blank' href='#'>Sample Job Title Three</a></li>" );
	}
	
	echo "</ul>";
 }
 
 function jhwpjp_GetCareersPageUrl()
 {
	$create_careers_page_title = jhwpjp_get_plugin_setting('create_careers_page_title');
	$careers_page_post_id = jhwpjp_get_plugin_setting('careers_page_post_id');
	
	if( null == $careers_page_post_id ) {
		$cp = get_page_by_title( $create_careers_page_title );
		if( null != $cp )
			$careers_page_post_id = $cp->ID;
	}	 

	// bail if you can't find page id
	if( null == $careers_page_post_id ) { return false; }
	
	return get_permalink( $careers_page_post_id );
 }
 
 function jhwpjp_GetJobPageUrl( $apid, $jobTitle, $jobUrl, $truncateToHashtag = false )
 {
	// if there's a page use that first
	$jp = get_page_by_title( $jobTitle );
	if( null != $jp ) { return get_permalink( $jp->ID ); }
	
	// then if there's a careers page, use that
	$careers_page_url = jhwpjp_GetCareersPageUrl();
	if( !empty( $careers_page_url ) ) { 
	
		if( $truncateToHashtag )
			return '#' . $apid; 
		
		return $careers_page_url . '#' . $apid; 
	}
		
	// if all else fails, use the web app link
	return $jobUrl;
 }
 
 function jhwpjp_MakePrivate( $apid ) 
 {
	 global $janehires_api_url;
	 $rawJSON = jhwpjp_get_data( $janehires_api_url . 'MakeJobPrivate/?apiKey=' . jhwpjp_GetAPIKey() . '&apid=' . $apid );
 }
 
 function jhwpjp_MakePublic( $apid ) 
 {
	 global $janehires_api_url;
	 $rawJSON = jhwpjp_get_data( $janehires_api_url . 'MakeJobPublic/?apiKey=' . jhwpjp_GetAPIKey() . '&apid=' . $apid );	 
 }

 function jhwpjp_CreatePost( $apid ) 
 {
	$job = jhwpjp_GetJob( $apid );
	
		$job_page = array(
			'post_type' => 'page',
			'post_title' => $job->Title,
			'post_content' => '[wp-job-portal-job apid=\"' . $apid . '\"]',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => $job->Title
		);

		$post_id = wp_insert_post($job_page);		 
 }
 
 function jhwpjp_GetJobsDataForTable()
 {
	global $janehires_api_url;
	$rawJSON_jobs = jhwpjp_get_data( $janehires_api_url . 'GetJobListings/' . jhwpjp_GetAPIKey() );	
	return json_decode( $rawJSON_jobs, true );		 
 }
 
 function jhwpjp_GetJob( $apid )
 {
	global $janehires_api_url;
	$rawJSON = jhwpjp_get_data( $janehires_api_url . 'GetJob/?apiKey=' . jhwpjp_GetAPIKey() . '&apid=' . $apid );
	return json_decode( $rawJSON );	 
 }
 
 function jhwpjp_GetManagers()
 {
	global $janehires_api_url;
	$rawJSON = jhwpjp_get_data( $janehires_api_url . 'GetManagers/?apiKey=' . jhwpjp_GetAPIKey() );
	return json_decode( $rawJSON );	 
 } 

function jhwpjp_AddJob( $jobTitle, $city, $state, $description, $compensation, $managerID, $requireCoverLetter, $sendManagerEmail, $isPublic )
{
	global $janehires_api_url;
	$baseUrl = $janehires_api_url . 'AddJob/';
	$addUrl = '?apiKey=' . jhwpjp_GetAPIKey();
	
	$addUrl = add_query_arg( 'jobTitle', urlencode_deep($jobTitle), $addUrl );
	$addUrl = add_query_arg( 'city', urlencode_deep($city), $addUrl );
	$addUrl = add_query_arg( 'state', urlencode_deep($state), $addUrl );
	$addUrl = add_query_arg( 'description', urlencode_deep( esc_html($description) ), $addUrl );
	$addUrl = add_query_arg( 'compensation', urlencode_deep($compensation), $addUrl );
	$addUrl = add_query_arg( 'managerIDBase64', urlencode_deep($managerID), $addUrl );
	$addUrl = add_query_arg( 'requireCoverLetter', ( $requireCoverLetter == '1' ? 'true' : 'false' ), $addUrl );
	$addUrl = add_query_arg( 'sendManagerEmail', ( $sendManagerEmail == '1' ? 'true' : 'false' ), $addUrl );
	$addUrl = add_query_arg( 'isPublic', ( $isPublic == '1' ? 'true' : 'false' ), $addUrl );

	$addUrl = substr( $addUrl, 1);
	$post = curl_init( $baseUrl );
	curl_setopt( $post, CURLOPT_POST, 1);
	curl_setopt( $post, CURLOPT_POSTFIELDS, $addUrl);
	curl_setopt( $post, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt( $post, CURLOPT_HEADER, 0);
	curl_setopt( $post, CURLOPT_RETURNTRANSFER, 1);

	$response = curl_exec( $post );	
	return json_decode( $response );	 	
}


function jhwpjp_EditJob( $apid, $jobTitle, $city, $state, $description, $compensation, $managerID, $requireCoverLetter, $sendManagerEmail, $isPublic, $compensationID ) 
{
	global $janehires_api_url;
	$baseUrl = $janehires_api_url . 'EditJob/';
	$editUrl = '?apiKey=' . jhwpjp_GetAPIKey();
	
	$editUrl =  add_query_arg( 'applicationPageIDBase64', urlencode_deep($apid), $editUrl );
	$editUrl =  add_query_arg( 'jobTitle', urlencode_deep($jobTitle), $editUrl );
	$editUrl =  add_query_arg( 'city', urlencode_deep($city), $editUrl );
	$editUrl =  add_query_arg( 'state', urlencode_deep($state), $editUrl );
	$editUrl =  add_query_arg( 'description', urlencode_deep( esc_html( $description ) ), $editUrl );
	$editUrl =  add_query_arg( 'compensation', urlencode_deep($compensation), $editUrl );
	$editUrl =  add_query_arg( 'managerIDBase64', urlencode_deep($managerID), $editUrl );
	$editUrl =  add_query_arg( 'requireCoverLetter', ( $requireCoverLetter == '1' ? 'true' : 'false' ), $editUrl );
	$editUrl =  add_query_arg( 'sendManagerEmail', ( $sendManagerEmail == '1' ? 'true' : 'false' ), $editUrl );
	$editUrl =  add_query_arg( 'isPublic', ( $isPublic == '1' ? 'true' : 'false' ), $editUrl );
	$editUrl =  add_query_arg( 'compensationIDBase64', urlencode_deep($compensationID), $editUrl );	

	$editUrl = substr( $editUrl, 1);
	$post = curl_init( $baseUrl );
	curl_setopt( $post, CURLOPT_POST, 1);
	curl_setopt( $post, CURLOPT_POSTFIELDS, $editUrl);
	curl_setopt( $post, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt( $post, CURLOPT_HEADER, 0);
	curl_setopt( $post, CURLOPT_RETURNTRANSFER, 1);

	$response = curl_exec( $post );	
	return json_decode( $response );			
}
 
  function jhwpjp_GetUserEmail() {
	$current_user = wp_get_current_user();
	if ( !($current_user instanceof WP_User) )
		return;	  
	
	$user_email = $current_user->user_email;
	
	if( !empty( $user_email ) && is_email( $user_email ) ) { return $user_email; }
  }
  
  function jhwpjp_activate()  {	  
	  jhwpjp_set_plugin_setting( 'run_setup', true );
  }
  
  function jhwpjp_uninstall() {
	update_option('jhwpjp_plugin_options', null);
  }

register_activation_hook( basename( dirname( __FILE__ ) ) . '/' . basename( __FILE__ ), jhwpjp_activate );
register_uninstall_hook(__FILE__, 'jhwpjp_uninstall');
  
?>
