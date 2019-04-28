<?php
	/* Template Name: Home */
?>
<?php get_header(); ?>

<?php
	//echo do_shortcode('[recent_post_slider design="design-1"]');
	echo do_shortcode('[rev_slider alias="news-gallery-post-based1"]');
?>
<?php $mvp_feat_posts = get_option('mvp_feat_posts'); if ($mvp_feat_posts == "true") { ?>
<div id="mvp-feat-home-wrap" class="left relative">

<?php $mvp_feat_layout = get_option('mvp_feat_layout'); if( $mvp_feat_layout == "Featured 1" ) { ?>
<section id="mvp-feat2-wrap" class="left relative">
	<?php global $do_not_duplicate; global $post; $recent = new WP_Query(array( 'tag' => get_option('mvp_feat_posts_tags'), 'posts_per_page' => '1'  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; ?>
	<div class="mvp-feat2-main left relative">
		<a href="<?php the_permalink(); ?>" rel="bookmark">
		<div class="mvp-feat2-main-img left relative">
			<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
				<?php the_post_thumbnail('mvp-post-thumb', array( 'class' => 'mvp-reg-img' )); ?>
				<?php the_post_thumbnail('mvp-mid-thumb', array( 'class' => 'mvp-mob-img' )); ?>
			<?php } ?>
			<?php if ( has_post_format( 'video' )) { ?>
				<div class="mvp-feat-vid-but">
					<i class="fa fa-play fa-3"></i>
				</div><!--mvpfeat-vid-but-->
			<?php } else if ( has_post_format( 'gallery' )) { ?>
				<div class="mvp-feat-gal-but">
					<i class="fa fa-camera fa-3"></i>
				</div><!--mvpfeat-gal-but-->
			<?php } ?>
		</div><!--mvp-feat2-main-img-->
		<div class="mvp-feat2-main-text">
			<h3 class="mvp-feat2-main-cat left"><span class="mvp-feat2-main-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
			<div class="mvp-feat2-main-title left relative">
				<?php if(get_post_meta($post->ID, "mvp_featured_headline", true)): ?>
					<h2><?php echo esc_html(get_post_meta($post->ID, "mvp_featured_headline", true)); ?></h2>
				<?php else: ?>
					<h2 class="mvp-stand-title"><?php the_title(); ?></h2>
				<?php endif; ?>
			</div><!--mvp-feat2-main-title-->
			<div class="mvp-feat1-info">
				<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
			</div><!--mvp-feat1-info-->
		</div><!--mvp-feat2-main-text-->
		</a>
	</div><!--mvp-feat2-main-->
	<?php endwhile; wp_reset_postdata(); ?>
	<?php global $do_not_duplicate; global $post; $recent = new WP_Query(array( 'tag' => get_option('mvp_feat_posts_tags'), 'post__not_in'=>$do_not_duplicate, 'posts_per_page' => '2'  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
	<div class="mvp-feat2-sub left relative">
		<a href="<?php the_permalink(); ?>" rel="bookmark">
		<div class="mvp-feat2-sub-img left relative">
			<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
				<?php the_post_thumbnail('mvp-mid-thumb'); ?>
			<?php } ?>
			<?php if ( has_post_format( 'video' )) { ?>
				<div class="mvp-feat-vid-but">
					<i class="fa fa-play fa-3"></i>
				</div><!--mvpfeat-vid-but-->
			<?php } else if ( has_post_format( 'gallery' )) { ?>
				<div class="mvp-feat-gal-but">
					<i class="fa fa-camera fa-3"></i>
				</div><!--mvpfeat-gal-but-->
			<?php } ?>
		</div><!--mvp-feat2-sub-img-->
		</a>
		<div class="mvp-feat2-sub-text-before left relative">
			<div class="mvp-feat2-sub-text">
				<h3 class="mvp-feat2-sub-cat"><span class="mvp-feat2-sub-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
				<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
				<div class="mvp-feat1-info">
					<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
				</div><!--mvp-feat1-info-->
			</div><!--mvp-feat2-sub-text-->
		</div><!--mvp-feat2-sub-text-before-->
	</div><!--mvp-feat2-sub-->
	<?php } endwhile; wp_reset_postdata(); ?>
</section><!--mvp-feat2-wrap-->
<?php } else if( $mvp_feat_layout == "Featured 2" ) { ?>
<section id="mvp-feat1-wrap" class="left relative">
	<?php global $do_not_duplicate; global $post; $recent = new WP_Query(array( 'tag' => get_option('mvp_feat_posts_tags'), 'posts_per_page' => '3'  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; ?>
	<div class="mvp-feat1-story left relative">
		<a href="<?php the_permalink(); ?>" rel="bookmark">
		<div class="mvp-feat1-story-img left relative">
			<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
				<?php the_post_thumbnail('mvp-post-thumb', array( 'class' => 'mvp-reg-img' )); ?>
				<?php the_post_thumbnail('mvp-mid-thumb', array( 'class' => 'mvp-mob-img' )); ?>
			<?php } ?>
			<?php if ( has_post_format( 'video' )) { ?>
				<div class="mvp-feat-vid-but">
					<i class="fa fa-play fa-3"></i>
				</div><!--mvpfeat-vid-but-->
			<?php } else if ( has_post_format( 'gallery' )) { ?>
				<div class="mvp-feat-gal-but">
					<i class="fa fa-camera fa-3"></i>
				</div><!--mvpfeat-gal-but-->
			<?php } ?>
		</div><!--mvp-feat1-story-img-->
		</a>
		<div class="mvp-feat1-story-text left relative">
			<h3 class="mvp-feat1-main-cat"><span class="mvp-feat1-main-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
			<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
			<div class="mvp-feat1-info">
				<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
			</div><!--mvp-feat1-info-->
		</div><!--mvp-feat1-story-text-->
	</div><!--mvp-feat1-story-->
	<?php endwhile; wp_reset_postdata(); ?>
</section><!--mvp-featured1-wrap-->
<?php } else if( $mvp_feat_layout == "Featured 3" ) { ?>
<section id="mvp-feat3-wrap" class="left relative">
	<?php global $do_not_duplicate; global $post; $recent = new WP_Query(array( 'tag' => get_option('mvp_feat_posts_tags'), 'posts_per_page' => '1'  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; ?>
		<a href="<?php the_permalink(); ?>" rel="bookmark">
		<div class="mvp-feat3-img left relative">
			<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
				<?php the_post_thumbnail('', array( 'class' => 'mvp-reg-img' )); ?>
				<?php the_post_thumbnail('mvp-mid-thumb', array( 'class' => 'mvp-mob-img' )); ?>
			<?php } ?>
			<?php if ( has_post_format( 'video' )) { ?>
				<div class="mvp-feat-vid-but">
					<i class="fa fa-play fa-3"></i>
				</div><!--mvpfeat-vid-but-->
			<?php } else if ( has_post_format( 'gallery' )) { ?>
				<div class="mvp-feat-gal-but">
					<i class="fa fa-camera fa-3"></i>
				</div><!--mvpfeat-gal-but-->
			<?php } ?>
		</div><!--mvp-feat3-img-->
		</a>
		<div class="mvp-feat3-text left relative">
			<h3 class="mvp-feat3-cat"><span class="mvp-feat3-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
			<?php if(get_post_meta($post->ID, "mvp_featured_headline", true)): ?>
				<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php echo esc_html(get_post_meta($post->ID, "mvp_featured_headline", true)); ?></h2></a>
			<?php else: ?>
				<a href="<?php the_permalink(); ?>" rel="bookmark"><h2 class="mvp-stand-title"><?php the_title(); ?></h2></a>
			<?php endif; ?>
			<div class="mvp-feat1-info">
				<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
			</div><!--mvp-feat1-info-->
			<p><?php echo wp_trim_words( get_the_excerpt(), 16, '...' ); ?></p>
		</div><!--mvp-feat3-text-->
	<?php endwhile; wp_reset_postdata(); ?>
</section><!--mvp-feat3-wrap-->
<?php } ?>
</div><!--mvp-feat-home-wrap-->
<!--<?php } ?>
<?php echo do_shortcode('[horizontal_news]'); ?>	
<div id="mvp-content-body-wrap" class="left relative">
	<div class="mvp-content-side-out relative">
		<div class="mvp-content-side-in">
			<div id="mvp-home-body" class="left relative">
				<div id="mvp-home-head-toggle" class="left relative">
					<ul class="mvp-home-head-toggle-list mvp-col-tabs">
						<li class="mvp-feat-col-tab">
							<a href="#mvp-tab-col1"><i class="fa fa-clock-o" aria-hidden="true"></i><span class="mvp-home-head-toggle-item"><?php esc_html_e( 'Terbaru', 'click-mag' ); ?></span></a>
						</li>
						<li>
							<a href="#mvp-tab-col2"><i class="fa fa-line-chart" aria-hidden="true"></i><span class="mvp-home-head-toggle-item"><?php esc_html_e( 'Trending', 'click-mag' ); ?></span></a>
						</li>
						<?php query_posts(array( 'tax_query' => array( array( 'taxonomy' => 'post_format', 'field' => 'slug', 'terms' => 'post-format-video' )) )); if (have_posts()) : ?>
						<li>
							<a href="#mvp-tab-col3"><i class="fa fa-play-circle-o" aria-hidden="true"></i><span class="mvp-home-head-toggle-item"><?php esc_html_e( 'Videos', 'click-mag' ); ?></span></a>
						</li>
						<?php endif; wp_reset_query(); ?>
						<?php query_posts(array( 'tax_query' => array( array( 'taxonomy' => 'post_format', 'field' => 'slug', 'terms' => 'post-format-gallery' )) )); if (have_posts()) : ?>
						<li>
							<a href="#mvp-tab-col4"><i class="fa fa-camera" aria-hidden="true"></i><span class="mvp-home-head-toggle-item"><?php esc_html_e( 'Galleries', 'click-mag' ); ?></span></a>
						</li>
						<?php endif; wp_reset_query(); ?>
					</ul>
				</div><!--mvp-home-head-toggle-->
				<?php if(get_option('mvp_arch_layout') == 'Column' ) { ?>
					<section id="mvp-tab-col1" class="mvp-blog-col-wrap left relative mvp-tab-col-cont">
						<ul class="mvp-blog-col-story left relative infinite-content">
							<?php if (isset($do_not_duplicate)) { ?>
								<?php $mvp_posts_num = esc_html(get_option('mvp_posts_num')); $paged = (get_query_var('page')) ? get_query_var('page') : 1; query_posts(array( 'posts_per_page' => $mvp_posts_num, 'post__not_in'=>$do_not_duplicate, 'paged' =>$paged )); if (have_posts()) : while (have_posts()) : the_post(); ?>
									<li class="infinite-post">
										<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
											<a href="<?php the_permalink(); ?>" rel="bookmark">
											<div class="mvp-blog-col-img left relative">
												<?php the_post_thumbnail('mvp-mid-thumb'); ?>
												<?php if ( has_post_format( 'video' )) { ?>
													<div class="mvp-feat-vid-but">
														<i class="fa fa-play fa-3"></i>
													</div><!--mvpfeat-vid-but-->
												<?php } else if ( has_post_format( 'gallery' )) { ?>
													<div class="mvp-feat-gal-but">
														<i class="fa fa-camera fa-3"></i>
													</div><!--mvpfeat-gal-but-->
												<?php } ?>
											</div><!--mvp-blog-col-img-->
											</a>
										<?php } ?>
										<div class="mvp-blog-col-text left relative">
											<h3 class="mvp-blog-col-cat left"><span class="mvp-blog-col-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
											<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
											<div class="mvp-feat1-info">
												<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
											</div><!--mvp-feat1-info-->
											<div class="mvp-story-share-wrap">
												<span class="mvp-story-share-but fa fa-share fa-2"></span>
												<div class="mvp-story-share-cont">
													<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
													<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
													<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
												</div><!--mvp-story-share-cont-->
											</div><!--mvp-story-share-wrap-->
										</div><!--mvp-blog-col-text-->
									</li>
								<?php endwhile; endif; ?>
							<?php } else { ?>
								<?php $mvp_posts_num = esc_html(get_option('mvp_posts_num')); $paged = (get_query_var('page')) ? get_query_var('page') : 1; query_posts(array( 'posts_per_page' => $mvp_posts_num, 'paged' =>$paged )); if (have_posts()) : while (have_posts()) : the_post(); ?>
									<li class="infinite-post">
										<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
											<a href="<?php the_permalink(); ?>" rel="bookmark">
											<div class="mvp-blog-col-img left relative">
												<?php the_post_thumbnail('mvp-mid-thumb'); ?>
												<?php if ( has_post_format( 'video' )) { ?>
													<div class="mvp-feat-vid-but">
														<i class="fa fa-play fa-3"></i>
													</div><!--mvpfeat-vid-but-->
												<?php } else if ( has_post_format( 'gallery' )) { ?>
													<div class="mvp-feat-gal-but">
														<i class="fa fa-camera fa-3"></i>
													</div><!--mvpfeat-gal-but-->
												<?php } ?>
											</div><!--mvp-blog-col-img-->
											</a>
										<?php } ?>
										<div class="mvp-blog-col-text left relative">
											<h3 class="mvp-blog-col-cat left"><span class="mvp-blog-col-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
											<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
											<div class="mvp-feat1-info">
												<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
											</div><!--mvp-feat1-info-->
											<div class="mvp-story-share-wrap">
												<span class="mvp-story-share-but fa fa-share fa-2"></span>
												<div class="mvp-story-share-cont">
													<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
													<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
													<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
												</div><!--mvp-story-share-cont-->
											</div><!--mvp-story-share-wrap-->
										</div><!--mvp-blog-col-text-->
									</li>
								<?php endwhile; endif; ?>
							<?php } ?>
						</ul><!--mvp-blog-col-story-->
						<?php $mvp_infinite_scroll = get_option('mvp_infinite_scroll'); if ($mvp_infinite_scroll == "true") { if (isset($mvp_infinite_scroll)) { ?>
							<a href="#" class="mvp-inf-more-but"><?php esc_html_e( 'More Posts', 'click-mag' ); ?></a>
						<?php } } ?>
						<div class="mvp-nav-links">
							<?php if (function_exists("pagination")) { pagination($wp_query->max_num_pages); } ?>
						</div><!--mvp-nav-links-->
					</section><!--mvp-blog-col-wrap-->
					<section id="mvp-tab-col2" class="mvp-blog-col-wrap left relative mvp-tab-col-cont">
						<ul class="mvp-blog-col-story left relative infinite-content">
							<?php if (isset($do_not_duplicate)) { ?>
								<?php $pop_days = esc_html(get_option('mvp_pop_days')); $pop_num = esc_html(get_option('mvp_pop_num')); $popular_days_ago = "$pop_days days ago"; $recent = new WP_Query(array('posts_per_page' => $pop_num, 'post__not_in' => $do_not_duplicate, 'orderby' => 'meta_value_num', 'order' => 'DESC', 'meta_key' => 'post_views_count', 'date_query' => array( array( 'after' => $popular_days_ago )) )); while($recent->have_posts()) : $recent->the_post(); ?>
									<li class="infinite-post">
										<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
											<a href="<?php the_permalink(); ?>" rel="bookmark">
											<div class="mvp-blog-col-img left relative">
												<?php the_post_thumbnail('mvp-mid-thumb'); ?>
												<?php if ( has_post_format( 'video' )) { ?>
													<div class="mvp-feat-vid-but">
														<i class="fa fa-play fa-3"></i>
													</div><!--mvpfeat-vid-but-->
												<?php } else if ( has_post_format( 'gallery' )) { ?>
													<div class="mvp-feat-gal-but">
														<i class="fa fa-camera fa-3"></i>
													</div><!--mvpfeat-gal-but-->
												<?php } ?>
											</div><!--mvp-blog-col-img-->
											</a>
										<?php } ?>
										<div class="mvp-blog-col-text left relative">
											<h3 class="mvp-blog-col-cat left"><span class="mvp-blog-col-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
											<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
											<div class="mvp-feat1-info">
												<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
											</div><!--mvp-feat1-info-->
											<div class="mvp-story-share-wrap">
												<span class="mvp-story-share-but fa fa-share fa-2"></span>
												<div class="mvp-story-share-cont">
													<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
													<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
													<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
												</div><!--mvp-story-share-cont-->
											</div><!--mvp-story-share-wrap-->
										</div><!--mvp-blog-col-text-->
									</li>
								<?php endwhile; wp_reset_postdata(); ?>
							<?php } else { ?>
								<?php $pop_days = esc_html(get_option('mvp_pop_days')); $pop_num = esc_html(get_option('mvp_pop_num')); $popular_days_ago = "$pop_days days ago"; $recent = new WP_Query(array('posts_per_page' => $pop_num, 'orderby' => 'meta_value_num', 'order' => 'DESC', 'meta_key' => 'post_views_count', 'date_query' => array( array( 'after' => $popular_days_ago )) )); while($recent->have_posts()) : $recent->the_post(); ?>
									<li class="infinite-post">
										<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
											<a href="<?php the_permalink(); ?>" rel="bookmark">
											<div class="mvp-blog-col-img left relative">
												<?php the_post_thumbnail('mvp-mid-thumb'); ?>
												<?php if ( has_post_format( 'video' )) { ?>
													<div class="mvp-feat-vid-but">
														<i class="fa fa-play fa-3"></i>
													</div><!--mvpfeat-vid-but-->
												<?php } else if ( has_post_format( 'gallery' )) { ?>
													<div class="mvp-feat-gal-but">
														<i class="fa fa-camera fa-3"></i>
													</div><!--mvpfeat-gal-but-->
												<?php } ?>
											</div><!--mvp-blog-col-img-->
											</a>
										<?php } ?>
										<div class="mvp-blog-col-text left relative">
											<h3 class="mvp-blog-col-cat left"><span class="mvp-blog-col-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
											<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
											<div class="mvp-feat1-info">
												<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
											</div><!--mvp-feat1-info-->
											<div class="mvp-story-share-wrap">
												<span class="mvp-story-share-but fa fa-share fa-2"></span>
												<div class="mvp-story-share-cont">
													<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
													<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
													<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
												</div><!--mvp-story-share-cont-->
											</div><!--mvp-story-share-wrap-->
										</div><!--mvp-blog-col-text-->
									</li>
								<?php endwhile; wp_reset_postdata(); ?>
							<?php } ?>
						</ul><!--mvp-blog-col-story-->
					</section><!--mvp-blog-col-wrap-->
					<section id="mvp-tab-col3" class="mvp-blog-col-wrap left relative mvp-tab-col-cont">
						<ul class="mvp-blog-col-story left relative infinite-content">
							<?php if (isset($do_not_duplicate)) { ?>
								<?php $mvp_posts_num = esc_html(get_option('mvp_posts_num')); $paged = (get_query_var('page')) ? get_query_var('page') : 1; query_posts(array( 'tax_query' => array( array( 'taxonomy' => 'post_format', 'field' => 'slug', 'terms' => 'post-format-video' )), 'posts_per_page' => $mvp_posts_num, 'post__not_in'=>$do_not_duplicate, 'paged' =>$paged )); if (have_posts()) : while (have_posts()) : the_post(); ?>
									<li class="infinite-post">
										<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
											<a href="<?php the_permalink(); ?>" rel="bookmark">
											<div class="mvp-blog-col-img left relative">
												<?php the_post_thumbnail('mvp-mid-thumb'); ?>
												<?php if ( has_post_format( 'video' )) { ?>
													<div class="mvp-feat-vid-but">
														<i class="fa fa-play fa-3"></i>
													</div><!--mvpfeat-vid-but-->
												<?php } else if ( has_post_format( 'gallery' )) { ?>
													<div class="mvp-feat-gal-but">
														<i class="fa fa-camera fa-3"></i>
													</div><!--mvpfeat-gal-but-->
												<?php } ?>
											</div><!--mvp-blog-col-img-->
											</a>
										<?php } ?>
										<div class="mvp-blog-col-text left relative">
											<h3 class="mvp-blog-col-cat left"><span class="mvp-blog-col-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
											<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
											<div class="mvp-feat1-info">
												<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
											</div><!--mvp-feat1-info-->
											<div class="mvp-story-share-wrap">
												<span class="mvp-story-share-but fa fa-share fa-2"></span>
												<div class="mvp-story-share-cont">
													<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
													<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
													<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
												</div><!--mvp-story-share-cont-->
											</div><!--mvp-story-share-wrap-->
										</div><!--mvp-blog-col-text-->
									</li>
								<?php endwhile; endif; wp_reset_query(); ?>
							<?php } else { ?>
								<?php $mvp_posts_num = esc_html(get_option('mvp_posts_num')); $paged = (get_query_var('page')) ? get_query_var('page') : 1; query_posts(array( 'tax_query' => array( array( 'taxonomy' => 'post_format', 'field' => 'slug', 'terms' => 'post-format-video' )), 'posts_per_page' => $mvp_posts_num, 'paged' =>$paged )); if (have_posts()) : while (have_posts()) : the_post(); ?>
									<li class="infinite-post">
										<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
											<a href="<?php the_permalink(); ?>" rel="bookmark">
											<div class="mvp-blog-col-img left relative">
												<?php the_post_thumbnail('mvp-mid-thumb'); ?>
												<?php if ( has_post_format( 'video' )) { ?>
													<div class="mvp-feat-vid-but">
														<i class="fa fa-play fa-3"></i>
													</div><!--mvpfeat-vid-but-->
												<?php } else if ( has_post_format( 'gallery' )) { ?>
													<div class="mvp-feat-gal-but">
														<i class="fa fa-camera fa-3"></i>
													</div><!--mvpfeat-gal-but-->
												<?php } ?>
											</div><!--mvp-blog-col-img-->
											</a>
										<?php } ?>
										<div class="mvp-blog-col-text left relative">
											<h3 class="mvp-blog-col-cat left"><span class="mvp-blog-col-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
											<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
											<div class="mvp-feat1-info">
												<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
											</div><!--mvp-feat1-info-->
											<div class="mvp-story-share-wrap">
												<span class="mvp-story-share-but fa fa-share fa-2"></span>
												<div class="mvp-story-share-cont">
													<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
													<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
													<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
												</div><!--mvp-story-share-cont-->
											</div><!--mvp-story-share-wrap-->
										</div><!--mvp-blog-col-text-->
									</li>
								<?php endwhile; endif; wp_reset_query(); ?>
							<?php } ?>
						</ul><!--mvp-blog-col-story-->
					</section><!--mvp-blog-col-wrap-->
					<section id="mvp-tab-col4" class="mvp-blog-col-wrap left relative mvp-tab-col-cont">
						<ul class="mvp-blog-col-story left relative infinite-content">
							<?php if (isset($do_not_duplicate)) { ?>
								<?php $mvp_posts_num = esc_html(get_option('mvp_posts_num')); $paged = (get_query_var('page')) ? get_query_var('page') : 1; query_posts(array( 'tax_query' => array( array( 'taxonomy' => 'post_format', 'field' => 'slug', 'terms' => 'post-format-gallery' )), 'posts_per_page' => $mvp_posts_num, 'post__not_in'=>$do_not_duplicate, 'paged' =>$paged )); if (have_posts()) : while (have_posts()) : the_post(); ?>
									<li class="infinite-post">
										<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
											<a href="<?php the_permalink(); ?>" rel="bookmark">
											<div class="mvp-blog-col-img left relative">
												<?php the_post_thumbnail('mvp-mid-thumb'); ?>
												<?php if ( has_post_format( 'video' )) { ?>
													<div class="mvp-feat-vid-but">
														<i class="fa fa-play fa-3"></i>
													</div><!--mvpfeat-vid-but-->
												<?php } else if ( has_post_format( 'gallery' )) { ?>
													<div class="mvp-feat-gal-but">
														<i class="fa fa-camera fa-3"></i>
													</div><!--mvpfeat-gal-but-->
												<?php } ?>
											</div><!--mvp-blog-col-img-->
											</a>
										<?php } ?>
										<div class="mvp-blog-col-text left relative">
											<h3 class="mvp-blog-col-cat left"><span class="mvp-blog-col-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
											<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
											<div class="mvp-feat1-info">
												<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
											</div><!--mvp-feat1-info-->
											<div class="mvp-story-share-wrap">
												<span class="mvp-story-share-but fa fa-share fa-2"></span>
												<div class="mvp-story-share-cont">
													<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
													<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
													<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
												</div><!--mvp-story-share-cont-->
											</div><!--mvp-story-share-wrap-->
										</div><!--mvp-blog-col-text-->
									</li>
								<?php endwhile; endif; wp_reset_query(); ?>
							<?php } else { ?>
								<?php $mvp_posts_num = esc_html(get_option('mvp_posts_num')); $paged = (get_query_var('page')) ? get_query_var('page') : 1; query_posts(array( 'tax_query' => array( array( 'taxonomy' => 'post_format', 'field' => 'slug', 'terms' => 'post-format-gallery' )), 'posts_per_page' => $mvp_posts_num, 'paged' =>$paged )); if (have_posts()) : while (have_posts()) : the_post(); ?>
									<li class="infinite-post">
										<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
											<a href="<?php the_permalink(); ?>" rel="bookmark">
											<div class="mvp-blog-col-img left relative">
												<?php the_post_thumbnail('mvp-mid-thumb'); ?>
												<?php if ( has_post_format( 'video' )) { ?>
													<div class="mvp-feat-vid-but">
														<i class="fa fa-play fa-3"></i>
													</div><!--mvpfeat-vid-but-->
												<?php } else if ( has_post_format( 'gallery' )) { ?>
													<div class="mvp-feat-gal-but">
														<i class="fa fa-camera fa-3"></i>
													</div><!--mvpfeat-gal-but-->
												<?php } ?>
											</div><!--mvp-blog-col-img-->
											</a>
										<?php } ?>
										<div class="mvp-blog-col-text left relative">
											<h3 class="mvp-blog-col-cat left"><span class="mvp-blog-col-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
											<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
											<div class="mvp-feat1-info">
												<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
											</div><!--mvp-feat1-info-->
											<div class="mvp-story-share-wrap">
												<span class="mvp-story-share-but fa fa-share fa-2"></span>
												<div class="mvp-story-share-cont">
													<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
													<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
													<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
												</div><!--mvp-story-share-cont-->
											</div><!--mvp-story-share-wrap-->
										</div><!--mvp-blog-col-text-->
									</li>
								<?php endwhile; endif; wp_reset_query(); ?>
							<?php } ?>
						</ul><!--mvp-blog-col-story-->
					</section><!--mvp-blog-col-wrap-->
				<?php } else { ?>
				<section id="mvp-tab-col1" class="mvp-main-blog-wrap left relative mvp-tab-col-cont">
					<ul class="mvp-main-blog-story left relative infinite-content">
						<?php if (isset($do_not_duplicate)) { ?>
						<?php $mvp_posts_num = esc_html(get_option('mvp_posts_num')); $paged = (get_query_var('page')) ? get_query_var('page') : 1; query_posts(array( 'posts_per_page' => $mvp_posts_num, 'post__not_in'=>$do_not_duplicate, 'paged' =>$paged )); if (have_posts()) : while (have_posts()) : the_post(); ?>
							<li class="infinite-post">
								<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
									<div class="mvp-main-blog-out relative">
										<a href="<?php the_permalink(); ?>" rel="bookmark">
										<div class="mvp-main-blog-img left relative">
											<?php the_post_thumbnail('mvp-mid-thumb', array( 'class' => 'mvp-reg-img' )); ?>
											<?php the_post_thumbnail('mvp-small-thumb', array( 'class' => 'mvp-mob-img' )); ?>
											<?php if ( has_post_format( 'video' )) { ?>
												<div class="mvp-feat-vid-but">
													<i class="fa fa-play fa-3"></i>
												</div><!--mvpfeat-vid-but-->
											<?php } else if ( has_post_format( 'gallery' )) { ?>
												<div class="mvp-feat-gal-but">
													<i class="fa fa-camera fa-3"></i>
												</div><!--mvpfeat-gal-but-->
											<?php } ?>
										</div><!--mvp-main-blog-img-->
										</a>
										<div class="mvp-main-blog-in">
											<div class="mvp-main-blog-text left relative">
												<h3 class="mvp-main-blog-cat left"><span class="mvp-main-blog-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
												<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
												<div class="mvp-feat1-info">
													<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
												</div><!--mvp-feat1-info-->
												<p><?php echo wp_trim_words( get_the_excerpt(), 16, '...' ); ?></p>
												<div class="mvp-story-share-wrap">
													<span class="mvp-story-share-but fa fa-share fa-2"></span>
													<div class="mvp-story-share-cont">
														<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
														<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
														<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
													</div><!--mvp-story-share-cont-->
												</div><!--mvp-story-share-wrap-->
											</div><!--mvp-main-blog-text-->
										</div><!--mvp-main-blog-in-->
									</div><!--mvp-main-blog-out-->
								<?php } else { ?>
									<div class="mvp-main-blog-text left relative mvp-blog-text-only">
										<h3 class="mvp-main-blog-cat left"><span class="mvp-main-blog-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
										<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
										<div class="mvp-feat1-info">
											<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
										</div><!--mvp-feat1-info-->
										<p><?php echo wp_trim_words( get_the_excerpt(), 16, '...' ); ?></p>
										<div class="mvp-story-share-wrap">
											<span class="mvp-story-share-but fa fa-share fa-2"></span>
											<div class="mvp-story-share-cont">
												<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
												<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
												<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
											</div><!--mvp-story-share-cont-->
										</div><!--mvp-story-share-wrap-->
									</div><!--mvp-main-blog-text-->
								<?php } ?>
							</li>
						<?php endwhile; endif; ?>
						<?php } else { ?>
						<?php $mvp_posts_num = esc_html(get_option('mvp_posts_num')); $paged = (get_query_var('page')) ? get_query_var('page') : 1; query_posts(array( 'posts_per_page' => $mvp_posts_num, 'paged' =>$paged )); if (have_posts()) : while (have_posts()) : the_post(); ?>
							<li class="infinite-post">
								<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
									<div class="mvp-main-blog-out relative">
										<a href="<?php the_permalink(); ?>" rel="bookmark">
										<div class="mvp-main-blog-img left relative">
											<?php the_post_thumbnail('mvp-mid-thumb', array( 'class' => 'mvp-reg-img' )); ?>
											<?php the_post_thumbnail('mvp-small-thumb', array( 'class' => 'mvp-mob-img' )); ?>
											<?php if ( has_post_format( 'video' )) { ?>
												<div class="mvp-feat-vid-but">
													<i class="fa fa-play fa-3"></i>
												</div><!--mvpfeat-vid-but-->
											<?php } else if ( has_post_format( 'gallery' )) { ?>
												<div class="mvp-feat-gal-but">
													<i class="fa fa-camera fa-3"></i>
												</div><!--mvpfeat-gal-but-->
											<?php } ?>
										</div><!--mvp-main-blog-img-->
										</a>
										<div class="mvp-main-blog-in">
											<div class="mvp-main-blog-text left relative">
												<h3 class="mvp-main-blog-cat left"><span class="mvp-main-blog-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
												<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
												<div class="mvp-feat1-info">
													<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
												</div><!--mvp-feat1-info-->
												<p><?php echo wp_trim_words( get_the_excerpt(), 16, '...' ); ?></p>
												<div class="mvp-story-share-wrap">
													<span class="mvp-story-share-but fa fa-share fa-2"></span>
													<div class="mvp-story-share-cont">
														<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
														<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
														<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
													</div><!--mvp-story-share-cont-->
												</div><!--mvp-story-share-wrap-->
											</div><!--mvp-main-blog-text-->
										</div><!--mvp-main-blog-in-->
									</div><!--mvp-main-blog-out-->
								<?php } else { ?>
									<div class="mvp-main-blog-text left relative mvp-blog-text-only">
										<h3 class="mvp-main-blog-cat left"><span class="mvp-main-blog-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
										<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
										<div class="mvp-feat1-info">
											<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
										</div><!--mvp-feat1-info-->
										<p><?php echo wp_trim_words( get_the_excerpt(), 16, '...' ); ?></p>
										<div class="mvp-story-share-wrap">
											<span class="mvp-story-share-but fa fa-share fa-2"></span>
											<div class="mvp-story-share-cont">
												<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
												<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
												<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
											</div><!--mvp-story-share-cont-->
										</div><!--mvp-story-share-wrap-->
									</div><!--mvp-main-blog-text-->
								<?php } ?>
							</li>
						<?php endwhile; endif; ?>
						<?php } ?>
					</ul><!--mvp-main-blog-story-->
					<?php $mvp_infinite_scroll = get_option('mvp_infinite_scroll'); if ($mvp_infinite_scroll == "true") { if (isset($mvp_infinite_scroll)) { ?>
						<a href="#" class="mvp-inf-more-but"><?php esc_html_e( 'More Posts', 'click-mag' ); ?></a>
					<?php } } ?>
					<div class="mvp-nav-links">
						<?php if (function_exists("pagination")) { pagination($wp_query->max_num_pages); } ?>
					</div><!--mvp-nav-links-->
				</section><!--mvp-main-blog-wrap-->
				<section id="mvp-tab-col2" class="mvp-main-blog-wrap left relative mvp-tab-col-cont">
					<ul class="mvp-main-blog-story left relative">
						<?php if (isset($do_not_duplicate)) { ?>
						<?php $pop_days = esc_html(get_option('mvp_pop_days')); $pop_num = esc_html(get_option('mvp_pop_num')); $popular_days_ago = "$pop_days days ago"; $recent = new WP_Query(array('posts_per_page' => $pop_num, 'post__not_in' => $do_not_duplicate, 'orderby' => 'meta_value_num', 'order' => 'DESC', 'meta_key' => 'post_views_count', 'date_query' => array( array( 'after' => $popular_days_ago )) )); while($recent->have_posts()) : $recent->the_post(); ?>
							<li>
								<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
									<div class="mvp-main-blog-out relative">
										<a href="<?php the_permalink(); ?>" rel="bookmark">
										<div class="mvp-main-blog-img left relative">
											<?php the_post_thumbnail('mvp-mid-thumb', array( 'class' => 'mvp-reg-img' )); ?>
											<?php the_post_thumbnail('mvp-small-thumb', array( 'class' => 'mvp-mob-img' )); ?>
											<?php if ( has_post_format( 'video' )) { ?>
												<div class="mvp-feat-vid-but">
													<i class="fa fa-play fa-3"></i>
												</div><!--mvpfeat-vid-but-->
											<?php } else if ( has_post_format( 'gallery' )) { ?>
												<div class="mvp-feat-gal-but">
													<i class="fa fa-camera fa-3"></i>
												</div><!--mvpfeat-gal-but-->
											<?php } ?>
										</div><!--mvp-main-blog-img-->
										</a>
										<div class="mvp-main-blog-in">
											<div class="mvp-main-blog-text left relative">
												<h3 class="mvp-main-blog-cat left"><span class="mvp-main-blog-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
												<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
												<div class="mvp-feat1-info">
													<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
												</div><!--mvp-feat1-info-->
												<p><?php echo wp_trim_words( get_the_excerpt(), 16, '...' ); ?></p>
												<div class="mvp-story-share-wrap">
													<span class="mvp-story-share-but fa fa-share fa-2"></span>
													<div class="mvp-story-share-cont">
														<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
														<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
														<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
													</div><!--mvp-story-share-cont-->
												</div><!--mvp-story-share-wrap-->
											</div><!--mvp-main-blog-text-->
										</div><!--mvp-main-blog-in-->
									</div><!--mvp-main-blog-out-->
								<?php } else { ?>
									<div class="mvp-main-blog-text left relative mvp-blog-text-only">
										<h3 class="mvp-main-blog-cat left"><span class="mvp-main-blog-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
										<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
										<div class="mvp-feat1-info">
											<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
										</div><!--mvp-feat1-info-->
										<p><?php echo wp_trim_words( get_the_excerpt(), 16, '...' ); ?></p>
										<div class="mvp-story-share-wrap">
											<span class="mvp-story-share-but fa fa-share fa-2"></span>
											<div class="mvp-story-share-cont">
												<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
												<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
												<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
											</div><!--mvp-story-share-cont-->
										</div><!--mvp-story-share-wrap-->
									</div><!--mvp-main-blog-text-->
								<?php } ?>
							</li>
						<?php endwhile; wp_reset_postdata(); ?>
						<?php } else { ?>
						<?php $pop_days = esc_html(get_option('mvp_pop_days')); $pop_num = esc_html(get_option('mvp_pop_num')); $popular_days_ago = "$pop_days days ago"; $recent = new WP_Query(array('posts_per_page' => $pop_num, 'orderby' => 'meta_value_num', 'order' => 'DESC', 'meta_key' => 'post_views_count', 'date_query' => array( array( 'after' => $popular_days_ago )) )); while($recent->have_posts()) : $recent->the_post(); ?>
							<li>
								<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
									<div class="mvp-main-blog-out relative">
										<a href="<?php the_permalink(); ?>" rel="bookmark">
										<div class="mvp-main-blog-img left relative">
											<?php the_post_thumbnail('mvp-mid-thumb', array( 'class' => 'mvp-reg-img' )); ?>
											<?php the_post_thumbnail('mvp-small-thumb', array( 'class' => 'mvp-mob-img' )); ?>
											<?php if ( has_post_format( 'video' )) { ?>
												<div class="mvp-feat-vid-but">
													<i class="fa fa-play fa-3"></i>
												</div><!--mvpfeat-vid-but-->
											<?php } else if ( has_post_format( 'gallery' )) { ?>
												<div class="mvp-feat-gal-but">
													<i class="fa fa-camera fa-3"></i>
												</div><!--mvpfeat-gal-but-->
											<?php } ?>
										</div><!--mvp-main-blog-img-->
										</a>
										<div class="mvp-main-blog-in">
											<div class="mvp-main-blog-text left relative">
												<h3 class="mvp-main-blog-cat left"><span class="mvp-main-blog-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
												<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
												<div class="mvp-feat1-info">
													<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
												</div><!--mvp-feat1-info-->
												<p><?php echo wp_trim_words( get_the_excerpt(), 16, '...' ); ?></p>
												<div class="mvp-story-share-wrap">
													<span class="mvp-story-share-but fa fa-share fa-2"></span>
													<div class="mvp-story-share-cont">
														<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
														<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
														<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
													</div><!--mvp-story-share-cont-->
												</div><!--mvp-story-share-wrap-->
											</div><!--mvp-main-blog-text-->
										</div><!--mvp-main-blog-in-->
									</div><!--mvp-main-blog-out-->
								<?php } else { ?>
									<div class="mvp-main-blog-text left relative mvp-blog-text-only">
										<h3 class="mvp-main-blog-cat left"><span class="mvp-main-blog-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
										<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
										<div class="mvp-feat1-info">
											<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
										</div><!--mvp-feat1-info-->
										<p><?php echo wp_trim_words( get_the_excerpt(), 16, '...' ); ?></p>
										<div class="mvp-story-share-wrap">
											<span class="mvp-story-share-but fa fa-share fa-2"></span>
											<div class="mvp-story-share-cont">
												<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
												<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
												<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
											</div><!--mvp-story-share-cont-->
										</div><!--mvp-story-share-wrap-->
									</div><!--mvp-main-blog-text-->
								<?php } ?>
							</li>
						<?php endwhile; wp_reset_postdata(); ?>
						<?php } ?>
					</ul><!--mvp-main-blog-story-->
				</section><!--mvp-main-blog-wrap-->
				<?php query_posts(array( 'tax_query' => array( array( 'taxonomy' => 'post_format', 'field' => 'slug', 'terms' => 'post-format-video' )) )); if (have_posts()) : ?>
				<section id="mvp-tab-col3" class="mvp-main-blog-wrap left relative mvp-tab-col-cont">
					<ul class="mvp-main-blog-story left relative">
						<?php if (isset($do_not_duplicate)) { ?>
						<?php $mvp_posts_num = esc_html(get_option('mvp_posts_num')); $paged = (get_query_var('page')) ? get_query_var('page') : 1; query_posts(array( 'tax_query' => array( array( 'taxonomy' => 'post_format', 'field' => 'slug', 'terms' => 'post-format-video' )), 'posts_per_page' => $mvp_posts_num, 'post__not_in'=>$do_not_duplicate, 'paged' =>$paged )); if (have_posts()) : while (have_posts()) : the_post(); ?>
							<li>
								<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
									<div class="mvp-main-blog-out relative">
										<a href="<?php the_permalink(); ?>" rel="bookmark">
										<div class="mvp-main-blog-img left relative">
											<?php the_post_thumbnail('mvp-mid-thumb', array( 'class' => 'mvp-reg-img' )); ?>
											<?php the_post_thumbnail('mvp-small-thumb', array( 'class' => 'mvp-mob-img' )); ?>
											<?php if ( has_post_format( 'video' )) { ?>
												<div class="mvp-feat-vid-but">
													<i class="fa fa-play fa-3"></i>
												</div><!--mvpfeat-vid-but-->
											<?php } else if ( has_post_format( 'gallery' )) { ?>
												<div class="mvp-feat-gal-but">
													<i class="fa fa-camera fa-3"></i>
												</div><!--mvpfeat-gal-but-->
											<?php } ?>
										</div><!--mvp-main-blog-img-->
										</a>
										<div class="mvp-main-blog-in">
											<div class="mvp-main-blog-text left relative">
												<h3 class="mvp-main-blog-cat left"><span class="mvp-main-blog-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
												<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
												<div class="mvp-feat1-info">
													<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
												</div><!--mvp-feat1-info-->
												<p><?php echo wp_trim_words( get_the_excerpt(), 16, '...' ); ?></p>
												<div class="mvp-story-share-wrap">
													<span class="mvp-story-share-but fa fa-share fa-2"></span>
													<div class="mvp-story-share-cont">
														<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
														<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
														<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
													</div><!--mvp-story-share-cont-->
												</div><!--mvp-story-share-wrap-->
											</div><!--mvp-main-blog-text-->
										</div><!--mvp-main-blog-in-->
									</div><!--mvp-main-blog-out-->
								<?php } else { ?>
									<div class="mvp-main-blog-text left relative mvp-blog-text-only">
										<h3 class="mvp-main-blog-cat left"><span class="mvp-main-blog-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
										<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
										<div class="mvp-feat1-info">
											<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
										</div><!--mvp-feat1-info-->
										<p><?php echo wp_trim_words( get_the_excerpt(), 16, '...' ); ?></p>
										<div class="mvp-story-share-wrap">
											<span class="mvp-story-share-but fa fa-share fa-2"></span>
											<div class="mvp-story-share-cont">
												<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
												<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
												<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
											</div><!--mvp-story-share-cont-->
										</div><!--mvp-story-share-wrap-->
									</div><!--mvp-main-blog-text-->
								<?php } ?>
							</li>
						<?php endwhile; endif; wp_reset_query(); ?>
						<?php } else { ?>
						<?php $mvp_posts_num = esc_html(get_option('mvp_posts_num')); $paged = (get_query_var('page')) ? get_query_var('page') : 1; query_posts(array( 'tax_query' => array( array( 'taxonomy' => 'post_format', 'field' => 'slug', 'terms' => 'post-format-video' )), 'posts_per_page' => $mvp_posts_num, 'paged' =>$paged )); if (have_posts()) : while (have_posts()) : the_post(); ?>
							<li>
								<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
									<div class="mvp-main-blog-out relative">
										<a href="<?php the_permalink(); ?>" rel="bookmark">
										<div class="mvp-main-blog-img left relative">
											<?php the_post_thumbnail('mvp-mid-thumb', array( 'class' => 'mvp-reg-img' )); ?>
											<?php the_post_thumbnail('mvp-small-thumb', array( 'class' => 'mvp-mob-img' )); ?>
											<?php if ( has_post_format( 'video' )) { ?>
												<div class="mvp-feat-vid-but">
													<i class="fa fa-play fa-3"></i>
												</div><!--mvpfeat-vid-but-->
											<?php } else if ( has_post_format( 'gallery' )) { ?>
												<div class="mvp-feat-gal-but">
													<i class="fa fa-camera fa-3"></i>
												</div><!--mvpfeat-gal-but-->
											<?php } ?>
										</div><!--mvp-main-blog-img-->
										</a>
										<div class="mvp-main-blog-in">
											<div class="mvp-main-blog-text left relative">
												<h3 class="mvp-main-blog-cat left"><span class="mvp-main-blog-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
												<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
												<div class="mvp-feat1-info">
													<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
												</div><!--mvp-feat1-info-->
												<p><?php echo wp_trim_words( get_the_excerpt(), 16, '...' ); ?></p>
												<div class="mvp-story-share-wrap">
													<span class="mvp-story-share-but fa fa-share fa-2"></span>
													<div class="mvp-story-share-cont">
														<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
														<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
														<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
													</div><!--mvp-story-share-cont-->
												</div><!--mvp-story-share-wrap-->
											</div><!--mvp-main-blog-text-->
										</div><!--mvp-main-blog-in-->
									</div><!--mvp-main-blog-out-->
								<?php } else { ?>
									<div class="mvp-main-blog-text left relative mvp-blog-text-only">
										<h3 class="mvp-main-blog-cat left"><span class="mvp-main-blog-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
										<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
										<div class="mvp-feat1-info">
											<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
										</div><!--mvp-feat1-info-->
										<p><?php echo wp_trim_words( get_the_excerpt(), 16, '...' ); ?></p>
										<div class="mvp-story-share-wrap">
											<span class="mvp-story-share-but fa fa-share fa-2"></span>
											<div class="mvp-story-share-cont">
												<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
												<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
												<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
											</div><!--mvp-story-share-cont-->
										</div><!--mvp-story-share-wrap-->
									</div><!--mvp-main-blog-text-->
								<?php } ?>
							</li>
						<?php endwhile; endif; wp_reset_query(); ?>
						<?php } ?>
					</ul><!--mvp-main-blog-story-->
				</section><!--mvp-main-blog-wrap-->
				<?php endif; wp_reset_query(); ?>
				<?php query_posts(array( 'tax_query' => array( array( 'taxonomy' => 'post_format', 'field' => 'slug', 'terms' => 'post-format-gallery' )) )); if (have_posts()) : ?>
				<section id="mvp-tab-col4" class="mvp-main-blog-wrap left relative mvp-tab-col-cont">
					<ul class="mvp-main-blog-story left relative">
						<?php if (isset($do_not_duplicate)) { ?>
						<?php $mvp_posts_num = esc_html(get_option('mvp_posts_num')); $paged = (get_query_var('page')) ? get_query_var('page') : 1; query_posts(array( 'tax_query' => array( array( 'taxonomy' => 'post_format', 'field' => 'slug', 'terms' => 'post-format-gallery' )), 'posts_per_page' => $mvp_posts_num, 'post__not_in'=>$do_not_duplicate, 'paged' =>$paged )); if (have_posts()) : while (have_posts()) : the_post(); ?>
							<li>
								<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
									<div class="mvp-main-blog-out relative">
										<a href="<?php the_permalink(); ?>" rel="bookmark">
										<div class="mvp-main-blog-img left relative">
											<?php the_post_thumbnail('mvp-mid-thumb', array( 'class' => 'mvp-reg-img' )); ?>
											<?php the_post_thumbnail('mvp-small-thumb', array( 'class' => 'mvp-mob-img' )); ?>
											<?php if ( has_post_format( 'video' )) { ?>
												<div class="mvp-feat-vid-but">
													<i class="fa fa-play fa-3"></i>
												</div><!--mvpfeat-vid-but-->
											<?php } else if ( has_post_format( 'gallery' )) { ?>
												<div class="mvp-feat-gal-but">
													<i class="fa fa-camera fa-3"></i>
												</div><!--mvpfeat-gal-but-->
											<?php } ?>
										</div><!--mvp-main-blog-img-->
										</a>
										<div class="mvp-main-blog-in">
											<div class="mvp-main-blog-text left relative">
												<h3 class="mvp-main-blog-cat left"><span class="mvp-main-blog-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
												<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
												<div class="mvp-feat1-info">
													<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
												</div><!--mvp-feat1-info-->
												<p><?php echo wp_trim_words( get_the_excerpt(), 16, '...' ); ?></p>
												<div class="mvp-story-share-wrap">
													<span class="mvp-story-share-but fa fa-share fa-2"></span>
													<div class="mvp-story-share-cont">
														<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
														<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
														<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
													</div><!--mvp-story-share-cont-->
												</div><!--mvp-story-share-wrap-->
											</div><!--mvp-main-blog-text-->
										</div><!--mvp-main-blog-in-->
									</div><!--mvp-main-blog-out-->
								<?php } else { ?>
									<div class="mvp-main-blog-text left relative mvp-blog-text-only">
										<h3 class="mvp-main-blog-cat left"><span class="mvp-main-blog-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
										<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
										<div class="mvp-feat1-info">
											<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
										</div><!--mvp-feat1-info-->
										<p><?php echo wp_trim_words( get_the_excerpt(), 16, '...' ); ?></p>
										<div class="mvp-story-share-wrap">
											<span class="mvp-story-share-but fa fa-share fa-2"></span>
											<div class="mvp-story-share-cont">
												<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
												<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
												<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
											</div><!--mvp-story-share-cont-->
										</div><!--mvp-story-share-wrap-->
									</div><!--mvp-main-blog-text-->
								<?php } ?>
							</li>
						<?php endwhile; endif; wp_reset_query(); ?>
						<?php } else { ?>
						<?php $mvp_posts_num = esc_html(get_option('mvp_posts_num')); $paged = (get_query_var('page')) ? get_query_var('page') : 1; query_posts(array( 'tax_query' => array( array( 'taxonomy' => 'post_format', 'field' => 'slug', 'terms' => 'post-format-gallery' )), 'posts_per_page' => $mvp_posts_num, 'paged' =>$paged )); if (have_posts()) : while (have_posts()) : the_post(); ?>
							<li>
								<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
									<div class="mvp-main-blog-out relative">
										<a href="<?php the_permalink(); ?>" rel="bookmark">
										<div class="mvp-main-blog-img left relative">
											<?php the_post_thumbnail('mvp-mid-thumb', array( 'class' => 'mvp-reg-img' )); ?>
											<?php the_post_thumbnail('mvp-small-thumb', array( 'class' => 'mvp-mob-img' )); ?>
											<?php if ( has_post_format( 'video' )) { ?>
												<div class="mvp-feat-vid-but">
													<i class="fa fa-play fa-3"></i>
												</div><!--mvpfeat-vid-but-->
											<?php } else if ( has_post_format( 'gallery' )) { ?>
												<div class="mvp-feat-gal-but">
													<i class="fa fa-camera fa-3"></i>
												</div><!--mvpfeat-gal-but-->
											<?php } ?>
										</div><!--mvp-main-blog-img-->
										</a>
										<div class="mvp-main-blog-in">
											<div class="mvp-main-blog-text left relative">
												<h3 class="mvp-main-blog-cat left"><span class="mvp-main-blog-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
												<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
												<div class="mvp-feat1-info">
													<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
												</div><!--mvp-feat1-info-->
												<p><?php echo wp_trim_words( get_the_excerpt(), 16, '...' ); ?></p>
												<div class="mvp-story-share-wrap">
													<span class="mvp-story-share-but fa fa-share fa-2"></span>
													<div class="mvp-story-share-cont">
														<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
														<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
														<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
													</div><!--mvp-story-share-cont-->
												</div><!--mvp-story-share-wrap-->
											</div><!--mvp-main-blog-text-->
										</div><!--mvp-main-blog-in-->
									</div><!--mvp-main-blog-out-->
								<?php } else { ?>
									<div class="mvp-main-blog-text left relative mvp-blog-text-only">
										<h3 class="mvp-main-blog-cat left"><span class="mvp-main-blog-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
										<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
										<div class="mvp-feat1-info">
											<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><span class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></span></span>
										</div><!--mvp-feat1-info-->
										<p><?php echo wp_trim_words( get_the_excerpt(), 16, '...' ); ?></p>
										<div class="mvp-story-share-wrap">
											<span class="mvp-story-share-but fa fa-share fa-2"></span>
											<div class="mvp-story-share-cont">
												<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><span class="mvp-story-share-fb fa fa-facebook fa-2"></span></a>
												<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><span class="mvp-story-share-twit fa fa-twitter fa-2"></span></a>
												<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><span class="mvp-story-share-pin fa fa-pinterest-p fa-2"></span></a>
											</div><!--mvp-story-share-cont-->
										</div><!--mvp-story-share-wrap-->
									</div><!--mvp-main-blog-text-->
								<?php } ?>
							</li>
						<?php endwhile; endif; wp_reset_query(); ?>
						<?php } ?>
					</ul><!--mvp-main-blog-story-->
				</section><!--mvp-main-blog-wrap-->
				<?php endif; wp_reset_query(); ?>
				<?php } ?>
			</div><!--mvp-home-body-->
		</div><!--mvp-content-side-in-->
		<?php get_sidebar('home'); ?>
	</div><!--mvp-content-side-out-->
</div><!--mvp-content-body-wrap-->
<?php get_footer(); ?>