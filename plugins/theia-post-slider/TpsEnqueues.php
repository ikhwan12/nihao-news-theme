<?php

/*
 * Copyright 2012-2018, Theia Post Slider, WeCodePixels, http://wecodepixels.com
 */

add_action( 'wp_enqueue_scripts', 'TpsEnqueues::wp_enqueue_scripts' );
add_action( 'admin_enqueue_scripts', 'TpsEnqueues::admin_enqueue_scripts' );
add_filter( 'script_loader_tag', 'TpsEnqueues::script_loader_tag', 10, 2 );

class TpsEnqueues {
	// Enqueue the required JavaScript for a given transition effect.
	public static function enqueue_transition( $transition ) {
		wp_register_script( 'theiaPostSlider/transition.js', TPS_PLUGINS_URL . 'js/tps-transition-' . $transition . '.js', array( 'jquery' ), TPS_VERSION );
		wp_enqueue_script( 'theiaPostSlider/transition.js' );
	}

	// Enqueue JavaScript and CSS.
	public static function wp_enqueue_scripts() {
		// Do not load unless necessary.
		if ( ! is_admin() && ! TpsMisc::is_compatible_post() ) {
			return;
		}

		// Theme.
		$theme = TpsOptions::get( 'theme_type' ) == 'font' ? 'font-theme.css' : TpsOptions::get( 'theme' );
		if ( $theme != 'none' ) {
			wp_register_style( 'theiaPostSlider', TPS_PLUGINS_URL . 'css/' . $theme, array(), TPS_VERSION );
			wp_enqueue_style( 'theiaPostSlider' );
		}

		// Font icons.
		if ( is_admin() || TpsOptions::get( 'theme_type' ) == 'font' ) {
			wp_register_style( 'theiaPostSlider-font', TPS_PLUGINS_URL . 'fonts/style.css', array(), TPS_VERSION );
			wp_enqueue_style( 'theiaPostSlider-font' );
		}

		if ( ! is_admin() ) {
			// history.js
			wp_register_script( 'history.js', TPS_PLUGINS_URL . 'js/balupton-history.js/jquery.history.js', array( 'jquery' ), '1.7.1' );
			wp_enqueue_script( 'history.js' );
		}

		// async.js
		wp_register_script( 'async.js', TPS_PLUGINS_URL . 'js/async.min.js', array(), '14.09.2014' );
		wp_enqueue_script( 'async.js' );

		// Hammer.js
		if ( TpsOptions::get( 'enable_touch_gestures', 'tps_advanced' ) ) {
			wp_register_script( 'hammer.js', TPS_PLUGINS_URL . 'js/hammer.min.js', array(), '2.0.4' );
			wp_enqueue_script( 'hammer.js' );
		}

		// The slider
		wp_register_script( 'theiaPostSlider/theiaPostSlider.js', TPS_PLUGINS_URL . 'js/tps.js', array( 'jquery' ), TPS_VERSION );
		wp_enqueue_script( 'theiaPostSlider/theiaPostSlider.js' );

		// Declarative approach js
		wp_register_script( 'theiaPostSlider/main.js', TPS_PLUGINS_URL . 'js/main.js', array( 'jquery' ), TPS_VERSION );
		wp_enqueue_script( 'theiaPostSlider/main.js' );

		// The selected transition effect
		self::enqueue_transition( TpsOptions::get( 'transition_effect' ) );

		if ( is_rtl() ) {
			wp_register_style( 'theiaPostSlider-rtl', TPS_PLUGINS_URL . 'css/rtl.css', array(), TPS_VERSION );
			wp_enqueue_style( 'theiaPostSlider-rtl' );
		}

		// Add inline styles.
		self::add_inline_styles();
	}

	// Add attributes to bypass Cloudflare's Rocket Loader.
	public static function script_loader_tag( $tag, $handle ) {
		if ( ! TpsOptions::get( 'disable_rocketscript' ) ) {
			return $tag;
		}

		if ( ! in_array( $handle, array( 'jquery', 'jquery-core', 'jquery-migrate', 'history.js', 'async.js', 'hammer.js', 'theiaPostSlider/theiaPostSlider.js', 'theiaPostSlider/main.js', 'theiaPostSlider/transition.js' ) ) ) {
			return $tag;
		}

		return str_replace( ' src', ' data-cfasync="false" src', $tag );
	}

