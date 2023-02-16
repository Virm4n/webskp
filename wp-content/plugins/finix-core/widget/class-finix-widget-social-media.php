<?php
/**
 * Widget API: Social Media class
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 */

/**
 * Finix Social Media
 */
function wpb_load_widget_social_media() {
	register_widget( 'social_media' );
}
add_action( 'widgets_init', 'wpb_load_widget_social_media' );

/**
 * Core class used to implement a Social Media widget.
 *
 * @since 1.1.0
 *
 * @see finix_Widget
 */
class social_media extends WP_Widget {

	/**
	 * Sets up a new Social Media widget instance.
	 *
	 * @since 1.1.0
	 */
	function __construct() {
		parent::__construct(
		// Base ID of your widget
			'social_media',
			// Widget name will appear in UI
			__( 'Finix Social Media', 'finix' ),
			// Widget description
			array( 'description' => __( 'Finix Social Media', 'finix' ) )
		);
	}

	/**
	 * Outputs the content for the current Social Media widget instance.
	 *
	 * @since 1.1.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Social Medias widget instance.
	 */
	public function widget( $args, $instance ) {
		$title   = isset( $instance['title'] ) ? $instance['title'] : false;
		$contant = isset( $instance['contant'] ) ? $instance['contant'] : false;
		$style   = ( ! empty( $instance['style'] ) ) ? $instance['style'] : false;
		$color   = ( ! empty( $instance['color'] ) ) ? $instance['color'] : false;
		$shape   = ( ! empty( $instance['shape'] ) ) ? $instance['shape'] : false;

		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>

		<?php if ( $contant ) : ?>
			<div class="social-content"><?php echo $contant; ?></div>
		<?php endif; ?>

		<ul class="social-info <?php echo $style; ?> <?php echo $color; ?> <?php echo $shape; ?>">
			<?php finix_social_links(); ?>
		</ul>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Outputs the settings form for the Social Media widget.
	 *
	 * @since 1.1.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title   = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$contant = isset( $instance['contant'] ) ? esc_attr( $instance['contant'] ) : '';
		$style   = isset( $instance['style'] ) ? esc_attr( $instance['style'] ) : 'style-default';
		$color   = isset( $instance['color'] ) ? esc_attr( $instance['color'] ) : 'color-theme';
		$shape   = isset( $instance['shape'] ) ? esc_attr( $instance['shape'] ) : 'shape-square';
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
		<label for="<?php echo $this->get_field_id( 'text' ); ?>">Style: 
			<select class='widefat' id="<?php echo $this->get_field_id( 'style' ); ?>"
					name="<?php echo $this->get_field_name( 'style' ); ?>" type="text">
				<option value='style-default'<?php echo ( $style == 'style-default' ) ? 'selected' : ''; ?>>
					Default
				</option>
				<option value='style-flat'<?php echo ( $style == 'style-flat' ) ? 'selected' : ''; ?>>
					Flat
				</option>
				<option value='style-border'<?php echo ( $style == 'style-border' ) ? 'selected' : ''; ?>>
					Border
				</option> 
			</select>                
		</label>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'text' ); ?>">Color: 
			<select class='widefat' id="<?php echo $this->get_field_id( 'color' ); ?>"
					name="<?php echo $this->get_field_name( 'color' ); ?>" type="text">
				<option value='color-theme'<?php echo ( $color == 'color-theme' ) ? 'selected' : ''; ?>>
					Theme
				</option>
				<option value='color-dark'<?php echo ( $color == 'color-dark' ) ? 'selected' : ''; ?>>
					Dark
				</option>
				<option value='color-light'<?php echo ( $color == 'color-light' ) ? 'selected' : ''; ?>>
					Light
				</option> 
			</select>                
		</label>
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'text' ); ?>">Shape: 
			<select class='widefat' id="<?php echo $this->get_field_id( 'shape' ); ?>"
					name="<?php echo $this->get_field_name( 'shape' ); ?>" type="text">
				<option value='shape-square'<?php echo ( $shape == 'shape-square' ) ? 'selected' : ''; ?>>
					Square
				</option>
				<option value='shape-rounded'<?php echo ( $shape == 'shape-rounded' ) ? 'selected' : ''; ?>>
					Rounded
				</option>
				<option value='shape-round'<?php echo ( $shape == 'color-round' ) ? 'selected' : ''; ?>>
					Round
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
		$instance            = array();
		$instance['title']   = sanitize_text_field( $new_instance['title'] );
		$instance['contant'] = sanitize_text_field( $new_instance['contant'] );
		$instance['style']   = sanitize_text_field( $new_instance['style'] );
		$instance['color']   = sanitize_text_field( $new_instance['color'] );
		$instance['shape']   = sanitize_text_field( $new_instance['shape'] );
		return $instance;
	}
} // Class wpb_widget ends here
?>
