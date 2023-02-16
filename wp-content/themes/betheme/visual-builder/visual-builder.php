<?php
if( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly
}

$post_types_disable = mfn_opts_get('post-type-disable');

require_once( get_theme_file_path('/functions/builder/class-mfn-builder-front.php') );
require_once( get_theme_file_path('/functions/builder/class-mfn-builder-items.php') );
require_once(get_theme_file_path('/functions/builder/class-mfn-builder-ajax.php'));
require_once(get_theme_file_path('/functions/builder/pre-built/class-mfn-single-page-import-api.php'));

if ( ! isset( $post_types_disable['portfolio'] ) ) {
	require_once( get_theme_file_path('/functions/post-types/class-mfn-post-type-portfolio.php') );
}
require_once( get_theme_file_path('/functions/post-types/class-mfn-post-type-page.php') );
require_once( get_theme_file_path('/functions/post-types/class-mfn-post-type-post.php') );

require_once( get_theme_file_path('/muffin-options/icons.php') );

require_once( get_theme_file_path('/visual-builder/classes/visual-builder-class.php') );

// admin bar link
add_action( 'admin_bar_menu', 'mfnvb_admin_bar_menu', 100 );

function mfnvb_admin_bar_menu( $admin_bar ){
	if( is_page() ){
		$args = array(
	    'id' => 'mfn-live-builder', // Must be a unique name
	    'title' => 'Edit with Live Builder', // Label for this item
	    'href' => admin_url('/post.php?post='. get_the_ID() .'&action=mfn-live-builder'),
		);
		$admin_bar->add_menu( $args );
	}
}

// old editor link
add_action( 'edit_form_after_title', 'mfnvb_ce_live_button' );

function mfnvb_ce_live_button($post) {
	if(in_array($post->post_type, array('page', 'post', 'portfolio'))){
		if( get_post_status($post->ID) == 'publish' ){
			echo '<div style="float: right; margin: 15px 0;" class="mfn-live-edit-page-button"><a href="' .admin_url('/post.php?post='. $post->ID .'&action=mfn-live-builder'). '" class="mfn-btn mfn-switch-live-editor button-hero mfn-btn-green button button-primary">Edit with Muffin Live Builder</a></div>';
		}else{
			echo '<div style="float: right; margin: 15px 0;" class="mfn-live-edit-page-button"><a href="' .admin_url('/post.php?post='. $post->ID .'&preview=true&action=mfn-live-builder'). '" class="mfn-btn mfn-switch-live-editor button-hero mfn-btn-green button button-primary">Edit with Muffin Live Builder</a></div>';
		}
	}
}

// gutenberg script
add_action( 'enqueue_block_editor_assets', 'mfnvb_gutenberg_functions' );

function mfnvb_gutenberg_functions() {
    wp_enqueue_script(
        'mfn-page-edit-button',
        get_theme_file_uri('/visual-builder/assets/js/button.js'),
        array( 'wp-blocks', 'wp-element', 'wp-block-editor' ),
        time()
    );
}

// add live builder link in admin page table
add_filter( 'post_row_actions', 'mfnvb_list_row_actions', 10, 2 );
add_filter( 'page_row_actions', 'mfnvb_list_row_actions', 10, 2 );

function mfnvb_list_row_actions( $actions, $post ) {
    if ( in_array($post->post_type, array("page", "post", "portfolio")) ) {
 		$actions[] = '<span class="mfn-edit-link"><a href="'.admin_url( 'post.php?post=' . $post->ID . '&action=mfn-live-builder' ).'" aria-label="Edit with Muffin Live Builder">Edit with Muffin Live Builder</a></span>';
    }
    return $actions;
}

// init vb class
add_action( 'post_action_mfn-live-builder', 'mfnvb_init_vb' );

function mfnvb_init_vb($post_id){

	$mfnVisualBuilder = new MfnVisualBuilder();
	$mfnVisualBuilder->mfn_load_sidebar();

	exit();
}

// save draft
add_action( 'wp_ajax_mfnvbsavedraft', 'mfnvb_save_draft'  );

