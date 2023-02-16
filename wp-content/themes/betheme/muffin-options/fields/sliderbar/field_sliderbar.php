<?php
class MFN_Options_sliderbar extends Mfn_Options_field
{

	/**
	 * Render
	 */

	public function render( $meta = false )
	{
		$class = array( 'form-group', 'range-slider' );

		// class

		if ( ! empty( $this->field['after'] ) ) {
			$class['has-addons'] = 'has-addons';
			$class[] = 'has-addons-append';
		}

		$class = implode( ' ', $class );

		// placeholder

		if( ! empty( $this->field['std'] ) ){
			$placeholder = $this->field['std'];
		}

		// parameters

		$min = isset( $this->field['param']['min'] ) ? $this->field['param']['min'] : 1;
		$max = isset( $this->field['param']['max'] ) ? $this->field['param']['max'] : 100;

		// output -----

		echo '<div class="'. esc_attr( $class ) .'">';

			echo '<div class="form-control">';
				echo '<input class="mfn-form-control mfn-form-input" type="number" min="'. esc_attr( $min ) .'" max="'. esc_attr( $max ) .'" '. $this->get_name( $meta ) .' value="'. esc_attr( $this->value ) .'" placeholder="'. esc_attr( $placeholder ) .'" />';
			echo '</div>';

			if( ! empty( $this->field['after'] ) ){
				echo '<div class="form-addon-append">';
					echo '<span class="label">'. esc_attr( $this->field['after'] ) .'</span>';
				echo '</div>';
			}

			echo '<div class="sliderbar"></div>';
			echo '<div class="range">'. esc_attr( $min ) .' - '. esc_attr( $max ) .'</div>';

		echo '</div>';

		echo $this->get_description();

		// enqueue

		$this->enqueue();




		return false;

		echo '<div class="mfn-slider-field clearfix">';

			echo '<div id="'. esc_attr($this->field['id']) .'_sliderbar" class="sliderbar" rel="'. esc_attr($this->field['id']) .'" data-min="'. esc_attr($min) .'" data-max="'. esc_attr($max) .'"></div>';

			echo '<input type="number" class="sliderbar_input" min="'. esc_attr($min) .'" max="'. esc_attr($max) .'" id="'. esc_attr($this->field['id']) .'" name="'. esc_attr($this->prefix.'['.$this->field['id'].']') .'" value="'. esc_attr($this->value) .'"/>';

			echo '<div class="range">'. esc_attr($min) .' - '. esc_attr($max) .'</div>';

			if (isset($this->field['desc'])) {
				echo '<span class="description">'. wp_kses($this->field['desc'], mfn_allowed_html('desc')) .'</span>';
			}

		echo '</div>';
	}

	/**
	 * Enqueue
	 */

	public function enqueue()
	{
		wp_enqueue_style( 'mfn-opts-jquery-ui-css' );
		wp_enqueue_script( 'mfn-opts-field-sliderbar', MFN_OPTIONS_URI .'fields/sliderbar/field_sliderbar.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-slider' ), MFN_THEME_VERSION, true );
	}
}
