<?php

/*
 * Copyright 2012-2018, Theia Post Slider, WeCodePixels, http://wecodepixels.com
 */

add_action('init', 'TpsContent::init');
add_action('the_post', 'TpsContent::the_post', 999999);
add_action('the_content', 'TpsContent::the_content', 999999);
add_filter('wp_title_parts', 'TpsContent::wp_title_parts', 10, 1);
add_filter('wpseo_title', 'TpsContent::wpseo_title', 10, 1);

class TpsContent
{
    // Set this to true to prevent the_content() from calling itself in an infinite loop.
    public static $theContentIsCalled = false;

    // Post data per post ID
    public static $postData = array();

    public static function init()
    {
        add_action('the_content', 'TpsContent::the_content_early', TpsOptions::get('the_content_early_priority'));
    }

    /*
     * We want to enable sliders only for the main post on a post page. This usually means that is_singular() returns true
     * (i.e. the query is for only one post). But, some themes have single queries used only to display the excerpts.
     * So, here we'll prepare the post for sliders, but these sliders will be activated only if the_content() is also
     * called.
     */
    public static function the_post($post)
    {
        if (
            TpsMisc::$force_disable ||
            !TpsMisc::is_compatible_post($post)
        ) {
            return;
        }

        global $page, $pages, $multipage;

        // If a page does not exist, display the last page.
        if ($page > count($pages)) {
            $page = count($pages);
        }

        // Get previous and next posts.
        $prevPost = TpsMisc::get_prev_next_post(true);
        $nextPost = TpsMisc::get_prev_next_post(false);

        /*
         * Prepare the sliders if
         * a) This is a single post with multiple pages.
         * - OR -
         * b) Previous/next post navigation is enabled and we do have a previous or a next post.
         */
        if (!($multipage || $prevPost || $nextPost)) {
            return;
        }

        // Save some variables that we'll also use in the_content().
        TpsContent::$postData[$post->ID] = array(
            'slideContainerId' => 'tps_slideContainer_' . $post->ID,
            'navIdUpper' => 'tps_nav_upper_' . $post->ID,
            'navIdLower' => 'tps_nav_lower_' . $post->ID,
            'prevPostId' => $prevPost,
            'nextPostId' => $nextPost,
            'prevPostUrl' => $prevPost ? get_permalink($prevPost) : null,
            'nextPostUrl' => $nextPost ? get_permalink($nextPost) : null
        );

        // Set this to false so that the theme doesn't display pagination buttons. Kind of a hack.
        $multipage = false;
    }

    public static function the_content_early($content)
    {
        if (!TpsMisc::$force_begin_and_end_comments && (
                TpsMisc::$force_disable ||
                !TpsMisc::is_compatible_post()
            )
        ) {
            return $content;
        }

        // Add strings to delimit the content.
        $content = TpsOptions::get_beginning_post_content_separator() . "\n" . $content . "\n" . TpsOptions::get_ending_post_content_separator();

        // Be sure that shortcodes are in their own paragraph.
        $shortcodes = array(
            TpsMisc::$begin_header_short_code,
            TpsMisc::$end_header_short_code,
            TpsMisc::$begin_title_short_code,
            TpsMisc::$end_title_short_code,
            TpsMisc::$begin_footer_short_code,
            TpsMisc::$end_footer_short_code
        );
        foreach ($shortcodes as $sc) {
            $content = str_replace($sc, "\n\n" . $sc . "\n\n", $content);
        }

        return $content;
    }

