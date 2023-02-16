<?php
if( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly
}

class Mfn_Builder_Helper {

  /**
   * Unique ID
   * Generate unique ID and check for collisions
   */

  public static function unique_ID($uids = array()){

  	if (function_exists('openssl_random_pseudo_bytes')) {

  		// openssl_random_pseudo_bytes

  		$uid = substr(bin2hex(openssl_random_pseudo_bytes(5)), 0, 9);

  	} else {

  		// fallback

  		$keyspace = '0123456789abcdefghijklmnopqrstuvwxyz';
  		$keyspace_length = 36;
  		$uid = '';

  		for ($i = 0; $i < 9; $i++) {
  			$uid .= $keyspace[rand(0, $keyspace_length - 1)];
      }

  	}

   	if( in_array( $uid, $uids ) ){
   		return self::unique_ID($uids);
   	}

   	return $uid;
  }

  /**
	 * Set new uniqueID for all builder sections, wrap and items
	 * This function also checks for possible collisions
	 */

	public static function unique_ID_reset($data, $uids){

		if (! is_array($data)) {
			return false;
		}

		foreach($data as $section_k => $section){

			$uids[] = self::unique_ID($uids);
			$data[$section_k]['uid'] = end($uids);

			if(is_array($section['wraps'])){
				foreach($section['wraps'] as $wrap_k => $wrap){

					$uids[] = self::unique_ID($uids);
					$data[$section_k]['wraps'][$wrap_k]['uid'] = end($uids);

					if(is_array($wrap['items'])){
						foreach($wrap['items'] as $item_k => $item){

							$uids[] = self::unique_ID($uids);
							$data[$section_k]['wraps'][$wrap_k]['items'][$item_k]['uid'] = end($uids);

						}
					}

				}
			}

		}

		return $data;

	}

  /**
	 * GET current builder uniqueIDs form $_POST
	 */

	public static function get_current_uids(){

		$uids_section = isset( $_POST['mfn-section-id'] ) ? $_POST['mfn-section-id'] : array();
		$uids_wrap = isset( $_POST['mfn-wrap-id'] ) ? $_POST['mfn-wrap-id'] : array();
		$uids_item = isset( $_POST['mfn-item-id'] ) ? $_POST['mfn-item-id'] : array();

		return array_merge( $uids_section, $uids_wrap, $uids_item );

	}

	/**
	 * GET Sliders
	 * Layer Slider
	 * Revolution Slider
	 */

	public static function get_sliders( $plugin = 'rev' ){

		global $wpdb;

		$sliders = array( 0 => esc_html__('-- Select --', 'mfn-opts') );

		if( 'layer' == $plugin ){

			// layer slider

			if (function_exists('layerslider')) {

				$table_prefix = mfn_opts_get('table_prefix', 'base_prefix');
				if ($table_prefix == 'base_prefix') {
					$table_prefix = $wpdb->base_prefix;
				} else {
					$table_prefix = $wpdb->prefix;
				}
				$table_name = $table_prefix . "layerslider";

				$array = $wpdb->get_results($wpdb->prepare("SELECT `id`, `name` FROM `$table_name` WHERE `flag_hidden` = %d AND `flag_deleted` = %d ORDER BY `name` ASC", 0, 0));

				if (is_array($array)) {
					foreach ($array as $v) {
						$sliders[$v->id] = $v->name;
					}
				}
			}

		} else {

			// revolution slider

			if (function_exists('rev_slider_shortcode')) {

				if ( 'base_prefix' == mfn_opts_get('table_prefix', 'base_prefix') ) {
					$table_prefix = $wpdb->base_prefix;
				} else {
					$table_prefix = $wpdb->prefix;
				}
				$table_name = $table_prefix . "revslider_sliders";

				$array = $wpdb->get_results($wpdb->prepare("SELECT `alias`, `title` FROM `$table_name` WHERE `type` != %s ORDER BY `title` ASC", 'template'));

				if (is_array($array)) {
					foreach ($array as $v) {
						$sliders[$v->alias] = $v->title;
					}
				}
			}

		}

		return $sliders;

	}

