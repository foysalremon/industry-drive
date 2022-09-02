<?php

if ( post_password_required() ) {
	return;
}

?>

<?php
	if (number_format_i18n(get_comments_number())!=0) {
?>
	<div class="section comments-section">
        <div class="container">
            <h2 class="section-title"><?php printf(_n('One Comment','%s Comments',get_comments_number(),'industry-dive'),number_format_i18n( get_comments_number() )); ?></h2>
            
            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
                <nav id="comment-nav-below" class="comment-navigation" role="navigation">
                    <div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'industry-dive' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'industry-dive' ) ); ?></div>
                    <div class="clearfix"></div>
                </nav>
            <?php endif;?>
            
            <ol class="comment-list">
                <?php
                    wp_list_comments( array(
                        'style'       => 'ol',
                        'short_ping'  => true,
                    ) );
                ?>
            </ol>
        </div>
	</div>
<?php
	}
?>
	<div class="section section-give-your-reply">
		<div class="container">
        <?php if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e('Comments are closed','industry-dive'); ?></p>
		<?php endif; ?>
		<?php
			$commenter = wp_get_current_commenter();
			$req = get_option( 'require_name_email' );
			$aria_req = ( $req ? " aria-required='true'" : '' );
			$required_text = '  ';
			$args = array(
				'id_form'           => 'commentForm',
				'class_form'           =>'comment-respond',
				'title_reply'       => __('Write a Comment', 'industry-dive'),
				'submit_button'      =>'<button type="submit" class="btn btn-primary">'.esc_html__('Post Comment','industry-dive').'</button>',

				'fields' => apply_filters( 'comment_form_default_fields', 
				array(
					'author' => '<div class="row"><div class="col col-6">
									<label>'.esc_html__('Your Name ', 'industry-dive').'<br/>
										<input type="text" name="author" id="author" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' placeholder="' . esc_html__( 'Enter your name here..','industry-dive') . '" />
									</label>
								</div>',
					'email' => ' <div class="col col-6">
									<label>'.esc_html__('Your Email ', 'industry-dive').'<br/>
										<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' placeholder="' . esc_html__( 'Enter your mail here..','industry-dive') . '" />
									</label>
								</div></div>'
				) ),
				'comment_field' =>  '<label>'.esc_html__('Comment ', 'industry-dive').'<br/>
										<textarea name="comment"'.$aria_req.' rows="5" placeholder="'.esc_html__('Enter your comment here..','industry-dive').'"></textarea>
									</label>',
				'label_submit' => esc_html__('Post Comment','industry-dive'),
			);
			comment_form($args); ?>
        </div>
	</div>
