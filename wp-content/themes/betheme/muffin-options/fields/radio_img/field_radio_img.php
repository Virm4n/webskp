<?php
class MFN_Options_radio_img extends Mfn_Options_field
{

	/**
	 * Render
	 */

	public function render($meta = false)
	{

		// alias

		$alias = $this->field['id'];

		if( ! empty( $this->field['alias'] ) ){
			$alias = $this->field['alias'];
		}

		// output -----

		echo '<div class="form-group visual-options">';
			echo '<div class="form-control">';
				echo '<ul>';

					foreach ( $this->field['options'] as $k => $v ) {

						if( checked( $this->value, $k, false ) ){
							$class = 'active';
						} else {
							$class = false;
						}

						echo '<li class="'. $class .'">';
							echo '<input type="radio" '. $this->get_name( $meta ) .' value="'. esc_attr( $k ) .'" '. checked( $this->value, $k, false ) .' autocomplete="off"/>';
							echo '<a href="#">';
								echo '<div class="mfn-icon">';

									if( ! $k ){
										$k = 'default';
									} else {
										$k = str_replace( array( ',', ' ' ), '-', $k );
									}

									echo '<img src="'. esc_url( MFN_OPTIONS_URI .'svg/select/'. $alias .'/'. $k .'.svg' ) .'" alt="'. esc_attr( $v ) .'" />';

								echo '</div>';
								echo '<span class="label">'. wp_kses( $v, mfn_allowed_html( 'desc') ) .'</span>';
							echo '</a>';
						echo '</li>';
					}

				echo '</ul>';	
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
		wp_enqueue_script( 'mfn-opts-field-radio_img', MFN_OPTIONS_URI .'fields/radio_img/field_radio_img.js', array( 'jquery' ), MFN_THEME_VERSION, true );
	}

}
