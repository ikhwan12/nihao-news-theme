<?php 

function youmax_admin_scripts(){
	wp_enqueue_script( 'youmax-admin-js', plugins_url('js/youmax-admin.js',__FILE__), true);
	wp_enqueue_style( 'youmax-admin-css', plugins_url('css/youmax-admin.css',__FILE__), true);
	wp_enqueue_script( 'spectrum-js', plugins_url('spectrum/spectrum.min.js',__FILE__), true);
	wp_enqueue_style( 'spectrum-css', plugins_url('spectrum/spectrum.min.css',__FILE__), true);
}
add_action('admin_enqueue_scripts', 'youmax_admin_scripts');


function youmax_register_post() {
	register_post_type( 'youmax-pro-post', array(
		'labels' => array('name' => 'Youmax Pro Post'),
		'rewrite' => false,
		'public' => false,
		'capability_type' => 'post',
		'query_var' => false ) 
	);
}
add_action('init', 'youmax_register_post');


function youmax_insert_callback() {

	if(!isset($_POST['shortcode'])) {
		$shortcode = '[youmax][/youmax]';
	} else {
		$shortcode = $_POST['shortcode'];	
	}

	if(!isset($_POST['name'])) {
		$name = 'Youmax'.wp_create_nonce();
	} else {
		$name = $_POST['name'];
	}

	// Create post object
	$my_post = array(
	  'post_title'    => $name,
	  'post_content'  => $shortcode,
	  'post_status'   => 'publish',
	  'post_type'	  => 'youmax-pro-post'
	);

	$postId = wp_insert_post( $my_post );

	echo $postId;

	wp_die();
}
add_action( 'wp_ajax_youmax_insert', 'youmax_insert_callback' );


function youmax_update_callback() {
	
	$my_post = array(
	  'ID'    => $_POST['id'],
	);
	
	if(isset($_POST['shortcode'])) {
		$my_post["post_content"] = $_POST['shortcode'];
	}

	if(isset($_POST['name'])) {
		$my_post["post_title"] = $_POST['name'];
	}

	//Update post object
	$postId = wp_update_post( $my_post );

	echo $postId;

	wp_die();
}
add_action( 'wp_ajax_youmax_update', 'youmax_update_callback' );


//Add Youmax Options page under "Settings"
add_action('admin_menu', 'youmax_admin_init');
function youmax_admin_init() {
	add_menu_page('Youmax - YouTube & Vimeo Portfolio for Awesome Biz', 'Youmax', 'manage_options', 'youmax', 'youmax_admin_list_all', 'dashicons-video-alt');	
	$addnew = add_submenu_page( 'youmax', 'Create Youmax Widget', 'Add New', 'manage_options', 'youmax-single', 'youmax_admin_add_new' );
}


