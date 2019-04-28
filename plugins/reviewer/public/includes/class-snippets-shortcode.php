<?php

/**
 * Reviewer Plugin v.3
 * Created by Michele Ivani
 */
class RWP_Snippets_Shortcode
{
    // Wildcard for Automatic Box.
	const WILDCARD = -1;
	const LIMIT = 10;
	const NEEDLE = '%needle%';

    // Instace of this class
    protected static $instance = null;
    protected $shortcode_tag = 'rwp_snippets';

    public function __construct()
    {
        $this->plugin_slug = 'reviewer';

        add_shortcode($this->shortcode_tag, array( $this, 'do_shortcode' ));
    }

    public function do_shortcode($atts)
    {
		global $wpdb;

        extract(shortcode_atts(array(
            'template'	=> '',
            'post'		=> get_the_ID(),
            'box' => 0,
        ), $atts));

        // Parse.
        $post_id = intval($post);
		$box_id = intval($box);
		$template_id = $template;
		$box = null;

        // Check if the box is an automatic one.
        $is_automatic = (static::WILDCARD == $box_id) ? true : false;

        // If is Automatic Box and the template is not set then returns an empty string.
        if ($is_automatic && empty($template_id) ) {
            return '';
		}

        // If is Automatic Box prepare the generated box id.
        if ($is_automatic) {
            $post_type 	= get_post_type($post_id);
            $box_id = md5('rwp-'. $template_id .'-'. $post_type . '-' . $post_id . '-' . static::WILDCARD);
		}

		// Review Box
		if (!$is_automatic) {
			$boxes = get_post_meta($post_id, 'rwp_reviews', true);
			if (!isset($boxes[ $box_id ])) {
				return '';
			}
			$box = $boxes[ $box_id ];
			$template = $box['review_template'];

			if (isset($box['review_snippets']) && 'critic_review' == $box['review_snippets']) {
				return $this->critic_review($box, $post_id);
			}
		}

		// Query reviews.
		$meta_key = 'rwp_rating_' . $box_id;
		$query = $wpdb->prepare('SELECT * FROM '. $wpdb->postmeta .' WHERE meta_key = %s && post_id = %d ORDER BY meta_id DESC', $meta_key, $post_id);
		$result = $wpdb->get_results($query);

		// Validate result.
		if (!is_array($result)) {
			$result = array();
		}

		$site_name = get_bloginfo('name');
		$site_url = get_site_url();

		// Preferences
		$preferences = get_option('rwp_preferences', array());

		// Profile.
		$profile = (isset($preferences['preferences_profile_link']['structure']) && !empty($preferences['preferences_profile_link']['structure'])) ? $preferences['preferences_profile_link'] : false;

		$count = 0;
		$average = 0;
		$reviews = array();

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

			// Review author.
			$user = new stdClass;

			if (0 < $rev->rating_user_id ) {
				$wp_user = get_user_by('id', $rev->rating_user_id);
				if (false === $wp_user) {
					$user->name = 'Anonymous';
				} else {
					$user->name = $wp_user->display_name;
				}

				if( false === $profile ) {
					$user->url = $site_url;
				} else {
					$identifier = ('username' == $profile['tag']) ? $wp_user->user_nicename : $rev->rating_user_id;
					$user->url = str_replace(static::NEEDLE, $identifier, $profile['structure']);
				}
			} else {
				$user->name = $rev->rating_user_name;
				$user->url = $site_url;
			}

			// Review.
			$review = new stdClass;
			$review->comment = $rev->rating_comment;
			$review->date = date('c', $rev->rating_date);
			$review->score = round(RWP_Reviewer::get_avg($rev->rating_score), 1);
			$review->author = $user;

			$average += $review->score;

			$reviews[] = $review;
		}

		// Template.
		$templates = get_option('rwp_templates', array());
		$temp = isset($templates[ $template_id ]) ? ((object) $templates[ $template_id ]) : new stdClass;

		$template = new stdClass;
		$template->minimum_score = $temp->template_minimum_score;
		$template->maximum_score = $temp->template_maximum_score;

		$template->use_featured_image = ('yes' == $temp->template_auto_reviews_featured_image) ? true : false;

		// Score Average and count
		$count = count($reviews);
		$average = ($count > 0) ? round(($average/$count), 1) : 0;
		if ($average <= $template->minimum_score) {
			$average += 0.1;
		}

		if ($count <= 0) {
			$count = 1;
		}

		// Publisher.
		$publisher = new stdClass;
		$publisher->name = isset($preferences['preferences_snippets']['field_publisher_name']) ? $preferences['preferences_snippets']['field_publisher_name'] : $site_name;
		$publisher->url = isset($preferences['preferences_snippets']['field_publisher_url']) ? $preferences['preferences_snippets']['field_publisher_url'] : $site_url;

        $limit = isset($preferences['preferences_snippets']['field_reviews_count']) ? intval($preferences['preferences_snippets']['field_reviews_count']): static::LIMIT;

