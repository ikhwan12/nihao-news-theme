<?php

function jhwpjp_JobForm() 
{
	$apid = null;
	if( !empty( $_GET['action'] ) && ( $_GET['action'] == 'editJob' ) && !empty( $_GET['job'] ) ) {
		$apid = sanitize_text_field( $_GET['job'] );
	}	
	
	$isEdit = !empty( $apid );
	$action = ( $isEdit ? 'editJob' : 'addJob' );
	$asterisk_image = plugins_url('/assets/icon-128x128.png', __FILE__);
	
	$title = '';
	$jobDescription = '';
	$compensation = '';
	$compensationID = '';
	$managerEmail = '';
	$managerName = '';
	$managerID = '';
	$city = jhwpjp_get_plugin_setting('default_location_city');
	$state = jhwpjp_get_plugin_setting('default_location_state');
	$zip = '';
	$requireCoverLetter = true;
	$sendManagerEmail = true;
	$isPublic = true;
	
	$managers = jhwpjp_GetManagers();
	
	if( $isEdit ) {
		$job = jhwpjp_GetJob( $apid );
		$title = $job->Title;	
		$jobDescription = $job->JobDescription;
		$compensation = $job->CompensationDescription;
		$compensationID = $job->CompensationID;
		$managerName = $job->ManagerName;
		$managerID = $job->ManagerID;
		$city = $job->City;
		$state = $job->State;
		$requireCoverLetter = $job->RequireCoverLetter;
		$sendManagerEmail = $job->SendManagerEmail;
		$isPublic = $job->IsPublic;		
	}
	
	$stateOptionTag = "<option value='" . esc_attr($state) . "' selected>" . esc_attr($state) . "</option>";
	
	?>
		<div style="width:98%;">
			<h2><img style="height:25px;vertical-align:middle;padding-right:3px;" src="<?php echo esc_url( $asterisk_image ); ?>" /> WP Job Portal by Jane</h2>
			<hr>
			
				<form method="post">
				
					<?php if( $isEdit ) { ?>
						<h2>Edit Job</h2>
					<?php } else { ?>
						<h2>Add Job</h2>
					<?php } ?>
				
					<?php wp_nonce_field(); ?>
					<input type='hidden' name='action' value='<?php esc_attr_e( $action ); ?>' />
					<input type='hidden' name='apid' value='<?php esc_attr_e( $apid ); ?>' />
					<input type='hidden' name='compensationID' value='<?php esc_attr_e( $compensationID ); ?>' />
					<input type='text' style='width:48%;' value='<?php esc_attr_e( $title ); ?>' name='Title' placeholder='Job Title' /><br>
					<?php 		
						echo "<input placeholder='City' id='default_location_city' name='City' size='40' type='text' value='". esc_attr( $city ) . "' required />";	
						echo "<select id='default_location_state' name='State'>" . $stateOptionTag . "<option value='AL'>Alabama</option><option value='AK'>Alaska</option><option value='AZ'>Arizona</option><option value='AR'>Arkansas</option><option value='CA'>California</option><option value='CO'>Colorado</option><option value='CT'>Connecticut</option><option value='DE'>Delaware</option><option value='DC'>District Of Columbia</option><option value='FL'>Florida</option><option value='GA'>Georgia</option><option value='HI'>Hawaii</option><option value='ID'>Idaho</option><option value='IL'>Illinois</option><option value='IN'>Indiana</option><option value='IA'>Iowa</option><option value='KS'>Kansas</option><option value='KY'>Kentucky</option><option value='LA'>Louisiana</option><option value='ME'>Maine</option><option value='MD'>Maryland</option><option value='MA'>Massachusetts</option><option value='MI'>Michigan</option><option value='MN'>Minnesota</option><option value='MS'>Mississippi</option><option value='MO'>Missouri</option><option value='MT'>Montana</option><option value='NE'>Nebraska</option><option value='NV'>Nevada</option><option value='NH'>New Hampshire</option><option value='NJ'>New Jersey</option><option value='NM'>New Mexico</option><option value='NY'>New York</option><option value='NC'>North Carolina</option><option value='ND'>North Dakota</option><option value='OH'>Ohio</option><option value='OK'>Oklahoma</option><option value='OR'>Oregon</option><option value='PA'>Pennsylvania</option><option value='RI'>Rhode Island</option><option value='SC'>South Carolina</option><option value='SD'>South Dakota</option><option value='TN'>Tennessee</option><option value='TX'>Texas</option><option value='UT'>Utah</option><option value='VT'>Vermont</option><option value='VA'>Virginia</option><option value='WA'>Washington</option><option value='WV'>West Virginia</option><option value='WI'>Wisconsin</option><option value='WY'>Wyoming</option></select>";
						// echo "<input placeholder='Zip' id='default_location_zip' name='Zip' size='5' type='number' value='" . esc_attr( $zip ) . "' required />";	
					?>
					<?php wp_editor( $jobDescription , 'JobDescription', $settings = array('textarea_name'=>'JobDescription', 'media_buttons'=>false,'drag_drop_upload'=>false) ); ?> 
					<br>
					<?php if( $isEdit ) { ?><label for=''>Compensation: </label> <?php } ?>
					<input type='text' style='width:80%;' value='<?php esc_attr_e( $compensation ); ?>' name='Compensation' id='Compensation' placeholder='Enter compensation (e.g., salary, insurance, retirement, education reimbursement)' />					
					<br>
					
					<?php if( $isEdit ) { ?>
						<br>
						<span>Job Manager: <code><?php esc_html_e( $managerName ); ?></code></span> 
						<input type='hidden' name='hiringManager' value='<?php esc_attr_e( $managerID ); ?>' />
					<?php } ?>
					<!-- <input type='text' style='width:80%;' value='<?php esc_attr_e( $managerEmail ); ?>' name='ManagerEmail' id='ManagerEmail' placeholder='Enter email of job manager who will be reviewing resumes' /> -->
					<br>
					
					<?php if( $isEdit ) { ?>
						<input type='checkbox' id='email_job_manager' name ='email_job_manager' value='1' <?php esc_html_e(($sendManagerEmail ? "checked='checked'" : ""));  ?> /> <label for='email_job_manager'>Send job manager an email with a link to resume each time a candidate applies</label><br>
						<input type='checkbox' id='make_public' name ='make_public' value='1' <?php esc_html_e(($isPublic ? "checked='checked'" : ""));  ?> /> <label for='make_public'>Make public - show job on my WordPress site</label><br>						
					<?php } else { ?>
						<label for='hiringManager'>Job hiring manager: </label>
						<select id='hiringManager' name='hiringManager'>
						<?php
							foreach($managers as $manager) { echo("<option value='" . $manager->UserID . "'>" . $manager->Name . "</option>"); }
						?>					
						</select>
						<br>
					
						<input type='checkbox' id='require_cover_letter' name ='require_cover_letter' value='1' <?php esc_html_e(($requireCoverLetter ? "checked='checked'" : ""));  ?> /> <label for='require_cover_letter'>Require cover letter</label><br>
						<input type='checkbox' id='email_job_manager' name ='email_job_manager' value='1' <?php esc_html_e(($sendManagerEmail ? "checked='checked'" : ""));  ?> /> <label for='email_job_manager'>Send job manager an email with a link to resume each time a candidate applies</label><br>
						<input type='checkbox' id='make_public' name ='make_public' value='1' <?php esc_html_e(($isPublic ? "checked='checked'" : ""));  ?> /> <label for='make_public'>Make public - show job on my WordPress site</label><br>
					<?php } ?>					
					
					<?php if( $isEdit ) { ?>		
						<br>
						<span>Job Shortcode: <input type='text' class='jhwpjp-shortcode' value='[wp-job-portal-job apid="<?php esc_html_e( $apid ); ?>"]' onfocus='this.select()' onmouseup='this.select()' /></span> 
						<br>
					<?php } ?>					
					
					<br>
									
					<a class="button button-primary" href="<?php echo( esc_url( remove_query_arg('action') ) ); ?>">Cancel</a>
					<input name="Submit" type="submit" class="button button-primary" value="<?php esc_attr_e('Save'); ?>" />
					
				</form>
		</div>
	<?php
	
}




