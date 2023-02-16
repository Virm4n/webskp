<?php
if( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly
}

class MfnVisualBuilder {

	public $url = MFN_OPTIONS_URI;

	public function __construct() {
    add_action( 'admin_enqueue_scripts', array( $this, 'mfn_append_vb_styles') );
  }

	public function mfn_append_vb_styles() {

		global $post;

		if ($api_key = trim(mfn_opts_get('google-maps-api-key'))) {
			$api_key = '?key='. $api_key;
		}

		//wp_deregister_script('jquery-ui-draggable');

		wp_enqueue_script( 'mfn-opts-plugins',get_template_directory_uri() .'/muffin-options/js/plugins.js', array('jquery'), MFN_THEME_VERSION, true );
		wp_enqueue_script('mfn-plugins', get_theme_file_uri('/js/plugins.js'), array('jquery'), MFN_THEME_VERSION, true);

		wp_enqueue_script('google-maps', 'https://maps.google.com/maps/api/js'. esc_attr($api_key), false, null, true);

		wp_enqueue_style('mfn-vbreset', get_theme_file_uri('/visual-builder/assets/css/reset.css'), false, time(), 'all');

		wp_enqueue_script('wp-theme-plugin-editor');
		wp_enqueue_style('wp-codemirror');

    // Add the color picker
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'iris', admin_url( 'js/iris.min.js' ), array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), false, 1 );
 		wp_enqueue_script( 'wp-color-picker', admin_url( 'js/color-picker.min.js' ), array( 'iris' ), false, 1 );

 		wp_enqueue_editor();
 		wp_enqueue_media();

 		// icons
 		wp_enqueue_style('mfn-icons', get_theme_file_uri('/fonts/mfn/icons.css'), false, time());
 		wp_enqueue_style('mfn-font-awesome', get_theme_file_uri('/fonts/fontawesome/fontawesome.css'), false, time());

 		// VB styles & scripts

 		wp_enqueue_style('mfn-vbstyle', get_theme_file_uri('/visual-builder/assets/css/style.css'), false, time(), false);

 		wp_enqueue_script('mfn-vblistjs', get_theme_file_uri('/visual-builder/assets/js/list.min.js'), false, time(), true);
		wp_enqueue_script('mfn-vbscripts', get_theme_file_uri('/visual-builder/assets/js/scripts.js'), false, time(), true);

		wp_add_inline_script( 'mfn-vbscripts', 'var ajaxurl = "'. admin_url( 'admin-ajax.php' ) . '";' );

		$permalink = get_preview_post_link($post->ID).'&visual=iframe';

		if( get_post_status($post->ID) == 'publish' ){
			$permalink = get_permalink( $post->ID );
			if( strpos($permalink, '?') !== false){
				$permalink .= '&visual=iframe';
			}else{
				$permalink .= '?visual=iframe';
			}
		}

		wp_localize_script( 'mfn-vbscripts', 'mfnvbvars',
        array(
          'ajaxurl' => admin_url( 'admin-ajax.php' ),
          'themepath' => get_theme_file_uri('/'),
          'rooturl' => get_site_url(),
          'permalink' => $permalink,
        )
	    );

	    $cm_args = wp_enqueue_code_editor(array(
			'autoRefresh' => true,
			'lint' => true,
			'indentUnit' => 2,
			'tabSize' => 2
		));

	    $codemirror['css']['codeEditor'] = wp_enqueue_code_editor(array(
			'type' => 'text/css', // required for lint
			'codemirror' => $cm_args,
		));

		$codemirror['html']['codeEditor'] = wp_enqueue_code_editor(array(
			'type' => 'text/html', // required for lint
			'codemirror' => $cm_args,
		));

		$codemirror['javascript']['codeEditor'] = wp_enqueue_code_editor(array(
			'type' => 'javascript', // required for lint
			'codemirror' => $cm_args,
		));

		wp_localize_script('mfn-vbscripts', 'mfn_cm', $cm_args);


		$lightboxOptions = mfn_opts_get('prettyphoto-options');

		$config = array(
			'mobileInit' => mfn_opts_get('mobile-menu-initial', 1240),
			'themecolor' => mfn_opts_get('color-theme'),
			'parallax' => mfn_parallax_plugin(),
			'responsive' => intval(mfn_opts_get('responsive', 0)),
			'sidebarSticky' => mfn_opts_get('sidebar-sticky') ? true : false,
			'lightbox' => array(
				'disable' => isset($lightboxOptions['disable']) ? true : false,
				'disableMobile' => isset($lightboxOptions['disable-mobile']) ? true : false,
				'title' => isset($lightboxOptions['title']) ? true : false,
			),
			'slider' => array(
				'blog' => intval(mfn_opts_get('slider-blog-timeout', 0)),
				'clients' => intval(mfn_opts_get('slider-clients-timeout', 0)),
				'offer' => intval(mfn_opts_get('slider-offer-timeout', 0)),
				'portfolio' => intval(mfn_opts_get('slider-portfolio-timeout', 0)),
				'shop' => intval(mfn_opts_get('slider-shop-timeout', 0)),
				'slider' => intval(mfn_opts_get('slider-slider-timeout', 0)),
				'testimonials' => intval(mfn_opts_get('slider-testimonials-timeout', 0)),
			),
		);

		wp_localize_script( 'mfn-vbscripts', 'mfn', $config );

	}

	// public function vb_forIframe(){
	// 	add_action( 'wp_enqueue_scripts', array( $this, 'append_vbiframe_styles') );
	// }

	// public function append_vbiframe_styles() {
	// 	wp_enqueue_style('mfn-iframe-vbstyle', get_theme_file_uri('/visual-builder/assets/css/iframe.css'), false, time(), 'all');
	// }

	public function sizes($size){
		$classes = array(
  			'divider' => 'divider',
  			'1/6' => 'one-sixth',
  			'1/5' => 'one-fifth',
  			'1/4' => 'one-fourth',
  			'1/3' => 'one-third',
  			'2/5' => 'two-fifth',
  			'1/2' => 'one-second',
  			'3/5' => 'three-fifth',
  			'2/3' => 'two-third',
  			'3/4' => 'three-fourth',
  			'4/5' => 'four-fifth',
  			'5/6' => 'five-sixth',
  			'1/1' => 'one'
  		);

  		return $classes[$size];
	}

	public function mfn_load_sidebar(){

		global $post;

		$post_type = get_post_type($post->ID);

		require_once(get_theme_file_path('/visual-builder/visual-builder-header.php'));

		$mfn_items = get_post_meta($post->ID, 'mfn-page-items', true);

		$widgetsClass =  new Mfn_Builder_Fields();

		$widgets = $widgetsClass->get_items();

		$inline_shortcodes = $widgetsClass->get_inline_shortcode();

		echo '<div class="frameOverlay"></div><div id="mfn-visualbuilder" class="mfn-ui mfn-visualbuilder">';

		$edit_lock = wp_check_post_lock($post->ID);

		if( $edit_lock && $edit_lock != get_current_user_id() ){
			require_once(get_theme_file_path('/visual-builder/partials/locker.php'));
		}else{
			wp_set_post_lock($post->ID);
		}

		// start sidebar
        echo '<div class="sidebar-wrapper" id="mfn-vb-sidebar">';

        echo '<div id="mfn-sidebar-resizer"></div>';

        // sidebar left
        require_once(get_theme_file_path('/visual-builder/partials/sidebar-menu.php'));

	    // end sidebar left

	    // start sidebar panel
        echo '<div class="sidebar-panel">';

        // start sidebar header

	    require_once(get_theme_file_path('/visual-builder/partials/sidebar-header.php'));

	    // end sidebar header

	    // items panel
        echo '<div class="sidebar-panel-content">';

        // start items panel
        require_once(get_theme_file_path('/visual-builder/partials/sidebar-widgets.php'));

        // end items panel

       	// start pre build
       	require_once(get_theme_file_path('/visual-builder/partials/sidebar-prebuilds.php'));
       	// end pre build

        // start revision
        require_once(get_theme_file_path('/visual-builder/partials/sidebar-revisions.php'));
        // end revisions

        // start export/import
        require_once(get_theme_file_path('/visual-builder/partials/sidebar-export-import.php'));

       // end export/import

        // start settings
       	require_once(get_theme_file_path('/visual-builder/partials/sidebar-settings.php'));
       	// end settings

       	// start options
       	require_once(get_theme_file_path('/visual-builder/partials/sidebar-options.php'));
       	// end options

       // start edit form

       echo '<div class="panel panel-edit-item" style="display: none;"><div class="mfn-form"><form id="mfn-vb-form">';



       	echo '<input type="hidden" name="pageid" value="'.get_the_ID().'">';
       	echo '<input type="hidden" name="mfn-builder-nonce" value="'.wp_create_nonce( 'mfn-builder-nonce' ).'">';

		if($mfn_items && ! is_array($mfn_items)) {
			$mfn_items = unserialize(call_user_func('base'.'64_decode', $mfn_items));
		}

		if(is_array($mfn_items)):
			//echo '<pre style="padding-left: 500px; background: yellow;; margin-top: 30px; ">'; print_r($mfn_items); echo '</pre>';
			$this->mfn_createForm($mfn_items);
		endif;

       echo '</form></div></div>';
       // end edit form

        echo '</div>';
        // start footer
        require_once(get_theme_file_path('/visual-builder/partials/sidebar-footer.php'));

        // end panel
        echo '</div>';
        // end sidebar
        echo '</div>';

        // iframe

        echo '<div id="mfn-preview-wrapper-holder" class="preview-wrapper">';
        // preview toolbar
        require_once(get_theme_file_path('/visual-builder/partials/preview-toolbar.php'));

        echo '<div id="mfn-preview-wrapper"></div>';
		//echo '<iframe id="mfn-vb-ifr" src="'.get_permalink().'?visual=iframe"></iframe>';
		// echo '<pre>'; print_r($mfn_items); echo '</pre>';
		echo '</div>';

		// introduction
        require_once(get_theme_file_path('/visual-builder/partials/introduction.php'));

        // modal icons
		require_once(get_theme_file_path('/visual-builder/partials/modal-icons.php'));

		// modal shortcodes
		require_once(get_theme_file_path('/visual-builder/partials/modal-shortcodes.php'));

        echo '</div>';



        echo '<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"><script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>';

        require_once(get_theme_file_path('/visual-builder/visual-builder-footer.php'));

		//echo $return;
	}

	public function mfn_appendNewSection($c, $r){
		$return = array();

		// wrappers loaded separately with muffins ui theme

		$mfn_fields = new Mfn_Builder_Fields();
		$mfn_helper = new Mfn_Builder_Helper();

		$items = $mfn_fields->get_section();
		$item_id = $mfn_helper->unique_ID();

		ob_start();

		$this->mfn_formElement('uid', $item_id, $item_id, 'sections['.$c.'][uid]', 'mcb-section-'.$item_id, $r);

		foreach($items as $i=>$j){
			if(isset($j['id'])){
				$this->mfn_formElement($j, '', $item_id, 'sections['.$c.'][attr]['.$j['id'].']', 'mcb-section-'.$item_id, $r);
			}else{
				$this->mfn_formElement($j, '', $item_id, '', 'mcb-section-'.$item_id, $r);
			}
		}

		$form = ob_get_contents();

		ob_end_clean();

		$return['form'] = $form;

		$return['html'] = '<div data-order="'.$c.'" data-uid="'.$item_id.'" class="section mcb-section mcb-section-new vb-item mcb-section-'.$item_id.' empty blink">';
		$return['html'] .= $mfn_helper->sectionTools();
		$return['html'] .= '<div class="section_wrapper mcb-section-inner"> <div class="mfn-section-new"> <h5>Select a wrap layout</h5> <div class="wrap-layouts"> <div class="wrap-layout wrap-11" data-type="wrap-11" data-tooltip="1/1"></div><div class="wrap-layout wrap-12" data-type="wrap-12" data-tooltip="1/2 | 1/2"><span></span></div><div class="wrap-layout wrap-13" data-type="wrap-13" data-tooltip="1/3 | 1/3 | 1/3"><span></span><span></span></div><div class="wrap-layout wrap-14" data-type="wrap-14" data-tooltip="1/4 | 1/4 | 1/4 | 1/4"><span></span><span></span><span></span></div><div class="wrap-layout wrap-13-23" data-type="wrap-1323" data-tooltip="1/3 | 2/3"><span></span></div><div class="wrap-layout wrap-23-13" data-type="wrap-2313" data-tooltip="2/3 | 1/3"><span></span></div><div class="wrap-layout wrap-14-12-14" data-type="wrap-141214" data-tooltip="1/4 | 1/2 | 1/4"><span></span><span></span></div></div><p>or choose from</p><a class="mfn-btn prebuilt-button mfn-btn-green btn-icon-left" href="#"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add-light"></span>Pre-built sections</span></a> </div></div>';
		$return['html'] .= '<a href="#" class="btn-section-add mfn-icon-add-light mfn-section-add siblings next" data-position="after">Add section</a></div>';

		$return['id'] = $item_id;

		return $return;
	}

	public function mfn_appendNewWrap($c, $s, $r, $d){
		$return = array();

		$mfn_fields = new Mfn_Builder_Fields();
		$mfn_helper = new Mfn_Builder_Helper();

		$items = $mfn_fields->get_wrap();
		$item_id = $mfn_helper->unique_ID();

		$input_size = '1/1';
		$class_size = 'one';

		if($d == 1){
			$input_size = 'divider';
			$class_size = 'divider';
		}

		ob_start();

		$this->mfn_formElement('uid', $item_id, $item_id, 'sections['.$s.'][wraps]['.$c.'][uid]', 'mcb-wrap-'.$item_id, $r);
		$this->mfn_formElement('size', $input_size, $item_id, 'sections['.$s.'][wraps]['.$c.'][size]', 'mcb-wrap-'.$item_id, $r);

		foreach($items as $i=>$j){
			if(isset($j['type'])){
				$this->mfn_formElement($j, '', $item_id, 'sections['.$s.'][wraps]['.$c.'][attr]['.$j['id'].']', 'mcb-wrap-'.$item_id, $r);
			}else{
				$this->mfn_formElement($j, '', $item_id, '', 'mcb-wrap-'.$item_id, $r);
			}

		}

		$form = ob_get_contents();

		ob_end_clean();

		$return['form'] = $form;
		$return['id'] = $item_id;
		$return['html'] = '<div data-order="'.$c.'" data-uid="'.$item_id.'" data-size="'.$input_size.'" style="background-repeat:no-repeat;background-position:left top;" class="wrap mcb-wrap mcb-wrap-new vb-item vb-item-wrap blink mcb-wrap-'.$item_id.' '.$class_size.' clearfix">';

		$return['html'] .= $mfn_helper->wrapTools($input_size);

		$return['html'] .= '<div class="mcb-wrap-inner empty"><div class="mfn-drag-helper placeholder-wrap"></div><div class="mfn-drag-helper placeholder-wrap"></div><div class="mfn-wrap-new"><a href="#" class="mfn-item-add mfn-btn btn-icon-left btn-small mfn-btn-blank2"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add"></span>Add item</span></a></div></div></div>';

		return $return;
	}

	public function mfn_appendWrapLayout($t, $s, $r){
		$return = array();

		$mfn_fields = new Mfn_Builder_Fields();
		$mfn_helper = new Mfn_Builder_Helper();

		$items = $mfn_fields->get_wrap();
		$item_id = $mfn_helper->unique_ID();

		switch ($t){
			case 'wrap-12':
				$item_id2 = $mfn_helper->unique_ID();
				ob_start();

				$this->mfn_formElement('uid', $item_id, $item_id, 'sections['.$s.'][wraps][0][uid]', 'mcb-wrap-'.$item_id, $r);
				$this->mfn_formElement('size', '1/2', $item_id, 'sections['.$s.'][wraps][0][size]', 'mcb-wrap-'.$item_id, $r);
				foreach($items as $i=>$j){
					if(isset($j['id'])){
						$this->mfn_formElement($j, '', $item_id, 'sections['.$s.'][wraps][0][attr]['.$j['id'].']', 'mcb-wrap-'.$item_id, $r);
					}else{
						$this->mfn_formElement($j, '', $item_id, '', 'mcb-wrap-'.$item_id, $r);
					}
				}

				$this->mfn_formElement('uid', $item_id2, $item_id2, 'sections['.$s.'][wraps][1][uid]', 'mcb-wrap-'.$item_id2, $r);
				$this->mfn_formElement('size', '1/2', $item_id2, 'sections['.$s.'][wraps][1][size]', 'mcb-wrap-'.$item_id2, $r);
				foreach($items as $i=>$j){
					if(isset($j['id'])){
						$this->mfn_formElement($j, '', $item_id2, 'sections['.$s.'][wraps][1][attr]['.$j['id'].']', 'mcb-wrap-'.$item_id2, $r);
					}else{
						$this->mfn_formElement($j, '', $item_id2, '', 'mcb-wrap-'.$item_id2, $r);
					}
				}

				$form = ob_get_contents();

				ob_end_clean();

				$html = '<div data-order="0" data-uid="'.$item_id.'" data-size="1/2" style="background-repeat:no-repeat;background-position:left top;" class="blink wrap mcb-wrap mcb-wrap-new vb-item vb-item-wrap mcb-wrap-'.$item_id.' one-second clearfix">'.$mfn_helper->wrapTools('1/2').'<div class="mcb-wrap-inner empty"><div class="mfn-drag-helper placeholder-wrap"></div><div class="mfn-wrap-new"><a href="#" class="mfn-item-add mfn-btn btn-icon-left btn-small mfn-btn-blank2"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add"></span>Add item</span></a></div></div></div>';
				$html .= '<div data-order="1" data-uid="'.$item_id2.'" data-size="1/2" style="background-repeat:no-repeat;background-position:left top;" class="blink wrap mcb-wrap mcb-wrap-new vb-item vb-item-wrap mcb-wrap-'.$item_id2.' one-second clearfix">'.$mfn_helper->wrapTools('1/2').'<div class="mcb-wrap-inner empty"><div class="mfn-drag-helper placeholder-wrap"></div><div class="mfn-wrap-new"><a href="#" class="mfn-item-add mfn-btn btn-icon-left btn-small mfn-btn-blank2"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add"></span>Add item</span></a></div></div></div>';

				$return['form'] = $form;
				$return['html'] = $html;
			break;
			case 'wrap-13':
				$item_id2 = $mfn_helper->unique_ID();
				$item_id3 = $mfn_helper->unique_ID();
				ob_start();

				$this->mfn_formElement('uid', $item_id, $item_id, 'sections['.$s.'][wraps][0][uid]', 'mcb-wrap-'.$item_id, $r);
				$this->mfn_formElement('size', '1/3', $item_id, 'sections['.$s.'][wraps][0][size]', 'mcb-wrap-'.$item_id, $r);
				foreach($items as $i=>$j){
					if(isset($j['id'])){
						$this->mfn_formElement($j, '', $item_id, 'sections['.$s.'][wraps][0][attr]['.$j['id'].']', 'mcb-wrap-'.$item_id, $r);
					}else{
						$this->mfn_formElement($j, '', $item_id, '', 'mcb-wrap-'.$item_id, $r);
					}
				}

				$this->mfn_formElement('uid', $item_id2, $item_id2, 'sections['.$s.'][wraps][1][uid]', 'mcb-wrap-'.$item_id2, $r);
				$this->mfn_formElement('size', '1/3', $item_id2, 'sections['.$s.'][wraps][1][size]', 'mcb-wrap-'.$item_id2, $r);
				foreach($items as $i=>$j){
					if(isset($j['id'])){
						$this->mfn_formElement($j, '', $item_id2, 'sections['.$s.'][wraps][1][attr]['.$j['id'].']', 'mcb-wrap-'.$item_id2, $r);
					}else{
						$this->mfn_formElement($j, '', $item_id2, '', 'mcb-wrap-'.$item_id2, $r);
					}
				}

				$this->mfn_formElement('uid', $item_id3, $item_id3, 'sections['.$s.'][wraps][2][uid]', 'mcb-wrap-'.$item_id3, $r);
				$this->mfn_formElement('size', '1/3', $item_id3, 'sections['.$s.'][wraps][2][size]', 'mcb-wrap-'.$item_id3, $r);
				foreach($items as $i=>$j){
					if(isset($j['id'])){
						$this->mfn_formElement($j, '', $item_id3, 'sections['.$s.'][wraps][2][attr]['.$j['id'].']', 'mcb-wrap-'.$item_id3, $r);
					}else{
						$this->mfn_formElement($j, '', $item_id3, '', 'mcb-wrap-'.$item_id3, $r);
					}
				}

				$form = ob_get_contents();

				ob_end_clean();

				$html = '<div data-order="0" data-uid="'.$item_id.'" data-size="1/3" style="background-repeat:no-repeat;background-position:left top;" class="blink wrap mcb-wrap mcb-wrap-new vb-item vb-item-wrap mcb-wrap-'.$item_id.' one-third clearfix">'.$mfn_helper->wrapTools('1/3').'<div class="mcb-wrap-inner empty"><div class="mfn-drag-helper placeholder-wrap"></div><div class="mfn-wrap-new"><a href="#" class="mfn-item-add mfn-btn btn-icon-left btn-small mfn-btn-blank2"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add"></span>Add item</span></a></div></div></div>';
				$html .= '<div data-order="1" data-uid="'.$item_id2.'" data-size="1/3" style="background-repeat:no-repeat;background-position:left top;" class="blink wrap mcb-wrap mcb-wrap-new vb-item vb-item-wrap mcb-wrap-'.$item_id2.' one-third clearfix">'.$mfn_helper->wrapTools('1/3').'<div class="mcb-wrap-inner empty"><div class="mfn-drag-helper placeholder-wrap"></div><div class="mfn-wrap-new"><a href="#" class="mfn-item-add mfn-btn btn-icon-left btn-small mfn-btn-blank2"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add"></span>Add item</span></a></div></div></div>';
				$html .= '<div data-order="2" data-uid="'.$item_id3.'" data-size="1/3" style="background-repeat:no-repeat;background-position:left top;" class="blink wrap mcb-wrap mcb-wrap-new vb-item vb-item-wrap mcb-wrap-'.$item_id3.' one-third clearfix">'.$mfn_helper->wrapTools('1/3').'<div class="mcb-wrap-inner empty"><div class="mfn-drag-helper placeholder-wrap"></div><div class="mfn-wrap-new"><a href="#" class="mfn-item-add mfn-btn btn-icon-left btn-small mfn-btn-blank2"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add"></span>Add item</span></a></div></div></div>';

				$return['form'] = $form;
				$return['html'] = $html;
			break;
			case 'wrap-14':
				$item_id2 = $mfn_helper->unique_ID();
				$item_id3 = $mfn_helper->unique_ID();
				$item_id4 = $mfn_helper->unique_ID();
				ob_start();

				$this->mfn_formElement('uid', $item_id, $item_id, 'sections['.$s.'][wraps][0][uid]', 'mcb-wrap-'.$item_id, $r);
				$this->mfn_formElement('size', '1/4', $item_id, 'sections['.$s.'][wraps][0][size]', 'mcb-wrap-'.$item_id, $r);
				foreach($items as $i=>$j){
					if(isset($j['id'])){
						$this->mfn_formElement($j, '', $item_id, 'sections['.$s.'][wraps][0][attr]['.$j['id'].']', 'mcb-wrap-'.$item_id, $r);
					}else{
						$this->mfn_formElement($j, '', $item_id, '', 'mcb-wrap-'.$item_id, $r);
					}
				}

				$this->mfn_formElement('uid', $item_id2, $item_id2, 'sections['.$s.'][wraps][1][uid]', 'mcb-wrap-'.$item_id2, $r);
				$this->mfn_formElement('size', '1/4', $item_id2, 'sections['.$s.'][wraps][1][size]', 'mcb-wrap-'.$item_id2, $r);
				foreach($items as $i=>$j){
					if(isset($j['id'])){
						$this->mfn_formElement($j, '', $item_id2, 'sections['.$s.'][wraps][1][attr]['.$j['id'].']', 'mcb-wrap-'.$item_id2, $r);
					}else{
						$this->mfn_formElement($j, '', $item_id2, '', 'mcb-wrap-'.$item_id2, $r);
					}
				}

				$this->mfn_formElement('uid', $item_id3, $item_id3, 'sections['.$s.'][wraps][2][uid]', 'mcb-wrap-'.$item_id3, $r);
				$this->mfn_formElement('size', '1/4', $item_id3, 'sections['.$s.'][wraps][2][size]', 'mcb-wrap-'.$item_id3, $r);
				foreach($items as $i=>$j){
					if(isset($j['id'])){
						$this->mfn_formElement($j, '', $item_id3, 'sections['.$s.'][wraps][2][attr]['.$j['id'].']', 'mcb-wrap-'.$item_id3, $r);
					}else{
						$this->mfn_formElement($j, '', $item_id3, '', 'mcb-wrap-'.$item_id3, $r);
					}
				}

				$this->mfn_formElement('uid', $item_id4, $item_id4, 'sections['.$s.'][wraps][3][uid]', 'mcb-wrap-'.$item_id4, $r);
				$this->mfn_formElement('size', '1/4', $item_id4, 'sections['.$s.'][wraps][3][size]', 'mcb-wrap-'.$item_id4, $r);
				foreach($items as $i=>$j){
					if(isset($j['id'])){
						$this->mfn_formElement($j, '', $item_id4, 'sections['.$s.'][wraps][3][attr]['.$j['id'].']', 'mcb-wrap-'.$item_id4, $r);
					}else{
						$this->mfn_formElement($j, '', $item_id4, '', 'mcb-wrap-'.$item_id4, $r);
					}
				}

				$form = ob_get_contents();

				ob_end_clean();

				$html = '<div data-order="0" data-uid="'.$item_id.'" data-size="1/4" style="background-repeat:no-repeat;background-position:left top;" class="blink wrap mcb-wrap mcb-wrap-new vb-item vb-item-wrap mcb-wrap-'.$item_id.' one-fourth clearfix">'.$mfn_helper->wrapTools('1/4').'<div class="mcb-wrap-inner empty"><div class="mfn-drag-helper placeholder-wrap"></div><div class="mfn-wrap-new"><a href="#" class="mfn-item-add mfn-btn btn-icon-left btn-small mfn-btn-blank2"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add"></span>Add item</span></a></div></div></div>';
				$html .= '<div data-order="1" data-uid="'.$item_id2.'" data-size="1/4" style="background-repeat:no-repeat;background-position:left top;" class="blink wrap mcb-wrap mcb-wrap-new vb-item vb-item-wrap mcb-wrap-'.$item_id2.' one-fourth clearfix">'.$mfn_helper->wrapTools('1/4').'<div class="mcb-wrap-inner empty"><div class="mfn-drag-helper placeholder-wrap"></div><div class="mfn-wrap-new"><a href="#" class="mfn-item-add mfn-btn btn-icon-left btn-small mfn-btn-blank2"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add"></span>Add item</span></a></div></div></div>';
				$html .= '<div data-order="2" data-uid="'.$item_id3.'" data-size="1/4" style="background-repeat:no-repeat;background-position:left top;" class="blink wrap mcb-wrap mcb-wrap-new vb-item vb-item-wrap mcb-wrap-'.$item_id3.' one-fourth clearfix">'.$mfn_helper->wrapTools('1/4').'<div class="mcb-wrap-inner empty"><div class="mfn-drag-helper placeholder-wrap"></div><div class="mfn-wrap-new"><a href="#" class="mfn-item-add mfn-btn btn-icon-left btn-small mfn-btn-blank2"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add"></span>Add item</span></a></div></div></div>';
				$html .= '<div data-order="3" data-uid="'.$item_id4.'" data-size="1/4" style="background-repeat:no-repeat;background-position:left top;" class="blink wrap mcb-wrap mcb-wrap-new vb-item vb-item-wrap mcb-wrap-'.$item_id4.' one-fourth clearfix">'.$mfn_helper->wrapTools('1/4').'<div class="mcb-wrap-inner empty"><div class="mfn-drag-helper placeholder-wrap"></div><div class="mfn-wrap-new"><a href="#" class="mfn-item-add mfn-btn btn-icon-left btn-small mfn-btn-blank2"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add"></span>Add item</span></a></div></div></div>';

				$return['form'] = $form;
				$return['html'] = $html;
			break;
			case 'wrap-1323':
				$item_id2 = $mfn_helper->unique_ID();
				ob_start();

				$this->mfn_formElement('uid', $item_id, $item_id, 'sections['.$s.'][wraps][0][uid]', 'mcb-wrap-'.$item_id, $r);
				$this->mfn_formElement('size', '1/3', $item_id, 'sections['.$s.'][wraps][0][size]', 'mcb-wrap-'.$item_id, $r);
				foreach($items as $i=>$j){
					if(isset($j['id'])){
						$this->mfn_formElement($j, '', $item_id, 'sections['.$s.'][wraps][0][attr]['.$j['id'].']', 'mcb-wrap-'.$item_id, $r);
					}else{
						$this->mfn_formElement($j, '', $item_id, '', 'mcb-wrap-'.$item_id, $r);
					}
				}

				$this->mfn_formElement('uid', $item_id2, $item_id2, 'sections['.$s.'][wraps][1][uid]', 'mcb-wrap-'.$item_id2, $r);
				$this->mfn_formElement('size', '2/3', $item_id2, 'sections['.$s.'][wraps][1][size]', 'mcb-wrap-'.$item_id2, $r);
				foreach($items as $i=>$j){
					if(isset($j['id'])){
						$this->mfn_formElement($j, '', $item_id2, 'sections['.$s.'][wraps][1][attr]['.$j['id'].']', 'mcb-wrap-'.$item_id2, $r);
					}else{
						$this->mfn_formElement($j, '', $item_id2, '', 'mcb-wrap-'.$item_id2, $r);
					}
				}

				$form = ob_get_contents();

				ob_end_clean();

				$html = '<div data-order="0" data-uid="'.$item_id.'" data-size="1/3" style="background-repeat:no-repeat;background-position:left top;" class="blink wrap mcb-wrap mcb-wrap-new vb-item vb-item-wrap mcb-wrap-'.$item_id.' one-third clearfix">'.$mfn_helper->wrapTools('1/3').'<div class="mcb-wrap-inner empty"><div class="mfn-drag-helper placeholder-wrap"></div><div class="mfn-wrap-new"><a href="#" class="mfn-item-add mfn-btn btn-icon-left btn-small mfn-btn-blank2"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add"></span>Add item</span></a></div></div></div>';
				$html .= '<div data-order="1" data-uid="'.$item_id2.'" data-size="2/3" style="background-repeat:no-repeat;background-position:left top;" class="blink wrap mcb-wrap mcb-wrap-new vb-item vb-item-wrap mcb-wrap-'.$item_id2.' two-third clearfix">'.$mfn_helper->wrapTools('2/3').'<div class="mcb-wrap-inner empty"><div class="mfn-drag-helper placeholder-wrap"></div><div class="mfn-wrap-new"><a href="#" class="mfn-item-add mfn-btn btn-icon-left btn-small mfn-btn-blank2"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add"></span>Add item</span></a></div></div></div>';

				$return['form'] = $form;
				$return['html'] = $html;
			break;
			case 'wrap-2313':
				$item_id2 = $mfn_helper->unique_ID();
				ob_start();

				$this->mfn_formElement('uid', $item_id, $item_id, 'sections['.$s.'][wraps][1][uid]', 'mcb-wrap-'.$item_id, $r);
				$this->mfn_formElement('size', '1/3', $item_id, 'sections['.$s.'][wraps][1][size]', 'mcb-wrap-'.$item_id, $r);
				foreach($items as $i=>$j){
					if(isset($j['id'])){
						$this->mfn_formElement($j, '', $item_id, 'sections['.$s.'][wraps][1][attr]['.$j['id'].']', 'mcb-wrap-'.$item_id, $r);
					}else{
						$this->mfn_formElement($j, '', $item_id, 'n', 'mcb-wrap-'.$item_id, $r);
					}
				}

				$this->mfn_formElement('uid', $item_id2, $item_id2, 'sections['.$s.'][wraps][0][uid]', 'mcb-wrap-'.$item_id2, $r);
				$this->mfn_formElement('size', '2/3', $item_id2, 'sections['.$s.'][wraps][0][size]', 'mcb-wrap-'.$item_id2, $r);
				foreach($items as $i=>$j){
					if(isset($j['id'])){
						$this->mfn_formElement($j, '', $item_id2, 'sections['.$s.'][wraps][0][attr]['.$j['id'].']', 'mcb-wrap-'.$item_id2, $r);
					}else{
						$this->mfn_formElement($j, '', $item_id2, '', 'mcb-wrap-'.$item_id2, $r);
					}
				}

				$form = ob_get_contents();

				ob_end_clean();

				$html = '<div data-order="0" data-uid="'.$item_id2.'" data-size="2/3" style="background-repeat:no-repeat;background-position:left top;" class="blink wrap mcb-wrap mcb-wrap-new vb-item vb-item-wrap mcb-wrap-'.$item_id2.' two-third clearfix">'.$mfn_helper->wrapTools('2/3').'<div class="mcb-wrap-inner empty"><div class="mfn-drag-helper placeholder-wrap"></div><div class="mfn-wrap-new"><a href="#" class="mfn-item-add mfn-btn btn-icon-left btn-small mfn-btn-blank2"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add"></span>Add item</span></a></div></div></div>';
				$html .= '<div data-order="1" data-uid="'.$item_id.'" data-size="1/3" style="background-repeat:no-repeat;background-position:left top;" class="blink wrap mcb-wrap mcb-wrap-new vb-item vb-item-wrap mcb-wrap-'.$item_id.' one-third clearfix">'.$mfn_helper->wrapTools('1/3').'<div class="mcb-wrap-inner empty"><div class="mfn-drag-helper placeholder-wrap"></div><div class="mfn-wrap-new"><a href="#" class="mfn-item-add mfn-btn btn-icon-left btn-small mfn-btn-blank2"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add"></span>Add item</span></a></div></div></div>';

				$return['form'] = $form;
				$return['html'] = $html;
			break;
			case 'wrap-141214':
				$item_id2 = $mfn_helper->unique_ID();
				$item_id3 = $mfn_helper->unique_ID();
				ob_start();

				$this->mfn_formElement('uid', $item_id, $item_id, 'sections['.$s.'][wraps][0][uid]', 'mcb-wrap-'.$item_id, $r);
				$this->mfn_formElement('size', '1/4', $item_id, 'sections['.$s.'][wraps][0][size]', 'mcb-wrap-'.$item_id, $r);
				foreach($items as $i=>$j){
					if(isset($j['id'])){
						$this->mfn_formElement($j, '', $item_id, 'sections['.$s.'][wraps][0][attr]['.$j['id'].']', 'mcb-wrap-'.$item_id, $r);
					}else{
						$this->mfn_formElement($j, '', $item_id, '', 'mcb-wrap-'.$item_id, $r);
					}
				}

				$this->mfn_formElement('uid', $item_id2, $item_id2, 'sections['.$s.'][wraps][1][uid]', 'mcb-wrap-'.$item_id2, $r);
				$this->mfn_formElement('size', '1/2', $item_id2, 'sections['.$s.'][wraps][1][size]', 'mcb-wrap-'.$item_id2, $r);
				foreach($items as $i=>$j){
					if(isset($j['id'])){
						$this->mfn_formElement($j, '', $item_id2, 'sections['.$s.'][wraps][1][attr]['.$j['id'].']', 'mcb-wrap-'.$item_id2, $r);
					}else{
						$this->mfn_formElement($j, '', $item_id2, '', 'mcb-wrap-'.$item_id2, $r);
					}
				}

				$this->mfn_formElement('uid', $item_id3, $item_id3, 'sections['.$s.'][wraps][2][uid]', 'mcb-wrap-'.$item_id3, $r);
				$this->mfn_formElement('size', '1/4', $item_id3, 'sections['.$s.'][wraps][2][size]', 'mcb-wrap-'.$item_id3, $r);
				foreach($items as $i=>$j){
					if(isset($j['id'])){
						$this->mfn_formElement($j, '', $item_id3, 'sections['.$s.'][wraps][2][attr]['.$j['id'].']', 'mcb-wrap-'.$item_id3, $r);
					}else{
						$this->mfn_formElement($j, '', $item_id3, '', 'mcb-wrap-'.$item_id3, $r);
					}
				}

				$form = ob_get_contents();

				ob_end_clean();

				$html = '<div data-order="0" data-uid="'.$item_id.'" data-size="1/4" style="background-repeat:no-repeat;background-position:left top;" class="blink wrap mcb-wrap mcb-wrap-new vb-item vb-item-wrap mcb-wrap-'.$item_id.' one-fourth clearfix">'.$mfn_helper->wrapTools('1/4').'<div class="mcb-wrap-inner empty"><div class="mfn-drag-helper placeholder-wrap"></div><div class="mfn-wrap-new"><a href="#" class="mfn-item-add mfn-btn btn-icon-left btn-small mfn-btn-blank2"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add"></span>Add item</span></a></div></div></div>';
				$html .= '<div data-order="1" data-uid="'.$item_id2.'" data-size="1/2" style="background-repeat:no-repeat;background-position:left top;" class="blink wrap mcb-wrap mcb-wrap-new vb-item vb-item-wrap mcb-wrap-'.$item_id2.' one-second clearfix">'.$mfn_helper->wrapTools('1/2').'<div class="mcb-wrap-inner empty"><div class="mfn-drag-helper placeholder-wrap"></div><div class="mfn-wrap-new"><a href="#" class="mfn-item-add mfn-btn btn-icon-left btn-small mfn-btn-blank2"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add"></span>Add item</span></a></div></div></div>';
				$html .= '<div data-order="2" data-uid="'.$item_id3.'" data-size="1/4" style="background-repeat:no-repeat;background-position:left top;" class="blink wrap mcb-wrap mcb-wrap-new vb-item vb-item-wrap mcb-wrap-'.$item_id3.' one-fourth clearfix">'.$mfn_helper->wrapTools('1/4').'<div class="mcb-wrap-inner empty"><div class="mfn-drag-helper placeholder-wrap"></div><div class="mfn-wrap-new"><a href="#" class="mfn-item-add mfn-btn btn-icon-left btn-small mfn-btn-blank2"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add"></span>Add item</span></a></div></div></div>';

				$return['form'] = $form;
				$return['html'] = $html;
			break;
			default:
				ob_start();
				$this->mfn_formElement('uid', $item_id, $item_id, 'sections['.$s.'][wraps][0][uid]', 'mcb-wrap-'.$item_id, $r);
				$this->mfn_formElement('size', '1/1', $item_id, 'sections['.$s.'][wraps][0][size]', 'mcb-wrap-'.$item_id, $r);

				foreach($items as $i=>$j){
					if(isset($j['id'])){
						$this->mfn_formElement($j, '', $item_id, 'sections['.$s.'][wraps][0][attr]['.$j['id'].']', 'mcb-wrap-'.$item_id, $r);
					}else{
						$this->mfn_formElement($j, '', $item_id, '', 'mcb-wrap-'.$item_id, $r);
					}

				}

				$form = ob_get_contents();
				$return['id'] = $item_id;

				ob_end_clean();

				$return['form'] = $form;
				$return['html'] = '<div data-order="0" data-uid="'.$item_id.'" data-size="1/1" style="background-repeat:no-repeat;background-position:left top;" class="blink wrap mcb-wrap mcb-wrap-new vb-item vb-item-wrap mcb-wrap-'.$item_id.' one clearfix">'.$mfn_helper->wrapTools('1/1').'<div class="mcb-wrap-inner empty"><div class="mfn-drag-helper placeholder-wrap"></div><div class="mfn-wrap-new"><a href="#" class="mfn-item-add mfn-btn btn-icon-left btn-small mfn-btn-blank2"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add"></span>Add item</span></a></div></div></div>';
		}

		return $return;
	}


	public function mfn_appendNewWidget($c, $s, $w, $i, $r, $wrap_size, $p){

		$return = array();
		$params = array();
		$params_content = '';

		$mfn_fields = new Mfn_Builder_Fields();
		$mfn_helper = new Mfn_Builder_Helper();

		$widgets = $mfn_fields->get_items();
		$item_id = $mfn_helper->unique_ID();

		$widget = $widgets[$i];

		ob_start();

		$this->mfn_formElement('uid', $item_id, $item_id, 'sections['.$s.'][wraps]['.$w.'][items]['.$c.'][uid]', 'mcb-item-'.$item_id, $r);

		foreach ($widget as $g => $wid) {

			if(is_array($wid)){
				foreach($wid as $e=>$t){
					$val = '';

					if(!empty($t['std'])) {
						$val = $t['std'];

						if($t['id'] == 'content'){
							$params_content = $t['std'];
						}else{
							$params[$t['id']] = $t['std'];
						}
					}

					if(!empty($t['vbstd'])) {
						$val = $t['vbstd'];

						if($t['id'] == 'content'){
							$params_content = $t['vbstd'];
						}else{
							$params[$t['id']] = $t['vbstd'];
						}
					}

					if(isset($t['id'])){

						$this->mfn_formElement($t, $val, $item_id, 'sections['.$s.'][wraps]['.$w.'][items]['.$c.'][fields]['.$t['id'].']', 'mcb-item-'.$item_id, $r, $widget['type']);
					}else{
						$this->mfn_formElement($t, $val, $item_id, '', 'mcb-item-'.$item_id, $r, $widget['type']);
					}
				}
			}else{
				// type, title, cat, size

				if($g == 'size'){
					$this->mfn_formElement($g, '1/1', $item_id, 'sections['.$s.'][wraps]['.$w.'][items]['.$c.']['.$g.']', 'mcb-item-'.$item_id, $r);
				}else{
					$this->mfn_formElement($g, $wid, $item_id, 'sections['.$s.'][wraps]['.$w.'][items]['.$c.']['.$g.']', 'mcb-item-'.$item_id, $r);
				}


			}
		}

		$form = ob_get_contents();

		ob_end_clean();


		$return['form'] = $form;
		$return['id'] = $item_id;

		$size = $widget['size'];

		//if($wrap_size != '1/1'){
			$size = '1/1';
		//}


		$html = '<div data-order="'.$c.'" data-uid="'.$item_id.'" data-size="'.$size.'" class="blink column mcb-column mfn-new-item vb-item vb-item-widget mcb-item-'.$item_id.' column_'.$widget['type'].' '.$this->sizes($size).'">';

		$html .= $mfn_helper->itemTools($size);

		$fun_name = 'sc_'.$i;

		if($i == 'placeholder'){
			$html .= '<div class="placeholder"></div>';
		}elseif($i == 'content'){
			$html .= '<div class="content-wp">'.get_post_field( 'post_content', $p ).'</div>';
		}elseif($i == 'divider'){
			$html .= '<hr />';
		}elseif($i == 'slider_plugin'){
			$html .= '<div class="mfn-widget-placeholder mfn-wp-revolution"></div>';
		}elseif($i == 'visual'){
			$html .= $params_content;
		}elseif($i == 'column'){
			$html .= '<div class="column_attr clearfix">'.$params_content.'</div>';
		}elseif($i == 'image_gallery'){
			$params['id'] = null;
			$html .= sc_gallery($params);
		}elseif($i == 'shop' && class_exists( 'WC_Shortcode_Products' )){
			$params['post'] = 0;
			$shortcode = new WC_Shortcode_Products( $params, 'products' );
			$html .= $shortcode->get_content();
		}elseif(!empty($params_content)){
			$html .= $fun_name($params, $params_content);
		}else{
			$output = $fun_name($params);
			if(is_array($output)){
				$html .= $output[0];
				$return['script'] = $output[1];
			}else{
				$html .= $output;
			}

		}

		$html .= '</div>';

		$return['html'] = $html;

		return $return;

	}


	public function mfn_createForm($mfn_items, $a = false, $r = false){

		$a ? $a = $a : $a = 0;
		$r ? $release = $r : $release = 'releaser-first';

		$mfn_fields = new Mfn_Builder_Fields();

		$widgets = $mfn_fields->get_items();
		$wraps = $mfn_fields->get_wrap();
		$sections = $mfn_fields->get_section();


		foreach($mfn_items as $i=>$j){
			$b = 0;
			echo $this->mfn_formElement('uid', $j['uid'], $j['uid'], 'sections['.$a.'][uid]', 'mcb-section-'.$j['uid'], $release);
			foreach ($sections as $x => $section) {
				$val = '';
				if(isset($section['id'])){
					foreach($j['attr'] as $k=>$l){
						if($section['id'] == $k){
							$val = $l;
						}
					}
					echo $this->mfn_formElement($section, $val, $j['uid'], 'sections['.$a.'][attr]['.$section['id'].']', 'mcb-section-'.$j['uid'], $release);
				}else{
					echo $this->mfn_formElement($section, '', $j['uid'], '', 'mcb-section-'.$j['uid'], $release);
				}
			}
			if(isset($j['wraps']) && count($j['wraps']) > 0):
			foreach($j['wraps'] as $m=>$n){
				$c = 0;
				echo $this->mfn_formElement('uid', $n['uid'], $n['uid'], 'sections['.$a.'][wraps]['.$b.'][uid]', 'mcb-wrap-'.$n['uid'], $release);
				echo $this->mfn_formElement('size', $n['size'], $n['uid'], 'sections['.$a.'][wraps]['.$b.'][size]', 'mcb-wrap-'.$n['uid'], $release);
				foreach ($wraps as $y => $wrap) {
					$val = '';
					if(isset($wrap['id'])){
						foreach($n['attr'] as $o=>$p){
							if($wrap['id'] == $o){
								$val = $p;
							}
						}
						echo $this->mfn_formElement($wrap, $val, $n['uid'], 'sections['.$a.'][wraps]['.$b.'][attr]['.$wrap['id'].']', 'mcb-wrap-'.$n['uid'], $release);
					}else{
						echo $this->mfn_formElement($wrap, '', $n['uid'], '', 'mcb-wrap-'.$n['uid'], $release);
					}
				}
				if(isset($n['items']) && is_iterable($n['items']) && count($n['items']) > 0):
					foreach($n['items'] as $q=>$r){
						echo $this->mfn_formElement('uid', $r['uid'], $r['uid'], 'sections['.$a.'][wraps]['.$b.'][items]['.$c.'][uid]', 'mcb-item-'.$r['uid'], $release);

						foreach($widgets[$r['type']] as $z=>$widget){
							foreach($r as $s=>$t){
								if(!is_array($t) && !is_array($widget) && $s == $z){
									echo $this->mfn_formElement($s, $t, $r['uid'], 'sections['.$a.'][wraps]['.$b.'][items]['.$c.']['.$s.']', 'mcb-item-'.$r['uid'], $release, $widgets[$r['type']]['type']);
								}elseif(is_array($t) && is_array($widget)){
									foreach($widget as $f=>$field){
										$wid_val = '';
										if(isset($field['id'])){
											foreach($t as $u=>$v){ if($field['id'] == $u) $wid_val = $v; }
											echo $this->mfn_formElement($field, $wid_val, $r['uid'], 'sections['.$a.'][wraps]['.$b.'][items]['.$c.'][fields]['.$field['id'].']', 'mcb-item-'.$r['uid'], $release, $widgets[$r['type']]['type']);
										}else{
											echo $this->mfn_formElement($field, '', $r['uid'], '', 'mcb-item-'.$r['uid'], $release);
										}
									}
								}
							}
						}
						$c++;
					}
				endif;
				$b++;
			}
			endif;

			$a++;
		}

	}

	public function mfn_formElement($field, $value, $uid, $meta, $t, $r, $n = false){

		// $field - input name
		// $value - input value
		// $uid - uid
		// $meta - name attr
		// $t - type
		// $r - release
		// $n - widget name optional

		if($uid == 'mfnopt'){

			echo '<div class="mfn-form-row mfn-row mfn-vb-formrow mfnopt '.$r.'">';

				if(isset($field['type']) && (!isset($field['row_class']) || $field['row_class'] != 'hidden' ) ):

					if(isset($field['title'])) echo '<label class="form-label">'.$field['title'].'</label>';

					echo '<div class="form-content">';

		     	$field_class = 'MFN_Options_'. $field['type'];

					require_once( get_template_directory() .'/muffin-options/fields/'. $field['type'] .'/field_'. $field['type'] .'.php' );

					if ( class_exists( $field_class ) ) {
						$field_object = new $field_class( $field, $value, 'options' );
						$field_object->render( $meta, true );
					}

					echo '</div>';

				endif;

			echo '</div>';

		}else{

			$rerender_releasers = array(
				'count', 'category', 'category_multi', 'order', 'orderby', 'columns', 'size', 'style', 'open1st', 'openAll', 'title_tag', 'images', 'exclude_id', 'pagination', 'load_more', 'events', 'filters', 'excerpt', 'link', 'link_title', 'in_row', 'timezone', 'date', 'show', 'arrows', 'limit', 'type', 'paginate', 'navigation', 'layer', 'rev', 'hide_photos', 'video', 'parameters', 'line', 'themecolor', 'html5_parameters', 'width', 'height'
			);

			$classes = '';

			$n == 'button' ? $n = 'widget-button' : null;
			$n == 'chart' ? $n = 'widget-chart' : null;
			$n ? $classes .= $n : null;

			$element = explode('-', $t);
			$field_name = '';

			if(isset($field['id'])){
				$field_name = $field['id'];
			}elseif(is_string($field)){
				$field_name = $field;
			}

			if(isset($element[1]) && $element[1] == 'item' && in_array($field_name, $rerender_releasers)){
				$classes .= ' re_render ';
			}

			if(empty($meta) && isset($field['title'])){
				$classes .= ' row-header ';
			}

			$classes .= ' '.$field_name;

			if(isset($field['type']) && $field['type'] == 'html'){

				echo $field['html'];

			}elseif(isset($field['type']) && $field['type'] == 'info'){

				echo '<div class="mfn-vb-formrow mfn-vb-'.$uid.' mfn-type-'.$element[1].'">';

				$field_class = 'MFN_Options_'. $field['type'];

				require_once( get_template_directory() .'/muffin-options/fields/'. $field['type'] .'/field_'. $field['type'] .'.php' );

				if ( class_exists( $field_class ) ) {
					$field_object = new $field_class( $field, $value );
					$field_object->render( $meta );
				}

				echo '</div>';

			}else{

				echo '<div data-name="'.$field_name.'" data-group="mfn-vb-'.$uid.'" data-element="'.$t.'" class="mfn-form-row mfn-row mfn-vb-formrow mfn-vb-'.$uid.' mfn-type-'.$element[1].' '.$classes.' '.$r.'">';

				if(empty($meta) && isset($field['title'])):
					echo '<h5 class="row-header-title">'. wp_kses($field['title'], mfn_allowed_html('title')) .'</h5>';
				elseif(isset($field['type']) && (!isset($field['row_class']) || $field['row_class'] != 'hidden' ) ):

					$field['preview'] = $field_name.'input';

					if(isset($field['title'])) echo '<label class="form-label">'.$field['title'].'</label>';

					echo '<div class="form-content">';

		        	$field_class = 'MFN_Options_'. $field['type'];

					require_once( get_template_directory() .'/muffin-options/fields/'. $field['type'] .'/field_'. $field['type'] .'.php' );

					if ( class_exists( $field_class ) ) {
						$field_object = new $field_class( $field, $value );
						$field_object->render( $meta, true );
					}

					echo '</div>';

				else:

					echo '<input class="'.$field_name.'input mfn-form-control mfn-form-input" type="hidden" name="'.$meta.'" value="'.$value.'">';

				endif;

				echo '</div>';

			}
		}
	}

}
