<?php
/**
 * Finix Dynamic CSS
 *
 * @package Finix
 * @subpackage finix
 * @since finix 1.0
*/

/**
 * All Dynamic CSS
 */
function finix_dynamic_css() {

	$dynamic_css = '';

	$finix_opt = get_option( 'finix_redux' );

	$body_color      = $finix_opt['body_color'];
	$cursor_color    = $finix_opt['cursor_color'];
	$logo_color      = $finix_opt['logo_color'];
	$loader_bg_color = $finix_opt['loader_bg_color'];
	$loader_color    = $finix_opt['loader_color'];
	$top_bg_color    = $finix_opt['top_bg_color'];
	$top_text_color  = $finix_opt['top_text_color'];
	$top_link_color  = $finix_opt['top_link_color'];
	$top_icon_color  = $finix_opt['top_icon_color'];
	$footer_bg_color = $finix_opt['footer_bg_color'];
	if ( $finix_opt['image_opicity'] == '2' ) {
		$footer_opt_color = $finix_opt['footer_opt_color'] ['rgba'];
	}
	$footer_title_color      = $finix_opt['footer_title_color'];
	$footer_text_color       = $finix_opt['footer_text_color'];
	$footer_link_color       = $finix_opt['footer_link_color'];
	$footer_link_hover_color = $finix_opt['footer_link_hover_color'];
	$page_header_title_color = $finix_opt['page_header_title_color'];
	$breadcrumbs_link_color  = $finix_opt['breadcrumbs_link_color'];
	$breadcrumbs_hover_color = $finix_opt['breadcrumbs_hover_color'];
	$page_header_bg_color    = $finix_opt['page_header_bg_color'];
	$page_header_shape_color = $finix_opt['shape_bg_color'];
	if ( $finix_opt['page_header_opacity'] == '2' ) {
		$opacity_color = $finix_opt['opacity_color'] ['rgba'];
		$opacity_gradient_color = $finix_opt['opacity_gradient_color'] ['rgba'];
	}
	$copyright_bg_color   = $finix_opt['copyright_bg_color'];
	$copyright_text_color = $finix_opt['copyright_text_color'];
	$copyright_link_color = $finix_opt['copyright_link_color'];

	$page_header_typography        = isset( $finix_opt['page-header-typography'] ) ? $finix_opt['page-header-typography'] : '';
	$button_typography        = isset( $finix_opt['button-typography'] ) ? $finix_opt['button-typography'] : '';
	$body_typography        = isset( $finix_opt['body-typography'] ) ? $finix_opt['body-typography'] : '';
	$h1_typography          = isset( $finix_opt['h1-typography'] ) ? $finix_opt['h1-typography'] : '';
	$h2_typography          = isset( $finix_opt['h2-typography'] ) ? $finix_opt['h2-typography'] : '';
	$h3_typography          = isset( $finix_opt['h3-typography'] ) ? $finix_opt['h3-typography'] : '';
	$h4_typography          = isset( $finix_opt['h4-typography'] ) ? $finix_opt['h4-typography'] : '';
	$h5_typography          = isset( $finix_opt['h5-typography'] ) ? $finix_opt['h5-typography'] : '';
	$h6_typography          = isset( $finix_opt['h6-typography'] ) ? $finix_opt['h6-typography'] : '';

	/*********************************************
	Layout Background Color
	*/
	if ( ! empty( $body_color ) ) {
		$dynamic_css .= "body { background-color : $body_color; }";
	}

	if ( ! empty( $cursor_color ) ) {
		$dynamic_css .= "#theme-cursor .cursor-outer { border-color : $cursor_color; }";
		$dynamic_css .= "#theme-cursor .cursor-inner { background : $cursor_color; }";
	}

	// Logo Text Background Color
	if ( ! empty( $body_color ) ) {
		$dynamic_css .= ".header-logo .site-logo-text{ color : $logo_color; }";
	}

	// Loader Background Color
	if ( ! empty( $loader_bg_color ) ) {
		$dynamic_css .= "#preloader{ background-color : $loader_bg_color; }";
	}

	// Loader Color
	if ( ! empty( $loader_color ) ) {
		$dynamic_css .= "
			.line-scale-pulse-out > div,
			.pacman > div:nth-child(3), 
			.pacman > div:nth-child(4), 
			.pacman > div:nth-child(5), 
			.pacman > div:nth-child(6),
			.square-spin > div,
			.ball-scale-multiple > div,
			.ball-grid-pulse > div,
			.ball-spin-fade-loader > div {background : $loader_color;}";
		$dynamic_css .= "
			.ball-clip-rotate > div {border-color : $loader_color;}";
		$dynamic_css .= "
			.ball-clip-rotate-multiple > div,
			.pacman > div:first-of-type,
			.pacman > div:nth-child(2) {border-left-color : $loader_color;}";
		$dynamic_css .= "
			.ball-clip-rotate-multiple > div {border-right-color : $loader_color;}";
		$dynamic_css .= "
			.ball-clip-rotate-multiple > div:last-child,
			.pacman > div:first-of-type,
			.pacman > div:nth-child(2) {border-top-color : $loader_color;}";
		$dynamic_css .= "
			.ball-clip-rotate-multiple > div:last-child,
			.pacman > div:first-of-type,
			.pacman > div:nth-child(2) {border-bottom-color : $loader_color;}";
	}

	/*********************************************
	Header Topbar Color
	*/
	if ( ! empty( $top_bg_color ) ) {
		$dynamic_css .= ".header-topbar {background-color : $top_bg_color; }";
	}

	if ( ! empty( $top_text_color ) ) {
		$dynamic_css .= ".header-topbar, .header-topbar a{color : $top_text_color; }";
	}

	if ( ! empty( $top_link_color ) ) {
		$dynamic_css .= ".header-topbar a:hover, .header-social li a:hover {color : $top_link_color; }";
	}

	if ( ! empty( $top_icon_color ) ) {
		$dynamic_css .= ".header-topbar i, .header-social li a {color : $top_icon_color; }";
	}

	/*********************************************
	Footer Color Option
	*/
	if ( ! empty( $footer_bg_color ) ) {
		$dynamic_css .= ".site-footer{ background-color : $footer_bg_color; }";
	}

	if ( $finix_opt['image_opicity'] == '2' ) {
		if ( ! empty( $footer_opt_color ) ) {
			$dynamic_css .= ".site-footer .footer-main:before{ background-color : $footer_opt_color; }";
		}
	}

	if ( ! empty( $footer_title_color ) ) {
		$dynamic_css .= ".site-footer .widget .widget-title,
		.site-footer .widget_feature_info .widget-feature-info .title{ color : $footer_title_color; }";
	}

	if ( ! empty( $footer_text_color ) ) {
		$dynamic_css .= ".site-footer,
        .site-footer .widget_testimonial .author-details .author-name,
        .site-footer .widget_testimonial .author-details .author-position,
        .site-footer .widget_newsletter .input-area input,
        .site-footer .calendar_wrap thead th { color : $footer_text_color; }";
	}

	if ( ! empty( $footer_link_color ) ) {
		$dynamic_css .= ".site-footer a,
            .site-footer .widget ul li > a,
            .site-footer .widget_recent_post .recent-post-list .post-info .post-title,
            .site-footer .footer-main .widget_calendar .wp-calendar-nav a { color : $footer_link_color; }";
	}

	if ( ! empty( $footer_link_hover_color ) ) {
		$dynamic_css .= ".site-footer a:hover,
            .site-footer .widget ul li > a:hover,
            .site-footer .widget_contact .footer-address ul li i,
            .site-footer .widget_social_media .social-info.style-default.color-theme li a,
            .site-footer .widget_social_media .social-info.style-border.color-theme li a,
            .site-footer .widget_recent_post .recent-post-list .post-info .post-date i,
            .site-footer .widget_recent_post .recent-post-list .post-info .post-title:hover,
            .site-footer .footer-main .calendar_wrap tbody td a,
            .site-footer .footer-main .widget_calendar .wp-calendar-nav a:hover,
            .site-footer .widget_feature_info .widget-feature-icon i { color : $footer_link_hover_color; }";

		$dynamic_css .= "
            .site-footer .widget_testimonial .testimonial-inner .author-content,
            .site-footer .widget_social_media .social-info.style-flat.color-theme li a,
            .site-footer .widget_newsletter .button-area button,
            .site-footer .footer-main .calendar_wrap caption,
            .site-footer .footer-main .calendar_wrap #today { background : $footer_link_hover_color; }";

		$dynamic_css .= "
            .site-footer .widget_testimonial .testimonial-inner .author-content:before {border-top-color: $footer_link_hover_color; }";
	}

	/*********************************************
	Page Header Color
	*/
	if ( ! empty( $page_header_title_color ) ) {
		$dynamic_css .= ".page-header .page-title{ color : $page_header_title_color; }";
	}

	if ( ! empty( $breadcrumbs_link_color ) ) {
		$dynamic_css .= "
            .page-header .breadcrumb li a,
            .page-header-inner.page-header-2 .breadcrumb li > a,
            .page-header-inner.page-header-2 .breadcrumb li > span a { color : $breadcrumbs_link_color; }";
	}

	if ( ! empty( $breadcrumbs_hover_color ) ) {
		$dynamic_css .= "
            .page-header .breadcrumb li span, 
            .page-header .breadcrumb li a:hover,
            .page-header-inner.page-header-2 .breadcrumb li > a:hover,
            .page-header-inner.page-header-2 .breadcrumb li > span a:hover { color : $breadcrumbs_hover_color; }";
	}

	if ( ! empty( $page_header_bg_color ) ) {
		$dynamic_css .= ".page-header{ background-color : $page_header_bg_color; }";
	}

	if ( ! empty( $page_header_shape_color ) ) {
		$dynamic_css .= ".page-header .svg-effect path{ fill : $page_header_shape_color; }";
	}

	if ( $finix_opt['page_header_opacity'] == '2' ) {
		if ( ! empty( $opacity_color ) ) {
			$dynamic_css .= ".page-header:before{ background-color : $opacity_color; }";
			if ( ! empty( $opacity_gradient_color ) ) {
				$dynamic_css .= ".page-header:before {background-image:linear-gradient(to right, $opacity_color 0%, $opacity_gradient_color 100%) }";
				$dynamic_css .= ".page-header:before {background-color : unset;}";
			}
		}
	}

	/*********************************************
	Copyright Color
	*/
	if ( ! empty( $copyright_bg_color ) ) {
		$dynamic_css .= ".site-footer .site-info { background-color : $copyright_bg_color; }";
	}

	if ( ! empty( $copyright_text_color ) ) {
		$dynamic_css .= ".site-footer .copyright-info, .site-footer .copyright-info a{ color : $copyright_text_color; }";
	}

	if ( ! empty( $copyright_link_color ) ) {
		$dynamic_css .= ".site-footer .copyright-info a:hover { color : $copyright_link_color; }";
	}

	/*******************************************
	Custom CSS
	*/
	if ( ! empty( $finix_opt['custom_css'] ) ) {
		$edukenz_css  = $finix_opt['custom_css'];
		$dynamic_css .= esc_attr( $edukenz_css );
	}

	/*****************************************
	Redux Typography
	*/
	if ( isset( $page_header_typography ) && ! empty( $page_header_typography ) ) {
		$page_header_css = '';

		if ( isset( $page_header_typography['font-family'] ) && ! empty( $page_header_typography['font-family'] ) ) {
			$page_header_css .= 'font-family: ' . $page_header_typography['font-family'] . ';';
		}

		if ( isset( $page_header_typography['font-style'] ) && ! empty( $page_header_typography['font-style'] ) ) {
			$page_header_css .= 'font-style: ' . $page_header_typography['font-style'] . ';';
		}

		if ( isset( $page_header_typography['font-weight'] ) && ! empty( $page_header_typography['font-weight'] ) ) {
			$page_header_css .= 'font-weight: ' . $page_header_typography['font-weight'] . ';';
		}

		if ( isset( $page_header_typography['letter-spacing'] ) && ! empty( $page_header_typography['letter-spacing'] ) ) {
			$page_header_css .= 'letter-spacing: ' . $page_header_typography['letter-spacing'] . ';';
		}

		if ( isset( $page_header_typography['line-height'] ) && ! empty( $page_header_typography['line-height'] ) ) {
			$page_header_css .= 'line-height: ' . $page_header_typography['line-height'] . ';';
		}

		if ( isset( $page_header_typography['font-size'] ) && ! empty( $page_header_typography['font-size'] ) ) {
			$page_header_css .= 'font-size: ' . $page_header_typography['font-size'] . ';';
		}
		
		if ( $page_header_css ) {
			$dynamic_css .= '.page-header .page-title { ' . $page_header_css . ' }';
		}
	}

	if ( isset( $button_typography ) && ! empty( $button_typography ) ) {
		$button_css = '';

		if ( isset( $button_typography['font-family'] ) && ! empty( $button_typography['font-family'] ) ) {
			$button_css .= 'font-family: ' . $button_typography['font-family'] . ';';
		}

		if ( isset( $button_typography['font-style'] ) && ! empty( $button_typography['font-style'] ) ) {
			$button_css .= 'font-style: ' . $button_typography['font-style'] . ';';
		}

		if ( isset( $button_typography['font-weight'] ) && ! empty( $button_typography['font-weight'] ) ) {
			$button_css .= 'font-weight: ' . $button_typography['font-weight'] . ';';
		}

		if ( isset( $button_typography['letter-spacing'] ) && ! empty( $button_typography['letter-spacing'] ) ) {
			$button_css .= 'letter-spacing: ' . $button_typography['letter-spacing'] . ';';
		}

		if ( isset( $button_typography['line-height'] ) && ! empty( $button_typography['line-height'] ) ) {
			$button_css .= 'line-height: ' . $button_typography['line-height'] . ';';
		}

		if ( isset( $button_typography['font-size'] ) && ! empty( $button_typography['font-size'] ) ) {
			$button_css .= 'font-size: ' . $button_typography['font-size'] . ';';
		}
		
		if ( $button_css ) {
			$dynamic_css .= '.header-button .header-link { ' . $button_css . ' }';
		}
	}

	if ( isset( $body_typography ) && ! empty( $body_typography ) ) {
		$body_css = '';

		if ( isset( $body_typography['font-family'] ) && ! empty( $body_typography['font-family'] ) ) {
			$body_css .= 'font-family: ' . $body_typography['font-family'] . ';';
		}

		if ( isset( $body_typography['font-style'] ) && ! empty( $body_typography['font-style'] ) ) {
			$body_css .= 'font-style: ' . $body_typography['font-style'] . ';';
		}

		if ( isset( $body_typography['font-weight'] ) && ! empty( $body_typography['font-weight'] ) ) {
			$body_css .= 'font-weight: ' . $body_typography['font-weight'] . ';';
		}

		if ( isset( $body_typography['letter-spacing'] ) && ! empty( $body_typography['letter-spacing'] ) ) {
			$body_css .= 'letter-spacing: ' . $body_typography['letter-spacing'] . ';';
		}

		if ( isset( $body_typography['line-height'] ) && ! empty( $body_typography['line-height'] ) ) {
			$body_css .= 'line-height: ' . $body_typography['line-height'] . ';';
		}

		if ( isset( $body_typography['font-size'] ) && ! empty( $body_typography['font-size'] ) ) {
			$body_css .= 'font-size: ' . $body_typography['font-size'] . ';';
		}
		
		if ( $body_css ) {
			$dynamic_css .= 'body { ' . $body_css . ' }';
		}
	}

	if ( isset( $h1_typography ) && ! empty( $h1_typography ) ) {
		$h1_css = '';

		if ( isset( $h1_typography['font-family'] ) && ! empty( $h1_typography['font-family'] ) ) {
			$h1_css .= 'font-family: ' . $h1_typography['font-family'] . ';';
		}

		if ( isset( $h1_typography['font-style'] ) && ! empty( $h1_typography['font-style'] ) ) {
			$h1_css .= 'font-style: ' . $h1_typography['font-style'] . ';';
		}

		if ( isset( $h1_typography['font-weight'] ) && ! empty( $h1_typography['font-weight'] ) ) {
			$h1_css .= 'font-weight: ' . $h1_typography['font-weight'] . ';';
		}

		if ( isset( $h1_typography['letter-spacing'] ) && ! empty( $h1_typography['letter-spacing'] ) ) {
			$h1_css .= 'letter-spacing: ' . $h1_typography['letter-spacing'] . ';';
		}

		if ( isset( $h1_typography['line-height'] ) && ! empty( $h1_typography['line-height'] ) ) {
			$h1_css .= 'line-height: ' . $h1_typography['line-height'] . ';';
		}

		if ( isset( $h1_typography['font-size'] ) && ! empty( $h1_typography['font-size'] ) ) {
			$h1_css .= 'font-size: ' . $h1_typography['font-size'] . ';';
		}
		
		if ( $h1_css ) {
			$dynamic_css .= 'h1 { ' . $h1_css . ' }';
		}
	}
	
	if ( isset( $h2_typography ) && ! empty( $h2_typography ) ) {
		$h2_css = '';

		if ( isset( $h2_typography['font-family'] ) && ! empty( $h2_typography['font-family'] ) ) {
			$h2_css .= 'font-family: ' . $h2_typography['font-family'] . ';';
		}

		if ( isset( $h2_typography['font-style'] ) && ! empty( $h2_typography['font-style'] ) ) {
			$h2_css .= 'font-style: ' . $h2_typography['font-style'] . ';';
		}

		if ( isset( $h2_typography['font-weight'] ) && ! empty( $h2_typography['font-weight'] ) ) {
			$h2_css .= 'font-weight: ' . $h2_typography['font-weight'] . ';';
		}

		if ( isset( $h2_typography['letter-spacing'] ) && ! empty( $h2_typography['letter-spacing'] ) ) {
			$h2_css .= 'letter-spacing: ' . $h2_typography['letter-spacing'] . ';';
		}

		if ( isset( $h2_typography['line-height'] ) && ! empty( $h2_typography['line-height'] ) ) {
			$h2_css .= 'line-height: ' . $h2_typography['line-height'] . ';';
		}

		if ( isset( $h2_typography['font-size'] ) && ! empty( $h2_typography['font-size'] ) ) {
			$h2_css .= 'font-size: ' . $h2_typography['font-size'] . ';';
		}
		
		if ( $h2_css ) {
			$dynamic_css .= 'h2 { ' . $h2_css . ' }';
		}
	}
	
	if ( isset( $h3_typography ) && ! empty( $h3_typography ) ) {
		$h3_css = '';

		if ( isset( $h3_typography['font-family'] ) && ! empty( $h3_typography['font-family'] ) ) {
			$h3_css .= 'font-family: ' . $h3_typography['font-family'] . ';';
		}

		if ( isset( $h3_typography['font-style'] ) && ! empty( $h3_typography['font-style'] ) ) {
			$h3_css .= 'font-style: ' . $h3_typography['font-style'] . ';';
		}

		if ( isset( $h3_typography['font-weight'] ) && ! empty( $h3_typography['font-weight'] ) ) {
			$h3_css .= 'font-weight: ' . $h3_typography['font-weight'] . ';';
		}

		if ( isset( $h3_typography['letter-spacing'] ) && ! empty( $h3_typography['letter-spacing'] ) ) {
			$h3_css .= 'letter-spacing: ' . $h3_typography['letter-spacing'] . ';';
		}

		if ( isset( $h3_typography['line-height'] ) && ! empty( $h3_typography['line-height'] ) ) {
			$h3_css .= 'line-height: ' . $h3_typography['line-height'] . ';';
		}

		if ( isset( $h3_typography['font-size'] ) && ! empty( $h3_typography['font-size'] ) ) {
			$h3_css .= 'font-size: ' . $h3_typography['font-size'] . ';';
		}
		
		if ( $h3_css ) {
			$dynamic_css .= 'h3 { ' . $h3_css . ' }';
		}
	}
	
	if ( isset( $h4_typography ) && ! empty( $h4_typography ) ) {
		$h4_css = '';

		if ( isset( $h4_typography['font-family'] ) && ! empty( $h4_typography['font-family'] ) ) {
			$h4_css .= 'font-family: ' . $h4_typography['font-family'] . ';';
		}

		if ( isset( $h4_typography['font-style'] ) && ! empty( $h4_typography['font-style'] ) ) {
			$h4_css .= 'font-style: ' . $h4_typography['font-style'] . ';';
		}

		if ( isset( $h4_typography['font-weight'] ) && ! empty( $h4_typography['font-weight'] ) ) {
			$h4_css .= 'font-weight: ' . $h4_typography['font-weight'] . ';';
		}

		if ( isset( $h4_typography['letter-spacing'] ) && ! empty( $h4_typography['letter-spacing'] ) ) {
			$h4_css .= 'letter-spacing: ' . $h4_typography['letter-spacing'] . ';';
		}

		if ( isset( $h4_typography['line-height'] ) && ! empty( $h4_typography['line-height'] ) ) {
			$h4_css .= 'line-height: ' . $h4_typography['line-height'] . ';';
		}

		if ( isset( $h4_typography['font-size'] ) && ! empty( $h4_typography['font-size'] ) ) {
			$h4_css .= 'font-size: ' . $h4_typography['font-size'] . ';';
		}
		
		if ( $h4_css ) {
			$dynamic_css .= 'h4 { ' . $h4_css . ' }';
		}
	}
	
	if ( isset( $h5_typography ) && ! empty( $h5_typography ) ) {
		$h5_css = '';

		if ( isset( $h5_typography['font-family'] ) && ! empty( $h5_typography['font-family'] ) ) {
			$h5_css .= 'font-family: ' . $h5_typography['font-family'] . ';';
		}

		if ( isset( $h5_typography['font-style'] ) && ! empty( $h5_typography['font-style'] ) ) {
			$h5_css .= 'font-style: ' . $h5_typography['font-style'] . ';';
		}

		if ( isset( $h5_typography['font-weight'] ) && ! empty( $h5_typography['font-weight'] ) ) {
			$h5_css .= 'font-weight: ' . $h5_typography['font-weight'] . ';';
		}

		if ( isset( $h5_typography['letter-spacing'] ) && ! empty( $h5_typography['letter-spacing'] ) ) {
			$h5_css .= 'letter-spacing: ' . $h5_typography['letter-spacing'] . ';';
		}

		if ( isset( $h5_typography['line-height'] ) && ! empty( $h5_typography['line-height'] ) ) {
			$h5_css .= 'line-height: ' . $h5_typography['line-height'] . ';';
		}

		if ( isset( $h5_typography['font-size'] ) && ! empty( $h5_typography['font-size'] ) ) {
			$h5_css .= 'font-size: ' . $h5_typography['font-size'] . ';';
		}
		
		if ( $h5_css ) {
			$dynamic_css .= 'h5 { ' . $h5_css . ' }';
		}
	}

	if ( isset( $h6_typography ) && ! empty( $h6_typography ) ) {
		$h6_css = '';

		if ( isset( $h6_typography['font-family'] ) && ! empty( $h6_typography['font-family'] ) ) {
			$h6_css .= 'font-family: ' . $h6_typography['font-family'] . ';';
		}

		if ( isset( $h6_typography['font-style'] ) && ! empty( $h6_typography['font-style'] ) ) {
			$h6_css .= 'font-style: ' . $h6_typography['font-style'] . ';';
		}

		if ( isset( $h6_typography['font-weight'] ) && ! empty( $h6_typography['font-weight'] ) ) {
			$h6_css .= 'font-weight: ' . $h6_typography['font-weight'] . ';';
		}

		if ( isset( $h6_typography['letter-spacing'] ) && ! empty( $h6_typography['letter-spacing'] ) ) {
			$h6_css .= 'letter-spacing: ' . $h6_typography['letter-spacing'] . ';';
		}

		if ( isset( $h6_typography['line-height'] ) && ! empty( $h6_typography['line-height'] ) ) {
			$h6_css .= 'line-height: ' . $h6_typography['line-height'] . ';';
		}

		if ( isset( $h6_typography['font-size'] ) && ! empty( $h6_typography['font-size'] ) ) {
			$h6_css .= 'font-size: ' . $h6_typography['font-size'] . ';';
		}
		
		if ( $h6_css ) {
			$dynamic_css .= 'h6 { ' . $h6_css . ' }';
		}
	}

	wp_add_inline_style( 'finix-responsive', $dynamic_css );
}
add_action( 'wp_enqueue_scripts', 'finix_dynamic_css', 20 );

