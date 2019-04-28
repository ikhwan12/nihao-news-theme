jQuery(document).ready(function( $ ) {}); // allow normal jQuery accessor

function showJob( apid ) {
	jQuery('#jhwpjp_jobs').hide();
	jQuery("div.jobDesc").hide();
	jQuery('#' + apid ).show();
}

jQuery(function(){

	jQuery(window).on('hashchange',function()
	{ 
		var apid = location.hash.slice(1);
		if( apid != "" ) {
			showJob( apid );
		} else {
			jQuery("div.jobDesc").hide();
			jQuery('#jhwpjp_jobs').show();
		}
	});

	jQuery(window).on('load',function()
	{ 
		var apid = location.hash.slice(1);
		if( apid != "" ) {
			showJob( apid );
		} else {
			jQuery("div.jobDesc").hide();
			jQuery('#jhwpjp_jobs').show();
		}
	}); 

});

function ApplyModal( url )
{
	var h = 425;
	var w = 430;
	
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    var newWindow = window.open(url,'ApplyModal','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=' + w + ',height=' + w + ',top=' + top + ',left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {
        newWindow.focus();
    }	
}

