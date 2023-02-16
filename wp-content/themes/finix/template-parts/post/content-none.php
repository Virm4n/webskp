<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

?>
<div class="no-results not-found">
	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :
			?>

			<p><?php printf( esc_html_e( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'finix' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'finix' ); ?></p>
			<?php
				get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</div><!-- .no-results -->
