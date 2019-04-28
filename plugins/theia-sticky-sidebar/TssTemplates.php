<?php

/*
 * Copyright 2013-2017, Theia Sticky Sidebar, WeCodePixels, http://wecodepixels.com
 */

class TssTemplates {
	public static function getTemplate() {
		$defaults = array(
			'customCss' => ''
		);

		$templates = array(
			'Attitude'                                   => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '#primary, #secondary',
						'containerSelector'   => '#main',
						'additionalMarginTop' => 20,
					)
				),
			),
			'Betheme'                                    => array(
				'customCss' => '
.sidebar .widget-area {
    min-height: inherit !important;
}
',
				'sidebars'  => array(
					array(
						'sidebarSelector'   => '.sidebar-1',
						'containerSelector' => '.content_wrapper',
					)
				),
			),
			'Blue Diamond'                               => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '.sidebar-wrapper',
					)
				),
			),
			'BoldR Lite'                                 => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '#page-container, #sidebar-container',
						'containerSelector'   => '#main-content',
						'additionalMarginTop' => 20,
					)
				),
			),
			'Bolid Theme'                                => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '#secondary',
					)
				),
			),
			'Boutique Shop'                              => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '#secondary',
						'additionalMarginTop' => 30,
					)
				),
			),
			'Catch Box'                                  => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '#primary, #secondary',
						'containerSelector'   => '#main',
						'additionalMarginTop' => 20,
					)
				),
			),
			'Churchope'                                  => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '.left-sidebar, .right-sidebar',
					)
				),
			),
			'Clean Retina'                               => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '#primary, #secondary',
						'containerSelector'   => '#container',
						'additionalMarginTop' => 20,
					)
				),
			),
			'Complexity'                                 => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '#secondary',
					)
				),
			),
			'Customizr'                                  => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '.article-container, .tc-sidebar',
						'additionalMarginTop' => 20,
					)
				),
			),
			'Destro'                                     => array(
				'sidebars' => array(
					array(
						'sidebarSelector'   => '#main_content_section, #sidebar_section',
						'containerSelector' => '#inner_content_section',
					)
				),
			),
			'Directory'                                  => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '#secondary',
					)
				),
			),
			'Eclipse'                                    => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '#secondary',
					)
				),
			),
			'Ego'                                        => array(
				'sidebars' => array(
					array(
						'sidebarSelector'        => '#sidebar',
						'additionalMarginTop'    => 40,
						'additionalMarginBottom' => 40,
					)
				),
			),
			'Enfold'                                     => array(
				'customCss' => '
#top #main .sidebar {
	overflow: auto !important;
}

