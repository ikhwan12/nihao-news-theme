<?php

/*
 * Copyright 2013-2017, Theia Sticky Sidebar, WeCodePixels, http://wecodepixels.com
 */

add_action( 'wp_ajax_tss_get_posts', 'TssAjax::wp_ajax_tss_get_posts' );

class TssAjax {
	const GET_POSTS_NONCE = 'tss-get-posts';
	const POSTS_PER_PAGE = 20;

	public static function wp_ajax_tss_get_posts() {
		if ( $_SERVER['REQUEST_METHOD'] !== 'GET' ) {
			return;
		}

		// Check nonce.
		check_admin_referer( self::GET_POSTS_NONCE );

		$result = array(
			'items' => array()
		);

		// Get posts.
		$args    = array(
			'post_type'      => 'any',
			's'              => $_GET['q'],
			'post_status'    => 'publish',
			'orderby'        => 'title',
			'order'          => 'ASC',
			'posts_per_page' => self::POSTS_PER_PAGE,
			'paged'          => $_GET['page']
		);
		$wpQuery = new WP_Query( $args );
		$posts   = $wpQuery->get_posts();
		foreach ( $posts as $post ) {
			$result['items'][] = array(
				'id'   => $post->ID,
				'text' => self::getPostText( $post )
			);
		}
		$result['more'] = count( $posts ) >= self::POSTS_PER_PAGE;

		// Show result.
		header( 'Content-Type: application/json' );
		echo json_encode( $result );
		die();
	}

	public static function getPostText( $post ) {
		return $post->post_title . ' (' . $post->post_type . ' #' . $post->ID . ')';
	}
}