function jhwpjp_JobForm_Save()
{
	// nonce validation
	if ( isset( $_POST['_wpnonce'] ) && ! empty( $_POST['_wpnonce'] ) ) {

		$nonce  = filter_input( INPUT_POST, '_wpnonce', FILTER_SANITIZE_STRING );

		if ( ! wp_verify_nonce( $nonce ) )
			wp_die( 'Nope! Security check failed!' );

	}   	

	$action = stripslashes( sanitize_text_field( $_POST['action'] ));
	$apid = stripslashes( sanitize_text_field( $_POST['apid'] ));
	$jobTitle = stripslashes( sanitize_text_field( $_POST['Title'] ));
	$city = stripslashes( sanitize_text_field( $_POST['City'] ));
	$state = stripslashes( sanitize_text_field( $_POST['State'] ));
	$description =  stripslashes( jhwpjp_strip_tags( $_POST['JobDescription'] ));
	$compensation = stripslashes( sanitize_text_field( $_POST['Compensation'] ));
	$managerID = stripslashes( sanitize_text_field( $_POST['hiringManager'] ));
	$requireCoverLetter = stripslashes( sanitize_text_field( $_POST['require_cover_letter'] ));
	$sendManagerEmail  = stripslashes( sanitize_text_field( $_POST['email_job_manager'] ));
	$isPublic = stripslashes( sanitize_text_field( $_POST['make_public'] ));
	$compensationID = stripslashes( sanitize_text_field( $_POST['compensationID'] ));
			  
	$isEdit = !empty( $apid );
	
	if( $isEdit ) {
		jhwpjp_EditJob( $apid, $jobTitle, $city, $state, $description, $compensation, $managerID, $requireCoverLetter, $sendManagerEmail, $isPublic, $compensationID );
	} else {
		jhwpjp_AddJob( $jobTitle, $city, $state, $description, $compensation, $managerID, $requireCoverLetter, $sendManagerEmail, $isPublic );
	}

	jhwpjp_reload_plugin_page();
	
}

