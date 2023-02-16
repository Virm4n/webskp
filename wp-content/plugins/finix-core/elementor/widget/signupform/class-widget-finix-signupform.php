<?php
namespace Elementor; 
use WP_Error;

if ( ! defined( 'ABSPATH' ) ) exit; 

/**
 * Elementor Blog widget.
 *
 * Elementor widget that displays an eye-catching headlines.
 *
 * @since 1.1.0
 */

class finix_signupform extends Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve signupform widget name.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget name.
	 */

	public function get_name() {
		return __( 'finix_signupform', 'finix' );
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve signupform widget title.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	
	public function get_title() {
		return __( 'Sign Up', 'finix' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the signupform widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */

	public function get_categories() {
		return [ 'finix' ];
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve signupform widget icon.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */

	public function get_icon() {
		return 'eicon-slider-push finix-icon';
	}

	/**
	 * Register signupform widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.1.0
	 * @access protected
	 */

	protected function _register_controls() {
			
		$this->start_controls_section(
			'section',
			[
				'label' => __( 'Sign Up', 'finix' ),
			]
		);

		$this->add_control(
            'title',
            [
                'label' => esc_html__( 'Form Title', 'finix' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Sign Up to Finix'
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'finix' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Lets get you all set up so you can verify your personal account and begin setting up your profile.'
            ]
        );

        $this->end_controls_section(); // End Hero content


        // Form Settings
        $this->start_controls_section(
            'form_labels',
            [
                'label' => __( 'Form Settings', 'finix' ),
            ]
        );

        $this->add_control(
            'forget_link_label',
            [
                'label' => esc_html__( 'Forget Password Link Label', 'finix' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => "Forgot your password?"
            ]
        );

        $this->add_control(
            'submit_label',
            [
                'label' => esc_html__( 'Submit Button Label', 'finix' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => "Sign Up"
            ]
        );

        $this->end_controls_section(); // End Hero content


        // --------------- Form Settings
        $this->start_controls_section(
            'form_fields',
            [
                'label' => __( 'Form Fields', 'finix' ),
            ]
        );

        $this->add_control(
            'username_label',
            [
                'label' => esc_html__( 'Username Label', 'finix' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Username'
            ]
        );

        $this->add_control(
            'username_place',
            [
                'label' => esc_html__( 'Username Placeholder', 'finix' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Username Name'
            ]
        );

        $this->add_control(
            'hr1',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_control(
            'email_label',
            [
                'label' => esc_html__( 'Email Label', 'finix' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Email Address'
            ]
        );

        $this->add_control(
            'email_place',
            [
                'label' => esc_html__( 'Email Placeholder', 'finix' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'finix@gmail.com'
            ]
        );

        $this->add_control(
            'hr2',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_control(
            'pwd_label',
            [
                'label' => esc_html__( 'Password Label', 'finix' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Password'
            ]
        );

        $this->add_control(
            'pwd_place',
            [
                'label' => esc_html__( 'Password Placeholder', 'finix' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '******'
            ]
        );

		$this->end_controls_section();
	}
	/**
	 * Render Blog widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.1.0
	 * @access protected
	 */
	
	protected function render() {
		$settings = $this->get_settings();

		$user_login = ( ! empty( $_POST['user_login'] ) ) ? sanitize_text_field( $_POST['user_login'] ) : '';
		$email = ( ! empty( $_POST['user_email'] ) ) ? sanitize_text_field( $_POST['user_email'] ) : '';
		$password = ( ! empty( $_POST['user_pwd'] ) ) ? $_POST['user_pwd'] : '';

		if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            ?>
            <div class="finix-form-element after-login">
                <h2 class="form-main-title">
                    <?php esc_html_e( 'Welcome', 'finix' ) ?> <span><?php echo $current_user->display_name; ?></span>
                </h2>
                <div class="success-check">
                    <i aria-hidden="true" class="fas fa-check"></i>
                    <h6><?php echo esc_html__('logged in Successfully.', 'finix'); ?></h6>
                </div>
                <p><?php esc_html_e( 'You can logout from', 'finix' ) ?>
                   <a class="form-link" href="<?php echo esc_url(wp_logout_url(home_url( '/'))) ?>"> <?php esc_html_e( 'here', 'finix' ) ?> </a>
                </p>
                <p><?php esc_html_e( 'Or navigate to the website', 'finix' ) ?>
                   <a class="form-link" href="<?php echo esc_url(home_url( '/')) ?>"> <?php esc_html_e( 'Homepage', 'finix' ) ?> </a>
                </p>
            </div>
            <?php
        }
        else {
            $username_place = (!empty($settings['username_place'])) ? ''.esc_attr($settings['username_place']).'' : '';
            $email_place = (!empty($settings['email_place'])) ? ''.esc_attr($settings['email_place']).'' : '';
            $pwd_place = (!empty($settings['pwd_place'])) ? ''.esc_attr($settings['pwd_place']).'' : '';
            ?>
            <div class="finix-form-element sign-up-form">
                <?php if (!empty($settings['title'])) : ?>
                    <h2 class="form-main-title"> <?php echo esc_html($settings['title']); ?> </h2>
                <?php endif; ?>
                <div class="form-info-content">
                    <?php echo wp_kses_post($settings['subtitle']) ?>
                </div>
                <form action="<?php echo esc_url(home_url( '/')) ?>wp-login.php?action=register"
                      name="registerform" id="registerform" method="post" class="wpcf7-form signup-form">
                    <div class="wpcf7-form-control-wrap">
                        <?php if(!empty($settings['username_label'])) : ?>
                            <label class="f_p text_c f_400"> <?php echo esc_html($settings['username_label']) ?> </label>
                        <?php endif; ?>
                        <input type="text" id="user_login" name="user_login" value="<?php echo esc_attr($user_login) ?>" placeholder="<?php echo esc_attr($username_place); ?>">
                    </div>
                    <div class="wpcf7-form-control-wrap">
                        <?php if(!empty($settings['email_label'])) : ?>
                            <label class="f_p text_c f_400"> <?php echo esc_html($settings['email_label']) ?> </label>
                        <?php endif; ?>
                        <input type="text" placeholder="<?php echo esc_attr($email_place) ?>" id="email" name="user_email" value="<?php echo esc_attr($email) ?>">
                    </div>
                    <div class="wpcf7-form-control-wrap">
                        <?php if(!empty($settings['pwd_label'])) : ?>
                            <label class="f_p text_c f_400"> <?php echo esc_html($settings['pwd_label']) ?> </label>
                        <?php endif; ?>
                        <input type="password" name="user_pwd" placeholder="<?php echo esc_attr($pwd_place) ?>" value="<?php echo esc_attr($password) ?>">
                    </div>
                    <!--<div class="wpcf7-form-control-checkbox">
                        <div class="checkbox remember">
                            <label>
                                <input type="checkbox"> I agree to terms and conditions of this website
                            </label>
                        </div>
                    </div>-->
                    <div class="wpcf7-form-control-action">
                        <div class="wpcf7-form-control-button">
                            <button type="submit" name="submit" class="wpcf7-submit">
                                <?php echo !empty($settings['submit_label']) ? esc_html($settings['submit_label']) : esc_html_e( 'Sign Up', 'finix' ) ?>
                            </button>
                        </div>
                        <?php if(!empty($settings['forget_link_label'])) : ?>
                            <div class="forgotten-password">
                                <a class="form-link" href="<?php echo esc_url(home_url( '/')) . '/wp-login.php?action=lostpassword'; ?>">
                                    <?php echo wp_kses_post($settings['forget_link_label']) ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
            <?php
        }

		// Error Handling
        global $errors;
        $errors = new WP_Error;
        if ( empty( $_POST['user_login'] ) || ! empty( $_POST['user_login'] ) && trim( $_POST['user_login'] ) == '' ) {
            $errors->add( 'user_login_error', sprintf( '<strong>%s</strong>: %s',__( 'ERROR', 'mydomain' ),__( 'You must include a user_login.', 'mydomain' ) ) );
        }
        if ( empty( $_POST['user_email'] ) || ! empty( $_POST['user_email'] ) && trim( $_POST['user_email'] ) == '' ) {
            $errors->add( 'email_error', sprintf( '<strong>%s</strong>: %s',__( 'ERROR', 'mydomain' ),__( 'You must include an email.', 'mydomain' ) ) );
        }
        if ( empty( $_POST['password'] ) || ! empty( $_POST['password'] ) && trim( $_POST['password'] ) == '' ) {
            $errors->add( 'password_error', sprintf( '<strong>%s</strong>: %s',__( 'ERROR', 'mydomain' ),__( 'You must enter a password.', 'mydomain' ) ) );
        }

		function user_register( $user_id ) {
            if ( ! empty( $_POST['user_login'] ) ) {
                update_user_meta( $user_id, 'user_login', sanitize_text_field( $_POST['user_login'] ) );
            }
            if ( ! empty( $_POST['user_email'] ) ) {
                update_user_meta( $user_id, 'email', sanitize_text_field( $_POST['user_email'] ) );
            }
            if ( ! empty( $_POST['password'] ) ) {
                update_user_meta( $user_id, 'password', sanitize_text_field( $_POST['password'] ) );
            }
        }
        add_action( 'user_register', 'user_register' );

	}
}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\finix_signupform() );
?>