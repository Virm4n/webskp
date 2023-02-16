<?php
class MFN_Options_font_select extends Mfn_Options_field
{

	/**
	 * Render
	 */

	public function render( $meta = false )
	{

		$fonts = mfn_fonts();

		// output -----

		echo '<div class="form-group">';
			echo '<div class="form-control">';

				echo '<select class="mfn-form-control mfn-form-select" '. $this->get_name( $meta ) .'>';

					// system fonts

					echo '<optgroup label="'. esc_html__( 'System', 'mfn-opts' ) .'">';
						foreach ($fonts['system'] as $font) {
							echo '<option value="'. esc_attr($font) .'" '. selected($this->value, $font, false).'>'. esc_html($font) .'</option>';
						}
					echo '</optgroup>';

					// custom font | uploaded in theme options

					if ( ! empty( $fonts['custom'] ) ) {
						echo '<optgroup label="'. esc_html__( 'Custom Fonts', 'mfn-opts' ) .'">';
							foreach ($fonts['custom'] as $font) {
								echo '<option value="'. esc_attr($font) .'" '. selected($this->value, $font, false).'>'. esc_html(str_replace('#', '', $font)) .'</option>';
							}
						echo '</optgroup>';
					}

					// google fonts | all

					echo '<optgroup label="'. esc_html__( 'Google Fonts', 'mfn-opts' ) .'">';
						foreach ($fonts['all'] as $font) {
							echo '<option value="'. esc_attr($font) .'" '. selected($this->value, $font, false) .'>'. esc_html($font) .'</option>';
						}
					echo '</optgroup>';

				echo '</select>';

			echo '</div>';
		echo '</div>';

		echo $this->get_description();
	}
}
