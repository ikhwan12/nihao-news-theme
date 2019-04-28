<?php get_header(); ?>
<div id="mvp-post-area">
	<div class="mvp-content-side-out relative">
		<div class="mvp-content-side-in">
			<div id="mvp-content-left-wrap" class="left relative">
				<article id="mvp-post-content-wrap" class="left relative">
					<div id="mvp-post-content" class="left relative">
						<div id="mvp-post-content-mid" class="left relative">
							<?php if(is_single()) { if (have_posts()) : while (have_posts()) : the_post(); ?>
								<?php woocommerce_breadcrumb(); ?>
							<?php endwhile; endif; } else { ?>
								<?php woocommerce_breadcrumb(); ?>
							<?php } ?>
							<div id="woo-content">
								<?php woocommerce_content(); ?>
								<?php wp_link_pages(); ?>
							</div><!--woo-content-->
						</div><!--mvp-post-content-mid-->
					</div><!--mvp-post-content-->
				</article><!--mvp-post-content-wrap-->
			</div><!--mvp-content-left-wrap-->
		</div><!--mvp-content-side-in-->
		<?php get_sidebar('woo'); ?>
	</div><!--mvp-content-side-out-->
</div><!--mvp-post-area-->
<?php get_footer(); ?>