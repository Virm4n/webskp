<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">
	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php echo esc_html__( 'Comment', 'finix' ); ?>
			<?php
			$comments_number = get_comments_number();
			echo esc_html( $comments_number );
			?>
		</h2>

		<?php finix_comment_nav(); ?>
		
		<ol class="commentlist">
			<?php
			wp_list_comments(
				array(
					'callback' => 'finix_comments',
					'style'    => 'ol',
					'short_ping'  => true,
				)
			);
			?>
		</ol>

		<?php

		finix_comment_nav();

		the_comments_pagination(
			array(
				'prev_text' => finix_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . esc_html__( 'Previous', 'finix' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next', 'finix' ) . '</span>' . finix_get_svg( array( 'icon' => 'arrow-right' ) ),
			)
		);

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() ) :
		?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'finix' ); ?></p>
		<?php
	endif;

	if ( comments_open() ) {
		?>
		<section class="respond-form">
			<?php
			$req      = get_option( 'require_name_email' );
			$aria_req = ( $req ? " aria-required='true'" : '' );

			$commenter = wp_get_current_commenter();
			$consent   = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

			$com_args = array(
				'class_form'          => 'comment-form contact-form',
				'title_reply_before'  => '<h3 id="reply-title" class="comment-reply-title text-blue">',
				'comment_notes_after' => '', // remove "Text or HTML to be displayed after the set of comment fields".
				'class_submit'        => 'submit button pull-left',
				/**
				 * Filters the default comment form fields.
				 *
				 * @since 3.0.0
				 *
				 * @param array $fields The default comment fields.
				 * @visible false
				 * @ignore
				 */
				'fields'              => apply_filters(
					'comment_form_default_fields',
					array(
						'author'  => '<div class="section-field comment-form-author">' .
							'<input id="author" class="placeholder" placeholder="' . esc_attr__( 'Name', 'finix' ) . '*" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' .
							'</div>',
						'email'   => '<div class="section-field comment-form-email">' .
							'<input id="email" class="placeholder" placeholder="' . esc_attr__( 'Email', 'finix' ) . '*" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' .
							'</div>',
						'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
							'<label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name and email in this browser for the next time I comment.', 'finix' ) . '</label></p>',
					)
				),
				'comment_field'       => '<div class="section-field textarea comment-form-comment">' .
					'<textarea id="comment" class="input-message placeholder" name="comment" placeholder="' . esc_attr__( 'Comment', 'finix' ) . '" cols="45" rows="8" aria-required="true"></textarea>' .
					'</div>',
			);
			comment_form( $com_args );
			// If registration required and not logged in.
			?>
		</section>
		<?php
	} // if you delete this the sky will fall on your head.
	?>
</div><!-- #comments -->
