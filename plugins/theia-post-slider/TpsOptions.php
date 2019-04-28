<?php

/*
 * Copyright 2012-2018, Theia Post Slider, WeCodePixels, http://wecodepixels.com
 */

// Sanitize/migrate options when accessing the admin page.
add_action( 'admin_init', 'TpsOptions::admin_init' );

// Sanitize options before updating them.
add_filter( 'pre_update_option', 'TpsOptions::pre_update_option', 10, 3 );

add_filter( 'updated_option', 'TpsOptions::updated_option', 10, 3 );

class TpsOptions extends WcpOptions_1_0_0 {
	public static function get_post_types() {
		$postTypes = self::get( 'post_types' );
		if ( ! is_array( $postTypes ) ) {
			$postTypes = array();
		}

		return $postTypes;
	}

	public static function get_beginning_post_content_separator() {
		return self::get( 'beginning_post_content_separator' );
	}

	public static function get_ending_post_content_separator() {
		return self::get( 'ending_post_content_separator' );
	}

	// Get all available transition effects.
	public static function get_transition_effects() {
		$options = array(
			'none'   => 'None',
			'simple' => 'Simple',
			'slide'  => 'Slide',
			'fade'   => 'Fade'
		);

		return $options;
	}

	// Get button horizontal positions.
	public static function get_button_horizontal_positions() {
		$options = array(
			'left'        => 'Left',
			'center'      => 'Center',
			'center_full' => 'Center, Full',
			'right'       => 'Right'
		);

		return $options;
	}

	// Get button vertical positions.
	public static function get_button_vertical_positions() {
		$options = array(
			'top_and_bottom' => 'Top and bottom',
			'top'            => 'Top',
			'bottom'         => 'Bottom',
			'none'           => 'None'
		);

		return $options;
	}

	// Get all available themes.
	public static function get_themes() {
		$themes = array();

		// Special files to ignore
		$ignore = array( 'admin.css' );

		// Get themes corresponding to .css files.
		$dir = __DIR__ . '/css';
		if ( $handle = opendir( $dir ) ) {
			while ( false !== ( $entry = readdir( $handle ) ) ) {
				if ( in_array( $entry, $ignore ) ) {
					continue;
				}

				$file = $dir . '/' . $entry;
				if ( ! is_file( $file ) ) {
					continue;
				}

				// Beautify name
				$name = substr( $entry, 0, - 4 ); // Remove ".css"
				$name = str_replace( '--', ', ', $name );
				$name = str_replace( '-', ' ', $name );
				$name = ucwords( $name );

				// Add theme
				$themes[ $entry ] = $name;
			}
			closedir( $handle );
		}

		$themes['none'] = 'None';

		// Sort alphabetically
		asort( $themes );

		return $themes;
	}

	/**
	 * @param $direction 'left' or 'right'
	 *
	 * @return string
	 */
	public static function get_font_icon( $direction ) {
		return $direction == 'left' ? TpsOptions::get( 'theme_vector_left_icon' ) : TpsOptions::get( 'theme_vector_right_icon' );
	}

	public static function get( $optionId, $optionGroups = null ) {
		$value = parent::get( $optionId, $optionGroups );

		$value = apply_filters( 'tps_options_get', $value, $optionId, $optionGroups );

		return $value;
	}

	public static function updated_option( $option, $old_value, $value ) {
		if ( $option == 'tps_dashboard' ) {
			// Reset global settings to default.
			$reset = array_key_exists( 'reset_global_settings_to_default', $value ) && $value['reset_global_settings_to_default'];
			if ( $reset ) {
				self::reset_global_settings();
			}

			// Reset post settings to default.
			$reset = array_key_exists( 'reset_all_post_settings_to_default', $value ) && $value['reset_all_post_settings_to_default'];
			if ( $reset ) {
				$query = new WP_Query( 'posts_per_page=-1' );
				while ( $query->have_posts() ) {
					$query->the_post();
					delete_post_meta( get_the_ID(), 'tps_options' );
				}
			}

			// Check for updates after updating the purchase code.
			if ( $value['purchase_code'] != $old_value['purchase_code'] ) {
				TpsUpdateChecker::$updateChecker->checkForUpdates();
			}
		}
	}

    public static function get_span_for_font_icon($class)
    {
        return '<span aria-hidden="true" class="' . $class . '"></span>';
    }

	public static function get_svg_for_icon($iconName, $direction)
    {
        $file = __DIR__ . '/svgs/' . $iconName . '-' . $direction . '.svg';
        $contents = file_get_contents($file);

        return $contents;
    }

	// Get all vector icons.
	public static function get_vector_icons() {
	    $icons = array();
        $icons = array_merge(self::get_font_icons(), $icons);
        $icons = array_merge(self::get_svg_icons(), $icons);
		ksort( $icons );
	    return $icons;
    }

