<?php
	/* Template Name: Full Width */
?>
<?php get_header(); ?>
<?php global $author; $userdata = get_userdata($author); ?>
<div id="mvp-post-area" <?php post_class(); ?>>
			<div id="mvp-content-left-wrap" class="left relative">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article id="mvp-post-content-wrap" class="left relative" itemscope itemtype="http://schema.org/NewsArticle">
				<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php the_permalink(); ?>"/>
				<div id="mvp-post-content" class="left relative">
							<div id="mvp-post-content-mid" class="left relative">
								<header id="mvp-post-head" class="left relative">
									<h1 class="mvp-post-title entry-title" itemprop="headline"><?php the_title(); ?></h1>
									<div id="mvp-post-info-wrap" class="left relative">
										<div id="mvp-post-info-bot" class="right relative">
											<ul class="mvp-post-soc-list left relative">
												<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="<?php esc_html_e( 'Share on Facebook', 'click-mag' ); ?>">
												<li class="mvp-post-soc-fb">
													<i class="fa fa-facebook-square fa-2" aria-hidden="true"></i><span class="mvp-post-soc-text"><?php esc_html_e( 'Share', 'click-mag' ); ?></span>
												</li>
												</a>
												<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&amp;url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="<?php esc_html_e( 'Tweet This Post', 'click-mag' ); ?>">
												<li class="mvp-post-soc-twit">
													<i class="fa fa-twitter fa-2" aria-hidden="true"></i><span class="mvp-post-soc-text"><?php esc_html_e( 'Tweet', 'click-mag' ); ?></span>
												</li>
												</a>
												<a href="whatsapp://send?text=<?php the_title(); ?> <?php the_permalink() ?>">
												<li class="mvp-post-soc-what">
													<i class="fa fa-whatsapp fa-2" aria-hidden="true"></i>
												</li>
												</a>
												<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'mvp-post-thumb' ); echo $thumb['0']; ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="<?php esc_html_e( 'Pin This Post', 'click-mag' ); ?>">
												<li class="mvp-post-soc-pin">
													<i class="fa fa-pinterest-p fa-2" aria-hidden="true"></i>
												</li>
												</a>
												<a href="mailto:?subject=<?php the_title(); ?>&amp;BODY=<?php esc_html_e( 'I found this article interesting and thought of sharing it with you. Check it out:', 'click-mag' ); ?> <?php the_permalink(); ?>">
												<li class="mvp-post-soc-email">
													<i class="fa fa-envelope-o fa-2" aria-hidden="true"></i>
												</li>
												</a>
												<?php if ( comments_open() ) { ?>
												<?php $disqus_id = get_option('mvp_disqus_id'); if ($disqus_id) { if (isset($disqus_id)) {  ?>
													<a href="#disqus_thread">
													<li class="mvp-post-soc-comm mvp-com-click">
														<i class="fa fa-comment-o fa-2" aria-hidden="true"></i><span class="mvp-post-soc-text"><?php esc_html_e( 'Comment', 'click-mag' ); ?></span>
													</li>
													</a>
												<?php } } else { ?>
													<a href="<?php comments_link(); ?>">
													<li class="mvp-post-soc-comm mvp-com-click">
														<i class="fa fa-comment-o fa-2" aria-hidden="true"></i><span class="mvp-post-soc-text"><?php comments_number(__( 'Comment', 'click-mag'), esc_html__('1 Comment', 'click-mag'), esc_html__('% Comments', 'click-mag'));?></span>
													</li>
													</a>
												<?php } ?>
												<?php } ?>
											</ul>
										</div><!--mvp-post-info-bot-->
									</div><!--mvp-post-info-wrap-->
								</header>
								<section id="mvp-content-main" itemprop="articleBody" <?php post_class(); ?>>
									<?php the_content(); ?>
									<?php wp_link_pages(); ?>
								</section><!--mvp-content-main-->
								<div class="mvp-org-wrap" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
									<div class="mvp-org-logo" itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
										<?php if(get_option('mvp_logo')) { ?>
											<img src="<?php echo esc_url(get_option('mvp_logo')); ?>"/>
											<meta itemprop="url" content="<?php echo esc_url(get_option('mvp_logo')); ?>">
										<?php } else { ?>
											<img src="<?php echo get_template_directory_uri(); ?>/images/logos/logo.png" alt="<?php bloginfo( 'name' ); ?>" />
											<meta itemprop="url" content="<?php echo get_template_directory_uri(); ?>/images/logos/logo.png">
										<?php } ?>
									</div><!--mvp-org-logo-->
									<meta itemprop="name" content="<?php bloginfo( 'name' ); ?>">
								</div><!--mvp-org-wrap-->
								<?php if ( comments_open() ) { ?>
									<?php $disqus_id = get_option('mvp_disqus_id'); if ($disqus_id) { if (isset($disqus_id)) {  ?>
										<div id="mvp-comments-button" class="left relative mvp-com-click">
											<span class="mvp-comment-but-text"><?php comments_number(__( 'Comments', 'click-mag'), esc_html__('Comments', 'click-mag'), esc_html__('Comments', 'click-mag')); ?></span>
										</div><!--mvp-comments-button-->
										<?php $disqus_id2 = esc_html($disqus_id); mvp_disqus_embed($disqus_id2); ?>
									<?php } } else { ?>
										<?php $mvp_click_id = get_the_ID(); ?>
										<div id="mvp-comments-button" class="left relative mvp-com-click">
											<span class="mvp-comment-but-text"><?php comments_number(__( 'Click to comment', 'click-mag'), esc_html__('1 Comment', 'click-mag'), esc_html__('% Comments', 'click-mag'));?></span>
										</div><!--mvp-comments-button-->
										<?php comments_template(); ?>
									<?php } ?>
								<?php } ?>
							</div><!--mvp-post-content-mid-->
				</div><!--mvp-post-content-->
			</article><!--mvp-post-content-wrap-->
			<?php endwhile; endif; ?>
			</div><!--mvp-content-left-wrap-->
</div><!--mvp-post-area-->
<?php get_footer(); ?>