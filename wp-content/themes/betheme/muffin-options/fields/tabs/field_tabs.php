<?php
class MFN_Options_tabs extends Mfn_Options_field
{

	/**
	 * Render
	 */

	public function render( $existing = false )
	{

		$field_prefix = '';
		$preview = '';
		$primary = 'title';

		// uid

		if ( empty( $this->field['uid'] ) ){
			$this->field['uid'] = '%uid%';
		}

		// name

		$name	= $this->field['id'] .'['. $this->field['uid'] .']';

		if ( 'new' == $existing ) {
			$field_prefix = 'data-';
		}

		// visual builder
		
		if( strpos( $existing, 'sections[' ) !== false ){
			$name = $existing;
		}

		// value

		if( ! is_array( $this->value ) ){
			$this->value = $this->field['std'];
		}

		// preview

		if ( ! empty( $this->field['preview'] ) ){
			$preview = 'preview-'. $this->field['preview'];
		}

		// primary

		if( isset( $this->field['primary'] ) ){
			$primary = $this->field['primary'];
		}

		if( empty( $this->field['options'][$primary][2] ) ){
			$this->field['options'][$primary][2] = '';
		}

		// output -----

		if( empty( $this->field['options'] ) ){
			echo 'please enter default fields';
			return false;
		}

		echo '<div class="form-group tabs mfn-form-verical">';

			echo '<ul class="tabs-wrapper '. esc_attr( $preview ) .'">';

				echo '<li class="tab default">';

					echo '<div class="tab-header">';

						echo '<a class="mfn-option-btn mfn-option-blank mfn-tab-toggle mfn-tab-show" href="#"><span class="mfn-icon mfn-icon-arrow-down"></span></a>';
						echo '<a class="mfn-option-btn mfn-option-blank mfn-tab-toggle mfn-tab-hide" href="#"><span class="mfn-icon mfn-icon-arrow-up"></span></a>';

            echo '<h6 class="title">'. esc_html( $this->field['options'][$primary][2] ) .'</h6>';
						echo '<a class="mfn-option-btn mfn-option-blue mfn-tab-clone" href="#"><span class="mfn-icon mfn-icon-clone"></span></a>';
						echo '<a class="mfn-option-btn mfn-option-blue mfn-tab-delete" href="#"><span class="mfn-icon mfn-icon-delete"></span></a>';

					echo '</div>';

					echo '<div class="tab-content">';
					
						foreach( $this->field['options'] as $label => $param ){

							// visual builder
							if( strpos( $existing, 'sections[' ) !== false ){
								$field_name = $name .'[0]['. $label .']';
							}else{
								$field_name = $name .'['. $label .'][]';
							}

							$js = false;
							if( $primary == $label ){
								$js = 'js-title';
							}

							echo '<div class="form-control">';
								echo '<label class="form-label">'. esc_html( $param[1] ) .'</label>';

								if( 'input' == $param[0] ){
									echo '<input class="mfn-form-control mfn-form-input mfn-tab-'. esc_attr($label) .' '. esc_attr($js) .'" type="text" data-default="'. esc_attr( $field_name ) .'" value="'. esc_html( $param[2] ) .'"/>';
								} else if ( 'textarea' == $param[0] ){
									echo '<textarea class="mfn-form-control mfn-form-textarea" rows="3" data-default="'. esc_attr( $field_name ) .'">'. esc_textarea( $param[2] ) .'</textarea>';
								}

							echo '</div>';

						}

					echo '</div>';

				echo '</li>';

				if ( ! empty( $this->value ) ) {

					if ( is_array( $this->value ) ){

						// visual builder
						$l = 0;

						foreach ( $this->value as $k => $value ) {

							if( empty( $value[$primary] ) ){
								$value[$primary] = '';
							}

							echo '<li class="tab">';

								echo '<div class="tab-header">';

									echo '<a class="mfn-option-btn mfn-option-blank mfn-tab-toggle mfn-tab-show" href="#"><span class="mfn-icon mfn-icon-arrow-down"></span></a>';
									echo '<a class="mfn-option-btn mfn-option-blank mfn-tab-toggle mfn-tab-hide" href="#"><span class="mfn-icon mfn-icon-arrow-up"></span></a>';

			            echo '<h6 class="title">'. esc_html( $value[$primary] ) .'</h6>';
									echo '<a class="mfn-option-btn mfn-option-blue mfn-tab-clone" href="#"><span class="mfn-icon mfn-icon-clone"></span></a>';
									echo '<a class="mfn-option-btn mfn-option-blue mfn-tab-delete" href="#"><span class="mfn-icon mfn-icon-delete"></span></a>';

								echo '</div>';

								echo '<div class="tab-content">';

									// visual builder
									

									foreach( $this->field['options'] as $label => $param ){

										// visual builder
										if( strpos( $existing, 'sections[' ) !== false ){
											$field_name = $name .'['. $l .']['. $label .']';
										}else{
											$field_name = $name .'['. $label .'][]';
										}

										if( empty( $value[$label] ) ){
											$value[$label] = '';
										}

										$js = false;
										if( $primary == $label ){
											$js = 'js-title';
										}

										echo '<div class="form-control">';
											echo '<label class="form-label">'. esc_html( $param[1] ) .'</label>';

											if( 'input' == $param[0] ){
												echo '<input type="text" class="mfn-form-control mfn-form-input mfn-tab-'. esc_attr( $label ) .' '. esc_attr($js) .'" '. esc_attr( $field_prefix ) .'name="'. esc_attr( $field_name ) .'" value="'. esc_html( $value[$label] ) .'"/>';
											} else if ( 'textarea' == $param[0] ){
												echo '<textarea class="mfn-form-control mfn-form-textarea" rows="3" '. esc_attr( $field_prefix ) .'name="'. esc_attr( $field_name ) .'">'. esc_textarea( $value[$label] ) .'</textarea>';
											}

										echo '</div>';

										

									}

								echo '</div>';

							echo '</li>';

							// visual builder
							$l++;

						}

					}

				}

			echo '</ul>';

			echo '<a href="#" class="mfn-button-add">'. esc_html__( 'Add new', 'mfn-opts' ) .'</a>';

		echo '</div>';

		echo $this->get_description();

		// enqueue
		
		// visual builder
		if( strpos( $existing, 'sections[' ) === false ){
			$this->enqueue();
		}
	}

	/**
	 * Enqueue
	*/

	public function enqueue()
	{
		wp_enqueue_script( 'mfn-opts-field-tabs', MFN_OPTIONS_URI .'fields/tabs/field_tabs.js', array( 'jquery' ), MFN_THEME_VERSION, true );
	}
}
