<?php get_header(); ?>
<?php global $author; $userdata = get_userdata($author); ?>
<div id="mvp-post-area" <?php post_class(); ?>>
	<div class="mvp-content-side-out relative">
		<div class="mvp-content-side-in">
			<div id="mvp-content-left-wrap" class="left relative">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article id="mvp-post-content-wrap" class="left relative" itemscope itemtype="http://schema.org/NewsArticle">
				<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php the_permalink(); ?>"/>
				<?php $mvp_featured_img = get_option('mvp_featured_img'); if ($mvp_featured_img == "true") { ?>
					<?php $mvp_show_hide = get_post_meta($post->ID, "mvp_featured_image", true); if ($mvp_show_hide !== "hide") { ?>
						<?php $mvp_img_loc = get_post_meta($post->ID, "mvp_img_loc", true); if ($mvp_img_loc == "small") { } else { ?>
							<?php if(get_post_meta($post->ID, "mvp_video_embed", true)) { ?>
								<div id="mvp-video-embed" class="left relative">
									<?php echo html_entity_decode(get_post_meta($post->ID, "mvp_video_embed", true)); ?>
								</div><!--mvp-video-embed-->
								<div class="mvp-post-img-hide" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
									<?php $thumb_id = get_post_thumbnail_id(); $mvp_thumb_array = wp_get_attachment_image_src($thumb_id, 'mvp-post-thumb', true); $mvp_thumb_url = $mvp_thumb_array[0]; $mvp_thumb_width = $mvp_thumb_array[1]; $mvp_thumb_height = $mvp_thumb_array[2]; ?>
									<meta itemprop="url" content="<?php echo esc_url($mvp_thumb_url) ?>">
									<meta itemprop="width" content="<?php echo esc_html($mvp_thumb_width) ?>">
									<meta itemprop="height" content="<?php echo esc_html($mvp_thumb_height) ?>">
								</div><!--mvp-post-img-hide-->
							<?php } else { ?>
								<?php global $post; $mvp_post_temp = get_post_meta($post->ID, "mvp_post_template", true); if ( $mvp_post_temp == "temp2" ) { ?>
									<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
										<div id="mvp-post-feat2-img" class="left relative" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
											<?php the_post_thumbnail(''); ?>
											<?php $thumb_id = get_post_thumbnail_id(); $mvp_thumb_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true); $mvp_thumb_url = $mvp_thumb_array[0]; $mvp_thumb_width = $mvp_thumb_array[1]; $mvp_thumb_height = $mvp_thumb_array[2]; ?>
											<meta itemprop="url" content="<?php echo esc_url($mvp_thumb_url) ?>">
											<meta itemprop="width" content="<?php echo esc_html($mvp_thumb_width) ?>">
											<meta itemprop="height" content="<?php echo esc_html($mvp_thumb_height) ?>">
											<div id="mvp-post-feat2-text">
												<a class="mvp-post-cat-link" href="<?php $category = get_the_category(); $category_id = get_cat_ID( $category[0]->cat_name ); $category_link = get_category_link( $category_id ); echo esc_url( $category_link ); ?>"><h3 class="mvp-post-cat left"><span class="mvp-post-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3></a>
												<div class="mvp-post-feat2-title left relative">
													<h1 class="mvp-post-title entry-title" itemprop="headline"><?php the_title(); ?></h1>
												</div><!--mvp-post-feat2-title-->
											</div><!--mvp-post-feat2-text-->
										</div><!--mvp-post-feat2-img-->
									<?php } ?>
								<?php } else { ?>
									<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
										<div id="mvp-post-feat-img" class="left relative" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
											<?php the_post_thumbnail(''); ?>
											<?php $thumb_id = get_post_thumbnail_id(); $mvp_thumb_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true); $mvp_thumb_url = $mvp_thumb_array[0]; $mvp_thumb_width = $mvp_thumb_array[1]; $mvp_thumb_height = $mvp_thumb_array[2]; ?>
											<meta itemprop="url" content="<?php echo esc_url($mvp_thumb_url) ?>">
											<meta itemprop="width" content="<?php echo esc_html($mvp_thumb_width) ?>">
											<meta itemprop="height" content="<?php echo esc_html($mvp_thumb_height) ?>">
										</div><!--mvp-post-feat-img-->
									<?php } ?>
								<?php } ?>
							<?php } ?>
						<?php } ?>
					<?php } else { ?>
						<div class="mvp-post-img-hide" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
							<?php $thumb_id = get_post_thumbnail_id(); $mvp_thumb_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true); $mvp_thumb_url = $mvp_thumb_array[0]; $mvp_thumb_width = $mvp_thumb_array[1]; $mvp_thumb_height = $mvp_thumb_array[2]; ?>
							<meta itemprop="url" content="<?php echo esc_url($mvp_thumb_url) ?>">
							<meta itemprop="width" content="<?php echo esc_html($mvp_thumb_width) ?>">
							<meta itemprop="height" content="<?php echo esc_html($mvp_thumb_height) ?>">
						</div><!--mvp-post-img-hide-->
					<?php } ?>
				<?php } else { ?>
					<div class="mvp-post-img-hide" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
						<?php $thumb_id = get_post_thumbnail_id(); $mvp_thumb_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true); $mvp_thumb_url = $mvp_thumb_array[0]; $mvp_thumb_width = $mvp_thumb_array[1]; $mvp_thumb_height = $mvp_thumb_array[2]; ?>
						<meta itemprop="url" content="<?php echo esc_url($mvp_thumb_url) ?>">
						<meta itemprop="width" content="<?php echo esc_html($mvp_thumb_width) ?>">
						<meta itemprop="height" content="<?php echo esc_html($mvp_thumb_height) ?>">
					</div><!--mvp-post-img-hide-->
				<?php } ?>
				<div id="mvp-post-content" class="left relative">
					<div class="mvp-post-content-out relative">
						<?php $mvp_related = get_option('mvp_related_posts'); if ($mvp_related == "true") { ?>
							<div id="mvp-post-info-col" class="left relative">
								<?php mvp_RelatedPosts(); ?>
							</div><!--mvp-post-info-col-->
						<?php } ?>
						<div class="mvp-post-content-in">
							<div id="mvp-post-content-mid" class="left relative">
				<?php $mvp_featured_img = get_option('mvp_featured_img'); if ($mvp_featured_img == "true") { ?>
					<?php $mvp_show_hide = get_post_meta($post->ID, "mvp_featured_image", true); if ($mvp_show_hide !== "hide") { ?>
						<?php $mvp_img_loc = get_post_meta($post->ID, "mvp_img_loc", true); if ($mvp_img_loc == "small") { ?>
							<?php if(get_post_meta($post->ID, "mvp_video_embed", true)) { ?>
								<div id="mvp-video-embed" class="left relative">
									<?php echo html_entity_decode(get_post_meta($post->ID, "mvp_video_embed", true)); ?>
								</div><!--mvp-video-embed-->
								<div class="mvp-post-img-hide" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
									<?php $thumb_id = get_post_thumbnail_id(); $mvp_thumb_array = wp_get_attachment_image_src($thumb_id, 'mvp-post-thumb', true); $mvp_thumb_url = $mvp_thumb_array[0]; $mvp_thumb_width = $mvp_thumb_array[1]; $mvp_thumb_height = $mvp_thumb_array[2]; ?>
									<meta itemprop="url" content="<?php echo esc_url($mvp_thumb_url) ?>">
									<meta itemprop="width" content="<?php echo esc_html($mvp_thumb_width) ?>">
									<meta itemprop="height" content="<?php echo esc_html($mvp_thumb_height) ?>">
								</div><!--mvp-post-img-hide-->
							<?php } else { ?>
								<?php global $post; $mvp_post_temp = get_post_meta($post->ID, "mvp_post_template", true); if ( $mvp_post_temp == "temp2" ) { ?>
									<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
										<div id="mvp-post-feat2-img" class="left relative" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
											<?php the_post_thumbnail(''); ?>
											<?php $thumb_id = get_post_thumbnail_id(); $mvp_thumb_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true); $mvp_thumb_url = $mvp_thumb_array[0]; $mvp_thumb_width = $mvp_thumb_array[1]; $mvp_thumb_height = $mvp_thumb_array[2]; ?>
											<meta itemprop="url" content="<?php echo esc_url($mvp_thumb_url) ?>">
											<meta itemprop="width" content="<?php echo esc_html($mvp_thumb_width) ?>">
											<meta itemprop="height" content="<?php echo esc_html($mvp_thumb_height) ?>">
											<div id="mvp-post-feat2-text">
												<a class="mvp-post-cat-link" href="<?php $category = get_the_category(); $category_id = get_cat_ID( $category[0]->cat_name ); $category_link = get_category_link( $category_id ); echo esc_url( $category_link ); ?>"><h3 class="mvp-post-cat left"><span class="mvp-post-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3></a>
												<div class="mvp-post-feat2-title left relative">
													<h1 class="mvp-post-title entry-title" itemprop="headline"><?php the_title(); ?></h1>
												</div><!--mvp-post-feat2-title-->
											</div><!--mvp-post-feat2-text-->
										</div><!--mvp-post-feat2-img-->
									<?php } ?>
								<?php } else { ?>
									<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
										<div id="mvp-post-feat-img" class="left relative" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
											<?php the_post_thumbnail(''); ?>
											<?php $thumb_id = get_post_thumbnail_id(); $mvp_thumb_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true); $mvp_thumb_url = $mvp_thumb_array[0]; $mvp_thumb_width = $mvp_thumb_array[1]; $mvp_thumb_height = $mvp_thumb_array[2]; ?>
											<meta itemprop="url" content="<?php echo esc_url($mvp_thumb_url) ?>">
											<meta itemprop="width" content="<?php echo esc_html($mvp_thumb_width) ?>">
											<meta itemprop="height" content="<?php echo esc_html($mvp_thumb_height) ?>">
										</div><!--mvp-post-feat-img-->
									<?php } ?>
								<?php } ?>
							<?php } ?>
						<?php } ?>
					<?php } ?>
				<?php } ?>
								<?php global $post; if(get_post_meta($post->ID, "mvp_photo_credit", true)): ?>
									<span class="mvp-feat-caption"><?php echo wp_kses_post(get_post_meta($post->ID, "mvp_photo_credit", true)); ?></span>
								<?php endif; ?>
								<header id="mvp-post-head" class="left relative">
									<?php global $post; $mvp_post_temp = get_post_meta($post->ID, "mvp_post_template", true); if ( $mvp_post_temp == "temp2" ) { ?>
										<?php $mvp_show_hide = get_post_meta($post->ID, "mvp_featured_image", true); if ($mvp_show_hide !== "hide") { ?>
											<div class="mvp-post-feat2-title-blank">
												<h2 class="entry-title" itemprop="headline"><?php the_title(); ?></h2>
											</div><!--mvp-post-feat2-title-->
										<?php } else { ?>
											<a class="mvp-post-cat-link" href="<?php $category = get_the_category(); $category_id = get_cat_ID( $category[0]->cat_name ); $category_link = get_category_link( $category_id ); echo esc_url( $category_link ); ?>"><h3 class="mvp-post-cat left"><span class="mvp-post-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3></a>
											<h1 class="mvp-post-title entry-title" itemprop="headline"><?php the_title(); ?></h1>
										<?php } ?>
									<?php } else { ?>
										<a class="mvp-post-cat-link" href="<?php $category = get_the_category(); $category_id = get_cat_ID( $category[0]->cat_name ); $category_link = get_category_link( $category_id ); echo esc_url( $category_link ); ?>"><h3 class="mvp-post-cat left"><span class="mvp-post-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3></a>
										<h1 class="mvp-post-title entry-title" itemprop="headline"><?php the_title(); ?></h1>
									<?php } ?>
									<?php if ( has_excerpt() ) { ?>
										<span class="mvp-post-excerpt left"><?php the_excerpt(); ?></span>
									<?php } ?>
									<div id="mvp-post-info-wrap" class="left relative">
										<div id="mvp-post-info-top" class="left relative">
											<div class="mvp-post-info-out right relative">
												<div id="mvp-post-author-img" class="left relative">
													<?php echo get_avatar( get_the_author_meta('email'), '45' ); ?>
												</div><!--mvp-post-author-img-->
												<div class="mvp-post-info-in">
													<div id="mvp-post-author" class="left relative" itemprop="author" itemscope itemtype="https://schema.org/Person">
														<p><?php esc_html_e( 'By', 'click-mag' ); ?><p><span class="author-name vcard fn author" itemprop="name"><?php the_author_posts_link(); ?></span> <?php $authtwitter = get_the_author_meta( 'twitter' ); if ( ! empty ( $authtwitter ) ) { ?><span class="mvp-author-twit"><a href="<?php echo esc_url(the_author_meta('twitter')); ?>" class="twitter-but" target="_blank"><i class="fa fa-twitter fa-2"></i></a></span><?php } ?> <?php $mvp_email = get_option('mvp_author_email'); if ($mvp_email == "true") { ?><span class="mvp-author-email"><a href="mailto:<?php the_author_meta('email'); ?>"><i class="fa fa-envelope-o fa-2"></i></a></span><?php } ?>
													</div><!--mvp-post-author-->
													<div id="mvp-post-date" class="left relative">
														<span class="post-info-text"><?php esc_html_e( 'Published on', 'click-mag' ); ?></span> <span class="post-date updated"><time class="post-date updated" itemprop="datePublished" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(get_option('date_format')); ?></time></span>
														<meta itemprop="dateModified" content="<?php the_modified_date('Y-m-d'); ?>"/>
													</div><!--mvp-post-date-->
												</div><!--mvp-post-info-in-->
											</div><!--mvp-post-info-out-->
										</div><!--mvp-post-info-top-->
										<?php $socialbox = get_option('mvp_social_box'); if ($socialbox == "true") { ?>
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
												<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'mvp-post-thumb' ); echo esc_url($thumb['0']); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="<?php esc_html_e( 'Pin This Post', 'click-mag' ); ?>">
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
										<?php } ?>
									</div><!--mvp-post-info-wrap-->
								</header>
								<section id="mvp-content-main" itemprop="articleBody" <?php post_class(); ?>>
									<?php the_content(); ?>
									<?php wp_link_pages(); ?>
									<?php $mvp_show_gallery = get_post_meta($post->ID, "mvp_post_gallery", true); if ($mvp_show_gallery == "show") { ?>
										<section class="mvp-post-gallery-wrap left relative">
											<div class="mvp-post-gallery-top left relative flexslider">
												<ul class="mvp-post-gallery-top-list slides">
													<?php $images = get_posts(array( 'post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'ASC' )); foreach($images as $image) { ?>
														<li>
    															<?php echo wp_get_attachment_image($image->ID, 'mvp-post-thumb'); ?>
														</li>
													<?php } ?>
												</ul>
											</div><!--mvp-post-gallery-top-->
											<div class="mvp-post-gallery-bot left relative flexslider">
												<ul class="mvp-post-gallery-bot-list slides">
													<?php $images = get_posts(array( 'post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'ASC' )); foreach($images as $image) { ?>
														<li>
    															<?php echo wp_get_attachment_image($image->ID, 'mvp-small-thumb'); ?>
														</li>
													<?php } ?>
												</ul>
											</div><!--mvp-post-gallery-bot-->
										</section><!--mvp-post-gallery-wrap-->
									<?php } ?>
								</section><!--mvp-content-main-->
								<div id="mvp-ad-rel-wrap">
									<div id="mvp-ad-rel-top" class="left relative">
										<span class="mvp-ad-rel-but mvp-ad-rel-click"><?php esc_html_e( 'Klik untuk Melanjutkan', 'click-mag' ); ?></span>
									</div><!--mvp-ad-rel-top-->
									<div id="mvp-ad-rel-bot" class="left relative">
										<div class="mvp-ad-rel-out right relative">
											<?php $mvp_post_ad = get_option('mvp_post_ad'); if ($mvp_post_ad) { ?>
												<div id="mvp-post-bot-ad" class="left relative">
													<span class="mvp-ad-label"><?php esc_html_e( 'Advertisement', 'click-mag' ); ?></span>
													<?php $mvp_post_ad = get_option('mvp_post_ad'); if ($mvp_post_ad) { echo html_entity_decode($mvp_post_ad); } ?>
												</div><!--mvp-post-bot-ad-->
											<?php } ?>
											<div class="mvp-ad-rel-in">
												<?php $mvp_related = get_option('mvp_related_posts'); if ($mvp_related == "true") { ?>
													<div id="mvp-post-bot-rel" class="left relative">
														<span class="mvp-related-head left relative"><?php esc_html_e( 'Berita Terkait', 'click-mag' ); ?></span>
														<?php mvp_RelatedPosts(); ?>
													</div><!--mvp-post-bot-rel-->
												<?php } ?>
											</div><!--mvp-ad-rel-in-->
										</div><!--mvp-ad-rel-out-->
									</div><!--mvp-ad-rel-bot-->
								</div><!--mvp-ad-rel-wrap-->
								<div class="mvp-post-tags">
									<span class="mvp-post-tags-header"><?php esc_html_e( 'Related Topics:', 'click-mag' ); ?></span><span itemprop="keywords"><?php the_tags('',', ','') ?></span>
								</div><!--mvp-post-tags-->
								<div class="posts-nav-link">
									<?php posts_nav_link(); ?>
								</div><!--posts-nav-link-->
								<?php $author = get_option('mvp_author_box'); if ($author == "true") { ?>
									<div id="mvp-author-box-wrap" class="left relative">
										<div class="mvp-author-box-out right relative">
											<div id="mvp-author-box-img" class="left relative">
												<?php echo get_avatar( get_the_author_meta('email'), '100' ); ?>
											</div><!--mvp-author-box-img-->
											<div class="mvp-author-box-in">
												<div id="mvp-author-box-text" class="left relative">
													<span class="mvp-author-box-name left relative"><?php the_author_posts_link(); ?></span>
													<p><?php the_author_meta('description'); ?></p>
									<div id="mvp-author-box-soc-wrap" class="left relative">
										<?php $mvp_email = get_option('mvp_author_email'); if ($mvp_email == "true") { ?>
											<a href="mailto:<?php the_author_meta('email'); ?>"><span class="mvp-author-box-soc fa fa-envelope-square fa-2"></span></a>
										<?php } ?>
										<?php $authordesc = get_the_author_meta( 'facebook' ); if ( ! empty ( $authordesc ) ) { ?>
											<a href="<?php the_author_meta('facebook'); ?>" alt="Facebook" target="_blank"><span class="mvp-author-box-soc fa fa-facebook-square fa-2"></span></a>
										<?php } ?>
										<?php $authordesc = get_the_author_meta( 'twitter' ); if ( ! empty ( $authordesc ) ) { ?>
											<a href="<?php the_author_meta('twitter'); ?>" alt="Twitter" target="_blank"><span class="mvp-author-box-soc fa fa-twitter-square fa-2"></span></a>
										<?php } ?>
										<?php $authordesc = get_the_author_meta( 'pinterest' ); if ( ! empty ( $authordesc ) ) { ?>
											<a href="<?php the_author_meta('pinterest'); ?>" alt="Pinterest" target="_blank"><span class="mvp-author-box-soc fa fa-pinterest-square fa-2"></span></a>
										<?php } ?>
										<?php $authordesc = get_the_author_meta( 'googleplus' ); if ( ! empty ( $authordesc ) ) { ?>
											<a href="<?php the_author_meta('googleplus'); ?>" alt="Google Plus" target="_blank"><span class="mvp-author-box-soc fa fa-google-plus-square fa-2"></span></a>
										<?php } ?>
										<?php $authordesc = get_the_author_meta( 'instagram' ); if ( ! empty ( $authordesc ) ) { ?>
											<a href="<?php the_author_meta('instagram'); ?>" alt="Instagram" target="_blank"><span class="mvp-author-box-soc fa fa-instagram fa-2"></span></a>
										<?php } ?>
										<?php $authordesc = get_the_author_meta( 'linkedin' ); if ( ! empty ( $authordesc ) ) { ?>
											<a href="<?php the_author_meta('linkedin'); ?>" alt="LinkedIn" target="_blank"><span class="mvp-author-box-soc fa fa-linkedin-square fa-2"></span></a>
										<?php } ?>
									</div><!--mvp-author-box-soc-wrap-->
												</div><!--mvp-author-box-text-->
											</div><!--mvp-author-box-in-->
										</div><!--mvp-author-box-out-->
									</div><!--mvp-author-box-wrap-->
								<?php } ?>
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
											<span class="mvp-comment-but-text"><?php comments_number(__( 'Komentar', 'click-mag'), esc_html__('1 Comment', 'click-mag'), esc_html__('% Comments', 'click-mag'));?></span>
										</div><!--mvp-comments-button-->
										<?php comments_template(); ?>
									<?php } ?>
								<?php } ?>
							</div><!--mvp-post-content-mid-->
						</div><!--mvp-post-content-in-->
					</div><!--mvp-post-content-out-->
				</div><!--mvp-post-content-->
			</article><!--mvp-post-content-wrap-->
			<?php setCrunchifyPostViews(get_the_ID()); ?>
			<?php endwhile; endif; ?>
			<?php $mvp_more = get_option('mvp_more_posts'); if ($mvp_more == "true") { ?>
			<div id="mvp-post-bot-wrap" class="left relative">
				<h4 class="mvp-post-bot-head left"><?php esc_html_e( 'Berita Tentang', 'click-mag' ); ?> <?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></h4>
				<section class="mvp-main-blog-wrap left relative">
					<ul class="mvp-main-blog-story left relative">
					<?php $mvp_more_num = esc_html(get_option('mvp_more_num')); $category = get_the_category(); $current_cat = $category[0]->cat_ID; $recent = new WP_Query(array( 'cat' => $current_cat, 'posts_per_page' => $mvp_more_num, 'post__not_in' => array( $post->ID ) )); while($recent->have_posts()) : $recent->the_post(); ?>
						<li>
						<div class="mvp-main-blog-out relative">
							<a href="<?php the_permalink(); ?>" rel="bookmark">
							<div class="mvp-main-blog-img left relative">
								<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
									<?php the_post_thumbnail('mvp-mid-thumb', array( 'class' => 'mvp-reg-img' )); ?>
									<?php the_post_thumbnail('mvp-small-thumb', array( 'class' => 'mvp-mob-img' )); ?>
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
							</div><!--mvp-main-blog-img-->
							</a>
							<div class="mvp-main-blog-in">
								<div class="mvp-main-blog-text left relative">
									<h3 class="mvp-main-blog-cat left"><span class="mvp-main-blog-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></h3>
									<a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
									<div class="mvp-feat1-info">
										<span class="mvp-blog-author"><?php esc_html_e( 'By', 'click-mag' ); ?> <?php the_author_posts_link(); ?></span><span class="mvp-blog-date"><i class="fa fa-clock-o"></i><time class="mvp-blog-time"><?php the_time(get_option('date_format')); ?></time></span>
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
					</li>
					<?php endwhile; wp_reset_query(); ?>
					</ul><!--mvp-main-blog-story-->
				</section><!--mvp-main-blog-wrap-->
			</div><!--mvp-post-bot-wrap-->
			<?php } ?>
			<?php $prev_next = get_option('mvp_prev_next'); if ($prev_next == "true") { ?>
				<div id="mvp-prev-next-wrap">
					<?php $prev_post = get_previous_post(TRUE, ''); if (!empty( $prev_post )) { ?>
						<div id="mvp-prev-post-wrap">
							<div id="mvp-prev-post-arrow" class="relative">
								<i class="fa fa-angle-left fa-4"></i>
							</div><!--mvp-prev-post-arrow-->
							<div class="mvp-prev-next-text">
								<?php previous_post_link('%link', '%title', TRUE); ?>
							</div><!--mvp-prev-post-text-->
						</div><!--mvp-prev-post-wrap-->
					<?php } ?>
					<?php $next_post = get_next_post(TRUE, ''); if (!empty( $next_post )) { ?>
						<div id="mvp-next-post-wrap">
							<div id="mvp-next-post-arrow" class="relative">
								<i class="fa fa-angle-right fa-4"></i>
							</div><!--mvp-prev-post-arrow-->
							<div class="mvp-prev-next-text">
								<?php next_post_link('%link', '%title', TRUE); ?>
							</div><!--mvp-prev-next-text-->
						</div><!--mvp-next-post-wrap-->
					<?php } ?>
				</div><!--mvp-prev-next-wrap-->
			<?php } ?>
			</div><!--mvp-content-left-wrap-->
		</div><!--mvp-content-side-in-->
		<?php get_sidebar(); ?>
	</div><!--mvp-content-side-out-->
</div><!--mvp-post-area-->
<?php get_footer(); ?>