
	var youmaxDefaultOptions = {

		apiKey					:"AIzaSyAlhAqP5RS7Gxwg_0r_rh9jOv_5WfaJgXw",	
		channelLinkForHeader	:"https://www.youtube.com/user/yogahousem",	
		tabs:[
	        {
	            name:"Uploads",
	            type:"youtube-channel-uploads",
	            link:"https://www.youtube.com/user/yogahousem",
	        }
	    ],
		maxResults				:"10",
		widgetTitle				:"Youmax Pro",
		videoDisplayMode		:"popup",										
		minimumViewsPerDayForTrendingVideos:"5",							
		displayFirstVideoOnLoad	:false,
		defaultSortOrder 		:"recent-first",
		youmaxDisplayMode		:"grid", 
		youmaxBackgroundColor   :"#ECEFF1",
	    itemBackgroundColor     :"#fbfbfb",
	    titleColor              :"rgb(0, 147, 165)",
	    descriptionColor        :"#686868",
	    viewsColor              :"#6f6f6f",
	    controlsTextColor       :"black",
	    titleFontFamily         :"Open Sans",           
	    generalFontFamily       :"Roboto Condensed",
	    titleFontSize           :"0.9",
	    titleFontWeight         :"normal",
	    descriptionFontSize     :"0.85",
	    viewsDateFontSize       :"0.75",
	    baseFontSize            :"16px", 
	    responsiveBreakpoints	:[600,900,2000,2500],
	    gridThumbnailType		:"full",
	    dateFormat				:"relative",
	    loadMoreText            :"<i class='fa fa-plus'></i>&nbsp;&nbsp;Show me more videos..",
	    ctaText                 :"<i class='fa fa-envelope'></i>&nbsp;&nbsp;Get me a consultation..",
		ctaLink                 :"http://www.healthbyscience.co.uk/get-started-now/"

	};


	jQuery(document).ready(function(){

	    jQuery(".dream-add-data").click(function() {
		    addSlide("Uploads","youtube-channel-uploads","https://www.youtube.com/user/designmilk");
	    });

	    jQuery(".dream-data").on("click",".dream-remove-data",function() {
	    	jQuery(this).parents(".dream-slide").remove();
	    });

	   	//visibility controller
	    jQuery(".dream-generator-header").click(function(){
	    	$controller = jQuery(this).find(".dream-generator-visibility-controller");
	    	targetId = $controller.data("target");
	    	$target = jQuery("#"+targetId);
	    	//console.log($target);

	    	if($target.is(":visible")) {
	    		$target.hide();
	    		$controller.html("<i class='fa fa-bars'></i> show");
	    	} else {
	    		$target.show();
	    		$controller.html("<i class='fa fa-times'></i> hide");
	    	}
	    });

		//hide all options
	    jQuery(".dream-generator-visibility-controller").click();
	    jQuery(".dream-generator-visibility-controller:first").click();

	    //change on youmax source
	    jQuery(".dream-data").on("change",".youmax-source-select",function(){
	    	updateLinkType(jQuery(this));
	    });

	});

	function generateShortcode() {

		var pluginJavascript = '{';

		
    	{ //FOR Multiple MODE------------------

			tabsJavascript = '\r\n\t\t'+'"tabs":[';

	    	jQuery(".dream-slide").each(function(){

	    		tabsJavascript += '\r\n\t\t\t{';

	    		$slide = jQuery(this);
	    		$slide.find(".dream-slide-option").each(function(){
	    			
	    			$input = jQuery(this).find("input");
					if(null==$input || $input.length==0) {
						//select box present
						$select = jQuery(this).find("select");
						tabsJavascript += '\r\n\t\t\t"'+$select.data("name")+'":"'+$select.val()+'",';
					} else {
						//input box present
	    				tabsJavascript += '\r\n\t\t\t"'+$input.data("name")+'":"'+$input.val()+'",';
					}

	    		});

				tabsJavascript = tabsJavascript.substring(0,tabsJavascript.length-1);
	    		tabsJavascript += '\r\n\t\t\t},';

	    	});

			tabsJavascript = tabsJavascript.substring(0,tabsJavascript.length-1);

	    	tabsJavascript += '\r\n\t\t],';
	    }

    	
    	//Plugin Javascript-------------------

    	pluginJavascript += tabsJavascript;

    	jQuery(".dream-plugin-option.loop").each(function(){

			$input = jQuery(this).find("input");
			if(null==$input || $input.length==0) {
				//select box present
				$select = jQuery(this).find("select");
				//simple select
				if($select.val()=="true"||$select.val()=="false") {
					pluginJavascript += '\r\n\t\t"'+$select.data("name")+'":'+$select.val()+',';
				} else {
					pluginJavascript += '\r\n\t\t"'+$select.data("name")+'":"'+$select.val()+'",';
				}
			} else {
				//input box present
				attributeValue = $input.val().replace(/"/g,"\\\"");
				attributeValue = attributeValue.replace(/'/g,"\\\"");
				
				if($input.val().indexOf("[")!=-1 && $input.val().indexOf("]")!=-1) {
					pluginJavascript += '\r\n\t\t"'+$input.data("name")+'":'+attributeValue+',';
				} else {
					pluginJavascript += '\r\n\t\t"'+$input.data("name")+'":"'+attributeValue+'",';
				}
			}

    	});

    	pluginJavascript = pluginJavascript.substring(0,pluginJavascript.length-1);
		pluginJavascript += '\r\n\t}';

		return pluginJavascript;

	}


	function createColorPickers() {

		jQuery('.dream-color-picker').each(function() {

			if(!jQuery(this).hasClass('dream-spectrum')) {

				jQuery(this).spectrum({
					showAlpha: true,
					showInput: true,
					preferredFormat: "rgb",
					showButtons: false,
					move: function(tinycolor) {
						jQuery(this).val(tinycolor.toRgbString());
					}
				});

				jQuery(this).addClass('dream-spectrum');

			}

		});

	}



    function addSlide(name,type,link) {

		slideHtml = '<div class="dream-slide">';
		slideHtml += '<div class="dream-slide-option type"><span>WHAT do you want to display?</span><select data-name="type" class="youmax-source-select"><option value="youtube-channel-uploads" selected>YouTube Uploads of a Channel</option><option value="youtube-playlist-videos">YouTube Videos from a PLaylist</option><option value="youtube-channel-playlists" >YouTube Playlists of a Channel</option><option value="vimeo-user-videos" >Vimeo Videos of a User</option></select></div>';
		slideHtml += '<div class="dream-slide-option link"><span>YouTube Channel Link</span><input type="text" data-name="link" value="'+link+'" /></div>';
		slideHtml += '<div class="dream-slide-option name"><span>Any Unique Name</span><input type="text" data-name="name" value="'+name+'" /></div>';
				
		slideHtml += '<div class="dream-remove-data"><i class="fa fa-times-circle"></i>Remove Source</div>';
		slideHtml += '</div>';

		$slide = jQuery(slideHtml);

    	jQuery(".dream-data").append($slide);

    	$slide.find(".youmax-source-select").val(type);

    }


    function updateLinkType($select) {
    	
    	var $slide = $select.parents(".dream-slide");

    	var type = $select.val();
		
		if(type=="youtube-playlist-videos") {
			$slide.find(".dream-slide-option.link span").text("YouTube Playlist Link");
		} else if(type=="vimeo-user-videos") {
			$slide.find(".dream-slide-option.link span").text("Vimeo User Link");
		} else {
			$slide.find(".dream-slide-option.link span").text("YouTube Channel Link");
		}

    }



	function setOptions(postId,postTitle,postShortcode,options) {

		//set Instance ID
		jQuery(".youmax-code-wrapper").attr("id",postId);

		//set Instance Name
		jQuery("#youmax_post_title").val(postTitle);

		//set Shortcode
		jQuery("#youmax-small-code").text(postShortcode);

		//set Tabs
		{
			//multiple mode
			jQuery(".dream-slide").remove();
			for(var i=0; i<options.tabs.length; i++) {
				addSlide(options.tabs[i].name,options.tabs[i].type,options.tabs[i].link);	
			}

		}

		//set Options
		for (var key in options) {
			if (options.hasOwnProperty(key)) {
				value = options[key];
				$input = jQuery(".dream-plugin-option").find("[data-name='"+key+"']");

				if(value.constructor===Array) {
					$input.val("["+options[key].toString()+"]");
				} else {
					$input.val(options[key].toString());	
				}
				
			}
		}

	}


	function youmaxSaveShortcode() {
		
		jQuery('#youmax-save-shortcode').prop('disabled', true).addClass('youmax-disabled');
		
		var post_id = jQuery('.youmax-code-wrapper').attr('id');
		var post_content = generateShortcode();
		var post_title = jQuery('#youmax_post_title').val();
		
		if(null==post_title || post_title=="") {
			jQuery('#youmax-save-shortcode').prop('disabled', false).removeClass('youmax-disabled');
			alert('Please enter a name for this Youmax Instance');
			jQuery('html, body').animate({scrollTop : 0},800);
			return;
		}
		
		if(null!=post_id && post_id!='' && post_id!='undefined') {
			action = 'youmax_update';
		} else {
			action = 'youmax_insert';
			post_id = '';
		}

		var data = {
			'action': action,
			'name': post_title,
			'shortcode': post_content,
			'id': post_id
		};

		jQuery.post(ajaxurl, data, function(response) {
			
			jQuery('#youmax-save-shortcode').prop('disabled', false).removeClass('youmax-disabled');

			if(response=='0') {
				alert('Could not Save');
				return;
			}

			console.log(response);
			
			alert('Your Youmax Instance has been Saved!');
			jQuery('#youmax-small-code').text('[youmaxpro id="'+response+'" name="'+post_title+'"]');
			jQuery('.youmax-code-wrapper').attr('id',response);

			jQuery('html, body').animate({scrollTop : 0},800);
		});
	}

