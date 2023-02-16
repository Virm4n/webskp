<?php
/**
 * Muffin Builder | Ajax actions
 *
 * @package Betheme
 * @author Muffin group
 * @link https://muffingroup.com
 */

if( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly
}

class Mfn_Builder_Ajax {

	/**
	 * Constructor
	 */

	public function __construct() {

		// handle custom AJAX endpoint

		add_action( 'wp_ajax_mfn_builder_seo', array( $this, '_seo' ) );
		add_action( 'wp_ajax_mfn_builder_export', array( $this, '_export' ) );
		add_action( 'wp_ajax_mfn_builder_import', array( $this, '_import' ) );
		add_action( 'wp_ajax_mfn_builder_import_page', array( $this, '_import_page' ) );
		add_action( 'wp_ajax_mfn_builder_template', array( $this, '_template' ) );
		add_action( 'wp_ajax_mfn_builder_settings', array( $this, '_settings' ) );
		add_action( 'wp_ajax_mfn_builder_revision_restore', array( $this, '_revision_restore' ) );
		add_action( 'wp_ajax_mfn_builder_pre_built_section', array( $this, '_pre_built_section' ) );

	}

	/**
	 * Copy builder content to WP Editor where it is useful for SEO plugins like Yoast
	 */

	public function _seo() {

		// function verifies the AJAX request, to prevent any processing of requests which are passed in by third-party sites or systems

		check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

		if (key_exists('mfn-item-type', $_POST) && is_array($_POST['mfn-item-type'])) {

			$count = [];
			$seo_content = '';

			foreach ($_POST['mfn-item-type'] as $type_k => $type) {

				$item = array(
					'type' => $type,
					'uid' => $_POST['mfn-item-id'][$type_k],
					'size' => $_POST['mfn-item-size'][$type_k],
				);

				// init count for specified item type

				if ( empty( $count[$type] ) ){
					$count[$type] = 0;
				}

				if ( isset( $_POST['mfn-items'][$type] ) && is_array( $_POST['mfn-items'][$type] ) ) {
					foreach ( $_POST['mfn-items'][$type] as $attr_k => $attr ) {

						if ( 'tabs' == $attr_k ) {

							// field type: TABS

							$item_tabs = $attr[ $item['uid'] ];
							$tabs = [];

							foreach( $item_tabs as $tab_key => $tab_fields ){
								foreach( $tab_fields as $tab_index => $tab_field ){

									$value = stripslashes( $tab_field );

									if ( ! mfn_opts_get( 'builder-storage' ) ) {
										// core.trac.wordpress.org/ticket/34845
										$value = preg_replace( '~\R~u', "\n", $value );
									}

									$tabs[$tab_index][$tab_key] = $value;

									// FIX | Yoast SEO

									$seo_val = trim( $value );
									if ( $seo_val && $seo_val !== '1' ) {
										$seo_content .= $seo_val ."\n";
									}

								}
							}

							$item['fields']['tabs'] = $tabs;

						} else {

							// all other field types

							$value = stripslashes( $attr[$count[$type]] );

							$seo_val = trim( $value );

							if ( $seo_val && intval( $seo_val ) !== 1 ) {

								if ( in_array( $attr_k, array( 'image', 'src' ) ) ) {
									$seo_content .= '<img src="'. esc_url( $seo_val ) .'" alt="'. mfn_get_attachment_data($seo_val, 'alt') .'"/>'."\n";
								} elseif ( 'link' == $attr_k ) {
									$seo_content .= '<a href="'. esc_url( $seo_val ) .'">'. $seo_val .'</a>'."\n";
								} else {
									$seo_content .= $seo_val ."\n";
								}

							}

						}
					}

					$seo_content .= "\n";
				}

				$count[$type] ++;
			}
		}

		$allowed_html = array(
			'a' => array(
				'href' => array(),
				'target' => array(),
				'title' => array(),
			),
			'h1' => array(),
			'h2' => array(),
			'h3' => array(),
			'h4' => array(),
			'h5' => array(),
			'h6' => array(),
			'img' => array(
				'src' => array(),
				'alt' => array(),
			),
		);

		echo wp_kses( $seo_content, $allowed_html );

		exit;

	}

	/**
	 * Export builder content as serialized string
	 * Accepts Muffin Builder items and converts it to serialized string
	 */

