<?php

/**
 * Reviewer Plugin v.3
 * Created by Michele Ivani
 */
class RWP_Rating_Numeric_Shortcode
{
	// Wildcard for Automatic Box.
    const WILDCARD = -1;

    // Instace of this class
    protected static $instance = null;
    protected $shortcode_tag1 = 'rwp_reviewer_score';
    protected $shortcode_tag2 = 'rwp_users_score';

    public function __construct()
    {
        $this->plugin_slug = 'reviewer';

        add_shortcode($this->shortcode_tag1, array( $this, 'do_shortcode1' ));
        add_shortcode($this->shortcode_tag2, array( $this, 'do_shortcode2' ));
    }

	public function do_shortcode1($atts)
    {
		global $wpdb;

        extract(shortcode_atts(array(
            'template'	=> '',
            'post'		=> get_the_ID(),
			'id' 		=> 0,
			'inline'	=> 'no',
        ), $atts));

        // Parse.
        $post_id = intval($post);
		$box_id = intval($id);
		$template_id = $template;

        // Check if the box is an automatic one.
		$is_automatic = (static::WILDCARD == $box_id) ? true : false;

        // If is Automatic Box then prepare the generated box id.
        if ($is_automatic) {
            return '<p>Automatic Box has not a Reviewer score</p>';
		}

		// Review Box
		$boxes = get_post_meta($post_id, 'rwp_reviews', true);
		if (!isset($boxes[ $box_id ])) {
            return '<p>No Review Box was found with ID '. $box_id .'</p>';
		}
		$box = $boxes[ $box_id ];
		$template_id = $box['review_template'];

		// Template.
		$templates = get_option('rwp_templates', array());
		$temp = isset($templates[ $template_id ]) ? ((object) $templates[ $template_id ]) : new stdClass;

		$maximum_score = $temp->template_maximum_score;

		// Score Average and count
		$average = round(RWP_Reviewer::get_avg($box['review_scores']), 1);

		unset($templates);
		unset($temp);

		$display_inline = (true === $inline || 'true' == $inline) ? 'style="display: inline-block"' : '';

		ob_start();
		?>
		<span class="rwp-box-score" <?php echo $display_inline ?>>
			<i class="rwp-box-score__average"><?php echo $average ?></i>
			<i class="rwp-box-score__maximum">/<?php echo $maximum_score ?></i>
		</span>
		<?php
        return ob_get_clean();
	}

	public function do_shortcode2($atts)
    {
		global $wpdb;

        extract(shortcode_atts(array(
            'template'	=> '',
            'post'		=> get_the_ID(),
			'id' 		=> 0,
			'inline'	=> 'no',
			'count'		=> 'yes',
        ), $atts));

        // Parse.
        $post_id = intval($post);
		$box_id = intval($id);
		$template_id = $template;

        // Check if the box is an automatic one.
        $is_automatic = (static::WILDCARD == $box_id) ? true : false;

        // If is Automatic Box and the template is not set then returns an empty string.
        if ($is_automatic && empty($template_id) ) {
            return 'Add the "template" parameter';
        }

        // If is Automatic Box then prepare the generated box id.
        if ($is_automatic) {
            $post_type 	= get_post_type($post_id);
            $box_id = md5('rwp-'. $template_id .'-'. $post_type . '-' . $post_id . '-' . static::WILDCARD);
		}

		// Query reviews.
		$meta_key = 'rwp_rating_' . $box_id;
		$query = $wpdb->prepare('SELECT * FROM '. $wpdb->postmeta .' WHERE meta_key = %s && post_id = %d', $meta_key, $post_id);
		$result = $wpdb->get_results($query);

		// Validate result.
		if (!is_array($result)) {
			$result = array();
		}

		$number = 0;
		$average = 0;

		// Loop the reviews.
		foreach ($result as $meta) {
			$rev = (object) maybe_unserialize($meta->meta_value);

            if (!property_exists($rev, 'rating_id')) {
                continue;
			}

			if ('published' != $rev->rating_status) {
				continue;
			}

			// Template ID.
			$template_id = $rev->rating_template;

			// Calulate the criteria average.
			$average += round(RWP_Reviewer::get_avg($rev->rating_score), 1);
			$number++;
		}

		// Template.
		$templates = get_option('rwp_templates', array());
		$temp = isset($templates[ $template_id ]) ? ((object) $templates[ $template_id ]) : new stdClass;

		$maximum_score = $temp->template_maximum_score;
		$label_s = $temp->template_users_count_label_s;
		$label_p = $temp->template_users_count_label_p;

		$label = (1 == $number) ? $label_s : $label_p;

		// Score Average and count
		$average = ($number > 0) ? round(($average/$number), 1) : 0;

		unset($templates);
		unset($result);
		unset($temp);

		$display_inline = ('yes' == $inline) ? 'style="display: inline-block"' : '';

		ob_start();
		?>
		<span class="rwp-box-score" <?php echo $display_inline; ?>>
			<i class="rwp-box-score__average"><?php echo $average ?></i>
			<i class="rwp-box-score__maximum">/<?php echo $maximum_score ?></i>
			<?php if ('yes' == $count ): ?>
			<i class="rwp-box-score__count">(<?php echo $number .' '. $label ?>)</i>
			<?php endif; ?>
		</span>
		<?php
        return ob_get_clean();
	}

    public static function get_instance()
	{
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
    }
}
