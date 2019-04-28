<?php

/*
 * Copyright 2013-2017, Theia Sticky Sidebar, WeCodePixels, http://wecodepixels.com
 */

// Sanitize/migrate options when accessing the admin page.
add_action( 'admin_init', 'TssOptions::admin_init' );

// Sanitize options before updating them.
add_filter( 'pre_update_option', 'TssOptions::pre_update_option', 10, 3 );

class TssOptions {
	public static function get( $optionId ) {
		$groups = array( 'tss_general' );
		foreach ( $groups as $groupId ) {
			$options = get_option( $groupId );
			if ( array_key_exists( $optionId, $options ) ) {
				return $options[ $optionId ];
			}
		}

		return null;
	}

	public static function get_defaults() {
		$defaults = array(
			'tss_dashboard' => array(
				'reset_to_defaults' => ''
			),
			'tss_general'   => array(
				'currentTheme'           => '',
				'isTemplate'             => false,
				'disableOnHomePage'      => false,
				'disableOnCategoryPages' => false,
				'disableOnPages'         => false,
				'disableOnPosts'         => false,
				'customCss'              => '',
				'preRenderContainersForSidebars' => false,
				'sidebars'               => array(
					'sidebarName'                => '',
					'sidebarSelector'            => '',
					'containerSelector'          => '',
					'additionalMarginTop'        => 0,
					'additionalMarginBottom'     => 0,
					'updateSidebarHeight'        => false,
					'minWidth'                   => 0,
					'disableOnResponsiveLayouts' => true,
					'sidebarBehavior'            => 'modern',
					'enabledPosts'               => ''
				),
			)
		);

		return $defaults;
	}

	// Initialize options
	public static function admin_init() {
		$defaults = self::get_defaults();

		// Reset to defaults.
		$reset_to_defaults = get_option( 'tss_dashboard' );
		$reset_to_defaults = is_array( $reset_to_defaults ) && array_key_exists( 'reset_to_defaults', $reset_to_defaults ) && $reset_to_defaults['reset_to_defaults'];
		if ( $reset_to_defaults ) {
			foreach ( $defaults as $groupId => $groupValues ) {
				delete_option( $groupId );
			}
		}

		// Migrate legacy sidebar options.
		{
			$options = get_option( 'tss_general' );
			if ( is_array( $options ) ) {
				$legacy_sidebar = array();
				$legacy_options = $defaults['tss_general']['sidebars'];
				foreach ( $legacy_options as $key => $value ) {
					if ( array_key_exists( $key, $options ) ) {
						$legacy_sidebar [ $key ] = $options[ $key ];
					}
				}

				// Save legacy sidebar.
				if ( $legacy_sidebar !== array() ) {
					$options['sidebars'] = array( $legacy_sidebar );
					update_option( 'tss_general', $options );
				}
			}
		}

		foreach ( $defaults as $groupId => $groupDefaults ) {
			$options = get_option( $groupId );

			if ( ! is_array( $options ) ) {
				$options = array();
				$changed = true;
			} else {
				$changed = false;
			}

			self::sanitizeOptions( $groupDefaults, $options, $changed );

			// Migrate legacy options.
			if ( $groupId == 'tss_general' ) {
				foreach ( $options['sidebars'] as &$sidebar ) {
					if ( $sidebar['sidebarBehavior'] == 'legacy' ) {
						$sidebar['sidebarBehavior'] = 'stick-to-bottom';
						$changed                    = true;
					}
				}
			}

			// Save options.
			if ( $changed ) {
				update_option( $groupId, $options );
			}
		}

		// Are the current settings for a different theme? If there is a template available, then use it.
		if (
			self::get( 'currentTheme' ) != wp_get_theme()->Name &&
			TssTemplates::getTemplate() !== null
		) {
			TssTemplates::useTemplate();
		}
	}

	public static function pre_update_option( $value, $option, $old_value ) {
		$defaults = self::get_defaults();

		if ( ! array_key_exists( $option, $defaults ) ) {
			return $value;
		}

		self::sanitizeOptions( $defaults[ $option ], $value, $changed );

		return $value;
	}

	public static function sanitizeOptions( $defaults, &$options, &$changed ) {
		// Add missing options.
		foreach ( $defaults as $key => $value ) {
			if ( array_key_exists( $key, $options ) == false ) {
				$changed         = true;
				$options[ $key ] = $value;
			}
		}

		// Remove surplus options.
		foreach ( $options as $key => $value ) {
			if ( array_key_exists( $key, $defaults ) == false ) {
				$changed = true;
				unset( $options[ $key ] );
			}
		}

		// Sanitize options.
		foreach ( $options as $key => $value ) {
			if ( is_bool( $defaults[ $key ] ) ) {
				$newValue = ( $options[ $key ] === true || $options[ $key ] === 'true' || $options[ $key ] === 'on' ) ? true : false;

				if ( $newValue !== $options[ $key ] ) {
					$options[ $key ] = $newValue;
					$changed         = true;
				}
			} else if ( is_numeric( $defaults[ $key ] ) ) {
				$newValue = (float) $options[ $key ];

				if ( $newValue !== $options[ $key ] ) {
					$options[ $key ] = $newValue;
					$changed         = true;
				}
			} else if ( is_array( $defaults[ $key ] ) ) {
				// Consider arrays as repeaters.
				// Try to parse as JSON.
				if ( is_string( $options[ $key ] ) ) {
					$options[ $key ] = json_decode( $options[ $key ], true );
					$changed         = true;
				}

				// Check if this is an array of arrays.
				if ( is_array( $options[ $key ] ) ) {
					$is_array_of_arrays = true;
					foreach ( $options[ $key ] as $kk => $vv ) {
						if ( ! is_array( $vv ) ) {
							$is_array_of_arrays = false;

							break;
						}
					}

					if ( count( $options[ $key ] ) === 0 || ! $is_array_of_arrays ) {
						$options[ $key ] = array( $defaults[ $key ] );
						$changed         = true;
					}
				} else {
					$options[ $key ] = array( $defaults[ $key ] );
					$changed         = true;
				}

				foreach ( $options[ $key ] as $kk => $vv ) {
					self::sanitizeOptions( $defaults[ $key ], $options[ $key ][ $kk ], $changed );
				}
			}

			if ( $key == 'customCss' ) {
				$options[ $key ] = self::sanitizeCss( $options[ $key ] );
			}
		}
	}

	public static function sanitizeCss( $css ) {
		$css = trim( $css );
		$css = str_replace( "\r\n", "\n", $css );

		return $css;
	}
}