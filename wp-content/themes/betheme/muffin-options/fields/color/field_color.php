<?php
class MFN_Options_color extends Mfn_Options_field
{

	/**
	 * Render
	 */

	public function render( $meta = false, $vb = false )
	{

		// value

		if ( $this->value ) {
			$value = $this->value;
		} elseif( ! empty( $this->field['std'] ) ) {
			$value = $this->field['std'];
		} else {
			$value = '';
		}

		// placeholder

		if( ! empty( $this->field['std'] ) ){
			$placeholder = $this->field['std'];
		} else {
			$placeholder = false;
		}

		// alpha

		if ( isset( $this->field[ 'alpha' ] ) ) {
			$alpha_escaped = 'data-alpha="true"';
		} else {
			$alpha_escaped = false;
		}

		// border

		if ( 'light' == mfn_brightness( $value, 240 ) ){
			$border = false;
		} else {
			$border = $value;
		}

		// output -----

		echo '<div class="form-group color-picker has-addons has-addons-prepend">';

			echo '<div class="color-picker-group">';

				echo '<div class="form-addon-prepend">';
					echo '<a href="#" class="color-picker-open"><span class="label '. esc_attr( mfn_brightness( $value ) ) .'" style="background-color:'. esc_attr( $value ) .';border-color:'. esc_attr( $border ) .'"><i class="icon-bucket"></i></span></a>';
				echo '</div>';

				echo '<div class="form-control has-icon has-icon-right">';
					echo '<input class="mfn-form-control mfn-form-input" type="text" placeholder="'. esc_attr( $placeholder ) .'" '. $this->get_name( $meta ) .' value="'. esc_attr( $value ) .'" autocomplete="off" />';
					echo '<a class="mfn-option-btn mfn-option-text color-picker-clear" href="#"><span class="text">Clear</span></a>';
				echo '</div>';

				echo '<input class="has-colorpicker" type="text" value="'. esc_attr( $value ) .'" '. $alpha_escaped .' autocomplete="off" style="visibility:hidden" />';

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
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'mfn-opts-field-color', MFN_OPTIONS_URI .'fields/color/field_color.js', array( 'wp-color-picker' ), MFN_THEME_VERSION, true);
	}

	public function vbenqueue()
	{
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'mfn-opts-field-color', MFN_OPTIONS_URI .'fields/color/vb_field_color.js', array( 'wp-color-picker' ), MFN_THEME_VERSION, true);
	}
}
