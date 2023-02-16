<?php
class MFN_Options_dimensions extends Mfn_Options_field
{

	/**
	 * Render
	 */

	public function render( $meta = false )
	{
		$class = false;
		$placeholder = [
			'top' => false,
			'right' => false,
			'bottom' => false,
			'left' => false,
		];

 		// inputs

    $inputs = [
      'top', 'right', 'bottom', 'left'
    ];

		// value

  	if( ! is_array( $this->value ) ){
  		$this->value = $this->field['std'];
  	}

		// class

		if( $this->value['isLinked'] ){
			$class = 'isLinked';
		}

		// placeholder

		if( ! empty( $this->field['std'] ) && is_array( $this->field['std'] ) ){
			$placeholder = $this->field['std'];
		}

		// output -----

		echo '<div class="form-group multiple-inputs has-addons has-addons-append '. esc_attr( $class ) .'">';

			// echo '<div class="form-addon-prepend">';
			// 	echo '<span class="label"><i class="icon-monitor"></i></span>';
			// echo '</div>';

			echo '<div class="form-control">';

				foreach( $inputs as $input ){

					$readonly = false;
					$input_class = false;

					if( 'top' != $input ){

						$in_class = 'disableable';

						if( $class ){
							$readonly = 'readonly="readonly"';
							$input_class = 'readonly';
						}

					} else {

						$in_class = false;

					}

					echo '<div class="field '. esc_attr( $in_class ) .'" data-key="'. esc_attr( $input ) .'">';
						echo '<input type="text" class="mfn-form-control mfn-form-input numeral '. esc_attr( $input_class ) .'" '. $this->get_name( $meta, $input ) .' data-key="'. esc_attr( $input ) .'" value="'. esc_attr( $this->value[$input] ) .'" '. $readonly .' autocomplete="off" placeholder="'. esc_attr( $placeholder[$input] ).'" />';
					echo '</div>';

				}

			echo '</div>';

			echo '<div class="form-addon-append">';
				echo '<a href="#" class="link">';
					echo '<span class="label"><i class="icon-link"></i></span>';
					echo '<input type="hidden" '. $this->get_name( $meta, 'isLinked' ) .' value="'. esc_attr( $this->value['isLinked'] ) .'" autocomplete="off"/>';
				echo '</a>';
			echo '</div>';

		echo '</div>';

		echo $this->get_description();

		// enqueue

		$this->enqueue();

	}

	/**
	 * Enqueue Function.
	 */

	public function enqueue()
	{
		wp_enqueue_script( 'mfn-field-dimensions', MFN_OPTIONS_URI .'fields/dimensions/field_dimensions.js', array( 'jquery' ), MFN_THEME_VERSION, true );
	}

}