	public function _export(){

		// function verifies the AJAX request, to prevent any processing of requests which are passed in by third-party sites or systems

		check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

		// variables

		$mfn_items = array();
		$mfn_wraps = array();

		// LOOP sections

		if ( isset( $_POST['mfn-section-id'] ) && is_array( $_POST['mfn-section-id'] ) ) {

			foreach ( $_POST['mfn-section-id'] as $sectionID_k => $sectionID ) {

				$section = array();

				$section['uid'] = $_POST['mfn-section-id'][$sectionID_k];

				// $section['attr'] - section attributes

				if (key_exists('mfn-sections', $_POST) && is_array($_POST['mfn-sections'])) {
					foreach ($_POST['mfn-sections'] as $section_attr_k => $section_attr) {
						$section['attr'][$section_attr_k] = stripslashes($section_attr[$sectionID_k]);
					}
				}

				$section['wraps'] = ''; // $section['wraps'] - section wraps will be added in next loop

				$mfn_items[] = $section;
			}

			$section_IDs = $_POST['mfn-section-id'];
			$section_IDs_key = array_flip($section_IDs);
		}

		// LOOP wraps

		if ( isset( $_POST['mfn-wrap-id'] ) && is_array( $_POST['mfn-wrap-id'] ) ) {

			foreach ($_POST['mfn-wrap-id'] as $wrapID_k => $wrapID) {

				$wrap = array();

				$wrap['uid'] = $_POST['mfn-wrap-id'][$wrapID_k];
				$wrap['size'] = $_POST['mfn-wrap-size'][$wrapID_k];
				$wrap['items'] = ''; // $wrap['items'] - items will be added in the next loop

				// $wrap['attr'] - wrap attributes

				if (key_exists('mfn-wraps', $_POST) && is_array($_POST['mfn-wraps'])) {
					foreach ($_POST['mfn-wraps'] as $wrap_attr_k => $wrap_attr) {
						$wrap['attr'][$wrap_attr_k] = $wrap_attr[$wrapID_k];
					}
				}

				$mfn_wraps[$wrapID] = $wrap;
			}

			$wrap_IDs = $_POST['mfn-wrap-id'];
			$wrap_IDs_key = array_flip($wrap_IDs);
			$wrap_parents = $_POST['mfn-wrap-parent'];
		}

		// LOOP items

		if ( isset( $_POST['mfn-item-type'] ) && is_array( $_POST['mfn-item-type'] ) ) {

			$count = [];

			foreach ( $_POST['mfn-item-type'] as $type_k => $type ) {

				$item = array(
					'type' => $type,
					'uid' => $_POST['mfn-item-id'][$type_k],
					'size' => $_POST['mfn-item-size'][$type_k],
				);

				// init count for specified item type

				if ( empty( $count[$type] ) ){
					$count[$type] = 0;
				}

				if ( isset( $_POST['mfn-items'][$type] ) && is_array( $_POST['mfn-items'][$type] ) ) {
					foreach ( $_POST['mfn-items'][$type] as $attr_k => $attr ) {

						// field type: TABS

						if ( 'tabs' == $attr_k ) {

							$item_tabs = $attr[ $item['uid'] ];
							$tabs = [];

							foreach( $item_tabs as $tab_key => $tab_fields ){
								foreach( $tab_fields as $tab_index => $tab_field ){

									$value = stripslashes( $tab_field );

									if ( ! mfn_opts_get( 'builder-storage' ) ) {
										// core.trac.wordpress.org/ticket/34845
										$value = preg_replace( '~\R~u', "\n", $value );
									}

									$tabs[$tab_index][$tab_key] = $value;

								}
							}

							$item['fields']['tabs'] = $tabs;

						} else {

							// all other field types

							$value = stripslashes( $attr[$count[$type]] );
							$item['fields'][$attr_k] = $value;

						}
					}

				}

				// increase count for specified item type

				$count[$type] ++;

				// parent wrap

				$parent_wrap_ID = $_POST['mfn-item-parent'][ $type_k ];

				if ( ! isset( $mfn_wraps[ $parent_wrap_ID ]['items'] ) || ! is_array( $mfn_wraps[ $parent_wrap_ID ]['items'] ) ) {
					$mfn_wraps[ $parent_wrap_ID ]['items'] = array();
				}

				$mfn_wraps[ $parent_wrap_ID ]['items'][] = $item;
			}
		}

		// assign wraps with items to sections

		foreach ( $mfn_wraps as $wrap_ID => $wrap ) {

			$wrap_key = $wrap_IDs_key[ $wrap_ID ];
			$section_ID = $wrap_parents[ $wrap_key ];
			$section_key = $section_IDs_key[ $section_ID ];

			if (! isset($mfn_items[ $section_key ]['wraps']) || ! is_array($mfn_items[ $section_key ]['wraps'])) {
				$mfn_items[ $section_key ]['wraps'] = array();
			}
			$mfn_items[ $section_key ]['wraps'][] = $wrap;

		}

		// prepare data to save

		if ( $mfn_items ) {

			$mfn_items = call_user_func('base'.'64_encode', serialize($mfn_items));

			// PREVIEW

			if( ! empty( $_POST['preview'] ) ){
				update_post_meta( $_POST['preview'], 'mfn-builder-preview', $mfn_items );
			}

			// REVISION

			if( ! empty( $_POST['revision-type'] ) ){

				$type = htmlspecialchars(trim($_POST['revision-type']));
				$id = htmlspecialchars(trim($_POST['post-id']));

				$revisions = $this->set_revision( $id, $type, $mfn_items );
				echo $this->get_revisions_json( $revisions );

				exit;

			}

			print_r( $mfn_items );

		}

		exit;

	}

