<?php
class MFN_Options_ajax extends Mfn_Options_field
{

	/**
	 * Render
	 */

	public function render( $meta = false )
	{
		$action = isset( $this->field['action'] ) ? $this->field['action'] : '';
		$param 	= isset( $this->field['param'] ) ? $this->field['param'] : '';

		echo '<div class="form-group ajax">';
			echo '<div class="form-control">';

				echo '<a class="mfn-btn mfn-btn-blue" href="#" data-ajax="'. esc_url( admin_url( 'admin-ajax.php' ) ) .'" data-action="'. esc_attr( $action ) .'" data-param="'. esc_attr( $param ) .'">';
					echo '<span class="btn-wrapper">'. esc_html__( 'Randomize', 'mfn-opts' ) .'</span>';
				echo '</a>';

			echo '</div>';
		echo '</div>';

		echo $this->get_description();

		// enqueue

		$this->enqueue();
	}

	/**
	 * Enqueue
	 */

	public function enqueue()
	{
		wp_enqueue_script( 'mfn-opts-field-ajax', MFN_OPTIONS_URI .'fields/ajax/field_ajax.js', array( 'jquery' ), MFN_THEME_VERSION, true );
	}
}
