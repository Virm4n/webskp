<?php
class MFN_Options_info extends Mfn_Options_field
{

	/**
	 * Render
	 */

	public function render($meta = false)
	{

		echo '<div class="mfn-alert">';

			echo '<div class="alert-icon mfn-icon-information"></div>';

			echo '<div class="alert-content">';
				echo '<p>'. $this->field['title'] .'</p>';
			echo '</div>';

			if( isset( $this->field['link'] ) && isset( $this->field['label'] ) ){

				echo '<div class="alert-options">';
					echo '<a target="_blank" href="'. esc_url( $this->field['link'] ) .'">'. esc_html( $this->field['label'] ) .'</a>';
				echo '</div>';

			}

		echo '</div>';

	}
}