function mfnvb_save_draft(){

	if(!is_user_logged_in()){ wp_die(); }
	check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

	$name = 'Muffin Builder #'.$_POST['id'];
	$slug = sanitize_title($name);

	$my_post = array(
		'ID'			=> $_POST['id'],
	  	'post_title'    => $name,
	  	'post_name'		=> $slug,
	  	'post_type'		=> $_POST['posttype'],
	  	'post_status'   => 'draft',
	);

	// Insert the post into the database
	wp_insert_post( $my_post );

	update_post_meta($_POST['id'], 'mfn-page-items', '');

	wp_die();
}

// take post editing
add_action( 'wp_ajax_takepostediting', 'mfnvb_take_post_editing'  );

function mfnvb_take_post_editing(){

	if(!is_user_logged_in()){ wp_die(); }
	check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

	$request = $_POST;
	$post_id = $request['pageid'];

	wp_set_post_lock( $post_id );

	wp_die();
}

// update view
add_action( 'wp_ajax_updatevbview', 'mfnvb_updateVbView'  );

function mfnvb_updateVbView(){

	if(!is_user_logged_in()){ wp_die(); }
	check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

	$save = array();

	$request = $_POST;
	$post_id = $request['pageid'];

	if( isset($request['savetype']) && in_array($request['savetype'], array('draft', 'publish')) ){
		$mfn_change_poststatus = array(
	      'ID'           => $post_id,
	      'post_status'   => $request['savetype']
		);
		wp_update_post( $mfn_change_poststatus );
	}

	if(isset($request['options']) && count($request['options']) > 0 ){
		foreach($request['options'] as $o=>$opt){
			update_post_meta($post_id, $o, $opt);
		}
	}

	if(isset($request['sections']) && count($request['sections']) > 0 ){

		$sections = $request['sections'];
		ksort($sections);

		if(count($sections) > 0){

			foreach ($sections as $s => $section) {

				if(isset($section['wraps']) && count($section['wraps']) > 0){
					ksort($section['wraps']);
					$sections[$s]['wraps'] = $section['wraps'];

					foreach($section['wraps'] as $w => $wrap){
						if(isset($wrap['items']) && count($wrap['items']) > 0){
							ksort($wrap['items']);
							$sections[$s]['wraps'][$w]['items'] = $wrap['items'];
						}
					}
				}

			}

		}

		$save = wp_unslash($sections);

		$new = call_user_func('base'.'64_encode', serialize($save));
		$old = get_post_meta($post_id, 'mfn-page-items', true);

		if (isset($new) && $new != $old) {
			update_post_meta($post_id, 'mfn-page-items', $new);

			$mfn_ajax = new Mfn_Builder_Ajax();
			$revisions = $mfn_ajax->set_revision( $post_id, 'update', $new );

			wp_send_json( $mfn_ajax->get_revisions_json( $revisions ) );

		} elseif ($old && (! isset($new) || ! $new)) {
			delete_post_meta($post_id, 'mfn-page-items', $old);
		}

	}

	wp_die();
}

// generate preview
add_action( 'wp_ajax_generatepreview', 'mfnvb_generatePreview'  );

function mfnvb_generatePreview(){

	if(!is_user_logged_in()){ wp_die(); }
	check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

	$request = $_POST;
	$post_id = $request['pageid'];
	$type = $request['gtype'];

	$sections = $request['sections'];

	ksort($sections);

	$save = wp_unslash($sections);

	$view = call_user_func('base'.'64_encode', serialize($save));
	update_post_meta($post_id, $type, $view);

	wp_die();
}

// set revision
add_action( 'wp_ajax_setrevision', 'mfnvb_set_revision'  );

function mfnvb_set_revision(){

	if(!is_user_logged_in()){ wp_die(); }
	check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

	$request = $_POST;
	$post_id = $request['pageid'];
	$type = $request['revtype'];

	$sections = $request['sections'];

	ksort($sections);

	$save = wp_unslash($sections);

	$new = call_user_func('base'.'64_encode', serialize($save));

	$mfn_ajax = new Mfn_Builder_Ajax();
	$revisions = $mfn_ajax->set_revision( $post_id, $type, $new );

	wp_send_json( $mfn_ajax->get_revisions_json( $revisions ) );

	wp_die();
}

// copy to clipboard

add_action( 'wp_ajax_mfntoclipboard', 'mfnvb_copytoclipboard'  );