	// Enqueue JavaScript and CSS for the admin interface.
	public static function admin_enqueue_scripts( $hookSuffix ) {
        if ($hookSuffix !== 'settings_page_tps') {
            return;
        }

		self::wp_enqueue_scripts();

		// Enqueue all transition scripts for live preview.
		foreach ( TpsOptions::get_transition_effects() as $key => $value ) {
			self::enqueue_transition( $key );
		}

		// CSS, even if there is no theme, so we can change the path via JS.
		if ( TpsOptions::get( 'theme' ) == 'none' ) {
			wp_register_style( 'theiaPostSlider', TPS_PLUGINS_URL . 'css/' . TpsOptions::get( 'theme' ), TPS_VERSION );
			wp_enqueue_style( 'theiaPostSlider' );
		}

		// Admin CSS
		wp_register_style( 'theiaPostSlider-admin', TPS_PLUGINS_URL . 'css/admin.css', array(), TPS_VERSION );
		wp_enqueue_style( 'theiaPostSlider-admin' );

		// Color picker
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );

        // Slim Select
        wp_enqueue_style('slimselect', TPS_PLUGINS_URL . 'node_modules/slim-select/dist/slimselect.min.css', array(), TPS_VERSION);
        wp_enqueue_script('slimselect', TPS_PLUGINS_URL . 'node_modules/slim-select/dist/slimselect.min.js', array('jquery'), TPS_VERSION);
    }

	protected static function add_inline_styles() {
		$css = array();

		$css[] = TpsOptions::get( 'custom_css' );

		// Additional CSS for vector themes.
		if ( TpsOptions::get( 'theme_type' ) == 'font' || is_admin() ) {
			$colors = TpsColors::get_variations( TpsOptions::get( 'theme_font_color' ) );

			$css[] = "
				.theiaPostSlider_nav.fontTheme ._title,
				.theiaPostSlider_nav.fontTheme ._text {
					line-height: " . TpsOptions::get( 'theme_font_size' ) . "px;
				}
	
				.theiaPostSlider_nav.fontTheme ._button,
				.theiaPostSlider_nav.fontTheme ._button svg {
					color: " . TpsOptions::get( 'theme_font_color' ) . ";
					fill: " . TpsOptions::get( 'theme_font_color' ) . ";
				}
	
				.theiaPostSlider_nav.fontTheme ._button ._2 span {
					font-size: " . TpsOptions::get( 'theme_font_size' ) . "px;
					line-height: " . TpsOptions::get( 'theme_font_size' ) . "px;
				}
	
				.theiaPostSlider_nav.fontTheme ._button ._2 svg {
					width: " . TpsOptions::get( 'theme_font_size' ) . "px;
				}
	
				.theiaPostSlider_nav.fontTheme ._button:hover,
				.theiaPostSlider_nav.fontTheme ._button:focus,
				.theiaPostSlider_nav.fontTheme ._button:hover svg,
				.theiaPostSlider_nav.fontTheme ._button:focus svg {
					color: " . TpsColors::hsl_to_hex( $colors['hover_color'] ) . ";
					fill: " . TpsColors::hsl_to_hex( $colors['hover_color'] ) . ";
				}
	
				.theiaPostSlider_nav.fontTheme ._disabled,				 
                .theiaPostSlider_nav.fontTheme ._disabled svg {
					color: " . TpsColors::hsl_to_hex( $colors['disabled_color'] ) . " !important;
					fill: " . TpsColors::hsl_to_hex( $colors['disabled_color'] ) . " !important;
				}
			";

			$buttonCss = array();

			if ( TpsOptions::get( 'theme_padding' ) ) {
				$buttonCss[] = 'padding: ' . TpsOptions::get( 'theme_padding' ) . 'px;';
			}

			if ( TpsOptions::get( 'theme_border_radius' ) ) {
				$buttonCss[] = 'border-radius: ' . TpsOptions::get( 'theme_border_radius' ) . 'px;';
			}

			if ( TpsOptions::get( 'theme_background_color' ) ) {
				$buttonCss[] = 'background-color: ' . TpsOptions::get( 'theme_background_color' ) . ';';
			}

			if ( count( $buttonCss ) ) {
				$css[] = "
					.theiaPostSlider_nav.fontTheme ._buttons ._button {
						" . implode( "\n", $buttonCss ) . "
					}
				";
			}
		}

		wp_add_inline_style( 'theiaPostSlider', implode( "\n", $css ) );
	}
}