    /*
     * Append the JavaScript code only if the_content is called (i.e. the whole post is being displayed, not just the
     * excerpt).
     */
    public static function the_content($content)
    {
        global $post, $page, $pages;

        if (
            TpsMisc::$force_disable ||
            !TpsMisc::is_compatible_post() ||
            !isset($post) ||
            !self::havePostData($post->ID)
        ) {
            // Remove shortcodes.
            $content = str_replace(array(
                TpsMisc::$begin_header_short_code,
                TpsMisc::$end_header_short_code,
                TpsMisc::$begin_title_short_code,
                TpsMisc::$end_title_short_code,
                TpsMisc::$begin_footer_short_code,
                TpsMisc::$end_footer_short_code
            ), '', $content);

            return $content;
        }

        $postData = TpsContent::$postData[$post->ID];

        // Do not allow multiple instances, if enabled.
        if (TpsOptions::get('do_not_check_for_multiple_instances', 'tps_advanced') == false && in_array($post->ID, TpsMisc::$posts_with_slider) == true) {
            return $content;
        }

        // Prevent this function from calling itself.
        if (self::$theContentIsCalled) {
            return $content;
        }
        self::$theContentIsCalled = true;

        $currentPage = min(max($page, 1), count($pages));

        // Extract short codes. This needs to be done before splitting the content.
        {
            TpsMisc::$current_post_title = TpsShortCodes::extract_short_code($content, TpsMisc::$begin_title_short_code, TpsMisc::$end_title_short_code);

            if ($page == 1) {
                $contentToExtractHeaderFrom = &$content;
            } else {
                $contentToExtractHeaderFrom = &$pages[0];
            }
            $header = TpsShortCodes::extract_short_code($contentToExtractHeaderFrom, TpsMisc::$begin_header_short_code, TpsMisc::$end_header_short_code);
            $header = do_shortcode($header);

            if ($page == count($pages)) {
                $contentToExtractFooterFrom = &$content;
            } else {
                $contentToExtractFooterFrom = &$pages[count($pages) - 1];
            }
            $footer = TpsShortCodes::extract_short_code($contentToExtractFooterFrom, TpsMisc::$begin_footer_short_code, TpsMisc::$end_footer_short_code);
            $footer = do_shortcode($footer);
        }

        // Split the content.
        $split_content = TpsMisc::split_content($content);
        $content = $split_content['content'];

        // Fix broken HTML.
        if (TpsOptions::get('try_to_fix_broken_html')) {
            if (function_exists('tidy_repair_string')) {
                $content = tidy_repair_string($content, null, 'utf8');
            } else {
                // Include HTMLPurifier, unless it is autoloaded.
                if (!class_exists('HTMLPurifier')) {
                    $file = __DIR__ . '/vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';

                    if (is_file($file)) {
                        include_once $file;
                    }
                }

                $config = HTMLPurifier_Config::createDefault();
                $config->set('Core.Encoding', 'UTF-8');
                $config->set('HTML.TidyLevel', 'none');
                $config->set('HTML.Trusted', true);
                $config->set('Cache.DefinitionImpl', null);
                $config->set('Core.LexerImpl', 'DirectLex');
                $config->set('HTML.TargetNoreferrer', false);
                $purifier = new HTMLPurifier($config);

                $content = $purifier->purify($content);
            }
        }

        // Start adding HTML.
        $html = '';

        // Apply 'before' fiters.
        $html = apply_filters('tps_the_content_before', $html, $content);

        // Add slider HTML.
        {
            $html .= $split_content['beforeContent'];

            // Header
            if ($header) {
                $html .= '<div class="theiaPostSlider_header _header">' . $header . '</div>';
            }

            $html = apply_filters('tps_the_content_before_header', $html, $content);

            // Top slider
            if (in_array(TpsPostOptions::get($post->ID, 'nav_vertical_position', 'tps_nav'), array(
                'top_and_bottom',
                'top'
            ))) {
                $html .= TpsNavigationBar::get_navigation_bar(array(
                    'currentSlide' => $page,
                    'totalSlides' => count($pages),
                    'prevPostUrl' => $postData['prevPostUrl'],
                    'nextPostUrl' => $postData['nextPostUrl'],
                    'id' => $postData['navIdUpper'],
                    'class' => '_upper',
                    'title' => TpsMisc::$current_post_title
                ));
            }

            $html = apply_filters('tps_the_content_before_current_slide', $html, $content);

            // Current slide.
            $html .= '<div id="' . $postData['slideContainerId'] . '" class="theiaPostSlider_slides"><div class="theiaPostSlider_preloadedSlide">';
            $html .= "\n\n" . $content . "\n\n";
            $html .= '</div></div>';

            $html = apply_filters('tps_the_content_after_current_slide', $html, $content);

            // Bottom slider
            if (in_array(TpsPostOptions::get($post->ID, 'nav_vertical_position', 'tps_nav'), array(
                'top_and_bottom',
                'bottom'
            ))) {
                $html .= TpsNavigationBar::get_navigation_bar(array(
                    'currentSlide' => $page,
                    'totalSlides' => count($pages),
                    'prevPostUrl' => $postData['prevPostUrl'],
                    'nextPostUrl' => $postData['nextPostUrl'],
                    'id' => $postData['navIdLower'],
                    'class' => '_lower',
                    'title' => TpsMisc::$current_post_title
                ));
            }

            // Footer
            $html .= '<div class="theiaPostSlider_footer _footer">' . $footer . '</div>';

            $html .= $split_content['afterContent'];
        }

        $slides = array();
        // Preload slides.
        {
            $preloadBegin = $currentPage + 1;
            $preloadEnd = $currentPage;

            if (TpsPostOptions::get($post->ID, 'slide_loading_mechanism', 'tps_advanced') == 'all') {
                $preloadBegin = 1;
                $preloadEnd = count($pages);
            }

            if (TpsOptions::get('ad_refreshing_mechanism', 'tps_advanced') == 'page') {
                // Avoid AJAX request if the page refreshes every single slide.
                if (TpsOptions::get('refresh_ads_every_n_slides', 'tps_advanced') == 1) {
                    $preloadBegin = $currentPage + 1;
                    $preloadEnd = $currentPage;
                } else {
                    $preloadBegin = max($currentPage - TpsOptions::get('refresh_ads_every_n_slides', 'tps_advanced'), $preloadBegin);
                    $preloadEnd = min($currentPage + TpsOptions::get('refresh_ads_every_n_slides', 'tps_advanced'), $preloadEnd);
                }
            }

            // Validate values.
            $preloadBegin = max(1, $preloadBegin);
            $preloadEnd = min(count($pages), $preloadEnd);

            for ($i = $preloadBegin; $i <= $preloadEnd; $i++) {
                // If we don't need to pass the source, then don't get the current slide since it will be echoed as actual HTML.
                if (!TpsOptions::get('do_not_cache_rendered_html', 'tps_advanced') && $i == $currentPage) {
                    continue;
                }

                if (TpsOptions::get('ad_refreshing_mechanism', 'tps_advanced') == 'page') {
                    // Only get permalinks for the edge slides.
                    if (
                        $i == $currentPage - TpsOptions::get('refresh_ads_every_n_slides', 'tps_advanced') ||
                        $i == $currentPage + TpsOptions::get('refresh_ads_every_n_slides', 'tps_advanced')
                    ) {
                        $slides[$i - 1] = array(
                            'permalink' => TpsMisc::get_post_page_url($i)
                        );

                        continue;
                    }
                }

                // Get the entire slide.
                $slides[$i - 1] = TpsMisc::get_sub_page($i, $currentPage);
            }
        }

        // Append the slider initialization script to the "theiaPostSlider.js" script.
        if (TpsPostOptions::get($post->ID, 'slide_loading_mechanism', 'tps_advanced') != 'refresh') {
            $sliderOptions = array(
                'slideContainer' => '#' . $postData['slideContainerId'],
                'nav' => array('.theiaPostSlider_nav'),
                'navText' => TpsOptions::get('navigation_text'),
                'helperText' => TpsOptions::get('helper_text'),
                'defaultSlide' => $currentPage - 1,
                'transitionEffect' => TpsOptions::get('transition_effect'),
                'transitionSpeed' => (int)TpsOptions::get('transition_speed'),
                'keyboardShortcuts' => (TpsMisc::is_compatible_post() && !TpsOptions::get('disable_keyboard_shortcuts', 'tps_nav')) ? true : false,
                'scrollAfterRefresh' => TpsOptions::get('scroll_after_refresh'),
                'numberOfSlides' => count($pages),
                'slides' => $slides,
                'useSlideSources' => TpsOptions::get('do_not_cache_rendered_html', 'tps_advanced'),
                'themeType' => TpsOptions::get('theme_type'),
                'prevText' => TpsOptions::get('prev_text'),
                'nextText' => TpsOptions::get('next_text'),
                'buttonWidth' => TpsOptions::get('button_width'),
                'buttonWidth_post' => TpsOptions::get('button_width_post'),
                'postUrl' => get_permalink($post->ID),
                'postId' => $post->ID,
                'refreshAds' => TpsOptions::get('refresh_ads', 'tps_advanced'),
                'refreshAdsEveryNSlides' => TpsOptions::get('refresh_ads_every_n_slides', 'tps_advanced'),
                'adRefreshingMechanism' => TpsOptions::get('ad_refreshing_mechanism', 'tps_advanced'),
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'loopSlides' => TpsOptions::get('button_behaviour', 'tps_nav') === 'loop',
                'scrollTopOffset' => TpsOptions::get('scroll_top_offset', 'tps_nav'),
                'hideNavigationOnFirstSlide' => TpsPostOptions::get($post->ID, 'nav_hide_on_first_slide'),
                'isRtl' => is_rtl(),
                'excludedWords' => explode("\n", str_replace("\r", '', TpsOptions::get('excludedWords')))
            );

            if (TpsOptions::get('theme_type') == 'font') {
                $sliderOptions['prevFontIcon'] = TpsOptions::get_font_icon(is_rtl() ? 'right' : 'left');
                $sliderOptions['nextFontIcon'] = TpsOptions::get_font_icon(is_rtl() ? 'left' : 'right');
            }

            if (TpsOptions::get('button_behaviour') === 'post') {
                $sliderOptions = array_merge($sliderOptions, array(
                    'prevPost' => $postData['prevPostUrl'],
                    'nextPost' => $postData['nextPostUrl'],
                    'prevText_post' => TpsOptions::get('prev_text_post'),
                    'nextText_post' => TpsOptions::get('next_text_post')
                ));
            }

            // Trigger ready/load events when navigating to another slide.
            $onChangeSlide = '';
            if (TpsOptions::get('window_load_js')) {
                $onChangeSlide .= "$(window).load();";
            }
            if (TpsOptions::get('document_ready_js')) {
                $onChangeSlide .= "$(document).ready();";
            }
            if (TpsOptions::get('domcontentloaded_js')) {
                $onChangeSlide .= "var DOMContentLoaded_event = document.createEvent(\"Event\"); DOMContentLoaded_event.initEvent(\"DOMContentLoaded\", true, true); window.document.dispatchEvent(DOMContentLoaded_event);";
            }
            if (TpsOptions::get('document_resize_js')) {
                $onChangeSlide .= "$(document).resize();";
            }
            if (TpsOptions::get('document_scroll_js')) {
                $onChangeSlide .= "$(document).scroll();";
            }

            $html .= "<div data-theiaPostSlider-sliderOptions='" . htmlspecialchars(json_encode($sliderOptions), ENT_QUOTES) . "' 
					 data-theiaPostSlider-onChangeSlide='" . htmlspecialchars(json_encode($onChangeSlide), ENT_QUOTES) . "'></div>";

            // Mark the post as having a slider.
            TpsMisc::$posts_with_slider[] = $post->ID;
        }

        // Apply 'after' fiters.
        $html = apply_filters('tps_the_content_after', $html, $content);

        self::$theContentIsCalled = false;

	    return $html;
    }

