<?php
/**
 * Widget API: Newsletter class
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 */

/**
 * Finix Newsletter
 */
function wpb_load_widget_newsletter() {
	register_widget( 'newsletter' );
}
add_action( 'widgets_init', 'wpb_load_widget_newsletter' );

/**
 * Core class used to implement a Newsletter widget.
 *
 * @since 1.1.0
 *
 * @see finix_Widget
 */
class newsletter extends WP_Widget {

	/**
	 * Sets up a new Newsletter widget instance.
	 *
	 * @since 1.1.0
	 */
	function __construct() {
		parent::__construct(
		// Base ID of your widget
			'newsletter',
			// Widget name will appear in UI
			__( 'Finix Newsletter', 'finix' ),
			// Widget description
			array( 'description' => __( 'Finix Newsletter', 'finix' ) )
		);
	}

	/**
	 * Outputs the content for the current Newsletter widget instance.
	 *
	 * @since 1.1.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		$title     = isset( $instance['title'] ) ? $instance['title'] : false;
		$contant   = isset( $instance['contant'] ) ? $instance['contant'] : false;
		$style     = ( ! empty( $instance['style'] ) ) ? $instance['style'] : false;
		$colortype = ( ! empty( $instance['colortype'] ) ) ? $instance['colortype'] : false;

		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>

	
		<div class="newsletter-content"><?php echo $contant; ?></div>

		<div class="newsletter-form <?php echo $style; ?> <?php echo $colortype; ?>">
			<?php
			$finix_opt = get_option( 'finix_redux' );

			if ( isset( $finix_opt['mailchimp_shortcode'] ) ) {
				$mailchimp_shortcode = $finix_opt['mailchimp_shortcode'];
			}

			echo do_shortcode( $mailchimp_shortcode );
			?>
		</div>

		<?php
		echo $args['after_widget'];
	}

	/**
	 * Outputs the settings form for the Newsletter widget.
	 *
	 * @since 1.1.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$contant   = isset( $instance['contant'] ) ? esc_attr( $instance['contant'] ) : '';
		$style     = isset( $instance['style'] ) ? esc_attr( $instance['style'] ) : 'style-1';
		$colortype = isset( $instance['colortype'] ) ? esc_attr( $instance['colortype'] ) : 'color-theme';
		// Widget admin form
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'finix' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
		<label for="<?php echo esc_html( $this->get_field_id( 'contant', 'finix' ) ); ?>"><?php esc_html_e( 'Contant:', 'finix' ); ?></label> 
		<textarea class="widefat" id="<?php echo esc_html( $this->get_field_id( 'contant', 'finix' ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'contant', 'finix' ) ); ?>" rows="3"><?php echo esc_html( $contant, 'finix' ); ?></textarea>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'text' ); ?>">Newsletter Style: 
			<select class='widefat' id="<?php echo $this->get_field_id( 'style' ); ?>"
					name="<?php echo $this->get_field_name( 'style' ); ?>" type="text">
				<option value='style-1'<?php echo ( $style == 'Style 1' ) ? 'selected' : ''; ?>>
					Style 1
				</option>
				<option value='style-2'<?php echo ( $style == 'Style 2' ) ? 'selected' : ''; ?>>
					Style 2
				</option> 
			</select>                
		</label>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'text' ); ?>">Color Type: 
			<select class='widefat' id="<?php echo $this->get_field_id( 'colortype' ); ?>"
					name="<?php echo $this->get_field_name( 'colortype' ); ?>" type="text">
				<option value='color-theme'<?php echo ( $colortype == 'Theme' ) ? 'selected' : ''; ?>>
					Theme
				</option>
				<option value='color-dark'<?php echo ( $colortype == 'Dark' ) ? 'selected' : ''; ?>>
					Dark
				</option>
				<option value='color-light'<?php echo ( $colortype == 'Light' ) ? 'selected' : ''; ?>>
					Light
				</option> 
			</select>                
		</label>
		</p>
		<?php
	}

	/**
	 * Handles updating the settings for the current Conatct Info widget instance.
	 *
	 * @since 1.1.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance              = array();
		$instance['title']     = sanitize_text_field( $new_instance['title'] );
		$instance['contant']   = sanitize_text_field( $new_instance['contant'] );
		$instance['style']     = sanitize_text_field( $new_instance['style'] );
		$instance['colortype'] = sanitize_text_field( $new_instance['colortype'] );
		return $instance;
	}
} // Class wpb_widget ends here
?>
