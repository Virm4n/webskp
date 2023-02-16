<?php
class MFN_Options_multi_text extends Mfn_Options_field
{

	/**
	 * Render
	 */

	public function render()
	{

		$class = false;

		// class

		if( ! $this->value ){
			$class = 'empty';
		}

		// name

		$name = $this->prefix .'['. $this->field['id'] .'][]';

		// output -----

		echo '<div class="form-group sidebar-add has-addons has-addons-append '. esc_attr( $class ) .'">';

			echo '<div class="form-control">';
				echo '<input class="mfn-form-control mfn-form-input" type="text" placeholder="'. __('Type sidebar title here', 'mfn-opts') .'" autocomplete=off />';
			echo '</div>';

			echo '<div class="form-addon-append">';
				echo '<a href="#" class="sidebar-add-button"><span class="label">'. __('Add sidebar', 'mfn-opts') .'</span></a>';
			echo '</div>';

			echo '<div class="break"></div>';

			echo '<div class="added-sidebars">';
				echo '<ul>';

					if ( isset( $this->value ) && is_array( $this->value ) ) {
						foreach ( $this->value as $k => $value ) {
							if ( $value != '' ) {

								echo '<li>';
									echo '<input type="hidden" name="'. esc_attr( $name ) .'" value="'. esc_attr( $value ) .'" />';
									echo '<span class="sidebar-title">'. esc_attr( $value ) .'</span>';
									echo '<a class="mfn-option-btn mfn-option-blue mfn-btn-delete" title="'. __('Delete', 'mfn-opts') .'" href="#">';
										echo '<span class="mfn-icon mfn-icon-delete"></span>';
									echo '</a>';
								echo '</li>';

							}
						}
					}

					echo '<li class="default">';
						echo '<input type="hidden" data-name="'. esc_attr( $name ) .'" value="" />';
						echo '<span class="sidebar-title">Default sidebar</span>';
						echo '<a class="mfn-option-btn mfn-option-blue mfn-btn-delete" title="'. __('Delete', 'mfn-opts') .'" href="#">';
							echo '<span class="mfn-icon mfn-icon-delete"></span>';
						echo '</a>';
					echo '</li>';

				echo '</ul>';
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
		wp_enqueue_script('mfn-opts-field-multi-text', MFN_OPTIONS_URI .'fields/multi_text/field_multi_text.js', array('jquery'), MFN_THEME_VERSION, true);
	}

}
