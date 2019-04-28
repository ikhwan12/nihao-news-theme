<?php
/*
Plugin Name: JB Horizontal Scroller News Ticker
Plugin URI: http://www.jobairbd.com/wpplugin
Description: JB Horizontal Scroller News Ticker is eye catching responsive Breaking Scroller News ticker plugin. Which you can use by shortcode in your theme.
Author: Jobair
Author URI:http://jobairbd.com
Version:1.0
*/
function  jb_hz_bn_news_ticker(){
wp_enqueue_script('jb_hz_bn_news-js',plugins_url('/js/jquery.li-scroller.1.0.js', __FILE__ ), array('jquery'),false);
wp_enqueue_style('jb_hz_bn_news-css',plugins_url('/css/jb-breaking-news.css', __FILE__ ));
}
add_action('init','jb_hz_bn_news_ticker');
/* short code*/
function jb_bn_shortcode($atts){
	extract( shortcode_atts( array(
		'id' => '',
		'scroll_speed' => '0.07',
		'category' => '',
		'count' => '5',
	), $atts ) );
	global $post;
    $q = new WP_Query(
    array( 'posts_per_page' => $count, 'post_type' => 'post','category_name' => $category )
       );
$list = '<script type="text/javascript">
				jQuery(function($){
					$("#bn_ticker'.$id.'").liScroll({
					travelocity: '.$scroll_speed.'
					});

				});

			</script>
					<div class="breaking_news">
						<div class="the_ticker">
							<div class="btn_title">
								<span>Breaking News</span>
							</div>
						</div>
						<div class="news_ticker">
							<ul id="bn_ticker'.$id.'">
							
					';


	while($q->have_posts()) : $q->the_post();
    //get the ID of your post in the loop
    $id = get_the_ID();
	        
    $list .= '		
						<li><span>&raquo;</span><a href="'.get_permalink().'">'.get_the_title().'</a></li>										
								
	';        
endwhile;
$list.= '</ul></div></div>';
wp_reset_query();
return $list;
}
add_shortcode('horizontal_news', 'jb_bn_shortcode');
?>