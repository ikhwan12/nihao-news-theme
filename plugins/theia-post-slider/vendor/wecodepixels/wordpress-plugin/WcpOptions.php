<?php

if ( ! class_exists( 'WcpOptions_1_0_0' ) ) {
	abstract class WcpOptions_1_0_0 {
		protected static function allow_repeater_arrays() {
			return false;
		}

		protected static function get_overwrites( $overwrites ) {
			return $overwrites;
		}

		protected static function get_defaults() {
			return array();
		}

		protected static function sanitize_options( $defaults, &$options, &$changed, $groupId ) {
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
					if ( static::allow_repeater_arrays() ) {
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
							static::sanitize_options( $defaults[ $key ], $options[ $key ][ $kk ], $changed, $groupId );
						}
					} else {
						if ( ! is_array( $options[ $key ] ) ) {
							$options[ $key ] = $defaults[ $key ];
							$changed         = true;
						}
					}
				}
			}
		}

		public static function pre_update_option( $value, $option, $old_value ) {
			$defaults = static::get_defaults();

			if ( ! array_key_exists( $option, $defaults ) ) {
				return $value;
			}

			static::sanitize_options( $defaults[ $option ], $value, $changed, $option );

			return $value;
		}

		public static function admin_init() {
			$overwrites = static::get_overwrites( array_fill_keys( static::get_groups(), array() ) );
			$defaults   = static::get_defaults();

			// Sanitize, validate.
			foreach ( $defaults as $groupId => $groupDefaults ) {
				$options = get_option( $groupId );

				if ( ! is_array( $options ) ) {
					$options = array();
					$changed = true;
				} else {
					$changed = false;
				}
				static::sanitize_options( $groupDefaults, $options, $changed, $groupId );

				// Overwrite options.
				if ( array_key_exists( $groupId, $overwrites ) ) {
					foreach ( $overwrites[ $groupId ] as $overwriteKey => $overwriteValue ) {
						$options[ $overwriteKey ] = $overwriteValue;
						$changed                  = true;
					}
				}

				// Save options.
				if ( $changed ) {
					update_option( $groupId, $options );
				}
			}
		}

		// Get generic enabled/disabled options.
		public static function get_generic_boolean() {
			$options = array(
				'false' => 'Disabled',
				'true'  => 'Enabled'
			);

			return $options;
		}

		public static function get( $optionId, $optionGroups = null ) {
			if ( $optionGroups === null ) {
				$optionGroups = static::get_groups();
			}

			$value = null;

			if ( ! is_array( $optionGroups ) ) {
				$optionGroups = array( $optionGroups );
			}

			foreach ( $optionGroups as $groupId ) {
				$options = get_option( $groupId );

				if ( ! is_array( $options ) ) {
					continue;
				}

				if ( array_key_exists( $optionId, $options ) ) {
					$value = $options[ $optionId ];

					break;
				}
			}

			return $value;
		}

		public static function get_groups() {
			$defaults = static::get_defaults();
			$groups   = array_keys( $defaults );

			return $groups;
		}

		// Reset all options expect for the "purchase_code".
		public static function reset_global_settings() {
			$defaults = static::get_defaults();

			foreach ( $defaults as $groupId => $groupValues ) {
				$purchaseCode = null;
				if ( array_key_exists( 'purchase_code', $groupValues ) ) {
					$purchaseCode = self::get( 'purchase_code', $groupId );
				}

				delete_option( $groupId );

				if ( $purchaseCode ) {
					update_option( $groupId, array( 'purchase_code' => $purchaseCode ) );
				}
			}
		}
	}
}
