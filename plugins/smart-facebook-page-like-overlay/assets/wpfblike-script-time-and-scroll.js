(function($) {
    $(function() {

        const DEBUG_MESSAGES = false;

        function debugMessage() {
            if (DEBUG_MESSAGES) {
                var finalMessage="";
                for (var i=0; i<arguments.length; i++)
                    finalMessage = finalMessage + " " + arguments[i];
                console.log(finalMessage);
            }
        }

        // social overlay dialog
        var TYPE_DEFAULT = 'default';
        var TYPE_AFTER_LIKE = 'after-like';
        var COOKIE_NAME_FB = 'social.overlay.fb.status';
        var COOKIE_NAME_VK = 'social.overlay.vk.status';
        var COOKIE_VALUE_DISABLED = 'disabled';
        var COOKIE_VALUE_CLOSED = 'closed';
        var STORAGE_KEY_PROVIDER = 'social.overlay.provider';
        var STORAGE_KEY_COUNTER = 'social.overlay.counter';
        var MIN_PAGE_COUNT = 1;
        var DELAY_TIME = wpfblike_script_data.delay_time*1000; // до первого показа
        var JQUERY_SELECTOR = wpfblike_script_data.selector;
        var cookiesLifetimes = {}; // время жизни кук в днях
        cookiesLifetimes[COOKIE_VALUE_DISABLED] = 365; // 1 год
        cookiesLifetimes[COOKIE_VALUE_CLOSED] = 1.*wpfblike_script_data.cookie_lifetime/24/60; 
        var providersCookies = {};
        providersCookies[Social.PROVIDER_FACEBOOK] = COOKIE_NAME_FB;
        providersCookies[Social.PROVIDER_VKONTAKTE] = COOKIE_NAME_VK;

        var categoryPostfix = $('body.mobile').length ? 'Mobile' : '';

        var dialogPrefix = 'dialog-social-';
        var dialog = $('#js-dialog-social-overlay');

        var socialButtons = $('#js-article-social-buttons');

        var repeaterWorks = false;

        
        var readyToAnimate = true,
            shownFlag = false,
            isVisible = false;            


        var JQUERY_SELECTOR = wpfblike_script_data.selector;    

        var articleContent = $(JQUERY_SELECTOR);

        var viewportHeight;
        if (document.compatMode === 'BackCompat') {
            viewportHeight = document.body.clientHeight;
        } else {
            viewportHeight = document.documentElement.clientHeight;
        }

        if (!dialog.length) {            
            debugMessage(wpfblike_script_data.does_not_contain_dialog_STRING);
            return;
        }

        if (!articleContent.length) {
            debugMessage(wpfblike_script_data.does_not_have_content_STRING+' ('+JQUERY_SELECTOR+')');
            return;
        }

        if ($(JQUERY_SELECTOR).data('disable-popups')) {
            debugMessage(wpfblike_script_data.disable_popups_STRING);
            return;
        }

        function init() {
            dialog.bind('social.' + Social.ACTION_SUBSCRIBE, function() {
                setCookie(dialog.data('provider-cookie'), COOKIE_VALUE_DISABLED);
                debugMessage(wpfblike_script_data.Cookie_set_STRING+' (disabled)');

                dialog.data('force-close', true); // после лайка мы сами закрываем диалог и говорим пользователю что он великолепен
                dialog.find('.js-form-block').hide();
                dialog.find('.d-close').hide();
                dialog.find('.js-message-block').show();

                setTimeout(function() {
                    dialog.dialogClose();
                }, 2500);
            });

            dialog.bind('social.' + Social.ACTION_UNSUBSCRIBE, function() {
                // тут допускаем случайные клики по дислайку
                // поэтому не предпринимаем никаких действий
                // setCookie(dialog.data('provider-cookie'), COOKIE_VALUE_CLOSED);
                // debugMessage(wpfblike_script_data.Cookie_set_STRING+' (closed)');
            });

            dialog.bind('dialog-close', function(e) {
                if (!dialog.data('force-close')) { // force-close выставляется в true если пользователь залайкал группу или нажал "спасибо, я уже с вами..."
                    setCookie(dialog.data('provider-cookie'), COOKIE_VALUE_CLOSED);
                    debugMessage(wpfblike_script_data.Cookie_set_STRING+' (closed)');
                }
                dialog.data('opened', false);
            });

            // собственный биндинг
            dialog.find('.js-social-overlay-dont-show-me').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                setCookie(dialog.data('provider-cookie'), COOKIE_VALUE_DISABLED);
                
                debugMessage(wpfblike_script_data.Cookie_set_STRING+' (disabled)');
                
                dialog.data('force-close', true);
                dialog.dialogClose();
            });
        }

        function initDelayedOverlay() {

            if (hasAnyCookie()) {
                setRepeater();
                // debugMessage('set repeater');
                return;
            }

            var provider = detectProvider();
            if (checkLocalStorageSupport()) {
                var count = localStorage.getItem(STORAGE_KEY_COUNTER) || 0;
                count++;
                if (count < MIN_PAGE_COUNT) {
                    localStorage.setItem(STORAGE_KEY_PROVIDER, provider);
                    localStorage.setItem(STORAGE_KEY_COUNTER, count);
                    return;
                }
            }

            if (provider == Social.PROVIDER_FACEBOOK) {
                $(document).bind('social.fb.loaded', function(ev) {

                    setTimeout(function() {
                        if (hasAnyCookie()) {
                            return;
                        }

                        if (!dialog.data('opened')) {
                            debugMessage (wpfblike_script_data.Its_time_to_show_STRING);
                            openDialog(provider, TYPE_DEFAULT);
                        }

                        setRepeater();

                    }, DELAY_TIME);
                });
            } else {
                setTimeout(function() {
                    if (hasAnyCookie()) {
                        return;
                    }

                    openDialog(provider, TYPE_DEFAULT);

                    setRepeater();
                    // debugMessage('set repeater');

                }, DELAY_TIME);
            }
        }


        function initLikeButtonsOverlay() {

            socialButtons.bind('social.' + Social.ACTION_SHARE, function(e, provider) {
                if (providersCookies[provider] == undefined || getCookie(providersCookies[provider]) == COOKIE_VALUE_DISABLED) {
                    return;
                }
                openDialog(provider, TYPE_AFTER_LIKE);
            });
            // хак для отлова закрытия фэйсбучного диалога шаринга
            socialButtons.bind('social.' + Social.ACTION_LIKE, function(e, provider) {
                if (provider != Social.PROVIDER_FACEBOOK) {
                    return;
                }
                var timer;
                timer = setInterval(function() {
                    if (!$('iframe.fb_iframe_widget_lift').length) {
                        socialButtons.trigger('social.' + Social.ACTION_SHARE, Social.PROVIDER_FACEBOOK);
                        clearInterval(timer);
                    }
                }, 1000);
            });
        }

        function openDialog(provider, type) {
            // открываем только один раз
            if (dialog.data('opened')) {
                return;
            }
            if (!type) {
                type = TYPE_DEFAULT;
            }
            var cookieName = providersCookies[provider];
            // var category = providersCategories[provider] + typeCategorySuffixes[type] + categoryPostfix;

            dialog.removeClass(dialogPrefix + Social.PROVIDER_VKONTAKTE);
            dialog.removeClass(dialogPrefix + Social.PROVIDER_FACEBOOK);
            dialog.addClass(dialogPrefix + provider);
            dialog.data('opened', true);
            dialog.data('provider-cookie', cookieName);

            dialog.find('.js-block').hide();
            dialog.find('.js-block-' + provider).show();
            dialog.find('.js-message-block').hide();
            dialog.find('.js-form-block').show(); // форма с лайком
            dialog.find('.d-close').show(); // кнопка закрытия окна
            dialog.find('.js-title').hide();
            dialog.find('.js-title-' + type).show();
            dialog.dialogOpen({
                'closable': false
            });

        }

        function getCookie(name) {
            return $.cookie(name);
        }

        function setCookie(name, value) {
            // debugMessage("cookie",name,value);
            $.cookie(name, value, {
                expires: cookiesLifetimes[value],
                path: '/'
            });
        }

        function hasAnyCookie() {
            return getCookie(COOKIE_NAME_FB) || getCookie(COOKIE_NAME_VK);
        }

        function checkLocalStorageSupport() {
            try {
                return 'localStorage' in window && window['localStorage'] !== null;
            } catch (e) {
                return false;
            }
        }

        function detectProvider() {
            var provider = 'fb';
            if (/^https?:\/\/[^\/]*facebook\.com/i.test(document.referrer)) {
                provider = 'fb';
            } else if (/^https?:\/\/[^\/]*vk\.com/i.test(document.referrer)) {
                provider = 'vk';
            } else if (checkLocalStorageSupport() && localStorage.getItem(STORAGE_KEY_PROVIDER)) {
                provider = localStorage.getItem(STORAGE_KEY_PROVIDER);
            }
            return provider;
        }


        function setRepeater() {

            if (repeaterWorks) return;

            // debugMessage("Repeater starts");

            repeaterWorks = true;

            // Раз в 5 секунд проверка, не сдохли ли куки.
            // Если сдохли, то показывает диалог снова
            setInterval(function() {
                if (hasAnyCookie()) {
                    if (dialog.data('opened')) debugMessage (wpfblike_script_data.Not_the_right_time_STRING);
                    return;
                }
                
                if (!dialog.data('opened')) debugMessage (wpfblike_script_data.Its_time_to_show_STRING);
                openDialog(detectProvider(), TYPE_DEFAULT);

            },5000);

        }


        init();

        debugMessage(wpfblike_script_data.Show_on_time_interval_STRING);
        initDelayedOverlay();

        initLikeButtonsOverlay();


    });
})(jQuery);