function jhwpjp_strip_tags($buffer) {
	$default_attribs = array(
		'id' => array(),
		'class' => array(),
		'title' => array(),
		'style' => array(),
		'data' => array(),
		'data-mce-id' => array(),
		'data-mce-style' => array(),
		'data-mce-bogus' => array(),
	);

	$allowed_tags = array(
		'div'           => $default_attribs,
		'span'          => $default_attribs,
		'p'             => $default_attribs,
		'a'             => array_merge( $default_attribs, array(
			'href' => array(),
			'target' => array('_blank', '_top'),
		) ),
		'u'             =>  $default_attribs,
		'i'             =>  $default_attribs,
		'q'             =>  $default_attribs,
		'b'             =>  $default_attribs,
		'ul'            => $default_attribs,
		'ol'            => $default_attribs,
		'li'            => $default_attribs,
		'br'            => $default_attribs,
		'hr'            => $default_attribs,
		'strong'        => $default_attribs,
		'blockquote'    => $default_attribs,
		'del'           => $default_attribs,
		'strike'        => $default_attribs,
		'em'            => $default_attribs,
		'code'          => $default_attribs,
		'h1'          => $default_attribs,
		'h2'          => $default_attribs,
		'h3'          => $default_attribs,
		'h4'          => $default_attribs,
		'h5'          => $default_attribs,
		'h6'          => $default_attribs,
	);

	if (function_exists('wp_kses')) { // WP is here
		$buffer = wp_kses($buffer, $allowed_tags);
	} else {
		$tags = array();

		foreach (array_keys($allowed_tags) as $tag) {
			$tags[] = "<$tag>";
		}

		$buffer = strip_tags($buffer, join('', $tags));
	}

	$buffer = trim($buffer);

	return $buffer;
}

?>