<?php
/**
 * Finix Comments
 *
 * @package Finix
 * @subpackage finix
 * @since finix 1.0
 */

/**
 * Finix Comment Function
 */
function finix_comments( $comment, $args, $depth ){ 
	// Get correct tag used for the comments
	if ( 'div' === $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	} ?>

	<<?php echo esc_attr($tag); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>">

	<?php
	// Switch between different comment types
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' : ?>
		<div class="pingback-entry"><span class="pingback-heading"><?php esc_html_e( 'Pingback:', 'finix' ); ?></span> <?php comment_author_link(); ?></div>
	<?php
		break;
		default :

		if ( 'div' != $args['style'] ) { ?>
			<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php } ?>
			<div class="comment-author">
				<div class="author-image">
				<?php
				
				// Display avatar unless size is set to 0
				if ( $args['avatar_size'] != 0 ) {
					$avatar_size = ! empty( 80 ) ? 80 : 70; // set default avatar size
						echo get_avatar( $comment, $avatar_size );
				}
				?>
				</div>
			</div><!-- .comment-author -->
			<div class="comment-details">
				<div class="author-info">
					<h4 class="author-name">
						<?php
						// Display author name
						printf( wp_kses( '%s', 'finix' ), get_comment_author_link() ); ?>
					</h4>
					<div class="comment-meta">
						<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><i class="ti ti-calendar"></i><?php
							/* translators: 1: date, 2: time */
							printf(
								wp_kses( '%1$s at %2$s', 'finix' ),
								get_comment_date(),
								get_comment_time()
							); ?>
						</a><?php
						edit_comment_link( esc_html__( '(Edit)', 'finix' ), '  ', '' ); ?>
					</div><!-- .comment-meta -->
				</div><!-- .author Info -->
				<div class="comment-description"><?php comment_text(); ?></div><!-- .comment-description -->
				<?php
				// Display comment moderation text
				if ( $comment->comment_approved == '0' ) { ?>
					<em class="comment-awaiting-moderation"><?php esc_html__( 'Your comment is awaiting moderation.', 'finix' ); ?></em><br/><?php
				} ?>
				<div class="reply"><?php
				// Display comment reply link
				comment_reply_link( array_merge( $args, array(
					'add_below' => $add_below,
					'depth'     => $depth,
					'max_depth' => $args['max_depth']
				) ) ); ?>
				</div>
			</div><!-- .comment-details -->
	<?php
		if ( 'div' != $args['style'] ) { ?>
			</div>
		<?php }
	// IMPORTANT: Note that we do NOT close the opening tag, WordPress does this for us
		break;
	endswitch; // End comment_type check.
}

/**
 * Move comments fields in last
 *
 * @param string $fields .
 */
function finix_move_comment_form_below( $fields ) {

	// Save fields to use later.
	$comment_field = isset( $fields['comment'] ) ? $fields['comment'] : '';
	$cookies_field = isset( $fields['cookies'] ) ? $fields['cookies'] : '';

	// Remove from current position.
	unset( $fields['comment'] );
	unset( $fields['cookies'] );

	// Re-assign saved fields to fields array.
	$fields['comment'] = $comment_field;
	$fields['cookies'] = $cookies_field;

	return $fields;
}
add_filter( 'comment_form_fields', 'finix_move_comment_form_below' );
?>