    // Get SVG icons.
    protected static function get_svg_icons()
    {
        $icons = array();
        $files = scandir(__DIR__ . '/svgs');

        foreach ($files as $file) {
            preg_match('/([a-zA-Z0-9\-]+)-(left|right).svg/', $file, $matches);

            if (count($matches) !== 3) {
                continue;
            }

            $name = $matches[1];
            $icons[$name] = array(
                'type' => 'svg'
            );
        }

        return $icons;
    }

	// Get font icons.
	protected static function get_font_icons() {
		// Get icon classes from CSS file.
		$iconsCss = file_get_contents( __DIR__ . '/fonts/style.css' );
		preg_match_all( '/.tps-icon-([^{]*):before {(.*?)content: "\\\\([a-zA-Z0-9]+)"(.*?)}/s', $iconsCss, $matches );

		// Group left and right icons.
		$icons = array();
        $icons['None'] = array(
            'type' => 'font',
            'leftCode' => 'none',
            'leftClass' => 'none',
            'rightCode' =>'none',
            'rightClass' => 'none'
        );
		foreach ( $matches[0] as $key => $value ) {
			$class = $matches[1][ $key ];
			$name  = str_replace( array( '-left', '-right' ), '', $class );
			$class = 'tps-icon-' . $class;
			$code  = $matches[3][ $key ];

			if ( ! array_key_exists( $name, $icons ) ) {
				$icons[ $name ] = array(
				    'type' => 'font'
                );
			}

			if ( strpos( $class, 'left' ) !== false ) {
				$icons[ $name ]['leftCode']  = $code;
				$icons[ $name ]['leftClass'] = $class;
			} else {
				$icons[ $name ]['rightCode']  = $code;
				$icons[ $name ]['rightClass'] = $class;
			}
		}

		return $icons;
	}

	protected static function get_defaults() {
		$defaults = array(
			'tps_dashboard'       => array(
				'purchase_code' => '',
				'reset_global_settings_to_default' => '',
				'reset_all_post_settings_to_default' => ''
			),
			'tps_general'         => array(
				'transition_effect'         => 'slide',
				'transition_speed'          => 400,
				'theme_type'                => 'font',
				'theme'                     => 'buttons-orange.css',
				'theme_font_name'           => 'chevron-circle',
				'theme_vector_left_icon'    => '<span aria-hidden="true" class="tps-icon-chevron-circle-left"></span>',
				'theme_vector_right_icon'   => '<span aria-hidden="true" class="tps-icon-chevron-circle-right"></span>',
				'theme_font_color'          => '#f08100',
				'theme_background_color'    => '',
				'theme_font_size'           => 48,
				'theme_padding'             => 0,
				'theme_border_radius'       => 0,
				'custom_css'                => '',
			),
			'tps_nav'             => array(
				'navigation_text'               => '%{currentSlide} of %{totalSlides}',
				'helper_text'                   => 'Use your &leftarrow; &rightarrow; (arrow) keys to browse',
				'prev_text'                     => 'Prev',
				'next_text'                     => 'Next',
				'button_width'                  => 0,
				'prev_text_post'                => 'Prev post',
				'next_text_post'                => 'Next post',
				'button_width_post'             => 0,
				'button_behaviour'              => 'standard',
				'post_navigation_inverse'       => false,
				'post_navigation_same_category' => false,
				'nav_horizontal_position'       => 'right',
				'nav_vertical_position'         => 'top_and_bottom',
				'disable_keyboard_shortcuts'    => false,
				'scroll_after_refresh'          => true,
				'scroll_top_offset'             => 0,
			),
			'tps_advanced'        => array(
				'default_activation_behavior' => 1,
				'post_types'                  => array( 'post', 'page' ),
				'slide_loading_mechanism'     => 'ajax',
				'refresh_ads'                 => false,
				'ad_refreshing_mechanism'     => 'javascript',
				'refresh_ads_every_n_slides'  => 1,
				'enable_touch_gestures'       => false,
				'override_subtitles'          => false,
			),
			'tps_troubleshooting' => array(
				'do_not_check_for_multiple_instances' => true,
				'remove_canonical_rel'                => true,
				'do_not_cache_rendered_html'          => true,
				'document_ready_js'                   => false,
				'window_load_js'                      => false,
				'domcontentloaded_js'                 => false,
				'document_resize_js'                  => false,
				'document_scroll_js'                  => false,
				'add_header_to_excerpt'               => false,
				'try_to_fix_broken_html'              => false,
				'disable_rocketscript'                => false,
				'excludedWords'                       => '',
				'the_content_early_priority'          => 0,
				'beginning_post_content_separator'    => '<p><!-- BEGIN THEIA POST SLIDER --></p>',
				'ending_post_content_separator'       => '<p><!-- END THEIA POST SLIDER --></p>'
			)
		);
		$defaults = apply_filters( 'tps_init_options_defaults', $defaults );

		return $defaults;
	}

