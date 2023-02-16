<?php
/**
 * Finix Helper Functions
 *
 * @package Finix
 * @subpackage finix
 * @since finix 1.0
*/

// Social Links
function finix_social_links() {
	$finix_opt = get_option( 'finix_redux' );
	?>
	<?php if ( ! empty( $finix_opt['facebook'] ) ) { ?>
		<li> <a href="<?php echo esc_url( $finix_opt['facebook'] ); ?>"><i class="fab fa-facebook-f" aria-hidden="true"></i></a> </li>
	<?php } ?>

	<?php if ( ! empty( $finix_opt['twitter'] ) ) { ?>
		<li> <a href="<?php echo esc_url( $finix_opt['twitter'] ); ?>"><i class="fab fa-twitter" aria-hidden="true"></i></a> </li>
	<?php } ?>

	<?php if ( ! empty( $finix_opt['instagram'] ) ) { ?>
		<li> <a href="<?php echo esc_url( $finix_opt['instagram'] ); ?>"><i class="fab fa-instagram" aria-hidden="true"></i></a> </li>
	<?php } ?>

	<?php if ( ! empty( $finix_opt['linkedin'] ) ) { ?>
		<li> <a href="<?php echo esc_url( $finix_opt['linkedin'] ); ?>"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a> </li>
	<?php } ?>

	<?php if ( ! empty( $finix_opt['youtube'] ) ) { ?>
		<li> <a href="<?php echo esc_url( $finix_opt['youtube'] ); ?>"><i class="fab fa-youtube" aria-hidden="true"></i></a> </li>
	<?php } ?>

	<?php if ( ! empty( $finix_opt['github'] ) ) { ?>
		<li> <a href="<?php echo esc_url( $finix_opt['github'] ); ?>"><i class="fab fa-github" aria-hidden="true"></i></a> </li>
	<?php } ?>

	<?php if ( ! empty( $finix_opt['dribbble'] ) ) { ?>
		<li> <a href="<?php echo esc_url( $finix_opt['dribbble'] ); ?>"><i class="fab fa-dribbble" aria-hidden="true"></i></a> </li>
	<?php }
}

// finix User Profile Info.
if ( is_super_admin() ) {
	if ( ! function_exists( 'finix_user_profile_info' ) ) {
		function finix_user_profile_info( $user ) {
			$user_profile_info = get_the_author_meta( 'finix_info', $user->ID ); ?>
			<h3><?php esc_html_e( 'User Profile', 'finix' ); ?></h3>

			<table class="form-table">
				<tbody>
					<tr>
						<th>
							<label for="finix_facebook"><?php esc_html_e( 'Facebook Account', 'finix' ); ?></label>
						</th>
						<td>
							<input id="finix_facebook" class="user-text" type="text"
								value="<?php echo isset( $user_profile_info['facebook'] ) ? $user_profile_info['facebook'] : ''; ?>"
								name="finix_info[facebook]">
						</td>
					</tr>
					<tr>
						<th>
							<label for="finix_twitter"><?php esc_html_e( 'Twitter Account', 'finix' ); ?></label>
						</th>
						<td>
							<input id="finix_twitter" class="user-text" type="text"
								value="<?php echo isset( $user_profile_info['twitter'] ) ? $user_profile_info['twitter'] : ''; ?>"
								name="finix_info[twitter]">
						</td>
					</tr>
					<tr>
						<th>
							<label for="finix_instagram"><?php esc_html_e( 'Instagram Account', 'finix' ); ?></label>
						</th>
						<td>
							<input id="finix_instagram" class="user-text" type="text"
								value="<?php echo isset( $user_profile_info['instagram'] ) ? $user_profile_info['instagram'] : ''; ?>"
								name="finix_info[instagram]">
						</td>
					</tr>
					<tr>
						<th>
							<label for="finix_linkedin"><?php esc_html_e( 'LinkedIn Account', 'finix' ); ?></label>
						</th>
						<td>
							<input id="finix_linkedin" class="user-text" type="text"
								value="<?php echo isset( $user_profile_info['linkedin'] ) ? $user_profile_info['linkedin'] : ''; ?>"
								name="finix_info[linkedin]">
						</td>
					</tr>
					<tr>
						<th>
							<label for="finix_youtube"><?php esc_html_e( 'Youtube Account', 'finix' ); ?></label>
						</th>
						<td>
							<input id="finix_youtube" class="user-text" type="text"
								value="<?php echo isset( $user_profile_info['youtube'] ) ? $user_profile_info['youtube'] : ''; ?>"
								name="finix_info[youtube]">
						</td>
					</tr>
				</tbody>
			</table>
			<?php
		}
	}

	add_action( 'show_user_profile', 'finix_user_profile_info' );
	add_action( 'edit_user_profile', 'finix_user_profile_info' );


	function finix_save_user_profile_info( $user_id ) {

		if ( ! current_user_can( 'edit_user', $user_id ) ) {
			return false;
		}
		update_user_meta( $user_id, 'finix_info', $_POST['finix_info'] );
	}

	add_action( 'personal_options_update', 'finix_save_user_profile_info' );
	add_action( 'edit_user_profile_update', 'finix_save_user_profile_info' );
}

// Comment Number.
function finix_get_comments_number_text( $zero = false, $one = false, $more = false, $post_id = 0 ) {
	$number = get_comments_number( $post_id );

	if ( $number > 1 ) {
		if ( false === $more ) {
			/* translators: %s: Number of comments. */
			$output = sprintf( _n( '%s Comment', '%s Comments', $number, 'finix' ), number_format_i18n( $number ) );
		} else {
			// % Comments
			/*
			 * translators: If comment number in your language requires declension,
			 * translate this to 'on'. Do not translate into your own language.
			 */
			if ( 'on' === _x( 'off', 'Comment number declension: on or off', 'finix' ) ) {
				$text = preg_replace( '#<span class="screen-reader-text">.+?</span>#', '', $more );
				$text = preg_replace( '/&.+?;/', '', $text ); // Kill entities.
				$text = trim( strip_tags( $text ), '% ' );

				// Replace '% Comments' with a proper plural form.
				if ( $text && ! preg_match( '/[0-9]+/', $text ) && false !== strpos( $more, '%' ) ) {
					/* translators: %s: Number of comments. */
					$new_text = _n( '%s Comment', '%s Comments', $number, 'finix' );
					$new_text = trim( sprintf( $new_text, '' ) );

					$more = str_replace( $text, $new_text, $more );
					if ( false === strpos( $more, '%' ) ) {
						$more = '% ' . $more;
					}
				}
			}

			$output = str_replace( '%', number_format_i18n( $number ), $more );
		}
	} elseif ( 0 == $number ) {
		$output = ( false === $zero ) ? __( '0 Comments', 'finix' ) : $zero;
	} else { // Must be one.
		$output = ( false === $one ) ? __( '1 Comment', 'finix' ) : $one;
	}
	/**
	 * Filters the comments count for display.
	 *
	 * @since 1.5.0
	 *
	 * @see _n()
	 *
	 * @param string $output A translatable string formatted based on whether the count
	 *                       is equal to 0, 1, or 1+.
	 * @param int    $number The number of post comments.
	 */
	return apply_filters( 'comments_number', $output, $number );
}
?>
