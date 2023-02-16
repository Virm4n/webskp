<?php
class MFN_Options_switch extends Mfn_Options_field
{

	/**
	 * Render
	 */

	public function render($meta = false, $vb = false )
	{
		$preview = '';

		// preview

		if ( ! empty( $this->field['preview'] ) ){
			$preview = 'preview-'. $this->field['preview'];
		}

		// output -----

		echo '<div class="form-group segmented-options">';
			echo '<div class="form-control">';
				echo '<ul class="'. esc_attr( $preview ) .'">';

					foreach ( $this->field['options'] as $k => $v ) {

						if( checked( $this->value, $k, false ) ){
							$class = 'active';
						} else {
							$class = false;
						}

						echo '<li class="'. $class .'">';
							echo '<fieldset>';
								echo '<input type="checkbox" '. $this->get_name( $meta ) .' value="'. esc_attr( $k ) .'" '. checked( $this->value, $k, false ) .' autocomplete="off" />';
								echo '<a href="#"><span class="text">'. esc_attr( $v ) .'</span></a>';
							echo '</fieldset>';
						echo '</li>';
					}

				echo '</ul>';
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
		wp_enqueue_script( 'mfn-opts-field-switch', MFN_OPTIONS_URI .'fields/switch/field_switch.js', array( 'jquery' ), MFN_THEME_VERSION, true );
	}

	public function vbenqueue()
	{
		wp_enqueue_script( 'mfn-opts-field-switch', MFN_OPTIONS_URI .'fields/switch/vb_field_switch.js', array( 'jquery' ), MFN_THEME_VERSION, true );
	}
}
