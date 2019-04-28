<?php get_header(); ?>
<?php global $author; $userdata = get_userdata($author); ?>
<div id="mvp-content-body-wrap" class="left relative">
	<div id="mvp-author-page-top" class="left relative">
		<div class="mvp-author-top-out right relative">
			<div id="mvp-author-top-left" class="left relative">
				<?php echo get_avatar( $userdata->user_email, '200' ); ?>
			</div><!--mvp-author-top-left-->
			<div class="mvp-author-top-in">
				<div id="mvp-author-top-right" class="left relative">
					<h1 class="mvp-author-top-head left"><?php echo esc_html( $userdata->display_name ); ?></h1>
					<span class="mvp-author-page-desc left relative"><?php echo wp_kses_post( $userdata->description ); ?></span>
					<ul class="mvp-author-page-list left relative">
						<?php $mvp_email = get_option('mvp_author_email'); if ($mvp_email == "true") { ?>
							<a href="mailto:<?php echo esc_html($userdata->user_email); ?>"><li class="fa fa-envelope-o fa-2"></li></a>
						<?php } ?>
						<?php $authordesc = $userdata->facebook; if ( ! empty ( $authordesc ) ) { ?>
							<a href="<?php echo esc_url( $userdata->facebook); ?>" alt="Facebook" target="_blank"><li class="fa fa-facebook-official fa-2"></li></a>
						<?php } ?>
						<?php $authordesc = $userdata->twitter; if ( ! empty ( $authordesc ) ) { ?>
							<a href="<?php echo esc_url( $userdata->twitter); ?>" alt="Twitter" target="_blank"><li class="fa fa-twitter fa-2"></li></a>
						<?php } ?>
						<?php $authordesc = $userdata->pinterest; if ( ! empty ( $authordesc ) ) { ?>
							<a href="<?php echo esc_url( $userdata->pinterest); ?>" alt="Pinterest" target="_blank"><li class="fa fa-pinterest-p fa-2"></li></a>
						<?php } ?>
						<?php $authordesc = $userdata->instagram; if ( ! empty ( $authordesc ) ) { ?>
							<a href="<?php echo esc_url( $userdata->instagram); ?>" alt="Instagram" target="_blank"><li class="fa fa-instagram fa-2"></li></a>
						<?php } ?>
						<?php $authordesc = $userdata->googleplus; if ( ! empty ( $authordesc ) ) { ?>
							<a href="<?php echo esc_url( $userdata->googleplus); ?>" alt="Google Plus" target="_blank"><li class="fa fa-google-plus fa-2"></li></a>
						<?php } ?>
						<?php $authordesc = $userdata->linkedin; if ( ! empty ( $authordesc ) ) { ?>
							<a href="<?php echo esc_url( $userdata->linkedin); ?>" alt="LinkedIn" target="_blank"><li class="fa fa-linkedin fa-2"></li></a>
						<?php } ?>
					</ul>
				</div><!--mvp-author-top-right-->
			</div><!--mvp-author-top-in-->
		</div><!--mvp-author-top-out-->
	</div><!--mvp-author-page-top-->
	<div class="mvp-content-side-out relative">
		<div class="mvp-content-side-in">
			<div id="mvp-home-body" class="left relative">
				<h4 class="mvp-arch-head left"><?php esc_html_e( 'Stories By', 'click-mag' ); ?> <?php echo esc_html( $userdata->display_name ); ?></h4><span class="mvp-head-icon fa fa-arrow-circle-o-down fa-2" aria-hidden="true"></span>
				<?php if(get_option('mvp_cat_layout') == 'Column' ) { ?>
					<section id="mvp-tab-col1" class="mvp-blog-col-wrap left relative mvp-tab-col-cont">
						<ul class="mvp-blog-col-story left relative infinite-content">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
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
						</ul><!--mvp-blog-col-story-->
						<?php $mvp_infinite_scroll = get_option('mvp_infinite_scroll'); if ($mvp_infinite_scroll == "true") { if (isset($mvp_infinite_scroll)) { ?>
							<a href="#" class="mvp-inf-more-but"><?php esc_html_e( 'More Posts', 'click-mag' ); ?></a>
						<?php } } ?>
						<div class="mvp-nav-links">
							<?php if (function_exists("pagination")) { pagination($wp_query->max_num_pages); } ?>
						</div><!--mvp-nav-links-->
					</section><!--mvp-blog-col-wrap-->
				<?php } else { ?>
				<section class="mvp-main-blog-wrap left relative">
					<ul class="mvp-main-blog-story left relative infinite-content">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
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
					</ul><!--mvp-main-blog-story-->
					<?php $mvp_infinite_scroll = get_option('mvp_infinite_scroll'); if ($mvp_infinite_scroll == "true") { if (isset($mvp_infinite_scroll)) { ?>
						<a href="#" class="mvp-inf-more-but"><?php esc_html_e( 'More Posts', 'click-mag' ); ?></a>
					<?php } } ?>
					<div class="mvp-nav-links">
						<?php if (function_exists("pagination")) { pagination($wp_query->max_num_pages); } ?>
					</div><!--mvp-nav-links-->
				</section><!--mvp-main-blog-wrap-->
				<?php } ?>
			</div><!--mvp-home-body-->
		</div><!--mvp-content-side-in-->
		<?php get_sidebar(); ?>
	</div><!--mvp-content-side-out-->
</div><!--mvp-content-body-wrap-->
<?php get_footer(); ?>