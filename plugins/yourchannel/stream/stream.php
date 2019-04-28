<?php
if( !defined( 'ABSPATH' ) ) die('They dead me.');

include_once 'api.php';

class YourChannelStream extends YourChannelStreamAPI {
	
	public function __construct( $source = array() ) {
		parent::__construct( $source );
	}
	
	function setSource( $args ){
		$this->source = $args;
		$this->siteInit();
	}
	
	public function checkCache( $delete=false ){
		$str = '';
		foreach($this->source as $v){
			$str .= (is_array($v) ? implode(',', $v) : $v);
		}
		
		$this->cache_key = 'yrc_'.md5($str);
		if($delete) delete_transient( $this->cache_key );
		$this->cache = get_transient( $this->cache_key );
	}
		
	function requestFeed(){
		//echo $this->cache ? 'Cache': 'Live';
		if( $this->cache ){
			 $cache = $this->cache[ in_array($this->source['stream'], array('playlist', 'search', 'custom')) ? 'uploads': $this->source['stream'] ];
			 if( is_array($cache) && isset( $cache['yrc_error'] ) ){}
			 else return $cache;
		}
		
		//echo $this->URL();
										
		$videos = array();		
		$body = wp_remote_retrieve_body( wp_remote_get( $this->URL() ) );
		
		if( !is_wp_error($body) ) $response = json_decode( $body );
		
		//wp_send_json( $response );
						
		if( is_wp_error($body) || !is_object($response) || property_exists( $response, 'error' ) ){
			
			if( is_wp_error($body) ) $this->error_msg = 'No Internet Connection';
			else if ( !$response )  $this->error_msg = 'Unknown Error. Try Again.';
			else $this->error_msg = $response->error->errors[0]->domain.', '.$response->error->errors[0]->reason.' :- '.$response->error->errors[0]->message;
			
			$this->error++;
			return array('yrc_error' => $this->error_msg, 'items' => array());
		}
						
		if($this->source['stream'] === 'banner' || $this->source['stream'] === 'custom'){
			return $response;
		}
				
		$vidids = array();
		$is_playlist = $this->source['stream'] === 'playlist';
		$is_playlists = $this->source['stream'] === 'playlists';
									
		foreach($response->items as $v){
			$vid = array(
				'kind' => $v->kind,
				'id' => $is_playlists ? $v->id : ($is_playlist ? $v->contentDetails->videoId : $v->id->videoId),
				'snippet' => $v->snippet
			);
			
			if( $is_playlists ) $vid['contentDetails'] = $v->contentDetails;
			
			$videos[] = $vid;
			$vidids[] = $vid['id'];
		}
		
		$this->source['page'] = ((property_exists( $response, 'nextPageToken' )) && $response->nextPageToken) ? $response->nextPageToken : '';
		//$this->source['max'] = min( $this->source['max'], $response->pageInfo->totalResults );
		//$this->source['loaded'] += sizeof($videos);
		
		if( !$is_playlists ){
			$meta = $this->getMeta( $vidids );
			if( !$meta ) return false;
			
			foreach($videos as &$vid){
				//$start = new DateTime('@0'); // Unix epoch
				//$start->add(new DateInterval( $meta[ $vid['id'] ]->contentDetails->duration ));
				//$vid['duration'] = $start->format('U');
				if( !isset($meta[ $vid['id'] ]) ) continue;
				$vid['contentDetails'] = $meta[ $vid['id'] ]->contentDetails;
				$vid['statistics'] = $meta[ $vid['id'] ]->statistics;
				$vid['snippet']->description = $meta[ $vid['id'] ]->snippet->description;
			}
		}
		
		$feed = array(
			'nextPageToken' => property_exists( $response, 'nextPageToken' ) ? $response->nextPageToken : '',
			'pageInfo' => $response->pageInfo,
			'items' => $videos
		);
						
		return $feed;
	}
	
	function getMeta( $vidids ){
		$this->params = 'videos?part=snippet,contentDetails,statistics&id='.implode(',', $vidids);
		
		$response = json_decode(wp_remote_retrieve_body( wp_remote_get( $this->URL() ) ));
		
		if( !is_object($response) || property_exists( $response, 'error' ) ){
			$this->error++;			
			return false;
		}		
		
		$meta = array();
		
		foreach($response->items as $item){
			$meta[$item->id] = $item;
		}
		
		return $meta;
						
	}
	
	function normalizeThumbs( $tbs ){
		$thumbs = array();
		if( property_exists( $tbs, 'default' ) ) $thumbs['small'] = $tbs->{'default'}->url;
		if( property_exists( $tbs, 'medium' ) ) $thumbs['medium'] = $tbs->medium->url;
		if( property_exists( $tbs, 'high' ) ) $thumbs['large'] = $tbs->high->url;
		return $thumbs;
	}
	
	function URL(){
		$url = 'https://www.googleapis.com/youtube/v3/' . $this->params .'&key=' . $this->apikey;
		return $url;	
	}
	
	function siteInit(){
		$this->apikey = $this->source['apikey'];
		$this->prepareParameters( $this->source );
	}
	
	function prepareParameters( $source ){
		if( !isset($source['page']) ) $source['page'] = '';
						
		$limit = $source['limit']; //min($source['max'] - $source['loaded'], 50);
		$this->limit = $limit;
		
		if( $source['sort_by'] === 'none') $source['sort_by'] = implode('', array('d', 'a', 't', 'e'));
		if( $source['sort_by'] === 'title_desc') $source['sort_by'] = 'title';
								
		switch( $source['stream'] ){
			case 'uploads':
				$this->params = 'search?order='. $source['sort_by'] .'&q=&part=snippet&channelId='. $source['stream_value'] .'&type=video&pageToken=frames-page-token&maxResults='.$limit;
				break;
			case 'playlist':
				$this->params = 'playlistItems?part=snippet,contentDetails&maxResults='.$limit.'&pageToken=frames-page-token&playlistId='.$source['stream_value'];
				break;
			case 'search':
				$search_channel = $source['search_own'] ? '&channelId='. $source['channel'] : '';
				$this->params = 'search?order='. $source['sort_by'] .'&q='. urlencode($source['stream_value']) .'&part=snippet'. $search_channel .'&type=video&pageToken=frames-page-token&maxResults='.$limit;
				break;
			case 'playlists':
				$this->params = 'playlists?part=snippet,status,contentDetails&channelId='. $source['stream_value'] .'&pageToken=frames-page-token&maxResults='.$limit;
				break;
			case 'banner':
				$this->params = 'channels?part=contentDetails,snippet,statistics,brandingSettings&id='.$source['channel'];
				break;
			case 'custom':
				$this->params = 'videos?part=contentDetails,statistics,snippet&id='.implode(',', $source['stream_value']);
				break;
		}
		
		$this->params = str_replace('frames-page-token', $source['page'], $this->params);
				
	}

}