//Add New / Edit Page
function youmax_admin_add_new() {

?>

<div class="wrap">
<h2></h2>
<div class="youmax-admin">

	<!--<span class="youmax-post-title-label">Youmax Instance Name</span>-->
	<input type="text" id="youmax_post_title" placeholder="Youmax Instance Name" size="30" spellcheck="true" autocomplete="off" value="" />
	
	<div class="youmax-code-wrapper" id="">
		<div id="youmax-small-code-title">Shortcode:</div>
		<br>
		<div id="youmax-small-code"></div>
	</div>
	
	<!-- Generator -->

    <div class="dream-generator-wrapper">
	    <div class="dream-generator">

	    	<div class="multiple-mode">
	    		<div class="dream-generator-header"><span>VIDEO SOURCES</span><span class="dream-generator-visibility-controller" data-target="youmax-video-sources">show</span></div>
	    		<div id="youmax-video-sources">
	    			<i class="youmax-extended-info">Each video source will be added in a separate Tab inside Youmax.</i>
		    		<div class="dream-data"></div>
		    		<div class="dream-add-data"><i class="fa fa-plus"></i>Add Source</div>
		    		<br>

	    		</div>
	    	</div>
	    	
		
		<div class="dream-generator-header"><span>BASIC</span><span class="dream-generator-visibility-controller" data-target="youmax-core-options">show</span></div>
	    	

	    	<div class="dream-options" id="youmax-core-options">

	    		<div class="dream-plugin-option loop">
	    			<span>API Key</span>
	    			<input type="text" data-name="apiKey" value="AIzaSyAlhAqP5RS7Gxwg_0r_rh9jOv_5WfaJgXw" />
	    		</div>

				<div class="dream-plugin-option loop">
	    			<span>YouTube Client ID</span>
	    			<input type="text" data-name="youTubeClientId" value="237485577723-lndqepqthdb3lh4gec2skvpfaii9sgh0.apps.googleusercontent.com" />
	    		</div>	    		

	      		<div class="dream-plugin-option loop">
	    			<span>Channel Link for Header</span>
	    			<input type="text" data-name="channelLinkForHeader" value="https://www.youtube.com/user/yogahousem" />
	    		</div>

	    		<div class="dream-plugin-option loop">
	    			<span>Maximum Results</span>
	    			<input type="text" data-name="maxResults" value="9" />
	    		</div>
   		
	    		<div class="dream-plugin-option loop">
	    			<span>Video Display Mode</span>
	    			<select data-name="videoDisplayMode">
	    				<option value="link">Link to YouTube</option>
	    				<option value="popup" selected>Popup</option>
	    				<option value="inline">Inline</option>
	    			</select>
	    		</div>

	    		<div class="dream-plugin-option loop">
	    			<span>Enable Playlist Navigation</span><i>If enabled, users can browse videos inside playlist items. If disabled, playlist items will be opened in a YouTube player. <br>(Check the "Playlists" Tab in Youmax above)</i>
	    			<select data-name="playlistNavigation">
	    				<option value="true" selected>Yes</option>
	    				<option value="false">No</option>
	    			</select>
	    		</div>

		  		<div class="dream-plugin-option loop">
	    			<span>Default Tab</span><i>Name of the Tab that must be shown on page load</i>
	    			<input type="text" data-name="defaultTab" value="Uploads" />
	    		</div>

	    	</div>


	    	<div class="dream-generator-header"><span>DISPLAY</span><span class="dream-generator-visibility-controller" data-target="youmax-basic-options">show</span></div>
	    	
	    	<!--
	    	<div class="dream-generator-mode" id="single-mode">Single Video Source</div>
	    	<div class="dream-generator-mode" id="multiple-mode">Multiple Video Sources</div>
	    	-->

	    	<div class="dream-options" id="youmax-basic-options">

	    		<div class="dream-plugin-option loop how">
	    			<span>HOW do you want it to look?</span>
	    			<select data-name="youmaxDisplayMode" >
	    				<option value="double-list" >Double List (for full width)</option>
	    				<option value="grid" selected >Grid (for medium width)</option>
	    				<option value="list">Singe List (for small width columns)</option>
	    			</select>
	    		</div>

	    		<div class="dream-plugin-option loop how">
	    			<span>Thumbnail Type (only for GRID)</span>
	    			<select data-name="gridThumbnailType">
	    				<option value="simple">Simple</option>
	    				<option value="neat">Neat</option>
	    				<option value="full" selected>Full</option>
	    			</select>
	    		</div>

	    		<div class="dream-plugin-option loop">
	    			<span>Auto Play Videos</span>
	    			<select data-name="autoPlay">
	    				<option value="true" selected>Yes</option>
	    				<option value="false">No</option>
	    			</select>
	    		</div>

	    		<div class="dream-plugin-option loop">
	    			<span>Date Format</span>
	    			<select data-name="dateFormat">
	    				<option value="specific">Specific (Ex: 24 May 2016)</option>
	    				<option value="relative" selected>Relative (Ex: 4 months ago)</option>
	    			</select>
	    		</div>

	    		

	    	</div>


	    	<div class="dream-generator-header"><span>HIDING</span><span class="dream-generator-visibility-controller" data-target="youmax-hiding-options">show</span></div>
	    	

	    	<div class="dream-options" id="youmax-hiding-options">

	    		<div class="dream-plugin-option loop how">
	    			<span>Hide Header</span>
	    			<select data-name="hideHeader" >
	    				<option value="true" >Yes</option>
	    				<option value="false" selected >No</option>
	    			</select>
	    		</div>


	    		<div class="dream-plugin-option loop how">
	    			<span>Hide Tabs</span>
	    			<select data-name="hideTabs" >
	    				<option value="true" >Yes</option>
	    				<option value="false" selected >No</option>
	    			</select>
	    		</div>


	    		<div class="dream-plugin-option loop how">
	    			<span>Hide Search Box</span>
	    			<select data-name="hideSearch" >
	    				<option value="true" >Yes</option>
	    				<option value="false" selected >No</option>
	    			</select>
	    		</div>


	    		<div class="dream-plugin-option loop how">
	    			<span>Hide Sorting Dropdown</span>
	    			<select data-name="hideSorting" >
	    				<option value="true" >Yes</option>
	    				<option value="false" selected >No</option>
	    			</select>
	    		</div>


	    		<div class="dream-plugin-option loop how">
	    			<span>Hide View Switcher</span>
	    			<br><i>Grid to List Switch button</i>
	    			<select data-name="hideViewSwitcher" >
	    				<option value="true" >Yes</option>
	    				<option value="false" selected >No</option>
	    			</select>
	    		</div>


	    		<div class="dream-plugin-option loop how">
	    			<span>Hide Loading Mechanism</span>
	    			<br><i>Load More button & Previous-Next buttons</i>
	    			<select data-name="hideLoadingMechanism" >
	    				<option value="true" >Yes</option>
	    				<option value="false" selected >No</option>
	    			</select>
	    		</div>

	
	    		<div class="dream-plugin-option loop how">
	    			<span>Hide CTA button</span>
	    			<br><i>Call to Action button - next to Load More buttons</i>
	    			<select data-name="hideCtaButton" >
	    				<option value="true" >Yes</option>
	    				<option value="false" selected >No</option>
	    			</select>
	    		</div>

	
	    		<div class="dream-plugin-option loop how">
	    			<span>Hide Popup Details</span><i>the video details (title + description + likes + comments) that are shown with the video player</i>
	    			<select data-name="hidePopupDetails" >
	    				<option value="true" >Yes</option>
	    				<option value="false" selected >No</option>
	    			</select>
	    		</div>

	    		
	    		<div class="dream-plugin-option loop how">
	    			<span>Hide Duration</span><i>the time count shown at the top of each video thumbnail</i>
	    			<select data-name="hideDuration" >
	    				<option value="true" >Yes</option>
	    				<option value="false" selected >No</option>
	    			</select>
	    		</div>

	    		<div class="dream-plugin-option loop how">
	    			<span>Hide Shadows on Thumbnails</span>
	    			<select data-name="hideThumbnailShadow" >
	    				<option value="true" selected>Yes</option>
	    				<option value="false" >No</option>
	    			</select>
	    		</div>	    		

	    	</div>
	    	
	    	
	    	<div class="dream-generator-header"><span>STYLE EDITOR</span><span class="dream-generator-visibility-controller" data-target="youmax-design-editor">show</span></div>

	    	<div class="dream-options" id ="youmax-design-editor">

	    		<div class="dream-plugin-option loop">
	    			<span>Youmax Background Color</span><input type="text" data-name="youmaxBackgroundColor" value="#ECEFF1" class="dream-color-picker"/>
	    		</div>
	    		<div class="dream-plugin-option loop">
	    			<span>Thumbnail Background Color</span><input type="text" data-name="itemBackgroundColor" value="#fbfbfb" class="dream-color-picker"/>
	    		</div>
	    		<div class="dream-plugin-option loop">
	    			<span>Header Background Color</span><input type="text" data-name="headerBackgroundColor" value="rgb(252, 76, 74)" class="dream-color-picker"/>
	    		</div>
	    		<div class="dream-plugin-option loop">
	    			<span>Header Text Color</span><input type="text" data-name="headerTextColor" value="white" class="dream-color-picker"/>
	    		</div>
	    		<div class="dream-plugin-option loop">
	    			<span>Thumbnail Title Color</span><input type="text" data-name="titleColor" value="#383838" class="dream-color-picker"/>
	    		</div>
	    		<div class="dream-plugin-option loop">
	    			<span>Thumbnail Description Color</span><input type="text" data-name="descriptionColor" value="828282" class="dream-color-picker"/>
	    		</div>
	    		<div class="dream-plugin-option loop">
	    			<span>Views & Date Color</span><input type="text" data-name="viewsColor" value="#6f6f6f" class="dream-color-picker"/>
	    		</div>
	    		<div class="dream-plugin-option loop">
	    			<span>Tabs Color</span><input type="text" data-name="tabsColor" value="black" class="dream-color-picker"/>
	    		</div>
	    		<div class="dream-plugin-option loop">
	    			<span>Select & Loading Button's Text Color</span><input type="text" data-name="controlsTextColor" value="black" class="dream-color-picker"/>
	    		</div>

		  		<div class="dream-plugin-option loop">
	    			<span>Base Font Size <i>use this to increase or decrease all font-sizes in Youmax</i></span>
	    			<input type="text" data-name="baseFontSize" value="16px" />
	    		</div>	

	    		<div class="dream-plugin-option loop">
	    			<span>Title Font Family</span>
	    			<select data-name="titleFontFamily">
	    				<option value="Open Sans">Open Sans</option>
	    				<option value="Roboto Condensed" selected>Roboto Condensed</option>
	    				<option value="sans-serif">Sans Serif</option>
	    				<option value="Calibri">Calibri</option>
	    			</select>
	    		</div>	
	    		<div class="dream-plugin-option loop">
	    			<span>Title Font Size</span>
	    			<input type="text" data-name="titleFontSize" value="0.9" />
	    		</div>
	      		<div class="dream-plugin-option loop">
	    			<span>Title Boldness</span>
	    			<select data-name="titleFontWeight">
	    				<option value="normal" selected>Normal</option>
	    				<option value="bold">Bold</option>
	    			</select>
	    		</div>
	    		<div class="dream-plugin-option loop">
	    			<span>General Font Family</span>
	    			<select data-name="generalFontFamily">
	    				<option value="Open Sans">Open Sans</option>
	    				<option value="Roboto Condensed" selected>Roboto Condensed</option>
	    				<option value="sans-serif">Sans Serif</option>
	    				<option value="Calibri">Calibri</option>
	    			</select>
	    		</div>
	    		<div class="dream-plugin-option loop">
	    			<span>Description Font Size</span>
	    			<input type="text" data-name="descriptionFontSize" value="0.85" />
	    		</div>	    		
	    		<div class="dream-plugin-option loop">
	    			<span>Views & Date Font Size</span>
	    			<input type="text" data-name="viewsDateFontSize" value="0.75" />
	    		</div>

	    	</div>

	    	<div class="dream-generator-header"><span>PLAY ICONS</span><span class="dream-generator-visibility-controller" data-target="youmax-icon-options">show</span></div>
	    	
	    	<!--
	    	<div class="dream-generator-mode" id="single-mode">Single Video Source</div>
	    	<div class="dream-generator-mode" id="multiple-mode">Multiple Video Sources</div>
	    	-->

	    	<div class="dream-options" id="youmax-icon-options">

				<div class="dream-plugin-option loop">
	    			<span>Show Play Icon on Hover (Animate)</span>
	    			<select data-name="showHoverAnimation">
	    				<option value="true">Yes</option>
	    				<option value="false" selected>No</option>
	    			</select>
	    		</div>

	    		<div class="dream-plugin-option loop">
	    			<span>Show Fixed Play Icon on Thumbnails</span>
	    			<select data-name="showFixedPlayIcon">
	    				<option value="true">Show</option>
	    				<option value="false" selected>Hide</option>
	    			</select>
	    		</div>

	    		<div class="dream-plugin-option loop">
	    			<span>Fixed Icon Shape</span>
	    			<select data-name="iconShape">
	    				<option value="square">Square</option>
	    				<option value="circle" selected>Circle</option>
	    			</select>
	    		</div>

	    	</div>


	    	<div class="dream-generator-header"><span>LOAD MORE</span><span class="dream-generator-visibility-controller" data-target="youmax-loading-options">show</span></div>
	    	
    		<div class="dream-options" id ="youmax-loading-options">

	    		<div class="dream-plugin-option loop">
	    			<span>Loading Mechanism</span>
	    			<select data-name="loadingMechanism">
	    				<option value="load-more" selected>Load More Button</option>
	    				<option value="prev-next">Pagination - Previous Next Buttons</option>
	    			</select>
	    		</div>

	    		<div class="dream-plugin-option loop">
	    			<span>Load More Button Text</span>
	    			<input type="text" data-name="loadMoreText" value="<i class='fa fa-plus'></i>&nbsp;&nbsp;Show me more videos.." />
	    		</div>
	    		<div class="dream-plugin-option loop">
	    			<span>Previous Button Text</span>
	    			<input type="text" data-name="previousButtonText" value="<i class='fa fa-angle-left'></i>&nbsp;&nbsp;Previous" />
	    		</div>
	    		<div class="dream-plugin-option loop">
	    			<span>Next Button Text</span>
	    			<input type="text" data-name="nextButtonText" value="Next&nbsp;&nbsp;<i class='fa fa-angle-right'></i>" />
	    		</div>


	    	</div>




	    	<div class="dream-generator-header"><span>ADVANCED</span><span class="dream-generator-visibility-controller" data-target="youmax-advanced-options">show</span></div>
	    	
	    		<div class="dream-options" id ="youmax-advanced-options">


		    		<div class="dream-plugin-option loop">
		    			<span>Display First Video on Page Load (for Inline Mode)</span>
		    			<select data-name="displayFirstVideoOnLoad">
		    				<option value="true" selected>Yes</option>
		    				<option value="false">No</option>
		    			</select>
		    		</div>

		    		
		    		<div class="dream-plugin-option loop">
		    			<span>CTA Button Text</span>
		    			<input type="text" data-name="ctaText" value="<i class='fa fa-shopping-cart'></i>&nbsp;&nbsp;Get me a GoPro.." />
		    		</div>
		    		<div class="dream-plugin-option loop">
		    			<span>CTA Button Link</span>
		    			<input type="text" data-name="ctaLink" value="https://gopro.com/" />
		    		</div>

		    		<div class="dream-plugin-option loop">
		    			<span>Minimum Views Per Day (for Trending Indicator)</span>
		    			<input type="text" data-name="minimumViewsPerDayForTrendingVideos" value="5" />
		    		</div>

		    		<div class="dream-plugin-option loop">
		    			<span>Responsive Breakpoints</span><i>Example: [600,900,1200,2000]<br>
In this case, below 600px width is 1 column layout.<br>
Between 600-900 you get 2-columns<br>
Between 900-1200 you get 3- columns<br>
Between 1200-2000 you get 4 columns<br>
Above 2000 you get 5 columns</i>
		    			<input type="text" data-name="responsiveBreakpoints" value="[600,900,1200,2000]" />
		    		</div>

		    	</div>

	    	


	    </div>

    </div>


	<!-- end generator -->
	
	<input id="youmax-save-shortcode" type="button" class="button-primary" value="Save" onclick="youmaxSaveShortcode();" />

</div>
</div>


<?php

	$action = $_GET['action'];
	$instance = $_GET['instance'];
	
	if (isset($action) && $action=="duplicate" && isset($instance)) {
		//DUPLICATE this Youmax instance 
		//[To be added in next version]

	}
		
	if (isset($instance)) {
		//EDIT this Youmax instance
		
		$youmax_post = get_post($instance); 
		$youmax_options = $youmax_post->post_content;		
		$youmax_post_title = $youmax_post->post_title;
		$youmax_display_shortcode = '[youmaxpro id="'.$instance.'" name="'.$youmax_post_title.'"]';
		?>
		
		<script type="text/javascript">
		jQuery(document).ready(function(){
			var options = <?php echo $youmax_options ?>;
			var postId = "<?php echo $instance ?>";
			var postTitle = "<?php echo $youmax_post_title ?>";
			var postShortcode = '<?php echo $youmax_display_shortcode ?>';
			setOptions(postId,postTitle,postShortcode,options);
			createColorPickers();
		});
		</script>

		<?php
		
	} else {
		//ADD NEW Youmax instance

		?>
		
		<script type="text/javascript">
		jQuery(document).ready(function(){
			setOptions(null,null,null,youmaxDefaultOptions);
			createColorPickers();
		});
		</script>

		<?php
		
	}

}


