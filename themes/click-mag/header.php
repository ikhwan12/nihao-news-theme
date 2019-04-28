<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-132853365-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-132853365-1');
</script>
<meta charset="<?php bloginfo('charset'); ?>" >
<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { if(get_option('mvp_favicon')) { ?><link rel="shortcut icon" href="<?php echo esc_url(get_option('mvp_favicon')); ?>" /><?php } } ?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'mvp-post-thumb' ); ?>
<meta property="og:image" content="<?php echo esc_url( $thumb['0'] ); ?>" />
<meta name="twitter:image" content="<?php echo esc_url( $thumb['0'] ); ?>" />
<?php } ?>
<?php if ( is_single() ) { ?>
<meta property="og:type" content="article" />
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<meta property="og:description" content="<?php echo strip_tags(get_the_excerpt()); ?>" />
<meta name="twitter:card" content="summary">
<meta name="twitter:url" content="<?php the_permalink() ?>">
<meta name="twitter:title" content="<?php the_title(); ?>">
<meta name="twitter:description" content="<?php echo strip_tags(get_the_excerpt()); ?>">
<?php endwhile; endif; ?>
<?php } else { ?>
<meta property="og:description" content="<?php bloginfo('description'); ?>" />
<?php } ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(''); ?>>
	<?php get_template_part('fly-menu'); ?>
	<?php if(get_option('mvp_wall_ad')) { ?>
		<div id="mvp-wallpaper">
			<?php if(get_option('mvp_wall_url')) { ?>
				<a href="<?php echo esc_url(get_option('mvp_wall_url')); ?>" class="mvp-wall-link" target="_blank"></a>
			<?php } ?>
		</div><!--mvp-wallpaper-->
	<?php } ?>
	<div id="mvp-site" class="left relative">
		<header id="mvp-head-wrap" class="left relative">
			<div id="mvp-head-top" class="left relative">
				<?php if(get_option('mvp_header_leader')) { ?>
					<div id="mvp-leader-wrap" class="left relative">
						<?php $ad970 = get_option('mvp_header_leader'); if ($ad970) { echo html_entity_decode($ad970); } ?>
					</div><!--mvp-leader-wrap-->
				<?php } ?>
				<?php $mvp_logo_loc = get_option('mvp_logo_loc'); if($mvp_logo_loc == 'Large') { ?>
					<div id="mvp-logo-wide" class="left relative">
						<div class="mvp-main-out relative">
							<div class="mvp-main-in">
								<?php if(get_option('mvp_logo')) { ?>
									<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img itemprop="logo" src="<?php echo esc_url(get_option('mvp_logo')); ?>" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
								<?php } else { ?>
									<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img itemprop="logo" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
								<?php } ?>
								<?php if ( is_home() || is_front_page() ) { ?>
									<h1 class="mvp-logo-title"><?php bloginfo( 'name' ); ?></h1>
								<?php } else { ?>
									<h2 class="mvp-logo-title"><?php bloginfo( 'name' ); ?></h2>
								<?php } ?>
							</div><!--mvp-main-in-->
						</div><!--mvp-main-out-->
					</div><!--mvp-logo-wide-->
				<?php } ?>
				<div id="mvp-search-wrap">
					<div id="mvp-search-box">
						<?php get_search_form(); ?>
					</div><!--mvp-search-box-->
					<div class="mvp-search-but-wrap mvp-search-click">
						<span></span>
						<span></span>
					</div><!--mvp-search-but-wrap-->
				</div><!--mvp-search-wrap-->
			</div><!--mvp-head-top-->
			<div id="mvp-nav-wrap" class="left relative">
				<div class="mvp-main-boxed-wrap">
					<div class="mvp-main-out relative">
						<div class="mvp-main-in">
							<div class="mvp-main-nav-cont left relative">
				<div class="mvp-nav-left-out">
					<div class="mvp-fly-but-wrap mvp-fly-but-click left relative">
						<span></span>
						<span></span>
						<span></span>
						<span></span>
					</div><!--mvp-fly-but-wrap-->
					<div id="mvp-logo-nav" class="left relative" itemscope itemtype="http://schema.org/Organization">
						<?php if(get_option('mvp_logo')) { ?>
							<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img itemprop="logo" src="<?php echo esc_url(get_option('mvp_logo_nav')); ?>" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
						<?php } else { ?>
							<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img itemprop="logo" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-nav.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
						<?php } ?>
						<?php if ( is_home() || is_front_page() ) { ?>
							<h1 class="mvp-logo-title"><?php bloginfo( 'name' ); ?></h1>
						<?php } else { ?>
							<h2 class="mvp-logo-title"><?php bloginfo( 'name' ); ?></h2>
						<?php } ?>
					</div><!--mvp-logo-nav-->
					<div class="mvp-nav-left-in">
						<div id="mvp-nav-right-wrap" class="left">
							<div class="mvp-nav-right-out">
								<div class="mvp-nav-right-in">
									<div id="mvp-nav-main" class="left">
										<nav id="mvp-nav-menu">
											<?php wp_nav_menu(array('theme_location' => 'main-menu')); ?>
										</nav><!--mvp-nav-menu-->
									</div><!--mvp-nav-main-->
								</div><!--mvp-nav-right-in-->
								<div id="mvp-nav-right" class="relative">
									<div id="mvp-nav-soc" class="left relative">
										<?php if(get_option('mvp_facebook')) { ?>
											<a href="<?php echo esc_html(get_option('mvp_facebook')); ?>" target="_blank"><span class="mvp-nav-soc-but fa fa-facebook fa-2"></span></a>
										<?php } ?>
										<?php if(get_option('mvp_twitter')) { ?>
											<a href="<?php echo esc_html(get_option('mvp_twitter')); ?>" target="_blank"><span class="mvp-nav-soc-but fa fa-twitter fa-2"></span></a>
										<?php } ?>
									</div><!--mvp-nav-soc-->
									<span class="mvp-nav-search-but fa fa-search fa-2 mvp-search-click"></span>

								</div><!--mvp-nav-right-->
							</div><!--mvp-nav-right-out-->
						</div><!--mvp-nav-right-wrap-->
					</div><!--mvp-nav-left-in-->
				</div><!--mvp-nav-left-out-->
							</div><!--mvp-main-nav-cont-->
						</div><!--mvp-main-in-->
					</div><!--mvp-main-out-->
				</div><!--mvp-main-boxed-wrap-->
			</div><!--mvp-nav-wrap-->
			<?php if (is_single()) { ?>
				<?php $socialbox = get_option('mvp_social_box'); if ($socialbox == "true") { ?>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div id="mvp-nav-soc-bar">
					<div class="mvp-main-out relative">
						<div class="mvp-main-in">
							<div id="mvp-nav-soc-cont" class="left relative">
								<div id="mvp-nav-soc-title" class="left">
									<h4><?php the_title(); ?></h4>
								</div><!--mvp-nav-soc-title-->
								<div id="mvp-nav-soc-list" class="left">
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
								</div><!--mvp-nav-soc-list-->
							</div><!--mvp-nav-soc-cont-->
						</div><!--mvp-main-in-->
					</div><!--mvp-main-out-->
				</div><!--mvp-nav-soc-bar-->
				<?php endwhile; endif; ?>
				<?php } ?>
			<?php } ?>
		</header><!--mvp-head-wrap-->
		<div id="mvp-main-wrap" class="left relative">
			<div class="mvp-main-boxed-wrap">
				<div class="mvp-main-out relative">
					<div class="mvp-main-in">
						<div id="mvp-main-content-wrap" class="left relative">