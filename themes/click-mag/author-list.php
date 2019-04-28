<?php
	/* Template Name: Authors List */
?>
<?php get_header(); ?>
<div id="mvp-post-area" <?php post_class(); ?>>
	<div class="mvp-content-side-out relative">
		<div class="mvp-content-side-in">
			<div id="mvp-content-left-wrap" class="left relative">
				<div id="mvp-post-content-wrap" class="left relative">
					<div id="mvp-post-content" class="left relative">
						<div id="mvp-post-content-mid" class="left relative">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
								<h1 class="mvp-arch-head"><?php the_title(); ?></h1>
							<?php endwhile; endif; ?>
							<?php $mvp_users = get_users('orderby=post_count&order=DESC'); foreach($mvp_users as $user) { $post_count = count_user_posts( $user->ID ); if($post_count < 1) continue; ?>
								<section class="mvp-authors-list-wrap left relative">
									<div class="mvp-authors-list-left left relative">
										<div class="mvp-authors-list-out">
											<div class="mvp-authors-list-img left relative">
												<?php echo get_avatar( $user->user_email, '150' ); ?>
											</div><!--mvp-authors-list-img-->
											<div class="mvp-authors-list-in">
												<div class="mvp-authors-list-text left relative">
													<h3 class="mvp-authors-list-head"><a href="<?php echo get_author_posts_url( $user->ID ); ?>"><?php echo esc_html( $user->display_name ); ?></a></h3>
													<p><?php echo wp_kses_post( $user->description ); ?></p>
												</div><!--mvp-authors-list-text-->
											</div><!--mvp-authors-list-in-->
										</div><!--mvp-authors-list-out-->
									</div><!--mvp-authors-list-left-->
									<div class="mvp-authors-list-right left relative">
										<span class="mvp-authors-list-post-head left relative"><?php esc_html_e( 'Latest from', 'click-mag' ); ?> <?php echo esc_html( $user->display_name ); ?></span>
										<?php wp_get_current_user(); $author_query = array('posts_per_page' => '5','author' => $user->ID); $author_posts = new WP_Query($author_query); while($author_posts->have_posts()) : $author_posts->the_post(); ?>
											<div class="mvp-authors-list-posts left relative">
												<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
											</div><!--mvp-authors-list-posts-->
										<?php endwhile; ?>
									</div><!--mvp-authors-list-right-->
								</section><!--mvp-authors-page-list-wrap-->
							<?php } ?>
						</div><!--mvp-post-content-mid-->
					</div><!--mvp-post-content-->
				</div><!--mvp-post-content-wrap-->
			</div><!--mvp-content-left-wrap-->
		</div><!--mvp-content-side-in-->
		<?php get_sidebar(); ?>
	</div><!--mvp-content-side-out-->
</div><!--mvp-post-area-->
<?php get_footer(); ?>