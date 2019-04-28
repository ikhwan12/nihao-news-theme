<?php

add_action('init','propanel_of_options');

if (!function_exists('propanel_of_options')) {
function propanel_of_options(){

//Theme Shortname
$shortname = "mvp";

//Populate the options array
global $tt_options;
$tt_options = get_option('of_options');

if ( is_admin() ) {

//Access the WordPress Pages via an Array
$tt_pages = array();
$tt_pages_obj = get_pages('sort_column=post_parent,menu_order');
foreach ($tt_pages_obj as $tt_page) {
$tt_pages[$tt_page->ID] = $tt_page->post_name; }
$tt_pages_tmp = array_unshift($tt_pages, "Select a page:");

//Access the WordPress Categories via an Array
$tt_categories = array();
$tt_categories_obj = get_categories('hide_empty=0');
foreach ($tt_categories_obj as $tt_cat) {
$tt_categories[$tt_cat->cat_ID] = $tt_cat->cat_name;}
$categories_tmp = array_unshift($tt_categories, "Select a category:");

if ( post_type_exists( 'scoreboard' ) ) {

//Access the custom Scoreboard Categories via an Array
$tt_tax = array();
$scores = get_terms('scores_cat', array( 'hide_empty' => 0 ));
foreach ($scores as $score) {
$tt_tax[$score->slug] = $score->slug;}
$tax_tmp = array_unshift($tt_tax, "Select a category:");

}

$arch_layout = array("Row","Column");

$logo_loc = array("Small","Large");

$post_layout = array("Template 1","Template 2");

$feat_layout = array("Featured 1","Featured 2","Featured 3");

}

/*-----------------------------------------------------------------------------------*/
/* Create The Custom Site Options Panel
/*-----------------------------------------------------------------------------------*/
$options = array(); // do not delete this line - sky will fall

/* General Settings */
$options[] = array( "name" => esc_html__('General','click-mag'),
			"type" => "heading");

if (isset($logo_loc)) {
$options[] = array( "name" => __('Logo Location','click-mag'),
			"desc" => esc_html__('Set the location of your logo.','framework_localize'),
			"id" => $shortname."_logo_loc",
			"std" => "Small",
			"type" => "select",
			"options" => $logo_loc);
}

$options[] = array( "name" => esc_html__('Logo','click-mag'),
			"desc" => esc_html__('If you are using the Large logo layout, select a file to appear as your logo that will appear above the navigation and will replace the default "Click Mag" logo. There are no maximum recommended dimensions for this logo size.','click-mag'),
			"id" => $shortname."_logo",
			"std" => "",
			"type" => "upload");

$options[] = array( "name" => __('Logo in Navigation','click-mag'),
			"desc" => esc_html__('Select a file that will appear in your navigation. The recommended maximum dimensions for this logo are 250x60.','mvp-text'),
			"id" => $shortname."_logo_nav",
			"std" => "",
			"type" => "upload");

$options[] = array( "name" => esc_html__('Logo in Navigation Width','click-mag'),
			"desc" => "If you are utilizing the Google AMP feature, you will need to enter the width of your logo file here. Default is 250.",
			"id" => $shortname."_amp_logow",
			"std" => "250",
			"type" => "text");

$options[] = array( "name" => esc_html__('Logo in Navigation Height','click-mag'),
			"desc" => "If you are utilizing the Google AMP feature, you will need to enter the height of your logo file here. Default is 60.",
			"id" => $shortname."_amp_logoh",
			"std" => "60",
			"type" => "text");

$options[] = array( "name" => esc_html__('Custom Favicon','click-mag'),
			"desc" => esc_html__('Upload a 16x16px PNG/GIF image that will represent your website\'s favicon.','click-mag'),
			"id" => $shortname."_favicon",
			"std" => "",
			"type" => "upload");

$options[] = array( "name" => esc_html__('Custom CSS','click-mag'),
			"desc" => "Enter your custom CSS here. You will not lose any of the CSS you enter here if you update the theme to a new version.",
			"id" => $shortname."_customcss",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => esc_html__('Toggle Responsiveness','click-mag'),
			"desc" => "Uncheck this box if you would like to remove the responsiveness of the theme.",
			"id" => $shortname."_respond",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => esc_html__('Toggle Infinite Scroll','click-mag'),
			"desc" => "Uncheck this box if you would like to remove the Infinite Scroll feature.",
			"id" => $shortname."_infinite_scroll",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => esc_html__('Enable RTL','click-mag'),
			"desc" => "Check this box if you would like to enable the RTL stylesheet.",
			"id" => $shortname."_rtl",
			"std" => "false",
			"type" => "checkbox");


/* Theme Color Settings */
$options[] = array( "name" => esc_html__('Colors','click-mag'),
			"type" => "heading");

$options[] = array( "name" => esc_html__('Primary Theme Color','click-mag'),
			"desc" => esc_html__('Primary color for the site.','click-mag'),
			"id" => $shortname."_primary_theme",
			"std" => "#ff3c36",
			"type" => "color");

$options[] = array( "name" => esc_html__('Top Navigation Background Color','click-mag'),
			"desc" => esc_html__('The background color of the top navigation.','click-mag'),
			"id" => $shortname."_top_nav_bg",
			"std" => "#ffffff",
			"type" => "color");

$options[] = array( "name" => esc_html__('Top Navigation Text Color','click-mag'),
			"desc" => esc_html__('The text color of the top navigation.','click-mag'),
			"id" => $shortname."_top_nav_text",
			"std" => "#444444",
			"type" => "color");

$options[] = array( "name" => esc_html__('Top Navigation Text Hover Color','click-mag'),
			"desc" => esc_html__('The text color when you mouse over the top navigation.','click-mag'),
			"id" => $shortname."_top_nav_hover",
			"std" => "#fdacc8",
			"type" => "color");

$options[] = array( "name" => esc_html__('Main Headlines Link Color','click-mag'),
			"desc" => esc_html__('The text color of the headline links.','click-mag'),
			"id" => $shortname."_headlines",
			"std" => "#222222",
			"type" => "color");

$options[] = array( "name" => esc_html__('Primary Link Color','click-mag'),
			"desc" => esc_html__('Primary link color for the site.','click-mag'),
			"id" => $shortname."_link_color",
			"std" => "#0077ee",
			"type" => "color");

$options[] = array( "name" => esc_html__('Link Hover Color','click-mag'),
			"desc" => esc_html__('Link hover color for the site.','click-mag'),
			"id" => $shortname."_link_hover",
			"std" => "#ff3c36",
			"type" => "color");

/* Font Settings */
$options[] = array( "name" => esc_html__('Fonts','click-mag'),
			"type" => "heading");

$options[] = array( "name" => esc_html__('General Content Font','click-mag'),
			"desc" => esc_html__('Enter the font name for the general font for the content on all pages.','click-mag'),
			"id" => $shortname."_content_font",
			"std" => "Merriweather",
			"type" => "text");

$options[] = array( "name" => esc_html__('Fly-Out Menu/Top Navigation Font','click-mag'),
			"desc" => "Enter the font name for the fly-out and top navigation menus.",
			"id" => $shortname."_menu_font",
			"std" => "Work Sans",
			"type" => "text");

$options[] = array( "name" => esc_html__('Featured Posts/Article Headline Font','click-mag'),
			"desc" => "Enter the font name the font for the headlines in the Featured Posts section and the Article title on posts and pages.",
			"id" => $shortname."_featured_font",
			"std" => "Work Sans",
			"type" => "text");

$options[] = array( "name" => esc_html__('General Headline Font','click-mag'),
			"desc" => "Enter the font name the font for the general headlines around the site.",
			"id" => $shortname."_headline_font",
			"std" => "Work Sans",
			"type" => "text");

$options[] = array( "name" => esc_html__('General Heading Font','click-mag'),
			"desc" => "Enter the font name the font for the general headings that appear at the top of the different sections around the site.",
			"id" => $shortname."_heading_font",
			"std" => "Work Sans",
			"type" => "text");


/* Homepage Settings */
$options[] = array( "name" => esc_html__('Homepage Settings','click-mag'),
			"type" => "heading");

$options[] = array( "name" => esc_html__('Attention','click-mag'),
			"desc" => "",
			"id" => $shortname."_attention_home_slider",
			"std" => "In order to utilize these functions, you will have to set up your homepage as a static page. Please refer to the Installing Demo Data section of the documentation for more information.",
			"type" => "info");

$options[] = array( "name" => esc_html__('Show Featured Posts?','click-mag'),
			"desc" => "Uncheck this box if you would like to remove the Featured Posts section from the homepage.",
			"id" => $shortname."_feat_posts",
			"std" => "true",
			"type" => "checkbox");

if (isset($feat_layout)) {
$options[] = array( "name" => esc_html__('Featured Posts Layout','click-mag'),
			"desc" => esc_html__('Select the layout of your Featured Posts section on the homepage.','click-mag'),
			"id" => $shortname."_feat_layout",
			"std" => "Featured 1",
			"type" => "select",
			"options" => $feat_layout);
}

$options[] = array( "name" => esc_html__('Featured Posts Tag Slug','click-mag'),
			"desc" => esc_html__('Enter the Tag Slug of the Tag you want associated with the Featured Posts section. Posts with this Tag will be displayed in the Featured Slider at the top of the homepage.','click-mag'),
			"id" => $shortname."_feat_posts_tags",
			"std" => "featured",
			"type" => "text");

if (isset($arch_layout)) {
$options[] = array( "name" => esc_html__('Homepage Blog Layout','mvp-text'),
			"desc" => __('Select the layout for the blog section of the homepage.','click-mag'),
			"id" => $shortname."_arch_layout",
			"std" => "Row",
			"type" => "select",
			"options" => $arch_layout);
}

$options[] = array( "name" => esc_html__('Number of posts per page','click-mag'),
			"desc" => "Set the number of posts per page that you want displayed on the Homepage Blog and the Latest News Template.",
			"id" => $shortname."_posts_num",
			"std" => "10",
			"type" => "text");


/* Popular Posts Settings */
$options[] = array( "name" => esc_html__('Popular Posts Settings','click-mag'),
			"type" => "heading");

$options[] = array( "name" => esc_html__('Number of Popular Posts','click-mag'),
			"desc" => "Set the number of posts to display in the Popular Posts sidebar.",
			"id" => $shortname."_pop_num",
			"std" => "10",
			"type" => "text");

$options[] = array( "name" => esc_html__('Popular Posts Days','click-mag'),
			"desc" => "Number of days to use for Popular Posts. Only posts published within this length of time will be displayed in the Popular Posts column.",
			"id" => $shortname."_pop_days",
			"std" => "9999",
			"type" => "text");


/* Article Settings */
$options[] = array( "name" => esc_html__('Article Settings','click-mag'),
			"type" => "heading");

if (isset($post_layout)) {
$options[] = array( "name" => esc_html__('Default Post Template','click-mag'),
			"desc" => esc_html__('Select the default Post Template layout for your articles.','click-mag'),
			"id" => $shortname."_post_layout",
			"std" => "Template 1",
			"type" => "select",
			"options" => $post_layout);
}

$options[] = array( "name" => esc_html__('Show Featured Image In Posts?','click-mag'),
			"desc" => esc_html__('Uncheck this box if you would like to remove the featured image thumbnail from all posts.','click-mag'),
			"id" => $shortname."_featured_img",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => esc_html__('Show Social Sharing Buttons?','click-mag'),
			"desc" => "Uncheck this box if you would like to remove the social sharing buttons from all posts.",
			"id" => $shortname."_social_box",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => esc_html__('Show Author Info?','click-mag'),
			"desc" => "Uncheck this box if you would like to remove the author info box from the bottom of the posts.",
			"id" => $shortname."_author_box",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => esc_html__('Show Author Email?','click-mag'),
			"desc" => "Uncheck this box if you would like to remove the author email link from within the author info box.",
			"id" => $shortname."_author_email",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => esc_html__('Show Related Posts?','click-mag'),
			"desc" => "Uncheck this box if you would like to remove the Related Posts from the bottom of the posts.",
			"id" => $shortname."_related_posts",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => esc_html__('Show More Posts?','click-mag'),
			"desc" => "Uncheck this box if you would like to remove the More Posts from the bottom of the posts.",
			"id" => $shortname."_more_posts",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => esc_html__('Number of More Posts','click-mag'),
			"desc" => "Set the number of More posts you want to display below each article.",
			"id" => $shortname."_more_num",
			"std" => "5",
			"type" => "text");

$options[] = array( "name" => esc_html__('Show Previous/Next Post Links?','click-mag'),
			"desc" => "Uncheck this box if you would like to remove the links to the previous/next posts arrows in the margins of each article.",
			"id" => $shortname."_prev_next",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => esc_html__('Use Continue Reading Button On Mobile?','click-mag'),
			"desc" => "Uncheck this box if you would like to remove the Continue Reading button feature on mobile devices.",
			"id" => $shortname."_cont_read",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => esc_html__('Disqus Forum Shortname','click-mag'),
			"desc" => "If you want to use Disqus as your commenting system, enter your Disqus Forum Shortname in order to activate Disqus on your site. This is the unique identifier for your website in Disqus (i.e. yourforumshortname.disqus.com)",
			"id" => $shortname."_disqus_id",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => esc_html__('Article Ad Code','click-mag'),
			"desc" => "Enter your ad code (Eg. Google Adsense) for the 300x250 ad area within the body of the article. The ad space can accommodate an ad of any height, but with only a maximum width of 300px.",
			"id" => $shortname."_post_ad",
			"std" => "",
			"type" => "textarea");


/* Google AMP Settings */
$options[] = array( "name" => esc_html__('Google AMP Settings','click-mag'),
			"type" => "heading");

$options[] = array( "name" => esc_html__('Enable Google AMP on mobile devices','click-mag'),
			"desc" => "Check this box if you would like to enable the Google AMP compatibility with the theme. You will also need to install and activate the AMP plugin that comes with the theme.",
			"id" => $shortname."_amp",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => esc_html__('Facebook App ID','click-mag'),
			"desc" => "In order to utilize the Google AMP Facebook share button, you must provide a valid Facebook App ID.",
			"id" => $shortname."_amp_fb",
			"std" => "",
			"type" => "text");


/* Category Settings */
$options[] = array( "name" => esc_html__('Category Pages','click-mag'),
			"type" => "heading");

$options[] = array( "name" => esc_html__('Attention','click-mag'),
			"desc" => "",
			"id" => $shortname."_attention_ad",
			"std" => "To set the number of posts that are displayed on category pages, go to Settings > Reading and change the 'Blog page show at most' number.",
			"type" => "info");

$options[] = array( "name" => esc_html__('Show Featured Posts','click-mag'),
			"desc" => "Uncheck this box if you would like to remove the Featured Posts section from the category pages.",
			"id" => $shortname."_featured_cat",
			"std" => "true",
			"type" => "checkbox");

if (isset($feat_layout)) {
$options[] = array( "name" => esc_html__('Featured Posts Layout','click-mag'),
			"desc" => esc_html__('Select the layout of your Featured Posts section on the category pages.','click-mag'),
			"id" => $shortname."_feat_cat_layout",
			"std" => "Featured 1",
			"type" => "select",
			"options" => $feat_layout);
}

if (isset($arch_layout)) {
$options[] = array( "name" => esc_html__('Archive Blog Layout','mvp-text'),
			"desc" => __('Select the layout for the blog section of your category and archive pages.','click-mag'),
			"id" => $shortname."_cat_layout",
			"std" => "Row",
			"type" => "select",
			"options" => $arch_layout);
}


/* Social Media Settings */
$options[] = array( "name" => esc_html__('Social Media','click-mag'),
			"type" => "heading");

$options[] = array( "name" => esc_html__('Facebook','click-mag'),
			"desc" => "Enter your Facebook Page URL here.",
			"id" => $shortname."_facebook",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => esc_html__('Twitter','click-mag'),
			"desc" => "Enter your Twitter URL here.",
			"id" => $shortname."_twitter",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => esc_html__('Pinterest','click-mag'),
			"desc" => "Enter your Pinterest URL here.",
			"id" => $shortname."_pinterest",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => esc_html__('Instagram','click-mag'),
			"desc" => "Enter your Instagram URL here.",
			"id" => $shortname."_instagram",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => esc_html__('Google Plus','click-mag'),
			"desc" => "Enter your Google Plus URL here.",
			"id" => $shortname."_google",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => esc_html__('Youtube','click-mag'),
			"desc" => "Enter your Youtube URL here.",
			"id" => $shortname."_youtube",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => esc_html__('Linkedin','click-mag'),
			"desc" => "Enter your Linkedin URL here.",
			"id" => $shortname."_linkedin",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => esc_html__('Tumblr','click-mag'),
			"desc" => "Enter your Tumblr URL here.",
			"id" => $shortname."_tumblr",
			"std" => "",
			"type" => "text");


/* Ad Management Settings */
$options[] = array( "name" => esc_html__('Ad Management','click-mag'),
			"type" => "heading");

$options[] = array( "name" => esc_html__('Attention','click-mag'),
			"desc" => "",
			"id" => $shortname."_attention_ad",
			"std" => "The 300x250 ads are controlled via a Widget.",
			"type" => "info");

$options[] = array( "name" => esc_html__('Header Leaderboard Ad Code','click-mag'),
			"desc" => "Enter your ad code (Eg. Google Adsense) for the 970x90 ad area. You can also place a 728x90 ad in this spot.",
			"id" => $shortname."_header_leader",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => esc_html__('Footer Leaderboard Ad Code','click-mag'),
			"desc" => "Enter your ad code (Eg. Google Adsense) for the 970x90 ad area just above the footer. You can also place a 728x90 ad in this spot.",
			"id" => $shortname."_footer_leader",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => esc_html__('Wallpaper Ad Image URL','click-mag'),
			"desc" => "Enter the URL for your wallpaper ad image. Wallpaper ad code should be a minimum of 1280px wide. Please see the theme documentation for more on wallpaper ad specifications.",
			"id" => $shortname."_wall_ad",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => esc_html__('Wallpaper Ad Click-Through URL','click-mag'),
			"desc" => "Enter the URL for your wallpaper ad click-through.",
			"id" => $shortname."_wall_url",
			"std" => "",
			"type" => "text");


/* Footer Settings */
$options[] = array( "name" => esc_html__('Footer Info','click-mag'),
			"type" => "heading");

$options[] = array( "name" => esc_html__('Copyright Text','click-mag'),
			"desc" => "Here you can enter any text you want (eg. copyright text)",
			"id" => $shortname."_copyright",
			"std" => "Copyright &copy; 2016 Click Mag Theme. Theme by MVP Themes, powered by WordPress.",
			"type" => "textarea");


update_option('of_template',$options);
update_option('of_shortname',$shortname);

}
}
?>