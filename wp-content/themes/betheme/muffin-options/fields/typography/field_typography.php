<?php
class MFN_Options_typography extends Mfn_Options_field
{

	/**
	 * Render
	 */

	public function render( $meta = false )
	{
		$disable = false;

		// name

		$name = $this->prefix .'['. $this->field['id'] .']';

		// disable

		if( isset( $this->field['disable'] ) ){
			$disable = $this->field['disable'];
		}

		// value

		$value = $this->value;

		if ( ! $value ) {

			$value = $this->field['std'];

		} elseif ( ! is_array($value)) {

			// compatibility with Be < 13.5
			$value = array(
				'size' => $value,
				'line_height' => $this->field['std']['line_height'],
				'weight_style' => $this->field['std']['weight_style'],
				'letter_spacing' => $this->field['std']['letter_spacing'],
			);

		}

		// output -----

		// font size

		echo '<div class="form-group typography has-addons has-addons-append">';

			echo '<div class="form-control" data-key="'. esc_html__('Font size', 'mfn-opts') .'">';
				echo '<input class="mfn-form-control mfn-form-number" type="number" name="'. esc_attr( $name ) .'[size]" value="'. esc_attr( $value['size'] ) .'" data-key="font-size" placeholder="'. esc_attr( $this->field['std']['size'] ) .'">';
			echo '</div>';
			echo '<div class="form-addon-append">';
				echo '<span class="label">px</span>';
			echo '</div>';

			if ( 'line_height' != $disable ) {

				echo '<div class="form-control" data-key="'. esc_html__('Line height', 'mfn-opts') .'">';
					echo '<input class="mfn-form-control mfn-form-number" type="number" name="'. esc_attr( $name ) .'[line_height]" value="'. esc_attr( $value['line_height'] ) .'" data-key="line-height" placeholder="'. esc_attr( $this->field['std']['line_height'] ) .'">';
				echo '</div>';
				echo '<div class="form-addon-append">';
					echo '<span class="label">px</span>';
				echo '</div>';

			}

			echo '<div class="form-control form-control-font" data-key="'. esc_html__('Font weight & style', 'mfn-opts') .'">';
				echo '<select class="mfn-form-control mfn-form-select" name="'. esc_attr( $name ) .'[weight_style]" data-key="weight-style">';
					echo '<option value="100" '. selected($value['weight_style'], '100', false) .'>100 thin</option>';
					echo '<option value="100italic" '. selected($value['weight_style'], '100italic', false) .'>100 thin italic</option>';
					echo '<option value="200" '. selected($value['weight_style'], '200', false) .'>200 extra-light</option>';
					echo '<option value="200italic" '. selected($value['weight_style'], '200italic', false) .'>200 extra-light italic</option>';
					echo '<option value="300" '. selected($value['weight_style'], '300', false) .'>300 light</option>';
					echo '<option value="300italic" '. selected($value['weight_style'], '300italic', false) .'>300 light italic</option>';
					echo '<option value="400" '. selected($value['weight_style'], '400', false) .'>400 regular</option>';
					echo '<option value="400italic" '. selected($value['weight_style'], '400italic', false) .'>400 regular italic</option>';
					echo '<option value="500" '. selected($value['weight_style'], '500', false) .'>500 medium</option>';
					echo '<option value="500italic" '. selected($value['weight_style'], '500italic', false) .'>500 medium italic</option>';
					echo '<option value="600" '. selected($value['weight_style'], '600', false) .'>600 semi-bold</option>';
					echo '<option value="600italic" '. selected($value['weight_style'], '600italic', false) .'>600 semi-bold italic</option>';
					echo '<option value="700" '. selected($value['weight_style'], '700', false) .'>700 bold</option>';
					echo '<option value="700italic" '. selected($value['weight_style'], '700italic', false) .'>700 bold italic</option>';
					echo '<option value="800" '. selected($value['weight_style'], '800', false) .'>800 extra-bold</option>';
					echo '<option value="800italic" '. selected($value['weight_style'], '800italic', false) .'>800 extra-bold italic</option>';
					echo '<option value="900" '. selected($value['weight_style'], '900', false) .'>900 black</option>';
					echo '<option value="900italic" '. selected($value['weight_style'], '900italic', false) .'>900 black italic</option>';
				echo '</select>';
			echo '</div>';

			echo '<div class="form-control" data-key="'. esc_html__('Letter spacing', 'mfn-opts') .'">';
				echo '<input class="mfn-form-control mfn-form-number" type="number" name="'. esc_attr( $name ) .'[letter_spacing]" value="'. esc_attr( $value['letter_spacing'] ) .'" data-key="letter-spacing" placeholder="'. esc_attr( $this->field['std']['letter_spacing'] ) .'">';
			echo '</div>';
			echo '<div class="form-addon-append">';
				echo '<span class="label">px</span>';
			echo '</div>';

		echo '</div>';





		// description

		echo $this->get_description();

		return false;

		echo '<div class="typography-wrapper typography-size">';
			echo '<label>'. esc_html__('Font size', 'mfn-opts') .'</label>';
			echo '<input type="number" name="'. esc_attr($name) .'[size]" value="'. esc_attr($value['size']) .'" data-key="font-size" />';
		echo '</div>';

		// line height

		if ( 'line_height' != $disable ) {
			echo '<div class="typography-wrapper typography-line">';
				echo '<label>'. esc_html__('Line height', 'mfn-opts') .'</label>';
				echo '<input type="number" name="'. esc_attr($name) .'[line_height]" value="'. esc_attr($value['line_height']) .'" data-key="line-height" />';
			echo '</div>';
		}

		// weight

		echo '<div class="typography-wrapper typography-weight">';

			echo '<label>'. esc_html__('Font weight & style', 'mfn-opts') .'</label>';

			echo '<select name="'. esc_attr($name) .'[weight_style]" data-key="weight-style">';
				echo '<option value="100" '. selected($value['weight_style'], '100', false) .'>100 Thin</option>';
				echo '<option value="100italic" '. selected($value['weight_style'], '100italic', false) .'>100 Thin Italic</option>';
				echo '<option value="200" '. selected($value['weight_style'], '200', false) .'>200 Extra-Light</option>';
				echo '<option value="200italic" '. selected($value['weight_style'], '200italic', false) .'>200 Extra-Light Italic</option>';
				echo '<option value="300" '. selected($value['weight_style'], '300', false) .'>300 Light</option>';
				echo '<option value="300italic" '. selected($value['weight_style'], '300italic', false) .'>300 Light Italic</option>';
				echo '<option value="400" '. selected($value['weight_style'], '400', false) .'>400 Regular</option>';
				echo '<option value="400italic" '. selected($value['weight_style'], '400italic', false) .'>400 Regular Italic</option>';
				echo '<option value="500" '. selected($value['weight_style'], '500', false) .'>500 Medium</option>';
				echo '<option value="500italic" '. selected($value['weight_style'], '500italic', false) .'>500 Medium Italic</option>';
				echo '<option value="600" '. selected($value['weight_style'], '600', false) .'>600 Semi-Bold</option>';
				echo '<option value="600italic" '. selected($value['weight_style'], '600italic', false) .'>600 Semi-Bold Italic</option>';
				echo '<option value="700" '. selected($value['weight_style'], '700', false) .'>700 Bold</option>';
				echo '<option value="700italic" '. selected($value['weight_style'], '700italic', false) .'>700 Bold Italic</option>';
				echo '<option value="800" '. selected($value['weight_style'], '800', false) .'>800 Extra-Bold</option>';
				echo '<option value="800italic" '. selected($value['weight_style'], '800italic', false) .'>800 Extra-Bold Italic</option>';
				echo '<option value="900" '. selected($value['weight_style'], '900', false) .'>900 Black</option>';
				echo '<option value="900italic" '. selected($value['weight_style'], '900italic', false) .'>900 Black Italic</option>';
			echo '</select>';

		echo '</div>';

		// letter spacing

		echo '<div class="typography-wrapper">';
			echo '<label>'. esc_html__('Letter spacing', 'mfn-opts') .'</label>';
			echo '<input type="number" name="'. esc_attr($name) .'[letter_spacing]" value="'. esc_attr($value['letter_spacing']) .'" data-key="letter-spacing"/>';
			// echo '<div class="desc-right">px</div>';
		echo '</div>';

	}
}