.widget {
	position: static;
}
',
				'sidebars'  => array(
					array(
						'sidebarSelector' => '.content, .sidebar',
					)
				),
			),
			'Evermore'                                   => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '#sidebar',
						'additionalMarginTop' => 30,
					)
				),
			),
			'EvoLve'                                     => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '#sidebar',
						'additionalMarginTop' => 20,
					)
				),
			),
			'Expound'                                    => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '#sidebar',
					)
				),
			),
			'FUZZY'                                      => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '.post-single-sidebar',
						'containerSelector'   => '.arround',
						'additionalMarginTop' => 130,
					)
				),
			),
			'Flexform'                                   => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => 'aside.sidebar',
						'additionalMarginTop' => 20,
					)
				),
			),
			'Food Recipes'                               => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '#sidebar',
					)
				),
			),
			'Fundify'                                    => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '#sidebar',
						'additionalMarginTop' => 80,
					)
				),
			),
			'Graphene'                                   => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '.sidebar',
						'additionalMarginTop' => 10,
					)
				),
			),
			'Hitched'                                    => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '#sidebar',
						'additionalMarginTop' => 20,
					)
				),
			),
			'I Love It!'                                 => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '#secondary',
						'additionalMarginTop' => 20,
					)
				),
			),
			'INOVADO'                                    => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '#sidebar',
						'additionalMarginTop' => 30,
					)
				),
			),
			'Impression'                                 => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '.sidebar',
					)
				),
			),
			'JPhotolio'                                  => array(
				'sidebars' => array(
					array(
						'sidebarSelector'        => '.sidebar',
						'additionalMarginTop'    => 10,
						'additionalMarginBottom' => 40,
					)
				),
			),
			'Jarida'                                     => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => 'aside.sidebar, aside.sidebar-narrow',
						'additionalMarginTop' => 20,
					)
				),
			),
			'Kaleido'                                    => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '.sidebar-wrap',
					)
				),
			),
			'Kallyas'                                    => array(
				'sidebars' => array(
					array(
						'sidebarSelector'   => '#mainbody > .row > .span3',
						'containerSelector' => '#mainbody',
					)
				),
			),
			'Leaf'                                       => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '#secondary',
					)
				),
			),
			'London Creative +'                          => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '#sidebar_home',
						'additionalMarginTop' => 10,
					)
				),
			),
			'Mantra'                                     => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '#primary',
					)
				),
			),
			'Maya Shop'                                  => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '#sidebar',
					)
				),
			),
			'Mural'                                      => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '#secondary',
						'additionalMarginTop' => 30,
					)
				),
			),
			'Nimble'                                     => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '#aside',
					)
				),
			),
			'Old Paper'                                  => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => 'aside.col-lg-3.col-sm-4',
						'containerSelector'   => '#content > .wrapper > .row',
						'additionalMarginTop' => 20,
					)
				),
			),
			'OneTouch'                                   => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '#left-sidebar, #right-sidebar',
						'additionalMarginTop' => 20,
					)
				),
			),
			'OptimizePress'                              => array(
				'sidebars' => array(
					array(
						'sidebarSelector'   => '.main-sidebar',
						'containerSelector' => '.main-content-area-container',
					)
				),
			),
			'POST'                                       => array(
				'sidebars' => array(
					array(
						'sidebarSelector'   => '.sidebar-main',
						'containerSelector' => '#main',
					)
				),
			),
			'PageLines'                                  => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '#sidebar-wrap',
					)
				),
			),
			'Parament'                                   => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '#sidebar',
					)
				),
			),
			'Pinboard'                                   => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '#sidebar',
					)
				),
			),
			'RT-Theme Seventeen'                         => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '.sidebar',
						'additionalMarginTop' => 15,
					)
				),
			),
			'Radial Premium Theme'                       => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '.sidebar',
						'additionalMarginTop' => 10,
					)
				),
			),
			'Responsive'                                 => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '#widgets',
					)
				),
			),
			'Responsive Fullscreen Studio for WordPress' => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '.sidebar-wrap-single',
						'updateSidebarHeight' => true,
					)
				),
			),
			'SimpleMag'                                  => array(
				'sidebars' => array(
					array(
						'sidebarSelector'   => 'jQuery(".sidebar").parent()',
						'containerSelector' => '#content > article > .wrapper > .grids',
					)
				),
			),
			'Skinizer'                                   => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '#sidebar',
						'additionalMarginTop' => 25,
					)
				),
			),
			'Smart IT'                                   => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '#sidebar',
						'additionalMarginTop' => 25,
					)
				),
			),
			'SmartMag'                                   => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '.sidebar, .main-content',
						'containerSelector'   => '.main > .row',
						'additionalMarginTop' => 20,
					)
				),
			),
			'Sommerce'                                   => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '#sidebar',
					)
				),
			),
			'Sterling'                                   => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => 'aside.sidebar',
					)
				),
			),
			'Sunny Blue Sky'                             => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '.sidebar',
						'additionalMarginTop' => 10,
					)
				),
			),
			'SuperMassive'                               => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '#sidebar',
						'additionalMarginTop' => 10,
					)
				),
			),
			'Symplex'                                    => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '#sidebar',
						'updateSidebarHeight' => true,
					)
				),
			),
			'Terra'                                      => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '#sidebar',
					)
				),
			),
			'The Agency'                                 => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '#sidebar',
					)
				),
			),
			'TrulyMinimal'                               => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '#sidebar',
					)
				),
			),
			'Twenty Eleven'                              => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '#secondary',
					)
				),
			),
			'Twenty Ten'                                 => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '#container, #primary',
						'containerSelector'   => '#main',
						'additionalMarginTop' => 20,
					)
				),
			),
			'Twenty Thirteen'                            => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '.sidebar-inner > .widget-area',
						'containerSelector'   => '#main',
						'additionalMarginTop' => 24,
					)
				),
			),
			'Twenty Twelve'                              => array(
				'sidebars' => array(
					array(
						'sidebarSelector'   => '#primary, #secondary',
						'containerSelector' => '#main',
					)
				),
			),
			'Typegrid'                                   => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '.sidebar',
					)
				),
			),
			'U-Design'                                   => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '#sidebar',
						'additionalMarginTop' => 10,
					)
				),
			),
			'Victoria'                                   => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '#sidebar',
					)
				),
			),
			'WP Opulus'                                  => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '#sidebar',
					)
				),
			),
			'Weaver II'                                  => array(
				'sidebars' => array(
					array(
						'sidebarSelector' => '#sidebar_wrap_left, #sidebar_wrap_right',
					)
				),
			),
			'deTube'                                     => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '#secondary',
						'additionalMarginTop' => 10,
					)
				),
			),
			'discover'                                   => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '#left-col, #sidebar',
						'containerSelector'   => '#content_container',
						'additionalMarginTop' => 20,
					)
				),
			),
			'iFeature'                                   => array(
				'sidebars' => array(
					array(
						'sidebarSelector'     => '#secondary',
						'additionalMarginTop' => 30,
					)
				),
			),
		);

		$theme_name = wp_get_theme()->Name;
		$found_id   = null;

		// Search for an exact match.
		if ( array_key_exists( $theme_name, $templates ) ) {
			$found_id = $theme_name;
		} else {
			// Search for prefixes.
			foreach ( $templates as $template_name => $template_data ) {
				if ( strtolower( substr( $theme_name, 0, strlen( $template_name ) ) ) == strtolower( $template_name ) ) {
					$found_id = $template_name;
					break;
				}
			}
		}

		// Template found.
		if ( $found_id !== null ) {
			// Cleanup.
			$template = $templates[ $found_id ];
			if ( array_key_exists( 'customCss', $template ) ) {
				$template['customCss'] = TssOptions::sanitizeCss( $template['customCss'] );
			}

			return array_merge( $defaults, $template );
		}

		// No match.
		return null;
	}

	public static function useTemplate() {
		$defaults = array(
			'currentTheme' => wp_get_theme()->Name,
			'isTemplate'   => true
		);

		$template = self::getTemplate();

		if ( $template !== null ) {
			$template = array_merge( array_merge( get_option( 'tss_general' ), $defaults ), $template );
			update_option( 'tss_general', $template );
			TssOptions::admin_init();
		}
	}

	// Are the current settings different from the theme's template?
	public static function areSettingsDifferentFromTemplate() {
		$template = self::getTemplate();

		if ( $template === null ) {
			return false;
		}

		foreach ( $template as $template_key => $template_value ) {
			$options_value = TssOptions::get( $template_key );

			if ( is_array( $template_value ) && is_array( $options_value ) ) {
				if (count($template_value) !== count ($options_value)) {
					return true;
				}

				for ($i = 0; $i < count($template_value); $i++) {
					$tt = $template_value[$i];
					$oo = $options_value[$i];

					foreach ( $tt as $kk => $vv ) {
						if ( $vv != $oo[ $kk ] ) {
							return true;
						}
					}
				}
			} else {
				if ( $template_value != $options_value ) {
					return true;
				}
			}
		}

		return false;
	}
}
