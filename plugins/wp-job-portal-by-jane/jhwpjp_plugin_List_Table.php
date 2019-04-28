<?php

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class jhwpjp_plugin_List_Table extends WP_List_Table {

	var $dataset;
	var $totalCount = 0;
	var $privateCount = 0;
	var $publicCount = 0;

    function __construct($data){
    global $status, $page;

		$this->dataset = $data;
	
        parent::__construct( array(
            'singular'  => __( 'job', 'jobstable' ),     //singular name of the listed records
            'plural'    => __( 'jobs', 'jobstable' ),   //plural name of the listed records
            'ajax'      => false        //does this table support ajax?

    ) );

    // add_action( 'admin_head', array( &$this, 'admin_header' ) );            

    }

  function admin_header() {
    echo '<style type="text/css">';
    echo '.wp-list-table .column-id { width: 5%; }';
    echo '.wp-list-table .column-booktitle { width: 40%; }';
    echo '.wp-list-table .column-author { width: 35%; }';
    echo '.wp-list-table .column-isbn { width: 20%;}';
    echo '</style>';
  }

  function no_items() {
    _e( 'No jobs found.' );
  }

  function column_default( $item, $column_name ) {
    switch( $column_name ) { 
        case 'Title':
        case 'ManagerName':
        case 'PostedDate':
        case 'IsPublic':		
            return $item[ $column_name ];
		case 'Location':
			return $item['City'] . ', ' . $item['State'];
        default:
            return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
    }
  }

function get_sortable_columns() {
  $sortable_columns = array(
    'Title'  => array('Title',false),
	'Location'  => array('Location',false),
    'ManagerName' => array('ManagerName',false),
	'PostedDate' => array('PostedDate',false),
    'IsPublic'   => array('IsPublic',false)
  );
  return $sortable_columns;
}

function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />',
            'Title' => __( 'Job Title', 'jobstable' ),
			'Location' => __( 'Location', 'jobstable' ),
			'ManagerName' => __( 'Manager', 'jobstable' ),
			'PostedDate' => __( 'Date', 'jobstable' ),
			'IsPublic' => __( 'Status', 'jobstable' )
        );
         return $columns;
    }

function usort_reorder( $a, $b ) {
  // If no sort, default to title
  $orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'PostedDate';
  // If no order, default to desc
  $order = ( ! empty($_GET['order'] ) ) ? $_GET['order'] : 'desc';
  // Determine sort order
  $result = strcmp( $a[$orderby], $b[$orderby] );
  // Send final sort direction to usort
  return ( $order === 'asc' ) ? $result : -$result;
}


function column_title($item){

  $jp = get_page_by_title( $item['Title'] );
	
  $actions = array(
            'edit'      => sprintf('<a href="?page=%s&action=%s&job=%s">Edit</a>',$_REQUEST['page'],'editJob',$item['ApplicationPageID']),
            'view'    => sprintf('<a href="%s">View</a>', jhwpjp_GetJobPageUrl( $item['ApplicationPageID'], $item['Title'], $item['Url'] )),
        );
		
	if( empty($jp) )
		$actions['create_page'] = sprintf('<a href="?page=%s&action=%s&job[]=%s">Create Page</a>',$_REQUEST['page'],'make_pages',$item['ApplicationPageID']);

  return sprintf('%1$s %2$s', $item['Title'], $this->row_actions($actions) );
}

function get_bulk_actions() {
  $actions = array(
    'private'    => 'Make Private',
	'public'    => 'Make Public',
	'make_pages'    => 'Create Job Pages'
  );
  return $actions;
}

function process_bulk_action() {

	// nonce validation
	if ( isset( $_POST['_wpnonce'] ) && ! empty( $_POST['_wpnonce'] ) ) {

		$nonce  = filter_input( INPUT_POST, '_wpnonce', FILTER_SANITIZE_STRING );
		$action = 'bulk-' . $this->_args['plural'];

		if ( ! wp_verify_nonce( $nonce, $action ) )
			wp_die( 'Nope! Security check failed!' );

	}   

    $action = $this->current_action();
	
	$jobs = $_POST['job'];
	
	if( empty($jobs) && !empty( $_GET['job'] ) ) { $jobs = $_GET['job']; }
	
    switch ( $action ) {

        case 'private':
			
			// make specified jobs private
			foreach( $jobs as $job )
				jhwpjp_MakePrivate($job);		
		
            // reload data
			$this->dataset = jhwpjp_GetJobsDataForTable();
            break;
			
        case 'public':
			
			// make specified jobs public
			foreach( $jobs as $job )
				jhwpjp_MakePublic($job);		
		
            // reload data
			$this->dataset = jhwpjp_GetJobsDataForTable();
            break;

        case 'make_pages':
			
			// create posts for the specified jobs 
			foreach( $jobs as $job )
				jhwpjp_CreatePost($job);		

            break;			

        default:
             // do nothing or something else
            return;
            break;
        }

    return;
}

