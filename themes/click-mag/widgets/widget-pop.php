<?php
/**
 * Plugin Name: Popular Posts Widget
 */

add_action( 'widgets_init', 'mvp_pop_load_widgets' );

function mvp_pop_load_widgets() {
	register_widget( 'mvp_pop_widget' );
}

class mvp_pop_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'mvp_pop_widget', 'description' => esc_html__('A widget that displays a list of popular posts within a time period of your choice.', 'click-mag') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'mvp_pop_widget' );

		/* Create the widget. */
		parent::__construct( 'mvp_pop_widget', esc_html__('Click Mag: Popular Posts Widget', 'click-mag'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		global $post;
		$title = apply_filters('widget_title', $instance['title'] );
		$popular_days = $instance['popular_days'];
		$number = $instance['number'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		?>

		<div class="mvp-trend-widget-wrap left relative">
			<?php $popular_days_ago = "$popular_days days ago"; $recent = new WP_Query(array( 'posts_per_page' => $number, 'orderby' => 'meta_value_num', 'order' => 'DESC', 'meta_key' => 'post_views_count', 'date_query' => array( array( 'after' => $popular_days_ago )) )); while($recent->have_posts()) : $recent->the_post(); ?>
			<div class="mvp-trend-widget-story left relative">
				<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
					<div class="mvp-100img-out right relative">
						<a href="<?php the_permalink(); ?>" rel="bookmark">
						<div class="mvp-trend-widget-img left relative">
							<?php the_post_thumbnail('mvp-small-thumb'); ?>
						</div><!--mvp-trend-widget-img-->
						</a>
						<div class="mvp-100img-in">
							<div class="mvp-trend-widget-text left relative">
								<h3 class="mvp-main-blog-cat left"><span class="mvp-main-blog-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
								<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
							</div><!--mvp-trend-widget-text-->
						</div><!--mvp-100img-in-->
						<div class="mvp-story-share-wrap">
							<span class="mvp-story-share-but fa fa-share fa-2"></span>
							<div class="mvp-story-share-cont">
								<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
								<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
								<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
							</div><!--mvp-story-share-cont-->
						</div><!--mvp-story-share-wrap-->
					</div><!--mvp-100img-out-->
				<?php } else { ?>
					<div class="mvp-trend-widget-text left relative">
						<h3 class="mvp-main-blog-cat left"><span class="mvp-main-blog-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
						<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
					</div><!--mvp-trend-widget-text-->
				<?php } ?>
			</div><!--mvp-trend-widget-story-->
			<?php endwhile; wp_reset_postdata(); ?>
		</div><!--mvp-trend-widget-wrap-->

		<?php

		/* After widget (defined by themes). */
		echo $after_widget;

	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['popular_days'] = strip_tags( $new_instance['popular_days'] );
		$instance['number'] = strip_tags( $new_instance['number'] );

		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Title', 'number' => 5, 'popular_days' => 30 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>

		<!-- Number of days -->
		<p>
			<label for="<?php echo $this->get_field_id( 'popular_days' ); ?>">Number of days to use for Popular Posts:</label>
			<input id="<?php echo $this->get_field_id( 'popular_days' ); ?>" name="<?php echo $this->get_field_name( 'popular_days' ); ?>" value="<?php echo $instance['popular_days']; ?>" size="3" />
		</p>

		<!-- Number of posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">Number of posts to display:</label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" size="3" />
		</p>


	<?php
	}
}

?>