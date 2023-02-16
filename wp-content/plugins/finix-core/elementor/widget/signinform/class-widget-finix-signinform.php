<?php
namespace Elementor; 
if ( ! defined( 'ABSPATH' ) ) exit; 

/**
 * Elementor Blog widget.
 *
 * Elementor widget that displays an eye-catching headlines.
 *
 * @since 1.1.0
 */

class finix_signinform extends Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve signinform widget name.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget name.
	 */

	public function get_name() {
		return __( 'finix_signinform', 'finix' );
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve signinform widget title.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	
	public function get_title() {
		return __( 'Sign In', 'finix' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the signinform widget belongs to.
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
	 * Retrieve signinform widget icon.
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
	 * Register signinform widget controls.
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
				'label' => __( 'Sign In Form', 'finix' ),
			]
		);

		$this->add_control(
            'title',
            [
                'label' => esc_html__( 'Form Title', 'finix' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Sign In to Finix'
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'finix' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'To Keep connected with us please login with your personal information by email address and password.'
            ]
        );

        $this->end_controls_section(); // End Hero content


        // Form Labels
        $this->start_controls_section(
            'form_labels',
            [
                'label' => __( 'Form Settings', 'finix' ),
            ]
        );

        $this->add_control(
            'btn_label',
            [
                'label' => esc_html__( 'Button Label', 'finix' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Login'
            ]
        );

        $this->add_control(
            'signup_text',
            [
                'label' => esc_html__( 'Sing up link text', 'finix' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => "Don't have an account? "
            ]
        );

        $this->add_control(
            'signup_link',
            [
                'label' => esc_html__( 'Sing up link URL', 'finix' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'forget_pass_label',
            [
                'label' => esc_html__( 'Forget Password Link Label', 'finix' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => "Forgot your password?"
            ]
        );

        $this->add_control(
            'reber_label',
            [
                'label' => esc_html__( 'Remember Checkbox Label', 'finix' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => "Remember me"
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

        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            ?>
            <div class="finix-form-element after-login">
                <h2 class="form-main-title">
                    <?php echo esc_html__('Welcome', 'finix'); ?> <span><?php echo $user->display_name; ?></span>
                </h2>
                <div class="success-check">
                    <i aria-hidden="true" class="fas fa-check"></i>
                    <h6><?php echo esc_html__('logged in Successfully.', 'finix'); ?></h6>
                    </div>
                <p><?php echo esc_html__('You can logout from', 'finix'); ?>
                    <a class="form-link" href="<?php echo esc_url(wp_logout_url(home_url( '/'))) ?>"><?php echo esc_html__('here', 'finix'); ?></a>
                </p>
                <p><?php echo esc_html__('Or navigate to the website', 'finix'); ?>
                    <a class="form-link" href="<?php echo esc_url(home_url( '/')) ?>"><?php echo esc_html__('Homepage', 'finix'); ?></a>
                </p>
            </div>
            <?php
        }
        else {
            ?>
            <div class="finix-form-element sign-in-form">
                <?php if (!empty($settings['title'])) : ?>
                    <h2 class="form-main-title">
                        <?php echo esc_html($settings['title']); ?>
                    </h2>
                <?php endif; ?>
                <?php if (!empty($settings['subtitle'])) : ?>
                    <div class="form-info-content">
                        <?php echo wp_kses_post($settings['subtitle']) ?>
                    </div>
                <?php endif; ?>
                <form action="<?php echo esc_url(home_url( '/')); ?>wp-login.php" class="wpcf7-form signin-form" method="post">
                    <div class="wpcf7-form-control-wrap">
                        <label class=""> <?php echo esc_html__('User Name', 'finix'); ?> </label>
                        <input type="text" name="log" placeholder="User Name">
                    </div>
                    <div class="wpcf7-form-control-wrap">
                        <label class=""><?php echo esc_html__('Password', 'finix'); ?></label>
                        <input type="password" name="pwd" placeholder="******">
                    </div>
                    <div class="wpcf7-form-control-checkbox">
                        <div class="checkbox remember">
                            <label>
                                <input type="checkbox" name="rememberme" value="forever">
                                <?php echo wp_kses_post($settings['reber_label']) ?>
                            </label>
                        </div>
                        <div class="forgotten-password">
                            <a class="form-link" href="<?php echo esc_url(home_url( '/')) . '/wp-login.php?action=lostpassword'; ?>">
                                <?php echo wp_kses_post($settings['forget_pass_label']) ?>
                            </a>
                        </div>
                    </div>
                    <div class="wpcf7-form-divider-separator">
                        <span class="divider-separator-inner">
                            or
                        </span>
                    </div>
                    <div class="wpcf7-form-control-action">
                        <div class="wpcf7-form-control-button">
                            <button type="submit" name="submit" name="wp-submit" class="wpcf7-submit"><?php echo esc_attr($settings['btn_label']) ?></button>
                        </div>
                        <?php
                        if (!empty($settings['signup_text'])) : ?>
                            <div class="wpcf7-form-control-new-account">
    							<span><?php echo esc_html__('New user?', 'finix'); ?></span> <a class="form-link new-account-link" href="<?php echo esc_url($settings['signup_link']) ?>">
                                    <?php echo esc_html($settings['signup_text']) ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        <?php
        }
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\finix_signinform() );
?>