<?php
/**
 * Plugin Name: Contributors Widget
 */

add_action( 'widgets_init', 'mvp_authors_load_widgets' );

function mvp_authors_load_widgets() {
	register_widget( 'mvp_authors_widget' );
}

class mvp_authors_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'mvp_authors_widget', 'description' => esc_html__('A widget that displays a list of contributors and their most recently published post.', 'click-mag') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'mvp_authors_widget' );

		/* Create the widget. */
		parent::__construct( 'mvp_authors_widget', esc_html__('Click Mag: Contributors Widget', 'click-mag'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		global $post;
		$title = apply_filters('widget_title', $instance['title'] );
		$number = $instance['number'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		?>

		<div class="mvp-authors-widget-wrap left relative">
			<?php $mvp_users = get_users(array( 'orderby' => 'post_count', 'order' => 'DESC', 'number' => $number )); foreach($mvp_users as $user) { $post_count = count_user_posts( $user->ID ); if($post_count < 1) continue; ?>
			<div class="mvp-trend-widget-story left relative">
					<div class="mvp-100img-out right relative">
						<div class="mvp-trend-widget-img left relative">
							<?php echo get_avatar( $user->user_email, '100' ); ?>
						</div><!--mvp-trend-widget-img-->
						<div class="mvp-100img-in">
							<div class="mvp-trend-widget-text left relative">
								<?php wp_get_current_user(); $author_query = array('posts_per_page' => '1','author' => $user->ID); $author_posts = new WP_Query($author_query); while($author_posts->have_posts()) : $author_posts->the_post(); ?>
									<a href="<?php echo get_author_posts_url( $user->ID ); ?>"><h3 class="mvp-main-blog-cat left"><span class="mvp-main-blog-cat left"><?php echo esc_html( $user->display_name ); ?></span></h3></a>
									<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
								<?php endwhile; ?>
							</div><!--mvp-trend-widget-text-->
						</div><!--mvp-100img-in-->
					</div><!--mvp-100img-out-->
			</div><!--mvp-trend-widget-story-->
			<?php } ?>
		</div><!--mvp-authors-widget-wrap-->

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
		$instance['number'] = strip_tags( $new_instance['number'] );

		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Title', 'number' => 5 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>

		<!-- Number of Authors -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">Number of contributors to display:</label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" size="3" />
		</p>


	<?php
	}
}

?>