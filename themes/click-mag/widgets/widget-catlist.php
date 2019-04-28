<?php
/**
 * Plugin Name: Category List Widget
 */

add_action( 'widgets_init', 'mvp_catlist_load_widgets' );

function mvp_catlist_load_widgets() {
	register_widget( 'mvp_catlist_widget' );
}

class mvp_catlist_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'mvp_catlist_widget', 'description' => esc_html__('A widget that displays a list of posts from a category of your choice.', 'click-mag') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'mvp_catlist_widget' );

		/* Create the widget. */
		parent::__construct( 'mvp_catlist_widget', esc_html__('Click Mag: Category List Widget', 'click-mag'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		global $post;
		$title = apply_filters('widget_title', $instance['title'] );
		$categories = $instance['categories'];
		$showcat = $instance['showcat'];
		$number = $instance['number'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		?>

			<div class="mvp-wide-widget-wrap left relative">
				<?php $recent = new WP_Query(array( 'cat' => $categories, 'posts_per_page' => $number )); while($recent->have_posts()) : $recent->the_post(); ?>
					<div class="mvp-wide-widget-story left relative">
						<a href="<?php the_permalink(); ?>" rel="bookmark">
						<div class="mvp-wide-widget-img left relative">
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
								<?php the_post_thumbnail('mvp-mid-thumb'); ?>
							<?php } ?>
							<?php if ( has_post_format( 'video' )) { ?>
								<div class="mvp-feat-vid-but">
									<i class="fa fa-play fa-3"></i>
								</div><!--mvpfeat-vid-but-->
							<?php } else if ( has_post_format( 'gallery' )) { ?>
								<div class="mvp-feat-gal-but">
									<i class="fa fa-camera fa-3"></i>
								</div><!--mvpfeat-gal-but-->
							<?php } ?>
						</div><!--mvp-wide-widget-img-->
						</a>
						<div class="mvp-wide-widget-text left relative">
							<?php if($showcat) { ?>
								<h3 class="mvp-feat2-sub-cat left"><span class="mvp-feat2-sub-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
							<?php } ?>
							<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
							<div class="mvp-feat1-info">
								<span class="mvp-blog-author"><?php _e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
							</div><!--mvp-feat1-info-->
						</div><!--mvp-wide-widget-text-->
					</div><!--mvp-wide-widget-story-->
				<?php endwhile; wp_reset_postdata(); ?>
			</div><!--mvp-wide-widget-wrap-->

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
		$instance['categories'] = strip_tags( $new_instance['categories'] );
		$instance['showcat'] = strip_tags( $new_instance['showcat'] );
		$instance['number'] = strip_tags( $new_instance['number'] );

		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Title', 'showcat' => 'on', 'number' => 5 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>

		<!-- Category -->
		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>">Select category:</label>
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>All Categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) {  ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>

		<!-- Show Categories -->
		<p>
			<label for="<?php echo $this->get_field_id( 'showcat' ); ?>">Show categories on posts:</label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'showcat' ); ?>" name="<?php echo $this->get_field_name( 'showcat' ); ?>" <?php checked( (bool) $instance['showcat'], true ); ?> />
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