function mfnvb_copytoclipboard(){

	if(!is_user_logged_in()){ wp_die(); }
	check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

	$save = wp_unslash( $_POST['sections'] );

	$view = call_user_func('base'.'64_encode', serialize($save));

	echo $view;

	wp_die();
}


// restore revision
add_action( 'wp_ajax_restorerevision', 'mfnvb_restore_revision'  );

function mfnvb_restore_revision(){

	if(!is_user_logged_in()){ wp_die(); }
	check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

	$uids = [];
	$return = array();

	$time = htmlspecialchars(trim($_POST['time']));
	$type = htmlspecialchars(trim($_POST['type']));
	$post_id = htmlspecialchars(trim($_POST['pageid']));

	if( ! $post_id || ! $time || ! $type ){
		return false;
	}

	$old = get_post_meta($post_id, 'mfn-page-items', true);

	// backup current version
	$mfn_ajax = new Mfn_Builder_Ajax();
	$revisions = $mfn_ajax->set_revision( $post_id, 'backup', $old );
	$return['revisions'] = $mfn_ajax->get_revisions_json( $revisions );

	$meta_key = 'mfn-builder-revision-'. $type;

	$revision_torestore = get_post_meta( $post_id, $meta_key, true );

	if( ! empty( $revision_torestore[$time] ) ){

		// unserialize backup

		$mfn_items = unserialize(call_user_func('base'.'64_decode', $revision_torestore[$time]));

		if ( is_array( $mfn_items ) ) {

			$mfn_items = Mfn_Builder_Helper::unique_ID_reset($mfn_items, $uids);

			ob_start();

			$mfnvb = new MfnVisualBuilder();
			$mfnvb->mfn_createForm($mfn_items);

			$form = ob_get_contents();

			ob_end_clean();

			ob_start();

			$front = new Mfn_Builder_Front($post_id);
			$front->show($mfn_items);

			$html = ob_get_contents();

			ob_end_clean();

			$return['html'] = $html;
			$return['form'] = $form;

			wp_send_json($return);

		}

	}


	wp_die();
}

// add new section
add_action( 'wp_ajax_addnewsection', 'mfnvb_newSection');

function mfnvb_newSection(){

	if(!is_user_logged_in()){ wp_die(); }
	check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );


	$count = $_POST['count']++;
	$releaser = $_POST['releaser'];

	$mfnvb = new MfnVisualBuilder();
	$return = $mfnvb->mfn_appendNewSection($count, $releaser);

	wp_send_json($return);
	wp_die();
}

// add new wrap
add_action( 'wp_ajax_addnewwrap', 'mfnvb_newWrap'  );

function mfnvb_newWrap(){

	if(!is_user_logged_in()){ wp_die(); }
	check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

	$count = $_POST['count']++;
	$section = $_POST['section'];
	$releaser = $_POST['releaser'];
	$divider = $_POST['is_divider'];

	$mfnvb = new MfnVisualBuilder();
	$return = $mfnvb->mfn_appendNewWrap($count, $section, $releaser, $divider);

	wp_send_json($return);
	wp_die();
}

// add new wrap layout
add_action( 'wp_ajax_addwraplayout', 'mfnvb_newWrapLayout'  );

function mfnvb_newWrapLayout(){

	if(!is_user_logged_in()){ wp_die(); }
	check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

	$type = $_POST['type'];
	$section = $_POST['section'];
	$releaser = $_POST['releaser'];

	$mfnvb = new MfnVisualBuilder();
	$return = $mfnvb->mfn_appendWrapLayout($type, $section, $releaser);

	wp_send_json($return);
	wp_die();
}

// add new widget
add_action( 'wp_ajax_addnewwidget', 'mfnvb_newWidget'  );

function mfnvb_newWidget(){

	if(!is_user_logged_in()){ wp_die(); }
	check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

	$count = $_POST['count']++;
	$section = $_POST['section'];
	$wrap = $_POST['wrap'];
	$size = $_POST['size'];
	$item = $_POST['item'];
	$releaser = $_POST['releaser'];
	$pageid = $_POST['pageid'];

	$mfnvb = new MfnVisualBuilder();

	$return = $mfnvb->mfn_appendNewWidget($count, $section, $wrap, $item, $releaser, $size, $pageid);

	wp_send_json($return);
	wp_die();
}