		unset($templates);
		unset($result);
		unset($temp);

		// Build snippets.
		$snippets = array(
            '@context' => 'http://schema.org/',
            '@type' => 'Product',
            'name' => (!is_null($box) && 'custom_title' == $box['review_title_options'] ) ? $box['review_title'] : get_the_title($post_id),
		);

		$image = $this->get_box_image($is_automatic, $post_id, $box, $template);
		if (!is_null($image)) {
			$snippets['image'] = $image;
		}

		$snippets['aggregateRating'] = array(
			'@type' => 'AggregateRating',
			'worstRating' => $template->minimum_score,
			'bestRating' => $template->maximum_score,
			'ratingValue' => $average,
			'ratingCount' => $count,
		);

		$snippets['review'] = array();
		$reviews = array_slice($reviews, 0, $limit);

        foreach ($reviews as $review) {
            $snippets['review'][] = array(
                '@type' => 'Review',
                'reviewBody' => $review->comment,
                'author' => array(
                    '@type' => 'Person',
                    'name' => $review->author->name,
                    'sameAs' => $review->author->url,
				),
                'publisher' => array(
					'@type' => 'Organization',
					'name' => $publisher->name,
                    'sameAs' => $publisher->url,
				),
                'datePublished' => $review->date,
                'reviewRating' => array(
                    '@type' => 'Rating',
                    'worstRating' => $template->minimum_score,
                    'bestRating' => $template->maximum_score,
                    'ratingValue' => $review->score,
				),
			);
		}

		// Custom Hook.
        $snippets = apply_filters('rwp_snippets', $snippets);

		ob_start();
		// echo '<pre>'; print_r($snippets); echo '</pre>';
		echo '<script type="application/ld+json">'. json_encode($snippets) .'</script>';
        return ob_get_clean();
	}

	public function critic_review($box, $post_id)
	{
		$permalink = get_permalink($post_id);
		$post = get_post($post_id);

		$wp_user = get_user_by('id', $post->post_author);
		$user = new stdClass;
		if (false === $wp_user) {
			$user->name = 'Anonymous';
			$user->url = $permalink;
		} else {
			$user->name = $wp_user->display_name;
			$user->url = get_author_posts_url($post->post_author);
		}

		// Template.
		$template_id = $box['review_template'];
        $templates = get_option('rwp_templates', array());
        $temp = isset($templates[ $template_id ]) ? ((object) $templates[ $template_id ]) : new stdClass;

        $template = new stdClass;
        $template->minimum_score = $temp->template_minimum_score;
		$template->maximum_score = $temp->template_maximum_score;

		$template->use_featured_image = ('yes' == $temp->template_auto_reviews_featured_image) ? true : false;

		// Score
		$score = round(RWP_Reviewer::get_avg($box['review_scores']), 1);
		if ($score <= $template->minimum_score) {
			$score += 0.1;
		}

		$snippets = array(
            '@context' => 'http://schema.org/',
            '@type' => 'Product',
			'name' => ('custom_title' == $box['review_title_options']) ? $box['review_title'] : $post->post_title,
		);

		$image = $this->get_box_image(false, $post_id, $box, $template);
        if (!is_null($image)) {
            $snippets['image'] = $image;
        }

		$snippets['review'] = array(
			'@type' => 'Review',
			'url' => $permalink,
			'author' => array(
				'@type' => 'Person',
				'name' => $user->name,
				'sameAs' => $user->url,
			),
			'publisher' => array(
				'@type' => 'Organization',
				'name' => get_bloginfo('name'),
				'sameAs' => $permalink,
			),
			'datePublished' => date('c', strtotime($post->post_date_gmt)),
			'description' => empty($box['review_summary']) ? substr(get_the_excerpt($post_id), 0, 199) : substr($box['review_summary'], 0, 199),
			'reviewRating' => array(
				'@type' => 'Rating',
				'worstRating' => $template->minimum_score,
				'bestRating' => $template->maximum_score,
				'ratingValue' => $score,
			),
		);

		// Custom Hook.
		$snippets = apply_filters('rwp_snippets', $snippets);

		// echo '<pre>'; print_r($snippets); echo '</pre>';
		return '<script type="application/ld+json">'. json_encode($snippets) .'</script>';
	}

	public function get_box_image($is_automatic = false, $post_id = 1, $box = null, $template)
	{
		if ($is_automatic) {
			if ($template->use_featured_image && has_post_thumbnail($post_id)) {
				return null;
			} else {
				$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
        		return $thumb[0];
			}
		} else {
			if (!is_null($box) && isset($box['review_use_featured_image']) && isset($box['review_image'])) {
				if ('no' == $box['review_use_featured_image'] && !empty($box['review_image'])) {
					return $box['review_image'];
				} elseif ('yes' == $box['review_use_featured_image'] && has_post_thumbnail($post_id)) {
					$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
               		 return $thumb[0];
				} else {
					$image = null;
				}
			} else {
				return null;
			}
		}
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
