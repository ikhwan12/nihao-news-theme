
var YC = YC || {'channels':{}};
	YC.lang = {'aui': yrc_lang_terms.aui};
	
jQuery(document).ready(function($){
	YC.EM = YC.EM || $({});

	YC.template = function(selector){
		return _.template($(selector).html());
	};
	
	YC.post = function(data, success, error){
		$.ajax({
			url: 'admin-ajax.php',
			type: 'POST',
			data: data,
			dataType: 'json',
			success: success,
			error: error
		});
	};
	
	YC.channel = {};

	YC.channels.adminit = function(channel, key, is_new){
		YRC.merge(channel, YC.dummy);
		//console.log( YRC.copy(channel), YRC.copy(YC.dummy) );
		if(!is_new) YRC.merge(channel, YC.dummy);
		channel.social = channel.social || {};
		YC.channel.data = channel;
		YC.channel.key = key;
		
		$('.yrc-content, #yrc-lang-form').addClass('wpb-hidden');
		$('#yrc-editor').html( YC.template('#yrc-form-tmpl')( YC.channel.data )).removeClass('wpb-hidden');
						
		YC.EM.trigger('yc.form');
		
		$('.yrc-theme').each(function(){
			YC.toggleThemeOptions($(this).children('.pbc-row-field'), channel.style.theme[$(this).data('theme')].style);
		});
						
		$('#yrc-live').removeClass('wpb-hidden');
		YC.channel.setup = new YRC.Setup(0, YC.channel.data, $('#yrc-live'));
	};
	
	YC.redraw = function(){
		$('style.yrc-stylesheet').remove();
		$('#yrc-live').empty();
						
		YC.channel.setup = new YRC.Setup(0, YC.channel.data, $('#yrc-live'));
	};

	$('body').on('change', 'input[name=apikey]', function(e){
		YC.channel.data.meta.apikey = $(this).val().trim();
		YRC.auth.apikey = $(this).val().trim();
	});
	
	$('body').on('click', '#pbc-delete-form', function(e){
		$(this).text(YC.lang.aui.deleting+'...');
		YC.post({'action': 'yrc_delete', 'yrc_key': YC.channel.data.meta.key}, function(re){
			$('.pbc-down[data-down='+YC.channel.data.meta.key+']').remove();
			delete YC.channels[YC.channel.data.meta.key];
			YC.cleanForm();
			if( !YC.is_pro ) window.location.reload();
		});
	});

	$('body').on('click', '#yrc-get-channel-id', function(e){
		$('.pbc-form-message').text('').removeClass('pbc-form-error');
		if(!YC.channel.data.meta.apikey || YC.channel.data.meta.apikey.length != 39) return YC.formError('apikey');
		var user_box = $('#yrc-username'), channel_input = $('#yrc-channel');
			if(!user_box.val() && !channel_input.val()) return;
			
		YRC.auth.apikey = YRC.auth.apikey || YC.dummy.meta.apikey;	
		var uu = user_box.val() ? YRC.auth.baseUrl('channels?part=snippet,contentDetails,statistics&forUsername='+user_box.val().trim())
				: YRC.auth.baseUrl('channels?part=snippet,contentDetails,statistics&id='+channel_input.val().trim());
		ajax(uu, function(re){
			if(!re.items.length)
				$('#yrc-ac-error').text( (user_box.val() ? user_box.val() : channel_input.val()) + YC.lang.aui.does_not_exist ).addClass('pbc-form-error');
			else {
				if(user_box.val()) channel_input.val(re.items[0].id);
				else user_box.val(re.items[0].snippet.title.replace(/[\[\]']+/g,'-'));
				
				channel_input.val(re.items[0].id);
				YC.channel.data.meta.channel = re.items[0].id;
				YC.channel.data.meta.user = user_box.val();
				YC.channel.data.meta.channel_uploads = re.items[0].contentDetails.relatedPlaylists.uploads;
				YC.channel.data.meta.onlyonce = '';
				YC.redraw();
			}
		}, function(er){
			console.log(er);
		});
	});
	
	$('body').on('change', '#yrc-channel', function(e){ $('#yrc-username').val(''); });
	$('body').on('change', '#yrc-username', function(e){ $('#yrc-channel').val(''); });
	$('body').on('change', '#pbc-show-sections input', function(e){
		if(this.name === 'banner') $('#yrc-show-sub-button').toggleClass('wpb-force-hide');
		YC.channel.data.style[this.name] = this.checked ? true : '';
		//if(YC.channel.data.style.search_on_top) YC.channel.data.style.search = true;
		YC.redraw();
	});
	
	$('body').on('change', '.yrc-thumb-styles input', function(e){
		var i = this.name.match(/\d+/)[0], th = ['videos', 'playlists'][i];
				
		if(this.name.split('[')[0] === 'video_size')
			YC.channel.data.style.theme[th].thumb[0] = this.value;
		else 
			YC.channel.data.style.theme[th].thumb = [(this.value === 'adjacent' ? 'adjacent' : YC.channel.data.style.theme[th].thumb[0]), this.value];
		
		if(YC.channel.data.style.theme[th].thumb[1] === 'adjacent'){
			YC.channel.data.style.theme[th].thumb[0] = 'adjacent';
			jQuery('input[value=small]').eq(i).attr('checked', 'checked');
		} else {
			if(YC.channel.data.style.theme[th].thumb[0] === 'adjacent')
				YC.channel.data.style.theme[th].thumb[0] = 'small';
		}
		
		var items = $('.yrc-'+(th.substr(0, th.length-1))).length ? $('.yrc-'+(th.substr(0, th.length-1))) : $('.yrc-'+(th.substr(0, th.length-1))+'-item');
		
		items.removeClass('yrc-item-open yrc-item-none yrc-item-closed yrc-item-adjacent yrc-item-small yrc-item-large')
			.addClass('yrc-item-'+YC.channel.data.style.theme[th].thumb[0]+' yrc-item-'+YC.channel.data.style.theme[th].thumb[1]);	
			
		YC.channel.setup.size.resize();
	});
	
	$('body').on('change', '.yrc-theme-style', function(e){
		YC.toggleThemeOptions( $(this).parents('.pbc-row-field').eq(0), $(this).val() );
	});
	
	YC.noop = function(){};
	
	YC.toggleThemeOptions = function( th, style ){
		var sibs = th.find('div[data-show]').addClass('wpb-force-hide');
		sibs.each(function(){
			var d = $(this).data('show');
			if( (d.indexOf( style + '-PRO' ) > -1) && !YC.is_pro ) YC.noop();
			else
				if( d.indexOf( style ) > -1 )
					$(this).removeClass('wpb-force-hide');
		});
	};

	function ajax(url, success, error){
		$.ajax({
			type: 'GET',
			url: url,
			success: success,
			error: error
		});
	}
	
	function rawValues( inputs ){
		var o = {};
		inputs.each(function(){
			if(this.type === 'radio'){
				if(this.checked) o[this.name] = this.value;
			} else if (this.type === 'checkbox') {
				o[this.name] = this.checked ? 1 : '';
			} else o[this.name] = this.value;
		});
		return o;
	}

	$('body').on('submit', '#pbc-form', function(e){
		e.preventDefault();
		
		$('.yrc-theme').each(function(i){
			var th = ['videos', 'playlists'][i], vals = rawValues( $('input, select', $(this)));
			vals.thumb = [vals['video_size['+i+']'], vals['video_meta['+i+']']];
			
			delete vals['video_size['+i+']'];
			delete vals['video_meta['+i+']'];
			
			for( var key in vals ){
				var keys = key.split('-');
				if( keys[1] )
					YC.channel.data.style.theme[th][keys[0]][keys[1]] = vals[key];
				else 
					YC.channel.data.style.theme[th][keys[0]] = vals[key];
			}
		});
		if( !YC.is_pro ) delete YC.channel.data.style.theme.playlists;
				
		$('.pbc-form-message').text('').removeClass('pbc-form-error');
		if(!YC.channel.data.meta.user || !YC.channel.data.meta.channel|| !YC.channel.data.meta.apikey) 
			return YC.formError('invalid');
		
		var o = rawValues($('input.wpb-raw'));
		
		YC.channel.data.meta.cache = o.cache;
		YC.channel.data.style.player_mode = o.player_mode;
		YC.channel.data.style.truncate = o.truncate;
		YC.channel.data.style.rtl = o.rtl;
		YC.channel.data.style.thumb_margin = o.thumb_margin || 8;
		YC.channel.data.style.thumb_image_size = o.thumb_image_size;
		YC.channel.data.style.play_icon = o.play_icon;
		YC.channel.data.style.youtube_play_icon = o.youtube_play_icon;
		YC.channel.data.meta.onlyonce = o.onlyonce;
		YC.channel.data.meta.per_page = Math.min(parseInt( o.per_page ), 50);
		YC.channel.data.meta.maxv = (parseInt( o.maxv )||0);
		
		console.log(o.youtube_play_icon);
		
		YC.channel.data.style.sticky.enable = o.enable_sticky;
			
		YC.EM.trigger('yc.save', o);	
		
		$('.pbc-form-save .button-primary').text(YC.lang.aui.saving+'...');
		var is_new = (YC.channel.key === 'nw');
		
		delete YC.channel.data.meta.playlist;
		delete YC.channel.data.meta.search_own;
		
		YC.post({'action': 'yrc_save', 'yrc_channel': YC.channel.data}, function(re){
			if(!re) YC.formError('invalid');
			
			YC.channel.data.meta.key = re;
			YC.channels.list(YC.channel.data, is_new);
			
			YC.channels[re] = YC.channel.data;
			YC.cleanForm();
		});
	});
	
	YC.cleanForm = function(){
		delete YC.channels.nw;
		delete YC.channel.data;
		delete YC.channel.key;
		delete YC.channel.setup;
				
		$('style.yrc-stylesheet').remove();
		$('#yrc-editor, #yrc-live').empty();
		$('.yrc-content, #yrc-editor, #yrc-lang-form').toggleClass('wpb-hidden');
		$('#yrc-defined-css').addClass('wpb-hidden');
		$("html, body").animate({ scrollTop: 0 }, "slow");
	};
	
	YC.formError = function(code){
		var messages = {
			'apikey': YC.lang.aui.enter_api_key,
			'invalid': YC.lang.aui.invalid_inputs
		};
		$('.pbc-form-message').text( messages[code] ).addClass('pbc-form-error');
		return false;
	};
			
	YC.dummy = {
		'meta': {
			'user': 'schooloflifechannel',
			'channel': 'UC7IcJI8PUf5Z3zKxnZvTBog',
			'key': 'nw',
			'apikey': 'AIzaSyCEhi-95k6t1rX4pDVqugauM-UyTfNHj8Q',
			'cache': 180,
			'channel_uploads': '',
			'onlyonce': '',
			'tag':'',
			'per_page':24,
			'maxv':500
		},
		
		'style': {
			'colors': {
				'item': {
					'background': 'inherit'
				},
				'button': {
					'background': '#333',
					'color': '#fff'
				},
				'color': {
					'text': '#fff',
					'link': 'inherit',
					'menu': '#000',
					'meta': 'inherit'
				}
			},
			'theme': {
				'a': 1,
				'videos': {
					'style': '__grid',
					'thumb':['large', 'open'],
					'desc': '',
					"carousel":{"thumbs":4,"thumbs_to_slide":2,"spacing":8},
					"carousel_nav":{"modifier":"__sides","position":["left, none"],"location":"prepend","background":"#fff","color":"#000","font_size":2,"border_radius":0}
				}
			},
			'fit': false,
			'playlists': true,
			'uploads': true,
			'player_mode': 1,
			'truncate': 1,
			'rtl':'',
			'banner':true,
			'thumb_margin':8,
			'play_icon':'',
			'youtube_play_icon':'',
			'thumb_image_size':'medium',
			'default_tab': 'uploads',
			sticky:{
				enable:'',
				width: 400,
				position: 'bottom-right',
				only_above: 768,
				margin: 12
			}
		}
	};
			
	YC.lang.form_labels = {
		'Videos': 'Videos',
		'Playlists': 'Playlists',
		'Search': 'Search',
		'Loading': 'Loading',
		'more': 'more',
		'Nothing_found': 'Nothing found',
		'Prev': 'Previous',
		'Next': 'Next'
	};
			
	YC.lang.show = function(){
		if( !YRC.lang.form.Prev && YC.is_pro ){
			YRC.lang.form.Prev = 'Previous';
			YRC.lang.form.Next = 'Next';
		}
		$('#pbc-feedback').after( YC.template('#yrc-lang-form-tmpl')({'terms': YRC.lang.form}) );
	};
		
	$('body').on('submit', '#yrc-lang-form', function(e){
		e.preventDefault(); var fo = $(this);
		YRC.lang.form = rawValues(fo.find('input'));
		fo.find('button').text(YC.lang.aui.saving+'....');
		YC.post({'action': 'yrc_save_lang', 'yrc_lang': YRC.lang.form}, function(re){
			fo.find('button').text(YC.lang.aui.save);
		});
	});
	
	$('body').on('click', '#yrc-delete-terms', function(e){
		e.preventDefault(); var a = $(this);
		a.text(YC.lang.aui.clearing+'....');
		YC.post({'action': 'yrc_delete_lang'}, function(re){
			a.text(YC.lang.aui.clear);
			window.location.reload();
		});
	});
	
	$('body').on('click', '.pbc-front-form .pbc-front-form-header ', function(e){
		$(this).next().toggleClass('wpb-zero');
	});
	
	$('body').on('click', '.pbc-field-toggler', function(e){
		$(this).next().toggleClass('wpb-force-hide');
	});
	
	YC.channels.remove = function(d){
		$('#yrc-channels tbody tr[data-down="'+d.meta.key+'"]').remove();
	};
		
	YC.channels.list = function(d, is_new){
		if(is_new)
			$('#yrc-channels tbody').append( YC.template('#yrc-channel-tmpl')(d) );
		else	
			$('#yrc-channels tbody tr[data-down="'+d.meta.key+'"]').replaceWith( YC.template('#yrc-channel-tmpl')(d) );
	};

	YC.channels.createNew = function(){
		var dum = JSON.parse( JSON.stringify( YC.dummy ) );
		YC.channels['nw'] = dum;
		YC.channels.adminit( dum, 'nw', true );
	};

	YC.versionCheck = function(){
		if(!window.localStorage) return false;
		if(localStorage.getItem('yrc_version') != $('#yrc-wrapper').data('version')) YC.newVersionInfo();
	};
	
	YC.newVersionInfo = function(){
		$('#yrc-version-info').removeClass('wpb-hidden');
		YC.setVersion();
	};
	
	YC.setVersion = function(){
		localStorage.setItem('yrc_version', $('#yrc-wrapper').data('version'));
	};
	
	YC.channels.deploy = function( channels ){
		$('#yrc-init-loader').addClass('wpb-hidden');
		channels.forEach(function(channel){
			YC.channels[ channel.meta.key ] = channel;
			YC.channels.list(channel, true);
		});
		
		if(channels.length){
			YC.dummy.meta.apikey = channels[0].meta.apikey;
			$('#yrc-channels, #yrc-editor').toggleClass('wpb-hidden');
			YC.versionCheck();
		} else {
			YC.channels.createNew();
			YC.setVersion();
		}
		
		$('#yrc-channels').on('click', 'tr.pbc-down .pbc-edit', function(e){
			YC.channels.adminit( YC.channels[ $(this).data('down') ], $(this).data('down') );
		});
		
		$('#yrc-channels').on('click', 'tr.pbc-down .pbc-clear-cache', function(e){
			var channel = YC.channels[ $(this).data('down') ], button = $(this).attr('disabled', 'disabled');
			YC.post({'action': 'yrc_clear_cache', 'yrc_chhanel_key': channel.meta.key + channel.meta.tag}, function(re){	
				button.removeAttr('disabled');
			});
		});
		
		$('body').on('click', '#pbc-cancel-form', function(e){
			YC.cleanForm();
		});
		
		YC.EM.trigger('yc.deployed');
		YC.lang.show();
	};
		
	YC.channels.init = function(){
		YC.post({'action': 'yrc_get'}, function(re){		
			YC.channels.deploy(re.filter(function(r){ return r; }));
		});
		$('#yrc-wrapper').addClass('yrc-form-'+(YC.is_pro ? 'pro' : 'free')).append( YC.template('#yrc-main-tmpl') )
		YC.EM.trigger('yc.init');
	};

	YC.channels.init();

});
