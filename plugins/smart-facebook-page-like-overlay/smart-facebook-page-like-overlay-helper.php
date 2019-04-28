<?php

// if this file is called directly, abort
if ( ! defined( 'ABSPATH' ) ) exit;

class SMART_FBOVERLAY_HELPER {

    // options
    protected $url;
    protected $title;
    protected $dontshow;
    protected $afterlike;
    protected $delay_time;
    protected $cookie_lifetime;

    protected $selector;

    public function getUrl()            { return $this->url; }
    public function getTitle()          { return $this->title; }            // string
    public function getDontShow()       { return $this->dontshow; }         // string
    public function getAfterLike()      { return $this->afterlike; }        // string

    public function setUrl($url)               { $this->url = $url; }
    public function setTitle($title)           { $this->title = html_entity_decode($title); }
    public function setDontShow($dontshow)     { $this->dontshow = html_entity_decode($dontshow); }
    public function setAfterLike($afterlike)   { $this->afterlike = html_entity_decode($afterlike); }

    function __construct() {
        $this->getOptions();
    }

    protected function getOptions() {
      
      $this->selector        = 'body';
      $this->delay_time      = 15;
      $this->cookie_lifetime = 60;
      
      $options   = (array)get_option('wpfblikefree');
      if (isset($options['wpfblikefree_fbpage']))
        $this->url      = $options['wpfblikefree_fbpage'];
      else $this->url       = WPFBLIKE_FBPAGE_DEFAULT_VALUE;
      if (isset($options['wpfblikefree_title']))
         $this->title        = $options['wpfblikefree_title'];
      else $this->title     = WPFBLIKE_TITLE_DEFAULT_VALUE;
      if (isset($options['wpfblikefree_dontshow']))
         $this->dontshow    = $options['wpfblikefree_dontshow'];
      else $this->dontshow  = WPFBLIKE_DONTSHOW_DEFAULT_VALUE;
      if (isset($options['wpfblikefree_afterlike']))
         $this->afterlike   = $options['wpfblikefree_afterlike'];
      else $this->afterlike = WPFBLIKE_AFTERLIKE_DEFAULT_VALUE;
    }

    public function echoOverlay() { ?>
    <!-- Smart Facebook Page Like Overlay plugin -->
    <div class="dialog-social dialog-social-time dialog-social-center js-dialog" id="js-dialog-social-overlay">

    <div class="js-form-block">
        <!--FB-->
        <div class="js-block js-block-fb">
            <div class="dialog-social-header">
                <div class="dialog-social-title">
                    <a class="dialog-social-lnk" href="https://www.facebook.com/<?php echo $this->url; ?>" target="_blank">
                        <img src="<?php echo plugins_url( 'assets/fb-dialog-logo.png', __FILE__ ); ?>" alt="facebook"></a>
                    <div class="dialog-social-message-block-text js-title js-title-default" style="display:none;">
                        <?php echo $this->title; ?></div>
                    <div class="dialog-social-message-block-text js-title js-title-after-like" style="display:none;">
                        <?php echo $this->afterlike; ?></div>
                </div>
            </div>
            <div class="dialog-social-widgets">
                <div class="fb-like"
                    data-event-listener-id="js-dialog-social-overlay"
                    data-event-like="Subscribe"
                    data-ga-skip-trigger="1"
                    data-event-dislike="Unsubscribe"
                    data-ga-category="FacebookGroupOverlayNEW" data-ga-action="Subscribe"
                    data-href="https://www.facebook.com/<?php echo $this->url; ?>"
                    data-width="400"
                    data-layout="standard"
                    data-action="like"
                    data-show-faces="false"
                    data-share="false"
                    style="overflow:hidden!important;width:400px"
                >
                </div>
            </div>
        </div>

        <div class="dialog-social-auth">
            <a href="#" class="js-social-overlay-dont-show-me dialog-social-auth-link"><?php echo $this->dontshow; ?></a>
        </div>
    </div>

    <div class="js-message-block" style="display:none;">
        <div class="dialog-social-header">
            <div class="dialog-social-title dialog-social-message-block-title">
                <a class="dialog-social-lnk" href="https://www.facebook.com/<?php echo $this->url; ?>" target="_blank">
                    <img src="<?php echo plugins_url( 'assets/fb-dialog-logo.png', __FILE__ ); ?>" alt="facebook"></a>
                <div class="dialog-social-message-block-text"><?php echo $this->afterlike; ?></div>
            </div>
        </div>
    </div>
    </div>
    <!--// Smart Facebook Page Like Overlay plugin -->      
    <?php
    }
    
    public function getScriptVars() {
        $wpfblike_script_vars = array(
          'delay_time'            => __( $this->delay_time ),
          'cookie_lifetime'       => __( $this->cookie_lifetime ),

          'selector'              => __( $this->selector ),

          'Show_on_scroll_STRING'         => __('Show on scroll',WPFBLIKEFREE_PLUGIN_NAME),
          'Show_on_time_interval_STRING'  => __('Show on time interval',WPFBLIKEFREE_PLUGIN_NAME),
          'Its_time_to_show_STRING'       => __('It\'s time to show',WPFBLIKEFREE_PLUGIN_NAME),
          'Not_the_right_time_STRING'     => __('Not the right time to show',WPFBLIKEFREE_PLUGIN_NAME),
          'Closing_STRING'                => __('Closing',WPFBLIKEFREE_PLUGIN_NAME),
          'Loading_STRING'                => __('Loading',WPFBLIKEFREE_PLUGIN_NAME),
          'Cookie_set_STRING'             => __('Cookie set',WPFBLIKEFREE_PLUGIN_NAME),
          'disable_popups_STRING'         => __('Overlay impression was disabled by disable-popups attribute',WPFBLIKEFREE_PLUGIN_NAME),
          'does_not_have_content_STRING'  => __('Page does not have “content” element',WPFBLIKEFREE_PLUGIN_NAME),
          'does_not_contain_dialog_STRING'=> __('Page source does not contain dialog',WPFBLIKEFREE_PLUGIN_NAME),
          'Close_STRING'                  => __('Close',WPFBLIKEFREE_PLUGIN_NAME)
        );
        
        return $wpfblike_script_vars;
    }

    public function echoFBSDK() { ?>
        <div id="fb-root"></div>
        <script>
            (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/<?php echo get_locale(); ?>/sdk.js#xfbml=1&version=v2.5";
            fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

            var wpfblikefree_fbasync_interval = setInterval( function() {
                if (typeof FB == 'undefined') {} else
                if (window.wpfb_fbAsyncInit && !window.wpfb_fbAsyncInit.hasRun) {
                    window.wpfb_fbAsyncInit.hasRun = true;
                    window.wpfb_fbAsyncInit();
                    clearInterval(wpfblikefree_fbasync_interval);
                }
            },
            500 );
        </script> 
<?php
    }

}