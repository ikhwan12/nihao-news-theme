<?php


if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Youmax_Instance_List extends WP_List_Table {

	// Class constructor
	public function __construct() {

		parent::__construct( array(
			'singular' => 'Youmax Instance', //singular name of the listed records
			'plural'   => 'Youmax Instances', //plural name of the listed records
			'ajax'     => false //does this table support ajax?
		) );

	}


	public static function get_youmax_instances( $per_page = 10, $offset = 0 ) {
		
		$args = array( 	'posts_per_page' => $per_page, 
						'offset'=> $offset, 
						'post_type' => 'youmax-pro-post',
						'orderby' => 'date',
						'order' => 'DESC',
						'post_status' => 'publish',
					);

		if(isset($_POST['s'])) {
			$search = $_POST['s'];
			$args['s'] = $search;
			$args['posts_per_page'] = 100;
		}
		
		if(isset($_GET['orderby'])) {
			$orderby = $_GET['orderby'];
			$args['orderby'] = $orderby;
		}
		
		if(isset($_GET['order'])) {
			$order = $_GET['order'];
			$args['order'] = $order;			
		}
		
		$myposts = get_posts( $args );
		$youmax_data = array();
		

		$count = 0;
		foreach ( $myposts as $post ) {
			$youmax_data[$count] = array();
			$youmax_data[$count]['youmax_post_id'] = $post->ID;
			$youmax_data[$count]['youmax_post_title'] = $post->post_title;
			$youmax_data[$count]['youmax_post_content'] = $post->post_content;
			$youmax_data[$count]['youmax_post_date'] = $post->post_date;
			$youmax_data[$count]['youmax_post_shortcode'] = '[youmaxpro id="'.$post->ID.'" name="'.$post->post_title.'"]';
			
			$count++;
		}

		return $youmax_data;
	}


	public static function record_count() {

		$count = 0;
		if(isset($_POST['s'])) {

		
			$args = array( 	'posts_per_page' => 100, 
							'post_type' => 'youmax-pro-post',
							'post_status' => 'publish',
							's' => $_POST['s']
						);

			$myposts = get_posts( $args );
			$count = count($myposts);

	
		} else {
			$post_count = wp_count_posts('youmax-pro-post');
			$count = $post_count->publish;
		}

		return $count;
	}


	/** Text displayed when no item data is available */
	public function no_items() {
		'No Youmax Instances Avaliable.';
	}

	public function column_youmax_post_title( $item ) {		
		
		$actions = array(
			'edit'      => sprintf('<a href="?page=%s&action=%s&instance=%s">Edit</a>','youmax-single','edit',$item['youmax_post_id']),
			//duplicate will be added in next version
			//'duplicate' => sprintf('<a href="?page=%s&action=%s&instance=%s">Duplicate</a>','youmax-single','duplicate',$item['youmax_post_id']),
			'delete'    => sprintf('<a href="?page=%s&action=%s&instance=%s">Delete</a>',$_REQUEST['page'],'delete',$item['youmax_post_id']),
		);
		
		$post_title = '<a href="?page=youmax-single&action=edit&instance='.$item['youmax_post_id'].'"><span class="youmax-post-title">'.$item['youmax_post_title'].'</span></a>';

		return sprintf('%1$s %2$s', $post_title, $this->row_actions($actions) );
		
	}

	public function column_youmax_post_shortcode( $item ) {
				
		return '<span class="youmax-shortcode">'.$item['youmax_post_shortcode'].'</span>';
		
	}

	public function column_youmax_post_date( $item ) {
		
		$readable_date = mysql2date('j F, Y',$item['youmax_post_date']);
		$readable_date = $readable_date.'<br/>'.mysql2date('G:i',$item['youmax_post_date']);
		
		return $readable_date;
		
	}


	function get_columns() {
		$columns = array(
			'youmax_post_title'    		=> 'Name',
			'youmax_post_shortcode' 	=> 'Shortcode',
			'youmax_post_date'			=> 'Date'
		);

		return $columns;
	}

	
	function get_sortable_columns() {
		$sortable_columns = array(
			'youmax_post_title'  => array('title',false),
			'youmax_post_date' => array('date',false),
		);
		return $sortable_columns;
	}	

	//Handles data query and filter, sorting, and pagination
	public function prepare_items() {
		
		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array($columns, $hidden, $sortable);		
		
		/** Process bulk action */
		if(isset($_POST['s'])) {
			$per_page     = 100;
		} else {
			$per_page     = 10;
		}
		$current_page = ($this->get_pagenum() - 1) * $per_page;
		$total_items  = self::record_count();


		$this->set_pagination_args( array(
			'total_items' => $total_items, //WE have to calculate the total number of items
			'per_page'    => $per_page //WE have to determine how many items to show on a page
		) );
		
		$this->items = self::get_youmax_instances( $per_page, $current_page );
	}

	
}