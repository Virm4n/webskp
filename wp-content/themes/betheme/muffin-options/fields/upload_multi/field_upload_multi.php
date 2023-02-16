<?php
class MFN_Options_upload_multi extends Mfn_Options_field
{

	/**
	 * Render
	 */

	public function render($meta = false, $vb = false )
	{
		$class = false;
		$data = 'image';
		$preview = '';

		// class

		if ( ! $this->value ){
			$class = 'empty';
		}

		// preview

		if ( ! empty( $this->field['preview'] ) ){
			$preview = 'preview-'. $this->field['preview'];
		}

		// output -----

		echo '<div class="form-group browse-image multi '. esc_attr( $class ) .'">';

			echo '<div class="browse-options">';

				echo '<input type="hidden" class="upload-input" '. $this->get_name( $meta ) .' value="'. esc_attr( $this->value ) .'"/>';

				echo '<a href="#" class="mfn-button-upload">'. esc_html__( 'Browse', 'mfn-opts' ) .'</a>';

				echo '<a class="mfn-button-delete-all" title="Delete" href="#">'. esc_html__( 'Delete all', 'mfn-opts' ) .'</a>';

			echo '</div>';

			echo '<ul class="gallery-container clearfix '. esc_attr( $preview ) .'">';

				if ( $this->value ){

					$images = explode( ',', $this->value );

					foreach ( $images as $img_id ) {

						$img_src = wp_get_attachment_image_src( $img_id, 'thumbnail' );
						$img_src = $img_src[0];

						echo '<li class="selected-image">';
							echo '<img data-pic-id="'. esc_attr( $img_id ) .'" src="'. esc_url( $img_src ) .'" />';
							echo '<a class="mfn-option-btn mfn-button-delete" data-tooltip="'. esc_html__( 'Delete', 'mfn-opts' ) .'" href="#"><span class="mfn-icon mfn-icon-delete"></span></a>';
						echo '</li>';

					}

				}

			echo '</ul>';

		echo '</div>';

		echo $this->get_description();

		// enqueue

		// visual builder
		if( ! $vb ){
			$this->enqueue();
		}

	}

	/**
	 * Enqueue
	 */

	public function enqueue()
	{
		wp_enqueue_media();
		wp_enqueue_script( 'mfn-opts-field-upload-multi', MFN_OPTIONS_URI .'fields/upload_multi/field_upload_multi.js', array( 'jquery' ), MFN_THEME_VERSION, true );
	}

}
