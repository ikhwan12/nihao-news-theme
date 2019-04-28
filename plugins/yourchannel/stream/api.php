<?php
if( !defined( 'ABSPATH' ) ) die('They dead me.');

class YourChannelStreamAPI{
	
	public $credentials = array();
	public $error = 0;
	public $error_msg = '';
	
	function __construct( $source ){
								
		$this->source = $source;
		
		//$this->getCredentials();
		
		$this->siteInit();
		
	}
	
	function getFeed(){
		if( !$this->limit ) return $this->defaultRe();
		$feed = $this->requestFeed();
		//if( !$feed ) $feed = $this->requestFeed();
		if( !$feed ) $feed = $this->defaultRe();
		return $feed;
	}
	
	function getCredentials(){
		global $social_frames;
		$this->credentials = $social_frames->returnSocialSettings();
	}
	
	function defaultRe(){
		return array( 'nextPageToken' => '', 'pageInfo' => array(), 'items' => array(), 'error' => $this->error_msg );
	}
	
	function siteInit(){}

}
