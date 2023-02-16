<?php
/**
 * Widget API: Recent Post class
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 */

/**
 * Finix Recent Post
 */
function wpb_load_widget_recent_post() {
    register_widget( 'recent_post' );
}
add_action( 'widgets_init', 'wpb_load_widget_recent_post' );
 
/**
 * Core class used to implement a Recent Post widget.
 *
 * @since 1.1.0
 *
 * @see finix_Widget
 */
class recent_post extends WP_Widget {
 
    /**
	 * Sets up a new Recent Post widget instance.
	 *
	 * @since 1.1.0
	 */
    function __construct() {
        parent::__construct(
        
        // Base ID of your widget
        'recent_post', 
        
        // Widget name will appear in UI
        __('Finix Recent Post', 'finix'), 
        
        // Widget description
        array( 'description' => __( 'Finix Recent Post', 'finix' ), ) 
        );
    }
 
    /**
	 * Outputs the content for the current Recent Post widget instance.
	 *
	 * @since 1.1.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
    public function widget( $args, $instance ) {
        $title = isset( $instance['title'] ) ? $instance['title'] : false;
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
        $date = isset( $instance['date'] ) ? $instance['date'] : false;
        $image = isset( $instance['image'] ) ? $instance['image'] : false;

        $arg = array(
			'post_type'           => 'post',
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
		);
		$r   = new WP_Query( $arg );
        
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
        ?>
        <ul class="recent-post-list">
            <?php
            while ( $r->have_posts() ) :
            $r->the_post();
            ?>
            <li>
                <?php if ( $image ) : ?>
                <?php if(has_post_thumbnail()) { ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail ('thumbnail'); ?>
                    </div>
                <?php } ?>
                <?php endif; ?>

                <div class="post-info">
                    <?php if ( $date ) : ?>
                        <span class="post-date"><i class="ti ti-calendar"></i><?php echo get_the_date();  ?></span>
                    <?php endif; ?>
                    <a class="post-title" href="<?php echo esc_url(get_permalink($r->ID)); ?>"><?php the_title(); ?></a>
                </div>
            </li>
            <?php
            endwhile;
            ?>
        </ul>
    <?php
        echo $args['after_widget'];
    }
         
    /**
	 * Outputs the settings form for the Recent Post widget.
	 *
	 * @since 1.1.0
	 *
	 * @param array $instance Current settings.
	 */
    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : ''; 
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $date = isset( $instance['date'] ) ? (bool) $instance['date'] : false;
        $image = isset( $instance['image'] ) ? (bool) $instance['image'] : false;
    
        // Widget admin form
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:','finix' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p><label for="<?php echo esc_html($this->get_field_id( 'number','finix' )); ?>"><?php esc_html_e( 'Number Of Post:','finix' ); ?></label>
		<input class="tiny-text" id="<?php echo esc_html($this->get_field_id( 'number','finix' )); ?>" name="<?php echo esc_html($this->get_field_name( 'number','finix' )); ?>" type="number" step="1" min="1" value="<?php echo esc_html($number,'finix'); ?>" size="3" /></p>

        <p><input class="checkbox" type="checkbox"<?php checked( $date ); ?> id="<?php echo esc_html($this->get_field_id( 'date','finix' )); ?>" name="<?php echo esc_html($this->get_field_name( 'date','finix' )); ?>" />
		<label for="<?php echo esc_html($this->get_field_id( 'date','finix' )); ?>"><?php esc_html_e( 'Display Post Date?','finix' ); ?></label></p>

        <p><input class="checkbox" type="checkbox"<?php checked( $image ); ?> id="<?php echo esc_html($this->get_field_id( 'image','finix' )); ?>" name="<?php echo esc_html($this->get_field_name( 'image','finix' )); ?>" />
		<label for="<?php echo esc_html($this->get_field_id( 'image','finix' )); ?>"><?php esc_html_e( 'Display Post Thumbnail?','finix' ); ?></label></p>
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
        $instance = array();
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['number']    = (int) $new_instance['number'];
        $instance['date'] = isset( $new_instance['date'] ) ? (bool) $new_instance['date'] : false;
        $instance['image'] = isset( $new_instance['image'] ) ? (bool) $new_instance['image'] : false;
        return $instance;
    }
} // Class wpb_widget ends here
?>