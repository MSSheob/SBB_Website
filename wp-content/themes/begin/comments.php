<?php
if ( post_password_required() ) {
	return;
}?>

<div id="comments" class="comments-area">
    <?php if ( have_comments() ) : ?>

	    <h3><?php comments_number(esc_html__('No Comments','begin'), esc_html__('Comment ( 1 )','begin'), esc_html__('Comments ( % )','begin') );?></h3>

		<?php the_comments_navigation(); ?>

        <ul class="commentlist">
     		<?php wp_list_comments( array( 'callback' => 'begin_comment_style' ) ); ?>
        </ul>

        <?php the_comments_navigation(); ?>

    <?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
        <p class="nocomments"><?php esc_html_e( 'Comments are closed.','begin'); ?></p>
    <?php endif;?>    
	
    <?php

	$fields = array(
    "author" => "<div class='column dt-sc-one-half'><p><input id='author' name='author' type='text' placeholder='".esc_html__("Name",'begin')."' required /></p>",
    "email" => "<p> <input id='email' name='email' type='text' placeholder='".esc_html__("Email",'begin')."' required /> </p></div>",
	);

	$comment = "<div class='column dt-sc-one-half first'><textarea id='comment' name='comment' cols='5' rows='3' placeholder='".esc_html__("Comment",'begin')."' ></textarea></div>";
	
	if( cs_get_option('privacy-commentform') == "true" ) {
		$content = do_shortcode( cs_get_option('privacy-commentform-msg') );
		$fields['comment-form-dt-privatepolicy'] = '<p class="comment-form-dt-privatepolicy">
			<input id="comment-form-dt-privatepolicy" name="comment-form-dt-privatepolicy" type="checkbox" value="yes">
			<label for="comment-form-dt-privatepolicy">'.$content.'</label>
		</p>';
	}
	
	$comments_args = array(
		'title_reply' 			=> 	esc_html__( 'Leave a Comment','begin' ),
		'fields'				=> 	$fields,
		'comment_field'			=> 	$comment,
		'comment_notes_before'	=>	'',
		'comment_notes_after'	=>	'',
		'label_submit'			=>	esc_html__('Comment','begin'));

	comment_form($comments_args); ?>

</div><!-- .comments-area -->