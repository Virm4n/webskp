<?php
/**
 * Finix ACF Functions
 *
 * @package Finix
 * @subpackage finix
 * @since finix 1.0
 */

function finix_acf_get( $array, $key, $default = null ) {
	$keys = explode( '/', $key );
	foreach ( $keys as $k ) {
		if ( ! isset( $array[ $k ] ) ) {

			return $default;

		}
		$array = $array[ $k ];

	}
	return $array;

}

function finix_get_attachment( $post ) {

	$post = get_post( $post );

	if ( ! $post ) {
		return false;
	}

	$thumb_id = 0;
	$id       = $post->ID;
	$a        = array(
		'ID'          => $id,
		'id'          => $id,
		'title'       => $post->post_title,
		'filename'    => wp_basename( $post->guid ),
		'url'         => wp_get_attachment_url( $id ),
		'alt'         => get_post_meta( $id, '_wp_attachment_image_alt', true ),
		'author'      => $post->post_author,
		'description' => $post->post_content,
		'caption'     => $post->post_excerpt,
		'name'        => $post->post_name,
		'date'        => $post->post_date_gmt,
		'modified'    => $post->post_modified_gmt,
		'mime_type'   => $post->post_mime_type,
		'type'        => finix_acf_get( explode( '/', $post->post_mime_type ), 0, '' ),
		'icon'        => wp_mime_type_icon( $id ),
	);

	if ( 'image' === $a['type'] ) {

		$thumb_id = $id;
		$src      = wp_get_attachment_image_src( $id, 'full' );

		$a['url']    = $src[0];
		$a['width']  = $src[1];
		$a['height'] = $src[2];

	} elseif ( 'audio' === $a['type'] || 'video' === $a['type'] ) {

		if ( 'video' === $a['type'] ) {

			$meta        = wp_get_attachment_metadata( $id );
			$a['width']  = finix_acf_get( $meta, 'width', 0 );
			$a['height'] = finix_acf_get( $meta, 'height', 0 );

		}

		$featured_id = get_post_thumbnail_id( $id );
		if ( $featured_id ) {

			$thumb_id = $featured_id;

		}
	}

	if ( $thumb_id ) {

		$sizes = get_intermediate_image_sizes();
		if ( $sizes ) {

			$a['sizes'] = array();

			foreach ( $sizes as $size ) {

				$src = wp_get_attachment_image_src( $thumb_id, $size );

				$a['sizes'][ $size ]             = $src[0];
				$a['sizes'][ $size . '-width' ]  = $src[1];
				$a['sizes'][ $size . '-height' ] = $src[2];
			}
		}
	}
	return $a;

}
