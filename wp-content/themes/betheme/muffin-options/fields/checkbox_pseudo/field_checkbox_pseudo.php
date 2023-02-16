<?php
class MFN_Options_checkbox_pseudo extends Mfn_Options_field
{

	/**
	 * Render
	 */

	public function render( $meta = false )
	{
		if ( ! is_array( $this->field[ 'options' ] ) ) {
			return false;
		}

		// prepare values array

		$this->value = preg_replace( '/\s+/', ' ', $this->value );
		$values = explode( ' ', $this->value );

		// output -----

		echo '<div class="form-group checkboxes pseudo">';

			echo '<input class="value" type="hidden" '. $this->get_name( $meta ) .' value="'. esc_attr( $this->value ) .'"/>';

			echo '<div class="form-control">';
				echo '<ul>';

					foreach ( $this->field['options'] as $k => $v ) {

						$check = false;
						$class = false;

						if ( in_array( $k, $values ) ) {
							$check = $k;
							$class = "active";
						}

						echo '<li class="'. esc_attr( $class ) .'">';
							echo '<input type="checkbox" class="mfn-form-checkbox" value="'. esc_attr( $k ) .'" '. checked( $check, $k, false ) .' />';
							echo '<span class="title">'. wp_kses( $v, mfn_allowed_html('desc') ) .'</span>';
						echo '</li>';

					}

				echo '</ul>';
			echo '</div>';

		echo '</div>';

		echo $this->get_description();

		// enqueue
		
		// visual builder
		
		if( strpos( $meta, 'sections[' ) === false ){
			$this->enqueue();
		}

	}

	/**
	 * Enqueue Function
	 */

	public function enqueue()
	{
		wp_enqueue_script( 'mfn-opts-field-checkbox-pseudo', MFN_OPTIONS_URI .'fields/checkbox_pseudo/field_checkbox_pseudo.js', array( 'jquery' ), MFN_THEME_VERSION, true );
	}

}