	/**
	 * Import builder content.
	 * Accepts serialized string and converts it to Muffin Builder items
	 */

	public function _import() {

		// function verifies the AJAX request, to prevent any processing of requests which are passed in by third-party sites or systems

		check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

		$import = htmlspecialchars(stripslashes($_POST['mfn-items-import']));

		if (! $import) {
			exit;
		}

		// unserialize received items data

		$mfn_items = unserialize(call_user_func('base'.'64_decode', $import));

		// get current builder uniqueIDs

		$uids = Mfn_Builder_Helper::get_current_uids();

		// reset uniqueID

		$mfn_items = Mfn_Builder_Helper::unique_ID_reset($mfn_items, $uids);

		if ( is_array( $mfn_items ) ) {

			$builder = new Mfn_Builder_Admin( 'ajax' );
			$builder->set_fields();

			foreach ( $mfn_items as $section ) {
				$uids = $builder->section( $section, $uids );
			}

		}

		exit;

	}

	/**
	 * Import template
	 * Get builder content from target page and converts it to Muffin Builder items
	 */

	public function _template() {

		// function verifies the AJAX request, to prevent any processing of requests which are passed in by third-party sites or systems

		check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

		$id = intval( $_POST['mfn-items-import-template'], 10 );

		if ( ! $id ) {
			exit;
		}

		// unserialize received items data

		$mfn_items = get_post_meta( $id, 'mfn-page-items', true );

		if ( ! $mfn_items ){
			exit;
		}

		if ( ! is_array( $mfn_items ) ) {
			$mfn_items = unserialize(call_user_func('base'.'64_decode', $mfn_items));
		}

		// get current builder uniqueIDs

		$uids = Mfn_Builder_Helper::get_current_uids();

		// reset uniqueID

		$mfn_items = Mfn_Builder_Helper::unique_ID_reset( $mfn_items, $uids );

		if ( is_array( $mfn_items ) ) {

			$builder = new Mfn_Builder_Admin( 'ajax' );
			$builder->set_fields();

			foreach ( $mfn_items as $section ) {
				$uids = $builder->section( $section, $uids );
			}

		}

		exit;

	}

	/**
	 * Builder settings
	 */

	public function _settings(){

		// function verifies the AJAX request, to prevent any processing of requests which are passed in by third-party sites or systems

		check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

		$option = htmlspecialchars(trim($_POST['option']));
		$value = htmlspecialchars(trim($_POST['value']));

		if( ! $option ){
			return false;
		}

		$options = get_site_option( 'betheme-builder' );

		if( ! $options ){
			$options = [];
		}

		$options[$option] = $value;

		update_site_option( 'betheme-builder', $options );

		echo 1;

		exit;

	}

	/**
	 * Builder settings
	 */

	public function _revision_restore(){

		$uids = [];

		// function verifies the AJAX request, to prevent any processing of requests which are passed in by third-party sites or systems

		check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

		$time = htmlspecialchars(trim($_POST['time']));
		$type = htmlspecialchars(trim($_POST['type']));
		$post_id = htmlspecialchars(trim($_POST['post_id']));

		if( ! $post_id || ! $time || ! $type ){
			return false;
		}

		$meta_key = 'mfn-builder-revision-'. $type;

		$revisions = get_post_meta( $post_id, $meta_key, true );

		if( ! empty( $revisions[$time] ) ){

			// unserialize backup

			$mfn_items = unserialize(call_user_func('base'.'64_decode', $revisions[$time]));

			// reset uniqueID

			$mfn_items = Mfn_Builder_Helper::unique_ID_reset($mfn_items, $uids);

			if ( is_array( $mfn_items ) ) {

				$builder = new Mfn_Builder_Admin( 'ajax' );
				$builder->set_fields();

				foreach ( $mfn_items as $section ) {
					$uids = $builder->section( $section, $uids );
				}

			}

		}

		exit;

	}

	/**
	 * Save builder content as revision
	 */

	public function set_revision( $post_id, $type, $mfn_items ){

		if( ! $post_id || ! $type || ! $mfn_items ){
			return false;
		}

		$meta_key = 'mfn-builder-revision-'. $type;

		$revisions = get_post_meta( $post_id, $meta_key, true );

		if( $revisions ){

			// revisions limit = 5

			if( count( $revisions ) >= 5 ){
				reset( $revisions );
				$rev_key = key( $revisions );
				unset( $revisions[$rev_key] );
			}

		} else {

			$revisions = [];

		}

		$time = time();

		$revisions[$time] = $mfn_items;

		update_post_meta( $post_id, $meta_key, $revisions );

		return $revisions;
	}

