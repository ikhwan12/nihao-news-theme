<!--RWP Review-->
<div
	class="rwp-review-wrap <?php $this->template_field('template_theme'); ?>"
	id="<?php echo $this->vueID; ?>"
	style="color: <?php $this->template_field('template_text_color'); ?>; font-size: <?php $this->template_field('template_box_font_size') ?>px"
    data-post-id="<?php echo $this->post_id; ?>"
    data-box-id="<?php $this->review_field('review_id'); ?>"
    data-template-id="<?php $this->template_field('template_id') ?>"
    data-disabled="<?php echo intval($this->is_users_rating_disabled()) ?>"
    data-sharing-review-link-label="<?php _e( 'Copy and paste the URL to share the review', 'reviewer' ) ?>"
    data-per-page="<?php echo $this->ratings_per_page ?>"
>

    <div class="rwp-review">
        <?php
            if( empty( $this->branch ) || $this->branch == 'recap' ) {

                $title_option = $this->review_field('review_title_options', true);
                // $same_as_url  = $this->review_field('review_sameas_attr', true);
                // $same_as_url  = empty( $same_as_url ) ? esc_url( get_permalink( $this->post_id ) ) : esc_url( $same_as_url );

                switch ( $title_option ) {
                    case 'hidden':
                        break;

                    case 'post_title':
                        $title = get_the_title( $this->post_id );
                        echo '<span class="rwp-title"><em>'. $title .'</em></span>';
                        break;

                    default:
                        $title = $this->review_field('review_title', true );
                        if(!empty( $title ) ) {
                            echo '<span class="rwp-title"><em>'. $title .'</em></span>';
                        }
                        break;
                }
            }
        ?>

        <?php $this->include_sections( $this->themes[ $this->template_field('template_theme', true) ], $hide_criteria_scores ); ?>

    </div><!-- /review -->

    <?php // echo '<pre>{{$data | json}}</pre>' ?>

    <?php
    // Snippets
    $snippets = $this->preferences_field('preferences_snippets', true);
    if (empty($this->branch) && $snippets['field_enabled']) {
        $identifier = ($this->is_automatic) ? $this->auto_review_id : $this->review_field('review_id', true);
        echo do_shortcode('[rwp_snippets template="'. $this->template_field('template_id', true) .'" post="'. $this->post_id .'" box="'. $identifier .'"]');
    }
    ?>

</div><!--/review-wrap-->