	/**
	 * Get all revisions for the post
	 */

	public static function get_revisions( $post_id ){

		$array = [
			'autosave' => [],
			'update' => [],
			'revision' => [],
			'backup' => [],
		];

		// $types = ['autosave', 'update', 'revision', 'backup'];

		$date_format = get_option( 'date_format' );
		$time_format = get_option( 'time_format' );

		foreach( $array as $type => $value ){

			$meta_key = $meta_key = 'mfn-builder-revision-'. $type;

			$revisions = get_post_meta( $post_id, $meta_key, true );

			if( is_array( $revisions ) ){
				foreach( $revisions as $rev_key => $rev_val ){
					$array[$type][$rev_key] = date( $date_format .' '. $time_format , $rev_key );
				}
			}

		}

		return $array;

	}

	/**
	 * Allowed HTML for wp_kses in builder preview
	 */

	public static function allowed_html(){

		$allowed = [
			'a' => [
				'href' => [],
			],
			'b' => [],
			'blockquote' => [],
			'br' => [],
			'em' => [],
			'h1' => [],
			'h2' => [],
			'h3' => [],
			'h4' => [],
			'h5' => [],
			'h6' => [],
			'i' => [
				'class' => [],
			],
			'img' => [
				'src' => [],
			],
			'li' => [],
			'ol' => [],
			'p' => [],
			'span' => [],
			'strong' => [],
			'u' => [],
			'ul' => [],
			'table' => [],
			'tr' => [],
			'th' => [
				'colspan' => [],
			],
			'td' => [
				'colspan' => [],
			],
		];

		return $allowed;

	}

	/**
	 * Fiter for: GET builder items
	 */

	public static function filter_builder_get($builder){

		// FIX | Muffin builder 2 compatibility

		if( ( ! $builder ) || is_array($builder) ){
			return $builder;
		}

		return unserialize(call_user_func('base'.'64_decode', $builder));

  }


  public static function sectionTools(){
  	$html = '<a href="#" class="btn-section-add mfn-icon-add-light mfn-section-add siblings prev" data-position="before">Add section</a> <div class="section-header mfn-section-sort-handler mfn-header header-large"> <div class="options-group"> <a class="mfn-option-btn mfn-option-text mfn-option-green btn-large mfn-wrap-add" title="Add wrap" href="#"><span class="mfn-icon mfn-icon-add"></span><span class="text">Wrap</span></a> <a class="mfn-option-btn mfn-option-text mfn-option-green btn-large mfn-wrap-add mfn-divider-add" title="Add divider" href="#"><span class="mfn-icon mfn-icon-add"></span><span class="text">Divider</span></a> </div><div class="options-group"> <a class="mfn-option-btn mfn-option-green btn-large mfn-element-drag mfn-section-drag" title="Drag" href="#"><span class="mfn-icon mfn-icon-drag"></span></a> <a class="mfn-option-btn mfn-option-green btn-large mfn-element-edit" title="Edit" href="#"><span class="mfn-icon mfn-icon-edit"></span></a> <a class="mfn-option-btn mfn-option-green btn-large mfn-module-clone mfn-section-clone" title="Clone" href="#"><span class="mfn-icon mfn-icon-clone"></span></a> <a class="mfn-option-btn mfn-option-green btn-large mfn-element-delete" title="Delete" href="#"><span class="mfn-icon mfn-icon-delete"></span></a> <div class="mfn-option-dropdown"> <a class="mfn-option-btn mfn-option-green btn-large" title="More" href="#"><span class="mfn-icon mfn-icon-more"></span></a> <div class="dropdown-wrapper"> <h6>Actions</h6> <a class="mfn-dropdown-item mfn-section-hide" href="#" data-show="Show section" data-hide="Hide section"><span class="mfn-icon mfn-icon-hide"></span><span class="mfn-icon mfn-icon-show"></span><span class="label">Hide section</span></a> <a class="mfn-dropdown-item mfn-section-move-up" href="#"><span class="mfn-icon mfn-icon-move-up"></span> Move up</a><a class="mfn-dropdown-item mfn-section-move-down" href="#"><span class="mfn-icon mfn-icon-move-down"></span> Move down</a>  <div class="mfn-dropdown-divider"></div><h6>Import / Export</h6> <a class="mfn-dropdown-item mfn-section-export" href="#"><span class="mfn-icon mfn-icon-export"></span> Export section</a> <a class="mfn-dropdown-item mfn-section-import mfn-section-import-before" href="#"><span class="mfn-icon mfn-icon-import-before"></span> Import before</a> <a class="mfn-dropdown-item mfn-section-import mfn-section-import-after" href="#"><span class="mfn-icon mfn-icon-import-before"></span> Import after</a></div></div></div></div>';

  	return $html;
  }

