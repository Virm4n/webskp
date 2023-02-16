<?php
class MFN_Options_pills extends Mfn_Options_field
{

	/**
	 * Render
	 */

	public function render( $meta = false, $vb = false )
	{

		// placeholder

		if( ! empty( $this->field['std'] ) ){
			$placeholder = $this->field['std'];
		} else {
			$placeholder = false;
		}


		// output -----


		echo '<div class="form-group mfn-pills-field">';
			echo '<div class="form-control">';

				echo '<input type="text" class="mfn-pills-input" placeholder="type in..."/>';
				echo '<input type="hidden" class="mfn-pills-input-hidden mfn-form-control mfn-form-input preview-classesinput preview-classinput" value="'. esc_attr( $this->value ) .'" '. $this->get_name( $meta ) .' placeholder="'. esc_attr( $placeholder ) .'"/>';

			echo '</div>';
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
		wp_enqueue_script( 'mfn-opts-field-pills', MFN_OPTIONS_URI .'fields/pills/field_pills.js', array( 'jquery' ), MFN_THEME_VERSION, true );
	}

	public function vbenqueue()
	{
		wp_enqueue_script( 'mfn-opts-field-pills-vb', MFN_OPTIONS_URI .'fields/pills/field_pills_vb.js', array( 'jquery' ), MFN_THEME_VERSION, true );
	}
}
