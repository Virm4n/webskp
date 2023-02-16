<?php
add_action( 'elementor/widgets/widgets_registered', 'finix_elementor_widgets' );
function finix_elementor_widgets() {

	if ( defined( 'ELEMENTOR_PATH' ) && class_exists( 'Elementor\Widget_Base' ) ) {

		require FINIX_THEME_ROOT . '/elementor/widget/accordion/class-widget-finix-accordion.php';

		require FINIX_THEME_ROOT . '/elementor/widget/blog/class-widget-finix-blog.php';

		require FINIX_THEME_ROOT . '/elementor/widget/button/class-widget-finix-button.php';

		require FINIX_THEME_ROOT . '/elementor/widget/client-logo/class-widget-finix-client-logo.php';

		require FINIX_THEME_ROOT . '/elementor/widget/counter/class-widget-finix-counter.php';

		require FINIX_THEME_ROOT . '/elementor/widget/demo-item/class-widget-finix-demo-item.php';

		require FINIX_THEME_ROOT . '/elementor/widget/domain-check/class-widget-finix-domain.php';

		require FINIX_THEME_ROOT . '/elementor/widget/feature-step/class-widget-finix-feature-step.php';

		require FINIX_THEME_ROOT . '/elementor/widget/flipbox/class-widget-finix-flipbox.php';

		require FINIX_THEME_ROOT . '/elementor/widget/image-gallery/class-widget-finix-image-gallery.php';

		require FINIX_THEME_ROOT . '/elementor/widget/info-box/class-widget-finix-info-box.php';

		require FINIX_THEME_ROOT . '/elementor/widget/list/class-widget-finix-list.php';

		require FINIX_THEME_ROOT . '/elementor/widget/newsletter/class-widget-finix-newsletter.php';

		require FINIX_THEME_ROOT . '/elementor/widget/parallax-banner/class-widget-finix-parallax-banner.php';

		require FINIX_THEME_ROOT . '/elementor/widget/portfolio/class-widget-finix-portfolio.php';

		require FINIX_THEME_ROOT . '/elementor/widget/pricing/class-widget-finix-pricing.php';

		require FINIX_THEME_ROOT . '/elementor/widget/products/class-widget-finix-products.php';

		require FINIX_THEME_ROOT . '/elementor/widget/quick-info/class-widget-finix-quick-info.php';

		require FINIX_THEME_ROOT . '/elementor/widget/rounded-skill/class-widget-finix-rounded-skill.php';

		require FINIX_THEME_ROOT . '/elementor/widget/section-title/class-widget-finix-section-title.php';		

		require FINIX_THEME_ROOT . '/elementor/widget/skill/class-widget-finix-skill.php';

		require FINIX_THEME_ROOT . '/elementor/widget/small-icon-box/class-widget-finix-small-icon-box.php';

		require FINIX_THEME_ROOT . '/elementor/widget/social-icons/class-widget-finix-social-icons.php';

		require FINIX_THEME_ROOT . '/elementor/widget/signinform/class-widget-finix-signinform.php';

		require FINIX_THEME_ROOT . '/elementor/widget/signupform/class-widget-finix-signupform.php';

		require FINIX_THEME_ROOT . '/elementor/widget/tab/class-widget-finix-tab.php';		

		require FINIX_THEME_ROOT . '/elementor/widget/team/class-widget-finix-team.php';

		require FINIX_THEME_ROOT . '/elementor/widget/team/class-widget-finix-team-grid.php';

		require FINIX_THEME_ROOT . '/elementor/widget/testimonial/class-widget-finix-testimonial.php';

		require FINIX_THEME_ROOT . '/elementor/widget/video/class-widget-finix-video.php';
	}
}

add_filter( 'elementor/icons_manager/additional_tabs', 'finix_add_ionicons_to_icon_manager' );
function finix_add_ionicons_to_icon_manager( $settings ) {
	$settings['ion-ionicons'] = array(
		'name'          => 'ion',
		'label'         => esc_html__( 'Ionicons', 'finix' ),
		'url'           => '',
		'enqueue'       => wp_enqueue_style( 'ionicons', FINIX_THEME_URL . '/assest/css/fonts/ionicons.css', array(), '2.0.1', 'all' ),
		'prefix'        => 'ion-',
		'displayPrefix' => 'ion',
		'labelIcon'     => 'ion ion-ios-world',
		'fetchJson'     => FINIX_THEME_URL . '/assest/js/ionicons.js',
		'ver'           => '1.0',
		'native'        => true,
	);

	return $settings;
}

add_filter( 'elementor/icons_manager/additional_tabs', 'finix_add_themify_to_icon_manager' );
function finix_add_themify_to_icon_manager( $settings ) {
	$settings['ti-themify'] = array(
		'name'          => 'ti-themify',
		'label'         => __( 'Themify', 'finix' ),
		'url'           => '',
		'enqueue'       => wp_enqueue_style( 'themify', FINIX_THEME_URL . '/assest/css/fonts/themify-icons.css', array(), '2.0.0', 'all' ),
		'prefix'        => 'ti-',
		'displayPrefix' => 'ti',
		'labelIcon'     => 'ti ti-world',
		'fetchJson'     => FINIX_THEME_URL . '/assest/js/themify.js',
		'ver'           => '1.0',
		'native'        => true,
	);

	return $settings;
}

add_filter( 'elementor/icons_manager/additional_tabs', 'finix_add_flaticon_to_icon_manager' );
function finix_add_flaticon_to_icon_manager( $settings ) {
	$settings['flaticon-themify'] = array(
		'name'          => 'flaticon-themify',
		'label'         => __( 'Flaticon', 'finix' ),
		'url'           => '',
		'enqueue'       => wp_enqueue_style( 'flaticon', FINIX_THEME_URL . '/assest/css/fonts/flaticon.css', array(), '2.0.0', 'all' ),
		'prefix'        => 'flaticon-',
		'displayPrefix' => 'glyph-icon',
		'labelIcon'     => 'glyph-icon flaticon-internet',
		'fetchJson'     => FINIX_THEME_URL . '/assest/js/flaticon.js',
		'ver'           => '1.0',
		'native'        => true,
	);

	return $settings;
}

add_action( 'elementor/editor/before_enqueue_scripts', 'finix_add_widget_to_icon_manager' );
function finix_add_widget_to_icon_manager( $settings ) {
	wp_enqueue_style( 'widgeticons', FINIX_THEME_URL . '/assest/css/admin.css', array(), '1.0.0', 'all' );

	return $settings;
}


add_action(
	'elementor/init',
	function() {
		\Elementor\Plugin::$instance->elements_manager->add_category(
			'finix',
			array(
				'title' => __( 'Finix Elements', 'finix' ),
				'icon'  => 'fa fa-plug',
			)
		);
	}
);
