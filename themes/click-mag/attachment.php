<?php get_header(); ?>
<?php global $author; $userdata = get_userdata($author); ?>
<div id="mvp-post-area" <?php post_class(); ?>>
	<div class="mvp-content-side-out relative">
		<div class="mvp-content-side-in">
			<div id="mvp-content-left-wrap" class="left relative">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article id="mvp-post-content-wrap" class="left relative" itemscope itemtype="http://schema.org/NewsArticle">
				<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php the_permalink(); ?>"/>
				<div id="mvp-post-content" class="left relative">
							<div id="mvp-post-content-mid" class="left relative">
								<?php global $post; if(get_post_meta($post->ID, "mvp_photo_credit", true)): ?>
									<span class="mvp-feat-caption"><?php echo wp_kses_post(get_post_meta($post->ID, "mvp_photo_credit", true)); ?></span>
								<?php endif; ?>
								<header id="mvp-post-head" class="left relative">
									<h1 class="mvp-post-title entry-title" itemprop="headline"><?php the_title(); ?></h1>
									<?php if ( has_excerpt() ) { ?>
										<span class="mvp-post-excerpt left"><?php the_excerpt(); ?></span>
									<?php } ?>
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
											</ul>
										</div><!--mvp-post-info-bot-->
									</div><!--mvp-post-info-wrap-->
								</header>
								<section id="mvp-content-main" itemprop="articleBody" <?php post_class(); ?>>
 									<?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "post"); ?>
										<a href="<?php echo esc_url(wp_get_attachment_url($post->id)); ?>" title="<?php the_title(); ?>" rel="attachment"><img src="<?php echo esc_url( $att_image[0] );?>" class="attachment-post" alt="<?php the_title(); ?>" /></a>
									<?php else : ?>
										<a href="<?php echo esc_url(wp_get_attachment_url($post->ID)); ?>" title="<?php echo esc_html( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo esc_html(basename($post->guid)); ?></a>
									<?php endif; ?>
								</section><!--mvp-content-main-->
							</div><!--mvp-post-content-mid-->
				</div><!--mvp-post-content-->
			</article><!--mvp-post-content-wrap-->
			<?php endwhile; endif; ?>
			</div><!--mvp-content-left-wrap-->
		</div><!--mvp-content-side-in-->
		<?php get_sidebar(); ?>
	</div><!--mvp-content-side-out-->
</div><!--mvp-post-area-->
<?php get_footer(); ?>