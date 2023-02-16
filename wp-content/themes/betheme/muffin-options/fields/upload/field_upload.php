<?php
class MFN_Options_upload extends Mfn_Options_field
{

	/**
	 * Render
	 */

	public function render( $meta = false, $vb = false )
	{
		$class = false;
		$data = 'image';
		$preview = '';

		// class

		if ( ! $this->value ){
			$class = 'empty';
		}

		// data

		if ( ! empty( $this->field['data'] ) ){
			$data = $this->field['data'];
		}

		// preview

		if ( ! empty( $this->field['preview'] ) ){
			$preview = 'preview-'. $this->field['preview'];
		}

		// output -----

		echo '<div class="form-group browse-image has-addons has-addons-append '. esc_attr( $class ) .'">';

			echo '<div class="form-control has-icon has-icon-right">';
				echo '<input class="mfn-form-control mfn-form-input '. esc_attr( $preview ) .'" type="text" '. $this->get_name( $meta ) .' value="'. esc_attr( $this->value ) .'" data-type="'. esc_attr( $data ) .'"/>';
				echo '<a class="mfn-option-btn mfn-button-delete" title="Delete" href="#"><span class="mfn-icon mfn-icon-delete"></span></a>';
			echo '</div>';

			echo '<div class="form-addon-append">';
				echo '<a href="#" class="mfn-button-upload"><span class="label">'. esc_html__( 'Browse', 'mfn-opts' ) .'</span></a>';
			echo '</div>';

			if ( 'image' == $data ) {
				echo '<div class="break"></div>';
				echo '<div class="selected-image">';
					echo '<img src="'. esc_attr( $this->value ) .'" alt="" />';
				echo '</div>';
			}

		echo '</div>';

		echo $this->get_description();

		// enqueue
		
		// visual builder
		if( ! $vb ){
			$this->enqueue();
		}else{
			$this->vbenqueue();
		}

	}

	/**
	 * Enqueue
	 */

	public function enqueue()
	{
		wp_enqueue_media();
		wp_enqueue_script( 'mfn-opts-field-upload', MFN_OPTIONS_URI .'fields/upload/field_upload.js', array( 'jquery' ), MFN_THEME_VERSION, true );
	}

	public function vbenqueue()
	{
		wp_enqueue_media();
		wp_enqueue_script( 'mfn-opts-field-upload', MFN_OPTIONS_URI .'fields/upload/vb_field_upload.js', array( 'jquery' ), MFN_THEME_VERSION, true );
	}

}