	/**
	 * Get revisions in json format
	 */

	public function get_revisions_json( $revisions ){

		if( ! is_array( $revisions ) ){
			return false;
		}

		$date_format = get_option( 'date_format' );
		$time_format = get_option( 'time_format' );

		$json = [];

		foreach( $revisions as $rev_key => $rev_val ){
			$json[$rev_key] = date( $date_format .' '. $time_format , $rev_key );
		}

		return json_encode($json);
	}

	/**
	 * Pre-built sections
	 */

	public function _pre_built_section(){

		// function verifies the AJAX request, to prevent any processing of requests which are passed in by third-party sites or systems

		check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

		$id = intval( $_POST['id'] );

		if( ! $id ){
			return false;
		}

		$sections_api = new Mfn_Pre_Built_Sections_API( $id );
		$response = $sections_api->remote_get_section();

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

			// change images url

			$placeholder_url = get_template_directory_uri() .'/functions/builder/pre-built/images/placeholders/';

			$regex = '/\#mfn_placeholder\#/';
			$mfn_items = $this->builder_replace( $regex, $placeholder_url, $mfn_items );

			// get current builder uniqueIDs

			$uids = [];

			// reset uniqueID

			$mfn_items = Mfn_Builder_Helper::unique_ID_reset( $mfn_items, $uids );

			if ( is_array( $mfn_items ) ) {

				$builder = new Mfn_Builder_Admin( 'ajax' );
				$builder->set_fields();

				foreach ( $mfn_items as $section ) {
					$uids = $builder->section( $section, $uids );
				}

			}

		}

		exit;

	}

	/**
	 * Import single page
	 */

	public function _import_page(){

		// function verifies the AJAX request, to prevent any processing of requests which are passed in by third-party sites or systems

		check_ajax_referer( 'mfn-builder-nonce', 'mfn-builder-nonce' );

		$page = esc_url( $_POST['mfn-items-import-page'] );

		if( ! $page ){
			return false;
		}

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

			$regex = '/http(.*)\.(png|jpg|jpeg|gif|svg|webp|mp4)/m';
			$mfn_items = $this->builder_replace( $regex, '', $mfn_items );

			// get current builder uniqueIDs

			$uids = [];

			// reset uniqueID

			$mfn_items = Mfn_Builder_Helper::unique_ID_reset( $mfn_items, $uids );

			if ( is_array( $mfn_items ) ) {

				$builder = new Mfn_Builder_Admin( 'ajax' );
				$builder->set_fields();

				foreach ( $mfn_items as $section ) {
					$uids = $builder->section( $section, $uids );
				}

			}

		}

		exit;

	}

	/**
	 * Replace Builder URLs
	 */

	public function builder_replace( $search, $replace, $subject ){

		// sections

		foreach( $subject as $section_key => $section ){

			// attributes

			if( ! empty( $section['attr'] ) ){
				foreach( $section['attr'] as $attribute_key => $attribute ){
					$attribute = preg_replace( $search, $replace, $attribute );
					$subject[$section_key]['attr'][$attribute_key] = $attribute;
				}
			}

			// FIX | Muffin Builder 2 compatibility
			// there were no wraps inside section in Muffin Builder 2

			if( ! isset( $section['wraps'] ) && is_array( $section['items'] ) ){

				$fix_wrap = array(
					'size' => '1/1',
					'uid' => Mfn_Builder_Helper::unique_ID(),
					'items'	=> $section['items'],
				);

				$section['wraps'] = array( $fix_wrap );

				$subject[$section_key]['wraps'] = $section['wraps'];
				unset( $subject[$section_key]['items'] );

			}

			// wraps

			if( ! empty( $section['wraps'] ) ){
				foreach( $section['wraps'] as $wrap_key => $wrap ){

					// attributes

					if( ! empty( $wrap['attr'] ) ){
						foreach( $wrap['attr'] as $attribute_key => $attribute ){
							$attribute = preg_replace( $search, $replace, $attribute );
							$subject[$section_key]['wraps'][$wrap_key]['attr'][$attribute_key] = $attribute;
						}
					}

					// items

					if( ! empty( $wrap['items'] ) ){
						foreach( $wrap['items'] as $item_key => $item ){

							// fields

							if( ! empty( $item['fields'] ) ){
								foreach( $item['fields'] as $field_key => $field ){
									$field = preg_replace( $search, $replace, $field );
									$subject[$section_key]['wraps'][$wrap_key]['items'][$item_key]['fields'][$field_key] = $field;
								}
							}

						}
					}

				}
			}

		}

		return $subject;

	}

}

$mfn_builder_ajax = new Mfn_Builder_Ajax();
