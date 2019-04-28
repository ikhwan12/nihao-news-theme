<?php
/**
 * Class GeneralTest
 *
 * @package Smart_Facebook_Page_Like_Overlay
 */

define('TEST_DOMAIN', 'http://wptest.org:9999');

class GeneralTest extends WP_UnitTestCase {

	protected $helper;

	function set_up() {
		system('rm -rf /tmp/wordpress/wp-content/plugins/smart-facebook-page-like-overlay');
		system('cp -R '.dirname(dirname(__FILE__)).' /tmp/wordpress/wp-content/plugins');
		$r = activate_plugin( 'smart-facebook-page-like-overlay-pro/smart-facebook-page-like-overlay.php' );
		if (is_wp_error($r)) {
			error_log('ERROR '.$r->get_error_message());
		}

		$out = $this->get_page();
		preg_match("'<!-- Smart Facebook Page Like Overlay plugin -->'", $out, $matches);
		$this->assertTrue( count($matches) == 1 );
	}

	function get_page() {
		$this->clone_all_tables();
		$this->set_options();

		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, TEST_DOMAIN);  
		curl_setopt($ch, CURLOPT_HEADER, 0);  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
		$output = curl_exec($ch);
		curl_close($ch);

		return $output;
	}

	function clone_table($from, $where) {
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, 'fboverlay_test');
		$mysqli->query('DROP TABLE '.$where);
		$mysqli->query('CREATE TABLE '.$where.' LIKE '.$from);

		global $wpdb;
		$items = $wpdb->get_results( "SELECT * FROM " . $from );

		$items_arr = [];
		foreach ($items as $item) {
			$items_arr[] = "('" . implode("', '",(array)$item) . "')";
		}
		$item_keys = array_keys((array)current($items));
		
		$q = "INSERT INTO " . $where . " (" . implode(', ', $item_keys) . ") VALUES " . implode(', ', $items_arr);
		$r = $mysqli->query($q);

		$mysqli->close();	
	}

	function set_options() {
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, 'fboverlay_test');
		$q = "UPDATE wp_options SET option_value = '" . TEST_DOMAIN . "' WHERE option_name = 'siteurl' OR option_name = 'home'";
		$mysqli->query($q);
		$mysqli->close();			
	}

	function clone_all_tables() {

		$wp_tables = [
			'commentmeta', 
			'comments', 
			'links', 
			'options', 
			'postmeta', 
			'posts', 
			'termmeta', 
			'terms', 
			'term_relationships',
			'term_taxonomy',
			'usermeta',
			'users'
		];

		foreach ($wp_tables as $table) {
			$this->clone_table('wptests_'.$table, 'wp_'.$table);
		}		

	}

	function test_plugin_presence() {
		$this->set_up();
	}
}