// re render content
add_action('wp_ajax_rendercontent', 'mfnvb_contentrender');

function mfnvb_contentrender(){

	if(!is_user_logged_in()){ wp_die(); }
	check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

	$val = wp_unslash($_POST['val']);
	wp_send_json(do_shortcode($val, true));

	wp_die();
}

// re render widget
add_action('wp_ajax_rerenderwidget', 'mfnvb_render_widget');

function mfnvb_render_widget(){
	if(!is_user_logged_in()){ wp_die(); }
	check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

	$type = $_POST['type'];
	$attr = $_POST['attri'];
	$content = '';

	if(isset($attr['tabs']) && count($attr['tabs']) > 0){
		foreach ($attr['tabs'] as $t=>$tab) {
			if(isset($tab['content'])){
				$attr['tabs'][$t]['content'] = wp_unslash( $tab['content'] );
			}
		}
	}

	$fun_name = 'sc_'.$type;

	if(!empty($attr['content'])){
		$content = $attr['content'];
		wp_send_json($fun_name($attr, $content));
	}elseif($type == 'slider_plugin'){
		wp_send_json('<div class="mfn-widget-placeholder mfn-wp-revolution"></div>');
	}elseif($type == 'image_gallery'){
		wp_send_json(sc_gallery($attr));
	}elseif($type == 'shop' && class_exists( 'WC_Shortcode_Products' )){
		$shortcode = new WC_Shortcode_Products( $attr, $attr['type'] );
		wp_send_json($shortcode->get_content());
	}else{
		wp_send_json($fun_name($attr));
	}

	wp_die();
}

// import data
add_action('wp_ajax_importdata', 'mfnvb_import_data');

function mfnvb_import_data(){
	if(!is_user_logged_in()){ wp_die(); }
	check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

	$request = $_POST;
	$post_id = $request['pageid'];

	$new = $request['import'];
	$old = get_post_meta($post_id, 'mfn-page-items', true);

	$current_items = unserialize(call_user_func('base'.'64_decode', $old));
	$new_items = unserialize(call_user_func('base'.'64_decode', $new));

	if($request['type'] == 'before'){
		$merge = array_merge($new_items, $current_items);
	}else if($request['type'] == 'after'){
		$merge = array_merge($current_items, $new_items);
	}else{
		$merge = $new_items;
	}

	$save = call_user_func('base'.'64_encode', serialize(wp_unslash($merge)));

	update_post_meta($post_id, 'mfn-page-items', $save);

	wp_die();
}

// import single page
add_action('wp_ajax_importsinglepage', 'mfnvb_import_single_page');

function mfnvb_import_single_page(){
	if(!is_user_logged_in()){ wp_die(); }
	check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

	$request = $_POST;
	$post_id = $request['pageid'];
	$page = $request['import'];
	$count = $_POST['count'];
	$releaser = $_POST['release'];


	$pages_api = new Mfn_Single_Page_Import_API( $page );
	$response = $pages_api->remote_get_page();

	if( ! $response ){

		_e( 'Remote API error.', 'mfn-opts' );

	} elseif( is_wp_error( $response ) ){

		echo $response->get_error_message();

	} else {

		// unserialize response

		$mfn_items = unserialize(call_user_func('base'.'64_decode', $response));

		if( ! is_array( $mfn_items ) ){
			return false;
		}

		// remove images url

		$builderajax = new Mfn_Builder_Ajax();

		$regex = '/http(.*)\.(png|jpg|jpeg|gif|svg|webp|mp4)/m';
		$mfn_items = $builderajax->builder_replace( $regex, '', $mfn_items );

		// get current builder uniqueIDs

		$uids = [];

		// reset uniqueID

		$mfn_items = Mfn_Builder_Helper::unique_ID_reset( $mfn_items, $uids );

		if ( is_array( $mfn_items ) ) {

			ob_start();

			$mfnvb = new MfnVisualBuilder();
			$mfnvb->mfn_createForm($mfn_items, $count, $releaser);

			$form = ob_get_contents();

			ob_end_clean();

			ob_start();

			$front = new Mfn_Builder_Front($id);
			$front->show($mfn_items);

			$html = ob_get_contents();

			ob_end_clean();

			$return['html'] = $html;
			$return['form'] = $form;

			wp_send_json($return);

		}

	}


	wp_die();
}