function column_cb($item) {
        return sprintf(
            '<input type="checkbox" name="job[]" value="%s" />', $item['ApplicationPageID']
        );    
    }
	
function column_PostedDate($item) {
        return sprintf('%s', jhwpjp_parseJsonDate($item['PostedDate']));    
    }	
	
function column_IsPublic($item) {
        return sprintf('%s', ($item['IsPublic'] ? 'Public' : 'Private'));    
    }	
	
protected function get_views() { 
   $views = array();
   $current = ( !empty($_REQUEST['job-table-filter']) ? $_REQUEST['job-table-filter'] : 'all');

   // All link
   $class = ($current == 'all' ? ' class="current"' :'');
   $all_url = remove_query_arg('job-table-filter');
   $views['all'] = "<a href='{$all_url }' {$class} >All <span class='count'>(" . $this->totalCount . ")</span></a>";

   // Private link
   $private_url = add_query_arg('job-table-filter','private');
   $class = ($current == 'private' ? ' class="current"' :'');
   $views['private'] = "<a href='{$private_url}' {$class} >Private <span class='count'>(" . $this->privateCount . ")</span></a>";

   // Public link
   $public_url = add_query_arg('job-table-filter','public');
   $class = ($current == 'public' ? ' class="current"' :'');
   $views['public'] = "<a href='{$public_url}' {$class} >Public <span class='count'>(" . $this->publicCount . ")</span></a>";

   return $views;
}	

function DoFilter()
{
  $filtered   = array();  	
	
  // filter counts
  foreach($this->dataset as $row) {
	  if( $row['IsPublic'] ) {
		  $this->publicCount++;
	  } else {
		  $this->privateCount++;
	  }
	  $this->totalCount++;
  }
  
  // run the filter
  $filter = ( !empty($_REQUEST['job-table-filter']) ? $_REQUEST['job-table-filter'] : 'all');
  if( $filter != 'all' )
  {
	foreach($this->dataset as $row) {
		if( ($filter == 'private') && !$row['IsPublic'] ) { array_push( $filtered, $row ); }
		if( ($filter == 'public') && $row['IsPublic'] ) { array_push( $filtered, $row ); }		
	}
	
	$this->dataset = $filtered;
  }	
}

function prepare_items() {
  $this->process_bulk_action();
  $columns  = $this->get_columns();
  $hidden   = array();
  $sortable = $this->get_sortable_columns();
  $this->_column_headers = array( $columns, $hidden, $sortable );
  usort( $this->dataset, array( &$this, 'usort_reorder' ) );
  
  $this->DoFilter();
  
  $per_page = 5;
  $current_page = $this->get_pagenum();
  $total_items = count( $this->dataset );

  // only ncessary because we have sample data
  $paged_data = array_slice( $this->dataset,( ( $current_page-1 )* $per_page ), $per_page );

  $this->set_pagination_args( array(
    'total_items' => $total_items,                  //WE have to calculate the total number of items
    'per_page'    => $per_page                     //WE have to determine how many items to show on a page
  ) );
  $this->items = $paged_data;
}

} //class


function jhwpjp_plugin_jobs_table($data){
  global $jobsTable;
  $option = 'per_page';
  $args = array(
         'label' => 'Jobs',
         'default' => 10,
         'option' => 'jobs_per_page'
         );
  add_screen_option( $option, $args );
  $jobsTable = new jhwpjp_plugin_List_Table($data);  
  echo '<div class="wrap">'; 
  echo '<h1 class="wp-heading-inline">Jobs</h1>';
  echo '<a href="' . esc_url( add_query_arg('action','addJob') ) . '" class="page-title-action">Add New</a>';
  echo '<hr class="wp-header-end">';
  $jobsTable->prepare_items(); 
  $jobsTable->views(); 
?>
  <form method="post">
    <input type="hidden" name="page" value="jobs_list_table">
    <?php
    // $jobsTable->search_box( 'search', 'search_id' );
	$jobsTable->display(); 
	?>
  </form></div> 
  <?php
}