  public static function wrapTools($size){
  	$html = '<div class="wrap-header mfn-header mfn-header-grey">';

  	if($size != 'divider'){
  		$html .= '<a class="mfn-option-btn mfn-option-grey mfn-size-change mfn-size-decrease" title="Decrease" href="#"><span class="mfn-icon mfn-icon-dec"></span></a> <a class="mfn-option-btn mfn-option-grey mfn-size-change mfn-size-increase" title="Increase" href="#"><span class="mfn-icon mfn-icon-inc"></span></a> <a class="mfn-option-btn mfn-option-text mfn-option-grey mfn-wrap-sort-handler" title="Size"><span class="text mfn-element-size-label">'.$size.'</span></a> <a class="mfn-option-btn mfn-option-text btn-icon-left mfn-option-grey mfn-item-add" title="Add item" href="#"><span class="mfn-icon mfn-icon-add"></span><span class="text">Item</span></a>';
  	}

  	$html .= '<a class="mfn-option-btn mfn-option-grey mfn-element-drag mfn-wrap-drag" title="Drag & Drop" href="#"><span class="mfn-icon mfn-icon-drag"></span></a>';

  	if($size != 'divider'){
  		$html .= '<a class="mfn-option-btn mfn-option-grey mfn-element-edit" title="Edit" href="#"><span class="mfn-icon mfn-icon-edit"></span></a>';
  	}

  	$html .= '<a class="mfn-option-btn mfn-option-grey mfn-module-clone mfn-wrap-clone" title="Clone" href="#"><span class="mfn-icon mfn-icon-clone"></span></a> <a class="mfn-option-btn mfn-option-grey mfn-element-delete" title="Delete" href="#"><span class="mfn-icon mfn-icon-delete"></span></a> </div>';

  	return $html;
  }

  public static function itemTools($size){
  	$html = '<div class="item-header mfn-header mfn-header-blue"> <a class="mfn-option-btn mfn-option-blue mfn-size-change mfn-size-decrease" title="Decrease" href="#"><span class="mfn-icon mfn-icon-dec"></span></a> <a class="mfn-option-btn mfn-option-blue mfn-size-change mfn-size-increase" title="Increase" href="#"><span class="mfn-icon mfn-icon-inc"></span></a> <a class="mfn-option-btn mfn-option-text mfn-option-blue" title="Size"><span class="text mfn-element-size-label">'.$size.'</span></a> <a class="mfn-option-btn mfn-option-blue mfn-element-drag mfn-column-drag" title="Drag &amp; Drop" href="#"><span class="mfn-icon mfn-icon-drag"></span></a> <a class="mfn-option-btn mfn-option-blue mfn-element-edit" title="Edit" href="#"><span class="mfn-icon mfn-icon-edit"></span></a> <a class="mfn-option-btn mfn-option-blue mfn-module-clone mfn-element-clone" title="Clone" href="#"><span class="mfn-icon mfn-icon-clone"></span></a> <a class="mfn-option-btn mfn-option-blue mfn-element-delete" title="Delete" href="#"><span class="mfn-icon mfn-icon-delete"></span></a> </div><div class="mfn-drag-helper mfn-dh-before placeholder-column"></div><div class="mfn-drag-helper mfn-dh-after placeholder-column"></div>';

  	return $html;
  }

}
