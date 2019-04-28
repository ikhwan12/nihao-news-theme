var smartFBAdapt = function(i, width) {
  if ( width < 760 ) {
    var leftPad = (width - 300) / 2 + 220;

    jQuery('.dialog-social')
      .css('top', '60%')
        .css('left', leftPad + 'px')
          .css('width', '300px')
            .css('position', 'fixed')
              .css('bottom', '')
                .css('right', '')
                  .removeClass('dialog-social-bottom-right dialog-social-bottom-left dialog-social-top-right dialog-social-top-left');

    jQuery('.dialog-social-widgets .fb-like').attr('data-width', '270');
    jQuery('.dialog-social-widgets .fb-like').css('width', '270px');
    jQuery('.dialog-social-widgets .fb-like span').css('width', '270px');
  } else {
    jQuery('.dialog-social')
      .css('left', '50%')
        .css('width', '445px');
  }
};

var ADAPT_CONFIG = {
  dynamic: true,
  callback: smartFBAdapt,
  range: [
    '0    to 760',
  ]
};

(function($) {
    
    var _dialogBg = $('<div class="dialog-bg"/>');
    var closable = true;
    _dialogBg.click(function(event) {
        event.preventDefault();
    });
    _dialogBg.appendTo('body');

    $(document).keydown(function(event) {
        if (event.which == 27 && closable === true) {
            _dialogCloseAll();
            _dialogBgHide();
        }
    });

    $.fn.dialogOpen = function(options) {
        if (options !== undefined && options.closable !== undefined) {
            closable = options.closable;
        }

        _dialogBgShow();
        _dialogCloseAll();
        _dialogOpen(this, options);
    };

    $.fn.dialogClose = function() {
        _dialogClose(this);
        _dialogBgHide();

        closable = true;
    };

    function _dialogBgShow() {
        if (_dialogBg.is(':hidden')) {
            _dialogBg.fadeIn(200);
        }
    }

    function _dialogBgHide() {
        if (_dialogBg.is(':visible')) {
            _dialogBg.fadeOut(200);
        }
    }

    function _dialogOpen(_dialog, options) {
        var _data = _dialog.data();
        _dialog.data($.extend({
            url: '',
            lrpc: '',
            data: '',
            type: 'POST'
        }, _dialog.data(), options));

        if (!_data.inited) {
            var _close = $('<div class="d-close" title="'+wpfblike_script_data.Close_STRING+'"/>');
            _close.click(function(event) {
                _dialog.dialogClose();
                event.preventDefault();
            });
            _close.prependTo(_dialog);
            _data.inited = true;
        }

        if ((_data.url || _data.lrpc) && !_data.loaded) {
            var _rotater = $('<div class="rotater"/>');
            $.ajax({
                url: _data['url'] ? _data.url : '?LRPC=' + _data.lrpc,
                data: _data.data,
                type: _data.type,
                dataType: 'html',
                beforeSend: function() {
                    _rotater.appendTo(_dialog).show();
                },
                success: function(data) {
                    _rotater.remove();
                    _dialog.append(data);
                    _data.loaded = true;
                },
                error: function() {
                    alert(__('Couldn\'t load data. Try again later.'));
                    _rotater.remove();
                    _dialog.dialogClose();
                }
            });
        }

        if (_dialog.hasClass('dialog-absolute')) {
            $(document).scrollTop(0);
        }

        if (_dialog.hasClass('dialog-mobile')) {
            var offsetTop = Math.round($(document).scrollTop() + ($(window).height() - _dialog.outerHeight()) / 2);
            _dialog.css('top', Math.max(offsetTop, 0) + 'px');
        } else if (isIpadOrIphone() && _dialog.css('position') == 'fixed' && _dialog.find('input').length) {
            // for ipad bug with keyboard make all overlays with input an absolute
            _dialog.css('position', 'absolute');
            _dialog.css('top', $(window).height() / 2); // assumes all fixed dialogs is 50%
            _dialog.css('left', $(window).width() / 2); // assumes all fixed dialogs is 50%
        }
        _dialog.removeClass('dialog-hidden');
        _dialog.fadeIn(200, function() {
            if (_data.setFocusTo && !isIpadOrIphone()) {
                _dialog.find(_data.setFocusTo).focus();
            }
            _dialog.trigger('dialog-open');
        });
    };

    function _dialogClose(_dialog) {
        _dialog.fadeOut(200, function() {
            _dialog.trigger('dialog-close');
        });
    };

    function _dialogCloseAll() {
        $('.js-dialog:visible').each(function(i, item) {
            _dialogClose($(item));
        });
    };

    function isIpadOrIphone() {
        return navigator.userAgent.indexOf('iPad') > -1 || navigator.userAgent.indexOf('iPhone') > -1;
    }

    window.wpfb_fbAsyncInit = function() {

      FB.init({
        xfbml      : true,
        version    : 'v2.5'
      });

      var handleAction = function(item, action, provider) {
        if (item.length && item.data('ga-category')) {

          if (item.data('event-listener-id')) {
            var eventListener = jQuery('#' + item.data('event-listener-id'));
            eventListener.trigger('social.' + action, provider);
          }

        }
      };

      FB.Event.subscribe('edge.create', function(url, htmlElement) {
        handleAction(jQuery(htmlElement), jQuery(htmlElement).data('event-like') ? jQuery(htmlElement).data('event-like') : Social.ACTION_LIKE, Social.PROVIDER_FACEBOOK);
      });

      FB.Event.subscribe('edge.remove', function(url, htmlElement) {
        handleAction(jQuery(htmlElement), jQuery(htmlElement).data('event-dislike') ? jQuery(htmlElement).data('event-dislike') : Social.ACTION_DISLIKE, Social.PROVIDER_FACEBOOK);
      });

      FB.Event.subscribe('xfbml.render', function() {
        jQuery(document).trigger('social.fb.loaded');
      });
    };

})(jQuery);


(function($) {
    $(function() {
        var Social = {
            ACTION_LIKE: 'Like',
            ACTION_DISLIKE: 'Dislike',
            ACTION_SHARE: 'Share',
            ACTION_UNSHARE: 'Unshare',
            ACTION_SUBSCRIBE: 'Subscribe',
            ACTION_UNSUBSCRIBE: 'Unsubscribe',
            ACTION_CLOSE: 'Close',
            ACTION_SHOWN: 'Shown',
            ACTION_HAPPY: 'HappyUser',
            PROVIDER_FACEBOOK: 'fb',
            PROVIDER_VKONTAKTE: 'vk',
            PROVIDER_TWITTER: 'tw'
        };

        window.Social = Social;
    });
})(jQuery);

