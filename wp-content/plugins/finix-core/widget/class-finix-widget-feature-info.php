<?php
/**
 * Widget API: Feature Info class
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 */

/**
 * Finix Feature Info
 */
function wpb_load_widget_feature_info() {
    register_widget( 'feature_info' );
}
add_action( 'widgets_init', 'wpb_load_widget_feature_info' );
 
/**
 * Core class used to implement a Feature Info widget.
 *
 * @since 1.1.0
 *
 * @see finix_Widget
 */
class feature_info extends WP_Widget {
 
    /**
	 * Sets up a new Feature Info widget instance.
	 *
	 * @since 1.1.0
	 */
    function __construct() {
        parent::__construct(
        
        // Base ID of your widget
        'feature_info', 
        
        // Widget name will appear in UI
        __('Finix Feature Info', 'finix'), 
        
        // Widget description
        array( 'description' => __( 'Finix Feature Info', 'finix' ), ) 
        );
    }
 
    /**
	 * Outputs the content for the current Feature Info widget instance.
	 *
	 * @since 1.1.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Feature Infos widget instance.
	 */
    public function widget( $args, $instance ) {

        $title = isset( $instance['title'] ) ? $instance['title'] : false;
        $address = isset( $instance['address'] ) ? $instance['address'] : false;
        $email = isset( $instance['email'] ) ? $instance['email'] : false;
        $phone = isset( $instance['phone'] ) ? $instance['phone'] : false;
        $fax = isset( $instance['fax'] ) ? $instance['fax'] : false;
        
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
        
        // This is where you run the code and display the output
        ?>
        

        <div class="footer-address">
            <ul>
                <?php if ( $address ) :  ?>
                <li>
                    <div class="widget-feature-icon"><i class="ti ti-location-pin"></i></div>
                    <div class="widget-feature-info">
                        <h4 class="title"><?php echo esc_html__('Our Location','finix'); ?></h4>
                        <span><?php echo $address; ?></span>
                    </div>
                </li>
                <?php endif; ?>
                <?php if ( $email ) :  ?>
                <li>
                    <div class="widget-feature-icon"><i class="ti ti-email"></i></div>
                    <div class="widget-feature-info">
                        <h4 class="title"><?php echo esc_html__('Our Email','finix'); ?></h4>
                        <span><?php echo $email; ?></span>
                    </div>
                </li>
                <?php endif; ?>
                <?php if ( $phone ) :  ?>
                <li>
                    <div class="widget-feature-icon"><i class="ti ti-headphone-alt"></i></div>
                    <div class="widget-feature-info">
                        <h4 class="title"><?php echo esc_html__('Phone Number','finix'); ?></h4>
                        <span><?php echo $phone; ?></span>
                    </div>
                </li>
                <?php endif; ?>
                <?php if ( $fax ) :  ?>
                <li>
                    <div class="widget-feature-icon"><i class="ti ti-printer"></i></div>
                    <div class="widget-feature-info">
                        <h4 class="title"><?php echo esc_html__('Fax Addres','finix'); ?></h4>
                        <span><?php echo $fax; ?></span>
                    </div>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    <?php
    echo $args['after_widget'];
    }
  
    /**
	 * Outputs the settings form for the Feature Info widget.
	 *
	 * @since 1.1.0
	 *
	 * @param array $instance Current settings.
	 */
    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';   
        $address    = isset( $instance['address'] ) ? esc_attr( $instance['address'] ) : '';
        $email    = isset( $instance['email'] ) ? esc_attr( $instance['email'] ) : '';
        $phone    = isset( $instance['phone'] ) ? esc_attr( $instance['phone'] ) : '';
        $fax    = isset( $instance['fax'] ) ? esc_attr( $instance['fax'] ) : '';
        // Widget admin form
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:','finix' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
        <label for="<?php echo esc_html($this->get_field_id( 'address','finix' )); ?>"><?php esc_html_e( 'Address:','finix' ); ?></label> 
        <input class="widefat" id="<?php echo esc_html($this->get_field_id( 'address','finix' )); ?>" name="<?php echo esc_html($this->get_field_name( 'address','finix')); ?>" type="text" value="<?php echo esc_html( $address,'finix'); ?>" />
        </p>

        <p>
        <label for="<?php echo esc_html($this->get_field_id( 'email','finix' )); ?>"><?php esc_html_e( 'Email:','finix' ); ?></label> 
        <input class="widefat" id="<?php echo esc_html($this->get_field_id( 'email','finix' )); ?>" name="<?php echo esc_html($this->get_field_name( 'email','finix')); ?>" type="text" value="<?php echo esc_html( $email,'finix'); ?>" />
        </p>

        <p>
        <label for="<?php echo esc_html($this->get_field_id( 'phone','finix' )); ?>"><?php esc_html_e( 'Phone:','finix' ); ?></label> 
        <input class="widefat" id="<?php echo esc_html($this->get_field_id( 'phone','finix' )); ?>" name="<?php echo esc_html($this->get_field_name( 'phone','finix')); ?>" type="text" value="<?php echo esc_html( $phone,'finix'); ?>" />
        </p>

        <p>
        <label for="<?php echo esc_html($this->get_field_id( 'fax','finix' )); ?>"><?php esc_html_e( 'Fax:','finix' ); ?></label> 
        <input class="widefat" id="<?php echo esc_html($this->get_field_id( 'fax','finix' )); ?>" name="<?php echo esc_html($this->get_field_name( 'fax','finix')); ?>" type="text" value="<?php echo esc_html( $fax,'finix'); ?>" />
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
        $instance = array();
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['address'] = sanitize_text_field( $new_instance['address'] );
        $instance['email'] = sanitize_text_field( $new_instance['email'] );
        $instance['phone'] = sanitize_text_field( $new_instance['phone'] );
        $instance['fax'] = sanitize_text_field( $new_instance['fax'] );
        return $instance;
    }
} // Class wpb_widget ends here
?>