    public static function wp_title_parts($title_array)
    {
        if (!TpsOptions::get('override_subtitles')) {
            return $title_array;
        }

        global $post, $page, $pages;

        // Only override subpages, not the first page.
        if ($page == 1) {
            return $title_array;
        }

        // Get [tps_title] content of the curent page, if available.
        setup_postdata($post);
        $content = $pages[$page - 1];
        $title = TpsShortCodes::extract_short_code($content, TpsMisc::$begin_title_short_code, TpsMisc::$end_title_short_code, false);
        if ($title) {
            $title_array[0] = strip_tags($title);

            return $title_array;
        }

        // Return unchanged title.
        return $title_array;
    }

    public static function wpseo_title($wpseo_title)
    {
        if (!TpsOptions::get('override_subtitles')) {
            return $wpseo_title;
        }

        global $post, $page, $pages;

        // Only override subpages, not the first page.
        if ($page == 1) {
            return $wpseo_title;
        }

        // Get [tps_title] content of the curent page, if available.
        setup_postdata($post);
        $content = $pages[$page - 1];
        $title = TpsShortCodes::extract_short_code($content, TpsMisc::$begin_title_short_code, TpsMisc::$end_title_short_code, false);
        if ($title) {
            $wpseo_title = str_replace($post->post_title, $title, $wpseo_title);

            return $wpseo_title;
        }

        // Return unchanged title.
        return $wpseo_title;
    }

    public static function havePostData($postId) {
		return array_key_exists($postId, TpsContent::$postData);
    }
}