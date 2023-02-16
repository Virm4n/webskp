<?php
/**
 * Widget API: Testimonial class
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 */

/**
 * Finix Testimonial
 */
function wpb_load_widget_testimonial() {
	register_widget( 'testimonial' );
}
add_action( 'widgets_init', 'wpb_load_widget_testimonial' );

/**
 * Core class used to implement a Testimonial widget.
 *
 * @since 1.1.0
 *
 * @see finix_Widget
 */
class testimonial extends WP_Widget {

	/**
	 * Sets up a new Testimonial widget instance.
	 *
	 * @since 1.1.0
	 */
	function __construct() {
		parent::__construct(
		// Base ID of your widget
			'testimonial',
			// Widget name will appear in UI
			__( 'Finix Testimonial', 'finix' ),
			// Widget description
			array( 'description' => __( 'Finix Testimonial', 'finix' ) )
		);
	}

	/**
	 * Outputs the content for the current Testimonial widget instance.
	 *
	 * @since 1.1.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Testimonials widget instance.
	 */
	public function widget( $args, $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : false;
		$no    = ( ! empty( $instance['no'] ) ) ? absint( $instance['no'] ) : 3;
		if ( ! $no ) {
			$no = 5;
		}
		$date  = isset( $instance['date'] ) ? $instance['date'] : false;
		$image = isset( $instance['image'] ) ? $instance['image'] : false;

		$arg = array(
			'post_type'           => 'testimonial',
			'posts_per_page'      => $no,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
		);
		$r   = new WP_Query( $arg );

		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>
		<div class="swiper-container" data-items="1" data-lg-items="1" data-md-items="1" data-sm-items="1" data-xs-items="1" data-space="10">
			<div class="swiper-wrapper">
					<?php
					while ( $r->have_posts() ) :
					$r->the_post();
					?>
					<div class="swiper-slide">
						<div class="testimonial-inner">    
							<div class="author-content"><?php the_content(); ?></div>
							<div class="author-details">
								<div class="author-photo"><?php the_post_thumbnail( 'thumbnail' ); ?></div>
								<div class="author-info">
									<h5 class="author-name"><?php the_title(); ?></h5>
									<?php
									$designation = get_post_meta( get_the_ID(), 'designation', true );
									if ( ! empty( $designation ) ) {
										?>
									<span class="author-position"><?php echo sprintf( '%s', esc_html( $designation, 'finix' ) ); ?></span>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<?php
					endwhile;
					?>
					
				</div>
			</div>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Outputs the settings form for the Testimonial widget.
	 *
	 * @since 1.1.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$no    = isset( $instance['no'] ) ? absint( $instance['no'] ) : 3;

		// Widget admin form
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'finix' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p><label for="<?php echo esc_html( $this->get_field_id( 'no', 'finix' ) ); ?>"><?php esc_html_e( 'Number Of Testimonial:', 'finix' ); ?></label>
		<input class="tiny-text" id="<?php echo esc_html( $this->get_field_id( 'no', 'finix' ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'no', 'finix' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_html( $no, 'finix' ); ?>" size="3" /></p>

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
		$instance          = array();
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['no']    = (int) $new_instance['no'];
		return $instance;
	}
} // Class wpb_widget ends here
?>