// import template
add_action('wp_ajax_importtemplate', 'mfnvb_import_template');

function mfnvb_import_template(){
	if(!is_user_logged_in()){ wp_die(); }
	check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

	$request = $_POST;
	$post_id = $request['pageid'];

	$new = get_post_meta($request['import'], 'mfn-page-items', true);
	$old = get_post_meta($post_id, 'mfn-page-items', true);

	$current_items = unserialize(call_user_func('base'.'64_decode', $old));
	$new_items = unserialize(call_user_func('base'.'64_decode', $new));

	if($request['type'] == 'before'){
		$merge = array_merge($new_items, $current_items);
	}else if($request['type'] == 'after'){
		$merge = array_merge($current_items, $new_items);
	}else{
		$merge = $new_items;
	}

	$save = call_user_func('base'.'64_encode', serialize(wp_unslash($merge)));

	update_post_meta($post_id, 'mfn-page-items', $save);

	wp_die();
}

// insert prebuilt
add_action('wp_ajax_insertprebuilt', 'mfnvb_insert_prebuilt');

function mfnvb_insert_prebuilt(){
	if(!is_user_logged_in()){ wp_die(); }


	$count = $_POST['count']++;
	$releaser = $_POST['release'];
	$id = $_POST['id'];

	check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

	$return = array();

	if( ! $id ){
		return false;
	}

	$mfn_helper = new Mfn_Builder_Helper();

	$sections_api = new Mfn_Pre_Built_Sections_API( $id );
	$response = $sections_api->remote_get_section();

	if( ! $response ){

		_e( 'Remote API error.', 'mfn-opts' );

	} elseif( is_wp_error( $response ) ){

		echo $response->get_error_message();

	} else {

		$uids = $mfn_helper->get_current_uids();

		$mfn_items = unserialize(call_user_func('base'.'64_decode', $response));

		if( ! is_array( $mfn_items ) ) return false;

		$placeholder_url = get_template_directory_uri() .'/functions/builder/pre-built/images/placeholders/';

		$mfn_ajax = new Mfn_Builder_Ajax();

		$mfn_items = $mfn_ajax->builder_replace( '#mfn_placeholder#', $placeholder_url, $mfn_items );
		$mfn_items = $mfn_helper->unique_ID_reset($mfn_items, $uids);

		ob_start();

		$mfnvb = new MfnVisualBuilder();
		$mfnvb->mfn_createForm($mfn_items, $count, $releaser);

		$form = ob_get_contents();

		ob_end_clean();

		ob_start();

		$front = new Mfn_Builder_Front($id);
		$front->show($mfn_items);

		$html = ob_get_contents();

		ob_end_clean();

		$return['html'] = $html;
		$return['form'] = $form;

		wp_send_json($return);

	}

	wp_die();
}


// import from clipboard
add_action('wp_ajax_importfromclipboard', 'mfnvb_importfromclipboard');

function mfnvb_importfromclipboard(){
	if(!is_user_logged_in()){ wp_die(); }
	check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

	$return = array();

	$mfn_helper = new Mfn_Builder_Helper();
	$id = $_POST['id'];
	$count = $_POST['count'];
	$releaser = $_POST['release'];

		$uids = $mfn_helper->get_current_uids();

		$mfn_items = unserialize( call_user_func('base'.'64_decode', $_POST['import']) );

		if( ! is_array( $mfn_items ) ) return false;

		$mfn_ajax = new Mfn_Builder_Ajax();

		$mfn_items = $mfn_helper->unique_ID_reset($mfn_items, $uids);

		ob_start();

		$mfnvb = new MfnVisualBuilder();
		$mfnvb->mfn_createForm($mfn_items, $count, $releaser);

		$form = ob_get_contents();

		ob_end_clean();

		ob_start();

		$front = new Mfn_Builder_Front($id);
		$front->show($mfn_items);

		$html = ob_get_contents();

		ob_end_clean();

		$return['html'] = $html;
		$return['form'] = $form;

		wp_send_json($return);

	wp_die();
}

?>
