

var YRS = {};

(function($){
	
	YRS.openWindow = function( values, entity ) {
		$('body').fPopup();
		$('.frames-p-content').html( _.template( $('#yrc-shortcode-instructions').html() ) );
		
		$('.frames-p-shell').css('height', function(){
			return $('.frames-p-content').height()
		});
		
		$('.yrc-ics-set > div, .yrc-ics-set ul').addClass('pb-hidden');
		
		if( yrc_server_vars.is_pro ) $('.yrc-ics-pro').removeClass('yrc-ics-pro');
		
		$('body').on('click', '.yrc-ics h3, .yrc-ics h4', function(e){
			$(this).next().toggleClass('pb-hidden');
		});
	};	
	
	$.fn.fPopup = function(){
		this.each(function(){
			
			$('body').append([
				'<div class="frames-popup pb-force-hid">',
					'<div class="frames-p-shell">',
						'<div class="frames-popup-bar pb-clr">',
							'<span class="frames-popup-title pb-float-left"></span>',
							'<span class="frames-closer pb-float-right"><span class="frames-close">X<span/></span></div>',
						'<div class="frames-p-content"><div class="frms-loading">Loading...</div></div>',
					'</div>',
				'</div>'].join(''));
												
			var th = 400;
			
			$(this).find('.frames-p-shell').css( {'width': '50%', 'height': th, 'margin': function(){
					var sl = $(this),
						wh =  ($(window).height() - (th))/2;
						
					sl.css('height',  th)
						.parent().css('height', $(document).outerHeight());
																	
					return jQuery(window).scrollTop() + (  wh > 0 ? wh : 20 ) + 'px auto auto auto';
				}
			});
			
		});
	};
	
	function fpclose(){
		$('.frames-popup').remove();
	}
			
	$('body').on('click', '.frames-closer', fpclose);	
	
	$('body').on('click', '#yrs-opener', function(e){
		e.preventDefault();
		YRS.openWindow();
	});	
	
	
	//YRS.openWindow();
	
	
})(jQuery);
