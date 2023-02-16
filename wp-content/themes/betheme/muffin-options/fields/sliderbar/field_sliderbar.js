(function($) {

  /* globals jQuery */

  "use strict";

  var $group = $('.mfn-ui .form-group.range-slider');

  function isNumeric(n) {

    return !isNaN(parseFloat(n)) && isFinite(n);
  }

  function inputChange( $input ) {

    var $form = $input.closest('.form-group'),
      $slider = $('.sliderbar', $form);

    var value = $input.val(),
      min = $input.attr( 'min' ) * 1,
      max = $input.attr( 'max' ) * 1;

    $slider.slider( 'value', value );

    if ( ! isNumeric( value ) || value < min || value > max) {
      $input.addClass( 'error' );
    } else {
      $input.removeClass( 'error' );
    }

  }

	/**
   * $(document).ready
   * Specify a function to execute when the DOM is fully loaded.
   */

  $(function($){

    // init

    $('.sliderbar', $group).each(function() {

      var $form = $(this).closest('.form-group'),
        $input = $('input', $form);

      var value = $input.attr( 'value' ),
        std = $input.attr( 'placeholder' ),
        min = $input.attr( 'min' ) * 1,
        max = $input.attr( 'max' ) * 1;

      if( ! value && std ){
        value = std;
      }

      $(this).slider({
        range: 'min',
        min: min,
        max: max,
        value: value,
        slide: function(event, ui) {
          $input.val( ui.value );
          $input.removeClass( 'error' );
        }
      });

    });

    // input value change | change

    $('input', $group).on('change', function() {

      inputChange($(this));

    });

  });

})(jQuery);