//List Instances Page
function youmax_admin_list_all() {

	require_once YOUMAX_PLUGIN_DIR . '/admin/list.php';
	
	if (isset($_GET['instance'])) {
		//delete the instance 

		$youmax_post_id = $_GET['instance'];

		$youmax_post = get_post($youmax_post_id); 
		
		if(isset($youmax_post)) {
			$youmax_post_title = $youmax_post->post_title;
			wp_delete_post( $youmax_post_id );
			?>
				<script>alert('Youmax Instance "<?php echo $youmax_post_title ?>" deleted!');</script>
			<?php
		}
		
	}
	

	?>
		<div class="wrap">
			<h2>Youmax - YouTube & Vimeo Portfolio for Awesome Biz</h2>
			
			<div id="poststuff">
				<div id="post-body" class="metabox-holder columns-1">
					<div id="post-body-content">
						<div class="meta-box-sortables ui-sortable">
							<form method="post">
								<input type="hidden" name="page" value="youmax_list_table">
								<?php
								$list_table = new Youmax_Instance_List();
								$list_table->prepare_items();								
								$list_table->search_box( 'search', 'youmax_search' );
								$list_table->display();
								?>
							</form>
						</div>
					</div>
				</div>
				<br class="clear">
			</div>
			


			
		</div>
	
	<?php

}


?>