	protected static function get_overwrites( $overwrites ) {
		$refreshPageOnEachSlide = false;

		// General
        $options = get_option('tps_general');
        if (is_array($options)) {
            // New versions have "font" as the default button theme type. Older versions that have a classic theme chosen, will have the "classic" option chosen by default.
            if (array_key_exists('theme', $options) && !array_key_exists('theme_type', $options)) {
                $overwrites['tps_general']['theme_type'] = 'classic';
            }

            // Migrate v1.x "font" icons.
            if (array_key_exists('theme_font_leftClass', $options)) {
                // "ArrowXX" was renamed to "Arrow-XXX".
                $leftSearchFor1 = 'tps-icon-arrow-left';
                $leftSearchFor2 = 'tps-icon-arrow-left-0';
                $rightSearchFor1 = 'tps-icon-arrow-right';
                $rightSearchFor2 = 'tps-icon-arrow-right-0';
                if (strpos($options['theme_font_leftClass'], $leftSearchFor1) === 0 && strpos($options['theme_font_leftClass'], $leftSearchFor2) !== 0) {
                    $options['theme_font_leftClass'] = str_replace($leftSearchFor1, $leftSearchFor2, $options['theme_font_leftClass']);
                    $options['theme_font_rightClass'] = str_replace($rightSearchFor1, $rightSearchFor2, $options['theme_font_rightClass']);
                    $overwrites['tps_general']['theme_font_name'] = str_replace('arrow', 'arrow-0', $options['theme_font_name']);
                }

                $overwrites['tps_general']['theme_vector_left_icon'] = '<span aria-hidden="true" class="' . $options['theme_font_leftClass'] . '"></span>';
                $overwrites['tps_general']['theme_vector_right_icon'] = '<span aria-hidden="true" class="' . $options['theme_font_rightClass'] . '"></span>';
            }
        }

		$options = get_option( 'tps_nav' );
		if ( is_array( $options ) ) {
			if ( array_key_exists( 'refresh_page_on_slide', $options ) && $options['refresh_page_on_slide'] == true ) {
				$refreshPageOnEachSlide = true;
			}
			if ( array_key_exists( 'enable_on_pages', $options ) && $options['enable_on_pages'] == true ) {
				$overwrites['tps_advanced']['post_types'] = array( 'post', 'page' );
			}
			if ( array_key_exists( 'post_navigation', $options ) && $options['post_navigation'] == true ) {
				$overwrites['tps_nav']['button_behaviour'] = 'post';
			}
		}

		$options = get_option( 'tps_advanced' );
		if ( is_array( $options ) && array_key_exists( 'slide_loading_mechanism', $options ) && $options['slide_loading_mechanism'] == 'refresh' ) {
			$refreshPageOnEachSlide = true;
		}

		if ( $refreshPageOnEachSlide ) {
			$overwrites['tps_advanced']['slide_loading_mechanism'] = 'ajax';
			$overwrites['tps_advanced']['refresh_ads']             = true;
			$overwrites['tps_advanced']['ad_refreshing_mechanism'] = 'page';
		}

		// Transfer multiple selects.
		$postTypes = get_option( 'tps_advanced_post_types' );
		if ( $postTypes !== false ) {
			$overwrites['tps_advanced']['post_types'] = $postTypes;
			delete_option( 'tps_advanced_post_types' );
		}

		return $overwrites;
	}

	protected static function sanitize_options( $defaults, &$options, &$changed, $groupId ) {
		parent::sanitize_options( $defaults, $options, $changed, $groupId );

		// Validate options.
		if ( $groupId == 'tps_general' ) {
			if ( array_key_exists( $options['transition_effect'], TpsOptions::get_transition_effects() ) == false ) {
				$options['transition_effect'] = $defaults['transition_effect'];
				$changed                      = true;
			}

			if ( $options['transition_speed'] < 0 ) {
				$options['transition_speed'] = $defaults['transition_speed'];
				$changed                     = true;
			}
		}

		if ( $groupId == 'tps_nav' ) {
			if ( $options['button_width'] < 0 ) {
				$options['button_width'] = $defaults['button_width'];
				$changed                 = true;
			}
		}

		if ( $groupId == 'tps_advanced' ) {
			if ( $options['refresh_ads_every_n_slides'] < 1 ) {
				$options['refresh_ads_every_n_slides'] = 1;
				$changed                               = true;
			}
		}
	}
}
