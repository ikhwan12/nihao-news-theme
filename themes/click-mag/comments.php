<div id="comments">
	<?php if ( post_password_required() ) : ?>
	<p class="nopassword"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'click-mag' ); ?></p>

	<?php
	/* Stop the rest of comments.php from being processed,
	 * but don't kill the script entirely -- we still have
	 * to fully load the template.
	 */
	return;
	endif;

		// You can start editing here -- including this comment!
	?>
	<?php if ( have_comments() ) : ?>
		<h4 class="mvp-post-header"><span class="mvp-post-header">
			<?php
			printf( _n( '1 Comment', '%1$s Comments', get_comments_number(), 'click-mag' ),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?>
		</span></h4>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
	<div class="navigation">
		<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'click-mag' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'click-mag' ) ); ?></div>
	</div> <!--navigation-->
	<?php endif; // check for comment navigation ?>
	<ol class="commentlist">
		<?php
		wp_list_comments( array( 'callback' => 'mvp_comment' ) );
		?>
	</ol>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
	<div class="navigation">
		<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'click-mag' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'click-mag' ) ); ?></div>
	</div> <!--navigation-->
	<?php endif; // check for comment navigation ?>
	<?php else : // or, if we don't have comments:

		/* If there are no comments and comments are closed,
		 * let's leave a little note, shall we?
		 */
		if ( ! comments_open() ) :
			/* <p class="nocomments"><?php esc_html_e( 'Comments are closed.', 'click-mag' ); ?></p> */
		endif; // end ! comments_open() ?>
	<?php endif; // end have_comments() ?>
	<?php if (get_option('comment_registration') && !$user_ID) : ?>
		<p>
			<?php esc_html_e('You must be logged in to post a comment' , 'click-mag'); ?>
			<a href="<?php echo esc_url(get_option('siteurl')); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">
				<?php esc_html_e('Login', 'click-mag'); ?>
			</a>
		</p>
	<?php else : ?>

	<?php endif; ?>

<?php comment_form(
	array(
		'title_reply' => '<h4 class="mvp-post-header"><span class="mvp-post-header">' . esc_html__( 'Leave a Reply', 'click-mag' ) . '</span></h4>',
		'title_reply_to' => '<h4 class="mvp-post-header"><span class="mvp-post-header">' . esc_html__( 'Leave a Reply', 'click-mag' ) . '</span></h4>',
	)
); ?>

</div><!--comments-->