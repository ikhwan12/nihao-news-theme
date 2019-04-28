<?php

/*
 * Copyright 2013-2017, Theia Sticky Sidebar, WeCodePixels, http://wecodepixels.com
 */

add_action( 'admin_init', 'TssAdmin::admin_init' );
add_action( 'admin_menu', 'TssAdmin::admin_menu' );

class TssAdmin {
	public static function admin_init() {
		register_setting( 'tss_options_dashboard', 'tss_dashboard', 'TssAdmin::validate' );
		register_setting( 'tss_options_general', 'tss_general', 'TssAdmin::validate' );
	}

	public static function admin_menu() {
		add_options_page( 'Theia Sticky Sidebar Settings', 'Theia Sticky Sidebar ', 'manage_options', 'tss', 'TssAdmin::do_page' );
	}

	public static function do_page() {
		$tabs = array(
			'dashboard' => array(
				'title' => __( "Dashboard", 'theia-sticky-sidebar' ),
				'class' => 'Dashboard'
			),
			'general'   => array(
				'title' => __( "General", 'theia-sticky-sidebar' ),
				'class' => 'General'
			)
		);
		if ( array_key_exists( 'tab', $_GET ) && array_key_exists( $_GET['tab'], $tabs ) ) {
			$current_tab = $_GET['tab'];
		} else {
			$current_tab = 'dashboard';
		}
		?>

		<div class="wrap">
			<a class="theiaStickySidebar_adminLogo"
			   href="http://wecodepixels.com/?utm_source=theia-sticky-sidebar-for-wordpress"
			   target="_blank"><img src="<?php echo plugins_url( '/images/wecodepixels-logo.png', __FILE__ ); ?>"></a>

			<h2 class="theiaStickySidebar_adminTitle">
				<a href="http://wecodepixels.com/products/theia-sticky-sidebar-for-wordpress/?utm_source=theia-sticky-sidebar-for-wordpress"
				   target="_blank"><img src="<?php echo plugins_url( '/images/theia-sticky-sidebar-thumbnail.png', __FILE__ ); ?>"></a>
				Theia Sticky Sidebar
			</h2>

			<h2 class="nav-tab-wrapper">
				<?php
				foreach ( $tabs as $id => $tab ) {
					$class = 'nav-tab';
					if ( $id == $current_tab ) {
						$class .= ' nav-tab-active';
					}
					?>
					<a href="?page=tss&tab=<?php echo $id; ?>"
					   class="<?php echo $class; ?>"><?php echo $tab['title']; ?></a>
				<?php
				}
				?>
			</h2>
			<?php
			$class = 'TssAdmin_' . $tabs[ $current_tab ]['class'];
			require $class . '.php';
			$page = new $class;
			$page->echoPage();
			?>
		</div>
	<?php
	}

	public static function validate( $input ) {
		return $input;
	}
}